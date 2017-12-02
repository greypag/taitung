<?php
if (! class_exists ( 'DTRoomPostType' )) {
	class DTRoomPostType {
		
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
					'dt_add_room_meta_box' 
			) );
			
			add_filter ( "manage_edit-dt_rooms_columns", array (
					$this,
					"dt_rooms_edit_columns" 
			) );
			
			add_action ( "manage_posts_custom_column", array (
					$this,
					"dt_rooms_columns_display" 
			), 10, 2 );
		}
		
		/**
		 */
		function createPostType() {
			$labels = array (
					'name' => __ ( 'Rooms', 'dt_themes' ),
					'all_items' => __ ( 'All Rooms', 'dt_themes' ),
					'singular_name' => __ ( 'Room', 'dt_themes' ),
					'add_new' => __ ( 'Add New', 'dt_themes' ),
					'add_new_item' => __ ( 'Add New Room', 'dt_themes' ),
					'edit_item' => __ ( 'Edit Room', 'dt_themes' ),
					'new_item' => __ ( 'New Room', 'dt_themes' ),
					'view_item' => __ ( 'View Room', 'dt_themes' ),
					'search_items' => __ ( 'Search Rooms', 'dt_themes' ),
					'not_found' => __ ( 'No Rooms found', 'dt_themes' ),
					'not_found_in_trash' => __ ( 'No Rooms found in Trash', 'dt_themes' ),
					'parent_item_colon' => __ ( 'Parent Room:', 'dt_themes' ),
					'menu_name' => __ ( 'Rooms', 'dt_themes' ) 
			);
			
			$args = array (
					'labels' => $labels,
					'hierarchical' => false,
					'description' => 'This is custom post type rooms',
					'supports' => array (
							'title',
							'editor',
							'excerpt',
							'comments',
							'thumbnail'
					),
					
					'public' => true,
					'show_ui' => true,
					'show_in_menu' => false,
					'menu_position' => 5,
					'menu_icon' => 'dashicons-admin-home',
					
					'show_in_nav_menus' => true,
					'publicly_queryable' => true,
					'exclude_from_search' => false,
					'has_archive' => true,
					'query_var' => true,
					'can_export' => true,
					'rewrite' => true,
					'capability_type' => 'post' 
			);
			
			register_post_type ( 'dt_rooms', $args );
		}
		
		/**
		 */
		function dt_add_room_meta_box() {
			add_meta_box ( "dt-room-default-metabox", __ ( 'Default Options', 'dt_themes' ), array (
					$this,
					'dt_default_metabox'
			), 'dt_rooms', "normal", "default" );
		}
		
		/**
		 */
		function dt_default_metabox() {
			include_once plugin_dir_path ( __FILE__ ) . 'metaboxes/dt_room_default_metabox.php';
		}
		
		/**
		 *
		 * @param unknown $columns        	
		 * @return multitype:
		 */
		function dt_rooms_edit_columns($columns) {

			$newcolumns = array (
				"cb" => "<input type=\"checkbox\" />",
				"dt_room_thumb" => "Image",
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
		function dt_rooms_columns_display($columns, $id) {
			global $post;
			
			switch ($columns) {
				
				case "dt_room_thumb" :
				
				    $image = wp_get_attachment_image(get_post_thumbnail_id($id), array(75,75));
					if(!empty($image)):
					  	echo $image;
				    else:
						echo __("No Image",'dt_themes');
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

			if ( (key_exists('post_type', $_POST)) && ('dt_rooms' == $_POST['post_type']) ) :

				if(isset($_POST['layout'])) :
	
					$settings = array ();
					$settings ['room_occupancy'] = isset ( $_POST ['_room_occupancy'] ) ? stripslashes ( $_POST ['_room_occupancy'] ) : "";
					$settings ['room_price'] = isset ( $_POST ['_room_price'] ) ? $_POST ['_room_price'] : "";
					$settings ['room_size'] = isset ( $_POST ['_room_size'] ) ? $_POST ['_room_size'] : "";

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

					$settings ['items'] = isset ( $_POST ['items'] ) ? $_POST ['items'] : "";
					$settings ['items_thumbnail'] = isset ( $_POST ['items_thumbnail'] ) ? $_POST ['items_thumbnail'] : "";
					$settings ['items_name'] = isset ( $_POST ['items_name'] ) ? $_POST ['items_name'] : "";
	
					update_post_meta ( $post_id, "_room_settings", array_filter ( $settings ) );

				endif;
			endif;
		}

		/**
		 * To load room pages in front end
		 *
		 * @param string $template
		 * @return string
		 */
		function dt_template_include($template) {
			if (is_singular( 'dt_rooms' )) {
				if (! file_exists ( get_stylesheet_directory () . '/single-dt_rooms.php' )) {
					$template = plugin_dir_path ( __FILE__ ) . 'templates/single-dt_rooms.php';
				}
			}
			return $template;
		}
	}
}
?>