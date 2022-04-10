<form method="POST" autocomplete="off">
  <div class="mb-3">
    <label for="InputEmail" class="form-label">Email address</label>
    <input type="text" class="form-control <?php echo $form?->hasError('email') ? 'is-invalid' : ''?>" id="InputEmail" aria-describedby="emailHelp" name="email" autocomplete="off" value="<?php echo $data['email'] ?? ''?>">
    <div class="invalid-feedback">
      <?php
        echo $form?->getFirstError('email')
      ?>
    </div>
  </div>
  <div class="mb-3">
    <label for="InputPassword" class="form-label">Password</label>
    <input type="password" class="form-control <?php echo $form?->hasError('password') ? 'is-invalid' : ''?>" id="InputPassword" name="password">
    <div class="invalid-feedback">
      <?php
        echo $form?->getFirstError('password')
      ?>
    </div>
  </div>
  <div class="mb-3">
    <label for="InputRePassword" class="form-label">Re enter your password</label>
    <input type="password" class="form-control <?php echo $form?->hasError('confirmPassword') ? 'is-invalid' : ''?>" id="InputRePassword" name="confirmPassword">
    <div class="invalid-feedback">
      <?php
        echo $form?->getFirstError('confirmPassword')
      ?>
    </div>
  </div>
  <div class="g-recaptcha" data-sitekey="<?= $SITE_KEY ?>"></div>
  <br/>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>