<?php
global $dt_modules, $dt_animation_types, $woothemes_sensei, $dtthemes_columns;

$dt_animation_types = array("flash" => "flash", "shake" => "shake", "bounce" => "bounce", "tada" => "tada", "swing" => "swing", "wobble" => "wobble", "pulse" => "pulse", "flip" => "flip", "flipInX" => "flipInX", "flipOutX" => "flipOutX", "flipInY" => "flipInY", "flipOutY" => "flipOutY", "fadeIn" => "fadeIn", "fadeInUp" => "fadeInUp", "fadeInDown" => "fadeInDown", "fadeInLeft" => "fadeInLeft", "fadeInRight" => "fadeInRight", "fadeInUpBig" => "fadeInUpBig", "fadeInDownBig" => "fadeInDownBig", "fadeInLeftBig" => "fadeInLeftBig", "fadeInRightBig" => "fadeInRightBig", "fadeOut" => "fadeOut", "fadeOutUp" => "fadeOutUp","fadeOutDown" => "fadeOutDown", "fadeOutLeft" => "fadeOutLeft", "fadeOutRight" => "fadeOutRight", "fadeOutUpBig" => "fadeOutUpBig", "fadeOutDownBig" => "fadeOutDownBig", "fadeOutLeftBig" => "fadeOutLeftBig","fadeOutRightBig" => "fadeOutRightBig", "bounceIn" => "bounceIn", "bounceInUp" => "bounceInUp", "bounceInDown" => "bounceInDown", "bounceInLeft" => "bounceInLeft", "bounceInRight" => "bounceInRight", "bounceOut" => "bounceOut", "bounceOutUp" => "bounceOutUp", "bounceOutDown" => "bounceOutDown", "bounceOutLeft" => "bounceOutLeft", "bounceOutRight" => "bounceOutRight", "rotateIn" => "rotateIn", "rotateInUpLeft" => "rotateInUpLeft", "rotateInDownLeft" => "rotateInDownLeft", "rotateInUpRight" => "rotateInUpRight", "rotateInDownRight" => "rotateInDownRight", "rotateOut" => "rotateOut", "rotateOutUpLeft" => "rotateOutUpLeft","rotateOutDownLeft" => "rotateOutDownLeft", "rotateOutUpRight" => "rotateOutUpRight", "rotateOutDownRight" => "rotateOutDownRight", "hinge" => "hinge", "rollIn" => "rollIn", "rollOut" => "rollOut", "lightSpeedIn" => "lightSpeedIn", "lightSpeedOut" => "lightSpeedOut", "slideDown" => "slideDown", "slideUp" => "slideUp", "slideLeft" => "slideLeft", "slideRight" => "slideRight", "slideExpandUp" => "slideExpandUp", "expandUp" => "expandUp", "expandOpen" => "expandOpen", "bigEntrance" => "bigEntrance", "hatch" => "hatch", "floating" => "floating", "tossing" => "tossing", "pullUp" => "pullUp", "pullDown" => "pullDown", "stretchLeft" => "stretchLeft", "stretchRight" => "stretchRight");

$variations = array("avocado" => "avocado", "black" => "black", "blue" => "blue", "blueiris" => "blueiris", "blueturquoise" => "blueturquoise", "brown" => "brown", "burntsienna" => "burntsienna", "chillipepper" => "chillipepper", "eggplant" => "eggplant", "electricblue" => "electricblue", "graasgreen" => "graasgreen", "gray" => "gray", "green" => "green", "orange" => "orange", "palebrown" => "palebrown", "pink" => "pink", "radiantorchid" => "radiantorchid", "red" => "red", "skyblue" => "skyblue", "yellow" => "yellow");

$button_types = array('type1' => 'Type 1', 'type2' => 'Type 2');

$button_size = array('small' => 'Small', 'medium' => 'Medium', 'large' => 'Large', 'xlarge' => 'Xlarge');

$page_targets = array('_blank' => 'Blank', '_new' => 'New', '_parent' => 'Parent', '_self' => 'Self', '_top' => 'Top');

$box_types = array('titled-box' => 'Titled Box', 'error-box' => 'Error Box', 'warning-box' => 'Warning Box', 'success-box' => 'Success Box', 'info-box' => 'Info Box');

$blocquote_types = array('type1' => 'Type 1', 'type2' => 'Type 2', 'type3' => 'Type 3', 'type4' => 'Type 4');

$pullquote_types = array('pullquote1' => 'Pullquote 1', 'pullquote2' => 'Pullquote 2', 'pullquote3' => 'Pullquote 3', 'pullquote4' => 'Pullquote 4', 'pullquote5' => 'Pullquote 5', 'pullquote6' => 'Pullquote 6');

$callout_box_types = array('type1' => 'Type 1', 'type2' => 'Type 2', 'type3' => 'Type 3', 'type4' => 'Type 4', 'type5' => 'Type 5');

$pricingtable_types = $testimonial_types = $colored_icon_box_types = array('type1' => 'Type 1', 'type2' => 'Type 2');

$align = array('left' => 'Left', 'right' => 'Right', 'center' => 'Center');

$yesorno = array('yes' => 'Yes', 'no' => 'No');

$trueorfalse = array('true' => 'True', 'false' => 'False');

$tooltip_positions = array('top' => 'Top', 'right' => 'Right', 'bottom' => 'Bottom', 'left' => 'Left');

$tooltip_types = array('default' => 'Default', 'boxed' => 'Boxed');

$dropcap_types = array('Default' => 'Default', 'Circle' => 'Circle', 'Bordered Circle' => 'Bordered Circle', 'Square' => 'Square', 'Bordered Square' => 'Bordered Square');

$bacground_repeat = array('no-repeat' => 'No Repeat', 'repeat' => 'Repeat', 'repeat-x' => 'Repeat X', 'repeat-y' => 'Repeat Y');

$bacground_position = array('left top' => 'Left Top', 'left center' => 'Left Center', 'left bottom' => 'Left Bottom', 'right top' => 'Right Top', 'right center' => 'Right Center', 'right bottom' => 'Right Bottom', 'center top' => 'Center Top', 'center center' => 'Center Center', 'center bottom' => 'Center Bottom');

$lengths = array(5 => 5, 10 => 10, 15 => 15, 20 => 20, 25 => 25, 30 => 30, 35 => 35, 40 => 40, 45 => 45, 50 => 50, 55 => 55, 60 => 60, 65 => 65, 70 => 70, 75 => 75, 80 => 80, 85 => 85, 90 => 90, 95 => 95, 100 => 100);

$post_columns = array(2 => 2, 3 => 3);

$portfolio_columns = array(2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6);

$teacher_columns = array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5);

$icon_box_types = array('type1' => 'Type 1', 'type2' => 'Type 2', 'type3' => 'Type 3', 'type4' => 'Type 4', 'type5' => 'Type 5', 'type6' => 'Type 6', 'type7' => 'Type 7', 'type8' => 'Type 8', 'type9' => 'Type 9', 'type10' => 'Type 10', 'type11' => 'Type 11');

$progressbar_types = array('standard' => 'Standard', 'progress-striped' => 'Striped', 'progress-striped-active' => 'Striped Active');

$oltypes = array('decimal' => 'Decimal', 'decimal-leading-zero' => 'Decimal With Leading Zero', 'lower-alpha' => 'Lower Alpha', 'lower-roman' => 'Lower Roman', 'upper-alpha' => 'Upper Alpha', 'upper-roman' => 'Upper Roman');

$ultypes = array('arrow' => 'Arrow', 'rounded-arrow' => 'Rounded Arrow', 'double-arrow' => 'Double Arrow', 'heart' => 'Heart', 'trash' => 'Trash', 'star' => 'Star', 'tick' => 'Tick', 'rounded-tick' => 'Rounded Tick', 'cross' => 'Cross', 'rounded-cross' => 'Rounded Cross', 'rounded-question' => 'Rounded Question', 'rounded-info' => 'Rounded Info', 'delete' => 'Delete', 'warning' => 'Warning', 'comment' => 'Comment', 'edit' => 'Edit', 'share' => 'Share', 'plus' => 'Plus', 'rounded-plus' => 'Rounded Plus', 'minus' => 'Minus', 'rounded-minus' => 'Rounded Minus', 'asterisk' => 'Asterisk', 'cart' => 'Cart', 'folder' => 'Folder', 'folder-open' => 'Folder Open', 'desktop' => 'Desktop', 'tablet' => 'Tablet', 'mobile' => 'Mobile', 'reply' => 'Reply', 'quote' => 'Quote', 'mail' => 'Mail', 'external-link' => 'External Link', 'adjust' => 'Adjust', 'pencil' => 'Pencil', 'print' => 'Print', 'tag' => 'Tag', 'thumbs-up' => 'Thumbs Up', 'thumbs-down' => 'Thumbs Down', 'time' => 'Time', 'globe' => 'Globe', 'pushpin' => 'Pushpin', 'map-marker' => 'Map Marker', 'link' => 'Link', 'paper-clip' => 'Paper Clip', 'download' => 'Download', 'key' => 'Key', 'search' => 'Search', 'rss' => 'Rss', 'twitter' => 'Twitter', 'facebook' => 'Facebook', 'linkedin' => 'Linkedin', 'google-plus' => 'Google Plus', 'circle-tick' => 'Circle Tick', 'location-arrow' => 'Location', 'paper-plane' => 'Paper Plane');

