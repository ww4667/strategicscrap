<?

class PricingBroker {
	public $id;
	public $first_name;
	public $last_name;
	public $email;
	public $password;
	public $company;
	public $created_at;
	public $updated_at;

	function __construct($i_id=null){
	}

	/** 
	* Creates a new PricingBroker
	* @param $i_post array of form fields 
	* @return int the id of the new PricingBroker in the database or array of errors if any
	*/
	static function create($i_post){
		global $modx;
		$fields = array();
		$table = "scrap_pricing_brokers";
		
		$keys = new PricingBroker(); // create a client object to use for column name matching
		if (is_array($i_post)) {
			foreach ($keys as $key => $val) {
				if (isset($i_post[$key])) $fields[$key] = mysql_real_escape_string($i_post[$key]);
			}
		} else {
			foreach ($keys as $key => $val) {
				if (isset($i_post->$key)) $fields[$key] = mysql_real_escape_string($i_post->$key);
			}
		}
		
		$fields['created_at'] = date("Y-m-d H:i￼:s"); // set created timestamp
		$insert_id = $modx->db->insert($fields, $table);
		
		return $insert_id;
	}
	
	/** 
	* update
	* @param $i_broker obj or array of form data
	* @param $i_broker_id int of PricingBroker id
	*/
	static function update($i_broker,$i_broker_id) {
		global $modx;
		$fields = array();
		$table = "scrap_pricing_brokers";
		$where = "id = $i_broker_id";
		
		$keys = new PricingBroker($i_broker_id); // get a client object to use for column name matching
		if (is_array($i_broker)) {
			foreach ($keys as $key => $val) {
				if (isset($i_broker[$key])) $fields[$key] = mysql_real_escape_string($i_broker[$key]);
			}
		} else {
			foreach ($keys as $key => $val) {
				if (isset($i_broker->$key)) $fields[$key] = mysql_real_escape_string($i_broker->$key);
			}
		}
		
		$fields['updated_at'] = date("Y-m-d H:i￼:s"); // set updated timestamp
		$update = $modx->db->update($fields, $table, $where);
		
		return $update;
	}
	
	/** 
	* retrieve an array of PricingBroker objects
	* @return {prices} returns the PricingBroker objects in an array
	*/
	static function retrieve_all(){
		global $modx;
		$fields = "*";
		$table = "scrap_pricing_brokers";

		$brokerquery = $modx->db->select($fields,$table);
		
		if ($modx->db->getRecordCount($brokerquery) > 0) {
			$brokers = array();
			while ($p = mysql_fetch_object($brokerquery)) {
				$broker = new PricingBroker();
				foreach ($p as $key => $val) {
					$broker->$key = $val;
				}
				$brokers[] = $broker;
			}
			return $brokers;
		} else {
			return FALSE;
		}
	}	
	
	/** 
	* retrieve a PricingBroker object
	* @param $i_broker_id int of PricingBroker id
	* @return {PricingBroker} returns the PricingBroker object
	*/
	static function retrieve($i_broker_id){
		global $modx;
		$fields = "*";
		$table = "scrap_pricing_brokers";
		$where = "id = $i_broker_id";
		$orderby = "";
		$limit = 1;

		$brokerquery = $modx->db->select($fields,$table,$where,$orderby,$limit);
		
		if ($modx->db->getRecordCount($brokerquery) > 0) {
			$brokerfields = mysql_fetch_object($brokerquery);
			$broker = new PricingBroker();
			foreach ($brokerfields as $key => $val) {
				$broker->$key = $val;
			}
			return $broker;
		} else {
			return FALSE;
		}
	}
	
	/** 
	* retrieve a PricingBroker object
	* @param $i_email int of PricingBroker email
	* @param $i_password string of PricingBroker password
	* @return {PricingBroker} returns the PricingBroker object
	*/
	static function login($i_email,$i_password){
		global $modx;
		$fields = "*";
		$table = "scrap_pricing_brokers";
		$where = "email = '$i_email' AND password = '$i_password'";
		$orderby = "";
		$limit = 1;

		$brokerquery = $modx->db->select($fields,$table,$where,$orderby,$limit);
		
		if ($modx->db->getRecordCount($brokerquery) > 0) {
			$brokerfields = mysql_fetch_object($brokerquery);
			$broker = new PricingBroker();
			foreach ($brokerfields as $key => $val) {
				$broker->$key = $val;
			}
			return $broker;
		} else {
			return FALSE;
		}
	}
	
	/** 
	* return a region based on state abreviation
	*/
	static function set_region($i_state){
		$south = array("TX","OK","AR","LA","MS");
		$central = array("IA","MN","KS","IL","MO","SD","ND","WI","NE");
		$northeast = array();
		$southeast = array("TN","FL","NC","SC","AL","GA");
		$west = array("CA","NM","AZ","ID","MT","NV","OR","WA","WY","UT","CO");
		$region = "";
		if(in_array($i_state, $south))$region = "S";
		if(in_array($i_state, $west))$region = "W";
		if(in_array($i_state, $central))$region = "C";
		if(in_array($i_state, $southeast))$region = "SE";
		if($region == "")$region = "NE";
		
		return $region;
	}
}

?>