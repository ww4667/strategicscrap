<?php 
/**
 * 
 * @author undead
 *
 */
class Category extends Crud {
	
	protected $_OBJECT_NAME = "category";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	array("type"=>"text","label"=>"Name","field"=>"name"),
											array("type"=>"join","label"=>"Category Join","field"=>"join_category")
											);
	function __construct(){
		parent::__construct();
		foreach($this->_OBJECT_PROPERTIES as $p) {
			$this->{$p['field']} = "";
		}
	}
}
?>