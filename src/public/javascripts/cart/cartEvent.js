// console.log("Cái con kẹc 🙂")

// function openModalCart() {
//     if($('.navbar__cart') == null) return;
//     const navCart = $('.navbar__cart');

//     navCart.onclick = function () {
//         window.location.href = BASE_URL + '/cart/cartPage.html';
//     }
// }

// openModalCart();

// function closeBtnClick() {
//     const closeBtn = $$('.close-btn');
//     closeBtn.forEach((btn) => {
//         btn.onclick = () => {
//             if($('.modal__cart.active')) {
//                 $('.modal__cart.active').classList.remove('active');
//             } 
//         }
//     });
// }

// closeBtnClick();

function modalCartEmpty() {
    return `
        <div class = "modal__cart-empty">
            <i class="fas fa-shopping-cart"></i>
            <h4 class="modal__cart-empty-text">Your shopping cart is empty</h4>
        </div>
    `
}

function cartPageEmpty() {
    return `    <div class="cartList__Empty">
                    <div class="empty__logo">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <h2>GIỎ HÀNG CỦA BẠN ĐANG TRỐNG</h2>
                    <p>Bạn chưa có sản phẩm nào trong giỏ hàng</p>
                    
                    <p>Bạn sẽ tìm thấy rất nhiều món bánh ngon ở cửa hàng chúng tôi.</p>
                    <button>
                        <a href="/orderPage/orderPage.html">XEM ĐƠN HÀNG</a>
                    </button>
                    <button>
                        <a href="">TIẾP TỤC MUA HÀNG</a>
                    </button>
                </div>`;
}

function productItemCartModel(product) {
    return `
        <li class="modal__cart-product-item">
            <div class="modal__cart-delete-icon">
                    <i class="far fa-times-circle deleteIcon" data-id = "${product.id}"></i>
            </div>

            <div class="modal__cart-imgbox">
                <img class="modal__cart-img" src="../product.jpg" alt="">
            </div>
        <div class="modal__cart-item-infor">
            <h3 class="modal__cart-item-name">${product.name}</h3>
            <span class="modal__cart-item-price">${product.sale}đ</span>
            <div class="modal__cart-item-input">
                <button class="cart__item-decrement"  data-id = "${product.id}">-</button>
                <input type="number" min="1" max="9999" step="1" value="${product.quantity}" class="cart_item-input" data-id = "${product.id}" inputmode="numeric">
                <button class="cart__item-increment" data-id = "${product.id}">+</button>
            </div>       
        </div>
    </li>
    `;
}

function productItemCartPage(product) {
    return `
        <div class="cartPage__product">
        <div class="cartPage__product-item">
            <div class="cartPage__product-imgBox">
                <img class="cartPage__product-img" src="../product.jpg" alt="">
            </div>

            <div class="cartPage__product-item-infor">
                <h3 class="cartPage__product-name">
                    ${product.name}
                </h3>
            
                <div class="modal__cart-delete-icon">
                    <i class="far fa-times-circle deleteIcon" data-id = "${product.id}"></i>
                </div>
            </div>
        </div>
        <div class="cartPage__product-item-price">
            <span class="cartPage__product-cost">${product.sale}đ</span>
        </div>
        <div class="cartPage__item-input">                           
            <div class="modal__cart-item-input">
                <button class="cart__item-decrement"  data-id = "${product.id}">-</button>
                <input type="number" min="1" max="999" step="1" value="${product.quantity}" class="cart_item-input" data-id = "${product.id}"  inputmode="numeric">
                <button class="cart__item-increment" data-id = "${product.id}">+</button>
            </div>
        </div>                             
        <div class = "cartPage__product-total">
            <span class="cartPage__product-total-cost">${product.sale * product.quantity}đ</span>
        </div>
    </div>
    `;
}

function productTotalPrice() {
    let productList = $$('.cartPage__product');
    let sumPrice = 0;
    productList.forEach((product) => {
        productPrice = product.querySelector('.cartPage__product-cost').innerText.split('$')[1];
        productQuantity = product.querySelector('.cart_item-input').value;
        sumPrice += productPrice * productQuantity;
    });
    return sumPrice;
}

function renderCartPage() {
    const url = BASE_API_URL + API_CART;
    sendRequest('GET', url, {}, (res) => {
        if(res.status == 1) {
            const htmls = res.productList.map((product) => {
                return productItemCartPage(product);
            }).join('');

            if($('.product-box')) {
                $('.product-box').innerHTML = htmls;
                $('.cartPage__Subtotal-number').innerHTML = `${productTotalPrice()}đ`;
                eventCart.init();
            }
        }
    })
}

function getParent(element, seletor) {
    while(element.parentElement) {
        if(element.parentElement.matches(seletor)) {
            return element.parentElement
        }
        element = element.parentElement
    }
}
// renderCartPage();

// function getParrent(element, seletor) {
//     while(element.parentElement) {
//         if(element.parentElement.matches(seletor)) {
//             return element.parentElement
//         }
//         element = element.parentElement
//     }
// }

const eventCart = {
    async inputBtnClick(e) {
        let isPlus = e.target.classList.contains('cart__item-increment'); 
        let isMinus = e.target.classList.contains('cart__item-decrement');
        let inputQuantity, product, productId, productPrice;
        if (isPlus || isMinus) {
            inputQuantity = e.target.parentElement.querySelector('.cart_item-input');
            productId = e.target.dataset.id;
            if(isPlus) {
                if (parseInt(inputQuantity.value) >= parseInt(inputQuantity.max)) return;
                ++inputQuantity.value;
            }
            else if(isMinus) {
                --inputQuantity.value;
            }
            product = getParent(e.target,'.cartPage__product');
            productPrice = product.querySelector('.cartPage__product-cost').innerText.split('$')[1];
            product.querySelector('.cartPage__product-total-cost').innerHTML = `$${productPrice*inputQuantity.value}`;
            $('.cartPage__Subtotal-number').innerHTML = `$${productTotalPrice()}`;

            let response = await HttpRequest({
                url: '/cart/edit',
                method: 'POST',
                data: {productId, amount: inputQuantity.value},
                });
            if(response.status) {
                console.log("kẹc");
            }
        }
    },
    btnCartPage() {
        $('#cartPage .product-box').addEventListener('click', (e) => {
            this.inputBtnClick(e);
        });
    }
    ,
    init() {
        this.btnCartPage();
    }
}

eventCart.init();

// $('#cartPage .product-box').addEventListener('click', (e) => {
//     console.log('kẹc')
// });

// eventCart.init();


// editQuantity(e)
// function kec() {
//     console.log("Cái con kẹc 🙂")
// }
// kec();


function AddToCart() {
    let inputQuantity = $$('.inputQuantity');
    let addToCart = $$('.addToCart');
    for(const [index, item] of addToCart.entries()) {
        item.onclick = async (e) => {
                let productId = item.dataset.id;
                let amount = inputQuantity[index].value;
    
                let response = await HttpRequest({
                    url: '/cart',
                    method: 'POST',
                    data: {productId, amount},
                    });
                if(response.status) {
                    console.log("kẹc");
                }
            }
        }
}

AddToCart();
