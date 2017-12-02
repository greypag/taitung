<?php get_header();

	global $dt_allowed_html_tags;
	while(have_posts()): the_post();
	
	  //GETTING META VALUES...
	  $meta_set = get_post_meta($post->ID, '_room_settings', true);
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
            <?php endif; ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="section-title hotel-title"><?php the_title(); ?></h1>
					<?php $room_meta = get_post_meta(get_the_ID(), '_room_settings', true); ?>

                    <div class="dt-sc-single-room-price">
                    	<div class="hotel-price">
                        	<span><?php echo dt_theme_currecy_symbol(); ?><?php echo wp_kses($room_meta['room_price'], $dt_allowed_html_tags); ?></span><?php _e('Per Night' ,'dt_themes'); ?>
                        	<a class="dt-sc-button theme-btn too-small" href="<?php echo dt_theme_page_permalink_by_its_template('tpl-booking.php'); ?>"><?php _e('Book Now', 'dt_themes'); ?></a>
                        </div>
                    </div>
					<div class="dt-sc-hr-invisible-small"></div><?php

					if( @array_key_exists("items", $meta_set) ):
						echo '<div class="clear"></div>';
						echo "<ul class='entry-gallery-post-slider'>";
							foreach ( $meta_set['items'] as $item ) { echo "<li><img src='{$item}' alt='hotel-img' /></li>";	}
						echo "</ul>";
						echo "<div id='entry-gallery-pager'>"; $i = 0;
							foreach ( $meta_set['items'] as $item ) { echo "<a data-slide-index='".$i."' href=''><img src='{$item}' alt='hotel-img' /></a>"; $i += 1;	}
						echo "</div>";
						echo '<div class="dt-sc-hr-invisible"></div><div class="clear"></div>';
					endif;

					//Room content...
					the_content();
					wp_link_pages(array('before' => '<div class="page-link"><strong>'.__('Pages:', 'dt_themes').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number'));
					edit_post_link(__('Edit', 'dt_themes'), '<span class="edit-link">', '</span>' ); ?>

                    <div class="dt-single-room-wrapper">
	                    <h4 class="section-title"><?php _e('Room Information', 'dt_themes'); ?></h4>
                        <ul class="dt-single-room-meta">
                            <li><span><?php _e('Occupancy', 'dt_themes'); ?></span> <?php echo wp_kses($room_meta['room_occupancy'], $dt_allowed_html_tags); ?></li>
                            <li><span><?php _e('Room Size', 'dt_themes'); ?></span> <?php echo wp_kses($room_meta['room_size'], $dt_allowed_html_tags); ?></li>
                        </ul>
					</div>
                </article>
                
            </section>
            
			<?php if($page_layout == 'with-right-sidebar'): ?>
                <section class="secondary-sidebar secondary-has-right-sidebar" id="secondary-right"><?php get_sidebar('right'); ?></section>
            <?php elseif($page_layout == 'with-both-sidebar'): ?>
                <section class="secondary-sidebar secondary-has-both-sidebar" id="secondary-right"><?php get_sidebar('right'); ?></section>
            <?php endif; ?>
            
          </div>
      </div><?php
      endwhile; ?>

<?php get_footer(); ?>