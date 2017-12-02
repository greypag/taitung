/*!
 * Screets Live Chat - Console User Interface
 * Author: @screetscom
 *
 * COPYRIGHT © 2016 Screets d.o.o. All rights reserved.
 * This  is  commercial  software,  only  users  who have purchased a valid
 * license  and  accept  to the terms of the  License Agreement can install
 * and use this program.
 */

;(function () {

	var W = window,
		D = document,
		title = D.title,
		root = this,
		prev_schat_ui = root.SLC_UI,
		// jQuery style selector for more complex queries (slower than getElementById)
		$ = function ( selector ) {
			return D.querySelector( selector );
		},
		removeClass = function( replace, new_class ) {
			var classes = replace.split( ' ' ),
				rx = '';

			for( var i=0; i < classes.length; i++ ) {
				rx = new RegExp( '(?:^|\\s)' + classes[i] + '(?!\\S)', 'g' );

				// Update class
				this.className = this.className.replace( rx , '' );

				if( new_class ) {
					this.className += ' ' + new_class;
				}
			}
		},
		hasClass = function( selector ) {
			var className = " " + selector + " ";

			if ( ( " " + this.className + " " ).replace( /[\n\t]/g, " " ).indexOf( className ) > -1 ) {
				return true;
			}
			return false;
		};


	function SLC_UI( opts ) {

		var self = this;

		// Default options
		var default_opts = {
			app_id              : '', // Real-time application
			token               : '', // Custom authentication token
			max_msgs            : 70, // Total number of chat messages to load per chat
			clean_time       	: 6, // (hours) Clean user's from the database (their session will be kept)
			max_inactive        : 1, // (hours) Visitors max inactive time, then they will be deleted
			user                : {}, // Default user data
			is_frontend         : false // Is front-end
		};

		// Setup and establish options
		this.opts = default_opts;
		for( var k in opts ) { this.opts[k] = opts[k]; }

		// Get Live Chat application
		this.app = new SChat( this.opts );

		// Useful IDs and data
		this.current_status = 'connecting'; // 'online', 'offline'
		this.chats = {}; // Chat data
		this.private_chats = {};
		this.read_ntfs = {};
		this.chat_msgs = {};
		this.replies = {}; // Unsent replies
		this.last_item_id = ''; // Last selected item (user, chat)
		this.current_user_id = '';
		this.current_chat_id = '';
		this.timeouts = {};
		this.last_msgs = {};
		this.W_state = true; // Window is actively using?
		this.settings = {}; // User settings
		this.online_users = {}; // List of current online user IDs

		// Common UI objects
		this.$btn_conn = $( '.schat-btn-conn' );
		this.$tab_head = D.getElementById( 'schat-tab-header' );
		this.$cnv = D.getElementById( 'schat-tab-cnv' ).querySelector('.schat-cnv');
		this.$sidebar_r = D.getElementById( 'schat-sidebar2' );
		this.$tab_ntf2 = ''; // It will be get on showing tab
		this.$settings = D.getElementById( 'schat-settings' );

		// Setup common UI elements
		this._ui();

		// Setup binding data events
		this._bind_data_events();

		// Logout if the user was logged anonymously before
		// (it will refresh the page)
		if( this.app.auth_data && this.app.auth_data.provider != 'custom ') {
			this.app.db.logout();
			return;
		}

		// Listens for changes to 
		// the user's authentication state
		firebase.auth().onAuthStateChanged( function( user ) {

			if( user ) {

				// FIXME
				// Update user info
				// $('.schat-user-name').innerHTML = username;
				// addClass.apply( $('.schat-user-info'), ['schat-active'] );

				// Re-login if operator was anonymously logged in before
				if( user.provider === 'anonymous' ) {

					self.app.db.logout();

				} else {

					var user_id = user.uid,
						username = self.opts.user.name;

					self.app.set_user( user_id, username );

					// Clean up database on load
					self.app.db.cleanup();

				}

			
			// Not logged in yet
			} else {

				// Login to database as operator
				self.app.db.login( 'custom', function( error ) {
					console.error(error);

					switch( error.code ) {
						case 'auth/invalid-api-key':
							self.app.ntf( 'invalid-api-key', 'Your Firebase API key is invalid. Go to your <a href="' + self.opts.opts_url + '">Integration options</a><br>and check your Firebase info twice.', 'error', 'main' );

							break;
							
						case 'auth/wrong-password':
							
							self.app.ntf( 'remove-user', 'Please go to Auth > Users in your <a href="http://console.firebase.google.com" target="_blank">Firebase project</a><br />and delete <strong>' + self.opts.user.email + '</strong> user.', 'error', 'main' );

							break;

						case 'auth/user-not-found':
							firebase.auth().createUserWithEmailAndPassword( self.opts.user.email, self.opts.user_pass ).catch(function(error) {
								self.app.ntf( 'create-user', error, 'error', 'main' );
							});
							break;

						case 'auth/operation-not-allowed':
							self.app.ntf( 'op-not-allowed', '<strong>ERROR:</strong> Go to Auth > Sign-in Methods in your Firebase console.<br>Enable both "Email/password" and "Anonymous" methods.', 'error', 'main' );

							break;
					}
				});

				// FIXME
				// Hide user info
				// removeClass.apply( $('.schat-user-info'), ['schat-active'] );

			}

		});

	}

	//
	// Internal methods
	// ------------------

	SLC_UI.prototype = {
		
		/**
		 * Setup binding data events
		 */
		_bind_data_events : function() {

			this.app.on( 'on-connect', this._on_connect.bind( this ) );
			this.app.on( 'op-update', this._on_op_update.bind( this ) );

			// Online users
			this.app.on( 'online-new', this._on_new_online.bind( this ) );
			this.app.on( 'online-update', this._on_update_online.bind( this ) );
			this.app.on( 'user-update', this._on_update_online.bind( this ) );
			this.app.on( 'online-remove', this._on_removed_online.bind( this ) );

			// Chat events
			this.app.on( 'chat-join', this._on_join_chat.bind( this ) );
			this.app.on( 'chat-update', this._on_update_chat.bind( this ) );
			this.app.on( 'chat-listen', this._on_listen_chat.bind( this ) );
			this.app.on( 'chat-exit', this._on_leave_chat.bind( this ) );
			this.app.on( 'msg-new', this._on_new_msg.bind( this ) );
			this.app.on( 'msg-remove', this._on_removed_msg.bind( this ) );

			// Others
			this.app.on( 'chat-history', this._on_chat_history.bind( this ) );
			this.app.on( 'setting-update', this._on_update_setting.bind( this ) );

			// Chat action
			this.app.on( 'chat-action', this._on_action.bind( this ) );
			this.app.on( 'chat-action-response', this._on_action_response.bind( this ) );

		},

		/**
		 * Setup common UI events
		 */
		_ui : function() {

			var self = this,
				$console_wrap = D.getElementById('schat-console'),
				$btn_logout = D.getElementById('schat-btn-logout'),
				$btn_reset = D.getElementById('schat-btn-reset');

			// Fold main menu
			this.app.add_class( D.body, 'folded' );

			// Show initial "Please wait" notification
			self.app.ntf( 'conn-wait', self.opts._wait, 'wait', 'main' );

			// Listen connection button click events
			self.$btn_conn.addEventListener( 'click', this._conn_btn.bind(this) );

			// Handle dismissal of message context menus (any non-right-click click event)
			
			if( $console_wrap ) {
				$console_wrap.addEventListener('click', function(e) {
					if( !e.button || e.button != 2 ) {
						self.app.reset_ui();
					}
				});
			}

			// Reset button
			if( $btn_reset ) {
				$btn_reset.addEventListener( 'click', function(e) {
					e.preventDefault();

					var ask = confirm( self.opts._ntf_reset );

					if( ask ) {

						// Go offline first
						self._conn_btn( 'online' );

						self.app.db.reset( function() {
							self.app.db.logout();
						});
					}

				});
			}

			// Check for desktop notifications
			if ( ( "Notification" in W ) && Notification.permission !== "granted" && Notification.permission !== 'denied' ) {

				self.app.add_class( $('.schat-desk-ntf-alert'), 'schat-active' );
				
				var $turn_on = D.getElementById('schat-btn-turn-on');

				$turn_on.addEventListener('click', function(e) {
					
					Notification.requestPermission( function ( permission ) {

						// If the user accepts, let's create a notification
						if ( permission === "granted" ) {
							self._notify( 'dn-activated', self.opts._ntf_dn_active, 'Hey!', null, 4000 );

							// Hide alert box
							 self.app.remove_class( $('.schat-desk-ntf-alert'), 'schat-active' );

						}
					});
				});
			}

			// Mark new messages as unread
			$('.schat-main').addEventListener('click', function(e) {
				if( self.current_chat_id ) {
					self._read( self.current_chat_id, self.current_user_id );
				}
			});

			// Sidebar tabs
			var $tabs_links = D.querySelectorAll('.schat-tabs li a'),
				$item = '',
				tab_id = '',
				$last_item = '';

			for( var i=0; i < $tabs_links.length; i++ ) {
				$item = $tabs_links[i];
				tab_id = $item.getAttribute('href').substring(1);

				// Activate default tab
				if( self.app.has_class( $item, 'schat-active') ) {

					self.app.add_class( D.getElementById(tab_id), 'schat-active' );

					$last_item = $item;
				}

				// Listen "tab" clicks
				$item.addEventListener( 'click', function(e) {
					e.preventDefault();

					tab_id = this.getAttribute('href').substring(1);
					last_tab_id = $last_item.getAttribute('href').substring(1);


					// Hide last content
					self.app.remove_class( $last_item, 'schat-active' );
					self.app.remove_class( D.getElementById(last_tab_id), 'schat-active' );

					// Activate current content
					self.app.add_class( this, 'schat-active' );
					self.app.add_class( D.getElementById(tab_id), 'schat-active' );

					$last_item = this;

				});
			}

			// "Please wait" notification for settings
			self.app.ntf( 'saved', self.opts._wait, 'wait', 'settings' );

			// Listen settings button clicks
			D.getElementById('schat-btn-settings').addEventListener('click', function(e) {
				e.preventDefault();

				self.app.add_class( $('.schat-overlay'), 'schat-active' );
				self.app.add_class( self.$settings, 'schat-active' );

			});

			// Listen overlay clicks
			$( '.schat-overlay' ).addEventListener( 'click', function(e) {
				e.preventDefault();

				self.app.remove_class( this, 'schat-active' );
				self.app.remove_class( self.$settings, 'schat-active' );

			});

			// Check if current window/tab is actively using 
			W.addEventListener( 'focus', function() { self.W_state = true; });
			W.addEventListener( 'blur', function() { self.W_state = false; });

			var margin = 57,
				top_nav_h = $('.schat-top-nav').offsetHeight;

			var fn_refresh_ui = function(e) {
  				
  				var admin_nav_h = D.getElementById('wpadminbar').offsetHeight,
  					e = D.documentElement,
					g = D.getElementsByTagName('body')[0],
					x = W.innerWidth || e.clientWidth || g.clientWidth,
					y = W.innerHeight|| e.clientHeight|| g.clientHeight,
					total_margin = margin + admin_nav_h + top_nav_h,
					h = 0,
					h_short = 0;

				// Big screens
				if( x >= 580 ) {
					h = y - total_margin;
					h_short = h;
				// Mobile screens
				} else {
					h = 300;
					h_short = 200;
				}

				D.getElementById('schat-sidebar').style.height = h_short + 'px';
				D.getElementById('schat-sidebar2').style.height = h + 'px';
				D.getElementById('schat-main').style.height = h + 'px';


			}

			// Setup chat console layout
			W.addEventListener('resize', fn_refresh_ui );

			// Refresh UI
			self._refresh_ui();

		},

		/**
		 * Refresh user interface (chat widget)
		 */
		_refresh_ui : function() {

			// Trigger "resize" event on page load (works with IE)
			var e = W.document.createEvent( 'UIEvents' );
			e.initUIEvent('resize', true, false, W, 0);
			W.dispatchEvent( e );

		},

		/**
		 * Update connection status
		 */
		_conn_btn : function( last_status ) {

			var $reply = $('.schat-reply'),
				$btn = this.$btn_conn,
				last_status = ( typeof last_status != 'object' ) ? last_status : $btn.getAttribute('data-status'),
				ico = ['dashicons dashicons-'],
				ntf = this.opts._offline;

			// Go online
			if( last_status === 'offline' ) {

				this.app.add_class( D.querySelector('body.wp-admin'), 'schat-online' );

				this.current_status = 'online';
				ico.push( 'yes' );
				ntf = this.opts._online;

				// Warn before exit
				W.onbeforeunload = this._warn_exit.bind(this);

				this.app.play( 'connected' );


				// Activate reply box
				if( $reply ) {
					$reply.disabled = false;
				}

			// Go offline
			} else {

				this.app.remove_class( D.querySelector('body.wp-admin'), 'schat-online' );

				this.current_status = 'offline';
				ico.push( 'no' );

				// Remove warning on page exit
				W.onbeforeunload = null;

				this.app.play( 'disconnected' );

				// Deactivate reply box
				if( $reply ) {
					$reply.disabled = true;
				}
			}

			// Get class 
			var cls = [ '_schat-', this.current_status ].join('');
			
			// Update database
			this.app.db.op_conn( this.current_status );

			// Update button UI
			removeClass.apply( $btn, ['_schat-connecting _schat-offline _schat-online', cls ] ); 
			$btn.innerHTML = this.render( 'btn-conn', { ico: ico.join(''), s: ntf } );

			// Update current status
			$btn.setAttribute( 'data-status', this.current_status );

		},

		/**
		 * Event to monitor current connection info
		 */
		_on_connect : function( is_connected ) {
			
			// No connection!
			if( !is_connected ) {
				this.app.ntf( 'no-conn', this.opts._no_conn, 'error', 'main', 'dashicons dashicons-warning' );

				// Update connection button
				removeClass.apply( this.$btn_conn, ['_schat-connecting _schat-online', '_schat-offline' ] ); 
				this.$btn_conn.innerHTML = this.render( 'btn-conn', { ico: 'dashicons dashicons-no', s: this.opts._tip_no_accept_chats } );
				this.$btn_conn.setAttribute( 'data-status', 'offline' );

				// Update connection button
				this._conn_btn( 'online' );
				
			// Connected or re-connected
			} else {
				this.app.hide_ntf( 'no-conn' );

				// Hide initial "please wait" notification
				this.app.hide_ntf( 'conn-wait' );

				// Show successfully connected!
				this.app.ntf( 'conn-success', this.opts._conn_success, 'success', 'main', null, 2000 );

				// Update connection button
				this._conn_btn( 'offline' );

				// Settings
				this._settings();
			}

		},

		/**
		 * Listen online operators updates
		 */
		_on_op_update : function( ops ) {

			if( this.current_status === 'online' ) {

				// Check if we're still in operators list
				if( !ops || ( ops && this.app.db.user_id in ops ) ) {

					// Refresh online status
					this._conn_btn( 'offline' );
				}
			}

		},

		/**
		 * Event to monitor online user updates
		 */
		_on_update_online : function( user ) {
			
			if( !user ) return;

			var self = this,
				item_id = [ 'schat-user-item-', user.id ].join(''),
				$item = D.getElementById( item_id );

			// This user isn't in the users list
			if( !$item ) return;

			// Update user info
			this._on_new_online( user.id, true );
		},

		/**
		 * Event to monitor new online user
		 */
		_on_new_online : function( user_id, refreshing ) {
			var self = this;

			firebase.database().ref( 'users/' + user_id ).once( 'value' ).then( function( snap ) {

				if( !snap.exists() ) return;

				var user = snap.val();

				if( !user.id || !user.name ) return;

				var $users_list = '',
					cls = [],
					ico = [],
					is_you = ( self.app.user_id === user.id ),
					list_item_id = 'schat-user-item-' + user.id,
					is_new = ( !( user.id in self.online_users ) && !is_you && !user.is_op );

				// Add this user into online list
				self.online_users[ user.id ] = true;

				// This user is you?
				if( is_you ) {
					cls.push('schat-you');
				}

				// Is a mobile user?
				if( user.platform.is_mobile ) {
					cls.push( 'schat-mobile' );
					ico.push( self.render( 'ico','mobile' ) );
				}

				// 1. Operator user?
				if( is_you || user.is_op ) {

					cls.push( 'schat-op' );
					ico.push( self.render( 'ico','star' ) );

					$users_list = D.getElementById( 'schat-ops' );
				
				// 2. Chat user?
				} else if( user.chats && user.sessions ) {

					cls.push('schat-in-chat');
					ico.push( self.render( 'ico', 'in-chat' ) );

					// Include all chats as class
					for( var chat_id in user.chats ) {
						cls.push('schat-chat-' + chat_id);
					}

					$users_list = D.getElementById( 'schat-visitors' );
				
				// 3. Web visitors
				} else {
					$users_list = D.getElementById( 'schat-web-visitors' );

				}

				// Include joined at information
				if( user.joined_at && !user.is_op ) {
					user._timeago = self.render( 'timeago', user.joined_at );
				}

				// Include geo location
				if( user.geo ) {
					user._flag = self.render( 'user-flag', user.geo.country_code );
					user._city = ( user.geo.city && user.geo.city !== 'false' ) ? user.geo.city : 'N/A';
					
					// Show country as user name instead of IP address
					if( user.name === user.platform.ip ) {

						if( user._city !== 'N/A' ) {
							user.name =  user._city + ', ' + user.geo.country;

						} else {
							user.name = user.geo.country
						}

					}
				}

				// Clean up list item
				self.app.remove_obj( list_item_id );

				// Get other parameters
				user._cls = cls.join(' ');
				user._ico = ico.join(' ');

				// Render the user item
				$users_list.insertAdjacentHTML( 'afterbegin', self.render( 'user-item', user ) );
				
				// New user?
				if( is_new && !self.settings['no-ntf-new-visitor'] ) {
					// Notify operator(s)
					self._notify( 'new-visitor', self.opts._ntf_new_visitor.replace( '%s', '"' + user.name + '"' ), null, user.avatar );
				}

				// Listen "click" events
				var $item = D.getElementById( list_item_id );
				$item.addEventListener( 'click', function(e) {
					e.preventDefault();

					// Show tab
					self._show_tab( user, false );

				});

				// Setup the list
				self._setup_list_item( $item );

				// Listen all visitors who have chat
				if( !self.private_chats[user.id] && user.chats && !user.is_op && !is_you ) {

					// Every visitor has one chat only
					// So listen first chat
					for( var chat_id in user.chats ) {
						self.app.db.listen_chat( chat_id );

						break;
					}

				}

				// Refresh tab
				if( self.current_user_id === user.id ) {
					self._show_tab( user, true );
				}

			});
			

		},

		/**
		 * Event to monitor removing online users
		 */
		_on_removed_online : function( user_id ) {
			
			this.app.remove_obj( 'schat-user-item-' + user_id );

		},

		/**
		 * Show user tab
		 */
		_show_tab : function( user, refreshing ) {

			var self = this,
				nav = [],
				is_you = ( user.id === this.app.user_id ),
				typing = false; // We busy with typing?

			// Hide main notification from previous selected user
			self.app.hide_ntf( 'main-ntf' );

			/**
			 * Delay for a specified time
			 */
			var fn_delay = ( function() {
				var timer = 0;
				
				return function( callback, ms ) {
					root.clearTimeout (timer);
					timer = root.setTimeout( callback, ms );
				};

			} )();

			// Reset current chat
			if( !refreshing ) {
				this.$cnv.id = '';
				this.$cnv.innerHTML = '';
				this.$sidebar_r.innerHTML = '';
			}


			// Update current data
			this.current_chat_id = '';
			this.current_user_id = user.id;

			// Get unsent reply
			user._reply_v = this.replies[user.id] || null;

			if( this.private_chats[user.id] ) {

				var chat_id = this.private_chats[user.id].id;

				this.current_chat_id = chat_id;
				this.$cnv.id = 'schat-cnv-' + chat_id;

				// Render current messages if exists
				if( !refreshing ) {
					if( this.chat_msgs[chat_id] ) {
						for( var msg_id in this.chat_msgs[chat_id] ) {
							this.app.add_msg( chat_id, this.chat_msgs[chat_id][msg_id], true );
						}
					}
				}

			// Listen all visitors who have chat
			} else if( user.chats && !user.is_op && !is_you ) {

				// Every visitor has one chat only
				// So listen first chat
				for( var chat_id in user.chats ) {
					this.current_chat_id = chat_id;
					this.app.db.listen_chat( chat_id );

					break;
				}

			}

			// Get user avatar
			user._avatar = this.app.render( 'avatar', user.avatar );

			// Get user sidebar info
			if( user.email ) { user._email = this.render( 'user-email', user.email ); }
			if( user.phone ) { user._phone = this.render( 'user-phone', user.phone ); }
			if( user.geo ) { user._geo = this.render( 'user-geo', user.geo ); }
			if( user.platform ) { 
				user.platform.page_url = user.current_page;
				user._platform = this.render( 'user-platform', user.platform ) };

			// Show user sidebar info
			this.$sidebar_r.innerHTML = this.render( 'tab-sidebar', user );

			// Render tab header
			this.$tab_head.innerHTML = this.render( 'tab-header', user );

			// Get secondary notification
			this.$tab_ntf2 = D.getElementById( 'schat-tab-ntf2' );
			
			var $reply = D.getElementById( 'schat-reply-' + user.id );

			if( is_you || this.current_status === 'offline' || !user.sessions ) { 
				$reply.disabled = true; 
			}

			// Mark new messages as read
			if( this.current_chat_id ) {
				this._read( this.current_chat_id, user.id );
			}

			// Listen reply box events
			if( $reply ) {

				$reply.addEventListener('keydown', function(e) {

					if( e && e.keyCode === 13 && !e.shiftKey ) {

						var reply = this,
							msg = this.value.trim();

						// Clear reply from unsent list
						delete self.replies[user.id];

						// We aren't typing anymore
						typing = false;
						self.app.db.typing( null, self.current_chat_id );

						var msg_type = ( user.is_op ) ? 'op2op' : 'default';

						if( msg.length > 0 ) {

							this.disabled = true;

							// Clean the value
							this.value = '';

							if( self.private_chats[user.id] ) {

								var chat_id = self.private_chats[user.id].id;
								
								if( !self.app.db.joined_chats[chat_id] ) {
									self.app.db.join_chat(chat_id);
								}

								// Mark as read new messages
								self._read( chat_id, user.id );

								// Push new message
								self.app.db.push_msg( chat_id, msg, msg_type, function() {
									reply.disabled = false;
									root.setTimeout( function() { 
										reply.focus() 
									}, 0);
								});

							} else {

								self.app.db.create_chat( { name: self.app.username }, 'private', function( new_chat_id ) {

									self.$cnv.id = 'schat-cnv-' + new_chat_id;
									self.current_chat_id = new_chat_id;

									// Push message
									self.app.db.push_msg( new_chat_id, msg, msg_type );

									// Invite user to the chat
									self.app.db.create_action( 'invite', user.id, new_chat_id );

									reply.disabled = false;
									root.setTimeout( function() { 
										reply.focus() 
									}, 0);

								});

							}
						}

						e.preventDefault();

					// Typing...
					} else {

						if( !typing ) {

							// Don't listen some keys
							switch( e.keyCode ) {
								case 17: // ctrl
								case 18: // alt
								case 16: // shift
								case 20: // capslock
								case 9: // tab
								case 8: // backspace
								case 224: // cmd (firefox)
								case 17:  // cmd (opera)
								case 91:  // cmd (safari/chrome) Left Apple
								case 93:  // cmd (safari/chrome) Right Apple
									return true;
							}

							// We're typing...
							self.app.db.typing( true, self.current_chat_id );

							// We're currently busy with typing
							typing = true;

						}

						// Remove user from typing list after the user has stopped typing 
						// for a specified amount of time
						fn_delay( function() {

							self.app.db.typing( null, self.current_chat_id );

							typing = false;
							
						}, 1000 );

						return true;
					}

				});
			}

			$reply.addEventListener( 'blur', function(e) {
				self.replies[user.id] = this.value.trim();
			});

			root.setTimeout( function() { 
				$reply.focus() 
			}, 0);

			var $tab_nav = D.getElementById('schat-tab-nav-wrap'),
				private_chat = self.private_chats[user.id];

			// 1. Has active chat
			if( private_chat && user.chats && user.chats[private_chat.id] && !user.is_op ) {
				
				// "Leave chat" button
				// (Needs to be more than 1 operator in the chat to show this button)
				/*nav.push( this.render( 'nav-link', {
					id: 'schat-btn-leave-chat',
					title: self.opts._leave_chat
				}));*/
				
				// "End chat" button
				nav.push( this.render( 'nav-link', {
					id: 'schat-btn-end-chat',
					title: self.opts._end_chat,
					ico: self.render( 'ico', 'logout' )
				}));

			// 2. Has chat but it has been ended
			} else if( private_chat && !user.is_op ) {

				// "Leave chat" button
				nav.push( this.render( 'nav-link', {
					id: 'schat-btn-leave-chat',
					title: self.opts._unfollow,
					desc: self.opts._tip_unfollow
				}));

			// 3. No chat...
			} else if( !user.is_op ) {
				self.app.ntf( 'main-ntf', self.opts._ntf_start_chat, 'warn', 'main', 'schat-ico-tip' );
			}

			// Get navigation			
			if( nav.length ) {
				$tab_nav.innerHTML = self.render( 'nav', { id: 'schat-header-nav', nav: nav.join(' ') });
			
			// No navigation link
			} else {
				$tab_nav.innerHTML = '';
			}

			// Listen tab navigation links
			this._tab_nav( 'user' );

		},

		/* Setup lists */
		_setup_list_item : function( $item ) {

			var self = this;

			// Keep active the last item
			var $last_item = D.getElementById( self.last_item_id );
			if( $last_item ) {
				self.app.add_class( $last_item, 'schat-active' );
			}

			// Listen "click" events
			$item.addEventListener( 'click', function(e) {
				e.preventDefault();

				// Deactivate the last item
				if( self.last_item_id ) {
					self.app.remove_class( D.getElementById(self.last_item_id), 'schat-active' );
				}

				// Activate current item
				self.app.add_class( this, 'schat-active' );

				self.last_item_id = this.id;

			});

		},

		_tab_nav : function( tab ) {

			var self = this,
				$btn_end_chat = D.getElementById('schat-btn-end-chat'),
				$btn_del = D.getElementById('schat-btn-delete');

			if( $btn_end_chat ) {
				$btn_end_chat.addEventListener( 'click', function(e) {
					e.preventDefault();
					var ask = confirm( self.opts._ask_end_chat );

					if( ask ) {
						// Leave us from current chat
						self.app.db.leave_chat( self.current_chat_id );

						// End the visitor chat as well
						self.app.db.create_action( 'end-chat', self.current_user_id, self.current_chat_id );

						if( tab === 'chat' ) {
							D.getElementById( 'schat-chat-item-' + self.current_chat_id ).click();
						}
						
					}
				});
			}

			// Listen "Delete" button
			if( $btn_del ) {
				$btn_del.addEventListener( 'click', function(e) {
					e.preventDefault();

					var ask = confirm( self.opts._ask_del );

					if( ask ) {
						self.app.db.delete_chat( self.current_chat_id, function() {
							self.$cnv.id = '';
							self.$cnv.innerHTML = '';
							self.$tab_head.innerHTML = '';
							self.$sidebar_r.innerHTML = '';
							self.current_chat_id = '';
						});
					}
				});
			}

		},

		_set_private_chats : function( chat ) {

			// Find private chats
			if( chat.authorized ) {
				for( var member_id in chat.authorized ) {
					if( member_id !== this.app.user_id ) {
						this.private_chats[member_id] = chat;
					}
				}
			}

			// Check if private chats are still active
			if( chat.is_ended ) {
				for( var member_id in this.private_chats ) {
					// This user isn't authorized of this chat anymore
					if( this.private_chats[member_id].id === chat.id ) {
						delete this.private_chats[member_id];
					}
				}
			}

		},

		/**
		 * Event to monitor listening chat
		 */
		_on_listen_chat : function( chat_id ) {

			// Create empty conversation data for this chat
			if( !this.chat_msgs[chat_id] ) {
				this.chat_msgs[chat_id] = {};
			}

			// Update conversation id
			if( this.current_chat_id === chat_id ) {
				this.$cnv.id = 'schat-cnv-' + chat_id;
			}

		},

		/**
		 * Event to monitor chat actions
		 */
		_on_join_chat : function( chat ) {

			this.chats[chat.id] = chat;

			// Create empty conversation data for this chat
			this.chat_msgs[chat.id] = {};

			// Update conversation id
			if( this.current_chat_id === chat.id ) {
				this.$cnv.id = 'schat-cnv-' + chat.id;
			}

			// Set private chats with this members
			this._set_private_chats( chat );

			var msg = this.opts._user_joined_chat.replace( '%s', this.app.username );

			// Notify visitor that this operator is joined chat
			this.app.db.push_msg( chat.id, msg, 'auto-ntf' );

		},
		_on_update_chat : function( chat ) {

			if( !chat.id ) return;

			this.chats[chat.id] = chat;

			// Set private chat with this members
			this._set_private_chats( chat );

			if( this.$tab_ntf2 && this.current_chat_id === chat.id ) {
				
				this.$tab_ntf2.innerHTML = '';

				// Show typing...
				if( chat.typing ) {
					for( user_id in chat.typing ) {
						if( user_id !== this.app.db.user_id ) {
							this.$tab_ntf2.insertAdjacentHTML( 'beforeend', this.render( 'typing', chat.typing[user_id] ) );
						}
					}
				}
			}


		},
		_on_leave_chat : function( chat_id ) {
			
			var members = this.chats[chat_id].authorized;

			// Remove messages data
			delete this.chat_msgs[chat_id];
			delete this.last_msgs[chat_id];

			// Remove private chats
			if( members ) {
				for( var member_id in members ) {
					if(  this.private_chats[member_id] && this.private_chats[member_id].id === chat_id ) {
						delete this.private_chats[member_id];
					}
				}
			}

			var msg = this.opts._user_left_chat.replace( '%s', this.app.username );

			// Notify visitor that this operator is joined chat
			this.app.db.push_msg( chat_id, msg, 'auto-ntf' );

			delete this.chats[chat_id];

		},

		_on_new_msg : function( chat_id, msg ) {

			var user_id = msg.user_id;
			
			if( !this.app.user || !this.app.user.muted || !this.app.user.muted[user_id] ) {

				// Update the last message
				this.last_msgs[chat_id] = msg;

				// Update chat messages
				this.chat_msgs[chat_id][msg.id] = msg;

				if( this.chats[chat_id] ) {

					var read_msgs = this.chats[chat_id].read_msgs || {};

					// Check if the message is unread
					if( !read_msgs[this.app.user_id] || read_msgs[this.app.user_id] < msg.timestamp ) {

						msg.unread = true;

						if( ( msg.type === 'default' || msg.type === 'op2op' ) && msg.user_id !== this.app.user_id ) {

							var class_name = ( msg.type === 'op2op' ) ? '.schat-user-' + msg.user_id : '.schat-chat-' + chat_id;

							// Highlight user
							this.app.add_class( $( class_name), 'schat-new-msg' );
							
							// Notify operators
							if( !this.settings['no-ntf-new-msg'] ) {
								this._notify( 'new-msg', msg.msg, msg.name, msg.avatar );
							}

						} else if( msg.type === 'auto-ntf' ) {

						}
					}

				}

				// Render message
				this.app.add_msg( chat_id, msg, true );

			}

		},

		_on_removed_msg : function( chat_id, msg_id ) {

			var obj_id = ['schat-msg-', msg_id].join('');
			this.app.remove_obj( obj_id );

			if( this.last_msgs[chat_id] && this.last_msgs[chat_id].id === msg_id ) {
				this.last_msgs[chat_id] = '';
			}
		},

		/**
		 * Events to monitor all chat history
		 */
		_on_chat_history : function( chats ) {
			var self = this,
				$chats = D.getElementById('schat-chats');

			$chats.innerHTML = '';

			var fn_show_chat = function(e) {
				e.preventDefault();

				var chat_id = this.getAttribute('data-id'),
					chat = chats[chat_id],
					nav = [];

				self.current_chat_id = chat_id;
				self.$cnv.id = 'schat-cnv-' + chat_id;
				self.$cnv.innerHTML = '';
				self.$tab_head.innerHTML = '';
				self.$sidebar_r.innerHTML = '';

				if( chat.is_ended ) {
					
					// "Delete" button (if isn't currently active)
					nav.push( self.render( 'nav-link', {
						id: 'schat-btn-delete',
						title: self.opts._del,
						ico: self.render( 'ico', 'cancel' )
					}));

				} else {
					chat._subtitle = '<strong style="color:#34c749;">' + self.opts._active + '</strong>';

					// "End chat" button
					nav.push( self.render( 'nav-link', {
						id: 'schat-btn-end-chat',
						title: self.opts._end_chat,
						ico: self.render( 'ico', 'logout' )
					}));
				}

				// Get navigation
				if( nav.length ) {
					chat._nav = self.render( 'nav', { id: 'schat-header-nav', nav: nav.join(' ') });
				} else {
					chat._nav = '';
				}

				// Update title
				chat._title = '<span>' + self.opts._chat_history + ':</span> ' + chat.name;
				
				// Render tab
				self.$tab_head.innerHTML = self.render( 'chat-tab-header', chats[chat_id] );

				// Listen tab navigation links
				self._tab_nav( 'chat' );

				// Render messages
				self.app.db.get_msgs( chat_id, function(msgs){
					
					if( msgs ) {
						for( var msg_id in msgs ) {
							if( msgs[msg_id].type === 'default' ) {
								self.app.add_msg( chat_id, msgs[msg_id], true );
							}
						}
					}

				});

				// Get user sidebar info
				var session = chat.session;

				if( session ) {
					if( session.avatar ) { session._avatar = self.app.render( 'avatar', session.avatar ); }
					if( session.email ) { session._email = self.render( 'user-email', session.email ); }
					if( session.phone ) { session._phone = self.render( 'user-phone', session.phone ); }
					if( session.geo ) { session._geo = self.render( 'user-geo2', session.geo ); }
					if( session.platform ) { 
						session._platform = self.render( 'user-platform2', session.platform ) 
					}

					if( chat.params && chat.params.vote ) {
						if( chat.params.vote === 'like' ) {
							session._vote = self.render( 'vote', { v: self.opts._like, id: 'like' } );
						} else {
							session._vote = self.render( 'vote', { v: self.opts._dislike, id: 'dislike' } );
						}
					}
					
					// Render sidebar
					self.$sidebar_r.innerHTML = self.render( 'chat-tab-sidebar', session );
					
				}

			};

			if( chats ) {
				var $item = ''

				for( var chat_id in chats ) {

					// Only list visitor chats
					if( chats[chat_id].session ) {
						$chats.insertAdjacentHTML( 'afterbegin', this.render( 'chat-item', chats[chat_id] ) );

						$item = D.getElementById( 'schat-chat-item-' + chat_id );

						if( $item ) {
							$item.addEventListener( 'click', fn_show_chat );

							self._setup_list_item( $item );
						}
					}



				}
			}
		},

		/* Event to monitor user settings updates */
        _on_update_setting : function( settings ) {

        	this.settings = settings || {};

        	if( settings ) {
				var $field = '';

				for( var name in settings ) {
					$field = D.getElementById( 'schat-f-' + name );

					if( $field.type === 'checkbox' ) {
						
						$field.checked = ( settings[name] ) ? true : false;

					} else {
						$field.value = settings[name];
					}
				}
			}
        },

		/**
		 * Events to monitor chat actions
		 */
		_on_action : function( action ) {

			var self = this;

			switch( action.type ) {

				// Invited to a specific chat (usually by another operator)
				case 'invite':
					try {
						self.app.db.response_action( action.id, 'accepted', function() {
							
							// Join chat
							self.app.db.join_chat( action.chat_id );
						});
						
					} catch(e) {
						console.warn(e);
					}
					break;
			}
			
		},

		/**
		 * Events to monitor chat action responses
		 */
		_on_action_response : function( action ) {

			if( !action.status ) return;

		},

		/* Warn before exit */
		_warn_exit : function() {

			// If we haven't been passed the event get the window.event
			var e = W.event;

			var message = this.opts._ask_page_exit;

			// For IE6-8 and Firefox prior to version 4
			if (e) e.returnValue = message;

			// For Chrome, Safari, IE8+ and Opera 12+
			return message;
		},

		/**
		 * Notify operators with all allowed alerts 
		 */
		_notify : function( type, msg, title, icon, duration ) {

			title = title || this.opts.site_name.substr(0, 20);

			duration = duration || 4000;

    		switch( type ) {
    			case 'new-msg': 
    			case 'new-visitor': 
    				this.app.play( type );

    				break;

    			// Visitor waiting for a reply
    			case 'waiting-reply':
    				
    				break;
    		}

    		// Don't notify user if already in window
			if( this.W_state ) return;

			// Notify 
    		this._ntf_devices( type, msg, title );
    		
    		// Browser doesn't support notifications or not allowed by user yet
			if ( !( "Notification" in W ) && Notification.permission !== "granted" ) {
				return;
			}

			var default_icon = this.opts.plugin_url + '/assets/img/screets-logo-160px.png',
				icon = icon || default_icon;


			// If it's okay let's create a notification
    		var notification = new Notification( title, {
    			body: msg,
    			icon: icon,
    			tag: type // Group notifications
    		});

    		if( duration ) {
    			setTimeout( notification.close.bind( notification ), duration );
    		}
    		notification.onclick = function() {
    			notification.close();
    		};
		},

		/**
		 * Notify mobile devices
		 */
		_ntf_devices : function( type, msg, title ) {

			if( this.opts.pushover.active && this.settings['pushover-device'] ) {
				var data = {
					token: this.opts.pushover.token,
					user: this.opts.pushover.user_key,
					message: msg + ' (Live Chat)',
					device: this.settings['pushover-device'],
					title: title
				};

				this.app.post( 'https://api.pushover.net/1/messages.json', data, function( r ) {
					// Successfully sent!
					if( r && !r.error ) {}
				});
			}
		},

		/**
		 * Mark as read new messages
		 */
		_read : function( chat_id, user_id ) {
			var self = this;

			if( this.last_msgs[chat_id] ) {
				this.app.db.read( chat_id, this.last_msgs[chat_id].timestamp );
			}

			// Remove other new messages
			setTimeout( function() {

				$user_item = D.getElementById( 'schat-user-item-' + user_id );

				if( $user_item ) {
					self.app.remove_class( $user_item, 'schat-new-msg' );
				}

				var $new_msgs = D.querySelectorAll( '.schat-cnv .schat-new' );

				if( $new_msgs ) {
					for( var i=0; i < $new_msgs.length; i++ ) {
						self.app.remove_class( $new_msgs[i], 'schat-new' );
					}
				}


			}, 0);
		},

		/**
		 * Settings
		 */
		_settings : function() {
			
			var self = this,
				$form = $('.schat-form-settings');

			var fn_save = function(e) {

				self.app.db.setting( this.name, this.value, this, function( err ) {
					if( !err ) {
						self.app.ntf( 'saved', self.opts._saved + '.', 'success', 'settings', null, 2000 );
					}
				});

			};

			this.app.add_class( $form, 'schat-active' );

			// Hide "please wait" notification
			this.app.hide_ntf( 'saved' );

			// Update user settings
			var form_settings = $form.elements;

			for( var i=0; i < form_settings.length; i++ ) {

				if( form_settings[i].type === 'checkbox' ) {
					form_settings[i].addEventListener( 'click', fn_save );
				}

				form_settings[i].addEventListener( 'blur', fn_save );

			}

			// Get user settings
			self.app.db.get_settings( self._on_update_setting.bind(this) );

			// Listen submit form
			$form.addEventListener( 'submit', fn_save );
		}

	};

	// Run the script in "noConflict" mode
	SLC_UI.noConflict = function noConflict() {
		root.SLC_UI = prev_schat_ui;
		return SLC_UI;
	};

	// Export the object as global
	root.SLC_UI = SLC_UI;


	//
	// External methods
	// ------------------

	/**
	 * Render template
	 */
	SLC_UI.prototype.render = function( template, p ) {
		
		var arr = [];

		switch( template ) {

			// Notification box
			case 'ntf-box':
				arr = [ '<div class="schat-ntf-box"><div class="schat-wrap">',p.msg,p.links,'</div></div>' ];
				break;

			// Connection button
			case 'btn-conn':
				arr = [ '<span class="', p.ico, '"></span> ', p.s ];
				break;

			// Chat history item
			case 'chat-item':
				arr = [ '<li id="schat-chat-item-',p.id,'" data-id="',p.id,'" class="schat-chat-', p.id, ' ', p._cls,'"><span class="schat-title">',p.name,'</span><span class="schat-time" data-livestamp="',(p.created_at/1000),'" title="',this.app.format_time( p.created_at, true ),'"></span></li>' ];
				break;

			// User list item
			case 'user-item':
				arr = [ '<li id="schat-user-item-',p.id,'" data-id="',p.id,'" class="schat-user-', p.id, ' ', p._cls,'"><span class="schat-icons">',p._timeago,p._ico,'</span><span class="schat-title">',p._flag,'', p.name, '</span>',p.meta,'</li>' ];
				break;

			case 'user-flag':
				arr = [ '<img class="schat-flag" src="',this.opts.plugin_url, '/assets/img/flags/',p,'.png" alt="" />' ];
				break;
			// User email
			case 'user-email':
				arr = [ '<a href="mailto:',p,'" class="schat-user-email">',p,'</a>' ];
				break;

			// User phone
			case 'user-phone':
				arr = [ '<a href="tel:',p,'" class="schat-user-phone">',p,'</a>' ];
				break;

			// User geo info
			case 'user-geo':
				arr = [ '<div class="schat-geo"><img class="schat-flag" src="',this.opts.plugin_url,'/assets/img/flags/',p.country_code,'.png" alt="" /> ',p.city,' ', p.country,'</div>' ];
				break;

			// User geo info (chat session style)
			case 'user-geo2':
				arr = [ '<div class="schat-geo"><img class="schat-flag" src="',this.opts.plugin_url,'/assets/img/flags/',p.country.code,'.png" alt="" /> ',p.city,' ', p.country.name,'</div>' ];
				break;

			// User platform info
			case 'user-platform':
				arr = [ '<div class="schat-platform">',p.browser,' ', p.browser_version,' - ', p.os, '<span class="schat-user-ip">',p.ip,'</span><span class="schat-looking-at">',this.opts._look_at,': <a href="',p.page_url,'" target="_blank">', p.page_url,'</a></span></div>' ];
				break;

			// User platform info (chat session style)
			case 'user-platform2':
				arr = [ '<div class="schat-platform">',p.browser,' ', p.browser_version,' - ', p.os, '<span class="schat-user-ip">',p.ip,'</span></div>' ];
				break;

			// Icon
			case 'ico':
				arr = [ '<i class="schat-ico schat-ico-',p,'"></i>' ];
				break;

			// Vote note
			case 'vote':
				arr = [ '<div class="schat-vote schat-vote-',p.id,'"><i class="schat-ico-',p.id,'"></i>',p.v,'</div>' ];
				break;

			// User tab header
			case 'tab-header':
				arr = [ '<div class="schat-wrap"><div class="schat-title">',p.name,'</div><div class="schat-ntf schat-ntf-tab-header"></div><textarea id="schat-reply-',p.id,'" name="msg" class="schat-reply" placeholder="',this.opts._reply_ph,'" ',p._disable,'>',p._reply_v,'</textarea><div id="schat-tab-nav-wrap">',p._nav,'</div><div id="schat-tab-ntf2" class="schat-tab-ntf2"></div></div>' ];
				break;

			// User tab sidebar
			case 'tab-sidebar':
				arr = [ '<div class="schat-wrap">',p._avatar,'<div class="schat-title">',p.name,'</div><div class="schat-meta">',p._email,p._phone, p._geo, p._platform,'</div></div>' ];
				break;

			// Chat tab header
			case 'chat-tab-header':
				arr = [ '<div class="schat-wrap"><div class="schat-title">',p._title,'</div><div class="schat-subtitle">',p._subtitle,'</div><div class="schat-ntf schat-ntf-tab-header"></div><div id="schat-tab-nav-wrap">',p._nav,'</div></div>' ];
				break;

			// Chat tab sidebar
			case 'chat-tab-sidebar':
				arr = [ '<div class="schat-wrap">',p._avatar,'<div class="schat-title">',p.name,'</div><div class="schat-meta">',p._email,p._phone, p._geo, p._platform,p._vote,'</div></div>' ];
				break;

			// User is typing...
			case 'typing':
				var msg = this.opts._user_typing.replace( '%s', p.name );
				arr = [ '<span class="schat-user-typing-',p.id,'"><i class="schat-ico schat-ico-pencil"></i>',msg,'...</span>' ];
				break;

			// Timeago
			case 'timeago':
				arr = [ '<abbr class="schat-time" data-livestamp="',(p/1000),'" title="',this.app.format_time( p, true ),'"></abbr>' ];
				break;

			// Navigation wrapper
			case 'nav':
				arr = [ '<ul id="',p.id,'"" class="',p.id,'">',p.nav,'</ul>' ];
				break;

			// Navigation link
			case 'nav-link':
				var _nav_link_cls = (p.desc) ? 'schat-tooltip' : '';

				arr = [ '<li><a id="',p.id,'" class="', _nav_link_cls, '" href="javascript:;" data-title="',p.desc,'">',p.ico,p.title,'</a></li>' ];
				break;
		}

		return arr.join('');

	};


})();