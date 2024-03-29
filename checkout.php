<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_POST['order_btn'])) {

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'flat no. ' . $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';
   
      $select_cart_user = mysqli_query($conn, "SELECT product_id FROM cart WHERE user_id = '$user_id'") or die('query failed');
      while ($fetch_products = mysqli_fetch_assoc($select_cart_user)) {
         $product_id = $fetch_products['product_id'];

         $select_cart_product = mysqli_query($conn, "SELECT * FROM product WHERE id = '$product_id'") or die('query failed');
         if (mysqli_num_rows($select_cart_product) > 0) {
            while ($cart_item = mysqli_fetch_assoc($select_cart_product)) {
               $cart_products[] = $cart_item['name'];
               $sub_total = ($cart_item['price']);
               $cart_total += $sub_total;
         }
      }
   }

   $total_product = implode(', ', $cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `order` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_product = '$total_product' AND total_price = '$cart_total'") or die('query failed');

   if ($cart_total == 0) {
      $message[] = 'your cart is empty';
   } else {
      if (mysqli_num_rows($order_query) > 0) {
         $message[] = 'order already placed!';
      } else {
         mysqli_query($conn, "INSERT INTO `order`(user_id, name, number, email, method, address, total_product, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_product', '$cart_total', '$placed_on')") or die('query failed');
         $message[] = 'order placed successfully!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <header class="header">
      <div class="header-1">

         <a href="index.php" class="logo"> <i class="fas fa-book"></i> book store raya</a>

         <form action="" class="search-form">
            <input type="search" name="" placeholder="search here..." id="search-box">
            <label for="search-box" class="fas fa-search"></label>
         </form>

         <div class="icons">
            <div id="search-btn" class="fas fa-search"></div>
            <div id="user-box" class="fas fa-user"></div>
            <a href="orders.php"><i class="fas fa-clipboard-list"></i></a>
            <?php
            $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            $cart_rows_number = mysqli_num_rows($select_cart_number);
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
         </div>
         <div class="user-box">
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
         </div>

      </div>
      <div class="heading">
         <h3 style="font-size: 2.5rem; ">our shop</h3>
         <p style="font-size: 1.5rem;"> <a href="index.php">home</a> / checkout </p>
      </div>
   </header>

   <section class="display-order">





      <?php
      $grand_total = 0;
      $select_cart_user = mysqli_query($conn, "SELECT product_id FROM cart WHERE user_id = '$user_id'") or die('query failed');
      while ($fetch_products = mysqli_fetch_assoc($select_cart_user)) {
         $product_id = $fetch_products['product_id'];

         $select_cart_product = mysqli_query($conn, "SELECT * FROM product WHERE id = '$product_id'") or die('query failed');
         if (mysqli_num_rows($select_cart_product) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart_product)) {
            $total_price = ($fetch_cart['price']);
            $grand_total += $total_price;
      ?>
            <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo 'Rp' . $fetch_cart['price']; ?>)</span> </p>
      <?php
         }
      } else {
         echo '<p class="empty">your cart is empty</p>';
      }
      }
      ?>
      <div class="grand-total"> grand total : <span>Rp<?php echo $grand_total; ?></span> </div>

   </section>

   <section class="checkout">

      <form action="" method="post">
         <h3>place your order</h3>
         <div class="flex">
            <div class="inputBox">
               <span>your name :</span>
               <input type="text" name="name" required placeholder="enter your name">
            </div>
            <div class="inputBox">
               <span>your number :</span>
               <input type="number" name="number" required placeholder="enter your number">
            </div>
            <div class="inputBox">
               <span>your email :</span>
               <input type="email" name="email" required placeholder="enter your email">
            </div>
            <div class="inputBox">
               <span>payment method :</span>
               <select name="method">
                  <option value="cash on delivery">cash on delivery</option>
                  <!-- <option value="credit card">credit card</option>
                  <option value="paypal">paypal</option>
                  <option value="paytm">paytm</option> -->
               </select>
            </div>
            <div class="inputBox">
               <span>address line 01 :</span>
               <input type="number" min="0" name="flat" required placeholder="e.g. flat no.">
            </div>
            <div class="inputBox">
               <span>address line 01 :</span>
               <input type="text" name="street" required placeholder="e.g. street name">
            </div>
            <div class="inputBox">
               <span>city :</span>
               <input type="text" name="city" required placeholder="e.g. mumbai">
            </div>
            <div class="inputBox">
               <span>state :</span>
               <input type="text" name="state" required placeholder="e.g. maharashtra">
            </div>
            <div class="inputBox">
               <span>country :</span>
               <input type="text" name="country" required placeholder="e.g. india">
            </div>
            <div class="inputBox">
               <span>pin code :</span>
               <input type="number" min="0" name="pin_code" required placeholder="e.g. 123456">
            </div>
         </div>
         <input type="submit" value="order now" class="btn" name="order_btn">
      </form>

   </section>









   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>