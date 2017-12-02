<?php
/**
 * SCREETS © 2016
 *
 * Plugin post type(s)
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
 * Register post types
 *
 * @since Live Chat (2.0)
 * @return void
 */
function fn_schat_post_types() {

	// Register Offline Messages post type
	$labels = array(
		'name'                => _x( 'Offline Messages', 'Post Type General Name', 'schat' ),
		'singular_name'       => _x( 'Offline Message', 'Post Type Singular Name', 'schat' ),
		'menu_name'           => __( 'Offline Message', 'schat' ),
		'parent_item_colon'   => __( 'Parent Offline Message:', 'schat' ),
		'all_items'           => __( 'All Offline Messages', 'schat' ),
		'view_item'           => __( 'View Offline Message', 'schat' ),
		'add_new_item'        => __( 'Add New Offline Message', 'schat' ),
		'add_new'             => __( 'New Offline Message', 'schat' ),
		'edit_item'           => __( 'Edit Offline Message', 'schat' ),
		'update_item'         => __( 'Update Offline Message', 'schat' ),
		'search_items'        => __( 'Search offline message', 'schat' ),
		'not_found'           => __( 'No offline message found', 'schat' ),
		'not_found_in_trash'  => __( 'No offline message found in Trash', 'schat' ),
	);

	$args = array(
		'labels'              => $labels,
		'supports'            => array( 'title' ),
		'hierarchical'        => false,
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => 'schat_console',
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => false,
		'menu_position'       => 60,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'rewrite' 			  => false,
		'capability_type'     => 'page',
		'capabilities' 		  => array(
			// 'create_posts' => false
		)
	);
	register_post_type( 'schat_offline_msg', $args );

	/*$labels = array(
		'name'                => _x( 'Support Topics', 'Post Type General Name', 'schat' ),
		'singular_name'       => _x( 'Support Topic', 'Post Type Singular Name', 'schat' ),
		'menu_name'           => __( 'Support Topics', 'schat' ),
		'name_admin_bar'      => __( 'Support Topics', 'schat' ),
		'parent_item_colon'   => __( 'Parent Item:', 'schat' ),
		'all_items'           => __( 'All Items', 'schat' ),
		'add_new_item'        => __( 'New Support Topic', 'schat' ),
		'add_new'             => __( 'Add New', 'schat' ),
		'new_item'            => __( 'New Item', 'schat' ),
		'edit_item'           => __( 'Edit Item', 'schat' ),
		'update_item'         => __( 'Update Item', 'schat' ),
		'view_item'           => __( 'View Item', 'schat' ),
		'search_items'        => __( 'Search Item', 'schat' ),
		'not_found'           => __( 'Not found', 'schat' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'schat' ),
	);
	register_post_type( 'schat_topic', array(
		'label'               => __( 'schat_topic', 'schat' ),
		'description'         => __( 'Support Topics', 'schat' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor' ),
		'taxonomies'          => array( 'schat_support_cat' ),
		'hierarchical'        => false,
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => 'schat_console', // Setup top level menu
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	) );

	//
	// Support category taxonomy
	//
	$labels = array(
		'name'                       => _x( 'Support Categories', 'Taxonomy General Name', 'schat' ),
		'singular_name'              => _x( 'Support Category', 'Taxonomy Singular Name', 'schat' ),
		'menu_name'                  => __( 'Support Categories', 'schat' ),
		'all_items'                  => __( 'Support Categories', 'schat' ),
		'parent_item'                => __( 'Parent item', 'schat' ),
		'parent_item_colon'          => __( 'Parent item', 'schat' ),
		'new_item_name'              => __( 'New Support Category', 'schat' ),
		'add_new_item'               => __( 'New Support Category', 'schat' ),
		'edit_item'                  => __( 'Edit Support Category', 'schat' ),
		'update_item'                => __( 'Update', 'schat' ),
		'view_item'                  => __( 'View', 'schat' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'schat' ),
		'add_or_remove_items'        => __( 'Add or remove', 'schat' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'schat' ),
		'popular_items'              => __( 'Popular Support Categories', 'schat' ),
		'search_items'               => __( 'Search', 'schat' ),
		'not_found'                  => __( 'Not Found', 'schat' ),
	);
	register_taxonomy( 'schat_support_cat', 'schat_topic', array(
		'labels'					=> $labels,
		'hierarchical'				=> true,
		'public'					=> false,
		'show_ui'					=> true,
		'show_admin_column'			=> true,
		'show_in_nav_menus'			=> true,
		'show_tagcloud'				=> false
	));*/

}

add_action( 'init', 'fn_schat_post_types', 0 );



