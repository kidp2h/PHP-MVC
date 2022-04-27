let validateForgot = {
  email: {
    pattern: new RegExp(/(\w+.)+@(\w+).(\w+)/g),
    message: 'Email is not valid',
  },
  // captcha: {
  //   message: 'Please check this box captcha',
  // },
};

$('#btn-forgot')
  ? ($('#btn-forgot').onclick = async () => {
      $('#captcha').value = grecaptcha.getResponse();
      let fields = ['email'];
      let status = validate(fields, validateForgot);
      if (status.length == 0) {
        let email = $('#email').value;
        let captcha = grecaptcha.getResponse();
        let response = await HttpRequest({
          url: '/forgotPassword',
          method: 'POST',
          data: { email, captcha },
        });
        if (response.status) {
          showToast('success', response.message);
        } else {
          showToast('error', response.message);
        }
        grecaptcha.reset();
      }
    })
  : null;
