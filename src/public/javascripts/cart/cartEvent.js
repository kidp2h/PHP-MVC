function handleOpenCloseModalCart() {
  if (!$('#cart-icon')) return;
  const navCart = $('#cart-icon');
  const exitCartBtn = $('.btn-exist');
  navCart.onclick = async () => {
    $('.modal').classList.add('active');

    let response = await HttpRequest({
      url: '/cart/modal',
      method: 'GET',
    });
    if (response.status) {
      if (response.productList == '') {
        $('.modal__cart-footer').style.display = 'none';
        $('.modal__cart-subtotal-all').innerHTML = '';
        $('.modal__cart-product-box').innerHTML = modalCartEmpty();
      } else {
        let productlist = response.productList.map((product) => {
          console.log(product.storeId);
          return productItemCartModal(product);
        });
        let cartTotalPrice = response.cartTotalPrice;
        $('.modal__cart-product-box').innerHTML = productlist.join('');
        $('.modal__cart-footer').style.display = 'block';
        $(
          '.modal__cart-subtotal-all'
        ).innerHTML = `$${cartTotalPrice['totalPrice']}`;
      }
    } else {
      $('.modal__cart-footer').style.display = 'none';
      $('.modal__cart-subtotal-all').innerHTML = '';
      $('.modal__cart-product-box').innerHTML = modalCartEmpty();
    }
  };
  exitCartBtn.onclick = () => {
    $('.modal').classList.remove('active');
  };
}
handleOpenCloseModalCart();

function modalCartEmpty() {
  return `
        <div class = "modal__cart-empty">
            <i class="fas fa-shopping-cart"></i>
            <h4 class="modal__cart-empty-text">Your shopping cart is empty</h4>
        </div>
    `;
}

function productItemCartModal(product) {
  product.image = JSON.parse(product.image);
  return `
        <li class="modal__cart-product-item cartProduct">
        <div class="modal__cart-imgbox">
            <img class="modal__cart-img" src="${product.image[0]}" alt="">
        </div>
        <div class="modal__cart-item-infor">
            <h3 class="modal__cart-item-name">${product.name}</h3>
            <span class="modal__cart-item-price cartProductPrice" data-price = "${product.price}">$${product.price}</span>
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

function updatePriceToCart(product, amount = 0) {
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
    sumPrice += parseInt(productPrice) * parseInt(productQuantity);
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
      updatePriceToCart(product);

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
    checkOutBtn.onclick = function () {
      if (checkOut.updated) {
        console.log('đã thanh toán');
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

function AddToCart() {
  let inputQuantity = $$('.inputQuantity');
  let addToCart = $$('.addToCart');
  for (const [index, item] of addToCart.entries()) {
    item.onclick = async (e) => {
      let productId = item.dataset.id;
      let amount = inputQuantity[index].value;
      let storeId = $('#store-select').value;

      let response = await HttpRequest({
        url: '/cart',
        method: 'POST',
        data: { productId, storeId, amount },
      });
      if (response.status) {
        console.log('add thành công');
      }
    };
  }
}

AddToCart();
