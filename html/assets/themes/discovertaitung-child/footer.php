            <!-- footer starts here -->
            <?php global $dt_allowed_html_tags; ?>

            <footer id="footer">
              <section>
                <div class="container">
                  <div class="qrcode">
                    <div class="dt_sc_one_fifth column space qrcode-icon">
                      <a href="https://itunes.apple.com/app/lu-xing-tai-dong/id655368655?mt=8">
                        <img src="<?php echo WP_CONTENT_URL;?>/uploads/i-balloon-iOS.jpg"/>
                      </a>
                      <?php if(ICL_LANGUAGE_CODE=='en'){ ?><p><?php _e('Download Taitung Traveling APP', 'dt_themes');?></p><?php }else{ ?><p><?php _e('下載旅行台東APP', 'dt_themes');?></p><?php } ?>
                      <p><?php _e('iOS', 'dt_themes');?></p>
                    </div>
                    <div class="dt_sc_one_fifth column space qrcode-icon">
                      <a href="https://play.google.com/store/apps/details?id=com.taitung">
                        <img src="<?php echo WP_CONTENT_URL;?>/uploads/i-balloon-Android.jpg"/>
                      </a>
                      <?php if(ICL_LANGUAGE_CODE=='en'){ ?><p><?php _e('Download Taitung Traveling APP', 'dt_themes');?></p><?php }else{ ?><p><?php _e('下載旅行台東APP', 'dt_themes');?></p><?php } ?>
                      <p><?php _e('Android', 'dt_themes');?></p>
                    </div>
                    <div class="dt_sc_one_fifth column space qrcode-icon">
                      <img src="<?php echo WP_CONTENT_URL;?>/uploads/tt-free-wifi.jpg"/>
                      <p>
                        <a class="btn qrcode-btn" href="https://tt-free.taitung.gov.tw/pc/index.aspx">
                          <?php _e('Details', 'dt_themes');?>
                        </a>
                      </p>
                    </div>
                    <div class="dt_sc_one_fifth column space qrcode-icon">
                      <a href="https://itunes.apple.com/app/tai-donge-zhi-tong/id1153458067?mt=8">
                        <img src="<?php echo WP_CONTENT_URL;?>/uploads/ttpush-iOS-1.jpg"/>
                      </a>
                      <?php if(ICL_LANGUAGE_CODE=='en'){ ?><p><?php _e('Download PPTNOW APP', 'dt_themes');?></p><?php }else{ ?><p><?php _e('下載踢一下APP', 'dt_themes');?></p><?php } ?>
                      <p><?php _e('TT Push iOS', 'dt_themes');?></p>
                    </div>
                    <div class="dt_sc_one_fifth column space qrcode-icon">
                      <a href="https://play.google.com/store/apps/details?id=com.taitung.ttpush">
                        <img src="<?php echo WP_CONTENT_URL;?>/uploads/ttpush-Android-1.jpg"/>
                      </a>
                      <?php if(ICL_LANGUAGE_CODE=='en'){ ?><p><?php _e('Download PPTNOW APP', 'dt_themes');?></p><?php }else{ ?><p><?php _e('下載踢一下APP', 'dt_themes');?></p><?php } ?>
                      <p><?php _e('TT Push Android', 'dt_themes');?></p>
                    </div>
                  </div>
                </div>
              </section>
				          <section class="copyright type2">
                	   <div class="container">
                       <div class="social-content">
                         <ul class="dt-sc-social-icons">
                         <li class="facebook"><a class="fa fa-facebook" href="https://www.facebook.com/HiTaitung/"></a></li>
                         <li class="instagram"><a class="fa fa-instagram" href="https://www.instagram.com/discover_taitung/"></a></li>
                         <?php /*
                         <li class="twitter"><a class="fa fa-twitter" href="#"></a></li>z
                         <li class="flickr"><a class="fa fa-flickr" href="#"></a></li>
                         */ ?>
                         <li class="youtube"><a class="fa fa-youtube" href="https://www.youtube.com/user/planning089"></a></li>
                         <li class="tel"><a class="fa fa-phone" href="tel:886089347512"><?php /* <span>089-347512</span>*/?></a></li>
                         <li class="rss"><a class="fa fa-rss" href="<?php if(ICL_LANGUAGE_CODE=='zh-hant'){echo WP_SITEURL;}else{echo WP_SITEURL.ICL_LANGUAGE_CODE.'/';}?>rss-feed/"></a></li>
                         </ul>
                       </div>
                       <?php /*
                        <div class="ticker-wrapper"><?php echo do_shortcode('[wp_rss_aggregator pagination="off" links_before=\'<ul id="news-ticker">\']');?></div>
                        */ ?>
                       <div class="copyright-content">
                         <ul>
                           <li><?php _e('Copyright © 2017 Discovertaitung.com', 'dt_themes');?></li>
                           <li><a href="http://www.miitbeian.gov.cn/" target="_blank"><?php _e('沪ICP备15044856号', 'dt_themes');?></a></li>
                         </ul>
                       </div>
                    </div>
                </section>
            </footer>
            <!-- footer ends here -->
		</div>
    </div>
<?php if(dt_theme_option('integration', 'enable-body-code') != '') echo '<script type="text/javascript">'.wp_kses(stripslashes(dt_theme_option('integration', 'body-code')), $dt_allowed_html_tags).'</script>';
wp_footer(); ?>
<!-- <script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function()
{ (i[r].q=i[r].q||[]).push(arguments)}
,i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-92697433-1', 'auto');
ga('send', 'pageview');
</script> -->
<?php /*
<script>
jQuery(function () {
  jQuery('#news-ticker').webTicker({
    startEmpty:false,
    height:'40px',
    hoverpause:true
  });
});
</script>
*/?>
</body>
</html>
