<?php
/**
 * SCREETS © 2016
 *
 * Template class
 *
 * COPYRIGHT © 2016 Screets d.o.o. All rights reserved.
 * This  is  commercial  software,  only  users  who have purchased a valid
 * license  and  accept  to the terms of the  License Agreement can install
 * and use this program.
 *
 * @package Live Chat
 * @author Screets
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class SLC_template {


	protected $file;
	protected $values = array();

	/**
	 * Construct
	 */
	public function __construct( $file ) {
		
		$this->file = $file;

	}

	/**
	 * Set value
	 */
	public function set( $key, $value ) {
		$this->values[$key] = $value;
	}

	/**
	 * Merge templates
	 */
	static public function merge( $templates, $separator = "n" ) {
		$output = "";
	
		foreach ( $templates as $template ) {
			$content = ( get_class( $template ) !== "SLC_template" )
				? "Error, incorrect type - expected Template."
				: $template->render();
			
			$output .= $content . $separator;

		}
	 
		return $output;
	}

	/**
	 * Render
	 */
	public function render() {

		if ( !file_exists(  $this->file ) ) {
			return "Error loading template file ($this->file).";
		}
		$output = file_get_contents( $this->file );
	  
		foreach ( $this->values as $key => $value ) {
			$tag = "{@$key}";
			$output = str_replace( $tag, $value, $output );
		}
	  
		return $output;
	}


}
