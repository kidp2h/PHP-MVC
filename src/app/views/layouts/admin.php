<?php
  use core\Application;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
      integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="/public/styles/admin/base.css">
    <link rel="stylesheet" href="/public/styles/admin/alert.css">
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
    <div id="admin">
      <div class="sidebar active">
        <ul>
          <li>
            <a class="item" href="#home">
              <img
                src="/public/images/logo.svg"
                alt="Kiwi standing on oval"
                width="60px"
                height="60px"
                style="object-fit: fill"
              />
              <span class="title">Shibaaa</span>
            </a>
          </li>
          <li class="manager active m-dashboard">
            <a class="item">
              <i class="fas fa-chart-line"></i>
              <span class="title">Dashboard</span>
            </a>
          </li>
          <li class="manager m-user">
            <a class="item">
              <i class="fas fa-user-friends"></i>
              <span class="title">User</span>
            </a>
          </li>
          <li class="manager m-product">
            <a class="item">
              <i class="fas fa-cubes"></i>
              <span class="title">Product</span>
            </a>
          </li>
          <li class="manager m-category">
            <a class="item">
              <i class="fas fa-receipt"></i>
              <span class="title">Category</span>
            </a>
          </li>
          <li class="manager m-bill">
            <a class="item">
              <i class="fas fa-file-invoice-dollar"></i>
              <span class="title">Bill</span>
            </a>
          </li>
          <li class="manager m-revenue">
            <a class="item">
              <i class="fas fa-signal"></i>
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
            <i style="font-size: 1.5em" class="fas fa-door-open"></i>
          </div>
        </div>
        {{content}}
      </div>
    </div>
    <script src="/public/javascripts/main.js"></script>
    <script src="/public/javascripts/admin/main.js"></script>
  </body>
</html>
