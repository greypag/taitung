<?php ob_start();
/** create_admin_menu()
  * Objective:
  *		Hook to create thme option page at back end.
**/
function create_admin_menu() {

	$role = get_role('administrator');
	if(!$role->has_cap('manage_theme')) $role->add_cap('manage_theme');

    if( function_exists('add_menu_page') )
		add_menu_page (IAMD_THEME_NAME.' - '.__('settings','iamd_text_domain'),IAMD_THEME_NAME,'manage_theme','parent','dt_theme_options_page', '', 25);

	if(function_exists('add_submenu_page'))
		add_submenu_page ('parent',IAMD_THEME_NAME.' - '.__("options",'iamd_text_domain'),__('Options','iamd_text_domain'),'manage_theme','parent','dt_theme_options_page');

	#Hotel Booking Menu Starts...
	if(function_exists('add_submenu_page') && dt_theme_option('general', 'disable-hotel-booking') != "on") {
		add_submenu_page( 'edit.php?post_type=dt_hotels', __('Rooms', 'iamd_text_domain'), __('Rooms', 'iamd_text_domain'), 'edit_posts', 'edit.php?post_type=dt_rooms', '');
		add_submenu_page( 'edit.php?post_type=dt_hotels', __('General Settings', 'iamd_text_domain'), __('General Settings', 'iamd_text_domain'), 'manage_options', 'generalsettings', 'dt_theme_hb_general_page');
		add_submenu_page( 'edit.php?post_type=dt_hotels', __('Rooms Availability', 'iamd_text_domain'), __('Rooms Availability', 'iamd_text_domain'), 'manage_options', 'availablesettings', 'dt_theme_hb_available_page');
		add_submenu_page( 'edit.php?post_type=dt_hotels', __('Additional Services', 'iamd_text_domain'), __('Additional Services', 'iamd_text_domain'), 'manage_options', 'servicesettings', 'dt_theme_hb_service_page');
		add_submenu_page( 'edit.php?post_type=dt_hotels', __('Order Details', 'iamd_text_domain'), __('Order Details', 'iamd_text_domain'), 'manage_options', 'ordersettings', 'dt_theme_hb_order_page');
	}
	#Hotel Booking Menu Ends...
}
### --- ****  create_admin_menu() *** --- ###
add_action('admin_menu', 'create_admin_menu');
$template_uri = get_template_directory().'/framework';

require_once($template_uri.'/theme_options/settings.php');

#Hotel Booking File Starts...
require_once($template_uri.'/hotelbooking/generalsettings.php');
require_once($template_uri.'/hotelbooking/availablesettings.php');
require_once($template_uri.'/hotelbooking/servicesettings.php');
require_once($template_uri.'/hotelbooking/ordersettings.php');

require_once($template_uri.'/hotelbooking/admin/core-functions.php');
require_once($template_uri.'/hotelbooking/frontend-functions.php');
#Hotel Booking File Ends...
#ob_flush();?>