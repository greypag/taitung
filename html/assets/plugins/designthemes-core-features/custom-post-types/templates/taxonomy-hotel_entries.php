<?php get_header();

	  //GETTING META VALUES...
	  $page_layout = dt_theme_option('specialty', 'post-archives-layout'); ?>
	  
	  <section class="fullwidth-background">
      	<div class="breadcrumb-wrapper">
			<div class="container">
				<h1><?php _e('Category Archives of : ', 'dt_themes'); echo single_cat_title(); ?></h1>
				<?php new dt_theme_breadcrumb; ?>
			</div>
		</div>
	  </section>        
      	
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
                          include(dirname(__FILE__).'/inc/hotel-archive-layout.php'); ?>
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