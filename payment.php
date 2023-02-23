<?php
    include './inc/cu.common.php';
    $uname=$_SESSION['user_username'];
    $q ="SELECT * FROM customer WHERE userName='$uname'";  
    $r = sql_query($q);
    $row_data= sql_fetch_assoc($r);
    $uid=$row_data['id'];
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
<style>
    .payment-img{
        width: 90%;
        margin: auto;
        display: block;
    }
</style>
<body>
      <?php include'header.php';?>
    <div class="container">
       <h2 class="text-center text-info">Payment Options</h2>
       <div class="row d-flex justify-content-center align-items-center my-5">
        <div class="col-md-6">
           <a href="http://www/paypal/com" target="_blank" name="online"><img src="" class="payment-img">Online</a>
           </div>
           <div class="col-md-6">
           <a href="order.php?id=<?php echo $uid?>" value="offline"><h3 class="text-center">Pay Offline</h3></a>
           </div>
       </div>
    </div>

        <!--footer section -->
<?php include'footer.php';?>
 <?php include'footer_link.php';?>
</body>

</html>