<?php get_header();

	while(have_posts()): the_post();

	  if(is_page()) dt_theme_slider_section($post->ID);

	  //GETTING META VALUES...
	  $meta_set = get_post_meta($post->ID, '_tpl_default_settings', true);

		// leon ACF
		$acf_general_display_gallery=get_field('general_display_gallery');
    $acf_image = get_field('general_heading_img');
		$acf_general_gallery_description = get_field('general_gallery_description');
    $acf_general_gallery_photo['items'][]=get_field('general_gallery_photo_1');
    $acf_general_gallery_photo['items'][]=get_field('general_gallery_photo_2');
    $acf_general_gallery_photo['items'][]=get_field('general_gallery_photo_3');
    $acf_general_gallery_photo['items'][]=get_field('general_gallery_photo_4');
    $acf_general_gallery_photo['items'][]=get_field('general_gallery_photo_5');
    $acf_general_gallery_photo['items'][]=get_field('general_gallery_photo_6');
    $acf_general_gallery_photo['items'][]=get_field('general_gallery_photo_7');
    $acf_general_gallery_photo['items'][]=get_field('general_gallery_photo_8');
    $acf_general_gallery_photo['items'][]=get_field('general_gallery_photo_9');
    $acf_general_gallery_photo['items'][]=get_field('general_gallery_photo_10');
    $acf_general_gallery_photo['items'][]=get_field('general_gallery_photo_11');
    $acf_general_gallery_photo['items'][]=get_field('general_gallery_photo_12');
    $acf_general_gallery_photo['items'][]=get_field('general_gallery_photo_13');
    $acf_general_gallery_photo['items'][]=get_field('general_gallery_photo_14');
    $acf_general_gallery_photo['items'][]=get_field('general_gallery_photo_15');
    $acf_general_gallery_photo['items'][]=get_field('general_gallery_photo_16');
    $acf_general_gallery_photo['items'][]=get_field('general_gallery_photo_17');
    $acf_general_gallery_photo['items'][]=get_field('general_gallery_photo_18');
    $acf_general_gallery_photo['items'][]=get_field('general_gallery_photo_19');
    $acf_general_gallery_photo['items'][]=get_field('general_gallery_photo_20');

    $acf_general_recent_page=get_field('general_recent_page');
		$acf_general_competition=get_field('general_competition');

	  if($GLOBALS['force_enable'] == true)
	  	$page_layout = $GLOBALS['page_layout'];
	  else
	  	$page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : $GLOBALS['page_layout'];

	  //BREADCRUMP...
	  if(!is_front_page() and !is_home())
		  get_template_part('includes/breadcrumb_section'); ?>

    <!-- leon changed the layout -->
			<div id="main">
		<section class="content-full-width" id="primary">
			<?php
	if( !empty($acf_image) ): ?>
		<div class="heading-img" style="background-image:url('<?php echo $acf_image['url']; ?>');"></div>
	<?php endif; ?>
	<?php
	$classes = array(
		'clearfix'
	);
?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

<?php if(!(is_home()||is_front_page())){ ?>
	<?php if(!empty($acf_general_display_gallery)&&$acf_general_display_gallery=='yes'){ ?>
	  <div class="dt-sc-hr-invisible  "></div>
	  <div class="dt-sc-hr-invisible  "></div>
	<?php } ?>
  <?php if(!empty($acf_general_display_gallery)){ ?>
    <div class="aligncenter clearfix container">
      <?php if( !empty($acf_summary) ): ?>
        <h2 class="summary-box section-title"><?php echo $acf_summary; ?></h2>
      <?php endif; ?>
    </div>
    <div class="clearfix container">
      <div class="gallery-slider-container dt-sc-two-third column first">
				<?php if(!empty($acf_general_display_gallery)&&$acf_general_display_gallery=='yes'){ ?>
					<ul class="gallery-bx-wrapper">
						<?php
						$i = 0;
						$gallery_pager_out='';
						// var_dump($acf_general_gallery_photo);
						foreach($acf_general_gallery_photo['items'] as $key => $item){
							//  var_dump($item);
							if(!empty($item)){
								$gallery_pager_out.="<li><img src='".$item['url']."'></li>";
							}
							$i += 1;
						}
						// $gallery_pager_out.='';
						echo $gallery_pager_out;
						?>
					</ul>
					<div id="entry-gallery-pager">
					<?php
					$i = 0;
					$gallery_pager_out='';
					// var_dump($acf_general_gallery_photo);
					foreach($acf_general_gallery_photo['items'] as $key => $item){
						if(!empty($item)){
								$gallery_pager_out.="<a data-slide-index='".$i."' href='' ><img src='".$item['url']."'></a>";
								$i += 1;
						}
					}
				//  echo $i;
					if($i==1){
						$gallery_pager_out='';
					}else{
						echo $gallery_pager_out;
					}
					// $gallery_pager_out.='';

					?>
					</div>
					<div class="dt-sc-hr-invisible"></div>
				<?php } ?>

        <!-- <div class="bx-wrapper"> -->


				<?php if(!empty($acf_general_gallery_description)){ ?>
				<div class="short-description-box clearfix"><?php echo $acf_general_gallery_description; ?></div><!-- leon Sport description -->
				<?php } ?>
				<?php if(!empty($acf_general_competition)){ ?>
				<div class="short-description-box clearfix"><?php echo $acf_general_competition; ?></div><!-- leon Sport competition -->
				<?php } ?>
      </div>
      <!-- </div> -->
			<!-- leon other sports -->
      <div class="dt-sc-one-third column">
				<div class="widget widget_popular_entries">
					<!--<h3 class="widgettitle">OTHER SPORTS</h3>-->
        <?php if($acf_general_recent_page=='yes'): ?>
					<?php
					// get the translated child page
					$child_of = apply_filters( 'wpml_object_id', 135, 'page', true );
					// get the default pages ID
					$default_pages = explode(',', '9273, 9263, 9253, 9244, 9347, 9337, 9324' );

					$pages = array();
					   //loop and get each translated page id
						 foreach($default_pages as $default_page) {
							 $pages[] = apply_filters( 'wpml_object_id', $default_page, 'page', true );
						 }
					// join
          $page = implode(',', $pages);
					// get all country pages
					$args = array('child_of' => $child_of, 'include' => $page,);
             $related = get_pages($args);
             if( $related ) foreach( $related as $post ) {
							 setup_postdata($post);
				  ?>
					<div class='recent-gallery-widget'>
          <ul>
            <li>
              <a class="thumb" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
								<?php the_post_thumbnail(); ?>
							</a>
							<p><strong>
								<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
							    <?php the_title(); ?>
							  </a>
							</strong></p>
							<div class="sport-side-text-over">
							  <?php the_field('general_short_description'); ?>
							</div>
            </li>
         </ul>
			   </div>
         <?php }
        wp_reset_postdata(); ?>
        <?php endif; ?>
				</div>
      </div>
     </div>
  <?php }else{ ?>
  							<div class="aligncenter clearfix container">
  								<?php if( !empty($acf_short_description) ): ?>
  								<h2 class="short-description-box clearfix"><?php echo $acf_short_description; ?></h2>
  								<?php endif; ?>
  								<?php if( !empty($acf_summary) ): ?>
  								<h2 class="summary-box section-title"><?php echo $acf_summary; ?></h2>
  								<?php endif; ?>
  							</div>
  <?php } ?>
<?php } ?>
							<?php
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
