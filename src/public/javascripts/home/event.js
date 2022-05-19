function ProductItem(product) {
  product.image = JSON.parse(product.image);

  return `  
      <div class="product-item">
          <div class="product-image__box">

              <img src="${product.image[0]}" alt="unsplash" class="product-image"/>
              <img src="${product.image[1]}" alt="unsplash" class="product-image--back"/>

              
              <div class="product-control">
                  <div class="product-quantity">
                      <button class="btn btn-mul"> - </button>
                      <input type="number" class ="inputQuantity" data-id="${product.id}" min="1" max="9999" value="1">
                      <button class="btn btn-add"> + </button>
                  </div>

                  <div class="product-add-cart addToCart" data-id = "${product.id}">   
                      <div>
                          <p id="add">ADD TO CART</p>
                      </div>
                  </div>
              </div>

          </div>

          <div class="product-info">
              <h2 class="product-info__heading">${product.name}</h2>
              <div class="product-price">
                  <span class="product-info__price product-info__price--sale"></span>
                  <span class="product-info__price"></span>
              </div> 
          </div> 
      </div>
  `;
}

const Home = {
  slider: function () {
    let slides = $$('.slider-wrapper__slide');
    let sliderDots = $$('.slider-dot-item');
    let i = 0;
    let timeout = 5000;

    let btnNext = $('.btn-next');
    btnNext.onclick = function () {
      slides.forEach((slide) => {
        slide.classList.remove('active');
      });
      sliderDots.forEach((item) => {
        item.classList.remove('active');
      });

      i = (i + 1) % slides.length;
      slides[i].classList.add('active');
      sliderDots[i].classList.add('active');
    };

    let btnPrev = $('.btn-prev');
    btnPrev.onclick = function () {
      slides.forEach((slide) => {
        slide.classList.remove('active');
      });
      sliderDots.forEach((item) => {
        item.classList.remove('active');
      });

      i = (i - 1 + slides.length) % slides.length;
      slides[i].classList.add('active');
      sliderDots[i].classList.add('active');
    };
    auto();
    function auto() {
      var lap = setInterval(function () {
        btnNext.click();
      }, timeout);

      btnNext.addEventListener('click', function () {
        clearInterval(lap);
        lap = setInterval(function () {
          btnNext.click();
        }, timeout);
      });

      btnPrev.addEventListener('click', function () {
        clearInterval(lap);
        lap = setInterval(function () {
          btnNext.click();
        }, timeout);
      });
    }

    sliderDots.forEach((item) => {
      item.addEventListener('click', function (e) {
        i = e.target.dataset.index - 2;
        btnNext.click();
      });
    });

    $$('.btn.slide__btn').forEach((btn) => {
      btn.onclick = () => {
        window.location.hash = '#shop';
      };
    });
  },

  btnItemCategory() {
    $$('.category-item').forEach((item) => {
      item.onclick = () => {
        let categoryName = item.querySelector('.category-content').innerText;
        window.location.hash = `#shop-${categoryName.toLowerCase()}`;
      };
    });
  },

  btnProduct: function () {
    let productControl = $$('.product-control');
    productControl.forEach((product) => {
      product.onclick = function (e) {
        e.stopPropagation();
      };
    });

    let productItem = $$('.product-item');
    productItem.forEach((product) => {
      product.onclick = function (e) {
        e.stopPropagation();
      };
    });

    let listProductBtnAdd = $$('.product-quantity .btn-add');
    listProductBtnAdd.forEach((btn) => {
      btn.onclick = function () {
        let quantity =
          Number.parseInt(btn.parentElement.querySelector('input').value) + 1;
        btn.parentElement.querySelector('input').value = quantity;
      };
    });

    let listProductBtnMul = $$('.product-quantity .btn-mul');
    listProductBtnMul.forEach((btn) => {
      btn.onclick = function () {
        let quantity = Number.parseInt(
          btn.parentElement.querySelector('input').value
        );
        if (quantity > 1)
          btn.parentElement.querySelector('input').value = quantity - 1;
      };
    });

    this.btnWish();
  },

  btnLoad: function () {
    var btnLoad = $('.btn-load');
    btnLoad.style.display = 'block';
    let _this = this;
    let page = 1;
    btnLoad.onclick = async function () {
      let dis = await _this.renderProduct(++page);
      // _this.btnProduct();
      // _this.btnItemProduct();
      if (dis) btnLoad.style.display = 'none';
    };
  },

  scrollView() {
    let sections = $$('.sectionNav');
    let navItems = $$('nav a');

    window.onscroll = () => {
      let current = '';
      sections.forEach((section) => {
        const sectionTop = section.offsetTop;
        if (window.scrollY >= sectionTop - 60) {
          current = section.getAttribute('id');
        }
      });

      navItems.forEach((navItem) => {
        if (navItem.getAttribute('href') == `#${current}`) {
          if ($('nav a.active')) {
            $('nav a.active').classList.remove('active');
            navItem.classList.add('active');
          }
        }
      });
    };
  },

  async renderProduct(page = 1) {
    let store = $('#store-select')?.value;
    let products = await HttpRequest({
      url: `http://localhost/product/on50?store=${store}&page=${page}`,
    });

    if (products.length === 0) return true;

    let productBox = $('.product .product-box');
    if (!productBox) return;

    if (page == 1) {
      productBox.innerHTML = products
        .map((product) => ProductItem(product))
        .join('');
    } else {
      productBox.insertAdjacentHTML(
        'beforeend',
        products.map((product) => ProductItem(product)).join('')
      );
    }
    return false;
  },

  init: function () {
    // if(!$('#home')) return;
    // this.slider();
    // this.renderProduct();
    // this.btnLoad();
  },
};

Home.init();
