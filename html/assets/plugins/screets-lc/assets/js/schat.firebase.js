/*!
 * Screets Live Chat - Firebase
 * Author: @screetscom
 *
 * COPYRIGHT © 2016 Screets d.o.o. All rights reserved.
 * This  is  commercial  software,  only  users  who have purchased a valid
 * license  and  accept  to the terms of the  License Agreement can install
 * and use this program.
 */

(function (Firebase) {

    var W = window,
        D = document,
        root = this,
        prev_slc_fb = root.SLC_FB,
        IE =  navigator.userAgent.match(/msie/i),
        SF = ( navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1 );

    /**
     * Firebase
     */
    function SLC_FB( opts ) {

        if( !opts.app_key || !opts.app_auth || !opts.app_db || !opts.app_bucket ) {
            
            if( !opts.is_frontend ) {
                window.location.href = opts.opts_url + '&tab=integrations&schat_err=101';
            }

            return;
        }

        var config = {
            apiKey: opts.app_key,
            authDomain: opts.app_auth,
            databaseURL: opts.app_db,
            storageBucket: opts.app_bucket,
        };
        firebase.initializeApp( config );

        // Firebase reference
        this.ref = firebase.database().ref();
        
        // Synchronously retrieves the current authentication state of the client
        this.auth_data = {};

        // Current user specific data
        this.user = null;
        this.user_id = null;
        this.username = null;
        this.user_avatar = null;
        this.is_op = false;
        this.is_frontend = opts.is_frontend;
        this.is_mobile = false; // "visible", "hidden"

        // Check if mobile user
        if( /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4)) ) {
            this.is_mobile = true;
        }

        // Unique sessions ID
        this.ops = {};
        this.session_id = null;
        this.session = {};

        // Useful IDs and data
        this.chats = {}; // Active chats (asynchronously)
        this.joined_chats = {}; // Joined chats (synchronously)
        this.listening_chats = {}; // Listening chats (asynchronously)
        this.last_msg_ids = {}; // Last new message IDs of chats
        this.prev_msgs = {}; // Previous message(s) for in each chat
        this.resp_counts = {}; // Total number of responses in each chat
        this.resp_times = {}; // All response times in each chat

        // Callback event IDs
        this.events = {};

        // A mapping of operations to re-queue on disconnect.
        this.presence_bits = {};

        // Firebase references (Frequently used)
        this.ref_user = null;
        this.ref_users = this.ref.child( 'users' );
        this.ref_online = this.ref.child( 'online_users' );
        this.ref_msgs = this.ref.child( 'messages' );
        this.ref_chats = this.ref.child( 'chats' );
        this.ref_ops = this.ref.child( 'operators' );
        this.ref_members = this.ref.child( 'members' );
        this.ref_settings = this.ref.child( 'settings' );

        // Setup and establish default options
        this.opts = opts || {};

    }

    // Run the script in "noConflict" mode
    SLC_FB.noConflict = function noConflict() {
        root.SLC_FB = prev_slc_fb;
        return SLC_FB;
    };

    // Export the object as global
    root.SLC_FB = SLC_FB;


    //
    // Internal methods
    // ------------------

    SLC_FB.prototype = {

        /**
         * Load the initial metadata for the user's account 
         * and set initial state
         */
        _load_user_meta : function( on_complete ) {

            var self = this;

            // Update user data with a default name on user's first visit
            self.ref_user.transaction( function( current ) {

                if( !current || !current.id || !current.name ) {
                    
                    return {
                        id : self.user_id,
                        name : self.username,
                        joined_at: firebase.database.ServerValue.TIMESTAMP
                    };
                }

            }, function( error, committed, snap ) {

                if (error) {
                    console.error( 'Transaction failed abnormally!', error );
                } else {

                    // Get user data
                    self.user = snap.val();

                    if( self.user.name ) {
                        self.opts.user.name = self.user.name;
                        self.username = self.user.name;
                    }

                    // Update session data
                    for( var id in self.opts.user ) { self.session[id] = self.opts.user[id]; }

                    // Update current user data
                    self.ref_user.update( self.opts.user );

                    // Try to get geo-location
                    self.get( 'https://geoip.screets.org/api', function( geo ) {

                        if( geo ) {

                            var data = {
                                'city' : ( geo.city !== false ) ? geo.city : '',
                                'country' : geo.country.name,
                                'country_code' : geo.country.code,
                                'lat' : geo.location.latitude,
                                'long' : geo.location.longitude,
                                'time_zone' : geo.location.time_zone
                            };

                            self.session['geo'] = geo;

                            // Update current user session data
                            self.ref_user.child( 'geo' ).update( data );
                            
                        }

                    });

                    // Check if current user is operator
                    self.ref_ops.child( self.user_id ).once( 'value' ).then( function( snap ) {

                        // Update operation info
                        self.ref_user.child( 'is_op' ).set( self.is_op );

                        root.setTimeout( on_complete, 0 );
                    });
                    
                }
            });

        },

        /**
         * Initialize Firebase listeners and callbacks for the supported bindings
         */
        _data_events : function( on_complete ) {

            var self = this;

            // Monitor connection state so we can re-queue 
            // disconnect operations if need be
            this.ref.child('.info/connected').on('value', function(snap) {

                // We're connected (or re-connected)! Set up our presence state
                if( snap.val() === true ) {
                    
                    for( var id in this.presence_bits ) {
                        var operation = this.presence_bits[id];

                        operation.ref.onDisconnect().set( operation.offline_val );
                        operation.ref.set( operation.online_val );
                    }

                    this._on_connect( true );

                // No internet connection or disconnected!
                } else {
                    this._on_connect( false );
                }

            }, this );

            // Generate a unique session id for the visit
            var session_ref = self.ref_user.child('sessions').push();
            self.session_id = session_ref.key;
            self._queue_operation( session_ref, true, null );

            // Register our user in online user's list
            var ref_user_id = self.ref_online.child( self.user_id );
            var ref_session_id = ref_user_id.child(self.session_id);
            self._queue_operation( ref_session_id, {
                id: self.user_id,
                name: self.username
            }, null );

            // Set last activity on disconnect
            self.ref_user.child('last_activity' ).onDisconnect().set( firebase.database.ServerValue.TIMESTAMP );
            
            // Listen for public online operators list
            self.ref_ops.on( 'value', self._on_op_update, self );

            // Listen for state changes for the given user
            self.ref_user.on( 'value', self._on_user_update, self );

            // Listen for chat actions from other users
            self.ref_user.child( 'actions' ).on( 'child_added', self._on_action, self );
            
            // Data events for operators in console
            if( !self.is_frontend ) {

                // Listen new removed online users
                self.ref_online.once( 'value' ).then( function(snap) {

                    self.ref_online.on( 'child_added', self._on_new_online.bind( self ) );
                    self.ref_online.on( 'child_removed', self._on_removed_online.bind( self ) );
                    // Listen user updates, so we can update online list
                    self.ref_users.on( 'child_changed', self._on_update_online.bind( self ) );

                });

                // Listen settings updates
                self.ref_settings.child( this.user_id ).on( 'value', self._on_update_setting.bind( self ) );

                // Listen all chats in reverse order
                self.ref_chats.on( 'value', self._on_chat_history.bind( self ) );
            }

        },

        /**
         * Event to monitor current connection info
         */
        _on_connect : function( is_connected ) {

            this._invoke( 'on-connect', is_connected );

        },

        /**
         * Event to monitor online user updates
         */
        _on_new_online : function( snap ) {
            this._invoke( 'online-new', /* user_id */ snap.key );
        },
        _on_update_online : function( snap ) {
            this._invoke( 'online-update', /* user_data */ snap.val() );
        },
        _on_removed_online : function( snap ) {
            this._invoke( 'online-remove', /* user_id */ snap.key );
        },

        /**
         * Event to monitor online operators
         */
        _on_op_update : function( snap ) {
            this.ops = snap.val();
            this._invoke( 'op-update', this.ops );
        },

        /**
         * Event to monitor current user state
         */
        _on_user_update : function( snap ) {
            this.user = snap.val();
            this._invoke( 'user-update', this.user );
        },

        /**
         * Event to monitor chat actions
         */
        _on_listen_chat : function( chat ) { this._invoke( 'chat-listen', chat ); },
        _on_update_chat : function( chat ) { this._invoke( 'chat-update', chat ); },
        _on_join_chat : function( chat ) { 
            // Remove typing value on disconnect
            // It's useful when user exit page immediately after typing
            this.ref_chats.child( chat.id + '/typing/' + this.user_id ).onDisconnect().remove();

            this._invoke( 'chat-join', chat ); 
        },
        _on_leave_chat : function( chat_id ) { this._invoke( 'chat-exit', chat_id ); },
        _on_new_msg : function( chat_id, snap ) { 
            var msg = snap.val();
            msg.id = snap.key;
            this._invoke( 'msg-new', chat_id, msg ); 
        },
        _on_removed_msg : function( chat_id, snap ) { 
            var msg_id = snap.key;
            this._invoke( 'msg-remove', chat_id, msg_id ); 
        },

        /* Event to monitor all chats history */
        _on_chat_history : function( snap ) {
            this._invoke( 'chat-history', snap.val() );
        },

        /* Event to monitor user settings updates */
        _on_update_setting : function( snap ) {
            this._invoke( 'setting-update', snap.val() );
        },
        /**
         * Event to monitor current authentication & user state
         */
        _on_auth_required : function() {
            this._invoke( 'auth-required' );
        },

        /**
         * Events to monitor chat actions
         */
        _on_action : function( snap ) {
            var self = this,
                action = snap.val();

            // Skip actions we've already responded to
            if( action.status ) {
                return;
            }

            action.id = action.id || snap.key;
            self.get_chat( action.chat_id, function( chat ) {
                chat.to_chat_name = chat.name;
                self._invoke( 'chat-action', action );
            });

        },

        /**
         * Events to monitor chat action responses
         */
        _on_action_response : function( snap ) {
            var self = this,
                action = snap.val();

            action.id = action.id || snap.key;
            self._invoke( 'chat-action-response', action );
        },

        /**
         * Append the new callback to our list of event handlers
         */
        _add_event_cb : function( event_id, callback ) {
            this.events[event_id] = this.events[event_id] || [];
            this.events[event_id].push( callback );
        },

        /**
         * Retrieve the list of event handlers for a given event id
         */
        _get_event_cb : function( event_id ) {
            if (this.events.hasOwnProperty(event_id)) {
                return this.events[event_id];
            }
            return [];
        },

        /**
         * Invoke each of the event handlers for a given 
         * event id with specified data
         */
        _invoke : function( event_id ) {
            var args = [],
                callbacks = this._get_event_cb( event_id );

            Array.prototype.push.apply( args, arguments );
            args = args.slice(1);

            for ( var i = 0; i < callbacks.length; i += 1 ) {
                callbacks[i].apply( null, args );
            }
        },

        /**
         * Keep track of on-disconnect events so they can be requeued 
         * if we disconnect the reconnect
         */
        _queue_operation : function( ref, online_val, offline_val ) {
            
            ref.onDisconnect().set( offline_val );
            ref.set( online_val );
            this.presence_bits[ref.toString()] = {
                ref: ref,
                online_val: online_val,
                offline_val: offline_val
            };

        },

        /**
         * Remove an on-disconnect event from firing upon 
         * future disconnect and reconnect
         */
        _remove_operation : function( path, value ) {
            var ref = firebase.database().refFromURL( path );
            ref.onDisconnect().cancel();
            ref.set(value);

            delete this.presence_bits[path];
        }

    };

    //
    // External methods
    // ------------------

    /**
     * Initialize the library and setup data listeners
     */
    SLC_FB.prototype.set_user = function( user_id, username, callback ) {

        var self = this;

        firebase.auth().onAuthStateChanged( function( user ) {

            if( user ) {
                self.auth_data = user;
                self.user_id = user_id.toString();
                self.username = username.toString();
                self.user_avatar = self.opts.user.avatar;
                self.ref_user = self.ref.child('users').child( self.user_id );
                self.is_op = ( schat_opts.console_url ) ? true : false;

                if( user.uid && self.is_op ) {
                    
                    var ref_op_user_id = self.ref_ops.child( self.user_id );

                    // Add user into operators list
                    if( !self.is_frontend && self.is_op ) {
                        self._queue_operation( ref_op_user_id, true, null );
                    
                    // Remove junk operation
                    } else if( !self.is_frontend ) {
                        self._remove_operation( ref_op_user_id.toString(), null );
                    }
                
                }

                // Get user meta data
                self._load_user_meta(function() {
                    root.setTimeout(function() {
                        
                        callback( self.user );

                        self._data_events();

                    }, 0);
                });

            } else {
                self.warn( 'Firebase requires authenticated Firebase reference' );
            }
        });
       
    };

    /**
     * Resumes the previous session by automatically entering chats
     */
    SLC_FB.prototype.resume_session = function() {
        var self = this;

        this.ref_user.child('chats').once( 'value' ).then( function( snap ) {
            var chats = snap.val();

            for( var chat_id in chats ) {
                self.join_chat( chats[chat_id].id );
            }

        } );
    };

    /**
     * Login to Firebase
     */
    SLC_FB.prototype.login = function( type, onError ) {

        var self = this;

        switch( type ) {

            case 'anonymously':

                firebase.auth().signInAnonymously().catch( onError );

                break;

            case 'custom':

                firebase.auth().signInWithEmailAndPassword( 'admin@screets.com', 'LovePi17' ).catch( onError );

                break;

        }

    };

    /**
     * Delete users to restart chat
     */
    SLC_FB.prototype.reset = function( callback ) {

        var self = this;

        this.ref.child('users').remove( function() {

            self.ref.child('online_users').remove();
            self.ref.child('operators').remove();
            
        });

    };

    /**
     * Clean up database
     */
    SLC_FB.prototype.cleanup = function() {
        
        var self = this;

        // Remove old users
        self.ref_users.once( 'value' ).then( function(snap) {

            var now = new Date().getTime(),
                users = snap.val(),
                user = {},
                diff = 0,
                diff_min = 0;

            if( users ) {
                for( var id in users ) {
                    diff = 0;
                    diff_min = 0;
                    user = users[id];

                    if( user.last_activity ) {
                        diff = now - user.last_activity,
                        diff_min = diff/60000;
                    }

                    if( ( user.email && user.email === self.opts.user.email ) || !user.id || !user.name || diff_min > 24*60 ) {
                        self.ref_users.child(id).remove();
                        self.ref_online.child(id).remove();
                        self.ref_ops.child(id).remove();
                    }

                }
            }

            // if( !user.id || !user.name || ( user.last_activity && user.last_activity < now ) 
        });

        // Check if online operators are still connected!
        self.ref_ops.once( 'value' ).then( function( snap ) {

            if( snap.exists() ) {
                var ops = snap.val();
                
                for( var op_id in ops ) {

                    // Check only other operators
                    if( op_id !== self.user_id ) {

                        // Offline operator if no session
                        self.ref_users.child(op_id).once( 'value' ).then( function(snap) {
                            if( snap.exists() ) {
                                var user = snap.val();

                                if( !user.id || !user.sessions ) {
                                    self.ref_ops.child( user.id ).remove();
                                }
                            } else if( user ) {
                                self.ref_ops.child( user.id ).remove();
                            }

                        });
                        
                    }
                }
            }
        });

    };

    /**
     * Logout
     */
    SLC_FB.prototype.logout = function() {

        firebase.auth().signOut();

        W.location.reload();

    };


    /**
     * Synchronously check authentication state
     */
    SLC_FB.prototype.is_logged = function() {
        
        if( this.auth_data.length > 0 ) {
            return true;
        } else {
            return false;
        }

    };

    /**
     * Create and automatically enter a new chat
     */
    SLC_FB.prototype.create_chat = function( chat_data, chat_type, callback ) {
        var self = this,
            ref_new_chat = this.ref_chats.push(),
            new_chat_id = ref_new_chat.key;

        var new_chat = {
            id: new_chat_id,
            name: chat_data.name,
            type: chat_type,
            created_by: this.username,
            created_at: firebase.database.ServerValue.TIMESTAMP
        };

        // Include session data if this user is visitor
        if( !self.is_op ) {
            for( var id in chat_data ) {
                self.session[id] = chat_data[id];
            }

            new_chat.session = self.session;
        }

        // Authorize the user (if not public chat)
        if( chat_type === 'private' ) {
            new_chat.authorized = {};
            new_chat.authorized[this.user_id] = true;
        }

        ref_new_chat.set( new_chat ).then( function() {
            self.join_chat( new_chat_id );

            if( callback ) { 
                callback( new_chat_id ); 
            }
        })
        .catch( function( error ) {

            console.error(error);

        });

    };

    /**
     * Join a chat
     */
    SLC_FB.prototype.join_chat = function( chat_id ) {
        var self = this;

        // Save chat_id synchronously to check "this.chats[chat_id]" data 
        // from somewhere in application
        self.joined_chats[chat_id] = true;

        // Get chat data and join
        self.get_chat( chat_id, function( chat ) {

            var chat_name = chat.name;

            if( !chat.id || !chat_name ) return;

            // Skip if we already in this chat
            if( self.chats[chat.id] ) return;

            self.chats[chat.id] = true;

            // Save entering this chat to resume the session again later
            if( self.user ) {
                self.ref_user.child('chats').child(chat.id).set({
                    id: chat.id,
                    name: chat_name,
                    active: true
                });
            }

            // Set presence bit for the chat and queue it for removal on disconnect
            self._queue_operation( self.ref.child( 'members/' + chat.id + '/' + self.user_id + '/' + self.session_id ), {
                id: self.user_id,
                name: self.username
            }, null);

            // Include session data if this user is visitor
            // (it's usually used when visitor invited to the chat by operator
            // and the session needs to be updated)
            if( !self.is_op ) {

                var chat_data = {
                    name: self.username, // Update chat name
                    session: self.session // Update chat session data
                }
                // Update chat session
                self.ref_chats.child( chat_id ).update( chat_data, function() {

                    // Invoke our callbacks before we start listening for new messages
                    self._on_join_chat(chat);

                    // Setup message listeners
                    self.listen_chat( chat.id );

                });

            } else {

                // Invoke our callbacks before we start listening for new messages
                self._on_join_chat(chat);

                // Setup message listeners
                self.listen_chat( chat.id );
            }

        });
    };

    /**
     * Listen a chat (setup message listeners)
     */
    SLC_FB.prototype.listen_chat = function( chat_id ) {

        var self = this;

        if( self.listening_chats[chat_id] ) return;

        var ref_chat = self.ref_chats.child(chat_id);

        // Invoke our callbacks before for listening chat for new messages
        self._on_listen_chat( chat_id );

        ref_chat.on( 'value', function(snap) {
            self._on_update_chat( snap.val() );
        });

        ref_chat.once('value').then( function(snap) {

            var ref_chat_msgs = self.ref_msgs.child(chat_id).limitToLast(parseInt(self.opts.max_msgs,10));

            // New messages
            ref_chat_msgs.on('child_added', function(snap) {
                self._on_new_msg( chat_id, snap );
            }, /* onCancel */ function() {
                // Turns out we don't have permission to access these messages
                self.leave_chat( chat_id );
            }, self );

            // Removed messages
            ref_chat_msgs.on('child_removed', function(snap) {
                self._on_removed_msg( chat_id, snap );
            }, /* onCancel */ function(){}, self );
            
            self.listening_chats[chat_id] = true;


        }, /* onFailure */ function(){}, self );

    };

    /**
     * Leave a chat
     */
    SLC_FB.prototype.leave_chat = function( chat_id ) {
        var self = this;

        // Remove listener for new messages of this chat
        self.ref_msgs.child(chat_id).off();

        if( self.user ) {
            var ref_member = self.ref_members.child( chat_id + '/' + self.user_id + '/' + self.session_id );

            // Remove presence bit for the chat and cancel on-disconnect removal
            self._remove_operation( ref_member.toString(), null );

            // Remove session bit for the chat
            self.ref_user.child('chats').child(chat_id).remove();

            // Set this chat is ended
            self.ref_chats.child( chat_id + '/is_ended' ).set(true);

        }

        delete self.chats[chat_id];

        // Invoke event callbacks for the chat-exit event
        self._on_leave_chat( chat_id );

    };

    /**
     * Get chat data
     */
    SLC_FB.prototype.get_chat = function( chat_id, callback ) {
        this.ref_chats.child( chat_id ).once( 'value' ).then( function( snap ) {
            callback( snap.val() );
        });
    };

    /**
     * Get chat messages
     */
    SLC_FB.prototype.get_msgs = function( chat_id, callback ) {
        this.ref_msgs.child( chat_id ).once( 'value' ).then( function( snap ) {
            callback( snap.val() );
        });
    };

    /**
     * Push message
     */
    SLC_FB.prototype.push_msg = function( chat_id, msg, msg_type, callback, onError ) {
        var self = this;

        var data = {
            user_id: self.user_id,
            name: self.username,
            timestamp: firebase.database.ServerValue.TIMESTAMP,
            msg: msg,
            avatar: self.user_avatar,
            type: msg_type || 'default'
        };

        // Update data by message type
        if( msg_type === 'auto-ntf' ) {
            data.user_id = 'system';
            data.avatar = '';
            data.name = 'System';
        }

        if( !self.user ) {
            self._on_auth_required();
            if( callback ) { callback( new Error('Not authenticated user!') ); }
            return;
        }

        var ref_new_msg = self.ref_msgs.child(chat_id).push();
        ref_new_msg.setWithPriority( data, firebase.database.ServerValue.TIMESTAMP ).then( callback ).catch( onError );
    
    };

    /**
     * Delete a message
     */
    SLC_FB.prototype.delete_msg = function( chat_id, msg_id, callback ) {
        this.ref_msgs.child( chat_id ).child( msg_id ).remove( callback );
    };

    /**
     * Delete chat and all related data (included messages)
     */
    SLC_FB.prototype.delete_chat = function( chat_id, callback ) {
        
        var self = this;

        this.ref_chats.child(chat_id).once('value').then( function(snap) {

            if( snap.exists() ) {
                var chat = snap.val();

                // Remove authorized users chats
                if( chat.authorized ) {
                    for( var user_id in chat.authorized ) {
                        self.ref_users.child( user_id + '/chats/' + chat_id ).remove();
                    }
                }

                // Remove related data
                self.ref_chats.child( chat_id ).remove();
                self.ref_msgs.child( chat_id ).remove();
                self.ref_members.child( chat_id ).remove();

                callback(true);

            // Not exists already
            } else {
                callback(true);
            }
        });
    };

    /**
     * Mute or unmute a given user by id. This list will be stored internally and
     * all messages from the muted clients will be filtered client-side after
     * receipt of each new message
     */
    SLC_FB.prototype.toogle_user_mute = function( user_id, callback ) {
        var self = this;

        if( !self.user ) {
            self._on_auth_required();
            if( callback ) { callback( new Error('Not authenticated user!') ); }
            return;
        }

        self.ref_user.child('muted').child(user_id).transaction( function(is_muted) {
            return (is_muted) ? null : true;
        }, callback );

    };

    /**
     * Callback registration. Supports each of the following events
     */
    SLC_FB.prototype.on = function( event_type, callback ) {
        this._add_event_cb( event_type, callback );
    };

    /**
     * Operator 
     */
    SLC_FB.prototype.op_conn = function( new_status, callback ) {

        var ref = this.ref_ops.child( this.user_id );

        if( new_status == 'online' ) {
            ref.set( true ).then( callback );
        } else {
            ref.remove(callback);
        }

    };

    /**
     * Update a specific user data
     */
    SLC_FB.prototype.update_user = function( user_id, data, callback ) {
        
        this.ref_users.child( user_id ).update( data, callback );

    };

    /**
     * Create an action
     */
    SLC_FB.prototype.create_action = function( type, user_id, chat_id ) {
        var self = this;

        var fn_send_action = function() {
            var ref_action = self.ref_users.child(user_id).child('actions').push();

            ref_action.set({
                type            : type,
                id              : ref_action.key,
                from_user_id    : self.user_id,
                from_username   : self.username,
                chat_id         : chat_id
            });

            // Handle listen unauth / failure in case we're kicked
            ref_action.on( 'value', self._on_action_response, function(){}, self );
        };

        if( !self.user ) {
            self._on_auth_required();
            return;
        }

        self.get_chat( chat_id, function(chat) {

            // Private chat
            if( chat.type === 'private' ) {

                // Ensure that action receiver is also authorized in the chat
                self.ref_chats.child(chat_id + '/authorized/' + user_id).set( true ).then( function() {
                    fn_send_action();
                });

            // Other types of chat
            } else {
                fn_send_action();
            }
        });
    };

    /**
     * Response action request
     */
    SLC_FB.prototype.response_action = function( action_id, status, callback ) {
        
        var self = this;

        self.ref_user.child('actions').child( action_id ).once( 'value' ).then( function( snap ) {
            var action = snap.val();

            if( action === null && callback ) {
                return callback( new Error( 'response_action('+action_id+'): Invalid action id' ) );
            } else {
                self.ref_user.child('actions').child( action_id ).update({
                    'status' : status,
                    'to_user_name': self.username
                }, callback );
            }
        });
    };

    /**
     * Update a parameter for current user
     */
    SLC_FB.prototype.set_param = function( name, value, callback ) {

        if( this.user ) {
            this.ref_user.child('params/' + name).set( value ).then( callback );
        }

    };
    
    /**
     * Update a parameter for a specific chat
     */
    SLC_FB.prototype.set_chat_param = function( chat_id, name, value, callback ) {

        this.ref_chats.child( chat_id + '/params/' + name ).set( value).then( callback );

    };

    /**
     * Current user's typing info
     */
    SLC_FB.prototype.typing = function( active, chat_id ) {
        var ref = this.ref_chats.child( chat_id + '/typing/' + this.user_id );

        if( active ) {
            ref.set({
                id: this.user_id,
                name: this.username 
            }); 
            return;
        }

        ref.remove();


    };

    /**
     * Update a setting
     */
    SLC_FB.prototype.setting = function( name, val, obj, callback ) {
        
        if( obj.type === 'checkbox' ) {
            val = obj.checked || null;
        } else {
            val = val || null;
        }

        this.ref_settings.child( this.user_id + '/' + name ).set( val, callback );
    };

    /**
     * Get user settings
     */
    SLC_FB.prototype.get_settings = function( callback ) {

        this.ref_settings.child( this.user_id ).once( 'value' ).then( function( snap ) {
            var settings = snap.val();
            
            callback( settings );
        });

    };

    /**
     * Browser console message
     */
    SLC_FB.prototype.warn = function( msg ) {
        
        if ( console ) {
            msg = 'Firechat Warning: ' + msg;
            if (typeof console.warn === 'function') {
                console.warn(msg);
            } else if (typeof console.log === 'function') {
                console.log(msg);
            }
        }
    };

    /**
     * Mark as read current message(s)
     */
    SLC_FB.prototype.read = function( chat_id, last_msg_time ) {
        this.ref_chats.child( chat_id + '/read_msgs/' + this.user_id ).set( last_msg_time );
    };

    /**
     * Send a get request to the server
     */
    SLC_FB.prototype.get = function( url, success, fail ) {
        
        var self = this,
            xhr = new XMLHttpRequest();

        xhr.open( "GET", url, true );

        // Handle response
        xhr.onreadystatechange = function() {

            if ( xhr.readyState == 4 ) {

                // Perfect!
                if( xhr.status == 200 ) {
                    if( success ) { success( JSON.parse( xhr.responseText ) ); }

                // Something wrong!
                } else {
                    if( fail ) { fail( null ); }
                }
            }
        };
        
        // Initiate request
        xhr.send( null );

    };

})(firebase);