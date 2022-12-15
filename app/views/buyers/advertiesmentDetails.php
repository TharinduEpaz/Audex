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
        body .container{
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
            <li><a href="<?php echo URLROOT;?>/buyers/index" class="nav_tags">Home</a></li>
            <li><a href="<?php echo URLROOT;?>/buyers/index" class="nav_tags">Shop</a></li>
            <li><a href="#" class="nav_tags">Sound Engineers</a></li>
            <li><a href="#" class="nav_tags">Events</a></li>
            <?php if(isset($_SESSION['user_id'])){
                echo '<div class="dropdown">';
                    echo '<button onclick="myFunction()" class="dropbtn">Hi '.$_SESSION['user_name']. ' &nbsp<i class="fa-solid fa-caret-down"></i></button>';
                    echo '<div id="myDropdown" class="dropdown-content">';
                        echo '<a href="'.URLROOT .'/'.$_SESSION['user_type'].'s/getProfile/'.$_SESSION['user_id'].'" class="nav_tags">Profile</a>';
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
        <!-- <div class="ad-search" >
            <input type="search" name="search"> 
            <a href="#"><button type="submit" value="search" name="submit">Search</button></a>
        </div> -->
        <div class="container-main">
            <div class="container-product-img">
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($data['ad']->image1); ?>" />
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
                <?php if($_SESSION['user_type'] == 'buyer' || $_SESSION['user_type'] == 'service_provider'){
                    echo '<button type="submit" class="msg">Message</button>';
                }
                ?>

                <form id="add_watch_list_form" method="POST">
                    <!-- if user is logged in then he have a _SESSION, if not user id value will be 0  -->
                    <?php if($_SESSION['user_type'] == 'buyer' || $_SESSION['user_type'] == 'service_provider'){
                        echo '<input type="text" name="user_type" value="buyer" hidden>';
                        echo '<input type="text" name ="user_id" value= " <?php echo (isset($_SESSION[\'user_id\']) ? $_SESSION[\'user_id\'] : 0) ; ?>" hidden>';
                        echo '<input type="text" name="product_id" value="<?php echo $data[\'ad\']->product_id ; ?>" hidden >';
                        echo '<input type="submit" value="Add To Watchlist" class="watch" id="add-to-watchlist">';

                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>