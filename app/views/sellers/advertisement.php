<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/advertise.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    
    <script type="text/javascript" src="<?php echo URLROOT . '/public/js/moment.min.js';?>"></script>
    <script type="text/javascript" src="<?php echo URLROOT . '/public/js/moment-timezone-with-data.js';?>"></script>
    <title>Advertisement</title>
</head>
<body>
<?php require_once APPROOT . '/views/sellers/navbar.php';?>

    <div class="container" style="background: none;">
    
    <!-- <?php echo '<pre>'; print_r($data); echo '</pre>';?>
    <?php echo $data['auction']->end_date;?> -->
        <div class="content">
        <div class="image_likes">
            <div class="image">
                    <div class="grid">
                        <div id="img1" class="img1" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['advertisement']->image1;?>)">
                        </div>
                        <div class="img2" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['advertisement']->image1;?>)">    
                            <a style="width: 100%;height:100%; " onclick="change_img1(); return false;" ></a>
                        </div>
                        <div class="img3" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['advertisement']->image2;?>)"> 
                            <?php if($data['advertisement']->image2!=null){?>  
                                <a style="width: 100%;height:100%; " onclick="change_img2(); return false;"></a> 
                            <?php }?>
                        </div>
                        <div class="img4" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['advertisement']->image3;?>)">   
                            <?php if($data['advertisement']->image3!=null){?>  
                                <a style="width: 100%;height:100%; " onclick="change_img3(); return false;"></a>
                            <?php }?>
                        </div>
                    </div>
                </div>
        </div>
            <div class="details">
                <h2><?php echo $data['advertisement']->product_title?></h2>
                <?php if($data['advertisement']->product_type=='auction'){?>
                    <div class="time">
                        <p>Time Left:&nbsp;</p>
                        <p id='remaining_time'></p>
                    </div>
                <?php }?>
                <table>
                    <tr>
                        <td class="name">Category</td>
                        <td class="value">: <?php echo $data['advertisement']->product_category?></td>
                    </tr>
                    <tr>
                        <td class="name">Model Number</td>
                        <td class="value">: <?php echo $data['advertisement']->model_no?></td>
                    </tr>
                    <tr>
                        <td class="name">Brand name</td>
                        <td class="value">: <?php echo $data['advertisement']->brand?></td>
                    </tr>
                    <tr>
                        <td class="name">Condition</td>
                        <td class="value">: <?php echo $data['advertisement']->product_condition?></td>
                    </tr>
                </table>
                <div class="price">
                    <h4>Rs. <?php echo $data['advertisement']->price?></h4>
                </div>
                <div class="buttons">
                    <?php if($data['advertisement']->product_type=='auction'){?>
                    <button type="button" class="bid_list" onclick="location.href='<?php echo URLROOT;?>/sellers/bid_list/<?php echo $data['advertisement']->product_id;?>'">Bid list</button>
                    <?php }?>
                    <button type="button" class="delete" onclick="location.href='<?php echo URLROOT;?>/sellers/delete_advertisement/<?php echo $data['advertisement']->product_id;?>'"> Delete</button>    
                    

                </div>
            </div>
        </div>
        <div class="description" style="margin-top: -2vh;">
            <h3>Description</h3>
            <p><?php echo $data['advertisement']->p_description?></p>
        </div>
    </div>
</body>
<script>

    function change_img1(){
        document.getElementById('img1').style.backgroundImage = "url('<?php echo URLROOT.'/public/uploads/'.$data['advertisement']->image1;?>')";
    }
    function change_img2(){
        document.getElementById('img1').style.backgroundImage = "url('<?php echo URLROOT.'/public/uploads/'.$data['advertisement']->image2;?>')";
    }
    function change_img3(){
        document.getElementById('img1').style.backgroundImage = "url('<?php echo URLROOT.'/public/uploads/'.$data['advertisement']->image3;?>')";
    }
                    
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
          if(<?php echo $data['auction']->is_finished;?>==0){

              window.location.href = "<?php echo URLROOT.'/users/bid_expired/'.$data['advertisement']->product_id.'/'.$data['auction']->auction_id?>";
          }
      }
    }, 1000);
</script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>
<!-- Closing the connection