$slider_types = array('LayerSlider' => 'Layer Slider', 'RevolutionSlider' => 'Revolution Slider');

$column_types = array('' => 'Type 1 ( With Space )', 'type2' => 'Type 2 ( Without Space )');

/*  Start of Columns Definition */

$options = array(
		'id' => array(
			'title' => esc_html__('ID', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'type' => array(
			'title' => esc_html__('Type', 'dt_themes'),
			'type' => 'select',
			'options' => $column_types,
			'default_value' => array(''),
		),
		'class' => array(
			'title' => esc_html__('CSS Class', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'style' => array(
			'title' => esc_html__('Style', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		)
);

$dtthemes_columns['one_column'] = array(
		'name' => esc_html__('1 Column', 'dt_themes'),
		'type' => 'column',
		'options' => $options,
	);
$dtthemes_columns['one_half'] = array(
		'name' => esc_html__('1/2 Column', 'dt_themes'),
		'type' => 'column',
		'options' => $options,
	);
$dtthemes_columns['one_third'] = array(
		'name' => esc_html__('1/3 Column', 'dt_themes'),
		'type' => 'column',
		'options' => $options,
	);
$dtthemes_columns['one_fourth'] = array(
		'name' => esc_html__('1/4 Column', 'dt_themes'),
		'type' => 'column',
		'options' => $options,
	);
$dtthemes_columns['one_fifth'] = array(
		'name' => esc_html__('1/5 Column', 'dt_themes'),
		'type' => 'column',
		'options' => $options,
	);
$dtthemes_columns['one_sixth'] = array(
		'name' => esc_html__('1/6 Column', 'dt_themes'),
		'type' => 'column',
		'options' => $options,
	);
$dtthemes_columns['two_third'] = array(
		'name' => esc_html__('2/3 Column', 'dt_themes'),
		'type' => 'column',
		'options' => $options,
	);
$dtthemes_columns['two_fifth'] = array(
		'name' => esc_html__('2/5 Column', 'dt_themes'),
		'type' => 'column',
		'options' => $options,
	);
$dtthemes_columns['two_sixth'] = array(
		'name' => esc_html__('2/6 Column', 'dt_themes'),
		'type' => 'column',
		'options' => $options,
	);
$dtthemes_columns['three_fourth'] = array(
		'name' => esc_html__('3/4 Column', 'dt_themes'),
		'type' => 'column',
		'options' => $options,
	);
$dtthemes_columns['three_fifth'] = array(
		'name' => esc_html__('3/5 Column', 'dt_themes'),
		'type' => 'column',
		'options' => $options,
	);
$dtthemes_columns['three_sixth'] = array(
		'name' => esc_html__('3/6 Column', 'dt_themes'),
		'type' => 'column',
		'options' => $options,
	);
$dtthemes_columns['four_fifth'] = array(
		'name' => esc_html__('4/5 Column', 'dt_themes'),
		'type' => 'column',
		'options' => $options,
	);
$dtthemes_columns['four_sixth'] = array(
		'name' => esc_html__('4/6 Column', 'dt_themes'),
		'type' => 'column',
		'options' => $options,
	);
$dtthemes_columns['five_sixth'] = array(
		'name' => esc_html__('5/6 Column', 'dt_themes'),
		'type' => 'column',
		'options' => $options,
	);
$dtthemes_columns['resizable'] = array(
		'name' => esc_html__('Resizable Column', 'dt_themes') ,
		'type' => 'column',
		'options' => $options,
	);
unset($dtthemes_columns['resizable']['options']['type']);

/*  End of Columns definition */

$dtthemes_columns['fullwidth_section'] = array(
	'name' => __('Fullwidth Section', 'dt_themes'),
	'type' => 'section',
	'separatecolumns' => 'true',
	'options' => array(
		'backgroundcolor' => array(
			'title' => __('Background Color', 'dt_themes'),
			'type' => 'colorpicker',
			'default_value' => ''
		),
		'backgroundimage' => array(
			'title' => __('Background Image', 'dt_themes'),
			'type' => 'upload',
			'default_value' => ''
		),
		'opacity' => array(
			'title' => __('Background Opacity', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'parallax' => array(
			'title' => __('Parallax Effect', 'dt_themes'),
			'type' => 'select',
			'options' => $yesorno,
			'default_value' => array('no')
		),
		'backgroundrepeat' => array(
			'title' => __('Background Repeat', 'dt_themes'),
			'type' => 'select',
			'options' => $bacground_repeat,
			'default_value' => array('no-repeat')
		),
		'backgroundposition' => array(
			'title' => __('Background Position', 'dt_themes'),
			'type' => 'select',
			'options' => $bacground_position,
			'default_value' => array('left top')
		),
		'paddingtop' => array(
			'title' => __('Padding Top', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'paddingbottom' => array(
			'title' => __('Padding Bottom', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'textcolor' => array(
			'title' => __('Text Color', 'dt_themes'),
			'type' => 'colorpicker',
			'default_value' => ''
		),
		'class' => array(
			'title' => __('CSS Class', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		)
	)
);

$dtthemes_columns['fullwidth_video'] = array(
	'name' => __('Fullwidth Section Video', 'dt_themes'),
	'type' => 'section',
	'options' => array(
		'mp4' => array(
			'title' => __('MP4', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'webm' => array(
			'title' => __('WEBM', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'ogv' => array(
			'title' => __('OGV', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'poster' => array(
			'title' => __('Poster Image', 'dt_themes'),
			'type' => 'upload',
			'default_value' => ''
		),
		'backgroundimage' => array(
			'title' => __('Background Image', 'dt_themes'),
			'type' => 'upload',
			'default_value' => ''
		),
		'paddingtop' => array(
			'title' => __('Padding Top (in px)', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'paddingbottom' => array(
			'title' => __('Padding Bottom (in px)', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'class' => array(
			'title' => __('CSS Class', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		)
	)
);

/*  End of Columns definition */


/*  Start of General Modules */

$dt_modules['general']['doshortcode_anycontent'] = array(
	'name' => __('Add Any Content Here', 'dt_themes'),
	'tooltip' => 'Add any content using this module',
	'icon_class' => 'ico-anycontent',
	'options' => array(
		'acc_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true
		)
	)
);

$dt_modules['general']['doshortcode_accordion_framed'] = array(
	'name' => __('Accordion Framed', 'dt_themes'),
	'tooltip' => 'Add Accordion Framed Module',
	'icon_class' => 'ico-accordion',
	'options' => array(
		'acc_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => '[dt_sc_accordion_group]<br>
							[dt_sc_toggle_framed title="Accordion 1"]<br>

							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>

							[/dt_sc_toggle_framed]<br>
							[dt_sc_toggle_framed title="Accordion 2"]<br>

							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>

							[/dt_sc_toggle_framed]<br>
							[dt_sc_toggle_framed title="Accordion 3"]<br>

							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>

							[/dt_sc_toggle_framed]<br>
						[/dt_sc_accordion_group]'
		)
	)
);

$dt_modules['general']['doshortcode_accordion_default'] = array(
	'name' => __('Accordion Default', 'dt_themes'),
	'tooltip' => 'Add Accordion Default Module',
	'icon_class' => 'ico-accordion',
	'options' => array(
		'acc_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => '[dt_sc_accordion_group]<br>
							[dt_sc_toggle title="Accordion 1"]<br>

							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>

							[/dt_sc_toggle]<br>
							[dt_sc_toggle title="Accordion 2"]<br>

							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>

							[/dt_sc_toggle]<br>
							[dt_sc_toggle title="Accordion 3"]<br>

							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>

							[/dt_sc_toggle]<br>
						[/dt_sc_accordion_group]'
		)
	)
);

$dt_modules['general']['animation'] = array(
	'name' => __('Animation', 'dt_themes'),
	'tooltip' => 'Add Animation effect for any content',
	'icon_class' => 'ico-animation',
	'options' => array(
		'effect' => array(
			'title' => __('Choose Effect', 'dt_themes'),
			'type' => 'select',
			'options' => $dt_animation_types,
			'default_value' => array('fadeIn')
		),
		'delay' => array(
			'title' => __('Delay', 'dt_themes'),
			'type' => 'text',
			'default_value' => 300
		),
		'an_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
		)
	)
);

$dt_modules['general']['button'] = array(
	'name' => __('Button', 'dt_themes'),
	'tooltip' => 'Add Button',
	'icon_class' => 'ico-button',
	'options' => array(
		'size' => array(
			'title' => __('Size', 'dt_themes'),
			'type' => 'select',
			'options' => $button_size,
			'default_value' => array('medium')
		),
		'link' => array(
			'title' => __('Link', 'dt_themes'),
			'type' => 'text',
			'default_value' => '#'
		),
		'type' => array(
			'title' => __('Type', 'dt_themes'),
			'type' => 'select',
			'options' => $button_types,
			'default_value' => array('type1')
		),
		'iconstyle' => array(
			'title' => __('Icon Style', 'dt_themes'),
			'type' => 'select',
			'options' => array('no-icon' => 'No Icon', 'with-icon' => 'With Icon', 'with-hover-effect' => 'With Hover Effect'),
			'default_value' => array('no-icon')
		),
		'icon' => array(
			'title' => __('Icon', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'fa-home'
		),
		'target' => array(
			'title' => __('Target', 'dt_themes'),
			'type' => 'select',
			'options' => $page_targets,
			'default_value' => array('_blank')
		),
		'variation' => array(
			'title' => __('Variation', 'dt_themes'),
			'type' => 'select',
			'options' => $variations,
			'default_value' => array()
		),
		'bgcolor' => array(
			'title' => __('Background Color', 'dt_themes'),
			'type' => 'colorpicker'
		),
		'textcolor' => array(
			'title' => __('Text Color', 'dt_themes'),
			'type' => 'colorpicker'
		),
		'class' => array(
			'title' => __('Class', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'button_content' => array(
			'title' => __('Text', 'dt_themes'),
			'type' => 'text',
			'is_content' => true,
			'default_value' => 'Click me!'
		)
	)
);

$dt_modules['general']['blockquote'] = array(
	'name' => __('Blockquote', 'dt_themes'),
	'tooltip' => 'Add Blockquote',
	'icon_class' => 'ico-blockquote',
	'options' => array(
		'type' => array(
			'title' => __('Type', 'dt_themes'),
			'type' => 'select',
			'options' => $blocquote_types,
			'default_value' => array('type1')
		),
		'align' => array(
			'title' => __('Align', 'dt_themes'),
			'type' => 'select',
			'options' => $align,
			'default_value' => array()
		),
		'variation' => array(
			'title' => __('Variation', 'dt_themes'),
			'type' => 'select',
			'options' => $variations,
			'default_value' => array()
		),
		'textcolor' => array(
			'title' => __('Text Color', 'dt_themes'),
			'type' => 'colorpicker'
		),
		'cite' => array(
			'title' => __('Cite', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'role' => array(
			'title' => __('Role', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'blockquote_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
		)
	)
);

$dt_modules['general']['pullquote'] = array(
	'name' => __('Pullquote', 'dt_themes'),
	'tooltip' => 'Add different types of pullquotes',
	'icon_class' => 'ico-quote',
	'options' => array(
		'type' => array(
			'title' => __('Type', 'dt_themes'),
			'type' => 'select',
			'options' => $pullquote_types,
			'default_value' => array('pullquote1')
		),
		'align' => array(
			'title' => __('Align', 'dt_themes'),
			'type' => 'select',
			'options' => $align,
			'default_value' => array('left')
		),
		'icon' => array(
			'title' => __('Show Icon', 'dt_themes'),
			'type' => 'select',
			'options' => $yesorno,
			'default_value' => array('yes')
		),
		'textcolor' => array(
			'title' => __('Text Color', 'dt_themes'),
			'type' => 'colorpicker',
			'default_value' => ''
		),
		'cite' => array(
			'title' => __('Cite Name', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'Dolor sit amet'
		),
		'pq_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ac luctus ligula. Phasellus a ligula blandit'
		)
	)
);

$dt_modules['general']['dropcap'] = array(
	'name' => __('Dropcap', 'dt_themes'),
	'tooltip' => __('Use this module to add dropcap', 'dt_themes'),
	'icon_class' => 'ico-dropcap',
	'options' => array(
		'type' => array(
			'title' => __('Type', 'dt_themes'),
			'type' => 'select',
			'options' => $dropcap_types,
			'default_value' => array('Default')
		),
		'variation' => array(
			'title' => __('Variation', 'dt_themes'),
			'type' => 'select',
			'options' => $variations,
			'default_value' => array()
		),
		'bgcolor' => array(
			'title' => __('Background Color', 'dt_themes'),
			'type' => 'colorpicker',
			'default_value' => '#808080'
		),
		'textcolor' => array(
			'title' => __('Text Color', 'dt_themes'),
			'type' => 'colorpicker',
			'default_value' => '#4bbcd7'
		),
		'content' => array(
			'title' => __('Text', 'dt_themes'),
			'type' => 'text',
			'is_content' => true,
			'default_value' => 'A'
		)
	)
);

$dt_modules['general']['fancy_ul'] = array(
	'name' => __('Unordered Lists', 'dt_themes'),
	'tooltip' => 'Add items in unordered lists',
	'icon_class' => 'ico-unorderedlists',
	'options' => array(
		'style' => array(
			'title' => __('Style', 'dt_themes'),
			'type' => 'select',
			'options' => $ultypes,
			'default_value' => array('arrow')
		),
		'variation' => array(
			'title' => __('Variation', 'dt_themes'),
			'type' => 'select',
			'options' => $variations,
			'default_value' => array()
		),
		'class' => array(
			'title' => __('Class', 'dt_themes'),
			'type' => 'text'
		),
		'ul_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => '<ul>
							<li>Lorem ipsum dolor sit</li>
							<li>Praesent convallis nibh</li>
							<li>Nullam ac sapien sit</li>
							<li>Phasellus auctor augue</li>
						</ul>'
		)
	)
);

$dt_modules['general']['fancy_ol'] = array(
	'name' => __('Ordered Lists', 'dt_themes'),
	'tooltip' => 'Add items in ordered list',
	'icon_class' => 'ico-orderedlists',
	'options' => array(
		'style' => array(
			'title' => __('Style', 'dt_themes'),
			'type' => 'select',
			'options' => $oltypes,
			'default_value' => array('decimal')
		),
		'variation' => array(
			'title' => __('Variation', 'dt_themes'),
			'type' => 'select',
			'options' => $variations,
			'default_value' => array()
		),
		'class' => array(
			'title' => __('Class', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'ol_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => '<ol>
							<li>Lorem ipsum dolor sit</li>
							<li>Praesent convallis nibh</li>
							<li>Nullam ac sapien sit</li>
							<li>Phasellus auctor augue</li>
						</ol>'
		)
	)
);

$dt_modules['general']['pricing_table'] = array(
	'name' => __('Pricing Table', 'dt_themes'),
	'tooltip' => 'Add pricing table',
	'icon_class' => 'ico-pricingtable',
	'options' => array(
		'type' => array(
			'title' => __('Type', 'dt_themes'),
			'type' => 'readonly',
			'default_value' => 'type1'
		),
		'space' => array(
			'title' => __('Style', 'dt_themes'),
			'type' => 'select',
			'options' => array('space' => 'Space', 'no-space' => 'No Space'),
			'default_value' => array('space')
		),
		'pt_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => "[dt_sc_one_third first]
				[dt_sc_pricing_table_item heading='Heading' button_text='Buy Now' button_link='#' price='$15' per='month' selected]
				<ul>
				<li>Text</li>
				<li>Text</li>
				<li>Text</li>
				</ul>
				[/dt_sc_pricing_table_item]
				[/dt_sc_one_third]
				[dt_sc_one_third]
				[dt_sc_pricing_table_item heading='Heading' button_text='Buy Now' button_link='#' price='$15' per='month']
				<ul>
				<li>Text</li>
				<li>Text</li>
				<li>Text</li>
				</ul>
				[/dt_sc_pricing_table_item]
				[/dt_sc_one_third]
				[dt_sc_one_third]
				[dt_sc_pricing_table_item heading='Heading' button_text='Buy Now' button_link='#' price='$15' per='month']
				<ul>
				<li>Text</li>
				<li>Text</li>
				<li>Text</li>
				</ul>
				[/dt_sc_pricing_table_item]
				[/dt_sc_one_third]"
		)
	)
);

$dt_modules['general']['pricing_table_two'] = array(
	'name' => __('Pricing Table Two', 'dt_themes'),
	'tooltip' => 'Add pricing table',
	'icon_class' => 'ico-pricingtable',
	'options' => array(
		'type' => array(
			'title' => __('Type', 'dt_themes'),
			'type' => 'readonly',
			'default_value' => 'type2'
		),
		'space' => array(
			'title' => __('Style', 'dt_themes'),
			'type' => 'select',
			'options' => array('space' => 'Space', 'no-space' => 'No Space'),
			'default_value' => array('space')
		),
		'pt_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => "[dt_sc_one_third first]
				[dt_sc_pricing_table_item_two heading='Summer stay for Single couple @ $250.00 for 2 Nights' thumb_image='http://placehold.it/395x250&text=Thumb' subtitle='Comfy Catherenes Home @ Genes Block Travanza' logo='http://placehold.it/253x48&text=Logo' color='purple' button_size='too-small'  button_text='Buy Now' button_link='#' selected]<br/><br/>
				Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit and seltd tasm cursus nunc.
				<br/><br/>[/dt_sc_pricing_table_item_two]
				[/dt_sc_one_third]
				[dt_sc_one_third]

				[dt_sc_pricing_table_item_two heading='Summer stay for Single couple @ $250.00 for 2 Nights' thumb_image='http://placehold.it/395x250&text=Thumb' subtitle='Comfy Catherenes Home @ Genes Block Travanza' logo='http://placehold.it/253x48&text=Logo' color='gold' button_size='too-small'  button_text='Buy Now' button_link='#']<br/><br/>
				Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit and seltd tasm cursus nunc.
				<br/><br/>[/dt_sc_pricing_table_item_two]
				[/dt_sc_one_third]
				[dt_sc_one_third]

				[dt_sc_pricing_table_item_two heading='Summer stay for Single couple @ $250.00 for 2 Nights' thumb_image='http://placehold.it/395x250&text=Thumb' subtitle='Comfy Catherenes Home @ Genes Block Travanza' logo='http://placehold.it/253x48&text=Logo' color='pink' button_size='too-small'  button_text='Buy Now' button_link='#']<br/><br/>
				Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit and seltd tasm cursus nunc.
				<br/><br/>[/dt_sc_pricing_table_item_two]

				[/dt_sc_one_third]"
		)
	)
);

$dt_modules['general']['progressbar'] = array(
	'name' => __('Progress Bar', 'dt_themes'),
	'tooltip' => 'Add different types of progres bar',
	'icon_class' => 'ico-progressbar',
	'options' => array(
		'type' => array(
			'title' => __('Type', 'dt_themes'),
			'type' => 'select',
			'options' => $progressbar_types,
			'default_value' => array('standard')
		),
		'color' => array(
			'title' => __('Color', 'dt_themes'),
			'type' => 'colorpicker',
			'default_value' => '#65bf05'
		),
		'value' => array(
			'title' => __('Value', 'dt_themes'),
			'type' => 'text',
			'default_value' => 55
		),
		'content' => array(
			'title' => __('Text', 'dt_themes'),
			'type' => 'text',
			'is_content' => true,
			'default_value' => 'Lorem ipsum dolor'
		)
	)
);

$dt_modules['general']['infographic_bar'] = array(
	'name' => __('Infographic Bar', 'dt_themes'),
	'tooltip' => 'Add different types of infographic bar',
	'icon_class' => 'ico-progressbar',
	'options' => array(
		'type' => array(
			'title' => __('Type', 'dt_themes'),
			'type' => 'select',
			'options' => $progressbar_types,
			'default_value' => array('standard')
		),
		'icon' => array(
			'title' => __('Fontawesome Icon', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'fa-paper-plane'
		),
		'icon_size' => array(
			'title' => __('Icon Size', 'dt_themes'),
			'type' => 'text',
			'default_value' => '150'
		),
		'color' => array(
			'title' => __('Color', 'dt_themes'),
			'type' => 'colorpicker',
			'default_value' => '#65bf05'
		),
		'value' => array(
			'title' => __('Value', 'dt_themes'),
			'type' => 'text',
			'default_value' => 55
		),
		'content' => array(
			'title' => __('Text', 'dt_themes'),
			'type' => 'text',
			'is_content' => true,
			'default_value' => 'Lorem ipsum dolor'
		)
	)
);

$dt_modules['general']['tabs_horizontal'] = array(
	'name' => __('Tabs - Horizontal', 'dt_themes'),
	'tooltip' => 'Add horizontal tabs',
	'icon_class' => 'ico-tabs',
	'options' => array(

		'th_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => '<br>[dt_sc_tab title="Tab1"]<br>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>
								[/dt_sc_tab]<br>

								<br>[dt_sc_tab title="Tab2"]<br>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>[/dt_sc_tab]<br>

								<br>[dt_sc_tab title="Tab3"]<br>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>[/dt_sc_tab]<br>'
		)
	)
);

$dt_modules['general']['tabs_vertical'] = array(
	'name' => __('Tabs Vertical', 'dt_themes'),
	'tooltip' => 'Add vertical tabs',
	'icon_class' => 'ico-tabs',
	'options' => array(
		'tv_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => '<br>[dt_sc_tab title="Tab1"]<br>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>
								[/dt_sc_tab]<br>

								<br>[dt_sc_tab title="Tab2"]<br>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>[/dt_sc_tab]<br>

								<br>[dt_sc_tab title="Tab3"]<br>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>[/dt_sc_tab]<br>'
		)
	)
);

$dt_modules['general']['tabs_vertical_with_icon'] = array(
	'name' => __('Tabs Vertical Icon', 'dt_themes'),
	'tooltip' => 'Add vertical icon tabs',
	'icon_class' => 'ico-tabs',
	'options' => array(
		'tv_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => '<br>[dt_sc_tab title="Tab1" icon="home"]<br>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>
								[/dt_sc_tab]<br>

								<br>[dt_sc_tab title="Tab2" icon="gift"]<br>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>[/dt_sc_tab]<br>

								<br>[dt_sc_tab title="Tab3" icon="support"]<br>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>[/dt_sc_tab]<br>'
		)
	)
);

$dt_modules['general']['icon_box'] = array(
	'name' => __('Icon Box', 'dt_themes'),
	'tooltip' => __('Use this module to add icon box', 'dt_themes'),
	'icon_class' => 'ico-iconbox',
	'options' => array(
		'type' => array(
			'title' => __('Types', 'dt_themes'),
			'type' => 'select',
			'options' => $icon_box_types,
			'default_value' => array('type1')
		),
		'fontawesome_icon' => array(
			'title' => __('Fontawesome Icon', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'trophy'
		),
		'color' => array(
			'title' => __('Icon Color', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'custom_icon' => array(
			'title' => __('Custom Icon', 'dt_themes'),
			'type' => 'upload',
			'default_value' => ''
		),
		'title' => array(
			'title' => __('Title', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'Well Trained Professionals'
		),
		'link' => array(
			'title' => __('Link', 'dt_themes'),
			'type' => 'text',
			'default_value' => '#'
		),
		'ib_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => 'Nunc at pretium est curabitur commodo leac est venenatis egestas sed aliquet auguevelit.'
		)
	)
);

$dt_modules['general']['icon_box_colored'] = array(
	'name' => __('Icon Box Colored', 'dt_themes'),
	'tooltip' => 'Add the colored icon box',
	'icon_class' => 'ico-iconbox-colored',
	'options' => array(
		'type' => array(
			'title' => __('Type', 'dt_themes'),
			'type' => 'select',
			'options' => $colored_icon_box_types,
			'default_value' => array('type1')
		),
		'fontawesome_icon' => array(
			'title' => __('Fontawesome Icons', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'home'
		),
		'custom_icon' => array(
			'title' => __('Custom Icons', 'dt_themes'),
			'type' => 'upload',
			'default_value' => ''
		),
		'title' => array(
			'title' => __('Title', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'Well Trained Professionals'
		),
		'bgcolor' => array(
			'title' => __('Background Color', 'dt_themes'),
			'type' => 'colorpicker',
			'default_value' => '#087dc2'
		),
		'ibc_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => "<p> Nunc at pretium est curabitur commodo leac est venenatis egestas sed aliquet auguevelit. </p><br>[dt_sc_button link='#' size='small' target='_blank']Know More[/dt_sc_button]"
		)
	)
);

$dt_modules['general']['callout_box'] = array(
	'name' => __('Callout Box', 'dt_themes'),
	'tooltip' => 'Add the callout box here',
	'icon_class' => 'ico-callout',
	'options' => array(
		'type' => array(
			'title' => __('Type', 'dt_themes'),
			'type' => 'select',
			'options' => $callout_box_types,
			'default_value' => array('type1')
		),
		'link' => array(
			'title' => __('Link', 'dt_themes'),
			'type' => 'text',
			'default_value' => '#'
		),
		'button_text' => array(
			'title' => __('Button Label', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'Purchase Now'
		),
		'icon' => array(
			'title' => __('Icon', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'fa-home'
		),
		'target' => array(
			'title' => __('Target', 'dt_themes'),
			'type' => 'select',
			'options' => $page_targets,
			'default_value' => array('_blank')
		),
		'class' => array(
			'title' => __('Class', 'dt_themes'),
			'type' => 'text'
		),
		'cb_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => "<h4>Our Technological services has been improved vastly</h4><h5>Come Experience the real life situations of saving life</h5>"
		)
	)
);

$dt_modules['general']['titled_box'] = array(
	'name' => __('Titled Box', 'dt_themes'),
	'tooltip' => 'Add titled box and different types of messgae box',
	'icon_class' => 'ico-box',
	'options' => array(
		'type' => array(
			'title' => __('Type', 'dt_themes'),
			'type' => 'select',
			'options' => $box_types,
			'default_value' => array('titled-box')
		),
		'title' => array(
			'title' => __('Title', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'Title Comes Here'
		),
		'icon' => array(
			'title' => __('Fontawesome Icon', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'fa-cloud'
		),
		'variation' => array(
			'title' => __('Variation', 'dt_themes'),
			'type' => 'select',
			'options' => $variations,
			'default_value' => array()
		),
		'bgcolor' => array(
			'title' => __('Background Color', 'dt_themes'),
			'type' => 'colorpicker'
		),
		'textcolor' => array(
			'title' => __('Text Color', 'dt_themes'),
			'type' => 'colorpicker'
		),
		'box_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra per inceptos himenaeos.,'
		)
	)
);

$dt_modules['general']['doshortcode_toggledefault'] = array(
	'name' => __('Toggle Default', 'dt_themes'),
	'tooltip' => 'Add default toggles',
	'icon_class' => 'ico-toggle',
	'options' => array(
		'td_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => '[dt_sc_toggle title="Toggle 1"]<br>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>
							[/dt_sc_toggle]<br>

							[dt_sc_toggle title="Toggle 2"]<br>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>
							[/dt_sc_toggle]<br>

							[dt_sc_toggle title="Toggle 3"]<br>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>
							[/dt_sc_toggle]'
		)
	)
);

$dt_modules['general']['doshortcode_toggleframed'] = array(
	'name' => __('Toggle Framed', 'dt_themes'),
	'tooltip' => 'Add framed toggles',
	'icon_class' => 'ico-toggle',
	'options' => array(
		'tf_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => '[dt_sc_toggle_framed title="Toggle 1"]<br>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>
							[/dt_sc_toggle_framed]<br>

							[dt_sc_toggle_framed title="Toggle 2"]<br>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>
							[/dt_sc_toggle_framed]<br>

							[dt_sc_toggle_framed title="Toggle 3"]<br>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>
						[/dt_sc_toggle_framed]'
		)
	)
);

$dt_modules['general']['tooltip'] = array(
	'name' => __('Tooltip', 'dt_themes'),
	'tooltip' => 'Add tooltip with different positions',
	'icon_class' => 'ico-pullquote',
	'options' => array(
		'type' => array(
			'title' => __('Type', 'dt_themes'),
			'type' => 'select',
			'options' => $tooltip_types,
			'default_value' => array('default')
		),
		'tooltip' => array(
			'title' => __('Tooltip Text', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'Consectetur adipisicing elit'
		),
		'position' => array(
			'title' => __('Position', 'dt_themes'),
			'type' => 'select',
			'options' => $tooltip_positions,
			'default_value' => array('top')
		),
		'href' => array(
			'title' => __('Link', 'dt_themes'),
			'type' => 'text',
			'default_value' => '#'
		),
		'target' => array(
			'title' => __('Target', 'dt_themes'),
			'type' => 'select',
			'options' => $page_targets,
			'default_value' => array('_blank')
		),
		'bgcolor' => array(
			'title' => __('Background Color', 'dt_themes'),
			'type' => 'colorpicker'
		),
		'textcolor' => array(
			'title' => __('Text Color', 'dt_themes'),
			'type' => 'colorpicker'
		),
		'tp_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'text',
			'is_content' => true,
			'default_value' => 'Lorem ipsum'
		)
	)
);

/*  End of General Modules */

/*  Start of Unique Modules */

$dt_modules['unique']['donutchart_small'] = array(
	'name' => __('Donut Chart Small', 'dt_themes'),
	'tooltip' => __('Use this module to add donutchart', 'dt_themes'),
	'icon_class' => 'ico-donutchart',
	'options' => array(
		'title' => array(
			'title' => __('Title', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'Lorem'
		),
		'bgcolor' => array(
			'title' => __('Background Color', 'dt_themes'),
			'type' => 'colorpicker',
			'default_value' => '#808080'
		),
		'fgcolor' => array(
			'title' => __('Foreground Color', 'dt_themes'),
			'type' => 'colorpicker',
			'default_value' => '#4bbcd7'
		),
		'percent' => array(
			'title' => __('Percent', 'dt_themes'),
			'type' => 'text',
			'default_value' => 75
		),
		'text' => array(
			'title' => __('Text', 'dt_themes'),
			'type' => 'text'
		)
	)
);

$dt_modules['unique']['donutchart_medium'] = array(
	'name' => __('Donut Chart Medium', 'dt_themes'),
	'tooltip' => __('Use this module to add donutchart', 'dt_themes'),
	'icon_class' => 'ico-donutchart',
	'options' => array(
		'title' => array(
			'title' => __('Title', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'Lorem'
		),
		'bgcolor' => array(
			'title' => __('Background Color', 'dt_themes'),
			'type' => 'colorpicker',
			'default_value' => '#808080'
		),
		'fgcolor' => array(
			'title' => __('Foreground Color', 'dt_themes'),
			'type' => 'colorpicker',
			'default_value' => '#7aa127'
		),
		'percent' => array(
			'title' => __('Percent', 'dt_themes'),
			'type' => 'text',
			'default_value' => 65
		),
		'text' => array(
			'title' => __('Text', 'dt_themes'),
			'type' => 'text'
		)
	)
);

$dt_modules['unique']['donutchart_large'] = array(
	'name' => __('Donut Chart Large', 'dt_themes'),
	'tooltip' => __('Use this module to add donutchart', 'dt_themes'),
	'icon_class' => 'ico-donutchart',
	'options' => array(
		'title' => array(
			'title' => __('Title', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'Lorem'
		),
		'bgcolor' => array(
			'title' => __('Background Color', 'dt_themes'),
			'type' => 'colorpicker',
			'default_value' => '#808080'
		),
		'fgcolor' => array(
			'title' => __('Foreground Color', 'dt_themes'),
			'type' => 'colorpicker',
			'default_value' => '#a23b6f'
		),
		'percent' => array(
			'title' => __('Percent', 'dt_themes'),
			'type' => 'text',
			'default_value' => 55
		),
		'text' => array(
			'title' => __('Text', 'dt_themes'),
			'type' => 'text'
		)
	)
);

$dt_modules['unique']['doshortcode_team'] = array(
	'name' => __('Team', 'dt_themes'),
	'tooltip' => 'Use this module to list team members',
	'icon_class' => 'ico-team',
	'options' => array(
		'ts_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => '[dt_sc_team name="James Duncan" role="Leading Programme" image="http://placehold.it/125" twitter="#" facebook="#" google="#" linkedin="#"]<br><p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>[/dt_sc_team]'
		)
	)
);

$dt_modules['unique']['doshortcode_testimonial'] = array(
	'name' => __('Testimonial', 'dt_themes'),
	'tooltip' => __('Use this module to add testimonial', 'dt_themes'),
	'icon_class' => 'ico-testimonial',
	'options' => array(
		'tm_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => '[dt_sc_testimonial name="John Doe" role="Cambridge Telcecom" image="http://placehold.it/300"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.[/dt_sc_testimonial]'
		)
	)
);

$dt_modules['unique']['doshortcode_testimonial_carousel'] = array(
	'name' => __('Testimonial Carousel', 'dt_themes'),
	'tooltip' => __('Use this module to add testimonial carousel', 'dt_themes'),
	'icon_class' => 'ico-testimonial',
	'options' => array(
		'tmc_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => '[dt_sc_testimonial_carousel]<br>
			<ul>
				<li>[dt_sc_testimonial name="John Doe" role="Cambridge Telcecom" image="http://placehold.it/300"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.[/dt_sc_testimonial]</li>
				<li>[dt_sc_testimonial name="John Doe" role="Cambridge Telcecom" image="http://placehold.it/300"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.[/dt_sc_testimonial]</li>
				<li>[dt_sc_testimonial name="John Doe" role="Cambridge Telcecom" image="http://placehold.it/300"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.[/dt_sc_testimonial]</li>
			</ul>
			<br>[/dt_sc_testimonial_carousel]'
		)
	)
);

$dt_modules['unique']['client_testimonials'] = array(
	'name' => __('Client Testimonial', 'dt_themes'),
	'tooltip' => __('Use this module to add client testimonial', 'dt_themes'),
	'icon_class' => 'ico-testimonial',
	'options' => array(
		'carousel' => array(
			'title' => __('Carousel', 'dt_themes'),
			'type' => 'select',
			'options' => array('true' => 'Yes', 'false' => 'No'),
			'default_value' => array('true')
		),
		'ct_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => '[dt_sc_client_testimonial name="Jamie Hunt" role="Creative Artist@Adobe" image="http://placehold.it/100&text=Client"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.[/dt_sc_client_testimonial]

								[dt_sc_client_testimonial name="Jamie Hunt" role="Creative Artist@Adobe" image="http://placehold.it/100&text=Client"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.[/dt_sc_client_testimonial]

								[dt_sc_client_testimonial name="Jamie Hunt" role="Creative Artist@Adobe" image="http://placehold.it/100&text=Client"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.[/dt_sc_client_testimonial]'
		)
	)
);

$dt_modules['unique']['blogposts'] = array(
	'name' => __('Recent Posts', 'dt_themes'),
	'tooltip' => __('Use this module to display recent posts', 'dt_themes'),
	'icon_class' => 'ico-recentposts',
	'options' => array(
		'excerpt_length' => array(
			'title' => __('Excerpt Length', 'dt_themes'),
			'type' => 'text',
			'default_value' => '25'
		),
		'show_meta' => array(
			'title' => __('Show Meta', 'dt_themes'),
			'type' => 'select',
			'options' => array( 'true' => 'Yes (Default)', 'false' => 'No'),
			'default_value' => array('true')
		),
		'limit' => array(
			'title' => __('Limit', 'dt_themes'),
			'type' => 'text',
			'default_value' => '3'
		),
		'categories' => array(
			'title' => __('Post Categories', 'dt_themes'),
			'type' => 'text',
			'default_value' => '2,4'
		),
		'posts_column' => array(
			'title' => __('Columns', 'dt_themes'),
			'type' => 'select',
			'options' => array( 'one-column' => 'I Column', 'one-half-column' => 'II Columns', 'one-third-column' => 'III Columns', 'one-fourth-column' => 'IV Columns'),
			'default_value' => array('one-third-column')
		),
	)
);

$dt_modules['unique']['gallery_items'] = array(
	'name' => __('Recent Gallery Items', 'dt_themes'),
	'tooltip' => __('Use this module to add recent gallery items', 'dt_themes'),
	'icon_class' => 'ico-portfolio-item',
	'options' => array(
		'limit' => array(
			'title' => __('Limit', 'dt_themes'),
			'type' => 'text',
			'default_value' => '4'
		),
		'categories' => array(
			'title' => __('Portfolio Categories', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'posts_column' => array(
			'title' => __('Columns', 'dt_themes'),
			'type' => 'select',
			'options' => array( 'one-half-column' => 'Two Column', 'one-third-column' => 'Three Column', 'one-fourth-column' => 'Four Column' ),
			'default_value' => array('one-half-column')
		),
		'filter' => array(
			'title' => __('Show Filter','dt_themes'),
			'type' => 'select',
			'options' => array( 'true' => 'Yes (Default)', 'false' => 'No'),
			'default_value' => array("true")
		)
	)
);

$dt_modules['unique']['events_list'] = array(
	'name' => __('Upcoming Events', 'dt_themes'),
	'tooltip' => __('Use this module to list upcoming events', 'dt_themes'),
	'icon_class' => 'ico-events',
	'options' => array(
		'limit' => array(
			'title' => __('Limit', 'dt_themes'),
			'type' => 'text',
			'default_value' => '-1'
		),
		'excerpt_length' => array(
			'title' => __('Excerpt Length', 'dt_themes'),
			'type' => 'text',
			'default_value' => '18'
		),
		'post_column' => array(
			'title' => __('Columns', 'dt_themes'),
			'type' => 'select',
			'options' => array( 'one-half-column' => 'Two Column', 'one-third-column' => 'Three Column', 'one-fourth-column' => 'Four Column' ),
			'default_value' => array('one-half-column')
		),
		'order' => array(
			'title' => __('Order', 'dt_themes'),
			'type' => 'select',
			'options' => array( 'ASC' => 'Ascending Order', 'DESC' => 'Descending Order' ),
			'default_value' => array('ASC')
		)
	)
);

$dt_modules['unique']['packages_list'] = array(
	'name' => __('Recent Packages', 'dt_themes'),
	'tooltip' => __('Use this module to list packages', 'dt_themes'),
	'icon_class' => 'ico-woocommerce_products',
	'options' => array(
		'limit' => array(
			'title' => __('Limit', 'dt_themes'),
			'type' => 'text',
			'default_value' => '-1'
		),
		'carousel' => array(
			'title' => __('Carousel', 'dt_themes'),
			'type' => 'select',
			'options' => array('true' => 'Enable', 'false' => 'Disable'),
			'default_value' => array('true')
		),
		'categories' => array(
			'title' => __('Package Categories', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'post_column' => array(
			'title' => __('Columns', 'dt_themes'),
			'type' => 'select',
			'options' => array( 'one-half-column' => 'Two Column', 'one-third-column' => 'Three Column', 'one-fourth-column' => 'Four Column' ),
			'default_value' => array('one-half-column')
		)
	)
);

$dt_modules['unique']['tourpackage_list'] = array(
	'name' => __('Recent Tour Packages', 'dt_themes'),
	'tooltip' => __('Use this module to list tour packages', 'dt_themes'),
	'icon_class' => 'ico-woocommerce_products',
	'options' => array(
		'limit' => array(
			'title' => __('Limit', 'dt_themes'),
			'type' => 'text',
			'default_value' => '-1'
		),
		'carousel' => array(
			'title' => __('Carousel', 'dt_themes'),
			'type' => 'select',
			'options' => array('true' => 'Enable', 'false' => 'Disable'),
			'default_value' => array('false')
		),
		'excerpt_length' => array(
			'title' => __('Excerpt Length', 'dt_themes'),
			'type' => 'text',
			'default_value' => '30'
		)
	)
);

$dt_modules['unique']['latest_hotel_reviews'] = array(
	'name' => __('Latest Hotel Reviews', 'dt_themes'),
	'tooltip' => __('Use this module to list hotel reviews', 'dt_themes'),
	'icon_class' => 'ico-testimonial',
	'options' => array(
		'limit' => array(
			'title' => __('Limit', 'dt_themes'),
			'type' => 'text',
			'default_value' => '-1'
		)
	)
);

$dt_modules['unique']['recent_competition'] = array(
	'name' => __('Recent Competition', 'dt_themes'),
	'tooltip' => __('Use this module to add recent competition', 'dt_themes'),
	'icon_class' => 'ico-portfolio-item',
	'options' => array(
		'competition_id' => array(
			'title' => __('Competition ID', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		)
	)
);

$dt_modules['unique']['best_destination_place'] = array(
	'name' => __('Best Destination Place', 'dt_themes'),
	'tooltip' => __('Use this module to add best destination place', 'dt_themes'),
	'icon_class' => 'ico-slider',
	'options' => array(
		'place_ids' => array(
			'title' => __('Place IDs', 'dt_themes'),
			'type' => 'text',
			'default_value' => '45,47'
		),
		'carousel' => array(
			'title' => __('Carousel', 'dt_themes'),
			'type' => 'select',
			'options' => array('true' => 'Enable', 'false' => 'Disable'),
			'default_value' => array('false')
		)
	)
);

$dt_modules['unique']['sports_list'] = array(
	'name' => __('Sports List', 'dt_themes'),
	'tooltip' => __('Use this module for sports list', 'dt_themes'),
	'icon_class' => 'ico-portfolio-item',
	'options' => array(
		'limit' => array(
			'title' => __('Limit', 'dt_themes'),
			'type' => 'text',
			'default_value' => '-1'
		),
		'posts_column' => array(
			'title' => __('Columns', 'dt_themes'),
			'type' => 'select',
			'options' => array( 'one-half' => 'Two Column', 'one-third' => 'Three Column', 'one-fourth' => 'Four Column' ),
			'default_value' => array('one-fourth')
		)
	)
);

$dt_modules['unique']['recommend_places'] = array(
	'name' => __('Recommended Places', 'dt_themes'),
	'tooltip' => __('Use this module for recommended places', 'dt_themes'),
	'icon_class' => 'ico-portfolio-item',
	'options' => array(
		'limit' => array(
			'title' => __('Limit', 'dt_themes'),
			'type' => 'text',
			'default_value' => '-1'
		),
		'posts_column' => array(
			'title' => __('Columns', 'dt_themes'),
			'type' => 'select',
			'options' => array( 'one-half' => 'Two Column', 'one-third' => 'Three Column', 'one-fourth' => 'Four Column' ),
			'default_value' => array('one-fourth')
		)
	)
);

$dt_modules['unique']['timeline_posts'] = array(
	'name' => __('Timeline Blog Posts', 'dt_themes'),
	'tooltip' => __('Use this module to list timeline blog posts', 'dt_themes'),
	'icon_class' => 'ico-recentposts',
	'options' => array(
		'limit' => array(
			'title' => __('Limit', 'dt_themes'),
			'type' => 'text',
			'default_value' => '-1'
		),
		'categories' => array(
			'title' => __('Post Categories', 'dt_themes'),
			'type' => 'text',
			'default_value' => '1,2'
		)
	)
);

$dt_modules['unique']['hotel_room'] = array(
	'name' => __('Hotel Room', 'dt_themes'),
	'tooltip' => __('Use this module to add hotel room', 'dt_themes'),
	'icon_class' => 'ico-events',
	'options' => array(
		'room_type' => array(
			'title' => __('Room Type', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'persons' => array(
			'title' => __('Persons', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'facilities' => array(
			'title' => __('Facilities', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'price' => array(
			'title' => __('Price', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'available' => array(
			'title' => __('Available', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		)
	)
);

/*  End of Unique Modules */

/*  Start of Others Modules */

$dt_modules['others']['clear'] = array(
	'name' => __('Clear', 'dt_themes'),
	'tooltip' => __('Add this module to add space between contents', 'dt_themes'),
	'icon_class' => 'ico-divider',
	'disable_resize' => true,
);

$dt_modules['others']['hr_border'] = array(
	'name' => __('Bordered Horizontal Rule', 'dt_themes'),
	'tooltip' => __('Use this module to add bordered horizontal rule', 'dt_themes'),
	'icon_class' => 'ico-divider',
	'disable_resize' => true,
);

$dt_modules['others']['hr'] = array(
	'name' => __('Horizontal Rule', 'dt_themes'),
	'tooltip' => __('Use this module to add horizontal rule', 'dt_themes'),
	'icon_class' => 'ico-divider',
	'disable_resize' => true,
);

$dt_modules['others']['hr_medium'] = array(
	'name' => __('Horizontal Rule Medium', 'dt_themes'),
	'tooltip' => __('Use this module to add medium horizontal rule', 'dt_themes'),
	'icon_class' => 'ico-divider',
	'disable_resize' => true,
);

$dt_modules['others']['hr_large'] = array(
	'name' => __('Horizontal Rule Large', 'dt_themes'),
	'tooltip' => __('Use this module to add large horizontal rule', 'dt_themes'),
	'icon_class' => 'ico-divider',
	'disable_resize' => true,
);

$dt_modules['others']['hr_top'] = array(
	'name' => __('Horizontal Rule With Top Link', 'dt_themes'),
	'tooltip' => __('Use this module to add horizontal rule with top link', 'dt_themes'),
	'icon_class' => 'ico-divider',
	'disable_resize' => true,
);

$dt_modules['others']['hr_invisible'] = array(
	'name' => __('Whitespace', 'dt_themes'),
	'tooltip' => __('Use this module to add whitespace', 'dt_themes'),
	'icon_class' => 'ico-divider',
	'disable_resize' => true,
);

$dt_modules['others']['hr_invisible_small'] = array(
	'name' => __('Whitespace Small', 'dt_themes'),
	'tooltip' => __('Use this module to add small whitespace', 'dt_themes'),
	'icon_class' => 'ico-divider',
	'disable_resize' => true,
);

$dt_modules['others']['hr_invisible_medium'] = array(
	'name' => __('Whitespace Medium', 'dt_themes'),
	'tooltip' => __('Use this module to add medium whitespace', 'dt_themes'),
	'icon_class' => 'ico-divider',
	'disable_resize' => true,
);

$dt_modules['others']['hr_invisible_large'] = array(
	'name' => __('Whitespace Large', 'dt_themes'),
	'tooltip' => __('Use this module to add large whitespace', 'dt_themes'),
	'icon_class' => 'ico-divider',
	'disable_resize' => true,
);

$dt_modules['others']['address'] = array(
	'name' => __('Address', 'dt_themes'),
	'tooltip' => __('Use this module to add address', 'dt_themes'),
	'icon_class' => 'ico-address',
	'options' => array(
		'line1' => array(
			'title' => __('Line 1', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'No: 58 A, East Madison St'
		),
		'line2' => array(
			'title' => __('Line 2', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'Baltimore, MD, USA'
		),
		'line3' => array(
			'title' => __('Line 3', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'line4' => array(
			'title' => __('Line 4', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		)
	)
);

$dt_modules['others']['phone'] = array(
	'name' => __('Phone', 'dt_themes'),
	'tooltip' => __('Use this module to add phone', 'dt_themes'),
	'icon_class' => 'ico-phone',
	'options' => array(
		'phone' => array(
			'title' => __('Phone No', 'dt_themes'),
			'type' => 'text',
			'default_value' => '+1 200 258 2145'
		)
	)
);

$dt_modules['others']['mobile'] = array(
	'name' => __('Mobile', 'dt_themes'),
	'tooltip' => __('Use this module to add mobile', 'dt_themes'),
	'icon_class' => 'ico-mobile',
	'options' => array(
		'mobile' => array(
			'title' => __('Mobile No', 'dt_themes'),
			'type' => 'text',
			'default_value' => '+91 99941 48997'
		)
	)
);

$dt_modules['others']['fax'] = array(
	'name' => __('Fax', 'dt_themes'),
	'tooltip' => __('Use this module to add fax', 'dt_themes'),
	'icon_class' => 'ico-fax',
	'options' => array(
		'fax' => array(
			'title' => __('Fax No', 'dt_themes'),
			'type' => 'text',
			'default_value' => '+1 100 458 2345'
		)
	)
);

$dt_modules['others']['email'] = array(
	'name' => __('Email', 'dt_themes'),
	'tooltip' => __('Use this module to add email', 'dt_themes'),
	'icon_class' => 'ico-email',
	'options' => array(
		'emailid' => array(
			'title' => __('Mail ID', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'yourname@somemail.com'
		)
	)
);

$dt_modules['others']['web'] = array(
	'name' => __('Web', 'dt_themes'),
	'tooltip' => __('Use this module to add website', 'dt_themes'),
	'icon_class' => 'ico-web',
	'options' => array(
		'url' => array(
			'title' => __('URL', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'http://www.google.com'
		)
	)
);

$dt_modules['others']['h1'] = array(
	'name' => __('H1', 'dt_themes'),
	'tooltip' => 'Add title H1',
	'icon_class' => 'ico-headings',
	'options' => array(
		'class' => array(
			'title' => __('Align', 'dt_themes'),
			'type' => 'select',
			'options' => array('alignleft' => 'Align Left', 'aligncenter' => 'Align Center', 'alignright' => 'Align Right'),
			'default_value' => array('alignleft')
		),
		'h1_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => 'Lorem ipsum dolor sit amet'
		)
	)
);

$dt_modules['others']['h2'] = array(
	'name' => __('H2', 'dt_themes'),
	'tooltip' => 'Add title H2',
	'icon_class' => 'ico-headings',
	'options' => array(
		'class' => array(
			'title' => __('Align', 'dt_themes'),
			'type' => 'select',
			'options' => array('alignleft' => 'Align Left', 'aligncenter' => 'Align Center', 'alignright' => 'Align Right'),
			'default_value' => array('alignleft')
		),
		'h2_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => 'Lorem ipsum dolor sit amet'
		)
	)
);

$dt_modules['others']['h3'] = array(
	'name' => __('H3', 'dt_themes'),
	'tooltip' => 'Add title H3',
	'icon_class' => 'ico-headings',
	'options' => array(
		'class' => array(
			'title' => __('Align', 'dt_themes'),
			'type' => 'select',
			'options' => array('alignleft' => 'Align Left', 'aligncenter' => 'Align Center', 'alignright' => 'Align Right'),
			'default_value' => array('alignleft')
		),
		'h3_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => 'Lorem ipsum dolor sit amet'
		)
	)
);

$dt_modules['others']['h4'] = array(
	'name' => __('H4', 'dt_themes'),
	'tooltip' => 'Add title H4',
	'icon_class' => 'ico-headings',
	'options' => array(
		'class' => array(
			'title' => __('Align', 'dt_themes'),
			'type' => 'select',
			'options' => array('alignleft' => 'Align Left', 'aligncenter' => 'Align Center', 'alignright' => 'Align Right'),
			'default_value' => array('alignleft')
		),
		'h4_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => 'Lorem ipsum dolor sit amet'
		)
	)
);

$dt_modules['others']['h5'] = array(
	'name' => __('H5', 'dt_themes'),
	'tooltip' => 'Add title H5',
	'icon_class' => 'ico-headings',
	'options' => array(
		'class' => array(
			'title' => __('Align', 'dt_themes'),
			'type' => 'select',
			'options' => array('alignleft' => 'Align Left', 'aligncenter' => 'Align Center', 'alignright' => 'Align Right'),
			'default_value' => array('alignleft')
		),
		'h5_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => 'Lorem ipsum dolor sit amet'
		)
	)
);

$dt_modules['others']['h6'] = array(
	'name' => __('H6', 'dt_themes'),
	'tooltip' => 'Add title H6',
	'icon_class' => 'ico-headings',
	'options' => array(
		'class' => array(
			'title' => __('Align', 'dt_themes'),
			'type' => 'select',
			'options' => array('alignleft' => 'Align Left', 'aligncenter' => 'Align Center', 'alignright' => 'Align Right'),
			'default_value' => array('alignleft')
		),
		'h6_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => 'Lorem ipsum dolor sit amet'
		)
	)
);

$dt_modules['others']['title_with_icon'] = array(
	'name' => __('Title with Icon', 'dt_themes'),
	'tooltip' => 'Add title with Icon',
	'icon_class' => 'ico-headings',
	'options' => array(
		'title' => array(
			'title' => __('Title', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'Lorem ipsum dolor sit amet'
		),
		'subtitle' => array(
			'title' => __('Sub Title', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'Lorem ipsum dolor sit amet'
		),
		'icon' => array(
			'title' => __('Fontawesome Icon', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'fa-gear'
		)
	)
);

$dt_modules['others']['contact_form'] = array(
	'name' => __('Contact Form', 'dt_themes'),
	'tooltip' => __('Use this module to display contact form', 'dt_themes'),
	'icon_class' => 'ico-newsletter-section',
	'options' => array(
		'to_email' => array(
			'title' => __('Recipient Email', 'dt_themes'),
			'type' => 'text',
			'default_value' => get_bloginfo('admin_email')
		),
		'success_msg' => array(
			'title' => __('Success Message', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'Thanks for Contacting Us, We will call back to you soon.'
		),
		'error_msg' => array(
			'title' => __('Error Message', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'Sorry your message not sent, Try again Later.'
		)
	)
);

$dt_modules['others']['doshortcode_social_profile'] = array(
	'name' => __('Social Profile', 'dt_themes'),
	'tooltip' => __('Use this module to add social icons', 'dt_themes'),
	'icon_class' => 'ico-socials',
	'options' => array(
		'nl_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => '[dt_social text="We\'re social everywhere. Come let\'s meet here." /]'
		)
	)
);

$dt_modules['others']['welcome_text'] = array(
	'name' => __('Welcome Text', 'dt_themes'),
	'tooltip' => __('Use this module to add welcome text', 'dt_themes'),
	'icon_class' => 'ico-headings',
	'options' => array(
		'wel_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => ''
		)
	)
);

$dt_modules['others']['marker'] = array(
	'name' => __('Map Marker', 'dt_themes'),
	'tooltip' => __('Use this module to use map marker', 'dt_themes'),
	'icon_class' => 'ico-map',
	'options' => array(
		'title' => array(
			'title' => __('Title', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'color' => array(
			'title' => __('Icon Color', 'dt_themes'),
			'type' => 'select',
			'options' => array('green' => 'Green', 'skyblue' => 'Skyblue', 'orange' => 'Orange', 'red' => 'Red', 'blue' => 'Blue', 'violet' => 'Violet'),
			'default_value' => array('green')
		)
	)
);

$dt_modules['others']['number_count'] = array(
	'name' => __('Counting Number', 'dt_themes'),
	'tooltip' => __('Use this module to add number count', 'dt_themes'),
	'icon_class' => 'ico-timeline',
	'options' => array(
		'icon' => array(
			'title' => __('Icon', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'location-arrow'
		),
		'value' => array(
			'title' => __('Value', 'dt_themes'),
			'type' => 'text',
			'default_value' => 1540
		),
		'title' => array(
			'title' => __('Title', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'nc_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => 'Nunc at pretium est curabitur commodo leac est venenatis egestas sed aliquet auguevelit.'
		)
	)
);

$dt_modules['others']['support_section'] = array(
	'name' => __('Support Section', 'dt_themes'),
	'tooltip' => __('Use this module to add support section', 'dt_themes'),
	'icon_class' => 'ico-planavisit',
	'options' => array(
		'title' => array(
			'title' => __('Title', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'link' => array(
			'title' => __('Link', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'phone' => array(
			'title' => __('Phone', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'image' => array(
			'title' => __('Image', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'http://placehold.it/250x350'
		),
		'sup_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => 'Nunc at pretium est curabitur commodo leac est venenatis egestas sed aliquet auguevelit.'
		)
	)
);

$dt_modules['others']['feature_icon'] = array(
	'name' => __('Feature Icon', 'dt_themes'),
	'tooltip' => __('Use this module to add feature icon', 'dt_themes'),
	'icon_class' => 'ico-iconbox',
	'options' => array(
		'icon' => array(
			'title' => __('Fontawesome Icon', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'gift'
		),
		'text' => array(
			'title' => __('Text', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'Lorem ipsum dolor sit amet'
		)
	)
);

$dt_modules['others']['intro_text'] = array(
	'name' => __('Intro Text', 'dt_themes'),
	'tooltip' => __('Use this module to add introduction text', 'dt_themes'),
	'icon_class' => 'ico-headings',
	'options' => array(
		'type' => array(
			'title' => __('Type', 'dt_themes'),
			'type' => 'select',
			'options' => array( 'type1' => 'Type - 1', 'type2' => 'Type - 2'),
			'default_value' => array('type1')
		),
		'it_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => '<h2>Welcome to Trendy Travel</h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.'
		)
	)
);

$dt_modules['others']['theme_iconbox'] = array(
	'name' => __('Theme Icon Box', 'dt_themes'),
	'tooltip' => __('Use this module to add theme icon box', 'dt_themes'),
	'icon_class' => 'ico-iconbox',
	'options' => array(
		'icon' => array(
			'title' => __('Fontawesome Icon', 'dt_themes'),
			'type' => 'text',
			'default_value' => 'heart'
		),
		'title' => array(
			'title' => __('Title', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		),
		'text' => array(
			'title' => __('Text', 'dt_themes'),
			'type' => 'text',
			'default_value' => ''
		)
	)
);

$dt_modules['others']['doshortcode_map_pointers'] = array(
	'name' => __('Image Map & Pointers', 'dt_themes'),
	'tooltip' => __('Use this module to add image map & pointers', 'dt_themes'),
	'icon_class' => 'ico-map',
	'options' => array(
		'nl_content' => array(
			'title' => __('Content', 'dt_themes'),
			'type' => 'wp_editor',
			'is_content' => true,
			'default_value' => '[dt_image_map_container]<br>
				[dt_image_map_pointer title="Machu Picchu" top="385" left="239" color="red"] Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. [/dt_image_map_pointer]<br>

				[dt_image_map_pointer title="Great Wall of China" top="193" left="788" color="grey"] Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. [/dt_image_map_pointer]<br>
			[/dt_image_map_container]'
		)
	)
);

/*  End of Others Modules */?>
