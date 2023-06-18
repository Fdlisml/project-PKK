<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_message.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="users">

   <h1 class="title"> message accounts </h1>

   <div class="box-container">
      <?php
        $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
        while($fetch_messages = mysqli_fetch_assoc($select_messages)){
        $select_users = mysqli_query($conn, "SELECT * FROM `user` WHERE `id` = $fetch_messages[id_user] ") or die('query failed');
        $fetch_users = mysqli_fetch_assoc($select_users)
      ?>
      <div class="box">
         <p> user id : <span><?php echo $fetch_messages['id_user']; ?></span> </p>

         <p> username : <span><?php echo $fetch_users['name']; ?></span> </p>
         <p> email : <span><?php echo $fetch_users['email']; ?></span> </p>
         
         <p> subject : <span><?php echo $fetch_messages['subject']; ?></span> </p>
         <p> message : <span><?php echo $fetch_messages['message']; ?></span> </p>
         <p> date : <span><?php echo $fetch_messages['date_message']; ?></span> </p>
         <a href="admin_message.php?delete=<?php echo $fetch_messages['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete message</a>
      </div>
      <?php
         };
      ?>
   </div>

</section>









<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>