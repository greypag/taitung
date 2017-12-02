/*!
 * Screets Live Chat - Plugin options scripts
 * Author: @screetscom
 *
 * COPYRIGHT © 2016 Screets d.o.o. All rights reserved.
 * This  is  commercial  software,  only  users  who have purchased a valid
 * license  and  accept  to the terms of the  License Agreement can install
 * and use this program.
 */

(function ($) {
	$(document).ready(function () {

		// Add "https://" prefix to app id
		$( 'input#screets-cx_app-id' ).before( 'https:// ' );

		// Move notification to top
		$( '.updated.top' ).prependTo( '#wpbody .wrap' );
		$( '.updated.top' ).delay(3000).fadeOut();

		// 
		// Validate options
		// 
		if( schat_admin_opts ) {
			var opt_v = '',
				tab_index = '',
				err = null;


			for( var opt_id in schat_admin_opts ) {
				tab_index = '';
				opt_v = schat_admin_opts[opt_id];
				err = null;

				if( opt_v.length == 0 ) {
					err = true;
				}

				switch( opt_id ){

					// General tab
					case 'api-key':

						// tab_index = 1;
						break;

					// Integrations tab
					case 'app-key':
					case 'app-auth':
					case 'app-db':
					case 'app-bucket':

						/*var _s = '<script src="https://www.gstatic.com/firebasejs';
						if( opt_v.indexOf( _s ) > -1 || opt_v.indexOf( _s ) > -1 ) {

						} else {
							err = true;
							$( '#screets-cx_' + opt_id ).parent().append( '<p class="schat-red"><span class="dashicons dashicons-warning"></span>  Copy/paste the whole snippet</p>' );
						}*/

						tab_index = 6;

						break;

					// Site info tab
					case 'site-name':
					case 'site-url':
					case 'site-email':
					case 'site-reply-to':

						tab_index = 2;

						break;

					// Users tab
					case 'guest-prefix':

						tab_index = 5;

						break;
				}

				if( err ) {
					$( '#screets-cx_' + opt_id ).parent().parent().addClass( 'schat-error' );
					
					// Highlight tab button
					if( tab_index ) {
						$('.nav-tab-wrapper a:nth-child(' + tab_index + ')').addClass('schat-error');
					}
				}

			}

			/*var $firebase_ntf = $('.schat-firebase-ntf').parent().parent();
			$firebase_ntf.hide();

			if( schat_admin_opts['app-id'] ) {

				var ref = new Firebase( 'https://' + schat_admin_opts['app-id'] + '.firebaseIO.com/' );;

				ref.authAnonymously( function( err, auth ) {
					// "Anonymous" login isn't activated
					if( err ) {
						$('.schat-anonymous-auth').html( '<span class="schat-red"><span class="dashicons dashicons-warning"></span> Inactive! Please go to <strong>"Login & Auth"</strong> menu and enable <strong>"Anonymous"</strong> tab in your Firebase dashboard.</span>' );

						// Show Firebase notification
						$firebase_ntf.show();
					} else {
						$('.schat-anonymous-auth').html( '<span class="schat-green"><span class="dashicons dashicons-yes"></span> Active</span>' );
					}
				});

			} else {
				$('.schat-anonymous-auth').html( '<span class="schat-grey">Waiting for you to create your Firebase application.</span>' );
				
				// Show Firebase notification
				$firebase_ntf.show();
			}*/
			
		}

		// Remove https:// part from "app-db"
		var $appDB = document.getElementById('screets-lc_app-db');
		if( $appDB ) {
			$($appDB).on( 'blur', function() {
				if( this.value.indexOf( 'https://' ) > -1 ) {
					this.value = this.value.replace( 'http://', '' ).replace( 'https://', '' );
				}
			}).trigger('blur');

			$($appDB).before( '<small style="color:#999;">https://</small>')
		}

		// 
		// Show specific pages & categories
		// 
		$('#schat-btn-specific-pages').click( function(e) {
			e.preventDefault();

			var status = ( $(this).data('status') == 'open' ) ? '' : 'open';

			var $pages = $(this).parent().parent().parent().next();
			var $cats = $pages.next();

			$pages.addClass('schat-specific-pages');
			$cats.addClass('schat-specific-cats');

			if( status ) {
				$pages.fadeIn(400);
				$cats.fadeIn(400);
				
			} else {
				$pages.fadeOut(400);
				$cats.fadeOut(400);
			}
			
			$(this).data( 'status', status );

		});

		//
		// Update options
		//
		function cx_update_opts() {

			var opt_specific_role = $('#screets-cx_visibilitycustom-wp-user'),
				list_specific_roles = opt_specific_role.closest('tr').next(),
				form_fields = $('select[name^=screets-cx_field]').closest('tr');

			// Show/hide specific user roles list
			if( opt_specific_role.prop('checked') )
				list_specific_roles.fadeIn(500);
			else
				list_specific_roles.hide();

			// Make some option rows as extra option
			list_specific_roles.addClass('cx-xtra-opt');
			form_fields.next().addClass('cx-xtra-opt').next().addClass('cx-xtra-opt').next().addClass('cx-xtra-opt');

		}

		// Listen changes
		$('.options-container input, .options-container select, .options-container textarea' ).on('change keyup blur', function() {
			cx_update_opts();
		});

		cx_update_opts();



	});
} (window.jQuery || window.Zepto));