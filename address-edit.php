<?php
include "./inc/cu.common.php";
if(!$cust_logged || !is_numeric($sess_cust_id)) {
    ForceOutCu(3);
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Petstore My Account">
    <meta name="keywords" content="Petstore My Account">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Petstore | My Account</title>

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
                        <h2>My Account</h2>
                        <div class="breadcrumb__option">
                            <a href="index.php">Home</a>
                            <span>Account</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

     <!-- Product Section Begin -->
    <section class="product spad address contact-form ">
        <div class="container">
            <div class="row">
                <?php include "_account_menu.php"; ?>
                <div class="col-lg-9 col-md-7">
                    <form action="#">
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <input type="text" placeholder="Title">
                            </div>
                            <div class="col-lg-12 text-center">
                                <textarea placeholder="Address"></textarea>
                                <button type="submit" class="site-btn float-left">SAVE</button>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->


    <?php include "_footer.php"; ?>
</body>

</html>