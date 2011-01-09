<?php	
	if(!isset($_SESSION)){
		session_start();
	}
	
	require_once($_SERVER['DOCUMENT_ROOT']."/gir/index.php");
	include_once($_SERVER['DOCUMENT_ROOT'].'/models/Mailer.php');
	
	/* --------------------------------------------------
	Find All Users That Are "X" Days Out From Expiring
	----------------------------------------------------- */
	//using "subscription_end_date" find all users that are exactly "X" days from expiring
	$scrapper = new Scrapper();
	$scrappers = $scrapper->getScrappersUpForRenewal(date("Y-m-d 00:00:00"), 30);
	
	foreach($scrappers as $s){
		//send each an email reminder
		$object['fname'] = $s->first_name;
		$object['lname'] = $s->last_name;
		$object['email'] = $s->email;
		
		Mailer::expire_reminder_30($object);
		sleep(1);
	}
		
	/* --------------------------------------------------
	Find All Users That Expire Today
	----------------------------------------------------- */
	//using "subscription_end_date" find all users that expired today
	$scrapper = new Scrapper();
	$scrappers = $scrapper->getScrappersUpForRenewal(date("Y-m-d 00:00:00"), 0);
	
	foreach($scrappers as $s){
		//send each an email reminder
		$object['fname'] = $s->first_name;
		$object['lname'] = $s->last_name;
		$object['email'] = $s->email;
		
		Mailer::expire_reminder_0($object);
		sleep(1);
	
		//change status
		$s->status = "EXPIRED";
		unset($s->email); // because it gets added to the db for the scrapper object somehow otherwise.
		$s->UpdateItem();
	}
?>