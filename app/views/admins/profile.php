<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/profilebody.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/seller_advertisement.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Admin Profile</title>
</head>
<body>
<?php require_once APPROOT . '/views/admins/navbar.php';?>

    <div class="container">
    <?php require_once APPROOT . '/views/admins/sidebar.php';?>        

        <div class="poster_advertisements">
            <h1>Profile Details</h1>
            
            <div class="w3-container">
      
    <div class="rightbox">
        <div class="profile">
        
          <h2>Full Name</h2>
          <p><?php echo $data['details']->first_name ?> <button class="btn">update</button></p>
          <h2>Mobile Number</h2>
          <p><?php echo $data['details']->phone_number ?></p>
          <h2>Address</h2>
          <p><?php echo $data['details']->address1 ?></p>
          <h2>Email</h2>
          <p><?php echo $data['details']->email ?><button class="btn">update</button></p>
          <h2>Password</h2>
          <p>******** <button class="btn">update</button></p>
        </div>
      </div>
    </div>

            
        

    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
<script>
   //keeping the sidebar button clicked at the page
   link = document.querySelector('#rpofile');
    link.style.background = "#E5E9F7";
    link.style.color = "red";
    link.style.fontWeight = "800";
</script>
</html>