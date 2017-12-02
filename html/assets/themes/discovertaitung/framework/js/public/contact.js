jQuery.noConflict();

jQuery(document).ready(function($){
	"use strict";
	
	if($(".btn-book").length) {
		$(".btn-book").colorbox({ inline:true, width:"auto" });
		
		$(".btn-book").each(function(){
			$(this).click(function(){
				$('#hidhotelname').val($(this).attr('data-title'));
			});
		});
	}
	
	if($(".contact-frm").length) {
		$(".contact-frm").validate({
		  onfocusout: function(element){ $(element).valid(); },
			rules: { 
				cname: { required: true, minlength: 2 },
				cemail: { required: true, email: true },
				cmessage: { required: true, minlength: 10 },
				txtcap: { required: true, minlength: 4, equalTo: "#txthidcap" }
			}
		});
	}
	
	if($(".booknow-frm").length) {
		$(".booknow-frm").validate({
			onfocusout: function(element){ $(element).valid(); },
			debug: true,
			rules: {
				txtfname: { required: true, minlength: 2 },
				txtemail: { required: true, email: true },
				txtdate: { required: true }
			}
		});
	}
	
	//AJAX SUBMIT...
	$('.contact-frm, .booknow-frm').submit(function () {
      
		var This = $(this);
        var data_value = null;
		
		if($(This).valid()) {
			var action = $(This).attr('action');

			data_value = decodeURI($(This).serialize());
			$.ajax({
                 type: "POST",
                 url:action,
                 data: data_value,
                 success: function (response) {
                   $('#ajax_message').html(response);
                   $('#ajax_message').slideDown('slow');
                   if (response.match('success') !== null){ $(This).slideUp('slow'); }
                 }
            });
        }
        return false;
    });
});

function initMap() {
	// Hotel & Place google map...
	jQuery('.list-hotel-map').each(function(){
		if(jQuery(this).length) {
			var map, eid, $lat, $lng, $add;
			
			eid = jQuery(this).attr('id');
			$lat = jQuery(this).attr('data-lt');
			$lng = jQuery(this).attr('data-lg');
			$add = jQuery(this).attr('data-add')

			map = new google.maps.Map(document.getElementById(eid), {
	          center: { lat: parseFloat($lat), lng: parseFloat($lng) },
    	      zoom: 19
        	});
			
			var marker = new google.maps.Marker({
	          position: { lat: parseFloat($lat), lng: parseFloat($lng) },
    	      map: map,
        	  title: $add
	        });

			var infowindow = new google.maps.InfoWindow({
	          content: $add
	        });
			
			marker.addListener('click', function() {
	          infowindow.open(map, marker);
    	    });
		}
	});
}