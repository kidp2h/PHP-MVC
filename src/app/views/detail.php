<div class = "detail-content">
        <div class="detail-nav">
            <div class="detail-nav__item pd-left-right-174">
                <span><a href="#">HOME</a></span>
                <i class="ion-chevron-right"></i>
                <span><a href="#"><?=$product['title']?></a></span>
                <i class="ion-chevron-right"></i>
                <span class = "nav__item--disable"><?=$product['name']?></span>
            </div>

            <!-- <div class="detail-nav__item">
                <i class="ion-chevron-right detail__nav-icon"></i>
                <i class="ion-chevron-right detail__nav-icon"></i>
            </div> -->
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
                        <i class="ion-chevron-left"></i>
                    </button>
                    <button class="detail-item__next-btn" onclick="clickSlideBtn(1)">
                        <i class="ion-chevron-right"></i>
                    </button>
                </div>
            </div>
                <div class="item-infor">
                    <h1 class="item__title"><?=$product['name']?></h1>
                    <div class="item__price-status">
                        <span class="item__price">$<?=$product['productPrice']?></span>
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
                                <input class="my-input inputQuantity" data-id="<?=$product['id']?>" type="number" min="1" max="100" step="1" value="1" id="my-input" inputmode="numeric">
                                <button class="increment" id="increment" onclick="stepper(this)">+</button>
                            </div>
                        </div>
                        <button id="buy-it-now" data-id="<?=$product['id']?>" data-store="<?=$product['storeId']?>" class="buy-it-now-btn addToCart">Add to cart</button>
                    </div>

                    <div class="Img_box">
                        <img class="img_more" src="/public/images/detail_icon/img_more.png" alt="">
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
                            <a href="#" title=""><?=$product['title']?></a>
                        </span>
                        <span class="item__meta-tags">Tags:
                            <a href="#" title=""> blue,</a>
                            <a href="#" title=""> blue,</a>
                            <a href="#" title=""> blue</a>
                        </span>
                </div>

                <div class="icon-bar">
                    <i class="ion-social-facebook icon-facebook"></i>
                    <i class="ion-social-twitter icon-twitter"></i>
                    <i class="ion-android-mail icon-envelope"></i>
                    <i class="ion-chatbubble-working icon-messenger"></i>
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
                                <i class="ion-plus-round"></i>
                            </span>
                            <span class="pane-icon--minus-icon"><i class="ion-minus-round"></i></span>
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
                            <?php

                            foreach($product['image'] as $image) {
                                echo '
                                <div class="detail__more-infor-img">
                                    <img src="'.$image.'" alt="">
                                </div>';
                            }
                            ?>
                            
                        </div>

                        <div class="detail__benefit-infor">
                            <div class="detail__benefit-list detail__benefit-list--tr">
                                <div class="detail__benefit-item">
                                    <div class="detail__benefit-img">
                                        <img src="/public/images/detail_icon/benefit-img_1.png" alt="">
                                    </div>
                                    <div class="detail__benefit-name">
                                        Rain & Water 
                                        <br>
                                        Resistant
                                    </div>
                                </div>

                                <div class="detail__benefit-item">
                                    <div class="detail__benefit-img">
                                        <img src="/public/images/detail_icon/benefit-img_2.png" alt="">
                                    </div>
                                    <div class="detail__benefit-name">
                                        UV Resistant
                                        <br>
                                        Coatings
                                    </div>
                                </div>

                                <div class="detail__benefit-item">
                                    <div class="detail__benefit-img">
                                        <img src="/public/images/detail_icon/benefit-img_3.png" alt="">
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
                                        <img src="/public/images/detail_icon/benefit-img_4.png" alt="">
                                    </div>
                                    <div class="detail__benefit-name">
                                        Lead-free
                                        <br>
                                        Powdercoat Finish
                                    </div>
                                </div>

                                <div class="detail__benefit-item">
                                    <div class="detail__benefit-img">
                                        <img src="/public/images/detail_icon/benefit-img_5.png" alt="">
                                    </div>
                                    <div class="detail__benefit-name">
                                        Resistant to
                                        <br>
                                        Spills
                                    </div>
                                </div>

                                <div class="detail__benefit-item">
                                    <div class="detail__benefit-img">
                                        <img src="/public/images/detail_icon/benefit-img_6.png" alt="">
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
                                <i class="ion-plus-round"></i>
                            </span>
                            <span class="pane-icon--minus-icon"><i class="ion-minus-round"></i></span>
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
                                <i class="ion-plus-round"></i>
                            </span>
                            <span class="pane-icon--minus-icon"><i class="ion-minus-round"></i></span>
                        </div>
                    </div>
                    <div class="pane-tab-content">
                        <div class="detail__sp-tab-content">
                            <strong>5 Reasons To Be Our Customer:</strong>
                            <table class="detail__sp-tab-content-table">
                                <tbody>
                                    <tr class="detail__sp-tab-reason-list">
                                        <th class="detail__sp-tab-reason-header">
                                            <img src="/public/images/detail_icon/reasons_1.png" alt="">
                                        </th>
                                        <td class="detail__sp-tab-reason">
                                            <p><strong>Exceptional Support</strong> Our friendly support staff are available all the time to help customers with any questions or concerns. We want our products to deliver the most joy and value with zero hassle. That’s why we insist on being available to assist when the need arises.</p>
                                        </td>
                                    </tr>
                                    <tr class="detail__sp-tab-reason-list">
                                        <th class="detail__sp-tab-reason-header">
                                            <img src="/public/images/detail_icon/reasons_2.png" alt="">
                                        </th>
                                        <td class="detail__sp-tab-reason">
                                            <p><strong>Exceptional Support</strong> Our friendly support staff are available all the time to help customers with any questions or concerns. We want our products to deliver the most joy and value with zero hassle. That’s why we insist on being available to assist when the need arises.</p>
                                        </td>
                                    </tr>
                                    <tr class="detail__sp-tab-reason-list">
                                        <th class="detail__sp-tab-reason-header">
                                            <img src="/public/images/detail_icon/reasons_3.png" alt="">
                                        </th>
                                        <td class="detail__sp-tab-reason">
                                            <p><strong>Exceptional Support</strong> Our friendly support staff are available all the time to help customers with any questions or concerns. We want our products to deliver the most joy and value with zero hassle. That’s why we insist on being available to assist when the need arises.</p>
                                        </td>
                                    </tr>
                                    <tr class="detail__sp-tab-reason-list">
                                        <th class="detail__sp-tab-reason-header">
                                            <img src="/public/images/detail_icon/reasons_4.png" alt="">
                                        </th>
                                        <td class="detail__sp-tab-reason">
                                            <p><strong>Exceptional Support</strong> Our friendly support staff are available all the time to help customers with any questions or concerns. We want our products to deliver the most joy and value with zero hassle. That’s why we insist on being available to assist when the need arises.</p>
                                        </td>
                                    </tr>
                                    <tr class="detail__sp-tab-reason-list">
                                        <th class="detail__sp-tab-reason-header">
                                            <img src="/public/images/detail_icon/reasons_5.png" alt="">
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
                                <i class="ion-plus-round"></i>
                            </span>
                            <span class="pane-icon--minus-icon"><i class="ion-minus-round"></i></span>
                        </div>
                    </div>
                    <div class="pane-tab-content">
                        <div class="detail__sp-delivery-return"> 
                            <div class="detail__delivery-return pd-top-50">
                                <div class="detail__delivery-return-header">
                                    <h4>Delivery</h4>
                                </div>
                                <div class="detail__delivery-return-content">
                                    <i class="ion-android-car"></i>
                                    <div class="delivery-return__detail">
                                        <h3>FREE SHIPPING</h3>
                                        <p>Our free shipping takes between 7 & 14 days from the day of dispatch</p>
                                    </div>                        
                                </div>
                        
                                <div class="detail__delivery-return-content">
                                    <i class="ion-ios-location"></i>
                                    <div class="delivery-return__detail">
                                        <h3>TRACKED ORDERS</h3>
                                        <p>After dispatch you will get a tracking code to follow your order's full journey</p>
                                    </div>                        
                                </div>
                            </div>

                            <div class="detail__delivery-return pd-top-50">
                                <div class="detail__delivery-return-header">
                                    <h4>Return</h4>
                                </div>
                                <div class="detail__delivery-return-content">
                                    <i class="ion-arrow-return-left"></i>
                                    <div class="delivery-return__detail">
                                        <h3>14 DAYS RETURN</h3>
                                        <p>You can return any unwanted item within 14 days and get a full refund</p>
                                    </div>                        
                                </div>
                        
                                <div class="detail__delivery-return-content">
                                    <i class="ion-ios-barcode"></i>
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
                                $product['image'] = json_decode($product['image']);
                                echo '
                                <div class="recommended__products-item">
                                    <div class="recommended__product-image" data-id="13">
                                        <div class="recommended__img">
                                            <img class="recommended-img recommended-img--active" src="'. $product['image'][0].'" alt="">
                                            <img class="recommended-img false" src="'.$product['image'][1].'" alt="">
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
                                            <div class="recommended__addToCart addToCart" data-id="'.$product['id'].'" data-store="'.$product['storeId'].'">
                                                <button class="recommended__add-to-cart-btn">
                                                    <span>Add to cart</span>
                                                    <i class="ion-android-cart"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="recommended-product-infor">
                                        <h3>'.$product['name'].'</h3>
                                        <h3 class="recommended-product-infor__store">STORE: '.$product['address'].'</h3>
                                        <span>$'.$product['productPrice'].'</span>
                                    </div>
                                    
                                </div>
                                ';
                            }
                        ?>
                    </div>
                </div>
                <div class="recommended__next-prev-btn">
                    <i class="ion-android-arrow-dropleft-circle recommended__prev-btn"></i>
                    <i class="ion-android-arrow-dropright-circle recommended__next-btn"></i>
                </div>
                </div>
            </div>
        </div>   
    </div>