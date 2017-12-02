<?php
	//GETTING META VALUES...
	$meta_set = "";
	if(is_page())
		$meta_set = get_post_meta($post->ID, '_tpl_default_settings', true);
	elseif(is_single())
		$meta_set = get_post_meta($post->ID, '_dt_post_settings', true);
		
	if(dt_theme_option('general', 'disable-breadcrumb') != "on"):
		//PARALLAX VALUES...
		$sub_bg = !empty($meta_set['sub-title-bg']) ? $meta_set['sub-title-bg'] : '';
		$sub_re = !empty($meta_set['sub-title-bg-repeat']) ? $meta_set['sub-title-bg-repeat'] : 'repeat';
		$sub_po = !empty($meta_set['sub-title-bg-position']) ? $meta_set['sub-title-bg-position'] : 'center center';
		$sub_co = !empty($meta_set['sub-title-bg-color']) ? hex2rgb($meta_set['sub-title-bg-color']) : '';
		
		//ASSIGNING VALUES...
		if($sub_bg != ''): ?>
			<section class="fullwidth-background sub-parallax" style="background-image:url(<?php echo esc_attr($sub_bg); ?>); background-repeat:<?php echo esc_attr($sub_re); ?>; background-position:<?php echo esc_attr($sub_po); ?>"><?php
			if($sub_co != ''): ?>
				<div class="breadcrumb-wrapper" style="background-color:rgba(<?php echo esc_attr($sub_co[0]); ?>, <?php echo esc_attr($sub_co[1]); ?>, <?php echo esc_attr($sub_co[2]); ?>, 0.9);"><?php
			else: ?>
				<div class="breadcrumb-wrapper"><?php
			endif;
		else: ?>
			<section class="fullwidth-background">
				<div class="breadcrumb-wrapper"><?php
		endif; ?>
                <div class="container">
                    <h1><?php the_title(); ?></h1>
                    <?php new dt_theme_breadcrumb; ?>
                </div>
				</div>
			</section><?php
	endif; ?>