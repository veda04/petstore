<?php
include "./inc/cu.common.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Petstore Checkout">
    <meta name="keywords" content="Petstore Checkout">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Petstore | Checkout</title>

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
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="placeorder.php">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                           <?php
                            ?>
                                <div class="checkout-cust">
                                    <table class="cust-table">
                                        <tr>
                                            <td><b>Customer Name: </b>Veda</td>
                                            <td><b>Email: </b>Veda</td>
                                        </tr>
                                    </table>
                                    <div class="">
                                        <br>
                                        <h5><b>Choose Address</b></h5>
                                            <div class="add-radio">
                                                <input type="radio" id="address1" name="address1" value="home">
                                                <label for="address1"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua.</label>
                                            </div>
                                            <div class="add-radio">
                                                <input type="radio" id="address2" name="address2" value="office">
                                                <label for="address2"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua.</label>
                                            </div>
                                    </div>
                                </div>
                            <?php
                           ?>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                <?php
                                $q = "SELECT p.id, p.productName, p.productPrice, p.productImg, c.fkCustomerId, c.qty FROM customer_cart c left join product p on c.fkProductId = p.id";
                                $r = sql_query($q);
                                $cart_items = sql_get_data($r);
                                $TOT_AMT = 0;
                                if(!empty($cart_items) && count($cart_items)) {
                                    foreach($cart_items as $obj_w) {
                                        $p_img = (!empty($obj_w->productImg) && file_exists(PROD_IMG_UPLOAD.$obj_w->productImg) ) ? PROD_IMG_PATH.$obj_w->productImg : "img/cart/cart-1.jpg";
                                        $p_url = "product-detail.php?id=".$obj_w->id;

                                        $tot_amt = $obj_w->qty * $obj_w->productPrice;
                                        $TOT_AMT += $tot_amt;
                                        ?>
                                        <li><?php echo $obj_w->productName; ?> <span><?php echo Rs.$tot_amt; ?></span></li>
                                        <?php
                                    }
                                }
                                ?>
                                </ul>
                                <hr />
                                <div class="checkout__order__total">Total <span><?php echo Rs.$TOT_AMT; ?></span></div>
                                <p>This is a Cash on Delivery(COD) Order. <br/> Estimated date of arrival
                                    <b><?php echo date("d-m-Y",strtotime("+4days"))." - ".date("d-m-Y",strtotime("+7days")); ?></b>.
                                </p>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

 

</body>

</html>