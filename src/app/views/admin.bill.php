<?php

use core\Application; ?>

<div class="tmanager tmanager-bill">
  <div class="t-wrap">
    <table class="content-table">
      <thead>
        <tr>
          <th class="sort sortUsername">
            <input type="radio" name="sort" value="" checked />
            Username
          </th>
          <th>Products</th>
          <th class="sort sortDateTimeBill">
            <input type="radio" name="sort" value="" />
            Date Time
          </th>
          <th class="sort sortSubtotal">
            <input type="radio" name="sort" value="" />
            Subtotal
          </th>
          <th class="sort sortStatus">
            <input type="radio" name="sort" value="" />
            Status
          </th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php

        foreach ($orders as $order) {
          include Application::$__ROOT_DIR__ . '/app/views/components/admin.bill.php';
        }

        ?>


      </tbody>
    </table>
  </div>
</div>