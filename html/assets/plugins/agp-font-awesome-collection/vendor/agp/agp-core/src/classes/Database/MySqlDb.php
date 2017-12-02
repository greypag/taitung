<?php
namespace Fac\Core\Database;

class MySqlDb extends DbAbstract {
    
    private $db;

    private $host;
    
    private $database;
    
    private $user;
    
    private $password;
    
    private $showError = TRUE;
    
    private $tranStarted = FALSE;

    public function __construct( $host, $database, $user, $password ) {
        $this->host=$host;
        $this->database=$database;
        $this->user=$user;
        $this->password=$password;
        $this->db = NULL;
    }   
    
    public function beginTran() {
        //Transaction will work only in InnoDB
        if (!$this->tranStarted && isset($this->db)) {
            mysql_query('SET AUTOCOMMIT=0', $this->db);
            mysql_query('START TRANSACTION', $this->db);
            $this->tranStarted = TRUE;
        }
    }
    
    public function commitTran() {
        //Transaction will work only in InnoDB
        if ($this->tranStarted && isset($this->db)) {
            mysql_query('COMMIT', $this->db);   
            mysql_query('SET AUTOCOMMIT=1', $this->db);
            $this->tranStarted = FALSE;
        }
    }
    
    public function rollbackTran() {
        //Transaction will work only in InnoDB
        if ($this->tranStarted && isset($this->db)) {
            mysql_query('ROLLBACK', $this->db);                        
            mysql_query('SET AUTOCOMMIT=1', $this->db);
            $this->tranStarted = FALSE;
        }        
    }
   
    public function connect() {
        if (!isset($this->db)) {
            
            $this->db = mysql_connect($this->host, $this->user, $this->password);
            
            if( !$this->db && $this->showError ) {
                throw new Exception( mysql_error() );
            }
            
            $connected = mysql_select_db($this->database, $this->db);
            if(!$connected && $this->showError ) {
                throw new Exception( mysql_error() );
            }
        }
        
        return $this->db;
    }    
    
    public function disconnect() {
        if ( isset($this->db) ) {
            
            if ($this->tranStarted) {
                $this->rollbackTran();
            }
            
            mysql_close($this->db);
            $this->db = NULL;
        }
    }    

    public function query($sql) {
        if ( isset($this->db) ) {
            $query_raw = mysql_query($sql, $this->db);

            if ( $query_raw === FALSE && $this->showError) {
                throw new Exception( mysql_error() );
            }
            
            $result = array();                            
            if ( $query_raw && is_resource($query_raw)) {
                while($row = mysql_fetch_array($query_raw, MYSQL_ASSOC)) {
                    $result[] = $row;    
                }                
            } else {
                $result = $query_raw;
            }
            return $result;            
        }
    }
    
    public function escape ($value) {
        return mysql_real_escape_string($value, $this->db);
    }

    public function getInsertId() {
		return mysql_insert_id($this->db);
	}    
    
    public function getDb() {
        return $this->db;
    }

    public function getHost() {
        return $this->host;
    }

    public function getDatabase() {
        return $this->database;
    }

    public function getUser() {
        return $this->user;
    }

    public function getPassword() {
        return $this->password;
    }
    
    public function getShowError() {
        return $this->showError;
    }

    public function setShowError($showError) {
        $this->showError = $showError;
        return $this;
    }
    
    public function getTranStarted() {
        return $this->tranStarted;
    }

}
