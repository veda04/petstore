<!-- Connect File -->
<?php 
include 'inc/config.inc.php';
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pet Store</title>

    <?php include'_header_links.php';?>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
      <?php include'_header.php';?>
   
    

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All Categories</span>
                        </div>
                        <ul>
                            <li><a href="./shop.php">Accessories</a></li>
                            <li><a href="./shop.php">Food</a></li>
                            <li><a href="./shop.php">Toys</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <input type="text" placeholder="What do yo u need?" name="search_data">
                                <button type="submit" name="search_data_product" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="img/banner.jpg"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/accessories/A-1.jpg">
                            <h5><a href="#">Accessories</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/food/F-11.jpg">
                            <h5><a href="#">Food</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/toys/T-5.jpg">
                            <h5><a href="#">Toys</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->
     <?php include'_footer_links.php';?>
      <?php include'_footer.php';?>


</body>

</html>
<?php    
$select_categories = "select * from 'categories'";
$result_categories = mysqli_query($con,$select_categories);
$row_data=mysqli_fetch_assoc($result_categories);
echo $row_data['categories_title'];
while($row_data=mysqli_fetch_assoc($result_categories)){
    $categories_title= $row_data['categories_title'];
    echo "";
}
?>