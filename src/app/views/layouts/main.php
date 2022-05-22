<?php use core\Application; 
try {

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="shortcut icon" type="image/svg" href="./images/logo.svg" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/public/icons/css/ionicons.min.css">
  <title><?= $title ?></title>
  <link rel="stylesheet" href="/public/styles/base.css">
  <link rel="stylesheet" href="/public/styles/navbar.css">
  <link rel="stylesheet" href="/public/styles/footer.css">
  <link rel="stylesheet" href="/public/styles/home/index.css">
  <link rel="stylesheet" href="/public/styles/home/responsive.css">
  <link rel="stylesheet" href="/public/styles/shop/apps.css">
  <link rel="stylesheet" href="/public/styles/shop/base.css">
  <link rel="stylesheet" href="/public/styles/shop/rp.css">
  <link rel="stylesheet" href="/public/styles/detail/style.css">
  <link rel="stylesheet" href="/public/styles/detail/responsive.css">
  <link rel="stylesheet" href="/public/styles/cart/cartPage.css">
  <link rel="stylesheet" href="/public/styles/cart/modalCart.css">
  <link rel="stylesheet" href="/public/styles/cart/modalStyle.css">
  <link rel="stylesheet" href="/public/styles/order/orderPage.css">
  <link rel="stylesheet" href="/public/styles/order/rp.css">
  <link rel="stylesheet" href="/public/styles/order/index.css">
  <link rel="stylesheet" href="/public/styles/toast.css">
</head>

<body>
  <div id="toasts"></div>
  <div class="__modal__overlay"></div>
  <div class="__modal" id="modal__information">
    <div class="modal__header">
      <h1>Information</h1>
      <div class="btn-close-modal">
        <i class="ion-close-round"></i> 
      </div>
    </div>
    <div class="__modal__body">
      <div class="form-group">
        <label for="fullName" class="label-input">Full name</label>
        <div class="group-input">
          <input spellcheck="false"  type="text" class="form-input" id="fullName" name="fullName" placeholder="Full Name" value="<?=Application::$user->fullName?>" />
        </div>
      </div>
      <div class="form-group">
        <label for="username" class="label-input">Username</label>
        <div class="group-input">
          <input spellcheck="false"  type="text" class="form-input input-disabled" id="username" name="username" value="<?=Application::$user->username?>" placeholder="Username" disabled/>
        </div>
      </div>
      <div class="form-group">
        <label for="email" class="label-input">Email address</label>
        <div class="group-input">
          <input spellcheck="false"  type="email" class="form-input input-disabled" id="email" name="email" placeholder="Email address"  value="<?=Application::$user->email?>" disabled/>
        </div>
      </div>
      <div class="form-group">
        <label for="phoneNumber" class="label-input">Phone number</label>
        <div class="group-input">
          <input spellcheck="false"  type="number" min="0" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-input <?= Application::$user->isActivePhone ? "input-disabled" : "" ?>" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" value="<?=Application::$user->phoneNumber?>" <?= Application::$user->isActivePhone ? "disabled" : null?>/>
          
          <?php if(Application::$user->isActivePhone){ ?>
            <span class="status__active">
              <i class="ion-ios-checkmark"></i>
              Actived
            </span>
          <?php }else { ?>
            <div class="btn__input btn-send-sms"><a href="javascript:void(0)">SEND OTP</a></div>
          <?php } ?>
        </div>
      </div>
      <?php if(!Application::$user->isActivePhone){ ?>
      <div class="form-group">
        <label for="otp" class="label-input">OTP</label>
        <div class="group-input">
          <input spellcheck="false"  type="number" min="0" class="form-input" id="otp" name="otp" placeholder="OTP" value=""/>
          <div class="btn__input btn-active-sms"><a href="javascript:void(0)">Active</a></div>
        </div>
      </div>
      <?php } ?>
      <div class="form-group">
        <label for="address" class="label-input">Address</label>
        <div class="group-input">
          <input spellcheck="false"  type="text" class="form-input" id="address" name="address" placeholder="Address" value="<?=Application::$user->address?>"/>
        </div>
      </div>
    </div>
    <div class="modal__footer">
      <div class="btn__modal btn-cancel">Cancel</div>
      <div class="btn__modal btn-save-changes">
        Save changes 
      </div>
    </div>
  </div>
  <div class="navigation">
    <div class="navigation-container">

      <div class="menu-bars">
        <button class="fancy-burger">
          <span class="rectangle rectangle--top rectangle--small"></span>
          <span class="rectangle rectangle--middle"></span>
          <span class="rectangle rectangle--bottom rectangle--small"></span>
        </button>
        <a href="/" class="logo">
          <img src="/public/images/logo.svg" alt="">
          SHIBA
        </a>
      </div>

      <nav class="navbar">
        <a href="/" class="home">Home</a>
        <a href="/shop" class="shop">Shop</a>
        <a href="/about" class="about">About</a>
      </nav>

      <select name="store" id="store-select">
        <?php
        foreach ($stores as $store) {
          $op = '';
          if ($store['id'] === $storeCurrent) $op = 'selected="selected"';
          echo '<option ' . $op . ' value="' . $store['id'] . '">' . $store['address'] . '</option>';
        }
        ?>
      </select>

      <div class="icons">
        <div class="navbar__inputSearch">
          <input class="navbar-input-Search" type="text">
          <i class="ion-ios-search-strong" id="nav-search"></i>
        </div>
        <i class="ion-ios-search-strong" id="search-icon"></i>
          <div href="javascript:void(0)" class="user-info userDropdown">
            <ul class="dropdown">
              <?php if(isset($_COOKIE["accessToken"])) {?>
                <li class="dropdown-item openModal"><a href="javascript:void(0)">Profile</a></li>
                <li class="dropdown-item"><a href="/logout">Logout</a></li>
              <?php } else { ?>
                <li class="dropdown-item"><a href="/signin">Sign In</a></li>
                <li class="dropdown-item"><a href="/signup">Sign Up</a></li>
              <?php } ?>
            </ul>
            <i class="ion-person" id="user-icon"></i>
          </div>
        <div class="icon cart" id="cart-icon" data-amount="0">
          <i class="ion-ios-cart"></i>
        </div>
      </div>
    </div>
  </div>

  <div id="app" class="container">
    {{content}}
  </div>

  <div class="footer">
    <div class="footer__top">
      <ul class="footer-track">
        <li class="footer-top__item hiden">
          <i class="fas fa-car"></i>
          <div class="item__content">
            <h3>FREE SHIPPING</h3>
            <p>free shipping for all US order</p>
          </div>
        </li>
        <li class="footer-top__item hiden">
          <i class="fas fa-car"></i>
          <div class="item__content">
            <h3>FREE SHIPPING</h3>
            <p>free shipping for all US order</p>
          </div>
        </li>
        <li class="footer-top__item hiden">
          <i class="fas fa-car"></i>
          <div class="item__content">
            <h3>FREE SHIPPING</h3>
            <p>free shipping for all US order</p>
          </div>
        </li>
        <li class="footer-top__item hiden">
          <i class="fas fa-car"></i>
          <div class="item__content">
            <h3>FREE SHIPPING</h3>
            <p>free shipping for all US order</p>
          </div>
        </li>
        <li class="footer-top__item">
          <i class="fas fa-car"></i>
          <div class="item__content">
            <h3>FREE SHIPPING</h3>
            <p>free shipping for all US order</p>
          </div>
        </li>
        <li class="footer-top__item">
          <i class="fas fa-life-ring"></i>
          <div class="item__content">
            <h3>SUPPORT 24/7</h3>
            <p>you have 30 days to return</p>
          </div>
        </li>
        <li class="footer-top__item">
          <i class="fas fa-undo-alt"></i>
          <div class="item__content">
            <h3>30 DAYS RETURN</h3>
            <p>free shipping for all US order</p>
          </div>
        </li>
        <li class="footer-top__item">
          <i class="fas fa-fingerprint"></i>
          <div class="item__content">
            <h3>100% PAYMENT SECURE</h3>
            <p>payment 100% secure</p>
          </div>
        </li>
        <li class="footer-top__item">
          <i class="fas fa-car"></i>
          <div class="item__content">
            <h3>FREE SHIPPING</h3>
            <p>free shipping for all US order</p>
          </div>
        </li>
        <li class="footer-top__item">
          <i class="fas fa-life-ring"></i>
          <div class="item__content">
            <h3>SUPPORT 24/7</h3>
            <p>you have 30 days to return</p>
          </div>
        </li>
        <li class="footer-top__item">
          <i class="fas fa-undo-alt"></i>
          <div class="item__content">
            <h3>30 DAYS RETURN</h3>
            <p>free shipping for all US order</p>
          </div>
        </li>
        <li class="footer-top__item">
          <i class="fas fa-fingerprint"></i>
          <div class="item__content">
            <h3>100% PAYMENT SECURE</h3>
            <p>payment 100% secure</p>
          </div>
        </li>
      </ul>
    </div>
    <div class="footer__container">
      <div class="footer-content">
        <div class="footer-logo">
          <a href="#">
            <h2 class="name">SHIBA</h2>
          </a>

          <a href="https://www.google.com/maps/" class="address">
            <i class="fas fa-map-marker-alt"></i>
            184 Main Rd E, St Albans VIC 3021, Australia
          </a>
          <a href="mailto:shibashop@company.com" class="mail">
            <i class="far fa-envelope"></i>
            shibashop@company.com
          </a>
          <a href="tel:0012233456" class="phone">
            <i class="fas fa-phone"></i>
            +001 2233 456
          </a>
          <ul class="footer-logo__social">
            <li class="social__icon">
              <a href="" id="icon-facebook"><i class="fab fa-facebook-f"></i></a>
            </li>
            <li class="social__icon">
              <a href="" id="icon-twitter"><i class="fab fa-twitter"></i></a>
            </li>
            <li class="social__icon">
              <a href="" id="icon-instagram"><i class="fab fa-instagram"></i></a>
            </li>
            <li class="social__icon">
              <a href="" id="icon-youtube"> <i class="fab fa-youtube"></i></a>
            </li>
          </ul>
        </div>
        <div class="information">
          <h2 class="header">INFOMATION</h2>
          <a href="#about" class="content">About Us</a>
          <a href="#home" class="content">Home Us</a>
          <a href="#category" class="content">Category Us</a>
          <a href="#feature" class="content">Feature Us</a>
          <a href="#shop" class="content">Shop Us</a>
        </div>
        <div class="useful">
          <h2 class="header">USEFUL LINKS</h2>
          <a href="#home" class="content"> Store Location</a>
          <a href="#home" class="content">Latest News</a>
          <a onclick="if($('#profile-icon')) $('#profile-icon').click();" class="content">My Account</a>
          <a href="#home" class="content">Size Guide</a>
          <a href="#home" class="content">Portfolio</a>
          <a href="#home" class="content">FAQs</a>
        </div>
        <div class="newsletter">
          <h2 class="header">NEWSLETTER SIGNUP</h2>
          <p class="content">Subscribe to our newsletter and get 10% off your first purchase</p>
          <form class="mail-user">
            <input name="email" type="email" placeholder="Your email address">
            <button type="submit" class="btn">Subcribe</button>
          </form>

        </div>

      </div>
      <div class="footer__img">
        <img src="./images/footer.jpg" alt="">
      </div>
    </div>
    <div class="footer__bottom">
      <p>Copyright © 2021 Shiba Shop. All Rights Reserved.</p>
    </div>
  </div>

  <div class="modal">
            <div class="modal__overlay"></div>

            <div class="modal__cart active">
            <div class="modal__cart-header">
                <h1>CART PRODUCTS</h1>
                <button class="btn-exist">
                    <i class="ion-close-round"></i>
                </button>
            </div>
            
            <div class="box">
                <ul class="modal__cart-product-box">
                </ul>
            </div>

            <div class="modal__cart-footer" style="display: none;">
                <div class="modal__cart-subtotal">
                    <h3 class="subtotal-text">Subtotal:</h3>
                    <span class="modal__cart-subtotal-all"></span>
                </div>
                <div class="modal__cart-view-cart">
                    <span class="modal__cart-view-cart-btn">
                    <a href="/cart">VIEW CART</a></span>
                </div>
            </div>
        </div>
            
            <div class="modal__noti glassmorphism ">
                <div class="modal-noti__logo">
                    <i class="far fa-check-circle" id="icon-success"></i>
                    <i class="fas fa-times" id="icon-error"></i>
                </div> 
                <input type="text">   
                <h2 class="modal-noti__disc success"></h2>
                <h2 class="modal-noti__disc error"></h2>
                <button class="btn-noti glassmorphism ">OK</button>
            </div> 
        </div>

</body>

<script src="/public/javascripts/main.js"></script>
<script src="/public/javascripts/home/event.js"></script>
<!-- <script src="/public/javascripts/shop/render.js"></script> -->
<script src="/public/javascripts/shop/appli.js"></script>
<script src="/public/javascripts/detail/detail.js"></script>
<script src="/public/javascripts/cart/cartEvent.js"></script>
<script src="/public/javascripts/order/order.js"></script>
<script src="/public/javascripts/toast.js"></script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</html>
<?php } catch (\Throwable $th){

  var_dump($th);
}
  
    //throw $th;
  
?>