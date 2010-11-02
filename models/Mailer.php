<?php

class Mailer{
	
	static function welcome_client_doc_prep($i_client){
//		$to = $i_client->email . ", brett@slashwebstudios.com";
		$to = $i_client->email . ", info@hawkeyedivorce.com";
		$subject = "Welcome to HawkeyeDivorce.com";
		$message = Mailer::include_message_body("welcome_client_doc_prep",$i_client);
		$from = "do_not_reply@HawkeyeDivorce.com";
		$headers = "From: Hawkeye Divorce <$from>\n";
		$headers .= "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\n";
		$headers .= "Reply-To: Hawkeye Divorce <do_not_reply@HawkeyeDivorce.com>\n";
		$headers .= "X-Priority: 1\n";
		$headers .= "X-MSMail-Priority: High\n";
		$headers .= "X-Mailer: HawkeyeDivorce.com";
		mail($to,$subject,$message,$headers);
	}

	static function welcome_client_full_service($i_client){
//		$to = $i_client->email . ", brett@slashwebstudios.com";
		$to = $i_client->email . ", info@hawkeyedivorce.com";
		$subject = "Welcome to HawkeyeDivorce.com";
		$message = Mailer::include_message_body("welcome_client_full_service",$i_client);
		$from = "do_not_reply@HawkeyeDivorce.com";
		$headers = "From: Hawkeye Divorce <$from>\n";
		$headers .= "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\n";
		$headers .= "Reply-To: Hawkeye Divorce <do_not_reply@HawkeyeDivorce.com>\n";
		$headers .= "X-Priority: 1\n";
		$headers .= "X-MSMail-Priority: High\n";
		$headers .= "X-Mailer: HawkeyeDivorce.com";
		mail($to,$subject,$message,$headers);
	}
	
	static function include_message_body($i_file,$i_object){
		ob_start(); //start the buffer
			$object = $i_object;
			include($_SERVER['DOCUMENT_ROOT'].'/views/mailer/'.$i_file.'.php');
			$message = ob_get_contents();
		ob_end_clean();
		return $message;
	}

}

?>