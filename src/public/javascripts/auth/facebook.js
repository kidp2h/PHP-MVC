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
      getUserData();
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
        getUserData();
      } else {
        alert('not success');
      }
    },
    { scope: 'email' }
  );
}
function getUserData() {
  FB.api(
    '/me',
    {
      locale: 'en_US',
      fields: 'id,first_name, email, name,last_name,picture,gender',
    },
    (response) => {
      console.log(response);
      alert(
        `${response.first_name} ${response.last_name} ID FB: ${response.id}`
      );
    }
  );
}
