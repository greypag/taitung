function menumobifix(){
  var isMobile = (/Mobile/i.test(navigator.userAgent));
  if(isMobile){
    jQuery('.menu-item-1 .megamenu-child-container').before(jQuery('.menu-item-1 .megamenu-child-container .sub-menu'));
    jQuery('.menu-item-2 .megamenu-child-container').before(jQuery('.menu-item-2 .megamenu-child-container .sub-menu'));
//menu-item menu-item-1
    jQuery('.menu-item-1').removeClass('menu-item-type-post_type').removeClass('menu-item-object-page').removeClass('current-menu-item').removeClass('page_item').removeClass('page-item-556').removeClass('current_page_item').removeClass('menu-item-megamenu-parent').removeClass('megamenu-4-columns-group').addClass('menu-item-type-custom').addClass('menu-item-object-custom').addClass('menu-item-simple-parent');
    jQuery('.menu-item-2').removeClass('menu-item-type-post_type').removeClass('menu-item-object-page').removeClass('current-menu-item').removeClass('page_item').removeClass('page-item-556').removeClass('current_page_item').removeClass('menu-item-megamenu-parent').removeClass('megamenu-4-columns-group').addClass('menu-item-type-custom').addClass('menu-item-object-custom').addClass('menu-item-simple-parent');
  }
}
jQuery(document).ready(function(){
  menumobifix();
});
