<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
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
        <img src="../img/image 1.png" alt="">
        <ul>
            <li><a href="<?php echo URLROOT;?>/pages/index" class="nav_tags">Home</a></li>
            <li><a href="#" class="nav_tags">Shop</a></li>
            <li><a href="#" class="nav_tags">Sound Engineers</a></li>
            <li><a href="#" class="nav_tags">Events</a></li>
            <li><a href="<?php echo URLROOT;?>/users/logout" class="nav_tags">Hi <?php echo $_SESSION['user_name']?></a></li>
        </ul>
    </nav>
    <div class="container">
        <div class="sidebar">
                <a href="#"><i class="fas fa-qrcode"></i> <span>Dashboard</span></a>
                <a href="#"> <i class="fa fa-cog" aria-hidden="true"></i><span>Profile Settings</span></a>
                <a class="current" href="#"> <i class="fa fa-ad" aria-hidden="true"></i><span>Advertisements</span></a>
                <a href="sell_item.php"> <i class="fa-solid fa-dollar-sign" aria-hidden="true"></i><span>Sell Item</span></a>
                <a href="#"> <i class="fa fa-comments"></i><span>Messages</span></a>       
        </div>
        <div class="poster_advertisements">
            <h1>Posted Advertisements</h1>
            <div class="header">
                <div class="image">
                    <img  class="two" src="" alt="photo">
                </div>
                <p class="one">Title</p>
                <p class="two">Format</p>
                <p class="three">Bids/Offers</p>
                <p class="four">Price</p>
                <p class="five">Edit</p>
                <p class="six">Priview</p>

            </div>
            <!-- <div class="advertisements"> -->
                <!-- <img class="two" src="../img/Rectangle 100.png" alt="photo">
                <div class="image">
                    <img src="../img/Rectangle 100.png" alt="photo">
                </div>
                <p class="one">Title</p>
                <p class="two">Format</p>
                <p class="three">Bids/Offers</p>
                <p class="four">Price</p>
                <a class="five" href="#">Edit</a>
                <a class="six" href="#">Preview</a> -->
                <!-- <?php echo $product_list;?> -->
            <!-- </div> -->
        </div>

    </div>
</body>
<script src="../js/form.js"></script>
</html>