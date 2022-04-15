<!-- <div class="fb-signin-button" data-width="300" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="true"></div> -->
<div id="signin">
  <h1 class="title">Sign In</h1>
  <span id="text-or">Sign In With</span>
  <div class="social-group">
    <span class="signin-social">
      <img class="logo-social" src="/public/images/logo-fb.png" alt="facebook" />
        <a href="javascript:void(0)" onclick="fbLogin()">Sign in with Facebook</a>
    </span>
    <span class="signin-social" id="login-google">
      <img class="logo-social" src="/public/images/logo-google.png" alt="google" />
      <a>Sign in with Google</a>
    </span>
  </div>
  <form id="form-signin" autocomplete="off">
    <div class="form-group">
      <label for="username" class="label-input">Username</label>
      <span class="validate-message">Error</span>
      <div class="group-input">
        <input type="text" class="form-input status-valid" autocomplete="off" id="username" name="username" placeholder="Username" />
        <i class="fa-solid fa-circle-info"></i>
      </div>
    </div>
    <div class="form-group">
      <label for="password" class="label-input">Password</label>
      <span class="validate-message">Error</span>
      <div class="group-input">
      <input type="password" class="form-input status-valid" id="password" name="password" placeholder="Password" />
        <!-- <i class="fa-solid fa-check"></i> -->
        <i class="fa-solid fa-eye showPassword"></i>
        <input type="checkbox" name="" id="" style="display: none;" checked>
      </div>
    </div>
    <div class="form-group">
      <label for="captcha" class="label-input">Captcha</label>
      <input type="hidden" id="captcha">
      <span class="validate-message">Error</span>
      <div class="g-recaptcha" data-sitekey="<?= $SITE_KEY ?>"></div>
    </div>
    <div class="form-group col-2">
      <div class="checkbox">
        <input type="checkbox" name="agree" id="agree" />
        <span class="checkbox-text">Remember me</span>
        <span class="checkmark">
          <i class="fa-solid fa-check"></i>
        </span>
      </div>
      <div class="forgot">
        <span>Forgot Password?</span>
      </div>
    </div>
    
    <button id="btn-signin">
      <i class="fa-solid fa-arrow-right"></i>
    </button>
    <input type="hidden" id="captcha">
    
    <span id="new-user">Don't have account ?
      <a href="/signup" id="redirect-signup">SignUp</a></span>
  </form>
</div>