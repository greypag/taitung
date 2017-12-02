<?php get_header();

while(have_posts()): the_post();

//GETTING META VALUES...
$meta_set = get_post_meta($post->ID, '_sight_settings', true);
$page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : 'single-sight-layout-one';

//BEN ACF
$acf_summary = get_field('general_summary');
$acf_short_description = get_field('general_short_description');
$acf_map_display = get_field('general_map_display');
$acf_map_marker = get_field('general_map_marker_label');
$acf_location = get_field('general_location');
$acf_image = get_field('general_heading_img');

//BEN GMAP
$gmap_api_key='AIzaSyCfD4lD8fjxKHzfKABTJKPkuv-NNmV1mZI';

//BEN GMAP FOR GMAP CHINA
$client_ip = $_SERVER['REMOTE_ADDR'];

//BREADCRUMP...
get_template_part('includes/breadcrumb_section'); ?>

<div id="main">
	<section id="primary" class="content-full-width">
    <?php
if( !empty($acf_image) ): ?>
	<div class="heading-img" style="background-image:url('<?php echo $acf_image['url']; ?>');"></div>
<?php endif; ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('fullwidth-section'); ?>>
      <div class="container aligncenter">
        <?php
        if( !empty($acf_summary) ): ?>
        <h2 class="summary-box section-title"><?php echo $acf_summary; ?></h2>
        <?php endif; ?>
        <?php
        if( !empty($acf_short_description) ): ?>
        <h3 class="short-description-box"><?php echo $acf_short_description; ?></h3>
        <?php endif; ?>
      </div>
			<div class="container">
				<div class="portfolio-single"><?php

				//Checking the layouts...
				if($page_layout == "single-sight-layout-one"):
					include(dirname(__FILE__).'/inc/sight-single-layout-one.php');
				else:
					include(dirname(__FILE__).'/inc/sight-single-layout-two.php');
				endif; ?>
        </div>
      </div>
      <div class="container">




        <!-- <div id="map" style="width:100%;height:500px"></div> -->
				<?php
				if( !empty($acf_map_display) && $acf_map_display=='yes' ):
				?>
				<div class="gmap">
					<div class="marker" data-lat="<?php echo $acf_location['lat']; ?>" data-lng="<?php echo $acf_location['lng']; ?>"><?php echo $acf_map_marker; ?></div>
				</div>
				<style type="text/css">

				.gmap {
					width: 100%;
					height: 400px;
					border: #ccc solid 1px;
					margin: 20px 0;
          font-family: Roboto,Arial,sans-serif;
          font-weight: 400;
				}
				/* fixes potential theme css conflict */
				.gmap img {
				   max-width: inherit !important;
				}
				</style>
				<?php
				//ben 170411 start
				$client_details = json_decode(file_get_contents("http://ipinfo.io/json"));
				$gmap_api_key='AIzaSyCfD4lD8fjxKHzfKABTJKPkuv-NNmV1mZI';
				$gmap_lang=ICL_LANGUAGE_CODE;
				if($gmap_lang=='en'){
					$gmap_lang='en';
				}
				if($client_details->country=='CN'){
					wp_register_script('gmap', 'http://maps.google.cn/maps/api/js?language='.$gmap_lang.'&key='.$gmap_api_key,NULL,NULL,true);
				}else{
					wp_register_script('gmap', '//maps.googleapis.com/maps/api/js?language='.$gmap_lang.'&key='.$gmap_api_key,NULL,NULL,true);
				}
				wp_enqueue_script('gmap');
				//ben 170411 eof
				?>
				<script type="text/javascript">
				(function($) {

				/*
				*  new_map
				*
				*  This function will render a Google Map onto the selected jQuery element
				*
				*  @type	function
				*  @date	8/11/2013
				*  @since	4.3.0
				*
				*  @param	$el (jQuery element)
				*  @return	n/a
				*/

				function new_map( $el ) {

					// var
					var $markers = $el.find('.marker');


					// vars
					var args = {
						zoom		: 16,
						center		: new google.maps.LatLng(0, 0),
						mapTypeId	: google.maps.MapTypeId.ROADMAP
					};


					// create map
					var map = new google.maps.Map( $el[0], args);


					// add a markers reference
					map.markers = [];


					// add markers
					$markers.each(function(){

				    	add_marker( $(this), map );

					});


					// center map
					center_map( map );


					// return
					return map;

				}

				/*
				*  add_marker
				*
				*  This function will add a marker to the selected Google Map
				*
				*  @type	function
				*  @date	8/11/2013
				*  @since	4.3.0
				*
				*  @param	$marker (jQuery element)
				*  @param	map (Google Map object)
				*  @return	n/a
				*/

				function add_marker( $marker, map ) {

					// var
					var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

					// create marker
					var marker = new google.maps.Marker({
						position	: latlng,
						map			: map
					});

					// add to array
					map.markers.push( marker );

					// if marker contains HTML, add it to an infoWindow
					if( $marker.html() )
					{
						// create info window
						var infowindow = new google.maps.InfoWindow({
							content		: $marker.html()
						});

						// show info window when marker is clicked
						//google.maps.event.addListener(marker, 'click', function() {

							infowindow.open( map, marker );

						//});
					}

				}

				/*
				*  center_map
				*
				*  This function will center the map, showing all markers attached to this map
				*
				*  @type	function
				*  @date	8/11/2013
				*  @since	4.3.0
				*
				*  @param	map (Google Map object)
				*  @return	n/a
				*/

				function center_map( map ) {

					// vars
					var bounds = new google.maps.LatLngBounds();

					// loop through all markers and create bounds
					$.each( map.markers, function( i, marker ){

						var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

						bounds.extend( latlng );

					});

					// only 1 marker?
					if( map.markers.length == 1 )
					{
						// set center of map
					    map.setCenter( bounds.getCenter() );
					    map.setZoom( 16 );
					}
					else
					{
						// fit to bounds
						map.fitBounds( bounds );
					}


          // resize window center map marker
          google.maps.event.addDomListener(window, "resize", function() {
              var center = map.getCenter();
              google.maps.event.trigger(map, "resize");
              map.setCenter(center);
          });
				}

				/*
				*  document ready
				*
				*  This function will render each map when the document is ready (page has loaded)
				*
				*  @type	function
				*  @date	8/11/2013
				*  @since	5.0.0
				*
				*  @param	n/a
				*  @return	n/a
				*/
				// global var
				var map = null;

				$(document).ready(function(){
					$('.gmap').each(function(){
						// create map
						map = new_map( $(this) );
					});
				});

				})(jQuery);
				</script>

        <?php endif; ?>


				<div class="post-nav-container">
					<?php if(isset($p_meta_set['location'])){ ?>
						<?php } ?>
						<div class="prev-post">
							<?php
							previous_post_link('%link', '<span class="fa fa-angle-left"></span> '.__('Previous', 'dt_themes'));
							previous_post_link('%link', '<p>%title</p>'); ?>
						</div>
						<div class="next-post">
							<?php
							next_post_link('%link', __('Next', 'dt_themes').' <span class="fa fa-angle-right"></span>');
							next_post_link('%link', '<p>%title</p>'); ?>
						</div>
					</div>
					<div class="explore-hotspot"></div>
					<?php if(dt_theme_option('general', 'disable-sight-comment') != true && (isset($p_meta_set['comment']) != "")) {
						echo '<div class="dt-sc-hr-invisible"></div>';
						comments_template('', true);
					} ?>
					<div class="dt-sc-hr-invisible-small"></div>
				</div>
			</div>
		</div>
		<?php
		//Show related posts items...
		if(isset($meta_set['show-related-items']) != ""):

			$args = array('orderby' =>	'rand', 'post_type' => 'dt_sights', 'post__not_in' => array(get_the_ID()), 'posts_per_page' => 6);

			$the_query = new WP_Query($args);
			if($the_query->have_posts()): ?>
			<div class="fullwidth-section">
				<div class="dt-sc-portfolio-container"><?php
				while($the_query->have_posts()): $the_query->the_post();
				$terms = wp_get_post_terms($post->ID, 'sight_entries', array("fields" => "slugs")); array_walk($terms, "arr_strfun"); ?>

				<div class="portfolio dt-sc-one-fourth column no-space <?php strtolower(implode(" ", $terms)); ?>">
					<?php /*
					<figure><?php
					$fullimg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
					$currenturl = $fullimg[0];
					$currenticon = "fa-plus";
					$pmeta_set = get_post_meta($post->ID, '_sight_settings', true);
					if( @array_key_exists('items_thumbnail', $pmeta_set) && ($pmeta_set ['items_name'] [0] == 'video' )) {
						$currenturl = $pmeta_set ['items'] [0];
						$currenticon = "fa-video-camera";
					}
					//GALLERY IMAGES...
					if(has_post_thumbnail()):
						$attr = array('title' => get_the_title(), 'alt' => get_the_title());
						the_post_thumbnail('full', $attr);
					else: ?>
					<img src="http<?php dt_theme_ssl(true);?>://placehold.it/1170X878.jpg&text=<?php the_title(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /><?php
				endif; ?>
				<figcaption>
					<div class="fig-content-wrapper">
						<div class="fig-content">
							<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
							<p><?php echo get_the_term_list($post->ID, 'sight_entries', ' ', ', ', ' '); ?></p>
							<div class="fig-overlay">
								<a class="zoom" title="<?php the_title(); ?>" data-gal="prettyPhoto[sight]" href="<?php echo esc_url($currenturl); ?>"><span class="fa <?php echo esc_attr($currenticon); ?>"> </span></a>
								<a class="link" href="<?php the_permalink(); ?>"> <span class="fa fa-link"> </span> </a>
								<?php if(dt_theme_is_plugin_active('roses-like-this/likethis.php')): ?>
									<?php printLikes($post->ID); ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</figcaption>
			</figure>
			*/?>
				</div><?php
	endwhile; ?>
			</div>
		</div><?php
