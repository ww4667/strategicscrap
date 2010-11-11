n<?php 

/**
 * 
 * @author undead
 * 
 * TODO: Keyed Entry
 * 
 */


class Auth {
	
	private $_USER_ID = null;
	private $_USER_LOGGED_IN = null;
	private $_USER_GROUP = null;
	private $_APPLICATION = null;
	private $_KEYED_ENTRY = false;
	private $_KEY = null;
	
	function __construct( ){
		
	}
	
	public function setApplication( $applicationName ){
		$this->_APPLICATION = $applicationName;
		return $this;
	}
	
	public function setUserGroup(){
		$this->_APPLICATION = $applicationName;
		return $this;
	}
	/*test */
	public function authenticate(){
		global $gir;
		/*
		 * $auth = new Auth();
		 * 
		 * $authObject = $auth->setApllication()->$setUserGroup()->authenticate();
		 * 
		 */
		$returnValue = _isLoggedIn();
		
		return $returnValue;
	}
	  
	private function _isLoggedIn( ){
		if( isset( $_SESSION['user'] ) ){
			if( isset( $_SESSION['user']['id'] ) )
				$this->_USER_ID = $_SESSION['user']['id'];
			if( isset( $_SESSION['user']['loggedIn'] ) )
				$this->_USER_LOGGED_IN = $_SESSION['user']['loggedIn'];
			if( isset( $_SESSION['user']['group'] ) )
				$this->_USER_GROUP = $_SESSION['user']['group'];
			if( isset( $_SESSION['user']['app'] ) )
				$this->_APP = $_SESSION['app'];
			
		} else {
			return false;
		}
		return true;
	}
	
	private function _isKeyedEntry(){
		$this->_APP = $_SESSION['app'];
		$this->_APP = $_SESSION['key'];
		
		
	}
}

?>