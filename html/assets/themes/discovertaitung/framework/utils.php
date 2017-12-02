<?php
/** dt_theme_public_title()
 * Objective:
 *		Outputs the value for <title></title> in front end.
 *
 **/
function dt_theme_public_title() {

	$status = dt_theme_is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php') || dt_theme_is_plugin_active('wordpress-seo/wp-seo.php');

	if (!$status) :
		#CODE STARTS
		global $post;
		$doctitle = '';
		$separator = dt_theme_option ( 'seo', 'title-delimiter' );
		$split = true;

		if (! empty ( $post )) :
			$author_meta = get_the_author_meta ( $post->post_author );
			$nickname = get_the_author_meta ( 'nickname', $post->post_author );
			$first_name = get_the_author_meta ( 'first_name', $post->post_author );
			$last_name = get_the_author_meta ( 'last_name', $post->post_author );
			$display_name = get_the_author_meta ( 'display_name', $post->post_author );
		endif;

		$args = array (
				"blog_title" => preg_replace ( "~(?:\[/?)[^/\]]+/?\]~s", '', get_option ( 'blogname' ) ),
				"blog_description" => get_bloginfo ( 'description' ),
				"post_title" => ! empty ( $post ) ? $post->post_title : NULL,
				"post_author_nicename" => ! empty ( $nickname ) ? ucwords ( $nickname ) : NULL,
				"post_author_firstname" => ! empty ( $first_name ) ? ucwords ( $first_name ) : NULL,
				"post_author_lastname" => ! empty ( $last_name ) ? ucwords ( $last_name ) : NULL,
				"post_author_dsiplay" => ! empty ( $display_name ) ? ucwords ( $display_name ) : NULL
		);
		$args = array_filter ( $args );
		// is_home
		if (is_home () || is_front_page ()) :
			$doctitle = "";
			if ((get_option ( 'page_on_front' ) != 0) && (get_option ( 'page_on_front' ) == $post->ID))
				$doctitle = trim ( get_post_meta ( $post->ID, '_seo_title', true ) );
			$doctitle = ! empty ( $doctitle ) ? trim ( $doctitle ) : $args ["blog_title"] . ' ' . $separator . ' ' . $args ["blog_description"];
			$split = false;

		// is_page
		elseif (is_page ()) :
			$doctitle = get_post_meta ( $post->ID, '_seo_title', true );
			if (empty ( $doctitle )) :
				$options = is_array ( dt_theme_option ( 'seo', 'page-title-format' ) ) ? dt_theme_option ( 'seo', 'page-title-format' ) : array ();
				foreach ( $options as $option ) :
					if (array_key_exists ( $option, $args ))
						$doctitle .= $args [$option] . ' ' . $separator . ' ';
				endforeach;

			endif;
		// is_post
		elseif (is_single ()) :
			$doctitle = get_post_meta ( $post->ID, '_seo_title', true );
			if (empty ( $doctitle )) :
				// o add categories in $args
				$categories = get_the_category ();
				$c = '';
				foreach ( $categories as $category ) :
					$c .= $category->name . ' ' . $separator . ' ';
				endforeach;

				$c = substr ( trim ( $c ), "0", strlen ( trim ( $c ) ) - 1 );
				$args ["category_title"] = $c;
				// nd of adding categories in $args

				// o add tags in $args
				$posttags = get_the_tags ();
				$ptags = '';
				if ($posttags) :
					foreach ( $posttags as $posttag ) :
						$ptags .= $posttag->name . $separator;
					endforeach;

					$ptags = substr ( trim ( $ptags ), "0", strlen ( trim ( $ptags ) ) - 1 );
					$args ["tag_title"] = $ptags;

				endif;
				// nd of adding tags in $args
				$options = is_array ( dt_theme_option ( 'seo', 'post-title-format' ) ) ? dt_theme_option ( 'seo', 'post-title-format' ) : array ();
				foreach ( $options as $option ) :
					if (array_key_exists ( $option, $args )) :
						$doctitle .= $args [$option] . ' ' . $separator . ' ';

					endif;
				endforeach;

			endif;
		// is_category()
		elseif (is_category ()) :
			$categories = get_the_category ();
			// o add category description into $args
			$args ["category_title"] = $categories [0]->name;
			$args ["category_desc"] = $categories [0]->description;
			// nd of adding category description into $args

			$options = is_array ( dt_theme_option ( 'seo', 'category-page-title-format' ) ) ? dt_theme_option ( 'seo', 'category-page-title-format' ) : array ();
			foreach ( $options as $option ) :
				if (array_key_exists ( $option, $args ))
					$doctitle .= $args [$option] . ' ' . $separator . ' ';
			endforeach;

		// is_tag()
		elseif (is_tag ()) :
			$args ["tag"] = wp_title ( "", false );
			$options = is_array ( dt_theme_option ( 'seo', 'tag-page-title-format' ) ) ? dt_theme_option ( 'seo', 'tag-page-title-format' ) : array ();
			foreach ( $options as $option ) :
				if (array_key_exists ( $option, $args ))
					$doctitle .= $args [$option] . ' ' . $separator . ' ';
			endforeach;

		// is_archive()
		elseif (is_archive ()) :
			$args ["date"] = wp_title ( "", false );
			$options = is_array ( dt_theme_option ( 'seo', 'archive-page-title-format' ) ) ? dt_theme_option ( 'seo', 'archive-page-title-format' ) : array ();
			foreach ( $options as $option ) :
				if (array_key_exists ( $option, $args ))
					$doctitle .= $args [$option] . ' ' . $separator . ' ';
			endforeach;

		// is_date()
		elseif (is_date ()) :

		// is_search()
		elseif (is_search ()) :
			$args ["search"] = __ ( "Search results for", 'iamd_text_domain' ) . ' "' . $_REQUEST ['s'] . '"'; // dding search text into the default args
			$options = is_array ( dt_theme_option ( 'seo', 'search-page-title-format' ) ) ? dt_theme_option ( 'seo', 'search-page-title-format' ) : array ();
			foreach ( $options as $option ) :
				if (array_key_exists ( $option, $args ))
					$doctitle .= $args [$option] . ' ' . $separator . ' ';
			endforeach;

		// is_404()
		elseif (is_404 ()) :
			$options = is_array ( dt_theme_option ( 'seo', '404-page-title-format' ) ) ? dt_theme_option ( 'seo', '404-page-title-format' ) : array ();
			foreach ( $options as $option ) :
				if (array_key_exists ( $option, $args ))
					$doctitle .= $args [$option] . ' ' . $separator . ' ';
			endforeach;
			$doctitle = $doctitle . __ ( 'Page not found', 'iamd_text_domain' );
			$split = false;

		elseif( ('tribe_events'== get_post_type() || is_singular('tribe_events') || is_singular('tribe_venue') || is_singular('tribe_organizer') || in_array('tribe-filter-live', get_body_class())) and !is_search()):
			$doctitle = $args ["blog_title"] . ' ' . $separator . ' ' . __ ( 'Events', 'iamd_text_domain' );
			$split = false;
		endif;

		if ($split) :
			if (strrpos ( $doctitle, $separator )) :
				$doctitle = str_split ( $doctitle, strrpos ( $doctitle, $separator ) );
				$doctitle = $doctitle [0];
			endif;
		endif;

		if( !empty($doctitle) )
			echo $doctitle;
		else
			wp_title( '|', true, 'right' );
	else :
		wp_title("|", true);
	endif;
}

