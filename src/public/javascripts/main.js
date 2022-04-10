const $ = (selector) => document.querySelector(selector);
const $$ = (selector) => document.querySelectorAll(selector);

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
