<?php
include '../inc/ad.common.php';
$PAGE_TITLE = "Offer Edit";

$edit_page = "offer-edit.php";
$del_page = $edit_page."?m=D&id=";
$offer_display = "offer.php";

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

if($mode == 'A'){
    $txtid = 0;
    $offer_name = "";
    $offer_description = "";
    $offer_value = "";
    $offer_type = "";
    $status = "A";

    $form_mode = 'C';
}
else if($mode == 'C'){
    //insert
    $txtid = NextId("id", "offers");
    $offer_name = $_POST["offer_name"];
    $offer_description = $_POST["offer_description"];
    $offer_value = $_POST["offer_value"];
    $offer_email = $_POST["offer_type"];
    $status = $_POST["active"];

    $q = "INSERT INTO offers(id, offerName, offerDesc, offerVal,offertype, status) values ('$txtid', '$offer_name', '$offer_description', '$offer_value','$offer_type', '$status')";
    $r = sql_query($q);
    $_SESSION[AD_SESSION_ID]->success_info = "New offer created successfully"; 

    header("location: ".$edit_page."?m=R&id=".$txtid);
    exit;
}
else if($mode == "R") {
    //edit
    $q = "SELECT * FROM offers WHERE id='$txtid'";
    $r = sql_query($q);
    $o = sql_fetch_object($r);

    $id = $o->id;
    $offer_name = $o->offerName;
    $offer_description = $o->offerDesc;
    $offer_value = $o->offerVal;
    $offer_type = $o->offertype;
    $status = $o->status;

    $form_mode = "U";
}
else if($mode == "U"){
    //update
    $txtid = $_POST["id"];
    $offer_name = $_POST["offer_name"];
    $offer_description = $_POST["offer_description"];
    $offer_value = $_POST["offer_value"];
    $offer_type = $_POST["offer_type"];
    $status = $_POST["active"];

    $q = "UPDATE offers SET offerName ='$offer_name', offerDesc ='$offer_description', offerVal ='$offer_value', offertype ='$offer_type', status='$status' WHERE id='$txtid'";
    $r = sql_query($q);
    $_SESSION[AD_SESSION_ID]->success_info = "Order successfully Updated"; 

    header("location: ".$edit_page."?m=R&id=".$txtid);
    exit;
}
else if($mode == "D"){
    $q = "DELETE FROM offers WHERE id=$txtid";
    $r = sql_query($q);
    $_SESSION[AD_SESSION_ID]->success_info = "Order successfully deleted"; 
    header("location: ".$offer_display);
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
                <?php echo $sess_info_str; ?>
                <div class="form-element-list">
                    <div class="basic-tb-hd">
                        <h2><?php echo $PAGE_TITLE; ?></h2>
                    </div>
                    <form action="<?php echo $edit_page; ?>" method="post" enctype = "multipart/form-data">
                        <input type="hidden" name="m" value="<?php echo $form_mode; ?>">
                        <input type="hidden" name="id" value="<?php echo $txtid; ?>">
                        <div class="row">
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" name="offer_name" value="<?php echo $offer_name; ?>" class="form-control" placeholder="Offer Name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" name="offer_description" value="<?php echo $offer_description; ?>" class="form-control" placeholder="Description" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" name="offer_value" value="<?php echo $offer_value; ?>" class="form-control" placeholder="Value" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" name="offer_type" value="<?php echo $offer_type; ?>" class="form-control" placeholder="Type" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="radio-area">
                                        <div class="">
                                            Status: 
                                        </div>
                                        <div class="fm-checkbox">
                                            <label>
                                                <input type="radio" <?php echo ($status=="A") ? "checked" : ""; ?> value="A" name="active"  class="i-checks"> 
                                                <i></i> 
                                                Active
                                            </label>
                                        </div>

                                        <div class="fm-checkbox">
                                            <label>
                                                <input type="radio"  <?php echo ($status=="I") ? "checked" : ""; ?> value="I" name="active" class="i-checks"> 
                                                <i></i> 
                                                Inactive
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int mg-t-15 flex-space-end">
                            <div>
                                <a href="<?php echo $offer_display ;?>" class="btn btn-warning warning-icon-notika waves-effect">    Back
                                </a>
                                <button type="submit" name="submit_btn" class="btn btn-success notika-btn-success waves-effect">
                                    Save
                                </button>
                                <button onclick="ConfirmDelete('<?php echo $del_page.$txtid; ?>', 'Category')" type="button" class="btn btn-danger danger-icon-notika waves-effect">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Start Footer area-->
<?php include "_footer.php"; ?>
</body>
</html>
