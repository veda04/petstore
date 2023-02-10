<?php
// $NO_REDIRECT = 1;
include '../inc/ad.common.php';
$PAGE_TITLE = "Customers";

$edit_page = "user-edit.php";

$q = "SELECT * FROM `customer`";//WHERE fkRoleId > 1";
$r = sql_query($q);
$num_rows = sql_num_rows($r);
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
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
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
                            <a class="btn btn-info info-icon-notika waves-effect" href="<?php echo $edit_page; ?>">Add</a>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Customer No.</th>
                                        <th>Customer Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($num_rows > 0) {
                                        for($i=1; $o=sql_fetch_object($r); $i++) {
                                            $sr_no = $i.'.';
                                            $id = $o->id;
                                            $name = $o->custName;
                                            $user_name = $o->userName;
                                            $cust_no = $o->custNumber;
                                            $cust_email = $o->custEmail;

                                            $role_name = "";
                                            ?>
                                            <tr>
                                                <td><?php echo $sr_no; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $user_name; ?></td>
                                                <td><?php echo $cust_no; ?></td>
                                                <td><?php echo $cust_email; ?></td>
                                            </tr>
                                            <?php                                            
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
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