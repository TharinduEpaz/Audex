<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css?id=1245';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/service_provider.css?id=124';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/style.css?id=1245';?>">
    
    
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
                        echo '<a href="'.URLROOT . '/sellers/getProfile/'.$_SESSION['user_id'].'" class="nav_tags">Profile</a>';
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
        <a href="#" id="advertisements"> <i class="fa fa-ad" aria-hidden="true"></i><span>Feed</span></a>
        <a href="#" id="calender"> <i class="fa fa-calendar" aria-hidden="true"></i><span>Calender</span></a>
        <a href="#" id="messages"> <i class="fa fa-comments"></i><span>Messages</span></a>       
    </div>

    <div class="service-provider-profile">
        <div class="white-box">
        <div class="profile-title">
            <div class="profile-pic"><i class="far fa-user fa-7x"></i></div>
            <div class="name-rating">
                <div class="name"><p id="Name"><?php echo $data['details']->first_name . ' ' . $data['details']->second_name ?></p><p id="profession"><?php echo $data['details']->profession?></p></div>
                <div class="rating"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></div>
            </div>
        </div>
        <div class="profile-info">
            <div class="description"><h1>About me</h1>
                <p> <?php if($data['details']->description == ''){
                    echo '<span class="red-alert">please complete your profile in the profile settings section</span>';
                }
                else{
                    echo $data['details']->description;
                } ?>
                    
</p></div>
            <div class="info-blocks">
                <div class="info-titles">
                    <span>First Name : </span>
                    <span>Last Name : </span>
                    <span>Email : </span>
                    <span>Address Line 1 : </span>
                    <span>Address Line 2 : </span>
                    <span>Mobile : </span>
                    <span>Profession : </span>
                    <span>Qualifications : </span>
                    <span>Achivements : </span>
                </div>
                <div class="info-items">
                    <span><?php echo $data['details']->first_name ?></span>
                    <span><?php echo $data['details']->second_name ?></span>
                    <span><?php echo $data['details']->email ?></span>
                    <span><?php echo $data['details']->address_line_one ?></span>
                    <span><?php echo $data['details']->address_line_two ?></span>
                    <span><?php echo $data['details']->mobile ?></span>
                    <span><?php echo $data['details']->profession ?></span>
                    <span><?php echo $data['details']->qualifications ?></span>
                    <span><?php echo $data['details']->achievements?></span>
                </div>
            </div>
            
        </div>
         <a href="<?php echo URLROOT .'/service_providers/settings'?>" class="btn"> Edit Settings</a></button>
        <h2>Events</h2>
        <div class="events">
            
            <div class="event"></div>
            <div class="event"></div>
            <div class="event"></div>
            <div class="event"></div>
        </div>
        </div>

        

    </div>

    <script>
        /* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }
    
    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }


        //keeping the sidebar button clicked at the page

        link = document.querySelector('#profile-settings');
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