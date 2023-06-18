<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

// if (isset($_POST['update_cart'])) {
//    $cart_id = $_POST['cart_id'];
//    $cart_quantity = $_POST['cart_quantity'];
//    mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
//    $message[] = 'cart quantity updated!';
// }

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE product_id = '$delete_id'") or die('query failed');
   header('location:cart.php');
}

if (isset($_GET['delete_all'])) {
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>
   <header class="header">
      <div class="header-1">

         <!-- <a href="index.php" class="logo"> <i class="fas fa-book"></i> book store raya</a> -->
         <a href="index.php">
            <img src="https://klikyuk.com/diklin/content/img/logo_diklin.png" width="120">
         </a>

         <form action="" class="search-form">
            <input type="search" name="" placeholder="search here..." id="search-box">
            <label for="search-box" class="fas fa-search"></label>
         </form>

         <div class="icons">
            <div id="search-btn" class="fas fa-search"></div>
            <div id="user-btn" class="fas fa-user"></div>
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
   </header>

   <section class="shopping-cart" style="padding-top: 4rem;">

      <h1 class="heading"> <span style="font-size: 3.7rem;">products added</span> </h1>

      <div class="box-container">
         <?php
         $grand_total = 0;
         $select_cart_user = mysqli_query($conn, "SELECT product_id FROM cart WHERE user_id = '$user_id'") or die('query failed');

         while ($fetch_products = mysqli_fetch_assoc($select_cart_user)) {
            $product_id = $fetch_products['product_id'];

            $select_cart_product = mysqli_query($conn, "SELECT * FROM product WHERE id = '$product_id'") or die('query failed');
            if (mysqli_num_rows($select_cart_product) > 0) {
               while ($fetch_cart = mysqli_fetch_assoc($select_cart_product)) {
         ?>
            <div class="box">
               <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>
               <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
               <div class="name"><?php echo $fetch_cart['name']; ?></div>
               <div class="price">Rp<?php echo $fetch_cart['price']; ?></div>
               <!-- <form action="" method="post">
               <input type="hidden" name="cart_id" value="">
               <input type="hidden" name="update_cart" value="update" class="option-btn">
            </form> -->
               <div class="sub-total"> sub total : <span>Rp<?php echo $sub_total = ($fetch_cart['price']); ?></span> </div>
            </div>
         <?php
            $grand_total += $sub_total;
               }
            } else {
               echo '<p class="empty">your cart is empty</p>';
            }
         }
         ?>
      </div>

      <div style="margin-top: 2rem; text-align:center;">
         <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm('delete all from cart?');">delete all</a>
      </div>

      <div class="cart-total">
         <p>grand total : <span>Rp<?php echo $grand_total; ?></span></p>
         <div class="flex">
            <a href="product.php" class="option-btn">continue shopping</a>
            <a href="checkout.php" class="btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">proceed to checkout</a>
         </div>
      </div>

   </section>


   <?php include 'footer.php' ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>