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
<style>
    .upload{
      width: 140px;
      position: relative;
      margin: auto;
      text-align: center;
    }
    .upload img{
      border-radius: 50%;
      /* border: 8px solid #DCDCDC; */
      width: 100px;
      height: 100px;
    }
    .upload .rightRound{
      position: absolute;
      bottom: 0;
      right: 0;
      background: #00B4FF;
      width: 32px;
      height: 32px;
      line-height: 33px;
      text-align: center;
      border-radius: 50%;
      overflow: hidden;
      cursor: pointer;
    }
    .upload .leftRound{
      position: absolute;
      bottom: 0;
      left: 0;
      background: red;
      width: 32px;
      height: 32px;
      line-height: 33px;
      text-align: center;
      border-radius: 50%;
      overflow: hidden;
      cursor: pointer;
    }
    .upload .fa{
      color: white;
    }
    .upload input{
      position: absolute;
      transform: scale(2);
      opacity: 0;
    }
    .upload input::-webkit-file-upload-button, .upload input[type=submit]{
      cursor: pointer;
    }
    #form{
        margin-left: -10%;
        margin-top: 0%;
        width: 0%;
        flex-direction: row;
    }
</style>
<body>
<?php require_once APPROOT . '/views/buyers/navbar.php';?>

    
    <div class="container">
    <?php require_once APPROOT . '/views/buyers/sidebar.php';?>
        <div class="poster_advertisements">
            <?php echo flash('post_message');?>
            <?php echo flash('phone_message');?>
            <?php echo flash('phone_message1');?>
            <?php echo flash('photo_message');?>
            <div class="form-display">
                <div class="top_details">
                    <div class="profile_img">
                    <form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
                            <div class="upload">                    
                              <img id="image" src="<?php echo URLROOT . '/public/uploads/'.$data['user']->profile_pic;?>" alt="Profile Picture">
                            <div class="rightRound" id = "upload">
                              <input type="file" name="image1" id = "image1" accept=".jpg, .jpeg, .png">
                              <i class = "fa fa-camera"></i>
                            </div>
                    
                            <div class="leftRound" id = "cancel" style = "display: none;">
                              <i class = "fa fa-times"></i>
                            </div>
                            <div class="rightRound" id = "confirm" style = "display: none;">
                              <input type="submit">
                              <i class = "fa fa-check"></i>
                            </div>
                          </div>
                        </form>
                    </div>
                    <div class="other_details_profile">
                        <p class="full_name"><?php echo $data['user']->first_name.' '.$data['user']->second_name; ?></p>
                        <div class="stars_date">
                            <div class="stars">
                            <?php $i=$data['user']->rate;
                                        $j=0;
                                        for($i; $i>=1; $i--){?>
                                        <i class="fa fa-star"></i>
                                        <?php  $j++;} ?>
                                        
                                        <?php if($i>0){ ?>
                                        <i class="fa fa-star-half-o"></i>
                                        
                                        <?php $i--;} 
                                        while($j<5){ ?>
                                        <i class="fa fa-star-o"></i>
                                        <?php $j++; } ?>
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
                    <span style="width:16px;margin-left: 2%;"></span>
                </div>
                <div class="form-data-area">
                    <label for="second_name">Second Name:</label>
                    <input type="text" name="second_name" value="<?php echo $data['user']->second_name; ?>" disabled>
                    <span style="width:16px;margin-left: 2%;"></span>
                </div>
                <div class="form-data-area">
                    <label for="email">Email:</label>
                    <input type="text" name="email" value="<?php echo $data['user']->email; ?>" disabled>
                    <a style="margin-left: 2%;" href="<?php echo URLROOT.'/users/change_email/'.$data['user']->user_id;?>"><i class="fas fa-edit"></i></a>
                </div>
                <div class="form-data-area">
                    <label for="address1">Address Line 1:</label>
                    <input type="text" name="address1" value="<?php echo $data['user']->address1; ?>" disabled>
                    <span style="width:16px;margin-left: 2%;"></span>
                </div>
                <div class="form-data-area">
                    <label for="address2">Address Line 1:</label>
                    <input type="text" name="address2" value="<?php echo $data['user']->address2; ?>" disabled>
                    <span style="width:16px;margin-left: 2%;"></span>
                </div>
                <div class="form-data-area">
                    <label for="password">Password</label>
                    <input type="text" name="password" value="*********" disabled>
                    <a style="margin-left: 2%;" href="<?php echo URLROOT.'/users/change_password/'.$data['user']->user_id;?>"><i class="fas fa-edit"></i></a>
                </div> 
                <div class="form-data-area">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" name="phone_number" value="<?php echo $data['user']->phone_number; ?>" disabled>
                    <a style="margin-left: 2%;" href="<?php echo URLROOT.'/users/change_phone/'.$data['user']->user_id;?>"><?php if($data['user']->phone_number!=NULL){ echo "<i class='fas fa-edit'></i>";}else{ echo "<i class='fa-solid fa-plus  style='color: #0b0f64;''></i>";}?></a>
                    
                </div>  
            </div> 
            <div class="button-edit-delete">
                <a href="<?php echo URLROOT.'/buyers/editProfile/'.$_SESSION['user_id']; ?>"><button type="submit"  value="Edit" id="edit-button"><i class="fas fa-edit"></i> Edit</button></a>
                
                <form action="<?php echo URLROOT.'/buyers/deleteProfile/'.$_SESSION['user_id']; ?>" method="post">
                    <input type="submit" value="Delete" id="delete-button">
                </form>
            </div>
        </div>
    </div>
    <h1 class="feedback"><?php echo '('.$data['feedbackcount'][0]->count.') '?>Feedbacks</h1>
    <div class="feedback" >
        <div class="feed" style="text-align: center;">
            <h4>Review</h4>
        </div>
        <div class="from" style="text-align: left;">
            <h4>From</h4>
        </div>
        <div class="rate" style="text-align: left;">
            <h4>Rate</h4>
        </div>
    </div>
    <?php foreach($data['feedbacks'] as $feedback): ?>
        <div class="feedback" >
            <div class="feed">
                <h5><?php echo $feedback->review; ?></h5>
            </div>
            <div class="from">
                <h5><?php echo $feedback->email_rater[0]. $feedback->email_rater[1]. $feedback->email_rater[2]. $feedback->email_rater[3].'****'.$feedback->email_rater[-4].$feedback->email_rater[-3].$feedback->email_rater[-2].$feedback->email_rater[-1]?></h5>
            </div>
            <div class="rate">
                <div class="stars">
                <?php $i=$data['user']->rate;
                                        $j=0;
                                        for($i; $i>=1; $i--){?>
                                        <i class="fa fa-star"></i>
                                        <?php  $j++;} ?>
                                        
                                        <?php if($i>0){ ?>
                                        <i class="fa fa-star-half-o"></i>
                                        
                                        <?php $i--;} 
                                        while($j<5){ ?>
                                        <i class="fa fa-star-o"></i>
                                        <?php $j++; } ?>
                </div>
            </div>
        </div>
            
    <?php endforeach; ?>
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

    document.getElementById("image1").onchange = function(){
        document.getElementById("image").src = URL.createObjectURL(image1.files[0]); // Preview new image

        document.getElementById("cancel").style.display = "block";
        document.getElementById("confirm").style.display = "block";

        document.getElementById("upload").style.display = "none";
      }

      var userImage = document.getElementById('image').src;
      document.getElementById("cancel").onclick = function(){
        document.getElementById("image").src = userImage; // Back to previous image

        document.getElementById("cancel").style.display = "none";
        document.getElementById("confirm").style.display = "none";

        document.getElementById("upload").style.display = "block";
      }
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

    //keeping the sidebar button clicked at the page
    link = document.querySelector('#profile');
    link.style.background = "#E5E9F7";
    link.style.color = "red";
    link.style.fontWeight = "800";
</script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>