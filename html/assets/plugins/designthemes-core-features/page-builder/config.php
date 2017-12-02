<?php

global $default_posttypes, $dtthemes_columns, $dtthemes_sample_layouts, $text_config, $dt_modules, $enable_widget, $theme_name, $dtthemes_modules, $default_animation_type, $default_animation_delay, $enable_pb_default, $dt_module_titles, $dt_widget_titles, $dt_wp_editor, $enable_animation_effects;


/* Theme name to get our custom widgets */
$theme_data = wp_get_theme ();
$theme_name = $theme_data->get ( 'Name' );

/* Wordpress Default Editor Name */
$dt_wp_editor = esc_html__('Wordpress Editor', 'dt_themes');


/* Seperate modules into different categories */
$dtthemes_modules = $dt_modules;
$dt_module_titles = array(
	'general' => 'General',
	'unique' => 'Unique',
	'others' => 'Others', 
);

/* To split widgets into different categories provide search key(first 2 letters of widgets) */
$dt_widget_titles = array(
	'default_widget' => array('search_key' => '*', 'name' => 'WP Widgets'), // Use * to bring rest all widgets under this title
	'custom_widget' => array('search_key' => 'DT', 'name' => $theme_name.' Widgets'),
	'events_widget' => array('search_key' => 'Tr', 'name' => 'Events Widgets'),
	'woocommerce_widget' => array('search_key' => 'WC', 'name' => 'WooCommerce Widgets'),
);


/* Default animation type and animation delay for columns */
$default_animation_type = '';
$default_animation_delay = '';


/* Enable page builder as default while creating new page
   Switch between 0 / 1 */
$enable_pb_default = 0;

/* To enable animation effects for columns */
$enable_animation_effects = true;

/* To make widget droppable inside module */
$enable_widget = true;


/* Defalt post types to activate page builder */
$default_posttypes = array ();


/* Configure UI messages here.
   Note: Don't change any hook name in this array */ 
$text_config = array(
	'confirm_message' => esc_html__('Permanently delete this module?', 'dt_themes'), 
	'confirm_clear_all_message' => esc_html__('Permanently delete all modules?', 'dt_themes'), 
	'confirm_custom_layout_delete_message' => esc_html__('Permanently delete this layout?', 'dt_themes'), 
	'create_layout_name' => esc_html__('Layout Name', 'dt_themes'), 
	'create_layout_confirm_message_yes' => esc_html__('Create', 'dt_themes'), 
	'create_layout_confirm_message_no' => esc_html__('Cancel', 'dt_themes'), 
	'create_layout_description_text' => esc_html__('* new layout will appear under the Sample Layout tab after page update', 'dt_themes'), 
	'confirm_message_yes' => esc_html__('Yes', 'dt_themes'), 
	'confirm_message_no' => esc_html__('No', 'dt_themes'), 
	'saving_text' => esc_html__('Saving...', 'dt_themes'), 
	'layout_saved_text' => esc_html__('Layout Saved.', 'dt_themes'), 
	'customcss_saved_text' => esc_html__('Custom CSS Saved.', 'dt_themes'), 
	'columnoptions_saved_text' => esc_html__('Column Options Saved.', 'dt_themes'),
	'sectionoptions_saved_text' => esc_html__('Section Options Saved.', 'dt_themes')
);


/* Configure any number of Sample Layout here */

$dir = plugin_dir_path ( __FILE__ ) . "samplelayouts/";

if (is_dir ( $dir )) {
	if(count(scandir($dir)) > 2) {
		foreach( glob( $dir . "*.txt" ) as $filepath )
		{
		
			$content = file_get_contents($filepath);
			$fn = explode('/', $filepath);
			$fn = $fn[count($fn)-1];
			$fn = explode('.', $fn);
			$filename = $fn[0];
			
			$ft = explode('-', $filename);
			$filetitle = '';
			
			foreach($ft as $x) {
				$filetitle .= ucfirst($x).' ';	
			}
			
			$dtthemes_sample_layouts[$filename] = array(
				'name' => $filetitle,
				'content' => $content
			);
			
		}
	}
}

?>