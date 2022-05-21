<div class="tmanager tmanager-product">
  <div class="box-filter">
    <div class="table-search">
      <i class="fas fa-search ic-input-search"></i>
      <input class="input-search" type="text" placeholder="Search by name product" />
    </div>
    <div class="box-search-detail">
      <div class="group-range-price">
        <label>Lọc theo giá</label>
        <input type="number" class="rangePrice" placeholder="Giá thấp nhất" id="rangePrice-from" maxlength="15" />
        <span>-</span>
        <input type="number" placeholder="Giá cao nhất" class="rangePrice" id="rangePrice-to" maxlength="15" />
      </div>
      <div class="group-filter-category">
        <label>Lọc theo loại</label>
        <div class="list-btn-category"></div>
      </div>
      <div class="group-filter-rate">
        <label>Lọc theo đánh giá</label>
        <span class="selectRate">
          <i data-pos="1" class="active">★</i>
          <i data-pos="2">★</i>
          <i data-pos="3">★</i>
          <i data-pos="4">★</i>
          <i data-pos="5">★</i>
        </span>
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
            <i class="fas fa-sort"></i>
          </th>
          <th class="sort sortCategory col2">
            <input type="radio" name="sort" value="" />
            Category
            <i class="fas fa-sort"></i>
          </th>
          <th class="sort sortPrice col3">
            <input type="radio" name="sort" value="" />
            Price($)
            <i class="fas fa-sort"></i>
          </th>
          <!-- <th class="sort sortSale col4">
            <input type="radio" name="sort" value="" />
            Sale($)
            <i class="fas fa-sort"></i>
          </th> -->
          <!-- <th class="sort sortRate col5">
            <input type="radio" name="sort" value="" />
            Rate
            <i class="fas fa-sort"></i>
          </th> -->
          <th>Action</th>
        </tr>
      </thead>
      <tbody>

        <?php 
          use core\Application;

          foreach($products as $product) {
            
          }
        ?>


      </tbody>
    </table>
  </div>
  <div class="actionProduct table-action">
    <div>
      <span class="btn-table-action add-product"><i class="ion-plus-round"></i></span>
    </div>
    <div class="pagination page-product" style="float: right">
      <input type="hidden" class="currentPage" value="1" />
      <ul>
        <li class="previous">&lt;</li>
        <li class="next">&gt;</li>
      </ul>
    </div>
  </div>
</div>