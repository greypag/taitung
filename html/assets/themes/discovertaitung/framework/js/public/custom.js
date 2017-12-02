jQuery.noConflict();
jQuery(document).ready(function($){

	"use strict";
	if( mytheme_urls.loadingbar === "enable") {
		if( mytheme_urls.linkedin === "enable") {
			$(window).load(function() {
				$(".cover").fadeOut("slow");
				$(".pace").remove();
			});
		} else {
			Pace.on("done", function(){
				$(".cover").fadeOut(500);
				$(".pace").remove();
			});
		}
	}

	var isMobile = (navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i)) || (navigator.userAgent.match(/Android/i)) || (navigator.userAgent.match(/Blackberry/i)) || (navigator.userAgent.match(/Windows Phone/i)) ? true : false;
	var $px, currentWidth;

	//Menu Start
	megaMenu();
	function megaMenu() {
		var screenWidth = $(document).width(),
		containerWidth = $("#header .container").width(),
		containerMinuScreen = (screenWidth - containerWidth)/2;
		if( containerWidth == screenWidth ){

			$px = 45;

			$("li.menu-item-megamenu-parent .megamenu-child-container").each(function(){

				var ParentLeftPosition = $(this).parent("li.menu-item-megamenu-parent").offset().left,
				MegaMenuChildContainerWidth = $(this).width();

				if( (ParentLeftPosition + MegaMenuChildContainerWidth) > screenWidth ){
					var SwMinuOffset = screenWidth - ParentLeftPosition;
					var marginFromLeft = MegaMenuChildContainerWidth - SwMinuOffset;
					var marginFromLeftActual = (marginFromLeft) + $px;
					var marginLeftFromScreen = "-"+marginFromLeftActual+"px";
					$(this).css('left',marginLeftFromScreen);
				}

			});
		} else {

			$px = 40;

			$("li.menu-item-megamenu-parent .megamenu-child-container").each(function(){
				var ParentLeftPosition = $(this).parent("li.menu-item-megamenu-parent").offset().left,
				MegaMenuChildContainerWidth = $(this).width();

				if( (ParentLeftPosition + MegaMenuChildContainerWidth) > containerWidth ){
					var marginFromLeft = ( ParentLeftPosition + MegaMenuChildContainerWidth ) - screenWidth;
					var marginLeftFromContainer = containerMinuScreen + marginFromLeft + $px;

					if( MegaMenuChildContainerWidth > containerWidth ){
						var MegaMinuContainer	= ( (MegaMenuChildContainerWidth - containerWidth)/2 ) + 10;
						var marginLeftFromContainerVal = marginLeftFromContainer - MegaMinuContainer;
						marginLeftFromContainerVal = "-"+marginLeftFromContainerVal+"px";
						$(this).css('left',marginLeftFromContainerVal);
					} else {
						marginLeftFromContainer = "-"+marginLeftFromContainer+"px";
						$(this).css('left',marginLeftFromContainer);
					}
				}

			});
		}
	}

	//Menu Hover Start
	function menuHover() {
		$("li.menu-item-depth-0,li.menu-item-simple-parent ul li" ).hover(
			function(){
				if( $(this).find(".megamenu-child-container").length  ){
					$(this).find(".megamenu-child-container").stop().fadeIn('fast');
				} else {
					$(this).find("> ul.sub-menu").stop().fadeIn('fast');
				}
			},
			function(){
				if( $(this).find(".megamenu-child-container").length ){
					$(this).find(".megamenu-child-container").stop(true, true).hide();
				} else {
					$(this).find('> ul.sub-menu').stop(true, true).hide();
				}
			}
		);
	}//Menu Hover End

	//OnePage Navigation
	if( $(".onepage_menu").length) {
	    $('.onepage_menu').onePageNav({
			currentClass: 'current_page_item',
    	    filter: ':not(.external)',
	        scrollSpeed: 750,
    	    scrollOffset: 90
	    });
	}

	//Sticky Navigation
	// if( navigator.platform.match(/(Mac|iPhone|iPod|iPad)/i) ||
	// 	navigator.userAgent.match(/Android/i)||
	// 	navigator.userAgent.match(/webOS/i) ||
	// 	navigator.userAgent.match(/iPhone/i) ||
	// 	navigator.userAgent.match(/iPod/i)) {
	// 		if( mytheme_urls.stickynav === "enable") {
	// 			$("#header-wrapper").sticky({ topSpacing: 0 });
	// 		}
	// } else {
	// 	if( mytheme_urls.stickynav === "enable") {
	// 		$("#header-wrapper").sticky({ topSpacing: 0 });
	// 	}
	// }
	$("#header-wrapper").stick_in_parent();
	//Sticky Navigation End

	//Mobile Menu
	$("#dt-menu-toggle").click(function( event ){
		event.preventDefault();
		var $menu = $("nav#main-menu").find("ul.menu:first");
		$menu.slideToggle(function(){
			$menu.css('overflow' , 'visible');
			$menu.toggleClass('menu-toggle-open');
		});
	});

	$(".dt-menu-expand").click(function(){
		if( $(this).hasClass("dt-mean-clicked") ){
			$(this).text("+");
			if( $(this).prev('ul').length ) {
				$(this).prev('ul').slideUp(300);
			} else {
				$(this).prev('.megamenu-child-container').find('ul:first').slideUp(300);
			}
		} else {
			$(this).text("-");
			if( $(this).prev('ul').length ) {
				$(this).prev('ul').slideDown(300);
			} else{
				$(this).prev('.megamenu-child-container').find('ul:first').slideDown(300);
			}
		}

		$(this).toggleClass("dt-mean-clicked");
		return false;
	});

	if( !isMobile ){
		currentWidth = window.innerWidth || document.documentElement.clientWidth;
		if( currentWidth > 767 ){
			menuHover();
		}
	}
	//Mobile Menu End
//Menu End

	//NICE SCROLL...
	if( $(window).width() > 767 && ! navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/) && ! navigator.platform.match(/(Mac|iPhone|iPod|iPad)/i)) {
		$("html").niceScroll({
			zindex: 999999,
			cursorborder: "1px solid #424242"
		});
	}

	//TEXTBOX CLEAR...
	$('input.Textbox, textarea.Textbox').focus(function() {
      if (this.value === this.title) {
        $(this).val("");
      }}).blur(function() {
      if (this.value === "") {
        $(this).val(this.title);
      }
    });

	//UI TO TOP PLUGIN...
	$().UItoTop({ easingType: 'easeOutQuart' });

	//Portfolio Tooltip...
	if($(".portfolio .fig-overlay a.likeThis").length){
		$(".portfolio .fig-overlay a.likeThis").each(function(){
			$(this).tooltipster({
                content: $(this).html()
			});
		});
	}

	$("select").each(function(){
		if($(this).css('display') != 'none') {
			$(this).wrap( '<div class="selection-box"></div>' );
		}
	});

	//DONUT CHART...
	$('.donutChart').each(function(){
		$(this).one('inview', function (event, visible) {
			if(visible === true) {
				var bgcolor, fgcolor = "";

				if($(this).attr('data-bgcolor') !== "") bgcolor = $(this).attr('data-bgcolor'); else bgcolor = '#f5f5f5';
				if($(this).attr('data-fgcolor') !== "") fgcolor = $(this).attr('data-fgcolor'); else fgcolor = '#E74D3C';

				$(this).donutchart({'size': 140, 'donutwidth': 10, 'fgColor': fgcolor, 'bgColor': bgcolor, 'textsize': 45 });
				$(this).donutchart('animate');
			}
		});
	});


	$(window).smartresize(function(){

		megaMenu();

		//Mobile Menu
		currentWidth = window.innerWidth || document.documentElement.clientWidth;
		if( !isMobile && (currentWidth > 767)  ){
			menuHover();
		}

		// dt_smartresize_block();
	});

	//All Query Block...
