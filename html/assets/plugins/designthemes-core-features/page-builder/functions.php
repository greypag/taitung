<?php

/**
 * A function to get modules menu list
 */
if ( ! function_exists('dt_get_modules_menu') ){
	function dt_get_modules_menu($dt_hide_elements){
		global $dtthemes_columns, $dtthemes_sample_layouts, $post, $postid, $theme_name, $dtthemes_modules, $dt_module_titles, $dt_widget_titles, $dt_widgets;
		
		$dt_hide_elements = explode(',', $dt_hide_elements);
		$dt_hide_elements = array_filter($dt_hide_elements);
		
		if(isset($dtthemes_columns) && (!in_array('columns', $dt_hide_elements))) { ?><a href="#" class="dt_add_element dt_add_column"><?php esc_html_e('Columns', 'dt_themes'); ?></a><?php }
		
		if(isset($dtthemes_modules) && (!in_array('modules', $dt_hide_elements))) {
			foreach($dt_module_titles as $dt_mod_key => $dt_module_title) {
				if(isset($dtthemes_modules[$dt_mod_key])) {
					?>
					<a href="#" class="dt_add_element <?php echo 'dt_add_'.$dt_mod_key ; ?>"><?php echo esc_html($dt_module_title); ?></a>
					<?php
				}
			}
		}
		
		if(isset($dt_widgets) && (!in_array('widgets', $dt_hide_elements))) {
			foreach($dt_widget_titles as $dt_mod_key => $dt_widget_title) {
				$i = 0;
				foreach ( $dt_widgets as $module_key => $module_settings ){
					if ($dt_widget_title['search_key'] != '*' && strpos($module_key, $dt_widget_title['search_key']) !== false) $i++; elseif ($dt_widget_title['search_key'] == '*') $i++;
				}
				if($i > 0) {
					?>
					<a href="#" class="dt_add_element <?php echo 'dt_add_'.$dt_mod_key ; ?>"><?php echo esc_html($dt_widget_title['name']); ?></a>
					<?php
				}
			}
		}
		
		if(isset($dtthemes_sample_layouts) && (!in_array('samplelayout', $dt_hide_elements))) { ?><a href="#" class="dt_add_element dt_add_sample_layout"><?php esc_html_e('Sample Layouts', 'dt_themes'); ?></a><?php }

	?>
	<?php
	}
}

/**
 * A function to get complete modules list
 */
