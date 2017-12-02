<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
  function chld_thm_cfg_parent_css() {
    wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
  }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION

// BEGIN SECURITY
global $sitepress;
function remove_meta_generator() {
  return '';
}
add_filter('the_generator', 'remove_meta_generator');
add_filter('revslider_meta_generator', 'remove_meta_generator');
remove_action('wp_head', array($sitepress,'meta_generator_tag'));
add_filter('ls_meta_generator', 'remove_meta_generator');

function remove_vc_meta_generator() {
  remove_action('wp_head', array(visual_composer(), 'addMetaData'));
}
add_action('init', 'remove_vc_meta_generator', 100);

remove_action('wp_head', 'feed_links');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');
remove_action('wp_head', 'wp_generator');

function disable_wp_emojicons(){
  // all actions related to emojis
  remove_action('wp_head','print_emoji_detection_script',9999);
  remove_action('wp_print_styles','print_emoji_styles',9999);
  remove_filter('wp_mail','wp_staticize_emoji_for_email');
  remove_filter('the_content_feed','wp_staticize_emoji');
  remove_filter('comment_text_rss','wp_staticize_emoji');
  remove_action('admin_print_styles','print_emoji_styles',9999);
  remove_action('admin_print_scripts','print_emoji_detection_script',9999);

  // filter to remove TinyMCE emojis
  add_filter('tiny_mce_plugins','disable_emojicons_tinymce');
}
add_action('init','disable_wp_emojicons');
//
// function wp_disable_feed() {
//   wp_die( __('No feed available, please visit our <a href="'. get_bloginfo('url') .'">homepage</a>!') );
// }
//
// add_action('do_feed', 'wp_disable_feed', 1);
// add_action('do_feed_rdf', 'wp_disable_feed', 1);
// add_action('do_feed_rss', 'wp_disable_feed', 1);
// add_action('do_feed_rss2', 'wp_disable_feed', 1);
// add_action('do_feed_atom', 'wp_disable_feed', 1);
// add_action('do_feed_rss2_comments', 'wp_disable_feed', 1);
// add_action('do_feed_atom_comments', 'wp_disable_feed', 1);

function filter_media_comment_status( $open, $post_id ) {
  $post = get_post( $post_id );
  if( $post->post_type == 'attachment' ) {
    return false;
  }
  return $open;
}
add_filter('comments_open', 'filter_media_comment_status', 10 , 2 );
// END SECURITY



// BEGIN Remove query string from static files
function remove_cssjs_ver( $src ) {
  if( strpos( $src, '?ver=' ) )
  $src = remove_query_arg( 'ver', $src );
  return $src;
}
add_filter('style_loader_src', 'remove_cssjs_ver', 10, 2);
add_filter('script_loader_src', 'remove_cssjs_ver', 10, 2);
// END Remove query string from static files



// BEGIN Body class based on language
add_filter('body_class', 'append_language_class');
function append_language_class($classes){
  $classes[] = 'lang-'.ICL_LANGUAGE_CODE;  //or however you want to name your class based on the language code
  //$classes='lang-'.$classes;
  return $classes;
}
// END Body class based on language



// START custom script
function custom_script() {
  //wp_register_script('custom_script', plugins_url('script-custom.js'));
  wp_register_script('custom_script', get_stylesheet_directory_uri() .'/script-custom.js',NULL,NULL,true);
  wp_register_script('mobimenufix', get_stylesheet_directory_uri() .'/script-mobimenufix.js',NULL,NULL,true);
  wp_enqueue_script('custom_script');
  wp_enqueue_script('mobimenufix');

  if (is_home() || is_front_page()) {
    wp_register_script('agoda_script', '//banner.agoda.com/js/show_ads.js',NULL,NULL,true);
    wp_enqueue_script('agoda_script');
  }
}
add_action('wp_enqueue_scripts', 'custom_script');
// END custom script



