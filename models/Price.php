<?

class Price {
	public $id;
	public $name;
	public $company;
	public $material;
	public $quantity;
	public $price;
	public $facility;
	public $city;
	public $state;
	public $region;
	public $notes;
	public $created_at;
	public $updated_at;

	function __construct($i_id=null){
	}

	/** 
	* Creates a new price
	* @param $i_post array of form fields 
	* @return int the id of the new price in the database or array of errors if any
	*/
	static function create($i_post){
		global $modx;
		$fields = array();
		$table = "ss_price";
		
		$keys = new Price(); // create a client object to use for column name matching
		if (is_array($i_post)) {
			foreach ($keys as $key => $val) {
				if (isset($i_post[$key])) $fields[$key] = mysql_real_escape_string($i_post[$key]);
			}
		} else {
			foreach ($keys as $key => $val) {
				if (isset($i_post->$key)) $fields[$key] = mysql_real_escape_string($i_post->$key);
			}
		}
		
		$fields['created_at'] = date("Y-m-d H:i:s"); // set created timestamp
		$insert_id = $modx->db->insert($fields, $table);
		
		return $insert_id;
	}
	
	/** 
	* update
	* @param $i_price obj or array of form data
	* @param $i_price_id int of price id
	*/
	static function update($i_price,$i_price_id) {
		global $modx;
		$fields = array();
		$table = "ss_price";
		$where = "id = $i_price_id";
		
		$keys = new Price($i_price_id); // get a client object to use for column name matching
		if (is_array($i_price)) {
			foreach ($keys as $key => $val) {
				if (isset($i_price[$key])) $fields[$key] = mysql_real_escape_string($i_price[$key]);
			}
		} else {
			foreach ($keys as $key => $val) {
				if (isset($i_price->$key)) $fields[$key] = mysql_real_escape_string($i_price->$key);
			}
		}
		
		$fields['updated_at'] = date("Y-m-d H:i￼:s"); // set updated timestamp
		$update = $modx->db->update($fields, $table, $where);
		
		return $update;
	}
	
	/** 
	* retrieve an array of price objects
	* @return {prices} returns the price objects in an array
	*/
	static function retrieve_all(){
		global $modx;
		$fields = "*";
		$table = "ss_price";

		$pricequery = $modx->db->select($fields,$table);
		
		if ($modx->db->getRecordCount($pricequery) > 0) {
			$prices = array();
			while ($p = mysql_fetch_object($pricequery)) {
				$price = new Price();
				foreach ($p as $key => $val) {
					$price->$key = $val;
				}
				$prices[] = $price;
			}
			return $prices;
		} else {
			return FALSE;
		}
	}	
	
	/** 
	* retrieve a price object
	* @param $i_price_id int of price id
	* @return {price} returns the price object
	*/
	static function retrieve($i_price_id){
		global $modx;
		$fields = "*";
		$table = "ss_price";
		$where = "id = $i_price_id";
		$orderby = "";
		$limit = 1;

		$pricequery = $modx->db->select($fields,$table,$where,$orderby,$limit);
		
		if ($modx->db->getRecordCount($pricequery) > 0) {
			$pricefields = mysql_fetch_object($pricequery);
			$price = new Price();
			foreach ($pricefields as $key => $val) {
				$price->$key = $val;
			}
			return $price;
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