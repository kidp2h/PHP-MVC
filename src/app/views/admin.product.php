<?php use core\Application; ?>

<div class="tmanager tmanager-product">
  <div class="box-filter">
    <div class="table-search">
      <i class="ion-search ic-input-search"></i>
      <input class="input-search" type="text" placeholder="Search by name product" />
    </div>
    <div class="box-search-detail">
      <div class="group-range-price">
        <label>Lọc theo giá</label>
        <input type="number" class="rangePrice" placeholder="Giá thấp nhất" id="rangePrice-from" maxlength="15" />
        <span>-</span>
        <input type="number" placeholder="Giá cao nhất" class="rangePrice" id="rangePrice-to" maxlength="15" />
      </div>
      <button class="btn-filter-detail">Filter</button>
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
            <i class="ion-funnel"></i>
          </th>
          <th class="sort sortCategory col2">
            <input type="radio" name="sort" value="" />
            Category
            <i class="ion-funnel"></i>
          </th>

          <th class="sort sortPrice col3">
            <input type="radio" name="sort" value="" />
            Price($)
            <i class="ion-funnel"></i>
          </th>
          
          <?php if(isset($idStore)) {?>
            
            <th class="sort sortPrice col3">
              <input type="radio" name="sort" value="" />
              Discount
              <i class="ion-funnel"></i>
            </th>
            
            <th class="sort sortPrice col3">
              <input type="radio" name="sort" value="" />
              Quantity
              <i class="ion-funnel"></i>
            </th>


          <?php }?>


          <th>Action</th>
        </tr>
      </thead>
      <tbody>

        <?php

          if(isset($idStore)) {

            foreach($products as $product) {
              $product['image'] = json_decode($product['image']);
              include Application::$__ROOT_DIR__.'/app/views/components/admin.product.store.php';
            }

          } else {

            foreach($products as $product) {
              $product['image'] = json_decode($product['image']);
              include Application::$__ROOT_DIR__.'/app/views/components/admin.product.php';
            }

          }
        ?>



      </tbody>
    </table>
  </div>
  <div class="actionProduct table-action">
    <div>
      <span class="btn-table-action add-product" data-store = '<?=$idStore?>'><i class="ion-plus-round"></i></span>
    </div>
  </div>
</div>
