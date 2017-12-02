// START BEN
function resizeIsotopeImg(){
  if((jQuery(window).width())/3-jQuery('.portfolio figure img').width()>0){
    jQuery('.portfolio figure img').width((jQuery(window).width()+17)/3);
  }
}

function applySamePriceTableHeight(){
  jQuery(".dt-sc-tb-content").height(null);
  var heights=jQuery(".dt-sc-tb-content").map(function(){
        return jQuery(this).height();
    }).get(),
    maxHeight=Math.max.apply(null,heights);
    jQuery(".dt-sc-tb-content").height(maxHeight);
}
// END BEN

jQuery(document).ready(function(){
  jQuery(".icon-button").append("<i class='fa fa-info-circle' style='margin-left: 10px;'></i>");

  // jQuery(".font-awesome").append("<i class='fa fa-arrows-h' aria-hidden='true'></i><i class="fa fa-map-marker" aria-hidden="true"></i>");
  // START BEN
  resizeIsotopeImg();
  applySamePriceTableHeight();
  // END BEN

  // START BEN
  // Javascript to enable link to tab
  var hash = document.location.hash;
  var prefix = "";
  var offTop = jQuery('.breadcrumb-wrapper').height()+jQuery('.heading-img').height();


  if (!(jQuery("body").hasClass("home"))) {
    if (hash) {
      console.log('Javascript to enable link to tab');
       jQuery("html, body").animate({ scrollTop: 0 }, "fast");
    }

    // Change hash for page-reload
    jQuery('.dt-sc-tabs-vertical-frame a').click(function(e) {
      console.log('Change hash for page-reload');
      window.location.hash = e.target.hash.replace("#", "#" + prefix);
      jQuery("html, body").animate({ scrollTop: 0}, "fast");

    });
  }
  // END BEN

  // START BEN 170214
  if(jQuery("body").hasClass("lang-zh-hant")){
    jQuery(".isotope-id-102").addClass("first").addClass("active-sort");
  }else if(jQuery("body").hasClass("lang-zh-hans")){
    jQuery(".isotope-id-123").addClass("first").addClass("active-sort");
  }else if(jQuery("body").hasClass("lang-en")){
    jQuery(".isotope-id-149").addClass("first").addClass("active-sort");
  }else if(jQuery("body").hasClass("lang-ja")){
    jQuery(".isotope-id-150").addClass("first").addClass("active-sort");
    jQuery(".isotope-id-193").removeClass("first").removeClass("active-sort");
  }else if(jQuery("body").hasClass("lang-ko")){
    jQuery(".isotope-id-151").addClass("first").addClass("active-sort");
  }
  // END BEN 170214


  // START BEN 170222
  // reorder isotope
  //en
  jQuery(".isotope-id-240").before(jQuery(".isotope-id-149"));
  jQuery(".isotope-id-240").before(jQuery(".isotope-id-188"));

  //ja
  jQuery(".isotope-id-193").before(jQuery(".isotope-id-150"));
  jQuery(".isotope-id-193").before(jQuery(".isotope-id-189"));
  jQuery(".isotope-id-193").before(jQuery(".isotope-id-241"));

  //ko

  jQuery(".isotope-id-242").before(jQuery(".isotope-id-190"));

  // END BEN 170222
});

// START BEN
jQuery(window).resize(function() {
  resizeIsotopeImg();
  applySamePriceTableHeight();
});
// END BEN


// START ben 170222
// Open External Links In New Window
jQuery('.wrapper a').each(function() {
   var a = new RegExp('/' + window.location.host + '/');
   if(!a.test(this.href)) {
       jQuery(this).click(function(event) {
           event.preventDefault();
           event.stopPropagation();
           window.open(this.href, '_blank');
       });
   }
});
// Open External Links In New Window
// END ben 170222

// START leon 170224
jQuery(document).ready(function(){
  if (jQuery("body").hasClass("page-id-9241")) {
    jQuery(".banner").appendTo(".fullwidth-background");
  }else if (jQuery("body").hasClass("page-id-11093")) {
    jQuery(".banner").appendTo(".fullwidth-background");
  }else if (jQuery("body").hasClass("page-id-11094")) {
    jQuery(".banner").appendTo(".fullwidth-background");
  }else if (jQuery("body").hasClass("page-id-11095")) {
    jQuery(".banner").appendTo(".fullwidth-background");
  }else if (jQuery("body").hasClass("page-id-11096")) {
    jQuery(".banner").appendTo(".fullwidth-background");
  }else if (jQuery("body").hasClass("page-id-9263")) {
    jQuery(".banner").appendTo(".fullwidth-background");
  }else if (jQuery("body").hasClass("page-id-10874")) {
    jQuery(".banner").appendTo(".fullwidth-background");
  }else if (jQuery("body").hasClass("page-id-10875")) {
    jQuery(".banner").appendTo(".fullwidth-background");
  }else if (jQuery("body").hasClass("page-id-10876")) {
    jQuery(".banner").appendTo(".fullwidth-background");
  }else if (jQuery("body").hasClass("page-id-10877")) {
    jQuery(".banner").appendTo(".fullwidth-background");
  }
});
  // jQuery(".48hr").click(function(){
  //   jQuery("html, body").animate({
  //     scrollTop: (jQuery('.strategy').offset().top)
  //   }, 500);
  // });
// leon make 48hr clickable
jQuery(document).ready(function(){
  if (jQuery("body").hasClass("home")) {
    // Javascript to enable link to tab
    var hash = document.location.hash;

    if (hash) {
      console.log('Javascript to enable link to tab 2');
      jQuery("html, body").animate({ scrollTop: (jQuery('.strategy').offset().top)}, 500);
    }


    var prefix = "";

    jQuery('.48hr').click(function(e) {
      console.log('Change hash for page-reload 2');
      window.location.hash = e.target.hash.replace("#", "#" + prefix);
      jQuery("html, body").animate({ scrollTop: (jQuery('.strategy').offset().top) }, 500);
      jQuery('#tab1').css("display", "none");
      jQuery('#tab2').css("display", "block");
    });
  }
  // setTimeout(function(){ jQuery("html, body").animate({ scrollTop: (jQuery('.strategy').offset().top)-200 }, 500); }, 1500);
});
// END leon 170224

// START Roma 170425
// lightbox
function createCookie(name, value, expires, path, domain) {
  var cookie = name + "=" + escape(value) + ";";

  if (expires) {
    // If it's a date
    if(expires instanceof Date) {
      // If it isn't a valid date
      if (isNaN(expires.getTime()))
       expires = new Date();
    }
    else
			expires = new Date(new Date().getTime() + parseInt(expires) * 1000 * 60 * 60 * 24);

    cookie += "expires=" + expires.toGMTString() + ";";
  }

  if (path)
    cookie += "path=" + path + ";";
  if (domain)
    cookie += "domain=" + domain + ";";

  document.cookie = cookie;
}
function deleteCookie(name, path, domain) {
  // If the cookie exists
  if (getCookie(name))
    createCookie(name, "", -1, path, domain);
}
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function getQueryStringValue (key) {
  return decodeURIComponent(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + encodeURIComponent(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
}

function closeModal() {
	jQuery('.lightbox').hide();
	createCookie("showSurveyPopUp","false",120,"/");
}
function popUp(){
	jQuery('.lightbox').show();
}

jQuery(window).load(function(){
	if(!getCookie("showSurveyPopUp")){
		if(!getQueryStringValue("survey")){
			setTimeout(function(){popUp()},300000);
		}
	}
});
//END Roma 170426
