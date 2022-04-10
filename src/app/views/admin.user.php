<div class="tmanager tmanager-user">
  <div class="box-filter">
    <div class="table-search">
      <i class="fas fa-search ic-input-search"></i>
      <input
        class="input-search"
        type="text"
        placeholder="Search by name user"
      />
    </div>
  </div>
  <div class="t-wrap">
    <table class="content-table">
      <thead>
        <tr>
          <th class="sort sortUsername">
            <input type="radio" name="sort" value="" />Username<i
              class="fas fa-sort"
            ></i>
          </th>
          <th class="sort sortFullName">
            <input type="radio" name="sort" value="" />FullName<i
              class="fas fa-sort"
            ></i>
          </th>
          <th class="sort sortAddress">
            <input type="radio" name="sort" value="" />Address<i
              class="fas fa-sort"
            ></i>
          </th>
          <th class="sort sortPhone">
            <input type="radio" name="sort" value="" />Phone<i
              class="fas fa-sort"
            ></i>
          </th>
          <th class="sort sortPermission">
            IsAdmin<i class="fas fa-sort"></i>
          </th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="actionUser table-action">
    <div>
      <span class="btn-table-action add-user"><i class="fas fa-plus"></i></span>
    </div>
    <div class="pagination page-user" style="float: right">
      <input type="hidden" class="currentPage" value="1" />
      <ul>
        <li class="previous">&lt;</li>
        <li class="next">&gt;</li>
      </ul>
    </div>
  </div>
</div>
