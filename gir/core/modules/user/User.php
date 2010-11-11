<?php 
/**
 *
 * @author undead
 *
 */
 
class User extends Crud {

    private $_USER_ID = null;
    private $_EMAIL = null;
    private $_PASSWORD = null;
    private $_LAST_LOGIN = null;
	
	protected $_OBJECT_NAME = "gir_user";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	array("type"=>"text","label"=>"E-mail","field"=>"email"),
											array("type"=>"text","label"=>"Password","field"=>"password"),
											array("type"=>"text","label"=>"Validation","field"=>"validation"),
											array("type"=>"number","label"=>"Logged In","field"=>"logged_in"),
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
	
	public function Login( $username, $password ) {
		return $this->_login( $username, $password );
	}
	
	public function Logout() {
		return $this->_logout();
	}
    
	/*
	 * PRIVATE FUNCTIONS
	 */
    private function _login( $username, $password ) {
    	if ( !isset($_SESSION)) return false; 
		if ( !isset($_SESSION['user']) && !isset($_SESSION['user']['loggedIn']) ) {
	        // check email exists
			$propertyName = 'email';
			$users = array();
			$users = $this->GetItemsObjByPropertyValue( $propertyName, $username );
			if( count($users) > 0 && $users[0]->password == $password ) {
				// authenticate and set session vars...
	//			$item = new User();
				$user = $users[0];
	//			$_SESSION['user']['object'] = serialize($item);
				$user->logged_in = 1;
				$user->last_login_ts = date("Y-m-d H:i:s");
				$user->UpdateItem();
				$_SESSION['user']['id'] = $user->id;
				$_SESSION['user']['username'] = $user->email;
				$_SESSION['user']['loggedIn'] = true;
				$_SESSION['user']['group'] = 'scrapper';
				return true;
			}
    	}
		return false;
    }
	
	private function _logout() {
		$u = new User();
		$user = $u->GetItemObj( $_SESSION['user']['id'] ); 
		$user->logged_in = 0;
		if($user->UpdateItem()) {
			unset($_SESSION['user']);
			return true;
		}
		return false;
	}
	
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
//			$this->UpdateItem($itemData);
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