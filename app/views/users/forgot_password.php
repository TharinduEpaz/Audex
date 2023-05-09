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
    <title>Forgot Password</title>
</head>
<body>
<?php require_once APPROOT . '/views/users/navbar.php';?>
    
    <div class="container_main">

        <div class="form" style="margin-top: 20vh;">
            <h1>Forgot Password</h1>
                <!-- <?php echo '<pre>'; print_r($data); echo '</pre>';?> -->

            
            <form action="<?php echo URLROOT . '/users/forgot_password/'.$data['id'].'/'.$data['time'].'/'.$data['password']?>" method="post">
            
                <?php
                
                if(!empty($data['new_password_err'])   ){
                    echo '<div class="error">';
                        echo '*'.$data['new_password_err'].'<br>';
                    echo '</div>';
                }

            ?>
                <label >Enter New Password</label>
                <div class="input">
                    <input type="password" name="new_password"  class="password" value="<?php echo $data['new_password']?>">                   
                </div>
                <?php
                
                if(!empty($data['confirm_password_err'])   ){
                    echo '<div class="error">';
                        echo '*'.$data['confirm_password_err'].'<br>';
                    echo '</div>';
                }

            ?>
                <label >Confirm New Password</label>
                <div class="input">
                    <input type="password" name="newc_password"  class="password" value="<?php echo $data['confirm_passwd']?>">                   
                </div>
                <div class="submit">
                    <input type="submit" name="submit" value="Change Password" id="button">
                </div>
            </form>
        </div>
    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>