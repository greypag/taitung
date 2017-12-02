<?php
	//PERFORMING HOTELS POST LAYOUT...
	$meta_set = get_post_meta($post->ID, '_tpl_default_settings', true);
	if($GLOBALS['force_enable'] == true)
	  $page_layout = $GLOBALS['page_layout'];
	else
	  $page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : $GLOBALS['page_layout'];
	
	$li_class = "column dt-sc-one-column";
	$feature_image = "hotel-thumb";
	
	//BETTER IMAGE SIZE...
	switch($page_layout) {
		case "with-left-sidebar":
			$li_class = $li_class." with-sidebar";
			$feature_image = $feature_image."-sidebar";
			break;
		
		case "with-right-sidebar":
			$li_class = $li_class." with-sidebar";
			$feature_image = $feature_image."-sidebar";
			break;

		case "with-both-sidebar":
			$li_class = $li_class." with-sidebar";
			$feature_image = $feature_image."-bothsidebar";
			break;
	}
	
	//POST VALUES....
	$limit = $meta_set['hotels-post-per-page'];
	$cats  = $meta_set['hotels-categories'];
	
	$cats = array_filter(array_unique($cats));
	
	if(empty($cats)) {
		$cats = get_categories('taxonomy=hotel_entries&hide_empty=1');
		$cats = get_terms( array('hotel_entries'), array('fields' => 'ids'));
	}
	global $dt_allowed_html_tags;
	$search_text = !empty($_REQUEST['search_text']) ? wp_kses($_REQUEST['search_text'], $dt_allowed_html_tags) : "";
	
	//PERFORMING QUERY...
	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
	elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
	else { $paged = 1; }
	
	//PERFORMING QUERY...
	if(isset($_REQUEST['search_text'])):
		$args = array('post_type' => 'dt_hotels', 'paged' => $paged , 'posts_per_page' => $limit, 'tax_query' => array( array( 'taxonomy' => 'hotel_entries', 'field' => 'id', 'terms' => $cats)),
																					'meta_query' => array( array( 'key' => '_hotel_settings', 'value' => $search_text, 'compare' => 'LIKE')));
		$wp_query = new WP_Query($args);
		if($wp_query->found_posts == 0):
			$args = array('post_type' => 'dt_hotels', 'paged' => $paged , 'posts_per_page' => $limit, 'tax_query' => array(array( 'taxonomy' => 'hotel_entries', 'field' => 'id', 'terms' => $cats)),'s' => $search_text);
		endif;
	else:
		$args = array('post_type' => 'dt_hotels', 'paged' => $paged , 'posts_per_page' => $limit, 'tax_query' => array( array( 'taxonomy' => 'hotel_entries', 'field' => 'id', 'terms' => $cats)));
	endif;
	
	$wp_query = new WP_Query($args);
	if($wp_query->have_posts()): ?>
    
      <div class="dt-sc-hr-invisible"></div>
      <div class="search-container" id="entry-search">
          <form name="frmsearch" action="<?php the_permalink(); ?>" method="get">
              <p><input type="text" name="search_text" value="<?php echo esc_attr($search_text); ?>" placeholder="<?php _e('Search by name, address, offer etc...', 'iamd_text_domain'); ?>" /></p>
              <input type="submit" value="<?php _e('Find Hotels', 'iamd_text_domain'); ?>">
          </form>
      </div>
      <div class="dt-sc-hr-invisible"></div>
      
      <h2 class="section-title entry-title"><?php _e('Hotels in : ', 'iamd_text_domain'); echo $search_text; ?></h2><?php
	  $maxpages = ($wp_query->max_num_pages != 0) ?  $wp_query->max_num_pages : 1;	  
      echo '<p class="entry-result-count">'.__('Showing Results ', 'iamd_text_domain').$wp_query->query_vars['paged'].__(' of ', 'iamd_text_domain').$maxpages.'</p>';
	  
	  //Show Hotels Filter...
	  if(isset($meta_set['hotels-filter']) != ""): ?>
         <div class="dt-sc-entry-sorting">
            <a href="#" data-filter="*" class="first active_sort"><?php _e('All', 'iamd_text_domain'); ?> (<?php echo $wp_query->post_count; ?>) </a>
            <?php
				foreach($cats as $term) {
					$myterm = get_term_by('id', $term, 'hotel_entries');
					?><a href="#" data-filter=".<?php echo strtolower($myterm->slug); ?>"><?php echo $myterm->name; ?> (<?php echo $myterm->count; ?>)</a><?php
				}?>
         </div><?php
	 endif; ?>
     
     <div class="dt-sc-hotels-container"><?php
		while($wp_query->have_posts()): $wp_query->the_post(); 
			$terms = wp_get_post_terms($post->ID, 'hotel_entries', array("fields" => "slugs")); array_walk($terms, "arr_strfun");
			$hotel_meta = array();
			$hotel_meta = get_post_meta(get_the_id() ,'_hotel_settings', true); ?>
			<div class="<?php echo $li_class." ".strtolower(implode(" ", $terms)); ?>">
                <div class="hotel-item hotel-list-view">
                    <div class="hotel-thumb">
                    	<div class="thumb-wrapper">
							<?php if(array_key_exists("offer_value", $hotel_meta)): ?>
                                <p class="hotel-offer"><span><?php echo $hotel_meta['offer_value']; ?></span></p>
                            <?php endif; ?>
                             <a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php
                                if( has_post_thumbnail() ):
                                    $attr = array('title' => get_the_title()); the_post_thumbnail($feature_image, $attr);
                                endif; ?>
                                <div class="image-overlay"><span class="image-overlay-inside"></span></div>
                             </a>
						</div>
                        <p>
                          <?php if(array_key_exists("show-book-now", $hotel_meta) && dt_theme_option('general', 'disable-hotel-booking') == "on"): ?>
                              <a data-title="<?php the_title(); ?>" href="#booknow_wrapper" class="dt-sc-button theme-btn too-small btn-book"><?php _e('Book Now', 'iamd_text_domain'); ?></a>
                          <?php elseif(array_key_exists("show-book-now", $hotel_meta)): ?>
                              <a href="<?php echo dt_theme_page_permalink_by_its_template('tpl-booking.php'); ?>" class="dt-sc-button theme-btn too-small"><?php _e('Book Now', 'iamd_text_domain'); ?></a>
                          <?php endif; ?>
                          <a href="<?php the_permalink();?>" class="dt-sc-button too-small yellow"><?php _e('View Details', 'iamd_text_domain'); ?></a>
                        </p>
                    </div>
                    <div class="hotel-details">
                        <h2><a href="<?php the_permalink();?>"><?php the_title(); ?>, <sub><?php echo $hotel_meta['hotel_add'];?></sub></a></h2><?php
                        echo get_the_term_list($post->ID, 'hotel_entries', '<p class="hotel-type">', ' ', '</p>');

						if(isset($meta_set['hotel-post-excerpt']) != "")
							echo dt_theme_excerpt($meta_set['hotel-post-excerpt-length']);

						//RATING CALCULATION...
						$arr_rate = dt_theme_comment_rating_count(get_the_ID());
						$all_avg = dt_theme_comment_rating_average(get_the_ID());

						echo '<div class="star-rating-wrapper"><div class="star-rating"><span style="width:'.(($all_avg/5)*100).'%"></span></div>('.count($arr_rate).__(' Ratings', 'iamd_text_domain').')</div>'; ?>

						<a href="<?php the_permalink(); ?>#hotel_map_<?php the_ID(); ?>" class="map-marker small"> <span class="red"></span><?php _e('View on Map', 'iamd_text_domain'); ?></a><?php
						if(get_post_meta(get_the_id() ,'starting_price', true)): ?>
                            <div class="hotel-thumb-meta">
                                <div class="hotel-price"><?php _e('Starts From', 'iamd_text_domain'); ?> <span><?php echo dt_theme_option("smodule","currency").get_post_meta(get_the_id() ,'starting_price', true) ;?></span></div>
                                <?php if(array_key_exists("specially_whome", $hotel_meta)): ?>
                                    <span class="hotel-option-type">
                                        <a href="<?php the_permalink();?>"><?php echo wp_kses($hotel_meta['specially_whome'], $dt_allowed_html_tags); ?></a>
                                    </span><?php
								endif; ?>
                            </div><?php
						endif; ?>
                    </div>
                </div>
	        </div><?php
		endwhile; ?>
     </div>
     <div style="display:none;">
         <div id="booknow_wrapper" class="booknow-container">
            <div id="ajax_message"> </div>
            <form name="frmbooknow" class="booknow-frm" action="<?php echo get_template_directory_uri(); ?>/framework/booknow.php" method="post">
                <p><input type="text" name="txtfname" required="required" placeholder="<?php _e('Name (required)', 'iamd_text_domain'); ?>" /></p>
                <p><input type="email" name="txtemail" required="required" placeholder="<?php _e('Email (required)', 'iamd_text_domain'); ?>" /></p>
                <p><input type="text" name="txtdate" required="required" placeholder="<?php _e('Date of Arrival (required)', 'iamd_text_domain'); ?>" /></p>
                <p><input type="text" name="txtphone" placeholder="<?php _e('Phone', 'iamd_text_domain'); ?>" /></p>
                <p><textarea name="txtmessage" rows="3" cols="32" placeholder="<?php _e('Message', 'iamd_text_domain'); ?>"></textarea></p>
                <p><input type="submit" name="subsend" value="<?php _e('Send', 'iamd_text_domain'); ?>" /></p>
                <input type="hidden" name="hidbookadminemail" value="<?php echo get_bloginfo('admin_email'); ?>" />
                <input type="hidden" name="hidbooksuccess" value="<?php _e('Thanks for Booking us, We will call back to you soon.', 'iamd_text_domain'); ?>" />
                <input type="hidden" name="hidbookerror" value="<?php _e('Sorry your message not sent, Try again Later.', 'iamd_text_domain'); ?>" />
                <input type="hidden" id="hidhotelname" name="hidhotelname" />
            </form>
         </div>
	 </div><?php
	 //Check maximum no.of pages...
	 if($wp_query->max_num_pages > 1): ?>
		<div class="pagination blog-pagination">
			<?php if(function_exists("dt_theme_pagination")) echo dt_theme_pagination("", $wp_query->max_num_pages, $wp_query); ?>
		</div><?php
	 endif;
	 wp_reset_query($wp_query);
	 else: ?>
		<h2><?php _e('Nothing Found.', 'iamd_text_domain'); ?></h2>
		<p><?php _e('Apologies, but no results were found for the requested archive.', 'iamd_text_domain'); ?></p><?php
	endif; ?>