<?php use core\Application; ?>

<div class="tmanager tmanager-category">
  <?php if(Application::$user->permission == 0){ ?>
  <div class="actionCategory table-action">
    <div>
      <span class="btn-table-action add-category"><i class="ion-plus-round"></i></span>
    </div>
  </div>
  <?php } ?>
  <div class="t-wrap">
    <table class="content-table">
      <thead>
        <tr>
          <th>Image</th>
          <th class="sort sortName">
            <input type="radio" name="sort" value="" checked />
            Name
          </th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody> 
        <?php
          foreach($categories as $category) {
            if($category['deleted_at'] == NULL && $category["id"] != "0")
              include Application::$__ROOT_DIR__.'/app/views/components/admin.category.php';
          }
        ?>
      </tbody>
    </table>
  </div>
</div>