<?php
wp_reset_query();
global $post;

if( is_page() ):

	dt_theme_show_sidebar('page',$post->ID, 'right');

elseif( is_singular('post') ):

	dt_theme_show_sidebar('page',$post->ID, 'right');

elseif( is_singular('dt_hotels')):

	dt_theme_show_sidebar('dt_hotels',$post->ID, 'right');

elseif( is_singular('dt_places')):

	dt_theme_show_sidebar('dt_places',$post->ID, 'right');

elseif( is_singular('product') ):

	$disable = dt_theme_option('woo',"disable-shop-everywhere-right-sidebar-for-product-layout");
	if( is_null($disable) ):
		if(function_exists('dynamic_sidebar') && dynamic_sidebar('shop-everywhere-sidebar-right') ): endif;
	endif;
	
elseif( is_post_type_archive('dt_galleries') ):
	
	if(function_exists('dynamic_sidebar') && dynamic_sidebar('custom-post-gallery-archives-sidebar-right') ): endif;

	$disable = dt_theme_option('specialty',"disable-everywhere-right-sidebar-for-gallery-archives");
	if( is_null($disable) ):
		if(function_exists('dynamic_sidebar') && dynamic_sidebar(('display-everywhere-sidebar-right')) ): endif;
	endif;
	
elseif( is_post_type_archive('product') ):

	dt_theme_show_sidebar('page',get_option('woocommerce_shop_page_id'), 'right');
	
elseif( class_exists('woocommerce') && is_product_category() ):

	$disable = dt_theme_option('woo',"disable-shop-everywhere-right-sidebar-for-product-category-layout");
	if( is_null($disable) ):
		if(function_exists('dynamic_sidebar') && dynamic_sidebar('shop-everywhere-sidebar-right') ): endif;
	endif;

elseif( class_exists('woocommerce') && is_product_tag() ):

	$disable = dt_theme_option('woo',"disable-shop-everywhere-right-sidebar-for-product-tag-layout");
	if( is_null($disable) ):
		if(function_exists('dynamic_sidebar') && dynamic_sidebar('shop-everywhere-sidebar-right') ): endif;
	endif;
	
elseif( is_post_type_archive('tribe_events') ):
	
	$disable = dt_theme_option('events',"disable-event-everywhere-right-sidebar-for-event-archive-layout");
	if( is_null($disable) ):
		if(function_exists('dynamic_sidebar') && dynamic_sidebar('events-everywhere-sidebar-right') ): endif;
	endif;

elseif( in_array('tribe-filter-live', get_body_class()) ):
	
	$disable = dt_theme_option('events',"disable-event-everywhere-right-sidebar-for-event-category-layout");
	if( is_null($disable) ):
		if(function_exists('dynamic_sidebar') && dynamic_sidebar('events-everywhere-sidebar-right') ): endif;
	endif;
	
elseif(is_singular('tribe_events') || is_singular('tribe_venue') || is_singular('tribe_organizer')):

	$disable = dt_theme_option('events',"disable-event-everywhere-right-sidebar-for-event-detail-layout");
	if( is_null($disable) ):
		if(function_exists('dynamic_sidebar') && dynamic_sidebar('events-everywhere-sidebar-right') ): endif;
	endif;		
		
elseif( is_archive() ):

	if(function_exists('dynamic_sidebar') && dynamic_sidebar('post-archives-sidebar-right') ): endif;

	$disable = dt_theme_option('specialty',"disable-everywhere-right-sidebar-for-post-archives");
	if( is_null($disable) ):
		if(function_exists('dynamic_sidebar') && dynamic_sidebar(('display-everywhere-sidebar-right')) ): endif;
	endif;

elseif( is_search() ):

	if(function_exists('dynamic_sidebar') && dynamic_sidebar('search-sidebar-right') ): endif;

	$disable = dt_theme_option('specialty',"disable-everywhere-right-sidebar-for-search");
	if( is_null($disable) ):
		if(function_exists('dynamic_sidebar') && dynamic_sidebar(('display-everywhere-sidebar-right')) ): endif;
	endif;
	
elseif( is_404() ):

	if(function_exists('dynamic_sidebar') && dynamic_sidebar('not-found-404-sidebar-right') ): endif;

	$disable = dt_theme_option('specialty',"disable-everywhere-right-sidebar-for-not-found-404");
	if( is_null($disable) ):
		if(function_exists('dynamic_sidebar') && dynamic_sidebar(('display-everywhere-sidebar-right')) ): endif;
	endif;

else:
	if(function_exists('dynamic_sidebar') && dynamic_sidebar(('display-everywhere-sidebar-right')) ): endif;
endif;

?>