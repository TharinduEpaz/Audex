<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css?id=1233'; ?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/login.css'; ?>">
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
        <img src="<?php echo URLROOT . '/public/img/image 1.png'; ?>" alt="logo">
        <ul>
            <li><a href="<?php echo URLROOT . '/pages/index'; ?>" class="nav_tags">Home</a></li>
            <li><a href="<?php echo URLROOT . '/users/shop'; ?>" class="nav_tags">Shop</a></li>
            <li><a href="#" class="nav_tags">Sound Engineers</a></li>
            <li><a href="#" class="nav_tags">Events</a></li>
            <?php
            if (isset($_SESSION['user_id'])) {
                echo '<div class="dropdown">';
                    echo '<button onclick="myFunction()" class="dropbtn">Hi '.$_SESSION['user_name']. ' &nbsp<i class="fa-solid fa-caret-down"></i></button>';
                    echo '<div id="myDropdown" class="dropdown-content">';
                        if ($_SESSION['user_type']=='seller') {
                            echo '<a href="'.URLROOT . '/sellers/advertisements" class="nav_tags">Profile</a>';
                        }
                        if ($_SESSION['user_type']=='buyer') {
                            echo '<a href="'.URLROOT . '/buyers/getProfile/'.$_SESSION['user_id'].'" class="nav_tags">Profile</a>';
                        }
                        if ($_SESSION['user_type']=='service_provider') {
                            echo '<a href="'.URLROOT . '/service_providers/getProfile/'.$_SESSION['user_id'].'" class="nav_tags">Profile</a>';
                        }
                        if ($_SESSION['user_type']=='admin') {
                            echo '<a href="'.URLROOT . '/admins/profile/'.$_SESSION['user_id'].'" class="nav_tags">Profile</a>';
                        }
                        echo '<a href="'.URLROOT . '/users/logout" class="nav_tags">Logout</a>';
                    echo '</div>';
                echo '</div> ';
            }
            else{
            echo '<li><a href="' . URLROOT . '/users/login" class="nav_tags">Login</a></li>';
            echo '<li><a href="' . URLROOT . '/users/register" class="nav_tags">Signup</a></li>';
            }
            ?>

        </ul>
    </nav>
    <div class="container_main">
        <div class="search">
            <div class="heading">
                <h1>Find the best <br>Audio Equipment</h1>
            </div>
            <div class="search-bar">
                <input type="search" name="search-item" placeholder="|">
                <button type="button" class="btn-search"><img
                        src="<?php echo URLROOT . '/public/img/icons/bxs_search-alt-2.png'; ?>"
                        alt="search"></input></button>
            </div>
        </div>
        <div class="explore">
            <div class="explore-line">
                <h3>Explore Popular Categories</h3>
            </div>
            <div class="explore-btn">
                <button><img src="<?php echo URLROOT . '/public/img/icons/bi_speaker.png'; ?>" alt="sp"
                        class="home-icon"></button>
                <button><img src="<?php echo URLROOT . '/public/img/icons/bxs_guitar-amp.png'; ?>" alt="am"
                        class="home-icon"></button>
                <button><img src="<?php echo URLROOT . '/public/img/icons/nimbus_guitar.png'; ?>" alt="gu"
                        class="home-icon"></button>
                <button><img src="<?php echo URLROOT . '/public/img/icons/jam_dj.png'; ?>" alt="dj"
                        class="home-icon"></button>
                <button><img src="<?php echo URLROOT . '/public/img/icons/Group.png'; ?>" alt="grp"
                        class="home-icon"></button>
            </div>
        </div>
    </div>
    <div class="hotest_auctions">

        <p id="title">Hotest Auctions</p>
        <div class="auction auction1"><img src="" alt=""></div>
        <div class="auction auction2"></div>
        <div class="auction auction3"></div>
        <div class="auction auction4"></div>
        <div class="auction auction5"></div>
        <div class="auction auction6"></div>

    </div>
    <div class="popular_engineers">
        <p id="title">Popular Engineers</p>
        <div class="engineer engineer1"></div>
        <div class="engineer engineer2"></div>
        <div class="engineer engineer3"></div>
        <div class="engineer engineer4"></div>
        <div class="engineer engineer5"></div>
        <div class="engineer engineer6"></div>

    </div>
    <div class="upcoming_events">

        <p id="title">Upcoming Events</p>
        <div class="event event1"></div>
        <div class="event event2"></div>
        <div class="event event3"></div>
        <div class="event event4"></div>
        <div class="event event5"></div>
        <div class="event event6"></div>
    </div>
    <div class="footer">
        <div class="section1">
            <h1>About us</h1><br><br>
            <p>Audexlk is an emarket place for sound equipments. We plan to build a marketplace where people can find equipment and professional engineers. We plan to break the boundaries of professional audio equipment renting. Our vision and business model are going towards achieving the same goal.  </p>
       
        </div>
        <div class="section2">
        <h1>Contact us</h1><br><br>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
       
        </div>

    </div>





</body>
<script src="<?php echo URLROOT . '/public/js/form.js'; ?>"></script>

</html>