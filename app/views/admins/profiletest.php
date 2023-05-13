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
                <a class="current" href="<?php echo URLROOT;?>/admins/profile"><i class="fas fa-qrcode"></i> <span>My Profile</span></a>
                <a href="<?php echo URLROOT;?>/admins/manageuser"> <i class="fa fa-cog" aria-hidden="true"></i><span>Manage Users</span></a>
                <a href="#"> <i class="fas fa-bookmark" aria-hidden="true"></i><span>Flags</span></a>
                <a href="<?php echo URLROOT;?>/admins/approval"> <i class="fas fa-check-circle" aria-hidden="true"></i><span>Approvals</span></a>
                <a href="#"> <i class="fas fa-child"></i><span>Help</span></a>       
        </div>
        <div class="poster_advertisements">
        <div class="form-display"> 
            <!-- <?php echo $_SESSION['user_id'];?> -->
                <h1>My Profile Details</h1>
                <div class="form-data-area">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" value="<?php echo $data['details']->first_name; ?>" disabled>
                </div>
                <div class="form-data-area">
                    <label for="second_name">Second Name:</label>
                    <input type="text" name="second_name" value="<?php echo $data['details']->second_name; ?>" disabled>
                </div>
                <div class="form-data-area">
                    <label for="email">Email:</label>
                    <input type="text" name="email" value="<?php echo $data['details']->email; ?>" disabled>
                </div>
                <div class="form-data-area">
                    <label for="address1">Address Line 1:</label>
                    <input type="text" name="address1" value="<?php echo $data['details']->address1; ?>" disabled>
                </div>
                <div class="form-data-area">
                    <label for="address2">Address Line 2:</label>
                    <input type="text" name="address2" value="<?php echo $data['details']->address2; ?>" disabled>
                </div>
                <div class="form-data-area">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" name="phone_number" value="<?php echo $data['details']->phone_number; ?>" disabled>
                </div>  
            </div> 

            <div class="button-edit-delete">
                <a href="<?php echo URLROOT.'/admins/editProfile/'.$_SESSION['user_id']; ?>"><button type="submit"  value="Edit" id="edit-button">Edit</button></a>
                
               <!-- <form action="<?php echo URLROOT.'/buyers/deleteProfile/'.$_SESSION['user_id']; ?>" method="post"> -->
                    <!-- <input type="submit" value="Delete" id="delete-button"> -->
                <!-- </form> -->
            </div>

        </div> 

    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>