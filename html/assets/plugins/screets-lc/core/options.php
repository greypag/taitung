<?php
/**
 * SCREETS © 2016
 *
 * Plugin default options
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
 * Get default plugin options
 *
 * @since Live Chat (2.0)
 * @return array $opts
 */
function fn_schat_get_opts() {

	$opts = array();

	$editor_settings = array( 'teeny' => true, 'textarea_rows' => 4 );

	//
	// General options
	//
	$opts['general'] = array(

		array(
			'id' 			=> 'enable',
			'name' 			=> __( 'Enable', 'schat' ),
			'enabled' 		=> __( 'Show', 'schat' ),
			'disabled' 		=> __( 'Hidden', 'schat' ),
			'desc' 			=> __( 'You can hide chat widget on all website except the specific pages and categories you select below', 'schat' ),
			'default' 		=> true,
			'type' 			=> 'enable'
		),

		array(
			'id' 		=> 'display',
			'name' 		=> __( 'Display', 'schat' ) . fn_schat_admin_desc( sprintf( __( "<a href='%s' target='_blank'>wp_footer()</a> <span class='schat-ico-new-win'></span> function has to be located in your theme", 'schat' ), 'http://codex.wordpress.org/Function_Reference/wp_footer' ), true ),
			'options' 	=> array(
				'hide_home' => __( 'Hide on homepage', 'schat' ),
				'hide_offline' => __( 'Hide when all operators offline', 'schat' ),
				'hide_mobile' => '<span class="dashicons dashicons-smartphone"></span> ' . __( 'Disable on mobile devices', 'schat' ),
				'hide_ssl' => __( 'Hide from pages that uses SSL', 'schat' )
			),
			'default'	=> array( 'show' ),
			'type' 		=> 'multicheck'
		),

		array(
			'desc'		=> '<a href="#" id="schat-btn-specific-pages">' . __( 'Specific pages & categories', 'schat' ) . ' &raquo;</a>',
			'type' 		=> 'note'
		),

		array(
			'id' 		=> 'specific-pages',
			'desc'		=> __( 'Always show on those pages:', 'schat' ),
			'hidden'	=> true,
			'type' 		=> 'multicheck-pages'
		),

		array(
			'id' 		=> 'specific-cats',
			'desc'		=> __( 'Always show on those categories:', 'schat' ),
			'hidden'	=> true,
			'type' 		=> 'multicheck-categories'
		),

		array(
			'id' 		=> 'visibility',
			'name' 		=> '<span class="dashicons dashicons-visibility"></span> ' . __( 'Who should see chat box?', 'schat' ),
			'options' 	=> array(
				'public' => __( 'Public', 'schat' ) . ' <small class="description">(' . __( 'Anyone who visits your website', 'schat' ) . ')</small>',
				'wp-user' => __( 'Registered users', 'schat' ) . ' <small class="description">(' . __( 'All users who logged in WordPress', 'schat' ) . ')</small>',
				'custom-wp-user' => __( 'Specific user roles', 'schat' ) . ' <small class="description">(' . __( 'Users who assigned to some specific roles', 'schat' ) . ')</small>',
				'admins' => __( 'Only admins & operators', 'schat' )
			),
			'default'	=> 'public',
			'type' 		=> 'radio'
		),

		array(
			'id' 		=> 'show-user-roles',
			'name' 		=> '',
			'desc' 		=> __( 'Make visible for only those user roles', 'schat' ) . ':',
			'options' 	=> fn_schat_get_role_names(),
			'type' 		=> 'multicheck'
		),

		array(
			'id' => 'api-key',
			'name' => '<span class="dashicons dashicons-post-status"></span> ' . __( 'Screets API Key', 'schat' ) . ' <span class="schat-red">*</span>',
			'desc' => '<strong>' . sprintf( __( '<a href="%s" target="_blank">Get your API key</a>', 'schat' ), 'http://screets.org/apps/api/v1/keys/?domain=' . fn_schat_current_domain() ) . '</strong> <span class="schat-ico-new-win"></span><br>' . __( 'It is required to activate the plugin and get <strong>free updates</strong>.', 'schat' ) . '<br><small>* ' . __( 'Note that you might need to re-login WordPress after updating your API key.', 'schat' ) . '</small>',
			'type' => 'text'
		)

	);

	//
	// Site info
	//
	$opts['site-info'] = array(

		array(
			'id' => 'site-name',
			'name' => __( 'Site name', 'schat' ) . '  <span class="schat-red">*</span>',
			'placeholder' => __( 'Site name', 'schat' ),
			'desc' => __( 'When needed, we will show this name as your site/company name', 'schat' ),
			'type' => 'text'
		),

		array(
			'id' => 'site-url',
			'name' => __( 'Site url', 'schat' ) . '  <span class="schat-red">*</span>',
			'placeholder' => 'http://example.com',
			'desc' => __( 'We will redirect your visitors to this URL from emails or other platforms', 'schat' ),
			'default' => 'http://' . fn_schat_current_domain(),
			'type' => 'text'
		),

		array(
			'id' => 'site-email',
			'name' => __( 'Site email address(es)', 'schat' ) . '  <span class="schat-red">*</span>' . fn_schat_admin_desc( __( 'The plugin notifications will be sent to this email address', 'schat' ) . '.<br/><br/>' . sprintf( __( 'If you need SMTP configuration, you will want to use %s plugin or other good one', 'schat' ), '<a href="https://wordpress.org/plugins/easy-wp-smtp/" target="_blank">Easy WP SMTP</a> <span class="schat-ico-new-win"></span>' ), true ),
			'placeholder' => __( 'Site email address(es)', 'schat' ),
			'desc' => __( "Separate email addresses with comma ','", 'schat' ),
			'type' => 'text'
		),

		array(
			'id' => 'site-reply-to',
			'name' => __( 'Site reply-to address', 'schat' ) . '  <span class="schat-red">*</span>' . fn_schat_admin_desc( __( 'Your visitors will reply to this email', 'schat' ), true ),
			'placeholder' => __( 'Site reply-to address', 'schat' ),
			'desc' => __( 'One email address only', 'schat' ),
			'type' => 'text'
		),

		array(
			'id' => 'site-logo',
			'name' => __( 'Site logo', 'schat' ),
			'desc' => __( 'Recommended size', 'schat' ) . ': 200 x 200px<br>' . __( 'Logo will be used in emails (sent to visitors) and other useful places as well', 'schat' ),
			'default' => SLC_URL . '/assets/img/screets-logo-160px.png',
			'type' => 'upload'
		),

		array(
			'id' => 'site-logo-force',
			'desc' => __( 'Force to use as default operator avatar', 'schat' ),
			'type' => 'checkbox'
		),

		array(
			'id' => 'social-twitter',
			'name' => __( 'Social links', 'schat' ) . fn_schat_admin_desc( __( 'Enter full URL (i.e. https://twitter.com/screetscom)', 'schat' ), true ),
			'placeholder' => 'Twitter',
			'unit' => '<i class="schat-ico-twitter"></i>',
			'type' => 'text'
		),

		array(
			'id' => 'social-facebook',
			'placeholder' => 'Facebook',
			'unit' => '<i class="schat-ico-facebook"></i>',
			'type' => 'text'
		),

		array(
			'id' => 'social-github',
			'placeholder' => 'GitHub',
			'unit' => '<i class="schat-ico-github"></i>',
			'type' => 'text'
		),

		array(
			'id' => 'social-linkedin',
			'placeholder' => 'LinkedIn',
			'unit' => '<i class="schat-ico-linkedin"></i>',
			'type' => 'text'
		),

		array(
			'id' => 'social-skype',
			'placeholder' => 'Skype',
			'unit' => '<i class="schat-ico-skype"></i>',
			'type' => 'text'
		),

		array(
			'id' => 'social-youtube',
			'placeholder' => 'Youtube',
			'unit' => '<i class="schat-ico-youtube"></i>',
			'type' => 'text'
		),

		array(
			'id' => 'social-vimeo',
			'placeholder' => 'Vimeo',
			'unit' => '<i class="schat-ico-vimeo"></i>',
			'type' => 'text'
		),

		array(
			'id' => 'social-slack',
			'placeholder' => 'Slack',
			'unit' => '<i class="schat-ico-slack"></i>',
			'type' => 'text'
		),

		array(
			'id' => 'social-slideshare',
			'placeholder' => 'SlideShare',
			'unit' => '<i class="schat-ico-slideshare"></i>',
			'type' => 'text'
		),

		array(
			'id' => 'social-medium',
			'placeholder' => 'Medium',
			'unit' => '<i class="schat-ico-medium"></i>',
			'type' => 'text'
		)
		
	);

	//
	// Design
	//
	$opts['design'] = array(
		array(
			'id' => 'primary-color',
			'name' => __( 'Primary color', 'schat' ),
			'default' => '#e54045',
			'type' => 'color'
		),

		array(
			'id' => 'primary-fg-color',
			'name' => __( 'Foreground color', 'schat' ),
			'default' => '#ffffff',
			'type' => 'color'
		),

		array(
			'id' => 'link-color',
			'name' => __( 'Link color', 'schat' ),
			'default' => '#42d18c',
			'type' => 'color'
		),

		array(
			'id' => 'bg-color',
			'name' => __( 'Popup background color', 'schat' ),
			'default' => '#ffffff',
			'type' => 'color'
		),

		array(
			'id' => 'border-color',
			'name' => __( 'Border color', 'schat' ),
			'default' => '#dddddd',
			'type' => 'color',
			'css' => "
				div#schat-widget .schat-chat-btn,
				div#schat-widget .schat-popup .schat-header {
					color: \$primary-fg-color;
					background-color: \$primary-color;
				}
				div#schat-widget .schat-chat-btn:hover,
				div#schat-widget .schat-popup .schat-header:hover {
					background-color: lighten(\$primary-color, 10%);
				}
				div#schat-widget .schat-popup {
					background-color: \$bg-color;
				}
				div#schat-widget .schat-popup .schat-content {
					border-color: lighten( \$border-color, 7% );
				}
				div#schat-widget .schat-popup a {
					color: \$link-color;
				}
				div#schat-widget .schat-popup a:hover {
					color: lighten( \$link-color, 10%);
				}"
		),

		array(
			'id' => 'popup-size',
			'name' => __( 'Popup size', 'schat' ),
			'default' => 280,
			'unit' => 'px',
			'placeholder' => __( 'Popup size', 'schat' ),
			'min' => 100,
			'max' => 400,
			'type' => 'number',
			'css' => 'div#schat-widget .schat-popup { width: (value+px); }'
			
		),

		array(
			'id' => 'widget-pos-y',
			'name' => __( 'Position', 'schat' ),
			'desc' => __( 'Which side do you want to display chat box', 'schat' ),
			'default' => 'bottom',
			'options' => array(
				'top' => __( 'Top', 'schat' ),
				'bottom' => __( 'Bottom', 'schat' ),
			),
			'type' => 'radio'
		),

		array(
			'id' => 'widget-pos-x',
			'default' => 'right',
			'options' => array(
				'left' => __( 'Left', 'schat' ),
				'right' => __( 'Right', 'schat' ),
			),
			'type' => 'radio'
		),

		array(
			'id' 		=> 'offset-x',
			'name'		=> __( 'Horizontal offset', 'schat' ) . fn_schat_admin_desc( __( 'Sets the horizontal distance between the page bottom and the chat widget', 'schat' ), true ),
			'unit' 		=> 'px',
			'default' 	=> 20,
			'max' 		=> 100,
			'type' 		=> 'number'
		),

		array(
			'id' 		=> 'offset-y',
			'name'		=> __( 'Vertical offset', 'schat' ) . fn_schat_admin_desc( __( 'Sets the vertical distance between the edge of page and the chat widget', 'schat' ), true ),
			'unit' 		=> 'px',
			'default' 	=> 20,
			'max' 		=> 100,
			'type' 		=> 'number',
			'css' => "
				\$t: if( \$widget-pos-y == top, (\$offset-x+px), inherit);
				\$b: if( \$widget-pos-y == bottom, (\$offset-x+px), inherit); 
				\$l: if( \$widget-pos-x == left, (\$offset-y+px), inherit); 
				\$r: if( \$widget-pos-x == right, (\$offset-y+px), inherit);
				
				div#schat-widget .schat-chat-btn, div#schat-widget .schat-popup { top: \$t; bottom: \$b; left: \$l; right: \$r;}"
		),

		array(
			'id' 		=> 'radius',
			'name' 		=> __( 'Radius', 'schat' ),
			'placeholder'=> __( 'Radius', 'schat' ),
			'unit' 		=> 'px',
			'default' 	=> '5',
			'max' 		=> 20,
			'type' 		=> 'number',
			'css' => "
				\$rad_tl: if( ( \$widget-pos-y == top and \$offset-x == 0 ) or ( \$widget-pos-x == left and \$offset-y == 0 ), 0, (\$radius+px) );
				\$rad_tr: if( ( \$widget-pos-y == top and \$offset-x == 0 ) or ( \$widget-pos-x == right and \$offset-y == 0 ), 0, (\$radius+px) );
				\$rad_br: if( ( \$widget-pos-y == bottom and \$offset-x == 0 ) or ( \$widget-pos-x == right and \$offset-y == 0 ), 0, (\$radius+px) );
				\$rad_bl: if( ( \$widget-pos-y == bottom and \$offset-x == 0 ) or ( \$widget-pos-x == left and \$offset-y == 0 ), 0, (\$radius+px) );

				div#schat-widget .schat-chat-btn {
					border-radius: \$rad_tl \$rad_tr \$rad_br \$rad_bl;
				}
				div#schat-widget img.alignleft,
				div#schat-widget img.alignright,
				div#schat-widget .schat-popup-online .schat-current-op-avatar,
				div#schat-widget .schat-popup-online textarea.schat-reply,
				div#schat-widget .schat-cnv .schat-msg .schat-msg-img,
				div#schat-widget .schat-cnv .schat-msg .schat-msg-img img:not(.emoji),
				div#schat-widget .schat-cnv .schat-msg-wrap,
				div#schat-widget .schat-cnv .schat-user-avatar > img,
				div#schat-widget .schat-cnv .schat-type-auto-ntf {
					border-radius: \$radius+px;
				}
				"
		),

		array(
			'id' 		=> 'padding',
			'name' 		=> 'Padding',
			'desc' 		=> sprintf( __( 'The %s area is the space between the content of the chat box and its border', 'schat' ) , '<em>padding</em>' ),
			'placeholder'=> 'Padding',
			'unit' 		=> 'px',
			'default' 	=> 20,
			'min' 		=> 10,
			'max' 		=> 30,
			'type' 		=> 'number',
			'css' => "
				div#schat-widget .schat-cnv,
				div#schat-widget .schat-popup .schat-body .schat-wrap,
				div#schat-widget .schat-popup-online .schat-ntf .schat-wrap {
					padding: (\$padding/2)+px \$padding+px;
				}

				div#schat-widget .schat-button {
					padding: 0 \$padding+px;
				}
				div#schat-widget .schat-button.schat-small {
					padding: 0 (\$padding/2)+px;
				}
				div#schat-widget .schat-popup-online .schat-current-op .schat-meta {
					padding-right: \$padding+px;
				}
				div#schat-widget .schat-popup-online .schat-current-op-avatar {
					left: \$padding+px;
				}
			"
		),

		/*array(
			'id' 		=> 'delay',
			'name' 		=> __( 'Delay', 'schat' ),
			'placeholder'=> 'Padding',
			'unit' 		=> 'seconds',
			'default' 	=> 2,
			'min' 		=> 0,
			'max' 		=> 30,
			'type' 		=> 'number'
		),*/

		/*array(
			'id' 		=> 'anim',
			'name' 		=> __( 'Animation', 'schat' ),
			'options' 	=> array(
				'na' 		=> __( 'None', 'schat' ),
				'slide' 	=> 'Slide in',
				'fade' 		=> 'Fade In',
				'bounce' 	=> 'Bounce In',
				'jelly' 	=> 'Jelly'
			),
			'desc' 		=> '',
			'default'	=> 'init',
			'type' 		=> 'select'
		),*/

		array(
			'id' => 'avatar-size',
			'name' => __( 'Avatar size', 'schat' ),
			'default' => 30,
			'unit' => 'px',
			'min' => 10,
			'max' => 70,
			'type' => 'number'
		),

		array(
			'id' => 'avatar-radius',
			'name' => __( 'Avatar radius', 'schat' ),
			'desc' => __( 'If avatar size and radius values are the same, the avatar will be circle', 'schat' ),
			'default' => 30,
			'unit' => 'px',
			'min' => 10,
			'max' => 70,
			'type' => 'number'
		),

		array(
			'id' 		=> 'shadow',
			'name' 		=> __( 'Shadow', 'schat' ),
			'type' 		=> 'radio',
			'options' 	=> array(
				'none' 	=> __( 'No shadow', 'schat' ),
				'0 3px 8px 0 ' => __( 'Key light', 'schat' ),
				'0 0 18px 0' => __( 'Ambient light', 'schat' ),
				'5px 4px 18px 0' => __( 'Area light', 'schat' )
			),
			'default' 	=> 'none'
		),

		array(
			'id' => 'shadow-opacity',
			'desc' => __( 'Shadow opacity', 'schat' ),
			'default' => 15,
			'unit' => '%',
			'min' => 0,
			'max' => 30,
			'type' => 'number',
			'css' => "
				div#schat-widget .schat-chat-btn, 
				div#schat-widget .schat-popup {
					-webkit-box-shadow: \$shadow rgba( 0, 0, 0, \$shadow-opacity/100 );
					box-shadow: \$shadow rgba( 0, 0, 0, \$shadow-opacity/100 );
				}
			"
		),


		array(
			'id' => 'font',
			'name' => __( 'Typography', 'schat' ),
			'desc' => __( 'Select your default font style', 'schat' ),
			'show_font_family' => true,
			'show_font_size' => true,
			'show_font_weight' => true,
			'show_line_height' => true,
			'show_color' => true,
			'show_font_style' => false,
			'show_letter_spacing' => false,
			'show_text_transform' => false,
			'show_font_variant' => false,
			'show_text_shadow' => false,
			'show_preview' => false,
			'default' => array(
				'color' => '#232323',
				'font-family' => 'inherit',
				'line-height' => '1.3em',
				'font-size' => '16px',
				'font-weight' => 'normal'
			),
			'type' => 'font',
			'css' => "
				div#schat-widget .schat-chat-btn, 
				div#schat-widget .schat-popup {
						font-size: (\$font-font-size);
						font-family: \$font-font-family;
						font-weight: \$font-font-weight;
				}
				div#schat-widget .schat-popup {
					color: \$font-color;
					line-height: \$font-line-height;
					border-radius: \$rad_tl \$rad_tr \$rad_br \$rad_bl;
				}
				div#schat-widget .schat-popup .schat-content {
					padding: \$padding+px;
					border-radius: \$rad_tl \$rad_tr \$rad_br \$rad_bl;
				}

				div#schat-widget input[type=\"email\"],
				div#schat-widget input[type=\"number\"],
				div#schat-widget input[type=\"search\"],
				div#schat-widget input[type=\"text\"],
				div#schat-widget input[type=\"tel\"],
				div#schat-widget input[type=\"url\"],
				div#schat-widget input[type=\"password\"],
				div#schat-widget textarea,
				div#schat-widget select {
					font-size: \$font-size;
					font-family: \$font-font-family;
					border-radius: \$radius+px;
					border-color: \$border-color;
				}

				div#schat-widget input[type=\"email\"]:focus,
				div#schat-widget input[type=\"number\"]:focus,
				div#schat-widget input[type=\"search\"]:focus,
				div#schat-widget input[type=\"text\"]:focus,
				div#schat-widget input[type=\"tel\"]:focus,
				div#schat-widget input[type=\"url\"]:focus,
				div#schat-widget input[type=\"password\"]:focus,
				div#schat-widget textarea:focus,
				div#schat-widget select:focus {
					border-color: darken( \$border-color, 10% );
				}

				div#schat-widget input[type=\"email\"]:disabled,
				div#schat-widget input[type=\"number\"]:disabled,
				div#schat-widget input[type=\"search\"]:disabled,
				div#schat-widget input[type=\"text\"]:disabled,
				div#schat-widget input[type=\"tel\"]:disabled,
				div#schat-widget input[type=\"url\"]:disabled,
				div#schat-widget input[type=\"password\"]:disabled,
				div#schat-widget textarea:disabled,
				div#schat-widget select:disabled {
					border-color: lighten( \$border-color, 7% );
				}

				div#schat-widget p { line-height: \$font-line-height; }

				div#schat-widget .schat-button {
					color: \$font-color;
					background-color: \$bg-color;
					border-radius: \$radius+px;
					border: 1px solid \$border-color;
					font-size: \$font-font-size;
					font-weight: \$font-font-weight;
				}

				div#schat-widget .schat-button:hover {
					color: lighten( \$font-color, 10% );
					border-color: darken( \$border-color, 10% );
				}

				div#schat-widget .schat-button.schat-small {
					font-size: \$font-font-size-2;
				}

				div#schat-widget .schat-button.schat-primary {
					color: \$primary-fg-color;
					background-color: \$link-color;
					border-color: \$link-color;
				}
				div#schat-widget .schat-button.schat-primary:hover {
					color: \$link-color;
					background-color: \$bg-color;
					border-color: \$link-color;
				}

				div#schat-widget .schat-button.schat-disabled,
				div#schat-widget .schat-button.schat-disabled:hover {
					color: lighten( \$font-color, 10% );
					border-color: \$border-color;
					background-color: \$bg-color;
				}

				div#schat-widget .schat-popup-online .schat-reply-box {
					border-color: lighten( \$border-color, 7% );
					border-radius: 0 0 \$radius+px \$radius+px;
				}

				div#schat-widget .schat-popup-online textarea.schat-reply {
					border-color: lighten( \$border-color, 7% );
				}

				div#schat-widget ul.schat-social li a,
				div#schat-widget a.schat-logo { 
					color: lighten( \$font-color, 50% ); 
				}
				div#schat-widget ul.schat-social li a:hover,
				div#schat-widget a.schat-logo:hover { 
					color: \$font-color; 
				}
				"
		),

		array(
			'id' 			=> 'whitelabel',
			'name' 			=> __( 'White label', 'schat' ),
			'desc' 			=> __( 'Show Screets logo', 'schat' ) . fn_schat_admin_desc( __( 'It will help us to increase the plugin popularity and create better community. A good community brings lots of benefits like extensions, new ideas and improvements.', 'schat' ), true ),
			'default' 		=> true,
			'type' 			=> 'checkbox'
		),

		/* Chat button */
		array(
			'name' => __( 'Chat button', 'schat' ),
			'type' => 'heading'
		),
		array(
			'desc' => 'Shortcode: <code>[cx-button]Live chat[/cx-button]</code><br>Custom HTML: <code>' . htmlspecialchars( '<a href="javascript:void(0);" class="schat-shortcode-chat-btn">Live Chat</a>' ) . '</code>',
			'type' => 'note'
		),

		array(
			'id' 			=> 'btn-active',
			'name' 			=> __( 'Activate', 'schat' ),
			'default' 		=> true,
			'enabled' 		=> __( 'Yes', 'schat' ),
			'disabled' 		=> __( 'No', 'schat' ),
			'type' 			=> 'enable'
		),

		array(
			'id' => 'btn-title-online',
			'name' => __( 'Button title', 'schat' ) . ' (' . __( 'Online', 'schat' ) . ')',
			'placeholder' => __( 'Button title', 'schat' ) . ' (' . __( 'Online', 'schat' ) . ')',
			'default' => "We're online!",
			'translate' => true,
			'type' => 'text'
		),

		array(
			'id' => 'btn-title-offline',
			'name' => __( 'Button title', 'schat' ) . ' (' . __( 'Offline', 'schat' ) . ')',
			'placeholder' => __( 'Button title', 'schat' ) . ' (' . __( 'Offline', 'schat' ) . ')',
			'default' => 'Send a message',
			'translate' => true,
			'type' => 'text'
		),

		array(
			'id' => 'btn-size',
			'name' => __( 'Button size', 'schat' ),
			'desc' => __( '0 (zero): No fixed size', 'schat' ),
			'default' => 0,
			'unit' => 'px',
			'min' => 0,
			'max' => 300,
			'type' => 'number',
			'css' => ".schat-chat-btn { \$w: if( \$btn-size > 0, \$btn-size+px, inherit ); width: \$w; }"
		),

		/*array(
			'id' => 'grabber',
			'name' => '<span class="dashicons dashicons-money"></span> ' . __( 'Attention grabber', 'schat' ),
			'desc' => __( "Add an image to your chat box to draw the visitor's eye to your live chat service - using your own logo or a photo", 'schat' ),
			'type' => 'upload'
		),

		array(
			'id' => 'grabber-2x',
			'desc' => __( 'Retina version', 'schat' ),
			'type' => 'upload'
		),

		array(
			'id' 		=> 'grabber-offset-x',
			'desc'		=> __( 'Horizontal offset', 'schat' ),
			'unit' 		=> 'px',
			'default' 	=> 10,
			'max' 		=> -100,
			'max' 		=> 100,
			'type' 		=> 'number'
		),

		array(
			'id' 		=> 'grabber-offset-y',
			'desc'		=> __( 'Vertical offset', 'schat' ),
			'unit' 		=> 'px',
			'default' 	=> 0,
			'max' 		=> -100,
			'max' 		=> 100,
			'type' 		=> 'number'
		),

		array(
			'id' 		=> 'grabber-hide',
			'desc'		=> __( 'Hide when all operators offline', 'schat' ),
			'type' 		=> 'checkbox'
		),*/
		
		);

	//
	// Popups
	//
	$opts['popups'] = array(

		/* Pre-chat popup */
		array(
			'name' => __( 'Pre-chat popup', 'schat' ),
			'type' => 'heading'
		),

		array(
			'id' 			=> 'prechat-active',
			'name' 			=> __( 'Activate', 'schat' ),
			'default' 		=> true,
			'enabled' 		=> __( 'Yes', 'schat' ),
			'disabled' 		=> __( 'No', 'schat' ),
			'type' 			=> 'enable'
		),

		array(
			'id' 			=> 'prechat-title',
			'name' 			=> __( 'Title', 'schat' ),
			'placeholder' 	=> __( 'Title', 'schat' ),
			'default' 		=> 'Login now',
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'prechat-greeting',
			'name' 			=> __( 'Greeting', 'schat' ),
			'placeholder' 	=> __( 'Greeting', 'schat' ),
			'default' 		=> "<strong>Need more help?</strong> Save time by starting your support request online.",
			'translate' 	=> true,
			'editor_settings' => $editor_settings,
			'type' 			=> 'editor'
		),

		array(
			'id' 			=> 'prechat-fields',
			'name' 			=> __( 'Form fields', 'schat' ),
			'options' 		=>  array(
				'name' => 'Your name',
				'email' => 'Email',
				'phone' => 'Phone',
				'question' => 'Describe your issue'
			),
			'default' 		=>  array( 'name', 'email', 'question' ),
			'visible_button' => true,
			'type' 			=> 'sortable'
		),

		array(
			'id' 			=> 'prechat-req-fields',
			'name' 			=> __( 'Required fields', 'schat' ),
			'desc' 			=> __( 'Choose required fields', 'schat' ),
			'options' 		=>  array(
				'name' => 'Your name',
				'email' => 'Email',
				'phone' => 'Phone',
				'question' => 'Describe your issue'
			),
			'multiple' => true,
			'default' 		=>  array( 'email', 'question' ),
			'type' 			=> 'multicheck'
		),

		array(
			'id' 			=> 'prechat-f-name',
			'name' 			=> __( 'Translate fields', 'schat' ),
			'placeholder'	=>  'Your name',
			'default' 		=>  'Your name',
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'prechat-f-email',
			'placeholder'	=>  'Email',
			'default' 		=>  'Email',
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'prechat-f-phone',
			'placeholder'	=>  'Phone',
			'default' 		=>  'Phone',
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'prechat-f-question',
			'placeholder'	=>  'Describe your issue',
			'default' 		=>  'Describe your issue',
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'prechat-btn',
			'name' 			=> 'Button text',
			'placeholder' 	=> 'Button text',
			'translate' 	=> true,
			'default' 		=> 'Login now',
			'translate' 	=> true,
			'type' 			=> 'text'
		),


		array(
			'id' 			=> 'prechat-footer',
			'name' 			=> __( 'Footer note', 'schat' ),
			'default' 		=> "We'll connect you to an expert.",
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		/* Online popup */
		array(
			'name' => __( 'Online popup', 'schat' ),
			'type' => 'heading'
		),

		array(
			'id' 			=> 'online-title',
			'name' 			=> __( 'Title', 'schat' ),
			'placeholder' 	=> __( 'Title', 'schat' ),
			'default' 		=> "We're online!",
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'welcome-msg',
			'name' 			=> __( 'Welcome message', 'schat' ),
			'placeholder' 	=> __( 'Welcome message', 'schat' ),
			'default' 		=> "Questions, issues or concerns? I'd love to help you!",
			'editor_settings' => $editor_settings,
			'translate' 	=> true,
			'type' 			=> 'editor'
		),

		array(
			'id' 			=> 'first-auto-reply',
			'name' 			=> __( 'First automatic reply', 'schat' ),
			'placeholder' 	=> __( 'First automatic reply', 'schat' ),
			'default' 		=> 'Please wait, an operator will be with you shortly.',
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' => 'str-reply-ph',
			'name' => __( 'Reply box placeholder', 'schat' ),
			'placeholder' => __( 'Reply box placeholder', 'schat' ),
			'default' => 'Your message',
			'translate' 	=> true,
			'type' => 'text'
		),

		array(
			'id' => 'str-reply-send',
			'name' => __( 'Send button', 'schat' ),
			'placeholder' => __( 'Send', 'schat' ),
			'default' => 'Send',
			'translate' 	=> true,
			'type' => 'text'
		),

		/* Offline popup */
		array(
			'name' => __( 'Offline popup', 'schat' ),
			'type' => 'heading'
		),

		array(
			'id' 			=> 'offline-title',
			'name' 			=> __( 'Title', 'schat' ),
			'placeholder' 	=> __( 'Title', 'schat' ),
			'default' 		=> 'Send a message',
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'offline-greeting',
			'name' 			=> __( 'Greeting', 'schat' ),
			'placeholder' 	=> __( 'Greeting', 'schat' ),
			'default' 		=> "Sorry, we aren't online at the moment. Leave a message.",
			'editor_settings' => $editor_settings,
			'translate' 	=> true,
			'type' 			=> 'editor'
		),

		array(
			'id' 			=> 'offline-fields',
			'name' 			=> __( 'Form fields', 'schat' ),
			'options' 		=>  array(
				'name' => 'Your name',
				'email' => 'Email',
				'phone' => 'Phone',
				'subject' => 'Subject',
				'question' => 'Describe your issue'
			),
			'default' 		=>  array( 'name', 'email', 'question' ),
			'visible_button' => true,
			'type' 			=> 'sortable'
		),

		array(
			'id' 			=> 'offline-req-fields',
			'name' 			=> __( 'Required fields', 'schat' ),
			'desc' 			=> __( 'Choose required fields', 'schat' ),
			'options' 		=>  array(
				'name' => 'Your name',
				'email' => 'Email',
				'phone' => 'Phone',
				'subject' => 'Subject',
				'question' => 'Describe your issue'
			),
			'multiple' => true,
			'default' 		=>  array( 'email', 'question' ),
			'type' 			=> 'multicheck'
		),

		array(
			'id' 			=> 'offline-f-name',
			'name' 			=> __( 'Translate fields', 'schat' ),
			'placeholder'	=>  'Your name',
			'default' 		=>  'Your name',
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'offline-f-email',
			'placeholder'	=>  'Email',
			'default' 		=>  'Email',
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'offline-f-phone',
			'placeholder'	=>  'Phone',
			'default' 		=>  'Phone',
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'offline-f-subject',
			'placeholder'	=>  'Subject',
			'default' 		=>  'Subject',
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'offline-f-question',
			'placeholder'	=>  'Describe your issue',
			'default' 		=>  'Describe your issue',
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'offline-btn',
			'name' 			=> __( 'Button text', 'schat' ),
			'placeholder' 	=> __( 'Button text', 'schat' ),
			'default' 		=> 'Send message',
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'offline-footer',
			'name' 			=> __( 'Footer note', 'schat' ),
			'default' 		=> "We'll get back to you as soon as possible.",
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'offline-msg-sent',
			'name' 			=> __( 'Success message', 'schat' ),
			'default' 		=> "Successfully sent! We will get back to you soon",
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'offline-social-links',
			'name' 			=> __( 'Social links', 'schat' ),
			'default' 		=> true,
			'enabled' 		=> __( 'Show', 'schat' ),
			'disabled' 		=> __( 'Hide', 'schat' ),
			'type' 			=> 'enable'
		),

		/* Post-chat popup */
		array(
			'name' => __( 'Post-chat popup', 'schat' ),
			'type' => 'heading'
		),

		array(
			'id' 			=> 'postchat-active',
			'name' 			=> __( 'Activate', 'schat' ),
			'default' 		=> true,
			'enabled' 		=> __( 'Yes', 'schat' ),
			'disabled' 		=> __( 'No', 'schat' ),
			'type' 			=> 'enable'
		),

		array(
			'id' 			=> 'postchat-title',
			'name' 			=> __( 'Title', 'schat' ),
			'placeholder' 	=> __( 'Title', 'schat' ),
			'default' 		=> 'Feedback',
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'postchat-greeting',
			'name' 			=> __( 'Greeting', 'schat' ),
			'placeholder' 	=> __( 'Greeting', 'schat' ),
			'default' 		=> "Help us help you better! Feel free to leave us any additional feedback.",
			'editor_settings' => $editor_settings,
			'translate' 	=> true,
			'type' 			=> 'editor'
		),

		array(
			'id' 			=> 'poschat-feedback-title',
			'name' 			=> __( 'Feedback', 'schat' ),
			'placeholder' 	=> __( 'Rating title', 'schat' ),
			'desc' 			=> __( 'Rating title', 'schat' ),
			'default' 		=> 'How do you rate our support?',
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'poschat-feedback-like',
			'placeholder' 	=> __( 'Like button', 'schat' ),
			'desc' 			=> __( 'Like button', 'schat' ),
			'default' 		=> 'Solved',
			'translate' 	=> true,
			'unit' 			=> '<i class="schat-ico-like"></i>',
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'poschat-feedback-dislike',
			'placeholder' 	=> __( 'Dislike button', 'schat' ),
			'desc' 			=> __( 'Dislike button', 'schat' ),
			'default' 		=> 'Not solved',
			'translate' 	=> true,
			'unit' 			=> '<i class="schat-ico-dislike"></i>',
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'poschat-feedback-saved',
			'placeholder' 	=> __( 'After voting message', 'schat' ),
			'desc' 			=> __( 'After voting message', 'schat' ),
			'default' 		=> 'Saved. Thank you!',
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'poschat-f-email',
			'placeholder' 	=> __( 'Email field', 'schat' ),
			'desc' 			=> __( 'Email field', 'schat' ),
			'default' 		=> 'Your email',
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'postchat-btn-email',
			'name' 			=> __( 'Buttons', 'schat' ),
			'placeholder' 	=> 'Email chat history',
			'default' 		=> 'Email chat history',
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'postchat-btn-send',
			'placeholder' 	=> 'Send',
			'default' 		=> 'Send',
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'postchat-btn-done',
			'placeholder' 	=> 'Done',
			'default' 		=> 'Done',
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'postchat-social-links',
			'name' 			=> __( 'Social links', 'schat' ),
			'default' 		=> true,
			'enabled' 		=> __( 'Show', 'schat' ),
			'disabled' 		=> __( 'Hide', 'schat' ),
			'type' 			=> 'enable'
		),
		

		/* Support categories popup */
		/*array(
			'name' => __( 'Support Categories', 'schat' ),
			'type' => 'heading'
		),

		array(
			'id' 			=> 'cats-active',
			'name' 			=> __( 'Activate', 'schat' ),
			'default' 		=> true,
			'enabled' 		=> __( 'Yes', 'schat' ),
			'disabled' 		=> __( 'No', 'schat' ),
			'type' 			=> 'enable'
		),

		array(
			'id' 			=> 'cats-title',
			'name' 			=> __( 'Title', 'schat' ),
			'placeholder' 	=> __( 'Title', 'schat' ),
			'default' 		=> __( "Get Help", 'schat' ),
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'cats-greeting',
			'name' 			=> __( 'Greeting', 'schat' ),
			'placeholder' 	=> __( 'Greeting', 'schat' ),
			'default' 		=> __( "Choose a product and we’ll connect you to an expert by chat, email, and more.", 'schat' ),
			'desc' 			=> __( 'HTML tags are allowed', 'schat' ),
			'translate' 	=> true,
			'type' 			=> 'textarea'
		),

		array(
			'id' 			=> 'topics-title',
			'name' 			=> __( 'Title', 'schat' ) . ' (' . __( 'Topics', 'schat' ) . ')',
			'placeholder' 	=> __( 'Title', 'schat' ) . ' (' . __( 'Topics', 'schat' ) . ')',
			'default' 		=> __( "Choose a topic", 'schat' ),
			'translate' 	=> true,
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'topics-greeting',
			'name' 			=> __( 'Greeting', 'schat' ) . ' (' . __( 'Topics', 'schat' ) . ')',
			'placeholder' 	=> __( 'Greeting', 'schat' ) . ' (' . __( 'Topics', 'schat' ) . ')',
			'default' 		=> __( "Choose a topic and we’ll find you the best option.", 'schat' ),
			'desc' 			=> __( 'HTML tags are allowed', 'schat' ),
			'translate' 	=> true,
			'type' 			=> 'text'
		)*/



	);

	//
	// Templates
	//
	$opts['templates'] = array(

		array(
			'id' 			=> 'prechat-fields',
			'name' 			=> __( 'Pre-chat form fields', 'schat' ),
			'lang' 			=> 'json',
			'type' 			=> 'code',
			'default' 		=> "[
	{
		\"name\": \"name\",
		\"type\": \"text\",
		\"label\": \"Your name\",
		\"placeholder\": \"Your name\"
	},
	{
		\"name\": \"email\",
		\"type\": \"email\",
		\"label\": \"Email\",
		\"placeholder\": \"Email\",
		\"required\": true
	}
]", 
		),

		array(
			'id' 			=> 'offline-fields',
			'name' 			=> __( 'Offline form fields', 'schat' ),
			'lang' 			=> 'json',
			'type' 			=> 'code',
			'default' 		=> "[
	{
		\"name\": \"name\",
		\"type\": \"text\",
		\"label\": \"Your name\",
		\"placeholder\": \"Your name\"
	},
	{
		\"name\": \"email\",
		\"type\": \"email\",
		\"label\": \"Email\",
		\"placeholder\": \"Email\",
		\"required\": true
	},
	{
		\"name\": \"question\",
		\"type\": \"textarea\",
		\"label\": \"Your question?\",
		\"placeholder\": \"Describe your issue\",
		\"required\": true
	},
	{
		\"name\": \"file\",
		\"type\": \"file\",
		\"label\": \"Send a file\"
	}
]"
		)

	);

	//
	// Users options
	//
	$opts['users'] = array(

		array(
			'id' 			=> 'guest-prefix',
			'name' 			=> __( 'Guest prefix', 'schat' ) . '  <span class="schat-red">*</span>',
			'placeholder'	=> __( 'Guest prefix', 'schat' ),
			'desc'			=> __( 'Visitors who didn\'t provide name or email will take guest name. For example, "Guest-1234"', 'schat' ),
			'default'		=> 'Guest-',
			'suffix'		=> '-ID',
			'translate'		=> true,
			'type' 			=> 'text'
		),

		array(
			'name' => __( 'Operators', 'schat' ),
			'type' => 'heading'
		),

		array(
			'desc' => '<a class="button" href="' . admin_url( 'users.php?role=cx_op' ) . '"><strong>' . __( 'List Operators', 'schat' ) . '</strong></a> <a class="button" href="' . admin_url( 'user-new.php?role=cx_op' ) . '">' . __( 'Add New Operator', 'schat' ) . '</a> ',
			'type' => 'note'
		),

		array(
			'id' 		=> 'op-caps',
			'name' 		=> '<span class="dashicons dashicons-admin-network"></span> ' . __( 'Operator capabilities', 'schat' ) . fn_schat_admin_desc( sprintf( __( 'To add more capabilities to CX Operators, consider to use %s plugin or other good one', 'schat' ), '<a href="https://wordpress.org/plugins/wpfront-user-role-editor/" target="_blank">WPFront User Role Editor</a> <span class="schat-ico-new-win"></span>' ), true ),
			'options' 	=> array(
				'answer_visitors' => __( 'Use chat console and answer visitors', 'schat' ) . ' &nbsp; <small class="description">(schat_answer_visitor)</small>',
				'see_chat_logs' => __( 'See chat logs', 'schat' ) . ' &nbsp; <small class="description">(schat_see_logs)</small>',
				'manage_chat_options' => __( 'Manage chat options', 'schat' ) . ' &nbsp; <small class="description">(schat_manage_chat_options)</small>'
			),
			'default'	=> array( 'answer_visitors', 'see_chat_logs' ),
			'type' 		=> 'multicheck'
		)

	);

	//
	// Integrations options
	//
	$opts['integrations'] = array(

		array(
			'name' 			=> '<img src="' . SLC_URL . '/assets/img/logos/firebase.png" height="30" alt="" class="schat-logo"> Firebase',
			'type' 			=> 'heading'
		),

		/*array(
			'desc' 			=> '<div class="schat-firebase-ntf update-nag"><p>' . sprintf( __( 'Create new project with <a href="%s" target="_blank">Google Firebase API</a>', 'schat' ), 'https://console.firebase.google.com' ) . ' <span class="schat-ico-new-win"></span>.',
			'type' 			=> 'note'
		),*/

		array(
			'desc' 			=> '<h3 style="margin-top:0">How to setup?</h3><ol style="margin:0 0 0 15px;">
				<li>' . sprintf( __( 'Create new project with <a href="%s" target="_blank">Google Firebase API</a>', 'schat' ), 'https://console.firebase.google.com' ) . '</li>
				<li>Click <strong>Add Firebase to your web app</strong> link and update the fields below.</li>
				<li>Go to Auth > Sign-in methods and enable both <strong>"Email/password"</strong> and <strong>"Anonymous"</strong>.</li>
				<li>Add <span class="schat-red">' . fn_schat_current_domain() . '</span> to <strong>"OAuth redirect domains"</strong> section on the same page.</li>
			</ol>',
			'type' 			=> 'note'
		),

		/*array(
			'name' 			=> '&nbsp;',
			'custom'		=> '<div style="background-color: #fff; padding: 5px 10px; display: inline-block; border-radius: 5px; margin-bottom: 10px; color: #333; font-size:14px; border: 1px solid #ddd; border-left: 2px solid #FFB400; background: #fafafa;"><p>Use <a href="https://www.firebase.com/account/#/" target="_blank">Legacy Firebase console</a>.<br>Do NOT use new firebase.google.com yet.</p> <a href="https://www.youtube.com/watch?v=QVR-3ppnnrw" class="button" target="_blank" style="margin-top:10px;">Check video tutorial <span class="schat-ico-new-win"></span></a> </div>',
			'type' 			=> 'custom'
		),*/

		array(
			'id' 			=> 'app-key',
			'name' 			=> 'Api Key  <span class="schat-red">*</span>',
			'placeholder'	=> 'apiKey',
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'app-auth',
			'name' 			=> 'Auth Domain  <span class="schat-red">*</span>',
			'placeholder'	=> 'projectId.firebaseapp.com',
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'app-db',
			'name' 			=> 'Database URL  <span class="schat-red">*</span>',
			'placeholder'	=> 'https://databaseName.firebaseio.com',
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'app-bucket',
			'name' 			=> 'Storage Bucket  <span class="schat-red">*</span>',
			'placeholder'	=> 'bucket.appspot.com',
			'type' 			=> 'text'
		),

		/*array(
			'id' 			=> 'app-snippet',
			'name' 			=> 'Web Snippet  <span class="schat-red">*</span>',
			'desc' 			=> 'Go to your Firebase project and click the <strong>Add Firebase to your web app</strong> link. Just copy/paste whole snippet here:',
			'is_code' 		=> true,
			'type' 			=> 'textarea'
		),*/

		/*array(
			'id' 			=> 'app-id',
			'name' 			=> 'App ID  <span class="schat-red">*</span>' . fn_schat_admin_desc( __( 'Your application name', 'schat' ) . '. <a href="https://www.firebase.com/signup/" target="_blank">' . sprintf( __( 'Create free %s account', 'schat' ), 'Firebase' ) . '</a> <span class="schat-ico-new-win"></span>', true ),
			'placeholder' 	=> __( 'App ID', 'schat' ),
			'unit'			=> '.firebaseIO.com',
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'app-secret',
			'name' 			=> 'Secret  <span class="schat-red">*</span>' . fn_schat_admin_desc( sprintf( __( '%s secret key can be found under "%s" menu in your %s dashboard', 'schat' ), 'Firebase', 'SECRETS', 'Firebase' ), true ),
			'placeholder'	=> 'Secret',
			'type' 			=> 'text'
		),

		array(
			'name' 			=> 'Anonymous Login  <span class="schat-red">*</span>',
			'custom'		=> '<div class="schat-anonymous-auth">' . __( 'Checking', 'schat' ) . '...</div>',
			'type' 			=> 'custom'
		),

		array(
			'id' 			=> 'debug',
			'name' 			=> __( 'Debug', 'schat' ) . fn_schat_admin_desc( __( 'Activate debugging when there is an issue on the plugin', 'schat' ), true ),
			'desc' 			=> __( 'Activate browser console debug', 'schat' ),
			'enabled' 		=> __( 'Yes', 'schat' ),
			'disabled' 		=> __( 'No', 'schat' ),
			'type' 			=> 'enable'
		),*/

		/*array(
			'name' 			=> '<img src="' . SLC_URL . '/assets/img/logos/google-maps.png" height="30" alt="" class="schat-logo"> Google Maps',
			'type' 			=> 'heading'
		),

		array(
			'id' 			=> 'gm-api',
			'name' 			=> 'Google Maps API Key' . fn_schat_admin_desc( __( 'Helps you to see user locations on map in chat console', 'schat' ), true ),
			'placeholder'	=> 'API Key',
			'desc'			=> '<a href="https://developers.google.com/maps/documentation/javascript/tutorial#api_key" target="_blank">' . __( 'Get your API key', 'schat' ) . '</a> <span class="schat-ico-new-win"></span>',
			'type' 			=> 'text'
		),*/

		array(
			'name' 			=> '<img src="' . SLC_URL . '/assets/img/logos/pushover.png" height="30" alt="" class="schat-logo"> Pushover',
			'type' 			=> 'heading'
		),

		array(
			'id' 			=> 'pushover-active',
			'name' 			=> __( 'Enable', 'schat' ) . fn_schat_admin_desc( __( 'Install Pushover to your mobile device or desktop (Mac or PC) and receive notifications from the plugin', 'schat' ) . '<br><a href="http://pushover.net" target="_blank">http://pushover.net</a> <span class="schat-ico-new-win"></span>', true ),
			'desc' 			=> __( 'Enable this application', 'schat' ),
			'enabled' 		=> __( 'Yes', 'schat' ),
			'disabled' 		=> __( 'No', 'schat' ),
			'type' 			=> 'enable'
		),

		array(
			'desc' 			=> __( 'Use that image below as "App Icon" when creating your Pushover application:<br><a href="' . SLC_URL . '/assets/img/logos/schat-logo-72px.png" target="_blank"><img src="' . SLC_URL . '/assets/img/logos/schat-logo-72px.png" height="30" alt=""></a>', 'schat' ),
			'type' 			=> 'note'
		),

		array(
			'id' 			=> 'pushover-user-key',
			'name' 			=> __( 'User key', 'schat' ),
			'placeholder' 	=> __( 'User key', 'schat' ),
			'desc' 			=> '<a href="https://pushover.net/apps/build" target="_blank">' . __( 'Create an application and get your keys', 'schat' ) . '</a> <span class="schat-ico-new-win"></span><br>User key is viewable when logged into <a href="https://pushover.net/dashboard" target="_blank">Pushover dashboard</a> <span class="schat-ico-new-win"></span>',
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'pushover-api-token',
			'name' 			=> 'API Token/Key',
			'desc' 			=> __( 'After creating application, you will see the key', 'schat' ),
			'placeholder' 	=> 'API token/key',
			'type' 			=> 'text'
		)

		/*array(
			'id' 			=> 'pushover-notify',
			'name' 			=> __( 'Send notification', 'schat' ),
			'options' 		=> array(
				'new-msg' => __( 'When new message received', 'schat' ),
				'new-user' => __( 'When new user is online', 'schat' ),
				'new-offline' => __( 'When new offline message received', 'schat' )
			),
			'default' 		=> array( 'new-msg', 'new-user' ),
			'type' 			=> 'multicheck'
		)*/


	);

	//
	// Advanced options
	//
	$opts['advanced'] = array(

		array(
			'id' 			=> 'proxy-ips',
			'name' 			=> __( 'Reverse proxy IPs', 'schat' ),
			'placeholder'	=> __( 'Reverse proxy IPs', 'schat' ),
			'desc'			=> __( "If your server is behind a reverse proxy, you must whitelist the proxy IP addresses from which WordPress should trust the HTTP_X_FORWARDED_FOR header in order to properly identify the visitor's IP address. Comma-delimited, e.g. '10.0.1.200,10.0.1.201'", 'schat' ),
			'type' 			=> 'text'
		),

		array(
			'id' 			=> 'custom-css',
			'name' 			=> __( 'Custom CSS', 'schat' ),
			'placeholder'	=> __( 'Custom CSS', 'schat' ),
			'lang' 			=> 'css',
			'type' 			=> 'code'
		)

	);

	//
	// Support options
	//
	$opts['support'] = array();

	return apply_filters( 'schat_admin_opts', $opts );

}