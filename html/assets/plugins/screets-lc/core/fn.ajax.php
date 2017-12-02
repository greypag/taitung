<?php
/**
 * SCREETS © 2016
 *
 * Ajax functions
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

// Ajax requests
add_action( 'wp_ajax_schat_ajax_cb', 'fn_schat_ajax_cb' );
add_action( 'wp_ajax_nopriv_schat_ajax_cb', 'fn_schat_ajax_cb' );

/**
 * Ajax Callback
 *
 * @since Live Chat (2.0)
 * @return void
 */
function fn_schat_ajax_cb() {

	// Response var
	$r = array();

	try {

		// Handling the supported actions:
		switch( $_GET['mode'] ) {

			// Front-end requests
			case 'offline': $r = fn_schat_ajax_send_email( $_POST ); break; // Offline foms
			case 'email_chat': $r = fn_schat_ajax_email_chat( $_POST ); break; 

			default:
				throw new Exception( 'Wrong AJAX action: ' . @$_REQUEST['mode'] );

		}

	} catch ( Exception $e ) {

		$r['err_code'] = $e->getCode();
		$r['error'] = $e->getMessage();

	}

	// Response output
	header( "Content-Type: application/json" );
	echo json_encode( $r );

	exit;

}

/**
 * Offline form
 *
 * @since Live Chat (2.0)
 * @param array $fd Form data
 * @return array $r Response
 */
function fn_schat_ajax_send_email( $fd ) {

	global $SChat;

	require_once SLC_PATH . '/core/fn.offline.php';

	// Get user agent data
	$agent = fn_schat_get_agent();

	// Get email subject
	$subject = ( !empty( $fd['subject'] ) ) ? $fd['subject'] : __( 'New message', 'schat' );
	
	// Email parameters
	$to = $SChat->opts->getOption( 'site-email' );
	$subject = apply_filters( 'schat_offline_email_subject', $subject );
	$headers = array( 'Content-Type: text/html; charset=UTF-8' );
	$site_name = $SChat->opts->getOption( 'site-name' );
	$from_name = ( !empty( $fd['name' ] ) ) ? $fd['name'] : $site_name;

	// Sending by visitor if email provided in offline form
	/*if( !empty( $fd['email'] ) ) {

		$headers[] = 'From: "' . $from_name . '" <' . $fd['email'] . '>';
		$headers[] = 'Reply-To: "' . $from_name . '" <' . $fd['email'] . '>';

	// No email provided in offline form..
	} else {
		$headers[] = 'From: "' . $from_name . '" <' . $to . '>';
	}*/

	// 
	// Prepare body
	// 
	$body = '';

	$custom_fields = array();

	// Get email body
	foreach( $fd as $k => $v ) {

		// Get custom fields if exists
		if( substr($k, 0, 5) === 'xtra-' ) {
			$custom_fields[substr($k,5)] = $v;

		// Offline form data
		} else {

			$title = schat__( 'offline-f-' . $k );

			$body .= '<strong>'. $title . ':</strong> ';
			$body .= '' . esc_html( stripslashes( $v ) ) . '<br />';

		}
	}

	// Render user-agent data
	$body .= '<br/><small>' . __( 'Visitor information', 'schat' ) . ':</small><br/>';
	$body .= '<small><strong>' . __( 'Platform', 'schat' ) . ':</strong> ' . $agent['browser'] . ' ' . $agent['browser_version'] . ' (' . $agent['os'] . ')</small><br/>';

	// Render other custom fields
	if( !empty( $custom_fields ) ) {
		$body .= '<small><strong>' . __( 'Location', 'schat' ) . ':</strong> ' . $custom_fields['city'] . ', ' . $custom_fields['country'] . ', ' . $custom_fields['ip'] . '</small><br/>';
		$body .= '<small><strong>' . __( 'Current page', 'schat' ) . ':</strong> <a href="' . $custom_fields['current-page'] .'">' . $custom_fields['current-page'] . '</a></small><br/>';
	}

	// Message meta data
	$meta = array_merge( $fd, $custom_fields );

	// Insert new offline message into database
	fn_schat_create_offline_msg( $fd['question'], $meta );

	// Send email
	if( fn_schat_send_email( $to, $subject, $body, $headers ) ) {
		return array( 'msg' => __( 'Successfully sent! Thank you', 'schat' ) );
	}

}

