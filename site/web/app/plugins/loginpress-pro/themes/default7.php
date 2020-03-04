
<?php
function seventh_presets() {
  ob_start();
  ?>
  <style media="screen" id="loginpress-style">
  html, body.login {
    height: auto !important;
  }
    body.login {
      background-image: url(<?php echo plugins_url( 'img/bg7.jpg', LOGINPRESS_PRO_PLUGIN_BASENAME )  ?>);
      background-position: center center;
      /*background-color: #f1f1f1 !important;*/
      background-size: cover;
      display: table !important;
      min-height: 100vh;
      width: 100%;
      padding: 0;
      position: relative;
    }
    body.login.login-action-login{
      display: table  !important;
    }
    /*body.login:after{
      width: 100%;
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      height: 60%;
      background: #263466;
    }*/
    /*.login label{
    font-size:0;
    line-height:0;
    margin-top: 0;
    display: block;
    margin-bottom:
    }*/
    .login label{
      font-size: 16px;
      color: #909090;
    }
    #login{
      /*background: url(img/form_bg.jpg) no-repeat 0 0 !important;*/
      background: #fff;
      max-width: 350px !important;
      width: 100% !important;
      border-radius: 10px;
      box-shadow: 0px 5px 50px 0px rgba(0, 0, 0, 0.1);
      margin-top: 8%;
      padding: 40px 20px 50px;
    }
    #loginform{
      margin: 0 auto;
      padding: 30px 0 0 !important;
    }
    #login:after{
      content: '';
      display: table;
      clear: both;
    }
    #login form p + p:not(.forgetmenot){
    margin-top: 35px;
    }
    .login form .input, .login input[type=text]{
      background: none;
      display: block;
      color: #909090;
      font-size: 16px;
      /*font-family: 'Open Sans';*/
      width:100%;
      border:0;
      height: 50px;
      padding: 0 15px;
      border-top:1px solid #e5e5e5;
      border-radius: 3px;
      -webkit-box-shadow: none;
      box-shadow: none;
    }
    .login form{
      background: none;
      padding: 0;
      box-shadow: none;
    }
    .login form br{
    display: none;
    }
    #login form p.submit{
      clear: both;
      padding-top: 35px;
    }
    .wp-core-ui #login  .button-primary{
      width:100% !important;
      display: block;
      float: none;
      background-color : #e15da8;
      font-weight: 700;
      font-size: 18px;
      /*font-family: 'Open Sans';*/
      color : #ffffff;
      height: 56px;
      border-radius: 0;
      border:0;
      box-shadow: none;
      border-radius: 5px;
    }
    .wp-core-ui #login  .button-primary:hover{
      background-color: #ea86be;
    }
    .login form .forgetmenot label{
      font-size: 13px;
      /*font-family: 'Open Sans';*/
      color: #909090;
    }
    .login form input[type=checkbox]{
      background: none;
      border: 1px solid #e5e5e5;
      height: 13px;
      width: 13px;
      min-width: 13px;
      border-radius: 3px;
    }
    .login #nav, .login #backtoblog {
      margin: 17px 0 0;
      padding: 0;
      font-size: 12px;
      /*font-family: "Open Sans";*/
      color: #909090;
    }
    .login #nav a, .login #backtoblog a{
      font-size: 12px;
      /*font-family: "Open Sans";*/
      color: #909090;
    }
    .login #backtoblog{
      float: left;
    }
    .login #nav {
      font-size: 0;
      float: right;
      width: 100%;
    }
    .login #nav a:last-child {
      float: right;
    }
    .login #nav a:first-child {
      float: left;
    }
    .login #backtoblog a:hover, .login #nav a:hover, .login h1 a:hover{
      color: #eae8e8;
    }
    /* style two factor plugin */
    .login .backup-methods-wrap a, #login form p:not([class]){
      color: #909090;
    }
    .login .backup-methods-wrap a:hover{
      color: #eae8e8;
    }
    /*End style two factor plugin */

    .footer-wrapper{
    	display: table-footer-group;
    }
    .footer-cont{
    	right: 0;
    	bottom: 0;
    	left: 0;
    	text-align: center;
    	display: table-cell;
    	vertical-align: bottom;
    	height: 100px;
      width: 100vw;
    }
    .copyRight{
    	text-align: center;
      padding: 12px;
      background-color: #e15da8;
      color: #ffffff;
    }
    #login form p + p:not(.forgetmenot){
    color: #d5d5d5;
    }
    input[type=checkbox]:checked:before{
      font-size: 18px;
      color: #e15da8 !important;
    }
    .mobile #login{
      padding: 15px;
    }
    .loginpress-show-love{
      color: #fff;
    }
    .loginpress-show-love a{
      color: #fff;
    }
    .loginpress-show-love a:hover{
      color: #fc6ec7;
    }
    @media screen and (max-width: 767px) {

      #login{
        width: 290px !important;
      }
    .login .loginpress-show-love{
      padding: 3px 10px;
      text-align: center;
      position: static;
      margin-top: 10px;
      float: none;
      background: rgba(225, 93, 168, 0.5);
    }
    }

    </style>

  <?php
  $content = ob_get_clean();
  return $content;
}
echo seventh_presets();
