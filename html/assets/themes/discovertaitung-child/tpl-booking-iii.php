<?php
/*
	Template Name: Booking - III
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
		  get_template_part('includes/breadcrumb_section');

	  global $dt_allowed_html_tags; ?>

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
                              <div class="step-icon-wrapper step-icon-current">
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
                      </div><?php
					  //Valid date...
                      if(isset($_COOKIE['checkin']) != "" && isset($_COOKIE['checkout']) != "" && isset($_REQUEST['room_id']) != ""): ?>
                          <form id="frmhotelcheckout" name="frmhotelcheckout" action="<?php the_permalink(); ?>" method="post">
                              <div class="dt-sc-one-third column first dt-reserve-wrapper">
                                  <h3 class="section-title"><?php _e('Your Reservation', 'iamd_text_domain'); ?></h3>
                                  <ul>
                                      <li><i class="fa fa-building-o"></i><span><?php _e('Hotel:', 'iamd_text_domain'); ?> </span><?php echo get_the_title($_REQUEST['hotel_id']); ?></li>
                                      <li><i class="fa fa-home"></i><span><?php _e('Room:', 'iamd_text_domain'); ?> </span><?php echo get_the_title($_REQUEST['room_id']); ?></li>
                                      <li><i class="fa fa-calendar"></i><span><?php _e('Check In:', 'iamd_text_domain'); ?> </span><?php echo $_COOKIE['checkin']; ?></li>
                                      <li><i class="fa fa-calendar"></i><span><?php _e('Check Out:', 'iamd_text_domain'); ?> </span><?php echo $_COOKIE['checkout']; ?></li>
                                      <li><i class="fa fa-group"></i><span><?php _e('Guests:', 'iamd_text_domain'); ?> </span><?php echo $_COOKIE['adults']; ?>&nbsp;<?php _e('Adult(s)', 'iamd_text_domain'); ?>, <?php echo $_COOKIE['childs']; ?>&nbsp;<?php _e('Child(s)', 'iamd_text_domain'); ?></li><?php
                                      $total_days = count(dt_theme_get_all_dates($_COOKIE['checkin'], $_COOKIE['checkout'])) - 1; $room_meta = get_post_meta(wp_kses($_REQUEST['room_id'], $dt_allowed_html_tags), '_room_settings', true); $rcost = wp_kses($room_meta['room_price'], $dt_allowed_html_tags); ?>
                                      <li><span><?php _e('Total Days:', 'iamd_text_domain'); ?> </span><?php echo $total_days; ?></li>
                                      <li><span><?php _e('Price / Night:', 'iamd_text_domain'); ?> </span><?php echo dt_theme_currecy_symbol().$rcost; ?></li>
                                  </ul>
                                  <h3 class="section-title"><?php _e('Additional Services', 'iamd_text_domain'); ?></h3>
                                  <ul><?php
                                      $service_opts = get_option('hb_service_settings');
                                      if($service_opts != NULL):
                                          foreach($service_opts as $key => $service):
                                              if($service['hb-hotel-id'] == $_REQUEST['hotel_id']):
                                                  ?><li><input type="checkbox" value="<?php echo esc_attr($key); ?>" name="chkservice[]" /><?php echo wp_kses($service['hb-service-name'], $dt_allowed_html_tags).' ('.dt_theme_currecy_symbol().wp_kses($service['hb-service-price'], $dt_allowed_html_tags).')'; ?></li><?php
                                              endif;
                                          endforeach;
                                      endif;	
                                  ?>
                                  </ul>
                                  <h3 class="section-title"><?php _e('Total Amount', 'iamd_text_domain'); ?></h3>
                                  <ul class="dt-net-wrapper"><?php
								  	  $netAmount = dt_theme_hb_net_amount($_REQUEST['room_id']); ?>
									  <li><span><?php _e('Net Amount ( TD * Price * Adult(s) )', 'iamd_text_domain'); ?></span><br /><i><?php echo dt_theme_currecy_symbol(); ?></i><div id="dt-netamount"><?php echo $netAmount; ?></div></li><?php
									  #DepositDue Enabled...
									  $hb_general_settings = get_option('hb_general_settings');
									  if($hb_general_settings['hb-general-enabledepositdue'] && $hb_general_settings['hb-general-depositpercent'] != ""):
									     $depPercent = wp_kses($hb_general_settings['hb-general-depositpercent'], $dt_allowed_html_tags); ?>
									     <li><span><?php _e('Deposit Due', 'iamd_text_domain'); ?> (<?php echo $depPercent; ?>%)</span><br /><i><?php echo dt_theme_currecy_symbol(); ?></i><div id="dt-depositamount"><?php echo $netAmount * ($depPercent / 100); ?></div></li><?php
									  endif; ?>
                                  </ul>
                              </div>

                              <div class="dt-sc-two-third column dt-room-wrapper">
                              	  <h3 class="section-title"><?php _e('Choose Payment Option', 'iamd_text_domain'); ?></h3>
                              	  <ul>
                                  	<li><input type="radio" class="rdopayment" name="rdopayoption[]" value="Pay with PayPal" /><?php _e('Pay with PayPal', 'iamd_text_domain'); ?>
									  <div class="dt-sc-warning-box"><?php _e("Pay via PayPal; you can pay with your credit card if you don't have a PayPal account.", "iamd_text_domain"); ?></div>
                                    </li>
                                    <li><input type="radio" class="rdopayment" name="rdopayoption[]" value="Pay on Arrival" checked="checked" /><?php _e('Pay on Arrival', 'iamd_text_domain'); ?>
	                                  <div class="dt-sc-warning-box"><?php _e('Please fill out following details, and get confirmation email.', 'iamd_text_domain'); ?></div>
                                    </li>
                                  </ul>
                                  
                              	  <div class="dt-sc-payarrival-wrapper">
                                      <h3 class="section-title"><?php _e('Guest Details', 'iamd_text_domain'); ?></h3>
                                      <div class="dt-sc-one-half column first">
                                          <label for="txtfirstname"><?php _e('First Name', 'iamd_text_domain'); ?><span>*</span></label>
                                          <input name="txtfirstname" id="txtfirstname" type="text" />
                                          <label for="txtlastname"><?php _e('Last Name', 'iamd_text_domain'); ?><span>*</span></label>
                                          <input name="txtlastname" id="txtlastname" type="text" />
                                          <label for="txtemailaddress"><?php _e('Email Address', 'iamd_text_domain'); ?><span>*</span></label>
                                          <input name="txtemailaddress" id="txtemailaddress" type="email" />
                                          <label for="txtphone"><?php _e('Telephone Number', 'iamd_text_domain'); ?><span>*</span></label>
                                          <input name="txtphone" id="txtphone" type="tel" />
                                          <label for="txtaddress1"><?php _e('Address Line 1', 'iamd_text_domain'); ?><span>*</span></label>
                                          <input name="txtaddress1" id="txtaddress1" type="text" />
                                      </div>
                                      <div class="dt-sc-one-half column">
                                          <label for="txtaddress2"><?php _e('Address Line 2', 'iamd_text_domain'); ?></label>
                                          <input name="txtaddress2" id="txtaddress2" type="text" />
                                          <label for="txtcity"><?php _e('City', 'iamd_text_domain'); ?><span>*</span></label>
                                          <input name="txtcity" id="txtcity" type="text" />
                                          <label for="txtstate"><?php _e('State / County', 'iamd_text_domain'); ?><span>*</span></label>
                                          <input name="txtstate" id="txtstate" type="text" />
                                          <label for="txtzipcode"><?php _e('Zip / Postcode', 'iamd_text_domain'); ?><span>*</span></label>
                                          <input name="txtzipcode" id="txtzipcode" type="text" />
                                          <label for="txtcountry"><?php _e('Country', 'iamd_text_domain'); ?><span>*</span></label>
                                          <input name="txtcountry" id="txtcountry" type="text" />
                                      </div>
                                      <label for="txtspecialreq"><?php _e('Special Request', 'iamd_text_domain'); ?></label>
                                      <textarea name="txtspecialreq" id="txtspecialreq"></textarea>
			                      </div>
                                  <input type="hidden" name="hotel_id" value="<?php echo esc_attr($_REQUEST['hotel_id']); ?>" />
                                  <input type="hidden" name="room_id" value="<?php echo esc_attr($_REQUEST['room_id']); ?>" />
                                  <input type="submit" name="paynow" value="Submit" />
                              </div>
                          </form><?php
                      else:
                          ?><div class="dt-sc-notice"><?php _e('Please do not reload the page', 'iamd_text_domain'); ?>, <a href="<?php echo dt_theme_page_permalink_by_its_template('tpl-booking.php'); ?>"><?php _e('begin your booking here', 'iamd_text_domain'); ?></a></div><?php
                      endif;
                      #After Form Submission...
					  $poption = !empty($_REQUEST['rdopayoption'][0]) ? $_REQUEST['rdopayoption'][0] : '';
                      if($poption == 'Pay on Arrival' && isset($_REQUEST['paynow']) != NULL):
                          require_once get_template_directory().'/framework/hotelbooking/paypal/payment-arrival.php';
                      elseif($poption == 'Pay with PayPal' && isset($_REQUEST['paynow']) != NULL):
                          require_once get_template_directory().'/framework/hotelbooking/paypal/expresscheckout.php';
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