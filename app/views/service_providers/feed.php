<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css?id=125';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/service_provider.css?id=145';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/style.css?id=145';?>">
  
    
    
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Audex</title>
</head>
<body>
<div class="navbar">
<nav>
    <input type="checkbox" name="check" id="check" onchange="docheck()">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
    <img src="../img/image 1.png" alt="">
    <ul>
        <li><a href="<?php echo URLROOT .'/service_providers/index'?>" class="nav_tags">Home</a></li>
        <li><a href="#" class="nav_tags">Shop</a></li>
        <li><a href="#" class="nav_tags">Sound Engineers</a></li>
        <li><a href="#" class="nav_tags">Events</a></li>
        <?php if(isset($_SESSION['user_id'])){
                echo '<div class="dropdown">';
                    echo '<button onclick="myFunction()" class="dropbtn">Hi '.$_SESSION['user_name']. ' &nbsp<i class="fa-solid fa-caret-down"></i></button>';
                    echo '<div id="myDropdown" class="dropdown-content">';
                        echo '<a href="'.URLROOT . '/service_providers/profile" class="nav_tags">Profile</a>';
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
</div>
    <div class="sidebar">
        <a href="#"><i class="fas fa-qrcode" id="dashboard"></i> <span>Dashboard</span></a>
        <a href="<?php echo URLROOT . '/service_providers/profile';?>" id="profile-settings"> <i class="fa fa-cog" aria-hidden="true"></i><span>Profile</span></a>
        <a href="<?php echo URLROOT .'/service_providers/index'?>" id="feed"> <i class="fa fa-ad" aria-hidden="true"></i><span>Feed</span></a>
        <a href="#" id="calender"> <i class="fa fa-calendar" aria-hidden="true"></i><span>Calender</span></a>
        <a href="#" id="messages"> <i class="fa fa-comments"></i><span>Messages</span></a>       
    </div>

    <div class="service-provider-profile">
        <div class="white-box">

        <div class="feed_items_container">
            <div class="feed-item item1"></div>
            <div class="feed-item item2"></div>
            <div class="feed-item item3"></div>
            <div class="feed-item item4"></div>
            <div class="feed-item item5"></div>
            <div class="feed-item item6"></div>
            

        </div>
        <div class="button-section">
            <button>Create New</button>

        </div>
        
        </div>

        

    </div>

    <script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>

    <script>

        //keeping the sidebar button clicked at the page

        link = document.querySelector('#feed');
        link.style.background = "#E5E9F7";
        link.style.color = "red";

        error = document.querySelector('.red-alert');
        error.style.color = "#FF0000"

        editButton = document.querySelector('.btn');

        if (error) {

            editButton.style.animation = "alert 2s ease 0s infinite normal forwards"
            editButton.style.color = "#FF0000"
            editButton.style.background = "#E5E9F7"
            
        }

    </script>

</body>
</html>