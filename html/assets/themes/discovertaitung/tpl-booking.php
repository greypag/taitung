<?php
/*
	Template Name: Booking - I
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
                              <div class="step-icon-wrapper step-icon-current">
                                  <div class="step-icon step-date"><span></span></div>
	                              <h5>1. <?php _e('Select Your Date', 'iamd_text_domain'); ?></h5>
                              </div>
                          </div>
                          <div class="step-wrapper">
                              <div class="step-icon-wrapper">
                                  <div class="step-icon step-room"><span></span></div>
                                  <h5>2. <?php _e('Select Your Room', 'iamd_text_domain'); ?></h5>
                              </div>
                          </div>
                          <div class="step-wrapper">
                              <div class="step-icon-wrapper">
                                  <div class="step-icon step-reserve"><span></span></div>
	                              <h5>3. <?php _e('Place Your Reservation', 'iamd_text_domain'); ?></h5>
                              </div>
                          </div>
                          <div class="step-wrapper last-col">
                              <div class="step-icon-wrapper">
                                  <div class="step-icon step-review"><span></span></div>
	                              <h5>4. <?php _e('Confirmation', 'iamd_text_domain'); ?></h5>
                              </div>
                          </div>
                          <div class="step-line"></div>
                      </div>
					  <?php $action = dt_theme_page_permalink_by_its_template('tpl-booking-ii.php'); ?>
                      <form id="frmbooking" name="frmbooking" action="<?php echo esc_url($action); ?>" method="post">
                          <label for="txtcheckindate"><?php _e('Checkin Date', 'iamd_text_domain'); ?><span>*</span></label>
                          <input type="text" class="datepicker" name="txtcheckindate" id="txtcheckindate" readonly="readonly" value="<?php echo !empty($_REQUEST['txtckindate']) ? esc_attr($_REQUEST['txtckindate']) : '';?>" />
                          
                          <label for="txtcheckoutdate"><?php _e('Checkout Date', 'iamd_text_domain'); ?><span>*</span></label>
                          <input type="text" class="datepicker" name="txtcheckoutdate" id="txtcheckoutdate" readonly="readonly" value="<?php echo !empty($_REQUEST['txtckoutdate']) ? esc_attr($_REQUEST['txtckoutdate']) : ''; ?>" />
                          
                          <label for="txtlocation"><?php _e('City / Location', 'iamd_text_domain'); ?></label>
                          <input type="text" name="txtlocation" id="txtlocation" /><input type="hidden" name="txtcityid" id="txtcityid" />
                          
                          <label for="cmbadults"><?php _e('Adults', 'iamd_text_domain'); ?><span>*</span></label>
                          <select name="cmbadults" id="cmbadults"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>
                          
                          <label for="cmbchilds"><?php _e('Children', 'iamd_text_domain'); ?></label>
                          <select name="cmbchilds" id="cmbchilds">
                              <option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
                          </select>
                          
                          <input type="submit" name="subfind" id="subfind" value="<?php _e('Check Availability', 'iamd_text_domain'); ?>" />
                      </form>
                      <div class="dt-calendar-container">
                          <div class="dt-sc-warning-box calendar-notice"><?php _e('Please select your dates from the calendar', 'iamd_text_domain'); ?></div>
                          <div id="open_datepicker"></div>
                          <div class="datepicker-key clearfix">
                              <div class="key-unavailable-wrapper clearfix">
                                  <div class="key-unavailable-icon"></div>
                                  <div class="key-unavailable-text"><?php _e('Unavailable', 'iamd_text_domain'); ?></div>
                              </div>
                              <div class="key-available-wrapper clearfix">
                                  <div class="key-available-icon"></div>
                                  <div class="key-available-text"><?php _e('Available', 'iamd_text_domain'); ?></div>
                              </div>
                              <div class="key-selected-wrapper clearfix">
                                  <div class="key-selected-icon"></div>
                                  <div class="key-selected-text"><?php _e('Selected Dates', 'iamd_text_domain'); ?></div>
                              </div>
						  </div>
                      </div>                      
                      <?php edit_post_link(__('Edit', 'iamd_text_domain'), '<span class="edit-link">', '</span>' ); ?>
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