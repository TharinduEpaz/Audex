<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/manageuser.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/admindashboard.css';?>">
    
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
                <a href="<?php echo URLROOT;?>/admins/mangeuser"> <i class="fa fa-cog" aria-hidden="true"></i><span>Manage Users</span></a>
                <a href="#"> <i class="fas fa-bookmark" aria-hidden="true"></i><span>Flags</span></a>
                <a href="<?php echo URLROOT;?>/admins/approval"> <i class="fas fa-check-circle" aria-hidden="true"></i><span>Approvals</span></a>
                <!-- <a href="#"> <i class="fas fa-child"></i><span>Help</span></a>        -->
        </div>
    <div class="poster_advertisements">
        <div class="whitebox1">

            <div class="view-report">
                <h4>View report from here</h4>
                <button class="view-report-btn" onclick="viewreport()" >View</button>
            </div>
            <div class="dashboard-content">

                <div class="cardBox">
                   <div class="card"> 
                    <div>
                        <div class="numbers">100</div>
                        <div class="cardName">Users</div>
                    </div>
                    <div class="iconBox">
                    <i class="fa-solid fa-users"></i>
                    </div>
                   </div>

                   <div class="card"> 
                    <div>
                        <div class="numbers">100</div>
                        <div class="cardName">Sellers</div>
                    </div>
                    <div class="iconBox">
                    <i class="fa-solid fa-cart-shopping"></i>                    </div>
                   </div>

                   <div class="card"> 
                    <div>
                        <div class="numbers">100</div>
                        <div class="cardName">Service Providers</div>
                    </div>
                    <div class="iconBox">
                    <i class="fa-solid fa-music"></i>                    </div>
                   </div>

                   <div class="card"> 
                    <div>
                        <div class="numbers">100</div>
                        <div class="cardName">Products</div>
                    </div>
                    <div class="iconBox">
                    <i class="fa-solid fa-headphones"></i>
                    </div>
                   </div>
                </div>

            </div>

            <div class="charts">



            </div>

            <div class="top-rated-sellers">
                <div class="cardHeader">
                    <h4>Top Rated Sellers</h4>
                </div>
                <table class="seller-table">
                    <tr>
                        <td>
                            <div class="imgBx"><img src="<?php echo URLROOT.'/public/uploads/profile/Profile-Pic-square.png';?>"></div>
                        </td>                   
                     </tr>
                </table>




            </div>


        
        </div>        
            
        

    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
<script>
    function viewreport(){
        // var url = 'http://localhost/Audex/admins/adminviewreport/';
        window.location.href="<?php echo URLROOT . '/admins/adminviewreport/';?>"
    }
</script>
</html>