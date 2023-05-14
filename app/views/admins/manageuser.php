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
    <?php require_once APPROOT . '/views/admins/sidebar.php';?>        

    <div class="poster_advertisements">
        <div class="whitebox" style ="height:auto">
          
            <div class="section2">
                <h3>Admins</h3>

                <table class="admin-table">

                <thead>
                            <tr>
                            
                            <th>First Name</th>
                            <th>Second Name</th>
                            <th>Email</th>
                            <th>registered date</th>
                           
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data['admins'] as $admins) : ?>
                            
                        
                                     <tr>                                   
                                    <td><?php echo $admins->first_name?></td>
                                    <td><?php echo $admins->second_name?></td>
                                    <td><?php echo $admins->email?></td>
                                    <td><?php echo $admins->registered_date?></td>


                        <?php endforeach; ?>

                </table>

            </div>
            
            
            <div class="section3">
                <h1> Add a new admin
                <a href="<?php echo URLROOT .'/admins/addadmin'?>" class="btn1"> click</a></button>
            </div>
        
            </div>  
        
        
                <div class="user-list">

                <h3>Users</h3>

                <table class="user-table">

                <thead>
                    <tr>
            
                        <th>User-Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email date</th>
                        <th>User user type</th>
                        </tr>
                </thead>
                <tbody>
                        <!-- <?php foreach ($data['admins'] as $admins) : ?> -->
            
        
                        <tr>                                   
                        <td>1</td>
                        <td>lahiru</td>
                        <td>kavishka</td>
                        <td>123@gmail.com</td>
                        <td>seller</td>


                         <!-- <?php endforeach; ?> -->

                    </table>

                            
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