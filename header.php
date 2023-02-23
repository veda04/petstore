<div class="container-fluied">
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
            if (!isset($_SESSION['user_username'])) {
           echo "<li class='nav-item'>
           <a class='nav-link' href='login.php'>Login</a><li>"; 
        }else
        echo "<li class='nav-item'>
           <a class='nav-link' href='logout.php'>Logout</a><li>"; 
       ?>

        <?php
            if (!isset($_SESSION['user_username'])) {
           echo "<li class='nav-item'>
          <a class='nav-link'>Welcome Guest</a>
        </li>"; 
        }else
        echo "<li class='nav-item'>
          <a class='nav-link'>Welcome ".$_SESSION['user_username']."</a>
        </li>"; 
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