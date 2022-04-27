<!-- <div class="fb-signin-button" data-width="300" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="true"></div> -->
<div class="form-glass" id="forgotPassword">
  <h1 class="title" style="text-transform: uppercase;">Forgot Password</h1>
    <div class="form-group">
      <label for="email" class="label-input">Email</label>
      <span class="validate-message">Error</span>
      <div class="group-input">
        <input spellcheck="false" type="text" class="form-input status-valid" autocomplete="off" id="email" name="email" placeholder="Email your account" />
        <i class="ion-ios-information-outline"></i>
      </div>
    </div>
    <div class="form-group">
      <label for="captcha" class="label-input">Captcha</label>
      <input type="hidden" id="captcha">
      <span class="validate-message">Error</span>
      <div class="g-recaptcha" data-sitekey="<?= $SITE_KEY ?>"></div>
    </div>
    
    <button id="btn-forgot" class="btn-submit">
      <i class="ion-ios-arrow-thin-right"></i>
    </button>
    <input type="hidden" id="captcha">
</div>
