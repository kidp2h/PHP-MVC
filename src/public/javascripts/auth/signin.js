let validateSignIn = {
  "username" : {
    min : 5,
    max : 15,
    "message" : "Username must be have 5 - 15 characters"
  },
  "password" :{
    min : 3,
    max : 9999999999999,
    "message" : "Minimum length of the password must be 6"
  },
  "captcha" : {
    "message":"Please check this box captcha"
  }
}

$('#btn-signin') ? ($('#btn-signin').onclick = async () => {
  $('#captcha').value = grecaptcha.getResponse();
  let fields = ['username', 'password','captcha'];
  var username, password, captcha;
  let status = [];
  fields.forEach((selector) => {
    $(`label[for=${selector}]`)?.classList.remove('error')
    $(`label[for=${selector}] ~ span`)?.classList.remove('validate-error')
    $(`input[name=${selector}]`)?.classList.remove('is-invalid');
    let input = $(`#${selector}`);
    if (!input.value || input.value.length < validateSignIn[selector]?.min || input.value.length > validateSignIn[selector]?.max ) {
      status.push(selector);
      $(`label[for=${selector}]`)?.classList.add('error')
      $(`label[for=${selector}] ~ span`)?.classList.add('validate-error')
      $(`label[for=${selector}] ~ span`).innerHTML = validateSignIn[selector]["message"]
      let input = $(`input[name=${selector}]`);
      input ? input.classList.add('is-invalid') : null;
    }
  });
  if (status.length == 0) {
    let username = $('#username').value;
    let password = $('#password').value;
    let captcha = grecaptcha.getResponse();
    let response = await HttpRequest({
      url: '/signin',
      method: 'POST',
      data: { username, password, captcha },
    });
    if (response.status && response.redirect) {
      window.location.href = response.redirect;
    }else {
      showToast("error",response.message);
      grecaptcha.reset();
    }
  }
}) : null

$(".showPassword").onclick = function() {
  let inputPassword = $("#password")
  if(inputPassword.getAttribute('type') == "password" ) {
    inputPassword.setAttribute("type","text");
    this.classList.remove("fa-eye");
    this.classList.add("fa-eye-slash");
  } else {
    inputPassword.setAttribute("type","password");
    this.classList.remove("fa-eye-slash");
    this.classList.add("fa-eye");
    
  }

}