<?php
// $NO_REDIRECT = 1;
include '../inc/ad.common.php';
$PAGE_TITLE = "Customer's Information";

$edit_page = "customer-edit.php";
$customer_display ="customer.php";
// stores the id of the selected customer
$txtid = $_GET['id'];

// query to select from customer table
$q = "SELECT * FROM customer WHERE id='$txtid'";
$r = sql_query($q);
$o = sql_fetch_object($r);

// assigning values to respective variables
$cust_name = $o->custName;
$cust_no = $o->custNumber;
$cust_email = $o->custEmail;

// function call to get address of the customer
$cust_add = get_add_arr($txtid);

// function to get all the orders of the customer
$cust_order = get_order_arr($txtid);
?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $PAGE_TITLE; ?></title>
    <meta name="description" content="">
    <?php include "_header_links.php"; ?>
</head>

<body>
    <!-- Start Header Top Area -->
    <?php include "_header.php"; ?>
    <?php include "_menu.php"; ?>

    <!-- Data Table area Start-->
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd flex-space">
                            <h2>
                                <?php echo $PAGE_TITLE; ?>
                            </h2>
                        </div>
                        <div class="">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="contact-inner">
                                        <div class="contact-hd widget-ctn-hd">
                                            <h2>Personal Details</h2>
                                        </div>
                                        <div class="contact-dt">
                                            <ul class="contact-list widget-contact-list">
                                                <li><b>Name:</b> <?php echo $cust_name?></li>
                                                <li><b>Phone Number:</b> <?php echo $cust_no?></li>
                                                <li><b>Email:</b> <?php echo $cust_email?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>b
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="contact-inner">
                                        <div class="contact-hd widget-ctn-hd">
                                            <h2>Addresses</h2>
                                        </div>
                                        <div class="contact-dt">
                                            <ul class="contact-list widget-contact-list">
                                                    <?php
                                                        // pr_arr($cust_add);
                                                        foreach($cust_add as $title => $address){
                                                            echo '<li>';
                                                            echo "<b>$address->title: </b>". $address->address;
                                                            echo '</li>';
                                                        }
                                                    ?>
                                            </ul>
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
                                                    <th>Order Type</th>
                                                    <th>Order Date</th>
                                                    <th>Payment method</th>
                                                    <th>Total Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // pr_arr($cust_order);
                                                // exit;
                                                
                                                ?>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Crusal Damperal</td>
                                                    <td>$500</td>
                                                    <td>$500</td>
                                                    <td>05</td>
                                                    <td>$3000</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int mg-t-15 flex-space-end">
                                <div>
                                    <a href="<?php echo $customer_display ;?>" class="btn btn-warning warning-icon-notika waves-effect">   
                                         Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Data Table area End-->


    <!-- Start Footer area-->
    <?php include "_footer.php"; ?>
</body>

</html>