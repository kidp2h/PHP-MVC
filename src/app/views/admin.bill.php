<?php use core\Application; ?>

<div class="tmanager tmanager-bill">
  <div class="t-wrap">
    <table class="content-table">
      <thead>
        <tr>
          <?php if(!isset($idStore)) {?>
          <th class="sort sortUsername">
            <input type="radio" name="sort" value="" checked />
            Store
            <i class="ion-funnel"></i>
          </th>
          <?php }?>
          <th class="sort sortUsername">
            <input type="radio" name="sort" value="" checked />
            Username
            <i class="ion-funnel"></i>
          </th>
          <th>Products</th>
          <th class="sort sortDateTimeBill">
            <input type="radio" name="sort" value="" />
            Date Time
            <i class="ion-funnel"></i>
          </th>
          <th class="sort sortSubtotal">
            <input type="radio" name="sort" value="" />
            Subtotal
            <i class="ion-funnel"></i>
          </th>
          <th class="sort sortStatus">
            <input type="radio" name="sort" value="" />
            Status
            <i class="ion-funnel"></i>
          </th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php

          foreach($orders as $order) {
            include Application::$__ROOT_DIR__.'/app/views/components/admin.bill.php';
          }

        ?>


      </tbody>
    </table>
  </div>
</div>