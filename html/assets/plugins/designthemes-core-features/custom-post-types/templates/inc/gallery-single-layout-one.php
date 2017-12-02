<!-- start: gallery-single-layout-one -->
<?php
	global $dt_allowed_html_tags;

	$p_meta_set = get_post_meta($post->ID, '_gallery_settings', true);
	$page_layout = $p_meta_set['layout']; ?>
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
                        echo "<iframe src='https://player.vimeo.com/video/{$url}' width='1170' height='800' frameborder='0'></iframe>";

                    //For Youtube...
                    elseif( strpos($item, "?v=") ):
                        $url = substr( strrchr($item, "="),1);
                        echo "<iframe src='https://www.youtube.com/embed/{$url}?wmode=opaque' width='1170' height='800' frameborder='0'></iframe>";
                    endif;
                }
            echo "</li>";
            endforeach;
        endif; ?>
    </ul>
	<div class="dt-sc-hr-invisible"></div>
    <div class="column">
        <?php /*<h3><?php the_title(); ?></h3>*/ ?>
        <?php
            the_content();
            wp_link_pages(array('before' => '<div class="page-link"><strong>'.__('Pages:', 'dt_themes').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number'));
            edit_post_link(__('Edit', 'dt_themes'), '<span class="edit-link">', '</span>' ); ?>
            <?php /* <p class="tags"><span class="fa fa-tag"></span> <?php echo get_the_term_list($post->ID, 'gallery_entries', __('Posted In:', 'dt_themes').'&nbsp;&nbsp;&nbsp;&nbsp;', '', ' '); ?></p>*/?>
    </div>
    <div class="column">
        <div class="content-box">
            <?php /* <h4><?php _e('Other Details', 'dt_themes'); ?></h4> */ ?>
            <ul class="project-details">
                <?php if(isset($p_meta_set['client'])):?><li><span class="fa fa-user"></span>test <strong><?php _e('Organizer : ', 'dt_themes'); ?></strong><?php echo wp_kses($p_meta_set['client'], $dt_allowed_html_tags); ?></li><?php endif; ?>
                <?php if(isset($p_meta_set['url'])): ?><li><span class="fa fa-link"></span><strong><?php _e('Website : ', 'dt_themes'); ?></strong><a href="<?php echo wp_kses($p_meta_set['url'], $dt_allowed_html_tags); ?>" target="_blank"><?php echo wp_kses($p_meta_set['url'], $dt_allowed_html_tags); ?></a></li><?php endif; ?>
                <?php /* <li><span class="fa fa-calendar"></span><strong><?php _e('Submitted On : ', 'dt_themes'); ?></strong><?php echo get_the_date('d')." ".get_the_date('M')." ".get_the_date('Y'); ?></li> */ ?>
            </ul>
        </div>
    </div>
    <div class="fullwidth-section"><?php if(isset($p_meta_set['show-social-share'])): ?><div class="gallery-share"><?php dt_theme_social_bookmarks('sb-gallery'); ?></div><?php endif; ?></div>

    <!-- end: gallery-single-layout-one -->
