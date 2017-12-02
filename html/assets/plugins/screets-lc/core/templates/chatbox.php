<?php
/**
 * SCREETS © 2016
 *
 * Full chat box template
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

if ( ! defined( 'ABSPATH' ) ) exit; ?>

<!-- Widget -->
<div id="schat-widget" class="schat-w schat-w-fixed">

	<!-- 
	 ## Chat button
	-->
	<div id="schat-btn" class="schat-chat-btn">
		<i class="schat-ico-l schat-ico-chat"></i>
		<span class="schat-title"></span> <i class="schat-ico-r <?php echo fn_schat_get_chat_icon(); ?>"></i>
		<div class="schat-count">0</div>
	</div>

	<!-- 
	 ## Initial popup 
	-->
	<div id="schat-popup-init" class="schat-popup schat-popup-init" data-mode="init">
		
		<!-- Popup header -->
		<div class="schat-header">
			<span class="schat-title"><?php _e( 'Connecting', 'schat' ) ;?></span><i class="schat-ico-r <?php echo fn_schat_get_chat_icon( 'open' ); ?>"></i>
		</div>

		<!-- Popup content -->
		<div class="schat-content">
			<div class="schat-ntf schat-ntf-init"></div>

			<div class="schat-ntf schat-active"><div class="schat-wait"><?php _e( 'Please wait', 'schat' ); ?>...</div></div>
		</div>
	
	</div>

	<!-- 
	 ## Offline popup 
	-->
	<div id="schat-popup-offline" class="schat-popup schat-popup-offline" data-mode="offline">
		
		<!-- Popup header -->
		<div class="schat-header">
			<span class="schat-title"><?php echo schat__( 'offline-title' ) ;?></span><i class="schat-ico-r <?php echo fn_schat_get_chat_icon( 'open' ); ?>"></i>
		</div>

		<!-- Popup content -->
		<div class="schat-content">
			
			<div class="schat-ntf schat-ntf-offline-top"></div>

			<div class="schat-lead"><?php echo schat__( 'offline-greeting' ) ;?></div>

			<form action="<?php echo SLC_URL; ?>" class="schat-form schat-form-offline" data-name="offline">
				<div class="schat-inner">

					<?php echo fn_schat_build_form( 'offline' ); ?>
				
				</div>

				<div class="schat-ntf schat-ntf-offline"></div>

				<div class="schat-send">
					<a href="javascript:;" class="schat-button schat-send-btn schat-send-offline schat-primary" rel="nofollow"><i class="schat-ico-send"></i> <?php echo schat__( 'offline-btn' ) ;?></a>
				</div>
			</form>

			<div class="schat-footer"><?php echo schat__( 'offline-footer' ) ;?></div>

			<?php echo fn_schat_get_social_links( 'offline' ); ?>

			<?php echo fn_schat_screets_logo(); ?>
		</div>
	</div>

	<!-- 
	 ## Pre-chat popup 
	-->
	<div id="schat-popup-prechat" class="schat-popup schat-popup-prechat" data-mode="prechat">
		
		<!-- Popup header -->
		<div class="schat-header">
			<span class="schat-title"><?php echo schat__( 'prechat-title' ) ;?></span><i class="schat-ico-r <?php echo fn_schat_get_chat_icon( 'open' ); ?>"></i>
		</div>

		<!-- Popup content -->
		<div class="schat-content">
			
			<div class="schat-lead"><?php echo schat__( 'prechat-greeting' ) ;?></div>
			
			<?php 
			if( current_user_can('schat_answer_visitor' ) && !is_admin() ):
				echo __( 'Operators cannot test the plugin from here. Please use other browser or computer to test the plugin', 'schat' ); 
			else:
			?>
			<form action="<?php echo SLC_URL; ?>" class="schat-form schat-form-prechat" data-name="prechat">
				<div class="schat-inner">
					
					<?php echo fn_schat_build_form( 'prechat' ); ?>
				
				</div>

				<div class="schat-ntf schat-ntf-prechat"></div>
				
				<div class="schat-send">
					<a href="javascript:;" class="schat-button schat-send-btn schat-send-prechat schat-primary" rel="nofollow"><?php echo schat__( 'prechat-btn' ) ;?></a>
				</div>
			</form>
			<?php endif; ?>

			<?php echo fn_schat_screets_logo(); ?>
		</div>
	</div>

	<!-- 
	 ## Online popup 
	-->
	<div id="schat-popup-online" class="schat-popup schat-popup-online" data-mode="online">

		<div class="schat-header">
			<span class="schat-title"><?php echo schat__( 'online-title' ) ;?></span><i class="schat-ico-r <?php echo fn_schat_get_chat_icon( 'open' ); ?>"></i>
		</div>

		
		<div class="schat-content">

			<?php 
			if( current_user_can('schat_answer_visitor' ) && !is_admin() ): ?>
				
				<div class="schat-ntf schat-info schat-active">
					<?php echo __( 'Operators cannot test the plugin from here. Please use other browser or computer to test the plugin', 'schat' );  ?>
				</div>
			
			<?php else: ?>
				
				<!-- Notifications -->
				<div class="schat-ntf schat-ntf-online"></div>
				
				<!-- Conversation -->
				<div class="schat-cnv"></div>

				<!-- Links -->
				<ul class="schat-links">
					<li class="schat-typing"></li>
					<li><a href="#" class="schat-btn-end-chat"><i class="schat-ico-logout"></i><?php _e( 'End chat', 'schat' ); ?></a></li>
				</ul>
				
				<!-- Reply box -->
				<div class="schat-reply-box schat-row">
					<span class="schat-col">
						<textarea name="msg" class="schat-reply" placeholder="<?php echo schat__( 'str-reply-ph'  ) ;?>" disabled="disabled"></textarea>
					</span>
					<span class="schat-col">
						<a href="javascript:void(0);" class="schat-reply-send schat-button schat-primary schat-small"><?php echo schat__(  'str-reply-send' ); ?></a>
					</span>
				</div>
			
			<?php endif; ?>
			
		</div>

	</div>

	<!-- 
	 ## Postchat popup 
	-->
	<div id="schat-popup-postchat" class="schat-popup schat-popup-postchat" data-mode="postchat">
		
		<div class="schat-header">
			<span class="schat-title"><?php echo schat__( 'postchat-title' ) ;?></span><i class="schat-ico-r <?php echo fn_schat_get_chat_icon( 'open' ); ?>"></i>
		</div>
		
		<!-- Popup content -->
		<div class="schat-content">
			<div class="schat-lead"><?php echo schat__( 'postchat-greeting' ) ;?></div>
			
			<!-- Notifications -->
			<div class="schat-ntf schat-ntf-postchat"></div>

			<!-- Rate our support -->
			<div class="schat-subtitle"><?php echo schat__( 'poschat-feedback-title' ); ?></div>
			<ul class="schat-vote">
				<li><a href="#" class="schat-button schat-small schat-btn-vote" data-vote="like"><i class="schat-ico-like"></i><span><?php echo schat__( 'poschat-feedback-like' ); ?></span></a></li>
				<li><a href="#" class="schat-button schat-small schat-btn-vote" data-vote="dislike"><i class="schat-ico-dislike"></i><span><?php echo schat__( 'poschat-feedback-dislike' ); ?></span></a></li>
			</ul>

			<!-- <div class="schat-feedback-box"><textarea name="feedback" id="schat-feedback" class="schat-feedback" placeholder="<?php _e( 'Your feedback', 'schat' ); ?>"></textarea></div> -->

			<ul class="schat-links">
				<li>
					<a href="#" class="btn-email-chat"><span class="schat-ico-mail"></span> <?php echo schat__( 'postchat-btn-email' ); ?></a>
					
					<!-- Email field -->
					<div class="schat-row schat-form-email">
						<div class="schat-col"><input type="email" name="email" class="schat-f-email" placeholder="<?php echo schat__( 'postchat-f-email' ); ?>"></div>
						<div class="schat-col"><a href="#" class="schat-button schat-send"><?php echo schat__( 'postchat-btn-send' ); ?></a></div>
					</div>
				</li>
				<li>
					<a href="#" class="btn-done"><span class="schat-ico-ok"></span> <?php echo schat__( 'postchat-btn-done' ); ?></a>
				</li>
			</ul>

			<!-- <div class="schat-button-wrap">
				<a href="#" class="btn-done schat-button schat-primary"><?php echo schat__( 'postchat-btn-done' ); ?></a>
			</div> -->

			<?php echo fn_schat_get_social_links( 'postchat' ); ?>

			<?php echo fn_schat_screets_logo(); ?>
			
		</div>

	</div>

</div>