<?php
/**
 * SCREETS © 2016
 *
 * User functions
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
 * Get operator name
 *
 * @since Live Chat (2.0)
 *
 * @param int $user_id  If you leave empty, current user ID will be used
 * @return string  Operator name of current user or specific user
 */
function fn_schat_get_op_name( $user_id = null ) {

	if( empty( $user_id) )
		$user_id = get_current_user_id();

	// Get operator name
	$op_name = get_user_meta( $user_id, 'cx_op_name', true );

	// Op name isn't defined yet, create new one for user
	if( empty( $op_name ) ) {

		$current_user = wp_get_current_user();

		$op_name = $current_user->display_name;

		// Update user meta as well (for later usage)
		update_user_meta( $user_id, 'cx_op_name', $op_name );
	}

	return $op_name;
}

/**
 * Update "operator" user capabilities using current chat options
 *
 * @since Live Chat (2.0)
 * @return void
 */
function fn_schat_update_op_caps() {
	global $SChat;

	// Get current capabilities of operator users
	$current_caps = $SChat->opts->getOption( 'op-caps' );

	// Get "operator" role
	$op_role = get_role( 'cx_op' );

	//
	// Update "operator" capabilities
	//
	if( in_array( 'answer_visitors', $current_caps ) )
		$op_role->add_cap( 'schat_answer_visitor' ); // Add capability
	else
		$op_role->remove_cap( 'schat_answer_visitor' ); // Remove capability

	if( in_array( 'see_chat_logs', $current_caps ) )
		$op_role->add_cap( 'schat_see_logs' ); // Add capability
	else
		$op_role->remove_cap( 'schat_see_logs' ); // Remove capability

	if( in_array( 'manage_chat_options', $current_caps ) )
		$op_role->add_cap( 'schat_manage_chat_options' ); // Add capability
	else
		$op_role->remove_cap( 'schat_manage_chat_options' ); // Remove capability

}

/**
 * Get default WordPress user role names
 *
 * @since Live Chat (2.0)
 * @return array Default role names
 */
function fn_schat_get_role_names( $exclude = null ) {
	global $wp_roles;

	// Get default WP user roles
	if ( ! isset( $wp_roles ) )
		$wp_roles = new WP_Roles();

	// Role names
	$role_names = $wp_roles->get_names();

	// Exclude some roles
	if( !empty( $exclude ) ) {

		foreach( $exclude as $name ) {
			if( !empty($role_names[$name] ) )
				unset( $role_names[$name] );
		}
	}

	return $role_names;

}

/**
 * Get current operator users' capability names
 *
 * @since Live Chat (2.0)
 * @return array $op_caps  Operator capability names
 */
function fn_schat_get_op_cap_names() {

	// Get "operator" role
	$op_role = get_role( 'cx_op' );

	return array_keys( $op_role->capabilities );

}

/**
 * Check if a user has role(s)
 *
 * @since Live Chat (2.0)
 * @return mixed $roles  String or array of roles
 */
function fn_schat_user_has_role( $roles, $user_id = null ) {

	// Get user data
	$user = ( is_numeric( $user_id ) ) ? get_userdata( $user_id ) : wp_get_current_user();

	if( empty( $user ) )
		return false;

	// Check if user has specific role(s)
	if( is_array( $roles ) ) {

		foreach( $roles as $role ) {

			if( in_array( $role, (array) $user->roles ) )
				return true;
		}

	} else {
		return in_array( $roles, (array) $user->roles );
	}


}

/**
 * Get a user's basic data by array
 *
 * @since Live Chat (2.0)
 * @return array $user_data
 */
function fn_schat_get_user_data_by_array( $user_id = null ) {
	global $SChat;

	$site_logo = $SChat->opts->getOption( 'site-logo' );
	$force_site_logo = $SChat->opts->getOption( 'site-logo-force' );

	$data = array();
	$default_avatar = ( !empty( $site_logo ) ) ? wp_get_attachment_url( $site_logo ) : null;

	// 
	// Logged user data
	//
	if( is_user_logged_in() ) {
		$user = ( is_numeric( $user_id ) ) ? get_userdata( $user_id ) : wp_get_current_user();

		if( empty( $user->ID ) )
			return false;

		// Get name
		$data['name'] = ( defined( 'SLC_OP' ) ) ? fn_schat_get_op_name( $user->ID ) : $user->display_name;

		// Get other data
		$data['email'] = $user->user_email;
		$data['username'] = $user->user_login;

		if( current_user_can( 'schat_answer_visitor' ) && !empty( $force_site_logo ) ) {
			$data['avatar'] = $default_avatar;
		} else {
			$data['avatar'] = fn_schat_get_avatar( $user->user_email, null, $default_avatar );
		}
	// 
	// Visitor data
	// 
	} else {
		$unique_name = uniqid( schat__( 'guest-prefix' ), true );

		$data['name'] = fn_schat_ip_addr();
		$data['username'] = $unique_name;
		$data['email'] = '';
		$data['avatar'] = SLC_URL . '/assets/img/cx-default-avatar.png';
	}


	return $data;

}

