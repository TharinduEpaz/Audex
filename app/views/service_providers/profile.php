<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css?id=1234';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/service_provider.css?id=1234';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/style.css?id=1234';?>">
    
    
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
        <li><a href="<?php echo URLROOT .'/pages/index'?>" class="nav_tags">Home</a></li>
        <li><a href="#" class="nav_tags">Shop</a></li>
        <li><a href="#" class="nav_tags">Sound Engineers</a></li>
        <li><a href="#" class="nav_tags">Events</a></li>
        <li><a href="#" class="nav_tags">Login</a></li>
    </ul>
</nav>
</div>
    <div class="sidebar">
        <a href="#"><i class="fas fa-qrcode" id="dashboard"></i> <span>Dashboard</span></a>
        <a href="<?php echo URLROOT . '/service_providers/profile';?>" id="profile-settings"> <i class="fa fa-cog" aria-hidden="true"></i><span>Profile</span></a>
        <a href="#" id="advertisements"> <i class="fa fa-ad" aria-hidden="true"></i><span>Advertisements</span></a>
        <a href="#" id="calender"> <i class="fa fa-calendar" aria-hidden="true"></i><span>Calender</span></a>
        <a href="#" id="messages"> <i class="fa fa-comments"></i><span>Messages</span></a>       
    </div>

    <div class="service-provider-profile">
        <div class="white-box">
        <div class="profile-title">
            <div class="profile-pic"><i class="far fa-user fa-7x"></i></div>
            <div class="name-rating">
                <div class="name"><p id="Name">Mevan Dissanayaka</p><p id="profession">Professional Sound Engineer</p></div>
                <div class="rating"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></div>
            </div>
        </div>
        <div class="profile-info">
            <div class="description"><h1>What is Lorem Ipsum?</h1>
                <p>
                    Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
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
                    <span>Mevan</span>
                    <span>Dissanayake</span>
                    <span>Mevan@gmail.com</span>
                    <span>No 53, Sahanpura, Bellapitiya</span>
                    <span>Horana</span>
                    <span>0704653462</span>
                    <span>Sound Engineer</span>
                    <span>MBS BA</span>
                    <span>Best Perfomance Award GR 2022</span>
                </div>
            </div>
            
        </div>
        <button id = "edit-settings">  <a href="<?php echo URLROOT .'/service_providers/settings'?>"> Edit Settings</a></button>
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

        //keeping the sidebar button clicked at the page

        link = document.querySelector('#profile-settings');
        link.style.background = "#E5E9F7";
        link.style.color = "red";

    </script>

</body>
</html>