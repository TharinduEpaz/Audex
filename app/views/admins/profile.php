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
    <nav>
        <input type="checkbox" name="check" id="check" onchange="docheck()">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <img src="<?php echo URLROOT . '/public/img/image 1.png';?>" alt="">
        <ul>
            <li><a href="<?php echo URLROOT;?>/admins/index" class="nav_tags">Home</a></li>
            <li><a href="#" class="nav_tags">Shop</a></li>
            <li><a href="#" class="nav_tags">Sound Engineers</a></li>
            <li><a href="#" class="nav_tags">Events</a></li>
            
            <?php if(isset($_SESSION['user_id'])){
                echo '<div class="dropdown">';
                    echo '<button onclick="myFunction()" class="dropbtn">Hi '.$_SESSION['user_name']. ' &nbsp<i class="fa-solid fa-caret-down"></i></button>';
                    echo '<div id="myDropdown" class="dropdown-content">';
                        echo '<a href="'.URLROOT . '/admins/profile" class="nav_tags">Profile</a>';
                        echo '<a href="'.URLROOT . '/users/logout" class="nav_tags">Logout</a>';
                    echo '</div>';
                echo '</div> ';
            }
            else{
                echo '<li><a href="'.URLROOT . '/users/login" class="nav_tags">Login</a></li>';
                echo '<li><a href="'.URLROOT.'/users/register" class="nav_tags">Signup</a></li>';
            }
             ?>
        </ul>
    </nav>
    <div class="container">
        <div class="sidebar">
                <a class="current" href="<?php echo URLROOT;?>/admins/profile"><i class="fas fa-qrcode"></i> <span>My Profile</span></a>
                <a href="<?php echo URLROOT;?>/admins/manageuser"> <i class="fa fa-cog" aria-hidden="true"></i><span>Manage Users</span></a>
                <a href="#"> <i class="fas fa-bookmark" aria-hidden="true"></i><span>Flags</span></a>
                <a href="#"> <i class="fas fa-check-circle" aria-hidden="true"></i><span>Approvals</span></a>
                <a href="#"> <i class="fas fa-child"></i><span>Help</span></a>       
        </div>
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
</html>