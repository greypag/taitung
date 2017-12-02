<?php
//Get all dates between two dates
function dt_theme_get_all_dates($strDateFrom, $strDateTo)
{
    $aryRange=array();

    $iDateFrom = mktime( 1, 0, 0, substr( $strDateFrom, 5, 2 ), substr( $strDateFrom, 8, 2 ), substr( $strDateFrom, 0, 4 ) );
    $iDateTo = mktime( 1, 0, 0, substr( $strDateTo, 5, 2 ), substr( $strDateTo, 8, 2 ), substr ( $strDateTo, 0, 4 ) );

    if( $iDateTo >= $iDateFrom )
    {
        array_push( $aryRange, date( 'd-m-Y', $iDateFrom ) ); // first entry
        while( $iDateFrom < $iDateTo )
        {
            $iDateFrom += 86400; // add 24 hours
            array_push( $aryRange, date('d-m-Y', $iDateFrom ) );
        }
    }
    return $aryRange;
}

//Getting Currency Symbol
function dt_theme_currecy_symbol() {
	$hb_gs = get_option('hb_general_settings');
	$symbol = get_dt_theme_hb_currency_symbol($hb_gs['hb-general-currency']);
	if(!empty($symbol))
		return $symbol;
	else
		return '$';
}

//Getting Net Amount
function dt_theme_hb_net_amount($room_id = "") {
	$total_days = count(dt_theme_get_all_dates($_COOKIE['checkin'], $_COOKIE['checkout'])) - 1;
	$room_meta = get_post_meta($room_id, '_room_settings', true);	
	$rcost = $room_meta['room_price'];
	$net_amount = ($total_days * $rcost * $_COOKIE['adults']);
	
	return $net_amount;
}

//Getting Services Amount
function dt_theme_hb_service_amount($service_id = array()) {
	$service_amount = 0;
	$service_opts = get_option('hb_service_settings');

	if(count($service_id) > 0):
		foreach($service_id as $sid):
			$service_amount += $service_opts[$sid]['hb-service-price'];
		endforeach;
	endif;

	return $service_amount;
}

//Getting Services title by ids array
function dt_theme_hb_service_title($service_id = "") {
	$service_id = explode(',', $service_id);
	$titles = "";
	$currency = dt_theme_currecy_symbol();
	$serviceopts = get_option('hb_service_settings');
	
	foreach($service_id as $sid):
		$titles .= @$serviceopts[$sid]['hb-service-name'].' ['.$currency.@$serviceopts[$sid]['hb-service-price'].'], ';
	endforeach;
	
	return $titles;
}

//Admin Notify Section
function dt_theme_admin_notify($token, $fname, $lname, $email, $amount, $hotelid, $roomid, $checkin, $checkout, $adults, $childs, $percent, $netamount) {
	
	$tomail = get_bloginfo('admin_email');
	$currency = dt_theme_currecy_symbol();
	
	$out = '';
	$out .= '<p>New Reservation submitted, The details of reservation can be found below:</p>';
	
	$out .= '<table width="400" border="0" cellspacing="1" cellpadding="5" bgcolor="#666666">';
		$out .= '<tr>';
			$out .= '<th width="40%" scope="row" bgcolor="#CCCCCC">Order Number</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$token.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#CCCCCC">First Name</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$fname.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#CCCCCC">Last Name</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$lname.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#CCCCCC">Email Address</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$email.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#CCCCCC">Paid Amount</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$currency.' '.$amount.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#CCCCCC">Hotel</th>';
			$out .= '<td bgcolor="#FFFFFF">'.get_the_title($hotelid).'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#CCCCCC">Room</th>';
			$out .= '<td bgcolor="#FFFFFF">'.get_the_title($roomid).'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#CCCCCC">Booked Dates</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$checkin.' to '.$checkout.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#CCCCCC">No.of Persons</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$adults.' Adults, '.$childs.' Childs</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#CCCCCC">Deposit (%)</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$percent.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#CCCCCC">Net Amount</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$currency.' '.$netamount.'</td>';
		$out .= '</tr>';
	$out .= '</table>';
	
	add_filter( 'wp_mail_content_type', 'dt_theme_set_html_content_type');
	wp_mail( $tomail, 'New Customer Order Submitted', $out, 'From: '.$email );
	remove_filter( 'wp_mail_content_type', 'dt_theme_set_html_content_type' );
}

