<!-- #general -->
<div id="theme-footer" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel"> 
            <li><a href="#my-footer"><?php _e("Footer",'iamd_text_domain');?></a></li>
			<li><a href="#my-footer-bottom"><?php _e("Footer Bottom",'iamd_text_domain');?></a></li>
        </ul>
        

        <!-- #my-footer-->
        <div id="my-footer" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php _e('Footer','iamd_text_domain');?></h3>
                </div>
                
                <div class="box-content">
                
                    <div class="bpanel-option-set">

                         <h6><?php _e('Show Footer','iamd_text_domain');?></h6>
                    	 <?php $switchclass = ( "on" ==  dt_theme_option('general','show-footer') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                         <div data-for="mytheme-show-footer" class="checkbox-switch <?php echo $switchclass;?>"></div>
						 <input class="hidden" id="mytheme-show-footer" name="mytheme[general][show-footer]" type="checkbox" 
						 <?php checked(dt_theme_option('general','show-footer'),'on');?>/>
                         <div class="hr"></div>
                    
                        <h6><?php _e('Footer Column Layout','iamd_text_domain');?></h6>
                        <p class="note"><?php _e("Select a perfect column layout style for your theme's footer.",'iamd_text_domain');?></p>
                        
                        <ul class="bpanel-layout-set bpanel-post-layout">
                        <?php $footer_layouts = array(
									1=>'one-column',							2=>'one-half-column',
									3=>'one-third-column',						4=>'one-fourth-column',
									5=>'onefourth-onefourth-onehalf-column',	6=>'onehalf-onefourth-onefourth-column',
									7=>'onefourth-threefourth-column',			8=>'threefourth-onefourth-column',
									9=>'onethird-twothird-column',				10=>'twothird-onethird-column');?>
                        <?php foreach($footer_layouts as $k => $v): $class = ( $k ==  dt_theme_option('general','footer-columns')) ? " class='selected' " : "";?>
                       		<li><a href="#" rel="<?php echo $k;?>" <?php echo $class;?>><img src="<?php echo IAMD_FW_URL."theme_options/images/columns/{$v}.png";?>" /></a></li>	
                        <?php endforeach;?>
                        </ul><input id="mytheme[general][footer-columns]" name="mytheme[general][footer-columns]" type="hidden"
                        			value="<?php echo  dt_theme_option('general','footer-columns');?>"/>
                                    
                    </div><!-- .bpanel-option-set -->
                    <div class="hr"></div>

                    <div class="bpanel-option-set">
                         <h6><?php _e('Show Copyright Text','iamd_text_domain');?></h6>
                    	 <?php $switchclass = ( "on" ==  dt_theme_option('general','show-copyrighttext') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                         <div data-for="mytheme-show-copyrighttext" class="checkbox-switch <?php echo $switchclass;?>"></div>
						 <input class="hidden" id="mytheme-show-copyrighttext" name="mytheme[general][show-copyrighttext]" type="checkbox" 
						 <?php checked(dt_theme_option('general','show-copyrighttext'),'on');?>/>
                         <div class="hr_invisible"></div>
                    
                        <h6><?php _e('Copyright Text','iamd_text_domain');?></h6>
                        <textarea id="mytheme-copyright-text" name="mytheme[general][copyright-text]"
                        	rows="" cols="" style="height:90px;"><?php echo htmlspecialchars (stripslashes(dt_theme_option('general','copyright-text')));?></textarea>
                        <p class="note"> <?php _e('You can paste your copyright text in this box. This will be automatically added to the footer.','iamd_text_domain');?> </p>
                    </div><!-- .bpanel-option-set -->
                    
                </div><!-- .box-content -->
            
            </div><!-- .bpanel-box end -->
            
        </div><!--#my-footer end-->
        
        <!-- #my-footer-->
        <div id="my-footer-bottom" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php _e('Footer Bottom','iamd_text_domain');?></h3>
                </div>

                <div class="box-content">

                    <div class="bpanel-option-set">
                    
                         <h6><?php _e('Show Bottom Section','iamd_text_domain');?></h6>
                    	 <?php $switchclass = ( "on" ==  dt_theme_option('general','show-footer-bottom') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                         <div data-for="mytheme-show-footer-bottom" class="checkbox-switch <?php echo $switchclass;?>"></div>
						 <input class="hidden" id="mytheme-show-footer-bottom" name="mytheme[general][show-footer-bottom]" type="checkbox" 
						 <?php checked(dt_theme_option('general','show-footer-bottom'),'on');?>/>
                         <div class="hr"></div>

                         <h6><?php _e('Bottom Content / Shortcode','iamd_text_domain');?></h6>
                         <textarea id="mytheme-bottom-content" name="mytheme[general][bottom-content]"
                              rows="" cols="" style="width:100%; height:150px;"><?php echo htmlspecialchars (stripslashes(dt_theme_option('general','bottom-content')));?></textarea>
                         <p class="note"> <?php _e('You can paste your bottom content. It supports shortcodes & html tags also.','iamd_text_domain');?> </p>

                    </div><!-- .bpanel-option-set -->
                    <div class="hr"></div>

                    <div class="bpanel-option-set">
                    
                         <h6><?php _e('Partner Content','iamd_text_domain');?></h6>
                         <textarea id="mytheme-partner-content" name="mytheme[general][partner-content]"
                              rows="" cols="" style="width:100%; height:100px;"><?php echo htmlspecialchars (stripslashes(dt_theme_option('general','partner-content')));?></textarea>
                         <p class="note"> <?php _e('You can paste your partner content. It supports html tags also.','iamd_text_domain');?> </p>
                         <div class="hr"></div>
                         
                         <h6><?php _e('Community Statistics','iamd_text_domain');?></h6>
                         <textarea id="mytheme-community-status" name="mytheme[general][community-status]"
                              rows="" cols="" style="width:100%; height:100px;"><?php echo htmlspecialchars (stripslashes(dt_theme_option('general','community-status')));?></textarea>
                         <p class="note"> <?php _e('You can paste your community statistics. It supports html tags also.','iamd_text_domain');?> </p>

                    </div><!-- .bpanel-option-set -->
                    
                </div><!-- .box-content -->
            
            </div><!-- .bpanel-box end -->
            
        </div><!--#my-footer end-->        
        
    </div><!-- .bpanel-main-content end-->
</div><!-- #general end-->