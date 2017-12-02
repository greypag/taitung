<?php
	global $dt_allowed_html_tags;

	//PERFORMING PLACES POST LAYOUT...
	$page_layout = dt_theme_option('specialty', 'post-archives-layout');
	if($GLOBALS['force_enable'] == true)
	  $page_layout = $GLOBALS['page_layout'];
	else
	  $page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : $GLOBALS['page_layout'];

	$li_class = "column dt-sc-one-third"; $column = 3;

	//PAGE LAYOUT CHECK...
	if($page_layout != "content-full-width") {
		$li_class = $li_class." with-sidebar";
	}

	global $wp_query;
	if(have_posts()): $i = 1; ?>
      <div class="dt-sc-places-container"><?php
        while(have_posts()): the_post();
            $temp_class = "";
            if($i == 1) $temp_class = $li_class." first"; else $temp_class = $li_class;
            if($i == $column) $i = 1; else $i = $i + 1;
            $place_meta = get_post_meta(get_the_id() ,'_place_settings', true); ?>            
            <div class="<?php echo esc_attr($temp_class); ?>">
                <div id="post-<?php the_ID(); ?>" <?php post_class('place-item'); ?>>
                    <div class="place-thumb"><?php
                        if( has_post_thumbnail() ): ?>
                            <a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php
                                $attr = array('title' => get_the_title()); the_post_thumbnail('places-threecol', $attr); ?>
                                <div class="image-overlay"><span class="image-overlay-inside"></span></div>
                            </a><?php
                        endif; ?>
                    </div>
                    <div class="place-detail-wrapper">
                        <div class="place-title">
                            <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <p><?php echo wp_kses(@$place_meta['place_add'], $dt_allowed_html_tags);?></p>
                        </div>
                        <div class="place-content">
                            <a class="map-marker" href="<?php the_permalink(); ?>#place_map_<?php the_ID(); ?>"> <span class="red"></span><?php _e('View on Map', 'dt_themes'); ?></a>
                            <a class="dt-sc-button too-small" href="<?php the_permalink(); ?>"><?php _e('View details', 'dt_themes'); ?></a>
                        </div>
                    </div>
                </div>
            </div><?php
        endwhile; ?>
      </div><?php
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