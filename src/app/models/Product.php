<?php

namespace app\models;

use core\Model;
use mysqli;

class product extends Model {
	const TABLE = "product";
	private self $product;
	public int $id;
	public string $title;
	public int $price;
	public string $createdAt;
	public string $updatedAt;
	public string $deletedAt;
	public function __construct() {
	}
	public static function __self__() {
		return new static();
	}
	public function fillInstance($id, $title, $price, $createdAt, $updatedAt, $deletedAt) {
		$this->product->ID = $id;
		$this->product->name = $title;
		$this->product->price = $price;
		$this->product->sale = $createdAt;
		$this->product->quantity = $updatedAt;
		$this->product->img = $deletedAt;
	}
	public function getId() {
		return $this->product->id;
	}
	public function setID($id) {
		$this->product->ID = $id;
	}
	public function getName() {
		return $this->product->title;
	}
	public function setName($title) {
		$this->product->name = $title;
	}
	public function getPrice() {
		return $this->product->price;
	}
	public function setPrice($price) {
		$this->product->price = $price;
	}
	public function getCreatedAt() {
		return $this->product->createdAt;
	}
	public function setCreatedAt($createdAt) {
		$this->product->createdAt = $createdAt;
	}
	public function getUpdateAt() {
		return $this->product->updatedAt;
	}
	public function setUpdateAt($updatedAt) {
		$this->product->updatedAt = $updatedAt;
	}
	public function getDeletedAt() {
		return $this->product->deletedAt;
	}
	public function setImg($deletedAt) {
		$this->product->deletedAt = $deletedAt;
	}
	public function getQuantity() {
		return mysqli_num_rows(self::$db->query("SELECT * FROM product"));
	}
    
    public function getProductById($id) {
        $sql = self::$db->query("SELECT * FROM product where product.id = '$id'");
        while($row=mysqli_fetch_array($sql,1)){
            $data=$row;
        }
        return $data;
    }

    public function randomProduct() { //random 8 products
        $data = [];
        $sql = self::$db->query("SELECT * FROM product ORDER BY RAND() LIMIT 7");
        while($row=mysqli_fetch_all($sql,1)){
            $data=$row;
        }
        return $data;
    }
	public function getListProducts($limit, $page){
		$index = ($page - 1) * $limit;
		$query = "SELECT product.*, category.title FROM product, category where product.category_id = category.id LIMIT $index, $limit";
		$sql= self::$db->query($query);
		$data = [];
		while($row = mysqli_fetch_all($sql, 1)) $data=$row;
		return $data;
	}

	public function pageNumber($limit) {
		$total = $this->getQuantity();
		if ($total <= $limit) return 1;
		else return $total % $limit == 0 ? $total / $limit : $total / $limit + 1;
	}
}
