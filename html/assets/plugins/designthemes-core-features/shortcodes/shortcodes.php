<?php
class DTCoreShortcodesDefination {

	function __construct() {

		/* Accordion Shortcode */
		add_shortcode ( "dt_sc_accordion_group", array (
				$this,
				"dt_sc_accordion_group"
		) );

		/* Button Shortcode */
		add_shortcode ( "dt_sc_button", array (
				$this,
				"dt_sc_button"
		) );

		/* BlockQuotes Shortcode */
		add_shortcode ( "dt_sc_blockquote", array (
				$this,
				"dt_sc_blockquote"
		) );

		/* Callout Box Shortcode */
		add_shortcode ( "dt_sc_callout_box", array (
				$this,
				"dt_sc_callout_box"
		) );

		/* Columns Shortcode */
		add_shortcode ( "dt_sc_one_column", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_one_half", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_one_third", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_one_fourth", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_one_fifth", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_one_sixth", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_two_sixth", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_two_third", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_three_fourth", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_two_fifth", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_three_fifth", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_four_fifth", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_three_sixth", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_four_sixth", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_five_sixth", array (
				$this,
				"dt_sc_columns"
		) );

		/* Column with inner */
		add_shortcode ( "dt_sc_one_half_inner", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_one_third_inner", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_one_fourth_inner", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_one_fifth_inner", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_one_sixth_inner", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_two_sixth_inner", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_two_third_inner", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_three_fourth_inner", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_two_fifth_inner", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_three_fifth_inner", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_four_four_inner", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_three_sixth_inner", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_four_sixth_inner", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_five_sixth_inner", array (
				$this,
				"dt_sc_columns"
		) );

		add_shortcode ( "dt_sc_four_fifth_inner", array (
				$this,
				"dt_sc_columns"
		) );

		/* Contact Information */
		#Address
		add_shortcode ( "dt_sc_address", array (
				$this,
				"dt_sc_address"
		) );

		#Phone
		add_shortcode ( "dt_sc_phone", array (
				$this,
				"dt_sc_phone"
		) );

		#Mobile
		add_shortcode ( "dt_sc_mobile", array (
				$this,
				"dt_sc_mobile"
		) );

		#Fax
		add_shortcode ( "dt_sc_fax", array (
				$this,
				"dt_sc_fax"
		) );

		#Email
		add_shortcode ( "dt_sc_email", array (
				$this,
				"dt_sc_email"
		) );

		#Web
		add_shortcode ( "dt_sc_web", array (
				$this,
				"dt_sc_web"
		) );
		/* Contact Information End */

		/* Clients Carousel Shortcode */
		add_shortcode ( "dt_sc_clients_carousel", array (
				$this,
				"dt_sc_clients_carousel"
		) );

		/* Donutchart Start */
		add_shortcode ( "dt_sc_donutchart_small", array (
				$this,
				"dt_sc_donutchart"
		) );

		add_shortcode ( "dt_sc_donutchart_medium", array (
				$this,
				"dt_sc_donutchart"
		) );

		add_shortcode ( "dt_sc_donutchart_large", array (
				$this,
				"dt_sc_donutchart"
		) );
		/* Donutchart End */

		/* Dividers */

		/* Clear Shortcode */
		add_shortcode ( "dt_sc_clear", array (
				$this,
				"dt_sc_clear"
		) );

		/* HR With Border */
		add_shortcode( "dt_sc_hr_border", array (
				$this,
				"dt_sc_hr_border"
		) );

		add_shortcode ( "dt_sc_hr", array (
				$this,
				"dt_sc_dividers"
		) );

		add_shortcode ( "dt_sc_hr_top", array (
				$this,
				"dt_sc_hr_top"
		) );

		add_shortcode ( "dt_sc_hr_medium", array (
				$this,
				"dt_sc_dividers"
		) );

		add_shortcode ( "dt_sc_hr_large", array (
				$this,
				"dt_sc_dividers"
		) );

		add_shortcode ( "dt_sc_hr_invisible", array (
				$this,
				"dt_sc_dividers"
		) );

		add_shortcode ( "dt_sc_hr_invisible_small", array (
				$this,
				"dt_sc_dividers"
		) );

		add_shortcode ( "dt_sc_hr_invisible_medium", array (
				$this,
				"dt_sc_dividers"
		) );

		add_shortcode ( "dt_sc_hr_invisible_large", array (
				$this,
				"dt_sc_dividers"
		) );
		/* Dividers End */

		/* Icon Boxes Shortcode */
		add_shortcode ( "dt_sc_icon_box", array (
				$this,
				"dt_sc_icon_box"
		) );
		/* Icon Boxes Shortcode End*/

		/* Icon Boxes Shortcode */
		add_shortcode ( "dt_sc_icon_box_colored", array (
				$this,
				"dt_sc_icon_box_colored"
		) );
		/* Icon Boxes Shortcode End*/

		/* Dropcap Shortcode */
		add_shortcode ( "dt_sc_dropcap", array (
				$this,
				"dt_sc_dropcap"
		) );

		/* Code Shortcode */
		add_shortcode ( "dt_sc_code", array (
				$this,
				"dt_sc_code"
		) );

		/* Ordered List Shortcode */
		add_shortcode ( "dt_sc_fancy_ol", array (
				$this,
				"dt_sc_fancy_ol"
		) );

		/* Unordered List Shortcode */
		add_shortcode ( "dt_sc_fancy_ul", array (
				$this,
				"dt_sc_fancy_ul"
		) );

		/* Pricing Table */
		add_shortcode ( "dt_sc_pricing_table", array (
				$this,
				"dt_sc_pricing_table"
		) );
		add_shortcode ( "dt_sc_pricing_table_two", array (
				$this,
				"dt_sc_pricing_table"
		) );

		/* Pricing Table Item */
		add_shortcode ( "dt_sc_pricing_table_item", array (
				$this,
				"dt_sc_pricing_table_item"
		) );

		add_shortcode ( "dt_sc_pricing_table_item_two", array (
				$this,
				"dt_sc_pricing_table_item_two"
		) );

		/* Progress Bar Shortcode */
		add_shortcode ( "dt_sc_progressbar", array (
				$this,
				"dt_sc_progressbar"
		) );

		/* Tabs */
		add_shortcode ( "dt_sc_tab", array (
				$this,
				"dt_sc_tab"
		) );

		add_shortcode ( "dt_sc_tabs_horizontal", array (
				$this,
				"dt_sc_tabs_horizontal"
		) );

		add_shortcode ( "dt_sc_tabs_vertical", array (
				$this,
				"dt_sc_tabs_vertical"
		) );

		add_shortcode ( "dt_sc_tabs_vertical_with_icon", array (
				$this,
				"dt_sc_tabs_vertical"
		) );

		/* Team Shortcode */
		add_shortcode ( "dt_sc_team", array (
				$this,
				"dt_sc_team"
		) );

		/* Testimonial Shortcode */
		add_shortcode ( "dt_sc_testimonial", array (
				$this,
				"dt_sc_testimonial"
		) );

		/* Testimonial Carousel Shortcode */
		add_shortcode ( "dt_sc_testimonial_carousel", array (
				$this,
				"dt_sc_testimonial_carousel"
		) );

		/* Testimonial Shortcode */
		add_shortcode ( "dt_sc_client_testimonial", array (
				$this,
				"dt_sc_client_testimonial"
		) );

		/* Testimonial Carousel Shortcode */
		add_shortcode ( "dt_sc_client_testimonials", array (
				$this,
				"dt_sc_client_testimonials"
		) );

		/* Title Shortcode */
		add_shortcode ( "dt_sc_h1", array (
				$this,
				"dt_sc_title"
		) );

