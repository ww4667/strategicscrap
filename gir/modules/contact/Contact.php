<?php 
/**
 *
 * @author undead
 * @description a generic text/number/date class that you can expand and use only the fields you need to
 *
 */
 
class Contact extends Crud {

	protected $_OBJECT_NAME = "contact";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	/* contact form */
											array("type"=>"text","label"=>"Name","field"=>"name"),
											array("type"=>"text","label"=>"First Name","field"=>"firstName"),
											array("type"=>"text","label"=>"Last Name","field"=>"lastName"),
											array("type"=>"text","label"=>"Title","field"=>"title"),
											array("type"=>"text","label"=>"Company","field"=>"company"),
											array("type"=>"text","label"=>"Email","field"=>"email"),
											array("type"=>"text","label"=>"Phone","field"=>"phone"),
											array("type"=>"text","label"=>"Address1","field"=>"address1"),
											array("type"=>"text","label"=>"Address2","field"=>"address2"),
											array("type"=>"text","label"=>"City","field"=>"city"),
											array("type"=>"text","label"=>"State","field"=>"state"),
											array("type"=>"text","label"=>"Zip","field"=>"zip"),
											array("type"=>"text","label"=>"Website","field"=>"website"),
											/*classified scrap form*/
											array("type"=>"text","label"=>"Unit","field"=>"unit"),
											array("type"=>"text","label"=>"Quantity","field"=>"quantity"),
											array("type"=>"text","label"=>"Price","field"=>"price")
											/*classified job form*/
											/*classified equipment form*/
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
	
	
	
	/*
	 * PRIVATE FUNCTIONS
	 */
	
}
?>