if ( ! function_exists('dt_get_modules_list') ){
	function dt_get_modules_list($dt_hide_elements){
		global $dtthemes_columns, $dtthemes_sample_layouts, $post, $postid, $theme_name, $dt_module_titles, $dtthemes_modules, $dt_widget_titles, $dt_widgets;
		 
		$dt_hide_elements = explode(',', $dt_hide_elements);
		$dt_hide_elements = array_filter($dt_hide_elements);
		
		// Columns
		if(isset($dtthemes_columns) && (!in_array('columns', $dt_hide_elements))):
			foreach ( $dtthemes_columns as $column_key => $column_settings ){
				
				if($column_settings['type'] != 'section') {
					
					if($column_key != 'resizable') $extra_cls = 'dt_disable_resize'; else $extra_cls = '';
					echo "<div data-placeholder='" . esc_attr( $column_settings['name'] ) . "' data-filter='" . esc_attr( strtolower($column_settings['name']) ) . "' data-name='" . esc_attr( $column_key ) . "' class='" . esc_attr( "dt_module dt_m_column {$extra_cls} dt_m_column_{$column_key}" ) . "'>" .
						'<div class="dt_module_controls">
							<span class="dt_module_name dt_column_name">' . esc_html( $column_settings['name'] ) . '</span>
							<span class="dt_move"></span>
							<div class="dt_module_options">
								<span class="dt_delete_column" title="Delete"></span>
								<span class="dt_clone_column" title="Clone"></span>
								<span class="dt_settings_arrow_column" title="Settings"></span>
							</div>
							<div class="dt_columndata_settings"></div>
						</div>
						<div class="dt_modules_holder dt_modules_container"></div>
						<div class="dt_show_modules_in_popup dt_popup_from_column" title="'.esc_attr__('Add Module', 'dt_themes').'"></div>
					</div>';
					
				} else {
					
					echo "<div data-placeholder='" . esc_attr( $column_settings['name'] ) . "' data-filter='" . esc_attr( strtolower($column_settings['name']) ) . "' data-name='".$column_key."' class='" . esc_attr( "dt_module dt_disable_resize dt_fullwidth_section {$column_key}" ) . "'>" .
						'<div class="dt_module_controls">
							<span class="dt_module_name dt_column_name">'.$column_settings['name'].'</span>
							<span class="dt_move"></span>
							<div class="dt_module_options">
								<span class="dt_delete_column" title="Delete"></span>
								<span class="dt_clone_column" title="Clone"></span>
								<span class="dt_settings_arrow_fullwidth" title="Settings"></span>
							</div>
							<div class="dt_fullwidthsection_data_settings"></div>
						</div>
						<div class="dt_modules_holder dt_fullwidth_section_container"></div>
						<div class="dt_show_modules_in_popup dt_popup_from_section" title="'.esc_attr__('Add Module', 'dt_themes').'"></div>
					</div>';
					
				}
			}
		endif;
		
		// Modules
		if(isset($dtthemes_modules) && (!in_array('modules', $dt_hide_elements))) {
			foreach($dt_module_titles as $dt_mod_key => $dt_module_title) {
				if(isset($dtthemes_modules[$dt_mod_key])) {
					foreach ( $dtthemes_modules[$dt_mod_key] as $module_key => $module_settings ) {
						$class = "dt_module dt_m_{$module_key} dt_module_".$dt_mod_key;
						if(isset($module_settings['disable_resize'])) $class .= " dt_disable_resize";
						if(isset($module_settings['full_width']) && $module_settings['full_width']) $class .= ' dt_full_width';
						if(isset($module_settings['tooltip'])) $tooltip = $module_settings['tooltip']; else $tooltip = $module_settings['name'];
						if(isset($module_settings['width'])) $spacer_width = " data-width='" . esc_attr( $module_settings['width'] ) . "'"; else $spacer_width = '';
						
						echo "<div data-placeholder='" . esc_attr( $module_settings['name'] ) . "' data-filter='" . esc_attr( strtolower($module_settings['name']) ) . "' data-name='" . esc_attr( $module_key ) . "' class='" . esc_attr( $class ) . " dt-sc-tooltip' title='" . $tooltip . "' " . $spacer_width . ">" . 
						'<span class="' . esc_html( $module_settings['icon_class'] ) . ' dt_icon"></span>
						<span class="dt_module_name">' . esc_html( $module_settings['name'] ) . '</span>';
						echo '<div class="dt_module_options">';
							if(!isset($module_settings['disable_resize'])) echo '<span class="dt_move"></span>';
							echo '<span class="dt_showorhide dt_show" title="Show"></span>
							<span class="dt_delete" title="Delete"></span>
							<span class="dt_clone_module" title="Clone"></span>';
							if(isset($module_settings['options'])): echo '<span class="dt_settings_arrow_module" title="Settings"></span>'; endif;
						echo '</div>
							<div class="dt_preview"></div>
							<div class="dt_module_settings"></div>
						</div>';
					}
				}
			}
		}
		
		
		// Widgets
		if(isset($dt_widgets) && (!in_array('widgets', $dt_hide_elements))) {
			$srch_arr = $wdkeys = array();
			foreach($dt_widget_titles as $wd_title) { if($wd_title['search_key'] != '*') $wdkeys[] = $wd_title['search_key']; }
			
			foreach($dt_widget_titles as $dt_key => $dt_widget_title) {	
				foreach ( $dt_widgets as $module_key => $module_settings ){
						if ($dt_widget_title['search_key'] != '*' && strpos($module_key, $dt_widget_title['search_key']) !== false) {
							
							$ico_class = explode('-', $module_settings['wpid']);
							$class = "dt_module dt_m_widget dt_m_{$module_key} dt_".$dt_key;
							if(isset( $module_settings['tooltip'])) $tooltip = $module_settings['tooltip']; else $tooltip = $module_settings['name'];
							echo "<div data-placeholder='" . esc_attr( $module_settings['name'] ) . "' data-filter='" . esc_attr( strtolower($module_settings['name']) ) . "' data-wpid='" . esc_attr( $module_settings['wpid'] ) . "' data-wpname='" . esc_attr( $module_settings['wpname'] ) . "' data-name='" . esc_attr( $module_key ) . "'  data-attr='" . esc_attr( $module_key ) . "' class='" . esc_attr( $class ) . " dt-sc-tooltip'  title='" . $tooltip . "'>" . 
								'<span class="ico-' . $ico_class[0] . ' dt_icon"></span>
								<span class="dt_module_name">' . esc_html( $module_settings['name'] ) . '</span>
								<div class="dt_module_options">
									<span class="dt_move"></span>
									<span class="dt_showorhide dt_show" title="Show"></span>
									<span class="dt_delete" title="Delete"></span>
									<span class="dt_clone_module" title="Clone"></span>';
									if(isset($module_settings['form'])): echo '<span class="dt_settings_arrow_widget" title="Settings"></span>'; endif;
								echo '</div>
								<div class="dt_preview"></div>
								<div class="dt_module_settings"></div>
							</div>';
							
						} elseif ($dt_widget_title['search_key'] == '*' && !in_array(substr($module_key, 0, 2), $wdkeys)) {
							
							$ico_class = explode('-', $module_settings['wpid']);
							$class = "dt_module dt_m_widget dt_m_{$module_key} dt_".$dt_key;
							if(isset( $module_settings['tooltip'])) $tooltip = $module_settings['tooltip']; else $tooltip = $module_settings['name'];
							echo "<div data-placeholder='" . esc_attr( $module_settings['name'] ) . "' data-filter='" . esc_attr( strtolower($module_settings['name']) ) . "' data-wpid='" . esc_attr( $module_settings['wpid'] ) . "' data-wpname='" . esc_attr( $module_settings['wpname'] ) . "' data-name='" . esc_attr( $module_key ) . "'  data-attr='" . esc_attr( $module_key ) . "' class='" . esc_attr( $class ) . " dt-sc-tooltip'  title='" . $tooltip . "'>" . 
								'<span class="ico-' . $ico_class[0] . ' dt_icon"></span>
								<span class="dt_module_name">' . esc_html( $module_settings['name'] ) . '</span>
								<div class="dt_module_options">
									<span class="dt_move"></span>
									<span class="dt_showorhide dt_show" title="Show"></span>
									<span class="dt_delete" title="Delete"></span>
									<span class="dt_clone_module" title="Clone"></span>';
									if(isset($module_settings['form'])): echo '<span class="dt_settings_arrow_widget" title="Settings"></span>'; endif;
								echo '</div>
								<div class="dt_preview"></div>
								<div class="dt_module_settings"></div>
							</div>';
							
						}
				}
			}
		}
		
		if(isset($dtthemes_sample_layouts) && (!in_array('samplelayout', $dt_hide_elements))):
			foreach ( $dtthemes_sample_layouts as $layout_key => $layout_settings ){
				
				$is_user_sample_layout = isset( $layout_settings['is_user_sample_layout'] ) && $layout_settings['is_user_sample_layout'];
				
				echo "<div data-placeholder='" . esc_attr( $layout_settings['name'] ) . "' data-filter='" . esc_attr( strtolower($layout_settings['name']) ) . "' data-name='" . esc_attr( $layout_key ) . "' class='" . esc_attr( "dt_module dt_sample_layout" ) . "'>" .
				'<span class="dt_module_name">' . esc_html( $layout_settings['name'] ) . '</span>' .
				'<span class="dt_move"></span>' . ( $is_user_sample_layout ? '<span class="dt_user_layout_delete">x</span>' : '' ) . '</div>';
			}
		endif;	
	}
}


