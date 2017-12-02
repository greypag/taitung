<!DOCTYPE html>
<!--[if IE 7 ]>    <html class="isie ie7 oldie no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="isie ie8 oldie no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="isie ie9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php is_dt_theme_moible_view(); ?>
	<!-- <meta name="description" content="<?php bloginfo('description'); ?>"/> --><!--Leon 04072017-->
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
  <meta name="baidu-site-verification" content="5MrkQHEPeG" />
  <meta name="shenma-site-verification" content="00c63d798bce7f299ede0cee1448b542_1494585884">
	<meta name="360-site-verification" content="4ff86db1c405cd0da54c78ad1a63d1da" />

	<!-- google-analytics -->
		<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function()
		{ (i[r].q=i[r].q||[]).push(arguments)}
		,i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-92697433-1', 'auto');
		ga('send', 'pageview');
		</script>

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push(
	{'gtm.start': new Date().getTime(),event:'gtm.js'}
	);var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-58DVRQS');</script>
	<!-- End Google Tag Manager -->

  <!-- Baidu Statistics setting -->
	<script>
		var _hmt = _hmt || [];
		(function()
		{ var hm = document.createElement("script"); hm.src = "https://hm.baidu.com/hm.js?b75fab08aed93a26afec2a1ae07b3879"; var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(hm, s); }
		)();
	</script>

	<title><?php dt_theme_public_title(); ?></title>
<?php /*
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  */ ?>
<?php
	global $dt_allowed_html_tags;
	#Load Theme Styles...
	if(dt_theme_option('integration', 'enable-header-code') != '') echo '<script type="text/javascript">'.wp_kses(stripslashes(dt_theme_option('integration', 'header-code')), $dt_allowed_html_tags).'</script>';
	wp_head(); ?>
</head>
<div id="debug" style="display:none;"><?php get_page_template(); ?></div>
<body <?php if(dt_theme_option("appearance","layout") == "boxed") body_class('boxed'); else body_class(); ?>>

	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-58DVRQS"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

	<?php if(dt_theme_option('general','loading-bar') != "true") echo '<div class="cover"></div>'; ?>
	<div class="wrapper">
    	<div class="inner-wrapper">
        	<!-- header-wrapper starts here -->
        	<div id="header-wrapper">
	            <?php $htype = dt_theme_option('appearance','header_type'); $htype = !empty($htype) ? $htype : 'header1'; ?>
            	<header id="header" class="<?php echo esc_attr($htype); ?>">
                	<?php if(dt_theme_option('general','header-top-bar') != "true"): ?>
                        <!-- Top bar starts here -->
                        <div class="top-bar">
                            <div class="container">
                                <div class="float-left"><?php
