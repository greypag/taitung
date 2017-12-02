<?php
namespace Fac\Core\Database;

use Fac\Core\Error\DbConnectException;

abstract class DbAbstract {
    
    abstract public function connect(); 
    
    abstract public function disconnect();     
    
    abstract public function query($sql);
    
    public function execSql($sql) {
        $errNo = $this->connect();
        if ( $errNo == 0) {
            $result = $this->query($sql);
            $this->disconnect();
            return $result;
        } else {
            $this->disconnect();
            throw new DbConnectException('Cannot establish connection to database.', $errNo);
        }
    }
}