/**
 * A action hook to save layout
 */
add_action( 'wp_ajax_dttheme_save_layout', 'dttheme_save_layout' );
function dttheme_save_layout(){
	if ( ! wp_verify_nonce( $_POST['dt_load_nonce'], 'dt_load_nonce' ) ) die(-1);

	$dt_convertible_settings = array();

	$dt_convertible_settings['layout_html'] = trim( $_POST['dt_layout_html'] ); 
	$dt_convertible_settings['layout_shortcode'] = $_POST['dt_layout_shortcode'];
	$dt_post_id = (int) $_POST['dt_post_id'];

	update_post_meta( $dt_post_id, '_dt_builder_settings', $dt_convertible_settings );
	
	die();
}

/**
 * A action hook to create sample layout
 */
add_action( 'wp_ajax_dttheme_create_new_sample_layout', 'dttheme_create_new_sample_layout' );
function dttheme_create_new_sample_layout(){

	if ( ! wp_verify_nonce( $_POST['dt_load_nonce'], 'dt_load_nonce' ) ) die(-1);

	$dt_layout_html = trim( $_POST['dt_layout_html'] );
	$dt_new_layout_name = sanitize_text_field( $_POST['dt_new_layout_name'] );

	$dtthemes_settings = get_option( 'dtthemes_settings' );

	$custom_layouts = isset( $dtthemes_settings['custom_sample_layouts'] ) ? $dtthemes_settings['custom_sample_layouts'] : array();
	$custom_layouts[] = array( 'name' => $dt_new_layout_name, 'content' => $dt_layout_html, 'is_user_sample_layout' => true );

	$dtthemes_settings['custom_sample_layouts'] = $custom_layouts;

	update_option( 'dtthemes_settings', $dtthemes_settings );

	die();
}


/**
 * A action hook to delete sample layout
 */
add_action( 'wp_ajax_dttheme_delete_sample_layout', 'dttheme_delete_sample_layout' );
function dttheme_delete_sample_layout(){
	if ( ! wp_verify_nonce( $_POST['dt_load_nonce'], 'dt_load_nonce' ) ) die(-1);

	$dt_layout_key = (int) $_POST['dt_layout_key'];

	$dtthemes_settings = get_option( 'dtthemes_settings' );

	if ( isset( $dtthemes_settings['custom_sample_layouts'][$dt_layout_key] ) ){
		unset( $dtthemes_settings['custom_sample_layouts'][$dt_layout_key] );
		$dtthemes_settings['custom_sample_layouts'] = array_values( $dtthemes_settings['custom_sample_layouts'] );
		update_option( 'dtthemes_settings', $dtthemes_settings );
	}

	die();
}


/**
 * A action hook to append sample layout to existing layout
 */
add_action( 'wp_ajax_dttheme_append_layout', 'dttheme_append_layout' );
function dttheme_append_layout(){
	global $dtthemes_sample_layouts;

	if ( ! wp_verify_nonce( $_POST['dt_load_nonce'], 'dt_load_nonce' ) ) die(-1);

	$layout_name = $_POST['dt_layout_name'];
	

	if ( isset( $dtthemes_sample_layouts[$layout_name] ) ) echo stripslashes( $dtthemes_sample_layouts[$layout_name]['content'] );

	die();
}



/**
 * A action hook and funtion to get modules data
 */
add_action( 'wp_ajax_dttheme_get_module_data', 'dttheme_get_module_data' );
function dttheme_get_module_data(){
	if ( ! wp_verify_nonce( $_POST['dt_load_nonce'], 'dt_load_nonce' ) ) die(-1);

	$module_name = $module_type = $matches = $module_class = $dt_module_exact_name = '';
	$module_window = 0;

	$module_class = $_POST['dt_module_class'];
	$dt_module_exact_name = $_POST['dt_module_exact_name'];
	$module_window = (int) $_POST['dt_modal_window'];

	$cors_mod = explode(' ', $module_class);
	foreach($cors_mod as $cmod) {
		if (strpos($cmod, 'dt_module_') !== false) $module_type = str_replace('dt_module_', '', $cmod);	
	}

	preg_match_all( '/dt_m_([^\s])+/', $module_class, $matches );	
	$module_name = str_replace( 'dt_m_', '', $matches[0][0] );

	dt_generate_module_datas( $module_name, $dt_module_exact_name, $module_type );
	
	die();
}


