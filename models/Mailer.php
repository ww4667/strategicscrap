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

	static function expire_reminder_0($i_object){
		$mail = new Zend_Mail();
		$mail->setFrom('do_not_reply@strategicscrap.com', 'Strategic Scrap');

		$mail->setSubject("Your Strategic Scrap Trial Is Over - Renew Today!");
		$mail->setBodyText("There's still time to renew! We value your membership, and we are extending an incredible offer to you. Visit http://strategicscrap.com to find out more. Don't miss out!");
		$mail->addTo($i_object['email'], $i_object['fname'] . " " . $i_object['lname']);
		
		//include_user_message_body(TEMPLATE_TO_USE, BODY_FILE_TO_USE, OBJECT_FOR_POPULATING_EMAIL_CONTENTS)
		$message = Mailer::include_user_message_body("base_template","expire_reminder_0",$i_object); //the template to use from /views/mailer (minus the ".php")
		
		//setting both bodyText AND bodyHtml sends a multipart message for people with text vs. html
		$mail->setBodyHtml($message);
		$mail->send();
	}

}
?>