		add_shortcode ( "dt_sc_h2", array (
				$this,
				"dt_sc_title"
		) );

		add_shortcode ( "dt_sc_h3", array (
				$this,
				"dt_sc_title"
		) );

		add_shortcode ( "dt_sc_h4", array (
				$this,
				"dt_sc_title"
		) );

		add_shortcode ( "dt_sc_h5", array (
				$this,
				"dt_sc_title"
		) );

		add_shortcode ( "dt_sc_h6", array (
				$this,
				"dt_sc_title"
		) );

		add_shortcode ( "dt_sc_title_with_icon", array (
				$this,
				"dt_sc_title_with_icon"
		) );
		/* Title Shortcode End */

		/* Toggle Shortcode */
		add_shortcode ( "dt_sc_toggle", array (
				$this,
				"dt_sc_toggle"
		) );

		/* Toogle Framed Shortcode */
		add_shortcode ( "dt_sc_toggle_framed", array (
				$this,
				"dt_sc_toggle_framed"
		) );

		/* Titles Box Shortcode */
		add_shortcode ( "dt_sc_titled_box", array (
				$this,
				"dt_sc_titled_box"
		) );

		/* Tooltip Shortcode */
		add_shortcode ( "dt_sc_tooltip", array (
				$this,
				"dt_sc_tooltip"
		) );

		/* PullQuotes Shortcode */
		add_shortcode ( "dt_sc_pullquote", array (
				$this,
				"dt_sc_pullquote"
		) );

		/* Portfolio Shortcode */

		add_shortcode( "dt_sc_portfolio_item", array(
			$this,
			"dt_sc_portfolio_item"
		));

		add_shortcode( "dt_sc_portfolios", array(
			$this,
			"dt_sc_portfolios"
		));

		add_shortcode ( "dt_sc_infographic_bar", array (
				$this,
				"dt_sc_infographic_bar"
		) );

		/* Full width Shortcode*/
		add_shortcode("dt_sc_fullwidth_section", array(
				$this,
				"dt_sc_fullwidth_section"
		) );

		/* Full Width Video Shortcode */
		add_shortcode("dt_sc_fullwidth_video", array(
				$this,
				"dt_sc_fullwidth_video"
		));

		/* Animation */
		add_shortcode("dt_sc_animation", array(
			$this,
			"dt_sc_animation"
		) );

		/* Page Builder Utils */
		add_shortcode ( "dt_sc_doshortcode", array (
				$this,
				"dt_sc_doshortcode"
		));

		/* Resizeable Column */
		add_shortcode ( "dt_sc_resizable", array (
				$this,
				"dt_sc_resizable"
		));

		add_shortcode ( "dt_sc_resizable_inner", array (
				$this,
				"dt_sc_resizable"
		));

