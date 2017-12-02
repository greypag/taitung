<?php
/**
 * SCREETS © 2016
 *
 * Shortcodes for the plugin
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
 * Chat button shortcode
 *
 * [cx-button]Live chat[/cx-button]
 *
 * @since Live Chat (2.1.1)
 * @return string Customized shortcode content
 */
function fn_schat_shortcode_chat_btn( $atts , $content = null ) {

	// Attributes
	$atts = shortcode_atts( array(
		// 'mode' => 'online'
	), $atts, 'cx-button' );

	return '<a href="javascript:void(0);" class="schat-shortcode-chat-btn">' . $content . '</a>';

}

add_shortcode( 'cx-button', 'fn_schat_shortcode_chat_btn' );