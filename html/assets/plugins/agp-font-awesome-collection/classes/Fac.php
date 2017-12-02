<?php
namespace Agp\Plugin\Fac;

use Fac\Core\ModuleAbstract;

class Fac extends ModuleAbstract {
    
    
    /**
     * Ajax
     * 
     * @var Ajax
     */
    private $ajax;
    
    /**
     * Shortcode Conctructor
     * 
     * @var Constructor
     */
    private $constructor;
    
    /**
     * Icon Repository
     * 
     * @var IconRepository
     */
    private $iconRepository;        
    
    
    /**
     * Shortcodes
     * 
     * @var Shortcodes
     */
    private $shortcodes;
    
    /**
     * Slider
     * 
     * @var Slider 
     */
    private $slider;
    
    /**
     * Custom elements
     * 
     * @var array
     */
    private $customElements;
    
    /**
     * slider elements
     * 
     * @var array
     */    
    private $sliderElements;
    
    
    /**
     * Taxonomy icons
     * 
     * @var TaxonomyIcons
     */
    private $taxonomyIcons;
    
    
    /**
     * Menu icons
     * 
     * @var MenuIcons
     */
    private $menuIcons;
    

    /**
     * LESS Parser
     * 
     * @var Less_Parser
     */
    private $lessParser;    

    /**
     * Environment
     * 
     * @var string 
     */
    private $environment;
    
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
        $this->setKey('fac');
        parent::__construct(dirname(dirname(__FILE__)));
        
        $this->lessParser = new \Less_Parser();        
        $this->iconRepository = new Persistence\IconRepository();
        $this->setSettings( Settings::instance( $this ) );        
        $this->setVersion( $this->getSettings()->getVersion() );        
        $this->environment = $this->getSettings()->getEnvironment();
        
        if ( $this->isActiveModule('m_shortcodes') ) {
            include_once ( $this->getBaseDir() . '/types/shortcodes-post-type.php' );                    
        }
        
        if ( $this->isActiveModule('m_sliders') ) {
            include_once ( $this->getBaseDir() . '/types/sliders-post-type.php' );                    
        }
        
        if ( $this->isActiveModule('m_visual_constructor') ) {
            $this->constructor = Constructor::instance();    
        }
        
        if ( $this->isActiveModule('m_shortcodes') ) {
            $this->shortcodes = Shortcodes::instance();    
        }
        
        $this->ajax = Ajax::instance();
        
        if ( $this->isActiveModule('m_sliders') ) {
            $this->slider = Slider::instance();    
        }
        
        if ( $this->isActiveModule('m_tax_icons') ) {
            $this->taxonomyIcons = TaxonomyIcons::instance();    
        }
        
        if ( $this->isActiveModule('m_menu_icons') ) {
            $this->menuIcons = MenuIcons::instance();    
        }        
        
