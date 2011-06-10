<?php 
/**
 * 
 * @author mr_kelly
 *
 *	To initiate the class pass the following as an array
 		source_key
 		source_pin
 		payment_info (Short Info about charge)
 		
 	To Charge Card use send_payment_transaction_soap() and pass the following as an array of values
		address_1
		address_2
		card_code
		cardholder_name (Name on Card)
		card_number
		ccmonth
		ccyear
		city
		company
		email
		first_name
		last_name
		phone
		state
		trans_amount
		trans_description
		zip
		
		IF recurring use the following
			recurring (set to true)
			trans_recur_description
			trans_recur_enabled
			trans_recur_schedule
	
	To Update Card info use update_epay_payment_method() and pass the following as an array of values
		usa_epay_id
		ccmonth
		ccyear
		card_number
		
	To Retrieve a list of customers with expiring cards before the next billing cycle occurs
		get_expired_before_next_billing()
		returns an array of customer numbers
		
 */

class Payment {
	
	public $source_key;
	public $source_pin;
	public $payment_info;
	
	function __construct($data){
		$this->source_key=$data['source_key'];
		$this->source_pin=$data['source_pin'];
		$this->payment_info=$data['payment_info'];
	}

	function start_epay_soap(){
		//echo $this->source_key;
		$item = array();
		
		//for live server use 'www' for test server use 'sandbox'0AE595C1
	  	$wsdl='http://sandbox.usaepay.com/soap/gate/0AE595C1/usaepay.wsdl';
	 
	  	// instantiate SoapClient object as $client
	  	$client = new SoapClient($wsdl);
	  	
		// generate random seed value
		$seed=mktime() . rand();
		 
		// make hash value using sha1 function
		$clear= $this->source_key . $seed . $this->source_pin;
		$hash=sha1($clear);
		 
		// assembly ueSecurityToken as an array
		$token=array(
			'SourceKey'=>$this->source_key,
			'PinHash'=>array(
		     	'Type'=>'sha1',
		     	'Seed'=>$seed,
		     	'HashValue'=>$hash
		   	),
			'ClientIP'=>$_SERVER['REMOTE_ADDR'],
		);
		
		$item["client"] = $client;
		$item["token"] = $token;
		
		return $item;
		
	}
	
	function send_payment_transaction_soap($data){
		
		try {
		
			$invoice_id = strtotime( date("F j, Y, g:i a") );
			$epay = Payment::start_epay_soap();
					
			//print "<pre>";
			//print_r($data);				
			//print "</pre>";
			
			$Address=array(
			  'City' => $data['city'],
			  'Company' => $data['company'],
			  'Country' => 'US',
			  'Email' => $data['email'],
			  'FirstName' => $data['first_name'],
			  'LastName' => $data['last_name'],
			  'Phone' => $data['phone'],
			  'State' => $data['state'],
			  'Street' => $data['address_1'],
			  'Street2' => $data['address_2'],
			  'Zip' => $data['zip']
			);
			 
			$Request=array(
			  'Command' => 'Sale',
			  'Details' => array(
			        'Amount' => $data["trans_amount"],
				'Clerk' => $data['card_holder_name'],
				'Currency' => '0',
				'Description' => $this->payment_info . $data["trans_description"],
				'Invoice' => $invoice_id),
			  'BillingAddress' => $Address,
			  'ShippingAddress' => $Address,
			  'CreditCardData' => array(
				'CardNumber' => $data['card_number'],
				'CardExpiration' => $data['ccmonth'].$data['ccyear'],
				'AvsStreet' => $data['address'],
				'AvsZip' => $data['zip'],
				'CardCode' => $data['card_code'])
			);		
			
			$Response=$epay["client"]->runTransaction($epay["token"], $Request);
	 		//$custnum = $client->convertTranToCust($token, $Response->RefNum, $RecurringBillData);
			
			if ($data["recurring"]){
				$RecurringBillData = array(
					array('Field'=>'NumLeft', 'Value'=>'*'),
					array('Field'=>'Amount', 'Value'=>$data["trans_amount"]),
					array('Field'=>'Description', 'Value'=>$data["trans_recur_description"]),
					array('Field'=>'Schedule', 'Value'=>$data["trans_recur_schedule"]),
					array('Field'=>'Enabled', 'Value'=>$data["trans_recur_enabled"])
				);	
			 
				$custnum = $epay["client"]->convertTranToCust($epay["token"], $Response->RefNum, $RecurringBillData);	
			
			}
			
			$TransactionObject=$epay["client"]->getTransaction($epay["token"], $Response->RefNum);
			
			//echo "<pre>";
			//print_r($TransactionObject);
			//echo "</pre>";
		
			if ($TransactionObject->Response->ErrorCode == 0){
				
				$status["customernumber"] = $custnum;
				//$status["cardnumber"] = $TransactionObject->CreditCardData->CardNumber;
				//$status["refnum"] = $Response->RefNum;
				$status["message"] = "Your payment has been approved";
				$status["success"] = true;
				
			} else {
				
				$status["error"] = $TransactionObject->Response->Error;
				$status["success"] = false;
				
			}
		} 
		 
		catch (SoapFault $e) { 
			$status["error"] = "There was an error processing your request: " . $e->getMessage();
			$status["success"] = false;
		}
		
		return $status;					
								
	}
	
