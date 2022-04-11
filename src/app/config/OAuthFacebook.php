<?php

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;

class OAuthFacebook {
  public Facebook $facebook;
  public string $accessToken;
  public function __construct() {
    $this->facebook = new Facebook([
      'app_id' => $_ENV["FB_APP_ID"],
      'app_secret' => $_ENV["FB_APP_SECRET"],
      'default_graph_version' => 'v2.10',
    ]);
    $helper = $this->facebook->getRedirectLoginHelper();
    try {
      if(isset($_SESSION["facebook_access_token"])){
        $this->accessToken = $_SESSION["facebook_access_token"];
      }else{
        $this->accessToken = $helper->getAccessToken();
      }
    }catch(FacebookResponseException $e){
      echo $e->getMessage();
      exit;
    }catch (FacebookSDKException $e){
      echo $e->getMessage();
      exit;
    }
  }
}