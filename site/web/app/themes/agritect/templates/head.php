<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="wpID" content="<?=get_current_user_id()?>" />
  <meta name="google-site-verification" content="wIrnyfDgGR3xL88vR9QLLAwOmKJch8A5vuoVu5NAhsU" />
  <script type="text/javascript">
  var themeurl = '<?=get_template_directory_uri()?>';
  var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
  </script>
  <style>
    #loginform #nav a:first-child {
      display: none;
    }

    #loginform #nav a:last-child:after {
      content: ' |';
    }
  </style>
  <?php wp_head(); ?>
</head>
