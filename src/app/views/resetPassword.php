<!-- <div class="fb-signin-button" data-width="300" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="true"></div> -->
<div class="form-glass" id="forgotPassword">
  <h1 class="title" style="text-transform: uppercase;">RESET PASSWORD</h1>
    <div class="form-group">
      <label for="newPassword" class="label-input">New Password</label>
      <span class="validate-message">Error</span>
      <div class="group-input">
        <input spellcheck="false" type="password" class="form-input status-valid" autocomplete="off" id="newPassword" name="newPassword" placeholder="New password your account" />
        <i class="ion-eye showPassword"></i>
      </div>
    </div>
    <div class="form-group">
      <label for="confirmNewPassword" class="label-input">Confirm New Password</label>
      <span class="validate-message">Error</span>
      <div class="group-input">
        
        <input type="password" spellcheck="false" class="form-input status-valid" autocomplete="off" id="confirmNewPassword" name="confirmNewPassword" placeholder="Confirm your new password" />
        <i class="ion-eye showPassword"></i>
      </div>
    </div>

  
    <button id="btn-reset" class="btn-submit" data-token="<?=$tokenReset?>">
      <i class="ion-ios-arrow-thin-right"></i>
    </button>
    <input type="hidden" id="captcha">
</div>
