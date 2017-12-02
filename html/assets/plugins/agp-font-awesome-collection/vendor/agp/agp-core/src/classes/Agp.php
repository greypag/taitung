<?php
namespace Fac\Core;

class Agp extends ModuleAbstract {
    
    /**
     * The single instance of the class 
     * 
     * @var object 
     */
    protected static $_instance = null;    
    
	/**
	 * Main Instance
	 *
     * @return object
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
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
    
    public function __construct() {
        $this->setKey('agp_core');
        parent::__construct(dirname(dirname(__FILE__)));
        
        $this->setSettings( Settings::instance( $this ) );
        $this->setVersion( $this->getSettings()->getVersion() );
        
        add_action( 'wp_enqueue_scripts', array($this, 'enqueueScripts' ) );                
        add_action( 'admin_enqueue_scripts', array($this, 'enqueueAdminScripts' ));       
    }
    
    public function enqueueScripts () {
    }        
    
    public function enqueueAdminScripts () {
        wp_register_style( 'agp-options-css', $this->getAssetUrl('css/agp-options.css') );           
//        wp_enqueue_style( 'agp-options-css' );                    
    }

}

Agp::instance();