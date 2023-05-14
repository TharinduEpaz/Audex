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
<body>
<?php require_once APPROOT . '/views/admins/navbar.php';?>
    <div class="container">
    <?php require_once APPROOT . '/views/admins/sidebar.php';?>        

    <div class="poster_advertisements">
    <div class="form-display" style="height:auto;padding:20px;">
    <div class="table_container">
        <div class="approval_title"></div>
                     <h3 style="text-align: center;">Sellers who has high ratings</h3><br>
                        <table class="serviceprovider_request">
                            <thead>
                                <tr>
                                
                                <th style="width: 10%;">User ID</th>
                                <th style="width: 60%;">Email</th>
                                <th>First Name</th>
                                <th>Rating</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                
                            
                            <?php foreach ($data['top_rated'] as $detail) : ?>
    
                                    <tr>                                   
                                        <td style="width: 3%;"><?php echo $detail->user_id?></td>
                                        <td style="width: fit-content;"><?php echo $detail->email?></td>
                                        <td> <?php echo $detail->first_name?></td>
                                        <td><?php echo $detail->rate?></td>
                                    </tr>
                            <?php endforeach; ?>
                            </tbody>
                </div>
            </div>
        </div> 

    </div>

</script>





<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
<script>


//keeping the sidebar button clicked at the page
link = document.querySelector('#reports');
    link.style.background = "#E5E9F7";
    link.style.color = "red";
    link.style.fontWeight = "800";


</script>
</html>