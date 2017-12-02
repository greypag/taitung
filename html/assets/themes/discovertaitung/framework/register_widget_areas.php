<?php 
	#Display Everywhere Left
	register_sidebar(array(
		'name' 			=>	__('Display Everywhere Left', 'iamd_text_domain'),
		'id'			=>	'display-everywhere-sidebar-left',
		'description'	=>	__("Common sidebar that appears on the left.","iamd_text_domain"),
		'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
		'after_widget' 	=> 	'</div>',
		'before_title' 	=> 	'<h3 class="widgettitle">',
		'after_title' 	=> 	'</h3>'));

	#Display Everywhere Right
	register_sidebar(array(
		'name' 			=>	__('Display Everywhere Right', 'iamd_text_domain'),
		'id'			=>	'display-everywhere-sidebar-right',
		'description'	=>	__("Common sidebar that appears on the right.","iamd_text_domain"),
		'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
		'after_widget' 	=> 	'</div>',
		'before_title' 	=> 	'<h3 class="widgettitle">',
		'after_title' 	=> 	'</h3>'));

	#Custom Widgetarea
	$custom_widgetarea = dt_theme_option('widgetarea','custom');
	$custom_widgetarea = is_array($custom_widgetarea) ? array_unique($custom_widgetarea) : array();
    $custom_widgetarea = array_filter($custom_widgetarea);
    foreach ($custom_widgetarea as $key => $value) {
    	$id = mb_convert_case($value, MB_CASE_LOWER, "UTF-8");
    	$id = str_replace(" ", "-", $id);

    	register_sidebar(array(
		'name' 			=>	$value,
		'id'			=>	$id,
		'description'   =>  __("A unique sidebar that is created in Admin panel for custom sidebar","iamd_text_domain"),
		'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
		'after_widget' 	=> 	'</div>',
		'before_title' 	=> 	'<h3 class="widgettitle">',
		'after_title' 	=> 	'</h3>'));
    }
	
	#Events Everywhere Sidebar
	if( class_exists('Tribe__Events__Main')	):
		#Left Sidebar
		register_sidebar(array(
			'name' 			=>	__('Events Everywhere Left', 'iamd_text_domain'),
			'id'			=>	'events-everywhere-sidebar-left',
			'description'   =>  __("Events page unique sidebar that appears on the left.","iamd_text_domain"),
			'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</div>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'</h3>'));
			
		#Right Sidebar
		register_sidebar(array(
			'name' 			=>	__('Events Everywhere Right', 'iamd_text_domain'),
			'id'			=>	'events-everywhere-sidebar-right',
			'description'   =>  __("Events page unique sidebar that appears on the right.","iamd_text_domain"),
			'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</div>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'</h3>'));
	endif;
	
	#Shop Everywhere Sidebar
	if( class_exists('woocommerce')	):
		#Left Sidebar
		register_sidebar(array(
			'name' 			=>	__('Shop Everywhere Left', 'iamd_text_domain'),
			'id'			=>	'shop-everywhere-sidebar-left',
			'description'   =>  __("Shop page unique sidebar that appears on the left.","iamd_text_domain"),
			'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</div>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'</h3>'));
			
		#Right Sidebar
		register_sidebar(array(
			'name' 			=>	__('Shop Everywhere Right', 'iamd_text_domain'),
			'id'			=>	'shop-everywhere-sidebar-right',
			'description'   =>  __("Shop page unique sidebar that appears on the right.","iamd_text_domain"),
			'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</div>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'</h3>'));
	endif;
	
	#Post Archives Sidebar
	$post_archives_layout = dt_theme_option('specialty','post-archives-layout');
	$post_archives_layout = !empty($post_archives_layout) ? $post_archives_layout : "content-full-width";
	if( $post_archives_layout != "content-full-width" ){
		if( $post_archives_layout == "with-left-sidebar" || $post_archives_layout == "with-both-sidebar" ){
			register_sidebar(array(
				'name' 			=>	__("Post Archives Sidebar Left",'iamd_text_domain'),
				'id'			=>	'post-archives-sidebar-left',
				'description'   =>  __("Tag archives sidebar that appears on the left.","iamd_text_domain"),
				'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</div>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
		}
		if( $post_archives_layout == "with-right-sidebar" || $post_archives_layout == "with-both-sidebar"){
			register_sidebar(array(
				'name' 			=>	__("Post Archives Sidebar Right",'iamd_text_domain'),
				'id'			=>	'post-archives-sidebar-right',
				'description'   =>  __("Tag archives sidebar that appears on the right.","iamd_text_domain"),
				'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</div>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
		}
	}
	
	#Gallery Archives Sidebar
	if( dt_theme_is_plugin_active('designthemes-core-features/designthemes-core-features.php') ):
		$gallery_archives_layout = dt_theme_option('specialty','gallery-archives-layout');
		$gallery_archives_layout = !empty($gallery_archives_layout) ? $gallery_archives_layout : "content-full-width";
		if( $gallery_archives_layout != "content-full-width" ){
			if( $gallery_archives_layout == "with-left-sidebar" || $gallery_archives_layout == "with-both-sidebar" ){
				register_sidebar(array(
					'name' 			=>	__("Gallery Archives Sidebar Left",'iamd_text_domain'),
					'id'			=>	'custom-post-gallery-archives-sidebar-left',
					'description'   =>  __("Gallery archives sidebar that appears on the left.","iamd_text_domain"),
					'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</div>',
					'before_title' 	=> 	'<h3 class="widgettitle">',
					'after_title' 	=> 	'</h3>'));
			}
			if( $gallery_archives_layout == "with-right-sidebar" || $gallery_archives_layout == "with-both-sidebar"){
				register_sidebar(array(
					'name' 			=>	__("Gallery Archives Sidebar Right",'iamd_text_domain'),
					'id'			=>	'custom-post-gallery-archives-sidebar-right',
					'description'   =>  __("Gallery archives sidebar that appears on the right.","iamd_text_domain"),
					'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</div>',
					'before_title' 	=> 	'<h3 class="widgettitle">',
					'after_title' 	=> 	'</h3>'));
			}
			
		}
	endif;
	
	#Search Page Layout
	$search_layout = dt_theme_option('specialty','search-layout');
	$search_layout = !empty($search_layout) ? $search_layout : "content-full-width";
	if( $search_layout != "content-full-width" ){
		if( $search_layout == "with-left-sidebar" || $search_layout == "with-both-sidebar" ){
			register_sidebar(array(
				'name' 			=>	__("Search Sidebar Left",'iamd_text_domain'),
				'id'			=>	'search-sidebar-left',
				'description'   =>  __("Search page sidebar that appears on the left.","iamd_text_domain"),
				'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</div>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
        }
		if( $search_layout == "with-right-sidebar" || $search_layout == "with-both-sidebar"){
			register_sidebar(array(
				'name' 			=>	__("Search Sidebar Right",'iamd_text_domain'),
				'id'			=>	'search-sidebar-right',
				'description'   =>  __("Search page sidebar that appears on the right.","iamd_text_domain"),
				'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</div>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
		}
		
	}
	
	#404 Page Layout
	$layout_404 = dt_theme_option('specialty','not-found-404-layout');
	$layout_404 = !empty($layout_404) ? $layout_404 : "content-full-width";
	if( $layout_404 != "content-full-width" ){
		if( $layout_404 == "with-left-sidebar" || $layout_404 == "with-both-sidebar" ){
			register_sidebar(array(
				'name' 			=>	__('Not Found ( 404 ) Sidebar Left','iamd_text_domain'),
				'id'			=>	'not-found-404-sidebar-left',
				'description'   =>  __("404 page sidebar that appears on the left.","iamd_text_domain"),
				'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</div>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
        }
		if( $layout_404 == "with-right-sidebar" || $layout_404 == "with-both-sidebar"){
			register_sidebar(array(
				'name' 			=>	__('Not Found ( 404 ) Sidebar Right','iamd_text_domain'),
				'id'			=>	'not-found-404-sidebar-right',
				'description'   =>  __("404 page sidebar that appears on the right.","iamd_text_domain"),
				'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</div>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
		}
		
	}

	#Footer Columnns		
	$footer_columns =  dt_theme_option('general','footer-columns');
	dt_theme_footer_widgetarea($footer_columns);
	
	#Custom Mega Menu Sidebars
	$widgets = dt_theme_option('widgetarea','megamenu');
	$widgets = is_array($widgets) ? array_unique($widgets) : array();
    $widgets = array_filter($widgets);
    foreach ($widgets as $key => $value) {
    	$id = mb_convert_case($value, MB_CASE_LOWER, "UTF-8");
    	$id = str_replace(" ", "-", $id);

    	register_sidebar(array(
			'name' 			=>	$value,
			'id'			=>	$id,
			'description'   =>  __("A unique mega menu sidebar that is created in Admin panel","iamd_text_domain"),
			'before_widget' => 	'<li id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</li>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'</h3>'));
    }

if( class_exists('woocommerce')	):

	#Custom Left Sidebars for Product
	$products = dt_theme_option("widgetarea","left-products");
	$products = !empty($products) ? $products : array();
	$widget_areas_for_products = array_filter(array_unique($products));
	foreach($widget_areas_for_products as $id):
		$title = get_the_title($id);
		register_sidebar(array(
			'name' 			=>	"Product: {$title} - Left",
			'id'			=>	"left-product-{$id}-sidebar",
			'description'	=> __("Individual product sidebar that appears on the left.","iamd_text_domain"),
			'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</div>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'</h3>'));
	endforeach;

	#Custom Right Sidebars for Product
	$products = dt_theme_option("widgetarea","right-products");
	$products = !empty($products) ? $products : array();
	$widget_areas_for_products = array_filter(array_unique($products));
	foreach($widget_areas_for_products as $id):
		$title = get_the_title($id);
		register_sidebar(array(
			'name' 			=>	"Product: {$title} - Right",
			'id'			=>	"right-product-{$id}-sidebar",
			'description'	=> __("Individual product sidebar that appears on the right.","iamd_text_domain"),
			'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</div>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'</h3>'));
	endforeach;

	#Custom Left Sidebars for Product Category
	$product_categories = dt_theme_option("widgetarea","left-product-category");
	$product_categories = !empty($product_categories) ? $product_categories : array();
	$widget_areas_for_product_categories = array_filter(array_unique($product_categories));
	
	foreach($widget_areas_for_product_categories as $id):
	
		$title = $wpdb->get_var( $wpdb->prepare("SELECT name FROM $wpdb->terms  WHERE term_id = %s",$id));
		$slug  = $wpdb->get_var( $wpdb->prepare("SELECT slug FROM $wpdb->terms  WHERE term_id = %s",$id));	
		
		register_sidebar(array(
			'name' 			=>	"Product Category: {$title} - Left ",
			'id'			=>	"left-product-category-{$slug}-sidebar",
			'description'	=> __("Individual product category sidebar that appears on the left.","iamd_text_domain"),
			'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</div>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'</h3>'));
	endforeach;
	
	#Custom Right Sidebars for Product Category
	$product_categories = dt_theme_option("widgetarea","right-product-category");
	$product_categories = !empty($product_categories) ? $product_categories : array();
	$widget_areas_for_product_categories = array_filter(array_unique($product_categories));
	
	foreach($widget_areas_for_product_categories as $id):
	
		$title = $wpdb->get_var( $wpdb->prepare("SELECT name FROM $wpdb->terms  WHERE term_id = %s",$id));
		$slug  = $wpdb->get_var( $wpdb->prepare("SELECT slug FROM $wpdb->terms  WHERE term_id = %s",$id));	
		
		register_sidebar(array(
			'name' 			=>	"Product Category: {$title} - Right ",
			'id'			=>	"right-product-category-{$slug}-sidebar",
			'description'	=> __("Individual product category sidebar that appears on the right.","iamd_text_domain"),
			'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</div>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'</h3>'));
	endforeach;

	#Custom Left Sidebars for Product Tag
	$product_tags = dt_theme_option("widgetarea","left-product-tag");
	$product_tags = !empty($product_tags) ? $product_tags : array();
	$widget_areas_for_product_tags = array_filter(array_unique($product_tags));
	foreach($widget_areas_for_product_tags as $id):
		$title = $wpdb->get_var( $wpdb->prepare("SELECT name FROM $wpdb->terms  WHERE term_id = %s",$id));
		$slug  = $wpdb->get_var( $wpdb->prepare("SELECT slug FROM $wpdb->terms  WHERE term_id = %s",$id));	
		register_sidebar(array(
			'name' 			=>	"Product Tag: {$title} - Left",
			'id'			=>	"left-product-tag-{$slug}-sidebar",
			'description'	=> __("Individual product tag sidebar that appears on the left.","iamd_text_domain"),
			'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</div>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'</h3>'));
	endforeach;

	#Custom Right Sidebars for Product Tag
	$product_tags = dt_theme_option("widgetarea","right-product-tag");
	$product_tags = !empty($product_tags) ? $product_tags : array();
	$widget_areas_for_product_tags = array_filter(array_unique($product_tags));
	foreach($widget_areas_for_product_tags as $id):
		$title = $wpdb->get_var( $wpdb->prepare("SELECT name FROM $wpdb->terms  WHERE term_id = %s",$id));
		$slug  = $wpdb->get_var( $wpdb->prepare("SELECT slug FROM $wpdb->terms  WHERE term_id = %s",$id));	
		register_sidebar(array(
			'name' 			=>	"Product Tag: {$title} - Right",
			'id'			=>	"right-product-tag-{$slug}-sidebar",
			'description'	=> __("Individual product tag sidebar that appears on the right.","iamd_text_domain"),
			'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</div>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'</h3>'));
	endforeach;

endif;?>