// START custom style
function custom_style(){
	// Example of loading a jQuery slideshow plugin just on the homepage
//	wp_register_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css' );

	// Load all of the styles that need to appear on all pages
//	wp_enqueue_style( 'main', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style('custom', get_stylesheet_directory_uri() . '/style-custom.css');

    if ( is_home() || is_front_page()) {
    	wp_enqueue_style('custom-index', get_stylesheet_directory_uri() . '/style-index.css');
    }
      if ( !(is_home() || is_front_page())) {
      	wp_enqueue_style('custom-index', get_stylesheet_directory_uri() . '/style-inner.css');
      }

}
add_action('wp_enqueue_scripts', 'custom_style',9999);
// END custom style



// START custom admin style
  function custom_admin_style() {
    wp_enqueue_style('custom-admin', get_stylesheet_directory_uri().'/style-admin.css');
  }
  add_action('admin_enqueue_scripts', 'custom_admin_style');
// END custom admin style



// START custom post length
function custom_excerpt_length( $limit ) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }
  $content = preg_replace('/[.+]/','', $content);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
// END custom post length



function my_acf_google_map_api( $api ){
	$api['key'] = 'AIzaSyAmOb-FF8nFDQtZmZVSsZzq8sGpWXnd7jU';
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');



add_theme_support( 'heading-img' );
add_image_size( 'heading-img', 1815, 353, true  );



add_editor_style( 'http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );



//create two taxonomies, genres and tags for the post type "tag"
function create_tag_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Hotspot Tags', 'taxonomy general name' ),
    'singular_name' => _x( 'Hotspot Tag', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Hotspot Tags' ),
    'popular_items' => __( 'Popular Hotspot Tags' ),
    'all_items' => __( 'All Hotspot Tags' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Hotspot Tag' ),
    'update_item' => __( 'Update Hotspot Tag' ),
    'add_new_item' => __( 'Add New Hotspot Tag' ),
    'new_item_name' => __( 'New Tag Name' ),
    'separate_items_with_commas' => __( 'Separate Hotspot tags with commas' ),
    'add_or_remove_items' => __( 'Add or remove Hotspot tags' ),
    'choose_from_most_used' => __( 'Choose from the most used Hotspot tags' ),
    'menu_name' => __( 'Hotspot Tags' ),
  );

  register_taxonomy('hotspot_tag','dt_galleries',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'hotspot_tag' ),
  ));
}
add_action( 'init', 'create_tag_taxonomies', 0 );



function dt_packages_list( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'limit'  => '-1',
		'carousel' => 'false',
		'categories' => '',
		'post_column' => 'one-fourth-column',	// one-half-column, one-third-column, one-fourth-column
	), $atts));

	$post_column = !empty($post_column) ? $post_column : 'one-fourth-column';
	$feature_image = "package-fourcol";

	if($post_column == "one-half-column") {
		$div_class = "column dt-sc-one-half";
		$feature_image = "package-twocol";
		$column = 2;
	}
	elseif($post_column == "one-third-column") {
		$div_class = "column dt-sc-one-third";
		$feature_image = "package-threecol";
		$column = 3;
	}
	elseif($post_column == "one-fourth-column") {
		$div_class = "column dt-sc-one-fourth";
		$feature_image = "package-fourcol";
		$column = 4;
	}

	if(empty($categories)) {
		// START change query post type from product to gallery BEN 161230
  $cats = get_categories('taxonomy=product_cat&hide_empty=1');
		$cats = get_terms( array('product_cat'), array('fields' => 'ids'));
	// $cats = get_categories('taxonomy=gallery_entries&hide_empty=1');
	// $cats = get_terms( array('gallery_entries'), array('fields' => 'ids'));
  // END change query post type from product to gallery BEN 161230
	} else {
		$cats = explode(',', $categories);
	}

	$out = "";

// START change query post type from product to gallery BEN 161230
	//$args = array('post_type' => 'product', 'posts_per_page' => $limit, 'tax_query' => array( array( 'taxonomy' => 'product_cat', 'field' => 'id', 'terms' => $cats )));
	$args = array('post_type' => 'dt_galleries', 'posts_per_page' => $limit, 'tax_query' => array( array( 'taxonomy' => 'hotspot_tag', 'field' => 'name', 'terms' => 'HotSpot' )));
