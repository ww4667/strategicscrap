<?php 
/**
 *
 * @author undead
 *
 */
 
class User {

    private $_USER_ID = null;
    private $_EMAIL = null;
    private $_PASSWORD = null;
    private $_LAST_LOGIN = null;
	
	protected $_OBJECT_NAME = "gir_user";
	protected $_OBJECT_PROPERTIES = array(	array("type"=>"text","label"=>"E-mail","field"=>"email"),
											array("type"=>"text","label"=>"Password","field"=>"password"),
											array("type"=>"text","label"=>"Validation","field"=>"validation"),
											array("type"=>"date","label"=>"Last Login","field"=>"last_login_ts")
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
	public function ForgotPassword($email) {
		return $this->_forgotPassword($email);
	}
    
	/*
	 * PRIVATE FUNCTIONS
	 */
    private function _emailCheck($email) {
        ;
    }
    
    private function _setLastLogin() {
        ;
    }
    
    private function _forgotPassword($email) {
        // check if email exists
		if($this->_emailCheck($email)) {
			// create unique random key ie. difference of current timestamp and created_ts MD5'd
			$key = 'somethingsecret';
			// store key to validation field
			$this->validation = $key;
			// send user an email with the secret key
			// $mail = new Mailer();
			// $message = "mail message with url in it";
			// $mail->SendMessage($email,$message);
		} else {
			return false;
		}
    }
    
    private function _setPassword($password) {
    	// stored password = MD5(MD5(password) + SomeSuperCoolSecretGirThing + MD5(created_ts))
        ;
    }
    
    private function _resetPassword($email,$key) {
        ;
    }
}
?>