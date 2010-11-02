<?php
/*
include_once($_SERVER['DOCUMENT_ROOT'].'/lib/modxapi.php');
$modxapi = new MODxAPI();
$modxapi->connect();
$modxapi->getSettings();
*/
include($_SERVER['DOCUMENT_ROOT'].'/inc/force_non_secure.php');

include_once($_SERVER['DOCUMENT_ROOT'].'/models/Deal.php');

	switch($controller_action){
		
		case 'index':
//			if(!isset($_GET['test'])){ 
//				redirect_to("/index_uc.php");
//			}
	
			$PAGE_BODY 			= "views/index/index.php";						/* which file to pull into the template */
			
			$deals = Deal::get_active_deals();
			if ($deals != false) {
				$deal = $deals[0];
			} else {
				$deal_array = Deal::get_past_deals(1);
				$deal = $deal_array[0];
			}
						
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;
		
		case 'deal-on-deck':
			$PAGE_BODY 			= "views/index/modules/deal_on_deck.php";						/* which file to pull into the template */
			
			$deal = Deal::get_deal_on_deck();
			$deal_on_deck = $deal;
			
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;

	}
?>