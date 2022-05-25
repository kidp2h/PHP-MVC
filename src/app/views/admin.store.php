<?php

use core\Application; ?>

<div class="tmanager tmanager-product">
    <div class="box-filter">
        <div class="table-search">
            <i class="ion-search ic-input-search"></i>
            <input class="input-search" type="text" placeholder="Search by name product" />
        </div>
        <div class="box-search-detail">
            <div class="group-range-price">
                <label>Lọc theo giá</label>
                <input type="number" class="rangePrice" placeholder="Giá thấp nhất" id="rangePrice-from" maxlength="15" />
                <span>-</span>
                <input type="number" placeholder="Giá cao nhất" class="rangePrice" id="rangePrice-to" maxlength="15" />
            </div>
            <button class="btn-filter-detail">Filter</button>
        </div>
    </div>
    <div class="t-wrap">
        <table class="content-table">
            <thead>
                <tr>
                    <th>Banner</th>
                    <th class="sort sortName col1">
                        <!-- <input type="radio" name="sort" value="" checked /> -->
                        Address
                        <!-- <i class="ion-funnel"></i> -->
                    </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($stores as $store) {
                    $store['banner'] = json_decode($store['banner']);
                    include Application::$__ROOT_DIR__ . '/app/views/components/admin.store.php';
                }
                ?>



            </tbody>
        </table>
    </div>
    <div class="actionProduct table-action">
        <div>
            <span class="btn-table-action add-product"><i class="ion-plus-round"></i></span>
        </div>
    </div>
</div>