if ( ! function_exists('dt_generate_module_datas') ){
	function dt_generate_module_datas( $module_name, $dt_module_exact_name, $module_type ){
		global $dtthemes_modules;
		
		$dtthemes_modules_new = $dtthemes_modules;

		if(isset($dtthemes_modules_new[$module_type][$module_name]['options'])):
			echo '<div class="dt_module_settings">';
			foreach ( $dtthemes_modules_new[$module_type][$module_name]['options'] as $option_slug => $option_settings ){
				$content_class = $opt_name = $opt_content = '';
				$opt_name = esc_attr( $option_slug );
				if(isset( $option_settings['is_content'] )):
					if(isset($option_settings['default_value'])) $opt_content = $option_settings['default_value'];
					else $opt_content = '';
					$content_class = isset( $option_settings['is_content'] ) ? 'dtthemes_module_content ' : '';
				else:
					$default_value = isset( $option_settings['default_value'] ) ? $option_settings['default_value'] : '';
					if(is_array($default_value)):
						$opt_content = implode(',', $default_value);
					else:
						$opt_content = ('' != $default_value) ? esc_attr( $default_value ) : '';
					endif;
				endif;
				echo '<div data-option_name="' . $opt_name . '" class="' . $content_class . $opt_name . ' dt_module_setting">' . $opt_content . '</div>';
			}
			echo '</div>';
		else:
			echo '<div class="dt_module_settings"></div>';
		endif;
		
	}
}


/**
 * A action hook and funtion to show module options
 */
add_action( 'wp_ajax_dttheme_show_module_options', 'dttheme_show_module_options' );
function dttheme_show_module_options(){
	if ( ! wp_verify_nonce( $_POST['dt_load_nonce'], 'dt_load_nonce' ) ) die(-1);

	$module_name = $module_type = $matches = '';

	$module_class = $_POST['dt_module_class'];
	$dt_module_exact_name = $_POST['dt_module_exact_name'];

	$cors_mod = explode(' ', $module_class);
	foreach($cors_mod as $cmod) {
		if (strpos($cmod, 'dt_module_') !== false && $cmod != 'dt_module_resizable') $module_type = str_replace('dt_module_', '', $cmod);	
	}

	preg_match_all( '/dt_m_([^\s])+/', $module_class, $matches );	
	$module_name = str_replace( 'dt_m_', '', $matches[0][0] );

	dt_generate_module_options( $module_name, $dt_module_exact_name, $module_type );
	
	die();
}

