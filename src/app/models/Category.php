<?php
namespace app\models;
use core\Model;
 
class Category extends Model {
    const TABLE = 'category';
    private self $Category;
    public int $id;
    public string $title;
    public string $created_at;
    public string $updated_at;

    public function __construct() {

    }

    public static function __self__() {
        return new static();
    }

    public function fillInstance($id, $title, $created_at, $updated_at) {
        $this->Category->id = $id;
        $this->Category->title = $title;
        $this->Category->created_at = $created_at;
        $this->Category->updated_at = $updated_at;
    }
    
    public function setId($id){
        $this->Category->id = $id;
    }

    public function getId(){
        return $this->Category->id;
    }

    public function setTitle($title){
        $this->Category->title = $title;
    }

    public function getTitle(){
        return $this->Category->title;
    }

    public function setCreatedAt($created_at){
        $this->Category->created_at = $created_at;
    }

    public function getCreatedAt(){
        return $this->Category->created_at;
    }

    public function setUpdatedAt($updated_at){
        $this->Category->updated_at = $updated_at;
    }

    public function getUpdatedAt(){
        return $this->Category->updated_at;
    }

    public function getCategoryList(){
        $data = [];
        $sql = self::$db->query("SELECT * FROM category");
        while($row = mysqli_fetch_all($sql,1)){
            $data = $row;
        }
        return $data;
    }

    public function getCategoryById($id) {
        $sql = self::$db->query("SELECT * FROM category WHERE category.id = '$id'");
        while($row = mysqli_fetch_array($sql,1)) {
            $data = $row;
        }
        return $data;
    }
}
?>
