// Ẩn hiện filter;
// const $ = document.querySelector.bind(document);
// const $$ = document.querySelectorAll.bind(document);
function InitEvent() {
  $('#ter')
    ? (document.getElementById('ter').onclick = function () {
        var hidden = document.getElementById('filter');
        if (hidden.style.display == 'block') {
          hidden.style.display = 'none';
        } else {
          hidden.style.display = 'block';
          hidden.style.animation = 'fadeIn ease-in 0.5s';
        }
      })
    : null;

  $('#close')
    ? (document.getElementById('close').onclick = function () {
        var hidden = document.getElementById('filter');
        if (hidden.style.display == 'block') {
          hidden.style.display = 'none';
        } else {
          hidden.style.animation = 'fadeIn ease-in 0.5s';
        }
      })
    : null;
    $$(".theloai").forEach(item=>{
      item.onclick=function(){
          item.querySelector("input").checked=true;
      }       
  });
  $$('.loc1 h3').forEach((item) => {
    item.onclick = function (e) {
      //console.log("clicked")
      item.parentElement.classList.toggle('active');
    };
  });
  
  // Nút backtop
  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function () {
    scrollFunction();
  };
  // var sortfilter = document.getElementById('slt');
  //  sortfilter.addEventListener('input', filtersort);

  if ($('#product-intro p'))
    $('#product-intro p').onclick = () => {
      renderShop.start();
    };
}

// Ẩn chuyển trang
function page_hide() {
  let page = document.getElementById('chuyentrang');
  page.style.display = 'none';
}

function page_block() {
  let page = document.getElementById('chuyentrang');
  page.style.display = 'flex';
}

// Ẩn filter
function filter_hide() {
  let filter = document.getElementById('filter');
  filter.style.display = 'none';
}

function scrollFunction() {
  var my_backtop = document.getElementById('backtop');
  if (my_backtop)
    if (
      document.body.scrollTop > 20 ||
      document.documentElement.scrollTop > 20
    ) {
      my_backtop.style.display = 'block';
      my_backtop.style.animation = 'fadeIn ease-in 0.5s';
    } else {
      my_backtop.style.display = 'none';
    }
}

function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

// Cộng trừ
function AddEvent() {
  let listProductBtnAdd = $$('.product-quantity .btn-add');
  listProductBtnAdd.forEach((btn) => {
    btn.onclick = function () {
      let quantity =
        Number.parseInt(btn.parentElement.querySelector('input').value) + 1;
      btn.parentElement.querySelector('input').value = quantity;
    };
  });
  let listProductBtntru = $$('.product-quantity .btn-tru');
  listProductBtntru.forEach((btn) => {
    btn.onclick = function () {
      let quantity = Number.parseInt(
        btn.parentElement.querySelector('input').value
      );
      if (quantity > 1)
        btn.parentElement.querySelector('input').value = quantity - 1;
    };
  });
}
//

// Hiệu ứng trái tim bé nhỏ
function AddHeart() {
  homeEvent.btnWish();
}

//hàm mới
// Tìm số trang
function getnumberpage(page) {
  return (totalPageUser =
    page.length % LIMIT == 0 ? page.length / LIMIT : page.length / LIMIT + 1);
}
// Phân trang
function getpage(data, page) {
  return data.slice((page - 1) * LIMIT, page * LIMIT);
}

function Searchshop(from, to, name, category) {
  let products = [];
  if (category == 'All') {
    products = ProductModel.getAll();
  } else {
    products = ProductModel.getAll().filter(
      (product) => product.category == category
    );
  }
  products = products.filter((product) =>
    product.name.toUpperCase().includes(name.toUpperCase())
  );
  products = products.filter(
    (product) => from <= product.sale && product.sale <= to
  );

  return products;
}
var sortfilter = document.getElementById('slt');
var store = document.getElementById('store-select');
function getData() {
  let sortfilter = document.getElementById('slt');
  let valuefilter = sortfilter.value;
  console.log(valuefilter);
  $('#sort').value = valuefilter;
  document.getElementById('filtertitle').click();
}
function getStore() {
  let sortname = document.getElementById('store-select');
  let sortNameValue = sortname.value;
  $('#storename').value = sortNameValue;
  document.getElementById('filtertitle').click();
}

sortfilter?.addEventListener('change', getData);
store.addEventListener('change', getStore);
function notChangedFilter(){
  let url = window.location.href.indexOf('sort=');
  url = window.location.href.slice(url + 5);
  if (url.indexOf('shop') != -1) {
    if (sortfilter) {
    sortfilter ? (value = 'All') : null;
    }
  }   
  if(sortfilter!=null)
  { 
    if(url.indexOf('shop')!= -1){
      sortfilter.value?'All':null;
  }else{
    sortfilter.value=url;
  }
  }
}
function notChangedCategories(){
  let url = window.location.href.indexOf('categories');
url=window.location.href.slice(url + 11);
var arr=[];
arr=url.split('&');
// console.log(arr[0]);
$$(".theloai").forEach(item=>{
  if(item.querySelector("input").value==arr[0]){
      item.querySelector("input").checked=true;
  }       
});
}
function notChangedTitle(){
  let url = window.location.href.indexOf('title');
url=window.location.href.slice(url + 6);
var arr=[];
arr=url.split('&');
if(url.indexOf('shop')!=-1){
  $("#search").value=null;
}else{
  if($("#search")!=null){
    $("#search").value=arr[0];
  };
}
}
function notChangedPrice(){
  let url = window.location.href.indexOf('minPrice');
url=window.location.href.slice(url + 9);
var arr=[];
if(url.indexOf('shop')!=-1){
  $("#min-input").value=0;
  $("#max-input").value=99999;
}else{
  arr=url.split('&');
  if($("#min-input")!=null){
    $("#min-input").value=arr[0];
  }
let arr1 = [];
if(arr[1]!=null){
  arr1=arr[1].split('=');
}

if(arr1[1]!=null){
  $("#max-input").value=arr1[1];
}else{
  if($("#max-input")!=null){
    $("#max-input").value=99999;
  }
 
}

}
$$('.trangn').forEach(element => {
  element.onclick = function() {
      $('.trangn.active').classList.remove('active')
      element.classList.add('active')

  }
});
}
window.onload = function () {
  InitEvent();
  notChangedFilter(); 
  notChangedCategories();
  notChangedTitle();
  notChangedPrice();
};