/**
 * dt_theme_canonical()
 * Objective:
 * Generate the Canonical url
 * This function called at register_public.php via dt_theme_seo_meta();
 */
function dt_theme_canonical() {
	$canonical = false;
	if (is_singular () || is_single ()) :
		$canonical = get_permalink ( get_queried_object () );

		// Fix paginated pages
		if (get_query_var ( 'paged' ) > 1) :
			global $wp_rewrite;
			if (! $wp_rewrite->using_permalinks ()) :
				$canonical = add_query_arg ( 'paged', get_query_var ( 'paged' ), $canonical );
			 else :
				$canonical = user_trailingslashit ( trailingslashit ( $canonical ) . 'page/' . get_query_var ( 'paged' ) );
			endif;

	endif;
	 else :
		if (is_front_page ()) :
			$canonical = home_url ( '/' );
		 elseif (is_home () && "page" == get_option ( 'show_on_front' )) :
			$canonical = get_permalink ( get_option ( 'page_for_posts' ) );
		 elseif (is_tax () || is_tag () || is_category ()) :
			$term = get_queried_object ();
			$canonical = get_term_link ( $term, $term->taxonomy );
		 elseif (function_exists ( 'get_post_type_archive_link' ) && is_post_type_archive ()) :
			$canonical = get_post_type_archive_link ( get_post_type () );
		 elseif (is_author ()) :
			$canonical = get_author_posts_url ( get_query_var ( 'author' ), get_query_var ( 'author_name' ) );
		 elseif (is_archive ()) :
			if (is_date ()) :
				if (is_day ()) :
					$canonical = get_day_link ( get_query_var ( 'year' ), get_query_var ( 'monthnum' ), get_query_var ( 'day' ) );
				 elseif (is_month ()) :
					$canonical = get_month_link ( get_query_var ( 'year' ), get_query_var ( 'monthnum' ) );
				 elseif (is_year ()) :
					$canonical = get_year_link ( get_query_var ( 'year' ) );
				endif;
			endif;
		endif;

		if ($canonical && get_query_var ( 'paged' ) > 1) :
			global $wp_rewrite;
			if (! $wp_rewrite->using_permalinks ())
				$canonical = add_query_arg ( 'paged', get_query_var ( 'paged' ), $canonical );
			else
				$canonical = user_trailingslashit ( trailingslashit ( $canonical ) . trailingslashit ( $wp_rewrite->pagination_base ) . get_query_var ( 'paged' ) );


		endif;
	endif;
	return $canonical;
}
// # --- **** dt_theme_canonical() *** --- ###

/**
 * show_fblike()
 * Objective:
 * Outputs the facebook like button in post and page.
 */
function show_fblike($arg = 'post') {
	$fb = dt_theme_option ( 'integration', "{$arg}-fb_like" );
	$output = "";
	if (! empty ( $fb )) :
		$layout = dt_theme_option ( 'integration', "{$arg}-fb_like-layout" );
		$scheme = dt_theme_option ( 'integration', "{$arg}-fb_like-color-scheme" );
		$output .= do_shortcode ( "[fblike layout='{$layout}' colorscheme='{$scheme}' /]" );
		echo $output;
	endif;
}
// # --- **** show_googleplus() *** --- ###
/**
 * show_googleplus()
 * Objective:
 * Outputs the facebook like button in post and page.
 */
function show_googleplus($arg = 'post') {
	$googleplus = dt_theme_option ( 'integration', "{$arg}-googleplus" );
	$output = "";
	if (! empty ( $googleplus )) :
		$layout = dt_theme_option ( 'integration', "{$arg}-googleplus-layout" );
		$lang = dt_theme_option ( 'integration', "{$arg}-googleplus-lang" );
		$output .= do_shortcode ( "[googleplusone size='{$layout}' lang='{$lang}' /]" );
		echo $output;
	endif;
}
// # --- **** show_googleplus() *** --- ###

// # --- **** show_twitter() *** --- ###
/**
 * show_twitter()
 * Objective:
 * Outputs the Twitter like button in post and page.
 */
function show_twitter($arg = 'post') {
	$twitter = dt_theme_option ( 'integration', "{$arg}-twitter" );
	$output = "";
	if (! empty ( $twitter )) :
		$layout = dt_theme_option ( 'integration', "{$arg}-twitter-layout" );
		$lang = dt_theme_option ( 'integration', "{$arg}-twitter-lang" );
		$username = dt_theme_option ( 'integration', "{$arg}-twitter-username" );
		$output .= do_shortcode ( "[twitter layout='{$layout}' lang='{$lang}' username='{$username}' /]" );
		echo $output;
	endif;
}
// # --- **** show_twitter() *** --- ###

// # --- **** show_stumbleupon() *** --- ###
/**
 * show_stumbleupon()
 * Objective:
 * Outputs the Stumbleupon like button in post and page.
 */
function show_stumbleupon($arg = 'post') {
	$stumbleupon = dt_theme_option ( 'integration', "{$arg}-stumbleupon" );
	$output = "";
	if (! empty ( $stumbleupon )) :
		$layout = dt_theme_option ( 'integration', "{$arg}-stumbleupon-layout" );
		$output .= do_shortcode ( "[stumbleupon layout='{$layout}' /]" );
		echo $output;
	endif;
}
// # --- **** show_stumbleupon() *** --- ###

// # --- **** show_linkedin() *** --- ###
/**
 * show_linkedin()
 * Objective:
 * Outputs the LinkedIn like button in post and page.
 */
function show_linkedin($arg = 'post') {
	$linkedin = dt_theme_option ( 'integration', "{$arg}-linkedin" );
	$output = "";
	if (! empty ( $linkedin )) :
		$layout = dt_theme_option ( 'integration', "{$arg}-linkedin-layout" );
		$output .= do_shortcode ( "[linkedin layout='{$layout}' /]" );
		echo $output;
	endif;
}
// # --- **** show_linkedin() *** --- ###

// # --- **** show_delicious() *** --- ###
/**
 * show_delicious()
 * Objective:
 * Outputs the Delicious like button in post and page.
 */
function show_delicious($arg = 'post') {
	$delicious = dt_theme_option ( 'integration', "{$arg}-delicious" );
	$output = "";
	if (! empty ( $delicious )) :
		$text = dt_theme_option ( 'integration', "{$arg}-delicious-text" );
		$output .= do_shortcode ( "[delicious text='{$text}' /]" );
		echo $output;
	endif;
}
// # --- **** show_delicious() *** --- ###

