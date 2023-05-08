<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/login.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    
    <title>Home</title>
</head>
<body>
    
<?php require_once APPROOT . '/views/users/navbar.php';?>


    <div class="container_main">
        <?php echo flash('user_deleted');?>
        <?php echo flash('email_err');?>
        <?php echo flash('auction_message');?>
        <?php echo flash('user_type_message');?>
        <?php echo flash('bid_expired');?>
        
                <!-- <?php echo '<pre>'; print_r($data); echo '</pre>';?> -->
        
        <div class="search">
            <div class="heading">
                <h1>Find the best <br>Audio Equipment</h1>
            </div>
            <div class="search-bar">
                <form method="post" class="search-form" id="main-search-bar" action="<?php echo URLROOT . '/public/users/searchItems';?>">
                    <input type="search" name="search-item" id="search-item-term" placeholder="Microphone"></input>
                    <button type="submit" class="btn-search"> <img src="<?php echo URLROOT . '/public/img/icons/bxs_search-alt-2.png'; ?>" alt="search"> </button>
                </form>
            </div>
            <div id="search-results">
                <table class="table" id="search-results-table">
                </table>
            </div>
        </div>
        <div class="explore">
            <div class="explore-line">
                <h3>Explore Popular Categories</h3>
            </div>
            <div class="explore-btn">
                <button><a href="<?php echo URLROOT.'/users/shop/speaker'; ?>"><img src="<?php echo URLROOT . '/public/img/icons/bi_speaker.png'; ?>" alt="speaker"
                        class="home-icon"></a></button>
                <button><a href="<?php echo URLROOT.'/users/shop/amplifier'; ?>"><img src="<?php echo URLROOT . '/public/img/icons/bxs_guitar-amp.png'; ?>" alt="amplifier"
                        class="home-icon"></a></button>
                <button><a href="<?php echo URLROOT.'/users/shop/guitar'; ?>"><img src="<?php echo URLROOT . '/public/img/icons/nimbus_guitar.png'; ?>" alt="guitar"
                        class="home-icon"></a></button>
                <button><a href="<?php echo URLROOT.'/users/shop/mixer'; ?>"><img src="<?php echo URLROOT . '/public/img/icons/jam_dj.png'; ?>" alt="dj mixer"
                        class="home-icon"></a></button>
                <button><a href="<?php echo URLROOT.'/users/shop/microphone'; ?>"><img src="<?php echo URLROOT . '/public/img/icons/Group.png'; ?>" alt="microphone"
                        class="home-icon"></a></button>
            </div>
        </div>
    </div>
    <div class="hotest_auctions">

        <p id="title">Hotest Auctions</p>
        <?php $i=0;foreach($data['auctions'] as $auction){?>
            <a href="<?php echo URLROOT.'/users/auction/'.$auction->product_id?>">
                <div class="auction"><img src="<?php echo URLROOT.'/uploads/'.$auction->image1?>" alt=""></div>
        </a>
        <?php $i++;}?>
        <?php while($i<6){?>
            <div class="auction"></div>
        <?php $i++;}?>

    </div>
    <div class="popular_engineers">
        <p id="title">Popular Engineers</p>
        <?php $i=0;foreach($data['engineers'] as $engineer){?>
            <a href="<?php echo URLROOT.'/users/serviceProviderPublic/'. "?id=$engineer->user_id"?>">
                <div class="engineer"><img src="<?php echo URLROOT.'/uploads/Profile/'.$engineer->profile_image?>" alt=""></div>
        </a>
        <?php $i++;}?>
        <?php while($i<6){?>
            <div class="engineer"></div>
        <?php $i++;}?>

    </div>
    <div class="upcoming_events">

        <p id="title">Upcoming Events</p>
        <div class="event event1"></div>
        <div class="event event2"></div>
        <div class="event event3"></div>
        <div class="event event4"></div>
        <div class="event event5"></div>
        <div class="event event6"></div>
    </div>
    <?php require_once APPROOT . '/views/users/footer.php';?>


</body>
<script>
    

jQuery(document).ready(function(){
    $.getScript('<?php echo URLROOT . '/public/js/form.js';?>');
    $.getScript('<?php echo URLROOT . '/public/js/search.js';?>');
});
</script>

</html>