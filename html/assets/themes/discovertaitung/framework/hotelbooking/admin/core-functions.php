<?php
/**
 * Hotels Booking Core Functions.
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Get full list of currency codes.
 * @return array
 */
function get_dt_theme_hb_currencies() {
	return array_unique(
		apply_filters( 'dt_theme_hb_currencies',
			array(
				'AED' => __( 'United Arab Emirates Dirham', 'iamd_text_domain' ),
				'AUD' => __( 'Australian Dollars', 'iamd_text_domain' ),
				'BDT' => __( 'Bangladeshi Taka', 'iamd_text_domain' ),
				'BRL' => __( 'Brazilian Real', 'iamd_text_domain' ),
				'BGN' => __( 'Bulgarian Lev', 'iamd_text_domain' ),
				'CAD' => __( 'Canadian Dollars', 'iamd_text_domain' ),
				'CLP' => __( 'Chilean Peso', 'iamd_text_domain' ),
				'CNY' => __( 'Chinese Yuan', 'iamd_text_domain' ),
				'COP' => __( 'Colombian Peso', 'iamd_text_domain' ),
				'CZK' => __( 'Czech Koruna', 'iamd_text_domain' ),
				'DKK' => __( 'Danish Krone', 'iamd_text_domain' ),
				'EUR' => __( 'Euros', 'iamd_text_domain' ),
				'HKD' => __( 'Hong Kong Dollar', 'iamd_text_domain' ),
				'HRK' => __( 'Croatia kuna', 'iamd_text_domain' ),
				'HUF' => __( 'Hungarian Forint', 'iamd_text_domain' ),
				'ISK' => __( 'Icelandic krona', 'iamd_text_domain' ),
				'IDR' => __( 'Indonesia Rupiah', 'iamd_text_domain' ),
				'INR' => __( 'Indian Rupee', 'iamd_text_domain' ),
				'ILS' => __( 'Israeli Shekel', 'iamd_text_domain' ),
				'JPY' => __( 'Japanese Yen', 'iamd_text_domain' ),
				'KRW' => __( 'South Korean Won', 'iamd_text_domain' ),
				'MYR' => __( 'Malaysian Ringgits', 'iamd_text_domain' ),
				'MXN' => __( 'Mexican Peso', 'iamd_text_domain' ),
				'NGN' => __( 'Nigerian Naira', 'iamd_text_domain' ),
				'NOK' => __( 'Norwegian Krone', 'iamd_text_domain' ),
				'NZD' => __( 'New Zealand Dollar', 'iamd_text_domain' ),
				'PHP' => __( 'Philippine Pesos', 'iamd_text_domain' ),
				'PLN' => __( 'Polish Zloty', 'iamd_text_domain' ),
				'GBP' => __( 'Pounds Sterling', 'iamd_text_domain' ),
				'RON' => __( 'Romanian Leu', 'iamd_text_domain' ),
				'RUB' => __( 'Russian Ruble', 'iamd_text_domain' ),
				'SGD' => __( 'Singapore Dollar', 'iamd_text_domain' ),
				'ZAR' => __( 'South African rand', 'iamd_text_domain' ),
				'SEK' => __( 'Swedish Krona', 'iamd_text_domain' ),
				'CHF' => __( 'Swiss Franc', 'iamd_text_domain' ),
				'TWD' => __( 'Taiwan New Dollars', 'iamd_text_domain' ),
				'THB' => __( 'Thai Baht', 'iamd_text_domain' ),
				'TRY' => __( 'Turkish Lira', 'iamd_text_domain' ),
				'USD' => __( 'US Dollars', 'iamd_text_domain' ),
				'VND' => __( 'Vietnamese Dong', 'iamd_text_domain' ),
			)
		)
	);
}

/**
 * Get Currency symbol.
 * @param string $currency (default: '')
 * @return string
 */
