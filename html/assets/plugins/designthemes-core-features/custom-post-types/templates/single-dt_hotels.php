<?php get_header();
	
	global $dt_allowed_html_tags;
	while(have_posts()): the_post();
	
	  //GETTING META VALUES...
	  $meta_set = get_post_meta($post->ID, '_hotel_settings', true);
	  if($GLOBALS['force_enable'] == true)
	  	$page_layout = $GLOBALS['page_layout'];
	  else
	  	$page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : $GLOBALS['page_layout'];
	
	  //BREADCRUMP...
	  get_template_part('includes/breadcrumb_section');
	  
	  //RATING CALCULATION...
	  $notes = array( 0 => __('No Rating Yet', 'dt_themes'), 1 => __('Very Poor', 'dt_themes'), 2 => __('Not that bad', 'dt_themes'), 3 => __('Average', 'dt_themes'), 4 => __('Good', 'dt_themes'), 5 => __('Perfect', 'dt_themes'));
	  $arr_rate = dt_theme_comment_rating_count(get_the_ID());
	  $all_avg = dt_theme_comment_rating_average(get_the_ID());
	  
	  $map_code = '';
	  $map_code = '<div class="widget">';
	  	$map_code .= '<h3 class="widgettitle">'.__('Here we are', 'dt_themes').'</h3>';
		$map_code .= '<div id="hotel_map_'.get_the_ID().'" class="list-hotel-map" data-add="'.get_the_title().', '.esc_attr(@$meta_set['hotel_add']).'" data-lt="'.esc_attr(@$meta_set['hotel_lat']).'" data-lg="'.esc_attr(@$meta_set['hotel_long']).'"></div>';
	  $map_code .= '</div>'; ?>
      
      <div id="main">
          <div class="container">
            <div class="dt-sc-hr-invisible"></div>
            <div class="dt-sc-hr-invisible-small"></div>
            
			<?php if($page_layout == 'with-left-sidebar'): ?>
                <section class="secondary-sidebar secondary-has-left-sidebar" id="secondary-left"><?php echo $map_code; get_sidebar('left'); ?></section>
            <?php elseif($page_layout == 'with-both-sidebar'): ?>
                <section class="secondary-sidebar secondary-has-both-sidebar" id="secondary-left"><?php get_sidebar('left'); ?></section>
            <?php endif; ?>
            
			<?php if($page_layout != 'content-full-width'): ?>
                  <section id="primary" class="page-with-sidebar page-<?php echo esc_attr($page_layout); ?>">
            <?php else: ?>
                  <section id="primary" class="content-full-width">
            <?php endif; ?>
            
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php echo get_the_term_list($post->ID, 'hotel_entries', '<p class="hotel-type">', ' ', '</p>'); ?>
					<h1 class="section-title hotel-title"><?php the_title(); ?></h1><sub><?php echo wp_kses($meta_set['hotel_add'], $dt_allowed_html_tags);?></sub><?php
					
                    echo '<div class="star-rating-wrapper"><div class="star-rating"><span style="width:'.(($all_avg/5)*100).'%"></span></div>('.__('Average ', 'dt_themes').$all_avg.__(' of ', 'dt_themes').count($arr_rate).__(' Ratings', 'dt_themes').')</div><div class="dt-sc-hr-invisible"></div>';
					//Hotel Content Starts...
					the_content();
					wp_link_pages(array('before' => '<div class="page-link"><strong>'.__('Pages:', 'dt_themes').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number'));
					edit_post_link(__('Edit', 'dt_themes'), '<span class="edit-link">', '</span>' );

					if(@array_key_exists("show-book-now", $meta_set)): ?>
						<p class="aligncenter"><a href="<?php echo dt_theme_page_permalink_by_its_template('tpl-booking.php'); ?>" class="theme-btn dt-sc-button medium"><?php _e('Book Now', 'dt_themes'); ?></a></p><?php
					endif;
					
					if( @array_key_exists("items", $meta_set) ):
						echo '<div class="dt-sc-hr-invisible-small"></div><div class="clear"></div>';
						echo "<ul class='entry-gallery-post-slider'>";
							foreach ( $meta_set['items'] as $item ) { echo "<li><img src='{$item}' alt='hotel-img' /></li>";	}
						echo "</ul>";
						echo "<div id='entry-gallery-pager'>"; $i = 0;
							foreach ( $meta_set['items'] as $item ) { echo "<a data-slide-index='".$i."' href=''><img src='{$item}' alt='hotel-img' /></a>"; $i += 1;	}
						echo "</div>";
						echo '<div class="dt-sc-hr-invisible"></div><div class="dt-sc-hr-invisible-small"></div><div class="clear"></div>';
					endif;
                    //Ratings...
                    if(isset($meta_set['show-ratings']) != ""): ?>
                        <h2 class="section-title"><?php echo count($arr_rate); _e('&nbsp;People have Rated', 'dt_themes'); ?></h2>
                        <div class="dt-sc-four-sixth column first">
                            <div class="rating-wrapper"><?php
                                $split_rate = array_count_values($arr_rate);
                                //Performing ratings...
                                for($i = 5; $i >= 1; $i--):
                                    if(!isset($split_rate[$i])) $split_rate[$i] = 0;
                                        echo '<div class="rating-item">';
                                            echo '<ul>';
                                                echo '<li class="rate-number">'.$i.' '.__('Stars', 'dt_themes').'</li>';
                                                echo '<li class="rate-starts"><p class="pack-rating rate-'.$i.'"><span></span></p></li>';
                                                $p = @($split_rate[$i] / count($arr_rate)) * 100;
                                                echo '<li class="rate-percent"><span style="background:#6dc82b; width:'.round($p, 1).'%; display:block; height:100%;"></span></li>';
                                                echo '<li class="rate-total">'.$split_rate[$i].'</li>';
                                            echo '</ul>';
                                        echo '</div>';
                                endfor; ?>
                            </div>
                        </div>
                        <div class="dt-sc-two-sixth column">
                            <div class="overal-rating-wrapper">
                                <div class="overal-rating">
                                    <p><?php echo $all_avg; ?></p>
                                </div>
                                <h2><?php echo $notes[round($all_avg)]; ?></h2>
                                <p><?php _e('Based on Ratings from', 'dt_themes'); echo '&nbsp;'.count($arr_rate).'&nbsp;'; _e('People', 'dt_themes'); ?></p>
                                <a href="#respond" class="theme-btn dt-sc-button medium"><?php _e('Write a Review', 'dt_themes'); ?></a>
                            </div>
                        </div>
                        <div class="clear"></div><?php
					endif;
					//Reviews...
					if(isset($meta_set['show-reviews']) != "") comments_template('/custom-comments.php', true); ?>
                </article>
                
            </section>
            
			<?php if($page_layout == 'with-right-sidebar'): ?>
                <section class="secondary-sidebar secondary-has-right-sidebar" id="secondary-right"><?php echo $map_code; get_sidebar('right'); ?></section>
            <?php elseif($page_layout == 'with-both-sidebar'): ?>
                <section class="secondary-sidebar secondary-has-both-sidebar" id="secondary-right"><?php echo $map_code; get_sidebar('right'); ?></section>
            <?php endif; ?>
            
          </div>
      </div><?php
      endwhile; ?>

<?php get_footer(); ?>