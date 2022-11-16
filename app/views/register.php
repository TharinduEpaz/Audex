<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/verify.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Register</title>
</head>
<body>
    <nav>
        <input type="checkbox" name="check" id="check" onchange="docheck()">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <img src="<?php echo URLROOT . '/public/img/image 1.png';?>" alt="logo">
        <ul>
            <li><a href="index" class="nav_tags">Home</a></li>
            <li><a href="#" class="nav_tags">Shop</a></li>
            <li><a href="#" class="nav_tags">Sound Engineers</a></li>
            <li><a href="#" class="nav_tags">Events</a></li>
            <li><a href="login" class="nav_tags">Login</a></li>
        </ul>
    </nav>
    <div class="container">
        <div id="forms" class="form">
            <h1>Register</h1>
            <!-- <?php
                if(!empty($errors)){
                    echo '<div class="error">';
                    foreach($errors as $error){
                        echo '-'.$error.'<br>';
                    }
                    echo '</div>';
                }

            ?> -->
            <form action="register.php" method="post">
                <div class="input">
                    <label for="">First Name</label>
                    <input type="text" name="fname" placeholder="First Name" required>
                </div>
                <div class="input">
                    <label for="">Last Name</label>
                    <input type="text" name="lname" placeholder="Last Name" required>
                </div>
                <div class="input">
                    <label for="">Email</label>
                    <input type="text" name="email" placeholder="Email" required>
                </div>
                <div class="input">
                    <label for="">Mobile Phone Number</label>
                    <input type="phone" name="phone" placeholder="0#########" required pattern="[0-9]{10}">
                </div>
                <div class="input">
                    <label for="type">Account type</label>
                        <select name="type" id="type">
                          <option value="buyer">Buyer</option>
                          <option value="seller">Seller</option>
                          <option value="service_provider">Service Provider</option>                         
                        </select>
                </div>
                <div class="input">
                    <label for="">Password</label>
                    <input type="password" name="password"  required>
                </div>
                <div class="submit">
                    <input type="submit" name="submit" value="Next" class="button">
                </div>
            </form>
        </div>
    </div>
</body>
<script src="../js/form.js"></script>
</html>
<!-- Closing the connection