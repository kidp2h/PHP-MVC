<?php
namespace router;

use app\controllers\AdminController;
use app\middlewares\AuthMiddleware;
use app\middlewares\AdminMiddleware;
use core\Application;

$app = Application::Instance();
$app->router->prefix("/admin");
$app->router->get("/",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isAdmin"]] ,[AdminController::class, "admin"]);
$app->router->get("/user", [[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isAdmin"]] ,[AdminController::class, "user"]);
$app->router->get("/product", [[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isAdmin"]] , [AdminController::class, "product"]);
$app->router->get("/category", [[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isAdmin"]] ,[AdminController::class, "category"]);
$app->router->get("/bill", [[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isAdmin"]] ,[AdminController::class, "bill"]);
$app->router->get("/revenue", [[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isAdmin"]] ,[AdminController::class, "revenue"]);
$app->router->get("/store", [[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isAdmin"]] ,[AdminController::class, "store"]);


$app->router->get("/store/user/{id:\d+}",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isManagerStore"]] ,[AdminController::class, "user"]);
$app->router->get("/store/product/{id:\d+}",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isManagerStore"]] ,[AdminController::class, "productStore"]);
$app->router->get("/store/category/{id:\d+}",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isManagerStore"]] ,[AdminController::class, "category"]);
$app->router->get("/store/bill/{id:\d+}",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isManagerStore"]] ,[AdminController::class, "billStore"]);
$app->router->get("/store/revenue/{id:\d+}",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isManagerStore"]] ,[AdminController::class, "revenueStore"]);
$app->router->get("/store/store/{id:\d+}",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isManagerStore"]] ,[AdminController::class, "storeStore"]);
$app->router->get("/store/{id:\d+}",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isManagerStore"]] ,[AdminController::class, "adminStore"]);


$app->router->post("/changeImageCategory/{id:\d+}",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isAdmin"]],[AdminController::class, "changeImageCategory"]);
$app->router->post("/uploadImageProduct/{id:\d+}",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isAdmin"]],[AdminController::class, "uploadImageProduct"]);
$app->router->post("/deleteImageProduct/{id:\d+}",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isAdmin"]],[AdminController::class, "deleteImageProduct"]);


$app->router->post("/removeProduct",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isAdmin"]],[AdminController::class, "removeProduct"]);
$app->router->post("/saveProduct",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isAdmin"]],[AdminController::class, "saveProduct"]);
$app->router->post("/createProduct",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isAdmin"]],[AdminController::class, "createProduct"]);
$app->router->post("/saveProductStore/{id:\d+}",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isManagerStore"]],[AdminController::class, "saveProductStore"]);
$app->router->post("/removeProductStore/{id:\d+}",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isManagerStore"]],[AdminController::class, "removeProductStore"]);


$app->router->post("/removeCategory",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isAdmin"]],[AdminController::class, "removeCategory"]);
$app->router->post("/saveCategory",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isAdmin"]],[AdminController::class, "saveCategory"]);
$app->router->post("/createCategory",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isAdmin"]],[AdminController::class, "createCategory"]);
$app->router->post("/handleProductRemoveCategory",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isAdmin"]],[AdminController::class, "handleProductRemoveCategory"]);


$app->router->post("/saveUser",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isAdmin"]],[AdminController::class, "saveUser"]);
$app->router->post("/createUser",[[AuthMiddleware::class,"isAuth"],[AdminMiddleware::class, "isAdmin"]],[AdminController::class, "createUser"]);