<?php
// session defines
define("AD_SESSION_ID", "ECOM_AD"); # admin session management
define("CU_SESSION_ID", "ECOM_CU"); # customer session management
define("SQL_ERROR", "1");
define("NOW", date("Y-m-d H:i:s"));
define("TODAY", date("Y-m-d"));
define("NEWLINE", "\n\r");
define("TAB_SPACE", "\t");

// path defines
define("LOG_PATH", DOCROOT."logs/"); # path to store logs


define("CAT_IMG_PATH", SITE_ADDRESS."images/category_images/"); # path to retrive logs
define("CAT_IMG_UPLOAD", DOCROOT."images/category_images/"); # path to store logs

define("PROD_IMG_PATH", SITE_ADDRESS."images/product_images/"); # path to retrive logs
define("PROD_IMG_UPLOAD", DOCROOT."images/product_images/"); # path to store logs

define("BLANK_IMAGE", ADMIN_ADDRESS."img/blank-img.png"); #blank image
?>