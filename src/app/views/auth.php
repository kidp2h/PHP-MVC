<!-- <div class="fb-login-button" data-width="300" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="true"></div> -->
<div id="form-login">
  <h1 class="title">Sign In</h1>
  <span id="text-or">Sign In With</span>
  <div class="social-group">
    <span class="login-social">
      <img class="logo-social" src="/public/images/logo-fb.png" alt="facebook" />
      Sign in with Facebook
    </span>
    <span class="login-social">
      <img class="logo-social" src="/public/images/logo-google.png" alt="facebook" />
      Sign in with Google
    </span>
  </div>
  <div id="form-login">
    <div class="form-group">
      <label for="username" class="label-input">Username</label>
      <input type="text" class="form-input" id="username" name="username" />
    </div>
    <div class="form-group">
      <label for="password" class="label-input">Password</label>
      <input type="text" class="form-input" id="password" name="password" />
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
    <button class="btn-login">
      <i class="fa-solid fa-arrow-right"></i>
    </button>
    <span id="new-user">Don't Have Account ?
      <a href="/register" id="redirect-signup">SignUp</a></span>
  </div>
</div>