<div class="modal__body glassmorphism">
  <div class="modal__inner">
    <div id="sign-in">
      <div class="box">
        <div class="form">
          <div class="form__header">
            <h1>Sign In</h1>
          </div>
          <div class="form__container">
            <div class="col-groups">
              <div class="groups">
                <label>Username</label>
                <input type="text" class="username" placeholder="Username">
              </div>
              <div class="groups">
                <label>Password</label>
                <div class="input-pass">
                  <input type="password" class="password" placeholder="Password">
                  <span class="show-btn">
                    <i class="fas fa-eye"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <button class="btn-signin">Sign In</button>
          <p class="hidden">Sign up here</p>
          <button class="changeSign hidden">
            <i class="fas fa-arrow-right"></i>
          </button>
        </div>
      </div>
      <div class="action hidden">
        <img src="./images/logo.svg" alt="">
        <h1 class="header">SHIBA SHOP</h1>
        <p>Chào mừng bạn đến với shop của chúng tôi :></p>
        <button class="changeSign">
          Sign Up
          <i class="fas fa-arrow-right"></i>
        </button>
      </div>
    </div>
    <div id="sign-up">
      <div class="action hidden">
        <img src="./images/logo.svg" alt="">
        <h1 class="header">SHIBA SHOP</h1>
        <p>Hãy đăng ký tài khoản và mua sắm thả ra nào :></p>
        <button class="changeSign changeSignIn">
          <i class="fas fa-arrow-left"></i>
          Sign In
        </button>
      </div>
      <div class="box">
        <div class="form">
          <div class="form__header">
            <h1>Sign Up</h1>
          </div>
          <div class="form__container">
            <div class="col-groups">
              <div class="groups">
                <label for="">Full name</label>
                <input type="text" class="fullname" name="fullname" rules="required" placeholder="Nguyen Van A">
                <span class="message"></span>
              </div>
              <div class="groups">
                <label for="">Address</label>
                <input type="text" class="address" name="address" rules="required" placeholder="184 Main Rd E, St Albans VIC 3021">
                <span class="message"></span>
              </div>
              <div class="groups">
                <label for="">Phone</label>
                <input type="text" class="phone" name="phone" rules="required|isNumber|min:10" placeholder="001 2233 456">
                <span class="message"></span>
              </div>
            </div>
            <div class="col-groups">
              <div class="groups">
                <label for="">Username</label>
                <input type="text" class="username" name="username" rules="required|username" placeholder="Username">
                <span class="message"></span>
              </div>
              <div class="groups">
                <label>Password</label>
                <div class="input-pass">
                  <input type="password" class="password" name="password" rules="required|min:6" placeholder="Password">
                  <span class="show-btn">
                    <i class="fas fa-eye"></i>
                  </span>
                </div>
                <span class="message"></span>
              </div>
              <div class="groups">
                <label for="">Password confirm</label>
                <div class="input-pass">
                  <input type="password" class="password_confirm" name="password_confirm" rules="required|isConfirmed" placeholder="Password confirm">
                  <span class="show-btn">
                    <i class="fas fa-eye"></i>
                  </span>
                </div>
                <span class="message"></span>
              </div>
            </div>
          </div>
          <button class="btn-signup">Sign Up</button>
          <p class="hidden">Sign in here</p>
          <button class="changeSign hidden">
            <i class="fas fa-arrow-left"></i>
          </button>
        </div>

      </div>
    </div>
  </div>
  <button class="btn-exist">
    <i class="fas fa-times"></i>
  </button>
</div>

<br />
<button type="submit" class="btn btn-primary" id="btn-login">Submit</button>
<span id="text-or">OR</span>
<div class="fb-login-button" data-width="300" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="true"></div>