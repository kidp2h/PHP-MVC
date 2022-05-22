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
itemSidebar.classList.add('active');