	function get_epay_customer_info($custnum){
		
		try{
			$epay = Payment::start_epay_soap();
	
			$customer = $epay["client"]->getCustomer($epay["token"],$custnum);			
  
	  		return $customer;
		}
		
		catch(SoapFault $e) {
		
			return null;
			
		}
	}

	function update_epay_payment_method($data){
		
		try { 
			$epay = Payment::start_epay_soap();
	
			$custnum = $data["usa_epay_id"];
	
			$update=array( 
				    array('Field'=>'CardExp'   , 'Value'=>$data['ccmonth'].$data['ccyear']), 
				    array('Field'=>'CardNumber', 'Value'=>$data['card_number'])  
				    ); 
	
	 		$result = $epay["client"]->quickUpdateCustomer($epay["token"],$custnum, $update);		
	
			if ($result){
				
				$status["message"] = "Your payment method has been updated";
				$status["success"] = true;
				
			} else {
				
				$status["error"] = $TransactionObject->Response->Error;
				$status["success"] = false;
				
			}
		} 
		 
		catch (SoapFault $e) { 
			
			$status["error"] = "There was an error processing your request: " . $e->getMessage();
			$status["success"] = false;
			
		}
		
		return $status;
				
	}
	
	public function run_auth_only($data){
		
		try {
		$epay = Payment::start_epay_soap();
			$Request=array(
				'AccountHolder' => 'Tester Jones',
				'Details' => array(
					'Description' => 'Example Transaction',
					'Amount' => '4.00',
					'Invoice' => '44539'
				),
				'CreditCardData' => array(
					'CardNumber' => '4444555566667779',
					'CardExpiration' => '0909',
					'AvsStreet' => '1234 Main Street',
					'AvsZip' => '99281',
					'CardCode' => '999'
				)
			);
		
			$res= $epay["client"]->runAuthOnly($epay["token"], $Request);
			
			return $res;
		} catch(SoapFault $e){
			
		}
	}
	
	public function void_transaction($data){
		try	{ 
			$epay 	= Payment::start_epay_soap();
			$res	= $epay["client"]->voidTransaction($epay["token"],$data["refnum"]);
			return 	$res;
		} 
		 
		catch (SoapFault $e) { 
			die("Void Transaction failed :" .$e->getMessage()); 
		} 
	}


	public function get_customer_history($custnum){
		//echo $custnum;
		try{
			$epay 	= Payment::start_epay_soap();
			$res	= $epay["client"]->getCustomerHistory($epay["token"],$custnum);
			return 	$res;
		
		} 
		 
		catch (SoapFault $e) { 
		  die("Get Customer History failed :" .$e->getMessage()); 
		 } 
	}
	
	public function get_expired_before_next_billing(){
		$expiring = array();
		$result = array();
		$data = array();
		try{
			$epay 	= Payment::start_epay_soap();
			$StartDate = Date('Y/m/d'); // todays date
			$EndDate = Date('Y/m/d',mktime(0,0,0,date('m')+1,date('d'),date('y'))); // date with one year difference i.e. same date of next year
  			
			$Format='csv';
			$Report='customer:Expiring before Next Billing';
			$Options = array();
			 
			$res=$epay["client"]->getReport($epay["token"], $Report, $Options, $Format);  
			$data=base64_decode($res);			

			$data = str_getcsv($data, "\n"); //parse the rows
			foreach($data as $Row){ 
				$Row = str_getcsv($Row, ",");//parse the items in rows
				$expiring[] = $Row[2]; 
			}
			$result["expiring"] = $expiring;
			return 	$result;
		
		} 
		 
		catch (SoapFault $e) { 
		  die("Get Expired Failed :" .$e->getMessage()); 
		 } 
	}
 
}
//customer:Expiring before Next Billing
?>