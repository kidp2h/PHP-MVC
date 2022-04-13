<?php 
                use \app\controllers\ProductController;
?>                
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
      integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= "/public/styles/shop/base.css" ?>">
    <link rel="stylesheet" href="<?= "/public/styles/shop/apps.css" ?>">
    <link rel="stylesheet" href="<?= "/public/styles/shop/rp.css" ?>">
    <title>Document</title>
</head>
<body>
<div id="shop">
        <div id="wrapper">
            <div id="product-intro">
                <p>Products</p>
            </div>

            <div id="content">
                <div id="menu">
                    <div id="ter">
                        <i class="fas fa-sliders-h"></i>
                        <p>Filter</p>
                    </div>

                    <div id="chocloc">
                        <select name="Select" id="slt">
                            <option value="All">All</option>
                            <option value="Featured">Featured</option>
                            <option value="A-Z">Alphabetically, A-Z</option>
                            <option value="Z-A">Alphabetically, Z-A</option>
                            <option value="lowtohigh">Price, low to high</option>
                            <option value="hightolow">Price, high to low</option>
                        </select>
                    </div>

                </div>
                <div id="product-gaoshop" >
                    <div id="filter" class="hide" style="z-index:1100">
                        <i class="fas fa-times" id="close"></i>
                        <ul class="loc1" >
                                <h3>Product Categories</h3>

                            <li id="loccategories">
                             
                            </li>
                            </ul>
                        <ul class="loc1">
                            
                                <h3>By Price</h3>
                        
                            <li>
                                <div class="slidecontainer">
                                    <span>$ </span><input type="number"  min="0" max="10000" value="0" id="min-input" placeholder="Min-price" >
                                    <span>- $<span>
                                    <input type="number" min="0" max="10000"  id ="max-input" value="99999" placeholder="Max-price" >

                                </div>
                            </li>
                           
                        </ul>
                        <ul class="loc1">
                                <h3>By Title</h3>
                        
                            <li>
                                <input type="text" name="" id="search" placeholder="Search for product title">
                            </li>
                            <li>
                            </li>

                        </ul>
                        <button class="filter-submit" id="filtertitle">Filter</button>
                        <ul class="loc1">

                                    
                                <h3>Shipping & Delivery</h3>
                        
                            <li class="hotro">
                                <i class="fas fa-shipping-fast"></i>
                                <div>
                                    <span class="tachchu">FREE SHIPPING
                                        </span>
                                    <span>
                                            Free shipping for all US order
                                        </span>
                                </div>
                            </li>
                            <li class="hotro">
                                <i class="fas fa-headphones-alt"></i>
                                <div>
                                    <span class="tachchu">SUPPORT 24/7
                                    </span>
                                    <span>
                                            We support 24 hours a day
                                        </span>
                                </div>
                            </li>
                            <li class="hotro">
                                <i class="fas fa-exchange-alt"></i>
                                <div>
                                <span class="tachchu" >
                                    30 DAYS RETURN
                                </span>
                                
                                    <span>
                                You have 30 days to return
                            </span>
                                </div>
                            </li>

                        </ul>
                    </div>
                    <div class="center-product">
                        <ul id="products">
                       <?php
                            forEach($currentPage as $product){
                                echo '<li><a href="http://localhost/detail/product/'.$product["id"].'">
                                <div class="product-items"></div>
                                <div class="product-top">
                                    <div class="product-thumb">
                                        <img src="${item.imgList[0]}" alt="ảnh 1" width="200px" height="200px">
                                    </div>
                                   
                                    <!-- //Mua ngay -->
                                    <div class="buy-now">
                                    <div class="product-quantity">
                                        <button class="btn btn-tru"> - </button>
                                        <input type="number" min="1" max="99" value="1" class="inputQuantity" data-id ="${item.id}"  >
                                        <button class="btn btn-add"> + </button>
                                    </div>
                                        <div class="addtocart addToCart" data-id ="${item.id}" >
                                            <p>ADD TO CART</p>
                                            <i id="cart-icon" class="fas fa-shopping-cart"></i>
                        
                                        </div>
                                    </div>
                                    <div class="icon-heart">
                                            <i class="far fa-heart"></i>
                                            <i class="fas fa-heart"></i>
                                    </div>
                                </div>
                                <div class="product-info ">
                                    <div href="" class="product-cat">${item.category}</div>
                                    <div href="" class="product-name">'.$product["title"].'</div>
                                    <div class="price">
                                    <div class="product-price">1000</div>
                                    <div class="sale-price">'.$product["price"].'</div>
                                    </div>
                                </div></a>
                            </li>'; 
                                
                            }
                            
                                 
                               
                        ?>
                        
                        </ul>
                       
                    </div>
                </div>

                <div id="chuyentrang">
                <?php 
                    for ($i=1;$i<=$pageNumber;$i++){
                        echo '<a class="pagination"href="?page='.$i.'">'.$i.'</a>' ;
                        }       
                ?>               
                </div>

            <div id="backtop" onclick="topFunction()">
                <i class="fas fa-arrow-up"></i>
            </div>
        </div>
    </div>
</body>
</html>