<?php
function view_details(){
        //condition to check isset or not
        if (isset($_GET['product_id'])) {
    //if(isset($_GET['category_id'])){
                $product_id=$_GET['product_id'];
                $select_query="SELECT * FROM product WHERE id ='$product_id'";
                $result_query=sql_query($select_query);
                while($row=sql_fetch_assoc($result_query)){
                   $product_id=$row['id'];
                   $product_name=$row['productName'];
                   $product_img=$row['productImg'];
                   $product_price=$row['productPrice'];
                   $product_desc=$row['productDesc'];
                   $category_id=$row['categoryId'];
                   echo "<div class='col-md-5 mb-2'>
                            <div class='card' >
                                <img src='./ctrl/images/$product_img' class='card-img-top' alt='$product_name'>
                                  <div class='card-body'>
                                    <h5 class='card-title'>$product_name</h5>
                                    <p class='card-text'>$product_desc</p>
                                    <p class='card-text'>Price: £$product_price</p>
                                    <a href='product.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                                    <a href='product.php' class='btn btn-secondary'>Go Back</a>
                                  </div>
                            </div>
                        </div> ";
       }
  //  }
}
}
//display all products
function get_all_products() {
        //condition to check isset or not
     if(empty($_GET['category_id'])){
         $select_query="SELECT * FROM product order by rand()";
                $result_query=sql_query($select_query);
                while($row=sql_fetch_assoc($result_query)){
                   $product_id=$row['id'];
                   $product_name=$row['productName'];
                   $product_img=$row['productImg'];
                   $product_price=$row['productPrice'];
                   $product_desc=$row['productDesc'];
                   $category_id=$row['categoryId'];
                   echo "<div class='col-md-5 mb-2'>
                            <div class='card' >
                                <img src='./ctrl/images/$product_img' class='card-img-top' alt='$product_name'>
                                  <div class='card-body'>
                                    <h5 class='card-title'>$product_name</h5>
                                    <p class='card-text'>$product_desc</p>
                                    <a href='product.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                                   <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                  </div>
                            </div>
                        </div> ";
                }
       }
    }
    //getting unique categories
    function get_unique_categories(){
           //condition to check isset or not
        if(isset($_GET['category_id'])){
            $category_id=$_GET['category_id'];
            $select_query="SELECT * from product where categoryId='$category_id'";
            $result_query=sql_query($select_query);
            $sum_of_rows=sql_num_rows($result_query);
              while($row=sql_fetch_assoc($result_query)){
                   $product_id=$row['id'];
                   $product_name=$row['productName'];
                   $product_img=$row['productImg'];
                   $product_price=$row['productPrice'];
                   $product_desc=$row['productDesc'];
                   $category_id=$row['categoryId'];
                   echo "<div class='col-md-5 mb-2'>
                            <div class='card' >
                                <img src='./ctrl/images/$product_img' class='card-img-top' alt='$product_name'>
                                  <div class='card-body'>
                                    <h5 class='card-title'>$product_name</h5>
                                    <p class='card-text'>$product_desc</p>
                                    <a href='product.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                                   <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more </a>
                                  </div>
                            </div>
                        </div> ";
                }
        }
    }

    //getting categories
    function get_categories(){
            $select_query="SELECT * from category";
            $result_query=sql_query($select_query);
            $sum_of_rows=sql_num_rows($result_query);
            while($row=sql_fetch_assoc($result_query)){
                  $category_name=$row['title'];  
                  $category_id=$row['id'];
                   echo "<a href='product.php?category_id=$category_id' >$category_name</a>";
                }
        }

    //adding product to cart
    function cart(){
        if (isset($_GET['add_to_cart'])){
          //  if(!isset($_SESSION['user_username'])){
           //     include 'login.php';
         //   }else{
                $uname=$_SESSION['user_username'];
                $query="SELECT * FROM customer WHERE userName='$uname'";
                $result_query=sql_query($query);
                $row=sql_fetch_assoc($result_query);
                $cid=$row['id'];
                $id = NextId("id", "customer_cart");
                $product_id=$_GET['add_to_cart'];
                $q= "SELECT * FROM customer_cart WHERE CustomerId='$cid' and ProductId='$product_id'";
                $r=sql_query($q);
                $num_rows=sql_num_rows($r);
                if($num_rows>0){
                    echo "<script>alert('This product is already present inside cart')</script>";
                    echo "<script>window.open('product.php','_self')</script>";
                }else{
                    $insert_query="INSERT INTO customer_cart (id,CustomerId,ProductId,quantity) values ('$id','$cid','$product_id',1)";
                    $result_query=sql_query($insert_query);
                    echo "<script>window.open('product.php','_self')</script>";
                }
        //    }
        }
    }

    //function to get number of cart items
    function cart_number(){
         if (isset($_GET['add_to_cart'])){
          //  if(!isset($_SESSION['user_username'])){
           //     include 'login.php';
         //   }else{
                $uname=$_SESSION['user_username'];
                $query="SELECT * FROM customer WHERE userName='$uname'";
                $result_query=sql_query($query);
                $row=sql_fetch_assoc($result_query);
                $cid=$row['id'];
                $q= "SELECT * FROM customer_cart WHERE CustomerId='$cid' ";
                $r=sql_query($q);
                $count_items=sql_num_rows($r);
                 echo "<small>$count_items</small>";
                }else{
                    if(isset($_SESSION['user_username'])){
                        $uname=$_SESSION['user_username'];
                        $query="SELECT * FROM customer WHERE userName='$uname'";
                        $result_query=sql_query($query);
                        $row=sql_fetch_assoc($result_query);
                        $cid=$row['id'];
                        $q= "SELECT * FROM customer_cart WHERE CustomerId='$cid' ";
                        $r=sql_query($q);
                        $count_items=sql_num_rows($r);
                        echo "<small>$count_items</small>";
                    }else{
                          echo "<small></small>";
                    }
                }
            }
?>