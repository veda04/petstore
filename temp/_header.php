<?php
$fileName =  basename($_SERVER["SCRIPT_NAME"]);
$M_ARR = array();

$M_ARR[1] = array("title"=>"Home", "href"=>"index.php", "has_sub"=>"N");
$M_ARR[2] = array("title"=>"Product", "href"=>"product.php", "has_sub"=>"N");
$M_ARR[3] = array("title"=>"Category", "href"=>"javascript:;", "has_sub"=>"Y");

$PROD_CATEGORY = getProductCategory();
$PROD_CATEGORY_ARR =  array();
// sub categories
if(!empty($PROD_CATEGORY)) {
    foreach($PROD_CATEGORY as $P_OBJ) {
        $c_url = "category.php?id=".$P_OBJ->id;
        $M_ARR[3]['SUB'][] = array("title"=>$P_OBJ->title, "href"=>$c_url, "has_sub"=>"N");
        $PROD_CATEGORY_ARR[$P_OBJ->id] = $P_OBJ->title;
    }
}

$M_ARR[4] = array("title"=>"Contact", "href"=>"contact.php", "has_sub"=>"N");

$d_str = "<ul>";
if(!empty($M_ARR)) {
    $d_str .= "<ul>";
    
    foreach($M_ARR as $_KEY => $MENU) {
        $d_selected = ( $MENU['href'] == $fileName ) ? "active" : "";
        $d_str .= '<li class="'.$d_selected.'"><a href="'.$MENU['href'].'">'.$MENU['title'].'</a>';

        if($MENU['has_sub'] == "Y") {
            $d_str .= '<ul class="header__menu__dropdown">';
                $SUB_ARR = isset($MENU['SUB']) ? $MENU['SUB'] : array();

                if(!empty($SUB_ARR) && count($SUB_ARR)) {
                    foreach($SUB_ARR as $_KEY2 => $MENU2) {
                        $d_str .= '<li><a href="'.$MENU2["href"].'">'.$MENU2["title"].'</a></li>';
                    }
                }

            $d_str .= '</ul>';
        }

        $d_str .= '</li>';
    }
    
    $d_str .= "</ul>";
}
$d_str .= "<ul>";

?>

<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="index.php"><img src="<?php echo HEADER_LOGO; ?>" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="wishlist.php"><i class="fa fa-heart"></i> <span>1</span></a></li>
            <li><a href="cart.php"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
        </ul>
        <div class="header__cart__price">item: <span class="userCartTotal"><?php echo Rs." 0.00"; ?></span></div>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__auth">
            <a href="login.php"><i class="fa fa-user"></i> Login</a>
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <?php echo $d_str; ?>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="<?php echo FB_LINK; ?>"><i class="fa fa-facebook"></i></a>
        <a href="<?php echo TW_LINK; ?>"><i class="fa fa-twitter"></i></a>
        <a href="<?php echo LI_LINK; ?>"><i class="fa fa-linkedin"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> <?php echo SITE_EMAIL; ?></li>
            <li>All your pet requirements at one stop</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> <?php echo SITE_EMAIL; ?></li>
                            <li>All your pet requirements at one stop</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="<?php echo FB_LINK; ?>"><i class="fa fa-facebook"></i></a>
                            <a href="<?php echo TW_LINK; ?>"><i class="fa fa-twitter"></i></a>
                            <a href="<?php echo LI_LINK; ?>"><i class="fa fa-linkedin"></i></a>
                        </div>
                        <div class="header__top__right__auth">
                            <a href="login.php"><i class="fa fa-user"></i> Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="index.php"><img src="<?php echo HEADER_LOGO; ?>" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <?php echo $d_str; ?>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li><a href="wishlist.php"><i class="fa fa-heart"></i> <span>1</span></a></li>
                        <li><a href="cart.php"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                    </ul>
                    <div class="header__cart__price">item: <span class="userCartTotal"><?php echo Rs." 0.00"; ?></span></div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->