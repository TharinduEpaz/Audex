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
<div class="service-provider-profile">
    <div class="white-box">

    <div class="dashboard-title">
        <p>Welcome Mevan !!</p>
        <p>This is your dashboard</p>
    </div>
    <div class="dashboard-container">

    <div class="dashboard-item" id="">
        <h1 id="msg-count">2</h1>
        <p>Unread Messages</p>
    </div>

    <div class="dashboard-item" id="">
        <h1 id="profile-views">122</h1>
        <p>Profile Views</p>
    </div>

    <div class="dashboard-item" id="">
        <h1 id="Likes">2</h1>
        <p>Total Likes</p>
    </div>

    <div class="dashboard-item" id="">
        <h1 id="Events">2</h1>
        <p>Events This Month</p>
    </div>
    <div class="dashboard-item" id="">
        <h1 id="Flags">0</h1>
        <p>Flags</p>
    </div>
    <div class="dashboard-item" id="">
        <h1 id="profile">100%</h1>
        <p>Profile Complete</p>
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
    //make sidebar button background clicked
    link = document.querySelector('#dashboard');
    link.style.background = "#E5E9F7";
    link.style.color = "red";


    

</script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>

</html>
