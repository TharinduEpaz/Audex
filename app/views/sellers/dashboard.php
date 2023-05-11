<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/advertise.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/service_provider.css?id=25';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    
    <script type="text/javascript" src="<?php echo URLROOT . '/public/js/moment.min.js';?>"></script>
    <script type="text/javascript" src="<?php echo URLROOT . '/public/js/moment-timezone-with-data.js';?>"></script>
    <title>Advertisement</title>
</head>
<body>
    <style>
        p{
            color: black;
            font-weight: 700;
        }
        .service-provider-profile {
          width: calc(100vw - 240px);
        }
        .service-provider-profile .white-box .dashboard-item {
            width: 30%;
            height: 28vh;
        }
        @media (max-width: 860px){
          .service-provider-profile{
          width: calc(100vw - 70px);
          margin-left: 70px;
        
          }
        }
    </style>
<?php require_once APPROOT . '/views/sellers/navbar.php';?>
<?php require_once APPROOT . '/views/sellers/sidebar.php';?>
<div class="service-provider-profile">
    <div class="white-box" style="margin-left: 5%;width:72vw">

    <div class="dashboard-title">
        <p>Welcome <?php echo $_SESSION['user_name'];?> !!</p>
        <p>This is your dashboard</p>
                <!-- <?php echo '<pre>'; print_r($data); echo '</pre>';?> -->

    </div>
    <div class="dashboard-container">

    <div class="dashboard-item" id="">
        <h1 id="msg-count" style="color: black;"><?php echo $data['feedbackcount'] ;?></h1>
        <p>Reviews</p>
    </div>

    <div class="dashboard-item" id="">
        <h1 id="profile-views"><?php echo $data['no_auctions']->count ;?></h1>
        <p>Live Auctions</p>
    </div>

    <div class="dashboard-item" id="">
        <h1 id="Likes"><?php echo $data['likes_dislikes']['likes'];?></h1>
        <p>Total Likes</p>
    </div>

    <div class="dashboard-item" id="">
        <h1 id="Events"><?php echo $data['likes_dislikes']['dislikes'];?></h1>
        <p>Total Dislikes</p>
    </div>
    <div class="dashboard-item" id="">
        <h1 id="Flags" style="color: red;">0</h1>
        <p>Flags</p>
    </div>
    <div class="dashboard-item" id="">
        <h1 id="profile"><?php echo $data['no_views']->count;?></h1>
        <p>Advertisements Views</p>
    </div>

    </div>
</div>
</div>
</body>


<script>
    //make unread messages number color red
    var msgCount = document.getElementById("msg-count");
    if(msgCount.innerHTML > 0){
        msgCount.style.color = "red";
    }

    //keeping the sidebar button clicked at the page
    link = document.querySelector('#dashboard');
    link.style.background = "#E5E9F7";
    link.style.color = "red";
    link.style.fontWeight = "800";

    

</script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>

</html>
