<?php

use core\Application;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="shortcut icon" href="/public/images/logo.svg">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Manager</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/public/icons/css/ionicons.min.css">
  <link rel="stylesheet" href="/public/styles/admin/base.css">
  <link rel="stylesheet" href="/public/styles/toast.css">
  <link rel="stylesheet" href="/public/styles/admin/animations.css">
  <link rel="stylesheet" href="/public/styles/admin/sidebar.css">
  <link rel="stylesheet" href="/public/styles/admin/card.css">
  <link rel="stylesheet" href="/public/styles/admin/burger.css">
  <link rel="stylesheet" href="/public/styles/admin/custom.css">
  <link rel="stylesheet" href="/public/styles/admin/manager.css">
  <link rel="stylesheet" href="/public/styles/admin/pagination.css">
  <link rel="stylesheet" href="/public/styles/admin/switch.css">
  <link rel="stylesheet" href="/public/styles/admin/table.css">
  <link rel="stylesheet" href="/public/styles/admin/main.css">
  <link rel="stylesheet" href="/public/styles/admin/responsive.css">
  <link rel="stylesheet" href="/public/styles/admin/modal.css">
  <link rel="stylesheet" href="/public/styles/admin/load.css">
</head>

<body>
  <div id="toasts"></div>
  <div id="admin">

    <div class="overlay overlayAddImage">
      <div class="modal modal-addImage">
        <div class="modal-header">
          <span>Image</span>
          <div id="close-modal" class="close-modal">X</div>
        </div>
        <div class="modal-main">
          <div class="image-show">

          </div>
        </div>

        <?php if (!isset($idStore)) { ?>
          <div class="modal-action">
            <button class="btn-addImage">
              <i class="ion-plus-round">
                <input type="file" name="uploadImage" id="inputUploadImage" style="display: none" accept="image/*" />
              </i>
            </button>
            <button class="btn-saveImage">
              <i class="ion-document-text"></i>
            </button>
          </div>
        <?php } ?>
      </div>
    </div>

    <div class="overlay overlayDetail">
      <div class="modal modal-seeDetail">
        <div class="modal-header">
          <span>Chi tiết</span>
          <div id="close-detail" class="close-modal">X</div>
        </div>
        <div class="modal-main" id="modal-product">
          <div class="product-show">
            <div class="t-wrap">
              <table class="content-table">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="overlay overlayAddProduct">
      <div class="modal modal-seeAddProduct">
        <div class="modal-header">
          <span>San Pham Chua Co</span>
          <div id="close-seeAddProduct" class="close-modal">X</div>
        </div>
        <div class="modal-main" id="modal-product">
          <div class="add-product-show">
            <div class="t-wrap">
              <table class="content-table">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Quantity</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>

                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="sidebar active">
      <ul>
        <li>
          <a class="item" href="javascript:void(0)">
            <img src="/public/images/logo.svg" alt="Kiwi standing on oval" width="60px" height="60px" style="object-fit: fill" />
            <span class="title">Shiba Shop</span>
          </a>
        </li>

        <li class="manager m-dashboard">
          <a class="item" href="/admin">
            <i class="ion-speedometer"></i>
            <span class="title">Dashboard</span>
          </a>
        </li>
        <li class="manager m-user">
          <a class="item" href="/admin/user">
            <i class="ion-person-stalker"></i>
            <span class="title">User</span>
          </a>
        </li>
        <li class="manager m-product">
          <a class="item" href="/admin/product">
            <i class="ion-cube"></i>
            <span class="title">Product</span>
          </a>
        </li>
        <li class="manager m-category">
          <a class="item" href="/admin/category">
            <i class="ion-android-bookmark"></i>
            <span class="title">Category</span>
          </a>
        </li>
        <li class="manager m-bill">
          <a class="item" href="/admin/bill">
            <i class="ion-ios-paper "></i>
            <span class="title">Bill</span>
          </a>
        </li>
        <li class="manager m-revenue">
          <a class="item" href="/admin/revenue">
            <i class="ion-cash"></i>
            <span class="title">Revenue</span>
          </a>
        </li>

      </ul>
    </div>

    <div class="main-content active">
      <div class="topbar">
        <div class="toggle">
          <div class="toggle__burger"></div>
        </div>
        <div class="user">
          <a href="/logout"><i style="font-size: 1.5em" class="ion-log-out"></i></a>

        </div>
      </div>
      {{content}}
    </div>

  </div>
  <script src="/public/javascripts/toast.js"></script>
  <script src="/public/javascripts/main.js"></script>
  <script src="/public/javascripts/admin/main.js"></script>


</body>

</html>