<?php

use core\Application; ?>
<div class="tmanager tmanager-user">
  <?php if (Application::$user->permission == 0) { ?>
    <div class="actionUser table-action">
      <div>
        <span class="btn-table-action add-user"><i class="ion-plus-round"></i></span>
      </div>
    </div>
  <?php } ?>
  <div class="t-wrap">
    <table class="content-table">
      <thead>
        <tr>
          <th class="sort sortUsername">
            <input type="radio" name="sort" value="" />Fullname
          </th>
          <th class="sort sortFullName">
            <input type="radio" name="sort" value="" />Username
          </th>
          <th class="sort sortAddress">
            <input type="radio" name="sort" value="" />Address
          </th>
          <th class="sort sortPhone">
            <input type="radio" name="sort" value="" />Phone
          </th>
          <th class="sort sortPermission">
            Email Address
          </th>
          <th>Permission</th>
          <?php if (Application::$user->permission == 0) { ?>
            <th>Action</th>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach (array_reverse($users) as $key => $value) { ?>
          <tr>
            <td class="rowTable"><?= $value->fullName ?></td>
            <td class="rowTable"><?= $value->username ?></td>
            <td class="rowTable"><?= $value->address ?></td>
            <td class="rowTable"><?= $value->phone ?></td>
            <td class="rowTable"><?= $value->email ?></td>
            <td class="categoryProduct rowTable">
              <div id="select">
                <select id="selectPermission" style="background-color: var(--primary-color);">
                  <option <?= $value->permission == 0 ? "selected" : '' ?> value='0'>Adminstrator</option>
                  <option <?= $value->permission == -1 ? "selected" : '' ?> value='-1'>User</option>
                </select>
              </div>
            </td>
            <?php if (Application::$user->permission == 0) { ?>
              <td class="action">
                <?php if (Application::$user->id != $value->id) { ?>
                  <button class="button-icon save" data-id='<?= $value->id ?>'>
                    <i class="ion-document-text"></i>
                  </button>
                <?php } ?>
              </td>
            <?php } ?>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>