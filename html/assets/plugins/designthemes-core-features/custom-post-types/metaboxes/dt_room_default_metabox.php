<?php
global $post;
$room_settings = get_post_meta ( $post->ID, '_room_settings', TRUE );
$room_settings = is_array ( $room_settings ) ? $room_settings : array (); ?>

<!-- 1. Layout -->
<div id="page-layout" class="custom-box">
    <div class="column one-sixth"><label><?php _e('Layout','dt_themes');?> </label></div>
    <div class="column five-sixth last">
        <ul class="bpanel-layout-set"><?php 
            $room_layout = array(
                'content-full-width'=>'without-sidebar',
                'with-left-sidebar'=>'left-sidebar',
                'with-right-sidebar'=>'right-sidebar',
                'with-both-sidebar'=>'both-sidebar');
            
                $v =  array_key_exists("layout",$room_settings) ?  $room_settings['layout'] : 'content-full-width';
            
            foreach($room_layout as $key => $value):
                $class = ($key == $v) ? " class='selected' " : "";
                echo "<li><a href='#' rel='{$key}' {$class}><img src='".IAMD_FW_URL."theme_options/images/columns/{$value}.png' /></a></li>";
            endforeach;?></ul>

         <input id="mytheme-page-layout" name="layout" type="hidden"  value="<?php echo $v;?>"/>
         <p class="note"> <?php _e("You can choose between a left, right or no sidebar layout.",'dt_themes');?> </p>
    </div>
</div> <!-- Layout End-->

<?php 
 $sb_layout = array_key_exists("layout",$room_settings) ? $room_settings['layout'] : 'content-full-width';
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
            <div class="column one-sixth"><label><?php _e('Disable Every Where Sidebar Left','dt_themes');?></label></div>
            <div class="column five-sixth last"><?php 
                $switchclass = array_key_exists("disable-everywhere-sidebar-left",$room_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                $checked = array_key_exists("disable-everywhere-sidebar-left",$room_settings) ? ' checked="checked"' : '';?>
                
                <div data-for="mytheme-disable-everywhere-sidebar-left" class="checkbox-switch <?php echo $switchclass;?>"></div>
                <input id="mytheme-disable-everywhere-sidebar-left" class="hidden" type="checkbox" name="disable-everywhere-sidebar-left" value="true"  <?php echo $checked;?>/>
                <p class="note"> <?php _e('Yes! to hide "Every Where Sidebar" on this page.','dt_themes');?> </p>
             </div>
        </div><!-- Every Where Sidebar Left End-->

        <!-- 3. Choose Widget Areas Start -->
        <div id="page-sidebars" class="sidebar-section custom-box page-widgetareas">
            <div class="column one-sixth"><label><?php _e('Choose Widget Area - Left Sidebar','dt_themes');?></label></div>
            <div class="column five-sixth last"><?php
                if( array_key_exists('widget-area-left', $room_settings)):
                    $widgetareas =  array_unique($room_settings["widget-area-left"]);
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
            <div class="column one-sixth"><label><?php _e('Disable Every Where Sidebar Right','dt_themes');?></label></div>
            <div class="column five-sixth last"><?php 
                $switchclass = array_key_exists("disable-everywhere-sidebar-right",$room_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                $checked = array_key_exists("disable-everywhere-sidebar-right",$room_settings) ? ' checked="checked"' : '';?>
                
                <div data-for="mytheme-disable-everywhere-sidebar-right" class="checkbox-switch <?php echo $switchclass;?>"></div>
                <input id="mytheme-disable-everywhere-sidebar-right" class="hidden" type="checkbox" name="disable-everywhere-sidebar-right" value="true"  <?php echo $checked;?>/>
                <p class="note"> <?php _e('Yes! to hide "Every Where Sidebar" on this page.','dt_themes');?> </p>
             </div>
        </div><!-- Every Where Sidebar Right End-->
        
        <!-- 3. Choose Widget Areas Start -->
        <div id="page-sidebars" class="sidebar-section custom-box page-widgetareas">
            <div class="column one-sixth"><label><?php _e('Choose Widget Area - Right Sidebar','dt_themes');?></label></div>
            <div class="column five-sixth last"><?php
                if( array_key_exists('widget-area-right', $room_settings)):
                    $widgetareas =  array_unique($room_settings["widget-area-right"]);
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

<!-- Additional Fields -->
<div class="custom-box meta-fields">
    <div class="column one-sixth">
        <label for="room_occupancy"><?php _e('Occupancy','dt_themes');?></label>
    </div>
    <div class="column one-fourth">
        <?php $v = array_key_exists("room_occupancy",$room_settings) ?  $room_settings['room_occupancy'] : '';?>
        <input id="room_occupancy" name="_room_occupancy" class="large" type="text" value="<?php echo $v;?>" placeholder="5 <?php _e('Person(s)', 'dt_themes'); ?>" />
		<p class="note"> <?php _e("Put no.of persons occupancy for this room.",'dt_themes');?> </p>
    </div>

    <div class="column one-eigth">  
        <label for="room_price"><?php _e('Price','dt_themes');?>&nbsp;(<?php echo dt_theme_currecy_symbol(); ?>)</label>
    </div>
    <div class="column one-seventh">
        <?php $v = array_key_exists("room_price",$room_settings) ?  $room_settings['room_price'] : '';?>
        <input id="room_price" name="_room_price" class="large" type="text" value="<?php echo $v;?>" placeholder="199.9" />
        <p class="note"> <?php _e("Put price of this room.",'dt_themes');?> </p>
    </div>
    
    <div class="column one-eigth">  
        <label for="room_size"><?php _e('Room Size','dt_themes');?></label>
    </div>
    <div class="column one-fifth">
        <?php $v = array_key_exists("room_size",$room_settings) ?  $room_settings['room_size'] : '';?>
        <input id="room_size" name="_room_size" class="large" type="text" value="<?php echo $v;?>" placeholder="28-38sqm / 325-375sqf" style="width:100%;" />
        <p class="note"> <?php _e("Put size of this room.",'dt_themes');?> </p>
    </div>
</div><!-- Additional Fields End -->

<!-- Medias -->
<div class="custom-box">
	<div class="column one-sixth">
		<label><?php _e('Images','dt_themes');?> </label>
	</div>
	<div class="column five-sixth last">
		<div class="dt-media-btns-container">
			<a href="#" class="dt-open-media button button-primary"><?php _e( 'Click Here to Add Images', 'dt_themes' );?> </a>
		</div>
		<div class="clear"></div>

		<div class="dt-media-container">
			<ul class="dt-items-holder"><?php
			if (array_key_exists ( "items", $room_settings )) {
				foreach ( $room_settings ["items_thumbnail"] as $key => $thumbnail ) {
					$item = $room_settings ['items'] [$key];
					$out = "";
					$name = "";
					$foramts = array (
							'jpg',
							'jpeg',
							'gif',
							'png' 
					);
					$parts = explode ( '.', $item );
					$ext = strtolower ( $parts [count ( $parts ) - 1] );
					if (in_array ( $ext, $foramts )) {
						$name = $room_settings ['items_name'] [$key];
						$out .= "<li>";
						$out .= "<img src='{$thumbnail}' alt='' />";
						$out .= "<span class='dt-image-name'>{$name}</span>";
						$out .= "<input type='hidden' name='items[]' value='{$item}' />";
					} else {
						$name = "video";
						$out .= "<li>";
						$out .= "<span class='dt-video'></span>";
						$out .= "<input type='text' name='items[]' value='{$item}' />";
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
<!-- Medias End -->