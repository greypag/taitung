<?php get_header();

	  //GETTING META VALUES...
	  $page_layout = dt_theme_option('specialty', 'post-archives-layout');
      
	  //BREADCRUMP...
	  if(!is_front_page() and !is_home())
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
				  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php
                      //Performing archive layout...
                      get_template_part('includes/archive-post-layout'); ?>
                  </article>
              </section>
              
              <?php if($page_layout == 'with-right-sidebar'): ?>
              	  <section class="secondary-sidebar secondary-has-right-sidebar" id="secondary-right"><?php get_sidebar('right'); ?></section>
              <?php elseif($page_layout == 'with-both-sidebar'): ?>
              	  <section class="secondary-sidebar secondary-has-both-sidebar" id="secondary-right"><?php get_sidebar('right'); ?></section>
              <?php endif; ?>
          </div>
      </div>

<?php get_footer(); ?>