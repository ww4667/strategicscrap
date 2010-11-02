<?php
/**
 * 
 * @author undead
 * 
 */
	class Gir {
		
	    public $crud = null;
	    public $auth = null;
		
	    function __construct(){
	    	$this->auth = new Auth();
	    	$this->crud = new Crud();
	    }
	}
?>