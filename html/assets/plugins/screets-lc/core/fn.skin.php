<?php
/**
 * SCREETS © 2016
 *
 * Useful skin functions
 *
 * COPYRIGHT © 2016 Screets d.o.o. All rights reserved.
 * This  is  commercial  software,  only  users  who have purchased a valid
 * license  and  accept  to the terms of the  License Agreement can install
 * and use this program.
 *
 * @package Live Chat
 * @author Screets
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Build form
 *
 * @since Live Chat (2.0)
 * @return void
 */
function fn_schat_build_form( $form_name ) {

	global $SChat;

	$output = '';

	require_once SLC_PATH . '/core/class.template.php';

	// Get fields
	$fields = $SChat->opts->getOption( $form_name . '-fields' );
	$req_fields = $SChat->opts->getOption( $form_name . '-req-fields' ) ;

	if( !empty( $fields ) ) {

		foreach( $fields as $name ) {

			switch( $name ) {
				case 'phone':
					$type = 'tel';
					break;

				case 'name':
				case 'subject':
					$type = 'text';
					break;

				case 'email':
					$type = 'email';
					break;

				case 'question':
					$type = 'textarea';
					break;

			}

			$tpl = new SLC_template( SLC_PATH . '/core/templates/tpl/form-' . $type . '.tpl' );


			$title = schat__( $form_name . '-f-' . $name );

			$class = '';
			$req = ( in_array( $name, $req_fields ) ) ? 'required' : null;
			$prefix = ( !empty( $req ) ) ? '<span class="schat-req">*</span> ' : '';
			$placeholder = ( !empty( $req ) ) ? $title . ' (' . __( 'Required', 'schat' ) . ')' : $title;

			$class .= ( !empty( $req ) ) ? ' schat-req' : '';

			// Setup fields
			if( !empty( $title ) ) {
				$tpl->set( 'name', $name );
				$tpl->set( 'title', $title );
				$tpl->set( 'prefix', $prefix );
				$tpl->set( 'suffix', '' );
				$tpl->set( 'ph', $placeholder );
				$tpl->set( 'val', '' );
				$tpl->set( 'class', '' );
				$tpl->set( 'required', $req );

				// Render the field
				$output .= $tpl->render();

			}


		}

	}

	return $output;

}

/**
 * Get chat icon according to current chat box position and status
 *
 * @since Live Chat (2.0)
 * @return string  Returns HTML class name of icon
 */
function fn_schat_get_chat_icon( $status = 'close' ) {

	global $SChat;

	if( $SChat->opts->getOption('widget-pos-y') == 'bottom' ) {
		return ( $status == 'open' ) ? 'schat-ico-down' : 'schat-ico-up';

	} else {
		return ( $status == 'open' ) ? 'schat-ico-up' : 'schat-ico-down';
	}

}


/**
 * Get widget position
 *
 * @since Live Chat (2.0)
 * @return string  Returns CSS code according to current options
 */
function fn_schat_get_pos( $pos, $offset_x, $offset_y ) {

	switch( $pos ) {
		case 'top-left':
			return 'top:' . $offset_x . 'px; left:' . $offset_y . 'px';

		case 'top-right':
			return 'top:' . $offset_x . 'px; right:' . $offset_y . 'px';

		case 'bottom-left':
			return 'bottom:' . $offset_x . 'px; left:' . $offset_y . 'px';

		case 'bottom-right':
			return 'bottom:' . $offset_x . 'px; right:' . $offset_y . 'px';
	}
}

/**
 * Foreground color should be dark or white?
 *
 * @since Live Chat (2.0)
 * @return bool  Returns true when foreground color should be dark according to provided color
 */
function fn_schat_is_black( $hexcolor ) {

	global $SChat;

	$white_fg = $SChat->opts->getOption( 'white-foreground' );

	// Force use white foreground
	if( !empty( $white_fg ) )
		return false;

	$r = hexdec( substr( $hexcolor, 0, 2 ) );
	$g = hexdec( substr( $hexcolor, 2, 2 ) );
	$b = hexdec( substr( $hexcolor, 4, 2 ) );

	$yiq = ( ( $r*299 ) + ( $g * 587 ) + ( $b * 114 ) ) / 1000;

	return ($yiq >= 128) ? true : false;

}

/**
 * Change the brightness of the passed in color
 *
 * $diff should be negative to go darker, positive to go lighter and
 * is subtracted from the decimal (0-255) value of the color
 *
 * @param string $hex color to be modified
 * @param string $diff amount to change the color
 * @return string hex color
 * @since Live Chat (2.1)
 */
