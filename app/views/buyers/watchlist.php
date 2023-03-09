<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/seller_advertisement.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/watchlist.css';?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Profile</title>
</head>
<body>
<?php require_once APPROOT . '/views/buyers/navbar.php';?>


    <div class="container">
    <?php require_once APPROOT . '/views/buyers/sidebar.php';?>        
        <div class="poster_advertisements">
            <div class="box">
                <?php foreach($data['products'] as $ads) : ?>
                    <div class="box-content">
                        <!-- <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($ads->image1); ?>" />  -->
                        <img src="<?php echo URLROOT.'/public/uploads/'.$ads->image1;?>" />  
                        <a href="<?php echo URLROOT . '/buyers/advertiesmentDetails/'.$ads->product_id;?>">
                        <h4><?php echo $ads->product_title ; ?><br><?php echo $ads->price ; ?></h4></a>

                        <form class="remove_item" method="post">
                            <!-- if user is logged in then he have a _SESSION, if not user id value will be 0  -->
                            <input type="text" name="user_type" value="buyer" hidden>
                            <input type="text" name ="user_id" value= " <?php echo (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0) ; ?>" hidden>
                            <input type="text" name="product_id" value="<?php echo $ads->product_id ; ?>" hidden >
                            <input type="submit" value="Remove" name="submit_btn">

                        </form>

                    </div> 
                    
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
<script>
    //keeping the sidebar button clicked at the page
    link = document.querySelector('#watch_list');
    link.style.background = "#E5E9F7";
    link.style.color = "red";
    link.style.fontWeight = "800";
</script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
<script src="<?php echo URLROOT . '/public/js/removeWatchListItem.js';?>"></script>
</html>
