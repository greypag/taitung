<?php
/**
 * SCREETS © 2016
 *
 * Common functions
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
 * Get translated string
 *
 * @since Live Chat (2.1)
 * @return string $value
 */
function schat__( $id ) {
	global $SChat;

	$str = $SChat->opts->getOption( $id );

	if( has_filter( 'wpml_translate_single_string' ) ) {
		return apply_filters( 'wpml_translate_single_string', $str, SLC_NAME, $id );

	} else if( function_exists( 'pll_register_string' ) ) {
		return pll__( $str );
	
	} else {
		return $str;
	}
	
}

/**
 * Clean value for getting
 *
 * @since Live Chat (2.0)
 * @return string $value
 */
function fn_schat_sanitize( $value, $line_break = false ) {

	if( $line_break )
		$value = nl2br( $value, true );

	return stripslashes( trim( $value ) );

}

/**
 * Parse email addresses from string by array
 *
 * @since Live Chat (2.0)
 * @return array Return emails by array
 */
function fn_schat_parse_email( $str ) {

	if( preg_match_all('/\s*"?([^><,"]+)"?\s*((?:<[^><,]+>)?)\s*/', $str, $matches, PREG_SET_ORDER) > 0) {

		$email = array();

		foreach( $matches as $m ) {
			if(! empty($m[2] ) )
				$emails[trim($m[2], '<>')] = trim( $m[1] );
			else
				$emails[] = trim( $m[1] );
		}

		return $emails;
	}

}

/**
 * Get current page URL
 *
 * @since Live Chat (2.0)
 * @return string URL
 */
function fn_schat_current_page_url() {

	$page_URL = 'http';

	if ( @$_SERVER['HTTPS'] == 'on' )
		$page_URL .= "s";

	$page_URL .= '://';

	if ( @$_SERVER['SERVER_PORT'] != '80' )
		$page_URL .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] .$_SERVER['REQUEST_URI'];
	else
		$page_URL .= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

	return $page_URL;

}

/**
 * Get current domain
 *
 * @since Live Chat (2.0)
 * @return string URL
 */
function fn_schat_current_domain() {

	$url = fn_schat_current_page_url();
	$urlobj = parse_url($url);
	$domain = $urlobj['host'];
	
	// Parse standart TLD like (com, co.uk)
	if ( preg_match( '/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs ) ) {
		return $regs['domain'];
	
	// Parse standart long-TLD like (traveling)
	} elseif ( preg_match( '/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,12})$/i', $domain, $regs ) ) {
		return $regs['domain'];
	}

	 return false;

}


/**
 * Create a simple description text for options
 * 
 * (It is common function, because it also works in Appearance > Customizer)
 *
 * @since Live Chat (2.0)
 * @return string $desc
 */
function fn_schat_admin_desc( $str, $new_line = false ) {
	$r = '';

	if( $new_line )
		$r .= '<br>';

	$r .= '<small style="color:#999;font-weight:normal;" class="description">' . $str . '</small>';

	return $r;
}