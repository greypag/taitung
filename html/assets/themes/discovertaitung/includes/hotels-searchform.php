<?php $smodule = dt_theme_option("smodule"); global $dt_allowed_html_tags; ?>
<div class="search-container type2">
    <div class="dt-sc-tabs-container">
        <ul class="dt-sc-tabs-frame"><?php
        	if(!array_key_exists("disable-hotels-tab", $smodule )): ?>
	            <li><a href="#"><?php echo !empty($smodule['hotel-title']) ? wp_kses($smodule['hotel-title'], $dt_allowed_html_tags) : __('Hotels', 'iamd_text_domain'); ?></a></li><?php
            endif;
			if(!array_key_exists("disable-packages-tab", $smodule )): ?>
				<li><a href="#"><?php echo !empty($smodule['packages-title']) ? wp_kses($smodule['packages-title'], $dt_allowed_html_tags) : __('Packages', 'iamd_text_domain'); ?></a></li><?php
            endif;
			if(!array_key_exists("disable-places-tab", $smodule )): ?>
				<li><a href="#"><?php echo !empty($smodule['places-title']) ? wp_kses($smodule['places-title'], $dt_allowed_html_tags) : __('Places', 'iamd_text_domain'); ?></a></li><?php
            endif; ?>
        </ul>

		<?php if(!array_key_exists("disable-hotels-tab", $smodule )): ?>
            <div class="dt-sc-tabs-frame-content"><?php
                //Hotels Search Module...
                $action = dt_theme_page_permalink_by_its_template('tpl-hotels-search.php'); ?>
                <form name="frmhotelsearch" action="<?php echo esc_url($action); ?>" method="post"><?php
    
                    if(array_key_exists("enable-title-module-for-hotels", $smodule )): ?>
                        <p><input type="text" name="txthotelname" placeholder="<?php _e('Type Hotel name here...', 'iamd_text_domain'); ?>" /></p><?php
                    endif;
                    
                    if(array_key_exists("enable-location-for-hotels", $smodule )): ?>
                        <p><select name="cmbcity">
                            <option value=""><?php _e('Choose City', 'iamd_text_domain'); ?></option><?php
                            $hotel_locations = get_categories("taxonomy=hotel_locations&hide_empty=1");
                            foreach ( $hotel_locations as $hotel_location ) {
                                $id = esc_attr( $hotel_location->slug );
                                $title = esc_html( $hotel_location->name );
                                $selected = "";
                                echo  "<option value='{$id}' {$selected} >{$title}</option>";
                            } ?>
                        </select></p><?php
                    endif;
                    
                    if(array_key_exists("enable-type-module-for-hotels", $smodule )): ?>
                        <p><select name="cmbcat">
                            <option value=""><?php _e('Choose Category', 'iamd_text_domain'); ?></option><?php
                            $hotel_types = get_categories("taxonomy=hotel_entries&hide_empty=1");
                            foreach ( $hotel_types as $hotel_type ) {
                                $id = esc_attr( $hotel_type->slug );
                                $title = esc_html( $hotel_type->name );
                                $selected = "";
                                echo  "<option value='{$id}' {$selected} >{$title}</option>";
                            } ?>
                        </select></p><?php
                    endif;
                    
                    if(array_key_exists("enable-min-price-for-hotels", $smodule )): ?>
                        <p class="select-price"><select name="cmbminprice">
                            <option value=""><?php _e('Min Price', 'iamd_text_domain'); ?></option><?php
                                $min_prices = array_key_exists("min-price-for-hotels", $smodule) ? wp_kses($smodule["min-price-for-hotels"], $dt_allowed_html_tags) : array();
                                $min_prices = array_filter($min_prices);
                                $min_prices = array_unique($min_prices);
                                foreach ( $min_prices as $min_price ) {
                                    $selected = "";
                                    echo  "<option value='{$min_price}' {$selected} >{$min_price}</option>";
                                } ?>
                        </select></p><?php
                    endif;
                    
                    if(array_key_exists("enable-max-price-for-hotels", $smodule )): ?>
                        <p class="select-price price-last"><select name="cmbmaxprice">
                            <option value=""><?php _e('Max Price', 'iamd_text_domain'); ?></option><?php
                                $max_prices = array_key_exists("max-price-for-hotels", $smodule) ? wp_kses($smodule["max-price-for-hotels"], $dt_allowed_html_tags) : array();
                                $max_prices = array_filter($max_prices);
                                $max_prices = array_unique($max_prices);
                                foreach ( $max_prices as $max_price ) {
                                    $selected = "";
                                    echo  "<option value='{$max_price}' {$selected} >{$max_price}</option>";
                                } ?>
                        </select></p><?php
                    endif;
                    
                    if(array_key_exists("enable-offer-for-hotels", $smodule )): ?>
                        <p><select name="cmboffers">
                            <option value=""><?php _e('Choose Offer', 'iamd_text_domain'); ?></option><?php
                                $offers = array_key_exists("offer-for-hotels", $smodule) ? wp_kses($smodule["offer-for-hotels"], $dt_allowed_html_tags) : array();
                                $offers = array_filter($offers);
                                $offers = array_unique($offers);
                                foreach ( $offers as $offer ) {
                                    $selected = "";
                                    echo  "<option value='{$offer}' {$selected} >{$offer}</option>";
                                } ?>
                        </select></p><?php
                    endif; ?>
                    <input name="subsearch" type="submit" value="<?php echo !empty($smodule['hotel-title']) ? esc_attr($smodule['hotel-title']) : __('Find Hotels', 'iamd_text_domain'); ?>" />
                </form>
            </div><?php
		endif;
		if(!array_key_exists("disable-packages-tab", $smodule )): ?>
            <div class="dt-sc-tabs-frame-content"><?php
                //Packages Search Module...
                $action = dt_theme_page_permalink_by_its_template('tpl-packages-search.php'); ?>
                <form name="frmpackagesearch" action="<?php echo esc_url($action); ?>" method="post"><?php
    
                    if(array_key_exists("enable-title-module-for-packages", $smodule )): ?>
                        <p><input type="text" name="txtpackagename" placeholder="<?php _e('Type Package name here...', 'iamd_text_domain'); ?>" /></p><?php
                    endif;
                    
                    if(array_key_exists("enable-location-for-packages", $smodule )): ?>
                        <p><select name="cmbcity">
                            <option value=""><?php _e('Choose City', 'iamd_text_domain'); ?></option><?php
                            $package_cities = array_key_exists("location-for-packages", $smodule) ? wp_kses($smodule["location-for-packages"], $dt_allowed_html_tags) : array();
                            $package_cities = array_filter($package_cities);
                            $package_cities = array_unique($package_cities);
                            foreach ( $package_cities as $package_city ) {
                                $selected = "";
                                echo  "<option value='{$package_city}' {$selected} >{$package_city}</option>";
                            } ?>
                        </select></p><?php
                    endif;
                    
                    if(array_key_exists("enable-type-module-for-packages", $smodule )): ?>
                        <p><select name="cmbcat">
                            <option value=""><?php _e('Choose Category', 'iamd_text_domain'); ?></option><?php
                            $package_types = get_categories("taxonomy=product_cat&hide_empty=1");
                            foreach ( $package_types as $package_type ) {
                                $id = esc_attr( $package_type->slug );
                                $title = esc_html( $package_type->name );
                                $selected = "";
                                echo  "<option value='{$id}' {$selected} >{$title}</option>";
                            } ?>
                        </select></p><?php
                    endif;
                    
                    if(array_key_exists("enable-min-price-for-packages", $smodule )): ?>
                        <p class="select-price"><select name="cmbminprice">
                            <option value=""><?php _e('Min Price', 'iamd_text_domain'); ?></option><?php
                                $min_prices = array_key_exists("min-price-for-packages", $smodule) ? wp_kses($smodule["min-price-for-packages"], $dt_allowed_html_tags) : array();
                                $min_prices = array_filter($min_prices);
                                $min_prices = array_unique($min_prices);
                                foreach ( $min_prices as $min_price ) {
                                    $selected = "";
                                    echo  "<option value='{$min_price}' {$selected} >{$min_price}</option>";
                                } ?>
                        </select></p><?php
                    endif;
                    
                    if(array_key_exists("enable-max-price-for-packages", $smodule )): ?>
                        <p class="select-price price-last"><select name="cmbmaxprice">
                            <option value=""><?php _e('Max Price', 'iamd_text_domain'); ?></option><?php
                                $max_prices = array_key_exists("max-price-for-packages", $smodule) ? wp_kses($smodule["max-price-for-packages"], $dt_allowed_html_tags) : array();
                                $max_prices = array_filter($max_prices);
                                $max_prices = array_unique($max_prices);
                                foreach ( $max_prices as $max_price ) {
                                    $selected = "";
                                    echo  "<option value='{$max_price}' {$selected} >{$max_price}</option>";
                                } ?>
                        </select></p><?php
                    endif;
                    
                    if(array_key_exists("enable-persons-for-packages", $smodule )): ?>
                        <p><select name="cmbpersons">
                            <option value=""><?php _e('Choose No.of Persons', 'iamd_text_domain'); ?></option><?php
                                $persons = array_key_exists("persons-for-packages", $smodule) ? wp_kses($smodule["persons-for-packages"], $dt_allowed_html_tags) : array();
                                $persons = array_filter($persons);
                                $persons = array_unique($persons);
                                foreach ( $persons as $person ) {
                                    $selected = "";
                                    echo  "<option value='{$person}' {$selected} >{$person}</option>";
                                } ?>
                        </select></p><?php
                    endif; ?>
                    <input name="subsearch" type="submit" value="<?php echo !empty($smodule['packages-title']) ? esc_attr($smodule['packages-title']) : __('Find Packages', 'iamd_text_domain'); ?>" />
                </form>
            </div><?php
		endif;
		if(!array_key_exists("disable-places-tab", $smodule )): ?>			
            <div class="dt-sc-tabs-frame-content"><?php
                //Places Search Module...
                $action = dt_theme_page_permalink_by_its_template('tpl-places-search.php'); ?>
                <form name="frmplacesearch" action="<?php echo esc_url($action); ?>" method="post"><?php
    
                    if(array_key_exists("enable-title-module-for-places", $smodule )): ?>
                        <p><input type="text" name="txtplacename" placeholder="<?php _e('Type Place name here...', 'iamd_text_domain'); ?>" /></p><?php
                    endif;
                    
                    if(array_key_exists("enable-location-for-places", $smodule )): ?>
                        <p><select name="cmbcity">
                            <option value=""><?php _e('Choose City', 'iamd_text_domain'); ?></option><?php
                            $places_cities = array_key_exists("location-for-places", $smodule) ? wp_kses($smodule["location-for-places"], $dt_allowed_html_tags) : array();
                            $places_cities = array_filter($places_cities);
                            $places_cities = array_unique($places_cities);
                            foreach ( $places_cities as $place_city ) {
                                $selected = "";
                                echo  "<option value='{$place_city}' {$selected} >{$place_city}</option>";
                            } ?>
                        </select></p><?php
                    endif;
                    
                    if(array_key_exists("enable-type-module-for-places", $smodule )): ?>
                        <p><select name="cmbcat">
                            <option value=""><?php _e('Choose Category', 'iamd_text_domain'); ?></option><?php
                            $place_types = get_categories("taxonomy=place_entries&hide_empty=1");
                            foreach ( $place_types as $place_type ) {
                                $id = esc_attr( $place_type->slug );
                                $title = esc_html( $place_type->name );
                                $selected = "";
                                echo  "<option value='{$id}' {$selected} >{$title}</option>";
                            } ?>
                        </select></p><?php
                    endif; ?>
                    <input name="subsearch" type="submit" value="<?php echo !empty($smodule['places-title']) ? esc_attr($smodule['places-title']) : __('Find Places', 'iamd_text_domain'); ?>" />
                </form>
            </div><?php
		endif; ?>	
    </div>
</div>