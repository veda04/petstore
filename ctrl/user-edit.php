<?php
include '../inc/ad.common.php';
$PAGE_TITLE = "User Edit";

$edit_page = "user-edit.php";
$del_page = $edit_page."?m=D&id=";
$user_display = "users.php";

// initiall value of m is ""
if(isset($_POST["m"]) && !empty($_POST['m'])) {
    $mode = $_POST["m"];
}
else if(isset($_GET["m"]) && !empty($_GET['m'])) {
    $mode =$_GET["m"];
}
else{
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
    $name = "";
    $username = "";
    $password = "";
    $role = "";
    $status = "A";

    $form_mode = 'C';
}
else if($mode == 'C') {
    //insert
    $txtid = NextId("id", "user");
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    $status = $_POST["active"];

    $q = "INSERT INTO user(id, name, username, password, fkRoleId,lastLogin, status) values ('$txtid', '$name', '$username', md5('$password'), '$role', NULL, '$status')";
    $r = sql_query($q);
    $_SESSION[AD_SESSION_ID]->success_info = "New user created Successfully"; 
    
    header("location: ".$edit_page."?m=R&id=".$txtid);
    exit;
}
else if($mode == "R") {
    //edit
    $q = "SELECT * FROM user WHERE id='$txtid'";
    $r = sql_query($q);
    $o = sql_fetch_object($r);

    $txtid = $o->id;
    $name = $o->name;
    $username = $o->username;
    $password = $o->password;
    $role = $o->fkRoleId;
    $status = $o->status;

    $form_mode = "U";
}
else if($mode == "U"){
    //update
    $txtid = $_POST["id"];
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    $status = $_POST["active"];

    $q = "UPDATE user SET name='$name', username='$username', password=md5('$password'), fkRoleId='$role', status='$status' WHERE id='$txtid'";
    $r = sql_query($q);
    $_SESSION[AD_SESSION_ID]->success_info = "Successfully Updated"; 

    header("location: ".$edit_page."?m=R&id=".$txtid);
    exit;
}
else if($mode == "D"){
    $q = "DELETE FROM user WHERE id=$txtid";
    $r = sql_query($q);

    header("location: ".$user_display);
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
                        <?php echo $sess_info_str; ?>
                    </div>
                    <form action="<?php echo $edit_page; ?>" method="post">
                        <input type="hidden" name="m" value="<?php echo $form_mode; ?>">
                        <input type="hidden" name="id" value="<?php echo $txtid; ?>">
                        <div class="row">
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                 <div class="form-group ic-cmp-int">
                                     <div class="form-ic-cmp">
                                         <i class="notika-icon notika-support"></i>
                                     </div>
                                     <div class="nk-int-st">
                                         <input type="text" name="name" id="name" value="<?php echo $name; ?>"  class="form-control"  placeholder="Name" required>
                                     </div>
                                 </div>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                 <div class="form-group ic-cmp-int">
                                     <div class="form-ic-cmp">
                                         <i class="notika-icon notika-support"></i>
                                     </div>
                                     <div class="nk-int-st">
                                         <input type="text" name="username" value="<?php echo $username; ?>" class="form-control" placeholder="Username" required>
                                     </div>
                                 </div>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                 <div class="form-group ic-cmp-int">
                                     <div class="form-ic-cmp">
                                         <i class="notika-icon notika-edit"></i>
                                     </div>
                                     <div class="nk-int-st">
                                         <input type="text" name="password" value="" class="form-control" placeholder="Password" required>
                                     </div>
                                 </div>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                 <div class="form-group ic-cmp-int">
                                     <div class="form-ic-cmp form-ic-cmp-sel">
                                         <i class="notika-icon notika-star"></i>
                                     </div>
                                     <div class="nk-int-st">
                                        <select name ="role" class="form-control select-form-control">
                                            <?php
                                            $q2 = "SELECT id, title FROM user_role WHERE id>1"; 
                                            $r2 = sql_query($q2);
                                            $num_rows = sql_num_rows($r2);
                                            if($num_rows > 0){
                                                 while($row = sql_fetch_assoc($r2)){
                                                   $selected = ($row['id']==$role) ? "selected" : ""; 
                                                   ?>
                                                   <option <?php echo $selected; ?> value="<?php echo $row['id']; ?>">
                                                     <?php echo $row['title']; ?></option><?php                    
                                                    }
                                                 }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                 <div class="form-group">
                                     <div class="radio-area">
                                        <div class="p-10">
                                         Status: 
                                         </div>
                                         <div class="fm-checkbox">
                                            <label><input type="radio" <?php echo ($status=="A") ? "checked" : ""; ?> value="A" name="active"  class="i-checks"> <i></i> Active</label>
                                        </div>
                                        <div class="fm-checkbox">
                                         <label><input type="radio"  <?php echo ($status=="I") ? "checked" : ""; ?> value="I" name="active" class="i-checks"> <i></i> Inactive</label>
                                        </div>
                                    </div>
                                 </div>
                            </div>
                        </div>
                        <div class="form-example-int mg-t-15 flex-space-end">
                            <div>
                                <a href="<?php echo $user_display ;?>" class="btn btn-warning warning-icon-notika waves-effect">Back</a>
                                <button type="submit" name="submit_btn" class="btn btn-success notika-btn-success waves-effect">Save</button>
                                <button onclick="ConfirmDelete('<?php echo $del_page.$txtid; ?>', 'User')" type="button" class="btn btn-danger danger-icon-notika waves-effect">Delete</button>
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