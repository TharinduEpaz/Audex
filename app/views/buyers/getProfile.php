<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/seller_advertisement.css';?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Profile</title>
</head>
<body>
<?php require_once APPROOT . '/views/buyers/navbar.php';?>

    
    <div class="container">
        <div class="sidebar">
            <a href="#" class="current"><i class="fas fa-address-card"></i> <span>My Profile</span></a>
            <a href="<?php echo URLROOT . '/users/watchlist';?>"> <i class="far fa-calendar-check" aria-hidden="true"></i><span>Watch List</span></a>
            <a href="#"> <i class="fa fa-comments-o" aria-hidden="true"></i><span>Feedback</span></a>
            <a href="<?php echo URLROOT . '/buyers/reactions';?>"> <i class="fa fa-thumbs-up" aria-hidden="true"></i><span>Reactions</span></a>
            <a href="messages.php"> <i class="fa fa-envelope"></i><span>Messages</span></a>       
        </div>
        <div class="poster_advertisements">
            <div class="form-display"> 
                <h1>My Profile Details</h1>
                <div class="form-data-area">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" value="<?php echo $data['user']->first_name; ?>" disabled>
                </div>
                <div class="form-data-area">
                    <label for="second_name">Second Name:</label>
                    <input type="text" name="second_name" value="<?php echo $data['user']->second_name; ?>" disabled>
                </div>
                <div class="form-data-area">
                    <label for="email">Email:</label>
                    <input type="text" name="email" value="<?php echo $data['user']->email; ?>" disabled>
                </div>
                <div class="form-data-area">
                    <label for="address1">Address Line 1:</label>
                    <input type="text" name="address1" value="<?php echo $data['user']->address1; ?>" disabled>
                </div>
                <div class="form-data-area">
                    <label for="address2">Address Line 1:</label>
                    <input type="text" name="address2" value="<?php echo $data['user']->address2; ?>" disabled>
                </div>
                <div class="form-data-area">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" name="phone_number" value="<?php echo $data['user']->phone_number; ?>" disabled>
                </div>  
            </div> 
            <div class="button-edit-delete">
                <a href="<?php echo URLROOT.'/buyers/editProfile/'.$_SESSION['user_id']; ?>"><button type="submit"  value="Edit" id="edit-button">Edit</button></a>
                
                <form action="<?php echo URLROOT.'/buyers/deleteProfile/'.$_SESSION['user_id']; ?>" method="post">
                    <input type="submit" value="Delete" id="delete-button">
                </form>
            </div>
        </div>
    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>