<?php
/*
	Template Name: Gallery Template
*/
	get_header();

	while(have_posts()): the_post();
		
	  //GETTING META VALUES...
	  $meta_set = get_post_meta($post->ID, '_tpl_default_settings', true);
	  if($GLOBALS['force_enable'] == true)
	  	$page_layout = $GLOBALS['page_layout'];
	  else
	  	$page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : $GLOBALS['page_layout'];
	  $default_width = !empty($meta_set['gallery-fullwidth']) ? $meta_set['gallery-fullwidth'] : '';
	  
	  if($default_width == '') $page_layout = 'content-full-width';
	  
	  //BREADCRUMP...
	  if(!is_front_page() and !is_home())
		  get_template_part('includes/breadcrumb_section'); ?>

      <div id="main">
          <?php if($default_width != "") echo '<div class="container">'; ?>
          
				<div class="dt-sc-hr-invisible"></div>
				<div class="dt-sc-hr-invisible-small"></div>
		  
		  <?php if($page_layout == 'with-left-sidebar' && $default_width == 'true'): ?>
				<section class="secondary-sidebar secondary-has-left-sidebar" id="secondary-left"><?php get_sidebar('left'); ?></section><?php
			  elseif($page_layout == 'with-both-sidebar' && $default_width == 'true'): ?>
				<section class="secondary-sidebar secondary-has-both-sidebar" id="secondary-left"><?php get_sidebar('left'); ?></section><?php
			  endif; ?>
				  
			  <?php if($page_layout != 'content-full-width'): ?>
					<section id="primary" class="page-with-sidebar page-<?php echo esc_attr($page_layout); ?>">
			  <?php else: ?>
					<section id="primary" class="content-full-width">
			  <?php endif; ?>                    
					  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div id="ajax_load_gallery_container" class="fullwidth-section">
						<?php
						  the_content();
						  wp_link_pages(array('before' => '<div class="page-link"><strong>'.__('Pages:', 'iamd_text_domain').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number'));
						  //PERFORMING BLOG LAYOUT...
						  get_template_part('includes/gallery-post-layout');
						  edit_post_link(__('Edit', 'iamd_text_domain'), '<span class="edit-link">', '</span>' ); ?>
						</div>  
					  </article>
					</section>
				  
			  <?php if($page_layout == 'with-right-sidebar' && $default_width == 'true'): ?>
				  <section class="secondary-sidebar secondary-has-right-sidebar" id="secondary-right"><?php get_sidebar('right'); ?></section>
			  <?php elseif($page_layout == 'with-both-sidebar' && $default_width == 'true'): ?>
				  <section class="secondary-sidebar secondary-has-both-sidebar" id="secondary-right"><?php get_sidebar('right'); ?></section>
			  <?php endif;
		  
		if($default_width != "") echo '</div>'; ?>
        
      </div>      
<?php endwhile; ?>

<?php get_footer(); ?>