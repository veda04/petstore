<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Store</title>
<div class="row px-1">
    <div class="col-md-12">
        <div class="row">
            <?php 
            if(!isset($_SESSION['user_username'])){
                include 'login.php';
            }else{
                include 'payment.php';
            }
            ?>
        </div>
    </div>
</div>
    