// # --- **** show_pintrest() *** --- ###
/**
 * show_pintrest()
 * Objective:
 * Outputs the Pintrest like button in post and page.
 */
function show_pintrest($arg = 'post') {
	$delicious = dt_theme_option ( 'integration', "{$arg}-pintrest" );
	$output = "";
	if (! empty ( $delicious )) :
		$layout = dt_theme_option ( 'integration', "{$arg}-pintrest-layout" );
		$output .= do_shortcode ( "[pintrest layout='{$layout}' prompt='true' /]" );
		echo $output;
	endif;
}
// # --- **** show_pintrest() *** --- ###

// # --- **** show_digg() *** --- ###
/**
 * show_digg()
 * Objective:
 * Outputs the Digg like button in post and page.
 */
function show_digg($arg = 'post') {
	$digg = dt_theme_option ( 'integration', "{$arg}-digg" );
	$output = "";
	if (! empty ( $digg )) :
		$layout = dt_theme_option ( 'integration', "{$arg}-digg-layout" );
		$output .= do_shortcode ( "[digg layout='{$layout}' /]" );
		echo $output;
	endif;
}
// # --- **** show_digg() *** --- ###

/**
 * dt_theme_footer_widgetarea()
 * Objective:
 * 1.
 * To Generate Footer Widget Areas
 * Args: $count = No of widget areas
 */
function dt_theme_footer_widgetarea($count) {
	$name = __ ( "Footer Column", 'iamd_text_domain' );
	if ($count <= 4) :
		for($i = 1; $i <= $count; $i ++) :
			register_sidebar ( array (
					'name' => $name . "-{$i}",
					'id' => "footer-sidebar-{$i}",
					'description' => __('Appears in the footer section of the site.', 'iamd_text_domain'),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => '</h3>'
			) );
		endfor
		;
	 elseif ($count == 5 || $count == 6) :
		$a = array (
				"1-4",
				"1-4",
				"1-2"
		);
		$a = ($count == 5) ? $a : array_reverse ( $a );
		foreach ( $a as $k => $v ) :
			register_sidebar ( array (
					'name' => $name . "-{$v}",
					'id' => "footer-sidebar-{$k}-{$v}",
					'description' => __('Appears in the footer section of the site.', 'iamd_text_domain'),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => '</h3>'
			) );
		endforeach
		;
	 elseif ($count == 7 || $count == 8) :
		$a = array (
				"1-4",
				"3-4"
		);
		$a = ($count == 7) ? $a : array_reverse ( $a );
		foreach ( $a as $k => $v ) :
			register_sidebar ( array (
					'name' => $name . "-{$v}",
					'id' => "footer-sidebar-{$k}-{$v}",
					'description' => __('Appears in the footer section of the site.', 'iamd_text_domain'),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => '</h3>'
			) );
		endforeach
		;
	 elseif ($count == 9 || $count == 10) :
		$a = array (
				"1-3",
				"2-3"
		);
		$a = ($count == 9) ? $a : array_reverse ( $a );
		foreach ( $a as $k => $v ) :
			register_sidebar ( array (
					'name' => $name . "-{$v}",
					'id' => "footer-sidebar-{$k}-{$v}",
					'description' => __('Appears in the footer section of the site.', 'iamd_text_domain'),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => '</h3>'
			) );
		endforeach
		;
	endif;
}
// # --- **** dt_theme_footer_widgetarea() *** --- ###

// # --- **** dt_theme_show_footer_widgetarea() *** --- ###
/**
 * dt_theme_show_footer_widgetarea()
 * Objective:
 * Outputs the Footer section widget area.
 */
function dt_theme_show_footer_widgetarea($count) {
	$classes = array (
			"1" => "dt-sc-one-column",
			"dt-sc-one-half",
			"dt-sc-one-third",
			"dt-sc-one-fourth",
			"1-2" => "dt-sc-one-half",
			"1-3" => "dt-sc-one-third",
			"1-4" => "dt-sc-one-fourth",
			"3-4" => "dt-sc-three-fourth",
			"2-3" => "dt-sc-two-third"
	);

	if ($count <= 4) :
		for($i = 1; $i <= $count; $i ++) :
			$class = $classes [$count];
			$first = ($i == 1) ? "first" : "";
			echo "<div class='column {$class} {$first}'>";
			if (function_exists ( 'dynamic_sidebar' ) && dynamic_sidebar ( "footer-sidebar-{$i}" )) : endif;
			echo "</div>";
		endfor;
	 elseif ($count == 5 || $count == 6) :
		$a = array (
				"1-4",
				"1-4",
				"1-2"
		);
		$a = ($count == 5) ? $a : array_reverse ( $a );
		foreach ( $a as $k => $v ) :
			$class = $classes [$v];
			$first = ($k == 0) ? "first" : "";
			echo "<div class='column {$class} {$first}'>";
			if (function_exists ( 'dynamic_sidebar' ) && dynamic_sidebar ( "footer-sidebar-{$k}-{$v}" )) : endif;
			echo "</div>";
		endforeach;


	elseif ($count == 7 || $count == 8) :
		$a = array (
				"1-4",
				"3-4"
		);

		$a = ($count == 7) ? $a : array_reverse ( $a );
		foreach ( $a as $k => $v ) :
			$class = $classes [$v];
			$first = ($k == 0) ? "first" : "";
			echo "<div class='column {$class} {$first}'>";
			if (function_exists ( 'dynamic_sidebar' ) && dynamic_sidebar ( "footer-sidebar-{$k}-{$v}" )) :endif;
			echo "</div>";
		endforeach;

	 elseif ($count == 9 || $count == 10) :
		$a = array (
				"1-3",
				"2-3"
		);
		$a = ($count == 9) ? $a : array_reverse ( $a );
		foreach ( $a as $k => $v ) :
			$class = $classes [$v];
			$first = ($k == 0) ? "first" : "";
			echo "<div class='column {$class} {$first}'>";
			if (function_exists ( 'dynamic_sidebar' ) && dynamic_sidebar ( "footer-sidebar-{$k}-{$v}" )) :endif;
			echo "</div>";
		endforeach;
	endif;
}
// # --- **** dt_theme_show_footer_widgetarea() *** --- ###

// # --- **** dt_theme_is_plugin_active() *** --- ###
/**
 * dt_theme_is_plugin_active()
 * Objective:
 * Check the plugin is activated
 */
function dt_theme_is_plugin_active($plugin) {
	if (is_multisite ()) :
		$plugins = array ();
		$c_plugins = is_array ( get_site_option ( 'active_sitewide_plugins' ) ) ? get_site_option ( 'active_sitewide_plugins' ) : array ();
		foreach ( array_keys ( $c_plugins ) as $c_plugin ) :
			$plugins [] = $c_plugin;
		endforeach;
		return in_array ( $plugin, $plugins );
	 else :
		return in_array ( $plugin, ( array ) get_option ( 'active_plugins', array () ) );
	endif;
}
// # --- **** dt_theme_is_plugin_active() *** --- ###

