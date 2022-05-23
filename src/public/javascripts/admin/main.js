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
  } else {
    page = window.location.pathname.split('/')[3] ?? 'dashboard';
  }
} else {
  page = window.location.pathname.split('/')[2] ?? 'dashboard';
}
let selector = `.manager.m-${page}`;
let itemSidebar = $(selector);
itemSidebar.classList.add('active');

if (window.location.pathname.split('/').includes('category')) {
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
                showToast('error', result.message, 5000, '#f15050ad', 'white');
              }
            }
            $('#inputChangeImage').value = '';
          });
          FR.readAsDataURL(this.files[0]);
        }
      };
    };
  });
}
// itemSidebar.classList.add('active');

const Product = {
  loadImageToModal(image, admin = false) {
    let imageList = JSON.parse(image);

    $('.image-show').innerHTML = '';

    let btnRemove = '';
    if (admin)
      btnRemove =
        '<button class="removeImage"><i class="ion-close-round"></i></button>';

    imageList.forEach((img) => {
      let imageHTML = `                        
        <div class="wrap-image list-image-product">
          <img class="image-product" src="${img}" alt="Image product id">
          ${btnRemove}
        </div>`;
      $('.image-show').insertAdjacentHTML('beforeend', imageHTML);
    });
  },
};

const Bill = {
  acceptBill: function (btn) {
    let row = btn.parentNode.parentNode;
    let status = row.querySelector('.status-bill');
    status.innerHTML = `<i class="fas fa-check-circle completed"></i>`;
    BillController.setStatusBill(btn.dataset.id, 'COMPLETED');
  },

  cancelBill: function (btn) {
    let row = btn.parentNode.parentNode;
    let status = row.querySelector('.status-bill');
    status.innerHTML = `<i class="fas fa-times-circle cancelled"></i>`;
    BillController.setStatusBill(btn.dataset.id, 'CANCELLED');
  },

  searchBill: function (from, to, key) {
    BillController.searchBill(from, to, key);
    HandleEvent.SlideTdTable();
  },
};
