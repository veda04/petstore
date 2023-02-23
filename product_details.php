<?php 
 include './inc/cu.common.php';
 include 'common_function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Store</title>
     <?php include'header_link.php';?>
</head>
<body>
       <?php include'header.php';?>
<?php
cart();
?>
<!--<div class="row px-1">
    <div class="col-md-2 bg-secondary p-0">
        <ul class='navbar-nav me-auto text-center'>
                        <li class='nav-item bg-info'>
                            <a href='' class='nav-link text-light'>Categories</a>
                        </li>
                        <li class='nav-item'>
                         //   <?php
                        //    get_categories();
                        //    ?>
                        </li>
                       </ul>"
        
       

    </div>
    <div class="col-md-10">
         <!-- Product -->
       <!--  <div class="row">
            <!--fetching categories-->
            <?php
            //calling function
          //  view_details();
                ?>

      <!--    </div>
      </div>
    </div> -->
    <!--footer section -->



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
                            <li><?php
                            get_categories();
                            ?></li>
                            
                        </ul>
                    </div>

                </div>

                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
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
                        <div class="row">
                     <?php
                    //calling function
                       get_all_products();
                       get_unique_categories();
                       //get_unique_products();
                ?>
            </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
<?php include'footer.php';?>
 <?php include'footer_link.php';?>
</body>

</html>