// # --- **** check_slider_revolution_responsive_wordpress_plugin() *** --- ###
/**
 * check_slider_revolution_responsive_wordpress_plugin()
 * Objective:
 * Check the "Revolution Responsive WordPress Plugin" is activated
 */
function check_slider_revolution_responsive_wordpress_plugin() {
	$sliders = false;
	if (dt_theme_is_plugin_active ( 'revslider/revslider.php' )) :
		global $wpdb;
		// table_prefix = WP_ALLOW_MULTISITE ? $wpdb->base_prefix : $wpdb->prefix;
		$table_prefix = $wpdb->prefix;
		$table_name = $table_prefix . "revslider_sliders";

		if ($wpdb->get_var ( "SHOW TABLES LIKE '$table_name'" ) == $table_name) :
			$resultset = $wpdb->get_results ( "SELECT title,alias FROM $table_name" );
			foreach ( $resultset as $rs ) :
				$sliders [$rs->alias] = $rs->title;
			endforeach;
			return $sliders;
		 else :
			return $sliders;
		endif;
	 else :
		return $sliders;
	endif;
}
// # --- **** dt_theme_is_plugin_active() *** --- ###

// # --- **** dt_theme_social_bookmarks() *** --- ###
/**
 * dt_theme_social_bookmarks()
 * Objective:
 * To show social shares
 */
function dt_theme_social_bookmarks($arg = 'sb-post') {
	global $post;

	$title = $post->post_title;
	$url = get_permalink ( $post->ID );
	$excerpt = $post->post_excerpt;
	$data = "";

	$fb = dt_theme_option ( 'integration', "{$arg}-fb_like" );
	$data .= ! empty ( $fb ) ? "<li class='facebook'><a href='http".dt_theme_ssl()."://www.facebook.com/sharer.php?u=$url&amp;t=" . urlencode ( $title ) . "' class='fa fa-facebook'></a></li>" : "";

	$twitter = dt_theme_option ( 'integration', "{$arg}-twitter" );
	$t_url = ! empty ( $twitter ) ? $url : '';
	$data .= ! empty ( $twitter ) ? "<li class='twitter'><a href='http".dt_theme_ssl()."://twitter.com/home/?status=" . urlencode ( $title ) . ":$t_url' class='fa fa-twitter'></a></li>" : "";

	$googleplus = dt_theme_option ( 'integration', "{$arg}-googleplus" );
	$data .= ! empty ( $googleplus ) ? "<li class='google'><a href=\"https://plus.google.com/share?url=$url\"  onclick=\"javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;\" class='fa fa-google-plus'></a></li>" : '';

	$linkedin = dt_theme_option ( 'integration', "{$arg}-linkedin" );
	$data .= ! empty ( $linkedin ) ? "<li class='linkedin'><a href='http".dt_theme_ssl()."://www.linkedin.com/shareArticle?mini=true&amp;title=".urlencode($title)."&amp;url=$url' title='Share On LinkedIn' class='fa fa-linkedin'></a></li>" : "";

	$pintrest = dt_theme_option ( 'integration', "{$arg}-pintrest" );
	$media = wp_get_attachment_url ( get_post_thumbnail_id ( $post->ID ) );
	$data .= ! empty ( $pintrest ) ? "<li class='pinterest'><a href='http".dt_theme_ssl()."://pinterest.com/pin/create/button/?url=" . urlencode ( $url ) . "&amp;media=$media' class='fa fa-pinterest'></a></li>" : "";

  // wechat social share icon
	$wechat = dt_theme_option ( 'integration', "{$arg}-wechat" );
  $data .= ! empty ( $wechat ) ? "<li class='wechat'></li>" : "";

	$data = ! empty ( $data ) ? "<ul class='dt-sc-social-icons'>{$data}</ul>" : "";
	echo $data;
}
// # --- **** dt_theme_social_bookmarks() *** --- ###

// # --- **** is_dt_theme_moible_view() *** --- ###
/**
 * dt_is_moible_view()
 * Objective:
 * If you eanble responsive mode in theme , this will add view port at the head
 */
function is_dt_theme_moible_view(){
	$dt_theme_options = get_option(IAMD_THEME_SETTINGS);
	$dt_theme_mobile = !empty($dt_theme_options['mobile']) ? $dt_theme_options['mobile'] : "";
	if(isset($dt_theme_mobile['is-theme-responsive']))
		echo "<meta name='viewport' content='width=device-width, initial-scale=1' />\r";
}
// # --- **** is_dt_theme_moible_view() *** --- ###

