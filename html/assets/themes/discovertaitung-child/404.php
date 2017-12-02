<?php get_header();

	  //GETTING META VALUES...
	  $page_layout = dt_theme_option('specialty', 'not-found-404-layout'); ?>

	  <section class="fullwidth-background">
      	<div class="breadcrumb-wrapper">
			<div class="container">
				<h1><?php _e('Page not Found', 'iamd_text_domain'); ?></h1>
				<?php new dt_theme_breadcrumb; ?>
			</div>
		</div>
	  </section>

      <div id="main">
          <div class="container">
<div class="">
							<div class="dt-sc-hr-invisible"></div>
              <div class="dt-sc-hr-invisible-small"></div>

              <?php /*if($page_layout == 'with-left-sidebar'): ?>
              	  <section class="secondary-sidebar secondary-has-left-sidebar" id="secondary-left"><?php get_sidebar('left'); ?></section>
              <?php elseif($page_layout == 'with-both-sidebar'): ?>
              	  <section class="secondary-sidebar secondary-has-both-sidebar" id="secondary-left"><?php get_sidebar('left'); ?></section>
              <?php endif;*/ ?>

			  <?php /*if($page_layout != 'content-full-width'): ?>
		            <section id="primary" class="page-with-sidebar page-<?php echo esc_attr($page_layout); ?>">
			  <?php else: */?>
		            <section id="primary" class="content-full-width">
              <?php /*endif;*/ ?>

                  <div class="error-404 aligncenter">
                      <div class="error">
                          <h2><?php _e('Page not Found', 'iamd_text_domain'); ?></h2>
                      </div>
                      <?php
					  	global $dt_allowed_html_tags;
                        echo wp_kses(stripcslashes(dt_theme_option('specialty','404-message')), $dt_allowed_html_tags);
                        get_search_form(); ?>
                  </div>

              </section>

              <?php /*if($page_layout == 'with-right-sidebar'): ?>
              	  <section class="secondary-sidebar secondary-has-right-sidebar" id="secondary-right"><?php get_sidebar('right'); ?></section>
              <?php elseif($page_layout == 'with-both-sidebar'): ?>
              	  <section class="secondary-sidebar secondary-has-both-sidebar" id="secondary-right"><?php get_sidebar('right'); ?></section>
              <?php endif; */?>
</div>
          </div>
      </div>

<?php get_footer(); ?>
