/*!
 * Screets Live Chat - Admin Scripts
 * Author: @screetscom
 *
 * COPYRIGHT © 2016 Screets d.o.o. All rights reserved.
 * This  is  commercial  software,  only  users  who have purchased a valid
 * license  and  accept  to the terms of the  License Agreement can install
 * and use this program.
 */

(function ($) {
	'use strict';

	/**
	 * Callback function for the 'click' event of the 'Set Footer Image'
	 * anchor in its meta box.
	 *
	 * Displays the media uploader for selecting an image.
	 *
	 */
	function fn_schat_show_media_uploader( $, id ) {
	    'use strict';
	 
	    var file_frame, image_data;
	 
	    /**
	     * If an instance of file_frame already exists, then we can open it
	     * rather than creating a new instance.
	     */
	    if ( undefined !== file_frame ) {
	 
	        file_frame.open();
	        return;
	 
	    }
	 
	    /**
	     * If we're this far, then an instance does not exist, so we need to
	     * create our own.
	     *
	     * Here, use the wp.media library to define the settings of the Media
	     * Uploader. We're opting to use the 'post' frame which is a template
	     * defined in WordPress core and are initializing the file frame
	     * with the 'insert' state.
	     *
	     * We're also not allowing the user to select more than one image.
	     */
	    file_frame = wp.media.frames.file_frame = wp.media({
	        frame:    'post',
	        state:    'insert',
	        multiple: false
	    });
	 
	    /**
	     * Setup an event handler for what to do when an image has been
	     * selected.
	     *
	     * Since we're using the 'view' state when initializing
	     * the file_frame, we need to make sure that the handler is attached
	     * to the insert event.
	     */
	    file_frame.on( 'insert', function() {

	        // Read the JSON data returned from the Media Uploader
		    var json = file_frame.state().get( 'selection' ).first().toJSON();

		    // First, make sure that we have the URL of an image to display
		    if ( 0 > $.trim( json.url.length ) ) {
		        return;
		    }

		    // After that, set the properties of the image and display it
		    $( '#CX_media_' + id )
		        .children( 'img' )
		        .attr( 'src', json.url )
		 		.attr( 'alt', json.caption )
				.attr( 'title', json.title )
		        .show()
		       	.parent()
		       	.removeClass( 'hidden' );

		    // Update field
		    $( '#CX_field_' + id ).val( json.id );

		    // Show "Remove image" link
		    $( '#CX_remove_' + id ).removeClass( 'hidden' );
	 
	    });
	 
	    // Now display the actual file_frame
	    file_frame.open();
	 
	}

	/**
	 * Callback function for the 'click' event of the 'Remove Footer Image'
	 * anchor in its meta box.
	 *
	 * Resets the meta box by hiding the image and by hiding the 'Remove
	 * Footer Image' container.
	 *
	 * @param    object    $    A reference to the jQuery object
	 */
	function fn_schat_reset_img_form( $, id ) {
	    'use strict';
	 
	    // First, we'll hide the image
	    $( '#CX_media_' + id )
	        .children( 'img' )
	        .hide();

		// Update field
		$( '#CX_field_' + id ).val( "" );

	    // Hide "Remove image" link
		$( '#CX_remove_' + id ).addClass( 'hidden' );

	}

	$(document).ready(function () {

		// Update operator capability options in chat settings
		$('#screets-cx_op-capsanswer_visitors').prop( 'checked', ( $.inArray( 'schat_answer_visitor', schat.op_caps ) !== -1 ) ? true : false );
		$('#screets-cx_op-capssee_chat_logs').prop( 'checked', ( $.inArray( 'schat_see_logs', schat.op_caps ) !== -1 ) ? true : false );
		$('#screets-cx_op-capsmanage_chat_options').prop( 'checked', ( $.inArray( 'schat_manage_chat_options', schat.op_caps ) !== -1 ) ? true : false );

		// Choose "role" while adding new user
		if( schat.user_role.length > 0 ) {
			$('#role option[value="' + schat.user_role + '"], #adduser-role option[value="' + schat.user_role + '"]').prop('selected', true );
		}

		// 
		// Display media uploader
		// 
        $( '.cx-media-uploader' ).on( 'click', function( e ) {
 
			// Stop the anchor's default behavior
			e.preventDefault();

			// Display the media uploader
			fn_schat_show_media_uploader( $, $(this).data('id') );
 
        });

        // 
        // Remove media image
        // 
        $( '.cx-media-remove' ).on( 'click', function( e ) {
     
			// Stop the anchor's default behavior
			e.preventDefault();

			// Remove the image, toggle the anchors
			fn_schat_reset_img_form( $, $(this).data('id') );
		     
		});


	});
} (window.jQuery || window.Zepto));