/**
 * Email chat history
 *
 * @since Live Chat (2.0)
 * @param array $fd Form data
 * @return array $r Response
 */
function fn_schat_ajax_email_chat( $fd ) {

	global $SChat;

	require_once SLC_PATH . '/core/fn.offline.php';

	if( empty( $fd['content'] ) ) {
		throw new Exception( __( 'No messages found', 'schat' ) );
	}

	if( !is_email( @$fd['email'] ) ) {
		throw new Exception( __( 'Email is invalid.', 'schat' ) );
	}

	// Email parameters
	$to = $fd['email'];
	$site_name = $SChat->opts->getOption( 'site-name' );
	$subject = apply_filters( 'schat_email_chat_subject', __( 'Chat History', 'schat' ) . ' - ' . current_time( 'Y-m-d' ) );
	$headers = array( 'Content-Type: text/html; charset=UTF-8' );
	$site_reply_to = $SChat->opts->getOption( 'site-reply-to' );

	$headers[] = 'From: "' . $site_name . '" <' . $site_reply_to . '>';
	$headers[] = 'Reply-To: "' . $site_name . '" <' . $site_reply_to . '>';

	// Sanitize message
	$body  = '<strong>' . __( 'Chat History', 'schat' ) . '</strong><br><br>';
	$body .= wp_kses( $fd['content'], array( 'strong' => array(), 'small' => array(), 'div' => array(), 'p' => array(), 'span' => array(), 'a' => array('href' => array()) ) );
	$body .= '<br><small>Chat ID: ' . $fd['chat_id'] . '</small>';

	if( fn_schat_send_email( $to, $subject, $body, $headers ) ) {
		return array( 'msg' => __( 'Successfully sent! Thank you', 'schat' ) );
	}

}

/**
 * Save chat transcript to server database
 *
 * @since Live Chat (2.0)
 * @param int $data Messages data
 * @return array $r Response
 */
function fn_schat_ajax_save_transcript( $raw ) {

	global $wpdb;

	$db_cnv = SLC_PX . 'conversations';
	$db_msgs = SLC_PX . 'chat_messages';
	$i = 0;
	$cnv_id = null;

	foreach( $raw as $id => $json_data ) {

		// Decode the value
		$v = json_decode( stripslashes( $json_data ) );

		// 
		// Create conversation
		//
		if( $i == 0 ) {

			$wpdb->query( $wpdb->prepare(
				"INSERT INTO {$db_cnv} (`name`,`created_at`, `type`) VALUES( %s, %d, %s )",
				$v->name, 
				$v->created_at, 
				$v->type
			));

			$cnv_id = $wpdb->insert_id;
		
		// 
		// Insert chat messages
		//
		} else {
			
			$wpdb->query( $wpdb->prepare(
				"INSERT INTO {$db_msgs} ( `cnv_id`, `user_id`, `name`, `msg`, `time`) VALUES( %d, %s, %s, %s, %d )",
				$cnv_id, 
				$v->user_id, 
				$v->name, 
				$v->msg, 
				$v->time
			));

		}

		$i++;
	}

	// Create user or get exists one
	/*$wpdb->replace( SLC_PX . 'users', array(
		'user_id' => $user->id,
		'name' => $user->name,
		'username' => @$user->username,
		'email' => @$user->email,
		'phone' => @$user->phone,
		'ip' => ip2long( fn_schat_ip_addr() )
	), array( '%s', '%s', '%s', '%s', '%s', '%d' ) );

	$user_id = $wpdb->insert_id;*/
	
	

	// Update page history

	return array( 'ok' => 1 );

}