const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);
    function setProductFilterWhite(ProductFilter){
        localStorage.setItem("ProductFilterWhite",JSON.stringify(ProductFilter));
        
    }
    setProductFilterWhite([]);
    function getProductFilterWhite(){
        let ProductFilter = JSON.parse(localStorage.getItem("ProductFilterWhite"));
        if (ProductFilter.length!=0){
            // console.log(ProductFilter);
            // console.log("dô");
            return ProductFilter;
        }else{
            return ProductModel.getAll();
        }     
    }

function productItems(item){
    return `
    <li>
        <div class="product-items"></div>
        <div class="product-top">
            <a href="#product-${item.id}" class="product-thumb">
                <img src="${item.imgList[0]}" alt="ảnh 1" width="200px" height="200px">
            </a>
           
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
            <div class="icon-heart ${item.wish == 1 && 'active'}" data-index="${item.id}" data-wish="${item.wish}">
                    <i class="far fa-heart"></i>
                    <i class="fas fa-heart"></i>
            </div>
        </div>
        <div class="product-info ">
            <div href="" class="product-cat">${item.category}</div>
            <div href="" class="product-name">${item.name}</div>
            <div class="price">
            <div class="product-price">${formatMoney(Number.parseInt(item.price), "$")}</div>
            <div class="sale-price">${formatMoney(Number.parseInt(item.sale), "$")}</div>
            </div>
        </div>
    </li>             
    `
}
//Lấy dữ liệu cho trang đầu tiên trong local và in ra màn hình
function renderData (x=1) {
    var htmls = ProductModel.getDocumentsByPage(x).map((item) => {
        return productItems(item);
    })
    if(!$('#products'))
    $(".center-product").innerHTML = ` <ul id="products"> </ul>`;
    document.getElementById('products').innerHTML = htmls.join('');
    AddEvent();
    AddHeart();
    AddToCart();
}
// lấy dữ liệu ra trong mảng dữ liệu và in ra màn hình
function renData (data,x) {
    console.log(data);
    var htmls = getpage(data,x).map((item) => {
        return productItems(item);
    })
    
    document.getElementById('products').innerHTML = htmls.join('');
    AddEvent();
    AddHeart();
    AddToCart();
}
// Hàm lọc sản phẩm 
function filtersort() {
    var sanpham;  // khởi tạo biến sản phẩm
    var sortfilter = document.getElementById('slt'); // lấy id của chọc lọc
    var valuefilter = sortfilter.value; // lấy giá trị
    sanpham=getProductFilterWhite();
    var productSort = sanpham.sort(function(a, b) {
        //Sếp xắp theo bảng chữ cái A_Z
        if (valuefilter === "A-Z") {
            return a.name.localeCompare(b.name);
        //Sếp xắp theo bảng chữ cái Z_A
        } else if (valuefilter === "Z-A") {
            return b.name.localeCompare(a.name);
        //Sếp xắp theo giá từ thấp đến cao
        } else if (valuefilter === "lowtohigh") {
            return a.sale - b.sale;
        //Sếp xắp theo giá từ cao đến thấp
        } else if (valuefilter === "hightolow") {
            return b.sale - a.sale;
        }  
    })
    if (valuefilter =="All"){
        getpage(productSort,1).map(item =>{     //sử dụng hàm getpade để in ra sản phẩm trang đầu tiên
        return productItems(item);
        })
    }
    if(valuefilter=="Featured"){   // Sản phẩm nổi bât
       productSort = sanpham.filter(item=>{ // Filter trong mảng sản phẩm
            return item.rate == 5; // Sản phẩm nổi bật có rate bằng 5      
        });
        if(productSort.length==0){
            $(".center-product").innerHTML = productFeatured();
            $('#return').onclick = function(){
                $("#slt").value = "All";
                $('#min-input').value=0;
                $('#max-input').value=999999;
                $('#search').value="";
                $$(".theloai input").forEach(item=> {
                    if(item.value=="All"){
                        item.checked=true;
                    }})
                renderData (x=1);
                taotrang();
                AddEvent();
                AddHeart();
                filter_hide();
                page_block();
                AddToCart();
                }
                return;

        }
    }
    //console.log(productSort);
    let htmls = getpage(productSort,1).map(item =>{     //sử dụng hàm getpade để in ra sản phẩm trang đầu tiên
        return productItems(item);
    })
    if(document.getElementById("products")){
        document.getElementById("products").innerHTML = htmls.join(""); //in ra màn hình
        //console.log(productSort.length); // lấy độ dài của mảng productsSort
        taotrang1(productSort,Number.parseInt(getnumberpage(productSort)));// hàm in theo trang
        AddEvent();
        page_block();
        AddHeart();
        filter_hide(); 
        AddToCart();
    }
   
}
// lÀM CATEGORIES
// INR RA DANH SÁCH THỂ LOẠI CỦA SẢN PHẨM
function rendertheloai(){
    // var htmls = CategoryModel.getAll().map(items =>{
    //     var cout =0;
    //     let listProducts = ProductModel.getAll();
    //     listProducts.forEach(value =>{
    //         if(items.name.toUpperCase() == value.category.toUpperCase()){
    //             cout++;
    //         }
    //     });
    //     return `
    //     <li class="theloai">
    //         <input type="radio" name="categories" value="${items.name}" class="locsanpham ${items.name}" ><p>${items.name}(${cout})</p></input>
    //     </li>
    //    `
    // })
    
    // document.getElementById('loccategories').innerHTML =`<li class="theloai">
    // <input type="radio"  name="categories" value="All" checked="true" ><p id="productall"   >All(${ProductModel.getAll().length})</p></input>
    // </li>`+htmls.join("");
    $$(".theloai").forEach(item=>{
        item.onclick=function(){
            item.querySelector("input").checked=true;
        }       
    });
}
    
