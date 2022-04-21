<?php
namespace app\models;
use core\Model;
 
class Store extends Model {
    const TABLE = 'store';

    public function __construct() {

    }

    public static function __self__() {
        return new static();
    }

    public function getStoreList() {
        $data = [];
        $sql = self::$db->query("SELECT * FROM store");
        while($row = mysqli_fetch_all($sql,1)){
            $data = $row;
        }
        return $data;
    }


}