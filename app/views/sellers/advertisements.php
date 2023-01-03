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
        <img src="<?php echo URLROOT . '/public/img/image 1.png';?>" alt="logo">
        <ul>
        <li><a href="<?php echo URLROOT;?>/sellers/index" class="nav_tags">Home</a></li>
            <li><a href="<?php echo URLROOT;?>/buyers/shop" class="nav_tags">Shop</a></li>
            <li><a href="#" class="nav_tags">Sound Engineers</a></li>
            <li><a href="#" class="nav_tags">Events</a></li>
            
            <?php if(isset($_SESSION['user_id'])){
                echo '<div class="dropdown">';
                    echo '<button onclick="myFunction()" class="dropbtn">Hi '.$_SESSION['user_name']. ' &nbsp<i class="fa-solid fa-caret-down"></i></button>';
                    echo '<div id="myDropdown" class="dropdown-content">';
                        echo '<a href="'.URLROOT . '/sellers/getProfile/'.$_SESSION['user_id']. ' " class="nav_tags">Profile</a>';
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
                <a href="#"><i class="fas fa-qrcode"></i> <span>Dashboard</span></a>
                <a href="<?php echo URLROOT.'/sellers/getProfile/'.$_SESSION['user_id']?>"> <i class="fa fa-cog" aria-hidden="true"></i><span>Profile Settings</span></a>
                <a class="current" href="<?php echo URLROOT;?>/sellers/advertisements"> <i class="fa fa-ad" aria-hidden="true"></i><span>Advertisements</span></a>
                <a href="<?php echo URLROOT;?>/sellers/advertise"><i class="fa-solid fa-dollar-sign" aria-hidden="true"></i><span>Advertise</span></a>
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
            <?php foreach($data['advertisements'] as $advertisement): ?>
            <div class="advertisements">
                <div class="image">
                    <img src="<?php echo 'data:image/jpg;charset=utf8;base64,'.base64_encode($advertisement->image1);?>" alt="photo">
                </div>
                <p class="one"><?php echo $advertisement->product_title;?></p>
                <p class="two"><?php echo $advertisement->product_type;?></p>
                <p class="three">N/A</p>
                <p class="four">Rs.<?php echo $advertisement->price;?></p>
                <a class="five" href="<?php echo URLROOT;?>/sellers/edit_advertisement/<?php echo $advertisement->product_id;?>">Edit</a>
                <a class="six" href="<?php echo URLROOT;?>/sellers/advertisement/<?php echo $advertisement->product_id;?>">Preview</a>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>