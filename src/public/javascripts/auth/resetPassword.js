let validateReset = {
  newPassword: {
    min: 3,
    max: 9999999999999,
    message: 'Your password is too short',
  },
  confirmNewPassword: {
    match: 'newPassword',
    message: 'Confirm password is not same',
  },
};

$('#btn-reset')
  ? ($('#btn-reset').onclick = async function () {
      let fields = ['newPassword', 'confirmNewPassword'];
      let status = validate(fields, validateReset);
      if (status.length == 0) {
        let newPassword = $('#newPassword').value;
        let confirmNewPassword = $('#confirmNewPassword').value;
        let tokenReset = this.dataset.token;
        let response = await HttpRequest({
          url: '/resetPassword',
          method: 'POST',
          data: { newPassword, confirmNewPassword, tokenReset },
        });
        if (response.status) {
          showToast('success', response.message);
          setTimeout(() => {
            window.location.href = response.redirect;
          }, 3000);
        }
      }
    })
  : null;
