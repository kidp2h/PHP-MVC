let validateSignUp = {
  "fullname": {
    min: 10,
    max: 50,
    "message" : "Full name must be have 10 - 50 characters"
  },
  "username" : {
    min : 5,
    max : 15,
    "message" : "Username must be have 5 - 15 characters"
  },
  "email" : {
    pattern: new RegExp(/(\w+.)+@(\w+).(\w+)/g),
    message: "Email is not valid"
  },
  "password" :{
    min : 3,
    max : 9999999999999,
    "message" : "Your password is too short"
  },
  "confirm-password": {
    match : "password",
    "message" : "Confirm password is not same"
  },
  "captcha" : {
    "message":"Please check this box captcha",
    max: 99999999999999
  }
}

$('#btn-signup') ? ($('#btn-signup').onclick = async () => {
  $('#captcha').value = grecaptcha.getResponse();
  let fields = ['fullname','username','email', 'password','confirm-password','captcha'];
  let status = [];
  fields.forEach((selector) => {
    $(`label[for=${selector}]`)?.classList.remove('error')
    $(`label[for=${selector}] ~ span`)?.classList.remove('validate-error')
    $(`input[name=${selector}]`)?.classList.remove('is-invalid');
    let input = $(`#${selector}`);
    if(!input.value || input.value.length <  validateSignUp[selector]?.min || input.value.length > validateSignUp[selector]?.max){
      showMessageValidator(status, selector, validateSignUp);
    }
    if(validateSignUp[selector]?.pattern){
      if( input.value.match(validateSignUp[selector].pattern).length <= 0 ){
        showMessageValidator(status, selector, validateSignUp);
      }
    }
    if(validateSignUp[selector]?.match){
      if(input.value != $(`#${validateSignUp[selector].match}`).value ){
        showMessageValidator(status, selector, validateSignUp);
      }
    }
  });
  if (status.length == 0) {
    let username = $('#username').value;
    let password = $('#password').value;
    let confirmPassword = $('#password').value;
    let fullName = $('#fullname').value;
    let email = $("#email").value;
    let captcha = grecaptcha.getResponse();
    let response = await HttpRequest({
      url: '/signup',
      method: 'POST',
      data: { username, password, fullName, email, confirmPassword , captcha },
    });
    if (response.status && response.redirect && response.message) {
      showToast("success",response.message);
      setTimeout(() => {
        window.location.href = response.redirect;
      }, 3000)
    } else if(response.message && response.status) {
      showToast("success",response.message);
      grecaptcha.reset();
    } else {
      showToast("error",response.message);
      grecaptcha.reset();
    }
  }
}) : null

const showMessageValidator = (status, selector, validate) => {
  status.push(selector);
  $(`label[for=${selector}]`)?.classList.add('error')
  $(`label[for=${selector}] ~ span`)?.classList.add('validate-error')
  $(`label[for=${selector}] ~ span`).innerHTML = validate[selector]["message"]
  let input = $(`input[name=${selector}]`);
  input ? input.classList.add('is-invalid') : null;
}
