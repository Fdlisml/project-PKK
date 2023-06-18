<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
    }
}
?>

<header class="header">

    <div class="header-1">

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

    <div class="header-2">
        <nav class="navbar">
            <ul>
                <li><a href="#home">home</a></li>
                <li><a href="#products">product</a></li>
                <li><a href="#category">category +</a>
                    <ul>
                        <li><a href="#botol">Botol</a></li>
                        <li><a href="#jerigen">Jerigen</a></li>
                    </ul>
                </li>
                <li><a href="contact.php">contact</a></li>
                <li><a href="logout.php">logout</a></li>
            </ul>
        </nav>
    </div>

</header>

<nav class="bottom-navbar">
    <a href="#home" class="fas fa-home"></a>
    <a href="#products" class="fas fa-list"></a>
    <a href="#category" class="fas fa-layer-group"></a>
    <a href="#contact" class="fas fa-address-book"></a>
</nav>