$('.toggle').onclick = () => {
  $$('.pagination').forEach((item) => {
    item.classList.toggle('hidden');
  });
  $('.sidebar').classList.toggle('active');
  $('.main-content').classList.toggle('active');
  $('.toggle').classList.toggle('open');
};
let page = null;
if (window.location.pathname.split('/').includes('store')) {
  if (window.location.pathname.split('/').length == 4) {
    page = 'dashboard';
  } else if (window.location.pathname.split('/').length == 3) {
    page = window.location.pathname.split('/')[2] ?? 'dashboard';
  } else {
    page = window.location.pathname.split('/')[3] ?? 'dashboard';
  }
} else {
  page = window.location.pathname.split('/')[2] ?? 'dashboard';
}
let selector = `.manager.m-${page}`;
let itemSidebar = $(selector);
itemSidebar.classList.add('active');
function getStore() {
  return location.pathname.split('/')[4];
}
const Modal = {
  removeImageAdmin: function () {
    $$('.removeImage').forEach(function (btn) {
      btn.onclick = async function () {
        let id = btn.dataset.id;
        let index = this.dataset.index;
        let addImageBtn = $(`.wrap-image[data-id='${id}']`).querySelector(
          '.addImage'
        );
        console.log(addImageBtn);
        let newListImage = [];
        btn.parentElement.remove();
        $$('.list-image-product').forEach((image) => {
          let imageElement = image.querySelector('.image-product');
          newListImage.push(imageElement.getAttribute('src'));
        });
        let formData = new FormData();
        if (index) {
          formData.append('index', index);
          formData.append('newListImage', addImageBtn.dataset.image);
        } else {
          formData.append('newListImage', JSON.stringify(newListImage));
        }
        formData.append('id', id);

        let response = await fetch(`/admin/deleteImageProduct/${id}`, {
          method: 'POST',
          body: formData,
        });
        let result = await response.json();
        if (result.status) {
          addImageBtn.dataset.image = result.payload;
          showToast('success', result.message, 5000, '#5f50f1ad', 'white');
        }
      };
    });
  },
  openImageAdmin() {
    $$('.addImage').forEach((btn) => {
      btn.onclick = function () {
        $('.btn-addImage').onclick = function () {
          let idProduct = btn.dataset.product;
          let listImage = btn.dataset.image;
          let btnAddImage = this;
          $('#inputUploadImage').click();
          $('#inputUploadImage').onchange = function () {
            if (this.files && this.files[0]) {
              let files = this.files[0];
              let FR = new FileReader();
              FR.addEventListener('load', async function (e) {
                if (e.total > 500000) {
                  showToast(
                    'error',
                    'Please upload image less 5MB',
                    5000,
                    '#f15050ad',
                    '#00000099'
                  );
                } else if (!e.target.result.includes('data:image/')) {
                  showToast(
                    'error',
                    'Only upload image, please !',
                    5000,
                    '#f15050ad',
                    '#00000099'
                  );
                } else {
                  btnAddImage.disabled = true;
                  //imgCurrent.setAttribute('src', e.target.result);
                  let htmlImage = `
                  <div class="wrap-image list-image-product">
                    <img class="image-product" src="${e.target.result}">
                    <button class="removeImage" data-id='${idProduct}'><i class="ion-close-round"></i></button>
                  </div>`;
                  $('.image-show').insertAdjacentHTML('beforeend', htmlImage);
                  let formData = new FormData();
                  formData.append('file', files);
                  formData.append('listImage', listImage);
                  let response = await fetch(
                    `/admin/uploadImageProduct/${idProduct}`,
                    {
                      method: 'POST',
                      body: formData,
                    }
                  );
                  let result = await response.json();

                  Modal.removeImageAdmin();
                  if (result.status) {
                    btn.dataset.image = result.payload;
                    let btnRemove = $(
                      `.image-product[src="${e.target.result}"]`
                    ).nextElementSibling;
                    btnRemove.dataset.index = result.index;
                    showToast(
                      'success',
                      result.message,
                      5000,
                      '#5f50f1ad',
                      'white'
                    );
                    btnAddImage.disabled = false;
                  } else {
                    showToast(
                      'error',
                      result.message,
                      5000,
                      '#f15050ad',
                      'white'
                    );
                    btnAddImage.disabled = false;
                  }
                }
                $('#inputUploadImage').value = '';
              });
              FR.readAsDataURL(this.files[0]);
            }
          };
        };
        $('.overlayAddImage').style.display = 'flex';
        $('.modal-addImage').style.transform = 'translateY(0px)';
        console.log(btn);
        Product.loadImageToModal(btn.dataset.image, btn.dataset.product, true);
        Modal.removeImageAdmin();
      };
    });
  },
  openImageAdminStore() {
    $$('.addImage').forEach((btn) => {
      btn.onclick = function () {
        $('.overlayAddImage').style.display = 'flex';
        $('.modal-addImage').style.transform = 'translateY(0px)';
        Product.loadImageToModal(btn.dataset.image, btn.dataset.product);
      };
    });
  },

  closeImageAdmin() {
    $('#close-modal').onclick = function () {
      $('.modal').style.transform = 'translateY(-600px)';
      $('#inputUploadImage').value = '';
      setTimeout(() => {
        $('.overlayAddImage').style.display = 'none';
      }, 300);
    };

    $('#close-detail').onclick = function () {
      $('.modal-seeDetail').style.transform = 'translateY(-600px)';
      setTimeout(() => {
        $('.overlayDetail').style.display = 'none';
      }, 300);
    };
  },

  closeImageAdminStore() {
    $('#close-modal').onclick = function () {
      $('.modal').style.transform = 'translateY(-600px)';
      setTimeout(() => {
        $('.overlayAddImage').style.display = 'none';
      }, 300);
    };

    $('#close-detail').onclick = function () {
      $('.modal-seeDetail').style.transform = 'translateY(-600px)';
      setTimeout(() => {
        $('.overlayDetail').style.display = 'none';
      }, 300);
    };
  },

  openDetails() {
    $$('.see-detail').forEach((btn) => {
      btn.onclick = async () => {
        $('.overlayDetail').style.display = 'flex';
        let id = btn.dataset.id;
        $('.modal-seeDetail').style.transform = 'translateY(0px)';
        let row = ``;
        let table = $('.product-show tbody');
        table.innerHTML = row;

        let products = await HttpRequest({ url: `/order/details?id=${id}` });

        products.forEach((item) => {
          row += `<tr>
                    <td>${item.name}</td>
                    <td>${item.quantity}</td>
                    <td>${item.productPrice * item.quantity}</td>
                </tr>`;
        });
        table.innerHTML = row;
      };
    });
  },

  openAddProductStore() {
    $('.add-product').onclick =  async function () {
      console.log(234);
      $('.overlayAddProduct').style.display = 'flex';
      $('.modal-seeAddProduct').style.transform = 'translateY(0px)';
  
      let store = $('.add-product').dataset.store;
  
      let row = ``;
      let table = $('.add-product-show tbody');
      table.innerHTML = row;
      let products = await HttpRequest({ url: `/product?store=${store}` });
  
      products.forEach((item) => {
  
      row += `<tr>
          <td>${item.id}</td>
          <td>${item.name}</td>
          <td>${item.title}</td>
          <td>${item.price}</td>
          <td contenteditable="true" class="addProduct-Discount">0</td>
          <td contenteditable="true" class="addProduct-Quantity">1</td>
  
          <td class="action">
              <button class="button-icon save add" data-id='${item.id}' data-table='products'>
                  <i class="ion-plus-round"></i>
              </button>
          </td>
      </tr>`;
      });
      table.innerHTML = row;
  
      $$('.button-icon.save.add').forEach(btn=> {
          btn.onclick = async () => {
              let parent = btn.parentNode.parentNode;
              let product = btn.dataset.id
              let discount = parent.querySelector('.addProduct-Discount').textContent 
              let quantity = parent.querySelector('.addProduct-Quantity').textContent 
              let store = $('.add-product').dataset.store
  
              await HttpRequest({
                  url: "/product/addProductDetails",
                  method: 'POST',
                  data: {
                      store,
                      product,
                      discount,
                      quantity
                  }
              })
  
              window.location.reload();
  
  
          }
      })
  };
  
  $('#close-seeAddProduct').onclick = function () {
      $('.modal-seeAddProduct').style.transform = 'translateY(-600px)';
      setTimeout(() => {
          $('.overlayAddProduct').style.display = 'none';
      }, 300);
  };
  },

  init() {
    if (!checkUrl('admin')) return;

    if (checkUrl('store')) {
      this.openImageAdminStore();
      this.closeImageAdminStore();
      if(checkUrl('product')) {
        console.log(123);
        this.openAddProductStore();
      }
    } else {
      this.openImageAdmin();
      this.closeImageAdmin();
    }

    this.openDetails();
  },
};