//User Notify Section
function dt_theme_user_notify($token, $fname, $email, $amount, $hotelid, $roomid, $sids, $checkin, $checkout, $adults, $childs, $percent, $netamount) {

	$frommail = get_bloginfo('admin_email');
	$currency = dt_theme_currecy_symbol();
	
	$out = '';
	$out .= 'Hi '.$fname.',<br>';
	$out .= '<p>Your Reservation confirmed, thanks! Details of your reservation can be found below:</p>';
	
	$out .= '<table width="400" border="0" cellspacing="1" cellpadding="5" bgcolor="#008282">';
		$out .= '<tr>';
			$out .= '<th width="40%" scope="row" bgcolor="#00D5D5">Order Number</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$token.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#00D5D5">Email Address</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$email.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#00D5D5">Paid Amount</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$currency.' '.$amount.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#00D5D5">Hotel</th>';
			$out .= '<td bgcolor="#FFFFFF">'.get_the_title($hotelid).'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#00D5D5">Room</th>';
			$out .= '<td bgcolor="#FFFFFF">'.get_the_title($roomid).'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#00D5D5">Additional Services</th>';
			$out .= '<td bgcolor="#FFFFFF">'.dt_theme_hb_service_title($sids).'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#00D5D5">Booked Dates</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$checkin.' to '.$checkout.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#00D5D5">No.of Persons</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$adults.' Adults, '.$childs.' Childs</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#00D5D5">Deposit (%)</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$percent.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#00D5D5">Net Amount</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$currency.' '.$netamount.'</td>';
		$out .= '</tr>';
	$out .= '</table>';

	add_filter( 'wp_mail_content_type', 'dt_theme_set_html_content_type');
	wp_mail( $email, 'Hotel Reservation Confirmed', $out, 'From: '.$frommail );
	remove_filter( 'wp_mail_content_type', 'dt_theme_set_html_content_type' );
}

//Admin Notify Section for PayArrival
function dt_theme_admin_payarrival_notify($fname, $lname, $email, $phone, $add1, $add2, $city, $state, $zip, $country, $special, $hotelid, $roomid, $checkin, $checkout, $adults, $childs, $netamount) {
	
	$tomail = get_bloginfo('admin_email');
	$currency = dt_theme_currecy_symbol();
	
	$out = '';
	$out .= '<p>New Email User Reservation submitted, The details of reservation can be found below:</p>';
	
	$out .= '<table width="400" border="0" cellspacing="1" cellpadding="5" bgcolor="#043d50">';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#a0dffa">First Name</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$fname.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#a0dffa">Last Name</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$lname.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#a0dffa">Email Address</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$email.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#a0dffa">Phone</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$phone.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#a0dffa">Address Line 1</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$add1.'<br>'.$city.'<br>'.$state.'<br>'.$country.' - '.$zip.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#a0dffa">Address Line 2</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$add2.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#a0dffa">Special Request</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$special.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#a0dffa">Hotel</th>';
			$out .= '<td bgcolor="#FFFFFF">'.get_the_title($hotelid).'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#a0dffa">Room</th>';
			$out .= '<td bgcolor="#FFFFFF">'.get_the_title($roomid).'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#a0dffa">Booked Dates</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$checkin.' to '.$checkout.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#a0dffa">No.of Persons</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$adults.' Adults, '.$childs.' Childs</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#a0dffa">Net Amount</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$currency.' '.$netamount.'</td>';
		$out .= '</tr>';
	$out .= '</table>';
	
	add_filter( 'wp_mail_content_type', 'dt_theme_set_html_content_type');
	wp_mail( $tomail, 'New Email Reservation Submitted', $out, 'From: '.$email );
	remove_filter( 'wp_mail_content_type', 'dt_theme_set_html_content_type' );
}

