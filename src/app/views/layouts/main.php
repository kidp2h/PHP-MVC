<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta property="og:image" content="https://source.unsplash.com/random" />
  <link rel="shortcut icon" type="image/svg" href="./images/logo.svg" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
    integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Main</title>
  <link rel="stylesheet" href="/public/styles/base.css">
  <link rel="stylesheet" href="/public/styles/navbar.css">
  <link rel="stylesheet" href="/public/styles/footer.css">
  <link rel="stylesheet" href="/public/styles/home/index.css">
  <link rel="stylesheet" href="/public/styles/shop/apps.css">
  <link rel="stylesheet" href="/public/styles/shop/base.css">
  <link rel="stylesheet" href="/public/styles/shop/rp.css">
  <link rel="stylesheet" href="/public/styles/detail/style.css">
  <link rel="stylesheet" href="/public/styles/detail/responsive.css">
  <link rel="stylesheet" href="/public/styles/cart/cartPage.css">
  <link rel="stylesheet" href="/public/styles/cart/modalCart.css">
  <link rel="stylesheet" href="/public/styles/order/index.css">




</head>

<body>
  <div class="navigation">
    <div class="navigation-container">

      <div class="menu-bars">
        <button class="fancy-burger">
          <span class="rectangle rectangle--top rectangle--small"></span>
          <span class="rectangle rectangle--middle"></span>
          <span class="rectangle rectangle--bottom rectangle--small"></span>
        </button>
        <a href="#home" class="logo">
          <img src="./images/logo.svg" alt="">
          SHIBA
        </a>
      </div>

      <nav class="navbar">
        <a href="/" class="home active">Home</a>
        <a href="/#category" class="category">Category</a>
        <a href="/#feature" class="feature">Featured</a>
        <a href="/shop" class="shop">Shop</a>
        <a href="/about" class="about">About</a>
      </nav>

      <div class="icons">
        <div class="navbar__inputSearch">
          <input class="navbar-input-Search" type="text">
          <i class="fas fa-search" id="nav-search"></i>
        </div>
        <i class="fas fa-search" id="search-icon"></i>
        <a href="/signin" class="user-info">
          <i class="fas fa-user" id="user-icon"></i>
        </a>
        <div class="icon cart" id="cart-icon" data-amount="0">
          <i class="fas fa-shopping-cart"></i>
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
          <!-- <img src="./images/footer.png" alt=""> -->

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

</body>

<script src="/public/javascripts/main.js"></script>
<script src="/public/javascripts/home/event.js"></script>
<script src="/public/javascripts/shop/render.js"></script>
<script src="/public/javascripts/shop/appli.js"></script>
<script src="/public/javascripts/detail/detail.js"></script>
<script src="/public/javascripts/cart/cartEvent.js"></script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>