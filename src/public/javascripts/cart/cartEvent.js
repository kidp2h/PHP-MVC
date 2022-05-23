function handleOpenCloseModalCart() {
  // if (!$('#cart-icon')) return;
  //
  // const exitCartBtn = $('.btn-exist');

  //   let response = await HttpRequest({
  //     url: '/cart/modal',
  //     method: 'GET',
  //   });
  //   if (response.status) {
  //     if (response.productList == '') {
  //       $('.modal__cart-footer').style.display = 'none';
  //       $('.modal__cart-subtotal-all').innerHTML = '';
  //       $('.modal__cart-product-box').innerHTML = modalCartEmpty();
  //     } else {
  //       let productlist = response.productList.map((product) => {
  //         console.log(product.storeId);
  //         return productItemCartModal(product);
  //       });
  //       let cartTotalPrice = response.cartTotalPrice;
  //       $('.modal__cart-product-box').innerHTML = productlist.join('');
  //       $('.modal__cart-footer').style.display = 'block';
  //       $(
  //         '.modal__cart-subtotal-all'
  //       ).innerHTML = `$${cartTotalPrice['totalPrice']}`;
  //     }
  //   } else {
  //     $('.modal__cart-footer').style.display = 'none';
  //     $('.modal__cart-subtotal-all').innerHTML = '';
  //     $('.modal__cart-product-box').innerHTML = modalCartEmpty();
  //   }
  // };
  const exitCartBtn = $('.btn-exist');
  const navCart = $('#cart-icon');
  navCart.onclick = async () => {
    $('.modal').classList.add('active');
  };
  exitCartBtn.onclick = () => {
    $('.modal').classList.remove('active');
  };
}
handleOpenCloseModalCart();

function cartPageEmpty() {
  return `    <div class="cartList__Empty">
                  <div class="empty__logo">
                      <i class="fas fa-shopping-bag"></i>
              
                  </div>
                  <h2>YOUR CART IS EMPTY.</h2>
                  <p>You don't have any products in the cart yet.</p>
                  
                  <p>You will find a lot of products on our "Shop" page.</p>

                  <button onclick = " window.location.hash = '#order'">MY ORDER</button>
                  <button onclick = " window.location.hash = '#shop'">RETURN TO SHOP</button>
              </div>`;
}

function modalCartEmpty() {
  return `
        <div class = "modal__cart-empty">
            <i class="fas fa-shopping-cart"></i>
            <h4 class="modal__cart-empty-text">Your shopping cart is empty</h4>
        </div>
    `;
}

function productItemCartModal(product) {
  // if(product.image) {
    product.image = JSON.parse(product.image);
  // }
  return `
        <li class="modal__cart-product-item cartProduct" data-id = "${product.id}" data-store = "${product.storeId}">
        <div class="modal__cart-imgbox">
            <img class="modal__cart-img" src="${product.image[0] || product.image}" alt="">
        </div>
        <div class="modal__cart-item-infor">
            <h3 class="modal__cart-item-name">${product.name}</h3>
            <span class="modal__cart-item-price cartProductPrice" data-price = "${product.productPrice}">$${product.productPrice}</span>
            <div class="modal__cart-item-input">
                <button class="cart__item-decrement"  data-id = "${product.id}" data-store = "${product.storeId}">-</button>
                <input type="number" min="1" max="9999" step="1" value="${product.quantity}" class="cart_item-input" data-id = "${product.id}" data-store = "${product.storeId}" inputmode="numeric">
                <button class="cart__item-increment" data-id = "${product.id}" data-store = "${product.storeId}">+</button>
            </div>
            <div class="modal__cart-delete-icon">
                <i class="ion-trash-a deleteIcon" data-id = "${product.id}" data-store = "${product.storeId}"></i>
            </div>
        </div>
    </li>
    `;
}

function getParent(element, seletor) {
  while (element.parentElement) {
    if (element.parentElement.matches(seletor)) {
      return element.parentElement;
    }
    element = element.parentElement;
  }
}

function updatePriceToCart(product = null, amount = 0) {
  if ($('.modal__cart-product-box')) {
    $('.modal__cart-subtotal-all').innerHTML = `$${productTotalPrice()}`;
  }
  if ($('#cartPage .product-box')) {
    if (product) {
      productPrice = product.querySelector('.cartPage__product-cost').dataset
        .price;
      product.querySelector('.cartPage__product-total-cost').innerHTML = `$${
        productPrice * amount
      }`;
    }
    $('.cartPage__Subtotal-number').innerHTML = `$${productTotalPrice()}`;
  }
}

function productTotalPrice() {
  let sumPrice = 0;
  let productPriceList = $$('.cartProductPrice');
  let productQuantityList = $$('.cart_item-input');
  let productQuantity, productPrice;

  productPriceList.forEach((item, index) => {
    productPrice = item.dataset.price;
    productQuantity = productQuantityList[index].value;
    sumPrice += parseFloat(productPrice) * parseFloat(productQuantity);
  });
  return sumPrice;
}

const checkOut = {
  updated: true,
};

