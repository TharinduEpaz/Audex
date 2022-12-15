<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/addadmin.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/seller_advertisement.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Advertisements</title>
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
                <a href="<?php echo URLROOT;?>/admins/profile"><i class="fas fa-qrcode"></i> <span>My Profile</span></a>
                <a class="current" href="<?php echo URLROOT;?>/admins/mangeuser"> <i class="fa fa-cog" aria-hidden="true"></i><span>Manage Users</span></a>
                <a href="#"> <i class="fas fa-bookmark" aria-hidden="true"></i><span>Flags</span></a>
                <a href="#"> <i class="fas fa-check-circle" aria-hidden="true"></i><span>Approvals</span></a>
                <a href="#"> <i class="fas fa-child"></i><span>Help</span></a>       
        </div>
    <div class="poster_advertisements">
        <div class="white-box">
            <h1>Add Admin</h1>
        <div class="info-settings">

<div class="info-titles">
    <span>First Name : </span>
    <span>Last Name : </span>
    <span>Email : </span>
    <span>Address Line 1 : </span>
    <span>Address Line 2 : </span>
    <span>Mobile : </span>
    <span>Password: </span>
    
</div>
<div class="info-items">
    <form action= "<?php echo URLROOT . '/admins/setDetails/' ?>" method="post">
         <input type="text" name="first_name"  placeholder="">
        <input type="text" name="second_name" placeholder="">
        <input type="email" name="email" placeholder="">
        <input type="text" name="address1" placeholder="">
        <input type="text" name="address2" placeholder="">
        <input type="number" name="mobile" placeholder="">
        <input type="password" name="password" placeholder="">
        
        <section class="buttons">

        <button id="save" type="submit">Save</button>
        <button id="cancel" type="reset" onclick="exit()">Cancel</button>
    </section>
    </form>
</div>
    
</div>
        
        </div>        
            
        

    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>