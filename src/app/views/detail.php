<div class = "detail-content">
        <div class="detail-nav pd-left-right-174">
            <div class="detail-nav__item">
                <span><a href="#">Home</a></span>
                <i class="fas fa-angle-right"></i>
                <span><a href="#">Laptop</a></span>
                <i class="fas fa-angle-right"></i>
                <span class = "nav__item--disable">Blue Laptop</span>
            </div>

            <div class="detail-nav__item">
                <i class="fas fa-border-all detail__nav-icon"></i>
                <i class="fas fa-chevron-right detail__nav-icon"></i>
            </div>
        </div>

        <div id="detail-item" class= "detail-item mg-top-42 mg-bot-42 pd-bot-50 pd-left-right-174">
            <div class="detail-item__slider">
                <?php 
                    $product['image'] = json_decode($product['image']);
                    $listImage = '
                    <div class="item-imgBx item-imgBx--active">
                        <img class="item__img" src="'.$product['image'][0].'" alt="">
                    </div>';
                    for ($i=1; $i < count($product['image']); $i++) { 
                        $listImage.= 
                        '<div class="item-imgBx">
                            <img class="item__img" src="'.$product['image'][$i].'" alt="">
                        </div>';
                    }
                    echo $listImage;
                ?>
                <div class="detail-item__next-prev-btn">
                    <button class="detail-item__prev-btn" onclick="clickSlideBtn(-1)">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="detail-item__next-btn" onclick="clickSlideBtn(1)">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
                <div class="item-infor">
                    <h1 class="item__title"><?=$product['title']?></h1>
                    <div class="item__price-status">
                        <span class="item__price"><?=$product['price']?></span>
                        <span class="item__status">In stock</span>
                    </div>

                    <div class="item__rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <span>(11 reviews)</span>
                    </div>

                    <div class="item-infor__description">
                        <?=$product['description']?>
                    </div>

                    <div class="item__option">
                        <!-- <div class="item__option-color">

                            <h4 class="color__title">
                                    COLOR:
                                    <span></span>
                                </h4>
                                <ul class="color__list">                  
                                    
                                            <li class="color__list-item color--red" data-img="0"></li>                             
                                        
                                            <li class="color__list-item color--pink false" data-img="1"></li>                             
                                        
                                            <li class="color__list-item color--black false" data-img="2"></li>                             
                                        
                                            <li class="color__list-item color--white false color__list-item--active" data-img="3"></li>                             
                                        
                                </ul>
                        </div> -->
                    </div>

                    <div class="item__variation">
                        <div class="variation__choose">
                            <div class="item__change-input">
                                <button class="decrement" id="decrement" onclick="stepper(this)">-</button>
                                <input class="my-input inputQuantity" data-id="12" type="number" min="1" max="100" step="1" value="1" id="my-input" inputmode="numeric">
                                <button class="increment" id="increment" onclick="stepper(this)">+</button>
                            </div>
                            <div class="item__favorative">
                                <i class="far fa-heart " data-index="12" data-wish="0"></i>
                            </div>
                        </div>
                        <button id="buy-it-now" data-id="12" class="buy-it-now-btn addToCart">Add to cart</button>
                    </div>

                    <div class="Img_box">
                        <img class="img_more" src="./images/detail_icon/img_more.png" alt="">
                    </div>

                    <div class="item__support-link">
                        <a class="support-link" href="#">Size Guide</a>
                        <a class="support-link" href="#">Delivery &amp; Return</a>
                        <a class="support-link" href="#">Ask a Question</a>
                    </div>

                    <div class="item__meta">
                        <span class="sku__wrapper">SKU:
                            <span class="sku__value"> M-06</span>
                        </span>
                        <span class="item__meta-Category">Categories:
                            <a href="#" title="">PHONE</a>
                        </span>
                        <span class="item__meta-tags">Tags:
                            <a href="#" title=""> blue,</a>
                            <a href="#" title=""> blue,</a>
                            <a href="#" title=""> blue,</a>
                        </span>
                </div>

                <div class="icon-bar">
                    <i class="fab fa-facebook icon-facebook"></i>
                    <i class="fab fa-twitter icon-twitter"></i>
                    <i class="fas fa-envelope icon-envelope"></i>
                    <i class="fab fa-facebook-messenger icon-messenger"></i>
                </div>
            </div>
        </div>
        

        <div class="detail__more-infor pd-left-right-174 pd-top-50 pd-bot-50">
            <div class="detail__infor-choose-list">
                <ul class="detail__infor-list">
                    <li class="detail__infor-item detail__infor-item--active">Description</li>
                    <li class="detail__infor-item">Additional Information</li>
                    <li class="detail__infor-item">Why Buy From Us</li>
                    <li class="detail__infor-item">Delivery & Returns</li>
                    <!-- <li class="detail__infor-item">Custom tab</li> -->
                    <!-- <li class="detail__infor-item">Reviews</li> -->
                </ul>
            </div>

            <div id="detail__content-infor" class="detail__content-infor">
                 <div class="detail__content-pane detail__content-pane--active"> 
                    <div class="pane-heading">
                        <span class="pane-title">Description</span>
                        <div class="pane-icon">
                            <span class="pane-icon--plus-icon">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="pane-icon--minus-icon"><i class="fas fa-minus"></i></span>
                        </div>
                    </div>
                    <div class="pane-tab-content">
                        <p>
                            Design inspiration lorem ipsum dolor sit amet, 
                            consectetuer adipiscing elit. Morbi commodo, 
                            ipsum sed pharetra gravida, orci magna rhoncus neque, 
                            id pulvinar odio lorem non turpis. Nullam sit amet enim. 
                            Suspendisse id velit vitae ligula volutpat condimentum. 
                            Aliquam erat volutpat. Sed quis velit. Nulla facilisi. 
                            Nulla libero. Vivamus pharetra posuere sapien. Nam consectetuer. 
                            Sed aliquam, nunc eget euismod ullamcorper, lectus nunc 
                            ullamcorper orci.
                        </p>

                        <div class="detail__more-infor-imgBox">
                            <div class="detail__more-infor-img">
                                <img src="/public/images/products/product-18-img-1.jpg" alt="">
                            </div>
                            <div class="detail__more-infor-img">
                                <img src="/public/images/products/product-18-img-2.jpg" alt="">
                            </div>
                            <div class="detail__more-infor-img">
                                <img src="/public/images/products/product-18-img-3.jpg" alt="">
                            </div>
                        </div>

                        <div class="detail__benefit-infor">
                            <div class="detail__benefit-list detail__benefit-list--tr">
                                <div class="detail__benefit-item">
                                    <div class="detail__benefit-img">
                                        <img src="./assets/img/benefit-img_1.png" alt="">
                                    </div>
                                    <div class="detail__benefit-name">
                                        Rain & Water 
                                        <br>
                                        Resistant
                                    </div>
                                </div>

                                <div class="detail__benefit-item">
                                    <div class="detail__benefit-img">
                                        <img src="./assets/img/benefit-img_2.png" alt="">
                                    </div>
                                    <div class="detail__benefit-name">
                                        UV Resistant
                                        <br>
                                        Coatings
                                    </div>
                                </div>

                                <div class="detail__benefit-item">
                                    <div class="detail__benefit-img">
                                        <img src="./assets/img/benefit-img_3.png" alt="">
                                    </div>
                                    <div class="detail__benefit-name">
                                        Corrosion Resistance 
                                        <br>
                                        to Sea water
                                    </div>
                                </div>
                            </div>
                            <div class="detail__benefit-list detail__benefit-list--tl">
                                <div class="detail__benefit-item">
                                    <div class="detail__benefit-img">
                                        <img src="./assets/img/benefit-img_4.png" alt="">
                                    </div>
                                    <div class="detail__benefit-name">
                                        Lead-free
                                        <br>
                                        Powdercoat Finish
                                    </div>
                                </div>

                                <div class="detail__benefit-item">
                                    <div class="detail__benefit-img">
                                        <img src="./assets/img/benefit-img_5.png" alt="">
                                    </div>
                                    <div class="detail__benefit-name">
                                        Resistant to
                                        <br>
                                        Spills
                                    </div>
                                </div>

                                <div class="detail__benefit-item">
                                    <div class="detail__benefit-img">
                                        <img src="./assets/img/benefit-img_6.png" alt="">
                                    </div>
                                    <div class="detail__benefit-name">                               
                                        Recyclable
                                        <br>
                                        Aluminium Frame
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="detail__content-pane"> 
                    <div class="pane-heading">
                        <span class="pane-title">Additional Information</span>
                        <div class="pane-icon">
                            <span class="pane-icon--plus-icon">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="pane-icon--minus-icon"><i class="fas fa-minus"></i></span>
                        </div>
                    </div>   
                    <div class="pane-tab-content">
                        <div class="detail__sp-tab-content">
                            <table class="detail__sp-tab-content-table">
                                <tbody>
                                    <tr class="detail__sp-tab-color-list">
                                        <th class="detail__sp-tab-color-header">Color</th>
                                        <td class="detail__sp-tab-color">
                                            <p>Blue, Red, Cyan, Black, Pink, Grey, Brown</p>
                                        </td>
                                    </tr>

                                    <tr class="detail__sp-tab-size-list">
                                        <th class="detail__sp-tab-size-header">Color</th>
                                        <td class="detail__sp-tab-size">
                                            <p>Blue, Red, Cyan, Black, Pink, Grey, Brown</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>

                <div class="detail__content-pane">
                    <div class="pane-heading">
                        <span class="pane-title">Why Buy From Us</span>
                        <div class="pane-icon">
                            <span class="pane-icon--plus-icon">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="pane-icon--minus-icon"><i class="fas fa-minus"></i></span>
                        </div>
                    </div>
                    <div class="pane-tab-content">
                        <div class="detail__sp-tab-content">
                            <strong>5 Reasons To Be Our Customer:</strong>
                            <table class="detail__sp-tab-content-table">
                                <tbody>
                                    <tr class="detail__sp-tab-reason-list">
                                        <th class="detail__sp-tab-reason-header">
                                            <img src="./assets/img/reasons_1.png" alt="">
                                        </th>
                                        <td class="detail__sp-tab-reason">
                                            <p><strong>Exceptional Support</strong> Our friendly support staff are available all the time to help customers with any questions or concerns. We want our products to deliver the most joy and value with zero hassle. That’s why we insist on being available to assist when the need arises.</p>
                                        </td>
                                    </tr>
                                    <tr class="detail__sp-tab-reason-list">
                                        <th class="detail__sp-tab-reason-header">
                                            <img src="./assets/img/reasons_1.png" alt="">
                                        </th>
                                        <td class="detail__sp-tab-reason">
                                            <p><strong>Exceptional Support</strong> Our friendly support staff are available all the time to help customers with any questions or concerns. We want our products to deliver the most joy and value with zero hassle. That’s why we insist on being available to assist when the need arises.</p>
                                        </td>
                                    </tr>
                                    <tr class="detail__sp-tab-reason-list">
                                        <th class="detail__sp-tab-reason-header">
                                            <img src="./assets/img/reasons_1.png" alt="">
                                        </th>
                                        <td class="detail__sp-tab-reason">
                                            <p><strong>Exceptional Support</strong> Our friendly support staff are available all the time to help customers with any questions or concerns. We want our products to deliver the most joy and value with zero hassle. That’s why we insist on being available to assist when the need arises.</p>
                                        </td>
                                    </tr>
                                    <tr class="detail__sp-tab-reason-list">
                                        <th class="detail__sp-tab-reason-header">
                                            <img src="./assets/img/reasons_1.png" alt="">
                                        </th>
                                        <td class="detail__sp-tab-reason">
                                            <p><strong>Exceptional Support</strong> Our friendly support staff are available all the time to help customers with any questions or concerns. We want our products to deliver the most joy and value with zero hassle. That’s why we insist on being available to assist when the need arises.</p>
                                        </td>
                                    </tr>
                                    <tr class="detail__sp-tab-reason-list">
                                        <th class="detail__sp-tab-reason-header">
                                            <img src="./assets/img/reasons_1.png" alt="">
                                        </th>
                                        <td class="detail__sp-tab-reason">
                                            <p><strong>Exceptional Support</strong> Our friendly support staff are available all the time to help customers with any questions or concerns. We want our products to deliver the most joy and value with zero hassle. That’s why we insist on being available to assist when the need arises.</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="detail__content-pane">
                    <div class="pane-heading">
                        <span class="pane-title">Delivery & Returns</span>
                        <div class="pane-icon">
                            <span class="pane-icon--plus-icon">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="pane-icon--minus-icon"><i class="fas fa-minus"></i></span>
                        </div>
                    </div>
                    <div class="pane-tab-content">
                        <div class="detail__sp-delivery-return"> 
                            <div class="detail__delivery-return pd-top-50">
                                <div class="detail__delivery-return-header pd-bot-50">
                                    <h4>Delivery</h4>
                                </div>
                                <div class="detail__delivery-return-content">
                                    <i class="fas fa-truck"></i>
                                    <div class="delivery-return__detail">
                                        <h3>FREE SHIPPING</h3>
                                        <p>Our free shipping takes between 7 & 14 days from the day of dispatch</p>
                                    </div>                        
                                </div>
                        
                                <div class="detail__delivery-return-content">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <div class="delivery-return__detail">
                                        <h3>TRACKED ORDERS</h3>
                                        <p>After dispatch you will get a tracking code to follow your order's full journey</p>
                                    </div>                        
                                </div>
                            </div>

                            <div class="detail__delivery-return pd-top-50">
                                <div class="detail__delivery-return-header pd-bot-50">
                                    <h4>Return</h4>
                                </div>
                                <div class="detail__delivery-return-content">
                                    <i class="fas fa-undo-alt"></i>
                                    <div class="delivery-return__detail">
                                        <h3>14 DAYS RETURN</h3>
                                        <p>You can return any unwanted item within 14 days and get a full refund</p>
                                    </div>                        
                                </div>
                        
                                <div class="detail__delivery-return-content">
                                    <i class="fas fa-barcode"></i>
                                    <div class="delivery-return__detail">
                                        <h3>FREE RETURNS</h3>
                                        <p>Pre-paid return label will be provided if you need to return your items</p>
                                    </div>                        
                                </div>
                            </div>

                    
                        </div>  
                    </div>
                </div>
            </div>
        </div>

        <div class="recommended pd-left-right-174 pd-top-50 pd-bot-50">
            <div class="recommended-header">
                <h3>You may also like</h3>
            </div>
            <div class="recommended__contents">
                <div class="recommended__products">
                    <div id="recommended__products-wrapper" class="recommended__products-wrapper">
                        <?php 
                            forEach($randomProduct as $product) {
                                echo '
                                <div class="recommended__products-item" style="margin-right: 10px; margin-left: 10px; width: 274.75px;">
                                    <div class="recommended__product-image" data-id="13">
                                        <div class="recommended__img">
                                            <img class="recommended-img recommended-img--active" src="./images/products/product-13-img-1.jpg" alt="">
                                            <img class="recommended-img false" src="./images/products/product-13-img-2.jpg" alt="">
                                            <div class="icon-heart " data-index="13" data-wish="0">
                                                <i class="far fa-heart"></i>
                                                <i class="fas fa-heart"></i>
                                            </div>
                                        </div>

                                        <div class="recommended__add-to-cart">
                                            <div class="recommended__quantity">
                                                <div class="recommended__quantity-input">
                                                    <button class="recommended__decrement">-</button>
                                                    <input class="recommended__input inputQuantity" data-id="13" type="number" min="1" max="100" step="1" value="1" inputmode="numeric">
                                                    <button class="recommended__increment">+</button>
                                                </div>
                                            </div>
                                            <div class="recommended__addToCart addToCart" data-id="13">
                                                <button class="recommended__add-to-cart-btn">
                                                    <span>Add to cart</span>
                                                    <i class="fas fa-shopping-cart"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="recommended-product-infor">
                                        <h3>'.$product['title'].'</h3>
                                        <span>'.$product['price'].'</span>
                                    </div>
                                    
                                </div>
                                ';
                            }
                        ?>
                        
                        <!-- <div class="recommended__products-item" style="margin-right: 10px; margin-left: 10px; width: 274.75px;">
                            <div class="recommended__product-image" data-id="13">
                                <div class="recommended__img">
                                    
                                            <img class="recommended-img recommended-img--active" src="./images/products/product-13-img-1.jpg" alt="">
                                            <img class="recommended-img false" src="./images/products/product-13-img-2.jpg" alt="">

                                    <div class="icon-heart " data-index="13" data-wish="0">
                                        <i class="far fa-heart"></i>
                                        <i class="fas fa-heart"></i>
                                    </div>
                                </div>

                                <div class="recommended__add-to-cart">
                                    <div class="recommended__quantity">
                                        <div class="recommended__quantity-input">
                                            <button class="recommended__decrement">-</button>
                                            <input class="recommended__input inputQuantity" data-id="13" type="number" min="1" max="100" step="1" value="1" inputmode="numeric">
                                            <button class="recommended__increment">+</button>
                                        </div>
                                    </div>
                                    <div class="recommended__addToCart addToCart" data-id="13">
                                        <button class="recommended__add-to-cart-btn">
                                            <span>Add to cart</span>
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="recommended-product-infor">
                                <h3>Galaxy Z Fold 3</h3>
                                <span>$2,458.00</span>
                            </div>
                            <div class="recommended__control">
                                <ul class="recommended__color-list">
                                        <li data-index="1" class="recommended__color-item color--black 
                                                recommended__color-item--active"></li><li data-index="2" class="recommended__color-item color--pink 
                                                false"></li>
                                    </ul>
                            </div>
                        </div> -->
                        <!-- <div class="recommended__products-item" style="margin-right: 10px; margin-left: 10px; width: 274.75px;">
                            <div class="recommended__product-image" data-id="18">
                                <div class="recommended__img">
                                    
                                            <img class="recommended-img recommended-img--active" src="./images/products/product-18-img-1.jpg" alt="">
                                            <img class="recommended-img false" src="./images/products/product-18-img-2.jpg" alt="">
                                            <img class="recommended-img false" src="./images/products/product-18-img-3.jpg" alt="">

                                    <div class="icon-heart " data-index="18" data-wish="0">
                                        <i class="far fa-heart"></i>
                                        <i class="fas fa-heart"></i>
                                    </div>
                                </div>

                                <div class="recommended__add-to-cart">
                                    <div class="recommended__quantity">
                                        <div class="recommended__quantity-input">
                                            <button class="recommended__decrement">-</button>
                                            <input class="recommended__input inputQuantity" data-id="18" type="number" min="1" max="100" step="1" value="1" inputmode="numeric">
                                            <button class="recommended__increment">+</button>
                                        </div>
                                    </div>
                                    <div class="recommended__addToCart addToCart" data-id="18">
                                        <button class="recommended__add-to-cart-btn">
                                            <span>Add to cart</span>
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="recommended-product-infor">
                                <h3>Asus ROG Strix Scope TKL Electro Punk</h3>
                                <span>$233.00</span>
                            </div>
                            <div class="recommended__control">
                                
                            </div>
                        </div>
                        <div class="recommended__products-item" style="margin-right: 10px; margin-left: 10px; width: 274.75px;">
                            <div class="recommended__product-image" data-id="28">
                                <div class="recommended__img">
                                    
                                            <img class="recommended-img recommended-img--active" src="./images/products/product-28-img-1.jpg" alt="">
                                            <img class="recommended-img false" src="./images/products/product-28-img-2.jpg" alt="">

                                    <div class="icon-heart " data-index="28" data-wish="0">
                                        <i class="far fa-heart"></i>
                                        <i class="fas fa-heart"></i>
                                    </div>
                                </div>

                                <div class="recommended__add-to-cart">
                                    <div class="recommended__quantity">
                                        <div class="recommended__quantity-input">
                                            <button class="recommended__decrement">-</button>
                                            <input class="recommended__input inputQuantity" data-id="28" type="number" min="1" max="100" step="1" value="1" inputmode="numeric">
                                            <button class="recommended__increment">+</button>
                                        </div>
                                    </div>
                                    <div class="recommended__addToCart addToCart" data-id="28">
                                        <button class="recommended__add-to-cart-btn">
                                            <span>Add to cart</span>
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="recommended-product-infor">
                                <h3>SteelSeries Arctis Pro 61486</h3>
                                <span>$569.00</span>
                            </div>
                            <div class="recommended__control">
                                
                            </div>
                        </div>
                        <div class="recommended__products-item" style="margin-right: 10px; margin-left: 10px; width: 274.75px;">
                            <div class="recommended__product-image" data-id="24">
                                <div class="recommended__img">
                                    
                                            <img class="recommended-img recommended-img--active" src="./images/products/product-24-img-1.jpg" alt="">
                                            <img class="recommended-img false" src="./images/products/product-24-img-2.jpg" alt="">
                                            <img class="recommended-img false" src="./images/products/product-24-img-3.jpg" alt="">
                                            <img class="recommended-img false" src="./images/products/product-24-img-4.jpg" alt="">

                                    <div class="icon-heart " data-index="24" data-wish="0">
                                        <i class="far fa-heart"></i>
                                        <i class="fas fa-heart"></i>
                                    </div>
                                </div>

                                <div class="recommended__add-to-cart">
                                    <div class="recommended__quantity">
                                        <div class="recommended__quantity-input">
                                            <button class="recommended__decrement">-</button>
                                            <input class="recommended__input inputQuantity" data-id="24" type="number" min="1" max="100" step="1" value="1" inputmode="numeric">
                                            <button class="recommended__increment">+</button>
                                        </div>
                                    </div>
                                    <div class="recommended__addToCart addToCart" data-id="24">
                                        <button class="recommended__add-to-cart-btn">
                                            <span>Add to cart</span>
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="recommended-product-infor">
                                <h3>Galaxy Watch 4 Ite</h3>
                                <span>$1,584.00</span>
                            </div>
                            <div class="recommended__control">
                                
                            </div>
                        </div>
                        <div class="recommended__products-item" style="margin-right: 10px; margin-left: 10px; width: 274.75px;">
                            <div class="recommended__product-image" data-id="21">
                                <div class="recommended__img">
                                    
                                            <img class="recommended-img recommended-img--active" src="./images/products/product-21-img-1.jpg" alt="">
                                            <img class="recommended-img false" src="./images/products/product-21-img-2.jpg" alt="">
                                            <img class="recommended-img false" src="./images/products/product-21-img-3.jpg" alt="">
                
                                    <div class="icon-heart " data-index="21" data-wish="0">
                                        <i class="far fa-heart"></i>
                                        <i class="fas fa-heart"></i>
                                    </div>
                                </div>
                
                                <div class="recommended__add-to-cart">
                                    <div class="recommended__quantity">
                                        <div class="recommended__quantity-input">
                                            <button class="recommended__decrement">-</button>
                                            <input class="recommended__input inputQuantity" data-id="21" type="number" min="1" max="100" step="1" value="1" inputmode="numeric">
                                            <button class="recommended__increment">+</button>
                                        </div>
                                    </div>
                                    <div class="recommended__addToCart addToCart" data-id="21">
                                        <button class="recommended__add-to-cart-btn">
                                            <span>Add to cart</span>
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                
                            <div class="recommended-product-infor">
                                <h3>Leopold FC660MPD Blue Star</h3>
                                <span>$156.00</span>
                            </div>
                            <div class="recommended__control">
                                
                            </div>
                        </div>
                        <div class="recommended__products-item" style="margin-right: 10px; margin-left: 10px; width: 274.75px;">
                            <div class="recommended__product-image" data-id="3">
                                <div class="recommended__img">
                                    
                                            <img class="recommended-img recommended-img--active" src="./images/products/product-3-img-1.jpg" alt="">
                                            <img class="recommended-img false" src="./images/products/product-3-img-2.jpg" alt="">
                                            <img class="recommended-img false" src="./images/products/product-3-img-3.jpg" alt="">
                                            <img class="recommended-img false" src="./images/products/product-3-img-4.jpg" alt="">
                
                                    <div class="icon-heart " data-index="3" data-wish="0">
                                        <i class="far fa-heart"></i>
                                        <i class="fas fa-heart"></i>
                                    </div>
                                </div>
                
                                <div class="recommended__add-to-cart">
                                    <div class="recommended__quantity">
                                        <div class="recommended__quantity-input">
                                            <button class="recommended__decrement">-</button>
                                            <input class="recommended__input inputQuantity" data-id="3" type="number" min="1" max="100" step="1" value="1" inputmode="numeric">
                                            <button class="recommended__increment">+</button>
                                        </div>
                                    </div>
                                    <div class="recommended__addToCart addToCart" data-id="3">
                                        <button class="recommended__add-to-cart-btn">
                                            <span>Add to cart</span>
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                
                            <div class="recommended-product-infor">
                                <h3>GOOGLE HOME</h3>
                                <span>$199.00</span>
                            </div>
                            <div class="recommended__control">
                                
                            </div>
                        </div>
                        <div class="recommended__products-item" style="margin-right: 10px; margin-left: 10px; width: 274.75px;">
                            <div class="recommended__product-image" data-id="12">
                                <div class="recommended__img">
                                    
                                            <img class="recommended-img recommended-img--active" src="./images/products/product-12-img-1.jpg" alt="">
                                            <img class="recommended-img false" src="./images/products/product-12-img-2.jpg" alt="">
                                            <img class="recommended-img false" src="./images/products/product-12-img-3.jpg" alt="">
                                            <img class="recommended-img false" src="./images/products/product-12-img-4.jpg" alt="">
                
                                    <div class="icon-heart " data-index="12" data-wish="0">
                                        <i class="far fa-heart"></i>
                                        <i class="fas fa-heart"></i>
                                    </div>
                                </div>
                
                                <div class="recommended__add-to-cart">
                                    <div class="recommended__quantity">
                                        <div class="recommended__quantity-input">
                                            <button class="recommended__decrement">-</button>
                                            <input class="recommended__input inputQuantity" data-id="12" type="number" min="1" max="100" step="1" value="1" inputmode="numeric">
                                            <button class="recommended__increment">+</button>
                                        </div>
                                    </div>
                                    <div class="recommended__addToCart addToCart" data-id="12">
                                        <button class="recommended__add-to-cart-btn">
                                            <span>Add to cart</span>
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                
                            <div class="recommended-product-infor">
                                <h3>IPHONE 13</h3>
                                <span>$2,103.00</span>
                            </div>
                            <div class="recommended__control">
                                <ul class="recommended__color-list">
                                        <li data-index="1" class="recommended__color-item color--red 
                                                recommended__color-item--active"></li><li data-index="2" class="recommended__color-item color--pink 
                                                false"></li><li data-index="3" class="recommended__color-item color--black 
                                                false"></li><li data-index="4" class="recommended__color-item color--white 
                                                false"></li>
                                    </ul>
                            </div>
                        </div>
                        <div class="recommended__products-item" style="margin-right: 10px; margin-left: 10px; width: 274.75px;">
                            <div class="recommended__product-image" data-id="29">
                                <div class="recommended__img">
                                    
                                            <img class="recommended-img recommended-img--active" src="./images/products/product-29-img-1.jpg" alt="">
                                            <img class="recommended-img false" src="./images/products/product-29-img-2.jpg" alt="">
                                            <img class="recommended-img false" src="./images/products/product-29-img-3.jpg" alt="">
                
                                    <div class="icon-heart " data-index="29" data-wish="0">
                                        <i class="far fa-heart"></i>
                                        <i class="fas fa-heart"></i>
                                    </div>
                                </div>
                
                                <div class="recommended__add-to-cart">
                                    <div class="recommended__quantity">
                                        <div class="recommended__quantity-input">
                                            <button class="recommended__decrement">-</button>
                                            <input class="recommended__input inputQuantity" data-id="29" type="number" min="1" max="100" step="1" value="1" inputmode="numeric">
                                            <button class="recommended__increment">+</button>
                                        </div>
                                    </div>
                                    <div class="recommended__addToCart addToCart" data-id="29">
                                        <button class="recommended__add-to-cart-btn">
                                            <span>Add to cart</span>
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                
                            <div class="recommended-product-infor">
                                <h3>Kingston HyperX Cloud Alpha Gold - Limited Edition</h3>
                                <span>$623.00</span>
                            </div>
                            <div class="recommended__control">
                                
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="recommended__next-prev-btn">
                    <i class="fas fa-chevron-circle-left recommended__prev-btn"></i>
                    <i class="fas fa-chevron-circle-right recommended__next-btn"></i>
                </div>
                </div>
            </div>
        </div>   
    </div>