<?php
include './inc/cu.common.php';
@session_start();
if (isset($_POST['user_login'])) {
  $u=$_POST['user_username'];
  $p=$_POST['user_password'];
  $q="SELECT * FROM customer";
  $r = sql_query($q);
  $num_rows = sql_num_rows($r);
  $row_data= sql_fetch_assoc($r);

  //cart item
  $q1="SELECT * FROM customer_cart";
  $r1 = sql_query($q1);
  $num_rows1 = sql_num_rows($r1);
     if ($num_rows>0) {
        $_SESSION['user_username']=$u;
    if (password_verify($p,$row_data['password'])){
       if($num_rows == 0 && $num_rows1 == 1){
        $_SESSION['user_username']=$u;
          echo "<script>window.open('index.php','_self')</script>";
       }else{
        $_SESSION['user_username']=$u;
         echo "<script>window.open('payment.php','_self')</script>";
       }
    }else{
      //echo "<script>alert('Username or password do not match')</script>";
         echo "<script>window.open('index.php','_self')</script>";
  }
   }else{
    echo "<script>alert('Username or do not match')</script>";
   }
}
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
<div class="container-fluied my-3">
    <h2 class="text-center">Login</h2>
    <div class=" row d-flex align-items-center justify-content-center">
        <div class="col-lg-12 col-xl-6">
            <form action="" method="post">
                <div class="form-outline mb-3">
                    <!-- username field-->
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" id="user_username" placeholder="Userame" class="form-control" name="user_username" autocomplete="off" required="required">
                </div>
                <div class="form-outline mb-3">
                    <!-- password field-->
                    <label for="user_password">Password</label>
                    <input type="password" class="form-control" id="user_password" placeholder="Password" name="user_password" autocomplete="off" required="required">
                </div>
                <div class="text-center">
                    <!-- login field-->
                    <input type="submit" value="Login" class="btn btn-primary" name="user_login">
                </div>
                <div class="text-center">
                    <p class="small">Don't have an account? <a href="./registration.php">Register</a></p>
                </div>
            </form>
            
        </div>
    </div>
    
</div>

    <!--footer section -->
<?php include'footer.php';?>
 <?php include'footer_link.php';?>
</body>

</html>