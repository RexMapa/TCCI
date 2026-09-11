<?php

$webmaster_email = "info@tccimmigration.com";

$contact_page = "contact.html";
$error_page = "error.html";
$success_page = "success.html";

$email_address = $_REQUEST['email_address'] ;
$first_name = $_REQUEST['first_name'] ;
$phone_number = $_REQUEST['phone_number'];
$destination =$_REQUEST['destination'];
$client_nationality = $_REQUEST['client_nationality'];
$client_education = $_REQUEST['client_education'];
$client_occupation = $_REQUEST['client_occupation'];
$msg = 
"Name: " . $first_name . "\r\n" . 
"Email: " . $email_address . "\r\n" . 
"Phone:" . $phone_number . "\r\n" .
"Destination:" . $destination . "\r\n" .
"Nationality:" . $client_nationality . "\r\n" . 
"Education:" . $client_education . "\r\n" . 
"Occupation:" . $client_occupation ;

function isInjected($str) {
	$injections = array('(\n+)',
	'(\r+)',
	'(\t+)',
	'(%0A+)',
	'(%0D+)',
	'(%08+)',
	'(%09+)'
	);
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	if(preg_match($inject,$str)) {
		return true;
	}
	else {
		return false;
	}
}

if (!isset($_REQUEST['email_address'])) {
header( "Location: $contact_page" );
}

elseif (empty($first_name) || empty($email_address)) {
header( "Location: $error_page" );
}

elseif ( isInjected($email_address) || isInjected($first_name) || isInjected($phone_number) || isInjected($destination) || isInjected($client_nationality) || isInjected($client_education) || isInjected($client_occupation)) {
header( "Location: $error_page" );
}

else {

	mail( "$webmaster_email", "Client Message", $msg );

	header( "Location: $success_page" );
}
?>