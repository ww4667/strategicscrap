<?php
/*
include_once($_SERVER['DOCUMENT_ROOT'].'/models/Client.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/models/Price.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/models/Pricing.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/models/User.php');
*/

require_once $_SERVER['DOCUMENT_ROOT'].'/zend/library/Zend/Mail.php';

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

/**
 * Handles all Outbound Mail 
 * @package Core
 */

class Mailer{

	static function include_user_message_body($template,$email_contents_file,$object){
		ob_start(); //start the buffer
			$object=$object;
			$email_contents_file = $_SERVER['DOCUMENT_ROOT'].'/views/mailer/'.$email_contents_file.'.php';
			include($_SERVER['DOCUMENT_ROOT'].'/views/mailer/'.$template.'.php');
			$message = ob_get_contents();
		ob_end_clean();
		return $message;
	}
	
	static function welcome_email($i_object){
		$mail = new Zend_Mail();
		$mail->setFrom('do_not_reply@strategicscrap.com', 'Strategic Scrap');

		$mail->setSubject("Welcome To Strategic Scrap!");
		$mail->setBodyText("Welcome to Strategic Scrap! You've just signed up for the most powerful and comprehensive tool the scrap metal industry has ever seen. Pricing, market data, transportation hub and more are now at your fingertips! If you have any other questions, feel free to contact us at StrategicInfo@StrategicScrap.com.");
		$mail->addTo($i_object['email'], $i_object['fname'] . " " . $i_object['lname']);
		
		//include_user_message_body(TEMPLATE_TO_USE, BODY_FILE_TO_USE, OBJECT_FOR_POPULATING_EMAIL_CONTENTS)
		$message = Mailer::include_user_message_body("base_template","welcome",$i_object); //the template to use from /views/mailer (minus the ".php")
		
		//setting both bodyText AND bodyHtml sends a multipart message for people with text vs. html
		$mail->setBodyHtml($message);
		$mail->send();
	}

	static function expire_reminder_30($i_object){
		$mail = new Zend_Mail();
		$mail->setFrom('do_not_reply@strategicscrap.com', 'Strategic Scrap');

		$mail->setSubject("Your Strategic Scrap Trial Is Almost Over - Renew Today!");
		$mail->setBodyText("This is just a friendly reminder to let you know that you have 30 Days Left in your Strategic Scrap free trial. Don't miss out on all sorts of great stuff! Visit http://strategicscrap.com#PAYMENT and continue your membership!");
		$mail->addTo($i_object['email'], $i_object['fname'] . " " . $i_object['lname']);
		
		//include_user_message_body(TEMPLATE_TO_USE, BODY_FILE_TO_USE, OBJECT_FOR_POPULATING_EMAIL_CONTENTS)
		$message = Mailer::include_user_message_body("base_template","expire_reminder_30",$i_object); //the template to use from /views/mailer (minus the ".php")
		
		//setting both bodyText AND bodyHtml sends a multipart message for people with text vs. html
		$mail->setBodyHtml($message);
		$mail->send();
	}

	static function expire_reminder_7($i_object){
		$mail = new Zend_Mail();
		$mail->setFrom('do_not_reply@strategicscrap.com', 'Strategic Scrap');

		$mail->setSubject("Your Strategic Scrap Trial Is Almost Over - Renew Today!");
		$mail->setBodyText("This is just a friendly reminder to let you know that you have 7 Days Left in your Strategic Scrap free trial. Don't miss out on all sorts of great stuff! Visit https://strategicscrap.com/payment-information enter your payment information and continue your membership!");
		$mail->addTo($i_object['email'], $i_object['fname'] . " " . $i_object['lname']);
		
		//include_user_message_body(TEMPLATE_TO_USE, BODY_FILE_TO_USE, OBJECT_FOR_POPULATING_EMAIL_CONTENTS)
		$message = Mailer::include_user_message_body("base_template","expire_reminder_7",$i_object); //the template to use from /views/mailer (minus the ".php")
		
		//setting both bodyText AND bodyHtml sends a multipart message for people with text vs. html
		$mail->setBodyHtml($message);
		$mail->send();
	}