function renderproducts() {
   
            // hàm lọc theo title (Nhập cái cần tìm)
            document.getElementById('filtertitle').onclick = function() {
            let MinPrice = Number.parseInt(document.getElementById("min-input").value)|| 0;
            let MaxPrice = Number.parseInt(document.getElementById("max-input").value)|| 999999;
            let categorys = $$(".theloai input ");
            let categoryname;
           
            categorys.forEach(item=>{
                if(item.checked == true){
                 categoryname =item.value;
                    
                }
            })
           
            console.log(categoryname);// lấy giá trị của price range
          // Sự kiện onclick ở button fillter title
          $("#slt").value = "All";
            let productArray= [];
            let title = document.getElementById('search').value||""; 
            console.log(MinPrice, MaxPrice,title, categoryname);// lấy giá trị trong div.search
            let filterproduct =Searchshop(MinPrice,MaxPrice,title,categoryname);
            console.log(Searchshop(MinPrice,MaxPrice,title,categoryname));
            if(filterproduct.length ==0){
            console.log("dô");
            $(".center-product").innerHTML = productEmty();
            filter_hide();
            page_hide()
            $('#return').onclick = function(){
            $("#slt").value = "All";
            $('#min-input').value=0;
            $('#max-input').value=999999;
            $('#search').value="";
            $$(".theloai input").forEach(item=> {
                if(item.value=="All"){
                    item.checked=true;
                }})
            renderData (x=1);
            taotrang();
            AddEvent();
            AddHeart();
            filter_hide();
            page_block();
            AddToCart();
            }
            return;
        }

        $(".center-product").innerHTML = ` <ul id="products"> </ul>`;
        filterproduct.map(product=>{
            productArray.push(product);
        })
        setProductFilterWhite(productArray);
        let htmltilte = getpage(filterproduct,1).map(item =>{    // sử dụng hàm getpage bên appli.js
            return productItems(item);
            
        })
        document.getElementById("products").innerHTML = htmltilte.join(""); // in dữ liệu ra màn hình
        taotrang1(filterproduct,Number.parseInt(getnumberpage(filterproduct)));

        console.log(filterproduct); // tạo ra 
        AddEvent(); // sự kiện công trừ cho sản phẩm
        AddHeart(); // sự kiện thêm yêu thích cho sản phẩm
        filter_hide();  // hàm ẩn filter
        page_block();
        AddToCart();

    
       
     

    }

// tạo số trang trong localStorange


}
function taotrang() {
    let pageNumber = ProductModel.getTotalPage();

    var s = `<p class="trangn active" >${1}</p>`;
    for (var i = 2; i <= pageNumber; i++) {
        s += `<p class="trangn" >${i}</p>`;
    }

    document.getElementById("chuyentrang").innerHTML = s;
    addpage();
}
// hàm in tất cả các sản phẩm theo trang 
function addpage() {
    $$('.trangn').forEach(element => {
        element.onclick = function() {
            $('.trangn.active').classList.remove('active')
            element.classList.add('active')
            var x = Number(element.textContent);
            renderData(x);
        }
    });
}
// hàm in ra số trang ở dưới div.trangn in các sản phẩm theo mảng lọc
function taotrang1(data,x) {
    let pageNumber = x;
    var s = `<p class="trangn active" >${1}</p>`;
    for (var i = 2; i <= pageNumber; i++) {
        s += `<p class="trangn" >${i}</p>`;
    }
   if(x>1)
   {document.getElementById("chuyentrang").innerHTML = s;}
   else{
    document.getElementById("chuyentrang").innerHTML = "";
   }
    
    addpage1(data); 
}
// hàm tạo trang từ mảng
function addpage1(data) {
    $$('.trangn').forEach(element => {
        element.onclick = function() {
            $('.trangn.active').classList.remove('active')
            element.classList.add('active')
            var x = Number(element.textContent);
           renData(data,x);
        }
    });
}
// load trang rồi sử dụng các hàm
// window.onload = () => {
//     rendertheloai();
//     renderData();
//     renderproducts();
//     taotrang();
//     InitEvent()
// }

function productEmty(){
    return ` <div id="empty">
    <i class="far fa-sad-tear"></i>
    <p>Empty Product</p>
    <div id="return">Return Shop</div>
</div>`
}
function productFeatured(){
    return ` <div id="empty">
    <i class="far fa-sad-tear"></i>
    <p>Not Featured Products</p>
    <div id="return">Return Shop</div>
</div>`
}


