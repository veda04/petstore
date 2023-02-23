<!--<div class="container-fluied">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <img src="./img/logo.png" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./about.php">About</a>
        </li> 
        <li class="nav-item dropdown">
          <a class="nav-link" href="./product.php">Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./contact.php">Contact</a>
        </li>
        <li>
            <a class="nav-link" href="./cart.php"><i class="fa-solid fa-cart-shopping"></i><sup>
              <?php
                 // include './inc/cu.common.php';
                 // include 'common_function.php';
                //  cart_number(); 
                ?>
             </sup></a>
        </li> 
        <?php
        //    if (!isset($_SESSION['user_username'])) {
       //    echo "<li class='nav-item'>
      //     <a class='nav-link' href='login.php'>Login</a><li>"; 
      //  }else
      //  echo "<li class='nav-item'>
      //     <a class='nav-link' href='logout.php'>Logout</a><li>"; 
       ?>

        <?php
        //    if (!isset($_SESSION['user_username'])) {
         //  echo "<li class='nav-item'>
        //  <a class='nav-link'>Welcome Guest</a>
       // </li>"; 
       // }else
       // echo "<li class='nav-item'>
      //    <a class='nav-link'>Welcome ".$_SESSION['user_username']."</a>
      //  </li>"; 
       ?>
      </ul>

      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-primary" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<style type="">
  body{
    overflow-x: hidden;
  }
  </style>
-->
<header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> hello@petstore.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__auth">
                                 <?php
                                    if (!isset($_SESSION['user_username'])) {
                                   //echo "                 <a class='nav-link' href='login.php'>Login</a><li>"; 
                                echo "<a href='login.php'><i class='fa fa-user'></i> Login</a>";
                                 }else
                                 echo "<a href='logout.php'><i class='fa fa-user'></i> Logout</a>";
                                 ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a ><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li ><a href="index.php">Home</a></li>
                            <li><a href="about.php">About</a></li>
                            <li><a href="product.php">Products</a>
                                
                            </li>
                            <li><a href="./contact.php">Contact</a></li><sup></sup>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

   