if ( ! function_exists('dt_generate_module_options') ){
	function dt_generate_module_options( $module_name, $dt_module_exact_name, $module_type ){
		global $dtthemes_modules;
		
		$dtthemes_modules_new = $dtthemes_modules;
		
		$i = 1;

		echo '<div class="dt_dialog_handle">' . esc_html( $dt_module_exact_name . ' ' . esc_html__('Settings', 'dt_themes') ) . '</div><a href="#" id="dt_close_module_settings"></a>';
		echo '<form id="dt_module_settings" class="dt_settings_form">';

		$totaloptions = count($dtthemes_modules_new[$module_type][$module_name]['options']);
		$halfoptions = '';
		
		if($totaloptions > 10) {
			$oddeven = ($totaloptions%2);
			if($oddeven == 1) { $totaloptions_str = $totaloptions - 1; }
			else { $totaloptions_str = $totaloptions; }
			$halfoptions = ($totaloptions_str/2);
			if($oddeven == 1) { $halfoptions = $halfoptions + 1; }
			echo '<div class="column dt-sc-one-half first">';
		}
		
		
		
		$wp_editor_module = array();
		
		if(isset($dtthemes_modules_new[$module_type][$module_name]['options'])) {
		
			foreach ( $dtthemes_modules_new[$module_type][$module_name]['options'] as $option_slug => $option_settings ){
				$content_class = isset( $option_settings['is_content'] ) ? ' dtthemes_module_content' : '';
	
				if(isset( $option_settings['depand_on'] )) {
					$dep_str = implode(' ', $option_settings['depand_on']['value']);
					$dep_cls = 'class="dt-filter '.$dep_str.'"';
					$dep_attr = 'style="display:none;"';
				} else {
					$dep_str = '';
					$dep_cls = '';
					$dep_attr = '';
				}
	
				if($option_settings['type'] != 'wp_editor') { echo '<p '.$dep_cls.' '.$dep_attr.'>'; }
				
				if($option_slug == 'info'): echo '<p>'.$option_settings.'</p>'; 
				elseif ( isset( $option_settings['title'] ) && $option_settings['type'] != 'wp_editor' ): echo "<label>{$option_settings['title']}</label>"; endif;
				
				switch ( $option_settings['type'] ) {
					
					case 'wp_editor':
						$opt_content = isset($option_settings['default_value']) ? $option_settings['default_value'] : '';
						$wp_editor_module['default_value'] = $opt_content;
						$wp_editor_module['option_slug'] = $option_slug;
						$wp_editor_module['content_class'] = $content_class;
						$wp_editor_module['editor_title'] = $option_settings['title'];
						
						break;
						
					case 'select':		
						$default_value = isset( $option_settings['default_value'] ) ? $option_settings['default_value'] : array();
						$dt_depand = isset( $option_settings['depand'] ) ? 'dt-depand' : '';
						$select_value = isset( $option_settings['select_value'] ) ? $option_settings['select_value'] : '';
						
						if(isset($option_settings['multiple']) && $option_settings['multiple'] == 1) { $multi_str = 'multiple="multiple"'; $content_class .= ' dt_multiselect'; } else { $multi_str = ''; }
						echo
						'<span class="selection-box"><select name="' . esc_attr( $option_slug ) . '" id="' . esc_attr( $option_slug ) . '" class="dtthemes_option ' . $dt_depand . ' ' . $content_class . '" '.$multi_str.'>'
							. '<option value="'.$select_value.'">  ' . esc_html__('Select', 'dt_themes') . '  </option>';
							foreach ( $option_settings['options'] as  $setting_key => $setting_value ){
								$sel_value =  isset($setting_key) ? $setting_key : $setting_value;
								$sel_res = in_array($sel_value, $default_value) ? ' selected="selected"' : '';
								echo '<option value="' . esc_attr( $sel_value ) . '"' . $sel_res . '>' . esc_html( $setting_value ) . '</option>';
							}
						echo '</select></span>';
						break;
						
					case 'text':
						$default_value = isset( $option_settings['default_value'] ) ? $option_settings['default_value'] : '';
						echo '<input name="' . esc_attr( $option_slug ) . '" type="text" id="' . esc_attr( $option_slug ) . '" value="'.$default_value.'" class="regular-text dtthemes_option' . $content_class . '" />';
						break;
						
					case 'checkbox':
						if(isset($option_settings['default_value']) && $option_settings['default_value'] == $option_settings['returnval']) $chk = checked('checked'); else $chk = '';
						$defval = isset( $option_settings['returnval'] ) ? $option_settings['returnval'] : esc_attr( $option_slug );
						echo '<input name="' . esc_attr( $option_slug ) . '"  value="' . $defval . '" type="checkbox" id="' . esc_attr( $option_slug ) . '" class="dtthemes_option' . $content_class . '" '.$chk.' />';
						break;
						
					case 'upload':
						echo '<input name="' . esc_attr( $option_slug ) . '" type="text" id="' . esc_attr( $option_slug ) . '" value="" class="regular-text dtthemes_option dtthemes_upload_field' . $content_class . '" />' . '<a href="#" class="dtthemes_upload_button">' . esc_html__('Upload', 'dt_themes') . '</a>';
						break;

					case 'colorpicker':		
						dtthemes_color_picker(esc_attr( $option_slug ), '#');
						break;
						
				}
	
				if($option_settings['type'] != 'wp_editor') { echo '</p>'; }
	
				if($i == $halfoptions) { echo '</div><div class="column dt-sc-one-half">'; }
				$i++;
				
			}
			
			if($totaloptions > 10) {
				echo '</div>';
			}
			
			if(!empty($wp_editor_module)) {
				echo '<div class="column dt-sc-one-column first">';
					$opt_content = $wp_editor_module['default_value'];
					$option_slug = $wp_editor_module['option_slug'];
					$content_class = $wp_editor_module['content_class'];
					$editor_title = $wp_editor_module['editor_title'];
					
					echo '<label>'.$editor_title.'</label>';
					wp_editor( $opt_content, $option_slug, array( 'editor_class' => 'dtthemes_wp_editor dtthemes_option ' . $content_class ) );
				echo '</div>';
			}
			
		
		} else {
			echo '<p>This module don\'t have any attribute to set, just click save changes button to add shortcode.</p>';
		}
		
		echo '<span id="dt_save_data" class="dt_button dt_save_text">'.esc_html__('Save Changes', 'dt_themes').'</span>';
		
		echo '<input type="hidden" id="dt_saved_module_name" value="' . esc_attr( $module_name ) . '" />';
		
		if(isset($dtthemes_modules_new[$module_type][$module_name]['disable_resize'])) { $dis_resize = $dtthemes_modules_new[$module_type][$module_name]['disable_resize']; }
		else { $dis_resize = ''; }
		
		echo '<input type="hidden" id="dt_disable_resize" value="' . $dis_resize . '" />';
		
		if(isset($wp_editor_module['option_slug']) && $wp_editor_module['option_slug'] != '') {echo '<input type="hidden" id="dt_wp_editor_name" value="' . esc_attr( $wp_editor_module['option_slug'] ) . '" />'; }

		echo '</form>';

		
	}
}


/**
 * A action hook and funtion to show widget options
 */
add_action( 'wp_ajax_dttheme_show_widget_options', 'dttheme_show_widget_options' );
function dttheme_show_widget_options(){
	if ( ! wp_verify_nonce( $_POST['dt_load_nonce'], 'dt_load_nonce' ) ) die(-1);

	$module_name = $module_type = $matches = '';

	$module_class = $_POST['dt_module_class'];
	$dt_module_exact_name = $_POST['dt_module_exact_name'];

	preg_match_all( '/dt_m_([^\s])+/', $module_class, $matches );
	$module_name = str_replace( 'dt_m_', '', $matches[0][1] );
	dt_generate_widget_options( $module_name, $dt_module_exact_name );
	
	die();
}

if ( ! function_exists('dt_generate_widget_options') ){
	function dt_generate_widget_options( $module_name, $dt_module_exact_name ){
		global $dt_widgets;
		
		$widget_prefix = substr($module_name, 0, 2);
		if($widget_prefix == 'DT') { $widget_cls = 'dttheme_custom_widgets'; } 
		else { $widget_cls = ''; }
		
		if(isset($dt_widgets[$module_name]['form'])):
				
			echo '<div class="dt_dialog_handle">' . esc_html( $dt_module_exact_name . ' ' . esc_html__('Settings', 'dt_themes') ) . '</div><a href="#" id="dt_close_widget_settings"></a>';
			echo '<form id="dt_widget_settings" class="dt_settings_form '.$widget_cls.'">';
			
			echo !empty( $dt_widgets[$module_name]['form'] ) ? $dt_widgets[$module_name]['form'] : '';
			
			echo '<span id="dt_save_data" class="dt_button dt_save_text">'.esc_html__('Save Changes', 'dt_themes').'</span>';
	
			echo '<input type="hidden" id="dt_widget_module_name" value="' . esc_attr( $module_name ) . '" />';
			echo '<input type="hidden" id="dt_widget_module_wpname" value="' . esc_attr( $dt_widgets[$module_name]['wpname'] ) . '" />';
			echo '<input type="hidden" id="dt_widget_module_wpid" value="' . esc_attr( $dt_widgets[$module_name]['wpid'] ) . '" />';
			echo '<input type="hidden" id="dt_widget_module_optionname" value="' . esc_attr( strtolower ($dt_widgets[$module_name]['name']) ) . '" />';
			
			echo '<input type="hidden" id="dt_module_type" value="widget" />';
	
			echo '</form>';
		
		else:
			echo '<p>This module don\'t have any attribute to set</p>';
		endif;
		
	}
}


