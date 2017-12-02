<?php
/**
 * SCREETS © 2016
 *
 * Offline functions
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
 * Send email with current template 
 *
 * @since Live Chat (2.0)
 * @return mixed Returns true if the email contents were sent successfully
 */
function fn_schat_send_email( $to, $subject, $body, $headers = array() ) {

	global $SChat;

	require_once SLC_PATH . '/core/class.template.php';

	// Create email template
	$email = new SLC_template( apply_filters( 'schat_email_template_file', SLC_PATH . '/core/templates/tpl/email-basic.tpl' ) );

	$site_logo = $img = wp_get_attachment_image_src( $SChat->opts->getOption( 'site-logo' ), 'full' );

	// Setup email header and footer contents
	$email->set( 'title', $subject );
	$email->set( 'logo', $site_logo[0] );
	$email->set( 'site_url', $SChat->opts->getOption( 'site-url' ) );
	$email->set( 'site_name', $SChat->opts->getOption( 'site-name' ) );
	$email->set( 'footer_note', '' );
	$email->set( 'radius', $SChat->opts->getOption('radius') );
	$email->set( 'body', $body );

	// Email content
	$msg = $email->render();

	// Email subject
	$subject = $SChat->opts->getOption( 'site-name' ) . ' - ' . $subject;

	// Try to send email
	if( !wp_mail( $to, $subject, $msg, $headers ) ) {
		throw new Exception( __( 'Something went wrong! Please try again', 'schat' ) );
	}

	return true;

}

/**
 * Add offline message
 *
 * @since Live Chat (2.0)
 * @param string $msg
 * @param array $meta  Message meta data
 * @return int $msg_id
 */
function fn_schat_create_offline_msg( $msg, $meta ) {

	// Get title
	if( !empty( $meta['name'] ) )
		$title = $meta['name'];

	elseif( !empty( $meta['email'] ) )
		$title = $meta['email'];
	
	elseif( !empty( $meta['phone'] ) )
		$title = $meta['phone'];

	else
		$title = $meta['ip_addr'];

	// Prepare post data
	$data = array(
		'post_type' 	=> 'schat_offline_msg',
		'post_title'	=> $title,
		'post_content' 	=> $msg,
		'post_status'	=> 'publish'
	);

	// Add offline message
	$msg_id = wp_insert_post( $data );

	// Add/update custom fields
	foreach( $meta as $k => $v ) {
		if( !empty( $v ) )
			add_post_meta( $msg_id, $k, $v, true ) || update_post_meta( $msg_id, $k, $v );
	}

	return $msg_id;

}