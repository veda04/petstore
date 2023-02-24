<?php
include "./inc/cu.common.php";
$cat_id = (isset($_GET['cid']) && is_numeric($_GET['cid']) ) ? $_GET['cid'] : "";
$prod_cond = "";
$cat_name = GetXFromYID("SELECT title from category WHERE id = '$cat_id' ");
if(!empty($cat_id) && !empty($cat_name)) {
    $prod_cond = " AND categoryId = $cat_id";
}

$PRODUCTS = getDataFromTable("product", "*", $prod_cond);
$prod_count = count($PRODUCTS);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Petstore Products">
    <meta name="keywords" content="Petstore Products">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Petstore | Products</title>

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
                        <h2>Petstore Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="index.php">Home</a>
                            <?php
                            echo !empty($cat_name) ? "<a href='product.php?cid=".$cat_id."'>".$cat_name."</a>" : "";
                            ?>
                            <span>Products</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

     <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <?php if(empty($cat_id)) { ?>
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>My Account</h4>
                            <ul>
                                <?php
                                ?>
                                <li>
                                    <a href="#">Address</a>
                                </li>
                                <li>
                                    <a href="#">Orders</a>
                                </li> 
                                <li>
                                    <a href="#">Logout</a>
                                </li>
                                <?php
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="<?php echo empty($cat_id) ? 'col-lg-9 col-md-7' : 'col-lg-12 col-md-12'; ?>" >
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-6">
                            <div class="form-cover">
                                Paste here :P
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->


    <?php include "_footer.php"; ?>
</body>

</html>