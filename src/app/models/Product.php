<?php   
namespace app\models;
use core\Model;
use utils\Utils;
class product extends Model{
    const TABLE = "product";
    private self $product;
    public int $id;
    public string $title;
    public int $price;
    public string $createdAt;
    public string $updatedAt;
    public string $deletedAt;
    public function __construct()
    {
        
    }
    public static function __self__(){
        return new static();
    }
    public function fillInstance($id, $title, $price, $createdAt, $updatedAt, $deletedAt){
        $this->product->ID = $id;
        $this->product->name = $title;
        $this->product->price= $price;
        $this->product->sale= $createdAt;
        $this->product->quantity= $updatedAt;
        $this->product->img= $deletedAt;
    }
    public function getId(){
        return $this->product->id;
    }
    public function setID($id){
        $this->product->ID=$id;
    }
    public function getName(){
        return $this->product->title;
    }
    public function setName($title){
        $this->product->name=$title;
    }
    public function getPrice(){
        return $this->product->price;
    }
    public function setPrice($price){
        $this->product->price=$price;
    }
    public function getCreatedAt(){
        return $this->product->createdAt;
    }
    public function setCreatedAt($createdAt){
        $this->product->createdAt=$createdAt;
    }
    public function getUpdateAt(){
        return $this->product->updatedAt;
    }
    public function setUpdateAt($updatedAt){
        $this->product->updatedAt=$updatedAt;
    }
    public function getDeletedAt(){
        return $this->product->deletedAt;
    }
    public function setImg($deletedAt){
        $this->product->deletedAt=$deletedAt;   
    }
    public function getQuantity(){
        return self::$db->query("SELECT COUNT(*) FROM {self::TABLE}");
    }
    
    public function getProducstlist($LIMIT, $PAGE){
        $sql= self::$db->query("SELECT * FROM {self::TABALE} ORDER BY 'ID' ASC LIMIT .$LIMIT. OFFSET .$LIMIT*($PAGE-1)");
        return mysqli_fetch_array($sql);
    }

    public function getProductById($id) {
        $sql = self::$db->query("SELECT * FROM product where product.id = '$id'");
        return mysqli_fetch_array($sql);
    }
    
    public function PageNumber($limit){
        $total= $this->getQuantity();
        if($total<=$limit){
            return 1;
        }else{
            return $total % $limit==0 ? $total/$limit : $total/$limit+1;
        }

    }
}
