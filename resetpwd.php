<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pet Store</title>
    <?php include'_header_links.php';?>
</head>
<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <?php include'_header.php';?>
           
    <!-- Header Section End -->

<style>
    #uni_modal .modal-content>.modal-footer,#uni_modal .modal-content>.modal-header{
        display:none;
    }
</style>
<div  class="contact-form spad">
    <div class="container-3 col-lg-3">
            <form action="" id="forgot_password-form">
                <div class="form-group">
                    <label for="" class="control-label">New Password</label>
                    <input type="password" class="form-control form" name="new_password" required>
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Re-enter Password</label>
                    <input type="password" class="form-control form" name="reenter_password" required>
                </div>
                  <div class="form-group d-flex justify-content-between">
                        <button type="submit" class="site-btn">Submit</button>
                    </div>
            </form>
        </div>
    </div>
</div>
 <?php include'_footer_links.php';?>
      <?php include'_footer.php';?>