//User Notify Section for PayArrival
function dt_theme_user_payarrival_notify($fname, $lname, $email, $phone, $add1, $add2, $city, $state, $zip, $country, $special, $hotelid, $roomid, $sids, $checkin, $checkout, $adults, $childs, $netamount) {

	$frommail = get_bloginfo('admin_email');
	$currency = dt_theme_currecy_symbol();
	
	$out = '';
	$out .= 'Hi '.$fname.' '.$lname.',<br>';
	$out .= '<p>Your Reservation registered, thanks! Details of your reservation can be found below:</p>';
	
	$out .= '<table width="400" border="0" cellspacing="1" cellpadding="5" bgcolor="#71540d">';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#f4e0b0">Email Address</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$email.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#f4e0b0">Phone</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$phone.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#f4e0b0">Address Line 1</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$add1.'<br>'.$city.'<br>'.$state.'<br>'.$country.' - '.$zip.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#f4e0b0">Address Line 2</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$add2.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#f4e0b0">Special Request</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$special.'</td>';
		$out .= '</tr>';		
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#f4e0b0">Hotel</th>';
			$out .= '<td bgcolor="#FFFFFF">'.get_the_title($hotelid).'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#f4e0b0">Room</th>';
			$out .= '<td bgcolor="#FFFFFF">'.get_the_title($roomid).'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#f4e0b0">Additional Services</th>';
			$out .= '<td bgcolor="#FFFFFF">'.dt_theme_hb_service_title($sids).'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#f4e0b0">Booked Dates</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$checkin.' to '.$checkout.'</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#f4e0b0">No.of Persons</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$adults.' Adults, '.$childs.' Childs</td>';
		$out .= '</tr>';
		$out .= '<tr>';
			$out .= '<th scope="row" bgcolor="#f4e0b0">Net Amount</th>';
			$out .= '<td bgcolor="#FFFFFF">'.$currency.' '.$netamount.'</td>';
		$out .= '</tr>';
	$out .= '</table>';

	add_filter( 'wp_mail_content_type', 'dt_theme_set_html_content_type');
	wp_mail( $email, 'Hotel Reservation Registered', $out, 'From: '.$frommail );
	remove_filter( 'wp_mail_content_type', 'dt_theme_set_html_content_type' );
}

//Set Html Content Type
function dt_theme_set_html_content_type() {

	return 'text/html';
}

//Get Hotels List
function dt_theme_roomtype_list($id, $selected = '', $class = "mytheme_select") {
	$name = explode ( ",", $id );
	if (count ( $name ) > 1) {
		$name = "[{$name[0]}][{$name[1]}]";
	} else {
		$name = "[{$name[0]}]";
	}
	$name = ($class == "multidropdown") ? "mytheme{$name}[]" : "mytheme{$name}";
	$output = "<select name='{$name}' class='{$class}'>";
	$output .= "<option value=''>" . __ ( 'Select Room Type', 'iamd_text_domain' ) . "</option>";
	$myhotels = get_posts ( 'posts_per_page=-1&post_type=dt_rooms&order=ASC' );
	
	foreach ( $myhotels as $hotel ) : setup_postdata( $hotel );
		@$id = esc_attr ( $hotel->ID );
		@$title = esc_html ( $hotel->post_title );
		@$output .= "<option value='{$id}' " . selected ( $selected, $id, false ) . ">{$title}</option>";
	endforeach;
	
	wp_reset_postdata();
	$output .= "</select>\n";
	return $output;
}

//Load List of Cities
add_action("wp_ajax_dt_ajax_load_location_terms", "dt_ajax_load_location_terms");
add_action("wp_ajax_nopriv_dt_ajax_load_location_terms", "dt_ajax_load_location_terms");
function dt_ajax_load_location_terms() {
	
	$results = get_terms('hotel_locations', 'search='.$_GET['name_startsWith'].'');

	$data = array();
	foreach($results as $row) {
		array_push($data, $row->name.'|'.$row->term_id);
	}	
	echo json_encode($data);
	exit();
}

//Caluculate when Additional Services
add_action("wp_ajax_dt_theme_checkout_calculation", "dt_theme_checkout_calculation");
add_action("wp_ajax_nopriv_dt_theme_checkout_calculation", "dt_theme_checkout_calculation");
function dt_theme_checkout_calculation() {
	$netAmount = dt_theme_hb_net_amount($_REQUEST['room_id']); $disAmount = '';

	if(isset($_REQUEST['chkservice'])):
		$netAmount += dt_theme_hb_service_amount($_REQUEST['chkservice']);
	endif;
	
	$hb_general_settings = get_option('hb_general_settings');
	if($hb_general_settings['hb-general-enabledepositdue'] && $hb_general_settings['hb-general-depositpercent'] != ""):
		$disAmount = $netAmount * ($hb_general_settings['hb-general-depositpercent'] / 100);
	endif;
	
	$data = array();
	array_push($data, round($netAmount, 2).'|'.round($disAmount, 2));
	echo json_encode($data);
	exit();
} ?>