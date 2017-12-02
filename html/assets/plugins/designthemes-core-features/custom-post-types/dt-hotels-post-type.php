<?php
if (! class_exists ( 'DTHotelPostType' )) {
	class DTHotelPostType {
		
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
					'dt_add_hotel_meta_box' 
			) );
			
			add_filter ( "manage_edit-dt_hotels_columns", array (
					$this,
					"dt_hotels_edit_columns" 
			) );
			
			add_action ( "manage_posts_custom_column", array (
					$this,
					"dt_hotels_columns_display" 
			), 10, 2 );
		}
		
		/**
		 */
		function createPostType() {
			$labels = array (
					'name' => __ ( 'Hotels', 'dt_themes' ),
					'all_items' => __ ( 'All Hotels', 'dt_themes' ),
					'singular_name' => __ ( 'Hotel', 'dt_themes' ),
					'add_new' => __ ( 'Add New', 'dt_themes' ),
					'add_new_item' => __ ( 'Add New Hotel', 'dt_themes' ),
					'edit_item' => __ ( 'Edit Hotel', 'dt_themes' ),
					'new_item' => __ ( 'New Hotel', 'dt_themes' ),
					'view_item' => __ ( 'View Hotel', 'dt_themes' ),
					'search_items' => __ ( 'Search Hotels', 'dt_themes' ),
					'not_found' => __ ( 'No Hotels found', 'dt_themes' ),
					'not_found_in_trash' => __ ( 'No Hotels found in Trash', 'dt_themes' ),
					'parent_item_colon' => __ ( 'Parent Hotel:', 'dt_themes' ),
					'menu_name' => __ ( 'Hotels Booking', 'dt_themes' ) 
			);
			
			$args = array (
					'labels' => $labels,
					'hierarchical' => false,
					'description' => 'This is custom post type hotels',
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
					'menu_icon' => 'dashicons-calendar',
					
					'show_in_nav_menus' => true,
					'publicly_queryable' => true,
					'exclude_from_search' => false,
					'has_archive' => true,
					'query_var' => true,
					'can_export' => true,
					'rewrite' => true,
					'capability_type' => 'post' 
			);
			
			register_post_type ( 'dt_hotels', $args );
			
			register_taxonomy ( "hotel_entries", array (
					"dt_hotels" 
			), array (
					"hierarchical" => true,
					"label" => "Categories",
					"singular_label" => "Category",
					"show_admin_column" => true,
					"rewrite" => true,
					"query_var" => true 
			) );
			
			$labels = array(
				'name'              => _x( 'Locations', 'dt_themes' ),
				'singular_name'     => _x( 'Location', 'dt_themes' ),
				'search_items'      => __( 'Search Locations', 'dt_themes' ),
				'all_items'         => __( 'All Locations', 'dt_themes' ),
				'parent_item'       => __( 'Parent Location', 'dt_themes' ),
				'parent_item_colon' => __( 'Parent Location:', 'dt_themes' ),
				'edit_item'         => __( 'Edit Location', 'dt_themes' ),
				'update_item'       => __( 'Update Location', 'dt_themes' ),
				'add_new_item'      => __( 'Add New Location', 'dt_themes' ),
				'new_item_name'     => __( 'New Location Name', 'dt_themes' ),
				'menu_name'         => __( 'Locations', 'dt_themes' ),
			);

			$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => true
			);

			register_taxonomy( 'hotel_locations', array( 'dt_hotels' ), $args );
		}
		
		/**
		 */
		function dt_add_hotel_meta_box() {
			add_meta_box ( "dt-hotel-default-metabox", __ ( 'Default Options', 'dt_themes' ), array (
					$this,
					'dt_default_metabox' 
			), 'dt_hotels', "normal", "default" );
		}
		
		/**
		 */
		function dt_default_metabox() {
			include_once plugin_dir_path ( __FILE__ ) . 'metaboxes/dt_hotel_default_metabox.php';
		}
		
		/**
		 *
		 * @param unknown $columns        	
		 * @return multitype:
		 */
		function dt_hotels_edit_columns($columns) {

			$newcolumns = array (
				"cb" => "<input type=\"checkbox\" />",
				"dt_hotel_thumb" => "Image",
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
		function dt_hotels_columns_display($columns, $id) {
			global $post;
			
			switch ($columns) {
				
				case "dt_hotel_thumb" :
				
				    $image = wp_get_attachment_image(get_post_thumbnail_id($id), array(75,75));
					if(!empty($image)):
					  	echo $image;
				    else:
						$hotel_settings = get_post_meta ( $post->ID, '_hotel_settings', TRUE );
						$hotel_settings = is_array ( $hotel_settings ) ? $hotel_settings : array ();
					
						if( array_key_exists("items_thumbnail", $hotel_settings)) {
							$item = $hotel_settings ['items_thumbnail'] [0];
							$name = $hotel_settings ['items_name'] [0];
						
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

			if ( (key_exists('post_type', $_POST)) && ('dt_hotels' == $_POST['post_type']) ) :
			
				if(isset($_POST['layout'])) :
				
					$settings = array ();
					$settings ['hotel_add'] = isset ( $_POST ['_place_add'] ) ? stripslashes ( $_POST ['_place_add'] ) : "";
					$settings ['hotel_lat'] = isset ( $_POST ['_hotel_lat'] ) ? stripslashes ( $_POST ['_hotel_lat'] ) : "";
					$settings ['hotel_long'] = isset ( $_POST ['_hotel_long'] ) ? stripslashes ( $_POST ['_hotel_long'] ) : "";
					
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
					
					$settings ['offer_value'] = isset ( $_POST ['_offer_value'] ) ? $_POST ['_offer_value'] : "";
					$settings ['specially_whome'] = isset ( $_POST ['_specially_whome'] ) ? $_POST ['_specially_whome'] : "";
					$settings ['show-book-now'] = isset ( $_POST ['mytheme-book-now'] ) ? $_POST ['mytheme-book-now'] : "";
					$settings ['show-ratings'] = isset ( $_POST ['mytheme-ratings'] ) ? $_POST ['mytheme-ratings'] : "";
					$settings ['show-reviews'] = isset ( $_POST ['mytheme-reviews'] ) ? $_POST ['mytheme-reviews'] : "";
					$settings ['items'] = isset ( $_POST ['items'] ) ? $_POST ['items'] : "";
					$settings ['items_thumbnail'] = isset ( $_POST ['items_thumbnail'] ) ? $_POST ['items_thumbnail'] : "";
					$settings ['items_name'] = isset ( $_POST ['items_name'] ) ? $_POST ['items_name'] : "";
	
					$settings ['room-types'] = $_POST['mytheme']['hotel']['room_list'];
	
					update_post_meta ( $post_id, "_hotel_settings", array_filter ( $settings ) );
					
					if( isset ( $_POST ['_starting_price'] ) )
						update_post_meta ( $post_id, "starting_price", stripslashes ( $_POST ['_starting_price'] ) );	
						
					//For default category...
					$terms = wp_get_object_terms ( $post_id, 'hotel_entries' );
					if (empty ( $terms )) :
						wp_set_object_terms ( $post_id, 'Uncategorized', 'hotel_entries', true );
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
			if (is_singular( 'dt_hotels' )) {
				if (! file_exists ( get_stylesheet_directory () . '/single-dt_hotels.php' )) {
					$template = plugin_dir_path ( __FILE__ ) . 'templates/single-dt_hotels.php';
				}
			} elseif (is_tax ( 'hotel_entries' )) {
				if (! file_exists ( get_stylesheet_directory () . '/taxonomy-hotel_entries.php' )) {
					$template = plugin_dir_path ( __FILE__ ) . 'templates/taxonomy-hotel_entries.php';
				}
			}
			return $template;
		}
	}
}
?>