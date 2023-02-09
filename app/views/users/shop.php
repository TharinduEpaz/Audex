<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/login.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/shop.css?id=123';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/advertiesmentDetails.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title><?php echo SITENAME; ?></title>
</head>
<body>
    <style>
        body .container{
            background-image: none;
            background-color: rgb(214, 214, 239);
        }
    </style> 
    <?php require_once APPROOT . '/views/users/navbar.php';?>

    <?php  echo $data['searchTerm']; ?>
    <div class="container" >
        <div class="ad-search_shop">
            <form method="post" class="shop-search-form" id="shop-search-form">
                    <input type="search" name="search-item" id="shop-search-item-term" placeholder="Microphone" value="<?php echo ($data['isEmptySearchTerm'] == '0') ? $data['searchTerm'] : '';  ?>" style="width: 25%;">
                    <label for="category">Category:</label>
                    <select name="category" id="category">
                        <option value="">All</option>
                        <option value="microphone">Microphone</option>
                        <option value="mixer">Mixer</option>
                        <option value="guitar">Guitar</option>
                    </select>
                    <label for="price">Price Min:</label>
                    <input type="text" name="price-min" placeholder="Price Min" style="width: 10%; border-radius: 0 0 0 0;" >
                    <label for="price">Price Max:</label>
                    <input type="text" name="price-max" placeholder="Price Max" style="width: 10%; border-radius: 0 0 0 0;">
                    <label for="Product_type">Type:</label>
                    <select name="type" id="type">
                        <option value="">All</option>
                        <option value="fixed_price">Fixed Price</option>
                        <option value="auction">Auction</option>
                    </select>
                    <button type="submit" > <img src="<?php echo URLROOT . '/public/img/icons/bxs_search-alt-2.png'; ?>" alt="search"> </button>
            </form>
        </div>
        <div id="shop-search-results">
            <table class="table" id="search-results-table">
            </table>
        </div>
        <?php echo flash('auction_error');?>
        <div id="search-result-area">
            <?php if( $data['isEmptySearchResults'] == '0' ){ ?>

                <?php foreach($data['searchResults'] as $result) : ?>
                    <div class="container-ad">
                        <div class="container-img">
                            <img src="<?php echo URLROOT.'/public/uploads/'.$result->image1;?>" /> 
                        </div>
                        <div class="title">
                            <a href="<?php echo URLROOT . '/users/advertiesmentDetails/'.$result->product_id;?>">
                            <?php echo $result->product_title ; ?><br>
                            <?php echo 'RS:'. $result->price ; ?></a>
    
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php }; ?>
        </div>

        <div class="header">
            <h1>New Arrivals</h1>
        </div>
        <!-- <?php echo '<pre>'; print_r($data); echo '</pre>';?> -->

        <div class="container-data">
            <?php $i=0;
            foreach($data['ads'] as $ads) :
                // if(!isset($data['ads'][$i])){
                //     echo $i;
                //    $i++;
                // }?>

                <div class="container-ad">
                    <div class="container-img">
                        <img src="<?php echo URLROOT.'/public/uploads/'.$ads->image1;?>" /> 
                    </div>
                    <div class="title">
                        <h3><?php echo $ads->product_title ; ?></h3>
                        <!-- <h3><?php echo $i ; ?></h3> -->
                        <?php 
                            if($ads->product_type == 'auction' ){
                                echo '<h5>Auction</h5>';?>
                                <!-- <?php echo $data['auction'][$i]->end_date;?> -->
                                <!-- <div class="time">
                                    <p>Time Left:&nbsp;</p>
                                    <p id='remaining_time'></p>
                                </div>
                            <script>
                                // Set the date we're counting down to
                                var countDownDate = new Date("<?php echo $data['auction'][$i]->end_date;?>").getTime();

                                // Update the count down every 1 second
                                var x = setInterval(function() {
                                
                                  // Get today's date and time
                                  var now = new Date().getTime();
                                
                                  // Find the distance between now and the count down date
                                  var distance = countDownDate - now;
                                
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
                                      window.location.href = "<?php echo URLROOT.'/users/bid_expired/'.$ads->product_id.'/'.$data['auction'][$i]->auction_id?>";
                                  }
                                }, 1000);
                            </script> -->
                            <?php } $i++;?>
                        <h4><?php echo 'RS:'. $ads->price ; ?></h4>
                        <a href="<?php if($ads->product_type == 'auction'){
                                echo URLROOT . '/users/auction/'.$ads->product_id;
                            }else{
                                echo URLROOT . '/users/advertiesmentDetails/'.$ads->product_id;
                            }
                                ?>">View</a>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="header">
            <h1>Popular Engineers</h1>
        </div>
    </div>
</body>

<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
<script src="<?php echo URLROOT . '/public/js/shop-search.js';?>"></script>
</html>