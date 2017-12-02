(function() {


  // jQuery('body').on('click', '.play-btn', function() {
  //     console.log('START: Slider Revolution: landing-top - click');
  //
  //     var slide = jQuery(this).closest('li');
  //     vid = slide.find('.play-vdo').show();
  //     vid.find('video')[0].play();
  //     console.log('END: Slider Revolution: landing-top - click');
  //
  // });

  /*
  var vdoclick=0;

  jQuery('.rev_slider').on('click', function() {
   console.log('START: Slider Revolution: landing-top - click');
   //console.log(this);
  //var slide = jQuery(this).closest('video');
  var slide = jQuery(this).find('video');
  // console.log(slide);
  //slide.length();

  jQuery('.tp-fullwidth-forcer').height(jQuery('.rev_slider').find('video').height());
  jQuery('.rev_slider').height(jQuery('.rev_slider').find('video').height());
  jQuery('.tp-caption.tp-resizeme.fullscreenvideo.play-vdo.disabled_lc.tp-videolayer.HasListener').height(jQuery('.rev_slider').find('video').height());
  jQuery('.rev.slider.fullwidthabanner.revslider-initialised.tp-simpleresponsive').height(jQuery('.rev_slider').find('video').height());
  jQuery('.rev_slider_wrapper.fullwidthbanner-container').height(jQuery('.rev_slider').find('video').height());





   console.log('END: Slider Revolution: landing-top - click');

  });
  */

  // change the "revapi3" parts to whatever api name is used for your slider
  revapi3.on('revolution.slide.onload', function() {
    console.log('START: Slider Revolution: landing-top - onload');
    console.log(this);
    console.log('END: Slider Revolution: landing-top - onload');
  });

  revapi3.on('revolution.slide.onclick', function() {
    console.log('START: Slider Revolution: landing-top - onclick');
    console.log(this);
    console.log('END: Slider Revolution: landing-top - onclick');
  });

  revapi3.on('revolution.slide.onchange', function() {
      console.log('START: Slider Revolution: landing-top - onchange');
      console.log(this);
      //170210 start ben
      // jQuery('.tp-video-play-button').click(function() {
      //     var vdoh = jQuery(document).width() / 16 * 9;
      //     jQuery('.play-vdo').css('height', vdoh);
      //     jQuery('.tp-videolayer').css('height', vdoh);
      //     jQuery('.tp-fullwidth-forcer').css('height', vdoh);
      //     jQuery('#rev_slider_3_1').css('height', vdoh);
      // });
      // var vdoh = jQuery(document).width() / 16 * 9;
      var vdoh = 600;
      jQuery('.play-vdo').css('height', vdoh);
          jQuery('.tp-videolayer').css('height', vdoh);
          jQuery('.tp-fullwidth-forcer').css('height', vdoh);
          jQuery('#rev_slider_3_1').css('height', vdoh);
      //170210 eof ben
      console.log('END: Slider Revolution: landing-top - onchange');
  });


  jQuery('.tp-videolayer').click(function() {
      var vdoh = jQuery(document).width() / 16 * 9;
      // var vdoh = 600;

      jQuery('.play-vdo').css('height', vdoh);
      jQuery('.tp-videolayer').css('height', vdoh);
      jQuery('.tp-fullwidth-forcer').css('height', vdoh);
      jQuery('#rev_slider_3_1').css('height', vdoh);

      jQuery('.resizelistener').css('height', '100%');
  });
})();
