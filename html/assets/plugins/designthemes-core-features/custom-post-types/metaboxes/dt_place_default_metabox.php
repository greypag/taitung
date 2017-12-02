<?php
global $post;
$place_settings = get_post_meta ( $post->ID, '_place_settings', TRUE );
$place_settings = is_array ( $place_settings ) ? $place_settings : array (); ?>

<!-- Additional Fields -->
<div class="custom-box meta-fields">
	<div class="column one-sixth">
        <label><?php _e('Address of Place','dt_themes');?></label>
    </div>
    <div class="column six-seventh" style="margin-bottom:20px;">
        <?php $v = array_key_exists("place_add",$place_settings) ?  $place_settings['place_add'] : '';?>
        <textarea id="place_add" name="_place_add" class="large" style="width:100%; margin-bottom:5px;" rows="3" placeholder="201 S. Division St., Ann Arbor, MI 48104"><?php echo $v;?></textarea>
        <div class="column one-seventh">
	        <input id="btngetmapval" type="button" class="button button-primary" value="<?php _e('Get Map Values', 'dt_themes');?>" />
		</div>
        <div class="column one-half">
        	<p class="note no-margin"> <?php _e("Put address and click button to get following values.",'dt_themes');?><br /><span style="color:#F00"><?php _e(' Note: It returns approximate value. Try ');?><a href="http://ctrlq.org/maps/address/" target="_blank"><?php echo esc_url_raw('https://ctrlq.org/maps/address/', 'dt_themes');?></a></span></p>
		</div>
        <div class="column one-third">
        	<p id="dt_ajax_res" class="note" style="color:#F00;"> </p>
        </div>
    </div>

    <div class="column one-sixth">
        <label><?php _e('Latitude','dt_themes');?></label>
    </div>
    <div class="column one-third">
        <?php $v = array_key_exists("place_lat",$place_settings) ?  $place_settings['place_lat'] : '';?>
        <input id="txtlat" name="_place_lat" class="large" type="text" value="<?php echo $v;?>" style="width:100%;" placeholder="42.2799011" />
        <p class="note"> <?php _e("Put the location latitude value. ( Use finder: https://ctrlq.org/maps/address/ )",'dt_themes');?> </p>
    </div>

    <div class="column one-seventh">  
        <label><?php _e('Longitude','dt_themes');?></label>
    </div>
    <div class="column one-third">
        <?php $v = array_key_exists("place_long",$place_settings) ?  $place_settings['place_long'] : '';?>
        <input id="txtlong" name="_place_long" class="large" type="text" value="<?php echo $v;?>" style="width:100%;" placeholder="-83.7438272" />
        <p class="note"> <?php _e("Put the location latitude value. ( Use finder: https://ctrlq.org/maps/address/ )",'dt_themes');?> </p>
    </div>
</div>
<!-- Additional Fields End -->

<!-- 1. Layout -->
<div id="page-layout" class="custom-box">
    <div class="column one-sixth"><label><?php _e('Layout','dt_themes');?> </label></div>
    <div class="column five-sixth last">
        <ul class="bpanel-layout-set"><?php 
            $place_layout = array(
                'content-full-width'=>'without-sidebar',
                'with-left-sidebar'=>'left-sidebar',
                'with-right-sidebar'=>'right-sidebar',
                'with-both-sidebar'=>'both-sidebar');
            
                $v =  array_key_exists("layout",$place_settings) ?  $place_settings['layout'] : 'content-full-width';
            
            foreach($place_layout as $key => $value):
                $class = ($key == $v) ? " class='selected' " : "";
                echo "<li><a href='#' rel='{$key}' {$class}><img src='".IAMD_FW_URL."theme_options/images/columns/{$value}.png' /></a></li>";
            endforeach;?></ul>

         <input id="mytheme-page-layout" name="layout" type="hidden"  value="<?php echo $v;?>"/>
         <p class="note"> <?php _e("You can choose between a left, right or no sidebar layout.",'dt_themes');?> </p>
    </div>
</div> <!-- Layout End-->