Modal.init();

const User = {
  saveUser() {
    $$('.tmanager-user .save').forEach((btn) => {
      btn.onclick = async function () {
        this.disabled = true;
        let row = this.parentElement.parentElement;
        let permission = row.querySelector('#selectPermission').value;
        let response = null;
        if (btn.dataset.action == 'create') {
          let fullName = row.querySelector('.fullName').textContent;
          let username = row.querySelector('.username').textContent;
          let address = row.querySelector('.address').textContent;
          let phoneNumber = row.querySelector('.phoneNumber').textContent;
          let email = row.querySelector('.email').textContent;
          response = await HttpRequest({
            url: '/admin/createUser',
            method: 'POST',
            data: {
              fullName,
              username,
              address,
              phoneNumber,
              email,
              permission,
            },
          });
          btn.removeAttribute('data-action');
          btn.dataset.id = response.payload;
          row.querySelector('.fullName').removeAttribute('contenteditable');
          row.querySelector('.username').removeAttribute('contenteditable');
          row.querySelector('.address').removeAttribute('contenteditable');
          row.querySelector('.phoneNumber').removeAttribute('contenteditable');
          row.querySelector('.email').removeAttribute('contenteditable');
        } else {
          let id = this.dataset.id;
          response = await HttpRequest({
            url: '/admin/saveUser',
            method: 'POST',
            data: { id, permission },
          });
        }
        if (response.status)
          showToast('success', response.message, 5000, '#5f50f1ad', 'white');
        else
          showToast('error', response.message, 5000, '#f15050ad', '#00000099');
        this.disabled = false;
      };
    });
  },
  createUser() {
    $('.add-user').onclick = function () {
      let selectPermission = $('#selectPermission').innerHTML;
      let row = `
      <tr>
        <td contenteditable="true" class="fullName">Full name</td>
        <td contenteditable="true" class="username">Username</td>
        <td contenteditable="true" class="address">Address user</td>
        <td contenteditable="true" class="phoneNumber">Phone number</td>
        <td contenteditable="true" class="email">Email address</td>
        <td class="permission">
          <div id="select">
            <select id="selectPermission" style="background-color: var(--primary-color);">
              ${selectPermission}
            </select>
          </div>
        </td>
        <td class="action">
          <button class="button-icon save" data-action='create'>
            <i class="ion-document-text"></i>
          </button>
        </td>
      </tr>`;
      $('.tmanager-user table tbody').insertAdjacentHTML('afterBegin', row);
      User.saveUser();
    };
  },
  init() {
    if (!checkUrl('user') || !isAdmin()) return;
    this.saveUser();
    this.createUser();
  },
};

