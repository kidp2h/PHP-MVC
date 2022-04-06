<div class="overlay overlayAddImage">
  <div class="modal modal-addImage">
    <div class="modal-header">
      <span>Thêm ảnh</span>
      <div id="close-modal" class="close-modal">X</div>
    </div>
    <div class="modal-main">
      <div class="image-show"></div>
    </div>
    <div class="modal-action">
      <button class="btn-addImage">
        <i class="fas fa-plus">
          <input
            type="file"
            name="uploadImage"
            id="inputUploadImage"
            style="display: none"
            accept="image/*"
          />
        </i>
      </button>
      <button class="btn-saveImage">
        <i class="fas fa-save"></i>
      </button>
    </div>
  </div>
  <div class="overlay overlayDetail">
    <div class="modal modal-seeDetail">
      <div class="modal-header">
        <span>Chi tiết</span>
        <div id="close-detail" class="close-modal">X</div>
      </div>
      <div class="modal-main" id="modal-product">
        <div class="product-show">
          <div class="t-wrap">
            <table class="content-table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Quantity</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>1</td>
                  <td>1</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    {{components.sidebar}}
    <div class="main-content active">
      {{components.topbar}}
      <input
        type="radio"
        id="r-dashboard"
        name="type"
        value="dashboard"
        checked
      />
      <input type="radio" id="r-user" name="type" value="user" />
      <input type="radio" id="r-product" name="type" value="product" />
      <input type="radio" id="r-category" name="type" value="category" />
      <input type="radio" id="r-bill" name="type" value="bill" />
      <input type="radio" id="r-revenue" name="type" value="revenue" />
      <div class="dashboard show">
        <div class="card-statistic">
          <div class="card card-user">
            <div class="card-wrap">
              <div class="number">0</div>
              <div class="card-name">Account</div>
            </div>
            <div class="icon-card">
              <i class="fas fa-user-friends ui-bg"></i>
            </div>
          </div>
          <div class="card card-product">
            <div class="card-wrap">
              <div class="number">0</div>
              <div class="card-name">Product</div>
            </div>
            <div class="icon-card">
              <i class="fas fa-cubes purple"></i>
            </div>
          </div>
          <div class="card card-category">
            <div class="card-wrap">
              <div class="number">0</div>
              <div class="card-name">Category</div>
            </div>
            <div class="icon-card">
              <i class="fas fa-receipt green"></i>
            </div>
          </div>
          <div class="card card-bill">
            <div class="card-wrap">
              <div class="number">0</div>
              <div class="card-name">Bill</div>
            </div>
            <div class="icon-card">
              <i class="fas fa-file-invoice-dollar red"></i>
            </div>
          </div>
        </div>
        <div class="details">
          <div class="wrap-table">
            <table class="content-table tuser">
              <thead>
                <tr>
                  <th>Username</th>
                  <th>FullName</th>
                  <th>IsAdmin</th>
                </tr>
              </thead>
              <tbody></tbody>
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
              <tbody></tbody>
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
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
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
            <span class="btn-table-action add-user"
              ><i class="fas fa-plus"></i
            ></span>
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
      <div class="tmanager tmanager-product">
        <div class="box-filter">
          <div class="table-search">
            <i class="fas fa-search ic-input-search"></i>
            <input
              class="input-search"
              type="text"
              placeholder="Search by name product"
            />
          </div>
          <div class="box-search-detail">
            <div class="group-range-price">
              <label>Lọc theo giá</label>
              <input
                type="number"
                class="rangePrice"
                placeholder="Giá thấp nhất"
                id="rangePrice-from"
                maxlength="15"
              />
              <span>-</span>
              <input
                type="number"
                placeholder="Giá cao nhất"
                class="rangePrice"
                id="rangePrice-to"
                maxlength="15"
              />
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
                <th class="sort sortSale col4">
                  <input type="radio" name="sort" value="" />
                  Sale($)
                  <i class="fas fa-sort"></i>
                </th>
                <th class="sort sortRate col5">
                  <input type="radio" name="sort" value="" />
                  Rate
                  <i class="fas fa-sort"></i>
                </th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
        <div class="actionProduct table-action">
          <div>
            <span class="btn-table-action add-product"
              ><i class="fas fa-plus"></i
            ></span>
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
      <div class="tmanager tmanager-category">
        <div class="box-filter">
          <div class="table-search">
            <i class="fas fa-search ic-input-search"></i>
            <input
              class="input-search"
              type="text"
              placeholder="Search by name category"
            />
          </div>
        </div>
        <div class="t-wrap">
          <table class="content-table">
            <thead>
              <tr>
                <th>Image</th>
                <th class="sort sortName">
                  <input type="radio" name="sort" value="" checked />
                  Name
                  <i class="fas fa-sort"></i>
                </th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
        <div class="actionCategory table-action">
          <div>
            <span class="btn-table-action add-category"
              ><i class="fas fa-plus"></i
            ></span>
          </div>
          <div class="pagination page-category" style="float: right">
            <input type="hidden" class="currentPage" value="1" />
            <ul>
              <li class="previous">&lt;</li>
              <li class="next">&gt;</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="tmanager tmanager-bill">
        <div class="box-filter">
          <div class="input-date">
            <span style="font-size: 1.5em; margin-left: 5px">From</span>
            <div class="table-search">
              <i class="fas fa-calendar-alt ic-input-search"></i>
              <input
                class="input-search input-from"
                type="datetime-local"
                style="margin-bottom: 0px"
              />
            </div>
            <span style="font-size: 1.5em; margin-left: 5px">To</span>
            <div class="table-search">
              <i class="fas fa-calendar-alt ic-input-search"></i>
              <input class="input-search input-to" type="datetime-local" />
            </div>
            <div class="table-search">
              <i class="fas fa-search ic-input-search"></i>
              <input
                class="input-search searchBillByUsername"
                type="text"
                placeholder="Search by username"
              />
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
        <div class="actionBill table-action" style="justify-content: flex-end">
          <div class="pagination page-bill">
            <input type="hidden" class="currentPage" value="1" />
            <ul>
              <li class="previous">&lt;</li>
              <li class="next">&gt;</li>
            </ul>
          </div>
        </div>
      </div>
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
                  <i class="fas fa-sort"></i>
                </th>
                <th class="sort sortCategory">
                  <input type="radio" name="sort" value="" />
                  Category
                  <i class="fas fa-sort"></i>
                </th>
                <th class="sort sortPrice">
                  <input type="radio" name="sort" value="" />
                  Price
                  <i class="fas fa-sort"></i>
                </th>
                <th class="sort sortQTY">
                  <input type="radio" name="sort" value="" />
                  Quantity Sold
                  <i class="fas fa-sort"></i>
                </th>
                <th class="sort sortTotal">
                  <input type="radio" name="sort" value="" />
                  Total
                  <i class="fas fa-sort"></i>
                </th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
      <div class="groups-alert"></div>
    </div>
  </div>
</div>
