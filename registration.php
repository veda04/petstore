<?php

include './inc/cu.common.php';


if(isset($_POST['user_register'])){
    $custid = NextId("id", "customer");
    $fname =$_POST['user_fullname'];
    $username =$_POST['user_username'];
    $email =$_POST['user_email'];
    $address =$_POST['user_address'];
    $contact =$_POST['user_contact'];
    $password=$_POST['user_password'];
    $hash_password=password_hash($password, PASSWORD_DEFAULT);
    $con_password =$_POST['conf_user_password'];

    //check whether username already exist or not
    $s="SELECT * FROM customer WHERE userName='$username' or custEmail=' $email'";
    $r = sql_query($s);
    $num_rows = sql_num_rows($r);
    if ($num_rows>0) {
      echo "<script>alert('Username and Email already exist!')</script>";
    }elseif ($password!=$con_password) {
        echo "<script>alert('Passwords do no match')</script>";
    }else{
    //insert data to database
    $q = "INSERT INTO customer(id,custName, userName, password, custNumber, custEmail,custAddress) values ('$custid','$fname','$username','$hash_password','$contact','$email','$address')";
    $r1 = sql_query($q);
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
    <h2 class="text-center">New Registration</h2>
    <div class=" row d-flex align-items-center justify-content-center">
        <div class="col-lg-12 col-xl-6">
            <form action="" method="post" >
               <div class="form-outline mb-3">
                    <!-- full name field-->
                    <label for="user_fullname" class="form-labelorm">Full Name</label>
                    <input type="text" id="user_fullname" placeholder="Full Name" class="form-control" name="user_fullname" autocomplete="off" required="required">
                </div>
                <div class="form-outline mb-3">
                    <!-- username field-->
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" id="user_username" placeholder="Userame" class="form-control" name="user_username" autocomplete="off" required="required">
                </div>
                  <div class="form-outline mb-3">
                    <!-- email field-->
                    <label for="user_email" class="form-label">Email</label>
                    <input type="text" id="user_emai" placeholder="Email" class="form-control" name="user_email" autocomplete="off" required="required">
                </div>
                 <div class="form-outline mb-3">
                    <!-- delivery address field-->
                    <label for="user_address" class="form-label">Delivery Address</label>
                    <input type="text" id="user_address" placeholder="Address" class="form-control" name="user_address" autocomplete="off" required="required">
                </div>
                <div class="form-outline mb-3">
                    <!-- contact field-->
                    <label for="user_contact" class="form-label">Contact</label>
                    <input type="number" id="user_contact" placeholder="Contact Number" class="form-control" name="user_contact" autocomplete="off" required="required">
                </div>
                <div class="form-row">
                    <!-- password field-->
                    <div class="form-group col-md-6">
                      <label for="user_password">Password</label>
                      <input type="password" class="form-control" id="user_password" placeholder="Password" name="user_password" autocomplete="off" required="required">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="conf_user_password">Confirm Password</label>
                      <input type="password" class="form-control" id="conf_user_password" placeholder="Confirm Password" name="conf_user_password" autocomplete="off" required="required">
                    </div>
                </div>
                <div class="text-center">
                    <!-- submit field-->
                    <input type="submit" value="Register" class="btn btn-primary" name="user_register">
                </div>
                <div class="text-center">
                    <p class="small">Already have an account? <a href="./login.php">Login</a></p>
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