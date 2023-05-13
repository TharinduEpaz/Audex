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
<!-- internal CSS begins -->
<style>
  .form-display1 {
    padding:40px;
    display: flex;
    flex-direction: row;
    align-items: flex-start;
  }

  .form-data-area:last-child {
    margin-bottom: 20px;
  }

  .profile-pic {
    display: flex;
    align-items:flex-start;
  }

  .profile-pic img {
    width: 200px;
    height: 200px;
    border-radius: 20px;
    object-fit: cover;
  }

  .middle {
    /* display: grid;
    grid-template-columns: repeat(2,1fr);
    grid-gap: 200px;
     */
     display:flex;
     flex-direction:column;
     gap:20px;


}



.profile-pic{
  display:flex;
  justify-content:center;
  align-items:center;
  padding:20px;
  padding-top:50px;
}
</style>
<!-- internal CSS over -->


<?php require_once APPROOT . '/views/admins/navbar.php';?>
    <div class="container">
        <div class="sidebar">
                <a  href="<?php echo URLROOT;?>/admins/profiletest"><i class="fas fa-qrcode"></i> <span>My Profile</span></a>
                <a href="<?php echo URLROOT;?>/admins/manageuser"> <i class="fa fa-cog" aria-hidden="true"></i><span>Manage Users</span></a>
                <a href="#"> <i class="fas fa-bookmark" aria-hidden="true"></i><span>Flags</span></a>
                <a class="current" href="<?php echo URLROOT;?>/admins/approval"> <i class="fas fa-check-circle" aria-hidden="true"></i><span>Approvals</span></a>
                <a href="#"> <i class="fas fa-child"></i><span>Help</span></a>       
        </div>
    <div class="poster_advertisements">
    <div class="form-display1">
    <h1>SP Profile Details</h1>
  
        <div class="middle">
            <div class="detailarea">
            <div class="profile-pic"> <?php if ($data['details'][0]->profile_image) : ?>
                            <img src="<?php echo URLROOT . '/public/uploads/Profile/' . $data['details'][0]->profile_image; ?>" id="profile-img">
                        <?php else : ?>
                            <i class="fa fa-user" aria-hidden="true"></i>
                        <?php endif; ?></i>
                    </div>

                <div class="form-data-area">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" placeholder="<?php echo $data['details'][0]->first_name; ?>" disabled>
                    
                    
                </div>
                <div class="form-data-area">
                    <label for="second_name">Second Name:</label>
                    <input type="text" name="second_name" placeholder="<?php echo $data['details'][0]->second_name; ?>" disabled>
                </div>
                <div class="form-data-area">
                    <label for="phone_number">Second Name:</label>
                    <input type="text" name="phone_number" placeholder="<?php echo $data['details'][0]->phone_number; ?>" disabled>
                </div>
               
                <div class="form-data-area">
                    <label for="qualifications">Qualifications:</label>
                    <input type="text" name="qualifications" placeholder="<?php echo $data['details'][0]->qualifications; ?>" disabled>
                </div>
                <div class="form-data-area">
                    <label for="achievements">Achievements:</label>
                    <input type="text" name="achievements" placeholder="<?php echo $data['details'][0]->achievements; ?>" disabled>
                </div>
                <div class="form-data-area">
                    <label for="description">Description:</label>
                    <!-- <input type="text" name="description" placeholder="<?php echo $data['details'][0]->description; ?>" disabled> -->
                    <textarea style="border:none;margin-top:10px;background-color:#e5e9f7; padding:10px; border-radius:10px;padding-top:5px" name="" id="" cols="52" rows="10" placeholder="<?php echo $data['details'][0]->description; ?>"></textarea>
                
                </div> 
            </div>
            
                <div class ="section_1">

                    <div class="pdf-approve">
                    <?php if ($data['details'][0]->approve_document == NULL): ?>
                        <?php echo "Data not provided"; ?>
                    <?php else: ?>
                        <embed src="<?php echo URLROOT . '/public/uploads/approve/' . $data['details'][0]->approve_document; ?>" width="500" height="375" type="application/pdf">
                    <?php endif; ?>
                    
                    </div>


                        <form clsss="form-ignore" action="<?php echo URLROOT . '/admins/ignoresp?id=' . $data['details'][0]->user_id;?>" method="POST">
                        <label for="ignore-reason">Reason to Ignore</label>
                        <input type="text" name="ignore-reason" id="ignore_reason" placeholder="" required>
                        <br>
                        <input type="submit" value="Ignore">    
                        </form>

                        <form class="form-approve" action="<?php echo URLROOT . '/admins/approvesp?id=' . $data['details'][0]->user_id .'?admin_ignored='. $data['details'][0]->admin_ignored ?>" method="POST">
                        <input type="submit" value="Approve">    
                        </form>

                        
                        <button id="back_btn" class="back-button" onclick="getbacktoapproval()">Back</button>
                    
                 </div>
            </div> 
        </div>

            </div>
        </div> 

    </div>

    
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
<script>
    function getbacktoapproval() {
    var url = 'http://localhost/Audex/admins/approval';
    window.open(url, '_self');
}

</script>

</html>