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

        <div class="contact__form__title">
            <h2>Create New Account</h2>
        </div>
        <div class="row d-flex align-item-center justify-content-center">
            <div class="col-lg-12 col-md-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" name="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="text" id="user_email" name="user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="user_gender" class="form-label">Gender</label>
                        <input type="dropdown" id="user_email" name="user_email" class="form-control"  autocomplete="off" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">Delivery Address</label>
                        <input type="address" id="user_address" name="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label">Contact Number</label>
                        <input type="text" id="user_contact" name="user_contact" class="form-control" placeholder="Enter your contact" autocomplete="off" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" name="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required">
                    </div>
                     <div class="form-outline mb-4">
                        <label for="conf_user_password" class="form-label">Confirm Password</label>
                        <input type="password" id="conf_user_password" name="conf_user_password" class="form-control" placeholder="Confirm Password" autocomplete="off" required="required">
                    </div>
                    <div class="text-center">
                        <input type="submit" name="user_register"  class="site-btn" value="Register">
                    </div>
                    <p class="text-center">Already have an account? <a href="./login.php"> Login</a></p>
                </form>
            </div>
        </div>


        <!--Footer Section --> 
     <?php include'_footer_links.php';?>
      <?php include'_footer.php';?>
   
</body>
<script>
    $(function () {
        $('#login-show').click(function () {
            uni_modal("", "login.php")
        })
        $('#registration').submit(function (e) {
            e.preventDefault();
            start_loader()
            if ($('.err-msg').length > 0)
                $('.err-msg').remove();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=register",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                error: err => {
                    console.log(err)
                    alert_toast("an error occured", 'error')
                    end_loader()
                },
                success: function (resp) {
                    if (typeof resp == 'object' && resp.status == 'success') {
                        location.reload()
                    } else if (resp.status == 'failed' && !!resp.msg) {
                        var _err_el = $('<div>')
                        _err_el.addClass("alert alert-danger err-msg").text(resp.msg)
                        $('[name="password"]').after(_err_el)
                        end_loader()
                    } else {
                        console.log(resp)
                        alert_toast("an error occured", 'error')
                        end_loader()
                    }
                }
            })
        })

    })
</script>
