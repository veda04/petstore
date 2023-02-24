<?php
include '../inc/ad.common.php';
$PAGE_TITLE = "View Order";
//$ORDER_TITLE = "Product Inventory";

$edit_page = "order-edit.php";
$del_page = $edit_page."?m=D&id=";
$order_display = "orders.php";

$or_id = $_GET['id'];

if(empty($or_id) || !is_numeric($or_id)) {
    header("location: $order_display");
    exit;
}

$cust_id = GetXFromYID("SELECT fkCustomerId from orders where id = $or_id");

if(isset($_POST['C_STATUS'])){
    $order_status = $_POST['order_status'];
    $order_desc = $_POST['order_desciption'];
    $q = "INSERT INTO order_status(orderStatusName) values('$order_status')";
    $r = sql_query($q);

}

// function call to get details of customer payment
//$cust_payment = get_pay_arr($txtid);

// function call to get details of the customer
$cust_details = get_det_arr($cust_id);

// function call to get details of order items
$order_items = get_items_arr($or_id);

$prod_name =  get_dat_arr("id", "productName", "product");

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
                            <div class="normal-table-list table table-bordered nk-light-green txt-white">
                                <div class="basic-tb-hd">
                                    <h4>Customer Details</h4>
                                </div>
                                <div class="invoice-ds-int">
                                    <?php
                                        //pr_arr($cust_details);
                                    foreach($cust_details as $arr_ind => $arr_blck){
                                     ?>
                                        <div><b>Name:</b> <?php echo $arr_blck->custName;?></div>
                                        <div><b>Phone Number:</b> <?php echo $arr_blck->custNumber;?></div>
                                        <div><b>Email:</b> <?php echo $arr_blck->custEmail;?></div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="invoice-sp">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Id</th>
                                            <th>Unit Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i=1;
                                        $total_price = 0;
                                        foreach($order_items as $arr_ind => $arr_blck){
                                            $prod_name_str = isset($prod_name[$arr_blck->fkProductId])? $prod_name[$arr_blck->fkProductId]: '-';
                                            $total_price += $arr_blck->totalPrice;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $prod_name_str; ?></td>
                                                <td><?php echo $arr_blck->unitPrice; ?></td>
                                                <td><?php echo $arr_blck->itemQuantity; ?></td>
                                                <td><?php echo $arr_blck->totalPrice; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b>Total:</b></td>
                                            <td><b><?php echo $total_price; ?></b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr>
                            <form action="<?php echo $edit_page; ?>" method="post">
                                <input type="hidden" name="m" value="C_STATUS">
                                 <div class="row">
                                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="basic-tb-hd">
                                            <br>
                                            <h4>Order Status</h4>
                                        </div>
                                     </div>
                                     <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                         <div class="form-group">
                                             <div class="nk-int-st">
                                                <select name="order_status" class="form-control select-form-control">
                                                    <?php
                                                        foreach($ORDER_STATUSES as $ordtype=>$orderval){
                                                            ?>
                                                            <option value="<?php echo $ordtype;?>"><?php echo $orderval;?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-lg-4 col-md- co4l-sm-12 col-xs-12">
                                         <div class="form-group">
                                             <div class="nk-int-st">
                                                 <textarea name="order_desciption" class="form-control ht-34" rows="2" placeholder="Comments...."></textarea>
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
                                <br>
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
