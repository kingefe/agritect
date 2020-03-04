<div id="authform" style="display:none">

  <form action="register" method="POST" id="register">
    <p class="message"></p>

    <fieldset>
      <input type="text"  name="new_name" placeholder="Your Name" id="new-username">
      <input type="email"  name="new_user_email" placeholder="Email address" id="new-useremail">
      <input type="password"  name="new_user_password" placeholder="Password" id="new-userpassword">

      <p>
        By registering for an account, you agree to Agritecture Designer's <a href="https://app.termly.io/document/terms-of-use-for-website/b06d0b70-51dd-4215-8466-1aa5db132b4c" target="_blank" class="text-white text-underline">terms and conditions</a>.
      </p>

      <input type="submit"  class="btn" id="register-button" value="Register" onclick="ajaxRegisterSubmit()">
    </fieldset>
    <p class="account">
      <a class="login" href="#" data-toggle="modal" data-target="#loginModal">Already a user? <span>Click to log in</span></a>
      <!-- <a class="login" href="https://testagritecture.com/wp/wp-login.php?lpsl_login_id=gplus_login"><span>Login with Google</span></a> -->
      <!-- <a class="login" href="https://agritect.test/wp/wp-login.php?lpsl_login_id=linkedin_login"><span>Login with LinkedIn</span></a> -->
    </p>
  </form>
  
  <div class="modal fade login" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Log in to your account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form id="login" action="login" method="post">
            <p class="status"></p>
            <input id="username" type="email" name="username" placeholder="Email">
            <input id="password" type="password" name="password" placeholder="Password">
            <input class="submit btn btn-primary" type="submit" value="Login" name="submit" onclick="ajaxLoginSubmit()">
            <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
            <p class="account">
              <a class="lost" href="<?php echo wp_lostpassword_url(); ?>" target="_blank">Lost your password? <span>Reset it!</span></a>
            </p>
          </form>

        </div>
      </div>
    </div>
  </div>

</div>
