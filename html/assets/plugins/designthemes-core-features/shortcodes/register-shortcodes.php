<?php
if (! class_exists ( 'DTCoreShortcodes' )) {
	
	/**
	 * Used to "Loades Core Shortcodes & Add button to tinymce"
	 *
	 * @author iamdesigning11
	 */
	class DTCoreShortcodes {
		
		/**
		 * Constructor for DTCoreShortcodes
		 */
		function __construct() {
			define ( 'DESIGNTHEMES_TINYMCE_URL', plugin_dir_url ( __FILE__ ) . 'tinymce' );
			define ( 'DESIGNTHEMES_TINYMCE_PATH', plugin_dir_path ( __FILE__ ) . 'tinymce' );
			
			require_once plugin_dir_path ( __FILE__ ) . 'shortcodes.php';
			
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
			
			add_filter ( 'the_content', array (
					$this,
					'dt_the_content_filter' 
			) );

			# For Uploading purpose in tpl-dashboard.php
			add_action( 'wp_ajax_wpuf_featured_img', array(
				$this,
				'dt_featured_img_upload'
			) );
		}
		
		/**
		 * A function hook that the WordPress core launches at 'init' points
		 */
		function dt_init() {
			
			/* Front End CSS & jQuery */
			if (! is_admin ()) {

				wp_enqueue_style ( 'dt-animation-css', plugin_dir_url ( __FILE__ ) . 'css/animations.css' );
				#wp_enqueue_style ( 'dt-flex-css', plugin_dir_url ( __FILE__ ) . 'css/flexslider.css' );
				wp_enqueue_style ( 'dt-sc-css', plugin_dir_url ( __FILE__ ) . 'css/shortcodes.css' );
				
				wp_enqueue_script ( 'jquery' );

				wp_enqueue_script( 'plupload-all' ); #Used for front end uploader in tpl-dashboard.php

				wp_enqueue_script ( 'dt-sc-inview-script', plugin_dir_url ( __FILE__ ) . 'js/inview.js', array (), false, true );
				#wp_enqueue_script ( 'dt-sc-flexslider-script', plugin_dir_url ( __FILE__ ) . 'js/jquery.flexslider.js', array (), false, true );
				wp_enqueue_script ( 'dt-sc-tabs-script', plugin_dir_url ( __FILE__ ) . 'js/jquery.tabs.min.js', array (), false, true );
				wp_enqueue_script ( 'dt-sc-viewport-script', plugin_dir_url ( __FILE__ ) . 'js/jquery.viewport.js', array (), false, true );
				wp_enqueue_script ( 'dt-sc-carouFredSel-script', plugin_dir_url ( __FILE__ ) . 'js/jquery.carouFredSel-6.2.1-packed.js', array (), false, true );
				wp_enqueue_script ( 'dt-sc-tipTip-script', plugin_dir_url ( __FILE__ ) . 'js/jquery.tipTip.minified.js', array (), false, true );
				wp_enqueue_script ( 'dt-sc-donutchart-script', plugin_dir_url ( __FILE__ ) . 'js/jquery.donutchart.js', array (), false, true );
				wp_enqueue_script ( 'dt-sc-script', plugin_dir_url ( __FILE__ ) . 'js/shortcodes.js', array (), false, true );

				#Used for front end uploader in tpl-dashboard.php
				wp_localize_script( 'dt-sc-script', 'dt_plupload', array(
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'plupload' => array(
						'browse_button' => 'dt-frontend-uploader',
						'file_data_name' => 'wpuf_featured_img',					
						'max_file_size' => wp_max_upload_size() . 'b',
						'url' => admin_url( 'admin-ajax.php' ) . '?action=wpuf_featured_img',
						'multipart' => true,
						'urlstream_upload' => true,
					)
				));

			}
			
			if (! current_user_can ( 'edit_posts' ) && ! current_user_can ( 'edit_pages' )) {
				return;
			}
			
			if( is_admin() ) { # Used to add Shortcode button at admin panel only

				if ("true" === get_user_option ( 'rich_editing' )) {
					add_filter ( 'mce_buttons', array (
							$this,
							'dt_register_rich_buttons' 
					) );
				
					add_filter ( 'mce_external_plugins', array (
							$this,
							'dt_add_external_plugins' 
					) );
				}
			}
		}
		
		/**
		 * A function hook that the WordPress core launches at 'admin_init' points
		 */
		function dt_admin_init() {
			wp_enqueue_style ( 'wp-color-picker' );
			wp_enqueue_script ( 'wp-color-picker' );
			
			// css
			wp_enqueue_style ( 'DTCorePlugin-sc-dialog', DESIGNTHEMES_TINYMCE_URL . '/css/styles.css', false, '1.0', 'all' );
			
			wp_localize_script ( 'jquery', 'DTCorePlugin', array (
					'plugin_folder' => WP_PLUGIN_URL . '/designthemes-core-features',
					'tinymce_folder' => DESIGNTHEMES_TINYMCE_URL 
			) );
		}
		
		/**
		 * A function hook that used to filter the content - to remove unwanted codes
		 *
		 * @param string $content        	
		 * @return string
		 */
		function dt_the_content_filter($content) {
			$dt_shortcodes = array("dt_sc_accordion_group","dt_sc_button","dt_sc_blockquote","dt_sc_callout_box",
				"dt_sc_one_half","dt_sc_one_third","dt_sc_one_fourth","dt_sc_one_fifth","dt_sc_one_sixth",
				"dt_sc_two_sixth","dt_sc_two_third","dt_sc_three_fourth","dt_sc_two_fifth","dt_sc_three_fifth",
				"dt_sc_four_fifth","dt_sc_three_sixth","dt_sc_four_sixth","dt_sc_five_sixth","dt_sc_one_half_inner",
				"dt_sc_one_third_inner","dt_sc_one_fourth_inner","dt_sc_one_fifth_inner","dt_sc_one_sixth_inner",
				"dt_sc_two_sixth_inner","dt_sc_two_third_inner","dt_sc_three_fourth_inner","dt_sc_two_fifth_inner",
				"dt_sc_three_fifth_inner","dt_sc_four_four_inner","dt_sc_three_sixth_inner","dt_sc_four_sixth_inner",
				"dt_sc_five_sixth_inner","dt_sc_four_fifth_inner","dt_sc_address","dt_sc_phone","dt_sc_mobile",
				"dt_sc_fax","dt_sc_email","dt_sc_web","dt_sc_clients_carousel","dt_sc_donutchart_small",
				"dt_sc_donutchart_medium","dt_sc_donutchart_large","dt_sc_clear","dt_sc_hr_border","dt_sc_hr",
				"dt_sc_hr_medium","dt_sc_hr_large","dt_sc_hr_invisible","dt_sc_hr_invisible_small",
				"dt_sc_hr_invisible_medium","dt_sc_hr_invisible_large","dt_sc_icon_box","dt_sc_icon_box_colored",
				"dt_sc_dropcap","dt_sc_code","dt_sc_fancy_ol","dt_sc_fancy_ul","dt_sc_pricing_table",
				"dt_sc_pricing_table_item","dt_sc_progressbar","dt_sc_tab","dt_sc_tabs_horizontal",
				"dt_sc_tabs_vertical","dt_sc_team","dt_sc_testimonial","dt_sc_testimonial_carousel",
				"dt_sc_h1","dt_sc_h2","dt_sc_h3","dt_sc_h4","dt_sc_h5","dt_sc_h6","dt_sc_title_with_icon",
				"dt_sc_toggle","dt_sc_toggle_framed","dt_sc_titled_box","dt_sc_tooltip","dt_sc_pullquote",
				"dt_sc_portfolio_item","dt_sc_portfolios","dt_sc_infographic_bar","dt_sc_fullwidth_section",
				"dt_sc_fullwidth_video","dt_sc_animation","dt_sc_featured_properties","dt_sc_agent","dt_sc_agency",
				"dt_sc_service","dt_sc_properties_property_type_wise_tab","dt_sc_properties_contract_type_wise_tab",
				"dt_sc_properties_location_wise_tab","dt_sc_recent_properties","dt_sc_property","dt_sc_property_sliders","dt_sc_property_slider");

			$block = join("|", $dt_shortcodes );
			// opening tag
			$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);

			// closing tag
			$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
			
			return $rep;
		}
		
		/**
		 * Adds DesignThemes custom shortcode rich buttons to TinyMCE
		 *
		 * @param unknown $buttons        	
		 * @return unknown
		 */
		function dt_register_rich_buttons($buttons) {
			array_push ( $buttons, "|", "designthemes_sc_button" );
			return $buttons;
		}
		
		/**
		 * Adds DesignThemes javascript to TinyMCE
		 *
		 * @param unknown $plugins        	
		 * @return unknown
		 */
		function dt_add_external_plugins($plugins) {
			
			global $wp_version;
			
			if(  version_compare( $wp_version, '3.9' , '<') ) {
				$url = DESIGNTHEMES_TINYMCE_URL . '/plugin-wp-3.8.js';
			} else {
				$url = DESIGNTHEMES_TINYMCE_URL . '/plugin-wp-3.9.js';
			}
			
			$plugins ['DTCoreShortcodePlugin'] = $url;
			
			return $plugins;
		}

		#Used for front end uploader in tpl-dashboard.php
		function dt_featured_img_upload() {

			$upload_data = array(
				'name' => $_FILES['wpuf_featured_img']['name'],
				'type' => $_FILES['wpuf_featured_img']['type'],
        	    'tmp_name' => $_FILES['wpuf_featured_img']['tmp_name'],
            	'error' => $_FILES['wpuf_featured_img']['error'],
            	'size' => $_FILES['wpuf_featured_img']['size']
        	);

        	$filetype = wp_check_filetype($upload_data['name']);

        	if($filetype['ext'] === "png" || $filetype['ext'] === "jpg" || $filetype['ext'] === "jpeg" ) {

        		if( intval( $upload_data['size'] ) <= 800000){ #800 KB

        			$attach_id = $this->dt_upload_file( $upload_data );

        			if( $attach_id ) {
        				$post = get_post( $attach_id );
		        		$name = $post->post_title;
		        		$thumbnail = wp_get_attachment_image_src($attach_id,'thumbnail');
		        		$thumbnail = $thumbnail[0];
		        		$full = wp_get_attachment_image_src($attach_id,'full');
		        		$full = $full[0];

		        		$html = "<li data-attachment-id='{$attach_id}'>";
		        		$html .= "<img src='{$thumbnail}' alt='' />";
						$html .= "<span class='dt-image-name'>{$name}</span>";
						$html .= "<input type='hidden' name='items[]' value='{$full}' />";
						$html .= "<input class='dt-image-name' type='hidden' name='items_name[]' value='{$name}' />";
						$html .= "<input type='hidden' name='items_thumbnail[]' value='{$thumbnail}' />";
						$html .= "<input type='hidden' name='items_id[]' value='{$attach_id}' />";
						$html .= "<span class='my_delete'><i class='fa fa-times-circle'> </i></span>";
		        		$html .= "</li>";
		        		$response = array('success' => true,'html' => $html);
        			}
        		} else {
        			$response = array('success' => "file_size", 'message' => __("File size should be less than 800 KB ",'dt_themes'));
        		}	
        	} else {
        		$response = array('success' => "file_type", 'message' => __("Please upload image only ( png / jpeg ) ",'dt_themes'));
        	}
        	echo json_encode( $response );
			exit;
		}

		#Used for front end uploader in tpl-dashboard.php
		function dt_upload_file( $upload_data ) {

			$uploaded_file = wp_handle_upload( $upload_data, array('test_form' => false) );

			// If the wp_handle_upload call returned a local path for the image
		    if ( isset( $uploaded_file['file'] ) ) {
		    	$file_loc = $uploaded_file['file'];
		    	$file_name = basename( $upload_data['name'] );
		    	$file_type = wp_check_filetype( $file_name );

		    	$attachment = array(
            		'post_mime_type' => $file_type['type'],
            		'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $file_name ) ),
            		'post_content' => '',
            		'post_status' => 'inherit');

        		$attach_id = wp_insert_attachment( $attachment, $file_loc );
        		$attach_data = wp_generate_attachment_metadata( $attach_id, $file_loc );
        		wp_update_attachment_metadata( $attach_id, $attach_data );
		       return $attach_id;
    		}
    		return false;
		}
	}
}
?>