	static function expire_reminder_0($i_object){
		$mail = new Zend_Mail();
		$mail->setFrom('do_not_reply@strategicscrap.com', 'Strategic Scrap');

		$mail->setSubject("Your Strategic Scrap Trial Is Over - Renew Today!");
		$mail->setBodyText("There's still time to renew! We value your membership, and we are extending an incredible offer to you. Visit https://strategicscrap.com/payment-information to enter your payment information. Don't miss out!");
		$mail->addTo($i_object['email'], $i_object['fname'] . " " . $i_object['lname']);
		
		//include_user_message_body(TEMPLATE_TO_USE, BODY_FILE_TO_USE, OBJECT_FOR_POPULATING_EMAIL_CONTENTS)
		$message = Mailer::include_user_message_body("base_template","expire_reminder_0",$i_object); //the template to use from /views/mailer (minus the ".php")
		
		//setting both bodyText AND bodyHtml sends a multipart message for people with text vs. html
		$mail->setBodyHtml($message);
		$mail->send();
	}

	static function expiring_payment_method($i_object){
		$mail = new Zend_Mail();
		$mail->setFrom('do_not_reply@strategicscrap.com', 'Strategic Scrap');

		$mail->setSubject("Your Strategic Scrap Payment Method has Expired - Update Today!");
		$mail->setBodyText("In order for your subscription to renew, you need to visit https://strategicscrap.com/payment-information and update your payment method as it has expired.");
		$mail->addTo($i_object['email'], $i_object['fname'] . " " . $i_object['lname']);
		
		//include_user_message_body(TEMPLATE_TO_USE, BODY_FILE_TO_USE, OBJECT_FOR_POPULATING_EMAIL_CONTENTS)
		$message = Mailer::include_user_message_body("base_template","expiring_payment_method",$i_object); //the template to use from /views/mailer (minus the ".php")
		
		//setting both bodyText AND bodyHtml sends a multipart message for people with text vs. html
		$mail->setBodyHtml($message);
		$mail->send();
	}

	static function accepted_bid_alert($i_object){
		$mail = new Zend_Mail();
		$mail->setFrom('do_not_reply@strategicscrap.com', 'Strategic Scrap');

		$mail->setSubject("Your Transportation Bid has been accepted!");
		$mail->setBodyText("Use your broker dashboard to see your accepted bid so you can get it processed. Login at http://strategicscrap.com to see the details.");
		$mail->addTo($i_object['email'], $i_object['fname'] . " " . $i_object['lname']);
		
		//include_user_message_body(TEMPLATE_TO_USE, BODY_FILE_TO_USE, OBJECT_FOR_POPULATING_EMAIL_CONTENTS)
		$message = Mailer::include_user_message_body("base_template","accepted_bid",$i_object); //the template to use from /views/mailer (minus the ".php")
		
		//setting both bodyText AND bodyHtml sends a multipart message for people with text vs. html
		$mail->setBodyHtml($message);
		$mail->send();
	}

	static function added_bid_alert($i_object){
		$mail = new Zend_Mail();
		$mail->setFrom('do_not_reply@strategicscrap.com', 'Strategic Scrap');

		$mail->setSubject("A bid has been submitted to your transportation request!");
		$mail->setBodyText("Visit your regional homepage to see your requests and view your unread bids. Login at http://strategicscrap.com to see the details.");
		$mail->addTo($i_object['email'], $i_object['fname'] . " " . $i_object['lname']);
		
		//include_user_message_body(TEMPLATE_TO_USE, BODY_FILE_TO_USE, OBJECT_FOR_POPULATING_EMAIL_CONTENTS)
		$message = Mailer::include_user_message_body("base_template","added_bid",$i_object); //the template to use from /views/mailer (minus the ".php")
		
		//setting both bodyText AND bodyHtml sends a multipart message for people with text vs. html
		$mail->setBodyHtml($message);
		$mail->send();
	}