<?php 
 $sb_layout = array_key_exists("layout",$place_settings) ? $place_settings['layout'] : 'content-full-width';
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
                $switchclass = array_key_exists("disable-everywhere-sidebar-left",$place_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                $checked = array_key_exists("disable-everywhere-sidebar-left",$place_settings) ? ' checked="checked"' : '';?>
                
                <div data-for="mytheme-disable-everywhere-sidebar-left" class="checkbox-switch <?php echo $switchclass;?>"></div>
                <input id="mytheme-disable-everywhere-sidebar-left" class="hidden" type="checkbox" name="disable-everywhere-sidebar-left" value="true"  <?php echo $checked;?>/>
                <p class="note"> <?php _e('Yes! to hide "Every Where Sidebar" on this page.','dt_themes');?> </p>
             </div>
        </div><!-- Every Where Sidebar Left End-->

        <!-- 3. Choose Widget Areas Start -->
        <div id="page-sidebars" class="sidebar-section custom-box page-widgetareas">
            <div class="column one-sixth"><label><?php _e('Choose Widget Area - Left Sidebar','dt_themes');?></label></div>
            <div class="column five-sixth last"><?php
                if( array_key_exists('widget-area-left', $place_settings)):
                    $widgetareas =  array_unique($place_settings["widget-area-left"]);
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
                $switchclass = array_key_exists("disable-everywhere-sidebar-right",$place_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                $checked = array_key_exists("disable-everywhere-sidebar-right",$place_settings) ? ' checked="checked"' : '';?>
                
                <div data-for="mytheme-disable-everywhere-sidebar-right" class="checkbox-switch <?php echo $switchclass;?>"></div>
                <input id="mytheme-disable-everywhere-sidebar-right" class="hidden" type="checkbox" name="disable-everywhere-sidebar-right" value="true"  <?php echo $checked;?>/>
                <p class="note"> <?php _e('Yes! to hide "Every Where Sidebar" on this page.','dt_themes');?> </p>
             </div>
        </div><!-- Every Where Sidebar Right End-->
        
        <!-- 3. Choose Widget Areas Start -->
        <div id="page-sidebars" class="sidebar-section custom-box page-widgetareas">
            <div class="column one-sixth"><label><?php _e('Choose Widget Area - Right Sidebar','dt_themes');?></label></div>
            <div class="column five-sixth last"><?php
                if( array_key_exists('widget-area-right', $place_settings)):
                    $widgetareas =  array_unique($place_settings["widget-area-right"]);
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

<!-- Show Related Posts -->
<div class="custom-box">
	<div class="column one-sixth">
		<label><?php _e('Show Hotels & Dest','dt_themes');?></label>
	</div>
	<div class="column five-sixth last"><?php
	
	$switchclass = array_key_exists ( "show-hotels-list", $place_settings ) ? 'checkbox-switch-on' : 'checkbox-switch-off';
	$checked = array_key_exists ( "show-hotels-list", $place_settings ) ? ' checked="checked"' : '';
	?><div data-for="mytheme-hotels-list"
			class="dt-checkbox-switch <?php echo $switchclass;?>"></div>
		<input id="mytheme-hotels-list" class="hidden" type="checkbox"
			name="mytheme-hotels-list" value="true" <?php echo $checked;?> />
		<p class="note"> <?php _e('Would you like to show the hotels list & popular destinations','dt_themes');?> </p>
	</div>
</div>
<!-- Show Related Posts End-->

<!-- Hotels List Start -->
<div class="custom-box">
	<div class="column one-sixth">
		<label><?php _e('Choose Hotels','dt_themes');?></label>
	</div>
	<div class="column five-sixth last"><?php if(array_key_exists("place-hotels-list",$place_settings)):
             $hotels_list = array_unique($place_settings["place-hotels-list"]);
             foreach($hotels_list as $hotels):
                echo "<!-- Category Drop Down Container -->
                      <div class='multidropdown'>";
                echo  dt_theme_hotelslist("place,hotels_list",$hotels,"multidropdown");
                echo "</div><!-- Category Drop Down Container end-->";
             endforeach;
          else:
            echo "<!-- Category Drop Down Container -->";
            echo "<div class='multidropdown'>";
            echo  dt_theme_hotelslist("place,hotels_list","","multidropdown");
            echo "</div><!-- Category Drop Down Container end-->";
           endif;?>
		<p class="note"> <?php _e('You can choose hotels to show in this place page.','dt_themes');?> </p>
	</div>
</div>
<!-- Hotels List End-->

<!-- Destination List Start -->
<div class="custom-box">
	<div class="column one-sixth">
		<label><?php _e('Choose Destinations','dt_themes');?></label>
	</div>
	<div class="column five-sixth last"><?php if(array_key_exists("place-destinations-list",$place_settings)):
             $destinations_list = array_unique($place_settings["place-destinations-list"]);
             foreach($destinations_list as $destination):
                echo "<!-- Category Drop Down Container -->
                      <div class='multidropdown'>";
                echo  dt_theme_destinationslist("place,destinations_list",$destination,"multidropdown");
                echo "</div><!-- Category Drop Down Container end-->";		
             endforeach;
          else:
            echo "<!-- Category Drop Down Container -->";
            echo "<div class='multidropdown'>";
            echo  dt_theme_destinationslist("place,destinations_list","","multidropdown");
            echo "</div><!-- Category Drop Down Container end-->";
           endif;?>
		<p class="note"> <?php _e('You can choose destinations to show in this place page.','dt_themes');?> </p>
	</div>
</div>
<!-- Destination List End-->

<!-- Show Reviews Section -->
<div class="custom-box">
	<div class="column one-sixth">
		<label><?php _e('Show Reviews','dt_themes');?></label>
	</div>
	<div class="column five-sixth last"><?php
	
	$switchclass = array_key_exists ( "show-reviews", $place_settings ) ? 'checkbox-switch-on' : 'checkbox-switch-off';
	$checked = array_key_exists ( "show-reviews", $place_settings ) ? ' checked="checked"' : '';
	?><div data-for="mytheme-reviews"
			class="dt-checkbox-switch <?php echo $switchclass;?>"></div>
		<input id="mytheme-reviews" class="hidden" type="checkbox"
			name="mytheme-reviews" value="true" <?php echo $checked;?> />
		<p class="note"> <?php _e('Would you like to show the reviews & ratings','dt_themes');?> </p>
	</div>
</div>
<!-- Show Reviews Section End-->

<!-- Show Recommended Section -->
<div class="custom-box">
	<div class="column one-sixth">
		<label><?php _e('Show Recommends','dt_themes');?></label>
	</div>
	<div class="column five-sixth last"><?php
	
	$switchclass = array_key_exists ( "show-recommends", $place_settings ) ? 'checkbox-switch-on' : 'checkbox-switch-off';
	$checked = array_key_exists ( "show-recommends", $place_settings ) ? ' checked="checked"' : '';
	?><div data-for="mytheme-recommends"
			class="dt-checkbox-switch <?php echo $switchclass;?>"></div>
		<input id="mytheme-recommends" class="hidden" type="checkbox"
			name="mytheme-recommends" value="true" <?php echo $checked;?> />
		<p class="note"> <?php _e('Would you like to show the recommendations','dt_themes');?> </p>
	</div>
</div>
<!-- Show Recommended Section End-->

<!-- Medias -->
<div class="custom-box">
	<div class="column one-sixth">
		<label><?php _e('Images','dt_themes');?> </label>
	</div>
	<div class="column five-sixth last">
		<div class="dt-media-btns-container">
			<a href="#" class="dt-open-media button button-primary"><?php _e( 'Click Here to Add Images', 'dt_themes' );?> </a>
			<!--<a href="#" class="dt-add-video button button-primary"><?php //_e( 'Click Here to Add Video', 'dt_themes' );?> </a>-->
		</div>
		<div class="clear"></div>

		<div class="dt-media-container">
			<ul class="dt-items-holder"><?php
			if (array_key_exists ( "items", $place_settings )) {
				foreach ( $place_settings ["items_thumbnail"] as $key => $thumbnail ) {
					$item = $place_settings ['items'] [$key];
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
						$name = $place_settings ['items_name'] [$key];
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