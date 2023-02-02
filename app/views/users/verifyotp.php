<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/login.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/shop.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/verify.css?id=123';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/advertiesmentDetails.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Verify email</title>
</head>
<body>
    <nav>
        <input type="checkbox" name="check" id="check" onchange="docheck()">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <img src="<?php echo URLROOT . '/public/img/image 1.png';?>" alt="LOGO">
        <ul>
            <li><a href="<?php echo URLROOT;?>" class="nav_tags">Home</a></li>
            <li><a href="#" class="nav_tags">Shop</a></li>
            <li><a href="#" class="nav_tags">Sound Engineers</a></li>
            <li><a href="#" class="nav_tags">Events</a></li>
            <!-- <?php if(isset($_SESSION['user_id'])){
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
             ?> -->
        </ul>
    </nav>
    <div class="container_main">
        <div class="form">
            <h1>Verify OTP</h1>
                <!-- <?php echo '<pre>'; print_r($data); echo '</pre>';?> -->

            <?php
                echo '<div class="error">';
                echo '<div class="attempt">';

                echo 'Attempt '.$_SESSION['attempt'].'<br>';
                echo '</div>';

                if(!empty($data['otp_err'])   ){
                        echo '*'.$data['otp_err'].'<br>';
                }
                echo '</div>';

            ?>
            <form action="<?php echo URLROOT . '/users/verifyotp'?>" method="post">
                <label >OTP(sent to email address)</label>
                <div class="input">
                    <input type="number" name="otp"  class="otp1" placeholder="0" pattern="[0-9]{6}" onpaste="false" >                   
                </div>
                <div class="acceptT">
                    <input type="checkbox" name="acceptT" id="">
                    <label for="acceptT">I hereby accept the <a href="#">terms and conditions</a> of Audexlk</label>
                </div>
                <div class="submit">
                    <input type="submit" name="submit" value="Finish Registration" id="button">
                </div>
            </form>
        </div>
    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>