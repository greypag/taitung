<?php
namespace Fac\Core\Database;

class MySqlPdoDb extends DbAbstract {
    
    /**
     * DB connection
     * 
     * @var PDO 
     */
    private $db;

    private $host;
    
    private $database;
    
    private $user;
    
    private $password;
    
    private $showError = TRUE;
    
    private $tranStarted = 0;

    public function __construct( $host, $database, $user, $password ) {
        $this->host=$host;
        $this->database=$database;
        $this->user=$user;
        $this->password=$password;
        $this->db = NULL;
    }   
    
    public function beginTran() {
        if( isset($this->db) && !$this->tranStarted++ ) {
            return $this->db->beginTransaction();
        }
        return $this->tranStarted >= 0;         
    }
    
    public function commitTran() {
        if ( isset($this->db) && !--$this->tranStarted ) {
           return $this->db->commit(); 
        }
        return $this->tranStarted >= 0;         
    }
    
    public function rollbackTran() {
        if($this->tranStarted >= 0) {
            $this->tranStarted = 0;
            return $this->db->rollback();
        }
        $this->tranStarted = 0;
        return false;         
    }
   
    public function connect() {
        
        if (!isset($this->db)) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8";
                $opt = array(
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                );
                $this->db = new PDO($dsn, $this->user, $this->password, $opt);
            } catch (PDOException $e) {
                if( !$this->showError ) {
                    throw new Exception( $e->getMessage() );
                    exit();
                }
            }            
        }
        return $this->db;
    }    
    
    public function disconnect() {
        if ( isset($this->db) ) {
            
            if ( $this->tranStarted ) {
                $this->rollbackTran();
            }
            
            $this->db = NULL;
        }
    }    

    public function query($sql) {
        if ( isset($this->db) ) {
            $query = $this->db->prepare($sql);
            $query->execute();
            
            $err = $this->db->errorInfo();
            if ( !empty($err[0]) && isset($err[2]) && $this->showError ) {
                throw new Exception( $err[2] );
                exit();
            }

            $result = array();
            try {
                $result = $query->fetchAll();    
            } catch (PDOException $e) {
            }
            
            return $result;
        }
    }
    
    public function escape ($value) {
        //return $this->db->quote($value);
        return $value;
    }

    public function getInsertId() {
		return $this->db->lastInsertId();
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
