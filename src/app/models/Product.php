<?php   
    namespace app\models;
    use core\Model;
use mysqli;
use utils\Utils;
class Product extends Model{
        const TABLE = "product";
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
        public function getAllProduct(){
            $data = [];
            $sql=self::$db->query("SELECT * FROM product");
            while($row=mysqli_fetch_all($sql,1)){
                $data=$row;
            }
            return $data;
        }
        public function getQuantityProducts(){
            return mysqli_num_rows(self::$db->query("SELECT  * FROM product"));
        }
        public function getProducstlist($LIMIT, $PAGE){
            $index =($PAGE-1)*$LIMIT;
            $query = 'SELECT * FROM product LIMIT '.$index.','.$LIMIT.'';
            $sql= self::$db->query($query);
            $data = [];
            while($row=mysqli_fetch_all($sql,1)){
                $data=$row;
            }
            return $data;
        }
        
        public function PageNumber($limit=6){
            $total= $this->getQuantityProducts();
            if($total<=$limit){
                return 1;
            }else{
                return $total%$limit==0 ? $total/$limit : $total/$limit+1;
            }
        } 
}