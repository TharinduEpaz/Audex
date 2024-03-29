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
        <?php require_once APPROOT . '/views/buyers/sidebar.php';?>        
        <div class="poster_advertisements">
            <form action="" method="POST" class="form-display-data" >
                <div class="form-display"> 
                    <h1>Edit Profile Details</h1>
                    <div class="form-data-area">
                        <label for="first_name">First Name:<sup>*</sup></label>
                        <input type="text" name="first_name" value="<?php echo $data['first_name']; ?>" class="<?php echo (!empty($data['first_name_err'])) ? 'invalid' : '' ; ?>" >
                    </div>
                    <div class="form-data-area">
                        <label for="second_name">Second Name:</label>
                        <input type="text" name="second_name" value="<?php echo $data['second_name']; ?>" class="<?php echo (!empty($data['second_name_err'])) ? 'invalid' : '' ; ?>">
                    </div>
                    <div class="form-data-area">
                        <label for="email">Email:</label>
                        <input type="text" name="email" value="<?php echo $data['email']; ?>" disabled>
                    </div>
                    <div class="form-data-area">
                        <label for="address1">Address Line 1:<sup>*</sup></label>
                        <input type="text" name="address1" value="<?php echo $data['address1']; ?>" class="<?php echo (!empty($data['address1_err'])) ? 'invalid' : '' ; ?>" >
                    </div>
                    <div class="form-data-area">
                        <label for="address2">Address Line 1:</label>
                        <input type="text" name="address2" value="<?php echo $data['address2']; ?>" class="<?php echo (!empty($data['address2_err'])) ? 'invalid' : '' ; ?>" >
                    </div>
                    <div class="form-data-area">
                        <label for="phone_number">Phone Number:<sup>*</sup></label>
                        <input type="text" name="phone_number" value="<?php echo $data['phone_number']; ?>" class="<?php echo (!empty($data['phone_number_err'])) ? 'invalid' : '' ; ?>" disabled>
                    </div>  
                </div>
                <input type="submit"  value="Save" id="edit-button"  >
            </form>   
           
        </div>
    </div>
</body>
<script>
    //keeping the sidebar button clicked at the page
    link = document.querySelector('#profile');
    link.style.background = "#E5E9F7";
    link.style.color = "red";
    link.style.fontWeight = "800";
</script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>