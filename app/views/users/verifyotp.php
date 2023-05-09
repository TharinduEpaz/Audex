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
    <script type="text/javascript" src="<?php echo URLROOT . '/public/js/moment.min.js';?>"></script>
    <script type="text/javascript" src="<?php echo URLROOT . '/public/js/moment-timezone-with-data.js';?>"></script>
    <title>Verify email</title>
</head>
<body>
<?php require_once APPROOT . '/views/users/navbar.php';?>
    
    <div class="container_main">
        <div class="form" style="margin-top: 25vh;">
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
            <div class="time">
                    <p>Time Left:&nbsp;</p>
                    <p id='remaining_time'></p>
                </div>
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
<script>
    // Update the count down every 1 second
    var x = setInterval(function() {
      // Get today's date and time
      var now = moment().tz("Asia/Colombo");
      var milliseconds = now.format('x');

      var end_date=  <?php echo strtotime($_SESSION['time']);?>;
      // Find the distance between now and the count down date
      var distance = end_date*1000 - milliseconds;
    
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);


        console.log(distance);
    
      // Display the result in the element with id="demo"
      document.getElementById("remaining_time").innerHTML = minutes + "m " + seconds + "s ";
    
      // If the count down is finished, write some text
      if (distance < 0) {
          clearInterval(x);
          document.getElementById("remaining_time").innerHTML = "EXPIRED";
        //   flash('phone_message1','Time exceeded','alert alert-danger');
          window.location.href = "<?php echo URLROOT.'/users/index'?>";
      }
    }, 1000);

</script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>