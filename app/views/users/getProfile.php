<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/seller_advertisement.css';?>">

    <!-- rate and review Modal is for specific styles for rata and review styles for modal -->
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/rateAndReviewModal.css';?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Profile</title>
</head>
<body>
<?php require_once APPROOT . '/views/users/navbar.php';?>

    <div class="container">
        <?php echo flash('rating_message')?>

        <div class="poster_advertisements">

                <!-- <?php echo '<pre>'; print_r($data); echo '</pre>';?> -->

            
            <div class="form-display">
                <div class="top_details">
                    <div class="profile_img">
                        <img src="<?php echo URLROOT . '/public/uploads/'.$data['user']->profile_pic;?>" alt="Profile Picture">
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
                                        
                                        <?php $i--;$j++;} 
                                        while($j<5){ ?>
                                        <i class="fa fa-star-o"></i>
                                        <?php $j++; } ?>
                                        <span>(<?php echo $data['feedbackcount'][0]->count?>)</span>
                            </div>
                            <div class="date">
                                <p>Joined : <?php echo date('Y-m-d',strtotime($data['user']->registered_date));; ?></p>
                            </div>
                        </div>
                        <div class="likes_dislikes">
                        </div>
                    </div>
                </div>
                <div class="details">
                    <div class="forms">
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
                            <label for="phone_number">Phone Number:</label>
                            <input type="text" name="phone_number" value="<?php echo $data['user']->phone_number; ?>" disabled>
                        </div>  

                    </div>
                    <?php if(isLoggedIn()){
                    if($_SESSION['user_email']!=$data['user']->email){?>
                    <!-- if user is logged in check user is not equal to seller -->
                        <div class="message_review">
                            <a  class="message" href="<?php echo URLROOT . '/users/chat/'.$data['user']->user_id;?>" class="btn btn-primary">Message</a>
                            <a href="" class="review" onclick="openModal(); return false;">Write Review</a>
                        </div>
                    <?php }}else{ ?>
                        <!-- user is not logged in -->
                        <div class="message_review">
                            <a  class="message" href="<?php echo URLROOT . '/users/chat/'.$data['user']->user_id;?>" class="btn btn-primary">Message</a>
                            <a href="" class="review" onclick="openModal(); return false;">Write Review</a>
                        </div>
                    <?php } ?>
                        <div id="myModal" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal()" style="float: right; z-index: 1; position: inherit; visibility: visible; opacity:100%;">&times;</span>
                                
                                <div class="review-seller">
                                    <!-- start of review form -->
                                    <div class="review-form">
                                        <div class="review-area-select-star">
                                            <label for="select">Rate:</label>
                                            <div class="star-rating">
                                                <i class="fa fa-star star" data-value="1"></i>
                                                <i class="fa fa-star star" data-value="2"></i>
                                                <i class="fa fa-star star" data-value="3"></i>
                                                <i class="fa fa-star star" data-value="4"></i>
                                                <i class="fa fa-star star" data-value="5"></i>
                                            </div>
                                        </div>
                                        <div class="feedback-area">
                                            <form action="" method="post" id="review-write-form">


                                                <label for="review">Review:</label>
                                                <textarea  name="review" rows="4" id="submitted-feedback"  ></textarea>
                                                <!-- <?php echo $data['loadFeedback'] ?> -->
                                                <!-- <?php flash('rating_message');?> -->
                                                <input type="submit" value="Submit" id="submit-review-btn">

                                            </form>
                                        </div>

                                    </div>
                                    <!-- end of review form -->
                                </div>
                            </div>
                        </div>

                </div>
            </div> 
        </div>
    </div>
    <h1 style="text-align: center;margin-bottom:2vh;"><?php echo '('.$data['feedbackcount'][0]->count.') '?>Feedbacks</h1>
    <div class="feedback" style="font-size:16pt;font-weight:800;">
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
        <div class="feedback">
            <div class="feed">
                <h5><?php echo $feedback->review; ?></h5>
            </div>
            <div class="from">
                <h5><?php echo $feedback->email_rater[0]. $feedback->email_rater[1]. $feedback->email_rater[2]. $feedback->email_rater[3].'****'.$feedback->email_rater[-4].$feedback->email_rater[-3].$feedback->email_rater[-2].$feedback->email_rater[-1]?></h5>
            </div>
            <div class="rate">
                <div class="stars">
                <?php $i=$feedback->rate;
                                        $j=0;
                                        for($i; $i>=1; $i--){?>
                                        <i class="fa fa-star"></i>
                                        <?php  $j++;} ?>
                                        
                                        <?php if($i>0){ ?>
                                        <i class="fa fa-star-half-o"></i>
                                        
                                        <?php $i--;$j++;} 
                                        while($j<5){ ?>
                                        <i class="fa fa-star-o"></i>
                                        <?php $j++; } ?>
                </div>
            </div>
        </div>
            
    <?php endforeach; ?>
</body>
<script>


    
    // get user email(email rater)  using sessions and check user is logged or not
    const email_rater = <?php
                    if (isLoggedIn()) {
                        echo "'".$_SESSION['user_email']."'";
                    }
                    else{
                        echo "0";
                    }
                ?>;
    // get rate receiver's email form profile
    const email_rate_receiver = <?php echo "'".$data['user']->email."'"; ?>;

    
    
    

    function openModal() {
        reviewWriteForm = document.getElementById("review-write-form");
        const stars = document.querySelectorAll('.star-rating .star');
        var value = '';
        
		var modal = document.getElementById("myModal");
		modal.style.display = "block";
            
        // rate functionality======================================================================================================================

        if(email_rater != "0"){
            // user is logged in
       
            for (const star of stars) {
                star.addEventListener('click', function () {
                    value = parseFloat(this.getAttribute('data-value'));

                        for (const star of stars) {
                            star.classList.remove('selected');
                        }
                
                        for (let i = 0; i < value; i++) {
                            stars[i].classList.add('selected');
                        }
                        // document.getElementById('buyer-selected-rate').value = value;
                        // document.getElementById('current-seller-rate').value = data.results4;
                    
                });
            }
            reviewWriteForm.addEventListener("submit",(e)=>{
                // e.preventDefault();
                //get the form data/sumitted data
                const feedback = document.getElementById('submitted-feedback').value;
                // console.log(feedback);
                // console.log(value);

                const url1 = '<?php echo URLROOT?>/users/rateSeller/';

                // console.log(url1);

                fetch(url1, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ rating: value,
                                           review:feedback,
                                           email_rater:email_rater,
                                           email_rate_receiver:email_rate_receiver,
                                        }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data.message);
            
                    for (const star of stars) {
                     star.classList.remove('selected');
                    }
            
                    for (let i = 0; i < value; i++) {
                     stars[i].classList.add('selected');
                    }
                    // document.getElementById('buyer-selected-rate').value = value;
                    // document.getElementById('current-seller-rate').value = data.results4;
                })
                .catch(error => {
                    console.error(error);
                });
            });

        }
        else{
            //user is not logged in 
            <?php $_SESSION['url']=URL();?>
            window.location.href = '<?php echo URLROOT?>/users/login/';
        }

           
    }

    function closeModal() {
		var modal = document.getElementById("myModal");
		modal.style.display = "none";
	}
    // When the user clicks anywhere outside of the modal, close it
	var modal = document.getElementById("myModal");

    window.addEventListener("click", function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });


</script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>