/**
 * A action hook and funtion to show column additional options
 */
add_action( 'wp_ajax_dttheme_show_columnoptions_panel', 'dttheme_show_columnoptions_panel' );
function dttheme_show_columnoptions_panel(){

	if ( ! wp_verify_nonce( $_POST['dt_load_nonce'], 'dt_load_nonce' ) ) die(-1);
	$dt_module_name = $_POST['dt_module_exact_name'];
	
	dt_generate_columnoptions_panel($dt_module_name);
	
	die();
}

if ( ! function_exists('dt_generate_columnoptions_panel') ){
	function dt_generate_columnoptions_panel($dt_module_name ){
		
		global $dtthemes_columns;
		
		echo '<div class="dt_dialog_handle">' . esc_html__('Column Options', 'dt_themes') . '</div><a href="#" id="dt_close_column_settings"></a>';
		echo '<form id="dt_column_settings" class="dt_settings_form">';
		
		$totaloptions = count($dtthemes_columns[$dt_module_name]['options']);
		$halfoptions = '';
		
		$i = 1;
		
		if($totaloptions > 10) {
			$oddeven = ($totaloptions%2);
			if($oddeven == 1) { $totaloptions_str = $totaloptions - 1; }
			else { $totaloptions_str = $totaloptions; }
			$halfoptions = ($totaloptions_str/2);
			if($oddeven == 1) { $halfoptions = $halfoptions + 1; }
			echo '<div class="column dt-sc-one-half first">';
		}
		
		if(isset($dtthemes_columns[$dt_module_name]['options'])) {
		
			foreach ( $dtthemes_columns[$dt_module_name]['options'] as $option_slug => $option_settings ){
				
				echo '<p>';
				
				echo '<label>'.$option_settings["title"].'</label>';
				
				switch ( $option_settings['type'] ) {
					
					case 'select':		
						$default_value = isset( $option_settings['default_value'] ) ? $option_settings['default_value'] : array();
						
						if(isset($option_settings['multiple']) && $option_settings['multiple'] == 1) { $multi_str = 'multiple="multiple"'; } else { $multi_str = ''; }
						echo
						'<span class="selection-box"><select name="' . esc_attr( $option_slug ) . '" id="' . esc_attr( $option_slug ) . '" class="dtthemes_option dt_multiselect" '.$multi_str.'>'
							. '<option value="">  ' . esc_html__('Select', 'dt_themes') . '  </option>';
							foreach ( $option_settings['options'] as  $setting_key => $setting_value ){
								$sel_value =  isset($setting_key) ? $setting_key : $setting_value;
								$sel_res = in_array($sel_value, $default_value) ? ' selected="selected"' : '';
								echo '<option value="' . esc_attr( $sel_value ) . '"' . $sel_res . '>' . esc_html( $setting_value ) . '</option>';
							}
						echo '</select></span>';
						break;
						
					case 'text':
						$default_value = isset( $option_settings['default_value'] ) ? $option_settings['default_value'] : '';
						echo '<input name="' . esc_attr( $option_slug ) . '" type="text" id="' . esc_attr( $option_slug ) . '" value="'.$default_value.'" class="regular-text dtthemes_option" />';
						break;
						
					case 'checkbox':
						if(isset($option_settings['default_value']) && $option_settings['default_value'] == $option_settings['returnval']) $chk = checked('checked'); else $chk = '';
						$defval = isset( $option_settings['returnval'] ) ? $option_settings['returnval'] : esc_attr( $option_slug );
						echo '<input name="' . esc_attr( $option_slug ) . '"  value="' . $defval . '" type="checkbox" id="' . esc_attr( $option_slug ) . '" class="dtthemes_option" '.$chk.' />';
						break;
						
					case 'upload':
						echo '<input name="' . esc_attr( $option_slug ) . '" type="text" id="' . esc_attr( $option_slug ) . '" value="" class="regular-text dtthemes_option dtthemes_upload_field" />' . '<a href="#" class="dtthemes_upload_button">' . esc_html__('Upload', 'dt_themes') . '</a>';
						break;

					case 'colorpicker':		
						dtthemes_color_picker(esc_attr( $option_slug ), '#');
						break;
						
				}
				
				echo '</p>';
	
				if($i == $halfoptions) { echo '</div><div class="column dt-sc-one-half">'; }
				$i++;
				
			}
			
		}
		
		if($totaloptions > 10) {
			echo '</div>';
		}
		
		echo '<span id="save_columnoptions" class="dt_button save_columnoptions">'.esc_html__('Save Changes', 'dt_themes').'</span>';
		echo '</form>';
		
	}
}


/**
 * A action hook and funtion to show fullwidth section options
 */
