<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pet Store</title>
         <link rel="stylesheet" href="css/style.css" type="text/css">
    <?php include'_header_links.php';?>
</head>
<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php include'_header.php';?>
   
 <div  class="cart_page">
     <table>
         <tr>
             <th>Product</th>
             <th>Quantity</th>
             <th>Subtotal</th>
         </tr>
         <tr>
             <td>
                 <div >
                    <img  src="img/categories/toys/T-9.jpg">
                    </div>

                     <div class="cart_info">
                        <h6>Albion Country</h6>
                     <small>Price: £6.00</small>
                     <br>
                     <a  href="">Remove</a>
                 </div>
             </td>
             <td >
                <input  type="number" value="1" name="">
            </td>
             <td>£6.00</td>
         </tr>
     </table>
     <div class="total_price">
         <table>
            <tr>
                <td>Subtotal</td>
                 <td>£18.00</td>
            </tr> 
             <tr>
                <td>Tax</td>
                 <td>£18.00</td>
            </tr> 
             <tr>
                <td>Total</td>
                 <td>£18.00</td>
            </tr> 
         </table>
     </div>

 </div>
      
<!--footer section-->

    <?php include'_footer_links.php';?>
      <?php include'_footer.php';?>
</body>
</html>
