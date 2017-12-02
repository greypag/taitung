jQuery.noConflict();
jQuery(document).ready(function($){
	
	var x;
	if($('#txtunavaildates').length) {
		x = $('#txtunavaildates').val();
		x = x.split(',');
	}
	
	var dformat = 'dd-mm-yy';
	
	$('#cmbhotels').change(function(){
		
		//Destroy Date Picker initial...
		$('#rangeInlinePicker').datepicker('destroy');
		
		var hotel_id = $(this).val();
		if(hotel_id !== '') {
			$.ajax({
			   type : "post",
			   dataType : "html",
			   url : dtThemeAjax.ajax_url,
			   data : {action: "dt_theme_hbroom_available_lists", hotel_id : hotel_id},
			   success: function (res) {
				   if(res.length) {
					  $('#roomtype').html(res);
		           }
			   },
			   error: function (jqXHR, textStatus, errorThrown) {
				  $('#rangeInlinePicker').html('Sorry Rooms not Loading...');
			   }
			});
		}
	});
	
	$('#roomtype').change(function(){
		
		//Destroy Date Picker initial...
		$('#rangeInlinePicker').datepicker('destroy');

		var hotel_id = $('#cmbhotels').val();
		var room_id = $(this).val();
		if(room_id !== '') {
			$.ajax({
			   type : "post",
			   dataType : "html",
			   url : dtThemeAjax.ajax_url,
			   data : {action: "dt_theme_hbroom_unavailable_dates", hotel_id : hotel_id, room_id : room_id},
			   success: function (res) {
				   if(res.length) {
					  var d = res.split(',');
					  $('#rangeInlinePicker').multiDatesPicker({
						  numberOfMonths: [2,6],
						  dateFormat: dformat,
						  altField: '#txtseldates',
						  minDate: 0,
						  beforeShowDay: function(date){
					         var string = $.datepicker.formatDate('dd-mm-yy', date);
					         return [ d.indexOf(string) == -1 ]
						  }
					  });
		           } else {
					  $('#rangeInlinePicker').multiDatesPicker({
						  numberOfMonths: [2,6],
						  dateFormat: dformat,
						  altField: '#txtseldates',
						  minDate: 0
					  });
				   }
			   },
			   error: function (jqXHR, textStatus, errorThrown) {
				  $('#rangeInlinePicker').html('Sorry Calendar not Loading...');
			   }
			});
		}
	});
	
	$('.save-unavailable').click(function(e){
		
		var hotel_id = $('#cmbhotels').val();
		var room_id = $('#roomtype').val();
		var sel_dates = $('#txtseldates').val();
		
		if(hotel_id !== '' && room_id !== '' && sel_dates !== '') {
			$('#rangeInlinePicker').datepicker('destroy');
			
			$.ajax({
			   type : "post",
			   dataType : "html",
			   url : dtThemeAjax.ajax_url,
			   data : {action: "dt_theme_hbroom_set_unavailable", hotel_id : hotel_id, room_id : room_id, sdates : sel_dates},
			   success: function (res) {
				   if(res.length) {
					  var d = res.split(',');
					  $('#rangeInlinePicker').multiDatesPicker({
						  numberOfMonths: [2,6],
						  dateFormat: dformat,
						  altField: '#txtseldates',
						  minDate: 0,
						  beforeShowDay: function(date){
					         var string = $.datepicker.formatDate('dd-mm-yy', date);
					         return [ d.indexOf(string) == -1 ]
						  }
					  });
					  $('#txtseldates').val('');
					  $('.dt-update-notice').find('strong').html('Settings saved successfully.');
					  $('.dt-update-notice').stop().show().fadeOut(1500);
		           } else {
					  $('#rangeInlinePicker').multiDatesPicker({
						  numberOfMonths: [2,6],
						  dateFormat: dformat,
						  altField: '#txtseldates',
						  minDate: 0
					  });
				   }
			   },
			   error: function (jqXHR, textStatus, errorThrown) {
				  $('#rangeInlinePicker').html('Sorry Calendar not Loading...');
			   }
			});
		} else {
			alert('Room Type & Dates are not selected...');
		}
		e.preventDefault();
	});
	
	$('.clear-unavailable').click(function(){
		
		var hotel_id = $('#cmbhotels').val();
		var room_id = $('#roomtype').val();
		
		if(room_id !== '') {
			var conf = confirm('Are you sure to clear dates?');
			if(conf === true) {
				$('#rangeInlinePicker').datepicker('destroy');
				
				$.ajax({
				   type : "post",
				   dataType : "html",
				   url : dtThemeAjax.ajax_url,
				   data : {action: "dt_theme_hbroom_clear_unavailable", hotel_id : hotel_id, room_id : room_id},
				   success: function (res) {
					   if(res.length) {
						  $('#rangeInlinePicker').multiDatesPicker({
							  numberOfMonths: [2,6],
							  dateFormat: dformat,
							  altField: '#txtseldates',
							  minDate: 0
						  });
					   } else {
						  $('#rangeInlinePicker').multiDatesPicker({
							  numberOfMonths: [2,6],
							  dateFormat: dformat,
							  altField: '#txtseldates',
							  minDate: 0
						  });
					   }
					   $('.dt-update-notice').find('strong').html('Settings cleared successfully.');
					   $('.dt-update-notice').stop().show().fadeOut(1500);
				   },
				   error: function (jqXHR, textStatus, errorThrown) {
					  $('#rangeInlinePicker').html('Sorry Calendar not Loading...');
				   }
				});
			}
		} else {
			alert('Room Type not selected...');
		}
	});	
	
	if($('table.dt-sc-tbl-services, table.dt-sc-tbl-orders').length) {
		$('table.dt-sc-tbl-services')
			.tablesorter({ headers: { 0: { sorter: false }, 2: { sorter: false }}, widgets: ['zebra'] })
			.tablesorterPager({container: $("#pager"), size: 5});
		$('input#quicksearch').quicksearch('table.dt-sc-tbl-services tbody tr');
		
		$('table.dt-sc-tbl-orders')
			.tablesorter({ headers: { 0: { sorter: false }, 3: { sorter: false }, 13: { sorter: false }, 14: { sorter: false } }, widgets: ['zebra'] })
			.tablesorterPager({container: $("#pager"), size: 5});
		$('input#quicksearch').quicksearch('table.dt-sc-tbl-orders tbody tr');
	}

	$('#frmservicesettings #submit').click(function(e){
		if($('#cmbserhotels').val() !== "") {
			return true;
		} else {
			alert('Select a hotel...');
			return false;
		}
		e.preventDefault();
	});

});