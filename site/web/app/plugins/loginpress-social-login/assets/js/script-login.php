<?php

/**
* script-login.php is created for adding Social related JS code in login page footer.
* @since 1.0.7
*/

?>
<script>

function addLoginPressSocialButton(){

  var rmLoginPressChecked = false;
  if ( document.getElementById('rememberme').checked == true ) {
    rmLoginPressChecked = true;
  }

  var $slLoginPressContainer = document.querySelector('.social-networks');
  if ( document.querySelectorAll('.social-networks').length > 0 ) {

    $slLoginPressContainer.remove();
    document.getElementById('loginform').innerHTML = document.getElementById('loginform').innerHTML + '<div class="social-networks block">' + $slLoginPressContainer.innerHTML + '</div>';
  }

  if( rmLoginPressChecked !== false ) {
    document.getElementById('rememberme').setAttribute( 'checked', rmLoginPressChecked );
  }
};
document.addEventListener( 'DOMContentLoaded', addLoginPressSocialButton, false );

</script>
