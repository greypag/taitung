jQuery(document).ready(function($){
	
	
	// To switch between Wordpress Default Editor and DT Page Builder //

	$('#dtthemes-metabox').hide();
	$('<a class="dt-pb-switch dt_button" href="#">' + dtthemes_options.theme_name + '</a>').insertAfter('div#titlediv').wrap('<p class="dt-composer-switch" />');
	
	$('.dt-pb-switch').click(function(e){
		if($(this).html() == dtthemes_options.theme_name) {
			$('div#postdivrich').attr('style', 'display:none');	
			$(this).html(dtthemes_options.dt_wp_editor);
			$('#dtthemes-metabox').show();
			$('<div id="dt-metabox-id" style="display:inline-block; width:100%"></div>').insertAfter('#dtthemes-metabox');
			dt_calculate_modules();
			if($('#poststuff a.wpb_switch-to-composer').length > 0) {
				var vc_mode = $('#poststuff a.wpb_switch-to-composer').html().replace(/ /g,'').toLowerCase();
				if(vc_mode == 'classicmode') {
					var $popup_alert = $("#dtthemes_ajax_popup_alert");
					$('<div class="popup_modal_blocker"></div>').insertAfter('div#dtthemes_ajax_popup_alert');
					$popup_alert.html( 'Visual composer is still active in this page, please disable it if you are going to use ' + dtthemes_options.theme_name + '<div id="dtthemes_close_ajax_poup" class="dt-popup-scroll" data-attr="scrollto-visualcomposer"></div>');
					$popup_alert.fadeIn('fast');
				}
			}
		} else if($(this).html() == dtthemes_options.dt_wp_editor) {
			$('div#postdivrich').attr('style', 'display:block');	
			$(this).html(dtthemes_options.theme_name);
			$('#dtthemes-metabox').hide();
			$( 'div#dt-metabox-id' ).remove();
		}
		e.preventDefault();
	});
	
	
	/* To calculate modules width */
	function dt_calculate_modules(){

		var dt_row_width = 0;
		dt_main_module_width = $('#dt_layout').width();

		$( '#dt_layout > .dt_module' ).removeClass('dt_first').each( function(index){
			if ( index === 0 || dt_row_width === 0 ) $(this).addClass('dt_first');

			dt_row_width += $(this).width();
			if ( dt_row_width === $('#dt_layout').outerWidth(true) ){
				$(this).next('.dt_module').addClass('dt_first');
				dt_row_width = 0;
			} else if ( Math.floor(dt_row_width) > $('#dt_layout').outerWidth(true) ){
				$(this).addClass('dt_first');
				dt_row_width = $(this).outerWidth(true);
			}
		} );
		
		
		var dt_fullwidth_row = 0;
		$( '#dt_layout .dt_fullwidth_section .dt_fullwidth_section_container > .dt_module' ).removeClass('dt_first').each( function(index){
			if ( index === 0 || dt_fullwidth_row === 0 ) $(this).addClass('dt_first');

			dt_fullwidth_row += $(this).width();
			if ( dt_fullwidth_row === $('#dt_layout').outerWidth(true) ){
				$(this).next('.dt_module').addClass('dt_first');
				dt_fullwidth_row = 0;
			} else if ( Math.floor(dt_fullwidth_row) > $('#dt_layout').outerWidth(true) ){
				$(this).addClass('dt_first');
				dt_fullwidth_row = $(this).outerWidth(true);
			}
		} );

	}
	
	/*Tooltip*/
	if(jQuery(".dt-sc-tooltip").length){
		jQuery(".dt-sc-tooltip").each(function(){ jQuery(this).tipTip({maxWidth: "auto",defaultPosition: "top"}); });
	}/*Tooltip End*/
	
	
	// To enable / disable DT Page Builder on page load //
	
	if($('div#dt_enable_builder').hasClass('chkbx-switch-on')) {
		$('div#postdivrich').attr('style', 'display:none');	
		$('.dt-pb-switch').html(dtthemes_options.dt_wp_editor);
		$('#dtthemes-metabox').show();
		$('<div id="dt-metabox-id" style="display:inline-block; width:100%"></div>').insertAfter('#dtthemes-metabox');
		dt_reactivate_ui_actions();
		dt_reactivate_ui_actions_all();
	} else if($('div#dt_enable_builder').hasClass('chkbx-switch-off')) {
		$('div#postdivrich').attr('style', 'display:block');	
		$('.dt-pb-switch').html(dtthemes_options.theme_name);
		$('#dtthemes-metabox').hide();
		$( 'div#dt-metabox-id' ).remove();
		dt_deactivate_ui_actions();
		dt_deactivate_ui_actions_all();
	} else {
		$('div#postdivrich').attr('style', 'display:block');	
		$('.dt-pb-switch').html(dtthemes_options.theme_name);
		$('#dtthemes-metabox').hide();
		$( 'div#dt-metabox-id' ).remove();
		dt_deactivate_ui_actions();
		dt_deactivate_ui_actions_all();
	}
	
	/* Activate or Deactivate functons */
	function dt_deactivate_ui_actions(){
		$('#dt_modules .dt_module').addClass('disable_onclick');
		$('#dt_layout .dt_m_column .dt_module_controls .dt_column_name').css('opacity',0.5);
		$( '#dt_layout' ).droppable( "disable" ).sortable( "disable" );
		$( '#dt_layout .dt_m_column .dt_modules_container' ).droppable( "disable" );
		$( '#dt_layout .dt_fullwidth_section .dt_fullwidth_section_container' ).droppable( "disable" );
		
		$( '#dt_layout > .dt_module span.dt_move, #dt_layout > .dt_module span.dt_delete, #dt_layout > .dt_module span.dt_settings_arrow_module, #dt_layout > .dt_module span.dt_settings_arrow_widget, #dt_layout > .dt_module span.dt_clone_module, #dt_layout > .dt_module span.dt_clone_column, #dt_layout > .dt_module span.dt_delete_column, #dt_layout > .dt_module span.dt_showorhide, #dt_layout > .dt_module span.dt_settings_arrow_column, #dt_layout > .dt_module span.dt_settings_arrow_fullwidth, #dt_layout > .dt_module span.dt_show_modules_in_popup' ).css( 'display', 'none' );
		
		$('#dt_layout .dt_module:not(.dt_active)').attr('style', 'opacity: 0.5; z-index: 1;');
		$( '#dt_layout .dt_module' ).each( function(){
			if($(this).find('.dt_modules_container .dt_module').hasClass('dt_active')) {
				$(this).attr('style', 'opacity: 1; z-index: 1;');
				$(this).find('.dt_modules_container .dt_module.dt_active').attr('style', 'opacity: 1; z-index: 1;');
			}
			if($(this).find('.dt_fullwidth_section_container .dt_module').hasClass('dt_active')) {
				$(this).attr('style', 'opacity: 1; z-index: 1;');
				$(this).find('.dt_fullwidth_section_container .dt_module.dt_active').attr('style', 'opacity: 1; z-index: 1;');
			}
		});
		
	}

	function dt_reactivate_ui_actions(){
		$('#dt_modules .dt_module').removeClass('disable_onclick');
		$('#dt_layout .dt_m_column .dt_module_controls .dt_column_name').css('opacity',1);
		$( '#dt_layout' ).droppable( "enable" ).sortable( "enable" );
		$( '#dt_layout .dt_m_column .dt_modules_container' ).droppable( "enable" );
		$( '#dt_layout .dt_fullwidth_section .dt_fullwidth_section_container' ).droppable( "enable" );
		
		$( '#dt_layout > .dt_module span.dt_showorhide, #dt_layout > .dt_module span.dt_clone_column, #dt_layout > .dt_module span.dt_delete_column, #dt_layout > .dt_module span.dt_settings_arrow_column, #dt_layout > .dt_module span.dt_settings_arrow_fullwidth, #dt_layout > .dt_module span.dt_show_modules_in_popup' ).css( 'display', 'block' );

		$( '#dt_layout .dt_module .dt_module_options' ).each( function(){
			if($(this).find('.dt_showorhide').attr('title') == 'Hide') {
				$(this).closest('.dt_module').css('opacity',0.4);
				$(this).find('.dt_settings_arrow_module, .dt_clone_module, .dt_delete, .dt_move, .dt_settings_arrow_widget').css('display','none');
			} else {
				$(this).closest('.dt_module').css('opacity',1);
				$(this).find('.dt_settings_arrow_module, .dt_clone_module, .dt_delete, .dt_move, .dt_settings_arrow_widget').css('display','block');
			}
		});
	}

	function dt_deactivate_ui_actions_all(){
		$('#dt_layout .dt_module, #dt_layout .dt_m_column').css('opacity',0.5);
		$( '.dt_builder_controls, #dt_modules' ).css('opacity',0.5);
		$( 'span#dtthemes_clear_all, span#dtthemes_create_layout' ).css( 'display', 'none' );
		$( 'div.dt_button').css( 'display', 'none' );
		$( 'div.dt_show_modules_in_popup').css( 'display', 'none' );
	}
	
	function dt_reactivate_ui_actions_all(){
		$( '#dt_layout .dt_module, #dt_layout .dt_m_column' ).removeClass('dt_active').css('opacity',1);
		$( '.dt_builder_controls, #dt_modules' ).css('opacity',1);
		$( 'span#dtthemes_clear_all, span#dtthemes_create_layout' ).css( 'display', 'block' );
		$( 'div.dt_button').css( 'display', 'inline-block' );
		$( 'div.dt_show_modules_in_popup').css( 'display', 'inline-block' );
	}
	
	$('.dt_module .dt_hide').each( function(){
		if($(this).attr('title') == 'Hide') {
			$(this).closest('.dt_module').css('opacity',0.4);
			$(this).parents('.dt_module_options').find('.dt_settings_arrow_module, .dt_clone_module, .dt_delete, .dt_move, .dt_settings_arrow_widget').css('display','none');
		}
	});
	

	if(dtthemes_options.builder_enable == 1) {
		
		!function(t){var e={topSpacing:0,bottomSpacing:0,className:"is-sticky",wrapperClassName:"sticky-wrapper",center:!1,getWidthFrom:""},n=t(window),i=t(document),a=[],s=n.height(),r=function(){var e,r=jQuery("#header-animate").height(),o=jQuery("#main-menu").height();e=-r;for(var c=n.scrollTop(),p=i.height(),l=p-s,d=c>l?l-c:e,h=0;h<a.length;h++){var m=a[h],u=m.stickyWrapper.offset().top,g=u-m.topSpacing-d;if(g>=c)null!==m.currentTop&&(m.stickyElement.css("position","").css("top","").css("height",""),m.stickyElement.parent().hasClass(m.className)&&m.stickyElement.parent().animate({},{queue:!1,duration:250,easing:"linear",complete:function(){m.stickyElement.parent().removeClass(m.className)}}),m.currentTop=null);else{var y=p-m.stickyElement.outerHeight()-m.topSpacing-m.bottomSpacing-c-d;0>y?y+=m.topSpacing:y=m.topSpacing,m.currentTop!=y&&(m.stickyElement.css("position","fixed").css("top",y).css("height",o),"undefined"!=typeof m.getWidthFrom&&m.stickyElement.css("width",t(m.getWidthFrom).width()),m.stickyElement.parent().addClass(m.className),m.stickyElement.parent().hasClass(m.className)||m.stickyElement.parent().animate({},{queue:!1,duration:250,easing:"linear",complete:function(){m.stickyElement.parent().addClass(m.className)}}),m.currentTop=y)}}},o=function(){s=n.height()},c={init:function(n){var i=t.extend(e,n);return this.each(function(){var e=t(this),n=e.attr("id"),s=t("<div></div>").attr("id",n+"-sticky-wrapper").addClass(i.wrapperClassName);e.wrapAll(s),i.center&&e.parent().css({width:e.outerWidth(),marginLeft:"auto",marginRight:"auto"}),"right"==e.css("float")&&e.css({"float":"none"}).parent().css({"float":"right"});var r=e.parent();r.css("height",e.outerHeight()),a.push({topSpacing:i.topSpacing,bottomSpacing:i.bottomSpacing,stickyElement:e,currentTop:null,stickyWrapper:r,className:i.className,getWidthFrom:i.getWidthFrom})})},update:r};window.addEventListener?(window.addEventListener("scroll",r,!1),window.addEventListener("resize",o,!1)):window.attachEvent&&(window.attachEvent("onscroll",r),window.attachEvent("onresize",o)),t.fn.sticky=function(e){return c[e]?c[e].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof e&&e?void t.error("Method "+e+" does not exist on jQuery.sticky"):c.init.apply(this,arguments)},t(function(){setTimeout(r,0)})}(jQuery);	
		$(".metabox-holder.columns-2 #submitdiv").sticky({ topSpacing: 31 });
	
	}
	
	$( 'body' ).delegate( '#poststuff a.wpb_switch-to-composer', 'click', function(){
		var vc_mode = $('#poststuff a.wpb_switch-to-composer').html().replace(/ /g,'').toLowerCase();
		var pb_mode = $('.dt-pb-switch').html().replace(/ /g,'').toLowerCase();
		if(pb_mode == 'wordpresseditor' && $('input[type="checkbox"]#dtthemes-enable-builder').is(':checked') && vc_mode == 'classicmode') {
			$('body').append('<div id="dtthemes_ajax_popup_alert"></div>');
			$('<div class="popup_modal_blocker"></div>').insertAfter('div#dtthemes_ajax_popup_alert');
			var $popup_alert = $("#dtthemes_ajax_popup_alert");
			$popup_alert.html( dtthemes_options.theme_name + ' is still active in this page, please disable it if you are going to use Visual Composer <div id="dtthemes_close_ajax_poup" class="dt-popup-scroll" data-attr="scrollto-pagebuilder"></div>' );
			$popup_alert.fadeIn('fast');
		}
	});
	
	$( 'body' ).delegate( '#dtthemes_close_ajax_poup', 'click', function(){
		var $popup_alert = $("#dtthemes_ajax_popup_alert");
		$('.popup_modal_blocker').remove();
		$popup_alert.fadeOut("slow");
	});
	
	$( 'body' ).delegate( '.dt-popup-scroll', 'click', function(){
		var $scrollto = $(this).attr('data-attr');
		if($scrollto == 'scrollto-pagebuilder') {
			$('html:not(:animated),body:not(:animated)').animate({ scrollTop: $('#dtthemes-metabox').offset().top - 170 }, 500);
		} else if($scrollto == 'scrollto-visualcomposer') {
			$('html:not(:animated),body:not(:animated)').animate({ scrollTop: $('.composer-switch').offset().top - 40 }, 500);
		}
	});
		
	$( 'body' ).delegate( '.popup_modal_blocker', 'click', function(){
		var $popup_alert = $("#dtthemes_ajax_popup_alert");
		$('.popup_modal_blocker').remove();
		$popup_alert.fadeOut("slow");
	});
		
});