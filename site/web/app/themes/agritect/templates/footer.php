<footer class="site-footer section--dark">
  <div class="container nolazy">
    <div class="row">
      <div class="col-12">
        <a href="https://app.termly.io/document/privacy-policy/c0a0c9e8-6231-416e-9f45-e3188dc9ebdc" target="_blank">Privacy Policy</a>
      </div>
    </div>
  </div>
</footer>

<script type="text/javascript">
  // jQuery(document).ready(function() {
  //   if(jQuery('.dashboard').length) {
  //     jQuery('.navbar.fixed-top').hide();
  //     jQuery('.site-footer').hide();
  //     // jQuery('body').css('padding-top', 0);
  //   }
  // });

  jQuery(function() {
    var pathArray = location.pathname.split('/');
    var newPathname = "";

    for (i = 0; i < pathArray.length; i++) {
      if(pathArray[i]) {
        newPathname += "/";
        newPathname += pathArray[i];  
      }
    }

    jQuery('.sidebar .nav a[href="' + newPathname + '"]').addClass('active');

    // What about the project + dashboard pages?
  });
</script>