const eventCart = {
  async inputBtnClick(e) {
    let isPlus = e.target.classList.contains('cart__item-increment');
    let isMinus = e.target.classList.contains('cart__item-decrement');
    let input, product, productId, storeId;
    if (isPlus || isMinus) {
      product = getParent(e.target, '.cartProduct');
      input = e.target.parentElement.querySelector('.cart_item-input');
      productId = e.target.dataset.id;
      storeId = e.target.dataset.store;

      if (isPlus) {
        if (parseInt(input.value) >= parseInt(input.max)) return;
        ++input.value;
      } else if (isMinus) {
        --input.value;
        if (parseInt(input.value) < parseInt(input.min)) {
          product.querySelector('.deleteIcon').click();
          return;
        }
      }
      updatePriceToCart(product, input.value);

      checkOut.updated = false;
      let response = await HttpRequest({
        url: '/cart/edit',
        method: 'POST',
        data: { productId, amount: input.value, storeId },
      });
      if (response.status) {
        checkOut.updated = true;
        console.log('updated thành công');
      }
    }
  },
  inputOnblur() {
    let cartItemInput = $$('.cart_item-input');
    let lastInputValue = [],
      newInputValue;
    cartItemInput.forEach((input, index) => {
      lastInputValue.push(input.value);
      input.onblur = async () => {
        newInputValue = input.value;
        if (
          parseInt(newInputValue) > parseInt(input.max) ||
          parseInt(newInputValue) === parseInt(lastInputValue[index])
        )
          return;
        inputQuantity = newInputValue;
        productId = input.dataset.id;
        storeId = input.dataset.store;

        product = getParent(input, '.cartProduct');
        updatePriceToCart(product, inputQuantity);

        let response = await HttpRequest({
          url: '/cart/edit',
          method: 'POST',
          data: { productId, amount: inputQuantity, storeId },
        });
        if (response.status) {
          console.log('update');
        }
      };
    });
  },
  async deleteBtnClick(e) {
    let deleteBtn = e.target.classList.contains('deleteIcon');
    if (deleteBtn) {
      storeId = e.target.dataset.store;
      productId = e.target.dataset.id;
      product = getParent(e.target, '.cartProduct');
      product.remove();
      if($('.modal__cart-product-box') && $('.modal__cart-product-box').children.length <= 0){
        $('.modal__cart-product-box').innerHTML = modalCartEmpty();
        $('.modal__cart-footer').style.display = 'none';
      } 
      else if($('.cartList__box') && $('.product-box').children.length <= 0) {
        $('.cartPage__product-header').style.display = 'none';
        $('.product-box').innerHTML = cartPageEmpty();
        $('.cartPage-footer').style.display = 'none';
      } else updatePriceToCart(product);

      let response = await HttpRequest({
        url: '/cart/delete',
        method: 'POST',
        data: { productId, storeId },
      });
      if (response.status) {
        console.log('xoá');
      }
    }
  },
  checkOutBtn() {
    if ($('.cartPage__Checkout') == null) return;
    let checkOutBtn = $('.cartPage__Checkout');
    let productBox = $('.product-box');
    let productHeader = $('.cartPage__product-header');
    let productFooter = $('.cartPage-footer');
    checkOutBtn.onclick = async () => {
      if (checkOut.updated) {
        productHeader.style.display = 'none';
        productBox.innerHTML = CartPageEmpty();
        productFooter.style.display = 'none';
        let response = await HttpRequest({
          url: '/order',
          method: 'POST',
          data: {},
        });
        if (response.status) {
          console.log('đã thanh toán');
        }
      } else {
        console.log('đợi cập nhật');
      }
    };
  },
  btnCartModal() {
    $('.modal__cart-product-box').addEventListener('click', (e) => {
      this.inputBtnClick(e);
      this.inputOnblur();
      this.deleteBtnClick(e);
    });
  },
  btnCartPage() {
    if (!$('#cartPage .product-box')) return;
    $('#cartPage .product-box').addEventListener('click', (e) => {
      this.inputBtnClick(e);
      this.inputOnblur();
      this.deleteBtnClick(e);
    });
  },
  init() {
    this.btnCartPage();
    this.btnCartModal();
    this.checkOutBtn();
  },
};

eventCart.init();

// function getCookies(name) {
//   var cookies = document.cookie;
//   cookieArr = cookies.split(';');
//   for(i = 0; i < cookieArr.length; i++) {
//     var str = cookieArr[i];
//     var arr = str.split('=');
//     console.log( i);
//     if(arr.length == 2) {
//       if(arr[0] == name) {
//         return arr[1];
//       }
//     }
//   }
//   return '';
// }

function AddToCart() {
  let inputQuantity = $$('.inputQuantity');
  let addToCart = $$('.addToCart');
  for (const [index, item] of addToCart.entries()) {
    item.onclick = async (e) => {
      let cartItem = $$('.cartProduct');
      let productId = item.dataset.id;
      let amount = inputQuantity[index].value;
      let storeId = item.dataset.store;
      
      let response = await HttpRequest({
        url: '/cart',
        method: 'POST',
        data: { productId, storeId, amount },
      });

      if (response.status) {
        response.product.quantity = amount;
        let newProduct = response.product;
        
        var isExist = false;
        [...cartItem].forEach((item, index) => {
          if ((productId == item.dataset.id) && (storeId == item.dataset.store)) {
                let itemQuantity = item.querySelector('.cart_item-input');
                isExist = true;
                itemQuantity.value = parseInt(itemQuantity.value) + parseInt(newProduct.quantity);
                updatePriceToCart();
              }
        })

        if (!isExist) {
          $('.modal__cart-product-box').
          insertAdjacentHTML("beforeend",productItemCartModal(newProduct));
        }

        if($('.modal__cart-footer').style.display == 'none') {
          $('.modal__cart-product-box').innerHTML = productItemCartModal(newProduct);
          $('.modal__cart-footer').style.display == 'block';
        } 
        updatePriceToCart();
        console.log('add thành công');
      } else if(response.status == false) {
        console.log('add thất bại');
      }
    };
  }
}

AddToCart();
