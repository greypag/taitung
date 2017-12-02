<?php
/**
 * SCREETS © 2016
 *
 * Firebase functions
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
 * Clean up Firebase DB
 *
 * @since Live Chat (2.0)
 * @return bool
 */
function fn_schat_cleanup_firebase_db() {

	global $SChat, $wpdb;

	require_once SLC_PATH . '/core/library/firebase/firebaseLib.php';

	$app_id = $SChat->opts->getOption('app-id');
	$app_secret = $SChat->opts->getOption('app-secret');

	if( empty( $app_id ) ) return;

	// Default path
	$path = 'https://' . $app_id . '.firebaseio.com/';

	// Connect to auth rules
	$firebase = new Firebase( $path, $app_secret );

}

/**
 * Update security rules
 *
 * @since Live Chat (2.0)
 * @return object
 */
function fn_schat_update_security_rules() {

	global $SChat;

	require_once SLC_PATH . '/core/library/firebase/firebaseLib.php';

	$app_id = $SChat->opts->getOption('app-id');
	$app_secret = $SChat->opts->getOption('app-secret');

	// Get security rules
	$rules_json = file_get_contents( SLC_PATH . '/rules.json' );

	// Default path
	$path = 'https://' . $app_id . '.firebaseio.com/';

	// Connect to auth rules
	$firebase = new Firebase( $path, $app_secret );

	// Update rules
	return json_decode( $firebase->set( '/.settings/rules', $rules_json ) );


}