        add_action( 'init', array($this, 'registerShortcodes' ), 998 );                
        add_action( 'wp_enqueue_scripts', array($this, 'enqueueScripts' ));                
        add_action( 'admin_enqueue_scripts', array($this, 'enqueueAdminScripts' ));                
        add_action( 'widgets_init', array($this, 'initWidgets' ) );
        add_action( 'admin_init', array($this, 'facTinyMCEButtons' ) );
        add_action( 'wp_print_scripts', array($this, 'facFooter' ) );
    }
    
    public function facFooter () {
        wp_enqueue_style( 'fac-fa' );        
    }
    
    public function registerShortcodes() {
        $shortcodes = $this->getSettings()->getShortcodes();
        if (!empty($shortcodes)) {
            foreach ($shortcodes as $key => $obj) {
                add_shortcode( $key, array( $this, 'doShortcode' ) );                     
            }
        }
        
        if ( $this->isActiveModule('m_shortcodes') ) {
            $this->customElements = $this->getSettings()->getCustomElementList();        
            if (!empty($this->customElements)) {
                foreach ($this->customElements as $key => $title) {
                    add_shortcode( $key, array( $this, 'doShortcode' ) );                     
                }
            }            
        }

        if ( $this->isActiveModule('m_sliders') ) {
            $this->sliderElements = $this->getSettings()->getSliderElementList();        
            if (!empty($this->sliderElements)) {
                foreach ($this->sliderElements as $key => $title) {
                    add_shortcode( $key, array( $this, 'doShortcode' ) );                     
                }
            }                    
        }

    }
    
    public function init () {
        $this->iconRepository->refreshRepository();
        parent::init();        
    }
    
    public function facTinyMCEButtons () {
        if ( current_user_can('edit_posts') && current_user_can('edit_pages') && $this->isActiveModule('m_visual_constructor')) {
            if ( get_user_option('rich_editing') == 'true' ) {
               add_filter( 'mce_buttons', array($this, 'facTinyMCERegisterButtons'));                
               add_filter( 'mce_external_plugins', array($this, 'facTinyMCEAddPlugin') );
            }        
        }        
    }

    public function facTinyMCERegisterButtons( $buttons ) {
       array_push( $buttons, "|", "fac_icon" );
       return $buttons;
    }    
    
    public function facTinyMCEAddPlugin( $plugin_array ) {
        $plugin_array['agp_fac_icon'] = $this->getAssetUrl("js/fac-icon{$this->getPrefix()}.js");
        return $plugin_array;        
    }        
    
    public function enqueueScripts () {
        wp_enqueue_script( 'fac-mobile', $this->getAssetUrl('libs/jquery.mobile.min.js'), array('jquery') );
        wp_enqueue_script( 'fac-slider', $this->getAssetUrl("libs/responsiveslides{$this->getPrefix()}.js"), array('jquery') );
        wp_enqueue_script( 'fac', $this->getAssetUrl("js/main{$this->getPrefix()}.js"), array('jquery', 'fac-mobile', 'fac-slider') );                                                         
        wp_enqueue_style( 'fac-css', $this->getAssetUrl("css/style{$this->getPrefix()}.css") );  
        wp_register_style( 'fac-fa', $this->getBaseUrl() ."/vendor/agp/agp-fontawesome/css/font-awesome{$this->getPrefix()}.css" );
    }        
    
    public function enqueueAdminScripts () {
        wp_enqueue_style( 'wp-color-picker' );        
        wp_enqueue_script( 'wp-color-picker' );   
        wp_enqueue_script( 'jquery-ui-sortable' );            
        wp_enqueue_script('colorbox-js', $this->getAssetUrl('libs/colorbox/jquery.colorbox-min.js'), array('jquery'));
        wp_enqueue_style('colorbox-css', $this->getAssetUrl('libs/colorbox/colorbox.css'));        
        wp_enqueue_script( 'fac', $this->getAssetUrl("js/admin{$this->getPrefix()}.js"), array('jquery', 'wp-color-picker') );                                                         
        wp_enqueue_style( 'fac-css', $this->getAssetUrl("css/admin{$this->getPrefix()}.css") );  
        wp_enqueue_style( 'fac-css-front', $this->getAssetUrl("css/style{$this->getPrefix()}.css") );          

        wp_localize_script( 'fac', 'ajax_fac', array( 
            'base_url' => site_url(),         
            'ajax_url' => admin_url( 'admin-ajax.php' ), 
            'ajax_nonce' => wp_create_nonce('ajax_atf_nonce'),        
        ));    
        wp_register_style( 'fac-fa', $this->getBaseUrl() ."/vendor/agp/agp-fontawesome/css/font-awesome{$this->getPrefix()}.css" );
    }            

    public function getIconRepository() {
        return $this->iconRepository;
    }

    public function setIconRepository(IconRepository $iconRepository) {
        $this->iconRepository = $iconRepository;
        return $this;
    }
    
    public function doDynamicCss ($fileName, $atts = array()) {
        if ( is_admin() ) {
            $this->getLessParser()->getLessParser()->Reset();
            $this->getLessParser()->getLessParser()->parseFile( $fileName );
            $this->getLessParser()->getLessParser()->ModifyVars( $atts );
            $css = Fac()->getLessParser()->getLessParser()->getCss();            
            if ( !empty($css) ) {
                echo '<style type="text/css" >' . $css . '</style>';                    
            }
        } else {
            $this->getLessParser()->getLessParser()->Reset();
            $this->getLessParser()->registerLessCss( $fileName, $atts );            
        }
    }
    
    public function doPreview ($atts, $content, $tag) {
        $shortcodes = $this->getSettings()->getShortcodes();
        $customShortcodes = $this->customElements;
        $sliderShortcodes = $this->sliderElements;
        
        if (!empty($shortcodes[$tag])) {
            $obj = $shortcodes[$tag];
            $default = $this->getSettings()->getShortcodeDefaults($tag);            
            if (empty($atts) || !is_array($atts)) {
                $atts = array();
            }
            $atts = array_merge($default, $atts );        
            
            return $this->getTemplate($obj->template, $atts);                             
        } elseif (!empty($customShortcodes[$tag])) {
            return $this->doCustomShortcode($atts, $content, $tag);
        } elseif (!empty($sliderShortcodes[$tag])) {
            //return $this->doSliderShortcode($atts, $content, $tag);
        }
    }        
    
    public function doShortcode ($atts, $content, $tag) {
        $shortcodes = $this->getSettings()->getShortcodes();
        $customShortcodes = $this->customElements;
        $sliderShortcodes = $this->sliderElements;
        
        if (!empty($shortcodes[$tag])) {
            $obj = $shortcodes[$tag];
            $default = $this->getSettings()->getShortcodeDefaults($tag);            
            if (empty($atts) || !is_array($atts)) {
                $atts = array();
            }
            $atts = array_merge($default, $atts );        
            
            return $this->getTemplate($obj->template, $atts);                             
        } elseif (!empty($customShortcodes[$tag])) {
            return $this->doCustomShortcode($atts, $content, $tag);
        } elseif (!empty($sliderShortcodes[$tag])) {
            return $this->doSliderShortcode($atts, $content, $tag);
        }
    }    
    
    public function doCustomShortcode ($atts, $content, $tag) {
        global $post;
        $content = '';
        
        $args = array(
            'post_type' => 'fac-shortcodes',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key'     => '_name',
                    'value'   => array( $tag ),
                    'compare' => 'IN',
                ),
            ),            
        );

        $query = new \WP_Query($args);
        
        while ( $query->have_posts() ) : $query->the_post();
            $content .= do_shortcode( get_post_field('post_content', $post->ID) );
        endwhile;        
        
        wp_reset_query();
        
        return $content;        
    }    
    
    public function doSliderShortcode ($atts, $content, $tag) {
        global $post;    
        $content = '';
        
        $args = array(
            'post_type' => 'fac-sliders',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key'     => '_name',
                    'value'   => array( $tag ),
                    'compare' => 'IN',
                ),
            ),            
        );

        $query = new \WP_Query($args);
        
        while ( $query->have_posts() ) : $query->the_post();
            $post_id = get_the_ID();
            $template = 'sliders/' . Fac()->getSlider()->getSliderType($post_id) . '/layout';
            $data = $this->slider->getData($post_id);
            $content .= $this->getTemplate($template, array('data' => $data, 'post_id' => $post_id ));
        endwhile;        

        wp_reset_query();
        
        return $content;        
    }      
    
    public function initWidgets() {
        if ( $this->isActiveModule('m_promotion_widget') ) {
            register_widget('Agp\Plugin\Fac\Widget\Promotion');    
        }
        
        if ( $this->isActiveModule('m_promotion_slider_widget') ) {
            register_widget('Agp\Plugin\Fac\Widget\PromotionSlider');    
        }
        
    }    
    
    public function isActiveModule ( $module ) {
        $settings = $this->getSettings()->getGlobalSettings();
        return !empty($settings[$module]);
    }

    public function getConstructor() {
        return $this->constructor;
    }
    
    public function getAjax() {
        return $this->ajax;
    }
    
    public function getShortcodes() {
        return $this->shortcodes;
    }

    public function getCustomElements() {
        return $this->customElements;
    }
    
    public function getSlider() {
        return $this->slider;
    }
    
    public function getSliderElements() {
        return $this->sliderElements;
    }

    public function getTaxonomyIcons() {
        return $this->taxonomyIcons;
    }
    
    public function getMenuIcons() {
        return $this->menuIcons;
    }

    public function getEnvironment() {
        return $this->environment;
    }
    
    public function getPrefix() {
        return ($this->environment == 'production') ? '.min' : '';
    }

}