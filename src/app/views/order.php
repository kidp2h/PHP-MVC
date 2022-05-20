
<div id="orderPage">
    <div class="banner">
        <div class="banner__header">
            <h1>My Order</h1>
        </div>
        <div class="banner__img-box">
            <img src="https://source.unsplash.com/random" alt="" />
        </div>
    </div>

    <div class="orderPage__box">
        <div class="orderPage__filter">
            <div class="orderPage-filter__item active" data-filter = "ALL">
                <span>ALL</span>
            </div>
            <div class="orderPage-filter__item" data-filter = "PENDING">
                <span>PENDING</span>
            </div>
            <div class="orderPage-filter__item" data-filter = "COMPLETED">
                <span>COMPLETED</span>
            </div>
            <div class="orderPage-filter__item" data-filter = "CANCELLED">
                <span>CANCELLED</span>
            </div>
        </div>

        <div class="orderPage__items">
            <?php 
            if($orders == null) {
                echo '<div class="order__itemEmpty">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <h2>No orders yet</h2>
                </div>
            </div>
            ';
            } else {
                forEach($orders as $order) {
                    if($order['status'] == 0) {
                        $status = 'PENDING';
                        $display = 'flex';
                    } 
                    else if($order['status'] == 1){
                        $status = 'COMPLETED';
                        $display = 'none';
                    }
                    else if($order['status'] == 2) {
                        $status = 'CANCELED';
                        $display = 'none';
                    }
                        
                    echo '<div class="order__item">
                    <div class="order__products">
                        <div class="order-products__header">
                            <h2 class="order__status">'.$status.'</h2>
                        </div>
                        <div class="order-products__box">
                    ';
                
                    forEach($orderDetails as $orderDetail) {
                        $orderDetail['image'] = json_decode($orderDetail['image']);
                        if($orderDetail['order_id'] == $order['id']){
                            echo '
                            <div class="order-product data-storeId = ' . $orderDetail['storeId'] . '">
                                <div class="order-product__info">
                                    <div class="order-product__imgBox">
                                        <img
                                            src="'.$orderDetail['image'][0].'"
                                            alt=""
                                        />
                                    </div>
                                    <div class="order-product__content">
                                        <h2 class="order-product__name">
                                            '.$orderDetail['name'].'
                                        </h2>
                                        <p class="order-product__quantity">Quantity: '.$orderDetail['quantity'].'</p>
                                        <p class="order-product__price">$'.$orderDetail['productPrice'].'</p>
                                    </div>
                                </div>
                                <div class="order-products__priceTotal">
                                    <p>$'.$orderDetail['productPrice']*$orderDetail['quantity'].'</p>
                                </div>
                            </div>
                            ';
                        }
                    }
    
                    echo '</div>
                        </div>
                        <div class="order__subtotal">
                            <p>Oder date: '.$order['created_at'].'</p>
                            <div class="order__total-confirm-canceled">
                                <h2>SUBTOTAL: $'.$order['total'].'</h2>
                                <div class="order__confirm-canceled-btn" style="display: '.$display.';">
                                    <button class="order__confirm-btn order__Btn" data-orderId = "'.$order['id'].'">CONFIRM ORDER</button>
                                    <button class="order__canceled-btn order__Btn" data-orderId = "'.$order['id'].'">CANCEL ORDER</button>
                                </div>
                            </div>
                        </div>';
                }
            }
            ?>
        </div>
    </div>
</div>