$('#btn-login').onclick = async () => {
  $('#captcha').value = grecaptcha.getResponse();
  let fields = ['captcha', 'username', 'password'];
  var username, password, captcha;
  let status = [];
  fields.forEach((selector) => {
    $(`label[for=${selector}]`).style.color = null;
    $(`input[name=${selector}]`)?.classList.remove('is-invalid');
    let input = $(`#${selector}`);
    if (!input.value) {
      status.push(selector);
      $(`label[for=${selector}]`).style.color = 'red';
      let input = $(`input[name=${selector}]`);
      if (input) input.classList.add('is-invalid');
    }
  });
  if (status.length == 0) {
    let username = $('#username').value;
    let password = $('#password').value;
    let captcha = grecaptcha.getResponse();
    let response = await HttpRequest({
      url: '/login',
      method: 'POST',
      data: { username, password, captcha },
    });
    if (response.status && response.redirect) {
      window.location.href = response.redirect;
    }
  }
};
