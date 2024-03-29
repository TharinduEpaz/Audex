<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/login.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/shop.css?id=123';?>">
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
            <li><a href="<?php echo URLROOT;?>/<?php echo $_SESSION['user_type'];?>s/index" class="nav_tags">Home</a></li>
            <li><a href="#" class="nav_tags">Shop</a></li>
            <li><a href="#" class="nav_tags">Sound Engineers</a></li>
            <li><a href="#" class="nav_tags">Events</a></li>
            <?php if(isset($_SESSION['user_id'])){
                echo '<div class="dropdown">';
                    echo '<button onclick="myFunction()" class="dropbtn">Hi '.$_SESSION['user_name']. ' &nbsp<i class="fa-solid fa-caret-down"></i></button>';
                    echo '<div id="myDropdown" class="dropdown-content">';
                        echo '<a href="'.URLROOT . '/'.$_SESSION['user_type'].'s/getProfile/'.$_SESSION['user_id'].'" class="nav_tags">Profile</a>';
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

    <div class="container" >
        <div class="ad-search_shop" >
            <input type="search" name="search" placeholder="Search for anything"> 
            <a href="#"><button type="submit" value="search" name="submit">Search</button></a>
        </div>



        <div class="header"  style="visibility:<?php echo $data['isEmpty'] == '1'? 'hidden':'visible'; ?> ;"  >
            <h1>Search Results</h1>
        </div>
        <!-- <div id="search-result-area">
            <?php if( $data['isEmpty'] != '1' ){ ?>

                <?php foreach($data['searchResults'] as $result) : ?>
                    <div class="container-ad">
                        <div class="container-img">
                            <img src="<?php echo URLROOT.'/public/uploads/'.$result->image1;?>" /> 
                        </div>
                        <div class="title">
                            <a href="<?php echo URLROOT . '/users/advertiesmentDetails/'.$result->product_id;?>">
                            <?php echo $result->product_title ; ?><br>
                            <?php echo 'RS:'. $result->price ; ?></a>
    
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php }; ?>
        </div> -->
        <div class="header">
            <h1>New Arrivals</h1>
        </div>
        <div class="container-data">
            <?php foreach($data['ads'] as $ads) : ?>
                <div class="container-ad">
                    <div class="container-img">
                        <img src="<?php echo URLROOT.'/public/uploads/'.$ads->image1;?>" /> 
                    </div>
                    <div class="title">
                        <a href="<?php echo URLROOT . '/users/advertiesmentDetails/'.$ads->product_id;?>">
                        <?php echo $ads->product_title ; ?><br>
                        <?php echo 'RS:'. $ads->price ; ?></a>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="header">
            <h1>Popular Engineers</h1>
        </div>
    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
<script src="<?php echo URLROOT . '/public/js/search.js'; ?>"></script>

</html>