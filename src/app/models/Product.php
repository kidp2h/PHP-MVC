<?php   
    namespace app\models;
    use core\Model;
    use utils\Utils;
    class Product extends Model{
        const TABLE = "Products";
        private self $Product;
        public int $ID;
        public string $name;
        public int $price;
        public int $sale;
        public int $quantity;
        public string $img;
        public function __construct()
        {
            
        }
        public static function __seft__(){
            return new static();
        }
        public function fillInstance($ID, $name, $price, $sale, $quantity, $img){
            $this->Product->ID = $ID;
            $this->Product->name = $name;
            $this->Product->price= $price;
            $this->Product->sale= $sale;
            $this->Product->quantity= $quantity;
            $this->Product->img= $img;
        }
        public function getID(){
            return $this->Product->ID;
        }
        public function setID($ID){
            $this->Product->ID=$ID;
        }
        public function getName(){
            return $this->Product->name;
        }
        public function setName($name){
            $this->Product->name=$name;
        }
        public function getPrice(){
            return $this->Product->price;
        }
        public function setPrice($price){
            $this->Product->price=$price;
        }
        public function getSale(){
            return $this->Product->sale;
        }
        public function setSale($sale){
            $this->Product->sale=$sale;
        }
        public function getQuantity(){
            return $this->Product->quantity;
        }
        public function setQuantity($quantity){
            $this->Product->quantity=$quantity;
        }
        public function getImg(){
            return $this->Product->img;
        }
        public function setImg($img){
            $this->Product->img=$img;   
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
