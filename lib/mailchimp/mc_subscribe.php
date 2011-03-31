<?php
/**
This Example shows how to Subscribe a New Member to a List using the MCAPI.php 
class and do some basic error checking.
**/
	require_once 'MCAPI.class.php';
 	//API Key - see http://admin.mailchimp.com/account/api
    $apikey = '367b42529b6a4f0814cd3632a26a8808-us2';
    
    // A List Id to run examples against. use lists() to view all
    // Also, login to MC account, go to List, then List Tools, and look for the List ID entry
    $listId = '6a66c0881d';
	$my_email = 'mike@slashwebstudios.com';
    

$api = new MCAPI($apikey);

$merge_vars = array('FNAME'=>'Test', 'LNAME'=>'Account');

// By default this sends a confirmation email - you will not see new members
// until the link contained in it is clicked!
$retval = $api->listSubscribe( $listId, $my_email, $merge_vars );

if ($api->errorCode){
	echo "Unable to load listSubscribe()!\n";
	echo "\tCode=".$api->errorCode."\n";
	echo "\tMsg=".$api->errorMessage."\n";
} else {
    echo "Subscribed - look for the confirmation email!\n";
}

?>
