<?php
	//Fetching Values...
	$firstname = $_REQUEST['txtfirstname'];
	$lastname = $_REQUEST['txtlastname'];
	$email = $_REQUEST['txtemailaddress'];
	$phone = $_REQUEST['txtphone'];
	$address1 = $_REQUEST['txtaddress1'];
	$address2 = $_REQUEST['txtaddress2'];
	$city = $_REQUEST['txtcity'];
	$state = $_REQUEST['txtstate'];
	$zip = $_REQUEST['txtzipcode'];
	$country = $_REQUEST['txtcountry'];
	$special = $_REQUEST['txtspecialreq'];
	$serids = !empty($_REQUEST['chkservice']) ? $_REQUEST['chkservice'] : array();
	
	$netamount = dt_theme_hb_net_amount($_REQUEST['room_id']);
	
	$checkin = $_COOKIE['checkin'];
	$checkout = $_COOKIE['checkout'];
	$adults = $_COOKIE['adults'];
	$childs = $_COOKIE['childs'];
	
	dt_theme_admin_payarrival_notify($firstname, $lastname, $email, $phone, $address1, $address2, $city, $state, $zip, $country, $special, $_REQUEST['hotel_id'], $_REQUEST['room_id'], $checkin, $checkout, $adults, $childs, $netamount);
	dt_theme_user_payarrival_notify($firstname, $lastname, $email, $phone, $address1, $address2, $city, $state, $zip, $country, $special, $_REQUEST['hotel_id'], $_REQUEST['room_id'], implode(',', $serids), $checkin, $checkout, $adults, $childs, $netamount);
	
	setcookie('checkin', "", (time()-3600), "/"); setcookie('checkout', "", (time()-3600), "/");
	setcookie('adults', "", (time()-3600), "/"); setcookie('childs', "", (time()-3600), "/");
	setcookie('hotelid', "", (time()-3600), "/"); setcookie('roomid', "", (time()-3600), "/");
	setcookie('serviceids', "", (time()-3600), "/"); setcookie('deppercent', "", (time()-3600), "/");
	
	wp_redirect( dt_theme_page_permalink_by_its_template('tpl-review.php').'?payarrival=true&fname='.$firstname.'&hid='.$_REQUEST['hotel_id'].'&rid='.$_REQUEST['room_id'].'&cin='.$checkin.'&cout='.$checkout );
	exit;
?>