const Product = {
  loadImageToModal(image, idProduct, admin = false) {
    let imageList = JSON.parse(image);

    $('.image-show').innerHTML = '';

    let btnRemove = '';
    if (admin)
      btnRemove = `<button class="removeImage" data-id=${idProduct} data-image='${image}'><i class="ion-close-round"></i></button>`;

    imageList.forEach((img) => {
      let imageHTML = `                        
        <div class="wrap-image list-image-product">
          <img class="image-product" src="${img}" alt="Image product id">
          ${btnRemove}
        </div>`;
      $('.image-show').insertAdjacentHTML('beforeend', imageHTML);
    });
  },
  removeProduct() {
    $$('.tmanager-product .remove').forEach((btn) => {
      btn.onclick = async function () {
        this.disabled = true;
        let response = null;
        if (btn.dataset.action == 'create') {
          this.parentElement.parentElement.remove();
        } else {
          this.parentElement.parentElement.remove();
          let id = this.dataset.id;
          response = await HttpRequest({
            url: '/admin/removeProduct',
            method: 'POST',
            data: { id },
          });
        }
        if (response.status)
          showToast('success', response.message, 5000, '#5f50f1ad', 'white');
        else
          showToast('error', response.message, 5000, '#f15050ad', '#00000099');
        this.disabled = false;
      };
    });
  },
  saveProduct() {
    $$('.tmanager-product .save').forEach((btn) => {
      btn.onclick = async function () {
        this.disabled = true;
        let row = this.parentElement.parentElement;
        let btnRemove = this.parentElement.querySelector('.remove');
        let btnAddImage = row.querySelector('.addImage');
        let wrapImage = row.querySelector('.wrap-image');
        let nameProduct = row.querySelector('.nameProduct').textContent;
        let priceProduct = row.querySelector('.priceProduct').textContent;
        let categoryProduct = row.querySelector('#selectCategory').value;
        let response = null;
        if (btn.dataset.action == 'create') {
          response = await HttpRequest({
            url: '/admin/createProduct',
            method: 'POST',
            data: { priceProduct, nameProduct, categoryProduct },
          });
          btn.removeAttribute('data-action');
          btnRemove.removeAttribute('data-action');
          btnRemove.dataset.id = response.payload;
          btn.dataset.id = response.payload;
          btnAddImage.style = null;
          btnAddImage.disabled = false;
          btnAddImage.dataset.product = response.payload;
          btnAddImage.dataset.image = '["/public/images/products/product.jpg"]';
          wrapImage.style = null;
          wrapImage.dataset.id = response.payload;
          Modal.init();
        } else {
          let id = this.dataset.id;
          response = await HttpRequest({
            url: '/admin/saveProduct',
            method: 'POST',
            data: { id, priceProduct, nameProduct, categoryProduct },
          });
        }
        if (response.status)
          showToast('success', response.message, 5000, '#5f50f1ad', 'white');
        else
          showToast('error', response.message, 5000, '#f15050ad', '#00000099');
        this.disabled = false;
      };
    });
  },
  createProduct() {
    $('.add-product').onclick = function () {
      let categorySelect = $('#selectCategory').innerHTML;
      let row = `
      <tr>
        <td>
          <div class="wrap-image" style="cursor:not-allowed">
            <img class="image-document i-product" src="/public/images/products/product.jpg" alt="">
            <button class="addImage" data-id="" style="pointer-events:none;cursor:not-allowed" disabled><i class="ion-plus-round"></i></button>
          </div>
        </td>
        <td contenteditable="true" class="nameProduct">NameProduct</td>
        <td class="categoryProduct">
          <div id="select">
            <select id="selectCategory">
              ${categorySelect}
            </select>
          </div>
        </td>
        <td contenteditable="true" class="priceProduct">1000</td>
        <td class="action">
            <button class="button-icon remove" data-action='create'>
                <i class="ion-trash-b"></i>
            </button>
            <button class="button-icon save" data-action='create'>
                <i class="ion-document-text"></i>
            </button>
        </td>
      </tr>`;
      $('.tmanager-product table tbody').insertAdjacentHTML('afterBegin', row);
      Product.removeProduct();
      Product.saveProduct();
    };
  },
  init() {
    if (!checkUrl('product') || !isAdmin()) return;
    this.removeProduct();
    this.saveProduct();
    this.createProduct();
  },
};
const ProductStore = {
  removeProduct() {
    $$('.tmanager-product .remove').forEach((btn) => {
      btn.onclick = async function () {
        let row = this.parentElement.parentElement;
        row.remove();
        let productId = btn.dataset.id;
        let response = await HttpRequest({
          url: `/admin/removeProductStore/${getStore()}`,
          method: 'POST',
          data: { productId },
        });
        if (response.status) {
          showToast('success', response.message, 5000, '#5f50f1ad', 'white');
        }
      };
    });
  },
  saveProduct() {
    $$('.tmanager-product .save').forEach((btn) => {
      btn.onclick = async function () {
        let row = this.parentElement.parentElement;
        let discountProduct = row.querySelector('.discountProduct').textContent;
        let quantityProduct = row.querySelector('.quantityProduct').textContent;
        let productId = btn.dataset.id;
        let response = await HttpRequest({
          url: `/admin/saveProductStore/${getStore()}`,
          method: 'POST',
          data: { discountProduct, quantityProduct, productId },
        });
        if (response.status) {
          showToast('success', response.message, 5000, '#5f50f1ad', 'white');
        }
      };
    });
  },
  init() {
    if (!isManager() || !checkUrl('product')) return;
    this.removeProduct();
    this.saveProduct();
  },
};

