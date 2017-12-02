<?php
	//PERFORMING BLOG POST LAYOUT...
	$meta_set = get_post_meta($post->ID, '_tpl_default_settings', true);
	if($GLOBALS['force_enable'] == true)
	  $page_layout = $GLOBALS['page_layout'];
	else
	  $page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : $GLOBALS['page_layout'];
	$post_layout = !empty($meta_set['blog-post-layout']) ? $meta_set['blog-post-layout'] : 'one-column';

	$article_class = "";
	$feature_image = "blog-onecol";
	$column = "";

	//POST LAYOUT SWITCH...
	switch($post_layout) {
		case "one-column":
			$article_class = "column dt-sc-one-column"; $feature_image = "blog-onecol"; break;

		case "one-half-column":
			$article_class = "column dt-sc-one-half"; $feature_image = "blog-twocol"; $column = 2; break;

		case "one-third-column":
			$article_class = "column dt-sc-one-third"; $feature_image = "blog-threecol"; $column = 3; break;

		case "thumb":
			$article_class = "column blog-thumb"; $feature_image = "blog-thumb"; break;
	}
	//BETTER IMAGE SIZE...
	switch($page_layout) {
		case "with-left-sidebar":
			$article_class = $article_class." with-sidebar";
			$feature_image = $feature_image."-sidebar";
			break;
		
		case "with-right-sidebar":
			$article_class = $article_class." with-sidebar";
			$feature_image = $feature_image."-sidebar";
			break;

		case "with-both-sidebar":
			$article_class = $article_class." with-sidebar";
			$feature_image = $feature_image."-bothsidebar";
			break;
	}

	//POST VALUES....
	$limit = $meta_set['blog-post-per-page'];
	$cats  = $meta_set['blog-post-exclude-categories'];
	
	$cats = array_filter(array_unique($cats));
	
	if(count($cats) == 0) array_push($cats, '0');
	
	//PERFORMING QUERY...
	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
	elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
	else { $paged = 1; }
		
	$args = array('post_type' => 'post', 'paged' => $paged, 'posts_per_page' => $limit, 'category__not_in' => $cats, 'ignore_sticky_posts' => 1);
	$wp_query = new WP_Query($args);
	
	if($wp_query->have_posts()): $i = 1;
	 echo '<div class="blog-isotope-wrapper">';
	 while($wp_query->have_posts()): $wp_query->the_post();
	 
	 	$temp_class = "";
		
		if($i == 1) $temp_class = $article_class." first"; else $temp_class = $article_class;
		if($i == $column) $i = 1; else $i = $i + 1;
	 	  $format = get_post_format();
		  $format = !empty($format) ? $format : 'standard';
		  $pholder = dt_theme_option('general', 'disable-placeholder-images'); ?>
          
          <div class="<?php echo $temp_class; ?>">
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
								  if( has_post_thumbnail() ): ?>
                                  	<div class="entry-thumb-wrapper">
									  <a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php
										  $attr = array('title' => get_the_title()); the_post_thumbnail($feature_image, $attr); ?>
										  <div class="blog-image-overlay"><span class="image-overlay-inside"></span></div>
									  </a>
									</div><?php
								  elseif($pholder != "true"): ?>
                                  	<div class="entry-thumb-wrapper">
									  <a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
										  <img src="http<?php dt_theme_ssl(true);?>://placehold.it/1170x800&text=<?php the_title(); ?>" width="1170" height="800" alt="<?php the_title(); ?>" />
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
									  echo '<div class="blog-image-overlay"><span class="image-overlay-inside"></span></div>';
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
								  if( has_post_thumbnail() ): ?>
                                  	<div class="entry-thumb-wrapper">
									  <a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php
										  $attr = array('title' => get_the_title()); the_post_thumbnail($feature_image, $attr); ?>
										  <div class="blog-image-overlay"><span class="image-overlay-inside"></span></div>
									  </a>
                                    </div><?php
								  elseif($pholder != "true"): ?>
                                  	<div class="entry-thumb-wrapper">
									  <a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
										  <img src="http<?php dt_theme_ssl(true);?>://placehold.it/1170x800&text=<?php the_title(); ?>" width="1170" height="800" alt="<?php the_title(); ?>" />
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
                          <div class="entry-metadata">
                          	  <?php
		                        if(isset($meta_set['disable-author-info']) == ""): ?>
                                	<p class="author"><span class="fa fa-user"> </span><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author_meta('display_name'); ?></a></p><?php
								endif;
								if(isset($meta_set['disable-comment-info']) == ""): ?>								
                	                <p><?php comments_popup_link('<span class="fa fa-comment"> </span>0', '<span class="fa fa-comment"> </span>1', '<span class="fa fa-comment"> </span>%', '', '<span class="fa fa-comment"> </span>0'); ?></p><?php
								endif; ?>	
                          </div>
                          <div class="entry-body"><?php
						  	  if(isset($meta_set['blog-post-excerpt']) != "")
                        		echo dt_theme_excerpt($meta_set['blog-post-excerpt-length']); ?>
                          </div><?php
						  if(isset($meta_set['disable-tag-info']) == ""):
							the_tags('<div class="tags"><span class="fa fa-tags"> </span> '.__('Posted In:', 'iamd_text_domain').'&nbsp;&nbsp;&nbsp;&nbsp;', '', '</div>');
						  endif; ?>
                      </div>
                  </div>
              </article>
          </div><?php
	 endwhile;
	 echo '</div>';
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