<?php

namespace app\models;

use core\Model;

class Banner extends Model
{
    const TABLE = 'banner';

    public function __construct()
    {
    }

    public static function __self__()
    {
        return new static();
    }

    public function getBanner()
    {
        $sql = self::$db->query("select images from banner");
        $data = mysqli_fetch_array($sql, 1);

        return json_decode(utf8_encode($data['images']), true);
    }
}
