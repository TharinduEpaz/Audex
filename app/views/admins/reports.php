<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <!-- <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/manageuser.css';?>"> -->
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <!-- <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/approval.css';?>"> -->

    
    <!-- <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/seller_advertisement.css';?>"> -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Manage User</title>
</head>
<style>
    body {
      margin: 0;
      padding: 0;
      overflow: auto; /* Enable scrolling on the body */
    }
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
    .approval_title{

        width: 100%;
        height: fit-content;
        /* border: 1px solid; */
        display: flex;
        align-items: center;
        justify-content: space-between;
        text-align: center;
        background: white;
        border-radius: 15px;
        padding: 3%;
    }
    .form-display {
        overflow: auto;

    /* display: flex; */
    /* flex-direction: column; */
    /* align-items: left; */
    /* margin: 5px 20px 20px 20px; */
    width: 75%;
    height: auto;
    background-color: white;
    border-radius: 1.4rem;
    position: fixed;
    top: 12vh;
    left: 270px;
    }
</style>
<body>
<?php require_once APPROOT . '/views/admins/navbar.php';?>
    <div class="container">
    <?php require_once APPROOT . '/views/admins/sidebar.php';?>

    <div class="form-display" style="height:inherit;padding:20px;">
        <h1 style="text-align: center;"> Common Reports</h1>
        <div class="approval_title">
            <div class="approved" onclick="viewreport()">
            <h3>All the payments</h3>
            </div>
            <div class="approved"  onclick="trending_products()">
            <h3>Trending products</h3>
            </div>
        </div>
        <h1 style="text-align: center;"> Service Provider Reports</h1>
        <div class="approval_title">
            <div class="approved" onclick="approved()">
            <h3>Service Providers Approved and Paid</h3>
            </div>
            <div class="approved"  onclick="low_ratings()">
            <h3>Service Providers who has low ratings</h3>
            </div>
            <div class="approved"  onclick="high_ratings()">
            <h3>Trending Service Providers</h3>
            </div>
        </div>
        <h1 style="text-align: center;"> Seller Reports</h1>
        <div class="approval_title">
            <div class="approved" onclick="seller_product_count()">
            <h3>Active Product counts of sellers</h3>
            </div>
            <div class="approved"  onclick="seller_low_ratings()">
            <h3>Sellers who has low ratings</h3>
            </div>
            <div class="approved"  onclick="seller_high_ratings()">
            <h3>Trending Sellers</h3>
            </div>
        </div>
    </div> 

    </div>






<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
<script>


function viewspprofile(userID) {
    
    var url = 'http://localhost/Audex/admins/spprofile?id=' + userID;
    window.open(url, '_self');
}

function approved(){
    window.location.href =  "<?php echo URLROOT . '/admins/approvedservice_providers';?>";
}
function low_ratings(){
    window.location.href =  "<?php echo URLROOT . '/admins/lowratings';?>";
}
function high_ratings(){
    window.location.href =  "<?php echo URLROOT . '/admins/highratings';?>";
}
function seller_high_ratings(){
    window.location.href =  "<?php echo URLROOT . '/admins/seller_highratings';?>";
}
function seller_low_ratings(){
    window.location.href =  "<?php echo URLROOT . '/admins/seller_lowratings';?>";
}
function seller_product_count(){
    window.location.href =  "<?php echo URLROOT . '/admins/seller_product_count';?>";
}
function viewreport(){
        window.location.href="<?php echo URLROOT . '/admins/adminviewreport/';?>"
}
function trending_products(){
        window.location.href="<?php echo URLROOT . '/admins/trending_products/';?>"
}


//keeping the sidebar button clicked at the page
link = document.querySelector('#reports');
    link.style.background = "#E5E9F7";
    link.style.color = "red";
    link.style.fontWeight = "800";



</script>
</html>