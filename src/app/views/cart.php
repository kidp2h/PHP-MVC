<div id="cartPage">
    <div class="banner">
        <div class="banner__header">
            <h1>view your CART products</h1>
        </div>
        <div class="banner__img-box">
            <img src="https://source.unsplash.com/random" alt="">
        </div>
    </div>

    <div class="cartList__box">
        <div class="cartPage__product-header">
            <div class="cartPage__product-title">PRODUCT</div>
            <div class="cartPage__product-price">PRICE</div>
            <div class="cartPage__product-quantity">QUANTITY</div>
            <div class="cartPage__product-total">TOTAL</div>
        </div>
        <div class="product-box">
        <?php 
            forEach($productList as $product) {
                echo ' 
                <div class="cartPage__product cartProduct">
                    <div class="cartPage__product-item">
                        <div class="cartPage__product-imgBox">
                            <img class="cartPage__product-img" src="./images/products/product-9-img-1.jpg" alt="">
                        </div>

                        <div class="cartPage__product-item-infor">
                            <h3 class="cartPage__product-name">
                                '.$product['name'].'
                            </h3>
                        
                            <div class="modal__cart-delete-icon">
                            <i class="far fa-trash-alt deleteIcon" data-id="'.$product['id'].'"></i>
                            </div>
                        </div>
                    </div>
                    <div class="cartPage__product-item-price">
                        <span class="cartPage__product-cost cartProductPrice" data-price = "'.$product['price'].'">$'.$product['price'].'</span>
                    </div>
                    <div class="cartPage__item-input">                           
                        <div class="modal__cart-item-input">
                            <button class="cart__item-decrement" data-id="'.$product['id'].'">-</button>
                            <input type="number" min="1" max="9999" step="1" value="'.$product['quantity'].'" class="cart_item-input" data-id="'.$product['id'].'" inputmode="numeric">
                            <button class="cart__item-increment" data-id="'.$product['id'].'">+</button>
                        </div>
                    </div>                             
                    <div class="cartPage__product-total">
                        <span class="cartPage__product-total-cost">$'.$product['price']*$product['quantity'].'</span>
                    </div>
                </div>
                ';
            } 
        ?>
        </div>
    </div>

    <div class="cartPage-footer" style="display: flex;">
        <div class="cartPage__Subtotal">
            <h3 class="cartPage__Subtotal-text">Subtotal:</h3>
            <div class="cartPage__Subtotal-number">$5,427.00</div>
        </div>
        <div class="cartPage__Checkout">
            <span class="cartPage__Checkout-text">CHECK OUT</span>
        </div>
    </div>
</div>