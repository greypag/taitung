<?php
/**
 * SCREETS © 2016
 *
 * Initialization the plug-in for front-end
 *
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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/**
 * Front-end initialization
 *
 * @access public
 * @return void
 */
function fn_schat_init() {

	// Don't render chat box
	if( !fn_schat_is_visible() ) {
		return;
	}

	// Load front-end styles and scripts
	// Don't load on customize page 'cause of multiple unknown users issue in Firebase
	if( !defined( 'DOING_AJAX' ) ) {
		add_action( 'wp_enqueue_scripts', 'fn_schat_frontend_scripts', 10 );
		add_action( 'wp_enqueue_scripts', 'fn_schat_render', 20 );
	}

}

add_action( 'init', 'fn_schat_init', 5 );



/**
 * Back-end styles and scripts
 *
 * @since Live Chat (2.0)
 * @return void
 */
function fn_schat_frontend_scripts( $hook ) {
	global $SChat;

	// Load common scripts
	$SChat->common_scripts();

	// Get current user data
	$user = fn_schat_get_user_data_by_array();

	// Get user agent data
	$agent = fn_schat_get_agent();

	// Get display options
	$display = $SChat->opts->getOption( 'display' );
	$prechat_active = $SChat->opts->getOption('prechat-active');
	$btn_active = $SChat->opts->getOption('btn-active');
	$postchat_active = $SChat->opts->getOption('postchat-active');

	$is_home = ( is_home() || is_front_page() ) ? true : false;
	$hide_when_offline = ( in_array( 'hide_offline', $display ) ) ? true : false;
	$show_prechat = ( !empty( $prechat_active ) ) ? true : false;
	$show_btn = ( !empty( $btn_active ) ) ? true : false;
	$show_postchat = ( !empty( $postchat_active ) ) ? true : false;
	$anonymous_login = ( !empty( $postchat_active ) ) ? true : false;

	// UI values
	$popup_size = $SChat->opts->getOption('popup-size');
	$offset_x = $SChat->opts->getOption('offset-x');
	$offset_y = $SChat->opts->getOption('offset-y');
	$pos_x = $SChat->opts->getOption('widget-pos-x');
	$pos_y = $SChat->opts->getOption('widget-pos-y');

	// Get DB url
	$app_db = trim( $SChat->opts->getOption( 'app-db' ) );
	if( strpos( $app_db, 'https://' ) === false ) {
		$app_db = 'https://' . $app_db;
	}

	// Default front-end application options
	$opts = apply_filters( 'schat_app_js_opts', array(
		'app_key' => trim( $SChat->opts->getOption( 'app-key' ) ),
		'app_auth' => trim( $SChat->opts->getOption( 'app-auth' ) ),
		'app_db' => $app_db,
		'app_bucket' => trim( $SChat->opts->getOption( 'app-bucket' ) ),

		'max_msgs' => 70, // Total number of chat messages to load per chat

		'hide_when_offline' => $hide_when_offline,
		'show_btn' => $show_btn,
		'show_prechat' => $show_prechat,
		'show_postchat' => $show_postchat,

		'user' => array(
			'name' => $user['name'],
			'avatar' => $user['avatar'],
			'email' => $user['email'],
			'platform' => array(
				'user_agent'=> $agent['user_agent'],
				'browser'=> $agent['browser'],
				'browser_version'=> $agent['browser_version'],
				'os'=> $agent['os'],
				'is_mobile' => wp_is_mobile(),
				'ip'=> fn_schat_ip_addr()
			),
			'current_page' => fn_schat_current_page_url()
		),

		'ip'=> fn_schat_ip_addr(),
		'is_ssl' => ( is_ssl() ) ? true : false,

		'session' => array(
			'user_agent'=> $agent['user_agent'],
			'browser'=> $agent['browser'],
			'browser_version'=> $agent['browser_version'],
			'os'=> $agent['os']
		),

		'is_home' => $is_home,
		'plugin_url' => SLC_URL,
		'ajax_url' => $SChat->ajax_url(),

		// UI values
		'popup_size' => $popup_size,
		'offset_x' => $offset_x,
		'offset_y' => $offset_y,
		'pos_x' => $pos_x,
		'pos_y' => $pos_y,

		// Strings & messages
		'_you' => __( 'You', 'schat' ),
		'_btn_online' => schat__( 'btn-title-online' ),
		'_btn_offline' => schat__( 'btn-title-offline' ),
		'_prechat_btn' => schat__( 'prechat-btn' ),
		'_welcome_msg' => schat__( 'welcome-msg' ),
		'_first_reply' => schat__( 'first-auto-reply' ),
		'_vote_saved' => schat__( 'poschat-feedback-saved' ),
		'_connecting' => __( 'Connecting', 'schat' ),
		'_no_conn' => __( 'No internet connection', 'schat' ),
		'_wait' => __( 'Please wait', 'schat' ),
		'_online' => __( 'Online', 'schat' ),
		'_offline' => __( 'Offline', 'schat' ),
		'_new_msg' => __( 'New message', 'schat' ),
		'_req_field' => __( 'Please fill out all required fields.', 'schat' ),
		'_invalid_email' => __( 'Email is invalid.', 'schat' ),
		'_no_msg' => __( 'No messages found', 'schat' ),
		'_we_online' => __( "We're online!", 'schat' ),
		'_we_offline' => __( "We're offline now", 'schat' ),
		'_ask_end_chat' => __( 'Are you sure you want to end chat?', 'schat' ),
		'_user_joined_chat' => __( '%s has joined the chat', 'schat' ),
		'_user_left_chat' => __( '%s has left the chat', 'schat' ),
		'_user_typing' => __( '%s is typing', 'schat' ),

		// Time strings
		'_time' => array(
			'prefix' => '',
			'suffix' => '',
			'seconds' => '',
			'minute' => __( '1m', 'schat' ),
			'minutes' => __( '%dm', 'schat' ),
			'hour' => __( '1h', 'schat' ),
			'hours' => __( '%dh', 'schat' ),
			'day' => __( '1d', 'schat' ),
			'days' => __( '%dd', 'schat' ),
			'month' => __( '1m', 'schat' ),
			'months' => __( '%dm', 'schat' ),
			'year' => __( '1y', 'schat' ),
			'years' => __( '%dy', 'schat' )
	    )
	));

	// Application JS
	wp_register_script(
		'schat-app',
		SLC_URL . '/assets/js/schat.app.js',
		array( 'twemoji', 'firebase', 'schat-firebase' ),
		SLC_VERSION,
		true
	);
	wp_enqueue_script( 'schat-app' );

	// Front-end User Interface JS
	wp_register_script(
		'schat-frontend-ui',
		SLC_URL . '/assets/js/schat.frontend.ui.js',
		array( 'schat-app' ),
		SLC_VERSION,
		true
	);
	wp_enqueue_script( 'schat-frontend-ui' );

	// Localize global data
	wp_localize_script( 'schat-firebase', 'schat_opts', $opts );

	// Skin reset styles
	wp_register_style(
		'schat-skin-reset',
		SLC_URL . '/assets/css/schat.basic.reset.css'
	);
	wp_enqueue_style( 'schat-skin-reset' );

	// Icons
	wp_register_style(
		'schat-icons',
		SLC_URL . '/assets/css/schat.icons.css',
		array(),
		SLC_VERSION
	);
	wp_enqueue_style( 'schat-icons' );

	// Skin styles
	wp_register_style(
		'schat-skin',
		SLC_URL . '/assets/css/schat.basic.css',
		array( 'schat-skin-reset' ),
		SLC_VERSION
	);
	wp_enqueue_style( 'schat-skin' );

}

