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
                <button><img src="<?php echo URLROOT . '/public/img/icons/bi_speaker.png'; ?>" alt="sp"
                        class="home-icon"></button>
                <button><img src="<?php echo URLROOT . '/public/img/icons/bxs_guitar-amp.png'; ?>" alt="am"
                        class="home-icon"></button>
                <button><img src="<?php echo URLROOT . '/public/img/icons/nimbus_guitar.png'; ?>" alt="gu"
                        class="home-icon"></button>
                <button><img src="<?php echo URLROOT . '/public/img/icons/jam_dj.png'; ?>" alt="dj"
                        class="home-icon"></button>
                <button><img src="<?php echo URLROOT . '/public/img/icons/Group.png'; ?>" alt="grp"
                        class="home-icon"></button>
            </div>
        </div>
    </div>
    <div class="hotest_auctions">

        <p id="title">Hotest Auctions</p>
        <div class="auction auction1"><img src="" alt=""></div>
        <div class="auction auction2"></div>
        <div class="auction auction3"></div>
        <div class="auction auction4"></div>
        <div class="auction auction5"></div>
        <div class="auction auction6"></div>

    </div>
    <div class="popular_engineers">
        <p id="title">Popular Engineers</p>
        <div class="engineer engineer1"></div>
        <div class="engineer engineer2"></div>
        <div class="engineer engineer3"></div>
        <div class="engineer engineer4"></div>
        <div class="engineer engineer5"></div>
        <div class="engineer engineer6"></div>

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
    <div class="footer">
        <div class="section1">
            <h1>About us</h1><br><br>
            <p>Audexlk is an emarket place for sound equipments. We plan to build a marketplace where people can find equipment and professional engineers. We plan to break the boundaries of professional audio equipment renting. Our vision and business model are going towards achieving the same goal.  </p>
       
        </div>
        <div class="section2">
        <h1>Contact us</h1><br><br>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
       
        </div>

    </div>

</body>
<script>
jQuery(document).ready(function(){
    $.getScript('<?php echo URLROOT . '/public/js/form.js';?>');
    $.getScript('<?php echo URLROOT . '/public/js/search.js';?>');
});
</script>

</html>