<?php
	//PERFORMING GALLERY POST LAYOUT...
	$page_layout = dt_theme_option('specialty', 'gallery-archives-layout');
	if($GLOBALS['force_enable'] == true)
	  $page_layout = $GLOBALS['page_layout'];
	else
	  $page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : $GLOBALS['page_layout'];

	$post_layout = dt_theme_option('specialty', 'gallery-archives-post-layout');
	$post_layout = !empty($post_layout) ? $post_layout : 'one-half-column';

	$li_class = "";
	$feature_image = "";

	//POST LAYOUT CHECK...
	switch($post_layout) {
		case "one-column":
			$li_class = "portfolio dt-sc-one-half column"; $feature_image = "gallery-twocol"; break;

		case "one-half-column":
			$li_class = "portfolio dt-sc-one-half column"; $feature_image = "gallery-twocol"; break;

		case "one-third-column":
			$li_class = "portfolio dt-sc-one-third column"; $feature_image = "gallery-threecol"; break;

		case "one-fourth-column":
			$li_class = "portfolio dt-sc-one-fourth column"; $feature_image = "gallery-fourcol"; break;
	}
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

	global $wp_query;	//FOR PAGINATION PURPOSE...
	if(have_posts()): ?>

     <div class="dt-sc-portfolio-container"><?php
		while(have_posts()): the_post(); ?>
			<div class="<?php echo $li_class; ?> no-space">
              <figure><?php
				$fullimg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
				$currenturl = $fullimg[0];
                $currenticon = "fa-plus";
				$pmeta_set = get_post_meta($post->ID, '_gallery_settings', true);
				if( @array_key_exists('items_thumbnail', $pmeta_set) && ($pmeta_set ['items_name'] [0] == 'video' )) {
					$currenturl = $pmeta_set ['items'][0];
					$currenticon = "fa-video-camera";
				}
				//GALLERY IMAGES...
				if(has_post_thumbnail()):
					$attr = array('title' => get_the_title(), 'alt' => get_the_title());
					the_post_thumbnail($feature_image, $attr);
				else: ?>
					<img src="http<?php dt_theme_ssl(true);?>://placehold.it/1170X878.jpg&text=<?php the_title(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /><?php
				endif; ?>
				<figcaption>
                  <div class="fig-content-wrapper">
                    <div class="fig-content">
                        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        <p><?php echo get_the_term_list($post->ID, 'gallery_entries', ' ', ', ', ' '); ?></p>
                        <div class="fig-overlay">
                            <a class="zoom" title="<?php the_title(); ?>" data-gal="prettyPhoto[gallery]" href="<?php echo $currenturl; ?>"><span class="fa <?php echo $currenticon; ?>"> </span></a>
                            <a class="link" href="<?php the_permalink(); ?>"> <span class="fa fa-link"> </span> </a>
                            <?php if(dt_theme_is_plugin_active('roses-like-this/likethis.php')): ?>
                                <?php printLikes($post->ID); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                  </div>
                </figcaption>
              </figure>
	        </div><?php
		endwhile; ?>
     </div>
	 <div class="dt-sc-hr-invisible"></div><?php
	 //Pagination...
	 if($wp_query->max_num_pages > 1): ?>
		<div class="pagination blog-pagination">
			<?php if(function_exists("dt_theme_pagination")) echo dt_theme_pagination("", $wp_query->max_num_pages, $wp_query); ?>
		</div><?php
	 endif;
	 wp_reset_query($wp_query);
	 else: ?>
		<h2><?php _e('Nothing Found.', 'dt_themes'); ?></h2>
		<p><?php _e('Apologies, but no results were found for the requested archive.', 'dt_themes'); ?></p><?php
	endif; ?>
