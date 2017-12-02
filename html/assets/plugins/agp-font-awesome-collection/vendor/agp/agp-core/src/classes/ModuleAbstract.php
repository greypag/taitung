<?php
namespace Fac\Core;

use Fac\Core\Config\SettingsAbstract;

abstract class ModuleAbstract {

    /**
     * Current plugin version
     * 
     * @var string 
     */
    private $version;
    
    /**
     * Module unique key
     * 
     * @var string 
     */
    private $key;

    /**
     * LESS Parser
     * 
     * @var LessParser
     */
    private $lessParser;

    /**
     * Base module directory
     * 
     * @var string
     */
    private $baseDir;
    
    /**
     * Base core module directory
     * 
     * @var string
     */
    private $baseCoreDir;    
    
    /**
     * Default template directory
     * 
     * @var string 
     */
    private $defaultTemplateDir;
    

    /**
     * Default core template directory
     * 
     * @var string 
     */
    private $defaultTemplateCoreDir;
    
    
    /**
     * Current template directory
     * 
     * @var string 
     */
    private $templateDir;
    
    
    /**
     * Module name
     * 
     * @var string 
     */
    private $moduleName;
    
    
    /**
     * Default assets directory
     * 
     * @var string
     */
    private $defaultAssetDir;
    
    /**
     * Default assets core directory
     * 
     * @var string
     */
    private $defaultAssetCoreDir;    
    
    /**
     * Current assets directory
     * 
     * @var string 
     */
    private $assetDir;
    
    /**
     * Plugin settings
     * 
     * @var SettingsAbstract
     */
    private $settings;        
    
    /**
     * Module helper
     * 
     * @var ModuleHelper
     */
    private $helper;
    
    /**
     * Constructor
     */
    public function __construct($baseDir = NULL) {

        $this->lessParser = new LessParser();
        $this->helper = new ModuleHelper();
        
        $this->baseCoreDir = dirname(dirname(__FILE__));
        $this->defaultTemplateCoreDir = $this->baseCoreDir . '/templates';
        $this->defaultAssetCoreDir = $this->baseCoreDir . '/assets';
        
        $this->setBaseDir($baseDir);
        
        add_action( 'init', array($this, 'init' ) );       
        add_action( 'customize_preview_init', array($this, 'init' ) );                
    }
    
    public function init() {
        $this->applyLessCss();        
    }
    
    public function applyLessCss() {
        $config = array();
        if ( !empty($this->settings) && !empty($this->getSettings()->getConfig()->admin->style) ) {
            $config = $this->getSettings()->objectToArray( $this->getSettings()->getConfig()->admin->style );   
        }                        
        
        if (is_admin()) {
            $this->lessParser->registerAdminLessCss( $this->getAssetPath('less/admin/agp-options.less'), array_merge($config, array(
                'key' => $this->getKey(),
            )));
        }
        
        if (is_admin_bar_showing()) {
            $this->lessParser->registerAdminLessCss( $this->getAssetPath('less/admin/admin-toolbar.less'), array_merge($config, array(
                'key' => $this->getKey(),
            )));            
            $this->lessParser->registerLessCss( $this->getAssetPath('less/admin/admin-toolbar.less'), array_merge($config, array(
                'key' => $this->getKey(),
            )));                        
        }        
    }
    
    /**
     * Gets template content
     * 
     * @param string $name
     * @param string|array $params
     * @return string
     */
    public function getTemplate($name, $params = NULL) {
        ob_start();
        $template = $this->templateDir . '/' . $name . '.php';
        $defaultTemplate = $this->defaultTemplateDir . '/' . $name . '.php';
        $defaultTemplateCore = $this->defaultTemplateCoreDir . '/' . $name . '.php';
        if ( file_exists($template) && is_file($template) ) {
            include ($template);
        } elseif (file_exists($defaultTemplate) && is_file($defaultTemplate) ) {
            include ($defaultTemplate);
        } elseif (file_exists($defaultTemplateCore) && is_file($defaultTemplateCore) ) {
            include ($defaultTemplateCore);
        }
        $result = ob_get_clean();
        return $result;
    }    

