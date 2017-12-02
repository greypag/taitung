<?php
/*
	Template Name: Booking - II
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
                              <div class="step-icon-wrapper step-icon-current">
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
                      </div><?php
					  //Valid date...
					  if(isset($_REQUEST['txtcheckindate']) != "" && isset($_REQUEST['txtcheckoutdate']) != ""):
						  $checkin = esc_attr($_REQUEST['txtcheckindate']);
						  $checkout = esc_attr($_REQUEST['txtcheckoutdate']);
			  
						  //Putting values to cookies...
						  setcookie('checkin', $checkin, (time()+3600), "/");	setcookie('checkout', $checkout, (time()+3600), "/");
						  setcookie('adults', $_REQUEST['cmbadults'], (time()+3600), "/"); setcookie('childs', esc_attr($_REQUEST['cmbchilds']), (time()+3600), "/");
						  
						  //Getting action...
						  $action = dt_theme_page_permalink_by_its_template('tpl-booking-iii.php'); ?>
						  <div class="dt-sc-one-third column first dt-reserve-wrapper">
							  <h3 class="section-title"><?php _e('Your Reservation', 'iamd_text_domain'); ?></h3>
							  <ul>
								  <li><i class="fa fa-calendar"></i><span><?php _e('Check In:', 'iamd_text_domain'); ?> </span><?php echo $checkin; ?></li>
								  <li><i class="fa fa-calendar"></i><span><?php _e('Check Out:', 'iamd_text_domain'); ?> </span><?php echo $checkout; ?></li>
								  <li><i class="fa fa-group"></i><span><?php _e('Guests:', 'iamd_text_domain'); ?> </span><?php echo esc_attr($_REQUEST['cmbadults']); ?>&nbsp;<?php _e('Adult(s)', 'iamd_text_domain'); ?>, <?php echo $_REQUEST['cmbchilds']; ?>&nbsp;<?php _e('Child(s)', 'iamd_text_domain'); ?></li>
                                  <li><a class="dt-sc-button green" href="<?php echo dt_theme_page_permalink_by_its_template('tpl-booking.php'); ?>"><?php _e('Edit Reservation', 'iamd_text_domain'); ?></a></li>
							  </ul>
						  </div>
						  <div class="dt-sc-two-third column dt-room-wrapper">
							  <h3 class="section-title"><?php _e('Choose Your Room', 'iamd_text_domain'); ?></h3><?php
							  //Getting dates...
							  $unroom_ids = array(); $args = "";
							  $availableoptions = get_option('hb_available_settings');
							  $select_arr = dt_theme_get_all_dates($checkin, $checkout);

							  if($availableoptions):
								  foreach($availableoptions as $key => $opts):
									  $temp = array();
									  foreach($opts as $k => $opt):
										  $c = count(array_intersect(explode(',', $opt), $select_arr));
										  //Push the roomids...
										  if($c > 0) {
											  array_push($temp, $k);
										  }
									  endforeach;
									  $unroom_ids[$key] = $temp;					
								  endforeach;
							  endif;  
							  
							  //Check Hotels Meta & Room type available...
							  if(!empty($_REQUEST['txtcityid'])) {
								  $args = array('post_type' => 'dt_hotels', 'posts_per_page' => -1, 'tax_query' => array(
																			array( 'taxonomy' => 'hotel_locations', 'field' => 'term_id', 'terms' => array($_REQUEST['txtcityid']), ), ));
							  } else {
								  $args = array('post_type' => 'dt_hotels', 'posts_per_page' => -1);
							  }

							  $the_query = new WP_Query($args);
							  if($the_query->have_posts()): ?>
								  <ul class="dt-room-list-wrapper"><?php
									  while($the_query->have_posts()): $the_query->the_post();
										  //Getting meta...
										  $hid = get_the_ID();
										  $hmeta = get_post_meta( $hid, '_hotel_settings', TRUE );

										  $selected_rooms = $hmeta['room-types'];
										  $arr = @array_diff($selected_rooms, $unroom_ids[$hid]);
										  $arr = @array_filter($arr);
										  
										  if(!empty($arr)) {
											  $args = array('post_type' => 'dt_rooms', 'posts_per_page' => -1, 'post__in' => $arr);
										  } elseif($unroom_ids[$hid] === NULL) {
											  $args = array('post_type' => 'dt_rooms', 'posts_per_page' => -1, 'post__in' => $selected_rooms);
										  } else {
											  continue;
										  }

										  echo '<h3 class="dt-room-parent"><a href="'.get_permalink(get_the_ID()).'" title="'.get_the_title(get_the_ID()).'">'.get_the_title(get_the_ID()).'</a></h3>';
										  //Retriving with current query...
										  $room_query = new WP_Query($args);
										  if($room_query->have_posts()):
											  while($room_query->have_posts()): $room_query->the_post();
												  $room_meta = get_post_meta(get_the_ID(), '_room_settings', true); ?>
												  <li class="dt-room-item">
													  <h5><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></h5>
													  <div class="dt-sc-room-thumb"><?php $attr = array('title' => get_the_title()); the_post_thumbnail('room-thumb', $attr); ?></div>
													  <div class="dt-sc-room-meta alignleft">
														  <ul>
															  <li><i class="fa fa-group"></i> <span><?php _e('Occupancy:', 'iamd_text_domain'); ?></span><?php echo wp_kses($room_meta['room_occupancy'], $dt_allowed_html_tags); ?></li>
															  <li><i class="fa fa-building-o"></i> <span><?php _e('Size:', 'iamd_text_domain'); ?></span><?php echo wp_kses($room_meta['room_size'], $dt_allowed_html_tags); ?></li>
														  </ul>
													  </div>
                                                      <div class="alignright">
                                                          <div class="hotel-thumb-meta">
                                                              <div class="hotel-price"><?php _e('Starts From', 'iamd_text_domain'); ?> <span><?php echo dt_theme_currecy_symbol().wp_kses($room_meta['room_price'], $dt_allowed_html_tags); ?></span><?php _e('Per Night', 'iamd_text_domain'); ?></div>
                                                              <form method="post" action="<?php echo esc_url($action); ?>" name="frmbook2">
                                                                  <input type="hidden" name="hotel_id" value="<?php echo $hid; ?>" />
                                                                  <input type="hidden" name="room_id" value="<?php the_ID(); ?>" />
                                                                  <input type="submit" name="subselect" value="<?php _e('Select Room', 'iamd_text_domain'); ?>" />
                                                              </form>
                                                          </div>
                                                      </div>
                                                      <div class="dt-sc-hr-invisible-small"></div>
													  <div class="dt-sc-room-features"><?php echo get_the_excerpt(); ?></div>
												  </li><?php
											  endwhile;
										  endif;
										  wp_reset_query($room_query);
									  endwhile; ?>
								  </ul><?php
							  else: ?>
                                  <h2><?php _e('Nothing Found.', 'iamd_text_domain'); ?></h2>
                                  <p><?php _e('Apologies, but no results were found for the requested archive.', 'iamd_text_domain'); ?></p><?php
							  endif;
							  wp_reset_query($the_query); ?>
						  </div>
					  <?php
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