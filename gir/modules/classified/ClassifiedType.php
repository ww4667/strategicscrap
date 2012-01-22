<?php 
/**
 * 
 * @author undead
 * @description a class to define a type of classfied. Perhaps int eh future forms will be associated to this.
 *
 */
class ClassifiedType extends Crud {
	 
	protected $_OBJECT_NAME = "classified_type";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	array("type"=>"text","label"=>"Name","field"=>"name"),
											array("type"=>"number","label"=>"Hidden","field"=>"hidden")	);
	
	function __construct(){
		parent::__construct();
		foreach($this->_OBJECT_PROPERTIES as $p) {
			$this->{$p['field']} = "";
		}
	}
	
}
?>
