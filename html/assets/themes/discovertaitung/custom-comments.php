<?php
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
 
if ( post_password_required() ) { ?>
	<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'iamd_text_domain'); ?></p>
<?php 
	return;
}
?>
<!-- START EDITING HERE. -->

<?php if(have_comments()): ?>
	
	<?php if(get_comment_pages_count() > 1 && get_option('page_comments')): ?>
    	<div class="pagination">
            <ul class="commentNav">
                <li><?php previous_comments_link(); ?></li>
                <li><?php next_comments_link(); ?></li>
            </ul>
		</div>
	<?php endif; ?>
    
    <div class="reviewentries" id="reviews">
		<h2 class="section-title"><?php comments_number(__('No Travellers Word', 'iamd_text_domain'), __('Travellers Word (1)', 'iamd_text_domain'), __('Travellers Word (%)', 'iamd_text_domain')); ?></h2>
        <div class="reviewlist">
            <?php wp_list_comments('avatar_size=62&type=comment&callback=dt_theme_hotel_comments&style=div'); ?>
        </div>
	</div><?php
	else:
		if('open' == $post->comment_status): ?>
            <h2 class="section-title"><?php _e('No Travellers Word', 'iamd_text_domain'); ?></h2><?php
		endif;
	endif;
	
	//PERFORMING COMMENT FORM...
	if('open' == $post->comment_status):

		$commenter = wp_get_current_commenter();

		$comment_form = array(
			'title_reply'          => __('Leave a Review', 'iamd_text_domain'),
			'comment_notes_before' => '',
			'comment_notes_after'  => '',
			'fields'               => array(
				'author' => '<div class="dt-sc-one-half column"><p><input id="author" name="author" type="text" required="" placeholder="'.__('Name (required)', 'iamd_text_domain').'" /></p>',
				'email'  => '<p><input id="email" name="email" type="text" required="" placeholder="'.__('Email (required)', 'iamd_text_domain').'" /></p>',
				'url' 	 => '<p><input id="url" name="url" type="text" placeholder="'.__('Website', 'iamd_text_domain').'" /></p></div>'
			),
			'label_submit'  => __('Submit Review', 'iamd_text_domain'),
			'logged_in_as'  => '',
			'comment_field' => '',
			'cancel_reply_link' => __('cancel reply', 'iamd_text_domain')
		);

		$comment_form['comment_field'] = '<div class="dt-sc-one-column column"><p><textarea id="comment" name="comment" placeholder="'.__('Message', 'iamd_text_domain').'"></textarea></p></div>';

		$comment_form['comment_field'] .= '<div class="dt-sc-one-half column first"><p><input type="text" id="profession" name="profession" placeholder="'.__('Profession', 'iamd_text_domain').'"></p>
			<p><input type="text" id="title" name="title" required="" placeholder="'.__('Title (required)', 'iamd_text_domain').'"></p>
			<p><label for="dt-rating">' . __( 'Your Rating', 'iamd_text_domain' ) .'</label><select name="rating" id="dt-rating">
			<option value="">' . __( 'Rate&hellip;', 'iamd_text_domain' ) . '</option>
			<option value="5">' . __( 'Perfect', 'iamd_text_domain' ) . '</option>
			<option value="4">' . __( 'Good', 'iamd_text_domain' ) . '</option>
			<option value="3">' . __( 'Average', 'iamd_text_domain' ) . '</option>
			<option value="2">' . __( 'Not that bad', 'iamd_text_domain' ) . '</option>
			<option value="1">' . __( 'Very Poor', 'iamd_text_domain' ) . '</option>
		</select></p></div>';

		comment_form( $comment_form );

	endif; ?>