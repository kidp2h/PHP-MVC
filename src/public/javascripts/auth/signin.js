let validateSignIn = {
  username: {
    min: 5,
    max: 15,
    message: 'Username must be have 5 - 15 characters',
  },
  password: {
    min: 3,
    max: 9999999999999,
    message: 'Minimum length of the password must be 6',
  },
};

$('#btn-signin')
  ? ($('#btn-signin').onclick = async () => {
      let fields = ['username', 'password'];
      let status = validate(fields, validateSignIn);

      if (status.length == 0) {
        let username = $('#username').value;
        let password = $('#password').value;
        let response = await HttpRequest({
          url: '/signin',
          method: 'POST',
          data: { username, password },
        });
        if (response.status && response.redirect) {
          window.location.href = response.redirect;
        } else {
          showToast('error', response.message);
        }
      }
    })
  : null;