add_action( 'wp_enqueue_scripts', 'dt_theme_enqueue_styles' );
function dt_theme_enqueue_styles() {

	$dt_theme_options = get_option(IAMD_THEME_SETTINGS);
	$dt_theme_general = $dt_theme_options ['general'];
	$template_uri = get_template_directory_uri();

	if (isset ( $dt_theme_general ['enable-favicon'] )) :
		$url = ! empty ( $dt_theme_general ['favicon-url'] ) ? $dt_theme_general ['favicon-url'] : $template_uri . "/images/favicon.png";
		echo "<link href='$url' rel='shortcut icon' type='image/x-icon' />\n";

		$phone_url = ! empty ( $dt_theme_general ['apple-favicon'] ) ? $dt_theme_general ['apple-favicon'] : $template_uri . "/images/apple-touch-icon.png";
		echo "<link href='$phone_url' rel='apple-touch-icon-precomposed'/>\n";

		$phone_retina_url = ! empty ( $dt_theme_general ['apple-retina-favicon'] ) ? $dt_theme_general ['apple-retina-favicon'] : $template_uri . "/images/apple-touch-icon-114x114.png";
		echo "<link href='$phone_retina_url' sizes='114x114' rel='apple-touch-icon-precomposed'/>\n";

		$ipad_url = ! empty ( $dt_theme_general ['apple-ipad-favicon'] ) ? $dt_theme_general ['apple-ipad-favicon'] : $template_uri . "/images/apple-touch-icon-72x72.png";
		echo "<link href='$ipad_url' sizes='72x72' rel='apple-touch-icon-precomposed'/>\n";

		$ipad_retina_url = ! empty ( $dt_theme_general ['apple-ipad-retina-favicon'] ) ? $dt_theme_general ['apple-ipad-retina-favicon'] : $template_uri . "/images/apple-touch-icon-144x144.png";
		echo "<link href='$ipad_retina_url' sizes='144x144' rel='apple-touch-icon-precomposed'/>\n";
	endif;

	wp_enqueue_style('default', get_stylesheet_uri());

	//RTL...
	if(is_rtl())
		wp_enqueue_style('rtl', $template_uri.'/rtl.css');

	//SKIN...
	if($theme = dt_theme_option('appearance','skin'))
		wp_enqueue_style("skin", $template_uri."/skins/$theme/style.css");
	else
		wp_enqueue_style("skin", $template_uri."/skins/blue/style.css");

	//SLIDER DISABLE FOR MOBILE...
	$dt_theme_mobile = !empty($dt_theme_options['mobile']) ? $dt_theme_options['mobile'] : "";

    if(isset($dt_theme_mobile['is-slider-disabled'])):
		$out =	'<style type="text/css">';
		$out .=	'@media only screen and (max-width:320px), (max-width: 479px), (min-width: 480px) and (max-width: 767px), (min-width: 768px) and (max-width: 959px),
		 (max-width:1200px) { .banner { display:none !important; } }';
		$out .=	'</style>';
		echo $out;
	endif;

	wp_enqueue_style('rating', $template_uri.'/css/rating.css');
	wp_enqueue_style('isotope', $template_uri.'/css/isotope.css');
	wp_enqueue_style('tooltipster', $template_uri.'/css/tooltipster.css');

	#Buddypress inline css...
	if (function_exists('bp_add_cover_image_inline_css')) {
		$inline_css = bp_add_cover_image_inline_css( true );
		wp_add_inline_style( 'bp-parent-css', strip_tags( $inline_css['css_rules'] ) );
	}

	if(!is_singular('product')) {
		wp_enqueue_style('prettyphoto', $template_uri.'/css/prettyPhoto.css');
	}
	wp_enqueue_style('style.fontawesome', $template_uri.'/css/font-awesome.min.css');

	#if(is_page_template('tpl-hotels.php') || is_singular('dt_places') || is_tax('hotel_entries') || is_page_template('tpl-hotels-search.php'))
		wp_enqueue_style('style.colorbox', $template_uri.'/css/colorbox.css');

	wp_enqueue_style('style.fancybox', $template_uri.'/css/jquery.fancybox.css');

	//WOOCOMMERCE...
	if(dt_theme_is_plugin_active('woocommerce/woocommerce.php'))
		wp_enqueue_style('stylewoo', $template_uri.'/framework/woocommerce/css/style.css');

	//RESPONSIVE STYLES...
	if(dt_theme_option('mobile', 'is-theme-responsive'))
		wp_enqueue_style("responsive", $template_uri."/css/responsive.css");

	if(dt_theme_option('general', 'loading-bar') != "true")
		wp_enqueue_style("pace-load", $template_uri."/css/pace-theme-loading-bar.css");

	//WP JQUERY...
	wp_enqueue_script('modernizr-script', $template_uri.'/framework/js/public/modernizr.custom.js');
	wp_enqueue_script('jquery');

	#Hotels Booking File Starts...
	if(dt_theme_option('general', 'disable-hotel-booking') != "on"):
		wp_enqueue_style('hb-front-flick-theme', $template_uri.'/framework/hotelbooking/css/flick/jquery-ui.min.css');
		wp_enqueue_style('hb-front-flick-ui-dp', $template_uri.'/framework/hotelbooking/css/ui-flick.datepick.css');

		wp_enqueue_script('jquery-ui');
		wp_enqueue_script('jquery-effects-core');
		wp_enqueue_script('jquery-effects-pulsate');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-autocomplete');
	endif;
	#Hotels Booking File Ends...

	wp_enqueue_script('jq.nicescroll', $template_uri.'/framework/js/public/jquery.nicescroll.min.js', array('jquery'));

	if(dt_theme_option('general', 'loading-bar') != "true"):
		wp_enqueue_script('jq.pacemin', $template_uri.'/framework/js/public/pace.min.js');
		wp_localize_script('jq.pacemin', 'paceOptions', array(
			'restartOnRequestAfter' => 'false',
			'restartOnPushState' => 'false'
		));
	endif;
}

function hex2rgb($hex) {
	$hex = str_replace ( "#", "", $hex );

	if (strlen ( $hex ) == 3) :
		$r = hexdec ( substr ( $hex, 0, 1 ) . substr ( $hex, 0, 1 ) );
		$g = hexdec ( substr ( $hex, 1, 1 ) . substr ( $hex, 1, 1 ) );
		$b = hexdec ( substr ( $hex, 2, 1 ) . substr ( $hex, 2, 1 ) );
	 else :
		$r = hexdec ( substr ( $hex, 0, 2 ) );
		$g = hexdec ( substr ( $hex, 2, 2 ) );
		$b = hexdec ( substr ( $hex, 4, 2 ) );
	endif;
	$rgb = array (
			$r,
			$g,
			$b
	);
	return $rgb;
}
// ##########################################
// PAGINATION
// ##########################################
function dt_theme_pagination($class='',$pages = '', $wp_query){
	$out = NULL;
	$paged = $wp_query->query_vars['paged'];
	if(empty($paged))$paged = 1;
	$prev = $paged - 1;
	$next = $paged + 1;
	$range = 10;
	$showitems = ($range * 2) + 1;
	if($pages == '') {
		$pages = $wp_query->max_num_pages;
		if(!$pages)	{
			$pages = 1;
		}
	}

	if($paged > 1) $out .= "<a class='prev-post' href='".get_pagenum_link($paged - 1)."'><span class='fa fa-angle-left'></span>".__('Previous', 'iamd_text_domain')."</a>";
	$out .= '<ul>';
		if(1 != $pages){
			for ($i=1; $i <= $pages; $i++){
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
					if( $class == "ajax-load"):
						$c =  ($paged == $i) ? "active-page" : "";
						$out .= "<li><a href='".get_pagenum_link($i)."' class='".$c."'>".$i."</a></li>";
					else:
						$out .=  ($paged == $i)? "<li class='active-page'>".$i."</li>":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li>";
					endif;
				}
			}
		}
	$out .= '</ul>';
	if ($paged < $pages) $out .= "<a class='next-post' href='".get_pagenum_link($paged + 1)."'>".__('Next', 'iamd_text_domain')."<span class='fa fa-angle-right'></span></a>";

	return $out;
}

function arr_strfun(&$item, $key) {
	$item = str_replace(" ", "-", strtolower($item));
}

function theme_chk_pp() {
	previous_posts_link("Prev");
	next_posts_link("Next");
}

//Filter for oembed_result...
function slt_wmode_opaque( $html, $url, $args ) {
 if( strrpos($url,"youtube") !== false || strrpos($url,"youtu.") !== false ) {
        $patterns[] = '/src="(.*?)"/';
        $replacements[] = 'src="${1}&wmode=opaque"';
        $html =  preg_replace($patterns, $replacements, $html);
        $html = str_replace('</iframe>)', '</iframe>', $html);

 }elseif( strrpos($url, "soundcloud.com") !== false ) {
         $patterns[] = '/height="(.*?)"/';
         $replacements[] = 'height="150"';
         $html =  preg_replace($patterns, $replacements, $html);

         $patterns[] = '/width="(.*?)"/';
         $replacements[] = 'width="100%"';
         $html =  preg_replace($patterns, $replacements, $html);

         $patterns[] = '/visual=true&/';
         $replacements[] = '';
         $html =  preg_replace($patterns, $replacements, $html);

 }
return $html;
}
add_filter( 'oembed_result', 'slt_wmode_opaque', 10, 3 );

