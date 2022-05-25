<?php

use core\Application; ?>

<div class="tmanager tmanager-product">
    <div class="t-wrap">
        <table class="content-table">
            <thead>
                <tr>
                    <th>Banner</th>
                    <th>Address</th>
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