// $args = array('post_type' => 'dt_galleries', 'posts_per_page' => $limit, 'tax_query' => array( array( 'taxonomy' => 'gallery_entries', 'field' => 'id', 'terms' => $cats )));
// END change query post type from product to gallery BEN 161230

	$the_query = new WP_Query($args);

	if($the_query->have_posts()): $i = 1;
		if($carousel == 'true')
			$out .= '<div class="package-wrapper dt_carousel" data-items="'.$column.'">';
		else
			$out .= '<div class="package-wrapper">';

		  while($the_query->have_posts()): $the_query->the_post();
			$tclass = "";
			if($i == 1 && $carousel != 'true') $tclass = $div_class." first"; else $tclass = $div_class;
			if($i == $column) $i = 1; else $i = $i + 1;

			$out .= '<div id="'.get_the_ID().'" class="'.$tclass.'">';
				$out .= '<div class="package-item">';
					if(has_post_thumbnail()):
						$out .= '<div class="package-thumb">';
							$out .= '<a href="'.get_permalink(get_the_ID()).'" title="'.get_the_title().'">';
								$attr = array('title' => get_the_title()); $out .= get_the_post_thumbnail(get_the_ID(), $feature_image, $attr);
								$out .= '<div class="image-overlay">';
									$out .= '<span class="image-overlay-inside"></span>';
								$out .= '</div>';
							$out .= '</a>';
						$out .= '</div>';
					endif;
					$out .= '<div class="package-details">';
						$out .= '<h5><a href="'.get_permalink().'">'.get_the_title().'</a></h5>';
						// $city = get_post_meta(get_the_ID(), '_package_place', true);
						// if(!empty($city))
						// 	$out .= '<p>'.$city.'</p>';
            $out .= '<p>'.get_field('general_summary').' </p>';
						$out .= '<div class="package-content">';
			// START: BEN
			// $out .= '<ul class="package-meta">';
							// 	$days = get_post_meta(get_the_ID(), '_package_days_duration', true);
							// 	if(!empty($days))
							// 		$out .= '<li> <span class="fa fa-calendar"></span>'.__('No of Days:', 'iamd_text_domain').' '.$days.' </li>';
							// 	$people = get_post_meta(get_the_ID(), '_package_people', true);
							// 	if(!empty($people))
							// 		$out .= '<li> <span class="fa fa-user"></span>'.__('People:', 'iamd_text_domain').' '.$people.' </li>';
							// $out .= '</ul>';
							// $sprice = get_post_meta(get_the_ID(), '_sale_price', true);
			// if(!empty($sprice))
							// 	$out .= '<span class="package-price">'.get_woocommerce_currency_symbol().$sprice.'</span>';
			// END: BEN
							$out .= '<a href="'.get_permalink().'" class="dt-sc-button too-small">'.__('View details', 'iamd_text_domain').'</a>';
						$out .= '</div>';
					$out .= '</div>';
			   $out .= '</div>';
			$out .= '</div>';
		  endwhile;
		$out .= '</div>';
		wp_reset_query($the_query);
	endif;

	if($carousel == 'true') {
		return '<div class="carousel_items">'
					.$out
					.'<div class="carousel-arrows">
						<a class="prev-arrow" href="#"><span class="fa fa-angle-left"> </span></a>
						<a class="next-arrow" href="#"><span class="fa fa-angle-right"> </span></a>
					  </div>
				</div>';
	} else {
		return $out;
	}
}
add_shortcode('dt_packages_list', 'dt_packages_list');
add_shortcode('dt_sc_packages_list', 'dt_packages_list');



/* START: BEN 1701112 */
/*
function add_taxonomies_to_pages() {
 register_taxonomy_for_object_type( 'post_tag', 'page' );
 register_taxonomy_for_object_type( 'category', 'page' );
 }
add_action( 'init', 'add_taxonomies_to_pages' );
 if ( ! is_admin() ) {
 add_action( 'pre_get_posts', 'category_and_tag_archives' );

 }
function category_and_tag_archives( $wp_query ) {
$my_post_array = array('post','page');

 if ( $wp_query->get( 'category_name' ) || $wp_query->get( 'cat' ) )
 $wp_query->set( 'post_type', $my_post_array );

 if ( $wp_query->get( 'tag' ) )
 $wp_query->set( 'post_type', $my_post_array );
}
*/

