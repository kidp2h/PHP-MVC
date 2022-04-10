<?php
namespace app\controllers;

use core\Controller;
use core\Request;

class DetailController extends Controller {
    private static self $instance;

    public function __construct() {
        //parent::setLayout('detail');
    }

    public static function Instance(){
        if(!isset(self::$instance)){
          self::$instance = new DetailController();
        }
        return self::$instance;
    }

    public static function detail() {
        return parent::render('detail');
    }
}
?>

