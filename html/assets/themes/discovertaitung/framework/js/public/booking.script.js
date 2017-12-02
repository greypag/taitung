jQuery.noConflict();
jQuery(document).ready(function($){
	
	var dformat = 'yy-mm-dd';
	
	$('#open_datepicker').datepicker({
		dateFormat: dformat,
		minDate: 0,
		numberOfMonths: 2,
		beforeShowDay: function(date) {
			var d1 = $.datepicker.parseDate(dformat, $("#txtcheckindate").val());
			var d2 = $.datepicker.parseDate(dformat, $("#txtcheckoutdate").val());
			return [true, d1 && ((date.getTime() == d1.getTime()) || (d2 && date >= d1 && date <= d2)) ? "ui-state-active" : ""];
		},
		onSelect: function(dateText, inst) {
			var dateTextForParse = (inst.currentMonth + 1) + '/' + inst.currentDay + '/' + inst.currentYear;
			var date1 = $.datepicker.parseDate(dformat, $("#txtcheckindate").val());
			var date2 = $.datepicker.parseDate(dformat, $("#txtcheckoutdate").val());
			if (!date1 || date2) {
				$("#txtcheckindate").val(dateText);
				$("#txtcheckoutdate").val("");
			} else {
				if(Date.parse(dateTextForParse) < Date.parse(date1))
				{
					$("#txtcheckindate").val(dateText);
					$("#txtcheckoutdate").val("");
				}
				else
				{
					$("#txtcheckoutdate").val(dateText);
				}
			}
		}
	});
	
	$('#frmbooking #subfind').click(function(e){
		var indate = $('#txtcheckindate').val();
		var outdate = $('#txtcheckoutdate').val();
		
		if(indate !== '' && outdate !== '') {
			if(indate !== outdate) {
				return true;
			} else {
				alert('Check In & Check Out Dates Cannot be on Same Day.');
				$('#txtcheckindate').effect("pulsate", { times:2 }, 400);
				$('#txtcheckoutdate').effect("pulsate", { times:2 }, 400);
			}
		} else {
			$('#txtcheckindate').val('');
			$('#txtcheckoutdate').val('');
			$(".ui-datepicker-calendar").effect("pulsate", { times:2 }, 400);
			$(".calendar-notice").fadeIn(1200, function() {
				// Animation complete
			});
			return false;
		}
		e.preventDefault();

	});
	
	// Calendar Message
	$(".datepicker").click(function(e){
		$(".ui-datepicker-calendar").effect("pulsate", { times:2 }, 400);
		$(".calendar-notice").fadeIn(1200, function() {
			// Animation complete
		});
		e.stopPropagation();
	});
	
	$('input.rdopayment:first').next('.dt-sc-warning-box').hide();
	
	$("input.rdopayment").on("click", function() {
		var n = $("input.rdopayment:checked").val();

		$('.dt-sc-warning-box').slideUp(500);

		if(n == 'Pay with PayPal') {
			$('.dt-sc-payarrival-wrapper').slideUp(1000);
		}
		else if(n == 'Pay on Arrival') {
			$('.dt-sc-payarrival-wrapper').slideDown(1000);
		}
		$(this).next('.dt-sc-warning-box').slideDown(500);
	});
	
	// Locaton autocomplete
	$('#txtlocation').autocomplete({
		source: function( request, response ) {
			$.ajax({
				url : mytheme_urls.ajaxurl,
				dataType: "json",
				data: {
				   action: "dt_ajax_load_location_terms",
				   name_startsWith: request.term
				},
				 success: function( data ) {
					 response( $.map( data, function( item ) {
						var code = item.split("|");
						return {
							label: code[0],
							value: code[0],
							data : item
						}
					}));
				}
			});
		},
		autoFocus: true,
		minLength: 1,
		select: function( event, ui ) {
			var code = ui.item.data.split("|");
			$(this).next('input').val(code[1]);
		}
	});
	
	// Checkout Form Validation
	if($("#frmhotelcheckout").length) {
		$("#frmhotelcheckout").validate({
		  onfocusout: function(element){ $(element).valid(); },
			rules: { 
				txtfirstname: { required: true, minlength: 2 },
				txtlastname: { required: true, minlength: 2 },
				txtemailaddress: { required: true, email: true },
				txtphone: { required: true },
				txtaddress1: { required: true },
				txtcity: { required: true },
				txtstate: { required: true },
				txtzipcode: { required: true },
				txtcountry: { required: true }
			}
		});
	}

	$('#frmhotelcheckout input[type="checkbox"]').click(function(){

		var data_value = unescape($('#frmhotelcheckout').serialize());

		$.ajax({
		   type : "post",
		   dataType : "html",
		   url : mytheme_urls.ajaxurl,
		   data : data_value + '&action=dt_theme_checkout_calculation',
		   dataType: 'json',
		   success: function( data ) {
			   $.map( data, function( item ) {
				  var code = item.split("|");
				  $('#dt-netamount').html(code[0]);
				  $('#dt-depositamount').html(code[1]);
			  });
		   },
		   error: function (jqXHR, textStatus, errorThrown) {
			  $('#rangeInlinePicker').html('Sorry Rooms not Loading...');
		   }
		});
	});

});