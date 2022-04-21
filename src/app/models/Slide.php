<?php
namespace app\models;
use core\Model;
 
class Slide extends Model {
    const TABLE = 'slide';

    public function __construct() {
        
    }

    public static function __self__() {
        return new static();
    }

    

}