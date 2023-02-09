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
<?php require_once APPROOT . '/views/users/navbar.php';?>


    <div class="container">
        <div class="sidebar">
            <a href="<?php echo URLROOT . '/buyers/getProfile/'.$_SESSION['user_id'];?>"><i class="fas fa-address-card"></i> <span>My Profile</span></a>
            <a href="<?php echo URLROOT . '/users/watchlist/'.$_SESSION['user_id'];?>" > <i class="far fa-calendar-check" aria-hidden="true"></i><span>Watch List</span></a>
            <a href="#"> <i class="fa fa-comments-o" aria-hidden="true"></i><span>Feedback</span></a>
            <a href="#" class="current"> <i class="fa fa-thumbs-up" aria-hidden="true"></i><span>Reactions</span></a>
            <a href="messages.php"> <i class="fa fa-envelope"></i><span>Messages</span></a>       
        </div>
        <div class="poster_advertisements">
            <div class="box">
                <?php foreach($data['products'] as $ads) : ?>
                    <div class="box-content">
                        <!-- <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($ads->image1); ?>" />  -->
                        <a href="<?php echo URLROOT . '/users/advertiesmentDetails/'.$ads->product_id;?>">
                            <img src="<?php echo URLROOT.'/public/uploads/'.$ads->image1;?>" />  
                            <h4><?php echo $ads->product_title ; ?><br><?php echo $ads->price ; ?></h4></a>
                    </div> 
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
<script src="<?php echo URLROOT . '/public/js/removeWatchListItem.js';?>"></script>
</html>