/**
 * Get avatar
 *
 * @since Live Chat (2.0)
 * @return string Full img tag
 */
function fn_schat_get_avatar( $email, $avatar_size = 100, $default = null ) {

	$url = '//www.gravatar.com/avatar/'
		. md5( $email )
		. '.jpg?s=' . $avatar_size;

	// Add default image
	if( !empty( $default ) )
		$url .= '&d=' . $default;

	return $url;

}

/**
 * Get user id
 * (Create unique user id if user isn't logged in)
 *
 * @since Live Chat (2.0)
 * @return string user ID
 */
function fn_schat_get_user_id() {

	if( is_user_logged_in() ) {

		$current_user = wp_get_current_user();

		// Includes prefix because uid must start with string
		return 'wp-' . $current_user->ID;

	} else {

		// Return unique visitor ID
		return uniqid( 'visitor-' );

	}
}

/**
 * Get user agent info
 *
 * @since Live Chat (2.0)
 * @author ruudrp@live.nl
 * @return string array Agent info
 */
function fn_schat_get_agent() {

	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$bname = __( 'Unknown', 'schat' );
	$version= '';$os = 'N/A';

	$os_list = array(
		'/windows nt 10/i' => 'Windows 10',
		'/windows nt 6.3/i' => 'Windows 8.1',
		'/windows nt 6.2/i' => 'Windows 8',
		'/windows nt 6.1/i' => 'Windows 7',
		'/windows nt 6.0/i' => 'Windows Vista',
		'/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
		'/windows nt 5.1/i' => 'Windows XP',
		'/windows xp/i' => 'Windows XP',
		'/windows nt 5.0/i' => 'Windows 2000',
		'/windows me/i' => 'Windows ME',
		'/win98/i' => 'Windows 98',
		'/win95/i' => 'Windows 95',
		'/win16/i' => 'Windows 3.11',
		'/macintosh|mac os x/i' => 'Mac OS X',
		'/mac_powerpc/i' => 'Mac OS 9',
		'/linux/i' => 'Linux',
		'/ubuntu/i' => 'Ubuntu',
		'/iphone/i' => 'iPhone',
		'/ipod/i' => 'iPod',
		'/ipad/i' => 'iPad',
		'/android/i' => 'Android',
		'/blackberry/i' => 'BlackBerry',
		'/webos/i' => 'Mobile'
	);

	// Next get the name of the useragent yes seperately and for good reason
	if( preg_match( '/Edge/i', $user_agent ) && !preg_match( '/Opera/i', $user_agent ) ) {
		$bname = 'Edge';
		$ub = "Edge";
	} elseif( preg_match( '/MSIE/i', $user_agent ) && !preg_match( '/Opera/i', $user_agent ) ) {
		$bname = 'Internet Explorer';
		$ub = "MSIE";
	} elseif( preg_match( '/Firefox/i', $user_agent ) ) {
		$bname = 'Firefox';
		$ub = "Firefox";
	}  elseif( preg_match( '/Maxthon/i', $user_agent ) ) {
		$bname = 'Maxthon';
		$ub = "Maxthon";
	}  elseif( preg_match( '/Chrome/i', $user_agent ) ) {
		$bname = 'Chrome';
		$ub = "Chrome";
	} elseif( preg_match( '/Safari/i', $user_agent ) ) {
		$bname = 'Safari';
		$ub = "Safari";
	} elseif( preg_match( '/Opera/i', $user_agent ) ) {
		$bname = 'Opera';
		$ub = "Opera";
	}  elseif( preg_match( '/Netscape/i', $user_agent ) ) {
		$bname = 'Netscape';
		$ub = "Netscape";
	} elseif ( preg_match( '/Wget/i', $user_agent ) ) {
		$bname = 'Wget';
		$ub = 'wget';
	} elseif ( preg_match( '/^([A-z0-9]+)\/([0-9.]+)/', $user_agent, $m ) ) {
		$bname = $m[1];
		$ub = $m[1];
	}

	// Get the correct version number
	$known = array( 'Version', $ub, 'other' );
	$pattern = '#(?<browser>' . join('|', $known ) .
	')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	if ( !preg_match_all( $pattern, $user_agent, $matches ) ) {
		// we have no matching number just continue
	}

	// See how many we have
	$i = count( $matches['browser'] );
	if ( $i != 1 ) {
		// We will have two since we are not using 'other' argument yet
		// See if version is before or after the name
		if ( strripos( $user_agent, "Version" ) < strripos( $user_agent,$ub ) ){
			$version = $matches['version'][0];
		} else {
			$version = $matches['version'][1];
		}
	} else {
		$version = $matches['version'][0];
	}

	// Check if we have a number
	if( $version == null || $version == "" ) { $version="?"; }

	// Get OS info
	foreach($os_list as $regex => $value) {
		if (preg_match($regex, $user_agent)) {
			$os = $value;
		}
	}

	return array(
		'user_agent' => $user_agent,
		'browser'      => $bname,
		'browser_version'   => $version,
		'os' => $os,
		'pattern'    => $pattern
	);
}