 <?php
// session_start();
 include './inc/cu.common.php';
        if(isset($_SESSION['user_username'])){
        $uname=$_SESSION['user_username'];
        $q= "SELECT * FROM customer WHERE userName='$uname'";
        $r=sql_query($q);
        $row=sql_fetch_assoc($r);
        $cid=$row['id'];
        $query="SELECT * FROM customer_cart WHERE CustomerId='$cid'";
        $result=sql_query($query);
        while($row=sql_fetch_assoc($result)){
            $product_id=$row['ProductId'];
            $total_price=0;
            $select_product="SELECT * FROM product WHERE id='$product_id'";
            $result_product=sql_query($select_product);
            while ($row_product_price=sql_fetch_assoc($result_product)) {
                $product_title=$row_product_price['productName'];
                $product_desc=$row_product_price['productDesc'];
                $price=array($row_product_price['productPrice']);
                $value=array_sum($price);
                $total_price+=$value;
                $product_img=$row_product_price['productImg'];
            }
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
<!-- Data Table area Start-->
<div class="bg-white ">
  <div class="container px-2">
      <div class="row px-2">
          <section class="h-100 gradient-custom">
  <div class="container py-5">
    <div class="row d-flex justify-content-center my-4">
      <div class="col-md-8">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Shopping Cart</h5>
          </div>
          <div class="card-body">
            <!-- php code to display dynamic data -->
            <!-- Single item -->
            <div class="row">
              <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                <!-- Image -->
                <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                  <img src="#" class="w-100" alt="" />
               <?php echo $product_img; ?>
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                  
                </div>
                <!-- Image -->
              </div>

              <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                <!-- Data -->
                <p><strong><?php echo $product_title; ?></strong></p>
                <p><?php echo $product_desc; ?></p>
                <button type="button" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip"
                  title="Remove item">
                  <i class="fas fa-trash"></i>
                </button>
                <button type="button" onclick="ConfirmDelete('<?php echo $del_link; ?>', 'Category'" class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip"
                  title="Move to the wish list">
                  <i class="fas fa-heart"></i>
                </button>
                <!-- Data -->
              </div>

              <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <!-- Quantity -->
                <div class="d-flex mb-4" style="max-width: 300px">
                  <button class="btn btn-primary px-3 me-2" class="btn btn-danger btn-sm mb-2"
                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                    <i class="fas fa-minus"></i>
                  </button>

                  <div class="form-outline">
                    <input id="form1" min="0" name="quantity" value="1" type="number" class="form-control" />
                    <label class="form-label" for="form1">Quantity</label>
                  </div>

                  <button class="btn btn-primary px-3 ms-2"
                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- Quantity -->

                <!-- Price -->
                <p class="text-start text-md-center">
                  <strong>£<?php echo $price ?></strong>
                </p>
                <!-- Price -->
              </div>
            </div>
           
            <!-- Single item -->
          </div>
        </div>
        <div class="card mb-4">
          <div class="card-body">
            <p><strong>Expected shipping delivery</strong></p>
            <p class="mb-0">25.02.2023 - 29.02.2023</p>
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body">
            <p><strong>We accept</strong></p>
            <img src="img/payment-item.png" alt="">
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Summary</h5>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li
                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                Products
                <span>£<?php echo $total_price; ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Shipping
                <span>£0.00</span>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                <div>
                  <strong>Total amount</strong>
                  <strong>
                    <p class="mb-0">(including VAT)</p>
                  </strong>
                </div>
                <span><strong>£<?php echo $total_price; ?></strong></span>
              </li>
            </ul>

            <button type="button" class="btn btn-primary btn-lg btn-block">
              <a href="checkout.php" class="text-light">Go to checkout</a>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
      </div>
  </div> 
</div>

    <!--footer section -->
<?php include'footer.php';?>
 <?php include'footer_link.php';?>
</body>

</html>