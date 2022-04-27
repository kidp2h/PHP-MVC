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
                            <option class="option" value="All">All</option>
                            <option class="option" value="AZ">Alphabetically, A-Z</option>
                            <option class="option" value="ZA">Alphabetically, Z-A</option>
                            <option class="option" value="lowtohigh">Price, low to high</option>
                            <option class="option" value="hightolow">Price, high to low</option>
                        </select>
                    </div>

                </div>
                <div id="product-gaoshop" >
                
                   <div id="filter" class="hide" style="z-index:1100">
                        <i class="fas fa-times" id="close"></i>
                        <form action="" method="GEST">
                        <ul class="loc1" >
                                <h3>Product Categories</h3>

                            <li id="loccategories">
                            <li class="theloai">
    <input type="radio"  name="categories" value="All" checked="true" ><p id="productall" >All</p></input>
    </li>
                            <?php 
									forEach($category as $cg){
                                        echo '<li class="theloai">
                                        <input type="radio" name="categories" value="'.$cg['title'].'" class="locsanpham '.$cg['title'].'" ><p>'.$cg["title"].'</p></input>
                                    </li>';
                                    }
								?>
                            </li>
                            </ul>
                        <ul class="loc1">
                            
                                <h3>By Price</h3>
                        
                            <li>
                                <div class="slidecontainer">
                                    <span>$ </span><input type="number"  min="0" max="10000" value="0" id="min-input" placeholder="minPrice" name="minPrice" >
                                    <span>- $<span>
                                    <input type="number" min="0" max="100000"  id ="max-input" value="9999" placeholder="maxPrice" name="maxPrice" >

                                </div>
                            </li>
                           
                        </ul>
                        <ul class="loc1">
                                <h3>By Title</h3>
                        
                            <li>
                                <input type="text"  id="search" placeholder="Search for product title" name="title" >
                            </li>
                        
                        </ul>
                        <ul class="loc1" style="display:none ;">
                        <h3>ByInput</h3>
                        <li>
                                
                                <?php echo '<input type="number" id="storename" name="store" value="'.$storeCurrent.'" >'?>
                            </li>
                            <li>
                                <input  type="text" id="sort" name="sort" value="All" >
                            </li>
                        </ul>
                        <button class="filter-submit" id="filtertitle" type="submit">Filter</button>
                        </form>
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
                        
                       <?php
                        if($data ==NULL){
                            echo '<div id="empty">
                            <i class="far fa-sad-tear"></i>
                            <p>Empty Product</p>
                            <div id="return">Return Shop</div>
                        </div>';

                        }else{
                            
                             echo'<ul id="products">';
                            
                            forEach($data as $product){
                                echo '
                                <li>
                                <div class="product-items"></div>
                                <div class="product-top">
                                    <div class="product-thumb">
                                        <a href="http://localhost/detail/product/'.$product["id"].'">
                                            <img src="'.json_decode($product['image'])[0].'" alt="ảnh 1" width="200px" height="200px">
                                        </a>
                                    </div>
                                   
                                    <!-- //Mua ngay -->
                                    <div class="buy-now">
                                    <div class="product-quantity">
                                        <button class="btn btn-tru"> - </button>
                                        <input type="number" min="1" max="99" value="1" class="inputQuantity" data-id ="'.$product["id"].'"  >
                                        <button class="btn btn-add"> + </button>
                                    </div>
                                        <div class="addtocart addToCart" data-id ="'.$product["id"].'" >
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
                                    <div href="" class="product-cat">'.$product["title"].'</div>
                                    <div href="" class="product-name">'.$product["name"].'</div>
                                    <div class="price">
                                    <div class="product-price">1000</div>
                                    <div class="sale-price">'.$product["price"].'</div>
                                    </div>
                                </div>
                            </li>'; 
                                
                            }
                         echo'</ul>';
                        }
                            
                            
                                 
                               
                        ?>
                        
                        
                       
                    </div>
                </div>

                <div id="chuyentrang">
                <?php 
                    if($pageNumber==1){
                        echo "";
                    }else{
                        if(isset($_GET['categories']) || isset($_GET['minPrice']) || isset($_GET['maxPrice']) || isset($_GET['title']) || isset($_GET['storename']) || isset($_GET['sort'])){
                        for ($i=1;$i<=$pageNumber;$i++){
                            echo '<a class="pagination"href="?page='.$i.'&store='.$_GET['store'].'&sort='.$_GET['sort'].'&categories='.$_GET['categories'].'&minPrice='.$_GET['minPrice'].'&maxPrice='.$_GET['maxPrice'].'&title='.$_GET['title'].'">'.$i.'</a>' ;
                            }}else{
                                for ($i=1;$i<=$pageNumber;$i++){
                                    echo '<a class="pagination"href="?page='.$i.'&store='.$_GET['store'].'">'.$i.'</a>' ;
                                    }
                            }  
                    }     
                ?>               
                </div>

            <div id="backtop" onclick="topFunction()">
                <i class="fas fa-arrow-up"></i>
            </div>
        </div>
    </div>