<?php if (!function_exists('dt_theme_features')) {

	// Register Theme Features
	function dt_theme_features() {
		global $wp_version;

		// Add theme support for Custom Background
		$b_args = array(
			'default-color' => 'ffffff',
			'default-image' => '',
			'wp-head-callback' => '_custom_background_cb',
			'admin-head-callback' => '',
			'admin-preview-callback' => ''
		);
		add_theme_support('custom-background', $b_args);
		// END of Custom Background Feature

		// Add theme support for Custom Header
		$hargs = array( 'default-image'=>'',	'random-default'=>false,	'width'=>0,					'height'=>0,
				'flex-height'=> false,	'flex-width'=> false,		'default-text-color'=> '',	'header-text'=> false,
				'uploads'=> true,		'wp-head-callback'=> '',	'admin-head-callback'=> '',	'admin-preview-callback' => '');
				
		add_theme_support('custom-header', $hargs);
		// END of Custom Header Feature

		// Add theme support for Translation
		load_theme_textdomain('iamd_text_domain', get_template_directory().'/languages');

		// Add theme support for Post Formats
		$formats = array(
			'status',
			'quote',
			'gallery',
			'image',
			'video',
			'audio',
			'link',
			'aside',
			'chat'
		);
		add_theme_support('post-formats', $formats);
		// END of Post Formats

		// Add theme support for custom CSS in the TinyMCE visual editor
		add_editor_style('css/editor-style.css');

		// Add theme support for Automatic Feed Links
		add_theme_support('automatic-feed-links');
		// END of Automatic Feed Links

		// Add theme support for Featured Images
		add_theme_support('post-thumbnails');

		//Gallery Image Sizes
		add_image_size('gallery-onecol', 940, 470, true);
		add_image_size('gallery-onecol-sidebar', 685, 340, true);
		add_image_size('gallery-twocol', 585, 400, true);
		add_image_size('gallery-twocol-sidebar', 420, 309, true);
		add_image_size('gallery-twocol-bothsidebar', 420, 287, true);
		add_image_size('gallery-threecol', 420, 287, true);
		add_image_size('gallery-threecol-sidebar', 420, 287, true);
		add_image_size('gallery-threecol-bothsidebar', 420, 287, true);
		add_image_size('gallery-fourcol', 420, 287, true);
		add_image_size('gallery-fourcol-sidebar', 420, 287, true);
		add_image_size('gallery-fourcol-bothsidebar', 420, 287, true);

		//Blog Image Sizes
		add_image_size('blog-onecol', 1070, 732, true);
		add_image_size('blog-onecol-sidebar', 670, 458, true);
		add_image_size('blog-onecol-bothsidebar', 490, 335, true);
		add_image_size('blog-twocol', 472, 323, true);
		add_image_size('blog-twocol-sidebar', 420, 287, true);
		add_image_size('blog-twocol-bothsidebar', 420, 287, true);
		add_image_size('blog-threecol', 420, 287, true);
		add_image_size('blog-threecol-sidebar', 420, 287, true);
		add_image_size('blog-threecol-bothsidebar', 510, 350, true);
		add_image_size('blog-thumb', 420, 287, true);
		add_image_size('blog-thumb-sidebar', 420, 287, true);
		add_image_size('blog-thumb-bothsidebar', 510, 350, true);

		//Hotel Image Sizes
		add_image_size('hotel-thumb', 420, 277, true);
		add_image_size('hotel-thumb-sidebar', 420, 338, true);
		add_image_size('hotel-thumb-bothsidebar', 420, 277, true);

		//Place Image Sizes
		add_image_size('places-twocol', 572, 418, true);
		add_image_size('places-twocol-sidebar', 420, 307, true);
		add_image_size('places-twocol-bothsidebar', 420, 307, true);
		add_image_size('places-threecol', 420, 307, true);
		add_image_size('places-threecol-sidebar', 420, 307, true);
		add_image_size('places-threecol-bothsidebar', 420, 307, true);
		add_image_size('places-fourcol', 420, 307, true);
		add_image_size('places-fourcol-sidebar', 420, 307, true);
		add_image_size('places-fourcol-bothsidebar', 420, 307, true);

		//Event Image Sizes
		add_image_size('events-twocol', 570, 390, true);
		add_image_size('events-twocol-sidebar', 420, 287, true);
		add_image_size('events-twocol-bothsidebar', 420, 287, true);
		add_image_size('events-threecol', 420, 287, true);
		add_image_size('events-threecol-sidebar', 420, 287, true);
		add_image_size('events-threecol-bothsidebar', 420, 287, true);
		add_image_size('events-fourcol', 420, 287, true);
		add_image_size('events-fourcol-sidebar', 420, 287, true);
		add_image_size('events-fourcol-bothsidebar', 420, 287, true);

		//Package Image Sizes
		add_image_size('package-twocol', 569, 569, true);
		add_image_size('package-twocol-sidebar', 420, 420, true);
		add_image_size('package-threecol', 420, 420, true);
		add_image_size('package-threecol-sidebar', 420, 420, true);
		add_image_size('package-fourcol', 420, 420, true);
		add_image_size('package-fourcol-sidebar', 420, 420, true);

		//Misc Image Sizes
		add_image_size('best-place', 572, 391, true);
		add_image_size('travel-dest', 420, 287, true);
		add_image_size('tour-package', 420, 420, true);

		add_image_size("my-post-thumb", 100, 80, true);

		add_image_size('room-thumb', 140, 100, true);
	}
	// Hook into the 'after_setup_theme' action
	add_action('after_setup_theme', 'dt_theme_features');
}

if (!function_exists('dt_theme_navigation_menus')) {

	// Register Navigation Menus
	function dt_theme_navigation_menus() {
		$locations = array(
			'primary-menu' => __('Primary Menu', 'iamd_text_domain'),
			'secondary-menu' => __('Secondary Menu', 'iamd_text_domain')
		);
		register_nav_menus($locations);
	}

	// Hook into the 'init' action
	add_action('init', 'dt_theme_navigation_menus');
}