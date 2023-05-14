<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/manageuser.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/approval.css';?>">

    
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/seller_advertisement.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Manage User</title>
</head>
<style>
    .approved{
        width: 20%;
        height: 20vh;
        /* border: 1px solid; */
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        background: #E5E9F7;
        border-radius: 15px;
    }
</style>
<body>
<?php require_once APPROOT . '/views/admins/navbar.php';?>
    <div class="container">
        <div class="sidebar">
                <a  href="<?php echo URLROOT;?>/admins/profiletest"><i class="fas fa-qrcode"></i> <span>My Profile</span></a>
                <a href="<?php echo URLROOT;?>/admins/manageuser"> <i class="fa fa-cog" aria-hidden="true"></i><span>Manage Users</span></a>
                <a href="#"> <i class="fas fa-bookmark" aria-hidden="true"></i><span>Flags</span></a>
                <a class="current" href="<?php echo URLROOT;?>/admins/approval"> <i class="fas fa-check-circle" aria-hidden="true"></i><span>Approvals</span></a>
                <a href="<?php echo URLROOT;?>/admins/reports"> <i class="fas fa-check-circle" aria-hidden="true"></i><span>Reports</span></a>

                <!-- <a href="#"> <i class="fas fa-child"></i><span>Help</span></a>        -->
        </div>
    <div class="poster_advertisements">
        <div class="form-display" style="height:auto;padding:20px;">
            <div class="table_container">
                <div class="approval_title"><h1 style="text-align: center;"> Service Provider Reports</h1></div>
                    <div class="approved" onclick="approved()">
                    <h3>Service Providers Approved and Paid</h3>
                    </div>
                    <div class="approved"  onclick="low_ratings()">
                    <h3>Service Providers who has low ratings</h3>
                    </div>
                    <div class="approved"  onclick="high_ratings()">
                    <h3>Service Providers who has high ratings</h3>
                    </div>
                </div>
            </div>
        </div> 

    </div>

</script>





<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
<script>


function viewspprofile(userID) {
    
    var url = 'http://localhost/Audex/admins/spprofile?id=' + userID;
    window.open(url, '_self');
}


</script>
</html>