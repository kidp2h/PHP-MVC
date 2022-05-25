<div class="tmanager tmanager-revenue">
  <div class="box-filter">
    <div class="table-search search-category">
      <select name="search-category" id="select-search-category"></select>
    </div>
  </div>
  <div class="t-wrap">
    <table class="content-table">
      <thead>
        <tr>
          <th class="sort sortProductName">
            <input type="radio" name="sort" value="" />
            Product
          </th>
          <th class="sort sortCategory">
            <input type="radio" name="sort" value="" />
            Category
          </th>
          <th class="sort sortQTY">
            <input type="radio" name="sort" value="" />
            Quantity Sold
          </th>
          <th class="sort sortTotal">
            <input type="radio" name="sort" value="" />
            Total
          </th>
        </tr>
      </thead>
      <tbody>
        <?php 

          use core\Application;
      
          foreach($revenue as $item) {
            
            include Application::$__ROOT_DIR__.'/app/views/components/admin.revenue.php';
          }

        ?>
       

      </tbody>
    </table>
  </div>
</div>