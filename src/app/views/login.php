<div id="form-login">
  <div class="mb-3">
    <label for="username" class="form-label">Email address</label>
    <input type="text" class="form-control" id="username" name="username">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="mb-3">
    <label for="captcha" class="form-label">Captcha</label>
    <label></label>
    <input type="hidden" id="captcha">
    <div class="g-recaptcha" data-sitekey="<?= $SITE_KEY ?>"></div>
  </div>

  <br/>
  <button type="submit" class="btn btn-primary" id="btn-login">Submit</button>
  <span id="text-or">OR</span>
  <a href="javascript:void(0)" id="fbLink" onclick="fbLogin()">
    <img src="/public/images/facebook.png" width="300" alt="">
  </a>
</div>

