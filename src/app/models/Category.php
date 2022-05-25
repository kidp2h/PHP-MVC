<?php
namespace app\models;
use core\Model;
 
class Category extends Model {
    private self $Category;
    public int $id;
    public string $title;
    public string $image;
    public string $created_at;
    public string $updated_at;
    public string $deleted_at;

    public function __construct() {

    }

    public static function __self__() {
        return new static();
    }

    public function fillInstance($id, $title,$image, $created_at, $updated_at) {
        $this->Category->id = $id;
        $this->Category->title = $title;
        $this->Category->image = $image;
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
    public function getCategoryListandNum($storeId){
        $data = [];
        $sql = self::$db->query("SELECT store.id AS storeId, product.category_id, category.title AS title, COUNT(product.category_id) AS SUM
        FROM category, product, product_details, store
        WHERE product.category_id = category.id AND product.id = product_details.product_id AND product_details.store_id = store.id
        AND store.id = $storeId
        GROUP BY store.id, product.category_id, category.title");
        while($row = mysqli_fetch_all($sql,1)){
            $data = $row;
        }
        return $data;
    }
    public function getSumProductbyStoreId($storeId){
        return mysqli_num_rows(self::$db->query("SELECT product.id 
		FROM product, product_details, store
		WHERE product.id=product_details.product_id
		AND product_details.store_id=store.id
		AND store.id=$storeId"));
	}

    public function getCategoryById($id) {
        $sql = self::$db->query("SELECT * FROM category WHERE category.id = '$id'");
        while($row = mysqli_fetch_array($sql,1)) {
            $data = $row;
        }
        return $data;
    }

    public function getCategoryListByStore($storeId){
        $data = [];
        $sql = self::$db->query("select DISTINCT category.*  from store, product_details, product, category
        where store.id = $storeId and store.id = product_details.store_id and product_details.product_id = product.id and product.category_id = category.id and category.id != 0 ");
        while($row = mysqli_fetch_all($sql,1)){
            $data = $row;
        }
        return $data;
    }
    public function getCategoryList(){
        $data = [];
        $sql = self::$db->query("select * from category");
        while($row = mysqli_fetch_all($sql,1)){
            $data = $row;
        }
        return $data;
    }
    public static function resolve(array $data) {
        $category = self::__self__();
        if(count($data) !=0 ){
          array_key_exists("id",$data) == true ? $category->id = $data["id"] : null;
          array_key_exists("title",$data) == true ? $category->title = $data["title"] : null;
          array_key_exists("image",$data) == true ? $category->image = $data["image"] : null;
          return $category;
        }else {
          return null;
        }
    
      }

}
?>