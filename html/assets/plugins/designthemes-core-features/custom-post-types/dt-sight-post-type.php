<?php
  if (! class_exists ( 'DTSightPostType' )) {
	class DTSightPostType {

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
					'dt_add_sight_meta_box'
			) );

			add_filter ( "manage_edit-dt_sights_columns", array (
					$this,
					"dt_sights_edit_columns"
			) );

			add_action ( "manage_posts_custom_column", array (
					$this,
					"dt_sights_columns_display"
			), 10, 2 );
		}

		/**
		 */
		function createPostType() {
			$labels = array (
					'name' => __ ( 'Hotspot', 'dt_themes' ),
					'all_items' => __ ( 'All Hotspots', 'dt_themes' ),
					'singular_name' => __ ( 'Hotspot', 'dt_themes' ),
					'add_new' => __ ( 'Add New', 'dt_themes' ),
					'add_new_item' => __ ( 'Add New Hotspot', 'dt_themes' ),
					'edit_item' => __ ( 'Edit Hotspot', 'dt_themes' ),
					'new_item' => __ ( 'New Hotspot', 'dt_themes' ),
					'view_item' => __ ( 'View Hotspot', 'dt_themes' ),
					'search_items' => __ ( 'Search Hotspots', 'dt_themes' ),
					'not_found' => __ ( 'No Hotspots found', 'dt_themes' ),
					'not_found_in_trash' => __ ( 'No Hotspots found in Trash', 'dt_themes' ),
					'parent_item_colon' => __ ( 'Parent Hotspot:', 'dt_themes' ),
					'menu_name' => __ ( 'Hotspots', 'dt_themes' )
			);

			$args = array (
					'labels' => $labels,
					'hierarchical' => false,
					'description' => 'This is custom post type hotspots',
					'supports' => array (
							'title',
							'editor',
							'comments',
							'thumbnail'
					),

					'public' => true,
					'show_ui' => true,
					'show_in_menu' => true,
					'menu_position' => 5,
					// 'menu_icon' => plugin_dir_url ( __FILE__ ) . 'images/icon_sight.png',
					'menu_icon' => 'dashicons-location',

					'show_in_nav_menus' => true,
					'publicly_queryable' => true,
					'exclude_from_search' => false,
					'has_archive' => true,
					'query_var' => true,
					'can_export' => true,
					// START: rewirte from post type name to specific name (BY BEN)
					// 'rewrite' => true,
					'rewrite' => array( 'slug' => 'hotspot' ),
					// END: rewirte from post type name to specific name (BY BEN)
					'capability_type' => 'post'
			);

			register_post_type ( 'dt_sights', $args );

			register_taxonomy ( "sight_entries", array (
					"dt_sights"
			), array (
					"hierarchical" => true,
					"label" => "Categories",
					"singular_label" => "Category",
					"show_admin_column" => true,
					// START: rewirte from post type name to specific name (BY BEN)
					// 'rewrite' => true,
					'rewrite' => array( 'slug' => 'hotspot-category' ),
					// END: rewirte from post type name to specific name (BY BEN)
					"query_var" => true
			) );
		}

		/**
		 */
		function dt_add_sight_meta_box() {
			add_meta_box ( "dt-sight-default-metabox", __ ( 'Default Options', 'dt_themes' ), array (
					$this,
					'dt_default_metabox'
			), 'dt_sights', "normal", "default" );
		}

		/**
		 */
		function dt_default_metabox() {
			include_once plugin_dir_path ( __FILE__ ) . 'metaboxes/dt_sight_default_metabox.php';
		}

		/**
		 *
		 * @param unknown $columns
		 * @return multitype:
		 */
		function dt_sights_edit_columns($columns) {

			$newcolumns = array (
				"cb" => "<input type=\"checkbox\" />",
				"dt_sight_thumb" => "Image",
				"title" => "Title",
				"likes"	=> "Likes",
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
		function dt_sights_columns_display($columns, $id) {
			global $post;

			switch ($columns) {

				case "dt_sight_thumb" :

				    $image = wp_get_attachment_image(get_post_thumbnail_id($id), array(75,75));
					if(!empty($image)):
					  	echo $image;
				    else:
						$sight_settings = get_post_meta ( $post->ID, '_sight_settings', TRUE );
						$sight_settings = is_array ( $sight_settings ) ? $sight_settings : array ();

						if( array_key_exists("items_thumbnail", $sight_settings)) {
							$item = $sight_settings ['items_thumbnail'] [0];
							$name = $sight_settings ['items_name'] [0];

							if( "video" === $name ) {
								echo '<span class="dt-video"></span>';
							}else{
								echo "<img src='{$item}' height='75px' width='75px' />";
							}
						}
					endif;
				break;

				case "likes":
					$likes = get_post_meta($post->ID, "_likes");
					if ($likes) {
					  echo $likes[0];
					} else {
					  echo 0;
					}
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

			if ( (key_exists('post_type', $_POST)) && ('dt_sights' == $_POST['post_type']) ) :

				if(isset($_POST['layout'])) :

					$settings = array ();
					$settings ['client'] = isset ( $_POST ['_client'] ) ? stripslashes ( $_POST ['_client'] ) : "";
					$settings ['location'] = isset ( $_POST ['_location'] ) ? stripslashes ( $_POST ['_location'] ) : "";
					$settings ['url'] = isset ( $_POST ['_url'] ) ? stripslashes ( $_POST ['_url'] ) : "";

					$settings ['sub-title-bg'] = isset($_POST['sub-title-bg']) ? $_POST['sub-title-bg'] : "";
					$settings ['sub-title-bg-repeat'] = isset($_POST['sub-title-bg-repeat']) ? $_POST['sub-title-bg-repeat'] : "";
					$settings ['sub-title-bg-position'] = isset($_POST['sub-title-bg-position']) ? $_POST['sub-title-bg-position'] : "";
					$settings ['sub-title-bg-color'] = isset($_POST['sub-title-bg-color']) ? $_POST['sub-title-bg-color'] : "";

					$settings ['layout'] = isset ( $_POST ['layout'] ) ? $_POST ['layout'] : "";
					$settings ['show-social-share'] = isset ( $_POST ['mytheme-social-share'] ) ? $_POST ['mytheme-social-share'] : "";
					$settings ['show-related-items'] = isset ( $_POST ['mytheme-related-item'] ) ? $_POST ['mytheme-related-item'] : "";
					$settings ['comment'] = isset ( $_POST ['mytheme-sight-comment'] ) ? $_POST ['mytheme-sight-comment'] : "";
					$settings ['items'] = isset ( $_POST ['items'] ) ? $_POST ['items'] : "";
					$settings ['items_thumbnail'] = isset ( $_POST ['items_thumbnail'] ) ? $_POST ['items_thumbnail'] : "";
					$settings ['items_name'] = isset ( $_POST ['items_name'] ) ? $_POST ['items_name'] : "";

					update_post_meta ( $post_id, "_sight_settings", array_filter ( $settings ) );

					//For default category...
					$terms = wp_get_object_terms ( $post_id, 'sight_entries' );
					if (empty ( $terms )) :
						wp_set_object_terms ( $post_id, 'Uncategorized', 'sight_entries', true );
					endif;
				endif;
			endif;
		}

		/**
		 * To load sight pages in front end
		 *
		 * @param string $template
		 * @return string
		 */
		function dt_template_include($template) {
			if (is_singular( 'dt_sights' )) {
				if (! file_exists ( get_stylesheet_directory () . '/single-dt_sights.php' )) {
					$template = plugin_dir_path ( __FILE__ ) . 'templates/single-dt_sights.php';
				}
			} elseif (is_tax ( 'sight_entries' )) {
				if (! file_exists ( get_stylesheet_directory () . '/taxonomy-sight_entries.php' )) {
					$template = plugin_dir_path ( __FILE__ ) . 'templates/taxonomy-sight_entries.php';
				}
			}
			return $template;
		}
	}
}
?>
