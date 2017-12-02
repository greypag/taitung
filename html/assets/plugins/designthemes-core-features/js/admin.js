jQuery.noConflict();
jQuery(document).ready(function($) {
	
	jQuery(document).on( 'click', '.dt-plugin-notice .notice-dismiss', function() {
	
		jQuery.ajax({
			url: ajaxurl,
			data: {
				action: 'dt_plugin_dismiss_notice'
			}
		})
	
	})
	
});