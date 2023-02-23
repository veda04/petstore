<?php
include '../inc/ad.common.php';
$PAGE_TITLE = "Order Edit";
//$ORDER_TITLE = "Product Inventory";

$edit_page = "order-edit.php";
$del_page = $edit_page."?m=D&id=";
$order_display = "orders.php";

// initiall value of m is ""
if(isset($_POST["m"]) && !empty($_POST['m'])) {
    $mode = $_POST["m"];
}
else if(isset($_GET["m"]) && !empty($_GET['m'])) {
    $mode =$_GET["m"];
}
else {
    $mode = "A";
}

//id
if(isset($_POST['id']) && is_numeric($_POST['id'])) {
    $txtid = $_POST['id'];
} 
else if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $txtid = $_GET['id'];
}
else {
    $mode = "A";
}
//  PRODUCT MODES
if($mode == 'A'){
    $txtid = 0;
    $prod_name = "";
    $prod_price = "";
    $prod_qty = "";
    $prod_img = BLANK_IMAGE;
    $prod_desc = "";
    $status = "A";

    //STOCK
    $fk_vendor_id = "";
    $qty_on_hand = "";
    $new_qty = "";
    $total_qty = "";
    $date_of_pruch = "";
    $stock_status = "A";  

    $form_mode = 'C';
}
else if($mode == 'C'){
    //insert
    $txtid = NextId("id", "product");
    $prod_name = $_POST["prod_name"];
    $prod_price = $_POST["prod_price"];
    $prod_qty = $_POST["prod_qty"];
    $prod_desc = $_POST["prod_desc"];
    $status = $_POST["active"];

    $q = "INSERT INTO product(id, productName,productPrice, productQty, productDesc, status) values ('$txtid', '$prod_name', '$prod_price', '$prod_qty', '$prod_desc', '$status')";
    $r = sql_query($q);
    $_SESSION[AD_SESSION_ID]->success_info = "New product created Successfully"; 
}
else if($mode == "R") {
    //edit
    $q = "SELECT * FROM product WHERE id='$txtid'";
    $r = sql_query($q);
    $o = sql_fetch_object($r);

    $id = $o->id;
    $prod_name = $o->productName;
    $prod_price = $o->productPrice;
    $prod_qty = $o->productQty;
    $prod_img = !empty($o->productImg)? PROD_IMG_PATH.$o->productImg : BLANK_IMAGE;
    $prod_desc = $o->productDesc;
    $status = $o->status;

    $form_mode = "U";
    $od_form_mode ='ADD_STOCK'; 
}
else if($mode == "U"){
    //update
    $txtid = $_POST["id"];
    $prod_name = $_POST["prod_name"];
    $prod_price = $_POST["prod_price"];
    $prod_qty = $_POST["prod_qty"];
    $prod_desc = $_POST["prod_desc"];
    $status = $_POST["active"];

    $q = "UPDATE product SET productName='$prod_name', productPrice='$prod_price', productQty='$prod_qty', productDesc='$prod_desc', status='$status' WHERE id='$txtid'";
    $r = sql_query($q);
    $_SESSION[AD_SESSION_ID]->success_info = "Successfully Updated"; 
}
else if($mode == "D"){
    $q = "DELETE FROM product WHERE id=$txtid";
    $r = sql_query($q);

    header("location: ".$item_display);
    exit;
}

if($mode == 'C' || $mode == 'U') {
    if(is_uploaded_file($_FILES["prod_img"]["tmp_name"])) {
        $uploaded_pic = $_FILES["prod_img"]["name"];
        $name = basename($_FILES['prod_img']['name']);
        $file_type = $_FILES['prod_img']['type'];
        $size = $_FILES['prod_img']['size'];
        $extension = substr($name, strrpos($name, '.') + 1);

        $q = "SELECT productImg, productName FROM product WHERE id='$txtid'";
        $r = sql_query($q);

        list($img, $name) = sql_fetch_row($r);
        //check if the img exists 
        if(!empty($img)) {
            $image = PROD_IMG_UPLOAD.$img;

            if(file_exists($image)) {
                unlink($image);
            }
        }
        // renaming the image with extension
        $renamed_img = $name.'.'.$extension;
        $setdir = opendir(PROD_IMG_UPLOAD);
        copy($_FILES["prod_img"]["tmp_name"], PROD_IMG_UPLOAD.$renamed_img);
        closedir($setdir);

        $q1 = "UPDATE product SET productImg='$renamed_img' WHERE id='$txtid'";
        $r1 = sql_query($q1);
    }
    header("location: ".$edit_page."?m=R&id=".$txtid);
    exit;
}


