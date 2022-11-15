<!-- <div class="fb-signin-button" data-width="300" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="true"></div> -->
<div class="form-glass" id="signin">
  <h1 class="title">Sign In</h1>
  <div class="form-group">
    <label for="username" class="label-input">Username</label>
    <span class="validate-message">Error</span>
    <div class="group-input">
      <input spellcheck="false" type="text" class="form-input status-valid" autocomplete="off" id="username" name="username" placeholder="Username" />
      <i class="ion-ios-information-outline"></i>
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="label-input">Password</label>
    <span class="validate-message">Error</span>
    <div class="group-input">
      <input spellcheck="false" type="password" class="form-input status-valid" id="password" name="password" placeholder="Password" />
      <i class="ion-eye showPassword"></i>
      <input type="checkbox" name="" id="" style="display: none;" checked>
    </div>
  </div>
  <div class="form-group col-2">
    <div class="checkbox">
      <input type="checkbox" name="agree" id="agree" />
      <span class="checkbox-text">Remember me</span>
      <span class="checkmark">
        <i class="ion-checkmark-round"></i>
      </span>
    </div>
  </div>

  <button id="btn-signin" class="btn-submit">
    <i class="ion-ios-arrow-thin-right"></i>
  </button>
  <input type="hidden" id="captcha">

  <span id="new-user">Don't have account ?
    <a href="/signup" id="redirect-signup">SignUp</a></span>
</div>