//MY MENU WALKER...
class DTOnePageMenuWalker extends Walker_Nav_Menu
{
	var $mega_active;

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
	{
		 global $wp_query;
		 $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		 $class_names = $value = '';

		 $classes = empty( $item->classes ) ? array() : (array) $item->classes;

		 $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );

 		 $class_names .= " menu-item-depth-{$depth}";
		 if($depth === 0 ) {
			if( $this->mega_active ) {
				$class_names .= " menu-item-megamenu-parent ";
				$columns = get_post_meta( $item->ID, '_dt-columns', true);
				$class_names .= " megamenu-{$columns}-columns-group";
			} else {
				$class_names .= " menu-item-simple-parent ";
			}
		 }
		 if( $depth === 1 ){
			$fullwidth = get_post_meta( $item->ID, '_dt-fullwidth', true);
			if( $fullwidth ) {
				$class_names .= " menu-item-fullwidth ";
			}
		 }
		 $class_names = ' class="'.esc_attr( $class_names ).'"';

		 $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		 $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		 $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		 $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

		 if(in_array('external', $item->classes) || $item->object != 'page' || $item->menu_item_parent != 0)
			 $attributes .= ! empty( $item->url )    ? ' href="'   . esc_attr( $item->url    ) .'"' : '';
		  else {
			 $pslug = basename( get_permalink($item->object_id) );
			 $attributes .= ! empty( $item->url )    ? ' href="'   . esc_attr( home_url() . '/#' . $pslug ) .'"' : '';
		  }

		 $item_output = $args->before;

		 if(in_array('external', $item->classes) || $item->object != 'page' || $item->menu_item_parent != 0)
			 $item_output .= '<a'. $attributes .' class = "external">';
		 else
			 $item_output .= '<a'. $attributes .'>';

		 $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
		 $item_output .= $args->link_after;
		 $item_output .= '</a>';
		 $item_output .= $args->after;

		 $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

add_action("wp_ajax_dt_theme_team_member", "dt_theme_team_member");
add_action("wp_ajax_nopriv_dt_theme_team_member", "dt_theme_team_member");
function dt_theme_team_member() {

	if ( !wp_verify_nonce( $_REQUEST['nonce'], "dt_team_member_nonce")) {
		exit();
	}
	$out = '';

	$post_id = $_REQUEST['post_id'];
	$args = array('post_type' => 'dt_teachers', 'p' => $post_id);
	$the_query = new WP_Query($args);
	if($the_query->have_posts()):
	 while($the_query->have_posts()): $the_query->the_post();

		$out .= '<div class="dt-team-member">';
			$out .= '<div class="dt-team-entry-left">';
				$out .= '<div class="dt-sc-team">';
					$out .= '<div class="dt-sc-entry-thumb">';
						$image =  get_the_post_thumbnail( $post_id );
						$image = !empty( $image ) ? $image : "<img src='http".dt_theme_ssl()."://placehold.it/220x220' />";
						$out .= $image;
					$out .= '</div>';
					$out .= '<div class="dt-sc-entry-title">';
						$out .= '<h2>'.get_the_title().'</h2>';
						$ts = get_post_meta($post_id, '_teacher_settings', true);
						if($ts['role'] != "")
							$out .= '<h5>'.$ts['role'].'</h5>';
					$out .= '</div>';
				$out .= '</div>';

				$out .= do_shortcode('[ratings id="'.$post_id.'"]');

			$out .= '</div>';

			$out .= '<div class="dt-team-entry-content">';

				$out .= '<ul>';
					$out .= '<li><strong>'.__('Experience', 'iamd_text_domain').' :</strong>'.$ts['exp'].'</li>';
					$out .= '<li><strong>'.__('Courses Submitted', 'iamd_text_domain').' :</strong>'.$ts['course'].'</li>';
					$out .= '<li><strong>'.__('Specialist in', 'iamd_text_domain').' :</strong>'.$ts['special'].'</li>';
				$out .= '</ul>';

				$out .= dt_theme_excerpt(50);
				$out .= '<a href="'.get_permalink().'" class="dt-sc-button small">'.__('read more', 'iamd_text_domain').'</a>';
			$out .= '</div>';

		$out .= '</div>';

	 endwhile;
	endif;

	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		#$result = json_encode($result);
		echo $out;
	}
	else {
		header("Location: ".$_SERVER["HTTP_REFERER"]);
	}
	die();
}

//Load Gallery Items...
add_action("wp_ajax_dt_ajax_load_gallery_posts", "dt_ajax_load_gallery_posts");
add_action("wp_ajax_nopriv_dt_ajax_load_gallery_posts", "dt_ajax_load_gallery_posts");
function dt_ajax_load_gallery_posts() {

	$out = '';

	$limit = (isset($_REQUEST['numPosts'])) ? $_REQUEST['numPosts'] : '5';
	$tax = (isset($_REQUEST['tax'])) ? explode(',', $_REQUEST['tax']) : '';
	$page = (isset($_REQUEST['pageNumber'])) ? $_REQUEST['pageNumber'] : '0';
	$offset = (isset($_REQUEST['offset'])) ? $_REQUEST['offset'] : '0';
	$li_class = $_REQUEST['liClass'];

	$args = array('post_type' => 'dt_galleries', 'posts_per_page' => $limit, 'post_status' => 'publish', 'offset' => $offset + ($limit * $page), 'tax_query' => array( array( 'taxonomy' => 'gallery_entries', 'field' => 'id', 'terms' => $tax )));

	$the_query = new WP_Query($args);
	if($the_query->have_posts()):
	 while($the_query->have_posts()): $the_query->the_post();

		$terms = wp_get_post_terms(get_the_ID(), 'gallery_entries', array("fields" => "slugs")); array_walk($terms, "arr_strfun");
		$out .= '<div class="'.$li_class." ".strtolower(implode(" ", $terms)).' no-space">';
			$out .= '<figure>';
                  $fullimg = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
                  $currenturl = $fullimg[0];
                  $currenticon = "fa-plus";
                  $pmeta_set = get_post_meta(get_the_ID(), '_gallery_settings', true);
                  if( @array_key_exists('items_thumbnail', $pmeta_set) && ($pmeta_set ['items_name'] [0] == 'video' )) {
                      $currenturl = $pmeta_set ['items'] [0];
                      $currenticon = "fa-video-camera";
                  }
                  //GALLERY IMAGES...
                  if(has_post_thumbnail()):
                      $attr = array('title' => get_the_title(), 'alt' => get_the_title());
                      $out .= get_the_post_thumbnail(get_the_ID(), 'full', $attr);
                  else:
                      $out .= '<img src="http'.dt_theme_ssl().'://placehold.it/1170X800.jpg&text=No Image" alt="'.get_the_title().'" title="'.get_the_title().'" />';
                  endif;
                  $out .= '<figcaption>';
				    $out .= '<div class="fig-content-wrapper">';
                      $out .= '<div class="fig-content">';
                          $out .= '<h5><a href="'.get_permalink().'">'.get_the_title().'</a></h5>';
                          $out .= '<p>'.get_the_term_list(get_the_ID(), 'gallery_entries', ' ', ', ', ' ').'</p>';
                          $out .= '<div class="fig-overlay">';
                              $out .= '<a class="zoom" title="'.get_the_title().'" data-gal="prettyPhoto[gallery]" href="'.$currenturl.'"><span class="fa '.$currenticon.'"> </span></a>';
                              $out .= '<a class="link" href="'.get_permalink().'"> <span class="fa fa-link"> </span> </a>';
                              if(dt_theme_is_plugin_active('roses-like-this/likethis.php')):
								$out .= generateLikeString(get_the_ID(), '');
							  endif;
                          $out .= '</div>';
                      $out .= '</div>';
					$out .= '</div>';
                  $out .= '</figcaption>';
                $out .= '</figure>';
	        $out .= '</div>';

	 endwhile;
	endif;

	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		#$result = json_encode($result);
		echo $out;
	}
	else {
		header("Location: ".$_SERVER["HTTP_REFERER"]);
	}
	die();
}