function get_dt_theme_hb_currency_symbol( $currency = '' ) {
	if ( ! $currency ) {
		$currency = get_option('dt_theme_hb_currency');
	}

	switch ( $currency ) {
		case 'AED' :
			$currency_symbol = 'د.إ';
			break;
		case 'BDT':
			$currency_symbol = '&#2547;&nbsp;';
			break;
		case 'BRL' :
			$currency_symbol = '&#82;&#36;';
			break;
		case 'BGN' :
			$currency_symbol = '&#1083;&#1074;.';
			break;
		case 'AUD' :
		case 'CAD' :
		case 'CLP' :
		case 'MXN' :
		case 'NZD' :
		case 'HKD' :
		case 'SGD' :
		case 'USD' :
			$currency_symbol = '&#36;';
			break;
		case 'EUR' :
			$currency_symbol = '&euro;';
			break;
		case 'CNY' :
		case 'RMB' :
		case 'JPY' :
			$currency_symbol = '&yen;';
			break;
		case 'RUB' :
			$currency_symbol = '&#1088;&#1091;&#1073;.';
			break;
		case 'KRW' : $currency_symbol = '&#8361;'; break;
		case 'TRY' : $currency_symbol = '&#84;&#76;'; break;
		case 'NOK' : $currency_symbol = '&#107;&#114;'; break;
		case 'ZAR' : $currency_symbol = '&#82;'; break;
		case 'CZK' : $currency_symbol = '&#75;&#269;'; break;
		case 'MYR' : $currency_symbol = '&#82;&#77;'; break;
		case 'DKK' : $currency_symbol = 'kr.'; break;
		case 'HUF' : $currency_symbol = '&#70;&#116;'; break;
		case 'IDR' : $currency_symbol = 'Rp'; break;
		case 'INR' : $currency_symbol = 'Rs.'; break;
		case 'ISK' : $currency_symbol = 'Kr.'; break;
		case 'ILS' : $currency_symbol = '&#8362;'; break;
		case 'PHP' : $currency_symbol = '&#8369;'; break;
		case 'PLN' : $currency_symbol = '&#122;&#322;'; break;
		case 'SEK' : $currency_symbol = '&#107;&#114;'; break;
		case 'CHF' : $currency_symbol = '&#67;&#72;&#70;'; break;
		case 'TWD' : $currency_symbol = '&#78;&#84;&#36;'; break;
		case 'THB' : $currency_symbol = '&#3647;'; break;
		case 'GBP' : $currency_symbol = '&pound;'; break;
		case 'RON' : $currency_symbol = 'lei'; break;
		case 'VND' : $currency_symbol = '&#8363;'; break;
		case 'NGN' : $currency_symbol = '&#8358;'; break;
		case 'HRK' : $currency_symbol = 'Kn'; break;
		default    : $currency_symbol = ''; break;
	}

	return $currency_symbol;
}

/**
 * Get Available Rooms.
 * @param string hotel_id
 * @return string
 */
add_action("wp_ajax_dt_theme_hbroom_available_lists", "dt_theme_hbroom_available_lists");
function dt_theme_hbroom_available_lists() {
	$hotelid = $_REQUEST['hotel_id'];
	
	if($hotelid != NULL) {
		$out = '';
		$hotel_settings = get_post_meta ( $hotelid, '_hotel_settings', TRUE );
		
		if(array_key_exists("room-types",$hotel_settings)):
			$out .= '<option value="">'.__('Choose Room Type', 'iamd_text_domain').'</option>';
			
            $room_list = array_filter(array_unique($hotel_settings["room-types"]));
            foreach($room_list as $room):
				$out .= '<option value="'.$room.'">'.get_the_title($room).'</option>';
			endforeach;
		endif;
		
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			echo $out;
		} 
		else {
			header("Location: ".$_SERVER["HTTP_REFERER"]);
		}
		die(1);
	}
}

/**
 * Get Unavailable Dates.
 * @param string hotel_id, room_id
 * @return string
 */
add_action("wp_ajax_dt_theme_hbroom_unavailable_dates", "dt_theme_hbroom_unavailable_dates");
function dt_theme_hbroom_unavailable_dates() {
	$hotelid = $_REQUEST['hotel_id'];
	$roomid = $_REQUEST['room_id'];
	
	if($roomid != NULL) {
		$availableoptions = get_option('hb_available_settings');
		$udates = $availableoptions[$hotelid][$roomid];
		
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			echo $udates;
		} 
		else {
			header("Location: ".$_SERVER["HTTP_REFERER"]);
		}
		die(1);
	}
}

/**
 * Set Unavailable Dates.
 * @param string room_id & sel_dates
 * @return string
 */
add_action("wp_ajax_dt_theme_hbroom_set_unavailable", "dt_theme_hbroom_set_unavailable");
function dt_theme_hbroom_set_unavailable() {
	$hotelid = $_REQUEST['hotel_id'];
	$roomid = $_REQUEST['room_id'];
	$sdates = $_REQUEST['sdates'];
	
	if($roomid != NULL && $sdates != NULL) {
		$availableoptions = get_option('hb_available_settings');
		$udates = $availableoptions[$hotelid][$roomid];
		$udates = $udates.','.$sdates;
		$udates = explode(',', $udates);
		$udates = array_filter($udates);
		$udates = implode(',', $udates);
		$availableoptions[$hotelid][$roomid] = $udates;
		update_option('hb_available_settings', $availableoptions);
		
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			echo $udates;
		} 
		else {
			header("Location: ".$_SERVER["HTTP_REFERER"]);
		}
		die(1);
	}
}

/**
 * Clear Unavailable Dates.
 * @param string room_id
 * @return string
 */
add_action("wp_ajax_dt_theme_hbroom_clear_unavailable", "dt_theme_hbroom_clear_unavailable");
function dt_theme_hbroom_clear_unavailable() {
	$hotelid = $_REQUEST['hotel_id'];
	$roomid = $_REQUEST['room_id'];
	
	if($roomid != NULL) {
		$alldates = get_option('hb_available_settings');
		unset($alldates[$hotelid][$roomid]);
		update_option('hb_available_settings', $alldates);
		
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			echo '';
		} 
		else {
			header("Location: ".$_SERVER["HTTP_REFERER"]);
		}
		die(1);
	}
} ?>