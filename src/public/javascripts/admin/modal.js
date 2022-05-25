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
        let store = btn.dataset.store;
        $('.modal-seeDetail').style.transform = 'translateY(0px)';
        let row = ``;
        let table = $('.product-show tbody');
        table.innerHTML = row;
        console.log(`/order/details/${store}?id=${id}`);

        let products = await HttpRequest({
          url: `/order/details/${store}?id=${id}`,
        });

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

  init() {
    if (!checkUrl('admin')) return;

    if (checkUrl('store')) {
      this.openImageAdminStore();
      this.closeImageAdminStore();
    } else {
      this.openImageAdmin();
      this.closeImageAdmin();
    }

    this.openDetails();
  },
};

Modal.init();
