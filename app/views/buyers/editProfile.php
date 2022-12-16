<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/seller_advertisement.css';?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Profile</title>
</head>
<body>
    <nav>
        <input type="checkbox" name="check" id="check" onchange="docheck()">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <img src="<?php echo URLROOT . '/public/img/image 1.png';?>" alt="logo">
        <ul>
            <li><a href="<?php echo URLROOT;?>/buyers/index" class="nav_tags">Home</a></li>
            <li><a href="<?php echo URLROOT;?>/buyers/shop" class="nav_tags">Shop</a></li>
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
    <div class="container">
        <div class="sidebar">
            <a href="#" class="current"><i class="fas fa-address-card"></i> <span>My Profile</span></a>
            <a href="<?php echo URLROOT . '/buyers/watchlist';?>"> <i class="far fa-calendar-check" aria-hidden="true"></i><span>Watch List</span></a>
            <a href="#"> <i class="fa fa-comments-o" aria-hidden="true"></i><span>Feedback</span></a>
            <a href="#"> <i class="fa fa-thumbs-up" aria-hidden="true"></i><span>Reactions</span></a>
            <a href="messages.php"> <i class="fa fa-envelope"></i><span>Messages</span></a>       
        </div>
        <div class="poster_advertisements">
            <form action="" method="POST" class="form-display-data">
                <div class="form-display"> 
                    <h1>Edit Profile Details</h1>
                    <div class="form-data-area">
                        <label for="first_name">First Name:<sup>*</sup></label>
                        <input type="text" name="first_name" value="<?php echo $data['first_name']; ?>" class="<?php echo (!empty($data['first_name_err'])) ? 'invalid' : '' ; ?>" >
                    </div>
                    <div class="form-data-area">
                        <label for="second_name">Second Name:</label>
                        <input type="text" name="second_name" value="<?php echo $data['second_name']; ?>" class="<?php echo (!empty($data['second_name_err'])) ? 'invalid' : '' ; ?>">
                    </div>
                    <div class="form-data-area">
                        <label for="email">Email:</label>
                        <input type="text" name="email" value="<?php echo $data['email']; ?>" disabled>
                    </div>
                    <div class="form-data-area">
                        <label for="address1">Address Line 1:<sup>*</sup></label>
                        <input type="text" name="address1" value="<?php echo $data['address1']; ?>" class="<?php echo (!empty($data['address1_err'])) ? 'invalid' : '' ; ?>" >
                    </div>
                    <div class="form-data-area">
                        <label for="address2">Address Line 1:</label>
                        <input type="text" name="address2" value="<?php echo $data['address2']; ?>" class="<?php echo (!empty($data['address2_err'])) ? 'invalid' : '' ; ?>" >
                    </div>
                    <div class="form-data-area">
                        <label for="phone_number">Phone Number:<sup>*</sup></label>
                        <input type="text" name="phone_number" value="<?php echo $data['phone_number']; ?>" class="<?php echo (!empty($data['phone_number_err'])) ? 'invalid' : '' ; ?>" >
                    </div>  
                </div>
                <input type="submit"  value="Save" id="edit-button"  >
            </form>   
           
        </div>
    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>