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
    btnLoad.onclick = function () {
      renderHome.products(++page);
      _this.btnProduct();
      _this.btnItemProduct();
      if (page == Math.floor(ProductModel.getTotalPage_Rate(8)))
        btnLoad.style.display = 'none';
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

  init: function () {
    if(!$('#home')) return;
    this.slider();
  },
};

// Home.init();
