window.fbAsyncInit = function () {
  FB.init({
    appId: '379674354067143',
    cookie: true,
    xfbml: true,
    version: 'v3.2',
  });

  FB.AppEvents.logPageView();
  FB.getLoginStatus(function (response) {
    if (response.status == 'connected') {
      handleResponse();
    }
  });
};

(function (d, s, id) {
  var js,
    fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {
    return;
  }
  js = d.createElement(s);
  js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js';
  fjs.parentNode.insertBefore(js, fjs);
})(document, 'script', 'facebook-jssdk');
function fbLogin() {
  FB.login(
    function (response) {
      if (response.authResponse) {
        handleResponse();
      } else {

      }
    },
    { scope: 'email' }
  );
}
function handleResponse() {
  FB.api('/me',{
    locale: 'vi_VN',
    fields: 'id,first_name, email, name,last_name,picture,gender',
  },async (response) => {
      document.cookie = `username=${response.id}`; 
      let username = response.id;
      let fullName = response.name;
      let email = response.email;
      let res = await HttpRequest({
        url: '/oauth',
        method: 'POST',
        data: { username, fullName, email },
      });
      if (res.status && res.redirect) {
        window.location.href = res.redirect;
      }else {
        showToast("error",res.message);
      }
    }
  );
}
