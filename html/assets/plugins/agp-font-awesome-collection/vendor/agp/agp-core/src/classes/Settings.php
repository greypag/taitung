<?php
namespace Fac\Core;

use Fac\Core\Config\SettingsAbstract;

class Settings extends SettingsAbstract {
    
    /**
     * The single instance of the class 
     * 
     * @var object 
     */
    protected static $_instance = null;    

    /**
     * Parent Module
     * 
     * @var ModuleAbstract
     */
    protected static $_parentModule;
    
	/**
	 * Main Instance
	 *
     * @return object
	 */
	public static function instance($parentModule = NULL) {
		if ( is_null( self::$_instance ) ) {
            self::$_parentModule = $parentModule;            
			self::$_instance = new self();
		}
		return self::$_instance;
	}    
    
	/**
	 * Cloning is forbidden.
	 */
	public function __clone() {
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 */
	public function __wakeup() {
    }        
    
    /**
     * Constructor 
     * 
     * @param ModuleAbstract $parentModule
     */
    public function __construct() {
        $config = include ($this->getParentModule()->getBaseDir() . '/config/config.php');        
        $key = $this->getParentModule()->getKey();
        parent::__construct($config, $key);
    }
    
    public static function getParentModule() {
        return self::$_parentModule;
    }
    
    public static function renderSettingsPage() {
        echo self::getParentModule()->getTemplate('admin/options/layout', self::instance());
    }    
    
}