const Category = {
  changeImage() {
    $$('.changeImage').forEach((btn) => {
      btn.onclick = function () {
        let id = this.dataset.id;
        let imgCurrent = btn.parentNode.querySelector('.image-document');
        $('#inputChangeImage').click();
        $('#inputChangeImage').onchange = function () {
          if (this.files && this.files[0]) {
            let files = this.files[0];
            let FR = new FileReader();
            FR.addEventListener('load', async function (e) {
              if (e.total > 500000) {
                showToast(
                  'error',
                  'Please upload image less 5MB',
                  5000,
                  '#f15050ad',
                  '#00000099'
                );
                showToast('error', '');
              } else if (!e.target.result.includes('data:image/')) {
                showToast(
                  'error',
                  'Only upload image, please !',
                  5000,
                  '#f15050ad',
                  '#00000099'
                );
              } else {
                imgCurrent.setAttribute('src', e.target.result);
                let formData = new FormData();
                formData.append('file', files);
                let response = await fetch(`/admin/changeImageCategory/${id}`, {
                  method: 'POST',
                  body: formData,
                });
                let result = await response.json();
                if (result.status) {
                  showToast(
                    'success',
                    result.message,
                    5000,
                    '#5f50f1ad',
                    'white'
                  );
                } else {
                  showToast(
                    'error',
                    result.message,
                    5000,
                    '#f15050ad',
                    'white'
                  );
                }
              }
              $('#inputChangeImage').value = '';
            });
            FR.readAsDataURL(this.files[0]);
          }
        };
      };
    });
  },
  removeCategory() {
    $$('.tmanager-category .remove').forEach((btn) => {
      btn.onclick = async function () {
        this.disabled = true;
        let response = null;
        if (btn.dataset.action == 'create') {
          this.parentElement.parentElement.remove();
        } else {
          this.parentElement.parentElement.remove();
          let id = this.dataset.id;
          function promiseRemoveCategory() {
            response = HttpRequest({
              url: '/admin/removeCategory',
              method: 'POST',
              data: { id },
            });
            return response;
          }
          function promiseHandleProductRemoveCategory() {
            response = HttpRequest({
              url: '/admin/handleProductRemoveCategory',
              method: 'POST',
              data: { id },
            });
            return response;
          }
          let result = await Promise.all([
            promiseRemoveCategory(),
            promiseHandleProductRemoveCategory(),
          ]);
          console.log(result);
        }
        if (response.status)
          showToast('success', response.message, 5000, '#5f50f1ad', 'white');
        else
          showToast('error', response.message, 5000, '#f15050ad', '#00000099');
        this.disabled = false;
      };
    });
  },
  saveCategory() {
    $$('.tmanager-category .save').forEach((btn) => {
      btn.onclick = async function () {
        this.disabled = true;
        let row = this.parentElement.parentElement;
        let btnRemove = this.parentElement.querySelector('.remove');
        let btnChangeImage = row.querySelector('.changeImage');
        let nameCategory = row.querySelector('.nameCategory').textContent;
        let response = null;
        if (btn.dataset.action == 'create') {
          response = await HttpRequest({
            url: '/admin/createCategory',
            method: 'POST',
            data: { nameCategory },
          });
          btn.removeAttribute('data-action');
          btnRemove.removeAttribute('data-action');
          btnRemove.dataset.id = response.payload;
          btn.dataset.id = response.payload;
          btnChangeImage.style = null;
          btnChangeImage.disabled = false;
          btnChangeImage.dataset.id = response.payload;
          Category.changeImage();
        } else {
          let id = this.dataset.id;
          response = await HttpRequest({
            url: '/admin/saveCategory',
            method: 'POST',
            data: { id, nameCategory },
          });
        }
        if (response.status)
          showToast('success', response.message, 5000, '#5f50f1ad', 'white');
        else
          showToast('error', response.message, 5000, '#f15050ad', '#00000099');
        this.disabled = false;
      };
    });
  },
  createCategory() {
    $('.add-category').onclick = function () {
      let row = `
      <tr>
        <td>
          <div class="wrap-image">
            <img class="image-document i-category" src="/public/images/products/product.jpg" alt="Image category ">
            <button class="changeImage" style="pointer-events:none;cursor:not-allowed" disabled>
              <i class="ion-edit">
                <input type="file" name="changeImage" id="inputChangeImage"  style="display: none;" accept="image/*">
              </i>
            </button>
          </div>
        </td>
        <td contenteditable="true" class="nameCategory">NameCategory</td>
        <td class="action">
          <button class="button-icon remove" data-action='create'>
            <i class="ion-trash-b"></i>
          </button>
          <button class="button-icon save" data-action='create'>
            <i class="ion-document-text"></i>
          </button>
        </td>
      </tr>`;
      $('.tmanager-category table tbody').insertAdjacentHTML('afterBegin', row);
      Category.removeCategory();
      Category.saveCategory();
    };
  },
  init() {
    if (!checkUrl('category') || !isAdmin()) return;
    this.changeImage();
    this.removeCategory();
    this.createCategory();
    this.saveCategory();
  },
};
const Bill = {
  acceptBill: function () {
    $$('.accept').forEach((btn) => {
      btn.onclick = async () => {
        let row = btn.parentNode.parentNode;
        let status = row.querySelector('.status-bill');
        status.innerHTML = `<i class="ion-checkmark-circled completed"></i>`;
        let orderId = btn.dataset.id;
        await HttpRequest({
          url: '/orderUpdateStatus',
          method: 'POST',
          data: {
            orderId,
            status: 2,
          },
        });
      };
    });
  },

  cancelBill: function () {
    $$('.cancel').forEach((btn) => {
      btn.onclick = async () => {
        let row = btn.parentNode.parentNode;
        let status = row.querySelector('.status-bill');
        status.innerHTML = `<i class="ion-close-circled cancelled"></i>`;
        let orderId = btn.dataset.id;
        await HttpRequest({
          url: '/orderUpdateStatus',
          method: 'POST',
          data: {
            orderId,
            status: 3,
          },
        });
      };
    });
  },

  searchBill: function (from, to, key) {
    BillController.searchBill(from, to, key);
    HandleEvent.SlideTdTable();
  },
  init() {
    if (!checkUrl('bill')) return;
    this.acceptBill();
    this.cancelBill();
  },
};

Bill.init();
const Store = {
  linkButton() {
    $$('.link').forEach((btn) => {
      btn.onclick = () => {
        window.location.href = `/admin/store/${btn.dataset.id}`;
      };
    });
  },

  init() {
    this.linkButton();
  },
};

Store.init();
User.init();
Product.init();
ProductStore.init();
Category.init();
