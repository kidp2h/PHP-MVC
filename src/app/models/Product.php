<?php

namespace app\models;

use core\Model;

class Product extends Model
{
	const TABLE = "product";
	private self $product;
	public int $id;
	public string $name;
	public int $price;
	public  $description;
	public array $image;
	public $category_id;
	public string $created_at;
	public string $updated_at;
	public string $deleted_at;
	public function __construct()
	{
	}
	public static function __self__()
	{
		return new static();
	}
	public function fillInstance($id, $name, $price, $createdAt, $updatedAt, $deletedAt)
	{
		$this->product->ID = $id;
		$this->product->name = $name;
		$this->product->price = $price;
		$this->product->sale = $createdAt;
		$this->product->quantity = $updatedAt;
		$this->product->img = $deletedAt;
	}
	public function getId()
	{
		return $this->product->id;
	}
	public function setID($id)
	{
		$this->product->ID = $id;
	}
	public function getName()
	{
		return $this->product->name;
	}
	public function setName($name)
	{
		$this->product->name = $name;
	}
	public function getPrice()
	{
		return $this->product->price;
	}
	public function setPrice($price)
	{
		$this->product->price = $price;
	}
	public function getCreatedAt()
	{
		return $this->product->createdAt;
	}
	public function setCreatedAt($createdAt)
	{
		$this->product->createdAt = $createdAt;
	}
	public function getUpdateAt()
	{
		return $this->product->updatedAt;
	}
	public function setUpdateAt($updatedAt)
	{
		$this->product->updatedAt = $updatedAt;
	}
	public function getDeletedAt()
	{
		return $this->product->deletedAt;
	}
	public function setImg($deletedAt)
	{
		$this->product->deletedAt = $deletedAt;
	}
	public function getQuantity($store, $category, $priceFrom, $priceTo, $tilte)
	{
		if (strtoupper($category) == strtoupper("All")) {
			return mysqli_num_rows(self::$db->query("SELECT product.*, category.title 
		FROM product, category,product_details, store 
		where product.category_id = category.id
		AND product.id = product_details.product_id
		AND product_details.store_id = store.id
		AND store.id = $store AND product.deleted_at IS NULL
		AND Upper (product.name) LIKE Upper('%$tilte%') 
		AND product.price BETWEEN $priceFrom AND $priceTo"));
		} else {
			return mysqli_num_rows(self::$db->query("SELECT * 
		FROM product, category,product_details, store 
		where product.category_id = category.id 
		AND product.id = product_details.product_id
		AND product_details.store_id = store.id
		AND store.id = $store   
		AND Upper(category.title) = Upper('$category')
		AND Upper (product.name) LIKE Upper('%$tilte%') 
		AND product.price BETWEEN $priceFrom AND $priceTo"));
		}
	}
	
	public function getProductByIdAndStore($productId, $storeId)
	{
		$sql = self::$db->query("SELECT product.*, category.title, store.id AS storeId, 
		store.address,  ROUND(product.price*(1 - product_details.discount/100)) AS productPrice 
		FROM product, product_details, category, store 
		WHERE product.category_id = category.id AND product.id = product_details.product_id 
		AND product_details.store_id = store.id AND product.id = '$productId' 
		AND store.id = '$storeId'");
		while ($row = mysqli_fetch_array($sql, 1)) {
			$data = $row;
		}
		return $data;
	}

    public function randomProduct() { //random 8 products
        $data = [];
        $sql = self::$db->query("SELECT product.*, category.title, store.id AS storeId, 
		store.address,  ROUND(product.price*(1 - product_details.discount/100)) AS productPrice 
		FROM product, product_details, category, store 
		WHERE product.category_id = category.id AND product.id = product_details.product_id 
		AND product_details.store_id = store.id AND product.deleted_at IS NULL
		ORDER BY RAND() LIMIT 8");
        while($row=mysqli_fetch_all($sql,1)){
            $data=$row;
        }
        return $data;
    }

	public function updateQuantityAfterCheckout($productId, $storeId, $amount) {
		return self::$db->query("UPDATE product_details 
		SET quantity = product_details.quantity - '$amount' 
        WHERE product_id = '$productId' and store_id = '$storeId'");
	}
	
	// public function getListProducts($store){
	// $query="SELECT product.*, category.title  
	// 	FROM product, category,product_details, store 
	// 	where product.category_id = category.id
	// 	AND product.id = product_details.product_id
	// 	AND product_details.store_id = store.id
	// 	AND store.id = $store ";
	// 	$sql= self::$db->query($query);
	// 	$data = [];
	// 	$sql = self::$db->query($query);
	// 	while ($row = mysqli_fetch_all($sql, 1)) {
	// 		$data = $row;
	// 	}
	// 	return $data;
	// }

	public function getListProducts($limit, $page)
	{
		$index = ($page - 1) * $limit;
		$query = "SELECT product.*, category.title FROM product, category where product.category_id = category.id AND product.deleted_at IS NULL  ";
		$sql = self::$db->query($query);
		$data = [];
		$sql = self::$db->query("SELECT * FROM product WHERE product.deleted_at IS NULL ORDER BY RAND() LIMIT 7");
		while ($row = mysqli_fetch_all($sql, 1)) {
			$data = $row;
		}
		return $data;
	}

	public function pageNumber($store, $limit, $category, $priceFrom, $priceTo, $tilte)
	{
		$total = $this->getQuantity($store, $category, $priceFrom, $priceTo, $tilte);
		if ($total <= $limit) return 1;
		else return $total % $limit == 0 ? $total / $limit : $total / $limit + 1;
	}
	public function getDatafilterAdvancedAll($store, $sort, $priceFrom, $priceTo, $tilte, $limit, $page)
	{
		$index = ($page - 1) * $limit;
		if(strtoupper($sort)==strtoupper('All')){
			$query="SELECT product.*, category.title, Round(product.price*(1-product_details.discount/100)) AS sale
			FROM product, category,product_details, store 
			where product.category_id = category.id
			AND product.id = product_details.product_id
			AND product_details.store_id = store.id
			AND store.id = $store AND product.deleted_at IS NULL     
			AND Upper (product.name) LIKE Upper('%$tilte%') 
			AND  product.price*(1-product_details.discount/100) BETWEEN $priceFrom AND $priceTo
			LIMIT $index, $limit";
		}else if(strtoupper($sort)==strtoupper('AZ')){
			$query="SELECT product.*, category.title,  Round(product.price*(1-product_details.discount/100))AS sale 
			FROM product, category,product_details, store 
			where product.category_id = category.id
			AND product.id = product_details.product_id
			AND product_details.store_id = store.id
			AND store.id = $store AND product.deleted_at IS NULL     
			AND Upper (product.name) LIKE Upper('%$tilte%') 
			AND  product.price*(1-product_details.discount/100) BETWEEN $priceFrom AND $priceTo
			ORDER BY product.name
			LIMIT $index, $limit";
		}else if(strtoupper($sort)==strtoupper('ZA')){
			$query="SELECT product.*, category.title,  Round(product.price*(1-product_details.discount/100)) AS sale 
			FROM product, category,product_details, store 
			where product.category_id = category.id
			AND product.id = product_details.product_id
			AND product_details.store_id = store.id
			AND store.id = $store AND product.deleted_at IS NULL     
			AND Upper (product.name) LIKE Upper('%$tilte%') 
			AND  product.price*(1-product_details.discount/100) BETWEEN $priceFrom AND $priceTo
			ORDER BY product.name DESC
			LIMIT $index, $limit";
		}else if(strtoupper($sort)==strtoupper('lowtohigh')){
			$query="SELECT product.*, category.title,  Round(product.price*(1-product_details.discount/100)) AS sale 
			FROM product, category,product_details, store 
			where product.category_id = category.id
			AND product.id = product_details.product_id
			AND product_details.store_id = store.id
			AND store.id = $store AND product.deleted_at IS NULL     
			AND Upper (product.name) LIKE Upper('%$tilte%') 
			AND  product.price*(1-product_details.discount/100) BETWEEN $priceFrom AND $priceTo
			ORDER BY sale
			LIMIT $index, $limit";
		}else if(strtoupper($sort)==strtoupper('hightolow')){
			$query="SELECT product.*, category.title ,  Round(product.price*(1-product_details.discount/100)) AS sale
			FROM product, category,product_details, store 
			where product.category_id = category.id
			AND product.id = product_details.product_id
			AND product_details.store_id = store.id
			AND store.id = $store AND product.deleted_at IS NULL     
			AND Upper (product.name) LIKE Upper('%$tilte%') 
			AND  product.price*(1-product_details.discount/100) BETWEEN $priceFrom AND $priceTo
			ORDER BY sale DESC
			LIMIT $index, $limit";
		}
		return $query;
	}
	public function getDatafilterAdvancedNotAll($store, $sort, $category, $priceFrom, $priceTo, $tilte, $limit, $page)
	{
		$index = ($page - 1) * $limit;
		if(strtoupper($sort)==strtoupper('All')){
			$query="SELECT product.*, category.title,  Round(product.price*(1-product_details.discount/100)) AS sale  
			FROM product, category,product_details, store 
			where product.category_id = category.id
			AND product.id = product_details.product_id
			AND product_details.store_id = store.id
			AND store.id = $store AND product.deleted_at IS NULL
			AND Upper(category.title) = Upper('$category')     
			AND Upper (product.name) LIKE Upper('%$tilte%') 
			AND  product.price*(1-product_details.discount/100) BETWEEN $priceFrom AND $priceTo
			LIMIT $index, $limit";
		}else if(strtoupper($sort)==strtoupper('AZ')){
			$query="SELECT product.*, category.title,  Round(product.price*(1-product_details.discount/100)) AS sale 
			FROM product, category,product_details, store 
			where product.category_id = category.id
			AND product.id = product_details.product_id
			AND product_details.store_id = store.id
			AND store.id = $store AND product.deleted_at IS NULL
			AND Upper(category.title) = Upper('$category')     
			AND Upper (product.name) LIKE Upper('%$tilte%') 
			AND product.price*(1-product_details.discount/100) BETWEEN $priceFrom AND $priceTo
			ORDER BY product.name
			LIMIT $index, $limit";
		}else if(strtoupper($sort)==strtoupper('ZA')){
			$query="SELECT product.*, category.title,  Round(product.price*(1-product_details.discount/100)) AS sale 
			FROM product, category,product_details, store 
			where product.category_id = category.id
			AND product.id = product_details.product_id
			AND product_details.store_id = store.id
			AND store.id = $store AND product.deleted_at IS NULL
			AND Upper(category.title) = Upper('$category')     
			AND Upper (product.name) LIKE Upper('%$tilte%') 
			AND  product.price*(1-product_details.discount/100) BETWEEN $priceFrom AND $priceTo
			ORDER BY product.name DESC
			LIMIT $index, $limit";
		}else if(strtoupper($sort)==strtoupper('lowtohigh')){
			$query="SELECT product.*, category.title,  Round(product.price*(1-product_details.discount/100)) AS sale 
			FROM product, category,product_details, store 
			where product.category_id = category.id
			AND product.id = product_details.product_id
			AND product_details.store_id = store.id
			AND store.id = $store AND product.deleted_at IS NULL
			AND Upper(category.title) = Upper('$category')     
			AND Upper (product.name) LIKE Upper('%$tilte%') 
			AND  product.price*(1-product_details.discount/100) BETWEEN $priceFrom AND $priceTo
			ORDER BY sale
			LIMIT $index, $limit";
		}else if(strtoupper($sort)==strtoupper('hightolow')){
			$query="SELECT product.*, category.title,  Round(product.price*(1-product_details.discount/100)) AS sale 
			FROM product, category,product_details, store 
			where product.category_id = category.id
			AND product.id = product_details.product_id
			AND product_details.store_id = store.id
			AND store.id = $store AND product.deleted_at IS NULL
			AND Upper(category.title) = Upper('$category')     
			AND Upper (product.name) LIKE Upper('%$tilte%') 
			AND  product.price*(1-product_details.discount/100) BETWEEN $priceFrom AND $priceTo
			ORDER BY sale DESC
			LIMIT $index, $limit";
		}
		return $query;
	}
	public function filterAdvanced($store, $sort, $category, $priceFrom, $priceTo, $tilte, $limit, $page)
	{
		if (strtoupper($category) == strtoupper("All")) {
			$SQL = $this->getDatafilterAdvancedAll($store, $sort, $priceFrom, $priceTo, $tilte, $limit, $page);
		} else {
			$SQL = $this->getDatafilterAdvancedNotAll($store, $sort, $category, $priceFrom, $priceTo, $tilte, $limit, $page);
		}

		$sql = self::$db->query($SQL);
		$data = [];
		while ($row = mysqli_fetch_all($sql, 1)) $data = $row;
		return $data;
	}

	public function getListProductNotHaveStoreId($storeId)
	{
		$data = [];

		$sql = "select p.*, c.title from product as p, category as c 
		where p.category_id = c.id and p.id not in (
		select pd.product_id from product_details as pd
		where pd.store_id = $storeId and p.deleted_at is null)";

		$result = self::$db->query($sql);
		while ($row = mysqli_fetch_all($result, 1)) $data = $row;

		return $data;
	}


	public function getListProductAllByStoreId($storeId = NULL)
	{
		$data = [];
		if (!$storeId)
			$sql = "select * from product";
		else
			$sql = "select p.*, pd.discount, pd.quantity from product as p, product_details as pd, store as s
				where p.id = pd.product_id and pd.store_id = s.id and s.id = $storeId";

		$result = self::$db->query($sql);
		while ($row = mysqli_fetch_all($result, 1)) $data = $row;

		return $data;
	}

	public function getEntireProduct()
	{
		$data = [];
		$sql = "select product.*, category.title as 'category_id' from product inner join category where category.id = product.category_id;";

		$result = self::$db->query($sql);
		while ($row = mysqli_fetch_assoc($result)) {
			array_push($data, $this->resolve($row));
		}
		return $data;
	}

	public function getListProductSaleOn50($store_id, $page, $limit)
	{
		$data = [];
		$index = ($page - 1) * $limit;
		$sql = self::$db->query("select p.*, pd.discount, ROUND(p.price*(1-pd.discount/100), 0)  as sale from store as s, product_details as pd, product as p
		where s.id = $store_id and pd.store_id = s.id and 
		pd.discount > 49 and pd.product_id = p.id and p.deleted_at is null");
		while ($row = mysqli_fetch_all($sql, 1)) $data = $row;

		$totalPage = ceil(count($data) / $limit);
		$data = array_slice($data, $index, $page * $limit);



		return array(
			"data" => $data,
			"totalPage" => $totalPage
		);
	}
	public function updateProductStore($discount, $quantity, $productId, $storeId){
		$sql = "UPDATE product_details SET discount=$discount, quantity=$quantity WHERE product_id=$productId AND store_id=$storeId";
		$result = self::$db->query($sql);
		return $result;
	}
	public function removeProductStore($storeId, $productId){
		$sql = "DELETE FROM product_details WHERE product_id=$productId AND store_id=$storeId";
		$result = self::$db->query($sql);
		return $result;
	}
	public static function resolve(array $data) {
    $product = self::__self__();
    if(count($data) !=0 ){
      array_key_exists("id",$data) == true ? $product->id = $data["id"] : null;
      array_key_exists("name",$data) == true ? $product->name = $data["name"] : null;
      array_key_exists("price",$data) == true ? $product->price = $data["price"] : null;
      array_key_exists("description",$data) == true ? $product->description = $data["description"] : null;
      array_key_exists("image",$data) == true ? $product->image = json_decode($data["image"]) : null;
      array_key_exists("category_id",$data) == true ? $product->category_id = $data["category_id"] : null;
      return $product;
    }else {
      return null;
    }
	}

	public static function AddProductDetails($store, $product, $discount, $quantity) {
		$sql = "insert into product_details values ($store, $product,  $quantity, $discount)";
		self::$db->query($sql);
	}
}
