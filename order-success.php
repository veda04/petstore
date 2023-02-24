<?php
include "./inc/cu.common.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Petstore Contact">
    <meta name="keywords" content="Petstore Contact">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Petstore | Contact</title>

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
                            <span>Order Success</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->


    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h4>Order has been successfully placed !!</h4>
                    </div>
                </div>
            </div>
            <div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <button class="site-btn">CONTINUE SHOPPING</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Form End -->

    <?php include "_footer.php"; ?>
</body>
</html>