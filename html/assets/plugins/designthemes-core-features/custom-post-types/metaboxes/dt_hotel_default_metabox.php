<?php
global $post;
$hotel_settings = get_post_meta ( $post->ID, '_hotel_settings', TRUE );
$hotel_settings = is_array ( $hotel_settings ) ? $hotel_settings : array (); ?>

<!-- Additional Fields -->
<div class="custom-box meta-fields">
	<div class="column one-sixth">
        <label><?php _e('Address of Hotel','dt_themes');?></label>
    </div>
    <div class="column six-seventh" style="margin-bottom:20px;">
        <?php $v = array_key_exists("hotel_add",$hotel_settings) ?  $hotel_settings['hotel_add'] : '';?>
        <textarea id="place_add" name="_place_add" class="large" style="width:100%; margin-bottom:5px;" rows="3" placeholder="272 Boylston St, Boston, MA 02116"><?php echo $v;?></textarea>
        <div class="column one-seventh">
	        <input id="btngetmapval" type="button" class="button button-primary" value="<?php _e('Get Map Values','dt_themes'); ?>" />
		</div>
        <div class="column one-half">
        	<p class="note no-margin"> <?php _e("Put address and click button to get following values.",'dt_themes');?><br /><span style="color:#F00"><?php _e(' Note: It returns approximate value. Try ');?><a href="https://ctrlq.org/maps/address/" target="_blank"><?php echo esc_url_raw('https://ctrlq.org/maps/address/', 'dt_themes');?></a></span></p>
		</div>
        <div class="column one-third">
        	<p id="dt_ajax_res" class="note" style="color:#F00;"> </p>
        </div>
    </div>

    <div class="column one-sixth">
        <label><?php _e('Latitude','dt_themes');?></label>
    </div>
    <div class="column one-third">
        <?php $v = array_key_exists("hotel_lat",$hotel_settings) ?  $hotel_settings['hotel_lat'] : '';?>
        <input id="txtlat" name="_hotel_lat" class="large" type="text" value="<?php echo $v;?>" style="width:100%;" placeholder="42.353068" />
        <p class="note"> <?php _e("Put the location latitude value. ( Use finder: https://ctrlq.org/maps/address/ )",'dt_themes');?> </p>
    </div>

    <div class="column one-seventh">  
        <label><?php _e('Longitude','dt_themes');?></label>
    </div>
    <div class="column one-third">
        <?php $v = array_key_exists("hotel_long",$hotel_settings) ?  $hotel_settings['hotel_long'] : '';?>
        <input id="txtlong" name="_hotel_long" class="large" type="text" value="<?php echo $v;?>" style="width:100%;" placeholder="-71.0765188" />
        <p class="note"> <?php _e("Put the location latitude value. ( Use finder: https://ctrlq.org/maps/address/ )",'dt_themes');?> </p>
    </div>
</div>
<!-- Additional Fields End -->

<!-- 1. Layout -->
<div id="page-layout" class="custom-box">
    <div class="column one-sixth"><label><?php _e('Layout','dt_themes');?> </label></div>
    <div class="column five-sixth last">
        <ul class="bpanel-layout-set"><?php 
            $hotel_layout = array(
                'content-full-width'=>'without-sidebar',
                'with-left-sidebar'=>'left-sidebar',
                'with-right-sidebar'=>'right-sidebar',
                'with-both-sidebar'=>'both-sidebar');
            
                $v =  array_key_exists("layout",$hotel_settings) ?  $hotel_settings['layout'] : 'content-full-width';
            
            foreach($hotel_layout as $key => $value):
                $class = ($key == $v) ? " class='selected' " : "";
                echo "<li><a href='#' rel='{$key}' {$class}><img src='".IAMD_FW_URL."theme_options/images/columns/{$value}.png' /></a></li>";
            endforeach;?></ul>

         <input id="mytheme-page-layout" name="layout" type="hidden"  value="<?php echo $v;?>"/>
         <p class="note"> <?php _e("You can choose between a left, right or no sidebar layout.",'dt_themes');?> </p>
    </div>
</div> <!-- Layout End-->

