<?php 
/**
 * 
 * @author undead
 *
 */
class Transportation_Type extends Crud {
	
	protected $_OBJECT_NAME = "transportation_type";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	array("type"=>"text","label"=>"Name","field"=>"name")
											);
	function __construct(){
		parent::__construct();
		foreach($this->_OBJECT_PROPERTIES as $p) {
			$this->{$p['field']} = "";
		}
	}
}
?>