(function($){

	// FeedsAPI option toggling
	// Show when FeedsAPI service is chosen, hide when other services are chosen
	$(window).load( function(){
		// The full text rss service dropdown
		var full_text_rss_service_dropdown = $('#ftp-full-text-rss-service');
		// The FeedsAPI key text field
		var feeds_api_key_field = $('#wprss-ftp-feeds-api-key');
		// The tr element that contains the FeedsAPI option
		var feeds_api_key_option_row = feeds_api_key_field.parent().parent();

		// The function that shows/hides that FeedsAPI key option
		var toggle_feeds_api_key_option = function(){
			// Get the service chosen
			var service = full_text_rss_service_dropdown.val();
			// Show when FeedsAPI is select, hide otherwise
			feeds_api_key_option_row.toggle( service === 'feeds_api' );
		};

		// When the dropdown value changes, run the toggle function
		full_text_rss_service_dropdown.change( toggle_feeds_api_key_option );

		// Run the toggle function when the window loads
		toggle_feeds_api_key_option();
	});


	// WORD TRIMMING
	$(window).load( function() {
		// Word limit field
		var word_limit = $('#ftp-word-limit');
		// Trimming type <tr> row
		var trimming_type_row = $('#ftp-trimming-type').parent().parent();

		// Returns true|false for word limit count not empty or greater than zero
		function is_word_limit_disabled() {
			return word_limit.val() == '' || word_limit.val() == '0';
		}

		// Hides the trimming type row
		var hide_trimming_type = function() {
			trimming_type_row.toggle( !is_word_limit_disabled() );
		};

		// If word limit is zero, change to empty at page load
		if ( is_word_limit_disabled() ) {
			word_limit.val( '' );
		}
		
		// On word limit change, check if trimming type row needs to ne hidden
		word_limit.on( 'change', hide_trimming_type );
		// Do the same checks at page load
		hide_trimming_type();
	});


	// CUSTOM NAMESPACE option handling
	$(window).load( function(){
		// The namespaces marker - where to add new namespaces
		var marker = $('#wprss-ftp-namespaces-marker');

		// The remove namespace button click function 
		var remove_namespace_action = function() {
			$(this).parent().remove();
		};

		// Add the click action to the 'Add Namespace' button
		$('#wprss-ftp-add-namespace').click( function() {
			// Create the section div
			var section = $('<div>').addClass('wprss-ftp-namespace-section');
			// Create the fields
			var name_field = $( wprss_namespace_input_template ).appendTo( section );
			var url_field = $( wprss_namespace_input_template ).addClass('wprss-ftp-namespace-url').appendTo( section );
			// Create the remove button
			var remove_btn = $( wprss_namespace_remove_btn ).click( remove_namespace_action ).appendTo( section );

			// Add the [name] and [url] indexes to the name attribute of the fields
			name_field.attr({
				name: name_field.attr('name') + '[names][]',
				placeholder: wprss_ftp_settings_scripts.name
			});
			url_field.attr({
				name: url_field.attr('name') + '[urls][]',
				placeholder: wprss_ftp_settings_scripts.url
			});

			// Add the created section, before the marker
			section.insertBefore( marker );
		});

		// Add the remove action to existing remove buttons
		$('.wprss-ftp-namespace-remove').click( remove_namespace_action );
	});

})(jQuery);