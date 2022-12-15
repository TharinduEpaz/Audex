<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/login.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Home</title>
</head>
<body>
    <nav>
        <input type="checkbox" name="check" id="check" onchange="docheck()">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <img src="<?php echo URLROOT . '/public/img/image 1.png';?>" alt="logo">
        <ul>
            <li><a href="#" class="nav_tags">Home</a></li>
            <li><a href="<?php echo URLROOT.'/buyers/shop/'; ?>" class="nav_tags">Shop</a></li>
            <li><a href="#" class="nav_tags">Sound Engineers</a></li>
            <li><a href="#" class="nav_tags">Events</a></li>
            <?php if(isset($_SESSION['user_id'])){
                echo '<div class="dropdown">';
                    echo '<button onclick="myFunction()" class="dropbtn">Hi '.$_SESSION['user_name']. ' &nbsp<i class="fa-solid fa-caret-down"></i></button>';
                    echo '<div id="myDropdown" class="dropdown-content">';
                        echo '<a href="'.URLROOT . '/buyers/getProfile/'.$_SESSION['user_id'].'" class="nav_tags">Profile</a>';
                        echo '<a href="'.URLROOT . '/'.$_SESSION['user_type'].'s/watchlist/'.$_SESSION['user_id'].'" class="nav_tags">Watchlist</a>';
                        echo '<a href="#" class="nav_tags">Feedback</a>';
                        echo '<a href="#" class="nav_tags">Reactions</a>';
                        echo '<a href="#" class="nav_tags">Messages</a>';
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
    <div class="container_main" id="container">
    <div class="search">
            <div class="heading">
                <h1>Find the best <br>Audio Equipment</h1>
            </div>
            <div class="search-bar">
                <input type="search" name="search-item" placeholder="|">
                <button type="button" class="btn-search"><img src="<?php echo URLROOT . '/public/img/icons/bxs_search-alt-2.png';?>" alt="search"></input></button>
            </div>
        </div>
        <div class="explore">
            <div class="explore-line">
                <h3>Explore Popular Categories</h3>
            </div>
            <div class="explore-btn">
                <button><img src="<?php echo URLROOT . '/public/img/icons/bi_speaker.png';?>" alt="sp"></button>
                <button><img src="<?php echo URLROOT . '/public/img/icons/bxs_guitar-amp.png';?>" alt="am"></button>
                <button><img src="<?php echo URLROOT . '/public/img/icons/nimbus_guitar.png';?>" alt="gu"></button>
                <button><img src="<?php echo URLROOT . '/public/img/icons/jam_dj.png';?>" alt="dj"></button>
                <button><img src="<?php echo URLROOT . '/public/img/icons/Group.png';?>" alt="grp"></button>
            </div>
        </div>
    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>