function create_page_tag_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Page Tags', 'taxonomy general name' ),
    'singular_name' => _x( 'Page Tag', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Page Tags' ),
    'popular_items' => __( 'Popular Page Tags' ),
    'all_items' => __( 'All Page Tags' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Page Tag' ),
    'update_item' => __( 'Update Page Tag' ),
    'add_new_item' => __( 'Add New Page Tag' ),
    'new_item_name' => __( 'New Tag Name' ),
    'separate_items_with_commas' => __( 'Separate Page tags with commas' ),
    'add_or_remove_items' => __( 'Add or remove Page tags' ),
    'choose_from_most_used' => __( 'Choose from the most used Page tags' ),
    'menu_name' => __( 'Page Tags' ),
  );

  register_taxonomy('page_tag','page',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'page_tag' ),
  ));
}
add_action( 'init', 'create_page_tag_taxonomies' );



function create_page_category_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like categorys)
  $labels = array(
    'name' => _x( 'Page Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Page Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Page Categories' ),
    'popular_items' => __( 'Popular Page Categories' ),
    'all_items' => __( 'All Page Categories' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Page Category' ),
    'update_item' => __( 'Update Page Category' ),
    'add_new_item' => __( 'Add New Page Category' ),
    'new_item_name' => __( 'New Category Name' ),
    'separate_items_with_commas' => __( 'Separate Page categorys with commas' ),
    'add_or_remove_items' => __( 'Add or remove Page categorys' ),
    'choose_from_most_used' => __( 'Choose from the most used Page categorys' ),
    'menu_name' => __( 'Page Categories' ),
  );

  register_taxonomy('page_category','page',array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'page_category' ),
  ));
}
add_action( 'init', 'create_page_category_taxonomies' );
/* END: BEN 1701112 */



