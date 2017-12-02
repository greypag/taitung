<?php
/*
	Template Name: Full Width Template
*/
	get_header();

	while(have_posts()): the_post();

	  if(is_page()) dt_theme_slider_section($post->ID);

	  //GETTING META VALUES...
	  $meta_set = get_post_meta($post->ID, '_tpl_default_settings', true);

	  //BREADCRUMP...
	  if(isset($meta_set['show_slider']) == "" && !is_front_page() && !is_home()):
		  if(dt_theme_option('general', 'disable-breadcrumb') != "on"): ?>
              <section class="fullwidth-background">
                <div class="breadcrumb-wrapper">
                  <div class="container">
                      <h1><?php the_title(); ?></h1>
                      <?php new dt_theme_breadcrumb; ?>
                  </div>
                </div>
              </section><?php
		  endif;
	  endif; ?>

      <div id="main">
		<section class="content-full-width" id="primary">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php
                //PAGE TOP CODE...
				global $dt_allowed_html_tags;
                if(dt_theme_option('integration', 'enable-single-page-top-code') != '') echo wp_kses(stripslashes(dt_theme_option('integration', 'single-page-top-code')), $dt_allowed_html_tags);
                the_content();
                wp_link_pages(array('before' => '<div class="page-link"><strong>'.__('Pages:', 'iamd_text_domain').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number')); ?>

                <div style="background-repeat:no-repeat;background-position:left top;" class="fullwidth-section">
                    <div class="fullwidth-bg">
                        <div class="container">
                          <?php
                            edit_post_link(__('Edit', 'iamd_text_domain'), '<span class="edit-link">', '</span>' );
                            echo '<div class="social-bookmark">';
                               show_fblike('page'); show_googleplus('page'); show_twitter('page'); show_stumbleupon('page'); show_linkedin('page'); show_delicious('page'); show_pintrest('page'); show_digg('page');
                            echo '</div>';
                            dt_theme_social_bookmarks('sb-page');
                            if(dt_theme_option('integration', 'enable-single-page-bottom-code') != '') echo wp_kses(stripslashes(dt_theme_option('integration', 'single-page-bottom-code')), $dt_allowed_html_tags);
                            if(dt_theme_option('general', 'disable-page-comment') != true && (isset($meta_set['comment']) != "")) comments_template('', true); ?>
                        </div>
                    </div>
                </div>



            </article>
        </section>
    <?php endwhile; ?>
      </div>

<?php get_footer(); ?>
