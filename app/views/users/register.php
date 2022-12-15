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
            <li><a href="<?php echo URLROOT;?>" class="nav_tags">Home</a></li>
            <li><a href="#" class="nav_tags">Shop</a></li>
            <li><a href="#" class="nav_tags">Sound Engineers</a></li>
            <li><a href="#" class="nav_tags">Events</a></li>
            <li><a href="<?php echo URLROOT;?>/users/login" class="nav_tags">Login</a></li>
        </ul>
    </nav>
    <div class="container-main">
        <div id="forms" class="form">
            <h1>Register</h1>
            <?php
                if(!empty($data['first_name_err']) || !empty($data['second_name_err']) || !empty($data['email_err']) || !empty($data['phone_err']) || !empty($data['password_err'])  ){
                    echo '<div class="error">';
                        if(!empty($data['first_name_err'])){
                            echo '*'.$data['first_name_err'].'<br>';
                        }
                        if(!empty($data['second_name_err'])){
                            echo '*'.$data['second_name_err'].'<br>';
                        }
                        if(!empty($data['email_err'])){
                            echo '*'.$data['email_err'].'<br>';
                        }
                        if(!empty($data['phone_err'])){
                            echo '*'.$data['phone_err'].'<br>';
                        }
                        if(!empty($data['password_err'])){
                            echo '*'.$data['password_err'].'<br>';
                        }

                    echo '</div>';
                }

            ?>
            <form action="<?php echo URLROOT . '/users/register';?>" method="post">
                <div class="input">
                    <label for="">First Name</label>
                    <input type="text" name="fname" placeholder="First Name" value="<?php echo $data['first_name']?>" >
                    <!-- <?php
                        echo '<div class="error">';
                        if(!empty($data['first_name_err'])){
                                echo '*'.$data['first_name_err'].'<br>';
                        }
                        echo '</div>';
                    ?> -->
                </div>
                <div class="input">
                    <label for="">Last Name</label>
                    <input type="text" name="lname" placeholder="Last Name"  value="<?php echo $data['second_name']?>" >
                    <!-- <?php
                        echo '<div class="error">';
                        if(!empty($data['second_name_err'])){
                            echo '*'.$data['second_name_err'].'<br>';
                        }
                        echo '</div>';
                    ?> -->
                </div>
                <div class="input">
                    <label for="">Email</label>
                    <input type="text" name="email" placeholder="Email" value="<?php echo $data['email']?>" >
                    <!-- <?php
                        echo '<div class="error">';
                        if(!empty($data['email_err'])){
                            echo '*'.$data['email_err'].'<br>';
                        }
                        echo '</div>';
                    ?>-->
                </div> 
                <div class="input">
                    <label for="">Mobile Phone Number</label>
                    <input type="phone" name="phone" placeholder="0#########" value="<?php echo $data['phone']?>"  pattern="[0-9]{10}">
                    <!-- <?php
                        echo '<div class="error">';
                        if(!empty($data['phone_err'])){
                            echo '*'.$data['phone_err'].'<br>';
                        }
                        echo '</div>';
                    ?> -->
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
                    <input type="password" name="password"  value="<?php echo $data['password']?>" >
                    <!-- <?php
                        echo '<div class="error">';
                        if(!empty($data['password_err'])){
                            echo '*'.$data['password_err'].'<br>';
                        }
                        echo '</div>';
                    ?> -->
                </div>
                <div class="submit">
                    <input type="submit" name="submit" value="Next" class="button">
                </div>
            </form>
        </div>
    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>
<!-- Closing the connection