    /**
     * Get asset path
     * 
     * @param string $name
     * @return string
     */
    public function getAssetPath($name = NULL) {
        $resultPath = $this->baseDir;
        
        if (empty($name)) {
            if (file_exists($this->assetDir) && is_dir($this->assetDir)) {
                $resultPath = $this->assetDir;        
            } elseif (file_exists($this->defaultAssetDir) && is_dir($this->defaultAssetDir)) {
                $resultPath = $this->defaultAssetDir;        
            } elseif (file_exists($this->defaultAssetCoreDir) && is_dir($this->defaultAssetCoreDir)) {
                $resultPath = $this->defaultAssetCoreDir;        
            }
        } else {
            $asset = $this->assetDir . '/' . $name;
            $defaultAsset = $this->defaultAssetDir . '/' . $name;            
            $defaultAssetCore = $this->defaultAssetCoreDir . '/' . $name;            
            if ( file_exists($asset) && is_file($asset) ) {
                $resultPath = $asset;
            } elseif ( file_exists($defaultAsset) && is_file($defaultAsset) ) {
                $resultPath = $defaultAsset;
            } elseif ( file_exists($defaultAssetCore) && is_file($defaultAssetCore) ) {
                $resultPath = $defaultAssetCore;
            }
        }
        
        return $resultPath;
    }
    
    /**
     * Get asset Url
     * 
     * @param string $name
     * @return string
     */
    public function getAssetUrl($name = NULL) {
        return $this->toUrl( $this->getAssetPath($name) );
    }    
    
    /**
     * Gets debug information
     * 
     * @param all $var
     */
    static public function debug ($var, $echo = true) {
        if (!$echo) {
            ob_start();
        }
        print_r('<pre>');
        print_r($var);
        print_r('</pre>');
        if (!$echo) {
            $result = ob_get_clean();
            return $result;
        }        
    }

    static public function getFiltersForHook( $hook = '', $echo = true ) {
        global $wp_filter;

        $hooks = isset( $wp_filter[$hook] ) ? $wp_filter[$hook] : array();  
        $hooks = call_user_func_array( 'array_merge', $hooks );

        foreach( $hooks as &$item ) {
            // function name as string or static class method eg. 'Foo::Bar'
            if ( is_string( $item['function'] ) ) { 
                $ref = strpos( $item['function'], '::' ) ? new \ReflectionClass( strstr( $item['function'], '::', true ) ) : new \ReflectionFunction( $item['function'] );
                $item['file'] = $ref->getFileName();
                $item['line'] = get_class( $ref ) == 'ReflectionFunction' 
                    ? $ref->getStartLine() 
                    : $ref->getMethod( substr( $item['function'], strpos( $item['function'], '::' ) + 2 ) )->getStartLine();

            // array( object, method ), array( string object, method ), array( string object, string 'parent::method' )
            } elseif ( is_array( $item['function'] ) ) {

                $ref = new \ReflectionClass( $item['function'][0] );

                // $item['function'][0] is a reference to existing object
                $item['function'] = array(
                    is_object( $item['function'][0] ) ? get_class( $item['function'][0] ) : $item['function'][0],
                    $item['function'][1]
                );
                $item['file'] = $ref->getFileName();
                $item['line'] = strpos( $item['function'][1], '::' )
                    ? $ref->getParentClass()->getMethod( substr( $item['function'][1], strpos( $item['function'][1], '::' ) + 2 ) )->getStartLine()
                    : $ref->getMethod( $item['function'][1] )->getStartLine();

            // closures
            } elseif ( is_callable( $item['function'] ) ) {     
                $ref = new \ReflectionFunction( $item['function'] );         
                $item['function'] = get_class( $item['function'] );
                $item['file'] = $ref->getFileName();
                $item['line'] = $ref->getStartLine();

            }       
        }
        
        if (!$echo) {
            ob_start();
        }
        print_r('<pre>');
        print_r($hooks);
        print_r('</pre>');
        if (!$echo) {
            $result = ob_get_clean();
            return $result;
        }        
    }  

