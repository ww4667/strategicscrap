<?php 
/**
 *
 * @author undead
 *
 */
 
class Scrapper extends User {

	protected $_OBJECT_NAME = "scrapper";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	array("type"=>"join","label"=>"Join User","field"=>"join_user"),
											array("type"=>"text","label"=>"Company","field"=>"company"),
											array("type"=>"text","label"=>"First Name","field"=>"first_name"),
											array("type"=>"text","label"=>"Last Name","field"=>"last_name"),
											array("type"=>"text","label"=>"Mobile Phone","field"=>"mobile_phone"),
											array("type"=>"text","label"=>"Home Phone","field"=>"home_phone"),
											array("type"=>"text","label"=>"Work Phone","field"=>"work_phone"),
											array("type"=>"text","label"=>"Fax Number","field"=>"fax_number"),
											array("type"=>"text","label"=>"Address 1","field"=>"address_1"),
											array("type"=>"text","label"=>"Address 2","field"=>"address_2"),
											array("type"=>"text","label"=>"City","field"=>"city"),
											array("type"=>"text","label"=>"State/Province","field"=>"state_province"),
											array("type"=>"text","label"=>"Postal Code","field"=>"postal_code"),
											array("type"=>"text","label"=>"Country","field"=>"country"),
											array("type"=>"text","label"=>"Notes","field"=>"notes"),
											array("type"=>"text","label"=>"Status","field"=>"status"),
											array("type"=>"date","label"=>"Subscription Start Date","field"=>"subscription_start_date"),
											array("type"=>"date","label"=>"Subscription End Date","field"=>"subscription_end_date"),
											array("type"=>"text","label"=>"Subscription Type","field"=>"subscription_type"),
											array("type"=>"text","label"=>"USAEPAY Customer Number","field"=>"customer_number"),
											array("type"=>"number","label"=>"Payment Method Status","field"=>"payment_method_status"),
											array("type"=>"text","label"=>"Account Settings","field"=>"account_settings")
										);
	
	function __construct(){
		parent::__construct();
		foreach($this->_OBJECT_PROPERTIES as $p) {
			$this->{$p['field']} = "";
		}
	}
	
	/*
	 * PUBLIC FUNCTIONS
	 */
	public function addUser( $userId = null ){
		$item = $this->GetCurrentItem();
		$user = $this->GetItem($userId);
		$this->SetCurrentItem($item); // need to reset Current item back to the facility
		if(count($user)>0){
			$user_join_property = null;
			$arr = $this->_OBJECT_PROPERTIES;
			$c = count($this->_OBJECT_PROPERTIES);
			$i = 0;
			while($i<$c){
				if( $arr[$i]['field'] == "join_user" ){
					$user_join_property = $arr[$i]['property_name_id'];
					break;
				}
				$i++;
			}
			$this->AddValueJoin($item['id'], $user_join_property, $userId);
		}
	}
	
	public function removeUser( $userId = null ){
		$user = $this->ReadObjectById($userId);
		if(count($user)>0){
			$item = $this->GetCurrentItem();
			$this->RemoveValueJoin($item['id'], $userId);
		}
		
	}
	
	public function getUsers( $itemId = null ) {
		// get materials by "itemId" and join type "material_join"
		$item = $this->GetCurrentItem();
		$itemId = $item['id'];
		$user = new User();
		$joins = $this->ReadJoins( $user );
		$this->join_user = $joins;
	}
	
	public function getAllWithUserDetails() {
		$scrapper_query = $this->GetObjectQueryString();
		$u = new User();
		$user_query = $u->GetObjectQueryString();
		$join_table = $this->_TABLE_PREFIX . constant('Crud::_VALUES_TABLE_JOINS');
		$query = "SELECT s.*,u.email,u.logged_in,u.last_login_ts";
		$query .= " FROM";
		$query .= " ($user_query) AS u,";
		$query .= " ($scrapper_query) AS s,";
		$query .= " $join_table AS j";
		$query .= " WHERE s.id = j.item_id AND u.id = j.value";
		return $this->Query( $query, true );
	}
	
	public function getScrappersByUserId( $userId ) {
		$u = new User();
		$user = $u->GetItemObj( $userId );
		if($user){
			$items = $this->ReadForeignJoins( $user );
			return $items;
		} else {
			return array();
		}
	}
	
	public function getScrapperByUserId( $userId ) {
		$u = new User();
		$user = $u->GetItemObj( $userId );
		if($user){
			$items = $this->ReadForeignJoins( $user );
			$obj = $this->GetItemObj( $items[0]['id'] );
			return $obj;
		} else {
			return false;
		}
	}

	public function getScrappersUpForRenewal( $compare_date, $days_out='30' ) {
		return $this->_getScrappersUpForRenewal( $compare_date, $days_out );
	}
	
	public function getExpiredScrappers( $compare_date, $days_out='0' ) {
		return $this->_getExpiredScrappers( $compare_date, $days_out );
	}
	
	public function sendExpiredCardNotifications( $data) {
		return $this->_sendExpiredCardNotifications( $data );
	}
	
	/**
	 * Returns array of all Requests made by the scrapper
	 * @return Object
	 * @example 
	 * $scrapperClass = new Scrapper();
	 * $scrapperByUserId = $scrapperClass->getScrappersByUserId( 105 ); //assumed user id
	 * $scrapperClass->GetItemObj( $scrapperByUserId[0]['id'] );
	 * $requestArray = $scrapperClass->getRequests();
	 */
	public function getRequests() {
		
//		$join_query = "SELECT jv.id, jv.value, jv.property_name_id, jv.item_id FROM ".$this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_JOINS')." as jv where jv.item_id = $itemId AND jv.value = $foreignItemId";
		
		// get materials by "itemId" and join type "material_join"
		$item = $this;
		
		$request = new Request();
		$joins = $request->ReadForeignJoins( $item );
		$requestReturnArray = array();
		
		$i = 0;
		while( $i < count($joins) ){
			$joins[$i]['request_snapshot'] = json_decode( $joins[$i]['request_snapshot'], true );
			// check for and set expired requests
			if( $joins[$i]['status'] == 0 || $joins[$i]['status'] == 1 ){
				$obj = $request->GetItemObj($joins[$i]['id']);
				if( $obj->IsExpired() ) {
					$joins[$i]['status'] == 3;
					$joins[$i]['locked'] == 1;
				}
			}
			
			$requestReturnArray[] = $joins[$i];
//			$ra = $joins[$i];
//			
//			$requestClass = new Request();
//			$requestClass->GetItemObj( $ra['id'] );
//			$requestClass->ReadJoins( new Material() );
//			$requestClass->ReadJoins( new Scrapper() );
//			$requestClass->ReadJoins( new Facility() );
			
//			$requestReturnArray[] = $requestClass;
			$i++;
		}
		
		return $requestReturnArray;
	}

	public function isAddressSet() {
		if ( empty($this->work_phone) || empty($this->company) || empty($this->address_1) || empty($this->city) || empty($this->state_province) || empty($this->postal_code) )
			return false;
		return true;
	}
	
	public function isPaymentMethodValid() {
		if ( empty($this->payment_method_status) || ($this->payment_method_status != 1))
			return false;
		return true;
	}

	public function isSubscriptionExpired() {
		if ( empty($this->subscription_end_date) || (strtotime($this->subscription_end_date) < strtotime(Date("m/d/Y"))))
			return true;
		return false;
	}
	
	public function getMarketData($symbol,$type = null) {
		
		$marketData = new stdClass;
		
		try{
			// LME DATA
			$xignite_header = new SoapHeader('http://www.xignite.com/services/', 'Header', array("Username" => "FDFDBEAF9B004b2eBB2D7A9D1D39F24F"));
			$client = new soapclient('http://globalfutures.xignite.com/xGlobalFutures.asmx?WSDL', array('trace' => 1));
			$client->__setSoapHeaders(array($xignite_header));
//	
//			$contracts = array(	'cash'			=> 0,
//								'three_month'	=> 3,
//								'fifteen_month'	=> 15	);
	
			$contracts = array(	'cash'			=> 0,
								'three_month'	=> 3	);
			
			$symbols = array(	'CU'	=> 'LME Copper',
								'AM'	=> 'LME Aluminum',
								'NI'	=> 'LME Nickel',
								'ZZ'	=> 'LME Zinc',
								'LD'	=> 'LME Lead',
								'TN'	=> 'LME Tin'	);
			
			
			foreach ($contracts as $option => $c) {
				foreach ($symbols as $symbol => $name) {
					$params = array(
									'Identifier'	=> $symbol,
									'Year'			=> '0',
									'Month'			=> $c,
									'Day'			=> '0',
									'Exchange'		=> 'LME',
									'Currency'		=> 'USD'
									);
					$result = $client->GetLMEFutureQuote($params);
					
					$tempObject = new stdClass;
					$tempObject->symbol = $symbol;
					$tempObject->material = $name;
					$tempObject->last = number_format($result->GetLMEFutureQuoteResult->Last/2204.62262,2);
					$tempObject->high = number_format($result->GetLMEFutureQuoteResult->High/2204.62262,2);
					$tempObject->low = number_format($result->GetLMEFutureQuoteResult->Low/2204.62262,2);
					$tempObject->open = number_format($result->GetLMEFutureQuoteResult->Open/2204.62262,2);
					$tempObject->previous_close = number_format($result->GetLMEFutureQuoteResult->PreviousClose/2204.62262,2);
					$tempObject->settle = number_format($result->GetLMEFutureQuoteResult->Settle/2204.62262,2);
//					$tempObject->change = number_format($result->GetLMEFutureQuoteResult->Change/2204.62262,2);
					$diff = $tempObject->last - $tempObject->previous_close;
					$tempObject->change = number_format($diff,2);
					$tempObject->change_percent = $result->GetLMEFutureQuoteResult->PercentChange;
					$marketData->{$option}[] = $tempObject;
				}
			}
			// COMEX DATA
			$xignite_header = new SoapHeader('http://www.xignite.com/services/', 'Header', array("Username" => "greg@slashwebstudios.com"));
			$client = new soapclient('http://www.xignite.com/xFutures.asmx?WSDL', array('trace' => 1));
			$client->__setSoapHeaders(array($xignite_header));
			
			// month year checker
			if(date("n")+3 > 12) {
				$month3 = date("n")-9;
				$year3 = date("Y")+1; 
				$month15 = date("n")-9;
				$year15 = date("Y")+2; 
			} else {
				$month3 = date("n")+3;
				$year3 = date("Y"); 
				$month15 = date("n")+3;
				$year15 = date("Y")+1; 
			}
//			
//			$contracts = array(	'cash'	=> array("month"=>"0","year"=>"0"),
//						'three_month'	=> array("month"=>$month3,"year"=>$year3),
//						'fifteen_month'	=> array("month"=>$month15,"year"=>$year15)	);
			
			$contracts = array(	'cash'	=> array("month"=>"0","year"=>"0"),
						'three_month'	=> array("month"=>$month3,"year"=>$year3)	);
			
			foreach ($contracts as $c => $data) {
				// create an array of parameters
				$param = array(
				               'Symbol' => "HG",
				               'Day' => "0",
				               'Month' => $data['month'],
				               'Year' => $data['year']
				);
				// call the service, passing the parameters and the name of the operation
				$result = $client->GetDelayedFuture($param);
				$tempObject = new stdClass;
				$tempObject->symbol = "HG";
				$tempObject->material = "COMEX Copper";
				$tempObject->last = number_format($result->GetDelayedFutureResult->Last,2);
				$tempObject->high = number_format($result->GetDelayedFutureResult->High,2);
				$tempObject->low = number_format($result->GetDelayedFutureResult->Low,2);
				$tempObject->open = number_format($result->GetDelayedFutureResult->Open,2);
				$tempObject->previous_close = number_format($result->GetDelayedFutureResult->PreviousClose,2);
				$tempObject->settle = number_format($result->GetDelayedFutureResult->Settle,2);
//				$tempObject->change = number_format($result->GetDelayedFutureResult->Change,2);
				$diff = $tempObject->last - $tempObject->open;
				$tempObject->change = number_format($diff,2);
				$tempObject->change_percent = $result->GetDelayedFutureResult->PercentChange;
				$marketData->{$c}[] = $tempObject;
			}
					
		} 
		 
		catch (SoapFault $e) { 
			$marketData->status = 0;
			$marketData->error = "Error loading feed data.";
			
		 } 
		  return $marketData; 
	}
    
	/*
	 * PRIVATE FUNCTIONS
	 */
    private function _privateFunction() {
    }
	
    private function _sendExpiredCardNotifications($data) {
		include_once($_SERVER['DOCUMENT_ROOT'].'/models/Mailer.php');
    		$u = new User();
    		$s = new Scrapper();
    		
    		foreach($data as $d){
    			$scrapper = $s->GetItemObj($d["scrapper_id"]);
				//$s->PTS($scrapper);
				if (!empty($scrapper)){
					$scrapper->payment_method_status = 2;
					$scrapper->UpdateItem();
					$users = $scrapper -> ReadJoins($u);
					$user = $users[0];
					$userId = $user["id"];
					$user = $u->GetItemObj( $userId );
					//convert time to m/d/Y for the email.
					$timestamp = strtotime($d["end_date"]);
					$d["end_date"] = date("m/d/Y", $timestamp);
					$d["email"] = $user->email;		
					Mailer::expiring_payment_method($d);
				}
    		}
    		
    	
    }
		
	private function _getScrappersUpForRenewal( $compare_date, $days_out ) {
		$scrappers_array = array();
		
		$query_date = date("Y-m-d 00:00:00",strtotime("+" . $days_out . " days",strtotime($compare_date)));
		
		$objectNameId = $this->_OBJECT_NAME_ID;
		
		$properties = $this->_OBJECT_PROPERTIES;
		$fields = ""; 
		foreach ($properties as $p) {
			if ($fields == "") {
				$fields .= " MAX(IF(pn.label='".$p['field']."', v.value, '')) AS `".$p['field']."`";
			} else {
				$fields .= ", MAX(IF(pn.label='".$p['field']."', v.value, '')) AS `".$p['field']."`";
			}
		}
		$query = "SELECT * FROM (SELECT o.id, o.created_ts, o.updated_ts, o.object_name_id,";
		$query .= $fields;
		$query .= " FROM " . $this->_TABLE_PREFIX.constant('Crud::_ITEMS') . " as o";
		$query .= " JOIN " . $this->_TABLE_PREFIX.constant('Crud::_OBJECT_DEFINITIONS') . " as od on od.object_name_id = o.object_name_id";
		$query .= " JOIN " . $this->_TABLE_PREFIX.constant('Crud::_PROPERTY_NAMES') . " as pn on pn.id = od.property_name_id";
		$query .= " JOIN 	(SELECT * FROM " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_DATES') . " UNION SELECT * FROM " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_NUMBERS') . " UNION SELECT * FROM " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_TEXT') . ") as v on v.property_name_id = od.property_name_id AND v.item_id = o.id";
		$query .= " WHERE o.object_name_id = $objectNameId";
		$query .= " GROUP BY o.id) as tbl";
		$query .= " WHERE subscription_end_date = '$query_date'";
		$query .= " AND (status = '' OR status = 'active')";
		
		$scrappers_array = $this->Query( $query, true );
		
		$output_array = array();
		foreach ($scrappers_array as $scrapper) {
			$s = new Scrapper();
			$s->GetItemObj($scrapper['id']);
			$user = new User();
			$users = $s->ReadJoins( $user );
			$s->join_user = '';
			$s->email = $users[0]['email'];
			$output_array[] = $s;
		}
		
		return $output_array;
	}
	
	private function _getExpiredScrappers( $compare_date, $days_out ) {
		$scrappers_array = array();
		
		$query_date = date("Y-m-d 00:00:00",strtotime("+" . $days_out . " days",strtotime($compare_date)));
		
		$objectNameId = $this->_OBJECT_NAME_ID;
		
		$properties = $this->_OBJECT_PROPERTIES;
		$fields = ""; 
		foreach ($properties as $p) {
			if ($fields == "") {
				$fields .= " MAX(IF(pn.label='".$p['field']."', v.value, '')) AS `".$p['field']."`";
			} else {
				$fields .= ", MAX(IF(pn.label='".$p['field']."', v.value, '')) AS `".$p['field']."`";
			}
		}
		$query = "SELECT * FROM (SELECT o.id, o.created_ts, o.updated_ts, o.object_name_id,";
		$query .= $fields;
		$query .= " FROM " . $this->_TABLE_PREFIX.constant('Crud::_ITEMS') . " as o";
		$query .= " JOIN " . $this->_TABLE_PREFIX.constant('Crud::_OBJECT_DEFINITIONS') . " as od on od.object_name_id = o.object_name_id";
		$query .= " JOIN " . $this->_TABLE_PREFIX.constant('Crud::_PROPERTY_NAMES') . " as pn on pn.id = od.property_name_id";
		$query .= " JOIN 	(SELECT * FROM " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_DATES') . " UNION SELECT * FROM " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_NUMBERS') . " UNION SELECT * FROM " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_TEXT') . ") as v on v.property_name_id = od.property_name_id AND v.item_id = o.id";
		$query .= " WHERE o.object_name_id = $objectNameId";
		$query .= " GROUP BY o.id) as tbl";
		$query .= " WHERE subscription_end_date <= '$query_date'";
		$query .= " AND (status = '' OR status = 'active')";
		
		//echo $query;
		$scrappers_array = $this->Query( $query, true );
		
		$output_array = array();
		foreach ($scrappers_array as $scrapper) {
			$s = new Scrapper();
			$s->GetItemObj($scrapper['id']);
			$user = new User();
			$users = $s->ReadJoins( $user );
			$s->join_user = '';
			$s->email = $users[0]['email'];
			$output_array[] = $s;
		}
		
		return $output_array;
	}
	
	private function _processPayment( $transaction, $options = null ) {
		require($_SERVER['DOCUMENT_ROOT'].'/lib/usaepay/usaepay.php');

		$clean = array();
		foreach ( $transaction as $t ) {
			$clean[] = trim( $t );
		}
		
		// Instantiate USAePay client object
		$tran=new umTransaction();
		
		$tran->command='authonly';		
		$tran->card=$clean['cardnum'];		
		$tran->exp=$clean['ccmonth'].$clean['ccyear'];			
		$tran->invoice="INVOICE12345";   		
		$tran->cardholder=$clean['cardname']; 	
		$tran->description="Strategic Scrap :: " . $description;
		// check for custom options
		$tran->amount = (!empty( $options['amount'] ) && isset( $options['amount'] ) ) ? $options['amount'] : "699.00";
		$tran->billamount = (!empty( $options['billamount'] ) && isset( $options['billamount'] ) ) ? $options['billamount'] : "699.00";
		$tran->discount = (!empty( $options['discount'] ) && isset( $options['discount'] ) ) ? $options['discount'] : "0";
		$tran->addcustomer = "Yes";
		$tran->schedule = "annually"; // daily, weekly, biweekly, monthly, bimonthly, quarterly, biannually, annually 
		// $tran->start = date("Ymd",strtotime("tomorrow")); // default is tomorrow if not set 
		// $tran->cvv2="435";		
		// $tran->ignoresslcerterrors = true;		
		/* customer details */
		$tran->billcompany = $clean['company'];
		$tran->billlname = $clean['last_name'];
		$tran->billfname = $clean['first_name'];
		$tran->billstreet = $clean['address_1'];
		$tran->billcity = $clean['city'];
		$tran->billstate = $clean['state'];
		$tran->billzip = $clean['zip'];
		$tran->email = $clean['email'];
		$tran->billphone = $clean['phone'];
		$tran->billcountry = "United States";
		
		if($tran->Process()){
			//Success
			return $tran;
		} else {
			//Fail
			return $tran->error;
		}
	}
}
?>