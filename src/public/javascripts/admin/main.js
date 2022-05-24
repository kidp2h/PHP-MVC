$('.toggle').onclick = () => {
  $$('.pagination').forEach((item) => {
    item.classList.toggle('hidden');
  });
  $('.sidebar').classList.toggle('active');
  $('.main-content').classList.toggle('active');
  $('.toggle').classList.toggle('open');
};
let page = window.location.pathname.split('/')[2] ?? 'dashboard';
console.log(page);
let selector = `.manager.m-${page}`;
let itemSidebar = $(selector);
// itemSidebar.classList.add('active');

const Product = {
  loadImageToModal(image, admin = false) {
    let imageList = JSON.parse(image);
    
    $('.image-show').innerHTML = '';

    let btnRemove = ''
    if(admin) btnRemove = '<button class="removeImage"><i class="ion-close-round"></i></button>';

    imageList.forEach((img) => {
        let imageHTML = `                        
        <div class="wrap-image list-image-product">
          <img class="image-product" src="${img}" alt="Image product id">
          ${ btnRemove }
        </div>`;
        $('.image-show').insertAdjacentHTML('beforeend', imageHTML);
    });
  }
}

const Bill = {
 
  acceptBill: function () {
    $$('.accept').forEach(btn=> {
      btn.onclick = () => {

        let row = btn.parentNode.parentNode;
        let status = row.querySelector('.status-bill');
        status.innerHTML = `<i class="ion-checkmark-circled completed"></i>`;
        let orderId = btn.dataset.id;
        HttpRequest({ 
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
      btn.onclick = () => {
        let row = btn.parentNode.parentNode;
        let status = row.querySelector('.status-bill');
        status.innerHTML = `<i class="ion-close-circled cancelled"></i>`;
        HttpRequest({ 
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
    this.acceptBill();
    this.cancelBill();
  }
}

Bill.init()