	static function scrap_broker_request($i_object){
		$mail = new Zend_Mail();
		$mail->setFrom('do_not_reply@strategicscrap.com', 'Strategic Scrap');
		$mail->setSubject("Strategic Scrap :: A bid request has been submitted from the Scrap Exchange");

		// Set plain text for email
		$request = $i_object->request_snapshot;
		$body_text = "The details of your bid request are below. Contact the requester directly with your bid for this request.";
		$body_text .= "\r\n\r\n";
		$body_text .= "Details:";
		$body_text .= "\r\n";
		$body_text .= "Contact: " . $request['scrapper']['first_name'] . " " . $request['scrapper']['last_name'];
		$body_text .= "\r\n\r\n";
		$body_text .= "Phone: " . isset($request['from']) ? $request['from']['from_work_phone'] : $request['scrapper']['work_phone'];
		$body_text .= "\r\n";
		$body_text .= "Email: " . $i_object->user['email'];
		$body_text .= "\r\n\r\n";
		$body_text .= "Material: " . $request['material']['name'];
		$body_text .= "\r\n";
		$body_text .= "Volume: " . $i_object->volume;
		$body_text .= "\r\n\r\n";
//		$body_text .= "Ship from:";
//		$body_text .= "\r\n";
//		$body_text .= $request['scrapper']['company'];
//		$body_text .= "\r\n";
//		$body_text .= $request['scrapper']['address_1'] . ", " . $request['scrapper']['address_2'] . ", " . $request['scrapper']['city'] . ", " . $request['scrapper']['state_province'] . " " . $request['scrapper']['postal_code'];
//		$body_text .= "\r\n\r\n";
//		$body_text .= "Ship to:";
//		$body_text .= $request['facility']['company'];
//		$body_text .= "\r\n";
//		$body_text .= $request['facility']['address_1'] . ", " . $request['facility']['address_2'] . ", " . $request['facility']['city'] . ", " . $request['facility']['state_province'] . " " . $request['facility']['zip_postal_code'];
//		$body_text .= "\r\n\r\n";
//		$body_text .= "Transportation Type: " . $request['transportation_type'];
//		$body_text .= "\r\n";
//		$body_text .= "Ship on or before: " . $request['ship_date'];
//		$body_text .= "\r\n";
//		$body_text .= "Deliver on or before: " . $request['deliver_date'];
//		$body_text .= "\r\n";
		$body_text .= "Special Instructions:";
		$body_text .= "\r\n";
		$body_text .= $i_object->special_instructions;

		$mail->setBodyText($body_text);
		$mail->addTo($request['facility']['email'], $request['facility']['first_name'] . " " . $request['facility']['last_name']);
		
		//include_user_message_body(TEMPLATE_TO_USE, BODY_FILE_TO_USE, OBJECT_FOR_POPULATING_EMAIL_CONTENTS)
		$message = Mailer::include_user_message_body("base_template","scrap_broker_request",$i_object); //the template to use from /views/mailer (minus the ".php")
		
		//setting both bodyText AND bodyHtml sends a multipart message for people with text vs. html
		$mail->setBodyHtml($message);
		$mail->send();
	}

	static function reset_password_email($i_object){
		$mail = new Zend_Mail();
		$mail->setFrom('do_not_reply@strategicscrap.com', 'Strategic Scrap');

		$mail->setSubject("Password Reset Request.");
        $mail->setBodyText("We've received your password reset request, please use the following url to reset your password - http://demo.strategicscrap.com/reset-password/?reset_key=" .  $i_object["password_reset"] . ".");
        $mail->addTo($i_object['email'],"Strategic Scrap Member");
		
		//include_user_message_body(TEMPLATE_TO_USE, BODY_FILE_TO_USE, OBJECT_FOR_POPULATING_EMAIL_CONTENTS)
		$message = Mailer::include_user_message_body("base_template","password_reset",$i_object); //the template to use from /views/mailer (minus the ".php")
		
		//setting both bodyText AND bodyHtml sends a multipart message for people with text vs. html
		$mail->setBodyHtml($message);
		$mail->send();
	}
	

	static function mail_chimp_subscribe($i_object){
		
		require_once ($_SERVER['DOCUMENT_ROOT'].'/lib/mailchimp/MCAPI.class.php');
		//API Key - see http://admin.mailchimp.com/account/api
		$apikey = '367b42529b6a4f0814cd3632a26a8808-us2';
		
		// A List Id to run examples against. use lists() to view all
		// Also, login to MC account, go to List, then List Tools, and look for the List ID entry
		$listId = '6a66c0881d';
		
		$api = new MCAPI($apikey);
					
		$merge_vars = array('FNAME'=>$i_object['fname'], 'LNAME'=>$i_object['lname']);
		
		// By default this sends a confirmation email - you will not see new members
		// until the link contained in it is clicked!
		$retval = $api->listSubscribe( $listId, $i_object["email"], $merge_vars );
		
		if ($api->errorCode){
			echo "Unable to load listSubscribe()!\n";
			echo "\tCode=".$api->errorCode."\n";
			echo "\tMsg=".$api->errorMessage."\n";
		} else {
		    echo "Subscribed - look for the confirmation email!\n";
		}
	}
}
?>