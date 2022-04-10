<div class="tmanager tmanager-bill">
  <div class="box-filter">
    <div class="input-date">
      <span style="font-size:1.5em;margin-left:5px;">From</span>
      <div class="table-search">
        <i class="fas fa-calendar-alt ic-input-search"></i>
        <input class="input-search input-from" type="datetime-local" style="margin-bottom: 0px;" />
      </div>
      <span style="font-size:1.5em;margin-left:5px;">To</span>
      <div class="table-search">
        <i class="fas fa-calendar-alt ic-input-search"></i>
        <input class="input-search input-to" type="datetime-local" />
      </div>
      <div class="table-search">
        <i class="fas fa-search ic-input-search"></i>
        <input class="input-search searchBillByUsername" type="text" placeholder="Search by username" />
      </div>
      <div><button class="btn-filter-bill">Filter</button></div>
    </div>
  </div>
  <div class="t-wrap">
    <table class="content-table">
      <thead>
        <tr>
          <th class="sort sortUsername">
            <input type="radio" name="sort" value="" checked />
            Username
            <i class="fas fa-sort"></i>
          </th>
          <th>Products</th>
          <th class="sort sortDateTimeBill">
            <input type="radio" name="sort" value="" />
            Date Time
            <i class="fas fa-sort"></i>
          </th>
          <th class="sort sortSubtotal">
            <input type="radio" name="sort" value="" />
            Subtotal
            <i class="fas fa-sort"></i>
          </th>
          <th class="sort sortStatus">
            <input type="radio" name="sort" value="" />
            Status
            <i class="fas fa-sort"></i>
          </th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="actionBill table-action" style="justify-content:flex-end">
    <div class="pagination page-bill">
      <input type="hidden" class="currentPage" value="1" />
      <ul>
        <li class="previous">&lt;</li>
        <li class="next">&gt;</li>
      </ul>
    </div>
  </div>
</div>