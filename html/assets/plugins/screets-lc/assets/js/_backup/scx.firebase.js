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
        prev_schat_fb = root.SLC_FB,
        IE =  navigator.userAgent.match(/msie/i),
        SF = ( navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1 );

    /**
     * Firebase
     */
    function SLC_FB( opts ) {

        // Firebase reference
        this.ref = new Firebase( 'https://' + opts.app_id + '.firebaseIO.com/' );

        // Current user specific data
        this.user = null;
        this.user_id = null;
        this.user_name = null;
        this.is_op = false;
        this.is_frontend = opts.is_frontend;
        this.is_mobile = false; // "visible", "hidden"

        // Check if mobile user
        if( /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4)) ) {
            this.is_mobile = true;
        }

        // Unique sessions ID
        this.session_id = null;
        this.session = null; // Session data

        // Useful IDs and data
        this.chats = {}; // Active chats
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
        this.ref_msgs = this.ref.child( 'messages' );
        this.ref_chats = this.ref.child( 'chats' );
        this.ref_ops = this.ref.child( 'operators' );
        this.ref_members = this.ref.child( 'members' );

        // Setup and establish default options
        this.opts = opts || {};

    }

    // Run the script in "noConflict" mode
    SLC_FB.noConflict = function noConflict() {
        root.SLC_FB = prev_schat_fb;
        return SLC_FB;
    };

    // Export the object as global
    root.SLC_FB = SLC_FB;


    //
    // Internal methods
    // ------------------

    SLC_FB.prototype = {

        /**
         * Authenticate user by type
         */
        _auth : function( type, callback ) {

            switch( type ) {

                // Anonymous authentication
                case 'anonymously':
                    this.ref.authAnonymously( function( err, auth ) {
                        callback( err, auth );
                    });
                    break;

                // Email/password authentication
                case 'password':
                    this.ref.authWithPassword( {
                        email: this.opts.email,
                        password: this.opts.pass
                    }, function( err, auth ) {
                        if( err ) {
                            console.error(err);
                        }
                        callback( err, auth );
                    });
                    break;

                // Custom authentication
                case 'custom':
                    this.ref.authWithCustomToken( this.opts.token, function( err, auth ) {
                        if( err ) {
                            console.error(err);
                        }
                        callback( err, auth );
                    });
                    break;
            }

        },

        /**
         * Setup user data
         */
        _load_user : function( callback ) {

            var self = this;

            // 
            // Update current user data on first visit
            // 
            self.ref_user.transaction( function( current ) {

                if( !current || !current.id || !current.name ) {

                    var user_data = self.opts.user;

                    // Add additional user data
                    user_data.id = self.user_id;
                    user_data.name = self.user_name;
                    user_data.is_op = self.is_op;
                    user_data.is_mobile = self.is_mobile;

                    return user_data;

                } 

            // 
            // Get current user's data
            // 
            }, function( err, committed, snap ) {
                
                if( err ) {
                    // Refresh the page, Firebase can't connect
                    // FIXME: Find better way to re-connect Firebase instead of refreshing
                    W.location.reload();

                    return;
                }

                // Get user data
                self.user = snap.val();

                var user_data = self.opts.user;

                // Update operator info
                user_data.is_op = self.is_op;

                // Update user name (keep the current one)
                if( self.is_op && !self.is_frontend ) {
                    user_data.name = self.opts.user.name; // Get original operator name
                } else {
                    user_data.name = self.user.name || self.opts.user.name;
                }
                
                // Log user in automatically if pre-chat isn't required
                if( !self.user.logged && self.user.chats && !self.opts.show_prechat ) {
                    user_data.logged =  true;
                }

                // Update some extra user data on every page visit
                self.ref_user.update( user_data );

                // Invoke callback
                root.setTimeout( callback, 0 );

                // Current user is operator?
                /*self.ref_ops.child( self.user_id ).once( 'value', function( snap ) {

                    self.is_op = !!snap.val();


                });*/


            } );
        },

        /**
         * Create new unique session
         */
        _new_session : function() {

            // Create unique session for the visit
            var ref_session = this.ref_user.child( 'sessions' ).push();

            var self = this,
                data = this.opts.session || {};

            data.location = ( this.is_frontend ) ? 'frontend' : 'backend';
            data.created_at = Firebase.ServerValue.TIMESTAMP;
            data.ip = this.opts.ip || null;
            data.is_mobile = self.is_mobile || null;

            // Update session data
            this.session = data;

            this.session_id = ref_session.key();
            this._queue_presence( ref_session, data, null );

            this.get( 'https://geoip.screets.org/api', function( geo ) {

                if( geo ) {

                    var data = {
                        'city' : geo.city,
                        'country' : geo.country.name,
                        'country_code' : geo.country.code,
                        'lat' : geo.location.latitude,
                        'long' : geo.location.longitude,
                        'time_zone' : geo.location.time_zone
                    };

                    // Update session data
                    self.session.geo = data;

                    // Update current user session data
                    self.ref_user.child( 'sessions' ).child(self.session_id).child('geo').update( data );
                    
                }
            });

        },

        /**
         * Initialize Firebase listeners and callbacks
         */
        _data_events : function() {

            var self = this;


            // Presence (Monitor current user connections)
            this.ref.root().child('.info/connected').on( 'value', function( snap ) {

                // Connected (or re-connected)!
                if( snap.val() === true ) {

                    // Create new session if not any session exists for the current user
                    self.ref_user.child( 'sessions' ).once( 'value', function(snap_session) {
                        if( !snap_session.exists() ) {
                            self._new_session();
                        }
                    });

                    // Set operator online
                    if( self.is_op && !self.is_frontend ) {
                        self._queue_presence( self.ref_ops.child( self.user_id ), true, null );
                        self._queue_presence( self.ref_user.child( 'online_op' ), true, null );
                    }

                    // Resume session
                    self.resume_session();

                // Disconnected
                } else {
                    // Clear active data to be re-connected again
                    self.chats = {};
                }

            }, this);

            // Create a unique session
            this._new_session();

            // Listen current user's state changes
            this.ref_user.on( 'value', this._on_user_update, this );

            // Listen users list updates
            this.ref_users.on( 'value', this._on_users_list_update, this );
            this.ref_users.on( 'child_removed', this._on_user_remove, this );

            // Check online operators
            this.ref_ops.on( 'value', this._on_op_update, this );

            // Listen for chat invitations from operators
            this.ref_user.child( 'actions' ).on( 'child_added', this._on_action, this );

            // Listen notifications
            this.ref_user.child( 'notifications' ).on( 'child_added', this._on_ntf, this );

        },

        /**
         * Keep track of on-disconnect events so they can be re-queued if we disconnect the reconnect
         */
        _queue_presence : function( ref, online_val, offline_val ) {

            // Set offline value on disconnect
            ref.onDisconnect().set( offline_val );

            // Set online value
            ref.set( online_val );

            // Update presence bits data
            this.presence_bits[ ref.toString() ] = {
                ref: ref,
                online_val: online_val,
                offline_val: offline_val
            };

        },

        /**
         * Remove an on-disconnect event from firing upon future disconnect and reconnect
         */
        _remove_presence : function( path, value ) {

            var ref = new Firebase( path );

            ref.onDisconnect().cancel();
            ref.set( value );

            // Remove from presence data
            delete this.presence_bits[path];

        },

        /**
         * Event to monitor chat actions
         */
        _on_action : function( snap ) {

            var self = this,
                action = snap.val();

            // Skip actions we've already responded to
            if( action.status )
                return;

            // Set action ID
            action.id = action.id || snap.key();

            self.get_chat( action.chat_id, function( chat ) {

                // Get chat name
                action.to_chat_name = chat.name;

                // Invoke the event
                self._invoke( 'chat-action', action );

            });

        },

        /**
         * Event to monitor chat action replies
         */
        _on_action_response : function( snap ) {

            var action = snap.val();

            if( action ) {

                // Set action ID
                action.id = action.id || snap.key();

                // Invoke the event
                this._invoke( 'chat-action-response', action );
                
            }

        },

        /**
         * Event to listen for messages
         */
        _on_ntf : function( snap ) {

            var ntf = snap.val();

            if( !ntf.read ) {

                // Mark as read
                snap.ref().child( 'read' ).set( true );

                // Invoke the event
                this._invoke( 'ntf', ntf );
            }

        },

        /**
         * Event to monitor current user state
         */
        _on_user_update : function( snap ) {

            // Update user data
            this.user = snap.val();

            // Update visitor data
            if( this.user && ( !this.is_op || this.is_frontend ) ) {
                
                var user_basic = {
                        id: this.user.id,
                        name: this.user.name,
                        avatar: this.user.avatar
                    },
                    ref_chat, 
                    user_val;

                // Get basic user data
                for( var id in this.user ) {
                    user_val = this.user[id];

                    // Only get data those id start with "_" prefix
                    if( id.charAt(0) === '_' ) {
                        user_basic[id.substr(1)] = user_val;
                    }
                }

                // Update visitor data in chat(s)
                if( this.user.chats ) {
                    for( var chat_id in this.user.chats ) {
                        this.ref_chats.child( chat_id ).child('visitor').set(user_basic);
                    }
                }

            }

            // Invoke the event
            this._invoke( 'user-update', this.user );

        },

        /**
         * Event to monitor current users list state
         */
        _on_users_list_update : function( snap ) {

            // Invoke the event
            this._invoke( 'users-list-update', snap.val() );

        },

        /**
         * Event to monitor current users list state
         */
        _on_user_remove : function( snap ) {

            // Invoke the event
            this._invoke( 'user-remove', snap.val() );

        },

        /**
         * Event to monitor online operators state
         */
        _on_op_update : function( snap ) {

            // Invoke the event
            this._invoke( 'op-update', snap.val() );

        },

        /**
         * Event to monitor join chat
         */
        _on_chat_join : function( chat ) {

            // Invoke the event
            this._invoke( 'chat-join', chat );

        },

        /**
         * Event to monitor chat updates
         */
        _on_chat_update : function( snap ) {
            
            var chat_id = snap.key(),
                chat = snap.val();

            if( chat_id in this.chats ) {

                this.chats[chat_id] = chat;

                // Invoke the event
                this._invoke( 'chat-update', chat );
                
            }

        },

        /**
         * Event to monitor exit chat
         */
        _on_chat_exit : function( chat_id ) {

            // Invoke the event
            this._invoke( 'chat-exit', chat_id );

        },

        /**
         * Event to monitor new members
         */
        _on_member_join : function( snap ) {

            // Invoke the event
            this._invoke( 'member-join', snap.val() );

        },

        /**
         * Event to monitor removed members
         */
        _on_member_exit : function( snap ) {

            // Invoke the event
            this._invoke( 'member-exit', snap.val() );

        },

        /**
         * Event to monitor new messages
         */
        _on_new_msg : function( chat_id, snap ) {

            var self = this,
                msg = snap.val(),
                prev_msg = this.prev_msgs[chat_id],
                last_msg_id = this.last_msg_ids[chat_id] || null;

            // Get message ID
            msg.id = snap.key();

            // Is it unread message?
            var is_unread = ( !last_msg_id && msg.user_id != this.user_id ) ? true : false;

            // Get chat data
            var chat = this.chats[chat_id];

            // Remove last message id, so all further messages will be unread
            if( last_msg_id === msg.id ) {
                delete this.last_msg_ids[chat_id];
            }

            // If previous message belongs to visitor and current message from operator,
            // increase the response count
            if( this.is_op && prev_msg && chat.visitor && prev_msg.user_id == chat.visitor.id && msg.user_id == this.user_id ) {

                var new_resp_time = msg.time - prev_msg.time;

                // Increase response count
                this.resp_counts[chat_id] += 1;

                // Insert new response time
                this.resp_times[chat_id].push( new_resp_time );

                if( !last_msg_id ) { // if unread message
                    
                    var ref_response_time = this.ref_chats.child(chat_id).child('response_time');
                    var count = this.resp_counts[chat_id] - 1;

                    // Set first response time
                    ref_response_time.child('first').transaction( function( current ) {
                        
                        if( !count ) { return new_resp_time; }

                    });

                    // Set maximum response time
                    ref_response_time.child('max').transaction( function( current ) {
                        
                        if( self.resp_times[chat_id] ) {
                            return Math.max.apply( Math, self.resp_times[chat_id] );
                        }

                    });

                    // Calculate average
                    ref_response_time.child('avg').transaction( function( current_avg ) {
                        
                        // Calculate average of the response time
                        return ( current_avg * count + new_resp_time ) / ( count + 1 );

                    });
                    
                }

            }

            // Update previous message
            this.prev_msgs[chat_id] = msg;

            // Visitor message
            if( chat.visitor && chat.visitor.id === msg.user_id ) {
                
                // Update last visitor message
                // this.last_vis_msgs[chat_id] = msg;

            // Operator message
            } else {

                /*var last_vis_msg = this.last_vis_msgs[chat_id],
                    resp_count = this.resp_counts[chat_id];

                // Calculate response time
                if( is_unread && last_vis_msg ) {

                    var ref_avg = this.ref_chats.child(chat_id).child('response_time').child('avg');

                    ref_avg.transaction( function( current_avg ) {

                        var now = new Date().getTime(),
                            new_resp_time = now - last_vis_msg.time;


                        // Calculate average of response time
                        var avg = ( current_avg * resp_count + new_resp_time ) / ( resp_count + 1 );

                        return Math.round( avg/1000 ); // Return as seconds
                    
                    });


                    // Clean last visitor message 'cause it's responded
                    delete this.last_vis_msgs[chat_id];

                    // Increase response count
                    this.resp_counts[chat_id] += 1;
                }*/

            }

            // Invoke the event
            this._invoke( 'msg-new', chat_id, msg, is_unread );

        },

        /**
         * Event to monitor deleted messages
         */
        _on_del_msg : function( chat_id, snap ) {

            var msg = snap.val();
            msg.id = snap.key();

            // Invoke the event
            this._invoke( 'msg-del', chat_id, msg );

        },

        /**
         * Event to monitor current authentication state
         */
        _on_auth_required : function() {

            // Invoke the event
            this._invoke( 'auth-req' );

        },

        /**
         * Get event handlers
         */
        _get_events : function( event_id ) {

            if( this.events.hasOwnProperty( event_id ) ) {
                return this.events[event_id];
            }

            return [];

        },

        /**
         * Invoke the event handlers
         */
        _invoke : function( event_id ) {

            var args = [],
                callbacks = this._get_events( event_id );

            Array.prototype.push.apply( args, arguments );
            args = args.slice(1);

            for ( var i = 0; i < callbacks.length; i += 1 ) {
                callbacks[i].apply( null, args );
            }

        },

        /**
         * Append the new callback to our list of event handlers
         */
        _add_event_cb : function( event_id, callback ) {

            this.events[ event_id ] = this.events[ event_id ] || [];
            this.events[ event_id ].push( callback );

        },

        /**
         * Retrieve the list of event handlers for a given event id
         */
        _get_event_cb : function( event_id ) {

            if( this.events.hasOwnProperty( event_id ) ) {
                return this.events[ event_id ];
            }

            return [];

        }

    };

    //
    // External methods
    // ------------------

    /**
     * Authenticate current user
     */
    SLC_FB.prototype.auth = function( type, callback, is_op ) {

        var auth = this.ref.getAuth();

        // Get current authentication
        if( auth ) {

            // Ensure that user is authenticating as operators
            /*if( is_op && !this.is_frontend && !auth.auth.is_op ) {
                this.ref.unauth();

                // Create new authentication
                this._auth( type, callback );
            
            } else {
            }*/


            callback( null, auth );

        // Create new authentication
        } else {

            this._auth( type, callback );

        }
    };

    /**
     * Logout current user completely (un-authenticate)
     */
    SLC_FB.prototype.unauth = function( callback ) {

        this.ref.unauth();

        if( callback ) {
            callback();
        }

    };

    /**
     * Set operator connection status
     * If "user_id" defined, a specific op's status will be updated
     */
    SLC_FB.prototype.op_conn = function( status, user_id ) {

        if( !user_id && ( !this.is_op || this.is_frontend ) ) { return; }

        // Update a specific operator status
        if( user_id ) {

            var ref_op = this.ref_ops.child( user_id ),
                ref_online_op = this.ref_users.child(user_id).child('online_op');

            if( status === 'online' ) {
                ref_op.set(true);
                ref_online_op.set(true);

            } else {

                if( ref_op ) ref_op.remove();
                if( ref_online_op ) ref_online_op.set(false);
            }

        // Update current operator status
        } else {


            if( status === 'online' ) {
                Firebase.goOffline();
                Firebase.goOnline();

            } else {
                Firebase.goOffline();
            }

        }


    };

    /**
     * Get a specific user if user exists
     * If not exists, returns false
     */
    SLC_FB.prototype.get_user = function( user_id, callback ) {

        this.ref_users.child( user_id ).once( 'value', function(snap) {
            
            var data = ( snap.exists() ) ? snap.val() : false;

            callback( data );

        });

    };

    /**
     * Get all users data
     */
    SLC_FB.prototype.get_users = function( callback ) {

        this.ref_users.once( 'value', function(snap) {

            var data = ( snap.exists() ) ? snap.val() : false;

            callback( data );

        });

    };

    /**
     * Update user data
     */
    SLC_FB.prototype.update_user = function( id, data, callback ) {

        this.ref_users.child(id).update( data, callback );
    };

    /**
     * Setup current user
     */
    SLC_FB.prototype.set_user = function( id, name, callback ) {

        var self = this;

        self.ref.onAuth( function( auth_data ) {

            if( auth_data && !self.user_id ) {
                
                // Update user data
                self.user_id = id.toString();
                self.user_name = name.toString();
                self.ref_user = self.ref.child( 'users' ).child( self.user_id );

                // Is operator?
                self.is_op = !!auth_data.auth.is_op;

                // Update "last active" value on disconnect
                self._queue_presence( 
                    self.ref_user.child('last_active'), 
                    null, 
                    Firebase.ServerValue.TIMESTAMP 
                );

                // Setup user data
                self._load_user( function() {

                    // Update user name with the current one
                    self.user_name = self.user.name.toString();

                    root.setTimeout( function() {

                        // Invoke callback
                        callback( self.user );

                        // Setup data events
                        self._data_events();

                    }, 0 );

                });

            // No authenticated Firebase reference found
            } else {
                // User isn't authenticated!
                self._on_auth_required();
            }

        });

    };

    /**
     * User exists?
     */
    SLC_FB.prototype.user_exists = function( user_id, callback ) {
        
        this.ref_users.child(user_id).once( 'value', function( snap ) {

            var exists = ( snap.val() !== null );

            callback( exists );

        });
    };

    /**
     * Delete user
     */
    SLC_FB.prototype.del_user = function( user_id, callback ) {

        // Delete user
        this.ref.child( 'users' ).child( user_id ).remove( callback );

    };

    /**
     * Check if user's session is active
     */
    SLC_FB.prototype.check_session = function( user_id, last_active ) {

        // No record for last activity
        if( !last_active ) {
            return true;
        }

        // Get difference in milliseconds
        var now = new Date().getTime(),
            diff = now - last_active,
            sec = Math.floor( diff / 1000 ); // difference in seconds...

        // If user just refreshed page, continue to show up user
        if( sec < 60 ) {
            return true;
        }

        // Remove user if it is offline for a long time
        if( sec > ( 60 * 160 ) ) {
            this.ref_users.child(user_id).remove();
            return false;
        }

        return true;
    };

    /**
     * Has current user has chat?
     */
    SLC_FB.prototype.has_chat = function( user_id, callback ) {

        var self = this;

        // Get all chats
        this.ref_chats.once( 'value', function(snap) {

            if( snap.exists() ) {
                var chats = snap.val(),
                    authorized = [];

                for( var id in chats ) {
                    
                    authorized = chats[id].authorized_users;

                    // Authorized user?
                    if( authorized && user_id in authorized ) {
                        callback( chats[id] );
                        
                        return;

                    }
                }
            }

            // No chats found
            callback( false );

        });

    };

    /**
     * Current has any private chat with a specific user?
     */
    SLC_FB.prototype.has_private_chat = function( search_user_id, callback ) {

        var self = this;

        // Get all chats
        this.ref_chats.once( 'value', function(snap) {

            if( snap.exists() ) {
                var chats = snap.val(),
                    authorized = [];

                for( var id in chats ) {
                    authorized = chats[id].authorized_users;

                    // Authorized user?
                    if( authorized && search_user_id in authorized && self.user_id in authorized ) {
                        callback( chats[id] );
                        
                        break;

                    }
                }
            }

            // No chats found
            callback( false );

        });

    };

    /**
     * Create and join chat
     */
    SLC_FB.prototype.create_chat = function( chat_name, default_data, callback ) {

        var self = this,
            ref_new_chat = this.ref_chats.push(),
            chat_id = ref_new_chat.key();

        // New chat data
        var chat_data = {
            id: chat_id,
            name: chat_name,
            created_at: Firebase.ServerValue.TIMESTAMP,
            created_by_user_id: this.user_id,
            missed: true,
            count_msgs: { // Number of messages
                visitor: 0,
                operator: 0,
                total: 0
            },
            response_time: {
                first: 0,
                avg: 0,
                max: 0
            }
        };

        // Merge chat data
        for( var k in default_data ) { chat_data[k] = default_data[k]; }

        // Authorize current user if the chat is visitor's chat
        chat_data.authorized_users = {};
        chat_data.authorized_users[ this.user_id ] = true;

        // Create chat and join automatically
        ref_new_chat.set( chat_data, function( err ) {

            // Invoke the callback
            if( callback ) {
                callback( err, chat_data );
            }

        });
    };

    /**
     * Join a chat chat
     */
    SLC_FB.prototype.join_chat = function( chat_id ) {

        var self = this,
            ref_chat = self.ref_chats.child( chat_id );

        self.get_chat( chat_id, function( chat ) {

            // Cleanup trash chat
            if( !chat ) {
                self.del_chat( chat_id, true );
                return;
            }

            var chat_name = chat.name,
                ref_member = self.ref_members.child( chat_id );

            // Skip if the chat isn't exists
            if( !chat_id || !chat_name ) return;

            // Skip if the user in this chat already
            if( self.chats[ chat_id ] ) return;

            // Add chat ID into chats data
            self.chats[ chat_id ] = chat;

            // Reset response counts
            self.resp_counts[chat.id] = 0;
            
            // Reset response times
            self.resp_times[chat.id] = [];

            // Update user chats to resume the session again later
            if( self.user ) {
                self.ref_user.child('chats').child(chat_id).update({
                    id: chat_id,
                    name: chat_name
                });
            }

            // Save visitor session data
            if( self.user.chats && ( !self.is_op || self.is_frontend ) ) {

                // Update chat session data
                ref_chat.child('session').update( self.session );

            }

            // Set presence bits for the chat
            // Also queue it, so we can remove on disconnect
            var ref_presence = ref_member.child( self.user_id ).child( self.session_id );
            self._queue_presence( ref_presence, {
                id: self.user_id,
                name: self.user_name,
                is_op: ( self.is_op && !self.is_frontend ) ? true : null
            }, null );

            // Authorize current user in the chat
            ref_chat.child('authorized_users').child( self.user_id ).set(true);

            // Unlisten chat member updates first..
            ref_member.off( 'child_added' );
            ref_member.off( 'child_removed' );

            // Listen all chat member updates
            ref_member.on( 'child_added', self._on_member_join, self );
            ref_member.on( 'child_removed', self._on_member_exit, self );

            // Invoke the event before listening new messages
            self._on_chat_join( chat );

            // Invoke the event for chat updates
            ref_chat.on( 'value', function( snap_chat ) {
                self._on_chat_update( snap_chat );
            });

            // Setup message listeners
            ref_chat.once( 'value', function( snap_chat ) {

                // Unlisten new messages first
                self.ref_msgs.child( chat_id ).off();

                // Get last message id
                self.last_msg_ids[chat_id] = chat.last_msg_id || null;

                // Listen new messages
                self.ref_msgs.child( chat_id ).limitToLast( parseInt( self.opts.max_msgs ) ).on( 'child_added', function( snap_msg ) {

                    // Invoke the event for new messages
                    self._on_new_msg( chat_id, snap_msg );

                }, function() {

                    // We don't have permission to access to these messages
                    // So leave the chat
                    self.leave_chat( chat_id );

                }, self );


                // Listen removed messages
                self.ref_msgs.child( chat_id ).limitToLast( parseInt( self.opts.max_msgs ) ).on( 'child_removed', function( snap_msg ) {

                    // Invoke the event for removed messages
                    self._on_del_msg( chat_id, snap_msg );

                }, function() {}, self );


            });

        });

    };

    /**
     * Accept a chat (operators only)
     */
    SLC_FB.prototype.accept_chat = function( chat_id ) {

        var self = this,
            ref_chat = self.ref_chats.child( chat_id );

        // Accept chat as operator
        if( self.is_op && !self.is_frontend ) {
            
            // Update "operators" list
            ref_chat.child('operator').child(self.user_id).set({
                id: self.user_id,
                name: self.user_name
            });

            // Get visitor
            ref_chat.child('visitor').once( 'value', function( snap_visitor ) {

                if( snap_visitor.exists() ) {
                    var visitor = snap_visitor.val();

                    // Ensure that visitor exists
                    self.user_exists( visitor.id, function( exists ) {

                        if( exists ) {
                            var ref_visitor_chat = self.ref_users.child(visitor.id).child('chats').child(chat_id);

                            // Activate visitor's chat
                            self._queue_presence( ref_visitor_chat.child('active'), true, null );
                            self._queue_presence( ref_visitor_chat.child('op_name'), self.user_name, null );

                        // Remove chat reference from "user chats" (not directly "chats" data)
                        } else {
                            self.ref_user.child('chats').child(chat_id).remove();
                        }

                    });
                }
                        

            });
            

            // It isn't missed chat anymore
            ref_chat.child('missed').set(false);

        }

    };

    /**
     * Leave a chat
     */
    SLC_FB.prototype.leave_chat = function( chat_id ) {

        if( !chat_id ) { return; }

         var self = this,
            ref_member_chat = self.ref.child( 'members' ).child( chat_id );

         // Remove listener for new messages from this chat
         self.ref_msgs.child( chat_id ).off();

         // Remove presence bits
         if( self.user ) {

            var ref_presence = ref_member_chat.child( self.user_id ).child( self.session_id );

            // Remove presence bit for the chat and cancel on-disconnect removal
            self._remove_presence( ref_presence.toString(), null );

            // Remove from authorized users
            self.ref_chats.child( chat_id ).child('authorized_users').child( self.user_id ).remove();

            // Remove session bit for the chat
            self.ref_user.child( 'chats' ).child( chat_id ).remove();

         }

         // Remove from chats data
         delete self.chats[chat_id];

         if( this.is_op && !this.is_frontend ) {

            // Deactivate visitor chat
            this.get_chat( chat_id, function( chat ) {

                var ref_visitor_chat = self.ref_users.child(chat.visitor.id).child('chats').child(chat_id);
                
                if( chat.visitor ) {
                    ref_visitor_chat.child('active').remove();
                    ref_visitor_chat.child('op_name').remove();
                }

            }); 

            
         }

         // Invoke the callbacks for exiting chat
         self._on_chat_exit( chat_id );

    };

    /**
     * Delete chat ( optionally chat messages)
     */
    SLC_FB.prototype.del_chat = function( chat_id, del_msgs, callback ) {

        var self = this;

        // First remove chat data
        self.ref_chats.child( chat_id ).remove( function( chat_err ) {
            
            if( !chat_err ) {

                // Remove chat messages too
                if( del_msgs ) {
                    self.ref_msgs.child( chat_id ).remove( function( msg_err ) {
                        if( callback ) {
                            callback( msg_err );
                        }
                    });
                }
                
            } else {
                if( callback ) { 
                    callback( chat_err ); 
                }
            }

        });

    };

    /**
     * Get chat data
     */
    SLC_FB.prototype.get_chat = function( chat_id, callback ) {

        this.ref_chats.child( chat_id ).once( 'value', function( snap ) {
            callback( snap.val() );
        });

    };

    /**
     * Get all chats once
     */
    SLC_FB.prototype.get_chats = function( callback ) {
        this.ref_chats.once( 'value', function(snap) {
            var data = snap.val();

            callback( data );
        });
    };

    /**
     * Get chat messages once
     */
    SLC_FB.prototype.get_chat_msgs = function( chat_id, callback ) {

        this.ref_msgs.child( chat_id ).once( 'value', function( snap ) {
            callback( snap.val() );
        });

    };

    /**
     * Send message
     */
    SLC_FB.prototype.push_msg = function( chat_id, msg, msg_type, callback ) {

        var self = this,
            newMessageRef,
            user_type = ( this.is_op && !this.is_frontend ) ? 'operator' : 'visitor';

        // Message data
        var msg_data = {
            user_id : self.user_id,
            name : self.user_name,
            msg : msg,
            avatar: self.user.avatar || '',
            type : msg_type || 'default',
            time : Firebase.ServerValue.TIMESTAMP
        };

        if( !self.user ) {

            // User isn't authenticated!
            self._on_auth_required();

            if( callback ) { callback( new Error( 'User is NOT authenticated!' ) ); }

            return;

        }

        var ref_chat = this.ref_chats.child(chat_id),
            ref_counts = ref_chat.child('count_msgs');

        function fn_increase( current_count ) {
            return current_count + 1;
        }

        // Increase total number of messages in the chat
        ref_counts.child( user_type ).transaction( fn_increase );
        ref_counts.child('total').transaction( fn_increase );

        // Create new message
        ref_msg = self.ref_msgs.child( chat_id ).push();

        // Update the message content in Firebase
        ref_msg.setWithPriority( msg_data, Firebase.ServerValue.TIMESTAMP, callback );

        // Update last message id if it isn't first message
        if( chat_id in this.prev_msgs ) {
            ref_chat.child('last_msg_id').set( ref_msg.key() );
        }

    };

    /**
     * Delete message
     */
    SLC_FB.prototype.del_msg = function( chat_id, msg_id, callback ) {

        // Delete message
        this.ref_msg.child( chat_id ).child( msg_id ).remove( callback );

    };

    /**
     * Delete a specific user session
     */
    SLC_FB.prototype.del_session = function( user_id, session_id ) {
        var sess = this.ref_users.child( user_id ).child( 'sessions' ).child( session_id ).remove();

    };

    /**
     * Send action to a specific user
     */
    SLC_FB.prototype.send_action = function( type, user_id, chat_id, xtra_data ) {

        var self = this;

        // Send invitation
        var fn_send_action = function() {

            // Create action
            var ref_action = self.ref.child( 'users' ).child( user_id ).child( 'actions' ).push();

            var data = {
                id              : ref_action.key(),
                from_user_id    : self.user_id,
                from_user_name  : self.user_name,
                chat_id         : chat_id,
                type            : type
            };

            // Merge additional data
            if( xtra_data ) {
                for( var id in xtra_data ) { data[id] = xtra_data[id]; }
            }

            // Update data
            ref_action.set( data );

            // Handle listen unauth / failure in case we're kicked
            ref_action.on( 'value', self._on_action_response, function(){}, self );
        };

        // Authentication is required
        if( !this.user ) {
            this._on_auth_required();
            return;
        }

        // Make authorize user in current chat 
        // and send invitation
        this.get_chat( chat_id, function( chat ) {
            
            if( chat.type === 'visitor' ) {

                // Get authorized users reference
                var ref_auth_users = self.ref_chats.child( chat_id ).child( 'authorized_users' );

                ref_auth_users.child( user_id ).set( true, function( err ) {
                    if( !err ) {
                        fn_send_action();
                    }
                });

            } else {
                fn_send_action();
            }
        });

    };

    /**
     * Accept action request
     */
    SLC_FB.prototype.accept_action = function( action_id, callback ) {

        var self = this;

        this.ref_user.child( 'actions' ).child( action_id ).once( 'value', function( snap ) {
            var action = snap.val();

            // Invalid action ID
            if( action === null && callback ) {
                return callback( new Error( 'accept_action(' + action_id + '): invalid action id' ) );

            // Enter chat and update action status as "accepted"
            } else {

                // Accept action
                self.ref_user.child( 'actions' ).child( action_id ).update({
                    status : 'accepted',
                    to_user_id: self.user_id,
                    to_user_name: self.user_name
                }, callback );
            }

        }, self );
    };

    /**
     * Decline action request
     */
    SLC_FB.prototype.decline_action = function( action_id, callback ) {

        var updates = {
            status : 'declined',
            to_user_id : this.user_id,
            to_user_name : this.user_name
        };

        this.ref_user.child( 'actions' ).child( action_id ).update( updates, callback );

    };

    /**
     * Update mode of current user
     */
    SLC_FB.prototype.update_mode = function( mode ) {
        
        if( this.ref_user ) {
            this.ref_user.child('mode').set( mode );
        }
        
    };

    /**
     * Send notification to a specific user
     */
    SLC_FB.prototype.send_ntf = function( type, user_id, data, callback ) {
        
        var self = this,
            ref_ntf = self.ref.child( 'users' ).child(user_id).child('notifications');

        // Push notification
        ref_ntf.push({
            from_user_id: self.user_id,
            timestamp: Firebase.ServerValue.TIMESTAMP,
            type: type,
            data: data || {}
        }, callback );

    };

    /**
     * Update a parameter in real-time database
     */
    SLC_FB.prototype.update_param = function( type, name, value, onComplete ) {

        if( !this.user ) return;

        switch( type ) {
            
            // User actions
            case 'user':
                this.ref_user.child( name ).set( value, onComplete );

                break;
        }
    };

    /**
     * Callback registration
     */
    SLC_FB.prototype.on = function( event_type, callback ) {
        this._add_event_cb( event_type, callback );
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

    /**
     * Resumes the previous session by joining chats automatically
     */
    SLC_FB.prototype.resume_session = function() {

        // 
        // Join to user chats
        //
        this.ref_user.child( 'chats' ).once( 'value', function( snap ) {

            var chats = snap.val();

            for( var chat_id in chats ) {
                this.join_chat( chat_id );
            }

        }, function() {}, this );

    };

})(Firebase);