function fn_schat_lum( $hex, $diff ) {
	$rgb = str_split( trim( $hex, '# ' ), 2 );

	foreach ( $rgb as &$hex ) {
		$dec = hexdec($hex);
		if ( $diff >= 0 ) {
			$dec += $diff;
		}
		else {
			$dec -= abs( $diff );
		}
		$dec = max( 0, min( 255, $dec ) );
		$hex = str_pad( dechex( $dec ), 2, '0', STR_PAD_LEFT );
	}

	return '#' . implode( $rgb );
}

/**
 * Get icon of current popup
 *
 * @return string  Return HTML code of icon
 * @since Live Chat (2.1)
 */
function fn_schat_get_popup_icon( $popup_name ) {

	global $SChat;

	$icon_id = $SChat->opts->getOption( $popup_name . '-icon' );
	$custom_icon_id = $SChat->opts->getOption( $popup_name . '-custom-icon' );

	if( empty( $icon_id ) && empty( $custom_icon_id ) ) {
		return '';
	}

	// Use custom icon
	if( !empty( $custom_icon_id ) ) {
		$icon_id = $img_src = $custom_icon_id;

	} else {

		// Default value is already a URL
		$img_src = SLC_URL . '/assets/img/icons/' . $icon_id . '.png';

	}


	if( is_numeric( $icon_id ) ) {

		// Get image
		$img = wp_get_attachment_image_src( $icon_id );

		// Get image source
		$img_src = $img[0];


	}

	return '<div class="schat-popup-icon"><img src="' . esc_url( $img_src ) . '" alt=""/></div>';

}

/**
 * Get social links
 *
 * @return string  List of social links in HTML
 * @since Live Chat (2.1)
 */
function fn_schat_get_social_links( $mode ) {

	global $SChat;

	$is_active = $SChat->opts->getOption( $mode . '-social-links' );

	if( empty( $is_active) ) return;

	$links = array(
		'twitter' => $SChat->opts->getOption( 'social-twitter' ),
		'facebook' => $SChat->opts->getOption( 'social-facebook' ),
		'github' => $SChat->opts->getOption( 'social-github' ),
		'linkedin' => $SChat->opts->getOption( 'social-linkedin' ),
		'skype' => $SChat->opts->getOption( 'social-skype' ),
		'youtube' => $SChat->opts->getOption( 'social-youtube' ),
		'vimeo' => $SChat->opts->getOption( 'social-vimeo' ),
		'slack' => $SChat->opts->getOption( 'social-slack' ),
		'slideshare' => $SChat->opts->getOption( 'social-slideshare' ),
		'medium' => $SChat->opts->getOption( 'social-medium' )
	);

	$output = "<ul class=\"schat-social\">\n";

	foreach( $links as $k => $link ) {
		if( !empty( $link ) ) {
			$output .= "<li><a href=\"" . $link . "\" target=\"_blank\"><i class=\"schat-ico-" . $k . "\"></i></a></li>\n";
		}
	}

	$output .= "</ul>\n";

	return $output;

}

/**
 * Get Screets logo
 *
 * @return string  Returns Screets logo
 * @since Live Chat (2.1)
 */
function fn_schat_screets_logo() {
	global $SChat;

	$whitelabel = $SChat->opts->getOption( 'whitelabel' );

	if( !empty( $whitelabel ) ) {
		//return '<a href="http://screets.org" target="_blank" class="schat-logo"><i class="schat-ico-night-bird"></i></a>';
		return '';
	}
}

/**
 * Get radius by position
 *
 * @return array  Returns radius values like array(2, 2, 0, 0);
 * @since Live Chat (2.1)
 */
function fn_schat_get_radius( $default_radius ) {

	global $SChat;

	$radius = array( $default_radius, $default_radius, $default_radius, $default_radius );

	// Get positions
	list( $pos_y, $pos_x ) = explode( '-', $SChat->opts->getOption('widget-pos') );

	// Remove radius if widget fixed to corner
	if( $SChat->opts->getOption('offset-y') == 0 ) {

		if( $pos_x == 'left' )
			$radius[0] = $radius[3] = 0;
		else
			$radius[1] = $radius[2] = 0;

	}
	if( $SChat->opts->getOption('offset-x') == 0 ) {

		if( $pos_y == 'top' )
			$radius[0] = $radius[1] = 0;
		else
			$radius[2] = $radius[3] = 0;

	}

	return $radius;
}
