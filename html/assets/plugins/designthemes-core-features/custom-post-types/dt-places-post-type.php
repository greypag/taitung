<?php
if (! class_exists ( 'DTPlacePostType' )) {
	class DTPlacePostType {

		/**
		 */
		function __construct() {
			// Add Hook into the 'init()' action
			add_action ( 'init', array (
					$this,
					'dt_init'
			) );

			// Add Hook into the 'admin_init()' action
			add_action ( 'admin_init', array (
					$this,
					'dt_admin_init'
			) );

			add_filter ( 'template_include', array (
					$this,
					'dt_template_include'
			) );
		}

		/**
		 * A function hook that the WordPress core launches at 'init' points
		 */
		function dt_init() {
			$this->createPostType ();
			add_action ( 'save_post', array (
					$this,
					'save_post_meta'
			) );
		}

		/**
		 * A function hook that the WordPress core launches at 'admin_init' points
		 */
		function dt_admin_init() {
			wp_enqueue_script ( 'jquery-ui-sortable' );

			remove_filter( 'manage_posts_custom_column', 'likeThisDisplayPostLikes');

			add_action ( 'add_meta_boxes', array (
					$this,
					'dt_add_place_meta_box'
			) );

			add_filter ( "manage_edit-dt_places_columns", array (
					$this,
					"dt_places_edit_columns"
			) );

			add_action ( "manage_posts_custom_column", array (
					$this,
					"dt_places_columns_display"
			), 10, 2 );
		}

		/**
		 */
		function createPostType() {
			$labels = array (
					'name' => __ ( 'Sports', 'dt_themes' ),
					'all_items' => __ ( 'All Sports', 'dt_themes' ),
					'singular_name' => __ ( 'Sport', 'dt_themes' ),
					'add_new' => __ ( 'Add New', 'dt_themes' ),
					'add_new_item' => __ ( 'Add New Sport', 'dt_themes' ),
					'edit_item' => __ ( 'Edit Sport', 'dt_themes' ),
					'new_item' => __ ( 'New Sport', 'dt_themes' ),
					'view_item' => __ ( 'View Sport', 'dt_themes' ),
					'search_items' => __ ( 'Search Sports', 'dt_themes' ),
					'not_found' => __ ( 'No Sports found', 'dt_themes' ),
					'not_found_in_trash' => __ ( 'No Sports found in Trash', 'dt_themes' ),
					'parent_item_colon' => __ ( 'Parent Sport:', 'dt_themes' ),
					'menu_name' => __ ( 'Sports', 'dt_themes' )
			);

			$args = array (
					'labels' => $labels,
					'hierarchical' => false,
					'description' => 'This is custom post type sports',
					'supports' => array (
							'title',
							'editor',
							'excerpt',
							'comments',
							'thumbnail'
					),

					'public' => true,
					'show_ui' => true,
					'show_in_menu' => true,
					'menu_position' => 5,
					// 'menu_icon' => 'fa-futbol-o',
          // 'menu_icon' => 'icon-sport-bicycle.png',
          'menu_icon' => plugin_dir_url ( __FILE__ ) . 'images/icon_sport_bicycle.png',

					'show_in_nav_menus' => true,
					'publicly_queryable' => true,
					'exclude_from_search' => false,
					'has_archive' => true,
					'query_var' => true,
					'can_export' => true,
					'rewrite' => true,
					'capability_type' => 'post'
			);

			register_post_type ( 'dt_places', $args );

			register_taxonomy ( "place_entries", array (
					"dt_places"
			), array (
					"hierarchical" => true,
					"label" => "Categories",
					"singular_label" => "Category",
					"show_admin_column" => true,
					"rewrite" => true,
					"query_var" => true
			) );
		}

		/**
		 */
		function dt_add_place_meta_box() {
			add_meta_box ( "dt-place-default-metabox", __ ( 'Default Options', 'dt_themes' ), array (
					$this,
					'dt_default_metabox'
			), 'dt_places', "normal", "default" );
		}

		/**
		 */
		function dt_default_metabox() {
			include_once plugin_dir_path ( __FILE__ ) . 'metaboxes/dt_place_default_metabox.php';
		}

		/**
		 *
		 * @param unknown $columns
		 * @return multitype:
		 */
		function dt_places_edit_columns($columns) {

			$newcolumns = array (
				"cb" => "<input type=\"checkbox\" />",
				"dt_place_thumb" => "Image",
				"title" => "Title",
				"author" => "Author"
			);
			$columns = array_merge ( $newcolumns, $columns );
			return $columns;
		}

		/**
		 *
		 * @param unknown $columns
		 * @param unknown $id
		 */
		function dt_places_columns_display($columns, $id) {
			global $post;

			switch ($columns) {

				case "dt_place_thumb" :

				    $image = wp_get_attachment_image(get_post_thumbnail_id($id), array(75,75));
					if(!empty($image)):
					  	echo $image;
				    else:
						$place_settings = get_post_meta ( $post->ID, '_place_settings', TRUE );
						$place_settings = is_array ( $place_settings ) ? $place_settings : array ();

						if( array_key_exists("items_thumbnail", $place_settings)) {
							$item = $place_settings ['items_thumbnail'] [0];
							$name = $place_settings ['items_name'] [0];

							if( "video" === $name ) {
								echo '<span class="dt-video"></span>';
							}else{
								echo "<img src='{$item}' height='75px' width='75px' />";
							}
						}
					endif;
				break;

			}
		}

		/**
		 */
		function save_post_meta($post_id) {
			if( key_exists ( '_inline_edit',$_POST )) :
				if ( wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce')) return;
			endif;

			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

			if (!current_user_can('edit_post', $post_id)) :
				return;
			endif;

			if ( (key_exists('post_type', $_POST)) && ('dt_places' == $_POST['post_type']) ) :

				if(isset($_POST['layout'])) :

					$settings = array ();
					$settings ['place_add'] = isset ( $_POST ['_place_add'] ) ? stripslashes ( $_POST ['_place_add'] ) : "";
					$settings ['place_lat'] = isset ( $_POST ['_place_lat'] ) ? stripslashes ( $_POST ['_place_lat'] ) : "";
					$settings ['place_long'] = isset ( $_POST ['_place_long'] ) ? stripslashes ( $_POST ['_place_long'] ) : "";

					$settings ['layout'] = isset ( $_POST ['layout'] ) ? $_POST ['layout'] : "";

					if($_POST['layout'] == 'with-both-sidebar') {
						$settings['disable-everywhere-sidebar-left'] = $_POST['disable-everywhere-sidebar-left'];
						$settings['disable-everywhere-sidebar-right'] = $_POST['disable-everywhere-sidebar-right'];
						$settings['widget-area-left'] =  array_unique(array_filter($_POST['mytheme']['widgetareas-left']));
						$settings['widget-area-right'] =  array_unique(array_filter($_POST['mytheme']['widgetareas-right']));
					} elseif($_POST['layout'] == 'with-left-sidebar') {
						$settings['disable-everywhere-sidebar-left'] = $_POST['disable-everywhere-sidebar-left'];
						$settings['widget-area-left'] =  array_unique(array_filter($_POST['mytheme']['widgetareas-left']));
					} elseif($_POST['layout'] == 'with-right-sidebar') {
						$settings['disable-everywhere-sidebar-right'] = $_POST['disable-everywhere-sidebar-right'];
						$settings['widget-area-right'] =  array_unique(array_filter($_POST['mytheme']['widgetareas-right']));
					}

					$settings ['show-hotels-list'] = isset ( $_POST ['mytheme-hotels-list'] ) ? $_POST ['mytheme-hotels-list'] : "";

					$settings ['place-hotels-list'] = $_POST['mytheme']['place']['hotels_list'];
					$settings ['place-destinations-list'] = $_POST['mytheme']['place']['destinations_list'];

					$settings ['show-reviews'] = isset ( $_POST ['mytheme-reviews'] ) ? $_POST ['mytheme-reviews'] : "";
					$settings ['show-recommends'] = isset ( $_POST ['mytheme-recommends'] ) ? $_POST ['mytheme-recommends'] : "";
					$settings ['items'] = isset ( $_POST ['items'] ) ? $_POST ['items'] : "";
					$settings ['items_thumbnail'] = isset ( $_POST ['items_thumbnail'] ) ? $_POST ['items_thumbnail'] : "";
					$settings ['items_name'] = isset ( $_POST ['items_name'] ) ? $_POST ['items_name'] : "";

					update_post_meta ( $post_id, "_place_settings", array_filter ( $settings ) );

					//For default category...
					$terms = wp_get_object_terms ( $post_id, 'place_entries' );
					if (empty ( $terms )) :
						wp_set_object_terms ( $post_id, 'Uncategorized', 'place_entries', true );
					endif;
				endif;
			endif;
		}

		/**
		 * To load gallery pages in front end
		 *
		 * @param string $template
		 * @return string
		 */
		function dt_template_include($template) {
			if (is_singular( 'dt_places' )) {
				if (! file_exists ( get_stylesheet_directory () . '/single-dt_places.php' )) {
					$template = plugin_dir_path ( __FILE__ ) . 'templates/single-dt_places.php';
				}
			} elseif (is_tax ( 'place_entries' )) {
				if (! file_exists ( get_stylesheet_directory () . '/taxonomy-place_entries.php' )) {
					$template = plugin_dir_path ( __FILE__ ) . 'templates/taxonomy-place_entries.php';
				}
			}
			return $template;
		}
	}
}
?>
