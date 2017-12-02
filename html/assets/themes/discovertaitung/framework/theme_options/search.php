<!-- #smodule -->
<div id="smodule" class="bpanel-content">
	 <!-- .bpanel-main-content starts here-->
	<div class="bpanel-main-content">

        <ul class="sub-panel">
            <li><a href="#my-smodule-search"><?php _e("Search Module",'iamd_text_domain');?></a></li>
        </ul>

        <!-- Search -->
        <div id="my-smodule-search" class="tab-content">
        
        	<div class="bpanel-box">
            	<div class="box-title"><h3><?php _e('General Settings','iamd_text_domain');?></h3></div>
                
				<div class="box-content">
					<h6><?php _e('Currency','iamd_text_domain');?></h6>
                    <input type="text" class="small" name="<?php echo "mytheme[smodule][currency]";?>" value="<?php echo dt_theme_option("smodule","currency");?>">
                    <p class="note no-margin"><?php _e( "Please set default currency",'iamd_text_domain'); ?></p>
                    <div class="clear"></div>
				</div>      
            </div>

        	<!-- Hotel Tab Settings -->
            <div class="bpanel-box">
                <!-- Section 2 -->
                <div class="box-title"><h3><?php _e('Hotels Tab Settings','iamd_text_domain');?></h3></div>
                <div class="box-content">

                    <div class="column one-half">
                        <div class="column one-fifth">
                            <?php dt_theme_switch("",'smodule',"disable-hotels-tab");?>
                        </div>
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e( "Disable Hotels Tab",'iamd_text_domain'); ?></p>
                        </div>
                    </div>

                    <div class="column one-half last">
                        <input type="text" style="width:200px;" name="<?php echo "mytheme[smodule][hotel-title]";?>" value="<?php echo dt_theme_option("smodule","hotel-title");?>">
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e( "Put tab title. eg: Hotels",'iamd_text_domain'); ?></p>
                        </div>
                    </div>

                    <div class="hr"> </div>

                    <h6><?php _e('Available Search Modules','iamd_text_domain');?></h6>

                    <div class="column one-half">
                        <div class="column one-fifth">
                            <?php dt_theme_switch("",'smodule',"enable-title-module-for-hotels");?>
                        </div>
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e( "Enable Title Module",'iamd_text_domain'); ?></p>
                        </div>
                    </div>
    
                    <div class="column one-half last">
                        <div class="column one-fifth">
                            <?php dt_theme_switch("",'smodule',"enable-type-module-for-hotels");?>
                        </div>
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e( "Enable Hotels Type Module",'iamd_text_domain'); ?></p>
                        </div>
                    </div>
    
                    <div class="hr"> </div>
    
                    <div class="column one-half">
                        <div class="clear"></div>
                        <h6><?php _e('Location','iamd_text_domain');?></h6>
    
                        <div class="column one-fifth">
                            <?php dt_theme_switch("",'smodule',"enable-location-for-hotels");?>
                        </div>
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e( "Enable Hotels Location",'iamd_text_domain'); ?></p>
                        </div>
                    </div>
    
                    <div class="column one-half last">
                    
                        <div class="clear"></div>
                        <h6><?php _e('Offer','iamd_text_domain');?></h6>
                        
                        <div class="column one-fifth">
                            <?php dt_theme_switch("",'smodule',"enable-offer-for-hotels");?>
                        </div>
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e( "Enable Hotels Offer",'iamd_text_domain'); ?></p>
                        </div>
    
                        <div class="clear"></div>
                        <!-- Range -->
                        <div class="smodule-price">
                            <a href='' class='add-price-item'><?php _e('Add Offer','iamd_text_domain');?></a>
                            <?php $offers = dt_theme_option("smodule","offer-for-hotels");
                                  $offers = is_array($offers) ? array_filter($offers) : array();
                                  $offers = array_unique( $offers);
                                foreach( $offers as $offer ){ ?>
                                <div class="smodule-price-container">
                                    <input type="text" class="medium" name="<?php echo "mytheme[smodule][offer-for-hotels][]";?>" value="<?php echo $offer;?>">
                                    <a href='' class='remove-price-item'><?php _e('Remove','iamd_text_domain');?></a>
                                </div>
                            <?php } ?>
                            <div class="clone hidden">
                                <div class="smodule-price-container">
                                    <input type="text" class="medium" name="<?php echo "mytheme[smodule][offer-for-hotels][]";?>" value="">
                                    <a href='' class='remove-price-item'><?php _e('Remove','iamd_text_domain');?></a>
                                </div>
                            </div>	
                        </div><!-- Range -->
                    </div>
    
                    <div class="hr"> </div>
                    <h6><?php _e('Price Modules','iamd_text_domain');?></h6>
    
                    <div class="column one-half">
                        <div class="column one-fifth">
                            <?php dt_theme_switch("",'smodule',"enable-min-price-for-hotels");?>
                        </div>
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e( "Enable Minimum Price Search",'iamd_text_domain'); ?></p>
                        </div>
                        <div class="clear"></div>
    
                        <div class="smodule-price">
                            <a href='' class='add-price-item'><?php _e('Add Range','iamd_text_domain');?></a>
                            <?php $prices = dt_theme_option("smodule","min-price-for-hotels");
                                  $prices = is_array($prices) ? array_filter($prices) : array();
                                  $prices = array_unique( $prices);
                                foreach( $prices as $price ){ ?>
                                <div class="smodule-price-container">
                                    <input type="text" class="medium" name="<?php echo "mytheme[smodule][min-price-for-hotels][]";?>" value="<?php echo $price;?>">
                                    <a href='' class='remove-price-item'><?php _e('Remove','iamd_text_domain');?></a>
                                </div>
                            <?php } ?>
                            <div class="clone hidden">
                                <div class="smodule-price-container">
                                    <input type="text" class="medium" name="<?php echo "mytheme[smodule][min-price-for-hotels][]";?>" value="">
                                    <a href='' class='remove-price-item'><?php _e('Remove','iamd_text_domain');?></a>
                                </div>
                            </div>	
                        </div>
                    </div>
    
                    <div class="column one-half last">
                        <div class="column one-fifth">
                            <?php dt_theme_switch("",'smodule',"enable-max-price-for-hotels");?>
                        </div>
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e( "Enable Maximum Price Search",'iamd_text_domain'); ?></p>
                        </div>
                        <div class="clear"></div>
                        <div class="smodule-price">
                            <a href='' class='add-price-item'><?php _e('Add Range','iamd_text_domain');?></a>
                            <?php $prices = dt_theme_option("smodule","max-price-for-hotels");
                                  $prices = is_array($prices) ? array_filter($prices) : array();
                                  $prices = array_unique( $prices);
                                foreach( $prices as $price ){ ?>
                                <div class="smodule-price-container">
                                    <input type="text" class="medium" name="<?php echo "mytheme[smodule][max-price-for-hotels][]";?>" value="<?php echo $price;?>">
                                    <a href='' class='remove-price-item'><?php _e('Remove','iamd_text_domain');?></a>
                                </div>
                            <?php } ?>
                            <div class="clone hidden">
                                <div class="smodule-price-container">
                                    <input type="text" class="medium" name="<?php echo "mytheme[smodule][max-price-for-hotels][]";?>" value="">
                                    <a href='' class='remove-price-item'><?php _e('Remove','iamd_text_domain');?></a>
                                </div>
                            </div>	
                        </div>
                    </div>
                </div><!-- Section 2 -->
        	</div><!-- Hotel Tab Settings End -->
            
        	<!-- Packages Tab Settings -->
            <div class="bpanel-box">
                <!-- Section 2 -->
                <div class="box-title"><h3><?php _e('Packages Tab Settings','iamd_text_domain');?></h3></div>
                <div class="box-content">

                    <div class="column one-half">
                        <div class="column one-fifth">
                            <?php dt_theme_switch("",'smodule',"disable-packages-tab");?>
                        </div>
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e( "Disable Packages Tab",'iamd_text_domain'); ?></p>
                        </div>
                    </div>

                    <div class="column one-half last">
                        <input type="text" style="width:200px;" name="<?php echo "mytheme[smodule][packages-title]";?>" value="<?php echo dt_theme_option("smodule","packages-title");?>">
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e( "Put tab title. eg: Packages",'iamd_text_domain'); ?></p>
                        </div>
                    </div>

                    <div class="hr"> </div>
    
                    <h6><?php _e('Available Search Modules','iamd_text_domain');?></h6>
    
                    <div class="column one-half">
                        <div class="column one-fifth">
                            <?php dt_theme_switch("",'smodule',"enable-title-module-for-packages");?>
                        </div>
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e( "Enable Title Module",'iamd_text_domain'); ?></p>
                        </div>
                    </div>
    
                    <div class="column one-half last">
                        <div class="column one-fifth">
                            <?php dt_theme_switch("",'smodule',"enable-type-module-for-packages");?>
                        </div>
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e( "Enable Packages Type Module",'iamd_text_domain'); ?></p>
                        </div>
                    </div>
    
                    <div class="hr"> </div>
    
                    <div class="column one-half">
                    
                        <div class="clear"></div>
                        <h6><?php _e('Location','iamd_text_domain');?></h6>
    
                        <div class="column one-fifth">
                            <?php dt_theme_switch("",'smodule',"enable-location-for-packages");?>
                        </div>
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e( "Enable Packages Location",'iamd_text_domain'); ?></p>
                        </div>
    
                        <div class="clear"></div>
                        <!-- Range -->
                        <div class="smodule-price">
                            <a href='' class='add-price-item'><?php _e('Add City','iamd_text_domain');?></a>
                            <?php $cities = dt_theme_option("smodule","location-for-packages");
                                  $cities = is_array($cities) ? array_filter($cities) : array();
                                  $cities = array_unique( $cities);
                                foreach( $cities as $city ){ ?>
                                <div class="smodule-price-container">
                                    <input type="text" class="medium" name="<?php echo "mytheme[smodule][location-for-packages][]";?>" value="<?php echo $city;?>">
                                    <a href='' class='remove-price-item'><?php _e('Remove','iamd_text_domain');?></a>
                                </div>
                            <?php } ?>
                            <div class="clone hidden">
                                <div class="smodule-price-container">
                                    <input type="text" class="medium" name="<?php echo "mytheme[smodule][location-for-packages][]";?>" value="">
                                    <a href='' class='remove-price-item'><?php _e('Remove','iamd_text_domain');?></a>
                                </div>
                            </div>	
                        </div><!-- Range -->
                        
                    </div>
    
                    <div class="column one-half last">
                    
                        <div class="clear"></div>
                        <h6><?php _e('Persons','iamd_text_domain');?></h6>
                        
                        <div class="column one-fifth">
                            <?php dt_theme_switch("",'smodule',"enable-persons-for-packages");?>
                        </div>
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e( "Enable Packages No.of. Persons",'iamd_text_domain'); ?></p>
                        </div>
    
                        <div class="clear"></div>
                        <!-- Range -->
                        <div class="smodule-price">
                            <a href='' class='add-price-item'><?php _e('Add Persons','iamd_text_domain');?></a>
                            <?php $persons = dt_theme_option("smodule","persons-for-packages");
                                  $persons = is_array($persons) ? array_filter($persons) : array();
                                  $persons = array_unique( $persons);
                                foreach( $persons as $person ){ ?>
                                <div class="smodule-price-container">
                                    <input type="text" class="medium" name="<?php echo "mytheme[smodule][persons-for-packages][]";?>" value="<?php echo $person;?>">
                                    <a href='' class='remove-price-item'><?php _e('Remove','iamd_text_domain');?></a>
                                </div>
                            <?php } ?>
                            <div class="clone hidden">
                                <div class="smodule-price-container">
                                    <input type="text" class="medium" name="<?php echo "mytheme[smodule][persons-for-packages][]";?>" value="">
                                    <a href='' class='remove-price-item'><?php _e('Remove','iamd_text_domain');?></a>
                                </div>
                            </div>	
                        </div><!-- Range -->
                    </div>
    
                    <div class="hr"> </div>
                    <h6><?php _e('Price Modules','iamd_text_domain');?></h6>
    
                    <div class="column one-half">
                        <div class="column one-fifth">
                            <?php dt_theme_switch("",'smodule',"enable-min-price-for-packages");?>
                        </div>
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e( "Enable Minimum Price Search",'iamd_text_domain'); ?></p>
                        </div>
                        <div class="clear"></div>
    
                        <div class="smodule-price">
                            <a href='' class='add-price-item'><?php _e('Add Range','iamd_text_domain');?></a>
                            <?php $prices = dt_theme_option("smodule","min-price-for-packages");
                                  $prices = is_array($prices) ? array_filter($prices) : array();
                                  $prices = array_unique( $prices);
                                foreach( $prices as $price ){ ?>
                                <div class="smodule-price-container">
                                    <input type="text" class="medium" name="<?php echo "mytheme[smodule][min-price-for-packages][]";?>" value="<?php echo $price;?>">
                                    <a href='' class='remove-price-item'><?php _e('Remove','iamd_text_domain');?></a>
                                </div>
                            <?php } ?>
                            <div class="clone hidden">
                                <div class="smodule-price-container">
                                    <input type="text" class="medium" name="<?php echo "mytheme[smodule][min-price-for-packages][]";?>" value="">
                                    <a href='' class='remove-price-item'><?php _e('Remove','iamd_text_domain');?></a>
                                </div>
                            </div>	
                        </div>
                    </div>
    
                    <div class="column one-half last">
                        <div class="column one-fifth">
                            <?php dt_theme_switch("",'smodule',"enable-max-price-for-packages");?>
                        </div>
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e( "Enable Maximum Price Search",'iamd_text_domain'); ?></p>
                        </div>
                        <div class="clear"></div>
                        <div class="smodule-price">
                            <a href='' class='add-price-item'><?php _e('Add Range','iamd_text_domain');?></a>
                            <?php $prices = dt_theme_option("smodule","max-price-for-packages");
                                  $prices = is_array($prices) ? array_filter($prices) : array();
                                  $prices = array_unique( $prices);
                                foreach( $prices as $price ){ ?>
                                <div class="smodule-price-container">
                                    <input type="text" class="medium" name="<?php echo "mytheme[smodule][max-price-for-packages][]";?>" value="<?php echo $price;?>">
                                    <a href='' class='remove-price-item'><?php _e('Remove','iamd_text_domain');?></a>
                                </div>
                            <?php } ?>
                            <div class="clone hidden">
                                <div class="smodule-price-container">
                                    <input type="text" class="medium" name="<?php echo "mytheme[smodule][max-price-for-packages][]";?>" value="">
                                    <a href='' class='remove-price-item'><?php _e('Remove','iamd_text_domain');?></a>
                                </div>
                            </div>	
                        </div>
                    </div>
                </div><!-- Section 2 -->
        	</div><!-- Packages Tab Settings End -->

        	<!-- Places Tab Settings -->
            <div class="bpanel-box">
                <!-- Section 2 -->
                <div class="box-title"><h3><?php _e('Places Tab Settings','iamd_text_domain');?></h3></div>
                <div class="box-content">

                    <div class="column one-half">
                        <div class="column one-fifth">
                            <?php dt_theme_switch("",'smodule',"disable-places-tab");?>
                        </div>
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e( "Disable Places Tab",'iamd_text_domain'); ?></p>
                        </div>
                    </div>

                    <div class="column one-half last">
                        <input type="text" style="width:200px;" name="<?php echo "mytheme[smodule][places-title]";?>" value="<?php echo dt_theme_option("smodule","places-title");?>">
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e( "Put tab title. eg: Places",'iamd_text_domain'); ?></p>
                        </div>
                    </div>

                    <div class="hr"> </div>

                    <h6><?php _e('Available Search Modules','iamd_text_domain');?></h6>
    
                    <div class="column one-half">
                        <div class="column one-fifth">
                            <?php dt_theme_switch("",'smodule',"enable-title-module-for-places");?>
                        </div>
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e( "Enable Title Module",'iamd_text_domain'); ?></p>
                        </div>
                    </div>
    
                    <div class="column one-half last">
                        <div class="column one-fifth">
                            <?php dt_theme_switch("",'smodule',"enable-type-module-for-places");?>
                        </div>
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e( "Enable Places Type Module",'iamd_text_domain'); ?></p>
                        </div>
                    </div>
    
                    <div class="hr"> </div>
    
                    <div class="column one-half">
                        <div class="clear"></div>
                        <h6><?php _e('Location','iamd_text_domain');?></h6>
    
                        <div class="column one-fifth">
                            <?php dt_theme_switch("",'smodule',"enable-location-for-places");?>
                        </div>
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e( "Enable Places Location",'iamd_text_domain'); ?></p>
                        </div>
    
                        <div class="clear"></div>
                        <!-- Range -->
                        <div class="smodule-price">
                            <a href='' class='add-price-item'><?php _e('Add City','iamd_text_domain');?></a>
                            <?php $cities = dt_theme_option("smodule","location-for-places");
                                  $cities = is_array($cities) ? array_filter($cities) : array();
                                  $cities = array_unique( $cities);
                                foreach( $cities as $city ){ ?>
                                <div class="smodule-price-container">
                                    <input type="text" class="medium" name="<?php echo "mytheme[smodule][location-for-places][]";?>" value="<?php echo $city;?>">
                                    <a href='' class='remove-price-item'><?php _e('Remove','iamd_text_domain');?></a>
                                </div>
                            <?php } ?>
                            <div class="clone hidden">
                                <div class="smodule-price-container">
                                    <input type="text" class="medium" name="<?php echo "mytheme[smodule][location-for-places][]";?>" value="">
                                    <a href='' class='remove-price-item'><?php _e('Remove','iamd_text_domain');?></a>
                                </div>
                            </div>	
                        </div><!-- Range -->
                    </div>
                </div><!-- Section 2 -->
        	</div><!-- Places Tab Settings End -->
            
        </div><!-- Search -->

    </div> <!-- .bpanel-main-content ends here-->
</div><!-- #smodule -->