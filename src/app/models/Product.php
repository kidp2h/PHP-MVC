<?php   
namespace app\models;
use core\Model;
use utils\Utils;
class Product extends Model{
    const TABLE = "Products";
    private self $Product;
    public int $id;
    public string $title;
    public int $price;
    public string  $Created_At;
    public string $Update_At;
    public string $Deleted_At;
    public function __construct()
    {
        
    }
    public static function __seft__(){
        return new static();
    }
    public function fillInstance($id, $title, $price, $Created_At, $Update_At, $Deleted_At){
        $this->Product->ID = $id;
        $this->Product->name = $title;
        $this->Product->price= $price;
        $this->Product->sale= $Created_At;
        $this->Product->quantity= $Update_At;
        $this->Product->img= $Deleted_At;
    }
    public function getId(){
        return $this->Product->id;
    }
    public function setID($id){
        $this->Product->ID=$id;
    }
    public function getName(){
        return $this->Product->title;
    }
    public function setName($title){
        $this->Product->name=$title;
    }
    public function getPrice(){
        return $this->Product->price;
    }
    public function setPrice($price){
        $this->Product->price=$price;
    }
    public function getCreated_At(){
        return $this->Product->Created_At;
    }
    public function setCreated_At($Created_At){
        $this->Product->Created_At=$Created_At;
    }
    public function getUpdate_At(){
        return $this->Product->Update_At;
    }
    public function setUpdate_At($Update_At){
        $this->Product->Update_At=$Update_At;
    }
    public function getDeleted_At(){
        return $this->Product->Deleted_At;
    }
    public function setImg($Deleted_At){
        $this->Product->Deleted_At=$Deleted_At;   
    }
    public function getQuantityProducts(){
        return self::$db->query("SELECT COUNT(*) FROM {self::TABLE}");
    }
    public function getProducstlist($LIMIT, $PAGE){
        $sql= self::$db->query("SELECT * FROM {self::TABALE} ORDER BY 'ID' ASC LIMIT .$LIMIT. OFFSET .$LIMIT*($PAGE-1)");
        return mysqli_fetch_array($sql);
    }
    
    public function PageNumber($limit){
        $total= $this->getQuantityProducts();
        if($total<=$limit){
            return 1;
        }else{
            return $total%$limit==0 ? $total/$limit : $total/$limit+1;
        }

    }
}
