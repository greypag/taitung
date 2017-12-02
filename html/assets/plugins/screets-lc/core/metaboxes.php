<?php
/**
 * SCREETS © 2016
 *
 * Plugin custom post types metaboxes
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

/**
 * Get Metabox form options
 *
 * @since Live Chat (2.0)
 * @return array $opts
 */
function fn_schat_get_metaboxes( $type = 'post') {

	switch( $type ) {
		
		// Post and custom post types
		case 'post':

			$opts = array(
				
			);

		break;

		// Topics
		case 'topic':
			$opts = array(
				array(
					'id' => 'topic-click-action',
					'name' => __( 'Click action', 'schat' ),
					'desc' => __( 'This action will occur when visitor clicks the topic in the list', 'schat' ),
					'options' => array(
						'show' => __( 'Show topic content', 'schat' ),
						'connect_op' => __( 'Connect to operator', 'schat' )
					),
					'default' => 'show',
					'type' => 'select'
				)
			);

		break;

	}

	return $opts;

}