<?php
/*
	Template Name: Booking - Review
*/
	get_header();

	while(have_posts()): the_post();

	  //GETTING META VALUES...
	  $meta_set = get_post_meta($post->ID, '_tpl_default_settings', true);
	  if($GLOBALS['force_enable'] == true)
	  	$page_layout = $GLOBALS['page_layout'];
	  else
	  	$page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : $GLOBALS['page_layout'];

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
                      the_content();
                      wp_link_pages(array('before' => '<div class="page-link"><strong>'.__('Pages:', 'iamd_text_domain').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number')); ?>

                      <div class="booking-step-wrapper clearfix">
                          <div class="step-wrapper">
                              <div class="step-icon-wrapper step-finish">
                                  <div class="step-icon step-date"><span></span></div>
	                              <h5>1. <?php _e('Select Your Date', 'iamd_text_domain'); ?></h5>
                              </div>
                          </div>
                          <div class="step-wrapper">
                              <div class="step-icon-wrapper step-finish">
                                  <div class="step-icon step-room"><span></span></div>
                                  <h5>2. <?php _e('Select Your Room', 'iamd_text_domain'); ?></h5>
                              </div>
                          </div>
                          <div class="step-wrapper">
                              <div class="step-icon-wrapper step-finish">
                                  <div class="step-icon step-reserve"><span></span></div>
	                              <h5>3. <?php _e('Place Your Reservation', 'iamd_text_domain'); ?></h5>
                              </div>
                          </div>
                          <div class="step-wrapper last-col">
                              <div class="step-icon-wrapper step-icon-current">
                                  <div class="step-icon step-review"><span></span></div>
	                              <h5>4. <?php _e('Confirmation', 'iamd_text_domain'); ?></h5>
                              </div>
                          </div>
                          <div class="step-line"></div>
                      </div><?php
					  //Check date & token...
					  if(isset($_COOKIE['checkin']) != "" && isset($_COOKIE['checkout']) != "" && $_REQUEST['token']): ?>
                      	  <div class="dt-sc-success-reserve"><i class="fa fa-user"></i><?php _e('Hi! You have successfully made a reservation. Here are your reservation details.', 'iamd_text_domain'); ?></div>
                          <h3 class="section-title aligncenter"><?php _e('Your Order Confirmation', 'iamd_text_domain'); ?></h3>
                          <table>
                          	<thead><tr><th><?php _e('Order No', 'iamd_text_domain'); ?></th><th><i class="fa fa-building-o"></i> <?php _e('Hotel', 'iamd_text_domain'); ?></th><th><i class="fa fa-coffee"></i> <?php _e('Room', 'iamd_text_domain'); ?></th><th><i class="fa fa-calendar"></i> <?php _e('Check In', 'iamd_text_domain'); ?></th><th><i class="fa fa-calendar"></i> <?php _e('Check Out', 'iamd_text_domain'); ?></th></tr></thead>
                            <tbody>
                            	<tr>
                                	<td><?php echo $_REQUEST['token']; ?></td>
                                    <td><?php echo get_the_title($_COOKIE['hotelid']); ?></td>
                                    <td><?php echo get_the_title($_COOKIE['roomid']); ?></td>
                                    <td><?php echo $_COOKIE['checkin']; ?></td>
                                    <td><?php echo $_COOKIE['checkout']; ?></td>
                                </tr>
                            </tbody>
                          </table><?php

						  require_once get_template_directory().'/framework/hotelbooking/paypal/review.php';

					  elseif(isset($_REQUEST['payarrival']) == 'true'): ?>
                      	  <div class="dt-sc-success-reserve"><i class="fa fa-user"></i><strong><?php _e('Hi', 'iamd_text_domain'); ?> <?php echo $_REQUEST['fname']; ?>!</strong> <?php _e('You have successfully made a reservation. Here are your reservation details.', 'iamd_text_domain'); ?></div>
                      	  <h3 class="section-title aligncenter"><?php _e('Your Order Confirmation', 'iamd_text_domain'); ?></h3>
						  <table>
                          	<thead><tr><th><i class="fa fa-building-o"></i> <?php _e('Hotel', 'iamd_text_domain'); ?></th><th><i class="fa fa-coffee"></i> <?php _e('Room', 'iamd_text_domain'); ?></th><th><i class="fa fa-calendar"></i> <?php _e('Check In', 'iamd_text_domain'); ?></th><th><i class="fa fa-calendar"></i> <?php _e('Check Out', 'iamd_text_domain'); ?></th></tr></thead>
                            <tbody>
                            	<tr>
                                    <td><?php echo get_the_title($_REQUEST['hid']); ?></td>
                                    <td><?php echo get_the_title($_REQUEST['rid']); ?></td>
                                    <td><?php echo $_REQUEST['cin']; ?></td>
                                    <td><?php echo $_REQUEST['cout']; ?></td>
                                </tr>
                            </tbody>
                          </table><?php
					  else:
						  ?><div class="dt-sc-notice"><?php _e('Please do not reload the page', 'iamd_text_domain'); ?>, <a href="<?php echo dt_theme_page_permalink_by_its_template('tpl-booking.php'); ?>"><?php _e('begin your booking here', 'iamd_text_domain'); ?></a></div><?php
					  endif;
					  edit_post_link(__('Edit', 'iamd_text_domain'), '<span class="edit-link">', '</span>' ); ?>
                  </article>
              </section>
              
              <?php if($page_layout == 'with-right-sidebar'): ?>
              	  <section class="secondary-sidebar secondary-has-right-sidebar" id="secondary-right"><?php get_sidebar('right'); ?></section>
              <?php elseif($page_layout == 'with-both-sidebar'): ?>
              	  <section class="secondary-sidebar secondary-has-both-sidebar" id="secondary-right"><?php get_sidebar('right'); ?></section>
              <?php endif;

        endwhile; ?>
          </div>
      </div>

<?php get_footer(); ?>