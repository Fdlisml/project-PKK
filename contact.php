<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST['add_message'])) {

    $subject = $_POST['subject'];
    $message_user = $_POST['message'];
    $date_message = date('Y-m-d');

    $add_message_query = mysqli_query($conn, "INSERT INTO `message`(`id_user`,`subject`,`message`,`date_message`) VALUES('$user_id', '$subject', '$message_user', '$date_message')") or die('query failed');

    if ($add_message_query) {
        $message[] = 'message added successfully!';
    } else {
        $message[] = 'message could not be added!';
    }
}
?>

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <script src="https://kit.fontawesome.com/f557a1e30d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style_contact.css">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
</head>

<body>

    <?php include 'header.php' ?>

    <section class="contact_us">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="contact_inner">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="contact_form_inner">
                                    <div class="contact_field">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <h3>Contatc Us</h3>
                                            <p>Feel Free to contact us any time. We will get back to you as soon as we can!.
                                            </p>
                                            <input type="text" class="form-control form-group" placeholder="Subject" name="subject" />
                                            <textarea class="form-control form-group" placeholder="Message" name="message" rows="3"></textarea>
                                            <button class="contact_form_submit" type="submit" name="add_message">Send</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="right_contact_social_icon d-flex align-items-end">
                                    <div class="socil_item_inner d-flex">
                                        <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="contact_info_sec">
                            <h4>Contact Info</h4>
                            <div class="d-flex info_single align-items-center">
                                <i class="fas fa-headset"></i>
                                <span>+62 81211415387</span>
                            </div>
                            <div class="d-flex info_single align-items-center">
                                <i class="fas fa-envelope-open-text"></i>
                                <span>diklin@gmail.com</span>
                            </div>
                            <div class="d-flex info_single align-items-center">
                                <i class="fas fa-map-marked-alt"></i>
                                <span>VISAR 1 Jl. Dahlia No.2, Cibinong, Kec. Cibinong, Kabupaten Bogor, Jawa Barat 16911</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="map_sec">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="map_inner">
                        <h4>Find Us on Google Map</h4>
                        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore quo beatae quasi assumenda, expedita aliquam minima tenetur maiores neque incidunt repellat aut voluptas hic dolorem sequi ab porro, quia error.</p> -->
                        <div class="map_bind">
                            <iframe src="https://maps.google.com/maps?q=Visar%20Indah%20Pratama%20Blok%20VC1%20No.2,%20Cibinong,%20Bogor&t=&z=11&ie=UTF8&iwloc=&output=embed" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="loader-container">
        <img src="image/1488.gif" alt="">
    </div>

    <script src="js/script.js"></script>
</body>

</html>