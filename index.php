<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST['add_to_cart'])) {

    $product_id = $_POST['product_id'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE product_id = '$product_id' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'already added to cart!';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`(user_id, product_id) VALUES('$user_id', '$product_id')") or die('query failed');
        $message[] = 'product added to cart!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diklin</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <!-- header section starts  -->

    <?php include 'header.php' ?>

    <!-- header section ends -->

    <section class="home" id="home">

        <div class="row">

            <div class="content">
                <h3>upto 75% off</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam deserunt nostrum accusamus. Nam alias sit necessitatibus, aliquid ex minima at!</p>
                <a href="https://www.tokopedia.com/tokobogorcom?source=universe&st=product" class="btn">shop now</a>
            </div>

            <div class="swiper books-slider">
                <div class="swiper-wrapper">
                    <a href="https://klikyuk.com/diklin/m/view.php?id=5" class="swiper-slide" target="blank"><img src="image/sabun/cuci-pakaian-removebg.png" alt=""></a>
                    <a href="https://klikyuk.com/diklin/m/view.php?id=2" class="swiper-slide" target="blank"><img src="image/sabun/cuci-tangan-removebg.png" alt=""></a>
                    <a href="https://klikyuk.com/diklin/m/view.php?id=3" class="swiper-slide" target="blank"><img src="image/sabun/lantai-removebg.png" alt=""></a>
                    <a href="https://klikyuk.com/diklin/m/view.php?id=1" class="swiper-slide" target="blank"><img src="image/sabun/cuci-piring-jepis-removebg.png" alt=""></a>
                    <a href="https://klikyuk.com/diklin/m/view.php?id=1" class="swiper-slide" target="blank"><img src="image/sabun/cuci-piring-lemon-removebg.png" alt=""></a>
                </div>
                <img src="image/stand.png" class="stand" alt="">
            </div>

        </div>

    </section>

    <!-- home section ense  -->

    <!-- icons section starts  -->

    <section class="icons-container">

        <div class="icons">
            <i class="fas fa-shipping-fast"></i>
            <div class="content">
                <h3>free shipping</h3>
                <p>order over $100</p>
            </div>
        </div>

        <div class="icons">
            <i class="fas fa-lock"></i>
            <div class="content">
                <h3>secure payment</h3>
                <p>100 secure payment</p>
            </div>
        </div>

        <div class="icons">
            <i class="fas fa-redo-alt"></i>
            <div class="content">
                <h3>easy returns</h3>
                <p>10 days returns</p>
            </div>
        </div>

        <div class="icons">
            <i class="fas fa-headset"></i>
            <div class="content">
                <h3>24/7 support</h3>
                <p>call us anytime</p>
            </div>
        </div>

    </section>


    <!-- newsletter section starts -->

    <section class="newsletter">

        <form action="">
            <h3>subscribe for latest updates</h3>
            <input type="email" name="" placeholder="enter your email" id="" class="box">
            <input type="submit" value="subscribe" class="btn">
        </form>

    </section>

    <!-- newsletter section ends -->

    <!-- deal section starts  -->

    <section class="deal">

        <div class="content">
            <h3>deal of the day</h3>
            <h1>upto 50% off</h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde perspiciatis in atque dolore tempora quaerat at fuga dolorum natus velit.</p>
            <a href="https://www.tokopedia.com/tokobogorcom?source=universe&st=product" class="btn">shop now</a>
        </div>

        <div class="image">
            <img src="image/sabun/banner1.png" alt="">
        </div>

    </section>

    <!-- deal section ends -->

    <!-- product section starts -->

    <section class="products" id="products" style="margin-bottom: 0; padding-bottom: 0;">

        <h1 class="heading"> <span>product</span> </h1>

        <div class="box-container">

            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `product` LIMIT 4 ") or die('query failed');
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                    <form action="" method="post" class="box">
                        <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                        <div class="name"><?php echo $fetch_products['name']; ?></div>
                        <div class="name"><?php echo $fetch_products['category']; ?></div>
                        <div class="price">Rp<?php echo $fetch_products['price']; ?></div>
                        <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                        <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    </form>
            <?php
                }
            } else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>

        <div class="load-more" style="margin-top: 2rem; text-align:center">
            <a href="product.php" class="option-btn">load more</a>
        </div>
    </section>

    <!-- product section ends -->

    <!-- category section starts  -->
    <section id="category">

        <section class="reviews" id="botol">

            <h1 class="heading"> <span>Botol</span> </h1>

            <div class="swiper reviews-slider">

                <div class="swiper-wrapper">

                    <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM `product` WHERE category='botol' ") or die('query failed');
                    if (mysqli_num_rows($select_products) > 0) {
                        while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                    ?>
                            <div class="swiper-slide box">
                                <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                                <div class="text">
                                    <h3><?php echo $fetch_products['name']; ?></h3>
                                    <p>Rp<?php echo $fetch_products['price']; ?></p>
                                    <p><?php echo $fetch_products['category']; ?></p>
                                    <p>dari luar, Hypnerotomachia mungkin tidak memiliki daya tarik, tetapi dari dalam, ia memiliki tipu muslihat seorang wanita buruk rupa, pesona sebuah misteri yang membuat kecanduan</p>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<p class="empty">no products added yet!</p>';
                    }
                    ?>

                </div>

        </section>

        <section class="reviews" id="jerigen">

            <h1 class="heading"> <span>Jerigen</span> </h1>

            <div class="swiper reviews-slider">

                <div class="swiper-wrapper">



                    <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM `product` WHERE category='jerigen' ") or die('query failed');
                    if (mysqli_num_rows($select_products) > 0) {
                        while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                    ?>
                            <div class="swiper-slide box">
                                <!-- <a href="https://klikyuk.com/diklin/m/v.php?id_post=2&k=Sabun" target="blank"> -->
                                <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                                <div class="text">
                                    <h3><?php echo $fetch_products['name']; ?></h3>
                                    <p>Rp<?php echo $fetch_products['price']; ?></p>
                                    <p><?php echo $fetch_products['category']; ?></p>
                                    <p>dari luar, Hypnerotomachia mungkin tidak memiliki daya tarik, tetapi dari dalam, ia memiliki tipu muslihat seorang wanita buruk rupa, pesona sebuah misteri yang membuat kecanduan</p>
                                </div>
                                </a>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<p class="empty">no products added yet!</p>';
                    }
                    ?>



                </div>

        </section>
    </section>

    <!-- category section ends -->

    <!-- footer section starts  -->

    <?php include 'footer.php'; ?>

    <!-- footer section ends -->

    <!-- loader  -->

    <div class="loader-container">
        <img src="image/1488.gif" alt="">
    </div>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>