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
  } else if (window.location.pathname.split('/').length == 3){
    page = window.location.pathname.split('/')[2] ?? 'dashboard';
  } else {
    page = window.location.pathname.split('/')[3] ?? 'dashboard';
  }
} else {
  page = window.location.pathname.split('/')[2] ?? 'dashboard';
}
console.log(page);
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
};

const Bill = {
 
  acceptBill: function () {
    $$('.accept').forEach(btn=> {
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
          }
        })
      }
    })
  },

  cancelBill: function () {

    $$('.cancel').forEach(btn=> {
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
          }
        })
      }
    })
  },

  searchBill: function (from, to, key) {
    BillController.searchBill(from, to, key);
    HandleEvent.SlideTdTable();
  },

  init() {
    if(!checkUrl('bill')) return;
    this.acceptBill();
    this.cancelBill();
  }
}

Bill.init();

const Store = {
  linkButton() {
    $$('.link').forEach(btn => {
      btn.onclick = () => {
        window.location.href = `/admin/store/${btn.dataset.id}`
      }
    })
  },

  init() {
    this.linkButton();
  }
}

Store.init()

