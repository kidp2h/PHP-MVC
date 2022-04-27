const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const HttpRequest = async (
  options = { url: '', method: 'GET', data: null, headers: {} }
) => {
  if (options.url !== '' || options.url !== undefined) {
    let response = null;
    if (options.method === 'POST') {
      response = await fetch(options.url, {
        method: options.method,
        body: new URLSearchParams(Object.entries(options.data)).toString(),
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
      });
    } else {
      response = await fetch(options.url, {
        method: options.method,
        headers: options.headers,
      });
    }
    return await response.json();
  } else {
    throw new Error('Too few argument !!');
  }
};

function getParrent(element, seletor) {
  while(element.parentElement) {
      if(element.parentElement.matches(seletor)) {
          return element.parentElement
      }
      element = element.parentElement
  }
}

function selectStore() {
  $('#store-select').addEventListener("change", () => {
    let i = window.location.href.indexOf('?');
    let url= window.location.href+"/";
    if(i!=-1){
       url = window.location.href.slice(0, i); 
    }
    console.log(i);
    url +="?store="+$('#store-select').value;
    // window.location.href = url;
  })
  
}

selectStore();