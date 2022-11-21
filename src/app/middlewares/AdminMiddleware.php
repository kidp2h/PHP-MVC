<?php

namespace app\middlewares;

use app\controllers\AdminController;
use app\models\User;
use core\Application;
use core\Request;
use core\Response;

class AdminMiddleware
{
  public static function isManagerStore(Request $request, Response $response): callable | bool
  {
    $idStore = $request->param('id');
    $accessToken = Application::getCookie("accessToken");
    $resultAccessToken = User::decodeAccessToken($accessToken);
    if ($resultAccessToken['status']) {
      $user = $resultAccessToken["user"];
      if ($user->permission == $idStore || $user->permission == 0) {
        AdminController::$paramsLayout = ["idStore" => $idStore];
        return true;
      } else if ($user->permission == 0) {
        return true;
      } else return fn () => $response->redirect("/");
    } else
      return fn () => $response->redirect("/");
  }
  public static function isAdmin(Request $request, Response $response): callable | bool
  {
    $result = User::decodeAccessToken($_COOKIE['accessToken']);
    if ($result["status"] && $result["user"]->permission == 0)
      return true;
    else
      return fn () => $response->redirect("/");
  }
}