/* START: BEN 170113 */
function dt_gallery_items( $atts, $content = null ) {
  extract(shortcode_atts(array(
    'limit' => -1,
    'categories' => '',
    'posts_column' => 'one-half-column', // one-third-column, one-fourth-column
    'filter' => ''
  ), $atts));

  global $post;
  $meta_set = get_post_meta(get_queried_object_id(), '_tpl_default_settings', true);
  $page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : 'content-full-width';
  $post_layout = $posts_column;

  $li_class = "";
  $feature_image = "";
  $out = "";

  //POST LAYOUT CHECK...
  switch($post_layout) {
    case "one-half-column":
      $li_class = "portfolio dt-sc-one-half column"; $feature_image = "gallery-twocol"; break;

    case "one-third-column":
      $li_class = "portfolio dt-sc-one-third column"; $feature_image = "gallery-threecol"; break;

    case "one-fourth-column":
      $li_class = "portfolio dt-sc-one-fourth column"; $feature_image = "gallery-fourcol"; break;
  }
  //BETTER IMAGE SIZE...
  switch($page_layout) {
    case "with-left-sidebar":
      $li_class = $li_class." with-sidebar";
      $feature_image = $feature_image."-sidebar";
      break;

    case "with-right-sidebar":
      $li_class = $li_class." with-sidebar";
      $feature_image = $feature_image."-sidebar";
      break;

    case "with-both-sidebar":
      $li_class = $li_class." with-sidebar";
      $feature_image = $feature_image."-bothsidebar";
      break;
  }

  if(basename(get_page_template()) == 'tpl-fullwidth.php') $feature_image = "full";
  //$out .= '<!-- debug: $categories: '.var_dump($categories).'-->';

  if(empty($categories)) {
    // $cats = get_categories('taxonomy=gallery_entries&hide_empty=1');
    // $cats = get_terms( array('gallery_entries'), array('fields' => 'ids'));
    $cats = get_categories('taxonomy=page_category&hide_empty=1');
    $cats = get_terms( array('page_category'), array('fields' => 'ids'));
  } else {
    $cats = explode(',', $categories);
  }

    if(ICL_LANGUAGE_CODE=='zh-hant'){
      $cats=array(102,105,106,103);
    }elseif(ICL_LANGUAGE_CODE=='zh-hans'){
      $cats=array(123,187,239,191);
    }elseif(ICL_LANGUAGE_CODE=='en'){
      $cats=array(149,188,240,192);
    }elseif(ICL_LANGUAGE_CODE=='ja'){
      $cats=array(150,189,241,193);
    }elseif(ICL_LANGUAGE_CODE=='ko'){
      $cats=array(151,190,242,194);
    }

  //PERFORMING QUERY...
  if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
  elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
  else { $paged = 1; }

  //PERFORMING QUERY...

//ben 170112

// $args = array('post_type' => 'dt_galleries', 'paged' => $paged , 'posts_per_page' => $limit,
//                                          'tax_query' => array(
//                                           array(
//                                               'taxonomy' => 'gallery_entries',
//                                               'field' => 'id',
//                                               'terms' => $cats
//                                           )));

  $args = array(
    'post_type' => 'page',
    'paged' => $paged ,
    // 'posts_per_page' => $limit,
    'tax_query' => array(
      array(
        'taxonomy' => 'page_category',
        'field' => 'id',
        'terms' => $cats
      )
    )
  );



//$out .= '<!-- debug: $cats: '.var_dump($cats).'-->';

  $the_query = new WP_Query($args);
  if($the_query->have_posts()):

   if($filter != "false"):
     $out .= '<div class="dt-sc-sorting-container">';
     //$out .= '<a data-filter="*" href="#" class="first active-sort">'.__("All", "iamd_text_domain").'</a>';
     $i=0;
     $myterm='';
     foreach($cats as $term) {
       // $myterm = get_term_by('id', $term, 'gallery_entries');
       //$out.='<!--debug ben: '.var_dump($term).'-->';
       $myterm = get_term_by('id', $term, 'page_category');
       //$out .= '<a href="#" data-filter=".'.strtolower($myterm->slug).'">'.$myterm->name.'</a>';
       if($i==0){
         // START BEN 170214
         $out .= '<a href="#" class="isotope-item active-sort first isotope-'.$i.'id'.strtolower($myterm->term_taxonomy_id).' isotope-i-'.$i.' isotope-id-'.strtolower($myterm->term_taxonomy_id).'" data-filter=".page_category-'.strtolower($myterm->term_taxonomy_id).'">'.$myterm->name.'</a>';// leon added categroy id to class
         // END BEN 170214
       }else{
         $out .= '<a href="#" class="isotope-item isotope-'.$i.'id'.strtolower($myterm->term_taxonomy_id).' isotope-i-'.$i.' isotope-id-'.strtolower($myterm->term_taxonomy_id).'" data-filter=".page_category-'.strtolower($myterm->term_taxonomy_id).'">'.$myterm->name.'</a>';// leon added categroy id to class
       }
       $i++;
     }
     $out .= '</div>';

   endif;

   $out .= '<div class="dt-sc-portfolio-container">';


  //  $page_id = get_the_ID();
  //  $li_class = $li_class." hotspot-id-".get_the_ID();


    while($the_query->have_posts()): $the_query->the_post();
      // $terms = wp_get_post_terms(get_the_ID(), 'gallery_entries', array("fields" => "slugs"));
      //  $terms = wp_get_post_terms(get_the_ID(), 'page_category', array("fields" => "term_taxonomy_id"));
      $terms = wp_get_post_terms(get_the_ID(), 'page_category', array("fields" => "ids"));


      // $pageid = wp_get_post_terms(get_the_ID(), 'page', array("fields" => "ids"));
      // $li_class = $li_class." hotspot-id-".strtolower(implode(" hotspot-id-", $pageid));

      array_walk($terms, "arr_strfun");
      //array_walk($terms2, "arr_strfun");

      $out .= '<div class="'.$li_class.' hotspot-id-'.get_the_ID() . ' page_category-'.strtolower(implode(" page_category-", $terms)).' no-space">';
        $out .= '<figure>';
        // START: ben 170111
        $fullimg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large', false);
        // $fullimg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
        // END ben 170111
        $currenturl = $fullimg[0];
        $currenticon = "fa-plus";
        $pmeta_set = get_post_meta($post->ID, '_gallery_settings', true);
        if( @array_key_exists('items_thumbnail', $pmeta_set) && ($pmeta_set ['items_name'] [0] == 'video' )) {
          $currenturl = $pmeta_set ['items'] [0];
          $currenticon = "fa-video-camera";
        }
        //GALLERY IMAGES...
        if(has_post_thumbnail()):
          $attr = array('title' => get_the_title(), 'alt' => get_the_title());
          //$out .= get_the_post_thumbnail($post->ID, '$feature_image', $attr);
          $out .= get_the_post_thumbnail($post->ID, 'full', $attr);
        else:
          $out .= '<img src="http'.dt_theme_ssl().'://placehold.it/1170X878.jpg&text='.get_the_title().'" alt="'.get_the_title().'" title="'.get_the_title().'" />';
        endif;
        $out .= '<figcaption>';
          $out .= '<div class="fig-content-wrapper">';
          $out .= '<div class="fig-content">';
            $out .= '<h5><a href="'.get_permalink().'">'.get_the_title().'</a></h5>';
            $out .= '<p>'.get_the_term_list($post->ID, 'gallery_entries', ' ', ', ', ' ').'</p>';
            $out .= '<div class="fig-overlay">';
              //$out .= '<a class="zoom" title="'.get_the_title().'" data-gal="prettyPhoto[gallery]" href="'.$currenturl.'"><span class="fa '.$currenticon.'"> </span></a>';
              $out .= '<a class="link" href="'.get_permalink().'"> <span class="fa fa-link"> </span> </a>';
              if(dt_theme_is_plugin_active('roses-like-this/likethis.php')):
                $out .= generateLikeString($post->ID, '');
              endif;
            $out .= '</div>';
          $out .= '</div>';
          $out .= '</div>';
        $out .= '</figcaption>';
        $out .= '</figure>';
      $out .= '</div>';
    endwhile;
   $out .= '</div>';
   wp_reset_query($the_query);

   else:
    $out .= '<h2>'.__("Nothing Found.", "iamd_text_domain").'</h2>';
    $out .= '<p>'.__("Apologies, but no results were found for the requested archive.", "iamd_text_domain").'</p>';
  endif;

  return $out;
}
add_shortcode('dt_gallery_items', 'dt_gallery_items');
add_shortcode('dt_sc_gallery_items', 'dt_gallery_items');
/* END: BEN 170113 */

