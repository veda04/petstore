<?php
include "./inc/cu.common.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Petstore Wishlist">
    <meta name="keywords" content="Petstore Wishlist">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Petstore | Wishlist</title>

    <?php include "_header_links.php"; ?>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <?php include "_header.php"; ?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Wishlist</h2>
                        <div class="breadcrumb__option">
                            <a href="index.php">Home</a>
                            <span>Wishlist</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <?php if($cust_logged) { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <tbody>
                                <?php
                                $q = "SELECT p.id, p.productName, p.productPrice, p.productImg FROM `customer_wishlist` cw left join product p on cw.fkProductId = p.id";
                                $r = sql_query($q);
                                $wishlist_items = sql_get_data($r);
                                $c = 1;
                                if(!empty($wishlist_items) && count($wishlist_items)) {
                                    foreach($wishlist_items as $obj_w) {
                                        $p_img = (!empty($obj_w->productImg) && file_exists(PROD_IMG_UPLOAD.$obj_w->productImg) ) ? PROD_IMG_PATH.$obj_w->productImg : "img/cart/cart-1.jpg";
                                        $p_url = "product-detail.php?id=".$obj_w->id;
                                        echo ($c % 4 == 0) ? "<tr>": "";
                                        ?>
                                        <td class="shoping__cart__item">
                                            <a href="<?php echo $p_url; ?>">
                                                <img src="<?php echo $p_img; ?>" alt="">
                                                <h5><?php echo $obj_w->productName; ?></h5>
                                            </a>
                                        </td>
                                        <?php
                                        echo ($c % 4 == 0) ? "</tr>": "";
                                        $c ++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn cart-btn-right">
                            Move Items to Cart</a>
                    </div>
                </div>
            </div>
            <?php } 
            else {
                echo '<p>You are not logged in. Please <a href="login.php">login</a> to view your wishlist.</p>';
            }
            ?>
        </div>
    </section>
    <!-- Shoping Cart Section End -->


    <?php include "_footer.php"; ?>
</body>
</html>