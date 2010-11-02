<?

class Client {
	public $id;
	public $fname;
	public $lname;
	public $email;
	public $password;
	public $address;
	public $city;
	public $state;
	public $zip;
	public $day_phone;
	public $eve_phone;
	public $service_type;
	public $created_at;
	public $updated_at;

	function __construct($i_id=null){
	}

	/** 
	* Creates a new client
	* @param $i_post array of form fields 
	* @return int the id of the new client in the database or array of errors if any
	*/
	static function create($i_post){
		global $modx;
		$fields = array();
		$table = "hd_clients";
		
		$keys = new Client(); // create a client object to use for column name matching
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
		$fields['password'] = sha1(trim($fields['password']));

		$insert_id = $modx->db->insert($fields, $table);
		
		return $insert_id;
	}
	
	/** 
	* update
	* @param $i_client obj or array of form data
	* @param $i_client_id int of client id
	*/
	static function update($i_client,$i_client_id) {
		global $modx;
		$fields = array();
		$table = "hd_clients";
		$where = "id = $i_client_id";
		
		$keys = new Client($i_client_id); // get a client object to use for column name matching
		if (is_array($i_client)) {
			foreach ($keys as $key => $val) {
				if (isset($i_client[$key])) $fields[$key] = mysql_real_escape_string($i_client[$key]);
			}
		} else {
			foreach ($keys as $key => $val) {
				if (isset($i_client->$key)) $fields[$key] = mysql_real_escape_string($i_client->$key);
			}
		}
		
		$fields['updated_at'] = date("Y-m-d H:i￼:s"); // set updated timestamp
		if (isset($fields['password']) && $fields['password'] != '') {
			$fields['password'] = sha1(trim($fields['password']));
		}
		$update = $modx->db->update($fields, $table, $where);
		
		return $update;
	}
	
	/** 
	* retrieve an array of client objects
	* @return {clients} returns the client objects in an array
	*/
	static function retrieve_all(){
		global $modx;
		$fields = "*";
		$table = "hd_clients";

		$clientquery = $modx->db->select($fields,$table);
		
		if ($modx->db->getRecordCount($clientquery) > 0) {
			$clients = array();
			while ($c = mysql_fetch_object($clientquery)) {
				$client = new Client();
				foreach ($c as $key => $val) {
					$client->$key = $val;
				}
				array_push($clients, $client);
			}
			return $clients;
		} else {
			return FALSE;
		}
	}	
	
	/** 
	* retrieve a client object
	* @param $i_client_id int of client id
	* @return {Client} returns the client object
	*/
	static function retrieve($i_client_id){
		global $modx;
		$fields = "*";
		$table = "hd_clients";
		$where = "id = $i_client_id";
		$orderby = "";
		$limit = 1;

		$clientquery = $modx->db->select($fields,$table,$where,$orderby,$limit);
		
		if ($modx->db->getRecordCount($clientquery) > 0) {
			$clientfields = mysql_fetch_object($clientquery);
			$client = new Client();
			foreach ($clientfields as $key => $val) {
				$client->$key = $val;
			}
			return $client;
		} else {
			return FALSE;
		}
	}	
	
	/** 
	* retrieve an array of most recent client objects
	* @return client objects in an array
	*/
	static function recent($i_limit=10){
		global $modx;
		$fields = "*";
		$table = "hd_clients";
		$where = "";
		$orderby = "id DESC";
		$limit = $i_limit;

		$clientquery = $modx->db->select($fields,$table,$where,$orderby,$limit);
		
		if ($modx->db->getRecordCount($clientquery) > 0) {
			$clients = array();
			while ($c = mysql_fetch_object($clientquery)) {
				$client = new Client();
				foreach ($c as $key => $val) {
					$client->$key = $val;
				}
				array_push($clients, $client);
			}
			return $clients;
		} else {
			return FALSE;
		}
	}	
	
	/**
	 * search clients db
	 * @param array of fields
	 * @return array of client objects
	 */
	static function search($i_fields) {
		global $modx;
		
//		foreach ($i_fields as $key => $val) {
//			$i_fields[$key] = addslashes($val);
//		}
		$fields = "*";
		$from = "hd_clients";
		$where = '';
		/* start build where statement */
		$keys = new Client();
		$where_fields = array();
		foreach ($keys as $key => $val) {
			if (isset($i_fields[$key])) {
				$where_fields[$key] = mysql_real_escape_string($i_fields[$key]);
				$where .= " AND $key LIKE '%".$where_fields[$key]."%'";
			}
		}
		$where = ltrim($where, ' AND ');
		/* end build where statement */
		$results = $modx->db->select($fields,$from,$where);
		if ($modx->db->getRecordCount($results) > 0) {
			$clients = array();
			while ($c = mysql_fetch_object($results)) {
				$client = new Client();
				foreach ($c as $key => $val) {
					$client->$key = $val;
				}
				array_push($clients, $client);
			}
			return $clients;
		} else {
			return FALSE;
		}
	}
	
	/** 
	* check if email exists in DB
	* @param $i_email email to check
	* @return true/false
	*/
	static function email_exists($i_email){
		global $modx;
		$fields = "*";
		$table = "hd_clients";
		$where = "email = '$i_email'";
		$orderby = "";
		$limit = 1;

		$clientquery = $modx->db->select($fields,$table,$where,$orderby,$limit);
		
		if ($modx->db->getRecordCount($clientquery) > 0) {
			$clientfields = mysql_fetch_object($clientquery);
			$client = new Client();
			foreach ($clientfields as $key => $val) {
				$client->$key = $val;
			}
			return $client;
		} else {
			return FALSE;
		}
	}	
	
	/** 
	* check if client is logged in
	* @return true/false
	*/
	static function is_logged_in(){
		
		if (isset($_SESSION['hd_client']) && isset($_SESSION['hd_client_id'])) {
			return TRUE;
		} else {
			return FALSE;
		}
	}	

	/**
	* sets the session for the client object
	*/
	static function log_out() {
		unset($_SESSION['hd_client']);
		unset($_SESSION['hd_client_id']);
	}

	/** 
	* save
	* @return true|false
	*/
	public function save() {
		Client::update($this, $this->id);
	}

	/**
	* sets the session for the client object
	*/
	public function session_refresh() {
		unset($_SESSION['hd_client']);
		unset($_SESSION['hd_client_id']);
		$_SESSION['hd_client'] = serialize($this);
		$_SESSION['hd_client_id'] = $this->id;
	}
}

?>