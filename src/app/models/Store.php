<?php

namespace app\models;

use core\Model;

class Store extends Model
{
    public function __construct()
    {
    }

    public static function __self__()
    {
        return new static();
    }

    public function getStoreList()
    {
        $data = [];
        $sql = self::$db->query("SELECT * FROM store");
        while ($row = mysqli_fetch_all($sql, 1)) {
            $data = $row;
        }
        return $data;
    }

    public function getBannerStore($storeId)
    {
        $sql = self::$db->query("select banner from store where id = $storeId ");
        $data = mysqli_fetch_array($sql, 1);
        return json_decode($data['banner']);
    }
}