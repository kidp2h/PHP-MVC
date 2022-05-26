<div id="cartPage">
    <div class="banner">
        <div class="banner__header">
            <h1>view your CART products</h1>
        </div>
        <div class="banner__img-box">
        </div>
    </div>

    <div class="cartList__box">
        <?php if($productList) { 
            $display = 'flex';
            echo '<div class="cartPage__product-header">
                <div class="cartPage__product-title">PRODUCT</div>
                <div class="cartPage__product-price">PRICE</div>
                <div class="cartPage__product-quantity">QUANTITY</div>
                <div class="cartPage__product-total">TOTAL</div>
            </div>';
         }?>
        <div class="product-box">
        <?php 
            if($productList == null) {
                $display = 'none';
                echo '<div class="cartList__Empty">
                <div class="empty__logo">
                    <i class="ion-bag"></i>
                </div>
                <h2>YOUR CART IS EMPTY</h2>
                <p>You will find a lot of products on our "Shop" page.</p>
                <a href="http://localhost/order"><button>MY ORDER</button></a>
                <a href="http://localhost/shop"><button>RETURN TO SHOP</button></a>
                </div>
                ';
            }
            else{
                forEach($productList as $product) {
                    $product['image'] = json_decode($product['image']);
                    echo ' 
                    <div class="cartPage__product cartProduct">
                        <div class="cartPage__product-item">
                            <div class="cartPage__product-imgBox">
                                <img class="cartPage__product-img" src="'.$product['image'][0].'" alt="">
                            </div>
    
                            <div class="cartPage__product-item-infor">
                                <h3 class="cartPage__product-name">
                                    '.$product['name'].'
                                </h3>
                                <h3 class="cartPage__product-store">
                                    STORE: '.$product['address'].'
                                </h3>
                                <div class="modal__cart-delete-icon">
                                <i class="ion-trash-a deleteIcon" data-id="'.$product['id'].'" data-store = "'.$product['storeId'].'"></i>
                                </div>
                            </div>
                        </div>
                        <div class="cartPage__product-item-price">
                            <span class="cartPage__product-cost cartProductPrice" data-price = "'.$product['productPrice'].'">$'.$product['productPrice'].'</span>
                        </div>
                        <div class="cartPage__item-input">                           
                            <div class="modal__cart-item-input">
                                <button class="cart__item-decrement" data-id="'.$product['id'].'" data-store = "'.$product['storeId'].'">-</button>
                                <input type="number" min="1" max="9999" step="1" value="'.$product['quantity'].'" class="cart_item-input" data-id="'.$product['id'].'" data-store = "'.$product['storeId'].'" inputmode="numeric">
                                <button class="cart__item-increment" data-id="'.$product['id'].'" data-store = "'.$product['storeId'].'">+</button>
                            </div>
                        </div>                             
                        <div class="cartPage__product-total">
                            <span class="cartPage__product-total-cost">$'.$product['productPrice']*$product['quantity'].'</span>
                        </div>
                    </div>
                    ';
                }
            } 
        ?>
        </div>
    </div>

    <div class="cartPage-footer" style="display: <?=$display?>;">
        <div class="cartPage__Subtotal">
            <h3 class="cartPage__Subtotal-text">Subtotal:</h3>
            <div class="cartPage__Subtotal-number">$<?= $cartTotalPrice['totalPrice'] ?></div>
        </div>
        <div class="cartPage__Checkout">
            <span class="cartPage__Checkout-text">CHECK OUT</span>
        </div>
    </div>
</div>