//echo do_shortcode('[wp_rss_aggregator links_before=\'<ul id="news-ticker">\']');
//echo wp_kses(do_shortcode(stripslashes(dt_theme_option('general', 'top-bar-left-content'))), $dt_allowed_html_tags); ?>
                                </div>
																<div class="top-right">
                                    <?php do_action('wpml_add_language_selector');?>
                                </div>
                            </div>
                        </div>
                        <!-- Top bar ends here -->
                    <?php endif; ?>
                    <div class="container">
                    	<div id="logo"><?php
							if( dt_theme_option('general', 'logo') ):
								$template_uri = get_template_directory_uri();
								$url = dt_theme_option('general', 'logo-url');
								$url = !empty( $url ) ? $url : $template_uri."/images/logo.png";

								$retina_url = dt_theme_option('general','retina-logo-url');
								$retina_url = !empty($retina_url) ? $retina_url : $template_uri."/images/logo@2x.png";

								$width = dt_theme_option('general','retina-logo-width');
								$width = !empty($width) ? $width."px;" : "234px";

								$height = dt_theme_option('general','retina-logo-height');
								$height = !empty($height) ? $height."px;" : "88px";?>
								<a href="<?php echo home_url();?>" title="<?php bloginfo('title'); ?>">
									<img class="normal_logo" src="<?php echo esc_url($url);?>" alt="<?php bloginfo('title'); ?>" title="<?php bloginfo('title'); ?>" />
									<img class="retina_logo" src="<?php echo esc_url($retina_url);?>" alt="<?php bloginfo('title'); ?>" title="<?php bloginfo('title'); ?>" />
								</a><?php
							else: ?>
								<div class="logo-title">
									<h1 id="site-title"><a href="<?php echo home_url(); ?>" title="<?php bloginfo('title'); ?>"><?php bloginfo('title'); ?></a></h1>
									<h2 id="site-description"><?php bloginfo('description'); ?></h2>
								</div><?php
							endif; ?>
						</div>
						<div id="award">
              <!-- START lonelyplanet -->
              <img class="lonely-planet-logo" src="<?php echo WP_CONTENT_URL;?>/uploads/lonely-planet-logo.png" title="<?php _e('Top 10 Asia Spots - Best Travel - Lonely Planet', 'dt_themes');?>" />
              <!-- END lonelyplanet -->
						</div>
                        <div id="primary-menu">
                            <div class="dt-menu-toggle" id="dt-menu-toggle">
                                <span class="dt-menu-toggle-icon"></span>
                            </div>
                        	   <nav id="main-menu"><?php
														    /* leon disabled original menu */
                                /* if( is_page_template('tpl-onepage.php') ):
                                    $meta = get_post_meta($post->ID, '_tpl_default_settings', true);
                                    $cmenu = "<li class='menu-item menu-item-type-post_type menu-item-object-page'><a href='".home_url()."/#".$post->post_name."'>".__('Home', 'iamd_text_domain')."</a></li>";
                                    wp_nav_menu( array('menu' => $meta['onepage_menu'], 'container'  => false, 'menu_id' => 'menu-main-menu', 'menu_class' => 'onepage_menu menu', 'fallback_cb' => 'dt_theme_default_navigation', 'walker' => new DTOnePageMenuWalker(), 'items_wrap' => '<ul id="%1$s" class="%2$s">'.$cmenu.'%3$s</ul>',));
                                else:
									wp_nav_menu( array('theme_location' => 'primary-menu', 'container'  => false, 'menu_id' => 'menu-main-menu', 'menu_class' => 'menu', 'fallback_cb' => 'dt_theme_default_navigation', 'walker' => new DTFrontEndMenuWalker()));
								endif; */ ?>
                <?php

                if(ICL_LANGUAGE_CODE=='zh-hant'){


                ?>
								<ul class="menu menu-toggle-open" id="menu-main-menu">
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item current_page_item menu-item-has-children menu-item-depth-0 menu-item-megamenu-parent megamenu-4-columns-group">
										<a href="<?php echo WP_SITEURL;?>"><?php _e('Home', 'dt_themes');?></a>
									</li>
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-megamenu-parent megamenu-4-columns-group">
										<a href="#"><?php _e('Travel', 'dt_themes');?></a>
										<div class="megamenu-child-container">
											<ul class="sub-menu">
												<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1 menu-item-with-widget-area">
													<h4 class="header-title"><?php _e('Hotspot', 'dt_themes');?></h4>
													<div class="menu-item-widget-area-container">
														<ul>
															<li class="widget widget_recent_entries">
																<div class="recent-posts-widget">
																	<ul>
																		<li>
																			<a class="thumb" href="<?php echo WP_SITEURL;?>hotspot/%e8%87%ba%e6%9d%b1%e5%9c%8b%e9%9a%9b%e7%86%b1%e6%b0%a3%e7%90%83%e5%98%89%e5%b9%b4%e8%8f%af/" rel="bookmark" title="<?php _e('臺東國際熱氣球嘉年華', 'dt_themes'); ?>">
																			 <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-ballon-3-1-420x420.jpg">
																			</a>
																			<p>
																			 <a href="<?php echo WP_SITEURL;?>hotspot/%e8%87%ba%e6%9d%b1%e5%9c%8b%e9%9a%9b%e7%86%b1%e6%b0%a3%e7%90%83%e5%98%89%e5%b9%b4%e8%8f%af/" rel="bookmark" title="<?php _e('臺東國際熱氣球嘉年華', 'dt_themes'); ?>">
																				 <?php _e('臺東國際熱氣球嘉年華', 'dt_themes'); ?>
																			 </a>
																		 </p>
																		</li>
																		<li>
																			<a class="thumb" href="<?php echo WP_SITEURL;?>hotspot/%e9%90%b5%e8%8a%b1%e6%9d%91%e9%9f%b3%e6%a8%82%e8%81%9a%e8%90%bd/" rel="bookmark" title="<?php _e('鐵花村音樂聚落', 'dt_themes'); ?>">
																			 <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-tie-3-420x420.jpg">
																			</a>
																			<p>
																			 <a href="<?php echo WP_SITEURL;?>hotspot/%e9%90%b5%e8%8a%b1%e6%9d%91%e9%9f%b3%e6%a8%82%e8%81%9a%e8%90%bd/" rel="bookmark" title="<?php _e('鐵花村音樂聚落', 'dt_themes'); ?>">
																				 <?php _e('鐵花村音樂聚落', 'dt_themes'); ?>
																			 </a>
																		 </p>
																		</li>
																		<li>
																			<a class="thumb" href="<?php echo WP_SITEURL;?>hotspot/%e8%87%ba%e6%9d%b1%e6%a3%ae%e6%9e%97%e5%85%ac%e5%9c%92/" rel="bookmark" title="<?php _e('臺東森林公園', 'dt_themes'); ?>">
																			 <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-forest-3-420x420.jpg">
																			</a>
																			<p>
																			 <a href="<?php echo WP_SITEURL;?>hotspot/%e8%87%ba%e6%9d%b1%e6%a3%ae%e6%9e%97%e5%85%ac%e5%9c%92/" rel="bookmark" title="<?php _e('臺東森林公園', 'dt_themes'); ?>">
																				 <?php _e('臺東森林公園', 'dt_themes'); ?>
																			 </a>
																		 </p>
																		</li>
																		<li>
																			<a class="thumb" href="<?php echo WP_SITEURL;?>hotspot/%e4%b8%89%e4%bb%99%e5%8f%b0%e9%a2%a8%e6%99%af%e5%8d%80/" rel="bookmark" title="<?php _e('三仙台風景區', 'dt_themes'); ?>">
																			 <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-3station-1-420x420.jpg">
																			</a>
																			<p>
																			 <a href="<?php echo WP_SITEURL;?>hotspot/%e4%b8%89%e4%bb%99%e5%8f%b0%e9%a2%a8%e6%99%af%e5%8d%80/" rel="bookmark" title="<?php _e('三仙台風景區', 'dt_themes'); ?>">
																				 <?php _e('三仙台風景區', 'dt_themes'); ?>
																			 </a>
																		 </p>
																		</li>
																	</ul>
																</div>
															</li>
														</ul>
													</div>
												</li>
												<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1 menu-item-with-widget-area">
													<a href="#" class="asdf">asdf</a>
													<div class="menu-item-widget-area-container">
														<ul>
															<li class="widget widget_recent_entries">
																<div class="recent-posts-widget">
																	<ul>
																		<li>
																			<a class="thumb" href="<?php echo WP_SITEURL;?>hotspot/%e6%b1%a0%e4%b8%8a%e4%bc%af%e6%9c%97%e5%a4%a7%e9%81%93/" rel="bookmark" title="<?php _e('池上伯朗大道', 'dt_themes'); ?>">
																			 <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-cycle-4-420x420.jpg">
																			</a>
																			<p>
																			 <a href="<?php echo WP_SITEURL;?>hotspot/%e6%b1%a0%e4%b8%8a%e4%bc%af%e6%9c%97%e5%a4%a7%e9%81%93/" rel="bookmark" title="<?php _e('池上伯朗大道', 'dt_themes'); ?>">
																				 <?php _e('池上伯朗大道', 'dt_themes'); ?>
																			 </a>
																		 </p>
																		</li>
																		<li>
																			<a class="thumb" href="<?php echo WP_SITEURL;?>hotspot/%e8%87%ba%e7%81%a3%e5%9c%8b%e9%9a%9b%e8%a1%9d%e6%b5%aa%e5%85%ac%e9%96%8b%e8%b3%bd/" rel="bookmark" title="<?php _e('臺灣國際衝浪公開賽', 'dt_themes'); ?>">
																			 <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-surf-5-420x420.jpg">
																			</a>
																			<p>
																			 <a href="<?php echo WP_SITEURL;?>hotspot/%e8%87%ba%e7%81%a3%e5%9c%8b%e9%9a%9b%e8%a1%9d%e6%b5%aa%e5%85%ac%e9%96%8b%e8%b3%bd/" rel="bookmark" title="<?php _e('臺灣國際衝浪公開賽', 'dt_themes'); ?>">
																				 <?php _e('臺灣國際衝浪公開賽', 'dt_themes'); ?>
																			 </a>
																		 </p>
																		</li>
																		<li>
																			<a class="thumb" href="<?php echo WP_SITEURL;?>hotspot/%e8%87%ba%e6%9d%b1%e5%a4%aa%e9%ba%bb%e9%87%8c%e9%87%91%e9%87%9d%e8%8a%b1%e5%ad%a3/" rel="bookmark" title="<?php _e('臺東太麻里金針花季', 'dt_themes'); ?>">
																			 <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-flower-2-420x420.jpg">
																			</a>
																			<p>
																			 <a href="<?php echo WP_SITEURL;?>hotspot/%e8%87%ba%e6%9d%b1%e5%a4%aa%e9%ba%bb%e9%87%8c%e9%87%91%e9%87%9d%e8%8a%b1%e5%ad%a3/" rel="bookmark" title="<?php _e('臺東太麻里金針花季', 'dt_themes'); ?>">
																				 <?php _e('臺東太麻里金針花季', 'dt_themes'); ?>
																			 </a>
																		 </p>
																		</li>
																		<li>
																			<a class="thumb" href="<?php echo WP_SITEURL;?>hotspot/%e5%85%83%e5%ae%b5%e7%af%80%e7%82%ae%e7%82%b8%e5%af%92%e5%96%ae%e7%88%ba/" rel="bookmark" title="<?php _e('元宵節炮炸寒單爺', 'dt_themes'); ?>">
																			 <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-pray-2-420x420.jpg">
																			</a>
																			<p>
																			 <a href="<?php echo WP_SITEURL;?>hotspot/%e5%85%83%e5%ae%b5%e7%af%80%e7%82%ae%e7%82%b8%e5%af%92%e5%96%ae%e7%88%ba/" rel="bookmark" title="<?php _e('元宵節炮炸寒單爺', 'dt_themes'); ?>">
																				 <?php _e('元宵節炮炸寒單爺', 'dt_themes'); ?>
																			 </a>
																		 </p>
																		</li>
																	</ul>
																</div>
															</li>
														</ul>
													</div>
												</li>
												<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1 menu-item-with-widget-area">
													<h4 class="header-title"><?php _e('景點', 'dt_themes');?></h4>
													<div class="menu-item-widget-area-container">
														<ul>
															<li class="widget widget_text">
																<div class="textwidget">
																	<h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL;?>%e5%8f%b0%e6%9d%b1%e5%b8%82%e5%8d%80/"><?php _e('台東市區', 'dt_themes');?></a></h6>
																	<h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL;?>%e5%8f%b09%e7%b7%9a%e6%99%af%e9%bb%9e/"><?php _e('縱谷台9線', 'dt_themes');?></a></h6>
																	<h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL;?>%e6%9d%b1%e6%b5%b7%e5%b2%b8%e5%8f%b011%e7%b7%9a/"><?php _e('東海岸台11線', 'dt_themes');?></a></h6>
																	<h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL;?>%e5%8f%b09%e7%b7%9a%e5%8d%97%e8%bf%b4%e5%85%ac%e8%b7%af/"><?php _e('台9線南迴山海', 'dt_themes');?></a></h6>
																	<h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL;?>%e5%8d%97%e6%a9%ab%e5%85%ac%e8%b7%af%e6%99%af%e9%bb%9e/"><?php _e('南橫山線', 'dt_themes');?></a></h6>
																</div>
															</li>
														</ul>
													 </div>
												 </li>
												<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1 menu-item-with-widget-area">
													<h4 class="header-title"><?php _e('攻略', 'dt_themes');?></h4>
													<div class="menu-item-widget-area-container">
														<ul>
															<h6><a href="<?php echo WP_SITEURL;?>hotspot/24%E5%B0%8F%E6%99%82x%E8%87%BA%E6%9D%B1%EF%BC%9A%E5%B8%82%E5%8D%80%E4%B8%80%E6%97%A5%E9%81%8A/"><?php _e('24小時駐足台東', 'dt_themes');?></a></h6>
															<h6><a class="48hr" href="<?php echo WP_SITEURL;?>#tab2"><?php _e('48小時駐足台東', 'dt_themes');?></a></h6>
															<li class="widget widget_text">
																<a class="header-a" href="<?php echo WP_SITEURL;?>hotspot/48%E5%B0%8F%E6%99%82x%E8%87%BA%E6%9D%B1%EF%BC%9A%E5%B1%B1%E7%B7%9A%E4%BA%8C%E6%97%A5%E9%81%8A/"><?php _e('山線二日遊', 'dt_themes');?></a>
															</li>
															<li class="widget widget_text">
																<a class="header-a" href="<?php echo WP_SITEURL;?>hotspot/48%E5%B0%8F%E6%99%82x%E8%87%BA%E6%9D%B1%EF%BC%9A%E6%B5%B7%E7%B7%9A%E4%BA%8C%E6%97%A5%E9%81%8A/"><?php _e('海線二日遊', 'dt_themes');?></a>
															</li>
															<div class="dt-sc-hr-invisible-small"></div>
															<h6><a href="<?php echo WP_SITEURL;?>hotspot/%E7%B4%AB%E8%89%B2%E6%97%85%E9%81%8Ax%E8%87%BA%E6%9D%B1%EF%BC%9A%E4%B8%89%E6%97%A5%E9%81%8A/"><?php _e('72小時駐足台東', 'dt_themes');?></a></h6>
														</ul>
													</div>
													<h4 class="header-title"><?php _e('深度之旅', 'dt_themes');?></h4>
													<div class="menu-item-widget-area-container">
														 <ul>
															 <li class="widget widget_text">
																 <div class="textwidget">
																	 <h6><a href="<?php echo WP_SITEURL;?>%E4%BC%91%E9%96%92%E8%BE%B2%E9%81%8A/"><?php _e('休閒農遊', 'dt_themes');?></a></h6>
																	 <h6><a href="<?php echo WP_SITEURL;?>%E8%87%BA%E6%9D%B1%E5%8E%9F%E4%BD%8F%E6%B0%91%E9%83%A8%E8%90%BD/"><?php _e('臺東原住民部落', 'dt_themes');?></a></h6>
																	 <h6><a href="<?php echo WP_SITEURL;?>%E9%9B%A2%E5%B3%B6/"><?php _e('離島', 'dt_themes');?></a></h6>
																 </div>
															 </li>
														 </ul>
													</div>
												</li>
											</ul>
											<div class="dt-menu-expand">+</div>
										</div>
										<div class="dt-menu-expand">+</div>
									</li>
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-megamenu-parent  megamenu-3-columns-group">
										<a href="#"><?php _e('藝文饗宴', 'dt_themes');?></a>
										<div class="megamenu-child-container">
											<ul class="sub-menu">
												<li class="menu-item-widget-area-container">
													<a href="<?php echo WP_SITEURL;?>%E8%97%9D%E6%96%87%E5%B1%95%E8%A6%BD/"><?php _e('藝文展覽', 'dt_themes');?></a>
													<ul>
														<li class="widget widget_text">
															<div class="textwidget">
																<a href="<?php echo WP_SITEURL;?>%E8%97%9D%E6%96%87%E5%B1%95%E8%A6%BD/"><img src="<?php echo WP_CONTENT_URL;?>/uploads/art-museum.jpg" alt="" title=""></a>
															</div>
														</li>
													</ul>
												</li>
												<li class="menu-item-widget-area-container">
													<a href="<?php echo WP_SITEURL;?>%E6%96%87%E5%8C%96%E7%99%BE%E8%80%81%E5%8C%AF/"><?php _e('文化百老匯', 'dt_themes');?></a>
													<ul>
														<li class="widget widget_text">
															<div class="textwidget">
																<a href="<?php echo WP_SITEURL;?>%E6%96%87%E5%8C%96%E7%99%BE%E8%80%81%E5%8C%AF/"><img src="<?php echo WP_CONTENT_URL;?>/uploads/art-broadway.jpg" alt="" title=""></a>
															</div>
														</li>
													</ul>
												</li>
												<li class="menu-item-widget-area-container">
													<a href="<?php echo WP_SITEURL;?>%E9%90%B5%E8%8A%B1%E6%9D%91/"><?php _e('鐵花村', 'dt_themes');?></a>
													<ul>
														<li class="widget widget_text">
															<div class="textwidget">
																<a href="<?php echo WP_SITEURL;?>%E9%90%B5%E8%8A%B1%E6%9D%91/"><img src="<?php echo WP_CONTENT_URL;?>/uploads/art-tiehua.jpg" alt="" title=""></a>
															</div>
														</li>
													</ul>
												</li>
											</ul>
											<div class="dt-menu-expand">+</div>
										</div>
										<div class="dt-menu-expand">+</div>
									</li>
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-simple-parent">
										<a href="<?php echo WP_SITEURL;?>%E9%81%8B%E5%8B%95/"><?php _e('Sport', 'dt_themes');?></a>
										<ul class="sub-menu">
											<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
												<a href="<?php echo WP_SITEURL;?>%e9%90%b5%e4%ba%ba%e4%b8%89%e9%a0%85%e8%b3%bd/"><?php _e('鐵人三項賽', 'dt_themes');?></a>
											</li>
											<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
												<a href="<?php echo WP_SITEURL;?>%e9%a6%ac%e6%8b%89%e6%9d%be/"><?php _e('馬拉松', 'dt_themes');?></a>
											</li>
											<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
												<a href="<?php echo WP_SITEURL;?>%e5%9c%8b%e9%9a%9b%e8%a1%9d%e6%b5%aa%e8%b3%bd/"><?php _e('國際衝浪賽', 'dt_themes');?></a>
											</li>
											<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
												<a href="<?php echo WP_SITEURL;?>%e8%a1%9d%e6%b5%aa/"><?php _e('衝浪', 'dt_themes');?></a>
											</li>
											<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
												<a href="<?php echo WP_SITEURL;?>%e8%87%aa%e8%a1%8c%e8%bb%8a/"><?php _e('自行車', 'dt_themes');?></a>
											</li>
											<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
												<a href="<?php echo WP_SITEURL;?>%e9%a3%9b%e8%a1%8c%e5%82%98/"><?php _e('飛行傘', 'dt_themes');?></a>
											</li>
											<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
												<a href="<?php echo WP_SITEURL;?>%e6%bd%9b%e6%b0%b4/"><?php _e('潛水', 'dt_themes');?></a>
											</li>
										</ul>
										<div class="dt-menu-expand">+</div>
									</li>
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-simple-parent">
										<a href="#"><?php _e('Transport', 'dt_themes');?></a>
										<ul class="sub-menu">
											<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
												<a href="<?php echo WP_SITEURL;?>%e5%8f%b0%e6%9d%b1%e6%a9%9f%e5%a0%b4/"><?php _e('到台東旅行 – 航空', 'dt_themes');?></a>
											</li>
											<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-1">
												<a href="#"><?php _e('在台東旅行', 'dt_themes');?></a>
												<ul class="sub-menu">
													<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-2">
														<a href="<?php echo WP_SITEURL;?>%E7%81%AB%E8%BB%8A/"><?php _e('火車', 'dt_themes');?></a>
													</li>
													<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-2">
														<a href="<?php echo WP_SITEURL;?>%E5%B7%B4%E5%A3%AB/"><?php _e('巴士', 'dt_themes');?></a>
													</li>
													<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-2">
														<a href="<?php echo WP_SITEURL;?>%E8%87%AA%E8%A1%8C%E9%96%8B%E8%BB%8A/"><?php _e('自行開車', 'dt_themes');?></a>
													</li>
												</ul>
											</li>
											<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
												<a href="<?php echo WP_SITEURL;?>%E9%9B%A2%E5%B3%B6%E4%BA%A4%E9%80%9A/"><?php _e('離島交通', 'dt_themes');?></a>
											</li>
										</ul>
										<div class="dt-menu-expand">+</div>
									</li>
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-simple-parent">
										<a href="<?php echo WP_SITEURL;?>%E7%94%9F%E6%B4%BB/"><?php _e('生活', 'dt_themes');?></a>
										<ul class="sub-menu">
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
												<a href="<?php echo WP_SITEURL;?>%E5%9C%8B%E9%9A%9B%E6%80%A7%E7%9A%84%E5%9C%A8%E5%9C%B0%E6%96%B0%E8%81%9E/"><?php _e('國際性的在地新聞', 'dt_themes');?></a>
											</li>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
												<a href="<?php echo WP_SITEURL;?>%E5%9C%A8%E5%9C%B0%E5%A4%96%E7%B1%8D%E4%BA%BA%E5%A3%AB%E6%95%85%E4%BA%8B/"><?php _e('在地外籍人士故事', 'dt_themes');?></a>
											</li>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
												<a href="<?php echo WP_SITEURL;?>%E7%94%9F%E6%B4%BB#tab1"><?php _e('「英語認證商家」地圖', 'dt_themes');?></a>
											</li>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
												<a href="<?php echo WP_SITEURL;?>%E7%94%9F%E6%B4%BB#tab2"><?php _e('當地治安狀況', 'dt_themes');?></a>
											</li>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
												<a href="<?php echo WP_SITEURL;?>%E7%94%9F%E6%B4%BB#tab3"><?php _e('緊急事故電話及相關資訊', 'dt_themes');?></a>
											</li>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
												<a href="<?php echo WP_SITEURL;?>%E7%94%9F%E6%B4%BB#tab4"><?php _e('出入境', 'dt_themes');?></a>
											</li>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
												<a href="<?php echo WP_SITEURL;?>%E7%94%9F%E6%B4%BB#tab5"><?php _e('氣候', 'dt_themes');?></a>
											</li>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
												<a href="<?php echo WP_SITEURL;?>%E7%94%9F%E6%B4%BB#tab6"><?php _e('教育', 'dt_themes');?></a>
											</li>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
												<a href="<?php echo WP_SITEURL;?>%E7%94%9F%E6%B4%BB#tab7"><?php _e('財務', 'dt_themes');?></a>
											</li>
										</ul>
										<div class="dt-menu-expand">+</div>
									</li>
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-simple-parent">
										<a href="<?php echo WP_SITEURL;?>%E5%95%86%E5%8B%99%E9%AB%94%E9%A9%97/"><?php _e('商務體驗', 'dt_themes');?></a>
										<ul class="sub-menu">
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
												<a href="<?php echo WP_SITEURL;?>%E5%95%86%E5%8B%99%E9%AB%94%E9%A9%97#tab1"><?php _e('打工換宿', 'dt_themes');?></a>
											</li>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
												<a href="<?php echo WP_SITEURL;?>%E5%95%86%E5%8B%99%E9%AB%94%E9%A9%97#tab2"><?php _e('企業徵才', 'dt_themes');?></a>
											</li>
										</ul>
										<div class="dt-menu-expand">+</div>
									</li>
								</ul>
														 <div class="lightbox" style="display:none">
															 <div class="liflex">
														   <div class="msg">
																 <div class="litext">您好 ! 感謝您的來訪，我們特別準備了這份使用者滿意度調查表，希望藉由您的看法及建議，幫助我們更加精進，感謝您的填寫，期待您再次來訪。</div>
                                 <div class="libtn">
                                   <div class="notNow" onclick="closeModal()">稍後填寫</div>
  														     <a class="survey btn" href="%E4%BD%BF%E7%94%A8%E8%80%85%E6%84%8F%E8%A6%8B%E8%AA%BF%E6%9F%A5%E8%A1%A8/?survey=true">使用者意見調查表</a>
                                 </div>
														   </div>
															 </div>
														 </div>
                             <?php
                           }elseif(ICL_LANGUAGE_CODE=='zh-hans'){?>
                             <ul class="menu menu-toggle-open" id="menu-main-menu">
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item current_page_item menu-item-has-children menu-item-depth-0 menu-item-megamenu-parent megamenu-4-columns-group">
                                 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>"><?php _e('Home', 'dt_themes');?></a>
                               </li>
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-megamenu-parent megamenu-4-columns-group">
                                 <a href="#"><?php _e('Travel', 'dt_themes');?></a>
                                 <div class="megamenu-child-container">
                                   <ul class="sub-menu">
                                     <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1 menu-item-with-widget-area">
                                       <h4 class="header-title"><?php _e('Hotspot', 'dt_themes');?></h4>
                                       <div class="menu-item-widget-area-container">
                                         <ul>
                                           <li class="widget widget_recent_entries">
                                             <div class="recent-posts-widget">
                                               <ul>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/taitung-hot-air-balloon-cn/" rel="bookmark" title="<?php _e('臺東國際熱氣球嘉年華', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-ballon-3-1-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/taitung-hot-air-balloon-cn/" rel="bookmark" title="<?php _e('臺東國際熱氣球嘉年華', 'dt_themes'); ?>">
                                                      <?php _e('臺東國際熱氣球嘉年華', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/tiehua-music-village-cn/" rel="bookmark" title="<?php _e('鐵花村音樂聚落', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-tie-3-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/tiehua-music-village-cn/" rel="bookmark" title="<?php _e('鐵花村音樂聚落', 'dt_themes'); ?>">
                                                      <?php _e('鐵花村音樂聚落', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/taitung-forest-park-cn/" rel="bookmark" title="<?php _e('臺東森林公園', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-forest-3-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/taitung-forest-park-cn/" rel="bookmark" title="<?php _e('臺東森林公園', 'dt_themes'); ?>">
                                                      <?php _e('臺東森林公園', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/sansiantai-cn/" rel="bookmark" title="<?php _e('三仙台風景區', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-3station-1-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/sansiantai-cn/" rel="bookmark" title="<?php _e('三仙台風景區', 'dt_themes'); ?>">
                                                      <?php _e('三仙台風景區', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                               </ul>
                                             </div>
                                           </li>
                                         </ul>
                                       </div>
                                     </li>
                                     <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1 menu-item-with-widget-area">
                                       <a href="#" class="asdf">asdf</a>
                                       <div class="menu-item-widget-area-container">
                                         <ul>
                                           <li class="widget widget_recent_entries">
                                             <div class="recent-posts-widget">
                                               <ul>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/mr-brown-avenue-cn/" rel="bookmark" title="<?php _e('池上伯朗大道', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-cycle-4-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/mr-brown-avenue-cn/" rel="bookmark" title="<?php _e('池上伯朗大道', 'dt_themes'); ?>">
                                                      <?php _e('池上伯朗大道', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/international-surfing-competition-cn/" rel="bookmark" title="<?php _e('臺灣國際衝浪公開賽', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-surf-5-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/international-surfing-competition-cn/" rel="bookmark" title="<?php _e('臺灣國際衝浪公開賽', 'dt_themes'); ?>">
                                                      <?php _e('臺灣國際衝浪公開賽', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/daylily-flowers-blossom-season-taimali-cn/" rel="bookmark" title="<?php _e('臺東太麻里金針花季', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-flower-2-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/daylily-flowers-blossom-season-taimali-cn/" rel="bookmark" title="<?php _e('臺東太麻里金針花季', 'dt_themes'); ?>">
                                                      <?php _e('臺東太麻里金針花季', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/bombing-lord-handan-yuanxiao-festival-cn/" rel="bookmark" title="<?php _e('元宵節炮炸寒單爺', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-pray-2-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/bombing-lord-handan-yuanxiao-festival-cn/" rel="bookmark" title="<?php _e('元宵節炮炸寒單爺', 'dt_themes'); ?>">
                                                      <?php _e('元宵節炮炸寒單爺', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                               </ul>
                                             </div>
                                           </li>
                                         </ul>
                                       </div>
                                     </li>
                                     <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1 menu-item-with-widget-area">
                                       <h4 class="header-title"><?php _e('景點', 'dt_themes');?></h4>
                                       <div class="menu-item-widget-area-container">
                                         <ul>
                                           <li class="widget widget_text">
                                             <div class="textwidget">
                                               <h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/downtown-taitung-cn/"><?php _e('台東市區', 'dt_themes');?></a></h6>
                                               <h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/provincial-highway-no-9-cn/"><?php _e('縱谷台9線', 'dt_themes');?></a></h6>
                                               <h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/provincial-highway-no-11-cn/"><?php _e('東海岸台11線', 'dt_themes');?></a></h6>
                                               <h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/provincial-highway-no-9-south-link-highway-cn/"><?php _e('台9線南迴山海', 'dt_themes');?></a></h6>
                                               <h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/southern-cross-island-highway-cn/"><?php _e('南橫山線', 'dt_themes');?></a></h6>
                                             </div>
                                           </li>
                                         </ul>
                                        </div>
                                      </li>
                                     <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1 menu-item-with-widget-area">
                                       <h4 class="header-title"><?php _e('攻略', 'dt_themes');?></h4>
                                       <div class="menu-item-widget-area-container">
                                         <ul>
                                           <h6><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/downtown-taitung-cn/"><?php _e('24小時駐足台東', 'dt_themes');?></a></h6>
                                           <h6><a class="48hr" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/#tab2"><?php _e('48小時駐足台東', 'dt_themes');?></a></h6>
                                           <li class="widget widget_text">
                                             <a class="header-a" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/48-hours-in-taitung-two-day-mountain-trip-cn/"><?php _e('山線二日遊', 'dt_themes');?></a>
                                           </li>
                                           <li class="widget widget_text">
                                             <a class="header-a" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/48-hours-in-taitung-two-day-east-coast-trip-cn/"><?php _e('海線二日遊', 'dt_themes');?></a>
                                           </li>
                                           <div class="dt-sc-hr-invisible-small"></div>
                                           <h6><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/3-days-trip-in-taitung-cn/"><?php _e('72小時駐足台東', 'dt_themes');?></a></h6>
                                         </ul>
                                       </div>
                                       <h4 class="header-title"><?php _e('深度之旅', 'dt_themes');?></h4>
                                       <div class="menu-item-widget-area-container">
                                          <ul>
                                            <li class="widget widget_text">
                                              <div class="textwidget">
                                                <h6><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/agricultural-countryside-cn/"><?php _e('休閒農遊', 'dt_themes');?></a></h6>
                                                <h6><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/aboriginal-villages-cn/"><?php _e('臺東原住民部落', 'dt_themes');?></a></h6>
                                                <h6><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/taiwan-island/"><?php _e('離島', 'dt_themes');?></a></h6>
                                              </div>
                                            </li>
                                          </ul>
                                       </div>
                                     </li>
                                   </ul>
																	 <div class="dt-menu-expand">+</div>
                                 </div>
																 <div class="dt-menu-expand">+</div>
                               </li>
															 <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-megamenu-parent  megamenu-3-columns-group">
																 <a href="#"><?php _e('藝文饗宴', 'dt_themes');?></a>
																 <div class="megamenu-child-container">
																	 <ul class="sub-menu">
																		 <li class="menu-item-widget-area-container">
																			 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/exhibitions-cn/"><?php _e('藝文展覽', 'dt_themes');?></a>
																			 <ul>
						 														<li class="widget widget_text">
						 															<div class="textwidget">
																				 	  <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/exhibitions-cn/"><img src="<?php echo WP_CONTENT_URL;?>/uploads/art-museum.jpg" alt="" title=""></a>
																			 		</div>
																				</li>
																			</ul>
																		 </li>
																		 <li class="menu-item-widget-area-container">
																			 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/cultural-broadway-cn/"><?php _e('文化百老匯', 'dt_themes');?></a>
																			 <ul>
						 														 <li class="widget widget_text">
						 															 <div class="textwidget">
																				     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/cultural-broadway-cn/"><img src="<?php echo WP_CONTENT_URL;?>/uploads/art-broadway.jpg" alt="" title=""></a>
																			     </div>
																				 </li>
																			 </ul>
																		 </li>
																		 <li class="menu-item-widget-area-container">
																			 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/tiehua-music-village-cn/"><?php _e('鐵花村', 'dt_themes');?></a>
																			 <ul>
						 														<li class="widget widget_text">
						 															<div class="textwidget">
																				    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/tiehua-music-village-cn/"><img src="<?php echo WP_CONTENT_URL;?>/uploads/art-tiehua.jpg" alt="" title=""></a>
																			    </div>
																				</li>
																			</ul>
																		 </li>
																	 </ul>
																	 <div class="dt-menu-expand">+</div>
																 </div>
																 <div class="dt-menu-expand">+</div>
															 </li>
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-simple-parent">
                                 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/sport-cn/"><?php _e('Sport', 'dt_themes');?></a>
                                 <ul class="sub-menu">
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/triathlon-taitungtaiwan-cn/"><?php _e('鐵人三項賽', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/marathon-taitungtaiwan-cn/"><?php _e('馬拉松', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/international-surfing-competition-cn/"><?php _e('國際衝浪賽', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/surfing-taitungtaiwan-cn/"><?php _e('衝浪', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/cycling-taitungtaiwan-cn/"><?php _e('自行車', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/paragliding-taitungtaiwan-cn/"><?php _e('飛行傘', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/scuba-diving-cn/"><?php _e('潛水', 'dt_themes');?></a>
                                   </li>
                                 </ul>
																 <div class="dt-menu-expand">+</div>
                               </li>
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-simple-parent">
                                 <a href="#"><?php _e('Transport', 'dt_themes');?></a>
                                 <ul class="sub-menu">
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/flights-taitungtaiwan-cn/"><?php _e('到台東旅行 – 航空', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-1">
                                     <a href="#"><?php _e('在台東旅行', 'dt_themes');?></a>
                                     <ul class="sub-menu">
                                       <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-2">
                                         <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/railway-taitungtaiwan-cn/"><?php _e('火車', 'dt_themes');?></a>
                                       </li>
                                       <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-2">
                                         <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/bus-taitungtaiwan-cn/"><?php _e('巴士', 'dt_themes');?></a>
                                       </li>
                                       <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-2">
                                         <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/driving-taitungtaiwan-cn/"><?php _e('自行開車', 'dt_themes');?></a>
                                       </li>
                                     </ul>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/island-transport-taiwan-cn/"><?php _e('離島交通', 'dt_themes');?></a>
                                   </li>
                                 </ul>
																 <div class="dt-menu-expand">+</div>
                               </li>
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-simple-parent">
                                 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-cn/"><?php _e('生活', 'dt_themes');?></a>
                                 <ul class="sub-menu">
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/international-news-taitungtaiwan-cn/"><?php _e('國際性的在地新聞', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/stories-of-expats-life-cn/"><?php _e('在地外籍人士故事', 'dt_themes');?></a>
                                   </li>
																	 <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-cn#tab1"><?php _e('「英语认证商家」地图', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-cn#tab2"><?php _e('當地治安狀況', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-cn#tab3"><?php _e('緊急事故電話及相關資訊', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-cn#tab4"><?php _e('出入境', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-cn#tab5"><?php _e('氣候', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-cn#tab6"><?php _e('教育', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-cn#tab7"><?php _e('財務', 'dt_themes');?></a>
                                   </li>
                                 </ul>
																 <div class="dt-menu-expand">+</div>
                               </li>
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-simple-parent">
                                 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/business-experience-cn/"><?php _e('商務體驗', 'dt_themes');?></a>
                                 <ul class="sub-menu">
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/business-experience-cn#tab1"><?php _e('打工換宿', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/business-experience-cn#tab2"><?php _e('企業徵才', 'dt_themes');?></a>
                                   </li>
                                 </ul>
																 <div class="dt-menu-expand">+</div>
                               </li>
                           </ul>
													 <div class="lightbox" style="display:none;">
														 <div class="liflex">
															 <div class="msg">
																	<div class="litext">您好！感谢您的来访，我们特别准备了这份使用者满意度调查表，希望藉由您的看法及建议，帮助我们改进与进步，感谢您的填写，期待您再次来访。</div>
																	 <div class="libtn">
																	 <div class="notNow" onclick="closeModal()">稍后填写</div>
																	 <a class="survey btn" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/%E7%94%A8%E6%88%B7%E6%84%8F%E8%A7%81%E8%B0%83%E6%9F%A5%E8%A1%A8/?survey=true">用户意见调查表</a>
																	</div>
															 </div>
														</div>
													 </div>
                             <?php
                           }elseif(ICL_LANGUAGE_CODE=='en'){?>
                             <ul class="menu menu-toggle-open" id="menu-main-menu">
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item current_page_item menu-item-has-children menu-item-depth-0 menu-item-megamenu-parent megamenu-4-columns-group">
                                 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>"><?php _e('Home', 'dt_themes');?></a>
                               </li>
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-megamenu-parent megamenu-4-columns-group">
                                 <a href="#"><?php _e('Travel', 'dt_themes');?></a>
                                 <div class="megamenu-child-container">
                                   <ul class="sub-menu">
                                     <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1 menu-item-with-widget-area">
                                       <h4 class="header-title"><?php _e('Scenic Spot', 'dt_themes');?></h4>
                                       <div class="menu-item-widget-area-container">
                                         <ul>
                                           <li class="widget widget_recent_entries">
                                             <div class="recent-posts-widget">
                                               <ul>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/taitung-international-hot-air-balloon-festival/" rel="bookmark" title="<?php _e('Taitung International Hot Air Balloon Festival', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-ballon-3-1-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/taitung-international-hot-air-balloon-festival/" rel="bookmark" title="<?php _e('Taitung International Hot Air Balloon Festival', 'dt_themes'); ?>">
                                                      <?php _e('Taitung International Hot Air Balloon Festival', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/tiehua-music-village/" rel="bookmark" title="<?php _e('Tiehua Music Village', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-tie-3-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/tiehua-music-village/" rel="bookmark" title="<?php _e('Tiehua Music Village', 'dt_themes'); ?>">
                                                      <?php _e('Tiehua Music Village', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/taitung-forest-park/" rel="bookmark" title="<?php _e('Taitung Forest Park', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-forest-3-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/taitung-forest-park/" rel="bookmark" title="<?php _e('Taitung Forest Park', 'dt_themes'); ?>">
                                                      <?php _e('Taitung Forest Park', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/sansiantai/" rel="bookmark" title="<?php _e('Sansiantai', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-3station-1-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/sansiantai/" rel="bookmark" title="<?php _e('Sansiantai', 'dt_themes'); ?>">
                                                      <?php _e('Sansiantai', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                               </ul>
                                             </div>
                                           </li>
                                         </ul>
                                       </div>
                                     </li>
                                     <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1 menu-item-with-widget-area">
                                       <a href="#" class="asdf">asdf</a>
                                       <div class="menu-item-widget-area-container">
                                         <ul>
                                           <li class="widget widget_recent_entries">
                                             <div class="recent-posts-widget">
                                               <ul>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/chishang-mr-brown-avenue/" rel="bookmark" title="<?php _e('Chishang Mr. Brown Avenue', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-cycle-4-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/chishang-mr-brown-avenue/" rel="bookmark" title="<?php _e('Chishang Mr. Brown Avenue', 'dt_themes'); ?>">
                                                      <?php _e('Chishang Mr. Brown Avenue', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/international-surfing-competition/" rel="bookmark" title="<?php _e('International Surfing Competition', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-surf-5-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/international-surfing-competition/" rel="bookmark" title="<?php _e('International Surfing Competition', 'dt_themes'); ?>">
                                                      <?php _e('International Surfing Competition', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/daylily-flowers-blossom-season-taimali/" rel="bookmark" title="<?php _e('Daylily Flowers Blossom Season in Taimali', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-flower-2-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/daylily-flowers-blossom-season-taimali/" rel="bookmark" title="<?php _e('Daylily Flowers Blossom Season in Taimali', 'dt_themes'); ?>">
                                                      <?php _e('Daylily Flowers Blossom Season in Taimali', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/bombing-lord-handan-yuanxiao-festival/" rel="bookmark" title="<?php _e('Bombing Lord Handan in Yuanxiao Festival', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-pray-2-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/bombing-lord-handan-yuanxiao-festival/" rel="bookmark" title="<?php _e('Bombing Lord Handan in Yuanxiao Festival', 'dt_themes'); ?>">
                                                      <?php _e('Bombing Lord Handan in Yuanxiao Festival', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                               </ul>
                                             </div>
                                           </li>
                                         </ul>
                                       </div>
                                     </li>
                                     <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1 menu-item-with-widget-area">
                                       <h4 class="header-title"><?php _e('Attractions in Taitung', 'dt_themes');?></h4>
                                       <div class="menu-item-widget-area-container">
                                         <ul>
                                           <li class="widget widget_text">
                                             <div class="textwidget">
                                               <h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/downtown-taitung/"><?php _e('Downtown Taitung', 'dt_themes');?></a></h6>
                                               <h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/provincial-highway-no-9/"><?php _e('Provincial Highway No.9', 'dt_themes');?></a></h6>
                                               <h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/provincial-highway-no-11-east-coast/"><?php _e('Provincial Highway No.11-East Coast', 'dt_themes');?></a></h6>
                                               <h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/provincial-highway-no-9-south-link-highway/"><?php _e('Provincial Highway No.9-South Link Highway', 'dt_themes');?></a></h6>
                                               <h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/southern-cross-island-highway/"><?php _e('Southern Cross-Island Highway', 'dt_themes');?></a></h6>
                                             </div>
                                           </li>
                                         </ul>
                                        </div>
                                      </li>
                                     <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1 menu-item-with-widget-area">
                                       <h4 class="header-title"><?php _e('Trip', 'dt_themes');?></h4>
                                       <div class="menu-item-widget-area-container">
                                         <ul>
                                           <h6><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/24-hours-in-taitung/"><?php _e('24 Hours In Taitung', 'dt_themes');?></a></h6>
                                           <h6><a class="48hr" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/#tab2"><?php _e('48 Hours in Taitung', 'dt_themes');?></a></h6>
                                           <li class="widget widget_text">
                                             <a class="header-a" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/48-hours-in-taitung-two-day-mountain-trip/"><?php _e('2 Day Mountain Trip', 'dt_themes');?></a>
                                           </li>
                                           <li class="widget widget_text">
                                             <a class="header-a" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/48-hours-in-taitung-two-day-east-coast-trip/"><?php _e('2 Day East Coast Trip', 'dt_themes');?></a>
                                           </li>
                                           <div class="dt-sc-hr-invisible-small"></div>
                                           <h6><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/3-days-trip-in-taitung/"><?php _e('72 Hours in Taitung', 'dt_themes');?></a></h6>
                                         </ul>
                                       </div>
                                       <h4 class="header-title"><?php _e('Traveling', 'dt_themes');?></h4>
                                       <div class="menu-item-widget-area-container">
                                          <ul>
                                            <li class="widget widget_text">
                                              <div class="textwidget">
                                                <h6><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/agricultural-countryside/"><?php _e('Farms', 'dt_themes');?></a></h6>
                                                <h6><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/aboriginal-villages/"><?php _e('Aboriginal Villages', 'dt_themes');?></a></h6>
                                                <h6><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/island/"><?php _e('Island', 'dt_themes');?></a></h6>
                                              </div>
                                            </li>
                                          </ul>
                                       </div>
                                     </li>
                                   </ul>
																	 <div class="dt-menu-expand">+</div>
                                 </div>
																 <div class="dt-menu-expand">+</div>
                               </li>
															 <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-megamenu-parent  megamenu-3-columns-group">
																 <a href="#"><?php _e('Art & Culture', 'dt_themes');?></a>
																 <div class="megamenu-child-container">
																	 <ul class="sub-menu">
																		 <li class="menu-item-widget-area-container">
																			 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/exhibitions/"><?php _e('Exhibitions', 'dt_themes');?></a>
																			 <ul>
						 														<li class="widget widget_text">
						 															<div class="textwidget">
																				    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/exhibitions/"><img src="<?php echo WP_CONTENT_URL;?>/uploads/art-museum.jpg" alt="" title=""></a>
																			    </div>
																				</li>
																			</ul>
																		 </li>
																		 <li class="menu-item-widget-area-container">
																			 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/cultural-broadway/"><?php _e('Cultural Broadway', 'dt_themes');?></a>
																			 <ul>
						 														<li class="widget widget_text">
						 															<div class="textwidget">
																				    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/cultural-broadway/"><img src="<?php echo WP_CONTENT_URL;?>/uploads/art-broadway.jpg" alt="" title=""></a>
																			    </div>
																				</li>
																			</ul>
																		 </li>
																		 <li class="menu-item-widget-area-container">
																			 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/tiehua-music-village/"><?php _e('Tiehua Music Village', 'dt_themes');?></a>
																			 <ul>
						 														<li class="widget widget_text">
						 															<div class="textwidget">
																				    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/tiehua-music-village/"><img src="<?php echo WP_CONTENT_URL;?>/uploads/art-tiehua.jpg" alt="" title=""></a>
																			    </div>
																				</li>
																			</ul>
																		 </li>
																	 </ul>
																	 <div class="dt-menu-expand">+</div>
																 </div>
																 <div class="dt-menu-expand">+</div>
															 </li>
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-simple-parent">
                                 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/sport/"><?php _e('Sport', 'dt_themes');?></a>
                                 <ul class="sub-menu">
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/triathlon/"><?php _e('Triathlon', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/marathon/"><?php _e('Marathon', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/international-surfing-competition/"><?php _e('International Surfing Competition', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/surfing/"><?php _e('Surfing', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/cycling/"><?php _e('Cycling', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/paragliding/"><?php _e('Paragliding', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/scuba-diving/"><?php _e('Scuba Diving', 'dt_themes');?></a>
                                   </li>
                                 </ul>
																 <div class="dt-menu-expand">+</div>
                               </li>
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-simple-parent">
                                 <a href="#"><?php _e('Transport', 'dt_themes');?></a>
                                 <ul class="sub-menu">
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/flights/"><?php _e('Flights', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-1">
                                     <a href="#"><?php _e('Travel in Taitung', 'dt_themes');?></a>
                                     <ul class="sub-menu">
                                       <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-2">
                                         <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/railway/"><?php _e('Railway', 'dt_themes');?></a>
                                       </li>
                                       <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-2">
                                         <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/bus/"><?php _e('Bus', 'dt_themes');?></a>
                                       </li>
                                       <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-2">
                                         <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/driving/"><?php _e('Driving', 'dt_themes');?></a>
                                       </li>
                                     </ul>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/island-transport/"><?php _e('Island Transport', 'dt_themes');?></a>
                                   </li>
                                 </ul>
																 <div class="dt-menu-expand">+</div>
                               </li>
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-simple-parent">
                                 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living/"><?php _e('Living', 'dt_themes');?></a>
                                 <ul class="sub-menu">
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/international-news/"><?php _e('International News', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/stories-of-expats-life/"><?php _e('Stories of Expat’s life', 'dt_themes');?></a>
																	 </li>
																	 <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living#tab1"><?php _e('Map of English Service', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living#tab2"><?php _e('Safety and Security', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living#tab3"><?php _e('Emergency Services', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living#tab4"><?php _e('Immigration', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living#tab5"><?php _e('Climate', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living#tab6"><?php _e('Studying', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living#tab7"><?php _e('Money/Currency Exchange', 'dt_themes');?></a>
                                   </li>
                                 </ul>
																 <div class="dt-menu-expand">+</div>
                               </li>
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-simple-parent">
                                 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/business-experience/"><?php _e('Business Experience', 'dt_themes');?></a>
                                 <ul class="sub-menu">
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/business-experience#tab1"><?php _e('Work Exchange', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/business-experience#tab2"><?php _e('Employment', 'dt_themes');?></a>
                                   </li>
                                 </ul>
																 <div class="dt-menu-expand">+</div>
                               </li>
                           	 </ul>
														<div class="lightbox" style="display:none;">
															<div class="liflex">
																<div class="msg">
																	<div class="litext">Thank you for your visit. We have prepared this User Satisfaction Survey in a way that will help us to be more sophisticated. Thank you for filling out and looking forward to your visit again.</div>
																	<div class="libtn">
																		<div class="notNow" onclick="closeModal()">Not Now</div>
																		<a class="survey btn" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/questionnaire-users-opinions/?survey=true">Questionnaire</a>
																	</div>
																</div>
															</div>
														</div>
                             <?php
                           }elseif(ICL_LANGUAGE_CODE=='ja'){?>
                             <ul class="menu menu-toggle-open" id="menu-main-menu">
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item current_page_item menu-item-has-children menu-item-depth-0 menu-item-megamenu-parent megamenu-4-columns-group">
                                 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>"><?php _e('Home', 'dt_themes');?></a>
                               </li>
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-megamenu-parent megamenu-4-columns-group">
                                 <a href="#"><?php _e('Travel', 'dt_themes');?></a>
                                 <div class="megamenu-child-container">
                                   <ul class="sub-menu">
                                     <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1 menu-item-with-widget-area">
                                       <h4 class="header-title"><?php _e('Hotspot', 'dt_themes');?></h4>
                                       <div class="menu-item-widget-area-container">
                                         <ul>
                                           <li class="widget widget_recent_entries">
                                             <div class="recent-posts-widget">
                                               <ul>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/taitung-hot-air-balloon-jp/" rel="bookmark" title="<?php _e('臺東國際熱氣球嘉年華', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-ballon-3-1-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/taitung-hot-air-balloon-jp/" rel="bookmark" title="<?php _e('臺東國際熱氣球嘉年華', 'dt_themes'); ?>">
                                                      <?php _e('臺東國際熱氣球嘉年華', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/tiehua-music-village-jp/" rel="bookmark" title="<?php _e('鐵花村音樂聚落', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-tie-3-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/tiehua-music-village-jp/" rel="bookmark" title="<?php _e('鐵花村音樂聚落', 'dt_themes'); ?>">
                                                      <?php _e('鐵花村音樂聚落', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/taitung-forest-park-jp/" rel="bookmark" title="<?php _e('臺東森林公園', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-forest-3-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/taitung-forest-park-jp/" rel="bookmark" title="<?php _e('臺東森林公園', 'dt_themes'); ?>">
                                                      <?php _e('臺東森林公園', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/sansiantai-jp/" rel="bookmark" title="<?php _e('三仙台風景區', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-3station-1-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/sansiantai-jp/" rel="bookmark" title="<?php _e('三仙台風景區', 'dt_themes'); ?>">
                                                      <?php _e('三仙台風景區', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                               </ul>
                                             </div>
                                           </li>
                                         </ul>
                                       </div>
                                     </li>
                                     <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1 menu-item-with-widget-area">
                                       <a href="#" class="asdf">asdf</a>
                                       <div class="menu-item-widget-area-container">
                                         <ul>
                                           <li class="widget widget_recent_entries">
                                             <div class="recent-posts-widget">
                                               <ul>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/mr-brown-avenue-jp/" rel="bookmark" title="<?php _e('池上伯朗大道', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-cycle-4-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/mr-brown-avenue-jp/" rel="bookmark" title="<?php _e('池上伯朗大道', 'dt_themes'); ?>">
                                                      <?php _e('池上伯朗大道', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/international-surfing-competition-jp/" rel="bookmark" title="<?php _e('臺灣國際衝浪公開賽', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-surf-5-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/international-surfing-competition-jp/" rel="bookmark" title="<?php _e('臺灣國際衝浪公開賽', 'dt_themes'); ?>">
                                                      <?php _e('臺灣國際衝浪公開賽', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/daylily-flowers-blossom-season-taimali-jp/" rel="bookmark" title="<?php _e('臺東太麻里金針花季', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-flower-2-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/daylily-flowers-blossom-season-taimali-jp/" rel="bookmark" title="<?php _e('臺東太麻里金針花季', 'dt_themes'); ?>">
                                                      <?php _e('臺東太麻里金針花季', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/bombing-lord-handan-yuanxiao-festival-jp/" rel="bookmark" title="<?php _e('元宵節炮炸寒單爺', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-pray-2-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/bombing-lord-handan-yuanxiao-festival-jp/" rel="bookmark" title="<?php _e('元宵節炮炸寒單爺', 'dt_themes'); ?>">
                                                      <?php _e('元宵節炮炸寒單爺', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                               </ul>
                                             </div>
                                           </li>
                                         </ul>
                                       </div>
                                     </li>
                                     <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1 menu-item-with-widget-area">
                                       <h4 class="header-title"><?php _e('景點', 'dt_themes');?></h4>
                                       <div class="menu-item-widget-area-container">
                                         <ul>
                                           <li class="widget widget_text">
                                             <div class="textwidget">
                                               <h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/downtown-taitung-jp/"><?php _e('台東市區', 'dt_themes');?></a></h6>
                                               <h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/provincial-highway-no-9-jp/"><?php _e('縱谷台9線', 'dt_themes');?></a></h6>
                                               <h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/provincial-highway-no-11-jp/"><?php _e('東海岸台11線', 'dt_themes');?></a></h6>
                                               <h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/provincial-highway-no-9-south-link-highway-jp/"><?php _e('台9線南迴山海', 'dt_themes');?></a></h6>
                                               <h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/southern-cross-island-highway-jp/"><?php _e('南橫山線', 'dt_themes');?></a></h6>
                                             </div>
                                           </li>
                                         </ul>
                                        </div>
                                      </li>
                                     <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1 menu-item-with-widget-area">
                                       <h4 class="header-title"><?php _e('攻略', 'dt_themes');?></h4>
                                       <div class="menu-item-widget-area-container">
                                         <ul>
                                           <h6><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/24-hours-in-taitung-jp/"><?php _e('24小時駐足台東', 'dt_themes');?></a></h6>
                                           <h6><a class="48hr" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/#tab2"><?php _e('48小時駐足台東', 'dt_themes');?></a></h6>
                                           <li class="widget widget_text">
                                             <a class="header-a" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/48-hours-in-taitung-two-day-mountain-trip-jp/"><?php _e('山線二日遊', 'dt_themes');?></a>
                                           </li>
                                           <li class="widget widget_text">
                                             <a class="header-a" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/48-hours-in-taitung-two-day-east-coast-trip-jp/"><?php _e('海線二日遊', 'dt_themes');?></a>
                                           </li>
                                           <div class="dt-sc-hr-invisible-small"></div>
                                           <h6><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/3-days-trip-in-taitung-jp/"><?php _e('72小時駐足台東', 'dt_themes');?></a></h6>
                                         </ul>
                                       </div>
                                       <h4 class="header-title"><?php _e('深度之旅', 'dt_themes');?></h4>
                                       <div class="menu-item-widget-area-container">
                                          <ul>
                                            <li class="widget widget_text">
                                              <div class="textwidget">
                                                <h6><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/agricultural-countryside-jp/"><?php _e('休閒農遊', 'dt_themes');?></a></h6>
                                                <h6><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/aboriginal-villages-jp/"><?php _e('臺東原住民部落', 'dt_themes');?></a></h6>
                                                <h6><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/taiwan-island/"><?php _e('離島', 'dt_themes');?></a></h6>
                                              </div>
                                            </li>
                                          </ul>
                                       </div>
                                     </li>
                                   </ul>
																	 <div class="dt-menu-expand">+</div>
                                 </div>
																 <div class="dt-menu-expand">+</div>
                               </li>
															 <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-megamenu-parent  megamenu-3-columns-group">
																 <a href="#"><?php _e('藝文饗宴', 'dt_themes');?></a>
																 <div class="megamenu-child-container">
																	 <ul class="sub-menu">
																		 <li class="menu-item-widget-area-container">
																			 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/exhibitions-jp/"><?php _e('藝文展覽', 'dt_themes');?></a>
																			 <ul>
						 														<li class="widget widget_text">
						 															<div class="textwidget">
																				    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/exhibitions-jp/"><img src="<?php echo WP_CONTENT_URL;?>/uploads/art-museum.jpg" alt="" title=""></a>
																			    </div>
																				</li>
																			</ul>
																		 </li>
																		 <li class="menu-item-widget-area-container">
																			 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/cultural-broadway-jp/"><?php _e('文化百老匯', 'dt_themes');?></a>
																			 <ul>
						 														<li class="widget widget_text">
						 															<div class="textwidget">
																				    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/cultural-broadway-jp/"><img src="<?php echo WP_CONTENT_URL;?>/uploads/art-broadway.jpg" alt="" title=""></a>
																			    </div>
																				</li>
																			</ul>
																		 </li>
																		 <li class="menu-item-widget-area-container">
																			 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/tiehua-music-village-jp/"><?php _e('鐵花村', 'dt_themes');?></a>
																			 <ul>
						 														<li class="widget widget_text">
						 															<div class="textwidget">
																				    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/tiehua-music-village-jp/"><img src="<?php echo WP_CONTENT_URL;?>/uploads/art-tiehua.jpg" alt="" title=""></a>
																			    </div>
																				</li>
																			</ul>
																		 </li>
																	 </ul>
																	 <div class="dt-menu-expand">+</div>
																 </div>
																 <div class="dt-menu-expand">+</div>
															 </li>
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-simple-parent">
                                 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/sport-jp/"><?php _e('Sport', 'dt_themes');?></a>
                                 <ul class="sub-menu">
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/triathlon-taitungtaiwan-jp/"><?php _e('鐵人三項賽', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/marathon-taitungtaiwan-jp/"><?php _e('馬拉松', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/international-surfing-competition-jp/"><?php _e('國際衝浪賽', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/surfing-taitungtaiwan-jp/"><?php _e('衝浪', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/cycling--taitungtaiwan-jp/"><?php _e('自行車', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/paragliding-taitungtaiwan-jp/"><?php _e('飛行傘', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/scuba-diving-jp/"><?php _e('潛水', 'dt_themes');?></a>
                                   </li>
                                 </ul>
																 <div class="dt-menu-expand">+</div>
                               </li>
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-simple-parent">
                                 <a href="#"><?php _e('Transport', 'dt_themes');?></a>
                                 <ul class="sub-menu">
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/flights-taitungtaiwan-jp/"><?php _e('到台東旅行 – 航空', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-1">
                                     <a href="#"><?php _e('在台東旅行', 'dt_themes');?></a>
                                     <ul class="sub-menu">
                                       <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-2">
                                         <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/railway-taitungtaiwan-jp/"><?php _e('火車', 'dt_themes');?></a>
                                       </li>
                                       <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-2">
                                         <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/bus-taitungtaiwan-jp/"><?php _e('巴士', 'dt_themes');?></a>
                                       </li>
                                       <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-2">
                                         <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/driving-taitungtaiwan-jp/"><?php _e('自行開車', 'dt_themes');?></a>
                                       </li>
                                     </ul>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/island-transport-taiwan-jp/"><?php _e('離島交通', 'dt_themes');?></a>
                                   </li>
                                 </ul>
																 <div class="dt-menu-expand">+</div>
                               </li>
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-simple-parent">
                                 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-jp/"><?php _e('生活', 'dt_themes');?></a>
                                 <ul class="sub-menu">
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/international-news-jp/"><?php _e('國際性的在地新聞', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/stories-of-expats-life-jp/ "><?php _e('在地外籍人士故事', 'dt_themes');?></a>
                                   </li>
																	 <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-jp#tab1"><?php _e('「英語サービス認証」マップ', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-jp#tab2"><?php _e('當地治安狀況', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-jp#tab3"><?php _e('緊急事故電話及相關資訊', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-jp#tab4"><?php _e('出入境', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-jp#tab5"><?php _e('氣候', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-jp#tab6"><?php _e('教育', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-jp#tab7"><?php _e('財務', 'dt_themes');?></a>
                                   </li>
                                 </ul>
																 <div class="dt-menu-expand">+</div>
                               </li>
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-simple-parent">
                                 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/business-experience-jp/"><?php _e('商務體驗', 'dt_themes');?></a>
                                 <ul class="sub-menu">
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/business-experience-jp#tab1"><?php _e('打工換宿', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/business-experience-jp#tab2"><?php _e('企業徵才', 'dt_themes');?></a>
                                   </li>
                                 </ul>
																 <div class="dt-menu-expand">+</div>
                               </li>
                           </ul>
														<div class="lightbox" style="display:none;">
															<div class="liflex">
																<div class="msg">
																	<div class="litext">当サイトにお越し下さりありがとうございます。今後のサイト品質の向上のため、満足度に関するアンケートにご協力お願いいたします。またのご来訪を心よりお待ちしております。</div>
																	<div class="libtn">
																		<div class="notNow" onclick="closeModal()">今はやめろ</div>
																		<a class="survey btn" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/%E3%83%A6%E3%83%BC%E3%82%B6%E3%83%BC%E3%82%A2%E3%83%B3%E3%82%B1%E3%83%BC%E3%83%88/?survey=true">ユーザーアンケート</a>
																	</div>
																</div>
															</div>
														</div>
                             <?php
                           }elseif(ICL_LANGUAGE_CODE=='ko'){?>
                             <ul class="menu menu-toggle-open" id="menu-main-menu">
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item current_page_item menu-item-has-children menu-item-depth-0 menu-item-megamenu-parent megamenu-4-columns-group">
                                 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>"><?php _e('Home', 'dt_themes');?></a>
                               </li>
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-megamenu-parent megamenu-4-columns-group">
                                 <a href="#"><?php _e('Travel', 'dt_themes');?></a>
                                 <div class="megamenu-child-container">
                                   <ul class="sub-menu">
                                     <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1 menu-item-with-widget-area">
                                       <h4 class="header-title"><?php _e('Hotspot', 'dt_themes');?></h4>
                                       <div class="menu-item-widget-area-container">
                                         <ul>
                                           <li class="widget widget_recent_entries">
                                             <div class="recent-posts-widget">
                                               <ul>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/taitung-hot-air-balloon-ko/" rel="bookmark" title="<?php _e('臺東國際熱氣球嘉年華', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-ballon-3-1-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/taitung-hot-air-balloon-ko/" rel="bookmark" title="<?php _e('臺東國際熱氣球嘉年華', 'dt_themes'); ?>">
                                                      <?php _e('臺東國際熱氣球嘉年華', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/tiehua-music-village-ko/" rel="bookmark" title="<?php _e('鐵花村音樂聚落', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-tie-3-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/tiehua-music-village-ko/" rel="bookmark" title="<?php _e('鐵花村音樂聚落', 'dt_themes'); ?>">
                                                      <?php _e('鐵花村音樂聚落', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/taitung-forest-park-ko/" rel="bookmark" title="<?php _e('臺東森林公園', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-forest-3-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/taitung-forest-park-ko/" rel="bookmark" title="<?php _e('臺東森林公園', 'dt_themes'); ?>">
                                                      <?php _e('臺東森林公園', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/sansiantai-ko/" rel="bookmark" title="<?php _e('三仙台風景區', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-3station-1-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/sansiantai-ko/" rel="bookmark" title="<?php _e('三仙台風景區', 'dt_themes'); ?>">
                                                      <?php _e('三仙台風景區', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                               </ul>
                                             </div>
                                           </li>
                                         </ul>
                                       </div>
                                     </li>
                                     <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1 menu-item-with-widget-area">
                                       <a href="#" class="asdf">asdf</a>
                                       <div class="menu-item-widget-area-container">
                                         <ul>
                                           <li class="widget widget_recent_entries">
                                             <div class="recent-posts-widget">
                                               <ul>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/mr-brown-avenue-ko/" rel="bookmark" title="<?php _e('池上伯朗大道', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-cycle-4-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/mr-brown-avenue-ko/" rel="bookmark" title="<?php _e('池上伯朗大道', 'dt_themes'); ?>">
                                                      <?php _e('池上伯朗大道', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/international-surfing-competition-ko/" rel="bookmark" title="<?php _e('臺灣國際衝浪公開賽', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-surf-5-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/international-surfing-competition-ko/" rel="bookmark" title="<?php _e('臺灣國際衝浪公開賽', 'dt_themes'); ?>">
                                                      <?php _e('臺灣國際衝浪公開賽', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/daylily-flowers-blossom-season-taimali-ko/" rel="bookmark" title="<?php _e('臺東太麻里金針花季', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-flower-2-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/daylily-flowers-blossom-season-taimali-ko/" rel="bookmark" title="<?php _e('臺東太麻里金針花季', 'dt_themes'); ?>">
                                                      <?php _e('臺東太麻里金針花季', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                                 <li>
                                                   <a class="thumb" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/bombing-lord-handan-yuanxiao-festival-ko/" rel="bookmark" title="<?php _e('元宵節炮炸寒單爺', 'dt_themes'); ?>">
                                                    <img src="<?php echo WP_CONTENT_URL;?>/uploads/hot-pray-2-420x420.jpg">
                                                   </a>
                                                   <p>
                                                    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/bombing-lord-handan-yuanxiao-festival-ko/" rel="bookmark" title="<?php _e('元宵節炮炸寒單爺', 'dt_themes'); ?>">
                                                      <?php _e('元宵節炮炸寒單爺', 'dt_themes'); ?>
                                                    </a>
                                                  </p>
                                                 </li>
                                               </ul>
                                             </div>
                                           </li>
                                         </ul>
                                       </div>
                                     </li>
                                     <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1 menu-item-with-widget-area">
                                       <h4 class="header-title"><?php _e('景點', 'dt_themes');?></h4>
                                       <div class="menu-item-widget-area-container">
                                         <ul>
                                           <li class="widget widget_text">
                                             <div class="textwidget">
                                               <h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/downtown-taitung-ko/"><?php _e('台東市區', 'dt_themes');?></a></h6>
                                               <h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/provincial-highway-no-9-ko/"><?php _e('縱谷台9線', 'dt_themes');?></a></h6>
                                               <h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/provincial-highway-no-11-ko/"><?php _e('東海岸台11線', 'dt_themes');?></a></h6>
                                               <h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/provincial-highway-no-9-south-link-highway-ko/"><?php _e('台9線南迴山海', 'dt_themes');?></a></h6>
                                               <h6 class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1"><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/southern-cross-island-highway-ko/"><?php _e('南橫山線', 'dt_themes');?></a></h6>
                                             </div>
                                           </li>
                                         </ul>
                                        </div>
                                      </li>
                                     <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1 menu-item-with-widget-area">
                                       <h4 class="header-title"><?php _e('攻略', 'dt_themes');?></h4>
                                       <div class="menu-item-widget-area-container">
                                         <ul>
                                           <h6><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/24-hours-in-taitung-ko/"><?php _e('24小時駐足台東', 'dt_themes');?></a></h6>
                                           <h6><a class="48hr" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/#tab2"><?php _e('48小時駐足台東', 'dt_themes');?></a></h6>
                                           <li class="widget widget_text">
                                             <a class="header-a" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/48-hours-in-taitung-two-day-mountain-trip-ko/"><?php _e('山線二日遊', 'dt_themes');?></a>
                                           </li>
                                           <li class="widget widget_text">
                                             <a class="header-a" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/48-hours-in-taitung-two-day-east-coast-trip-ko/"><?php _e('海線二日遊', 'dt_themes');?></a>
                                           </li>
                                           <div class="dt-sc-hr-invisible-small"></div>
                                           <h6><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/hotspot/3-days-trip-in-taitung-ko/"><?php _e('72小時駐足台東', 'dt_themes');?></a></h6>
                                         </ul>
                                       </div>
                                       <h4 class="header-title"><?php _e('深度之旅', 'dt_themes');?></h4>
                                       <div class="menu-item-widget-area-container">
                                          <ul>
                                            <li class="widget widget_text">
                                              <div class="textwidget">
                                                <h6><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/agricultural-countryside-ko/"><?php _e('休閒農遊', 'dt_themes');?></a></h6>
                                                <h6><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/aboriginal-villages-ko/"><?php _e('臺東原住民部落', 'dt_themes');?></a></h6>
                                                <h6><a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/taiwan-island-ko/"><?php _e('離島', 'dt_themes');?></a></h6>
                                              </div>
                                            </li>
                                          </ul>
                                       </div>
                                     </li>
                                   </ul>
																	 <div class="dt-menu-expand">+</div>
                                 </div>
																 <div class="dt-menu-expand">+</div>
                               </li>
															 <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-megamenu-parent  megamenu-3-columns-group">
																 <a href="#"><?php _e('藝文饗宴', 'dt_themes');?></a>
																 <div class="megamenu-child-container">
																	 <ul class="sub-menu">
																		 <li class="menu-item-widget-area-container">
																			 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/exhibitions-ko/"><?php _e('藝文展覽', 'dt_themes');?></a>
																			 <ul>
						 														<li class="widget widget_text">
						 															<div class="textwidget">
																				    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/exhibitions-ko/"><img src="<?php echo WP_CONTENT_URL;?>/uploads/art-museum.jpg" alt="" title=""></a>
																			    </div>
																				</li>
																			</ul>
																		 </li>
																		 <li class="menu-item-widget-area-container">
																			 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/cultural-broadway-ko/"><?php _e('文化百老匯', 'dt_themes');?></a>
																			 <ul>
						 														<li class="widget widget_text">
						 															<div class="textwidget">
																				    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/cultural-broadway-ko/"><img src="<?php echo WP_CONTENT_URL;?>/uploads/art-broadway.jpg" alt="" title=""></a>
																			    </div>
																				</li>
																			</ul>
																		 </li>
																		 <li class="menu-item-widget-area-container">
																			 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/tiehua-music-village-ko/"><?php _e('鐵花村', 'dt_themes');?></a>
																			 <ul>
						 														<li class="widget widget_text">
						 															<div class="textwidget">
																				    <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/tiehua-music-village-ko/"><img src="<?php echo WP_CONTENT_URL;?>/uploads/art-tiehua.jpg" alt="" title=""></a>
																			    </div>
																				</li>
																			</ul>
																		 </li>
																	 </ul>
																	 <div class="dt-menu-expand">+</div>
																 </div>
																 <div class="dt-menu-expand">+</div>
															 </li>
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-simple-parent">
                                 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/sport-ko/"><?php _e('Sport', 'dt_themes');?></a>
                                 <ul class="sub-menu">
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/triathlon-taitungtaiwan-ko/"><?php _e('鐵人三項賽', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/marathon-taitungtaiwan-ko/"><?php _e('馬拉松', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/international-surfing-competition-ko/"><?php _e('國際衝浪賽', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/surfing-taitungtaiwan-ko/"><?php _e('衝浪', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/cycling-taitungtaiwan-ko/"><?php _e('自行車', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/paragliding-taitungtaiwan-ko/"><?php _e('飛行傘', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/scuba-diving-ko/"><?php _e('潛水', 'dt_themes');?></a>
                                   </li>
                                 </ul>
																 <div class="dt-menu-expand">+</div>
                               </li>
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-simple-parent">
                                 <a href="#"><?php _e('Transport', 'dt_themes');?></a>
                                 <ul class="sub-menu">
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/flights-taitungtaiwan-ko/"><?php _e('到台東旅行 – 航空', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-1">
                                     <a href="#"><?php _e('在台東旅行', 'dt_themes');?></a>
                                     <ul class="sub-menu">
                                       <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-2">
                                         <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/railway-taitungtaiwan-ko/"><?php _e('火車', 'dt_themes');?></a>
                                       </li>
                                       <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-2">
                                         <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/bus-taitungtaiwan-ko/"><?php _e('巴士', 'dt_themes');?></a>
                                       </li>
                                       <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-2">
                                         <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/driving-taitungtaiwan-ko/"><?php _e('自行開車', 'dt_themes');?></a>
                                       </li>
                                     </ul>
                                   </li>
                                   <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/island-transport-taiwan-ko/"><?php _e('離島交通', 'dt_themes');?></a>
                                   </li>
                                 </ul>
																 <div class="dt-menu-expand">+</div>
                               </li>
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-simple-parent">
                                 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-ko/"><?php _e('生活', 'dt_themes');?></a>
                                 <ul class="sub-menu">
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/international-news-taitungtaiwan-ko/"><?php _e('國際性的在地新聞', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/stories-of-expats-life-ko/"><?php _e('在地外籍人士故事', 'dt_themes');?></a>
                                   </li>
																	 <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-ko#tab1"><?php _e('영어 서비스 제공 관광지 안내', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-ko#tab2"><?php _e('當地治安狀況', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-ko#tab3"><?php _e('緊急事故電話及相關資訊', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-ko#tab4"><?php _e('出入境', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-ko#tab5"><?php _e('氣候', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-ko#tab6"><?php _e('教育', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/living-taitungtaiwan-ko#tab7"><?php _e('財務', 'dt_themes');?></a>
                                   </li>
                                 </ul>
																 <div class="dt-menu-expand">+</div>
                               </li>
                               <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-depth-0 menu-item-simple-parent">
                                 <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/business-experience-ko/"><?php _e('商務體驗', 'dt_themes');?></a>
                                 <ul class="sub-menu">
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/business-experience-ko#tab1"><?php _e('打工換宿', 'dt_themes');?></a>
                                   </li>
                                   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-depth-1">
                                     <a href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/business-experience-ko#tab2"><?php _e('企業徵才', 'dt_themes');?></a>
                                   </li>
                                 </ul>
																 <div class="dt-menu-expand">+</div>
                               </li>
                           </ul>
														<div class="lightbox" style="display:none;">
															<div class="liflex">
																<div class="msg">
																	<div class="litext">설문에 응답해주셔서 감사합니다. 고객 설문조사를 통해 더욱 나은 서비스를 제공해드리도록 노력하겠습니다. 저희 웹사이트에 방문해주셔서 감사합니다.</div>
																	<div class="libtn">
																		<div class="notNow" onclick="closeModal()">지금은 안돼.</div>
																		<a class="survey btn" href="<?php echo WP_SITEURL.ICL_LANGUAGE_CODE; ?>/%EB%A7%81%ED%81%AC%EC%82%AC%EC%9A%A9%EC%9E%90-%EC%9D%98%EA%B2%AC-%EC%A1%B0%EC%82%AC%ED%91%9C/?survey=true">링크사용자 의견 조사표</a>
																	</div>
																</div>
															</div>
														</div>
                             <?php
                           }
                           ?>
                            </nav>
                        </div>

                    </div>
				</header>
			</div><!-- header-wrapper ends here -->
