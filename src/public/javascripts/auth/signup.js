let validateSignUp = {
  fullname: {
    min: 10,
    max: 50,
    message: 'Full name must be have 10 - 50 characters',
  },
  username: {
    min: 5,
    max: 15,
    message: 'Username must be have 5 - 15 characters',
  },
  email: {
    pattern: new RegExp(/(\w+.)+@(\w+).(\w+)/g),
    message: 'Email is not valid',
  },
  password: {
    min: 3,
    max: 9999999999999,
    message: 'Your password is too short',
  },
  'confirm-password': {
    match: 'password',
    message: 'Confirm password is not same',
  },
  captcha: {
    message: 'Please check this box captcha',
    max: 99999999999999,
  },
};

$('#btn-signup')
  ? ($('#btn-signup').onclick = async () => {
      let fields = [
        'fullname',
        'username',
        'email',
        'password',
        'confirm-password',
      ];
      let status = validate(fields, validateSignUp);
      if (status.length == 0) {
        let username = $('#username').value;
        let password = $('#password').value;
        let confirmPassword = $('#password').value;
        let fullName = $('#fullname').value;
        let email = $('#email').value;
        let response = await HttpRequest({
          url: '/signup',
          method: 'POST',
          data: {
            username,
            password,
            fullName,
            email,
            confirmPassword,
          },
        });
        if (response.status && response.redirect) {
          showToast('success', response.message);
          setTimeout(() => {
            window.location.href = response.redirect;
          }, 3000);
        } else {
          showToast('error', response.message);
        }
      }
    })
  : null;