//Rating Average Function...
function dt_theme_comment_rating_average($pid = '') {
	$comment_arr = get_approved_comments($pid);
	$sum_rate = "";
	$arr_rate = array();

	foreach($comment_arr as $comment) {
		$i = get_comment_meta( $comment->comment_ID, 'rating', true );
		if($i != "") {
			$sum_rate += $i;
			array_push($arr_rate, $i);
		}
	}
	if($sum_rate != "")
		$all_avg = round($sum_rate / count($arr_rate), 1);
	else
		$all_avg = 0;

	return $all_avg;
}

//Rating Count Function...
function dt_theme_comment_rating_count($pid = '') {
	$comment_arr = get_approved_comments($pid);
	$arr_rate = array();
	foreach($comment_arr as $comment) {
		$i = get_comment_meta( $comment->comment_ID, 'rating', true );
		array_push($arr_rate, $i);
	}
	return $arr_rate;
}

//Getting Permalink by page template...
function dt_theme_page_permalink_by_its_template( $temlplate ) {
	$permalink = null;
	$pages = get_posts( array(
		'post_type' => 'page',
		'meta_key' => '_wp_page_template',
		'meta_value' => $temlplate,
		'suppress_filters' => 0 ) );

	if ( is_array( $pages ) && count( $pages ) > 0 ) {
		$login_page = $pages[0];
		$permalink = get_permalink( $login_page->ID );
	}
	return $permalink;
}

#Save additional comment fields...
add_action( 'comment_post', 'dt_sc_custom_save_comment_meta_data' );
function dt_sc_custom_save_comment_meta_data( $comment_id ) {

  if ( ( isset( $_POST['title'] ) ) && ( $_POST['title'] != '') )
  $title = wp_filter_nohtml_kses($_POST['title']);
  add_comment_meta( $comment_id, 'title', $title );

  if ( ( isset( $_POST['profession'] ) ) && ( $_POST['profession'] != '') )
  $role = wp_filter_nohtml_kses($_POST['profession']);
  add_comment_meta( $comment_id, 'profession', $role );

  if ( ( isset( $_POST['rating'] ) ) && ( $_POST['rating'] != '') )
  $rating = wp_filter_nohtml_kses($_POST['rating']);
  add_comment_meta( $comment_id, 'rating', $rating );
}

//Show Sidebar Function...
function dt_theme_show_sidebar($type, $id, $sidebar = 'left'){

	if( $type === 'post'){
		$settings = get_post_meta($id,'_dt_post_settings',TRUE);
	}elseif( $type === 'page' ){
		$settings = get_post_meta($id,'_tpl_default_settings',TRUE);
	}elseif( $type === "dt_hotels" ){
		$settings = get_post_meta($id,'_hotel_settings',TRUE);
	}elseif( $type === "dt_places" ){
		$settings = get_post_meta($id,'_place_settings',TRUE);
	}elseif( $type === "dt_teachers" ){
		$settings = get_post_meta($id,'_teacher_settings',TRUE);
	}

	$settings = is_array($settings) ? $settings  : array();

	if ( !array_key_exists('disable-everywhere-sidebar-'.$sidebar,$settings) ):
		if(function_exists('dynamic_sidebar') && dynamic_sidebar(('display-everywhere-sidebar-'.$sidebar)) ): endif;
	endif;

	if( array_key_exists('widget-area-'.$sidebar, $settings)):

		foreach ($settings['widget-area-'.$sidebar] as $widget ) {
			$id = mb_convert_case($widget, MB_CASE_LOWER, "UTF-8");
			if(function_exists('dynamic_sidebar') && dynamic_sidebar($id) ): endif;
		}
	endif;

}

// Avoid a problem with Events Calendar PRO 4.2 which can inadvertently
// break oembeds.
function dt_theme_undo_recurrence_oembed_logic() {

	if ( ! class_exists( 'Tribe__Events__Pro__Main' ) ) return;

	$pro_object = Tribe__Events__Pro__Main::instance();
	$pro_callback = array( $pro_object, 'oembed_request_post_id_for_recurring_events' );

	remove_filter( 'oembed_request_post_id', $pro_callback );
}
add_action( 'init', 'dt_theme_undo_recurrence_oembed_logic' );

