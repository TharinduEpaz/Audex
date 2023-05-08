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
    <title>Change Phone Number</title>
</head>
<body>
<?php require_once APPROOT . '/views/users/navbar.php';?>
    
    <div class="container_main">
        <div class="form" style="margin-top: 30vh;">
            <h1>Change/Add Phone Number</h1>
                <!-- <?php echo '<pre>'; print_r($data); echo '</pre>';?> -->

            <?php
                
                if(!empty($data['phone_err'])   ){
                    echo '<div class="error">';
                        echo '*'.$data['phone_err'].'<br>';
                    echo '</div>';
                }

            ?>
            <form action="<?php echo URLROOT . '/users/change_phone/'.$data['id']?>" method="post">
                <label >Enter phone number</label>
                <div class="input">
                    <input type="number" name="phone"  class="otp1" placeholder="0#########" pattern="[0-9]{10}" value="<?php echo $data['phone']?>" onpaste="false" >                   
                </div>
                <div class="submit">
                    <input type="submit" name="submit" value="Send OTP" id="button">
                </div>
            </form>
        </div>
    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>