/**
 * Render front-end widget(s)
 *
 * @since Live Chat (2.0)
 * @return void
 */
function fn_schat_render() {

	// Don't render chat box
	if( !fn_schat_is_visible() ) {
		return;
	}

	if( is_user_logged_in() ) {

		// Set authentication method
		$method = 'custom';

		// Set user group
		$group = ( is_admin() && current_user_can( 'schat_answer_visitor' ) ) ? 'op' : 'chat_user';


	} else {

		// Set authentication method
		$method = 'anonymous';

		// Set user group
		$group = 'anonymous';

	}

	// Render chat box
	if( !defined( 'DOING_AJAX' ) ) {
		add_action( 'wp_footer', 'fn_schat_get_chatbox', 5, 0 );
		add_action( 'wp_footer', 'fn_schat_get_app', 25, 0 );
	}

}

/**
 * Get chat box
 *
 * @since Live Chat (2.0)
 * @return string HTML template of chat box
 */
function fn_schat_get_chatbox() {

	global $SChat;

	// Get full chat box template
	require SLC_PATH . '/core/templates/chatbox.php';


}

/**
 * Get application script
 *
 * @since Live Chat (2.0)
 * @return string HTML template of chat box
 */
function fn_schat_get_app() { ?>

	<script type="text/javascript">

		document.addEventListener( 'DOMContentLoaded', function() {

			var schat = new SLC_UI( schat_opts );

		}, false );

	</script>

	<?php

}

/**
 * Admin toolbar menu
 *
 * @since Live Chat (2.0)
 * @return void
 */
function fn_schat_toolbar_menu() {
	global $wp_admin_bar;

	// Add "Chat Console" link to admin toolbar menu
	$args = array(
		'id'     => 'schat-console',
		'title'  => __( 'Chat Console', 'schat' ),
		'parent' => 'site-name',
		'href'   => admin_url( 'admin.php?page=schat_console' )
	);
	$wp_admin_bar->add_menu( $args );

}
add_action( 'wp_before_admin_bar_render', 'fn_schat_toolbar_menu', 999 );

/**
 * Chat box is visible?
 *
 * @access public
 * @return void
 */
function fn_schat_is_visible() {

	global $SChat;

	// Is enabled?
	$is_enable = $SChat->opts->getOption( 'enable' );

	// Get display options
	$display = $SChat->opts->getOption( 'display' );

	
	// Chat widget is "hidden"
	if( empty( $is_enable ) ) {

		$post_id = get_the_ID();

		if( !empty( $post_id ) ) {

			$specific_pages = $SChat->opts->getOption( 'specific-pages' );
			$specific_cats = $SChat->opts->getOption( 'specific-cats' );

			if( !in_array( $post_id, @$specific_pages ) && !in_category( @$specific_cats ) ) {
				return false;
			}

		}

	}

	// Hide on homepage
	if( ( is_home() or is_front_page() ) && in_array( 'hide_home', $display ) )
		return false;

	// Disable on mobile devices
	if( wp_is_mobile() && in_array( 'hide_mobile', $display ) )
		return false;

	// Hide from pages that uses SSL
	if( is_ssl() && in_array( 'hide_ssl', $display ) )
		return false;

	$visibility = $SChat->opts->getOption( 'visibility' );

	if( $visibility != 'public' ) {

		// Display to registered users only
		if( $visibility == 'wp-user' && !is_user_logged_in() )
			return false;

		// Only admins & operators
		if( $visibility == 'admins' && !fn_schat_user_has_role( array( 'administrator', 'cx_op' ) ) )
			return false;

		// Custom user roles
		if( $visibility == 'custom-wp-user' ) {
			$custom_user_roles = maybe_unserialize( $SChat->opts->getOption( 'show-user-roles' ) );

			if( !fn_schat_user_has_role( $custom_user_roles ) )
				return false;
		}

	}

	return true;

}
