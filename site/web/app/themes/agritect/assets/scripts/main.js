
// All External Links in a New Tab
jQuery(document).ready(function() {
  jQuery('a').filter(function() {
    return this.hostname && this.hostname !== location.hostname;
  }).attr("target","_blank");
});

// IS TOP IN VIEWPORT?
function topInViewport(element) {
  return (
    jQuery(element).offset().top >= jQuery(window).scrollTop() &&
    jQuery(element).offset().top <=
      jQuery(window).scrollTop() + jQuery(window).height()
  );
}
/*
jQuery(window).on("load resize scroll",function(e){
  if ( topInViewport(jQuerythis) && jQuerythis.text()==='0' ) {
    // SOME CODE HERE
  }
});
*/

// Get URL Post Variables
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace("#","&").replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}