$(window).load(function(){
	dt_smartresize_block();

	if($(".carousel_items").length) {

		console.log("carousel_items");
		$(".carousel_items .dt_carousel").each(function(){
			$(this).carouFredSel({
			responsive: true,
			auto: false,
			width: '100%',
			prev: $(this).next('.carousel-arrows').find('.prev-arrow'),
			next: $(this).next('.carousel-arrows').find('.next-arrow'),
			height: 'auto',
			scroll: 1,
			items: { width: $(this).find('.column').width(),  visible: { min: 1, max: parseInt($(this).attr('data-items')) } }
			});
		});
	}
});

    //PrettyPhoto...
    var $pphoto = $('a[data-gal^="prettyPhoto[gallery]"]');
    if ($pphoto.length) {
        //PRETTYPHOTO...
        $("a[data-gal^='prettyPhoto[gallery]']").prettyPhoto({
			hook:'data-gal',
            show_title: false,
            social_tools: false,
            deeplinking: false
        });
    }

    //Gallery CarouFredSel...
	if( ($(".gallery-bx-wrapper").length) && ($(".gallery-bx-wrapper li").length > 1) ) {
		$('.gallery-bx-wrapper').bxSlider({ auto:false, video:true, useCSS:false, autoHover:true, adaptiveHeight:true, pagerCustom: '#entry-gallery-pager' });
	}
	if( ($(".gallery-bx-wrapper-2").length) && ($(".gallery-bx-wrapper-2 li").length > 1) ) {
		$('.gallery-bx-wrapper-2').bxSlider({ auto:false, video:true, useCSS:false, autoHover:true, adaptiveHeight:true, pagerCustom: '#entry-gallery-pager-2' });
	}
	//Fitvids...
	$("div.dt-video-wrap").fitVids();
	$('.wp-video').css('width', '100%');

	//Gallery Blog Slider...
    if( ($("ul.entry-gallery-post-slider").length) && ( $("ul.entry-gallery-post-slider li").length > 1 ) ){
     $("ul.entry-gallery-post-slider").bxSlider({ auto:false, video:true, useCSS:false, autoHover:true, adaptiveHeight:true, pagerCustom: '#entry-gallery-pager' });
    }

	//Parallax Sections...
	$('.dt-sc-parallax-section').bind('inview', function (event, visible) {
		if(visible === true) {
			$(this).parallax("50%", 0.5);
		} else {
			$(this).css('background-position', '');
		}
	});

	//Animate Number...
	$('.dt-sc-num-count').each(function(){
	  $(this).one('inview', function (event, visible) {
		  if(visible === true) {
			  var val = $(this).attr('data-value');
			  $(this).animateNumber({ number: val	}, 2000);
		  }
	  });
	});

	//Ajax Load Gallery Items...
	var $page = 0;
	var $data = "", $el = $('#ajax_load_gallery_container'), $content = $('.dt-sc-portfolio-container', $el);

	$('#ajax_load_gallery').click(function(){

      var $noPosts = $(this).attr('data-per-page');
	  var $tax = $(this).attr('data-taxonomy');
	  var $liClass = $(this).attr('data-li-class');

	  $(this).addClass('loading');
	  $page++;

	  //Perform ajax loads...
      $.ajax({
         type : "post",
         dataType : "html",
         url : mytheme_urls.ajaxurl,
         data : { action: "dt_ajax_load_gallery_posts", numPosts : $noPosts, tax : $tax, pageNumber: $page, liClass: $liClass },
         success: function (data) {
			$data = $(data);
			if ($data.length > 0) {
                $content.append($data);
				//$('.dt-sc-portfolio-container').isotope( 'reloadItems' ).isotope();
				$(window).trigger( 'resize' );

				$("a[data-gal^='prettyPhoto[gallery]']").prettyPhoto({
					show_title: false,
					social_tools: false,
					deeplinking: false
				});
				$(".portfolio .fig-overlay a.likeThis").each(function(){
					$(this).tooltipster({
						content: $(this).html()
					});
				});
			} else {
				$('#ajax_load_gallery').html('<span></span>No More Posts to Show');
				$('#ajax_load_gallery').attr('disabled', 'disabled');
			}
			$('#ajax_load_gallery').removeClass('loading');
         },
		 error: function (jqXHR, textStatus, errorThrown) {
			$('#ajax_load_gallery').html('<span></span>No More Posts to Show');
		 }
      });
	  return false;
	});

	//Rating Script...
	$("#dt-rating").hide().before('<p class="stars"><span><a class="star-1" href="#">1</a><a class="star-2" href="#">2</a><a class="star-3" href="#">3</a><a class="star-4" href="#">4</a><a class="star-5" href="#">5</a></span></p>');
	$("body").on("click", "#commentform p.stars a", function () {
        var b = $(this),
            c = $(this).closest("#commentform").find("#dt-rating");
        return c.val(b.text()), b.siblings("a").removeClass("active"), b.addClass("active"), !1
    });

	//Lightbox map...
	if($(".btn-place-review").length) {
		$('#respond').wrap('<div id="dt-sc-respond-wrapper" class="hide"></div>');
		$('.btn-place-review').colorbox({ inline:true, width:"auto" });
	}

	//Events overlay insert...
	$('.tribe-events-event-image').each(function(){
		$(this).find('a').append('<div class="image-overlay"><span class="image-overlay-inside"></span></div>');
	});

	//Image Map Pointer...
	if($(".dt-sc-map-tooltip").length){
		$(".dt-sc-map-tooltip").each(function(){ $(this).tipTip({maxWidth: "auto", defaultPosition: "bottom"}); });
	}
	if($(".dt-map-pointer").length) {
		$(".dt-map-pointer").fancybox({
			scrolling: 'no',
			width: 'auto',
			height: 'auto'
		});
	}

	//NEWSLETTER AJAX SUBMIT...
	$('form[name="frmsubscribe"]').on('submit', function () {

		var $this = $(this);
		var $mc_email = $this.find('#dt_mc_emailid').val(),
			$mc_apikey = $this.find('#dt_mc_apikey').val(),
			$mc_listid = $this.find('#dt_mc_listid').val();

		$.ajax({
			type: "POST",
			url: mytheme_urls.ajaxurl,
			data:
			{
				action: 'dt_theme_mailchimp_subscribe',
				mc_email: $mc_email,
				mc_apikey: $mc_apikey,
				mc_listid: $mc_listid
			},
			success: function (response) {
				$this.parent().find('#ajax_newsletter_msg').html(response);
				$this.parent().find('#ajax_newsletter_msg').slideDown('slow');
				if (response.match('success') != null) $this.slideUp('slow');
			}
		});

		return false;

    });
});

