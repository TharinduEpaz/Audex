<?php date_default_timezone_set("Asia/Kolkata");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/advertise.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/bid.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo URLROOT . '/public/js/moment.min.js';?>"></script>
    <script type="text/javascript" src="<?php echo URLROOT . '/public/js/moment-timezone-with-data.js';?>"></script>

    <title>Advertisement</title>
</head>
<body>
<?php require_once APPROOT . '/views/users/navbar.php';?>

    <div class="container" style="background: none;">
    
        <div class="content">
            <div class="image">
                <img src="<?php echo URLROOT.'/public/uploads/'.$data['ad']->image1;?>" alt="">
                <!-- <a href="">next</a> -->
            </div>
            <div class="auction_details">
                <h2><?php echo $data['ad']->product_title?></h2>
                <h3>Price:&nbsp;<?php echo $data['ad']->price?></h3>
                <!-- <?php echo date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). ' + 10 days'));?> -->
                <div class="time">
                    <p>Time Left:&nbsp;</p>
                    <p id='remaining_time'></p>
                </div>

                <!-- <?php echo '<pre>'; print_r($data); echo '</pre>';?> -->
                <!-- <?php echo '<pre>'; print_r($data['auctions']); echo '</pre>';?> -->
                <!-- <?php echo $data['auctions'][0]->price;?> -->
                <table>
                    <tr>
                        <th>Place</th>
                        <th>Name</th>
                        <th>Amount</th>
                    </tr>
                    <?php 
                        if(!empty($data['auctions'])){
                            $i=0;
                            foreach($data['auctions'] as $auction):
                            $i++;
                        
                        echo '<tr>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$data['user'][$i-1]->first_name[0].$data['user'][$i-1]->first_name[1].'****</td>';
                            echo '<td>Rs.'.$auction->price.'</td>';
                        echo '</tr>';
                        endforeach;
                        }
                    ?>
                </table>
                <div class="add_bid" >
                    <?php
                        if(!empty($data['price_err1']) || !empty($data['price_err2']) || !empty($data['price_err3']) || !empty($data['price_err4'])  || !empty($data['price_err5'])){
                            echo '<div class="error">';
                                if(!empty($data['price_err'])){
                                    echo '*'.$data['price_err'].'<br>';
                                }if(!empty($data['price_err1'])){
                                    echo '*'.$data['price_err1'].'<br>';
                                }if(!empty($data['price_err2'])){
                                    echo '*'.$data['price_err2'].'<br>';
                                }if(!empty($data['price_err3'])){
                                    echo '*'.$data['price_err3'].'<br>';
                                }if(!empty($data['price_err4'])){
                                    echo '*'.$data['price_err4'].'<br>';
                                }if(!empty($data['price_err5'])){
                                    echo '*'.$data['price_err5'].'<br>';
                                }

                            echo '</div>';
                        }

                    ?>
                                    
                    <!-- <h1><?php echo $data['ad']->product_id.'/'.$auction->auction_id.'/'.$data['auctions'][0]->price.'/'.$data['ad']->price;?></h1> -->
                    
                    
                    <button id="form-trigger" class="bid_button">BID</button>
                        <div class="pop_up">

                                <form action="<?php echo URLROOT.'/users/bid/'.$data['ad']->product_id?>" class="bid" method="post">
    
                                    <!-- <label for="price">Price</label> -->
                                    <input class="price" type="number" step="0.01" name="price"  placeholder="xxxx.xx"   ><br>
                                    <div class="add_bid1">
                                    <input type="submit" name="submit" value="Bid" class="bid_button"><br>
                                    <button type="button" id="form-close" class="close">Cancel</button>
                                    </div>
                                        <p>* By clicking BID button, you are accepting to buy the product if you become the winner</p>
                                </form>
                        </div>
                        
                </div>
                <?php 
                    if(isLoggedIn()){
                        if($_SESSION['user_email']!=$data['ad']->email){
                            echo '<div class="message_bid">';
                                echo '<div class="message_seller">';
                                echo '<a href="'.URLROOT.'/users/message" class="btn">Message Seller</a>';
                                echo '</div>';
                            echo '</div>';
                        }
                    }
                ?>
            </div>
        </div>
        <div class="description">
            <h3>Description</h3>
            <p><?php echo $data['ad']->p_description?></p>
        </div>
    </div>
</body>
<!-- Display the countdown timer in an element -->

<!-- <script type="text/javascript" src="https://momentjs.com/downloads/moment.min.js"></script> -->
<!-- <script type="text/javascript" src="https://momentjs.com/downloads/moment-timezone-with-data-1970-2030.js"></script> -->

<script>
    // Update the count down every 1 second
    var x = setInterval(function() {
      // Get today's date and time
      var now = moment().tz("Asia/Colombo");
      var milliseconds = now.format('x');

      var end_date=  <?php echo strtotime($data['auction']->end_date);?>
      // Find the distance between now and the count down date
      var distance = end_date*1000 - milliseconds;
    
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);


   
    
      // Display the result in the element with id="demo"
      document.getElementById("remaining_time").innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";
    
      // If the count down is finished, write some text
      if (distance < 0) {
          clearInterval(x);
          document.getElementById("remaining_time").innerHTML = "EXPIRED";
          window.location.href = "<?php echo URLROOT.'/users/bid_expired/'.$data['ad']->product_id.'/'.$data['auction']->auction_id?>";
      }
    }, 1000);


    const trigger = document.getElementById("form-trigger");
    const formContainer = document.querySelector(".pop_up");
    const formClose = document.getElementById("form-close");

    trigger.addEventListener("click", function() {
      formContainer.style.display = "block";
    });

    formClose.addEventListener("click", function() {
      formContainer.style.display = "none";
    });

</script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>
<!-- Closing the connection