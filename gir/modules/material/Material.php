<?php 
/**
 * 
 * @author undead
 *
 */
class Material extends Crud {
	
	protected $_OBJECT_NAME = "material";
	protected $_OBJECT_PROPERTIES = array(	array("type"=>"text","label"=>"Name","field"=>"name")
											);
	function __construct(){
		parent::__construct();
	}
}
?>