/* START: BEN 170206 */
// disable rest api
add_filter('rest_enabled', '__return_false'); add_filter('rest_jsonp_enabled', '__return_false');
// remove wp-json link
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
// remove wp-embed.js
add_action( 'init', function() {

    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');

    // Turn off oEmbed auto discovery.
    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
}, PHP_INT_MAX - 1 );
/* END: BEN 170206 */


// START custom script
function custom_chat() {
  //wp_register_script('custom_script', plugins_url('script-custom.js'));
  // Firebase JS



  //ben 170411 start
  $client_details = json_decode(file_get_contents("http://ipinfo.io/json"));
  $gmap_api_key='AIzaSyCfD4lD8fjxKHzfKABTJKPkuv-NNmV1mZI';
  $gmap_lang=ICL_LANGUAGE_CODE;
  $firebasejs_ver='3.7.4';
  if($gmap_lang=='en'){
    $gmap_lang='en';
  }
  if($client_details->country=='CN'){
    wp_register_script(
      'firebase',
      'https://www.gstatic.cn/firebasejs/'.$firebasejs_ver.'/firebase.js',
      null, SLC_FIREBASE_VERSION, true
    );
    wp_enqueue_script( 'firebase' );

    // Firebase App JS
    wp_register_script(
      'firebase-app',
      'https://www.gstatic.cn/firebasejs/'.$firebasejs_ver.'/firebase-app.js',
      null, SLC_FIREBASE_VERSION, true
    );
    wp_enqueue_script( 'firebase-app' );

    // Firebase Auth JS
    wp_register_script(
      'firebase-auth',
      'https://www.gstatic.cn/firebasejs/'.$firebasejs_ver.'/firebase-auth.js',
      null, SLC_FIREBASE_VERSION, true
    );
    wp_enqueue_script( 'firebase-auth' );

    // Firebase DB JS
    wp_register_script(
      'firebase-db',
      'https://www.gstatic.cn/firebasejs/'.$firebasejs_ver.'/firebase-database.js',
      null, SLC_FIREBASE_VERSION, true
    );
    wp_enqueue_script( 'firebase-db' );
  }else{
      wp_register_script(
        'firebase',
        'https://www.gstatic.com/firebasejs/'.$firebasejs_ver.'/firebase.js',
        null, SLC_FIREBASE_VERSION, true
      );
      wp_enqueue_script( 'firebase' );

      // Firebase App JS
      wp_register_script(
        'firebase-app',
        'https://www.gstatic.com/firebasejs/'.$firebasejs_ver.'/firebase-app.js',
        null, SLC_FIREBASE_VERSION, true
      );
      wp_enqueue_script( 'firebase-app' );

      // Firebase Auth JS
      wp_register_script(
        'firebase-auth',
        'https://www.gstatic.com/firebasejs/'.$firebasejs_ver.'/firebase-auth.js',
        null, SLC_FIREBASE_VERSION, true
      );
      wp_enqueue_script( 'firebase-auth' );

      // Firebase DB JS
      wp_register_script(
        'firebase-db',
        'https://www.gstatic.com/firebasejs/'.$firebasejs_ver.'/firebase-database.js',
        null, SLC_FIREBASE_VERSION, true
      );
      wp_enqueue_script( 'firebase-db' );
  }
  //ben 170411 eof

}
add_action('wp_enqueue_scripts', 'custom_chat');



