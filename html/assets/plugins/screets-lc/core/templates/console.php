<?php
/**
 * SCREETS © 2016
 *
 * Chat Console
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
global $Schat;
?>

<div id="schat-console" class="schat-w schat-container">
	
	<!-- Settings popup -->
	<div id="schat-settings" class="schat-settings">
		<div class="schat-wrap">

			<h3><?php _e( 'Operator Settings', 'schat' ); ?></h3>
			
			<div class="schat-ntf schat-ntf-settings"></div>

			<form action="" class="schat-form-settings">
				<div class="schat-field">
					<label><span class="schat-red">*</span> <?php _e( 'Pushover Device Name', 'schat' ); ?>: <a class="schat-tooltip schat-tooltip-r" data-title="To find your device name, open your Pushover app in your mobile/desktop and go to settings.">[?]</a></label>
					<input type="text" name="pushover-device" id="schat-f-pushover-device" placeholder="Your device name">
					<small><?php _e( 'Separate multiple devices by a comma ","', 'schat' ); ?></small>
				</div>

				<div class="schat-field">
					<label><?php _e( 'Notifications', 'schat' ); ?>:</label>

					<label>
						<small>
							<input type="checkbox" name="no-ntf-new-visitor" id="schat-f-no-ntf-new-visitor" value="1"> <?php _e( 'Disable new visitor notifications', 'schat' ); ?></small>
					</label>

					<label>
						<small>
							<input type="checkbox" name="no-ntf-new-msg" id="schat-f-no-ntf-new-msg" value="1"> <?php _e( 'Disable new message notifications', 'schat' ); ?></small>
					</label>
				</div>
				
				<div class="schat-field">
					<label>Tools:</label>
					<a href="javascript:;" id="schat-btn-reset" class="button schat-btn-reset schat-tooltip " style="color:#e54045" data-title="<?php _e( 'It is helpful if something wrong in chat connections or chat transmissions. It doesn\'t delete chat data', 'schat' ); ?>"><?php _e( 'Restart', 'schat' ); ?></a>
				</div>

			</form>
		</div>
	</div>
	<div class="schat-overlay"></div>

	<!-- Console header -->
	<div class="schat-top-nav schat-group">
		<div class="schat-logo">
			<img src="<?php echo SLC_URL; ?>/assets/img/NB-logo-150px.png" alt="Night Bird">
		</div>

		<div class="schat-version"><?php echo SLC_VERSION; ?></div>
		
		<!-- Top navigation -->
		<ul class="schat-nav">
			<li><a href="<?php echo SLC_PLUGIN_URL; ?>" target="_blank"><strong><?php echo SLC_NAME_SHORT; ?></strong> <?php echo SLC_EDITION; ?></a></li>
			<li><a href="javascript:;" id="schat-btn-conn" class="schat-btn-conn _schat-connecting"><span class="dashicons dashicons-update"></span> <?php _e( 'Connecting', 'schat' ); ?>...</a></li>
			<li><a href="javascript:;" id="schat-btn-settings" class="schat-btn-settings"><i class="schat-ico schat-ico-options"></i><?php _e( 'Settings', 'schat' ); ?></a></li>
		</ul>

	</div>

	<!-- Main notifications -->
	<div class="schat-ntf schat-ntf-main"></div>

	<!-- Console main content -->
	<div class="schat-main-content schat-group">
		
		<!-- Sidebar -->
		<div id="schat-sidebar" class="schat-sidebar schat-span_1_of_4 schat-col">
			<div class="schat-wrap">

				<!-- Desktop notifications -->
				<div class="schat-desk-ntf-alert">
					<div class="schat-title"><?php _e( 'Get notified of new messages', 'schat' ); ?></div>
					<a id="schat-btn-turn-on" href="javascript:;"><?php _e( 'Turn on desktop notifications', 'schat' ); ?></a>
				</div>

				<!-- Sidebar notifications -->
				<div class="schat-ntf schat-ntf-side"></div>
				
				<!-- Tabs -->
				<ul class="schat-tabs">
					<li><a href="#schat-list-users" class="schat-active"><i class="schat-ico-user"></i></a></li>
					<?php if( current_user_can( 'schat_see_logs' ) ): ?>
						<li><a href="#schat-list-chats"><i class="schat-ico-chat"></i></a></li>
					<?php endif; ?>
				</ul>

				<!-- Users list -->
				<div id="schat-list-users" class="schat-tab-content schat-users-wrap">
					<h3 class="schat-title"><?php _e( 'Users', 'schat' ); ?></h3>
					<ul id="schat-ops" class="schat-users schat-list schat-ops"></ul>
					<ul id="schat-visitors" class="schat-users schat-list schat-visitors"></ul>

					<h3 class="schat-title"><?php _e( 'Web visitors', 'schat' ); ?></h3>
					<ul id="schat-web-visitors" class="schat-users schat-list schat-web-visitors"></ul>
				</div>

				<!-- Chats history -->
				<div id="schat-list-chats" class="schat-tab-content schat-chats-wrap">
					<h3 class="schat-title"><?php _e( 'Chat history', 'schat' ); ?></h3>
					
					<div class="schat-chats-search"><input type="search" name="s" placeholder="<?php _e( 'Search in chats', 'schat' ); ?>" id=""></div>

					<ul id="schat-chats" class="schat-chats schat-list"></ul>
				</div>
			</div>
		</div>

		<!-- Main -->
		<div id="schat-main" class="schat-main schat-span_2_of_4 schat-col">
			<div class="schat-wrap">

				<div id="schat-tab" class="schat-tab">
					
					<!-- Current user tab header -->
					<div class="schat-ntf schat-ntf-tab-header"></div>
					<div id="schat-tab-header" class="schat-tab-header">
						<small>Please select a user from left...</small>
					</div>
					
					<!-- Current chat conversation-->
					<div id="schat-tab-cnv" class="schat-tab-cnv">
						<div class="schat-cnv"></div>
					</div>

				</div>
				
			</div>
		</div>
	
		<!-- Right sidebar -->
		<div id="schat-sidebar2" class="schat-sidebar2 schat-span_1_of_4 schat-col"></div>
	</div>
</div>