<?php
namespace Fac\Core;

class LessParser {
    /**
     * LESS Parser
     * 
     * @var \Less_Parser
     */
    private $lessParser;

    /**
     * Rendered LESS CSS List
     * 
     * @var array
     */
    
    private $registeredLessCss =array();
    
    /**
     * Rendered Admin LESS CSS List
     * 
     * @var array
     */
    
    private $registeredAdminLessCss =array();    
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->lessParser = new \Less_Parser();
        add_action( 'wp_footer', array($this, 'enqueueLessCss' ) );         
        add_action( 'admin_footer', array($this, 'enqueueAdminLessCss' ) );         
    }
    
    
    public function enqueueLessCss() {
        if (!empty($this->registeredLessCss)) {
            echo '<style type="text/css" >' . implode('', $this->registeredLessCss) . '</style>';                    
        }
    }    
    
    public function enqueueAdminLessCss() {
        if (!empty($this->registeredAdminLessCss)) {
            echo '<style type="text/css" >' . implode('', $this->registeredAdminLessCss) . '</style>';                    
        }
    }        
    
    public function registerLessCss( $filename, $vars = array() ) {
        if ( file_exists($filename) ) {
            $this->lessParser->parseFile( $filename );
            $this->lessParser->ModifyVars( $vars );
            $this->registeredLessCss[] = $this->lessParser->getCss();  
        }
    }
    
    public function registerAdminLessCss( $filename, $vars = array() ) {
        if ( file_exists($filename) ) {
            $this->lessParser->parseFile( $filename );
            $this->lessParser->ModifyVars( $vars );
            $this->registeredAdminLessCss[] = $this->lessParser->getCss();  
        }
    }    

    public function getLessParser() {
        return $this->lessParser;
    }
    
    public function getRegisteredLessCss() {
        return $this->registeredLessCss;
    }

    public function getRegisteredAdminLessCss() {
        return $this->registeredAdminLessCss;
    }
    
}
