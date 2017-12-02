<?php add_action("admin_init", "post_metabox");?>
<?php function post_metabox(){
			add_meta_box("post-template-meta-container", __('Post Options','iamd_text_domain'), "post_settings","post", "normal", "default");
            add_meta_box("post-format-meta-container",__('Post Format Options','iamd_text_domain'),"post_format_settings","post","normal","default");			
			add_action('save_post','post_meta_save');
	} 
	
	function post_settings($args){ 
		global $post; 
		$tpl_default_settings = get_post_meta($post->ID,'_dt_post_settings',TRUE);
		$tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();?>
        
        <div class="sub-title custom-box">
            <div class="column one-sixth"><?php _e( 'Title Background','iamd_text_domain');?></div>
            <div class="column five-sixth last">
                <div class="image-preview-container">
                    <?php $subtitlebg = array_key_exists ( "sub-title-bg", $tpl_default_settings ) ? $tpl_default_settings ['sub-title-bg'] : '';?>
                    <input name="sub-title-bg" type="text" class="uploadfield medium" readonly="readonly" value="<?php echo $subtitlebg;?>"/>
                    <input type="button" value="<?php _e('Upload','iamd_text_domain');?>" class="upload_image_button show_preview" />
                    <input type="button" value="<?php _e('Remove','iamd_text_domain');?>" class="upload_image_reset" />
                    <?php if( !empty($subtitlebg) ) dt_theme_adminpanel_image_preview($subtitlebg );?>
                    <p class="note"><?php _e("Upload an image for the sub title background",'iamd_text_domain');?></p>
                </div>                    
            </div>
        </div>

        <div class="sub-title custom-box">
            <div class="column one-sixth"></div>
            <div class="column five-sixth last">
                <div class="column one-third">
                    <label><?php _e('Background Repeat','iamd_text_domain');?></label>
                    <?php $bgrepeat =  array_key_exists ( "sub-title-bg-repeat", $tpl_default_settings ) ? $tpl_default_settings ['sub-title-bg-repeat'] : ''; ?>
                    <div class="clear"></div>
                    <select name="sub-title-bg-repeat">
                        <option value=""><?php _e("Select",'iamd_text_domain');?></option>
                        <?php foreach( array("repeat","repeat-x","repeat-y","no-repeat") as $option): ?>
                               <option value="<?php echo $option;?>" <?php selected($option,$bgrepeat);?>><?php echo $option;?></option>
                        <?php endforeach;?>
                    </select>
                    <p class="note"><?php _e("Select how would you like to repeat the background image ",'iamd_text_domain');?></p>
                </div>

                <div class="column one-third">
                    <label><?php _e('Background Position','iamd_text_domain');?></label>
                    <?php $bgposition =  array_key_exists ( "sub-title-bg-position", $tpl_default_settings ) ? $tpl_default_settings ['sub-title-bg-position'] : ''; ?>
                    <div class="clear"></div>
                    <select name="sub-title-bg-position">
                        <option value=""><?php _e("Select",'iamd_text_domain');?></option>
                        <?php foreach( array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right") as $option): ?>
                            <option value="<?php echo $option;?>" <?php selected($option,$bgposition);?>> <?php echo $option;?></option>
                        <?php endforeach;?>
                    </select>
                    <p class="note"><?php _e("Select how would you like to position the background",'iamd_text_domain');?></p>
                </div>

                <div class="column one-third last">
                <?php $label = 		__("Background Color",'iamd_text_domain');
                      $name  =		"sub-title-bg-color";
                      $value =  	array_key_exists ( "sub-title-bg-color", $tpl_default_settings ) ? $tpl_default_settings ['sub-title-bg-color'] : "#";
                      $tooltip = 	__("Select background color for sub title section e.g. #f2d607",'iamd_text_domain'); ?>
                      <label><?php echo $label;?></label>
                      <div class="clear"></div>
                      <?php dt_theme_admin_color_picker("",$name,$value,'');?>
                      <p class="note"><?php echo $tooltip;?></p>
                </div>
            </div>
        </div>
        <!-- 0. Sub title End-->
        
        <!-- Layout Start -->
        <div id="page-layout" class="custom-box">
			<div class="column one-sixth">                        
                <label><?php _e('Layout','iamd_text_domain');?> </label>
            </div>
			<div class="column five-sixth last">  
                <ul class="bpanel-layout-set">
                    <?php $homepage_layout = array(
                        'content-full-width'=>'without-sidebar',
                        'with-left-sidebar'=>'left-sidebar',
                        'with-right-sidebar'=>	'right-sidebar',
                        'with-both-sidebar'=>'both-sidebar');
                        $v =  array_key_exists("layout",$tpl_default_settings) ?  $tpl_default_settings['layout'] : 'content-full-width';
                        foreach($homepage_layout as $key => $value):
                            $class = ($key == $v) ? " class='selected' " : "";
                            echo "<li><a href='#' rel='{$key}' {$class}><img src='".IAMD_FW_URL."theme_options/images/columns/{$value}.png' /></a></li>";
                        endforeach;?>
                </ul>
                <?php $v = array_key_exists("layout",$tpl_default_settings) ? $tpl_default_settings['layout'] : 'content-full-width';?>
                <input id="mytheme-post-layout" name="layout" type="hidden"  value="<?php echo $v;?>"/>
                <p class="note"> <?php _e("You can choose between a left, right or no sidebar layout.",'iamd_text_domain');?> </p>
            </div>
        </div><!-- Layout End-->
    
		<?php 
         $sb_layout = array_key_exists("layout",$tpl_default_settings) ? $tpl_default_settings['layout'] : 'content-full-width';
         $sidebar_both = $sidebar_left = $sidebar_right = '';
         if($sb_layout == 'content-full-width') {
            $sidebar_both = 'style="display:none;"'; 
         } elseif($sb_layout == 'with-left-sidebar') {
            $sidebar_right = 'style="display:none;"'; 
         } elseif($sb_layout == 'with-right-sidebar') {
            $sidebar_left = 'style="display:none;"'; 
         } 
        ?>
        <div id="widget-area-options" <?php echo $sidebar_both;?>>
            
            <div id="left-sidebar-container" class="page-left-sidebar" <?php echo $sidebar_left; ?>>
                <!-- 2. Every Where Sidebar Left Start -->
                <div id="page-commom-sidebar" class="sidebar-section custom-box">
                    <div class="column one-sixth"><label><?php _e('Disable Every Where Sidebar Left','iamd_text_domain');?></label></div>
                    <div class="column five-sixth last"><?php 
                        $switchclass = array_key_exists("disable-everywhere-sidebar-left",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                        $checked = array_key_exists("disable-everywhere-sidebar-left",$tpl_default_settings) ? ' checked="checked"' : '';?>
                        
                        <div data-for="mytheme-disable-everywhere-sidebar-left" class="checkbox-switch <?php echo $switchclass;?>"></div>
                        <input id="mytheme-disable-everywhere-sidebar-left" class="hidden" type="checkbox" name="disable-everywhere-sidebar-left" value="true"  <?php echo $checked;?>/>
                        <p class="note"> <?php _e('Yes! to hide "Every Where Sidebar" on this page.','iamd_text_domain');?> </p>
                     </div>
                </div><!-- Every Where Sidebar Left End-->

                <!-- 3. Choose Widget Areas Start -->
                <div id="page-sidebars" class="sidebar-section custom-box page-widgetareas">
                    <div class="column one-sixth"><label><?php _e('Choose Widget Area - Left Sidebar','iamd_text_domain');?></label></div>
                    <div class="column five-sixth last"><?php
                        if( array_key_exists('widget-area-left', $tpl_default_settings)):
                            $widgetareas =  array_unique($tpl_default_settings["widget-area-left"]);
                            $widgetareas = array_filter($widgetareas);
                            foreach( $widgetareas as $widgetarea ){
                                echo '<div class="multidropdown">';
                                echo dt_theme_custom_widgetarea_list("widgetareas-left",$widgetarea,"multidropdown","left-sidebar");
                                echo '</div>';
                            }
                            echo '<div class="multidropdown">';
                                echo dt_theme_custom_widgetarea_list("widgetareas-left","","multidropdown","left-sidebar");
                            echo '</div>';                                
                        else:
                            echo '<div class="multidropdown">';
                               echo dt_theme_custom_widgetarea_list("widgetareas-left","","multidropdown","left-sidebar");
                            echo '</div>';                                
                        endif;?>
                    </div>
                </div><!-- Choose Widget Areas End -->
            </div>

            <div id="right-sidebar-container" class="page-right-sidebar" <?php echo $sidebar_right; ?>>
                <!-- 3. Every Where Sidebar Right Start -->
                <div id="page-commom-sidebar" class="sidebar-section custom-box page-right-sidebar">
                    <div class="column one-sixth"><label><?php _e('Disable Every Where Sidebar Right','iamd_text_domain');?></label></div>
                    <div class="column five-sixth last"><?php 
                        $switchclass = array_key_exists("disable-everywhere-sidebar-right",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                        $checked = array_key_exists("disable-everywhere-sidebar-right",$tpl_default_settings) ? ' checked="checked"' : '';?>
                        
                        <div data-for="mytheme-disable-everywhere-sidebar-right" class="checkbox-switch <?php echo $switchclass;?>"></div>
                        <input id="mytheme-disable-everywhere-sidebar-right" class="hidden" type="checkbox" name="disable-everywhere-sidebar-right" value="true"  <?php echo $checked;?>/>
                        <p class="note"> <?php _e('Yes! to hide "Every Where Sidebar" on this page.','iamd_text_domain');?> </p>
                     </div>
                </div><!-- Every Where Sidebar Right End-->
                
                <!-- 3. Choose Widget Areas Start -->
                <div id="page-sidebars" class="sidebar-section custom-box page-widgetareas">
                    <div class="column one-sixth"><label><?php _e('Choose Widget Area - Right Sidebar','iamd_text_domain');?></label></div>
                    <div class="column five-sixth last"><?php
                        if( array_key_exists('widget-area-right', $tpl_default_settings)):
                            $widgetareas =  array_unique($tpl_default_settings["widget-area-right"]);
                            $widgetareas = array_filter($widgetareas);
                            foreach( $widgetareas as $widgetarea ){
                                echo '<div class="multidropdown">';
                                echo dt_theme_custom_widgetarea_list("widgetareas-right",$widgetarea,"multidropdown","right-sidebar");
                                echo '</div>';
                            }
                            echo '<div class="multidropdown">';
                                echo dt_theme_custom_widgetarea_list("widgetareas-right","","multidropdown","right-sidebar");
                            echo '</div>';                                
                        else:
                            echo '<div class="multidropdown">';
                               echo dt_theme_custom_widgetarea_list("widgetareas-right","","multidropdown","right-sidebar");
                            echo '</div>';                                
                        endif;?>
                    </div>
                </div><!-- Choose Widget Areas End -->
            </div>

        </div>
        
        <!-- Comment Section Start -->
        <div class="custom-box">
			<div class="column one-sixth">                        
                <label><?php _e('Disable Comments','iamd_text_domain');?></label>
            </div>
			<div class="column five-sixth last">  
				<?php $switchclass = array_key_exists("disable-comment",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                      $checked = array_key_exists("disable-comment",$tpl_default_settings) ? ' checked="checked"' : '';?>
                <div data-for="mytheme-post-comment" class="checkbox-switch <?php echo $switchclass;?>"></div>
                <input id="mytheme-post-comment" class="hidden" type="checkbox" name="post-comment" value="true"  <?php echo $checked;?>/>
                <p class="note"> <?php _e('YES! to disable Comments.','iamd_text_domain');?> </p>
            </div>	
        </div><!-- Comment Section End-->

        <!-- Featured Image Section Start -->
        <div class="custom-box">
			<div class="column one-sixth">                        
        	    <label><?php _e('Disable Featured Image','iamd_text_domain');?></label>
            </div>
			<div class="column five-sixth last">  
				<?php $switchclass = array_key_exists("disable-featured-image",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                      $checked = array_key_exists("disable-featured-image",$tpl_default_settings) ? ' checked="checked"' : '';?>
                <div data-for="mytheme-post-featured-image" class="checkbox-switch <?php echo $switchclass;?>"></div>
                <input id="mytheme-post-featured-image" class="hidden" type="checkbox" name="post-featured-image" value="true"  <?php echo $checked;?>/>
                <p class="note"> <?php _e('YES! to disable featured image','iamd_text_domain');?> </p>
            </div>
        </div><!-- Featured Image Section End-->
        
        <!-- Post Meta-->
        <div class="custom-box">
            <h3><?php _e('Post Meta Options','iamd_text_domain');?></h3>
            <?php $post_meta = array(array(
                    "id"=>		"disable-author-info",
                    "label"=>	__("Disable the Author info.",'iamd_text_domain'),
                    "tooltip"=>	__("By default the author info will display when viewing your posts. You can choose to disable it here.",'iamd_text_domain')
                ), array(
                    "id"=>		"disable-date-info",
                    "label"=>	__("Disable the date info.",'iamd_text_domain'),
                    "tooltip"=>	__("By default the date info will display when viewing your posts. You can choose to disable it here.",'iamd_text_domain')
                ),
                array(
                    "id"=>		"disable-comment-info",
                    "label"=>	__("Disable the comment info.",'iamd_text_domain'),
                    "tooltip"=>	__("By default the comment info will display when viewing your posts. You can choose to disable it here.",'iamd_text_domain')
                ),
                array(
                    "id"=>		"disable-category-info",
                    "label"=>	__("Disable the category info.",'iamd_text_domain'),
                    "tooltip"=>	__("By default the category info will display when viewing your posts. You can choose to disable it here.",'iamd_text_domain')
                ),
                array(
                    "id"=>		"disable-tag-info",
                    "label"=>	__("Disable the tag info.",'iamd_text_domain'),
                    "tooltip"=>	__("By default the tag info will display when viewing your posts. You can choose to disable it here.",'iamd_text_domain')
                ));
            $count = 1;
            foreach($post_meta as $p_meta):
                $last = ($count%3 == 0)?"last":'';
                $id = 		$p_meta['id'];
                $label =	$p_meta['label'];
                $tooltip =  $p_meta['tooltip'];
                $v =  array_key_exists($id,$tpl_default_settings) ?  $tpl_default_settings[$id] : '';
                $rs =		checked($id,$v,false);
                $switchclass = ($v<>'') ? 'checkbox-switch-on' :'checkbox-switch-off';
                
                echo "<div class='one-third-content {$last}'>";
                echo '<div class="bpanel-option-set">';
                echo "<label>{$label}</label>";							
                echo "<div data-for='{$id}' class='checkbox-switch {$switchclass}'></div>";
                echo "<input class='hidden' id='{$id}' type='checkbox' name='{$id}' value='{$id}' {$rs} />";
				echo '<p class="note">';
				echo ($tooltip);
				echo '</p>';
                echo '</div>';
                echo '</div>';
                
            $count++;	
            endforeach;?>
        </div><!-- Post Meta End--><?php
		
		wp_reset_postdata();
    }
	
    function post_format_settings( $args ) {
        global $post; 
        $tpl_default_settings = get_post_meta($post->ID,'_dt_post_settings',TRUE);
        $tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array(); ?>

        <div id="dt-post-format-gallery">
            <div class="custom-box">
                <div class="column one-sixth"><label><?php _e('Image Gallery','iamd_text_domain');?> </label></div>
                <div class="column five-sixth last">
                    <div class="dt-media-btns-container">
                        <a href="#" class="dt-open-media-for-gallery-post button button-primary">
                            <?php _e( 'Click Here to Add Images', 'iamd_text_domain' );?> </a>
                    </div>
                    <div class="clear"></div>
                    <div class="dt-media-container">
                        <ul class="dt-items-holder"><?php
                            if ( array_key_exists("items",  $tpl_default_settings)) {
                                foreach ( $tpl_default_settings["items_thumbnail"] as $key => $thumbnail ) {
                                    $item = $tpl_default_settings ['items'] [$key];
                                    $out = "";
                                    $name = "";
                                    $foramts = array ('jpg','jpeg','png','gif');
                                    $parts = explode ( '.', $item );
                                    $ext = strtolower ( $parts [count ( $parts ) - 1] );

                                    $out .= "<li>";
                                    if (in_array ( $ext, $foramts )) {
                                        $name = $tpl_default_settings ['items_name'] [$key];
                                    
                                        $out .= "<img src='{$thumbnail}' alt='' />";
                                        $out .= "<span class='dt-image-name'>{$name}</span>";
                                        $out .= "<input type='hidden' name='items[]' value='{$item}' />";
                                    }
                                    $out .= "<input class='dt-image-name' type='hidden' name='items_name[]' value='{$name}' />";
                                    $out .= "<input type='hidden' name='items_thumbnail[]' value='{$thumbnail}' />";
                                    $out .= "<span class='my_delete'></span>";
                                    $out .= "</li>";
                                    echo $out;
                                }
                            }
                        ?></ul>
                    </div>    
                </div>
            </div> 
        </div>

        <div id="dt-post-format-video-audio">
            <div class="custom-box">
                <div class="column one-sixth"><label><?php _e('oEmbed URL','iamd_text_domain');?> </label></div>
                <div class="column five-sixth last">
                    <?php $oembed_url = array_key_exists("oembed-url", $tpl_default_settings) ? $tpl_default_settings['oembed-url'] : "";?>
                    <input type="text" name="oembed-url" value="<?php echo $oembed_url;?>" class="widefat"/>
                    <p class="note"><?php _e("Enter a URL that is compatible with WP's built-in oEmbed feature. This setting is used for your video and audio post formats.",'iamd_text_domain');?></p>
                </div>
            </div>

            <div class="custom-box">
                <div class="column one-sixth"><label><?php _e('Self Hosted URL','iamd_text_domain');?> </label></div>
                <div class="column five-sixth last">
                    <?php $self_hosted_url = array_key_exists("self-hosted-url", $tpl_default_settings) ? $tpl_default_settings['self-hosted-url'] : ""; ?>
                    <input type="text" name="self-hosted-url" value="<?php echo $self_hosted_url;?>" class="widefat"/>
                    <p class="note"><?php _e("Insert your self hosted video or audio url here.",'iamd_text_domain');?></p>                    
                </div>
            </div>            
        </div><?php        
    }
	
	function post_meta_save($post_id){

		if( key_exists ( '_inline_edit',$_POST )) :
			if ( wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce')) return;
		endif;

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	 
	 	if (!current_user_can('edit_post', $post_id)) :
			return;
		endif;

		if ( (key_exists('post_type', $_POST)) && ('post' == $_POST['post_type']) ) :

			$settings = array();
			$settings['layout'] = isset($_POST['layout']) ? $_POST['layout'] : "";
			$settings['disable-comment'] = isset( $_POST['post-comment'] ) ? $_POST['post-comment'] : "";
	
			if($_POST['layout'] == 'with-both-sidebar') {
				$settings['disable-everywhere-sidebar-left'] = $_POST['disable-everywhere-sidebar-left'];
				$settings['disable-everywhere-sidebar-right'] = $_POST['disable-everywhere-sidebar-right'];
				$settings['widget-area-left'] =  array_unique(array_filter($_POST['mytheme']['widgetareas-left']));
				$settings['widget-area-right'] =  array_unique(array_filter($_POST['mytheme']['widgetareas-right']));
			} elseif($_POST['layout'] == 'with-left-sidebar') {
				$settings['disable-everywhere-sidebar-left'] = $_POST['disable-everywhere-sidebar-left'];
				$settings['widget-area-left'] =  array_unique(array_filter($_POST['mytheme']['widgetareas-left']));
			} elseif($_POST['layout'] == 'with-right-sidebar') {
				$settings['disable-everywhere-sidebar-right'] = $_POST['disable-everywhere-sidebar-right'];
				$settings['widget-area-right'] =  array_unique(array_filter($_POST['mytheme']['widgetareas-right']));
			}
			
			$settings['sub-title-bg'] = isset($_POST['sub-title-bg']) ? $_POST['sub-title-bg'] : "";
			$settings['sub-title-bg-repeat'] = isset($_POST['sub-title-bg-repeat']) ? $_POST['sub-title-bg-repeat'] : "";
			$settings['sub-title-bg-position'] = isset($_POST['sub-title-bg-position']) ? $_POST['sub-title-bg-position'] : "";
			$settings['sub-title-bg-color'] = isset($_POST['sub-title-bg-color']) ? $_POST['sub-title-bg-color'] : "";
			
			$settings['disable-featured-image'] = isset($_POST['post-featured-image']) ? $_POST['post-featured-image'] : "";
			$settings['disable-author-info']	= isset($_POST['disable-author-info']) ? $_POST['disable-author-info'] : "";
			$settings['disable-date-info']	= isset($_POST['disable-date-info']) ? $_POST['disable-date-info'] : "";
			$settings['disable-comment-info']	= isset($_POST['disable-comment-info']) ? $_POST['disable-comment-info'] : "";
			$settings['disable-category-info']	= isset($_POST['disable-category-info'])?$_POST['disable-category-info']: "";
			$settings['disable-tag-info']	= isset($_POST['disable-tag-info']) ? $_POST['disable-tag-info'] : "";

			#For Gallery Post Format
			if( $_POST['post_format'] === "gallery") {
				$settings ['items'] = isset ( $_POST ['items'] ) ? $_POST ['items'] : "";
				$settings ['items_thumbnail'] = isset ( $_POST ['items_thumbnail'] ) ? $_POST ['items_thumbnail'] : "";
				$settings ['items_name'] = isset ( $_POST ['items_name'] ) ? $_POST ['items_name'] : "";
	
			} elseif( $_POST['post_format'] === "video" || $_POST['post_format'] === "audio" ) {
				$settings['oembed-url'] = isset( $_POST['oembed-url'] ) ? $_POST['oembed-url'] : "";
				$settings['self-hosted-url'] = isset( $_POST['self-hosted-url'] ) ? $_POST['self-hosted-url'] : "";
			}

			update_post_meta($post_id, "_dt_post_settings", array_filter($settings));
		endif;
	}?>