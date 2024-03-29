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
    <div class="form-display">
    <div class="table_container">
        <div class="approval_title"><h1 style="text-align: center;"> Service Provider Approvals</h1></div>
                    <table class="serviceprovider_request">
                        <thead>
                            <tr>
                            
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Payment</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        
                        <?php foreach ($data['details'] as $detail) : ?>

                                <tr>                                   
                                    <td><?php echo $detail->first_name?></td>
                                    <td><?php echo $detail->second_name?></td>
                                    <td> <?php echo $detail->email?></td>
                                    <td><?php if($detail->is_paid==0){echo 'No';}else{echo 'Yes';}?></td>
                                    <td>
                                        <div class="btn-container">
                                            <button id="view_btn" class="view-button" onclick="viewspprofile(<?php echo $detail->user_id?>)">view</button>
                                             
                                            <!-- <button id="approve_btn" class="approve-button">Approve</button> -->
                                            <!-- <button id="ignore_btn" class="ignore-button">Ignore</button> -->
                                        </div>  
                                    </td>
                                </tr>
                        <?php endforeach; ?>
                            
                        
                            
                        </tbody>
                    </table>
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
 //keeping the sidebar button clicked at the page
 link = document.querySelector('#approvals');
    link.style.background = "#E5E9F7";
    link.style.color = "red";
    link.style.fontWeight = "800";


</script>
</html>