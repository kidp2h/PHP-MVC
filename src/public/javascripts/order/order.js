function OrderItem(order, orderDetails) {
    return`
    <div class="order__item">
        <div class="order__products">
            <div class="order-products__header">
                <h2 class="order__status">${
                (order.status == 0 && 'PENDING') ||
                (order.status == 1 && 'COMPLETED') ||
                (order.status == 2 && 'CANCELED')
                }</h2>
            </div>
            <div class="order-products__box">
                ${orderDetails.map(orderDetail => {
                    if(orderDetail.order_id === order.id){
                        return OrderProduct(orderDetail);
                    }
                }).join('')}
            </div>
        </div>
        <div class="order__subtotal">
            <p>Oder date: ${order.created_at}</p>
            <div class="order__total-confirm-canceled">
                <h2>SUBTOTAL: $${order.total}</h2>
                    <div class="order__confirm-canceled-btn" ${(order.status == 1 || order.status == 2) && 'style="display: none;"'}>
                        <button class="order__confirm-btn order__Btn" data-orderId = "${order.id}">CONFIRM ORDER</button>
                        <button class="order__canceled-btn order__Btn" data-orderId = "${order.id}">CANCEL ORDER</button>
                    </div>
            </div>
        </div>
    </div>
    `;
}

function dateTime(date) {
    let d = new Date(date)
    return d.getDate() + '/' + (d.getMonth()+1) + '/' + d.getFullYear() + " " 
}

function OrderItemEmpty() {
    return `
        <div class="order__itemEmpty">
            <i class="fas fa-file-invoice-dollar"></i>
            <h2>No orders yet</h2>
        </div>
    `
}

function OrderProduct(product) {
    product.image = JSON.parse(product.image);
    return `
    <div class="order-product">
        <div class="order-product__info">
            <div class="order-product__imgBox">
                <img
                    src="${product.image[0]}"
                    alt=""
                />
            </div>
            <div class="order-product__content">
                <h2 class="order-product__name">
                    ${product.name}
                </h2>
                <p class="order-product__quantity">Quantity: ${product.quantity}</p>
                <p class="order-product__price">$${product.productPrice}</p>
            </div>
        </div>
        <div class="order-products__priceTotal">
            <p>$${product.productPrice * product.quantity}</p>
        </div>
    </div>
    `
}

const eventOrderPage = {
    handleStatusFilter() {
        $$('.orderPage-filter__item').forEach((item) => {
            item.onclick = async () => {
                if(item.classList.contains('active')) return;
                $('.orderPage-filter__item.active').classList.remove('active');
                item.classList.add('active');
            
                let filter = item.dataset.filter;
                let status;
                switch(filter) {
                    case 'ALL':
                        status = -1;
                        break;
                    case 'PENDING':
                        status = 0;
                        break;
                    case 'COMPLETED':
                        status = 1;
                        break;
                    case 'CANCELLED':
                        status = 2;
                        break;
                    default:
                        console.log('không họp lệ');
                } 
                
                let response = await HttpRequest({
                    url: '/orderByStatus',
                    method: 'POST',
                    data: {status}
                  });
                  if (response.status) {
                    let orderlist = response.orders.map(order => {
                        return OrderItem(order, response.orderDetails);
                    });
                    $('.orderPage__items').innerHTML = orderlist.join('');
                  } else {
                    $('.orderPage__items').innerHTML = OrderItemEmpty();
                  }
            };
        });
    },
    async handleConfirmCanceled(e){
        let isConfirmed = e.target.classList.contains('order__confirm-btn');
        let isCanceled = e.target.classList.contains('order__canceled-btn');
        let statusFilters, statusFilterActive, status, orderStatus;
        if(isConfirmed || isCanceled) {
            statusFilters = $$('.orderPage-filter__item');
            statusFilterActive = [...statusFilters].filter(status => 
                                 status.classList.contains('active'))[0].innerText;

            if(isConfirmed) {
                orderStatus = 'COMPLETED';
                status = 1;
            } else if(isCanceled) {
                orderStatus = 'CANCELED';
                status = 2;
            }

            let orderItem = getParent(e.target, '.order__item');
            if(statusFilterActive == 'ALL') {
                orderItem.querySelector('.order__status').innerHTML = orderStatus;
                orderItem.querySelector('.order__confirm-canceled-btn').style.display = 'none';
            } else if (statusFilterActive == 'PENDING') {
                orderItem.remove();
                if($('.orderPage__items').children.length <= 0) 
                    $('.orderPage__items').innerHTML = OrderItemEmpty();
            }

            let orderId = e.target.dataset.orderid;
            let response = await HttpRequest({
                url: '/orderUpdateStatus',
                method: 'POST',
                data: {orderId, status}
            });
            if (response.status) {
                console.log("update status thành công");
            }
        }
    },
    handleOrderBtnClick() {
        if (!$('#orderPage .orderPage__box')) return;
        $('#orderPage .orderPage__box').addEventListener('click', (e) => {
            this.handleConfirmCanceled(e);
        });
    },
    init() {
        this.handleStatusFilter();
        this.handleOrderBtnClick();
    }
};

eventOrderPage.init();