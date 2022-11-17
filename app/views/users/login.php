<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/login.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body>
    <nav>
        <input type="checkbox" name="check" id="check" onchange="docheck()">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <img src="<?php echo URLROOT . '/public/img/image 1.png';?>" alt="">
        <ul>
            <li><a href="home.php" class="nav_tags">Home</a></li>
            <li><a href="#" class="nav_tags">Shop</a></li>
            <li><a href="#" class="nav_tags">Sound Engineers</a></li>
            <li><a href="#" class="nav_tags">Events</a></li>
            <li><a href="#" class="nav_tags">Login</a></li>
        </ul>
    </nav>
    <div class="container">
        <div id="forms" class="form">
            <h1>Login</h1>
            <?php
                if(!empty($data['email_err']) || !empty($data['password_err'])  ){
                    echo '<div class="error">';
                        if(!empty($data['email_err'])){
                            echo '*'.$data['email_err'].'<br>';
                        }
                        if(!empty($data['password_err'])){
                            echo '*'.$data['password_err'].'<br>';
                        }

                    echo '</div>';
                }

            ?>

            <form action="<?php echo URLROOT . '/users/login';?>" method="post" >
                <div class="input">
                    <label for="">Email</label>
                    <input type="email" name="email" placeholder="Enter email" value="<?php echo $data['email']?>" >
                </div>
                <div class="input">
                    <label for="">Password</label>
                    <input type="password" name="password" placeholder="Enter password" value="<?php echo $data['password']?>" >
                </div>
                <div class="reg_now">
                    <p>Do not have an account?&nbsp&nbsp</p>
                    <a href="<?php echo URLROOT . '/users/register';?>"> Register now</a>
                </div>
                <a href="register.html" class="forgot">Forgot password</a>
                <div class="submit">
                    <input type="submit" name="submit" value="Login" class="button">
                </div>
            </form>
        </div>
    </div>
</body>
<script src="../js/form.js"></script>
</html>
<!-- Closing the connection