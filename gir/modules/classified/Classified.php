<?php 
/**
 * 
 * @author undead
 *
 */
class Classified extends Crud {
	 
	protected $_OBJECT_NAME = "classified";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	array("type"=>"date","label"=>"Created Date","field"=>"created_date"),
											array("type"=>"date","label"=>"Expiration Date","field"=>"expiration_date"),
											array("type"=>"text","label"=>"Title","field"=>"title"),
											array("type"=>"text","label"=>"Description","field"=>"description"),
											array("type"=>"text","label"=>"Keywords","field"=>"keywords"),
											array("type"=>"join","label"=>"Scrapper Join","field"=>"join_scrapper"),
											array("type"=>"text","label"=>"Classified Snapshot","field"=>"classified_snapshot"),
											array("type"=>"number","label"=>"Locked","field"=>"locked"),
											array("type"=>"number","label"=>"Archived","field"=>"archived"),
											array("type"=>"number","label"=>"Status","field"=>"status")
										);
	
	function __construct(){
		parent::__construct();
		foreach($this->_OBJECT_PROPERTIES as $p) {
			$this->{$p['field']} = "";
		}
	}
	
}
?>
