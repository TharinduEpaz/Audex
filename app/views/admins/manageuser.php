<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/manageuser.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/seller_advertisement.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Manage User</title>
</head>
<body>
<?php require_once APPROOT . '/views/admins/navbar.php';?>
   
    <div class="container">
    <div class="sidebar">
                <a href="<?php echo URLROOT;?>/admins/profiletest"><i class="fas fa-qrcode"></i> <span>My Profile</span></a>
                <a class="current" href="<?php echo URLROOT;?>/admins/mangeuser"> <i class="fa fa-cog" aria-hidden="true"></i><span>Manage Users</span></a>
                <a href="#"> <i class="fas fa-bookmark" aria-hidden="true"></i><span>Flags</span></a>
                <a href="<?php echo URLROOT;?>/admins/approval"> <i class="fas fa-check-circle" aria-hidden="true"></i><span>Approvals</span></a>
                <!-- <a href="#"> <i class="fas fa-child"></i><span>Help</span></a>        -->
        </div>
    <div class="poster_advertisements">
        <div class="whitebox">
            <div class="section1">
            <input type="text" placeholder="Search..">
            <button class="searchbtn">Search</button>
            </div>


            <div class="section2">
            <h2>Recently marked accounts</h2>
            <div class="information">
                <ul id="first">
                    <li id="sus"">Mark : Suspend</li>
                    <li>Flag_id : 86436464</li>
                    <li>User_id : 27243864</li>
                    
                 
                </ul>
                <div class="button">
                    <button id="act">Action</button>
                    <button id="ign">Ignore</button>
                   <button id="rev">Review</button>
                </div>
                   <ul id="second">
                    <li id="del">Mark : delete</li>
                    <li>Flag_id : 86436464</li>
                    <li>User_id : 27243864</li>
                    
                 
                </ul>
                <div class="button">
                    <button id="act">Action</button>
                    <button id="ign">Ignore</button>
                   <button id="rev">Review</button>
                
                </div>
            </div>
            </div>

            
            
            <div class="section3">
                <h1> Add a new admin
                <a href="<?php echo URLROOT .'/admins/addadmin'?>" class="btn1"> click</a></button>
            </div>
        
        </div>        
            
        

    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>