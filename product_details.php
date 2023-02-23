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
<div class="row px-1">
    <div class="col-md-2 bg-secondary p-0">
        <ul class='navbar-nav me-auto text-center'>
                        <li class='nav-item bg-info'>
                            <a href='' class='nav-link text-light'>Categories</a>
                        </li>
                        <li class='nav-item'>
                            <?php
                            get_categories();
                            ?>
                        </li>
                       </ul>"
        
       

    </div>
    <div class="col-md-10">
         <!-- Product -->
         <div class="row">
            <!--fetching categories-->
            <?php
            //calling function
            view_details();
                ?>

          </div>
      </div>
    </div>
    <!--footer section -->
<?php include'footer.php';?>
 <?php include'footer_link.php';?>
</body>

</html>