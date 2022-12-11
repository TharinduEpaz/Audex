<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/login.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/shop.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/advertiesmentDetails.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title><?php echo SITENAME; ?></title>
</head>
<body>
    <style>
        body{
            background-image: none;
            background-color: rgb(214, 214, 239);
        }
    </style> 
    <nav>
        <input type="checkbox" name="check" id="check" onchange="docheck()">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <img src="<?php echo URLROOT . '/public/img/image 1.png';?>" alt="logo">
        <ul>
            <li><a href="<?php echo URLROOT;?>/pages/index" class="nav_tags">Home</a></li>
            <li><a href="<?php echo URLROOT;?>/buyers/index" class="nav_tags">Shop</a></li>
            <li><a href="#" class="nav_tags">Sound Engineers</a></li>
            <li><a href="#" class="nav_tags">Events</a></li>
            <?php if(isset($_SESSION['user_id'])){
                echo '<div class="dropdown">';
                    echo '<button onclick="myFunction()" class="dropbtn">Hi '.$_SESSION['user_name']. ' &nbsp<i class="fa-solid fa-caret-down"></i></button>';
                    echo '<div id="myDropdown" class="dropdown-content">';
                        echo '<a href="'.URLROOT . '/sellers/advertisements" class="nav_tags">Profile</a>';
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
        <div class="ad-search" >
            <input type="search" name="search"> 
            <a href="#"><button type="submit" value="search" name="submit">Search</button></a>
        </div>
        <div class="container-main">
            <div class="container-product-img">
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($data['ad']->img); ?>" />
                <div class="container-product-description">
                    <h4>Product Description</h4>
                    <?php echo $data['ad']->p_description ; ?>
                </div>
            </div>
            <div class="container-product-attributes">
                <div class="title">
                    <h3><?php echo $data['ad']->product_title ; ?></h3>
                </div>
                <div class="category">
                    <h4><?php echo $data['ad']->product_category ; ?></h4>
                </div>
                <div class="condition">
                    <h4><?php echo $data['ad']->product_condition ; ?></h4>
                </div>
                <div class="brand">
                    <h4><?php echo $data['ad']->brand ; ?></h4>
                </div>            
                <div class="price">
                    <button ><?php echo 'RS.'.$data['ad']->price ; ?></button>
                </div>
                <button type="submit" class="msg">Message</button>
                <button onclick="addWatchList()" onload="checkWatchlist()" type="submit" class="watch">Add To Watchlist</button>
            </div>
        </div>
    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>