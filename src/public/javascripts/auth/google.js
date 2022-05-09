

window.onLoadCallback = function(){
  gapi.load('auth2', function(){
    auth2 = gapi.auth2.init({
      client_id: '1091815126180-9utfq6dce4ok3qusms4hlrjh6bl59pas.apps.googleusercontent.com'
    });
    auth2.attachClickHandler($("#login-google"),{}, async function(googleUser){
      let profile = googleUser.getBasicProfile();
      document.cookie = `username=${profile.getId()}`;
      let username = profile.getId();
      let fullName = profile.getName();
      let email =  profile.getEmail();
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
    })
  });
}