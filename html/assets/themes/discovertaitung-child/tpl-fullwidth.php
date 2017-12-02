<?php
/*
	Template Name: Full Width Template
*/
	get_header();

	while(have_posts()): the_post();

	  if(is_page()) dt_theme_slider_section($post->ID);

	  //GETTING META VALUES...
	  $meta_set = get_post_meta($post->ID, '_tpl_default_settings', true);

		//BEN ACF
		$acf_image = get_field('general_heading_img');
		$acf_summary = get_field('general_summary');
		$acf_short_description = get_field('general_short_description');
		$acf_general_display_social_share=get_field('general_display_social_share');
    $acf_general_display_gallery=get_field('general_display_gallery');

    //BEN 170214
		$acf_summary_2 = get_field('general_summary_2');
		$acf_short_description_2 = get_field('general_short_description_2');
    $acf_general_display_gallery_2=get_field('general_display_gallery_2');
    $acf_general_gallery_description_2 = get_field('general_gallery_description_2');

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
    $acf_general_gallery_photo_2['items'][]=get_field('general_gallery_photo_10');
    $acf_general_gallery_photo_2['items'][]=get_field('general_gallery_photo_11');
    $acf_general_gallery_photo_2['items'][]=get_field('general_gallery_photo_12');
    $acf_general_gallery_photo_2['items'][]=get_field('general_gallery_photo_13');
    $acf_general_gallery_photo_2['items'][]=get_field('general_gallery_photo_14');
    $acf_general_gallery_photo_2['items'][]=get_field('general_gallery_photo_15');
    $acf_general_gallery_photo_2['items'][]=get_field('general_gallery_photo_16');
    $acf_general_gallery_photo_2['items'][]=get_field('general_gallery_photo_17');
    $acf_general_gallery_photo_2['items'][]=get_field('general_gallery_photo_18');
    $acf_general_gallery_photo_2['items'][]=get_field('general_gallery_photo_19');
    $acf_general_gallery_photo_2['items'][]=get_field('general_gallery_photo_20');

    // array_filter($acf_general_gallery_photo, function($value) { return $value !== ''; });
    array_filter($acf_general_gallery_photo['items']);
    array_filter($acf_general_gallery_photo_2['items']);

    // var_dump($acf_general_gallery_photo);
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
<!-- ben 170117 -->


  <?php if(!empty($acf_general_display_gallery)){ ?>
    <div class="aligncenter clearfix container">
      <?php if( !empty($acf_summary) ): ?>
        <h2 class="summary-box section-title"><?php echo $acf_summary; ?></h2>
      <?php endif; ?>
      <?php if(!empty($acf_general_gallery_description)){ ?>
        <div class="short-description-box clearfix"><?php echo $acf_short_description; ?></div>
      <?php } ?>
    </div>




<!-- gallery -->
    <div class="clearfix container">
			<?php if(!empty($acf_general_display_gallery)&&$acf_general_display_gallery=='yes'){ ?>
      <div class="gallery-slider-container dt-sc-two-third column first">
        <!-- <div class="bx-wrapper"> -->
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
      </div>
			<?php } ?>
      <!-- </div> -->
      <div class="<?php if(!empty($acf_general_display_gallery)&&$acf_general_display_gallery=='yes'){ ?>dt-sc-one-third <?php } ?>column">
        <?php if(!empty($acf_general_gallery_description)){ ?>
        <div class="short-description-box clearfix"><?php echo $acf_general_gallery_description; ?></div>
        <?php }else{ ?>
          <div class="short-description-box clearfix"><?php echo $acf_short_description; ?></div>
          <?php } ?>

        <?php if(!empty($acf_general_display_social_share)&&$acf_general_display_social_share=='yes'): ?>
        <div class="gallery-share" id="social-share"><?php dt_theme_social_bookmarks('sb-gallery'); ?></div>
        <?php endif; ?>
      </div>
     </div>
<!-- /gallery -->




<?php if(!empty($acf_general_display_gallery_2)&&$acf_general_display_gallery_2=='yes'){ ?>
<!-- gallery2 -->

  <div class="aligncenter clearfix container">
      <h2 class="summary-box section-title"><?php echo $acf_summary_2; ?></h2>
      <div class="short-description-box clearfix"><?php echo $acf_short_description_2; ?></div>
  </div>
    <div class="clearfix container">
			<?php if(!empty($acf_general_display_gallery_2)&&$acf_general_display_gallery_2=='yes'){ ?>
      <div class="gallery-slider-container dt-sc-two-third column first">
        <!-- <div class="bx-wrapper"> -->
        <ul class="gallery-bx-wrapper-2">
  				<?php
  				$i = 0;
          $gallery_pager_out='';
          // var_dump($acf_general_gallery_photo);
  				foreach($acf_general_gallery_photo_2['items'] as $key => $item){
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
        <div id="entry-gallery-pager-2">
				<?php
				$i = 0;
        $gallery_pager_out='';
        // var_dump($acf_general_gallery_photo);
				foreach($acf_general_gallery_photo_2['items'] as $key => $item){
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
      </div>
			<?php } ?>
      <!-- </div> -->
      <div class="dt-sc-one-third column">
        <?php if(!empty($acf_general_gallery_description_2)){ ?>
        <div class="short-description-box clearfix"><?php echo $acf_general_gallery_description_2; ?></div>
        <?php }else{ ?>
          <div class="short-description-box clearfix"><?php echo $acf_short_description_2; ?></div>
          <?php } ?>

        <?php if(!empty($acf_general_display_social_share)&&$acf_general_display_social_share=='yes'): ?>
        <div class="gallery-share"><?php dt_theme_social_bookmarks('sb-gallery'); ?></div>
        <?php endif; ?>
      </div>
     </div>
<!-- /gallery2 -->
<?php } ?>

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
<!-- wechat social share icon -->
<script>
if (jQuery('#social-share').length) {
	jQuery('.a2a_button_wechat').removeClass('a2a_button_wechat').appendTo('.wechat').addClass('fa fa-wechat');
}
</script>
