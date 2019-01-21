//slider
jQuery(window).load(function() {
	jQuery('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 50,
    itemMargin: 20,
    asNavFor: '#slider',
    direction: "vertical", 
  });
  jQuery('#slider').flexslider({
    animation: "slide",
    directionNav: false,
    sync: "#carousel",
    controlNav: false,
     
  });
});