endif;
endif; ?>
	</section>
</div>
<div class="fullwidth"><div class="target-sight"></div></div>
<?php endwhile; ?>
<script type="text/javascript">
//jQuery('.top-image').detach().prependTo('.dt-sc-hr-invisible-top ');
//jQuery('#column_data.column.dt-sc-one-column.space.first').detach().prependTo('.dt-sc-hr-invisible-small-top');
jQuery('.fullwidth-section.test-field-buttom').detach().prependTo('.explore-hotspot');
jQuery('.sight-container').detach().prependTo('.target-sight');
</script>
<!-- <?php if(isset($p_meta_set['location'])){ ?>
	<script>
	function gMap() {
		var mapOptions = {
			zoom: 10
		}
		var map = new google.maps.Map(document.getElementById("map"), mapOptions);
		var geocoder = new google.maps.Geocoder();
		jQuery(function() {
			geocodeAddress(geocoder, map);
		});
	}
	function geocodeAddress(geocoder, resultsMap) {
		var address = "<?php echo $p_meta_set['location']; ?>";
		geocoder.geocode({'address': address}, function(results, status) {
			if (status === 'OK') {
				resultsMap.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: resultsMap,
					position: results[0].geometry.location
				});
				var placewindow = new google.maps.InfoWindow({
					content: "<?php echo $p_meta_set['location']; ?>"
				})
				placewindow.open(resultsMap, marker);
			} else {
				alert('Geocode was not successful for the following reason: ' + status);
			}
		});
	}
	</script>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCfD4lD8fjxKHzfKABTJKPkuv-NNmV1mZI&amp;callback=gMap"></script> -->
	<?php }?>
	<?php get_footer(); ?>
