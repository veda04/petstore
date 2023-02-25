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
    <section class="product spad">
        <div class="container">
            <div class="row">
                <?php include "_account_menu.php"; ?>
                <div class="col-lg-9 col-md-7">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-6">
                            <div class="form-cover">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="shoping__cart__table order-listing">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Order Date</th>
                                                        <th>Order Type</th>
                                                        <th>Total Amount</th>
                                                        <th>Payment Method</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>22/01/22</td>
                                                        <td>Return Order</td>
                                                        <td>200000</td>
                                                        <td>COD</td>
                                                        <td>
                                                            <a href="order-view.php" class="site-btn">VIEW</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>22/01/22</td>
                                                        <td>Return Order</td>
                                                        <td>200000</td>
                                                        <td>COD</td>
                                                        <td>
                                                            <a href="order-view.php" class="site-btn">VIEW</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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