// STOCK MODES
if($mode == 'ADD_STOCK'){
    $fk_vendor_id = $_POST["fk_vendor_id"];
    $new_qty = $_POST["new_qty"];
    $date_of_pruch = $_POST["date_of_pruch"];
    $qty_on_hand = $_POST["prod_qty"];
    $total_qty = intval($qty_on_hand) + intval($new_qty);

    $q = "INSERT INTO product_stock(fkProductId, fkVendorId, qtyOnHand, newQty, totalQty, dateOfPruch, status) values ('$txtid','$fk_vendor_id', '$qty_on_hand', '$new_qty', '$total_qty', '$date_of_pruch', 'A')";
    $r = sql_query($q);

    if(sql_affected_rows($r)) {
        // success message
        $_SESSION[AD_SESSION_ID]->success_info = "Stock Successfully Updated"; 
    }
    else {
        // failure message;
        $_SESSION[AD_SESSION_ID]->success_info = "Unable to update stock"; 
    }

    header("location: $edit_page?m=R&id=$txtid");
    exit;
}
else if($mode == 'DELETE_STOCK'){
    $psid = $_GET['psid'];
    $q = "DELETE FROM product_stock WHERE id=$psid";
    $r = sql_query($q);
    $_SESSION[AD_SESSION_ID]->success_info = "Inventory Successfully Deleted"; 
    header("location: $edit_page?m=R&id=$txtid");
    exit;
}
?> 
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $PAGE_TITLE?></title>
    <meta name="description" content="">
    <?php include "_header_links.php"; ?>
</head>
<body>
<!-- Start Header Top Area -->
<?php include "_header.php"; ?>
<?php include "_menu.php"; ?>

<!-- Form Element area Start-->
<div class="form-element-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-element-list">
                    <div class="basic-tb-hd">
                        <h2><?php echo $PAGE_TITLE; ?></h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="normal-table-list table table-bordered">
                                <div class="basic-tb-hd">
                                    <h4>Customer Details</h4>
                                </div>
                                <div class="invoice-ds-int">
                                    <h5>Name: <span class="w-500">Veda</span></h5>  
                                    <h5>Number: <span class="w-500">Veda</span></h5>  
                                    <h5>Email: <span class="w-500">Veda</span></h5>  
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="normal-table-list table table-bordered">
                                <div class="basic-tb-hd">
                                    <h4>Payment Details</h4>
                                </div>
                                <div class="invoice-ds-int">
                                    <h5>Payment Method: <span class="w-500">Veda</span></h5> 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="invoice-sp">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item Name</th>
                                            <th>Unit Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Crusal Damperal</td>
                                            <td>$500</td>
                                            <td>05</td>
                                            <td>$3000</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Indriacal Superral</td>
                                            <td>$650</td>
                                            <td>06</td>
                                            <td>$7000</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Vidaska Adrioal</td>
                                            <td>$400</td>
                                            <td>03</td>
                                            <td>$2000</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Croustal Desrikal</td>
                                            <td>$600</td>
                                            <td>04</td>
                                            <td>$7000</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b>TOTAL :</b></td>
                                            <td><b>$7000</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr>
                            <form action="" method="post" enctype = "multipart/form-data">
                                 <div class="row">
                                     <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                         <div class="form-group">
                                             <div class="nk-int-st">
                                                 <select name="" class="form-control select-form-control">
                                                      <option value="">A</option>
                                                      <option value="">A</option>
                                                      <option value="">A</option>
                                                 </select>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-lg-4 col-md- co4l-sm-12 col-xs-12">
                                         <div class="form-group">
                                             <div class="nk-int-st">
                                                 <textarea class="form-control" rows="2" placeholder="Let us type some lorem ipsum...."></textarea>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                         <div class="form-group">
                                             <div class="nk-int-st">
                                                <button type="submit" name="submit_btn" class="btn btn-success notika-btn-success waves-effect">
                                                    Save
                                                </button>
                                             </div>
                                         </div>
                                     </div>
                                 </div>   
                            </form>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="basic-tb-hd">
                                <h4>Title</h4>
                            </div>
                            <div class="invoice-sp">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item Name</th>
                                            <th>Unit Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Crusal Damperal</td>
                                            <td>$500</td>
                                            <td>05</td>
                                            <td>$3000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<!-- Start Footer area-->
<?php include "_footer.php"; ?>
</body>
</html>
