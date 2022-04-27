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
  <link rel="stylesheet" href="/public/styles/cart/modalStyle.css">
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

  <div class="modal">
            <div class="modal__overlay"></div>

            <div class="modal__cart active">
            <div class="modal__cart-header">
                <h1>CART PRODUCTS</h1>
                <button class="btn-exist">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="box">
                <ul class="modal__cart-product-box">
                  <!-- <li class="modal__cart-product-item">
                      <div class="modal__cart-imgbox">
                          <img class="modal__cart-img" src="./images/products/product-9-img-1.jpg" alt="">
                      </div>
                      <div class="modal__cart-item-infor">
                          <h3 class="modal__cart-item-name">Sony Alpha ILCE-7CL</h3>
                          <span class="modal__cart-item-price">$1,854.00</span>
                          <div class="modal__cart-item-input">
                              <button class="cart__item-decrement" data-id="9">-</button>
                              <input type="number" min="1" max="9999" step="1" value="101" class="cart_item-input" data-id="9" inputmode="numeric">
                              <button class="cart__item-increment" data-id="9">+</button>
                          </div>
                          <div class="modal__cart-delete-icon deleteIcon">
                              <i class="far fa-trash-alt deleteIcon" data-id="9"></i>
                          </div>
                      </div>
                  </li>
              
                  <li class="modal__cart-product-item">
                      <div class="modal__cart-imgbox">
                          <img class="modal__cart-img" src="./images/products/product-6-img-1.jpg" alt="">
                      </div>
                      <div class="modal__cart-item-infor">
                          <h3 class="modal__cart-item-name">BLUETOOTH PINK</h3>
                          <span class="modal__cart-item-price">$109.00</span>
                          <div class="modal__cart-item-input">
                              <button class="cart__item-decrement" data-id="6">-</button>
                              <input type="number" min="1" max="9999" step="1" value="2" class="cart_item-input" data-id="6" inputmode="numeric">
                              <button class="cart__item-increment" data-id="6">+</button>
                          </div>
                          <div class="modal__cart-delete-icon deleteIcon">
                              <i class="far fa-trash-alt deleteIcon" data-id="6"></i>
                          </div>
                      </div>
                  </li>
              
                  <li class="modal__cart-product-item">
                      <div class="modal__cart-imgbox">
                          <img class="modal__cart-img" src="./images/products/product-17-img-1.jpg" alt="">
                      </div>
                      <div class="modal__cart-item-infor">
                          <h3 class="modal__cart-item-name">Lenovo Ideapad 5 Pro</h3>
                          <span class="modal__cart-item-price">$2,784.00</span>
                          <div class="modal__cart-item-input">
                              <button class="cart__item-decrement" data-id="17">-</button>
                              <input type="number" min="1" max="9999" step="1" value="1" class="cart_item-input" data-id="17" inputmode="numeric">
                              <button class="cart__item-increment" data-id="17">+</button>
                          </div>
                          <div class="modal__cart-delete-icon deleteIcon">
                              <i class="far fa-trash-alt deleteIcon" data-id="17"></i>
                          </div>
                      </div>
                  </li>
              
                  <li class="modal__cart-product-item">
                      <div class="modal__cart-imgbox">
                          <img class="modal__cart-img" src="./images/products/product.jpg" alt="">
                      </div>
                      <div class="modal__cart-item-infor">
                          <h3 class="modal__cart-item-name">GOOGLE HOME</h3>
                          <span class="modal__cart-item-price">$199.00</span>
                          <div class="modal__cart-item-input">
                              <button class="cart__item-decrement" data-id="15">-</button>
                              <input type="number" min="1" max="9999" step="1" value="1" class="cart_item-input" data-id="15" inputmode="numeric">
                              <button class="cart__item-increment" data-id="15">+</button>
                          </div>
                          <div class="modal__cart-delete-icon deleteIcon">
                              <i class="far fa-trash-alt deleteIcon" data-id="15"></i>
                          </div>
                      </div>
                  </li>
              
                  <li class="modal__cart-product-item">
                      <div class="modal__cart-imgbox">
                          <img class="modal__cart-img" src="./images/products/product-14-img-1.jpg" alt="">
                      </div>
                      <div class="modal__cart-item-infor">
                          <h3 class="modal__cart-item-name">Fujifilm Instax Mini 11</h3>
                          <span class="modal__cart-item-price">$248.00</span>
                          <div class="modal__cart-item-input">
                              <button class="cart__item-decrement" data-id="14">-</button>
                              <input type="number" min="1" max="9999" step="1" value="1" class="cart_item-input" data-id="14" inputmode="numeric">
                              <button class="cart__item-increment" data-id="14">+</button>
                          </div>
                          <div class="modal__cart-delete-icon deleteIcon">
                              <i class="far fa-trash-alt deleteIcon" data-id="14"></i>
                          </div>
                      </div>
                  </li>
              
                  <li class="modal__cart-product-item">
                      <div class="modal__cart-imgbox">
                          <img class="modal__cart-img" src="./images/products/product-18-img-1.jpg" alt="">
                      </div>
                      <div class="modal__cart-item-infor">
                          <h3 class="modal__cart-item-name">Asus ROG Strix Scope TKL Electro Punk</h3>
                          <span class="modal__cart-item-price">$233.00</span>
                          <div class="modal__cart-item-input">
                              <button class="cart__item-decrement" data-id="18">-</button>
                              <input type="number" min="1" max="9999" step="1" value="1" class="cart_item-input" data-id="18" inputmode="numeric">
                              <button class="cart__item-increment" data-id="18">+</button>
                          </div>
                          <div class="modal__cart-delete-icon deleteIcon">
                              <i class="far fa-trash-alt deleteIcon" data-id="18"></i>
                          </div>
                      </div>
                  </li> -->
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
            
            <!-- <div class="modal__profile">

                <div class="modal-profile__optinons">
                    <button class="btn-options">
                        <i class="fa-solid fa-gear"></i>
                    </button>
                    <ul class="options__menu">
                        <li class="option__item" id="edit-profile">
                            <i class="fa-solid fa-pen-to-square"></i>
                            <span>Edit Profile</span>
                        </li>
                        <li class="option__item" id="change-pass">
                            <i class="fa-solid fa-key"></i>
                            <span>Change Pass</span>
                        </li>
                    </ul>
                </div>
                
                <button class="btn-exist">
                    <i class="fas fa-times"></i>
                </button>

                <div class="modal-profile__main">
                    <div class="modal-profile__imgBox">
                        <img src="./images/user-1.jpg" alt="">
                    </div>

                    <div class="modal-profile__header">
                        <h1>USERNAME</h1>
                    </div>

                    <div class="modal-profile__info">
                        <div class="form">
                            <div class="form__container">
                                <div class="col-groups">
                                    <div class="groups">
                                        <label for="">Full name</label>
                                        <input type="text" class="fullname" name="fullname" rules="required" disabled="">
                                        <span class="message"></span>
                                    </div>
                                    <div class="groups">
                                        <label for="">Address</label>
                                        <input type="text" class="address" name="address" rules="required" disabled="">
                                        <span class="message"></span>
                                    </div>
                                    <div class="groups">
                                        <label for="">Phone</label>
                                        <input type="text" class="phone" name="phone" rules="required|isNumber|min:10" disabled="">
                                        <span class="message"></span>
                                    </div>
                                </div>  
                            </div>  
                            <button class="btn-save">SAVE</button>
                        </div>

                    </div>
                </div>

                <div class="modal-profile__changePass">
                    <div class="form">
                        <div class="form__container">
                            <div class="col-groups">
                                <div class="groups">
                                    <label>Current Password</label>
                                    <div class="input-pass">
                                        <input type="password" class="current-password" name="current-password" rules="required|checkPassCurrent" placeholder="Password">
                                        <span class="show-btn">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                    <span class="message"></span>
                                </div>
                                <div class="groups">
                                    <label>New Password</label>
                                    <div class="input-pass">
                                        <input type="password" class="password" name="password" rules="required|min:6" placeholder="Password">
                                        <span class="show-btn">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                    <span class="message"></span>
                                </div>
                                <div class="groups">
                                    <label for="">New Password Confirm</label>
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
                        <button class="btn-changePass">Change</button>
                        <button class="changeSign">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

            </div> -->
        </div>

</body>

<script src="/public/javascripts/main.js"></script>
<script src="/public/javascripts/home/event.js"></script>
<!-- <script src="/public/javascripts/shop/render.js"></script>
<script src="/public/javascripts/shop/appli.js"></script>
<script src="/public/javascripts/detail/detail.js"></script>  -->
<script src="/public/javascripts/cart/cartEvent.js"></script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>