add_action( 'wp_ajax_dttheme_show_fullwidthsection_options', 'dttheme_show_fullwidthsection_options' );
function dttheme_show_fullwidthsection_options(){

	if ( ! wp_verify_nonce( $_POST['dt_load_nonce'], 'dt_load_nonce' ) ) die(-1);
	$dt_section_key = $_POST['dt_section_key'];

	dt_generate_fullwidthsection_options($dt_section_key);
	
	die();
}

if ( ! function_exists('dt_generate_fullwidthsection_options') ){
	function dt_generate_fullwidthsection_options( $dt_section_key ){
		global $dtthemes_columns;
		
		echo '<div class="dt_dialog_handle">' . esc_html__('Fullwidth Section Options', 'dt_themes') . '</div><a href="#" id="dt_close_sections_settings"></a>';
		echo '<form id="dt_fullwidth_section_settings" class="dt_settings_form">';
				
				$halfoptions = '';
				$separatecolumns = ($dtthemes_columns[$dt_section_key]['separatecolumns'] == 'true') ? $dtthemes_columns[$dt_section_key]['separatecolumns'] : '';
				if($separatecolumns == 'true') {
					$totaloptions = count($dtthemes_columns[$dt_section_key]['options']);
					
					$oddeven = ($totaloptions%2);
					if($oddeven == 1) { $totaloptions_str = $totaloptions - 1; }
					else { $totaloptions_str = $totaloptions; }
					$halfoptions = ($totaloptions_str/2);
					if($oddeven == 1) { $halfoptions = $halfoptions + 1; }
					
					echo '<div class="column dt-sc-one-half first">';
				}
				
				$i = 1;
				
				foreach($dtthemes_columns[$dt_section_key]['options'] as $field_key => $field_settings) {
					$content_class = isset( $field_settings['is_content'] ) ? ' dtthemes_module_content' : '';
					
					if(isset( $field_settings['depand_on'] )) {
						$dep_str = implode(' ', $field_settings['depand_on']['value']);
						$dep_cls = 'class="dt-filter '.$dep_str.'"';
						$dep_attr = 'style="display:none;"';
					} else {
						$dep_cls = '';
						$dep_attr = '';
					}
					
					switch ( $field_settings['type'] ) {
												
						case 'select':		
							$default_value = isset( $field_settings['default_value'] ) ? array($field_settings['default_value']) : array();
							$dt_depand = isset( $field_settings['depand'] ) ? 'dt-depand' : '';
							
							if($field_key == 'type') { $select_default = 'select'; } else { $select_default = ''; }
							
							if(isset($field_settings['multiple']) && $field_settings['multiple'] == 1) { $multi_str = 'multiple="multiple"'; $content_class .= ' dt_multiselect'; } else { $multi_str = $content_class = ''; }
							
							echo '<p '.$dep_cls.' '.$dep_attr.'><label>'.$field_settings['title'].'</label> ';							
							echo
							'<span class="selection-box"><select name="' . esc_attr( $field_key ) . '" id="' . esc_attr( $field_key ) . '" class="dtthemes_fws_option ' . $dt_depand . $content_class . '" '.$multi_str.'>'
								. '<option value="'.$select_default.'">  ' . esc_html__('Select', 'dt_themes') . '  </option>';
								foreach ( $field_settings['options'] as  $setting_key => $setting_value ){
									$sel_value =  isset($setting_key) ? $setting_key : $setting_value;
									$sel_res = in_array($sel_value, $default_value) ? ' selected="selected"' : '';
									echo '<option value="' . esc_attr( $sel_value ) . '"' . $sel_res . '>' . esc_html( $setting_value ) . '</option>';
								}
							echo '</select></span>';
							echo '</p>';
							break;
							
						case 'text':
							$default_value = isset( $field_settings['default_value'] ) ? $field_settings['default_value'] : '';							
							echo '<p '.$dep_cls.' '.$dep_attr.'><label>'.$field_settings['title'].'</label> ';
							echo '<input name="' . esc_attr( $field_key ) . '" type="text" id="' . esc_attr( $field_key ) . '" value="'.$default_value.'" class="regular-text dtthemes_fws_option' . $content_class . '" />';
							echo '</p>';
							break;
							
						case 'checkbox':
							if(isset($field_settings['default_value']) && $field_settings['default_value'] == $field_settings['returnval']) $chk = checked('checked'); else $chk = '';
							$defval = isset( $field_settings['returnval'] ) ? $field_settings['returnval'] : esc_attr( $field_key );
							echo '<p><label>'.$field_settings['title'].'</label> ';
							echo '<input name="' . esc_attr( $field_key ) . '"  value="' . $defval . '" type="checkbox" id="' . esc_attr( $field_key ) . '" class="dtthemes_fws_option' . $content_class . '" '.$chk.' />';
							echo '</p>';
							break;
							
						case 'upload':
							echo '<p><label>'.$field_settings['title'].'</label> ';
							echo '<input name="' . esc_attr( $field_key ) . '" type="text" id="' . esc_attr( $field_key ) . '" value="" class="regular-text dtthemes_fws_option dtthemes_upload_field' . $content_class . '" />' . '<a href="#" class="dtthemes_upload_button">' . esc_html__('Upload', 'dt_themes') . '</a>';

							echo '</p>';
							break;
	
						case 'colorpicker':	
							echo '<p '.$dep_cls.' '.$dep_attr.'><label>'.$field_settings['title'].'</label> ';
							echo "<input type='text' class='dtthemes_fws_option dt-color-field ".$field_key." medium' name='".$field_key."' id='".$field_key."'  />";
							echo '</p>';
							echo '<script type="text/javascript">
									jQuery(document).ready(function($){
										var color_val = jQuery(".dt_active_section .dt_fullwidthsection_data_settings .'.$field_key.'").html();
										jQuery("#'.$field_key.'").val( color_val );
										jQuery("#'.$field_key.'").wpColorPicker();
									});
								</script>';
							break;
							
					}
					
					if($i == $halfoptions) { echo '</div><div class="column dt-sc-one-half">'; }
					$i++;
					
				}
				
				if($separatecolumns == 'true') {
					echo '</div>';
				}
				
		echo '<span id="save_fullwidthoptions" class="dt_button save_fullwidthoptions">'.esc_html__('Save Changes', 'dt_themes').'</span>';
		echo '</form>';
	}
}


