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
<style>
    .modal{
        display: none;
        /* border: 1px solid; */
        width: 50vw;
        height: 60vh;
        position: absolute;
        top: 12vh;
        left: 8vw;
        background-color: white;
        padding: 3% 5%;
        background-color: lightgrey;
    border: 2px solid;
    }
    .inp{
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }
    .inp textarea{
        padding: 3%;
    }
    .inp button{
        margin-top: 3vh;
        width: 15%;
        height: 4vh;
        border-radius: 26px;
        border: 1px solid #7373ff;
        color: white;
        font-weight: 800;
        cursor: pointer;
        background-color: #7373ff;
        margin-left: 2%;
    }
</style>
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
                    <div id="modal" class="modal">
                        <form id="form"  method="post">
                            <h3 style="text-align: center;">Suspend User</h3>
                            <div class="inp">
                                <label style="font-weight: 700;" for="reason">Reason:   </label>
                                <textarea name="reason" id="reason" cols="60" rows="13"></textarea>
                            </div>
                            <div class="inp">
                                <button  type="submit">Submit</button>
                                <button onclick="closeModal()" type="button" >Cancel</button>
                            </div>
                        </form>
                    </div>
                    
                    <thead>
                        <tr>
            
                            <th>User-Id</th>
                        <!-- <th>First Name</th> -->
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Suspend/UnSuspend</th>
                        <th>Reason</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['users'] as $user) : ?>
                        
                        
                        <tr>                                   
                        <td><?php echo $user->user_id ?></td>
                        <!-- <td><?php echo $user->first_name ?></td> -->
                        <td><?php echo $user->email ?></td>
                        <td><?php echo ucwords($user->user_type) ?></td>
                        <?php if($user->is_admin_suspend == 0) { ?>
                            <td><a href="#" onclick="openModal(<?php echo $user->user_id?>)">Suspend</a></td>
                        <?php } else { ?>
                        <td><a href="<?php echo URLROOT.'/admins/unsuspend/'.$user->user_id?>">Unsuspend</a></td>
                        <?php } ?>
                        <td style="overflow: auto;"><?php echo $user->admin_suspend_reason ?></td>


                         <?php endforeach; ?>

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

    //modal
    var modal = document.getElementById("modal");
    var body=document.querySelector("body");
    function openModal(id){
        modal.style.display = "block";
        var form=document.getElementById("form");
        form.action="<?php echo URLROOT . '/admins/suspend/';?>"+id;
    }
    function closeModal(){
        modal.style.display = "none";
    }
</script>
</html>