// ANUMATE CSS + JQUERY INVIEW CONFIGURATION
(function ($) {
    "use strict";
    $(".animate").each(function () {
        $(this).bind('inview', function (event, visible) {
            var $delay = "";
            var $this = $(this),
                $animation = ($this.data("animation") !== undefined) ? $this.data("animation") : "slideUp";
            $delay = ($this.data("delay") !== undefined) ? $this.data("delay") : 300;

            if (visible === true) {
                setTimeout(function () {
                    $this.addClass($animation);
                }, $delay);
            } else {
                setTimeout(function () {
                    $this.removeClass($animation);
                }, $delay);
            }
        });
    });
})(jQuery);

//Responsive Purpose...
function dt_smartresize_block() {
	"use strict";

	var $container = jQuery('.dt-sc-portfolio-container');
	var $gw;

	if (jQuery('.dt-sc-portfolio-container .portfolio').hasClass('no-space')) { $gw = 0; }
  jQuery('.dt-sc-sorting-container a').click(function () {
  	jQuery('.dt-sc-sorting-container').find('a').removeClass('active-sort');
  	jQuery(this).addClass('active-sort');

		var selector = jQuery(this).attr('data-filter');
		$container.isotope({
			filter: selector,
			animationOptions: {
				duration: 750,
				easing: 'linear'
			},
			itemSelector: '.dt-sc-portfolio-container .portfolio',
			masonry: {
				gutterWidth: 0
			}
		});
		return false;
	});

	jQuery('.dt-sc-entry-sorting a').click(function () {
		jQuery('.dt-sc-entry-sorting').find('a').removeClass('active_sort');
		jQuery(this).addClass('active_sort');

		var selector = jQuery(this).attr('data-filter');
		jQuery('.dt-sc-hotels-container').isotope({
			filter: selector,
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false
			},
			itemSelector: '.dt-sc-hotels-container .column',
			masonry: {
				gutterWidth: 0
			}
		});
		return false;
	});

	if ($container.length) {
    if(jQuery("body").hasClass("lang-zh-hant")){
  		$container.isotope({
  			filter: '.page_category-102',
  			itemSelector: '.dt-sc-portfolio-container .portfolio',
  			masonry: {
  				gutterWidth: 0
  			}
  		});
    }else if(jQuery("body").hasClass("lang-zh-hans")){
  		$container.isotope({
  			filter: '.page_category-123',
  			itemSelector: '.dt-sc-portfolio-container .portfolio',
  			masonry: {
  				gutterWidth: 0
  			}
  		});
    }else if(jQuery("body").hasClass("lang-en")){
  		$container.isotope({
  			filter: '.page_category-149',
  			itemSelector: '.dt-sc-portfolio-container .portfolio',
  			masonry: {
  				gutterWidth: 0
  			}
  		});
    }else if(jQuery("body").hasClass("lang-ja")){
  		$container.isotope({
  			filter: '.page_category-150',
  			itemSelector: '.dt-sc-portfolio-container .portfolio',
  			masonry: {
  				gutterWidth: 0
  			}
  		});
    }else if(jQuery("body").hasClass("lang-ko")){
  		$container.isotope({
  			filter: '.page_category-151',
  			itemSelector: '.dt-sc-portfolio-container .portfolio',
  			masonry: {
  				gutterWidth: 0
  			}
  		});
    }
	}

	if( jQuery(".blog-isotope-wrapper").length ){
		$gw = 20; if(jQuery(".container").width() == 710) { $gw = 15; }
		jQuery(".blog-isotope-wrapper").isotope({
			itemSelector : '.column',
			transformsEnabled: false,
			masonry: {
				gutterWidth: $gw
			}
		});
	}

	if( jQuery('.dt-sc-hotels-container').length ) {
		jQuery('.dt-sc-hotels-container').isotope({
			filter: '*',
			itemSelector : '.dt-sc-hotels-container .dt-sc-one-column',
			masonry: {
				gutterWidth: 0
			}
		});
	}
}
