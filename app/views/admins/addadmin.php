<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/addadmin.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/seller_advertisement.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Add admin</title>
</head>
<body>
<?php require_once APPROOT . '/views/admins/navbar.php';?>
    <div class="container">
    <?php require_once APPROOT . '/views/admins/sidebar.php';?>        

    <div class="poster_advertisements_admin">
        <div class="white-box">
            <h1>Add Admin</h1>
        <div class="info-settings">

        <div class="info-titles">
            <span>First Name : </span>
            <span>Last Name : </span>
            <span>Email : </span>
            <span>Address Line 1 : </span>
            <span>Address Line 2 : </span>
            <span>Mobile : </span>
            <span>Password: </span>
            
        </div>
<div class="info-items">
    <form action= "<?php echo URLROOT . '/admins/setDetails/' ?>" method="post">
         <input type="text" name="first_name"  placeholder="" required>
        <input type="text" name="second_name" placeholder="" required>
        <input type="email" name="email" placeholder="" required>
        <input type="text" name="address1" placeholder="" required>
        <input type="text" name="address2" placeholder="" required>
        <input type="number" name="mobile" placeholder="" required>
        <input type="password" name="password" placeholder="" required>
        
        <section class="buttons">

            <button id="save" type="submit">Save</button>
            <button id="cancel" type="reset" onclick="exit()">Cancel</button>
        </section>
    </form>
</div>
    
</div>
        
        </div>        
            
        

    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
<script>
    //keeping the sidebar button clicked at the page
    link = document.querySelector('#manage_users');
    link.style.background = "#E5E9F7";
    link.style.color = "red";
    link.style.fontWeight = "800";

</script>
</html>