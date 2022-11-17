<!-- <div class="fb-signin-button" data-width="300" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="true"></div> -->
<div class="form-glass" id="signup">
  <h1 class="title">Sign Up</h1>
  <div id="form-signup">
    <div class="form-group">
      <label for="fullname" class="label-input">Full Name</label>
      <span class="validate-message">Error</span>
      <div class="group-input">
        <input spellcheck="false" type="text" class="form-input status-valid" id="fullname" name="fullname" placeholder="Full Name" value="" />
        <i class="ion-ios-information-outline"></i>
      </div>
    </div>
    <div class="form-group">
      <label for="email" class="label-input">Email Address</label>
      <span class="validate-message">Error</span>
      <div class="group-input">
        <input spellcheck="false" type="email" class="form-input status-valid" value="" id="email" name="email" placeholder="Email" />
        <i class="ion-ios-information-outline"></i>
      </div>
    </div>
    <div class="form-group">
      <label for="username" class="label-input">Username</label>
      <span class="validate-message">Error</span>
      <div class="group-input">
        <input spellcheck="false" type="text" class="form-input status-valid" value="" id="username" name="username" placeholder="Username" value="" />
        <i class="ion-ios-information-outline"></i>
      </div>
    </div>
    <div class="form-col-2">
      <div class="form-group">
        <label for="password" class="label-input">Password</label>
        <span class="validate-message">Error</span>
        <div class="group-input">
          <input spellcheck="false" type="password" class="form-input status-valid" value="" id="password" name="password" placeholder="Password" />
          <!-- <i class="fa-solid fa-check"></i> -->
          <i class="ion-eye showPassword"></i>
          <input type="checkbox" name="" id="" style="display: none;" checked>
        </div>
      </div>

      <div class="form-group">
        <label for="confirm-password" class="label-input">Confirm password</label>
        <span class="validate-message">Error</span>
        <div class="group-input">
          <input spellcheck="false" type="password" class="form-input status-valid" value="" id="confirm-password" name="confirm-password" placeholder="Confirm password" />
          <i class="ion-eye showPassword"></i>
          <!-- <i class="fa-solid fa-check"></i> -->
          <!-- <i class="fa-solid fa-eye showPassword"></i>
          <input type="checkbox" name="" id="" style="display: none;" checked> -->
        </div>
      </div>
    </div>
    <button id="btn-signup" class="btn-submit">
      <i class="ion-ios-arrow-thin-right"></i>
    </button>
    <input type="hidden" id="captcha">

    <span id="new-user">Have you already account ?
      <a href="/signin" id="redirect-signup">SignIn</a></span>
  </div>
</div>