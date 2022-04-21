
function handleOpenCloseModalCart() {
    if(!$('#cart-icon')) return;
    const navCart = $('#cart-icon');
    const exitCartBtn = $('.btn-exist');
    navCart.onclick = async () => {
        $('.modal').classList.add('active');

        let response = await HttpRequest({
            url: '/cart/modal',
            method: 'GET',
        });
        if(response.status) {
           if(response.productList == ''){
                $('.modal__cart-product-box').innerHTML = modalCartEmpty();
                $('.modal__cart-footer').style.display = 'none';
                $('.modal__cart-subtotal-all').innerHTML = '';
            } else { 
                let productlist = response.productList.map((product) => {
                    return productItemCartModal(product);
                });
                let cartTotalPrice = response.cartTotalPrice;
                $('.modal__cart-product-box').innerHTML = productlist.join('');
                $('.modal__cart-footer').style.display = 'block';
                $('.modal__cart-subtotal-all').innerHTML = `$${cartTotalPrice[0]['totalPrice']}`;
            }
        } else {
            $('.modal__cart-product-box').innerHTML = modalCartEmpty();
            $('.modal__cart-footer').style.display = 'none';
            $('.modal__cart-subtotal-all').innerHTML = '';
        }
    }
    exitCartBtn.onclick = () => {
        $('.modal').classList.remove('active');
    }
}
handleOpenCloseModalCart();

function modalCartEmpty() {
    return `
        <div class = "modal__cart-empty">
            <i class="fas fa-shopping-cart"></i>
            <h4 class="modal__cart-empty-text">Your shopping cart is empty</h4>
        </div>
    `
}

function productItemCartModal(product) {
    return `
        <li class="modal__cart-product-item cartProduct">
        <div class="modal__cart-imgbox">
            <img class="modal__cart-img" src="${product.img}" alt="">
        </div>
        <div class="modal__cart-item-infor">
            <h3 class="modal__cart-item-name">${product.name}</h3>
            <span class="modal__cart-item-price cartProductPrice">$${product.price}</span>
            <div class="modal__cart-item-input">
                <button class="cart__item-decrement"  data-id = "${product.id}">-</button>
                <input type="number" min="1" max="9999" step="1" value="${product.quantity}" class="cart_item-input" data-id = "${product.id}" inputmode="numeric">
                <button class="cart__item-increment" data-id = "${product.id}">+</button>
            </div>
            <div class="modal__cart-delete-icon deleteIcon">
                <i class="far fa-trash-alt deleteIcon" data-id = "${product.id}"></i>
            </div>
        </div>
    </li>
    `;
}

function getParent(element, seletor) {
    while(element.parentElement) {
        if(element.parentElement.matches(seletor)) {
            return element.parentElement
        }
        element = element.parentElement
    }
}

function updatePriceToModalCart() {
    $('.modal__cart-subtotal-all').innerHTML = `$${productTotalPrice()}`;
}

function updatePriceToCartPage(product, amount = 0) {
    if(product) {
        productPrice = product.querySelector('.cartPage__product-cost').innerText.split('$')[1];
        product.querySelector('.cartPage__product-total-cost').innerHTML = `$${productPrice*amount}`;
    }
    $('.cartPage__Subtotal-number').innerHTML = `$${productTotalPrice()}`;
}

function productTotalPrice() { 
    let sumPrice = 0;
    let productPriceList = $$('.cartProductPrice');
    let productQuantityList = $$('.cart_item-input');
    let productQuantity, price;

    productPriceList.forEach((productPrice, index) => {
        productQuantity = productQuantityList[index].value;
        price = productPrice.innerText.split('$')[1];
        sumPrice += parseInt(price)*parseInt(productQuantity);
    })
    return sumPrice;
}

const eventCart = {
    async inputBtnClick(e) {
        let isPlus = e.target.classList.contains('cart__item-increment'); 
        let isMinus = e.target.classList.contains('cart__item-decrement');
        let inputQuantity, product, productId;
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
            product = getParent(e.target,'.cartProduct');
            if($('.modal__cart-product-box')) {
                updatePriceToModalCart();
            }
            if($('#cartPage .product-box')){
                updatePriceToCartPage(product, inputQuantity.value);
            }

            let response = await HttpRequest({
                url: '/cart/edit',
                method: 'POST',
                data: {productId, amount: inputQuantity.value},
            });
            if(response.status) {
                console.log("update kẹc");
            }
        }
    },
    deleteBtnClick() {
        let deleteBtn = $$('.deleteIcon i');
        deleteBtn.forEach((item, index) => {
            item.onclick = async () => {
                productId = item.dataset.id;
                product = getParent(item, '.cartProduct');
                product.remove();
                if($('.modal__cart-product-box')) {
                    updatePriceToModalCart();
                }
                if($('#cartPage .product-box')){
                    updatePriceToCartPage(product);
                }

                let response = await HttpRequest({
                    url: '/cart/delete',
                    method: 'POST',
                    data: {productId},
                    });
                if(response.status) {
                    console.log("xoá kẹc");
                }
            }
        })
        // let deleteBtn = e.target.classList.contains('.deleteIcon i');
        // console.log(deleteBtn);
        // if(deleteBtn) {
        //     productId = e.target.dataset.id;
        //     product = getParent(e.target, '.cartPage__product');
        //     product.remove();

        //     let response = await HttpRequest({
        //     url: '/cart/delete',
        //     method: 'POST',
        //     data: {productId},
        //     });
        //     if(response.status) {
        //         console.log("xoá kẹc");
        //     }
        // }
    },
    btnCartModal() {
        // if(!$('.modal__cart-product-box')) return;
        $('.modal__cart-product-box').addEventListener('click', (e) => {
            this.inputBtnClick(e);
            this.deleteBtnClick();
            // this.inputOnBlur(); 
        });
    },
    btnCartPage() {
        if(!$('#cartPage .product-box')) return;
        $('#cartPage .product-box').addEventListener('click', (e) => {
            this.inputBtnClick(e);
            this.deleteBtnClick();
        });
    },
    init() {
        this.btnCartPage();
        this.btnCartModal();
        // this.deleteBtnClick();
    }
}

eventCart.init();

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
