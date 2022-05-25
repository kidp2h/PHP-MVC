<div class="dashboard show">
  <div class="card-statistic">
    <div class="card card-user">
      <div class="card-wrap">
        <div class="number"><?= count($users)?></div>
        <div class="card-name">Account</div>
      </div>
      <div class="icon-card">
        <i class="ion-person-stalker ui-bg"></i>
      </div>
    </div>
    <div class="card card-product">
      <div class="card-wrap">
        <div class="number"><?= count($products)?></div>
        <div class="card-name">Product</div>
      </div>
      <div class="icon-card">
        <i class="ion-cube purple"></i>
      </div>
    </div>
    <div class="card card-category">
      <div class="card-wrap">
        <div class="number"><?= count($categories)?></div>
        <div class="card-name">Category</div>
      </div>
      <div class="icon-card">
        <i class="ion-android-bookmark green"></i>
      </div>
    </div>
    <div class="card card-bill">
      <div class="card-wrap">
        <div class="number"><?= count($orders)?></div>
        <div class="card-name">Bill</div>
      </div>
      <div class="icon-card">
        <i class="ion-ios-paper red"></i>
      </div>
    </div>
  </div>
  <div class="details">
    <div class="wrap-table">
      <table class="content-table tuser">
        <thead>
          <tr>
            <th>Fullname</th>
            <th>Address</th>
            <th>Phone</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach(array_slice($users,0,3) as $key => $value){ ?>
          <tr>
            <td><?= $value->fullName ?></td>
            <td><?= $value->address ?></td>
            <td><?= $value->phoneNumber ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="wrap-table">
      <table class="content-table tproduct">
        <thead>
          <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Price($)</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach(array_slice($products,0,8) as $key => $value){ ?>
          <tr>
            <td><?= $value->name ?></td>
            <td><?= $value->category_id ?></td>
            <td><?= $value->price ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="wrap-table">
      <table class="content-table tcategory">
        <thead>
          <tr>
            <th>Image</th>
            <th>Name</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach(array_slice($categories, 1, 3) as $key => $value){ ?>
          <tr>
          <td>
            <div class="wrap-image">
              <img class="image-document i-category" src="<?= $value->image?>" alt="Category id <?= $value->id?>" width="50">
            </div>
          </td>
            <td><?= $value->title ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>