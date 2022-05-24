<div class="tmanager tmanager-user">
  <div class="t-wrap">
    <table class="content-table">
      <thead>
        <tr>
          <th class="sort sortUsername">
            <input type="radio" name="sort" value="" />Fullname<i
              class="ion-funnel"
            ></i>
          </th>
          <th class="sort sortFullName">
            <input type="radio" name="sort" value="" />Username<i
              class="ion-funnel"
            ></i>
          </th>
          <th class="sort sortAddress">
            <input type="radio" name="sort" value="" />Address<i
              class="ion-funnel"
            ></i>
          </th>
          <th class="sort sortPhone">
            <input type="radio" name="sort" value="" />Phone<i
              class="ion-funnel"
            ></i>
          </th>
          <th class="sort sortPermission">
            Email Address<i class="ion-funnel"></i>
          </th>
          <th>Permission</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($users as $key => $value){ ?>
        <tr>
            <td class="rowTable"><?= $value->fullName?></td>
            <td class="rowTable"><?= $value->username?></td>
            <td class="rowTable"><?= $value->address?></td>
            <td class="rowTable"><?= $value->phone?></td>
            <td class="rowTable"><?= $value->email?></td>
            <td class="rowTable"><?= $value->permission?></td>
        </tr>
      <?php } ?> 
      </tbody>
    </table>
  </div>
</div>
