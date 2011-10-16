<?
final class Mysql extends Database {

    static private $instance;

    protected function __construct($dbHost=null, $dbName=null, $dbUser=null, $dbPass=null) {
        parent::__construct($dbHost, $dbName, $dbUser, $dbPass);
    }

    static function getInstance($dbHost, $dbName, $dbUser, $dbPass) {
        if(!Mysql::$instance) {
            Mysql::$instance = new Mysql($dbHost, $dbName, $dbUser, $dbPass );
        }
        return Mysql::$instance;
    }

    public function __set($name, $value) {
        if (isset($name) && isset($value)) {
            parent::__set($name, $value);
        }
    }

    public function __get($name) {
        if (isset($name)) {
            return parent::__get($name);
        }
    }

    public function Connected() {
        if (is_resource($this->connection)) {
            return true;
        } else {
            return false;
        }
    }

    public function AffectedRows() {
        return mysql_affected_rows($this->connection);
    }

    public function Open() {
        if (is_null($this->database))
            die("MySQL database not selected");
        if (is_null($this->hostname))
            die("MySQL hostname not set");

        $this->connection = @mysql_connect($this->hostname, $this->username, $this->password);

        if ($this->connection === false)
        die("Could not connect to database. Check your username and password then try again.\n");



        if (!mysql_select_db($this->database, $this->connection)) {
            die("Could not select database");
        }
    }

    public function Close() {
        mysql_close($this->connection);
        $this->connection = null;
    }

    public function Query($sql) {
        if ($this->connection === false) {
            die('No Database Connection Found.');
        }

        $result = @mysql_query($sql,$this->connection);
        if ($result === false) {
        	print "<h1>ERROR!</h1>";
        	
        	die( mysql_error(  ) );
        }
        
        return $result;
    }

    public function FetchArray( $result, $result_type = MYSQL_ASSOC ) {
    	
        if ($this->connection === false) {
            die('No Database Connection Found.');
        }
       
        $data = @mysql_fetch_array( $result, $result_type );
        
        if ( !is_array( $data ) ) {
        	/* while we should throw a myswl error, we should return an empty arry to be 
        	 * consistant with result handling
        	 * die( mysql_error() );
        	 */
        	$data = array();
        }
        return $data;
        
    }

    public function FetchAssocArray( $result ) {
    	
        if ($this->connection === false) {
            die('No Database Connection Found.');
        }
       
		while( ( $resultArray[] = @mysql_fetch_assoc( $result ) ) || array_pop( $resultArray ) ); 

        return $resultArray;
        
    }
}
?>