<?php
namespace Fac\Core\Config;

abstract class ConfigAbstract {

    private $key;
    
    protected $data;
    
    /**
     * Constructor
     */
    public function __construct( $data = array(), $key = NULL ) {    
        $this->key = $key;
        $this->data = $data;
    }
    
    /**
     * Convert an array into a stdClass()
     * 
     * @param   array   $array  The array we want to convert
     * 
     * @return  object
     */
    public function arrayToObject($array) {
        
        // First we convert the array to a json string
        $json = json_encode($array);

        // The we convert the json string to a stdClass()
        $object = json_decode($json);

        return $object;
    }


    /**
     * Convert a object to an array
     * 
     * @param   object  $object The object we want to convert
     * 
     * @return  array
     */
    public function objectToArray($object) {
        
        // First we convert the object into a json string
        $json = json_encode($object);

        // Then we convert the json string to an array
        $array = json_decode($json, true);

        return $array;
    }    
 
    
    public function applyData (array $data) {
        $key = $this->key;
        if (!empty($key)) {
            $this->data[$key] = array_merge($this->data[$key], $data);    
        } else {
            $this->data = array_merge($this->data, $data);    
        }        
    }
    
    public function getConfig() {
        $key = $this->key;
        if (!empty($key)) {
            return $this->arrayToObject($this->data[$key]);
        } else {
            return $this->arrayToObject($this->data);    
        }
    }
   
    public function getKey() {
        return $this->key;
    }

    public function setKey($key) {
        $this->key = $key;
        return $this;
    }
}