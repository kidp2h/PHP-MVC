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
}


