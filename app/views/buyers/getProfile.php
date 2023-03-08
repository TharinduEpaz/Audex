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
            <?php echo flash('post_message');?>
            <?php echo flash('phone_message');?>
            <?php echo flash('phone_message1');?>
            <?php echo flash('photo_message');?>
            <div class="form-display">
                <div class="top_details">
                    <div class="profile_img">
                        <img src="<?php echo URLROOT . '/public/uploads/'.$data['user']->profile_pic;?>" alt="Profile Picture">
                        <div class="input">
                            <a href="" class="edit" onclick="openModal(); return false;">Edit</a>
                            <!-- <a class="edit" href="<?php echo URLROOT.'/users/edit_profile_picture/'.$data['user']->user_id?>">Edit</a> -->
                            <!-- <a class="edit" href="<?php echo URLROOT.'/users/edit_profile_picture/'.$data['user']->user_id?>">Edit</a> -->
                        </div>
                        <div id="myModal" class="modal">
                            <div class="modal-content">

                                <span class="close" onclick="closeModal()">&times;</span>
                                <div class="img">
                                    <form  id="form" action="<?php URLROOT.'users/edit_profile_picture/'.$data['user']->user_id?>" method="post" enctype="multipart/form-data">
                                    
                                    <input type="file" name="image1" id="file" class="custom-file-input">
                                    <input type="submit" value="Upload">
                                    </form>
                                    <a href="" class="post" onclick="closeModal(); return false;">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="other_details_profile">
                        <p class="full_name"><?php echo $data['user']->first_name.' '.$data['user']->second_name; ?></p>
                        <div class="stars_date">
                            <div class="stars">
                            <?php $i=0;
                                        for($i; $i<floor($data['buyer']->rate); $i++): ?>
                                        <i class="fa fa-star"></i>
                                        <?php endfor; ?>
                                        
                                        <?php if(strpos((string)$data['buyer']->rate, '.')){ ?>
                                        <i class="fa fa-star-half-o"></i>
                                        
                                        <?php  $i++; } 
                                        while($i<5){ ?>
                                        <i class="fa fa-star-o"></i>
                                        <?php $i++; } ?>
                            </div>
                            <div class="date">
                                <p>Joined : <?php echo date('Y-m-d',strtotime($data['user']->registered_date));; ?></p>
                            </div>
                        </div>
                        <div class="likes_dislikes">
                            <div class="flags">
                            <i class="fa-sharp fa-solid fa-flag"> : 0</i>

                            </div>
                        </div>
                    </div>
                </div>
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
                    <a style="margin-left: 2%;" href="<?php echo URLROOT.'/users/change_email/'.$data['user']->user_id;?>">Change</a>
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
                    <label for="password">Password</label>
                    <input type="text" name="password" value="*********" disabled>
                    <a style="margin-left: 2%;" href="<?php echo URLROOT.'/users/change_password/'.$data['user']->user_id;?>">Change</a>
                </div>
                <div class="form-data-area">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" name="phone_number" value="<?php echo $data['user']->phone_number; ?>" disabled>
                    <a style="margin-left: 2%;" href="<?php echo URLROOT.'/users/change_phone/'.$data['user']->user_id;?>"><?php if($data['user']->phone_number!=NULL){ echo "Change";}else{ echo "Add";}?></a>
                    
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
<script>
    function openModal() {
			var modal = document.getElementById("myModal");
			modal.style.display = "block";
            const form= document.getElementById("form");
            form.addEventListener('submit',e=>{
                e.preventDefault();
                const data= new FormData(form);
                for(const pair of data.entries()){
                    console.log(`${pair[0]}+', '+${pair[1]}`);
                }
                fetch("<?php echo URLROOT.'/users/edit_profile_picture/'.$data['user']->user_id?>",{
                    method:'POST',
                    body:data
                }).then(res=>res.json())
                .then(data=>{
                    // console.log(data);
                    window.location.href="<?php echo URLROOT.'/buyers/getProfile/'.$data['user']->user_id; ?>";
                    // closeModal();
                })
            });
           
	}
    function closeModal() {
			var modal = document.getElementById("myModal");
			modal.style.display = "none";
	}

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
	  var modal = document.getElementById("myModal");

      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
</script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>