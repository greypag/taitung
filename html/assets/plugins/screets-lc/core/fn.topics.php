<?php
/**
 * SCREETS © 2016
 *
 * Support category and topic functions
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
 * Setup support categories list
 *
 * @since Live Chat (2.0)
 */
class SLC_cat_walker extends Walker_Category {

	/**
	 * Starts the list before the elements are added
	 */
	function start_lvl( &$output, $depth = 1, $args = array() ) {  
        $output .= "\n<ul class=\"schat-cat-sub schat-depth-{$depth}\">\n";  
    }  

    /**
	 * Ends the list of after the elements are added
	 */
    function end_lvl( &$output, $depth = 0, $args = array() ) {  
        $output .= "</ul>\n";  
    }  

    /**
	 * Start the element output
	 */
	function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		
		 $cat_name = apply_filters(
			'list_cats',
			esc_attr( $category->name ),
			$category
		);


		// Don't generate an element if the category name is empty.
		if ( ! $cat_name ) {
			return;
		}

		// Get taxonomy meta
		$cat_meta = get_option( 'taxonomy_' . $category->term_id );
		$cat_thumb = '';
		$cat_desc = esc_attr( strip_tags( $category->description ) );

		if( !empty( $cat_meta['featured_img'] ) ) {
			$cat_thumb = wp_get_attachment_url( $cat_meta['featured_img'] );
		}

		// Get specific data attributes
		$data  = 'data-name="' . $cat_name . '" ';
		$data .= 'data-img="' . $cat_thumb . '" ';
		$data .= 'data-count="' . $category->count . '" ';

		// Get the link
		$link = '<a href="' . esc_url( get_term_link( $category ) ) . '" data-id="' . $category->term_id . '" ' . $data;

		if ( $args['use_desc_for_title'] && ! empty( $category->description ) ) {	

			$link .= 'title="' . $cat_desc . '"';

		}

		$link .= '>';

		if( !empty( $cat_thumb) ) {
			$link .= '<div class="schat-thumb"><img src="'. $cat_thumb .'" alt=""></div>';
		}

		$link .= '<div class="schat-title">';
		$link .= "\t<div class=\"schat-name\">{$cat_name}</div>";
		$link .= "\t<div class=\"schat-desc\">{$cat_desc}</div>";
		$link .= '</div></a>';

		if ( 'list' == $args['style'] ) {
			$output .= "\t<li";

			// Get CSS classes
			$css_classes = array(
					'schat-cat-item',
					'schat-cat-item-' . $category->term_id,
			);

			if ( ! empty( $args['current_category'] ) ) {
				$_current_category = get_term( $args['current_category'], $category->taxonomy );
				if ( $category->term_id == $args['current_category'] ) {
					$css_classes[] = 'schat-active';
				} elseif ( $category->term_id == $_current_category->parent ) {
					$css_classes[] = 'schat-active-parent';
				}
			}

			$css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );

			$output .=  ' class="' . $css_classes . '"';
			$output .= ">$link\n";

		} else {
			$output .= "\t$link<br />\n";
		}

	}

	/**
	 * Ends the element output, if needed
	 */
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}
}

/**
 * Get support categories list
 *
 * @since Live Chat (2.0)
 * @return string Returns list of support categories list or false if no category found
 */
function fn_schat_get_support_cats() {

	return wp_list_categories( array(
		'hide_empty' => false,
		'title_li' => '',
		'echo' => false,
		'taxonomy' => 'schat_support_cat',
		'walker' => new SLC_cat_walker
	));

}

/**
 * Get support topics list as list
 *
 * @since Live Chat (2.0)
 * @return string Returns list of support categories list or false if no category found
 */
function fn_schat_get_support_topics_list( $cat_id ) {

	global $post, $SChat;

	$html = '';

	// Get topics
	$topics = get_posts( array(
		'post_type' => 'schat_topic',
		'tax_query' => array(
			array(
				'taxonomy' => 'schat_support_cat',
				'field' => 'term_id',
				'terms' => $cat_id,
			)
		)
	));

	if( !empty( $topics ) ) {
		foreach ( $topics as $post ) { 
			setup_postdata( $post );
			
			// Get default click action
			$click_act = $SChat->opts->getOption( 'topic-click-action', get_the_id() );
			
			// Include list into html content
			$html .= '<li><a href="' . esc_url( get_permalink() ) . '" data-id="' . get_the_id() . '" data-name="' . get_the_title() . '" data-action="' . $click_act . '">' . get_the_title()  . '</a></li>' . PHP_EOL;
		}
		wp_reset_postdata();

	// No topics found
	} else { 
		$html .= '<li><a href="javascript:;">' . __( 'No topics found', 'schat' ) . '</a></li>'; 
	}

	return $html;
}