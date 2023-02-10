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
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>

    <title>Profile</title>
</head>
<body>
<?php require_once APPROOT . '/views/users/navbar.php';?>


    <div class="container">
        <div class="sidebar">
            <a href="<?php echo URLROOT . '/buyers/getProfile/'.$_SESSION['user_id'];?>"><i class="fas fa-address-card"></i> <span>My Profile</span></a>
            <a href="#" class="current"> <i class="far fa-calendar-check" aria-hidden="true"></i><span>Watch List</span></a>
            <a href="#"> <i class="fa fa-comments-o" aria-hidden="true"></i><span>Feedback</span></a>
            <a href="<?php echo URLROOT . '/buyers/reactions/'.$_SESSION['user_id'];?>"> <i class="fa fa-thumbs-up" aria-hidden="true"></i><span>Reactions</span></a>
            <a href="messages.php"> <i class="fa fa-envelope"></i><span>Messages</span></a>       
        </div>
        <div class="poster_advertisements">
            <div class="box">
                <?php foreach($data['products'] as $ads) : ?>
                    <div class="box-content">
                        <!-- <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($ads->image1); ?>" />  -->
                        <img src="<?php echo URLROOT.'/public/uploads/'.$ads->image1;?>" />  
                        <a href="<?php echo URLROOT . '/users/advertiesmentDetails/'.$ads->product_id;?>">
                        <h4><?php echo $ads->product_title ; ?><br><?php echo $ads->price ; ?></h4></a>

                        <form class="remove_item" method="post">
                            <!-- if user is logged in then he have a _SESSION, if not user id value will be 0  -->
                            <input type="text" name="user_type" value="buyer" hidden>
                            <input type="text" name ="user_id" value= " <?php echo (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0) ; ?>" hidden>
                            <input type="text" name="product_id" value="<?php echo $ads->product_id ; ?>" hidden >
                            <input type="submit" value="Remove" name="submit_btn">
                            <!-- <dialog id="dia">
                                <div class="top-part">
                                    <button class="btn_close">X</button>
                                    <i class="fa-sharp fa-solid fa-xmark"></i>
                                </div>  
                                <hr>
                                <div>
                                    <button class="continue">OK </button>  
                                    <button class="close">Close</button>
                                </div>
                            </dialog> -->
                        </form>

                    </div> 
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
<script>
jQuery(document).ready(function(){
    $.getScript('<?php echo URLROOT . '/public/js/form.js';?>');
    $.getScript('<?php echo URLROOT . '/public/js/removeWatchListItem.js';?>');
});
</script>
</html>
