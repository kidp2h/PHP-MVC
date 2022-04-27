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
  while (element.parentElement) {
    if (element.parentElement.matches(seletor)) {
      return element.parentElement;
    }
    element = element.parentElement;
  }
}

function validate(fields, validate) {
  let status = [];
  fields.forEach((selector) => {
    $(`label[for=${selector}]`)?.classList.remove('error');
    $(`label[for=${selector}] ~ span`)?.classList.remove('validate-error');
    $(`input[name=${selector}]`)?.classList.remove('is-invalid');
    let input = $(`#${selector}`);
    console.log(input.value);
    if (
      !input.value ||
      input.value.length < validate[selector]?.min ||
      input.value.length > validateSignIn[selector]?.max
    ) {
      showMessageValidator(status, selector, validate);
    }
    if (validate[selector]?.pattern) {
      if (
        !input.value.match(validate[selector].pattern) ||
        input.value.match(validate[selector].pattern).length <= 0
      ) {
        showMessageValidator(status, selector, validate);
      }
    }
    if (validate[selector]?.match) {
      if (input.value != $(`#${validate[selector].match}`).value) {
        showMessageValidator(status, selector, validate);
      }
    }
  });
  return status;
}

$$('.showPassword').forEach((element) => {
  element.onclick = function () {
    let inputPassword = this.previousElementSibling;
    if (inputPassword.getAttribute('type') == 'password') {
      inputPassword.setAttribute('type', 'text');
      this.classList.remove('ion-eye');
      this.classList.add('ion-eye-disabled');
    } else {
      inputPassword.setAttribute('type', 'password');
      this.classList.remove('ion-eye-disabled');
      this.classList.add('ion-eye');
    }
  };
});

function selectStore() {
  $('#store-select').addEventListener('change', () => {
    let i = window.location.href.indexOf('?');
    let url = window.location.href + '/';
    if (i != -1) {
      url = window.location.href.slice(0, i);
    }
    console.log(i);
    url += '?store=' + $('#store-select').value;
    // window.location.href = url;
  });
}

const showMessageValidator = (status, selector, validate) => {
  status.push(selector);
  $(`label[for=${selector}]`)?.classList.add('error');
  $(`label[for=${selector}] ~ span`)?.classList.add('validate-error');
  $(`label[for=${selector}] ~ span`).innerHTML = validate[selector]['message'];
  let input = $(`input[name=${selector}]`);
  input ? input.classList.add('is-invalid') : null;
};

selectStore();
