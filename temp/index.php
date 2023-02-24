<?php
include "../inc/cu.common.php";
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Petstore Home">
    <meta name="keywords" content="Petstore Home">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Petstore | Home</title>

    <?php include "_header_links.php"; ?>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php include "_header.php"; ?>

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All categories</span>
                        </div>
                        <ul>
                            <?php
                            $limit = 10; $i = 1;
                            if(!empty($PROD_CATEGORY)) {
                                if($i <= $limit) {
                                    foreach($PROD_CATEGORY as $P_OBJ) {
                                        $c_url = "product.php?cid=".$P_OBJ->id;
                                        echo '<li><a href="'.$c_url.'">'.$P_OBJ->title.'</a></li>';
                                        $i ++;
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg">
                        <div class="hero__text">
                            <span>FRUIT FRESH</span>
                            <h2>Vegetable <br />100% Organic</h2>
                            <p>Free Pickup and Delivery Available</p>
                            <a href="#" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
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
                    <?php
                    if(!empty($PROD_CATEGORY)) {
                        foreach($PROD_CATEGORY as $P_OBJ) {
                            $c_url = "product.php?cid=".$P_OBJ->id;
                            $cat_img = !empty($P_OBJ->image) ? $P_OBJ->image : "img/categories/cat-1.jpg";
                            ?>
                            <div class="col-lg-3">
                                <div class="categories__item set-bg" data-setbg="<?php echo $cat_img; ?>">
                                    <h5><a href="<?php echo $c_url; ?>"><?php echo $P_OBJ->title; ?></a></h5>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <?php
                            if(!empty($PROD_CATEGORY)) {
                                foreach($PROD_CATEGORY as $P_OBJ) {
                                    $urlname = GetUrlName($P_OBJ->title);
                                    echo '<li data-filter=".'.$urlname.'">'.$P_OBJ->title.'</li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                <?php
                $PRODUCTS = getDataFromTable("product", "", " order by categoryId", "SELECT * FROM (SELECT *,ROW_NUMBER() OVER (PARTITION BY categoryId ORDER BY id) AS row_num FROM product) AS products_with_row_num WHERE row_num <= 10 ORDER BY categoryId, id");
                
                if(!empty($PRODUCTS)) {
                    foreach($PRODUCTS as $PROD_OBJ) {
                        $prd_id = $PROD_OBJ->id;
                        $prod_url = "product-detail.php?id=".$prd_id;
                        $cat_name = isset($PROD_CATEGORY_ARR[$PROD_OBJ->categoryId]) ? $PROD_CATEGORY_ARR[$PROD_OBJ->categoryId] : "";
                        $cat_urlname = GetUrlName($cat_name);
                ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mix <?php echo $cat_urlname; ?> fresh-meat">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg" data-setbg="img/featured/feature-1.jpg">
                                    <ul class="featured__item__pic__hover">
                                        <li><a onclick="addToWishlist('<?php echo $prd_id; ?>');" href="javascript:;"><i class="fa fa-heart"></i></a></li>
                                        <!-- <li><a href="#"><i class="fa fa-retweet"></i></a></li> -->
                                        <li><a onclick="addToCart('<?php echo $prd_id; ?>');" href="javascript:;"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6><a href="<?php echo $prod_url; ?>"><?php echo $PROD_OBJ->productName; ?></a></h6>
                                    <h5><?php echo ($PROD_OBJ->productPrice > 0) ? Rs."&nbsp;".$PROD_OBJ->productPrice : ""; ?></h5>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <?php include "_footer.php"; ?>
</body>

</html>