    /**
     * Gets url for the specified file path
     * 
     * @param string $file
     * @return string
     */    
    public function toUrl($file = '') {
        
        // Get correct URL and path to wp-content
        $content_url = content_url();
        $content_dir = untrailingslashit( dirname( dirname( get_stylesheet_directory() ) ) );    

        // Fix path on Windows
        $sfile = str_replace( '\\', '/', $file );
        $content_dir = str_replace( '\\', '/', $content_dir );
        
        $result = str_replace( $content_dir, $content_url, $sfile );
        if ( $result == $sfile ) {
            $result = plugin_dir_url($file) . basename($file);
        }
        
        return $result;   
    }
    
    /**
     * Gets curent URL
     * 
     * @global type $wp
     * @return type
     */
    public function getCurrentUrl() {
        global $wp;
        return add_query_arg( $_SERVER['QUERY_STRING'], '', home_url( $wp->request ) );         
    }    
    
    /**
     * Gets base URL
     * 
     * @return type
     */
    public function getBaseUrl() {
        return $this->toUrl($this->baseDir);
    }
    
    /**
     * Getters and Setters
     */ 

    public function getBaseDir() {
        return $this->baseDir;
    }

    public function getDefaultTemplateDir() {
        return $this->defaultTemplateDir;
    }

    public function getTemplateDir() {
        return $this->templateDir;
    }

    public function getModuleName() {
        return $this->moduleName;
    }

    public function setBaseDir($baseDir) {
        $this->moduleName = NULL;
        $this->defaultTemplateDir = NULL;
        $this->defaultAssetDir = NULL;
        $this->templateDir = NULL;
        $this->assetDir = NULL;        

        $this->baseDir = $baseDir;
        if (!empty($this->baseDir)) {
            $this->moduleName = basename( $this->baseDir );        
            $this->defaultTemplateDir = $this->baseDir . '/templates';
            $this->defaultAssetDir = $this->baseDir . '/assets';
            $this->templateDir = get_stylesheet_directory() . '/templates/'. $this->moduleName;
            $this->assetDir = $this->templateDir . '/assets';                    
        }
        return $this;
    }

    public function setDefaultTemplateDir($defaultTemplateDir) {
        $this->defaultTemplateDir = $defaultTemplateDir;
        return $this;
    }

    public function setTemplateDir($templateDir) {
        $this->templateDir = $templateDir;
        return $this;
    }

    public function setModuleName($moduleName) {
        $this->moduleName = $moduleName;
        return $this;
    }

    public function getDefaultAssetDir() {
        return $this->defaultAssetDir;
    }

    public function getAssetDir() {
        return $this->assetDir;
    }

    public function setDefaultAssetDir($defaultAssetDir) {
        $this->defaultAssetDir = $defaultAssetDir;
        return $this;
    }

    public function setAssetDir($assetDir) {
        $this->assetDir = $assetDir;
        return $this;
    }
    
    public function getBaseCoreDir() {
        return $this->baseCoreDir;
    }

    public function getDefaultAssetCoreDir() {
        return $this->defaultAssetCoreDir;
    }

    public function setBaseCoreDir($baseCoreDir) {
        $this->baseCoreDir = $baseCoreDir;
        return $this;
    }

    public function setDefaultAssetCoreDir($defaultAssetCoreDir) {
        $this->defaultAssetCoreDir = $defaultAssetCoreDir;
        return $this;
    }

    public function getDefaultTemplateCoreDir() {
        return $this->defaultTemplateCoreDir;
    }

    public function setDefaultTemplateCoreDir($defaultTemplateCoreDir) {
        $this->defaultTemplateCoreDir = $defaultTemplateCoreDir;
        return $this;
    }

    public function getKey() {
        return $this->key;
    }

    public function setKey($key) {
        $this->key = $key;
        return $this;
    }
    
    public function getLessParser() {
        return $this->lessParser;
    }

    public function getSettings() {
        return $this->settings;
    }

    public function setSettings(SettingsAbstract $settings) {
        $this->settings = $settings;
        return $this;
    }
    
    public function getVersion() {
        return $this->version;
    }

    public function setVersion($version) {
        $this->version = $version;
        return $this;
    }

    public function getHelper() {
        return $this->helper;
    }

    public function setHelper(ModuleHelper $helper) {
        $this->helper = $helper;
        return $this;
    }

}
