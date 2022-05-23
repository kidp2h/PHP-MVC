<?php use core\Application; ?>

<div class="tmanager tmanager-category">
  <div class="box-filter">
    <div class="table-search">
      <i class="ion-search ic-input-search"></i>
      <input class="input-search" type="text" placeholder="Search by name category" />
    </div>
  </div>
  <div class="t-wrap">
    <table class="content-table">
      <thead>
        <tr>
          <th>Image</th>
          <th class="sort sortName">
            <input type="radio" name="sort" value="" checked />
            Name
            <i class="ion-funnel"></i>
          </th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody> 
        <?php
          foreach($categories as $category) {
            include Application::$__ROOT_DIR__.'/app/views/components/admin.category.php';
          }
        ?>
      </tbody>
    </table>
  </div>
  <div class="actionCategory table-action">
    <div>
      <span class="btn-table-action add-category"><i class="ion-plus-round"></i></span>
    </div>
  </div>
</div>