/**
 * A action hook and funtion to show modules in pop up panel
 */
add_action( 'wp_ajax_dttheme_show_modules_panel', 'dttheme_show_modules_panel' );
function dttheme_show_modules_panel(){

	if ( ! wp_verify_nonce( $_POST['dt_load_nonce'], 'dt_load_nonce' ) ) die(-1);

	$dt_hide_elements = $_POST['dt_hide_elements'];
	dt_generate_modules_panel($dt_hide_elements);
	
	die();
}

if ( ! function_exists('dt_generate_modules_panel') ){
	function dt_generate_modules_panel($dt_hide_elements){
		echo '<div class="dt_dialog_handle">' . esc_html__('Add Modules', 'dt_themes') . '</div><a href="#" id="dt_close_popup_modules"></a>';
		echo '<form id="dt_popup_modules" class="dt_settings_form">';
				echo '<div class="dt_search_modules">';
					echo '<input type="text" name="dt_search_field" id="dt_search_filed" placeholder="'.esc_html('Search Here', 'dt_themes').'" />';
				echo '</div>';
				echo '<div class="dt_popup_modules_group">';
					dt_get_modules_menu($dt_hide_elements);
				echo '</div>';
				echo '<div class="dt_popup_modules_items">';	
					dt_get_modules_list($dt_hide_elements);
				echo '</div>';
		echo '</form>';
	}
}


/**
 * A action hook and funtion to show custom css options
 */
add_action( 'wp_ajax_dttheme_show_customcss_panel', 'dttheme_show_customcss_panel' );
function dttheme_show_customcss_panel(){

	if ( ! wp_verify_nonce( $_POST['dt_load_nonce'], 'dt_load_nonce' ) ) die(-1);
	$dt_post_id = (int) $_POST['dt_post_id'];
	$dt_customcss_data = isset($_POST['dt_customcss_data']) ? $_POST['dt_customcss_data'] : '';
	if($dt_customcss_data == '') $dt_customcss_data = get_post_meta( $dt_post_id, '_dt_customcss_data', true );

	dt_generate_customcss_options( $dt_customcss_data );
	
	die();
}

if ( ! function_exists('dt_generate_customcss_options') ){
	function dt_generate_customcss_options( $cssdata ){

		echo '<div class="dt_dialog_handle">' . esc_html__('Add Custom CSS', 'dt_themes') . '</div><a href="#" id="dt_close_customcss_settings"></a>';
		echo '<form id="dt_customcss_settings">'
				. '<p><textarea cols="128" rows="10" name="dt_customcss_data" id="dt_customcss_data" class="text">'.$cssdata.'</textarea></p>'
			    . '<span id="save_customcss" class="dt_button save_customcss">'.esc_html__('Save Changes', 'dt_themes').'</span>';
		echo '</form>';
	}
}


/**
 * A action hook to save custom css data
 */
add_action( 'wp_ajax_dttheme_save_customcss_data', 'dttheme_save_customcss_data' );
function dttheme_save_customcss_data(){

	if ( ! wp_verify_nonce( $_POST['dt_load_nonce'], 'dt_load_nonce' ) ) die(-1);

	$dt_post_id = (int) $_POST['dt_post_id'];
	$dt_customcss_data = isset($_POST['dt_customcss_data']) ? $_POST['dt_customcss_data'] : '';
	update_post_meta( $dt_post_id, '_dt_customcss_data', $dt_customcss_data );
	
	die();
}


/**
 * A action hook to display custom css data in corresponding pages
 */
add_action('wp_head', 'dtthemes_add_customcss', 9);
function dtthemes_add_customcss() {
	
	if(get_post() != '') {
		$builder_enable = get_post_meta( get_the_ID(), '_dt_enable_builder', true );
		if($builder_enable == 1):
			$dt_post_id = get_the_ID();
			$output = get_post_meta( $dt_post_id, '_dt_customcss_data', true );;
	
			if (!empty($output)) :
				echo "\r".'<style type="text/css">'."\r".$output."\r".'</style>'."\r";
			endif;
		endif;
	}
	
}

function dtthemes_color_picker($name, $value) {
	global $wp_version;
	
	if (( float ) $wp_version >= 3.5) :
		echo "<input type='text' class='dtthemes_option color-field medium' name='{$name}' id='{$name}' value='{$value}' />";
	 else :
		echo "<input type='text' class='medium color_picker_element' name='{$name}' id='{$name}' value='{$value}' />";
		echo "<div class='color_picker'></div>";
	endif;
}


add_filter( 'wp_default_editor', 'dt_force_tmce_editor' );
function dt_force_tmce_editor( $editor_mode ) {
	return 'tinymce';
}

function dt_mb_unserialize($string) {
	$string = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $string);
	return unserialize($string);
}
?>