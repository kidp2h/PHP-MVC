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
                        </ul>
                       
                    </div>
                </div>

                <div id="chuyentrang">
                        </div>      
            <div id="backtop" onclick="topFunction()">
                <i class="fas fa-arrow-up"></i>
            </div>
        </div>
    </div>
</body>
</html>