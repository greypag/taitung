<!-- start: gallery-single-layout-two -->
<?php
	global $dt_allowed_html_tags;

	$p_meta_set = get_post_meta($post->ID, '_gallery_settings', true);
	$page_layout = $p_meta_set['layout'];
?>
    <div class="gallery-slider-container dt-sc-two-third column<?php if($page_layout == "single-gallery-layout-three") echo ' right-gallery'; else echo ' first'; ?>">
        <ul class="gallery-bx-wrapper"><?php
            //GETTING GALLERY VALUES...
            global $wp_embed;

            if(isset($p_meta_set['items']) != ""):
                foreach($p_meta_set['items'] as $key => $item):
                echo "<li>";
                    if($p_meta_set ['items_name'] [$key] != 'video')
                        echo "<img src='".$item."' alt='".$p_meta_set ['items_name'] [$key]."'>";
                    else {
                        //For Vimeo...
                        if ( strpos($item, "vimeo") ) :
                            $url = substr( strrchr($item, "/"),1);
                            echo "<iframe src='https://player.vimeo.com/video/{$url}' width='770' height='530' frameborder='0'></iframe>";

                        //For Youtube...
                        elseif( strpos($item, "?v=") ):
                            $url = substr( strrchr($item, "="),1);
                            echo "<iframe src='https://www.youtube.com/embed/{$url}?wmode=opaque' width='770' height='530' frameborder='0'></iframe>";
                        endif;
                    }
                echo "</li>";
                endforeach;
            endif; ?>
        </ul>
        <div id="entry-gallery-pager">
				<?php
      // var_dump($p_meta_set);
				$i = 0;
        $gallery_pager_out='';
				foreach($p_meta_set['items'] as $key => $item){
					$gallery_pager_out.="<a data-slide-index='".$i."' href='' ><img src='".$item."' alt='".$p_meta_set ['items_name'] [$key]."'></a>";
					$i += 1;
				}
        $gallery_pager_out.='';
        echo $gallery_pager_out;
				?></div>
		</div>
    <div class="dt-sc-one-third column<?php if($page_layout == "single-gallery-layout-three") echo ' first'; ?>">
        <div class="content-box">
            <?php /*<h3><?php the_title(); ?></h3> */?>
            <?php the_content();
            wp_link_pages(array('before' => '<div class="page-link"><strong>'.__('Pages:', 'dt_themes').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number'));
            //edit_post_link(__('Edit', 'dt_themes'), '<span class="edit-link">', '</span>' ); ?>
            <?php /*<p class="tags"><span class="fa fa-tag"></span> <?php echo get_the_term_list($post->ID, 'gallery_entries', __('Posted In:', 'dt_themes').'&nbsp;&nbsp;&nbsp;&nbsp;', '', ' '); ?></p>*/?>
			<div class="dt-sc-hr-invisible-small"></div>
            <?php /*<h4><?php _e('Other Details', 'dt_themes'); ?></h4>*/?>
            <ul class="project-details">
              <?php
              $acf_general_address = get_field('general_address');
              $acf_general_phone = get_field('general_phone');
              $acf_general_website_text = get_field('general_website_text');
              $acf_general_website = get_field('general_website');
							$acf_general_open = get_field('general_open');
							$acf_general_information = get_field('general_information');
							$acf_general_remarks = get_field('general_remarks');
							$acf_general_date = get_field('general_date');
							$acf_general_link = get_field('general_link');
							$acf_general_ticket = get_field('general_ticket');
              ?>
              <?php
              if( !empty($acf_general_address) ): ?>
                <li class="divided-list"><div class="divide-1"><span class="fa fa-fw fa-map-marker"></span><strong><?php _e('Address: ', 'dt_themes');?></strong></div><div class="divide-2"><?php echo $acf_general_address; ?></div></li>
              <?php endif;?>
              <?php
              if( !empty($acf_general_phone) ): ?>
                <li class="divided-list"><div class="divide-1"><span class="fa fa-fw fa-phone"></span><strong><?php _e('Phone: ', 'dt_themes');?></strong></div><div class="divide-2"><?php echo $acf_general_phone; ?></div></li>
              <?php endif;?>
							<?php
              if( !empty($acf_general_date) ): ?>
                <li class="divided-list"><div class="divide-1"><span class="fa fa-fw fa-calendar"></span><strong><?php _e('Date: ', 'dt_themes');?></strong></div><div class="divide-2"><?php echo $acf_general_date; ?></div></li>
              <?php endif;?>
              <?php
              if( !empty($acf_general_website) ): ?>
                <li><span class="fa fa-fw fa-link"></span><strong><?php _e('Website: ', 'dt_themes');?></strong><a href="<?php echo $acf_general_website; ?>" target="_blank"><?php echo $acf_general_website_text; ?></a></li>
              <?php endif;?>
							<?php
							if( !empty($acf_general_link) ): ?>
								<li><span class="fa fa-fw fa-link"></span><a href="<?php echo $acf_general_link; ?>" target="_blank"><strong><?php _e('Information Link', 'dt_themes');?></strong></a></li>
							<?php endif;?>
							<?php
							if( !empty($acf_general_ticket) ): ?>
								<li><span class="fa fa-fw fa-ticket"></span><a href="<?php echo $acf_general_ticket; ?>" target="_blank"><strong><?php _e('Book Ticket', 'dt_themes');?></strong></a></li>
							<?php endif;?>
							<?php
							if( !empty($acf_general_open) ): ?>
								<li class="divided-list"><div class="divide-1"><span class="fa fa-fw fa-clock-o"></span><strong><?php _e('Opening hours: ', 'dt_themes');?></strong></div><div class="divide-2"><?php echo $acf_general_open; ?></div></li>
							<?php endif;?>
							<?php
							if( !empty($acf_general_information) ): ?>
								<li class="divided-list"><div class="divide-1"><span class="fa fa-fw fa-ticket"></span><strong><?php _e('Information: ', 'dt_themes');?></strong></div><div class="divide-2"><?php echo $acf_general_information; ?></div></li>
							<?php endif;?>
							<?php
							if( !empty($acf_general_remarks) ): ?>
								<li class="divided-list"><div class="divide-1"><span class="fa fa-fw fa-info-circle"></span><strong><?php _e('Remarks: ', 'dt_themes');?></strong></div><div class="divide-2"><?php echo $acf_general_remarks; ?></div></li>
							<?php endif;?>


							  <?php /*if(isset($p_meta_set['location'])):?><li><span class="fa fa-fw fa-map-marker"></span><strong><?php _e('Address: ', 'dt_themes');?></strong><?php echo wp_kses($p_meta_set['location'], $dt_allowed_html_tags); ?></li><?php endif; ?>
								<?php if(isset($p_meta_set['client'])): ?><li><span class="fa fa-phone"></span><strong><?php _e('Phone : ', 'dt_themes'); ?></strong><?php echo wp_kses($p_meta_set['client'], $dt_allowed_html_tags); ?></li><?php endif; ?>
                <?php if(isset($p_meta_set['url'])): ?><li><span class="fa fa-fw fa-link"></span><strong><?php _e('Website: ', 'dt_themes'); ?></strong><a href="<?php echo wp_kses($p_meta_set['url'], $dt_allowed_html_tags); ?>" target="_blank"><?php echo wp_kses($p_meta_set['url'], $dt_allowed_html_tags); ?></a></li><?php endif; ?>
                <?php <li><span class="fa fa-calendar"></span><strong><?php _e('Submitted On : ', 'dt_themes'); ?></strong><?php echo get_the_date('d')." ".get_the_date('M')." ".get_the_date('Y'); ?></li> */?>
            </ul>
            <?php if(isset($p_meta_set['show-social-share'])): ?><div class="gallery-share"><?php dt_theme_social_bookmarks('sb-gallery'); ?></div><?php endif; ?>
        </div>
      </div>
    <!-- end: gallery-single-layout-two -->

		<!-- wechat social share icon -->
		<script>
		jQuery('.a2a_button_wechat').appendTo('.wechat').addClass('fa fa-wechat').removeClass('a2a_button_wechat');
		</script>
