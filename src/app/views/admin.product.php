<?php

use core\Application; ?>

<div class="tmanager tmanager-product">
  <div class="actionProduct table-action">
    <div>
      <span class="btn-table-action add-product"><i class="ion-plus-round"></i></span>
    </div>
  </div>
  <div class="t-wrap">
    <table class="content-table">
      <thead>
        <tr>
          <th>Image</th>
          <th class="sort sortName col1">
            <input type="radio" name="sort" value="" checked />
            Name
          </th>
          <th class="sort sortCategory col2">
            <input type="radio" name="sort" value="" />
            Category
          </th>

          <th class="sort sortPrice col3">
            <input type="radio" name="sort" value="" />
            Price

          </th>



          <th>Action</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $products = array_reverse($products);

        foreach ($products as $product) {
          if ($product->deleted_at == NULL)
            //$product->image = json_decode($product->image);
            include Application::$__ROOT_DIR__ . '/app/views/components/admin.product.php';
        }

        ?>



      </tbody>
    </table>
  </div>

</div>