<?php 
 $sb_layout = array_key_exists("layout",$hotel_settings) ? $hotel_settings['layout'] : 'content-full-width';
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
                $switchclass = array_key_exists("disable-everywhere-sidebar-left",$hotel_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                $checked = array_key_exists("disable-everywhere-sidebar-left",$hotel_settings) ? ' checked="checked"' : '';?>
                
                <div data-for="mytheme-disable-everywhere-sidebar-left" class="checkbox-switch <?php echo $switchclass;?>"></div>
                <input id="mytheme-disable-everywhere-sidebar-left" class="hidden" type="checkbox" name="disable-everywhere-sidebar-left" value="true"  <?php echo $checked;?>/>
                <p class="note"> <?php _e('Yes! to hide "Every Where Sidebar" on this page.','dt_themes');?> </p>
             </div>
        </div><!-- Every Where Sidebar Left End-->

        <!-- 3. Choose Widget Areas Start -->
        <div id="page-sidebars" class="sidebar-section custom-box page-widgetareas">
            <div class="column one-sixth"><label><?php _e('Choose Widget Area - Left Sidebar','dt_themes');?></label></div>
            <div class="column five-sixth last"><?php
                if( array_key_exists('widget-area-left', $hotel_settings)):
                    $widgetareas =  array_unique($hotel_settings["widget-area-left"]);
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
                $switchclass = array_key_exists("disable-everywhere-sidebar-right",$hotel_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                $checked = array_key_exists("disable-everywhere-sidebar-right",$hotel_settings) ? ' checked="checked"' : '';?>
                
                <div data-for="mytheme-disable-everywhere-sidebar-right" class="checkbox-switch <?php echo $switchclass;?>"></div>
                <input id="mytheme-disable-everywhere-sidebar-right" class="hidden" type="checkbox" name="disable-everywhere-sidebar-right" value="true"  <?php echo $checked;?>/>
                <p class="note"> <?php _e('Yes! to hide "Every Where Sidebar" on this page.','dt_themes');?> </p>
             </div>
        </div><!-- Every Where Sidebar Right End-->
        
        <!-- 3. Choose Widget Areas Start -->
        <div id="page-sidebars" class="sidebar-section custom-box page-widgetareas">
            <div class="column one-sixth"><label><?php _e('Choose Widget Area - Right Sidebar','dt_themes');?></label></div>
            <div class="column five-sixth last"><?php
                if( array_key_exists('widget-area-right', $hotel_settings)):
                    $widgetareas =  array_unique($hotel_settings["widget-area-right"]);
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

<!-- Starting Price & Special Offer -->
<div class="custom-box">
    <div class="column one-sixth">
        <label><?php _e('Starting Price','dt_themes');?></label>
    </div>
    <div class="column one-third">
        <?php $v = get_post_meta ( $post->ID, "starting_price",true);;?>
        <input id="txtsprice" name="_starting_price" class="large" type="text" value="<?php echo $v;?>" style="width:100%;" placeholder="199.99" />
        <p class="note"> <?php _e("Put the value of starting pricing.",'dt_themes');?> </p>
    </div>

    <div class="column one-seventh">  
        <label><?php _e('Special Offer','dt_themes');?></label>
    </div>
    <div class="column one-third">
        <?php $v = array_key_exists("offer_value",$hotel_settings) ?  $hotel_settings['offer_value'] : '';?>
        <input id="txtoffer" name="_offer_value" class="large" type="text" value="<?php echo $v;?>" style="width:100%;" placeholder="<?php _e('10% Special Offer', 'dt_themes'); ?>" />
        <p class="note"> <?php _e("Put the special offer value.",'dt_themes');?> </p>
    </div>
</div>
<!-- Starting Price & Special Offer Section End-->

<!-- For Whome & Book Now -->
<div class="custom-box">
    <div class="column one-sixth">
        <label><?php _e('For Whome','dt_themes');?></label>
    </div>
    <div class="column one-third">
        <?php $v = array_key_exists("specially_whome",$hotel_settings) ?  $hotel_settings['specially_whome'] : '';?>
        <input id="txtswhome" name="_specially_whome" class="large" type="text" value="<?php echo $v;?>" style="width:100%;" placeholder="<?php _e('Only For Families', 'dt_themes'); ?>" />
        <p class="note"> <?php _e("Put the text of specially for whome.",'dt_themes');?> </p>
    </div>

    <div class="column one-seventh">
		<label><?php _e('Show Book Now','dt_themes');?></label>
    </div>
	<div class="column one-third last"><?php
	
	$switchclass = array_key_exists ( "show-book-now", $hotel_settings ) ? 'checkbox-switch-on' : 'checkbox-switch-off';
	$checked = array_key_exists ( "show-book-now", $hotel_settings ) ? ' checked="checked"' : ''; ?>
    <div data-for="mytheme-book-now"
			class="dt-checkbox-switch <?php echo $switchclass;?>"></div>
		<input id="mytheme-book-now" class="hidden" type="checkbox"
			name="mytheme-book-now" value="true" <?php echo $checked;?> />
		<p class="note"> <?php _e('Would you like to show the book now section','dt_themes');?> </p>
	</div>
</div>
<!-- For Whome & Book Now Section End-->

<!-- Show Rating Section -->
<div class="custom-box">
	<div class="column one-sixth">
		<label><?php _e('Show Ratings','dt_themes');?></label>
	</div>
	<div class="column one-third"><?php
	
	$switchclass = array_key_exists ( "show-ratings", $hotel_settings ) ? 'checkbox-switch-on' : 'checkbox-switch-off';
	$checked = array_key_exists ( "show-ratings", $hotel_settings ) ? ' checked="checked"' : ''; ?>
    <div data-for="mytheme-ratings"
			class="dt-checkbox-switch <?php echo $switchclass;?>"></div>
		<input id="mytheme-ratings" class="hidden" type="checkbox"
			name="mytheme-ratings" value="true" <?php echo $checked;?> />
		<p class="note"> <?php _e('Would you like to show the rating section','dt_themes');?> </p>
	</div>

	<div class="column one-seventh">
		<label><?php _e('Show Reviews','dt_themes');?></label>
	</div>
	<div class="column one-third last"><?php
	
	$switchclass = array_key_exists ( "show-reviews", $hotel_settings ) ? 'checkbox-switch-on' : 'checkbox-switch-off';
	$checked = array_key_exists ( "show-reviews", $hotel_settings ) ? ' checked="checked"' : '';
	?><div data-for="mytheme-reviews"
			class="dt-checkbox-switch <?php echo $switchclass;?>"></div>
		<input id="mytheme-reviews" class="hidden" type="checkbox"
			name="mytheme-reviews" value="true" <?php echo $checked;?> />
		<p class="note"> <?php _e('Would you like to show the reviews section','dt_themes');?> </p>
	</div>
</div>
<!-- Show Reviews Section End-->

<div class="custom-box">
	<div class="column one-sixth">
		<label><?php _e('Choose Rooms','dt_themes');?></label>
	</div>
	<div class="column five-sixth last"><?php
    	  if(array_key_exists("room-types",$hotel_settings)):
             $room_list = array_unique($hotel_settings["room-types"]);
             foreach($room_list as $room):
                echo "<!-- Rooms Drop Down Container -->
                      <div class='multidropdown'>";
                echo  dt_theme_roomtype_list("hotel,room_list",$room,"multidropdown");
                echo "</div><!-- Rooms Drop Down Container end-->";
             endforeach;
          else:
            echo "<!-- Rooms Drop Down Container -->";
            echo "<div class='multidropdown'>";
            echo  dt_theme_roomtype_list("hotel,room_list","","multidropdown");
            echo "</div><!-- Rooms Drop Down Container end-->";
          endif; ?>
		<p class="note"> <?php _e('You can choose room under a hotel in the booking page.','dt_themes');?> </p>
	</div>
</div>

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
			if (array_key_exists ( "items", $hotel_settings )) {
				foreach ( $hotel_settings ["items_thumbnail"] as $key => $thumbnail ) {
					$item = $hotel_settings ['items'] [$key];
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
						$name = $hotel_settings ['items_name'] [$key];
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