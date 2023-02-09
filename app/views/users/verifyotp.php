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
<?php require_once APPROOT . '/views/users/navbar.php';?>
    
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
                if(!empty($data['accept_err'])   ){
                    echo '*'.$data['accept_err'].'<br>';
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