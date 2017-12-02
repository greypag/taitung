/*!
 * Screets Live Chat - Console (Back-end)
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
		prev_chat_x = root.SChat,
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


	function SChat( opts ) {

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

		// Common UI objects
		this.$btn_status = D.getElementById( 'SLC-btn-status' );
		this.$user_tab = $( '.schat-user-tab' );
		this.$user_tab_wrap = $( '.schat-user-tab-wrap' );
		this.$cnv = $( '.schat-user-cnv' );

		// Check if options are valid
		if( !this._validate_opts() ) { return; }

		// Create real-time database
		this.db = new SLC_FB( this.opts );

		// All users
		this.users = {};
		this.$last_user_item = null; // Last selected user item

		// User data
		this.user = {};
		this.user_id = '';

		// Useful variables
		this.chat_msgs = {};
		this.replies = {}; // Unsent replies
		this.unread_msgs = {}; // New messages IDs
		this.current_user_id = '';
		this.current_chat = '';

		// Sounds
		this.sounds = {};
		this._add_sound( 'new-msg' );

		// Some useful regexes
		this.url_pattern = /\b(?:https?|ftp):\/\/[a-z0-9-+&@#\/%?=~_|!:,.;]*[a-z0-9-+&@#\/%=~_|]/gim;
		this.pseudo_url_pattern = /(^|[^\/])(www\.[\S]+(\b|$))/gim;

		// Show "Please wait..." notification
		this.ntf( this.opts._wait + '...', 'wait' );

		// Authenticate user
		this.auth( function( user ) {

			// Manage common UI elements
			self._ui();

			// Clean sidebar notification
			self.hide_ntf( 'sidebar' );

		});

		// Setup binding data events
		this._data_events();

		// Cleanup database
		this._cleanup();

	}

	//
	// Internal methods
	// ------------------

	SChat.prototype = {

		/**
		 * Clean up database
		 */
		_cleanup : function() {

			var self = this;

			// 
			// Clean up users
			// 
			this.db.get_users( function( users ) {
				if( users ) {

					var user = '',
						session = '',
						now = new Date().getTime(),
						act_diff = 0,
						act_hour = 0,
						sess_diff = 0,
						sess_hour = 0;



					for( var user_id in users ) {
						user = users[user_id];
						session = ''; // Reset session data
						
						// Delete old or junk sessions (inc. visitors and operators)
						if( user.sessions ) {
							for( var sess_id in user.sessions ) {
								session = user.sessions[sess_id];

								// Find old session
								if( session.created_at ) {

									sess_diff = now - session.created_at;
									sess_hour = Math.floor( ( sess_diff / 1000 ) / 60 / 60 ); // difference in hours

									// Delete session
									if( self.opts.clean_time <= sess_hour ) {
										self.db.del_session( user_id, sess_id );

										// Make user offline if operator
										if( user.id && user.is_op ) {
											self.db.op_conn( 'offline', user_id );
										}
									}

								// Junk session (so delete user. it is old)
								} else {
									self.db.del_user( user_id, function() {} );
								}
							}
						}

						// Delete junk users with no user ID
						if( !user.id ) {
							self.db.del_user( user_id, function() {} );
							return;
						}

						// Delete inactive visitors
						if( !user.is_op && user.last_active && !user.sessions ) {
							act_diff = now - user.last_active;
							act_hour = Math.floor( ( act_diff / 1000 ) / 60 / 60 ); // difference in hours

							if( self.opts.max_inactive <= act_hour ) {
								self.db.del_user( user_id, function() {} );
							}
						// Remove junk visitors
						} else if( !user.is_op && !user.last_active && !user.sessions ) {
							self.db.del_user( user_id, function() {} );
						}

						
					}
				}
			});

			// 
			// Clean up chats
			// 
			this.db.get_chats( function( chats ) {

				if( chats ) {
					var chat = '';

					for( chat_id in chats ) {
						chat = chats[chat_id];

						// Clean junk chats
						if( !chat.id ) {
							self.db.del_chat( chat_id, true );
						}
					}
				}

			});

		},

		/**
		 * Setup binding data events
		 */
		_data_events : function() {

			// Notifications
			this.db.on( 'ntf', this._on_ntf.bind( this ) );
			
			// Update user and users list data
			this.db.on( 'user-update', this._on_user_update.bind( this ) );
			this.db.on( 'users-list-update', this._on_users_list_update.bind( this ) );
			this.db.on( 'user-remove', this._on_user_remove.bind( this ) );
			this.db.on( 'op-update', this._on_op_update.bind( this ) );

			// Events for chat and messages
			this.db.on( 'chat-join', this._on_chat_join.bind( this ) );
			this.db.on( 'chat-update', this._on_chat_update.bind( this ) );
			this.db.on( 'chat-exit', this._on_chat_exit.bind( this ) );
			this.db.on( 'member-join', this._on_member_join.bind( this ) );
			this.db.on( 'member-exit', this._on_member_exit.bind( this ) );
			this.db.on( 'chat-action', this._on_action.bind( this ) );
			this.db.on( 'chat-action-response', this._on_action_response.bind( this ) );
			this.db.on( 'msg-new', this._on_new_msg.bind( this ) );
			this.db.on( 'msg-del', this._on_del_msg.bind( this ) );

		},

		/**
		 * Setup common UI elements (calls once after authentication)
		 */
		_ui : function() {

			var self = this;

			// Online/offline button
			this.$btn_status.addEventListener( 'click', function(e) {
				e.preventDefault();

				var status = ( !self.user.online_op ) ? 'online' : 'offline';

				// Update status
				self.db.op_conn( status );
				
			});

		},

		/**
		 * Setup online UI elements
		 */
		_online_ui : function() {

			// Setup classes of status button
			removeClass.apply( this.$btn_status, ['_schat-connecting _schat-offline'] );
			this.$btn_status.className += ' _schat-online';

			// Update status button
			this.$btn_status.innerHTML = this.opts._online;

		},

		/**
		 * Setup offline UI elements
		 */
		_offline_ui : function() {

			// Setup classes of status button
			removeClass.apply( this.$btn_status, ['_schat-connecting _schat-online'] );
			this.$btn_status.className += ' _schat-offline';

			// Update status button
			this.$btn_status.innerHTML = this.opts._offline;

		},

		/**
		 * Update current user
		 */
		_on_user_update : function( user ) {

			if( !user ) return;

			// Update current user data
			this.user = user;
			this.user_id = user.id;

			if( user.online_op ) {
				this._online_ui();
			} else {
				this._offline_ui();
			}

		},

		/**
		 * Event to monitor online operators state
		 */
		_on_op_update : function( ops ) {},

		/**
		 * When current user joined chat
		 */
		_on_chat_join : function( chat ) {

			// Create messages object for this chat 
			this.chat_msgs[chat.id] = {};

			// Create empty new messages data
			this.unread_msgs[chat.id] = 0;

			// Accept the chat as operator
			this.db.accept_chat( chat.id );

		},

		/**
		 * When one of joined chats updated
		 */
		_on_chat_update : function( chat ) {},

		/**
		 * When current user exit from the chat
		 */
		_on_chat_exit : function( chat_id ) {

			// Delete old chat messages
			delete this.chat_msgs[chat_id];

			// Delete new messages data
			delete this.unread_msgs[chat_id];

		},

		/**
		 * Event to monitor new chat members
		 */
		_on_member_join : function( member ) {},

		/**
		 * Event to monitor member exits
		 */
		_on_member_exit : function( member ) {},

		/**
		 * Event to listen for messages
		 */
		_on_ntf : function( ntf ) {},

		/**
		 * Event to monitor chat actions
		 */
		_on_action : function( action ) {

			var self = this;
				
			this.db.accept_action( action.id, function( err ) {
				
				if( !err ) { 

					switch( action.type ) {

						// Auto-initiate chat
						case 'auto-initiate':
							// Enter chat
							self.db.join_chat( action.chat_id );

							break;
					
					}

				// Show error
				} else { 
					self.ntf( err, 'error' ); }
			});

		},

		/**
		 * Event to monitor chat action replies
		 */
		_on_action_response : function( action ) {
			
			switch( action.type ) {
				case 'auto-initiate':

					if( action.status === 'accepted' ) {

						// Auto-join the chat
						this.db.join_chat( action.chat_id );

					}

					break;

				// End chat
				case 'end-chat':
					
					if( action.status === 'accepted' ) {
						this.db.leave_chat( action.chat_id );
					}

					break;
			}
		},
		

		/**
		 * New message
		 */
		_on_new_msg : function( chat_id, msg, is_unread ) {

			var user_id = msg.user_id,
				$user_item = $('.schat-user-' + msg.user_id),
				$user_item_count = $('.schat-user-count-' + msg.user_id);

			if ( !this.user || !this.user.muted || !this.user.muted[ user_id ] ) {

				// Update current conversation
				if( this.current_chat.id === chat_id ) {

					// Remove message if exists in the conversation already
					this._remove_obj( 'SLC-msg-' + msg.id );

					// Add message to current conversation
					this.add_msg( chat_id, msg, true );
					

				}

				if( is_unread ) {

					// Insert into unread messages
					this.unread_msgs[chat_id] += 1;

					// Highlight the user in the list
					removeClass.apply( $user_item, ['schat-new-msg', 'schat-new-msg' ] );

					var total_msgs = this.unread_msgs[chat_id];

					// Update user item data
					$user_item.setAttribute('data-count-new-msgs', total_msgs );

					// Show count
					$user_item_count.innerHTML = total_msgs;

				}

				// Update window title
				this._update_w_title();

				// Update current chat messages
				this.chat_msgs[chat_id][msg.id] = msg;

				// Play sound
				if( is_unread && msg.user_id !== this.db.user_id ) {
					this.play( 'new-msg' );
				}

			}

		},

		/**
		 * Remove message
		 */
		_on_del_msg : function( chat_id, msg ) {

			this._remove_obj( 'SLC-msg-' + msg.id );

		},

		/**
		 * Update users list
		 */
		_on_users_list_update : function( users ) {

			var self = this,
				cls = [], // User item class(es)
				ico = []; // User icons

			// Update users data
			this.users = users || {};

			if( users ) {

				var $list = {
					op: D.getElementById( 'SLC-ops' ),
					visitor: D.getElementById( 'SLC-visitors' ),
					offline: D.getElementById( 'SLC-offline' )
				};

				var fn_on_click = function(e) {

					e.preventDefault();
		
					var user_id = this.getAttribute( 'data-id' );

					// Deactivate last user item
					if( self.current_user_id ) {
						var $user_item = D.getElementById( 'SLC-user-item-' + self.current_user_id );

						if( $user_item ) {
							removeClass.apply( $user_item, ['schat-active'] );
						}
					}

					// Update last user id
					self.current_user_id = user_id;

					// Make as read
					self._read_msgs();

					// Show tab
					self.show_tab( user_id );

				};

				var data = {},
					$item = {},
					now = new Date().getTime(),
					render = true;

				for( id in users ) {

					render = true; // Reset render 

					// Clean default data
					cls = [];
					ico = [],
					obj_id = 'SLC-user-item-' + id,
					is_you = ( id === this.user_id );

					// Get user data
					data = users[id];

					// Clean old user from the list first
					this._remove_obj( obj_id );

					if( data.id ) { // Don't get junk users
						
						// Is you?
						if( id === this.user_id ) {
							cls.push( 'schat-you' );
						}

						// Mobile user
						if( data.is_mobile ) {
							cls.push( 'schat-mobile' );
							ico.push( 'mobile' );
						}

						// Operators (online)
						if( data.is_op && data.online_op ) {
							data._type = 'op'; 
							cls.push( 'schat-op' );
							ico.push( 'op' );
						
						// Web visitors (online)
						} else if( !data.is_op && data.sessions ) {
							data._type = 'visitor';
							cls.push( 'schat-visitor' );

							// Is visitor waiting for a reply 'cause no operators
							// active in the chat? So warn the current operator
							if( data.chats ) {
								for( var _id in data.chats ) {
									if( !data.chats[_id].active ) {

										cls.push( 'schat-urgent' );
										ico.push( 'urgent' );


									} else {
										cls.push( 'schat-in-chat' );
										ico.push( 'in-chat' );
									}

									break;
								}
							}

							// Get active session
							var session = '';
							for( var sess_id in data.sessions) {
								session = data.sessions[sess_id];

								// Render visitor meta
								if( session.geo ) {
									data.meta = this.render( 'user-item-meta', session.geo );
									break;
								}
							}

						// Offline users
						} else {
							data._type = 'offline';
							cls.push( 'schat-offline' );

							// Offline operator
							if( data.is_op ) {
								cls.push( 'schat-op' );
								ico.push( 'op' );

							// Offline visitor
							} else {
								
								// Don't include inactive visitors in the list
								if( data.last_active ) {
									var diff_min = Math.floor( ( ( now - data.last_active ) / 1000 ) / 60 );

									// If the visitor didn't back in 2 minutes, don't show in the list
									// If he comes back, it will be shown in online list
									if( 2 <= diff_min ) {
										render = false;
									}
								}


							}
						}

						// Count new messages
						data.count = 0;
						if( !is_you && data.chats ) {
							for( var chat_id in data.chats ) {
								if( chat_id in this.unread_msgs ) {
									data.count += this.unread_msgs[chat_id];
								}
							}
						}

						// Item has new message
						if( data.count > 0 ) {
							cls.push( 'schat-new-msg' );
						}

						// Get class(es)
						data._cls = cls.join( ' ' );

						// Get icons
						if( ico ) {
							for( var i=0; i < ico.length; i++ ) {
								data._ico = this.render( 'ico', ico[i] );
							}
						}
						

						// Insert the user in the list
						if( render ) {
							$list[ data._type ].insertAdjacentHTML( 'beforeend', this.render( 'user-item', data ) );

							$item = D.getElementById( obj_id );
							
							// Listen the item
							if( $item ) {
								$item.addEventListener( 'click', fn_on_click );
							}
						}


						// Refresh current user tab (except conversation that's already real-time)
						if( data.id == this.current_user_id ) {
							this.show_tab( data.id, true );
						}

					}

				}

			// No users found
			}

		},

		/**
		 * Event to monitor removing users
		 */
		_on_user_remove : function( user ) {

			this._remove_obj( 'SLC-user-item-' + user.id );

		},

		/**
		 * Mark new messages as read
		 */
		_read_msgs : function() {

			var user_id = this.current_user_id;

			var $user_item = D.getElementById( 'SLC-user-item-' + user_id );

			// Reset count
			$user_item.setAttribute( 'data-count-new-msgs', 0 );

			// Remove highlight from the item in users list
			removeClass.apply( $user_item, ['schat-new-msg'] );

			// Update window title
			this._update_w_title();

			// Delete new messages of related user's chat
			var chat = {};
			if( this.db.chats ) {

				// Find user chats
				for( var chat_id in this.db.chats ) {
					
					chat = this.db.chats[chat_id];

					if( chat && chat.authorized_users && user_id in chat.authorized_users ) {
						
						this.unread_msgs[chat_id] = 0;

					}

				}

				
			}

		},

		/**
		 * Update window title
		 */
		_update_w_title : function() {

			var count = 0;

			for( var chat_id in this.unread_msgs ) {				
				count += this.unread_msgs[chat_id];
			}

			if( count > 0 ) {
				D.title = this.render( 'w-title', count );
			} else {
				D.title = title;
			}
		},

		/**
		 * Run an action
		 */
		_run_action : function( type ) {

			var self = this,
				visitor_id = this.current_user_id;

			switch( type ) {

				// Accept chat
				case 'accept-chat':
					// Join the chat as operator
					this.db.join_chat( this.current_chat.id );
					
				break;

				// Start chat with visitor
				case 'start-chat':

					this.db.has_private_chat( visitor_id, function( chat ) {

						// Chat already exists, invite visitor to this chat
						if( chat ) {

							self.db.send_action( 'auto-initiate', visitor_id, chat.id );

						// Create new chat and invite visitor
						} else {

							var data = {
								type: 'support',
								started_by: 'operator',
								missed: false
							};

							self.db.create_chat( visitor_id, data, function( err, new_chat ) {

								if( !err ) {
									self.db.send_action( 'auto-initiate', visitor_id, new_chat.id );
								}

							});

						}

					});

				break;

				// Leave from the chat
				case 'leave-chat':
					this.db.leave_chat( this.current_chat.id );
					
				break;

				// End visitor's chat and let operator to leave from the chat
				case 'end-chat':

					this.db.leave_chat( this.current_chat.id );
					this.db.send_action( 'end-chat', visitor_id, this.current_chat.id );
					
				break;

			}
		},

		/**
		 * Check if a value exists in an array
		 *
		 * @param    {string}
		 */
		_in_array : function( val, array ) {
			
			var length = array.length;

			for(var i = 0; i < length; i++) {
				if( array[i] == val ) return true;
			}

			return false;
		},

		/**
		 * Add sound
		 */
		_add_sound : function( name ) {
			this.sounds[name] = new Audio( this.opts.plugin_url + '/assets/sounds/' + name + '.mp3' );
		},

		/**
		 * Check if a value exists in an array
		 *
		 * @param    {string}
		 */
		_in_array : function( val, array ) {
			
			var length = array.length;

			for(var i = 0; i < length; i++) {
				if( array[i] == val ) return true;
			}

			return false;
		},

		/**
		 * Is URL an image
		 *
		 * Source: http://stackoverflow.com/a/19395606/272478
		 */
		_is_img : function( uri ) {
			
			// Make sure we remove any nasty GET params 
			uri = uri.split('?')[0];

			// Moving on now
			var parts = uri.split('.'),
				extension = parts[parts.length-1],
				imageTypes = ['jpg','jpeg','tiff','png','gif','bmp'];

			if( imageTypes.indexOf( extension ) !== -1 ) {
				return true;
			}
		},

		/**
		 * Convert HTML tags to text and replace plain URLs with links
		 *
		 * @param    {string}
		 */
		_parse : function( str ) {
			
			var links = str.match( this.url_pattern ) || [],
				pseudo_links = str.match( this.pseudo_url_pattern ),
				link = '',
				href = '',
				template = '',
				rx = '';

			// Merge links with pseudos
			if( pseudo_links ) {
				for( var i in pseudo_links ) { links.push( pseudo_links[i].trim() ); }
			}

			// Convert HTML tags and new lines to text
			str = String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace( /\n/g, '<br>');

			// Twitter Emoji parse
			str = twemoji.parse( str );

			for( var i=0; i<links.length; ++i ) {
				link = links[i];

				if( this._is_img( link ) ) { 
					template = 'msg-img';
				} else {
					template = 'msg-link';
				}

				// Clean http:// part from url
				href = link.replace( /.*?:\/\//g, "" );

				rx = new RegExp( link, 'g' );

				str = str.replace( rx, this.render( template, href ) );
				
			}

			return str;
			
		},

		/**
		 * Remove a DOM object
		 */
		_remove_obj : function( id ) {

			var $item = D.getElementById(id);

			if( $item ) { 
				$item.parentNode.removeChild( $item ); 
			}

		},

		/**
		 * Update timestamps
		 *
		 * @source https://coderwall.com/p/uub3pw/javascript-timeago-func-e-g-8-hours-ago
		 */
		_timeago : function() {

			var self = this;

			var templates = this.opts._time;

			var fn_template = function (t, n) {
				return templates[t] && templates[t].replace( /%d/i, Math.abs(Math.round(n)));
			};

			var fn_timer = function (time) {

				var now = new Date();
				var seconds = ( (now.getTime() - time ) * .001) >> 0;
				var minutes = seconds / 60;
				var hours = minutes / 60;
				var days = hours / 24;
				var years = days / 365;

				return templates.prefix + (
				seconds < 45 && fn_template('seconds', seconds) || seconds < 90 && fn_template('minute', 1) || minutes < 45 && fn_template('minutes', minutes) || minutes < 90 && fn_template('hour', 1) || hours < 24 && fn_template('hours', hours) || hours < 42 && fn_template('day', 1) || days < 30 && fn_template('days', days) || days < 45 && fn_template('month', 1) || days < 365 && fn_template('months', days / 30) || years < 1.5 && fn_template('year', 1) || fn_template('years', years)) + templates.suffix;
			};

			var $el = D.getElementsByClassName( 'schat-timeago' );
			
			for ( var i in $el ) {
				var $this = $el[i];
				if (typeof $this === 'object') {
					$this.innerHTML = fn_timer( $this.getAttribute('datetime') );
				}
			}

			// Update time every minute
			setTimeout( function() {
				self._timeago();
			}, 60000 );
		},

		/**
		 * Check if chat options are valid
		 */
		_validate_opts : function() {

			if( !this.opts.app_id || !this.opts.token ) {
				this.ntf( this.opts._invalid_conf, 'error' );
				return false;
			}

			return true;

		},


	};

	// Run the script in "noConflict" mode
	SChat.noConflict = function noConflict() {
		root.SChat = prev_chat_x;
		return SChat;
	};

	// Export the object as global
	root.SChat = SChat;


	//
	// External methods
	// ------------------

	/**
	 * Authenticate user
	 */
	SChat.prototype.auth = function( callback ) {

		var self = this;

		this.db.auth( 'custom', function( err, auth ) {
			if( !err ) {
				self.db.set_user( auth.uid, self.opts.user.name, function( user ) {

					if( callback ) {
						callback( user );
					}

				});
			}

		}, true /* Force to authenticate as operator */ );

	};

	/**
	 * Show notification
	 */
	SChat.prototype.ntf = function( msg, type, section, timeout ) {

		// Update section
		section = section || 'sidebar';

		var self = this,
			$ntf = $( '.schat-ntf-' + section );

		// Render message
		$ntf.innerHTML = this.render( 'ntf', {
			msg: msg,
			type: type
		});

		// Set classes
		$ntf.className += ' schat-active';

		if( timeout ) { 
			setTimeout( function() { 
				self.hide_ntf( section );
			}, timeout ); 
		}

	};

	/**
	 * Hide all notifications
	 */
	SChat.prototype.hide_ntf = function( section ) {
		
		// Update section
		section = section || 'sidebar';

		var $ntf = $( '.schat-ntf-' + section );

		removeClass.apply( $ntf, ['schat-active'] );
		$ntf.innerHTML = '';

	};

	/**
	 * Show tab
	 */
	SChat.prototype.show_tab = function( user_id, refresh_tab ) {

		var self = this,
			is_you = ( user_id === self.user_id );

		// Setup current tab
		self.$user_tab_wrap.id = 'SLC-user-' + user_id;

		// Make read new messages
		self.$user_tab_wrap.addEventListener( 'click', function(e) {
			self._read_msgs();
		});

		// Keep active of current list item
		$user_item = D.getElementById( 'SLC-user-item-' + user_id );

		if( $user_item ) {
			D.getElementById( 'SLC-user-item-' + user_id ).className += ' schat-active';
		}

		// Listen buttons
		var fn_listen_btns = function( btns ) {

			var $btn = '';

			if( btns ) {
				for( var i=0; i < btns.length; i++ ) {
					$btn = $('.schat-tab-btn-' + btns[i] );

					if( $btn ) {
						$btn.addEventListener( 'click', function( e ) {
							e.preventDefault();

							var type = this.getAttribute('href').substr(1);

							// Run action
							self._run_action( type );
						});
					}
				}
			}
		};

		var user = this.users[user_id];

		if( user ) {

			var data = user, // Tab data
				cls = [], // Tab class(es)
				btns = [], // Tab main buttons
				listen_btns = [], // Tab main buttons
				params = [], // User parameters
				private_chat = '',
				active_chat = '',
				inactive_chat = '';

			// User is online?
			if( user.sessions ) {
				cls.push( 'schat-online' );
			}

			// Refreshing tab class
			if( refresh_tab ) {
				cls.push( '_schat-refresh' );
			}

			// Get useful user data
			var popup_status = ( user.popup ) ? self.opts._open : self.opts._close,
				popup_status_slug = ( user.popup ) ? 'open' : 'close';

			// Get private chat if there is any...
			if( user.chats ) {
				for( var chat_id in user.chats ) {
					
					if( self.db.chats && chat_id in self.db.chats ) {
						private_chat = self.db.chats[chat_id];
						break;
					}
				}
			}

			// Get active and inactive visitor chat
			if( user.chats ) {
				for( chat_id in user.chats ) {
					if( user.chats[chat_id].active ) {
						active_chat = user.chats[chat_id];
					} else {
						inactive_chat = user.chats[chat_id];
					}
					
					break;
				}
			}

			// Clean current conversation area
			if( !refresh_tab ) {
				self.$cnv.innerHTML = '';
			}

			// Get visitor's active user session
			if( !user.is_op ) {
				
			}
			
			// Update current chat data
			self.current_chat = private_chat || active_chat || inactive_chat;

			// The chat is active!
			if( private_chat ) {

				// Update conversation in real-time
				if( !refresh_tab ) {

					var chat_msgs = self.chat_msgs[private_chat.id],
						msg = {};

					// Clean current conversation area
					self.$cnv.innerHTML = '';

					// Insert current chat messages
					if( chat_msgs && !is_you ) {

						for( msg_id in chat_msgs ) {

							// Get message
							msg = chat_msgs[msg_id];

							// Add message to conversation area
							self.add_msg( private_chat.id, msg, false );
						}
					}
					
				}

				// Only for visitors who have private chat
				if( !user.is_op ) {

					// Leave chat 
					btns.push( self.render( 'tab-link', {
						id: 'leave-chat',
						title: self.opts._leave_chat
					}));
					listen_btns.push( 'leave-chat' );

					// End chat
					/*btns.push( self.render( 'tab-link', {
						id: 'end-chat',
						title: self.opts._end_chat
					}));
					listen_btns.push( 'end-chat' );*/

				}

				// Reply box is active
				if( !is_you ) {
					cls.push( 'schat-reply-active' );
				}
				

			// The user is an ONLINE OPERATOR, but no private chat
			} else if( user.is_op && user.online_op && !is_you ) {

				// Reply box is active
				cls.push( 'schat-reply-active' );

			// The user is a VISITOR, but no private chat
			} else if( !user.is_op && !is_you ) {

				// The visitor is online
				if( user.sessions ) {

					// The visitor is free to talk
					// Because any operator or the visitor itself not started chat yet
					if( !user.chats ) {

						// Start chat
						btns.push( self.render( 'tab-link', {
							id: 'start-chat',
							title: self.opts._start_chat
						}));
						listen_btns.push( 'start-chat' );

					// The visitor logged in a chat, 
					// but no operator accepted yet
					} else if( user.chats && inactive_chat) {

						// Accept the chat
						btns.push( self.render( 'tab-link', {
							id: 'accept-chat',
							title: self.opts._accept_chat
						}));
						listen_btns.push( 'accept-chat' );

						// Include related class(es)
						cls.push( 'schat-urgent' );

					
					// The visitor is talking with an operator
					} else if( active_chat ) {
						var _msg = self.opts._act_op_info.replace( '%s', active_chat.op_name );
						data.active_op = self.render( 'tab-op', _msg );
					}
				
				// The visitor is offline 
				} else {
				}

			}
		}

		// General visitor data
		if( !user.is_op ) {
			
			// Render session data
			if( private_chat.session ) {
				private_chat.session.geo = private_chat.session.geo || {};
				data.session = self.render( 'tab-session', private_chat.session );
			}

			// Parameters
			params.push( self.render( 'param-item', {
				id: 'popup',
				title: self.opts._popup,
				slug: popup_status_slug,
				val: popup_status
			}));

			params.push( self.render( 'param-item', {
				id: 'mode',
				title: self.opts._mode,
				slug: self.opts._mode,
				val: user.mode || '-'
			}));
		}

		// Get tab parameters
		data.params = params.join('');

		// Get reply box placeholder
		data.reply_ph = self.opts._reply_ph;

		// Get tab buttons
		if( btns.length > 0 ) { data.btns = self.render( 'tab-nav', btns.join('') ); }

		// Get classes
		data.cls = cls.join(' ');

		// Get unsent reply
		data.reply = self.replies[user_id] || null;

		// Get tab header
		data.content = self.render( 'tab-header', data );

		// Render tab content
		self.$user_tab.innerHTML = self.render( 'tab-wrap', data );

		// Listen buttons
		fn_listen_btns( listen_btns );

		// Get reply box
		var $reply = $('.schat-reply');

		// Focus reply box
		if( !refresh_tab ) { $reply.focus(); }

		// Listen reply box
		$reply.addEventListener( 'keydown', function(e) {
			if( e && e.keyCode === 13 && !e.shiftKey ) {
				var msg = this.value.trim();
				var _user_id = this.getAttribute('data-user-id');


				// Clear reply from unsent list
				delete self.replies[_user_id];

				if( msg.length > 0 ) {

					// Clean the value
					this.value = '';

					// Push the message
					if( private_chat ) {
						self.db.push_msg( private_chat.id, msg, 'default' );

					// Create new chat room
					} else {

						var data = {
							type: 'support',
							started_by: 'operator',
							missed: false
						};

						self.db.create_chat( user_id, data, function( err, new_chat ) {

							if( !err ) {

								// Invite the selected user to chat
								self.db.send_action( 'auto-initiate', user_id, new_chat.id );

								// Update current chat data
								self.current_chat = new_chat;

								// 
								self.db.push_msg( new_chat.id, msg, 'default' );

								// Join the chat
								self.db.join_chat( new_chat.id );

							}

						});
					}

					// Mark new messages as read if still left
					self._read_msgs();
				}

				e.preventDefault();

			// Typing...
			} else {
				return true;
			}

		});

		// Save unset reply
		$reply.addEventListener( 'blur', function(e) {
			
			var _user_id = this.getAttribute('data-user-id');

			self.replies[_user_id] = this.value.trim();
		});

	};

	/**
	 * Render message in the chat chat
	 *
	 * @param    {string}    message
	 */
	SChat.prototype.add_msg = function( chat_id, raw_msg, is_new ) {
		
		// Message data
		var msg_data = {
			id              : raw_msg.id,
			user_id         : raw_msg.user_id,
			name            : raw_msg.name,
			type            : raw_msg.type,
			time            : this.format_time( raw_msg.time ),
			msg             : raw_msg.msg || '',
			self_msg        : ( raw_msg.user_id == this.db.user_id )
		};

		// Set class
		msg_data.cls = ( msg_data.self_msg ) ? 'schat-msg schat-you' : 'schat-msg schat-other';

		// Optimize the message
		msg_data.msg = this._parse( msg_data.msg );

		// Include user avatar
		if( raw_msg.avatar ) {
			msg_data.avatar = this.render( 'avatar', raw_msg.avatar );
		}

		// Insert to conversation content
		this.$cnv.insertAdjacentHTML( 'afterbegin', this.render( 'chat-msg', msg_data ) );

		if( is_new ) {
			var $new_msg = D.getElementById( 'SLC-msg-' + raw_msg.id );

			// Make it unread message
			$new_msg.className += ' schat-new';

			// Remove "schat-new" class after a while
			setTimeout( function() {
				removeClass.apply( $new_msg, ['schat-new'] );
			}, 1200 );
		}


	};

	/**
	 * Given a timestamp, format it in the form hh:mm am/pm. Defaults to now
	 * if the timestamp is undefined.
	 *
	 * @param    {Number}    timestamp
	 * @param    {string}    date
	 * @return   {string}
	 */
	SChat.prototype.format_time = function( timestamp ) {

		var date = (timestamp) ? new Date(timestamp) : new Date(),
			hours = date.getHours() || '0',
			minutes = '' + date.getMinutes();

		// Update hours & minutes
		minutes = ( minutes.length < 2 ) ? '0' + minutes : minutes;

		return '' + hours + ':' + minutes;

	};


	/**
	 * Play a sound
	 */
	SChat.prototype.play = function( name ) {
		
		if( !( name in this.sounds ) ) {
			this._add_sound( name );
		}

		this.sounds[name].play();
	};

	/**
	 * Render template
	 */
	SChat.prototype.render = function( template, p ) {
		
		var arr = [];

		switch( template ) {

			// Notification
			case 'ntf':
				arr = [ '<div class="schat-wrap schat-', p.type,'">', p.msg, '</div>' ];
				break;

			// Standart link button
			case 'link':
				p.href = p.href || 'javascript:;';
				arr = [ '<a href="', p.href, '" class="schat-link schat-btn-',p.name,'">',p.val,'</a>' ];
				break;

			// User list item
			case 'user-item':
				arr = [ '<li id="SLC-user-item-',p.id,'" data-id="',p.id,'" class="schat-user-', p.id, ' ', p._cls,'"><span class="schat-icons">',p._timeago,p._ico,'</span><span class="schat-title"><span class="schat-count schat-user-count-',p.id,'" id="SLC-user-item-c-',p.id,'">',p.count,'</span> ', p.name, '</span>',p.meta,'</li>' ];
				break;

			// User meta
			case 'user-item-meta':
				arr = [ '<div class="schat-meta"><img src="',this.opts.plugin_url,'/assets/img/flags/',p.country_code,'" alt="" /> ',p.city, ', ', p.country, '</div>' ];
				break;

			// Icon
			case 'ico':
				arr = [ '<i class="schat-ico schat-ico-',p,'"></i>' ];
				break;

			// Tab wrap
			case 'tab-wrap':
				arr = [ '<div class="schat-wrap ',p.cls,'"><div class="schat-tab-header"><span class="schat-title">',p.name,'</span></div>',p.btns,p.active_op,p.session,'<div class="schat-content">',p.content,'</div></div>' ];
				break;

			// Tab header
			case 'tab-header':
				arr = [ '<div class="schat-reply-wrap"><textarea name="msg" placeholder="',p.reply_ph,'" data-user-id="',p.id,'" class="schat-reply">',p.reply,'</textarea></div><ul class="schat-user-params">',p.params,'</ul>' ];
				break;

			// Tab navigation
			case 'tab-nav':
				arr = [ '<ul class="schat-tab-nav">',p,'</ul>' ];
				break;

			// Tab session info
			case 'tab-session':
				arr = [ '<div class="schat-tab-session"><div class="schat-geo">',p.geo.city,', ', p.geo.country,' (IP: ', p.ip,')</div><div class="schat-platform">',p.browser,' ',p.browser_version,' (',p.os,')</div></div>' ];
				break;

			// Tab active operator
			case 'tab-op':
				arr = [ '<div class="schat-tab-op">',p,'...</div>' ];
				break;

			// Tab link
			case 'tab-link':
				arr = [ '<li class="schat-tab-link-',p.id,'"><a href="#',p.id,'" class="schat-button-s schat-tab-btn-',p.id,'">',p.title,'</a></li>' ];
				break;

			// User param item
			case 'param-item':
				arr = [ '<li class="schat-p-', p.id,' schat-p-val-',p.slug,'"><strong class="schat-title">',p.title,'</strong><span class="schat-val">',p.val,'</span></li>' ];
				break;

			// Time
			case 'time':
				arr = [ '<time class="schat-timeago" datetime="' + p + '"></time>' ];
				break;

			// Room message
			case 'chat-msg':
				arr = [ '<div id="SLC-msg-',p.id,'" class="schat-msg schat-msg-',p.id,' ',p.cls,'">',p.avatar,'<div class="schat-msg-wrap"><span class="schat-msg-time">',p.time,'</span><span class="schat-msg-author">',p.name,'</span><span class="schat-msg-content">',p.msg,'</span></div></div>' ];
				break;

			// Avatar
			case 'avatar':
				arr = [ '<span class="schat-msg-avatar"><img src="',p,'" alt="" /></span>' ];
				break;

			// Image link
			case 'msg-img':
				arr = [ '<div class="schat-msg-img"><a href="//',p,'" target="_blank"><img src="//',p,'" alt="" /></a></div>' ];
				break;

			// Normal link :)
			case 'msg-link':
				arr = [ '<a href="//',p,'" target="_blank">', p,'</a>' ];
				break;

			// Window title
			case 'w-title':
				arr = [ '(',p,') ', title  ];
				break;

		}

		return arr.join('');

	};


})();