// add a priority if you need it
// add_action('wp_enqueue_scripts','dequeue_my_css',100);

function _remove_script_version( $src ){
$parts = explode( '?ver', $src );
return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );

// END custom script







// START custom script
//function custom_news_ticker() {
  //wp_register_script('custom_news_ticker_script', get_stylesheet_directory_uri() .'/script/jquery.webticker.min.js',NULL,NULL,true);
  //wp_enqueue_script('custom_news_ticker_script');

    // wp_register_script('custom_news_ticker_custom', get_stylesheet_directory_uri() .'/script/jquery-news-ticker/includes/custom.js',NULL,NULL,true);
    // wp_enqueue_script('custom_news_ticker_custom');
  //
  // wp_register_script('custom_news_ticker_style', get_stylesheet_directory_uri() . '/script/jquery-news-ticker/styles/ticker-style.css');
  // wp_enqueue_style('custom_news_ticker_style');

//}
//add_action('wp_enqueue_scripts', 'custom_news_ticker');
// END custom script


function dequeue_theme_css() {
  wp_dequeue_style('style.colorbox');
  wp_deregister_style('style.colorbox');

  wp_dequeue_style('style.fancybox');
  wp_deregister_style('style.fancybox');

  wp_dequeue_style('prettyphoto');
  wp_deregister_style('prettyphoto');
}
add_action('wp_enqueue_scripts','dequeue_theme_css',100);



function dequeue_theme_goofont_css() {
  wp_dequeue_style('mytheme-google-fonts');
  wp_deregister_style('mytheme-google-fonts');

}
add_action('wp_head','dequeue_theme_goofont_css',20);

remove_filter( 'wpseo_robots', '',99 );

function staging_noindex() {
    // $output_no_index = php_sapi_name() != 'cli'
    //         // the following below [w\.] is to skip any www\. stuff
    //         && ( ! empty( $_SERVER['SERVER_NAME'] )
    //           && (preg_match( '#(staging|test|development|dev|sandbox|new|example|sample|testing|clients)\d*\.#si', $_SERVER['SERVER_NAME'] )
    //             ||$_SERVER["HTTP_HOST"]==='ec2-52-76-231-110.ap-southeast-1.compute.amazonaws.com')
    //          );

    //if ( $output_no_index ) {
    if(strpos($_SERVER['HTTP_HOST'],'compute.amazonaws.com')!==false){
      echo '<meta name="robots" content="noindex,nofollow"/>';
    }
  //  }
}
add_action( 'wp_head', 'staging_noindex', 0 );