//Update for page builder latest version
add_action( 'wp_ajax_dt_theme_update_pagebuilder_contents', 'dt_theme_update_pagebuilder_contents' );
add_action( 'wp_ajax_nopriv_dt_theme_update_pagebuilder_contents', 'dt_theme_update_pagebuilder_contents' );
function dt_theme_update_pagebuilder_contents() {

	// Script to update pages
	$page_args = array('post_type' => 'page' ,'post_status' => 'publish' , 'posts_per_page' =>'-1');

	$page_datas = new WP_Query( $page_args );
	if( $page_datas->have_posts() ):
		while( $page_datas->have_posts() ):
			$page_datas->the_post();

				$current_page_id = get_the_ID();

				$builder_layout = get_post_meta( $current_page_id, '_dt_builder_settings', true );
				$builder_layout = is_array( $builder_layout ) ? $builder_layout  : array();
				$layout_html = array_key_exists('layout_html',$builder_layout ) ? $builder_layout['layout_html'] : '';
				$layout_shortcode = array_key_exists('layout_shortcode',$builder_layout ) ? $builder_layout['layout_shortcode'] : '';
				$layout_parsed = array_key_exists('layout_parsed',$builder_layout ) ? $builder_layout['layout_parsed'] : 'false';

				if($layout_parsed != 'true') {

					$layout_html_new = str_replace('<span class="dt_add_module_column" title="Add Module" style="display:none;">A</span>', '', $layout_html);
					$layout_html_new = str_replace('<div data-option_name="content" class="content', '<div data-option_name="title_content" class="title_content', $layout_html_new);
					$layout_html_new = str_replace('dt_fullwidth_section_container', 'dt_modules_holder dt_fullwidth_section_container', $layout_html_new);
					$layout_html_new = str_replace('dt_modules_container', 'dt_modules_holder dt_modules_container', $layout_html_new);
					$layout_html_new = mb_convert_encoding($layout_html_new, 'HTML-ENTITIES', "UTF-8");


					$doc = new DomDocument();
					$file = @$doc->loadHTML($layout_html_new);

					$divtag = $doc->getElementsByTagName('div');
					foreach($divtag AS $item)
					{

						$item_class = $item->getAttribute('class');
						$item_class_arr = explode(' ', $item_class);

						if(in_array('dt_m_column', $item_class_arr)) {

							$add_module_div = $doc->createElement('div', '');
							$add_module_div_class = $doc->createAttribute('class');
							$add_module_div_class->value = 'dt_show_modules_in_popup dt_popup_from_column';
							$add_module_div_title = $doc->createAttribute('title');
							$add_module_div_title->value = 'Add Module';

							$add_module_div->appendChild($add_module_div_class);
							$add_module_div->appendChild($add_module_div_title);

							$item->appendChild($add_module_div);

						}

						if(in_array('dt_fullwidth_section', $item_class_arr)) {

							$add_module_div = $doc->createElement('div', '');
							$add_module_div_class = $doc->createAttribute('class');
							$add_module_div_class->value = 'dt_show_modules_in_popup dt_popup_from_section';
							$add_module_div_title = $doc->createAttribute('title');
							$add_module_div_title->value = 'Add Module';

							$add_module_div->appendChild($add_module_div_class);
							$add_module_div->appendChild($add_module_div_title);

							$item->appendChild($add_module_div);

						}

					}

					$layout_html_new = @$doc->saveHTML();

					$layout_html_new = str_replace('<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">', '', $layout_html_new);
					$layout_html_new = str_replace('<html><body>', '', $layout_html_new);
					$layout_html_new = str_replace('</body></html>', '', $layout_html_new);

					$output = array();
					$output['layout_html'] = $layout_html_new;
					$output['layout_shortcode'] = $layout_shortcode;
					$output['layout_parsed'] = 'true';

					update_post_meta($current_page_id, '_dt_builder_settings', $output);

				}

		endwhile;
	endif;

	// Script to update posts
	$post_args = array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' =>'-1');

	$post_datas = new WP_Query( $post_args );
	if( $post_datas->have_posts() ):
		while( $post_datas->have_posts() ):
			$post_datas->the_post();

				$current_page_id = get_the_ID();

				$builder_layout = get_post_meta( $current_page_id, '_dt_builder_settings', true );
				$builder_layout = is_array( $builder_layout ) ? $builder_layout  : array();
				$layout_html = array_key_exists('layout_html',$builder_layout ) ? $builder_layout['layout_html'] : '';
				$layout_shortcode = array_key_exists('layout_shortcode',$builder_layout ) ? $builder_layout['layout_shortcode'] : '';
				$layout_parsed = array_key_exists('layout_parsed',$builder_layout ) ? $builder_layout['layout_parsed'] : 'false';

				if($layout_parsed != 'true') {

					$layout_html_new = str_replace('<span class="dt_add_module_column" title="Add Module" style="display:none;">A</span>', '', $layout_html);
					$layout_html_new = str_replace('<div data-option_name="content" class="content', '<div data-option_name="title_content" class="title_content', $layout_html_new);
					$layout_html_new = str_replace('dt_fullwidth_section_container', 'dt_modules_holder dt_fullwidth_section_container', $layout_html_new);
					$layout_html_new = str_replace('dt_modules_container', 'dt_modules_holder dt_modules_container', $layout_html_new);
					$layout_html_new = mb_convert_encoding($layout_html_new, 'HTML-ENTITIES', "UTF-8");


					$doc = new DomDocument();
					$file = @$doc->loadHTML($layout_html_new);

					$divtag = $doc->getElementsByTagName('div');
					foreach($divtag AS $item)
					{

						$item_class = $item->getAttribute('class');
						$item_class_arr = explode(' ', $item_class);

						if(in_array('dt_m_column', $item_class_arr)) {

							$add_module_div = $doc->createElement('div', '');
							$add_module_div_class = $doc->createAttribute('class');
							$add_module_div_class->value = 'dt_show_modules_in_popup dt_popup_from_column';
							$add_module_div_title = $doc->createAttribute('title');
							$add_module_div_title->value = 'Add Module';

							$add_module_div->appendChild($add_module_div_class);
							$add_module_div->appendChild($add_module_div_title);

							$item->appendChild($add_module_div);

						}

						if(in_array('dt_fullwidth_section', $item_class_arr)) {

							$add_module_div = $doc->createElement('div', '');
							$add_module_div_class = $doc->createAttribute('class');
							$add_module_div_class->value = 'dt_show_modules_in_popup dt_popup_from_section';
							$add_module_div_title = $doc->createAttribute('title');
							$add_module_div_title->value = 'Add Module';

							$add_module_div->appendChild($add_module_div_class);
							$add_module_div->appendChild($add_module_div_title);

							$item->appendChild($add_module_div);

						}

					}

					$layout_html_new = @$doc->saveHTML();

					$layout_html_new = str_replace('<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">', '', $layout_html_new);
					$layout_html_new = str_replace('<html><body>', '', $layout_html_new);
					$layout_html_new = str_replace('</body></html>', '', $layout_html_new);

					$output = array();
					$output['layout_html'] = $layout_html_new;
					$output['layout_shortcode'] = $layout_shortcode;
					$output['layout_parsed'] = 'true';

					update_post_meta($current_page_id, '_dt_builder_settings', $output);

				}

		endwhile;
	endif;

	$bp_data = get_option(IAMD_THEME_SETTINGS);
	$bp_data['pagebuilder_update'] = 'done';
	update_option(IAMD_THEME_SETTINGS, $bp_data);

	die('1');

}

/* ---------------------------------------------------------------------------
 * SSL | Attachments
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'dt_theme_ssl_attachments' ) )
{
	function dt_theme_ssl_attachments( $url ){
		if( is_ssl() ){
			return str_replace('http://', 'https://', $url);
		}
		return $url;
	}
}
add_filter( 'wp_get_attachment_url', 'dt_theme_ssl_attachments' );

/* ---------------------------------------------------------------------------
 * Site SSL Compatibility
 * --------------------------------------------------------------------------- */
if(!function_exists('dt_theme_ssl'))
{
	function dt_theme_ssl( $echo = false ){
		$ssl = '';
		if( is_ssl() ) $ssl = 's';
		if( $echo ){
			echo esc_html($ssl);
		}
		return $ssl;
	}
}?>
