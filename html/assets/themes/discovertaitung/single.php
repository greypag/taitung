<?php get_header();

	while(have_posts()): the_post();
		
	  //GETTING META VALUES...
	  $meta_set = get_post_meta($post->ID, '_dt_post_settings', true);
	  if($GLOBALS['force_enable'] == true)
	  	$page_layout = $GLOBALS['page_layout'];
	  else
	  	$page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : $GLOBALS['page_layout'];
	  
	  //BREADCRUMP...
	  get_template_part('includes/breadcrumb_section'); ?>

      <div id="main">
          <div class="container">
              <div class="dt-sc-hr-invisible"></div>
              <div class="dt-sc-hr-invisible-small"></div>
              
              <?php if($page_layout == 'with-left-sidebar'): ?>
              	  <section class="secondary-sidebar secondary-has-left-sidebar" id="secondary-left"><?php get_sidebar('left'); ?></section>
              <?php elseif($page_layout == 'with-both-sidebar'): ?>
              	  <section class="secondary-sidebar secondary-has-both-sidebar" id="secondary-left"><?php get_sidebar('left'); ?></section>
              <?php endif; ?>

			  <?php if($page_layout != 'content-full-width'): ?>
		            <section id="primary" class="page-with-sidebar page-<?php echo esc_attr($page_layout); ?>">
			  <?php else: ?>
		            <section id="primary" class="content-full-width">
              <?php endif;
			  	  //Getting posts format...
				  $format = get_post_format();
		 		  $format = !empty($format) ? $format : 'standard';
				  $pholder = dt_theme_option('general', 'disable-placeholder-images'); ?>

				  <article id="post-<?php the_ID(); ?>" <?php post_class('blog-entry'); ?>>
					  <div class="blog-entry-inner">
                          <div class="entry-meta">
                              <a class="entry_format" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"> </a><?php
							  if(isset($meta_set['disable-date-info']) == ""): ?>                              
                                  <div class="date">
                                      <span><?php echo get_the_date('d'); ?></span>
                                      <?php echo get_the_date('M'); ?> <br /><?php echo get_the_date('Y'); ?>
                                  </div><?php
							  endif; ?>
                          </div>
                          <div class="entry-thumb">
							  <?php if(is_sticky()): ?>
                                  <div class="featured-post"><span><?php _e('Featured','iamd_text_domain'); ?></span></div>
                              <?php endif; ?>

                              <!-- POST FORMAT STARTS -->
                              <?php if( $format === "image" || empty($format) ):
                                      if( has_post_thumbnail() && isset($meta_set['disable-featured-image']) == "" ): ?>
                                      	<div class="entry-thumb-wrapper">
                                          <a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php
                                              $attr = array('title' => get_the_title()); the_post_thumbnail('blog-onecol', $attr); ?>
                                              <div class="blog-image-overlay"><span class="image-overlay-inside"></span></div>
                                          </a>
                                        </div><?php
                                      elseif($pholder != "true" && isset($meta_set['disable-featured-image']) == ""): ?>
                                      	<div class="entry-thumb-wrapper">
                                          <a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
                                              <img src="http<?php echo dt_theme_ssl(true);?>://placehold.it/1070x450&text=<?php the_title(); ?>" width="1070" height="450" alt="<?php the_title(); ?>" />
                                              <div class="blog-image-overlay"><span class="image-overlay-inside"></span></div>
                                          </a>
                                        </div><?php
                                      endif;
                              		elseif( $format === "gallery" ):
                                      $post_meta = get_post_meta(get_the_id() ,'_dt_post_settings', true);
									  $post_meta = is_array($post_meta) ? $post_meta : array();
                                      if( array_key_exists("items", $post_meta) ):
									  	echo '<div class="entry-thumb-wrapper">';
                                          echo "<ul class='entry-gallery-post-slider'>";
                                          foreach ( $post_meta['items'] as $item ) { echo "<li><img src='{$item}' alt='gal-img' /></li>";	}
                                          echo "</ul>";
										  echo "<div id='entry-gallery-pager'>"; $i = 0;
											foreach ( $post_meta['items'] as $item ) { echo "<a data-slide-index='".$i."' href=''><img src='{$item}' /></a>"; $i += 1;	}
										  echo "</div>";
										echo "</div>";
                                      endif;
                                    elseif( $format === "video" ):
                                          $post_meta =  get_post_meta(get_the_id() ,'_dt_post_settings', true);
										  $post_meta = is_array($post_meta) ? $post_meta : array();
                                          if( array_key_exists('oembed-url', $post_meta) || array_key_exists('self-hosted-url', $post_meta) ):
                                              if( array_key_exists('oembed-url', $post_meta) ):
											  	echo '<div class="entry-thumb-wrapper">';
                                                  echo "<div class='dt-video-wrap'>".wp_oembed_get($post_meta['oembed-url']).'</div>';
												echo '</div>';  
                                              elseif( array_key_exists('self-hosted-url', $post_meta) ):
											  	echo '<div class="entry-thumb-wrapper">';
                                                  echo "<div class='dt-video-wrap'>".wp_video_shortcode( array('src' => $post_meta['self-hosted-url']) ).'</div>';
												echo '</div>';
                                              endif;
                                          endif;
                                    elseif( $format === "audio" ):
                                          $post_meta =  get_post_meta(get_the_id() ,'_dt_post_settings', true);
										  $post_meta = is_array($post_meta) ? $post_meta : array();
                                          if( array_key_exists('oembed-url', $post_meta) || array_key_exists('self-hosted-url', $post_meta) ):
                                              if( array_key_exists('oembed-url', $post_meta) ):
											  	echo '<div class="entry-thumb-wrapper">';
                                                  echo wp_oembed_get($post_meta['oembed-url']);
												echo '</div>';
                                              elseif( array_key_exists('self-hosted-url', $post_meta) ):
											  	echo '<div class="entry-thumb-wrapper">';
                                                  echo wp_audio_shortcode( array('src' => $post_meta['self-hosted-url']) );
												echo '</div>';
                                              endif;
                                          endif;
                                    else:
                                      if( has_post_thumbnail() && isset($meta_set['disable-featured-image']) == "" ): ?>
                                      	<div class="entry-thumb-wrapper">
                                          <a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php
                                              $attr = array('title' => get_the_title()); the_post_thumbnail('blog-onecol', $attr); ?>
                                              <div class="blog-image-overlay"><span class="image-overlay-inside"></span></div>
                                          </a>
                                        </div><?php
                                      elseif($pholder != "true" && isset($meta_set['disable-featured-image']) == ""): ?>
                                      	<div class="entry-thumb-wrapper">
                                          <a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
                                              <img src="http<?php dt_theme_ssl(true);?>://placehold.it/1070x450&text=<?php the_title(); ?>" width="1070" height="450" alt="<?php the_title(); ?>" />
                                              <div class="blog-image-overlay"><span class="image-overlay-inside"></span></div>
                                          </a>
                                        </div><?php
                                      endif;
                              		endif; ?>
                              <!-- POST FORMAT ENDS -->
                          </div>

                          <div class="entry-details">
                              <div class="entry-title">
                                  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                              </div>
                              <div class="entry-metadata"><?php
								 if(isset($meta_set['disable-author-info']) == ""): ?>
                                   <p class="author"><span class="fa fa-user"> </span><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author_meta('display_name'); ?></a></p><?php
                                 endif;
                                 if(isset($meta_set['disable-comment-info']) == ""): ?>								
                                   <p><?php comments_popup_link('<span class="fa fa-comment"> </span>0', '<span class="fa fa-comment"> </span>1', '<span class="fa fa-comment"> </span>%', '', '<span class="fa fa-comment"> </span>0'); ?></p><?php
                                 endif; ?>
                              </div>
                              <div class="entry-body"><?php
                                  //PAGE TOP CODE...
								  global $dt_allowed_html_tags;
                                  if(dt_theme_option('integration', 'enable-single-post-top-code') != '') echo wp_kses(stripslashes(dt_theme_option('integration', 'single-post-top-code')), $dt_allowed_html_tags);
                                  the_content();
                                  wp_link_pages(array('before' => '<div class="page-link"><strong>'.__('Pages:', 'iamd_text_domain').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number'));
                                  edit_post_link(__('Edit', 'iamd_text_domain'), '<span class="edit-link">', '</span>' );
                                  echo '<div class="social-bookmark">';
                                  show_fblike('post'); show_googleplus('post'); show_twitter('post'); show_stumbleupon('post'); show_linkedin('post'); show_delicious('post'); show_pintrest('post'); show_digg('post');
                                  echo '</div>';
                                  dt_theme_social_bookmarks('sb-post');
                                  if(dt_theme_option('integration', 'enable-single-post-bottom-code') != '') echo wp_kses(stripslashes(dt_theme_option('integration', 'single-post-bottom-code')), $dt_allowed_html_tags); ?>
                              </div><?php
							  
							  if(isset($meta_set['disable-tag-info']) == ""):
								the_tags('<div class="tags"><span class="fa fa-tags"> </span> '.__('Posted In: ', 'iamd_text_domain'), '', '</div>');
							  endif; ?>
                          </div>
                      </div>
                      <div class="post-nav-container">
                          <div class="prev-post"><?php
							  $p = get_adjacent_post(1, '', 1);
							  if(!empty($p)):
							  	echo '<a href="'.get_permalink($p->ID).'" title="'.$p->post_title.'"><span class="fa fa-angle-left"></span> Previous</a>';
								echo '<p>'.$p->post_title.'</p>';
							  endif; ?>
                          </div>
                          <div class="next-post"><?php
							  $n = get_adjacent_post(1, '', 0);
							  if(!empty($n)):
								echo '<a href="'.get_permalink($n->ID).'" title="'.$n->post_title.'">Next <span class="fa fa-angle-right"></span></a>';
								echo '<p>'.$n->post_title.'</p>';
							  endif; ?>
                          </div>
                      </div>
                      
                      <div class="author-info">
                          <h2 class="section-title"><?php _e('About the Author', 'iamd_text_domain'); ?></h2>
                          <div class="thumb">
	                          <?php echo get_avatar(get_the_author_meta('user_email'), $size = '85'); ?>
                          </div>
                          <div class="author-desc">
                              <div class="author-title"><?php
								$user_info = get_userdata(get_the_author_meta('ID')); ?>
                                <p><?php _e('By', 'iamd_text_domain'); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta('ID')); ?>"><?php echo $user_info->user_login; ?></a> / <?php echo ucfirst(implode(', ', $user_info->roles)); ?></p>
                                <span><i class="fa fa-twitter"></i><a href="https://twitter.com/<?php echo $user_info->user_nicename; ?>"><?php _e('Follow ', 'iamd_text_domain'); echo $user_info->user_nicename; ?></a></span>
                              </div>
                              <sub><?php _e('on', 'iamd_text_domain'); echo get_the_date(' M d, Y'); ?></sub>
                              <p><?php the_author_meta('description'); ?></p>
                          </div>
                      </div>
                  </article>
                  <?php if(dt_theme_option('general', 'global-post-comment') != true && (isset($meta_set['disable-comment']) == "")) comments_template('', true); ?>
				  <div class="dt-sc-hr-invisible"></div>
				  <div class="dt-sc-hr-invisible-small"></div>
              </section>

              <?php if($page_layout == 'with-right-sidebar'): ?>
              	  <section class="secondary-sidebar secondary-has-right-sidebar" id="secondary-right"><?php get_sidebar('right'); ?></section>
              <?php elseif($page_layout == 'with-both-sidebar'): ?>
              	  <section class="secondary-sidebar secondary-has-both-sidebar" id="secondary-right"><?php get_sidebar('right'); ?></section>
              <?php endif;
			  
        endwhile; ?>
          </div>
      </div>

<?php get_footer(); ?>