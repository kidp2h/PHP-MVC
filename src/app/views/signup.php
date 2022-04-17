<!-- <div class="fb-signin-button" data-width="300" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="true"></div> -->
<div id="signup">
  <h1 class="title">Sign Up</h1>
  <span id="text-or">CONITNUE WITH</span>
  <div class="social-group">
    <span class="signin-social">
      <img class="logo-social" src="/public/images/logo-fb.png" alt="facebook" />
      Continue with Facebook
    </span>
    <span class="signin-social">
      <img class="logo-social" src="/public/images/logo-google.png" alt="facebook" />
      Continue with Google
    </span>
  </div>
  <div id="form-signup">
    <div class="form-group">
      <label for="fullname" class="label-input">Full Name</label>
      <span class="validate-message">Error</span>
      <div class="group-input">
        <input type="text" class="form-input status-valid" id="fullname" name="fullname" placeholder="Full Name" value="Nguyen Phuc Thinh"/>
        <i class="fa-solid fa-circle-info"></i>
      </div>
    </div>
    <div class="form-group">
      <label for="email" class="label-input">Email Address</label>
      <span class="validate-message">Error</span>
      <div class="group-input">
        <input type="email" class="form-input status-valid" value="kidp2h@gmail.com" id="email" name="email" placeholder="Email" />
        <i class="fa-solid fa-circle-info"></i>
      </div>
    </div>
    <div class="form-group">
      <label for="username" class="label-input">Username</label>
      <span class="validate-message">Error</span>
      <div class="group-input">
        <input type="text" class="form-input status-valid" value="admin" id="username" name="username" placeholder="Username" value=""/>
        <i class="fa-solid fa-circle-info"></i>
      </div>
    </div>
    <div class="form-col-2">
      <div class="form-group">
        <label for="password" class="label-input">Password</label>
        <span class="validate-message">Error</span>
        <div class="group-input">
        <input type="password" class="form-input status-valid" value="admin" id="password" name="password" placeholder="Password" />
          <!-- <i class="fa-solid fa-check"></i> -->
          <i class="ion-eye showPassword"></i>
          <input type="checkbox" name="" id="" style="display: none;" checked>
        </div>
      </div>

      <div class="form-group">
        <label for="confirm-password" class="label-input">Confirm password</label>
        <span class="validate-message">Error</span>
        <div class="group-input">
        <input type="password" class="form-input status-valid" value="admin" id="confirm-password" name="confirm-password" placeholder="Confirm password" />
          <!-- <i class="fa-solid fa-check"></i> -->
          <!-- <i class="fa-solid fa-eye showPassword"></i>
          <input type="checkbox" name="" id="" style="display: none;" checked> -->
        </div>
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
          <i class="ion-checkmark-round"></i>
        </span>
      </div>
      <div class="forgot">
        <span>Forgot Password?</span>
      </div>
    </div>
    
    <button id="btn-signup">
      <i class="ion-ios-arrow-thin-right"></i>
    </button>
    <input type="hidden" id="captcha">
    
    <span id="new-user">Have you already account ?
      <a href="/signin" id="redirect-signup">SignIn</a></span>
  </div>
</div>
