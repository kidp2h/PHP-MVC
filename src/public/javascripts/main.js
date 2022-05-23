let validateInformation = {
  password: {
    min: 3,
    max: 9999999999999,
    message: 'Your password is too short',
  },
  confirmNewPassword: {
    match: 'password',
    message: 'Confirm password is not same',
  },
};

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
        //gui cookie
        credentials: "include"

      });
    } else {
      response = await fetch(options.url, {
        method: options.method,
        headers: options.headers,
        credentials: "include"
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
      input.value.length > validate[selector]?.max
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

const showMessageValidator = (status, selector, validate) => {
  status.push(selector);
  $(`label[for=${selector}]`)?.classList.add('error');
  $(`label[for=${selector}] ~ span`)?.classList.add('validate-error');
  $(`label[for=${selector}] ~ span`).innerHTML = validate[selector]['message'];
  let input = $(`input[name=${selector}]`);
  input ? input.classList.add('is-invalid') : null;
};
$('.openModal')
  ? ($('.openModal').onclick = function () {
      $('#modal__information').classList.add('active');
      $('.__modal__overlay').classList.add('active');
      $('body').classList.add('active');
    })
  : null;
$('.btn-close-modal')
  ? ($('.btn-close-modal').onclick = function () {
      $('#modal__information').classList.remove('active');
      $('.__modal__overlay').classList.remove('active');
      $('body').classList.remove('active');
    })
  : null;
$('.btn-cancel')
  ? ($('.btn-cancel').onclick = function () {
      $('#modal__information').classList.remove('active');
      $('.__modal__overlay').classList.remove('active');
      $('body').classList.remove('active');
    })
  : null;
$('.btn-save-changes')
  ? ($('.btn-save-changes').onclick = async function () {
      let fields = ['password', 'confirmNewPassword'];
      let password = $('#password').value;
      let confirmNewPassword = $('#confirmNewPassword').value;
      let status = [];
      if (password !== '' || confirmNewPassword !== '') {
        status = validate(fields, validateInformation);
      }
      if (status.length == 0) {
        let fullName = $('#fullName').value;
        let phoneNumber = $('#phoneNumber').value;
        let address = $('#address').value;
        let response = await HttpRequest({
          url: '/saveChanges',
          method: 'POST',
          data: { password, phoneNumber, address, fullName },
        });
        if (response.status) {
          showToast('success', 'Update information successfully !');
        } else {
          showToast('error', 'Not found error, please contact developer !');
        }
      }
    })
  : null;
$('.btn-send-sms')
  ? ($('.btn-send-sms').onclick = async function () {
      if (!this.classList.contains('disabled')) {
        let phoneNumber = $('#phoneNumber').value;
        if (phoneNumber == '') {
          return showToast('error', 'Phone number is invalid');
        } else {
          let _this = this;
          let timeLeft = 60;
          $('.btn-send-sms a').textContent = 'Sending...';
          if (!this.classList.contains('disabled')) {
            this.classList.add('disabled');
            let response = await HttpRequest({
              url: '/sendOTP',
              method: 'POST',
              data: { phoneNumber },
            });
            if (response.status) {
              tempInterval = setInterval(function () {
                if (timeLeft <= 0) {
                  clearInterval(tempInterval);
                  _this.classList.remove('disabled');
                  $('.btn-send-sms a').textContent = 'SEND OTP';
                  console.log(tempInterval, timeLeft, 'end');
                }
                if (timeLeft > 0) {
                  $('.btn-send-sms a').textContent = timeLeft;
                }
                timeLeft -= 1;
              }, 1000);
              showToast('success', `Code OTP was sent to ${phoneNumber} ! `);
            } else showToast('error', response.message);
          }
        }
      }
    })
  : null;

$('.btn-active-sms')
  ? ($('.btn-active-sms').onclick = async function () {
      let otp = $('#otp').value;
      let response = await HttpRequest({
        url: '/verifyOTP',
        method: 'POST',
        data: { otp },
      });
      if (response.status) {
        showToast('success', `Successfully active your phone number ! `);
        this.parentElement.parentElement.remove();
        let span = document.createElement('span');
        let icon = document.createElement('i');
        let text = document.createTextNode('Actived');
        icon.classList.add('ion-ios-checkmark');
        span.classList.add('status__active');
        span.appendChild(icon);
        span.appendChild(text);
        $('.btn-send-sms').replaceWith(span);
        $('#phoneNumber').classList.add('input-disable');
      } else
        showToast(
          'error',
          "Can't active your phone number, you can check otp again ! "
        );
    })
  : null;

function activeNavbar() {
  switch (window.location.pathname) {
    case '/':
      $('nav.navbar a.home').classList.add('active');
      break;
    case '/shop':
      $('nav.navbar a.shop').classList.add('active');
      break;
    case '/about':
      $('nav.navbar a.about').classList.add('active');
      break;
  }
}
activeNavbar();

function formatMoney(n, currency = '$') {
  if (typeof n != 'number') n = Number(n);
  return currency + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
}

const navbarEvent = {
  fancyBurger() {
    const navbar = $('.navbar');
    const btn = $('.fancy-burger');
    btn
      ? (btn.onclick = () => {
          btn.querySelectorAll('span').forEach((span) => {
            span.classList.toggle('open');
          });
          navbar.classList.toggle('open');
        })
      : null;
  },

  navItem() {
    $$('nav a').forEach((navItem) => {
      navItem.onclick = () => {
        if ($('nav a.active')) $('nav a.active').classList.remove('active');
        navItem.classList.add('active');
        if ($('.navbar.open')) $('.fancy-burger').click();
      };
    });
  },

  init() {
    this.fancyBurger();
    this.navItem();
  },
};

navbarEvent.init();

let checkUrl = (...agr) => {
  let isEmpty = true
  agr.forEach(url => { 
    if(!window.location.pathname.includes(url)) {
      isEmpty = false
    }
  })
  return isEmpty
}
