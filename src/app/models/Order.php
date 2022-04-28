<?php
namespace app\models;
use core\Model;

class Order extends Model {
    const TABLE = 'cart';
    private self $Order;
    public int $id;
    public int $user_id;
    public int $store_id;
    public int $status;
    public int $total;
    public string $created_at;
    public string $updated_at;

    public function __construct() {

    }

    public static function __self__() {
        return new static();
    }

    public function fillInstance($id, $user_id, $store_id, $status, $total, $created_at, $updated_at) {
        $this->Order->id = $id;
        $this->Order->user_id = $user_id;
        $this->Order->store_id = $store_id;
        $this->Order->status = $status;
        $this->Order->total = $total;
        $this->Order->created_at = $created_at;
        $this->Order->updated_at = $updated_at;
    }

    public function setUserId($user_id){
        $this->Order->user_id = $user_id;
    }

    public function getUserId(){
        return $this->Order->user_id;
    }
}