		add_shortcode ( "dt_sc_widgets", array (
				$this,
				"dt_sc_widgets"
		));
		/* Page Builder Utils */
	}

	/**
	 *
	 * @param string $content
	 * @return string
	 */
	function dtShortcodeHelper($content = null) {
		$content = do_shortcode ( shortcode_unautop ( $content ) );
		$content = preg_replace ( '#^<\/p>|^<br \/>|<p>$#', '', $content );
		$content = preg_replace ( '#<br \/>#', '', $content );
		return trim ( $content );
	}

	/**
	 *
	 * @param string $dir
	 * @return multitype:
	 */
	function dtListImages($dir = null) {
		$images = array ();
		$icon_types = array (
				'jpg',
				'jpeg',
				'gif',
				'png'
		);

		if (is_dir ( $dir )) {
			$handle = opendir ( $dir );
			while ( false !== ($dirname = readdir ( $handle )) ) {

				if ($dirname != "." && $dirname != "..") {
					$parts = explode ( '.', $dirname );
					$ext = strtolower ( $parts [count ( $parts ) - 1] );

					if (in_array ( $ext, $icon_types )) {
						$option = $parts [count ( $parts ) - 2];
						$images [$dirname] = str_replace ( ' ', '', $option );
					}
				}
			}
			closedir ( $handle );
		}

		return $images;
	}


	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_accordion_group($attrs, $content = null) {
		$out = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$out = str_replace ( "<h5 class='dt-sc-toggle", "<h5 class='dt-sc-toggle-accordion ", $out );
		$out = "<div class='dt-sc-toggle-frame-set'>{$out}</div>";
		return $out;
	}


	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_button($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'size' => '',
				'link' => '#',
				'type' => '',
				'iconstyle' =>'',
				'icon' => '',
				'target' => '',
				'variation' => '',
				'bgcolor' => '',
				'textcolor' => '',
				'class' =>''
		), $attrs ) );

		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );

		if( ($iconstyle !== "no-icon") && !empty($icon)  ){
			$content = "<i class='fa {$icon}'> </i>".$content;
		}

		$size = ($size == 'xlarge') ? ' xlarge' : $size;
		$size = ($size == 'large') ? ' large' : $size;
		$size = ($size == 'medium') ? ' medium' : $size;
		$size = ($size == 'small') ? ' small' : $size;

		$target = empty($target) ? 'target="_blank"' : "target='{$target}' ";

		$variation = (($variation) && (empty ( $bgcolor ))) ? ' ' . $variation : '';

		$styles = array ();
		if ($bgcolor)
			$styles [] = 'background-color:' . $bgcolor . ';border-color:' . $bgcolor . ';';
		if ($textcolor)
			$styles [] = 'color:' . $textcolor . ';';
		$style = join ( '', array_unique ( $styles ) );
		$style = ! empty ( $style ) ? ' style="' . $style . '"' : '';

		if(preg_match('#^{{#', $link) === 1) {
			$link =  str_replace ( '{{', '[', $link );
			$link =  str_replace ( '}}', '/]', $link );
			$link = do_shortcode($link);
		}else{
			$link = esc_url ( $link );
		}

		$type = ( $type === "type2" ) ? "bordered" : "";

		$hover = ( $iconstyle === "with-hover-effect") ? " with-icon " : "";

		$out = "<a href='{$link}' {$target} class='dt-sc-button {$class} {$size} {$variation} {$type} {$hover}' {$style}>{$content}</a>";
		return $out;
	}

	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_blockquote($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'type' => "type1",
				'align' => '',
				'variation' => '',
				'textcolor' => '',
				'cite'=> '',
				'role' =>''
		), $attrs ) );

		$class = array();
		if( preg_match( '/left|right|center/', trim( $align ) ) )
			$class[] = ' align' . $align;
		if( $variation)
			$class[] = ' ' . $variation;

		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$content = strip_tags($content);
		$content = ! empty ( $content ) ? "<q>{$content}</q>" : "";

		$cite = ! empty ( $cite ) ? '&ndash; ' .$cite : "";
		$role = ! empty ( $role ) ? '<br> <span>' . $role . '</span>' : "";

		$cite = !empty( $cite ) ? "<cite>$cite$role</cite>" : "";

		$style = ( $textcolor ) ? ' style="color:' . $textcolor . ';"' : '';
		$class = join( '', array_unique( $class ) );

		$out = "<blockquote class='{$type} {$class}' {$style}>{$content}{$cite}</blockquote>";
		return $out;
	}


	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_callout_box($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'type' => "type1",
				'link' => '#',
				'button_text'=> __('Purchase Now','dt_themes'),
				'icon' =>'',
				'target' => '',
				'class' => ''
		), $attrs ) );

		$attribute = !empty($icon) ? "class='dt-sc-callout-box with-icon {$type} {$class}' " :" class='dt-sc-callout-box {$type} {$class}' ";

		$target = empty($target) ? 'target="_blank"' : "target='{$target}' ";

		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );

		$out1 = ""; $out2 = "";

		$out1 = ( !empty( $title ) ) ? "<h2>{$title}</h2>" : "";

		if( !empty( $icon ) ):
			$out1 .= '<div class="icon">';
			$out1 .= "<span class='fa {$icon}'></span>";
			$out1 .= '</div>';
		endif;
		$out1 .= $content;

		if($type != 'type1' and $type != 'type2' and $type != 'type4') {
			$out1 = '<div class="column dt-sc-four-fifth first">'.$out1.'</div>';
		}

		$out2 = ( !empty($link) ) ? "<a href='{$link}' class='dt-sc-button small' {$target}>{$button_text}</a>" : "";

		if($type != 'type1' and $type != 'type2' and $type != 'type4') {
			$out2 = '<div class="column dt-sc-one-fifth">'.$out2.'</div>';
		}

		return "<div {$attribute}>".$out1.$out2."</div>";
	}

	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @param string $shortcodename
	 * @return string
	 */
	function dt_sc_columns($attrs, $content = null, $shortcodename = "") {
		extract ( shortcode_atts ( array (
				'id' => '',
				'class' => '',
				'style' => '' ,
				'type' => ''
		), $attrs ) );

		$shortcodename = str_replace ( "_", "-", $shortcodename );
		$shortcodename = str_replace ( "-inner", "", $shortcodename );

		$id = ($id != '') ? " id = '{$id}'" : '';
		$style = !empty( $style ) ? " style='{$style}' ": "";
		$type = ( trim($type) === 'type2' ) ? "no-space" : "space";
		$first = (isset ( $attrs [0] ) && trim ( $attrs [0] == 'first' )) ? 'first' : '';
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$out = "<div {$id} class='column {$shortcodename} {$class} {$type} {$first}' {$style} >{$content}</div>";
		return $out;
	}

	/* Contact Information */

	/**
	 * Shortcode : Address
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	 function dt_sc_address($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'line1' => '',
				'line2' => '',
				'line3' => '',
				'line4' => ''
		), $attrs ) );


		$out = '<div class="dt-sc-contact-info address">';
		$out .= "<p>";
		$out .= "<i class='fa fa-rocket'></i>";
		$out .= ( !empty($line1) ) ? $line1 : "";
		$out .= ( !empty($line2) ) ? "<br>$line2" : "";
		$out .= ( !empty($line3) ) ? "<br>$line3" : "";
		$out .= ( !empty($line4) ) ? "<br>$line4" : "";
		$out .= "</p>";
		$out .= '</div>';

		return $out;
	 }

	/**
	 * Shortcode : Phone
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	 function dt_sc_phone($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'phone' => ''
		), $attrs ) );

		$out = '<div class="dt-sc-contact-info">';
		$out .= ( !empty($phone) ) ?"<p><i class='fa fa-phone'></i>{$phone}</p>": "";
		$out .= '</div>';

		return $out;
	 }

	/**
	 * Shortcode : Mobile
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	 function dt_sc_mobile($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'mobile' => ''
		), $attrs ) );

		$out = '<div class="dt-sc-contact-info">';
		$out .= ( !empty($mobile) ) ?"<p><i class='fa fa-mobile-phone'></i>{$mobile}</p>": "";
		$out .= '</div>';

		return $out;
	 }

	/**
	 * Shortcode : Fax
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	 function dt_sc_fax($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'fax' => ''
		), $attrs ) );

		$out = '<div class="dt-sc-contact-info">';
		$out .= ( !empty($fax) ) ? "<p><i class='fa fa-file-text'></i>{$fax}</p>" : "";
		$out .= '</div>';

		return $out;
	 }

	/**
	 * Shortcode : Email id
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	 function dt_sc_email($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'emailid' => ''
		), $attrs ) );

		$out = '<div class="dt-sc-contact-info">';
		$out .= ( !empty($emailid) ) ? "<p><i class='fa fa-envelope-o'></i><a href='mailto:$emailid'>{$emailid}</a></p>" : "";
		$out .= '</div>';
		return $out;
	 }

	/**
	 * Shortcode : Website Url
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	 function dt_sc_web($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'url' => ''
		), $attrs ) );

		$out = '<div class="dt-sc-contact-info">';

		if( !empty( $url ) ) {
			$out .= "<p><i class='fa fa-globe'></i><a target='_blank' href='{$url}'>";
			$a = preg_replace('#^[^:/.]*[:/]+#i', '',urldecode( $url ));
			$out .=	preg_replace('!\bwww3?\..*?\b!', '', $a);
			$out .= "</a></p>";
		}
		$out .= '</div>';

		return $out;
	 }
	/* Contact Information End*/

	/* Client Carousel */
	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_clients_carousel($attrs, $content = null) {

		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$content = str_replace( '<ul>', "<ul class='dt-sc-partner-carousel'>", $content );


		$out = '<div class="dt-sc-partner-carousel-wrapper">';
		$out .= $content;
		$out .= '<div class="carousel-arrows">';
		$out .= '	<a href="" class="partner-prev"> </a>';
		$out .= '	<a href="" class="partner-next"> </a>';
		$out .= '</div>';
		$out .= '</div>';
		return $out;
	}

	/* Client Carousel End*/

	/* Dividers */
	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_clear($attrs, $content = null) {
		return '<div class="dt-sc-clear"></div>';
	}

	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_hr_border($attrs, $content = null) {
		return '<div class="dt-sc-hr-border"></div>';
	}


	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @param string $shortcodename
	 * @return string
	 */
	function dt_sc_donutchart($attrs, $content = null, $shortcodename = "") {
		extract ( shortcode_atts ( array (
				'title' => '',
				'bgcolor' => '',
				'fgcolor' => '',
				'percent' =>'30',
				'text' => ''
		), $attrs ) );

		$size = "160";
		$size = ( "dt_sc_donutchart_medium" === $shortcodename ) ? "260" : $size;
		$size = ( "dt_sc_donutchart_large" === $shortcodename ) ? "360" : $size;

		$shortcodename = str_replace ( "_", "-", $shortcodename );
		$out = "<div class='{$shortcodename}'>";
		$out .= "<div class='dt-sc-donutchart' data-size='{$size}' data-percent='{$percent}' data-bgcolor='{$bgcolor}' data-fgcolor='$fgcolor'></div>";
		$out .= ( empty($title) ) ? $out : "<h5 class='dt-sc-donutchart-title'>{$title}</h5>";
		if($text != "")
			$out .= "<p>{$text}</p>";
		$out .= '</div>';
		return $out;
	}

	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @param string $shortcodename
	 * @return string
	 */
	function dt_sc_dividers($attrs, $content = null, $shortcodename = "") {
		extract ( shortcode_atts ( array (
				'class' => '',
				'top' => ''
		), $attrs ) );

		if ("dt_sc_hr" === $shortcodename || "dt_sc_hr_medium" === $shortcodename || "dt_sc_hr_large" === $shortcodename) {

			$shortcodename = str_replace ( "_", "-", $shortcodename );

			$out = "<div class='{$shortcodename} {$class}'>";

			if ((isset ( $attrs [0] ) && trim ( $attrs [0] == 'top' ))) {

				$out = "<div class='{$shortcodename} top {$class}'>";
				$out .= "<a href='#top' class='scrollTop'><span class='fa fa-angle-up'></span>" . __ ( "top", 'dt_themes' ) . "</a>";
			}

			$out .= "</div>";
		} else {
			$shortcodename = str_replace ( "_", "-", $shortcodename );
			$out = "<div class='{$shortcodename}  {$class}'></div>";
		}
		return $out;
	}
	/* Dividers End*/

	function dt_sc_hr_top($attrs, $content = null, $shortcodename="" ){
		$out = do_shortcode("[dt_sc_hr top]");
		return $out;
	}

	/* Icon Boxes Shortcode */
	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @param string $shortcodename
	 * @return string
	 */
	function dt_sc_icon_box($attrs, $content = null, $shortcodename = "") {
		extract ( shortcode_atts ( array (
				'type' => '',
				'fontawesome_icon' => '',
				'custom_icon' => '',
				'color' => '',
				'title' => '',
				'link' => ''
		), $attrs ) );

		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );

		$out =  "<div class='dt-sc-ico-content {$type}'>";
		if( !empty($fontawesome_icon) ){
			$out .= "<div class='icon {$color}'> <span class='fa fa-{$fontawesome_icon}'> </span> </div>";

		}elseif( !empty($custom_icon) ){
			$out .= "<div class='icon {$color}'><a href='{$link}'><img title='' alt='' src='$custom_icon'></a></div>";
		}
    $out .= "<div class='icon-text'>"; //leon add div tag
		if( !empty($link) ) :
			$out .= empty( $title ) ? $out : "<h4><a href='{$link}'> {$title} </a></h4>";
		else:
			$out .= empty( $title ) ? $out : "<h4>{$title}</h4>";
		endif;

		$out .= $content;
		$out .= "</div>";
		$out .= "</div>";
		return $out;
	}
	/* Icon Boxes Short code End*/

	/* Icon Boxes Colored Short code */
	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @param string $shortcodename
	 * @return string
	 */
	function dt_sc_icon_box_colored($attrs, $content = null, $shortcodename = "") {
		extract ( shortcode_atts ( array (
				'type' => '',
				'fontawesome_icon' => '',
				'custom_icon' => '',
				'title' => '',
				'bgcolor' => ''
		), $attrs ) );

		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );

		$bgcolor = empty ( $bgcolor ) ? "" : " style='background:{$bgcolor};' ";

		$type = ( trim($type) === 'type1' ) ? "no-space" : "space";

		$out =  "<div class='dt-sc-colored-box {$type}' {$bgcolor}>";

		$icon = "";
		if( !empty($fontawesome_icon) ){
			$icon = "<span class='fa fa-{$fontawesome_icon}'> </span>";

		}elseif( !empty($custom_icon) ){
			$icon = "";
		}

		$out .= "<h5>{$icon}{$title}</h5>";
		$out .= $content;
		$out .= "</div>";
		return $out;
	}
	/* Icon Boxes Colored Short code End*/


	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @param string $shortcodename
	 * @return string
	 */
	function dt_sc_dropcap($attrs, $content = null, $shortcodename = "") {
		extract ( shortcode_atts ( array (
				'type' => '',
				'variation' => '',
				'bgcolor' => '',
				'textcolor' => ''
		), $attrs ) );

		$type = str_replace ( " ", "-", $type );
		$type = "dt-sc-dropcap-".strtolower ( $type );

		$bgcolor = ( $type == 'dt-sc-dropcap-default') ? "" : $bgcolor;
		$variation = ( ( $variation ) && ( empty( $bgcolor ) ) ) ? ' ' . $variation : '';

		$styles = array();
		if($bgcolor) $styles[] = 'background-color:' . $bgcolor . ';';
		if($textcolor) $styles[] = 'color:' . $textcolor . ';border-color:' . $textcolor . ';';;
		$style = join('', array_unique( $styles ) );
		$style = !empty( $style ) ? ' style="' . $style . '"': '' ;

		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );

		$out = "<span class='dt-sc-dropcap $type {$variation}' {$style}>{$content}</span>";
		return $out;
	}

	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_code($attrs, $content = null) {
		$array = array (
				'[' => '&#91;',
				']' => '&#93;',
				'/' => '&#47;',
				'<' => '&#60;',
				'>' => '&#62;',
				'<br />' => '&nbsp;'
		);
		$content = strtr ( $content, $array );
		$out = "<pre>{$content}</pre>";
		return $out;
	}

	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return mixed
	 */
	function dt_sc_fancy_ol($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'style' => '',
				'variation' => '',
				'class' => ''
		), $attrs ) );

		$style = ($style) ? trim ( $style ) : 'decimal';
		$class = ($class) ? trim ( $class ) : '';
		$variation = ($variation) ? ' ' . trim ( $variation ) : '';
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$content = str_replace ( '<ol>', "<ol class='dt-sc-fancy-list {$variation} {$class} {$style}'>", $content );
		$content = str_replace ( '<li>', '<li><span>', $content );
		$content = str_replace ( '</li>', '</span></li>', $content );
		return $content;
	}

	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return mixed
	 */
	function dt_sc_fancy_ul($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'style' => '',
				'variation' => '',
				'class' => ''
		), $attrs ) );
		$style = ($style) ? trim ( $style ) : 'arrow';
		$class = ($class) ? trim ( $class ) : '';
		$variation = ($variation) ? ' ' . trim ( $variation ) : '';
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$content = str_replace ( '<ul>', "<ul class='dt-sc-fancy-list {$variation} {$class} {$style}'>", $content );
		return $content;
	}

	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_pricing_table($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'type' => 'type1',
				'space' => 'space'
		), $attrs ) );

		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );

		return "<div class='dt-sc-pricing-table {$type} {$space}'>" . $content . '</div>';
	}

	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_pricing_table_item($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'heading' => __ ( "Heading", 'dt_themes' ),
        // 'per' => 'month',
        'pre' => '',
        'per' => '',
				'price' => '',
				"button_link" => "",
				"button_text" => '',
				"button_size" => "small"
		), $attrs ) );

		$selected = (isset ( $attrs [0] ) && trim ( $attrs [0] == 'selected' )) ? 'selected' : '';

		$button_link= do_shortcode($button_link);

		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$content = str_replace ( '<ul>', '<ul class="dt-sc-tb-content">', $content );
		$content = str_replace ( '<ol>', '<div><ul class="dt-sc-tb-content">', $content );
    $content = str_replace ( '</ol>', '</ul>', $content );
    $content ='<div class="dt-sc-tb-content-wrapper">'.$content.'</div>';
    // $price = ! empty ( $price ) ? "<div class='dt-sc-price'> $price <span> $per</span> </div>" : "";
    $price = ! empty ( $price ) ? "<div class='dt-sc-price'><span> $pre</span> $price <span> $per</span> </div>" : "";

		$out = "<div class='dt-sc-pr-tb-col $selected'>";
		$out .= '	<div class="dt-sc-tb-header">';
		$out .= '		<div class="dt-sc-tb-title">';
		$out .= "			<h5>$heading</h5>";
		$out .= '		</div>';
		$out .= $price;
		$out .= '	</div>';
		$out .= $content;

		if(preg_match('#^{{#', $button_link) === 1) {
			$button_link =  str_replace ( '{{', '[', $button_link );
			$button_link =  str_replace ( '}}', '/]', $button_link );
			$button_link = do_shortcode($button_link);
		}else{
			$button_link = esc_url ( $button_link );
		}
    if(!empty($button_text)||!empty($button_link)){
      $out .= '<div class="dt-sc-buy-now">';
      $out .= do_shortcode ( "[dt_sc_button size='$button_size' link='$button_link']" . $button_text . "[/dt_sc_button]" );
      $out .= '</div>';
    }

		$out .= '</div>';
		return $out;
	}

	function dt_sc_pricing_table_item_two($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'heading' => '',
				'thumb_image' => '',
				'subtitle' => '',
				'logo' => '',
				'color' => '',
				"button_link" => '',
				"button_text" => __('Buy Now', 'dt_themes'),
				"button_size" => "too-small"
		), $attrs ) );

		$selected = (isset ( $attrs [0] ) && trim ( $attrs [0] == 'selected' )) ? 'selected' : '';

		$button_link= do_shortcode($button_link);

		$out = "<div class='dt-sc-pr-tb-col type3 $color $selected'>";
			if(!empty($heading))
				$out .= "<div class='dt-sc-tb-title'><h3>$heading</h3></div>";
			if(!empty($thumb_image))
				$out .= "<div class='dt-sc-tb-thumb'><img src='$thumb_image' alt='pricing-thumb' />";
				// $out .= "<div class='image-overlay'><span class='image-overlay-inside'></span></div>";
				$out .= "</div>";
			$out .= "<div class='dt-sc-tb-content'>";
				if(!empty($subtitle))
					$out .= "<h5>$subtitle</h5>";
					$out .= DTCoreShortcodesDefination::dtShortcodeHelper( $content );
				if(!empty($logo))
					$out .=	"<img src='$logo' alt='logo' />";
				$out .= "<a href='".esc_url($button_link)."' class='dt-sc-button $button_size'>$button_text</a>";
			$out .= "</div>";
		$out .= "</div>";
		return $out;
	}

	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_progressbar($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'type' => 'standard',
				'color' => '',
				'value' => '55'
		), $attrs ) );


		if( $type === 'standard' ){
			$type = "dt-sc-standard";
		}elseif( $type === 'progress-striped' ){
			$type = "dt-sc-progress-striped";
		}elseif( $type === 'progress-striped-active' ){
			$type = "dt-sc-progress-striped active";
		}


		$color = ! empty ( $color ) ? "style='background-color:$color;'" : "";

		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$content = $content.' - '.$value."%";
		$value = "data-value='$value'";
		$out = "<div class='dt-sc-bar-text'>{$content}</div>";
		$out .= "<div class='dt-sc-progress $type'>";
		$out .= "<div class='dt-sc-bar' $color $value></div>";
		$out .= '</div>';
		return $out;
	}

	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_tab($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'title' => '',
				'icon' => ''
		), $attrs ) );

		$icontxt = "";
		if($icon != '') $icontxt = '<span class="fa '.$icon.'"> </span>';

		$out = '<li class="tab_head"><a href="#">' . $icontxt . $title . '</a></li><div class="tabs_content">' . DTCoreShortcodesDefination::dtShortcodeHelper ( $content ) . '</div>';
		return $out;
	}


	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_tabs_horizontal($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'class' => ''
		), $attrs ) );

		preg_match_all("/(.?)\[(dt_sc_tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/dt_sc_tab\])?(.?)/s", $content, $matches);
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
		}
		$out = '<ul class="dt-sc-tabs-frame">';
			for($i = 0; $i < count($matches[0]); $i++) {

				$icontxt = '';
				if(isset($matches[3][$i]['icon']) != '') $icontxt = '<span class="fa fa-'.$matches[3][$i]['icon'].'"> </span>';

				$out .= '<li><a href="#tab'.($i+1).'">' . $icontxt . $matches[3][$i]['title'] . '</a></li>';
			}
		$out .= '</ul>';

		for($i = 0; $i < count($matches[0]); $i++) {
			$content = DTCoreShortcodesDefination::dtShortcodeHelper($matches[5][$i]);
			$out .= '<div class="dt-sc-tabs-frame-content" id="tab'.($i+1).'">' . $content . '</div>';
		}
	return "<div class='dt-sc-tabs-container {$class}'>$out</div>";
	}


	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_tabs_vertical($attrs, $content = null) {
		preg_match_all("/(.?)\[(dt_sc_tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/dt_sc_tab\])?(.?)/s", $content, $matches);
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
		}
		$out = "<ul class='dt-sc-tabs-vertical-frame'>";
		for($i = 0; $i < count($matches[0]); $i++) {

			$icontxt = '';
			if(isset($matches[3][$i]['icon']) != '') $icontxt = '<span class="fa fa-'.$matches[3][$i]['icon'].'"> </span>';

			$out .= '<li><a href="#tab'.($i+1).'">' . $icontxt . $matches[3][$i]['title'] . '</a></li>';
		}
		$out .= "</ul>";

		for($i = 0; $i < count($matches[0]); $i++) {
			$content = DTCoreShortcodesDefination::dtShortcodeHelper($matches[5][$i]);
			$out .= '<div class="dt-sc-tabs-vertical-frame-content" id="tab'.($i+1).'">' . $content . '</div>';
		}
		return "<div class='dt-sc-tabs-vertical-container'>$out</div>";
	}

	/**
	 *
	 * @param unknown $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_team($attrs, $content = null) {
		$attributes = array (
				'name' => '',
				'image' => 'http://placehold.it/300',
				'role' => '',
				'alt' => __('Please specify image url','dt_themes'),
				'title' => __('Please specify image url','dt_themes')
		);

		$sociables = array('fa-dribbble' => 'dribble', 'fa-flickr' => 'flickr', 'fa-github' => 'github', 'fa-pinterest' => 'pinterest','fa-twitter' => 'twitter', 'fa-youtube' => 'youtube', 'fa-android' => 'android', 'fa-dropbox' => 'dropbox', 'fa-instagram' => 'instagram', 'fa-windows' => 'windows', 'fa-apple' => 'apple', 'fa-facebook' => 'facebook', 'fa-google-plus' => 'google', 'fa-linkedin' => 'linkedin', 'fa-skype' => 'skype', 'fa-tumblr' => 'tumblr', 'fa-vimeo-square' => 'vimeo', 'fa-weixin' => 'wechat');

		foreach ( $sociables as $sociable ) {
			$attributes [$sociable] = '';
		}

		extract ( shortcode_atts ( $attributes, $attrs ) );

		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );

		$image = "<img src='{$image}' alt='{$alt}' title='{$title}' />";
		$name = empty ( $name ) ? "" : "<h5>{$name}</h5>";
		$role = empty ( $role ) ? "" : "<h6>{$role}</h6>";

		$s = "";

		foreach ( $sociables as $key => $value ) {
			if(array_key_exists($value, $attrs))
				$s .= '<li class="'.$value.'"><a class="fa '.$key.'" href="'.$attrs[$value].'" title="'.ucfirst($value).'"></a></li>';
		}
		$s = ! empty ( $s ) ? "<ul class='dt-sc-social-icons'>$s</ul>" : "";

		$out = "<div class='dt-sc-team'>";
			$out .= "<div class='dt-sc-team-thumb'>{$image}</div>";
			$out .= $name.$role;
			$out .= $content;
			$out .= '<p class="team-contact"><span></span>'.__('im available here', 'dt_themes').'</p>';
			$out .= $s;
		$out .= '</div>';
		return $out;
	}

	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_testimonial($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'name' => '',
				'role' => '',
				'image' => 'http://placehold.it/300'
		), $attrs ) );
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$content = ! empty ( $content ) ? '<q>"'.$content.'"</q>' : "";
		$name = ! empty ( $name ) ? "{$name}" : "";
		$role = ! empty ( $role ) ? "<span>{$role}</span>" : "";

		$content = (! empty ( $content ) ) ? '<blockquote>'.$content.'</blockquote>' : "";
		$content.= "<div class='author-detail'>$name, <span>$role</span></div>";

		$image = "<img src='{$image}' alt='{$name}' title='{$name}' />";
		$image = "<div class='author'>{$image}</div>";


		return "<div class='dt-sc-testimonial'>$image$content</div>";
	}

	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_testimonial_carousel($attrs, $content = null) {

		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$content = str_replace( '<ul>', "<ul class='dt-sc-testimonial-carousel'>", $content );


		$out = '<div class="dt-sc-testimonial-carousel-wrapper">';
		$out .= $content;
		$out .= '<div class="carousel-arrows">';
		$out .= '	<a href="" class="testimonial-prev"> </a>';
		$out .= '	<a href="" class="testimonial-next"> </a>';
		$out .= '</div>';
		$out .= '</div>';
		return $out;
	}

	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_client_testimonial($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'name' => '',
				'role' => '',
				'image' => 'http://placehold.it/100&text=Client'
		), $attrs ) );
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$content = ! empty ( $content ) ? '<q>&quot;'.$content.'&quot;</q>' : "";
		$content = (! empty ( $content ) ) ? '<blockquote>'.$content.'</blockquote>' : "";

		$name = ! empty ( $name ) ? " {$name} " : "";
		$role = ! empty ( $role ) ? "{$role}" : "";

		$image = "<img src='{$image}' alt='{$role}' title='{$name}' />";
		$image = "<div class='author-detail'>{$image}<cite>{$name}<span>{$role}</span></cite></div>";

		return "<div class='client-testimonial'>$content$image</div>";
	}

	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_client_testimonials($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'carousel' => ''
		), $attrs ) );

		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );

		if($carousel == 'true') {
			$out = '<div class="carousel_items">';
				$out .= '<div class="dt-sc-client-testimonial-wrapper dt_carousel" data-items="1">';
					$out .= $content;
				$out .= '</div>';
				$out .= '<div class="carousel-arrows">';
				$out .= '	<a class="prev-arrow" href="#"><span class="fa fa-angle-left"> </span></a>';
				$out .= '	<a class="next-arrow" href="#"><span class="fa fa-angle-right"> </span></a>';
				$out .= '</div>';
			$out .= '</div>';
		} else {
			$out = '<div class="dt-sc-client-words-wrapper">';
				$out .= $content;
			$out .= '</div>';
		}
		return $out;
	}

	function dt_sc_title( $attrs,$content = null , $shortcodename = "" ){
		extract ( shortcode_atts ( array (
				'class' => ''
		), $attrs ) );

		$shortcodename = str_replace ( "dt_sc_", "", $shortcodename );
		$out = "<{$shortcodename} class='section-title {$class}'>";
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$content = strip_tags($content);
		$out .= $content;
		$out .= "</{$shortcodename}>";
		return $out;
	}

	function dt_sc_title_with_icon( $attrs,$content = null ){
		extract ( shortcode_atts ( array (
				'title' => '',
				'subtitle' => '',
				'icon'=>''
		), $attrs ) );

		$out = '<div class="main-title-wrapper">';
		$out .= "	<span class='main-title-icon fa {$icon}'> </span>";
		$out .= '	<div class="main-title">';
		$out .= 		!empty( $title ) ? "<h2>{$title}</h2>": "";
		$out .= 		!empty( $subtitle ) ? "<h4>{$subtitle}</h4>": "";
		$out .= '	</div>';
		$out .= '</div>';
		return $out;
	}

	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_toggle($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'title' => ''
		), $attrs ) );

		$out = "<h5 class='dt-sc-toggle'><a href='#'>{$title}</a></h5>";
		$out .= '<div class="dt-sc-toggle-content" style="display: none;">';
		$out .= '<div class="block">';
			$out .= DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$out .= '</div>';
		$out .= '</div>';
		return $out;
	}

	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_toggle_framed($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'title' => ''
		), $attrs ) );

		$out = '<div class="dt-sc-toggle-frame">';
		$out .= "	<h5 class='dt-sc-toggle'><a href='#'>{$title}</a></h5>";
		$out .= '	<div class="dt-sc-toggle-content" style="display: none;">';
		$out .= '		<div class="block">';
			$out .= DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$out .= '		</div>';
		$out .= '	</div>';
		$out .= '</div>';
		return $out;
	}

	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_titled_box($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'title' => '',
				'icon' => '',
				'type'	=> '',
				'variation' => '',
				'bgcolor' => '',
				'textcolor' => ''
		), $attrs ) );

		$type = (empty($type)) ? 'dt-sc-titled-box' :"dt-sc-$type";
		$variation = ( ( $variation ) && ( empty( $bgcolor ) ) ) ? ' ' . $variation : '';
		$content = DTCoreShortcodesDefination::dtShortcodeHelper( $content );

		$styles = array();
		if($bgcolor) $styles[] = 'background-color:' . $bgcolor . ';border-color:' . $bgcolor . ';';
		if($textcolor) $styles[] = 'color:' . $textcolor . ';';
		$style = join('', array_unique( $styles ) );
		$style = !empty( $style ) ? ' style="' . $style . '"': '' ;

		if($type == 'dt-sc-titled-box') :
			$icon = ( empty($icon) ) ? "" : "<span class='fa {$icon} '></span>";
			$title = "<h6 class='{$type}-title' {$style}> {$icon} {$title}</h6>";
			$out = "<div class='{$type} {$variation}'>";
			$out .= $title;
			$out .=	"<div class='{$type}-content'>{$content}</div>";
			$out .= "</div>";
		else :
			$out = "<div class='{$type}'>{$content}</div>";
		endif;
		return $out;
	}

	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_tooltip($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'type'	=> 'default',
				'tooltip' => '',
				'position' => 'top',
				'href' => '',
				'target' => '',
				'bgcolor' => '',
				'textcolor' => ''
		), $attrs ) );

		$class  = "class=' ";
		$class .=  ( $type == "boxed" ) ? "dt-sc-boxed-tooltip" : "";
		$class .= " dt-sc-tooltip-{$position}'";

		$href = " href='{$href}' ";
		$title = " title = '{$tooltip}' ";
		$target = empty($target) ? 'target="_blank"' : "target='{$target}' ";

		$styles = array();
		if($bgcolor) $styles[] = 'background-color:' . $bgcolor . ';border-color:' . $bgcolor . ';';
		if($textcolor) $styles[] = 'color:' . $textcolor . ';';
		$style = join('', array_unique( $styles ) );
		$style = !empty( $style ) ? ' style="' . $style . '"': '' ;
		$style = ( $type == "boxed" ) ? $style : "";

		$content = DTCoreShortcodesDefination::dtShortcodeHelper( $content );
		$out = "<a {$href} {$title} {$class} {$style} {$target}>{$content}</a>";
		return $out;
	}

	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_pullquote($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'type'	=> 'pullquote1',
				'align' => '',
				'icon' => '',
				'textcolor' => '',
				'cite' => ''
		), $attrs ) );

		$class = array();
		if( isset($type) )
			$class[] = " dt-sc-{$type}";

		if( trim( $icon ) == 'yes' )
			$class[] = ' quotes';

		if( preg_match( '/left|right|center/', trim( $align ) ) )
			$class[] = ' align' . $align;

		$cite = ( $cite ) ? ' <cite>&ndash; ' . $cite .'</cite>' : '' ;

		$style = ( $textcolor ) ? ' style="color:' . $textcolor . ';"' : '';
		$class = join( '', array_unique( $class ) );

		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$content = strip_tags($content);
		$out = "<span class='{$class}' {$style}> {$content} {$cite}</span>";

		return $out;
	}

	/**
	 * [dt_sc_portfolio_item description]
	 * @param  [type] $attrs         [description]
	 * @param  [type] $content       [description]
	 * @param  string $shortcodename [description]
	 * @return [type]                [description]
	 */
	function dt_sc_portfolio_item( $attrs, $content = null, $shortcodename= "" ){
		extract( shortcode_atts( array( 'id' => ''), $attrs ));
		$out = "";
		if( !empty( $id ) ){
			$p = get_post( $id );
			if( $p->post_type === "dt_portfolios" ):
				$permalink = get_permalink($id);
				$portfolio_item_meta = get_post_meta($id,'_portfolio_settings',TRUE);
				$portfolio_item_meta = is_array($portfolio_item_meta) ? $portfolio_item_meta  : array();

				$out .= "<div id='portfolio-{$id}' class='portfolio gallery'>";
				$out .= '<figure>';
							$popup = "http".dt_theme_ssl()."://placehold.it/1060x795&text=Add%20Image%20/%20Video%20%20to%20Portfolio";
							if( array_key_exists('items_name', $portfolio_item_meta) ) {
								$item =  $portfolio_item_meta['items_name'][0];
								$popup = $portfolio_item_meta['items'][0];
								if( "video" === $item ) {
									$items = array_diff( $portfolio_item_meta['items_name'] , array("video") );
									if( !empty($items) ) {
										$out .= "<img src='".$portfolio_item_meta['items'][key($items)]."' width='1060' height='795' alt='' />";
									} else {
										$out .= '<img src="http'.dt_theme_ssl().'://placehold.it/1060x795&text=Add%20Image%20/%20Video%20%20to%20Portfolio" alt="" width="1060" height="795"/>';
									}
								} else {
									$out .= "<img src='".$portfolio_item_meta['items'][0]."' width='1060' height='795' alt=''/>";
								}
							} else{
								$out .= "<img src='{$popup}' alt=''/>";
							}
					$out .= '<figcaption>';
					$out .= '	<div class="fig-title">';
					$out .= "		<h5><a href='{$permalink}'>{$p->post_title}</a></h5>";
								if( array_key_exists("sub-title",$portfolio_item_meta) ):
									$out .= "<h6>{$portfolio_item_meta["sub-title"]}</h6>";
								endif;
					$out .= '	</div>';
					$out .= ' 	<div class="fig-overlay">';
					$out .= "		<a href='{$popup}' data-gal='prettyPhoto[gallery]'' class='zoom'> <span class='fa fa-plus'> </span> </a>";
					$out .= "		<a href='{$permalink}' class='link'> <span class='fa fa-link'> </span> </a>";
					$out .= '	</div>';
					$out .= '</figcaption>';
				$out .= '</figure>';
				$out .= '</div>';
			else:
				$out .="<p>".__("There is no portfolio item with id :","dt_themes").$id."</p>";
			endif;

		} else {

			$out .="<p>".__("Please give portfolio post id","dt_themes")."</p>";
		}
		return $out;
	}

	function dt_sc_portfolios( $attrs, $content = null ){
		extract( shortcode_atts( array( 'category_id' => '','column'=>'3','count'=>'-1'), $attrs ));
		$out = "";
		$post_class = "";
		switch ( $column ) {
			case '2':
				$post_class = " dt-sc-one-half";
				break;

			case '3':
				$post_class = " dt-sc-one-third ";
				break;

			case '4':
				$post_class = " dt-sc-one-fourth ";
				break;

			case '5':
				$post_class = " dt-sc-one-fifth ";
				break;

			case '6':
				$post_class = " dt-sc-one-sixth ";
				break;
		}

		$category_id = explode(",", $category_id);
		if( is_array($category_id) && !empty($category_id) ){

			$args = array( 'orderby' => 'ID',
				'order' => 'ASC',
				'paged' => get_query_var( 'paged' ),
				'posts_per_page' => $count,
				'tax_query' => array( array( 'taxonomy'=>'portfolio_entries', 'field'=>'id', 'operator'=>'IN', 'terms'=>$category_id ) ) );

				query_posts($args);
				if( have_posts() ):
					while( have_posts() ):
						the_post();

						$the_id = get_the_ID();
						$permalink = get_permalink($the_id);
						$title = get_the_title($the_id);

						$portfolio_item_meta = get_post_meta($the_id,'_portfolio_settings',TRUE);
						$portfolio_item_meta = is_array($portfolio_item_meta) ? $portfolio_item_meta  : array();

						$out .= "<div id='portfolio-{$the_id}' class='portfolio column gallery no-space {$post_class}'>";
						$out .= '<figure>';
									$popup = "http".dt_theme_ssl()."://placehold.it/1060x795&text=Add%20Image%20/%20Video%20%20to%20Portfolio";
									if( array_key_exists('items_name', $portfolio_item_meta) ) {
										$item =  $portfolio_item_meta['items_name'][0];
										$popup = $portfolio_item_meta['items'][0];
										if( "video" === $item ) {
											$items = array_diff( $portfolio_item_meta['items_name'] , array("video") );
											if( !empty($items) ) {
												$out .= "<img src='".$portfolio_item_meta['items'][key($items)]."' width='1060' height='795' alt='' />";
											} else {
												$out .= '<img src="http'.dt_theme_ssl().'://placehold.it/1060x795&text=Add%20Image%20/%20Video%20%20to%20Portfolio" width="1060" height="795" alt=""/>';
											}
										} else {
											$out .= "<img src='".$portfolio_item_meta['items'][0]."' width='1060' height='795' alt=''/>";
										}
									} else{
										$out .= "<img src='{$popup}' alt=''/>";
									}
							$out .= '<figcaption>';
							$out .= '	<div class="fig-title">';
							$out .= "		<h5><a href='{$permalink}'>{$title}</a></h5>";
										if( array_key_exists("sub-title",$portfolio_item_meta) ):
											$out .= "<h6>{$portfolio_item_meta["sub-title"]}</h6>";
										endif;
							$out .= '	</div>';
							$out .= ' 	<div class="fig-overlay">';
							$out .= "		<a href='{$popup}' data-gal='prettyPhoto[gallery]' class='zoom'> <span class='fa fa-plus'> </span> </a>";
							$out .= "		<a href='{$permalink}' class='link'> <span class='fa fa-link'> </span> </a>";
							$out .= '	</div>';
							$out .= '</figcaption>';
						$out .= '</figure>';
						$out .= '</div>';
					endwhile;
				endif;
				wp_reset_query();

		} else {
			$out = "<p>".__("No portfolios in given category","dt_themes")."</p>";
		}

		return $out;
	}

	/**
	 *
	 * @param array $attrs
	 * @param string $content
	 * @return string
	 */
	function dt_sc_infographic_bar($attrs, $content = null, $shortcodename ="") {
		extract ( shortcode_atts ( array (
				'type' => 'standard',
				'icon' =>'',
				'icon_size'=>'150',
				'color' => '',
				'value' => '55'
		), $attrs ) );

		if( $type === 'standard' ){
			$type = "dt-sc-standard";
		}elseif( $type === 'progress-striped' ){
			$type = "dt-sc-progress-striped";
		}elseif( $type === 'progress-striped-active' ){
			$type = "dt-sc-progress-striped active";
		}

		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );

		$out = '<div class="dt-sc-infographic-bar">';

		if( !empty($icon) ){
		$out .= "<i class='fa {$icon}' style='font-size:{$icon_size}px; color:{$color};'> </i>";
		}
		$out .= '	<div class="info">';

		$out .= "		<div class='dt-sc-progress $type'>";
		$out .= "		 <div data-value={$value} style='background-color:{$color};' class='dt-sc-bar'></div>";
		$out .= '		</div>';

		$out .= "		<div class='dt-sc-bar-percentage'> <span> {$value}%  </span> </div>";
		$out .= "		<div class='dt-sc-bar-text'>$content</div>";
		$out .= '	</div>';

		$out .= '</div>';

		return $out;
	}

	function dt_sc_fullwidth_section($attrs, $content = null) {
		extract ( shortcode_atts ( array (
			'backgroundcolor' => '',
			'backgroundimage' => '',
			'backgroundrepeat' => '',
			'backgroundposition' => '',
			'paddingtop' => '',
			'paddingbottom' => '',
			'textcolor' =>'',
			'opacity' => '',
			'class' =>'',
			'parallax' => 'no'
		), $attrs ) );

		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );

		$styles = array ();
		$styles[] = !empty( $textcolor ) ? "color:{$textcolor};" : "";
		if( !empty( $opacity ) ) {
			$hex = str_replace ( "#", "", $backgroundcolor );
			if (strlen ( $hex ) == 3) :
				$r = hexdec ( substr ( $hex, 0, 1 ) . substr ( $hex, 0, 1 ) );
				$g = hexdec ( substr ( $hex, 1, 1 ) . substr ( $hex, 1, 1 ) );
				$b = hexdec ( substr ( $hex, 2, 1 ) . substr ( $hex, 2, 1 ) );
			else :
				$r = hexdec ( substr ( $hex, 0, 2 ) );
				$g = hexdec ( substr ( $hex, 2, 2 ) );
				$b = hexdec ( substr ( $hex, 4, 2 ) );
			endif;
			$rgb = array ( $r,$g,$b);
			$styles[] = "background-color:rgba($rgb[0],$rgb[1],$rgb[2],$opacity); ";
		} else {
			$styles[] = !empty( $backgroundcolor ) ? "background-color:{$backgroundcolor};" : "";
		}

		$styles[] = !empty( $backgroundimage ) ? "background-image:url({$backgroundimage});" : "";
		$styles[] = !empty( $backgroundrepeat ) ? "background-repeat:{$backgroundrepeat};" : "";
		$styles[] = !empty( $backgroundposition ) ? "background-position:{$backgroundposition};" : "";
		$styles[] = !empty( $paddingtop ) ? "padding-top:{$paddingtop}px;" : "";
		$styles[] = !empty( $paddingbottom ) ? "padding-bottom:{$paddingbottom}px;" : "";

		$parallaxclass = "";
		if( $parallax === "yes") {
			$styles[] = "background-attachment:fixed; ";
			$parallaxclass = "dt-sc-parallax-section";
		}

		$styles = array_filter( $styles);
		$style = join ( '', array_unique ( $styles ) );
		$style = ! empty ( $style ) ? ' style="' . $style . '"' : '';

		$out = 	"<div class='fullwidth-section {$class} {$parallaxclass}' {$style}>";
		$out .=	'	<div class="container">';
		$out .= 	$content;
		$out .= '	</div>';
		$out .= '</div>';
		return $out;
	}

	function dt_sc_fullwidth_video( $attrs, $content = null ) {
		extract ( shortcode_atts ( array (
			'mp4' => '',
			'webm'=>'',
			'ogv' => '',
			'poster' => '',
			'backgroundimage' => '',
			'paddingtop' => '',
			'paddingbottom' => '',
			'class' =>''
		), $attrs ) );

		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );

		$styles = array ();
		$styles[] = !empty( $paddingtop ) ? "padding-top:{$paddingtop}px;" : "";
		$styles[] = !empty( $paddingbottom ) ? "padding-bottom:{$paddingbottom}px;" : "";
		$styles = array_filter( $styles);
		$style = join ( '', array_unique ( $styles ) );

		$backgroundimage = !empty( $backgroundimage )  ? "$backgroundimage" : "http".dt_theme_ssl()."://placehold.it/1920x400.jpg&text=DesignThemes";
		$style .= " background:url({$backgroundimage}) left top repeat; ";
		$style = ! empty ( $style ) ? ' style="' . $style . '"' : '';

		$poster = !empty( $poster )  ? " poster='{$poster}' " : "";

		$mp4 = !empty( $mp4 )  ? "<source src='{$mp4}' type='video/mp4'/>" : "";
		$webm = !empty( $webm )  ? "<source src='{$webm}' type='video/webm'/>" : "";
		$ogv = !empty( $ogv )  ? "<source src='{$ogv}' type='video/ogg'/>" : "";


		$out  = "<div class='dt-sc-fullwidth-video-section {$class}' {$style}>";
		$out .= '	<div class="dt-sc-video-container">';
		$out .= "	<div class='dt-sc-mobile-image-container' style='display:none;'></div>";
		$out .= "		<video autoplay loop class='dt-sc-video dt-sc-fillWidth' {$poster}>";
		$out .= 		$mp4.$webm.$ogv;
		$out .= '		</video>';
		$out .= '	</div>';
		$out .= '   <div class="dt-sc-video-content-wrapper">';
		$out .= "		<div class='container'>{$content}</div>";
		$out .= '	</div>';
		$out .= '</div>';

		return $out;
	}

	function dt_sc_animation( $attrs, $content = null ){
		extract ( shortcode_atts ( array ( 'effect' => '','delay'=>''), $attrs ) );
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		return "<div class='animate' data-animation='{$effect}' data-delay='{$delay}'>{$content}</div>";
	}

	function dt_sc_doshortcode($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'width' => '100',
				'animation' => '',
				'animation_delay' => ''
		), $attrs ) );

		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );

		$danimation = !empty( $animation ) ? " data-animation='{$animation}' ": "";
		$ddelay = ( !empty( $animation ) && !empty( $animation_delay )) ? " data-delay='{$animation_delay}' " : "";
		$danimate = !empty( $animation ) ? "animate": "";

		$first = (isset ( $attrs [0] ) && trim ( $attrs [0] == 'first' )) ? 'first' : '';

		$out = '<div class="column '.$danimate.' '.$first.'" style="width:'.$width.'%;" '.$danimation.' '.$ddelay.'>';
		$cont = do_shortcode($content);
		if(isset($cont))
			$out .= $cont;
		else
			$out .= $content;
		$out .= '</div>';
		return $out;
	}

	function dt_sc_resizable($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'width' => '',
				'class' => '',
				'animation' => '',
				'animation_delay' => ''
		), $attrs ) );

		$danimation = !empty( $animation ) ? " data-animation='{$animation}' ": "";
		$ddelay = (!empty( $animation ) && !empty( $animation_delay )) ? " data-delay='{$animation_delay}' " : "";
		$danimate = !empty( $animation ) ? "animate": "";

		$style = (!empty( $width ) ) ? ' style="width:'.$width.'%;" ' : "";

		$first = (isset ( $attrs [0] ) && trim ( $attrs [0] == 'first' )) ? 'first' : '';
		$content = do_shortcode(DTCoreShortcodesDefination::dtShortcodeHelper ( $content ));
		$out = "<div class='column {$class} {$danimate} {$first}' {$danimation} {$ddelay} {$style}>{$content}</div>";
		return $out;
	}

	function dt_sc_widgets($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'widget_name' => '',
				'widget_wpname' => '',
				'widget_wpid' => ''
		), $attrs ) );

		if($widget_name != ''):

			foreach($attrs as $key=>$value):
				$instance[$key] = $value;
			endforeach;

			$instance = array_filter($instance);

			if(($widget_name == 'TribeEventsAdvancedListWidget' || $widget_name == 'TribeEventsMiniCalendarWidget') && isset($instance['selector'])) {
				$instance['filters'] = '{"tribe_events_cat":["'.$instance['selector'].'"]}';
			}

			if(substr($widget_name, 0, 2) == 'WC') $add_cls = 'woocommerce';
			else $add_cls = '';

			$args = array(
				'before_widget' => '<aside id="'.$widget_wpid.'" class="widget '.$add_cls.' '.$widget_wpname.'">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget-title"><h3>',
				'after_title'   => '</h3><div class="title-sep"><span></span></div></div>',
				'widget_id'		=> $instance['widget_wpid']
			);

			ob_start();
			the_widget($widget_name, $instance, $args);
			$output = ob_get_clean();

			return $output;
		endif;
	}
}

new DTCoreShortcodesDefination();?>
