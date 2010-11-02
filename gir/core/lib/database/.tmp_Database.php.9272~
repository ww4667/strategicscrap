<?
class Database {
    // an array of properties used by __get and __set
    private $props;
   
    // the actual connection resource
    protected $connection;
   
    // the hostname for the database server
    protected $hostname;
   
    // the name of the database to use
    protected $database;
   
    // the username to use to access the database
    protected $username;
   
    // the password to use to access the database
    protected $password;
   
    protected function __construct($dbHost=null, $dbName=null, $dbUser=null, $dbPass=null) {
        $this->database = $dbName;
        $this->hostname = $dbHost;
        $this->username = $dbUser;
        $this->password = $dbPass;
    }
   
    protected function __set($name, $value) {
        if (isset($this->props[$name])) {
            $this->props[$name] = $value;
        }
    }
   
    protected function __get($name) {
        if (isset($this->props[$name])) {
            return $this->props[$name];
        } else {
            return nulll;   
        }
    }
}
?>