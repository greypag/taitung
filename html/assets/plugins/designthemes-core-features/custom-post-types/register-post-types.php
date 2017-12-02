<?php
if (! class_exists ( 'DTCoreCustomPostTypes' )) {

	/**
	 *
	 * @author iamdesigning11
	 *
	 */
	class DTCoreCustomPostTypes {
		function __construct() {

			/* Gallery Custom Post Type */
			require_once plugin_dir_path ( __FILE__ ) . '/dt-gallery-post-type.php';
			if (class_exists ( 'DTGalleryPostType' )) {
				new DTGalleryPostType ();
			}
			/* Sight Custom Post Type */
			// require_once plugin_dir_path ( __FILE__ ) . '/dt-sight-post-type.php';
			// if (class_exists ( 'DTSightPostType' )) {
			// 	new DTSightPostType ();
			// }

			/* Places Custom Post Type */
			require_once plugin_dir_path ( __FILE__ ) . '/dt-places-post-type.php';
			if (class_exists ( 'DTPlacePostType' )) {
				new DTPlacePostType ();
			}

			/* Hotels Custom Post Type */
			require_once plugin_dir_path ( __FILE__ ) . '/dt-hotels-post-type.php';
			if (class_exists ( 'DTHotelPostType' )) {
				new DTHotelPostType ();
			}

			/* Rooms Custom Post Type */
			require_once plugin_dir_path ( __FILE__ ) . '/dt-rooms-post-type.php';
			if (class_exists ( 'DTRoomPostType' )) {
				new DTRoomPostType ();
			}

			// Add Hook into the 'admin_init()' action
			add_action ( 'admin_init', array (
					$this,
					'dt_admin_init'
			) );

			add_action ( 'wp_ajax_dt_admin_ajax_map_values', array (
					$this,
					'dt_admin_ajax_map_values'
			) );
		}

		/**
		 * A function hook that the WordPress core launches at 'admin_init' points
		 */
		function dt_admin_init() {
			wp_enqueue_style ( 'dt-custom-post-css', plugin_dir_url ( __FILE__ ) . 'css/styles.css' );
			wp_register_script ( 'dt-metabox-script', plugin_dir_url ( __FILE__ ) . 'js/dt.metabox.js', array (), false, true );
			wp_localize_script( 'dt-metabox-script', 'dtAjaxMap', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
			wp_enqueue_script( 'dt-metabox-script' );
		}

		function dt_admin_ajax_map_values() {
			$result = "";
			if(isset($_REQUEST['place_address']) != "")
			{
				$address = $_REQUEST['place_address'];
				$prepAddr = str_replace(' ', '+', $address);
				$geocode = file_get_contents('http'.dt_theme_ssl().'://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
				$output= json_decode($geocode);
				$lat = @$output->results[0]->geometry->location->lat;
				$long = @$output->results[0]->geometry->location->lng;

				if($lat != "" && $long != "") {
					$result['type'] = "success";
					$result['lat'] = $lat;
					$result['long'] = $long;
				} else {
					$result['type'] = "error";
					$result['text'] = "Invalid Address...";
				}
			} else {
				$result['type'] = "error";
				$result['type'] = "Invalid Address...";
			}

			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
				$result = json_encode($result);
				echo $result;
			}
			die();
		}
	}
}
?>
