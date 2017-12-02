<?php
/* 
	Template Name: OnePage Template
*/
get_header();

  the_post();

  if(is_page()) dt_theme_slider_section($post->ID);
  
  //GETTING META VALUES...
  $meta_set = get_post_meta($post->ID, '_tpl_default_settings', true); ?>
  
  <div id="main">
	<section class="content-full-width" id="primary">
    
        <article id="<?php echo $post->post_name; ?>"><?php
            the_content();
            wp_link_pages(array('before' => '<div class="page-link"><strong>'.__('Pages:', 'iamd_text_domain').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number')); ?>
        </article>
        
        <?php
          //Getting Menu Items..
          $menuobj = $meta_set['onepage_menu'];
          
          $sections = array();
          if(!empty($menuobj)):
              $menu_items = wp_get_nav_menu_items( $menuobj, array('output' => ARRAY_A) );
          endif;
			
          if(isset($menu_items) != NULL):
              foreach($menu_items as $menu_item):
                  if($menu_item->post_status == 'publish' && $menu_item->menu_item_parent == 0 && $menu_item->object == 'page' && !in_array('external', $menu_item->classes)):
                      $title = $menu_item->title;
                      $page_id = $menu_item->object_id;
                      $sections[$page_id] = $title;
                  endif;
              endforeach;
          endif;			
          
          //PERFORMING QUERY...
          if(count($sections) > 0):
              $args = array('post_type' => 'page', 'post__in' => array_keys($sections), 'orderby' => 'post__in', 'posts_per_page' => -1);
              $wp_query = new WP_Query($args);
              if($wp_query->have_posts()):
				while($wp_query->have_posts()): $wp_query->the_post(); ?>
  
				  <article id="<?php echo $post->post_name; ?>">
					<div class="main-title">
						<div class="container">
							<h2><?php echo $sections[$post->ID]; ?></h2>
						</div>
					</div>
					<?php
					  the_content();
					  wp_link_pages(array('before' => '<div class="page-link"><strong>'.__('Pages:', 'iamd_text_domain').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number')); ?>
				  </article><?php

		  		endwhile;
				wp_reset_query($wp_query);
              endif;
          endif; ?>

	</section>
  </div>

<?php get_footer(); ?>