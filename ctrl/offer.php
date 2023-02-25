<?php
// $NO_REDIRECT = 1;
include '../inc/ad.common.php';
$PAGE_TITLE = "Offers";

$edit_page = "offer-edit.php";

$q = "SELECT * FROM `offers`";
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
<?php include "_header.php"; ?>
<?php include "_menu.php"; ?>

<!-- Data Table area Start-->
<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php echo $sess_info_str; ?>
                <div class="data-table-list">
                    <div class="basic-tb-hd flex-space">
                        <h2>
                            <?php echo $PAGE_TITLE; ?>
                        </h2>
                        <?php if(!$is_support) { ?>
                        <a class="btn btn-info info-icon-notika waves-effect" href="<?php echo $edit_page; ?>">Add</a>
                        <?php } ?>
                    </div>
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Offer Name</th>
                                    <th>Description</th>
                                    <th>Value</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <?php if(!$is_support) { ?>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($num_rows > 0) {
                                    for($i=1; $o=sql_fetch_object($r); $i++) {
                                        $sr_no = $i.'.';
                                        $id = $o->id;
                                        $offer_name = $o->offerName;
                                        $offer_description = $o->offerDesc;
                                        $offer_value = $o->offerVal;
                                        $offer_type = $o->offertype;
                                        $status = $o->status;

                                        $edit_link = $edit_page."?m=R&id=".$id;
                                        $del_link = $edit_page."?m=D&id=".$id;
                                        ?>
                                        <tr>
                                            <td><?php echo $sr_no; ?></td>
                                            <td><?php echo $offer_name; ?></td>
                                            <td><?php echo $offer_description ?></td>
                                            <td><?php echo $offer_value; ?></td>
                                            <td><?php echo $offer_type; ?></td>
                                            <td><?php echo isset($STATUS_ARR[$status]) ? $STATUS_ARR[$status] : "-"; ?></td>
                                            <?php if(!$is_support) { ?>
                                            <td>
                                                <a class="btn btn-warning notika-btn-success waves-effect" href="<?php echo $edit_link; ?>">Edit
                                                </a>
                                            </td>
                                            <td>
                                                <button onclick="ConfirmDelete('<?php echo $del_link; ?>', 'Category')" type="button" class="btn btn-danger danger-icon-notika waves-effect">Delete</button>
                                            </td>
                                            <?php } ?>
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