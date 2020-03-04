<?php
function ajax_check_user_logged_in() {
    echo is_user_logged_in()?'true':'false';
    die();
}
add_action('wp_ajax_is_user_logged_in', 'ajax_check_user_logged_in');
add_action('wp_ajax_nopriv_is_user_logged_in', 'ajax_check_user_logged_in');

/*
    $.ajax({
      'url':ajaxurl,
      'type':'GET',
      'async':false,
      'data':{action: 'is_user_logged_in'},
      'success':function(data){
        loggedin = data;
      }
    });
*/

?>
