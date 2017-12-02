/*!
 * Screets Live Chat - Front-end
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
			app_id 				: '', // Real-time application 
			max_msgs			: 70, // Total number of chat messages to load per chat
			default_mode		: '', // Initial mode
			hide_when_offline	: false, // Hide chat box when all operators offline
			show_btn 			: true, // Show chat button
			show_prechat 		: true, // Show login form to visitor before chat
			show_postchat 		: true, // Show feedback form to visitor after ending chat
			user 				: {}, // Default user data
			is_frontend			: true, // Is front-end
			minimized_before	: false // User minimized popup already on current page refresh
		};

		// Setup and establish options
		this.opts = default_opts;
		for( var k in opts ) { this.opts[k] = opts[k]; }

		// Create real-time database
		this.db = new SLC_FB( this.opts ); // Firebase

		// User data
		this.user = {};
		this.user_id = '';

		// Online operators list
		this.online_ops = {};

		// Useful variables
		this.mode = 'offline';
		this.btn_mode = 'hidden'; // "visible", "hidden"
		this.popup_mode = 'hidden'; // "visible", "hidden"
		this.chat = {};
		this.chat_msgs = {};
		this.last_msg = null; // The last read message
		this.count_new_msgs = 0; // Total unread messages
		this.chat_op = null; // Authorized operator of the current chat
		this.departments = {};
		this.retina = this._is_retina();

		// Sounds
		this.sounds = {};
		this._add_sound( 'new-msg' );

		// Common UI objects
		this.$btn = D.getElementById( 'SLC-btn' );
		this.$popup = D.getElementById( 'SLC-popup-' + this.mode );
		this.$attention = D.getElementById( 'SLC-attention' );
		this.$cnv = $( '#SLC-popup-online .schat-cnv' );
		this.$reply = $( '.schat-reply' );
		this.$btn_prechat = D.getElementsByClassName( 'schat-send-prechat' );
		this.$btn_offline = D.getElementsByClassName( 'schat-send-offline' );

		// Some useful regexes
		this.url_pattern = /\b(?:https?|ftp):\/\/[a-z0-9-+&@#\/%?=~_|!:,.;]*[a-z0-9-+&@#\/%=~_|]/gim;
		this.pseudo_url_pattern = /(^|[^\/])(www\.[\S]+(\b|$))/gim;

		// Setup common UI elements
		this._ui();

		// Authenticate user as visitor
		this.db.auth( 'anonymously', function( err, auth ) {
			if( !err ) {

				// Show "connecting"... notification
				if( self.mode === 'online' ) {
					self.ntf( self.opts._connecting, 'wait' );
				}

				self.db.set_user( auth.uid, self.opts.user.name, function( user ) {
					
					// Update current popup status
					var popup_status = ( self.popup_mode === 'visible' ) ? 'open' : null;
					self.db.update_param( 'user', 'popup', popup_status );

				});
			} else {
				console.error( 'SChat', err );
			}
			
		});

		// Setup binding events
		this._data_events();

	}

	//
	// Internal methods
	// ------------------

	SChat.prototype = {

		/**
		 * Setup binding events
		 */
		_data_events : function() {

			// Notifications
			this.db.on( 'ntf', this._on_ntf.bind( this ) );

			// Update user data
			this.db.on( 'user-update', this._on_user_update.bind( this ) );
			this.db.on( 'op-update', this._on_op_update.bind( this ) );
			this.db.on( 'auth-req', this._on_auth_required.bind( this ) );

			// Event for chat and messages
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
		 * Setup common UI elements
		 */
		_ui : function() {

			var self = this,
				$popups = D.getElementsByClassName( 'schat-popup' ),
				$forms = D.getElementsByClassName( 'schat-form' ),
				$lists = D.getElementsByClassName( 'schat-list' );

			// Chat button events
			this.$btn.addEventListener( 'click', function(e) {
				e.preventDefault();

				// Mark unread messages as read
				self.read_msgs();

				var status = ( self.online_ops ) ? 'prechat' : 'offline';

				// Update mode every click on button according to online operators
				self.refresh_mode( status );

				// Show popup
				self.popup( 'show' );

			});

			// 
			// Lists
			//
			if( $lists ) {
				var _list_links = [],
					_sub_items = [];
					$_selected_item = '';

				for( var i=0; i < $lists.length; i++ ) {

					// Get list items
					_list_links = $lists[i].getElementsByClassName( 'schat-item' );

					for( var k=0; k < _list_links.length; k++ ) {

						// List items' "click" event
						_list_links[k].querySelector('a').addEventListener( 'click', function(e) {
							e.preventDefault();

							var $list_item = this.parentNode;

							// Go back to the list
							if( hasClass.apply( $list_item, ['_schat-selected'] ) ) {

								// Remove burger icon
								$list_item.querySelector('.schat-ico').remove();

								// Deactivate list item
								removeClass.apply( $list_item, ['_schat-selected'] );
								removeClass.apply( $list_item.parentNode, ['_schat-open'] );
								

							// Show sub-menu
							} else {
								// Get sub menu items if exists
								_sub_items = $list_item.getElementsByClassName( 'schat-item' );

								if( _sub_items.length > 0 ) {

									// Add burger icon
									this.insertAdjacentHTML( 'afterbegin', '<i class="schat-ico fa fa-bars"></i>' );

									// Activate the menu
									$list_item.parentNode.className += ' _schat-open';
									$list_item.className += ' _schat-selected';

								}
							}

						});

					}

				}
			}

			// 
			// Popup events
			//
			if( $popups ) {
				for( var i=0; i < $popups.length; i++ ) {

					// Popup header "click" event
					$popups[i].querySelector('.schat-header').addEventListener( 'click', function(e) {
						e.preventDefault();

						// User minimized popup by himself
						self.minimized_before = true;

						// Mark unread messages as read
						self.read_msgs();

						// Hide popup
						self.popup( 'hide' );
					});
				}
			}

			// 
			// Listen typing messages
			// 
			if( this.$reply ) {

				this.$reply.addEventListener( 'keydown', function(e) {
						
					// Push new message
					if( e && e.keyCode === 13 && !e.shiftKey ) {
						
						var msg = this.value.trim();

						if( msg.length > 0 ) {

							// Clean the value
							this.value = '';

							// Push message to database
							self.db.push_msg( self.chat.id, msg, 'default' );

							// Mark new messages as read if still left
							self.read_msgs();
							
						}

						e.preventDefault();

					// Typing...
					} else {
						return true;
					}
				});
				
			}


			// 
			// Form fields events
			// 
			if( $forms ) {

				var form_name = '';

				// Setup all forms
				for( var i=0; i < $forms.length; i++ ) {

					this.setup_form( $forms[i] );
					
				}
			}

			// 
			// Send buttons
			// 
			var working_prechat = false,
				$btn = '';

			// Pre-chat send button
			if( this.$btn_prechat ) {
				for( var i=0; i < this.$btn_prechat.length; i++ ) {
					$btn = this.$btn_prechat[i];

					$btn.addEventListener( 'click', function(e) {

						e.preventDefault();

						// Prevents multiple clicks
						if( working_prechat ) return;

						// Form sending..
						working_prechat = true;

						var form_data = self.get_form_data();

						// Start chat
						self.start_chat( form_data );

					});

				}
			}

			// 
			// Offline send button
			// 
			if( this.$btn_offline ) {
				for( var i=0; i < this.$btn_offline.length; i++ ) {
					$btn = this.$btn_offline[i];

					$btn.addEventListener( 'click', function(e) {

						e.preventDefault();

						// Prevents multiple clicks
						if( working_prechat ) return;

						// Form sending..
						working_prechat = true;

						var form_data = self.get_form_data();

						// Send offline form
						self.send_offline( form_data );

					});

				}
			}

			// Listen conversation clicks
			// FIXME: change $cnv with $popup (according to mode updates)
			if( this.$cnv ) {
				this.$cnv.addEventListener('click', function(e) {
					self.read_msgs();
				});
			}

			// 
			// Resize window
			// 
			W.addEventListener('resize', function( e ){
  
				if( self.$popup ) {

					/*var $popup = self.$popup,
						$reply = $popup.querySelector('.schat-reply-box'),
						e = D.documentElement,
						g = D.getElementsByTagName('body')[0],
						x = W.innerWidth || e.clientWidth || g.clientWidth,
						y = W.innerHeight|| e.clientHeight|| g.clientHeight,
						bottom = parseInt( self._get_css( self.$popup, 'bottom' ), 10 ),
						max_h = y - bottom - 10;


					// Don't setup in small screens
					if( x >= 550 ) {

						// Set max height of fixed popup
						$popup.style.maxHeight = max_h + 'px';

						// Put bottom space to conversation not to mix with reply box
						if( self.$cnv ) {
							var reply_h = ( $reply ) ? $reply.offsetHeight : 0;
							self.$cnv.style.marginBottom = ( reply_h + 20 ) + 'px';
						}

					}*/

				}

			});

			// Trigger "resize" event
			this.refresh_ui();
		},

		/**
		 * Get CSS property
		 */
		_get_css : function ( $el, property ) {

			return W.getComputedStyle( $el, null ).getPropertyValue( property );
		},

		/**
		 * Get current position of an element
		 */
		/*_get_pos : function ( $el ) {

			var pos_x = 0,
				pos_y = 0;
		  
			while( $el ) {
				pos_x += ( $el.offsetLeft -  $el.scrollLeft +  $el.clientLeft );
				pos_y += ( $el.offsetTop -  $el.scrollTop +  $el.clientTop );
				$el = $el.offsetParent;
			}
			return { x: pos_x, y: pos_y };
		},*/

		/**
		 * Event to monitor user updates
		 */
		_on_user_update : function( user ) {

			if( !user ) return;

			// Update current user data
			this.user = user;
			this.user_id = user.id;

			// If no active chat, try to be online again
			// It means, we need to show prechat form here or force to re-login again
			if( !this.chat.length ) {
				this.refresh_mode();
			}

		},

		/**
		 * Event to monitor online operators state
		 */
		_on_op_update : function( ops ) {

			var $chat_btns = D.querySelectorAll( '.schat-chat-btn' ),
				btn_class = '',
				btn_title = '';

			var $reply = this.$popup.querySelector('.schat-reply');

			// Update online operators list
			this.online_ops = ops;

			// There is online operator(s)
			if( ops ) {

				btn_class = 'schat-online';
				btn_title = this.opts._btn_online;

				// Re-enable reply box
				if( $reply ) {
					$reply.disabled = false;
				}

			// No operator offline!
			} else {

				btn_class = 'schat-offline';
				btn_title = this.opts._btn_offline;

				// Disable reply box
				if( $reply ) {
					$reply.disabled = true;
				}

			}

			// Update chat button(s)
			if( $chat_btns ) {
				var $btn = '';
				var $btn_title = '';

				for( var i=0; i < $chat_btns.length; i++ ) {
					$btn = $chat_btns[i].querySelector('.schat-title');
					
					// Update button class
					removeClass.apply( $btn, [btn_class, btn_class] );

					// Add button title
					$btn.innerHTML = this.render( 'btn-title', btn_title );

				}
			}

			// Show up button or popup if possible
			if( !this.opts.hide_when_offline && this.popup_mode != 'visible' ) {
				if( this.opts.show_btn ) {
					this.btn( 'show' );
				} else {
					this.popup( 'show' );
				}
			}

			// Refresh mode
			this.refresh_mode();
		},

		/**
		 * When current user joined chat
		 */
		_on_chat_join : function( chat ) {
			
			var self = this;

			// Update chat data
			this.chat = chat;

			// Enable reply box
			if( this.$reply ) {
				this.$reply.disabled = false;
			}

			// Open popup if it's closed
			if( this.popup_mode === 'hidden' ) {
				this.popup( 'visible' );
			}

			// Go online mode
			this.refresh_mode();

			// Show welcome message if no message sent to room
			if( !Object.keys( this.chat_msgs ).length ) {
				this.ntf( this.opts._welcome_msg, 'info', 'online' );

			// Clear "connecting" message if exists
			} else {
				this.hide_ntf( 'online' );
			}

			setTimeout( function() {
				if( self.$reply ) {
					self.$reply.focus();
				}
			}, 0);

		},
		
		/**
		 * When one of joined chats updated
		 */
		_on_chat_update : function( chat ) {

			this.chat = chat;
			
		},

		/**
		 * When current user exit from the chat
		 */
		_on_chat_exit : function( chat_id ) {

			// Clear chat data
			this.chat = {};

			// Go pre-chat mode
			this.refresh_mode();

			// Disable reply box
			if( this.$reply ) {
				this.$reply.setAttribute( 'disabled', 'disabled' );
			}

		},

		/**
		 * Event to monitor new members
		 */
		_on_member_join : function( member ) {

			var self = this,
				user = null;

			// Update operator data if member is an operator
			for( sid in member ) {
				user = member[sid];
				
				if( user.is_op ) {
					this.chat_op = user;
				}
			}

			// Update current operator info
			if( this.chat_op ) {
				this._update_op();
			}

			/*if( members ) {

				var self = this,
					user = null,
					sessions = null,
					current_op = null;

				for( id in members ) {

					sessions = members[id];

					for( session_id in sessions ) {
						user = sessions[session_id];

						// Get current operator of the chat room
						if( user.is_op ) {
							current_op = user;
						}
					}
				}

				// Update current operator data
				this.chat_op = current_op;

				// Update operator data
				if( this.chat && current_op ) {
					
					
				}
			}*/

		},

		/**
		 * Event to monitor removed members
		 */
		_on_member_exit : function( member ) {

			var user = null,
				removed_op = null;

			// Update operator data if member is an operator
			for( sid in member ) {
				user = member[sid];

				if( user.is_op ) {
					removed_op = user;
				}
			}

			if( removed_op && this.chat_op && this.chat_op.id === removed_op.id ) {
				this.chat_op = null;

				this._update_op();
			}

		},

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

						// End chat
						case 'end-chat':
							
							if( self.chat ) {
								self.db.leave_chat( self.chat.id );
							}

							break;
					
					}
					
				// Show error
				} else {
					self.ntf( err, 'error' );
				}

			});


		},

		/**
		 * Event to monitor chat action replies
		 */
		_on_action_response : function( action ) {},

		/**
		 * New message
		 */
		_on_new_msg : function( chat_id, msg, is_unread ) {

			var user_id = msg.user_id;

			if ( !this.user || !this.user.muted || !this.user.muted[ user_id ] ) {
				
				// Hide "welcome message"
				this.hide_ntf( 'online' );

				// Update current chat messages
				this.chat_msgs[msg.id] = msg;

				// Add message to conversation area
				this.add_msg( chat_id, msg, true );

				// Count new messages
				if( is_unread ) {
					this.count_new_msgs += 1;

					// Update count on chat button
					var count = this.$btn.querySelector('.schat-count');
					count.innerHTML = this.count_new_msgs;

					// Popup chat box
					if( !this.minimized_before ) {
						this.refresh_mode( 'online' );
						this.popup( 'show' );
					
					// Add new message notification on chat button
					} else {
						removeClass.apply( this.$btn, ['schat-new-msg', 'schat-new-msg'] );
					}
				}

				// Update window title
				this._update_w_title();

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

			this.del_msg( chat_id, msg );

		},

		/**
		 * Event to monitor current authentication state
		 */
		_on_auth_required : function() {

			if( this.mode == 'online' ) {
				this.refresh_mode( 'prechat' );
			}

		},

		/**
		 * Update window title
		 */
		_update_w_title : function() {
			if( this.count_new_msgs > 0 ) {
				D.title = this.render( 'w-title', this.count_new_msgs );
			} else {
				D.title = title;
			}
		},

		/**
		 * Update current operator info
		 */
		_update_op : function() {

			var self = this,
				$op = $('.schat-current-op'),
				$op_status = $('.schat-current-op-status');

			var fn_update_status = function( online_op ) {

				// Get connection status
				if( online_op ) {
					$op.className += ' schat-online';
					$op_status.innerHTML = self.opts._online;

				} else {
					$op.className += ' schat-offline';
					$op_status.innerHTML = self.opts._offline;
				}

			};

			// Operator offline
			if( !this.chat_op ) {
				fn_update_status( false );

			// Operator online now
			} else {

				this.db.get_user( this.chat_op.id, function( op ) {

					if( op ) {
						$('.schat-current-op-name').innerHTML = op.name;
						$('.schat-current-op-avatar').setAttribute( 'src', op.avatar );

						// Clean connection classes
						removeClass.apply( $op, ['schat-offline schat-online', 'schat-active' ] );
						
						// Update status
						fn_update_status( op.online_op );
					}

				});
				
			}

		},

		/**
		 * Listen to close button of attention grabber
		 */
		_grabber_close : function( e ) {
			e.preventDefault();

			// Update the user last showed grabber
			this.db.update_param( 'user', 'last_grabber', this.opts.grabber_id );

			// Hide grabber
			removeClass.apply( this.$attention, ['schat-active'] );
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
		 * Load an image
		 *
		 */
		_load_img : function( url, callback ) {

			var img = new Image();
			
			img.onload = function() {
				
				// Run callback
				if( callback ) callback( img );
				
			};
			
			// Load image
			img.src = url + '?_=' + ( +new Date() );

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
		 * Is URL an image
		 */
		_is_retina : function( uri ) {
			
			if ( W.matchMedia ) {
				var mq = W.matchMedia( "only screen and (min--moz-device-pixel-ratio: 1.3), only screen and (-o-min-device-pixel-ratio: 2.6/2), only screen and (-webkit-min-device-pixel-ratio: 1.3), only screen  and (min-device-pixel-ratio: 1.3), only screen and (min-resolution: 1.3dppx)" );
				return ( mq && mq.matches || ( W.devicePixelRatio > 1 ) ); 
			}

			return false;

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
			
		}

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
	 * Start chat
	 */
	SChat.prototype.start_chat = function( data ) {

		var self = this;

		// Update user data
		this.db.update_user( this.user_id, data, function() {

			// Create private chat
			self.db.has_chat( self.user_id, function( chat ) {

				// Chat already exists, so join it
				if( chat ) {
					self.db.join_chat( chat.id );

				// Create new chat
				} else {

					self.db.create_chat( self.user.name, {
						type: 'support',
						started_by: 'visitor',
						department_id: data.department || null
						
					// Chat created successfully
					}, function( err, new_chat ) {

						// Auto-join the chat
						if( !err ) {
							self.db.join_chat( new_chat.id );
						}
						
					});
					
				}

			});

		});

	};

	/**
	 * Send offline form
	 */
	SChat.prototype.send_offline = function( fd ) {

		var self = this;

		// Include user geo data if exists
		if( this.db.session && this.db.session.geo ) {
			
			for( var k in this.db.session.geo ) {  fd[ 'xtra-' + k ] = this.db.session.geo[k]; }
		}

		// Include other custom data
		fd['xtra-ip_addr'] = this.opts.ip; // "ip_addr" is required name for backward compatibility of the plugin
		fd['xtra-current-page'] = this.opts.current_page;

		// Send offline message
		this.post( 'offline', fd, function( r ) {

			// Successfully sent!
			if( !r.error ) {
				self.hide_ntf( 'offline' );

				// Clear textarea
				$('.schat-field-question .schat-field').value = "";

				self.ntf( self.opts._success_sent, 'success' );

				setTimeout(function() {
					self.popup('hide');
				}, 3000 );

			} else {
				self.ntf( r.error, 'error' );
			}

			// Re-enable form
			self.enable_form('offline');

		});


		// Upload file(s)
		/*if( $el.getAttribute( 'data-type' === 'file' ) ) {

			for ( var i=0; i < filesArray.length; i++ ) {
				sendFile(filesArray[i]);
			}
			
		}*/
	};

	/**
	 * Chat button events
	 */
	SChat.prototype.btn = function( action ) {

		switch( action ) {
			
			// Show chat button
			case 'show':
				removeClass.apply( this.$btn, ['schat-active _schat-open', 'schat-active _schat-open'] );

				// Hide popup
				this.popup( 'hide-with-btn' );

				// Refresh mode
				this.btn_mode = 'visible';

				// Show attention grabber if possible
				this.show_grabber();

				break;

			// Show chat button WITHOUT closing popup
			case 'show-with-popup':
				removeClass.apply( this.$btn, ['schat-active', 'schat-active'] );

				// Refresh mode
				this.btn_mode = 'visible';

				// Show attention grabber if possible
				this.show_grabber();

				break;

			// 
			// Toggle button display status
			//
			case 'toggle':

				if( this.btn_mode === 'visible' ) {
					this.btn( 'hide' );
				} else {
					this.btn( 'show' );
				}

				break;

			// Hide chat button
			case 'hide':
				removeClass.apply( this.$btn, ['schat-active'] );

				// Refresh mode
				this.btn_mode = 'hidden';

				break;
		}

	};

	/**
	 * Popup events
	 */
	SChat.prototype.popup = function( action ) {

		switch( action ) {

			// 
			// Show popup
			//
			case 'show':

				// Hide chat button
				this.btn( 'hide' );

				// Activate current popup
				removeClass.apply( this.$popup, ['schat-active _schat-open', 'schat-active _schat-open'] );

				var _first_field = this.$popup.querySelector('.schat-field');
				
				// Focus first input field
				if( _first_field ) {
					setTimeout( function() {
						_first_field.focus();
					}, 0 );
				}

				// Update popup mode
				this.popup_mode = 'visible';

				// Update parameter
				this.db.update_param( 'user', 'popup', 'open' );

				break;

			// 
			// Hide popup and show up chat button
			//
			case 'hide':

				// Deactivate popup
				removeClass.apply( this.$popup, ['schat-active _schat_open'] );

				// Show chat button
				this.btn( 'show' );

				// Update popup mode
				this.popup_mode = 'hidden';

				// Update parameter
				this.db.update_param( 'user', 'popup', null );

				break;

			// 
			// Toggle popup display status
			//
			case 'toggle':

				if( this.popup_mode === 'visible' ) {
					this.popup( 'hide-with-btn' );
				} else {
					this.popup( 'show' );
				}

				break;

			// 
			// Hide popup and chat button
			//
			case 'hide-with-btn':

				// Deactivate popup
				removeClass.apply( this.$popup, ['schat-active _schat_open'] );

				// Refresh mode
				this.popup_mode = 'hidden';

				// Update parameter
				this.db.update_param( 'user', 'popup', null );

				break;
		}

		// Refresh UI
		this.refresh_ui();
	};

	/**
	 * Change mode
	 */
	SChat.prototype.refresh_mode = function( force_mode ) {

		var self = this,
			has_chat = ( this.user.chats ) ? true : false,
			new_mode = this.mode;

		// Hide offline top notifications
		this.hide_ntf( 'offline-top' );

		switch( new_mode ) {

			// Offline mode
			case 'offline':

				if( this.hide_when_offline ){
					new_mode = null;

				// We're online!
				} else if( this.online_ops && has_chat ) {
					var _msg = this.opts._btn_online + ' <a class="schat-btn-login" href="javascript;">' + this.opts._prechat_btn + '</a>' ;
					this.ntf( _msg, 'success', 'offline-top' );

					var $login_btns = D.querySelectorAll('.schat-btn-login');
					
					for( var i=0; i < $login_btns.length; i++ ) {
						$login_btns[i].addEventListener('click', function(e) {
							e.preventDefault();

							self.refresh_mode( 'prechat' );
						});
					}
				}

				break;

			// Pre-chat mode
			case 'prechat':
				
				// Go "online" mode if user has already active chat
				// and an operator online 
				// or pre-chat is inactive
				if( !this.opts.show_prechat || ( this.online_ops && has_chat ) ) {
					new_mode = 'online';
				}

			 break;

			// Online mode
			case 'online':
				
				// Go "prechat" mode if user has no chats
				if( !has_chat ) {
					new_mode = 'prechat';
				}

			 break;

		}

		if( force_mode ) {
			new_mode = force_mode;
		}

		// If no new mode possible, close popup and hide button
		if( !new_mode ) {
			this.popup( 'hide-with-btn' );
		}

		var $_new_mode = D.getElementById( 'SLC-popup-' + new_mode );

		if( !$_new_mode ) return;

		// Refresh mode in database
		this.db.update_mode( new_mode );

		// Hide last popup
		removeClass.apply( this.$popup, ['schat-active _schat-open _schat-updated'] );

		// Update current popup object
		this.$popup = $_new_mode;

		var cls = ( this.popup_mode === 'visible' ) ? ' schat-active _schat-open _schat-updated' : ' schat-active _schat-updated'; 

		// Activate new mode
		this.$popup.className += cls;

		// Update new mode
		this.mode = new_mode;

		// Refresh ui
		this.refresh_ui();

	};

	/**
	 * Render message in the chat
	 *
	 * @param    {string}    chat id
	 * @param    {string}    message
	 */
	SChat.prototype.add_msg = function( chat_id, raw_msg, is_new ) {
		
		// Message data
		var msg_data = {
			id 				: raw_msg.id,
			user_id 		: raw_msg.user_id,
			name 			: raw_msg.name,
			type 			: raw_msg.type,
			time 			: this.format_time( raw_msg.time ),
			msg 			: raw_msg.msg || '',
			self_msg 		: ( raw_msg.user_id == this.db.user_id )
		};

		var cls = [],
			prev_msg_class = '';

		// Group visitor messages
		if( !this.last_msg ) {

			// Set class for the message owner
			if( msg_data.self_msg ) {
				cls.push( 'schat-you-start' );
			} else {
				cls.push( 'schat-other-start' );
			}

		} else if( !this.last_msg.self_msg && msg_data.self_msg ) {
			cls.push( 'schat-you-start' );

			prev_msg_class = ' schat-other-end';

		// Group other messages
		} else if( this.last_msg.self_msg && !msg_data.self_msg ) {
			cls.push( 'schat-other-start' );

			prev_msg_class = ' schat-you-end';
		}

		// Set previous message
		if( prev_msg_class ) {
			D.getElementById('SLC-msg-' + this.last_msg.id ).className += prev_msg_class;
		}

		// Set class for the message owner
		if( msg_data.self_msg ) {
			cls.push( 'schat-you' );
		} else {
			cls.push( 'schat-other' );
		}

		// Get classes
		msg_data.cls = cls.join(' ');

		// Optimize the message
		msg_data.msg = this._parse( msg_data.msg );

		// Include user avatar
		if( raw_msg.avatar ) {
			msg_data.avatar = this.render( 'avatar', raw_msg.avatar );
		}

		// Insert to conversation content
		if( this.$cnv ) {
			this.$cnv.insertAdjacentHTML( 'beforeend', this.render( 'chat-msg', msg_data ) );

			// Scroll down
			this.$cnv.scrollTop = 10000;
		}


		if( is_new ) {

			var $new_msg = D.getElementById( 'SLC-msg-' + raw_msg.id );

			if( $new_msg ) {

				// Make it unread message
				$new_msg.className += ' schat-new';

				// Remove "schat-new" class after a while
				setTimeout( function() {
					removeClass.apply( $new_msg, ['schat-new'] );
				}, 1200 );
				
			}
		}

		// Update last message
		this.last_msg = msg_data;

	};

	/**
	 * Render notification in the chat
	 *
	 * @param    {string}    chat id
	 * @param    {string}    message
	 * @param    {string}    type (info, warn, error etc.)
	 */
	SChat.prototype.add_ntf = function( chat_id, msg, type ) {
		
		var data = {
			msg 		: msg,
			type 		: type
		};


		// Insert to conversation content
		if( this.$cnv ) {
			this.$cnv.insertAdjacentHTML( 'beforeend', this.render( 'chat-ntf', data ) );
		}

	};

	/**
	 * Remove message in the chat chat
	 *
	 */
	SChat.prototype.del_msg = function( chat_id, msg ) {
		
		var $msg = D.getElementById( 'SLC-msg-' + msg.id );
		
		if( $msg ) {
			$msg.parentNode.removeChild( $msg );
		}

	};

	/**
	 * Setup form fields
	 */
	SChat.prototype.setup_form = function( $form ) {

		var self = this,
			valid_nodes = [ 'INPUT', 'SELECT', 'TEXTAREA' ],
			form_name = $form.getAttribute('data-name'),
			$field = {},
			$send_btn = $( '.schat-send-' + form_name ),
			$last_label = '';

		// Activate send button if possible
		var fn_check_send_btn = function() {

			var activate = true;

			for( var i = 0; i < $form.elements.length; i++ ) {
				if( $form[i].hasAttribute('required') && !hasClass.apply( $form[i], ['schat-valid'] ) ) {
					activate = false;
				}
			}

			// Clean disabled class just in case 
			removeClass.apply( $send_btn, ['schat-disabled'] );

			// Keep the button disabled
			if( !activate ) {
				$send_btn.className += ' schat-disabled';
			} 

		};

		// Show up form labels
		var fn_focus = function(e) {

			var $label = this.previousElementSibling;

			// Hide latest label first
			if( $last_label ) {
				removeClass.apply( $last_label, ['_schat-show'] );
			}

			// Show up current form label
			if( $label ) {
				$label.className += ' _schat-show';
			}

		};

		var fn_blur = function(e) { 
			$last_label = this.previousElementSibling;
		};

		// Setup fields
		for( var i = 0; i < $form.elements.length; i++ ) {

			if( this._in_array( $form[i].nodeName, valid_nodes ) ) {
				
				// Get field
				$field = $form[i];

				// Show/hide current form field label
				$field.onfocus =  fn_focus;
				$field.onblur =  fn_blur;

				// Send the form when user clicks "enter"
				$field.addEventListener( 'keyup', function(e) {

					if( !hasClass.apply( $send_btn, ['schat-disabled'] ) && $field.nodeName !== 'TEXTAREA' && e && e.keyCode === 13 && !e.shiftKey ) {
						$send_btn.click();
					} else {

						// Validate the field
						self.validate( e.target );

						// Activate send button if possible
						fn_check_send_btn();

						return true;
					}
				});
				
			}

		}

		// Disable send button for the first view
		$send_btn.className += ' schat-disabled';

	};

	/**
	 * Show attention grabber
	 */
	SChat.prototype.show_grabber = function() {

		var $grabber = this.$attention,
			$btn = this.$btn,
			img_id = this.opts.grabber_id;

		var fn_show = function() {
			removeClass.apply( $grabber, ['schat-active', 'schat-active' ] );
		};

		// Don't show the closed grabber one more
		if( $grabber && this.db.user.last_grabber != img_id ) {

			// Get close button
			var $close = $('.schat-attention .schat-close');

			// Get button "bottom" size
			var btn_bottom = parseInt( this._get_css( $btn, 'bottom' ), 10 ),
				$img = D.getElementById( 'SLC-attention-img' ),
				retina_version_uri = $img.getAttribute( 'data-retina' ) || null;

			// Setup attention "bottom" property
			this.$attention.style.bottom = ( btn_bottom + $btn.offsetHeight + parseInt( this.opts.grabber_offset, 10 ) ) + 'px';
			this.$attention.style.right = ( btn_bottom + $btn.offsetHeight + parseInt( this.opts.grabber_offset, 10 ) ) + 'px';

			// Show retina version
			if( this.retina && retina_version_uri ) {

				this._load_img( retina_version_uri, function( img ) {
					$img.src = img.src;

					fn_show();
				});

			// Show standard version
			} else {
				setTimeout( function() {
					fn_show();
				}, 1000 );
			}

			$close.removeEventListener('click', this._grabber_close );
			$close.addEventListener('click', this._grabber_close.bind(this) );

		}

	};

	/**
	 * Get current form data
	 */
	SChat.prototype.get_form_data = function() {

		var form_fields = $( '.schat-' + this.mode + '-mode .schat-form' ).elements,
			form_data = {},
			$field = {},
			$send_btn = $( '.schat-send-' + this.mode );
			valid_nodes = [ 'INPUT', 'SELECT', 'TEXTAREA' ];

		// Disable the send button
		$send_btn.className += ' schat-disabled';
		
		// Show up "Please wait" notification
		this.ntf( this.opts._wait, 'wait' );

		for( var id in form_fields ) {

			$field = form_fields[id];

			if( $field.value && this._in_array( $field.nodeName, valid_nodes ) ) {

				// Disable fields
				$field.setAttribute( 'disabled', 'disabled' );

				// Get form data
				form_data[$field.name] = $field.value;

			}
		}

		var name_field = form_data['name'],
			email_field = form_data['email'];

		// Update "name" with localdomain part of email if possible
		if( !name_field && email_field ) {
			form_data['name'] = email_field.substring( 0, email_field.indexOf( '@' ) );
		}

		return form_data;

	};

	/**
	 * Re-enable form
	 */
	SChat.prototype.enable_form = function( mode ) {
		var form_fields = $( '.schat-' + mode + '-mode .schat-form' ).elements,
			$send_btn = $( '.schat-send-' + mode );

		removeClass.apply( $send_btn, [ 'schat-disabled' ] );

		for( var id in form_fields ) {

			form_fields[id].disabled = false;

		}
	};

	/**
	 * Validate a form field
	 */
	SChat.prototype.validate = function( $el ) {
		
		var val = '',
			is_req = $el.hasAttribute( 'required' ),
			type = $el.getAttribute( 'type' );

		if( type === 'file' ) {
			val = $el.files[0];
		} else {
			val = $el.value.trim();
		}

		// Clean error(s)
		removeClass.apply( $el, ['schat-error schat-valid'] );

		if( is_req ) {

			// Don't allow required fields empty
			if( val === '' ) {
				$el.className += ' schat-error';
				this.ntf( this.opts._req_field, 'error' );

				return;
	
			// Validate email
			} else if( type === 'email' && !this.is_email( val ) ) {

				$el.className += ' schat-error';
				this.ntf( this.opts._invalid_email, 'error' );

				return;
			}

			// It is validated!
			$el.className += ' schat-valid';

			// Clean notification
			this.hide_ntf();

		}

	};

	/**
	 * Validate email field
	 */
	SChat.prototype.is_email = function( email ) {

		var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

		return re.test(email);

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
	 * Show notification
	 */
	SChat.prototype.ntf = function( msg, type, mode, timeout ) {

		// Refresh mode
		mode = mode || this.mode;

		var self = this,
			$ntf = $( '.schat-ntf-' + mode );

		if( !$ntf ) return;
		
		// Render message
		$ntf.innerHTML = this.render( 'ntf', {
			msg: msg,
			type: type
		});

		// Set classes
		$ntf.className += ' schat-active';

		if( timeout > 0 ) { 
			setTimeout( function() { 
				self.hide_ntf( mode );
			}, timeout ); 
		}

	};

	/**
	 * Hide all notifications
	 */
	SChat.prototype.hide_ntf = function( mode ) {

		// Refresh mode
		mode = mode || this.mode;

		var $ntf = $( '.schat-ntf-' + mode );

		if( !$ntf ) return;

		removeClass.apply( $ntf, ['schat-active'] );
		$ntf.innerHTML = '';

	};

	/**
	 * Refresh user interface (chat widget)
	 */
	SChat.prototype.refresh_ui = function() {

		// Trigger "resize" event on page load
		W.dispatchEvent( new Event( 'resize' ) );

		// Scroll down
		if( this.$cnv ) {
			this.$cnv.scrollTop = 10000
		}
	};

	/**
	 * Mark unread messages as read
	 */
	SChat.prototype.read_msgs = function() {
		
		// Reset count messages
		this.count_new_msgs = 0;

		// Remove new message notification on chat button
		removeClass.apply( this.$btn, ['schat-new-msg'] );

		this._update_w_title();

	};

	/**
	 * Send a post request to the server
	 */
	SChat.prototype.post = function( mode, data, callback ) {
		
		var self = this,
			xhr = new XMLHttpRequest(),
			fd = new FormData();

		xhr.open( "POST", this.opts.ajax_url + '?action=schat_ajax_cb&mode=' + mode, true );

		// Handle response
		xhr.onreadystatechange = function() {

			if ( xhr.readyState == 4 ) {

				// Perfect!
				if( xhr.status == 200 ) {
					if( callback ) { callback( JSON.parse( xhr.responseText ) ); }

				// Something wrong!
				} else {
					if( callback ) { callback( null ); }
				}
			}
		};
		
		// Get data
		for( var k in data ) { fd.append( k, data[k] ) ; }

		// Initiate a multipart/form-data upload
		xhr.send( fd );

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

			// Chat button title
			case 'btn-title':
				arr = [ '<span class="schat-title">' + p + '</span>' ];
				break;

			// Time
			case 'time':
				arr = [ '<span class="schat-last-online" data-time="' + p.ts + '">' + p.date + '</span>' ];
				break;

			// Room message
			case 'chat-msg':
				arr = [ '<div id="SLC-msg-',p.id,'" class="schat-msg schat-msg-',p.id,' ',p.cls,'">',p.avatar,'<div class="schat-msg-wrap"><span class="schat-msg-time">',p.time,'</span><span class="schat-msg-author">',p.name,'</span><span class="schat-msg-content">',p.msg,'</span></div></div>' ];
				break;

			// Room notification
			case 'chat-ntf':
				arr = [ '<div class="schat-msg-ntf schat-msg-ntf-',p.type,'">',p.msg,'</div>' ];
				break;

			// Avatar
			case 'avatar':
				arr = [ '<span class="schat-msg-avatar"><img src="',p,'" alt="" /></span>' ];
				break;

			// Department list item
			case 'department-item':
				arr = [ '<option value="',p.id,'" name="',p.id,'">',p.name,'</option>' ];
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