<?php

require_once ("paypalfunctions.php");
$hb_general_settings = get_option('hb_general_settings');
// ==================================
// PayPal Express Checkout Module
// ==================================

//'------------------------------------
//' The paymentAmount is the total value of 
//' the shopping cart, that was set 
//' earlier in a session variable
//' by the shopping cart page
//'------------------------------------
$paymentAmount = dt_theme_hb_net_amount($_REQUEST['room_id']);
if(isset($_REQUEST['chkservice'])):
	$paymentAmount += dt_theme_hb_service_amount($_REQUEST['chkservice']);
endif;	

if($hb_general_settings['hb-general-enabledepositdue'] && $hb_general_settings['hb-general-depositpercent'] != ""):
	$paymentAmount = $paymentAmount * ($hb_general_settings['hb-general-depositpercent'] / 100);
	setcookie('deppercent', $hb_general_settings['hb-general-depositpercent'], (time()+3600), "/");
endif;

setcookie('hotelid', $_REQUEST['hotel_id'], (time()+3600), "/");
setcookie('roomid', $_REQUEST['room_id'], (time()+3600), "/");

if(isset($_REQUEST['chkservice'])):
	setcookie('serviceids', implode(',', $_REQUEST['chkservice']), (time()+3600), "/");
endif;	

$itemName = get_the_title($_REQUEST['hotel_id']).' : '.get_the_title($_REQUEST['room_id']);
$itemDescription = $_COOKIE['checkin']. ' to ' .$_COOKIE['checkout'];

//'------------------------------------
//' The currencyCodeType and paymentType
//' are set to the selections made on the Integration Assistant
//'------------------------------------
$currencyCodeType = "USD";
$paymentType = "Sale";

//'------------------------------------
//' The returnURL is the location where buyers return to when a
//' payment has been succesfully authorized.
//'
//' This is set to the value entered on the Integration Assistant 
//'------------------------------------
$returnURL = $hb_general_settings['hb-general-paypalreturn'];

//'------------------------------------
//' The cancelURL is the location buyers are sent to when they hit the
//' cancel button during authorization of payment during the PayPal flow
//'
//' This is set to the value entered on the Integration Assistant 
//'------------------------------------
$cancelURL = $hb_general_settings['hb-general-paypalcancel'];

//'------------------------------------
//' Calls the SetExpressCheckout API call
//'
//' The CallShortcutExpressCheckout function is defined in the file PayPalFunctions.php,
//' it is included at the top of this file.
//'-------------------------------------------------

$resArray = CallShortcutExpressCheckout ( round($paymentAmount, 2), $currencyCodeType, $paymentType, $returnURL, $cancelURL, $itemName, $itemDescription );
$ack = strtoupper($resArray["ACK"]);
if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
{
	RedirectToPayPal ( $resArray["TOKEN"] );
} 
else  
{
	//Display a user friendly Error on the page using any of the following error information returned by PayPal
	$ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
	$ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
	$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
	$ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
	
	echo "SetExpressCheckout API call failed. ";
	echo "Detailed Error Message: " . $ErrorLongMsg;
	echo "Short Error Message: " . $ErrorShortMsg;
	echo "Error Code: " . $ErrorCode;
	echo "Error Severity Code: " . $ErrorSeverityCode;
}
?>