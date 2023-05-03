<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css?id=1425';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/service_provider.css?id=325';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/style.css?id=1445';?>">

    <!-- this is for model -->
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/seller_advertisement.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/rateAndReviewModal.css';?>">


    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Audex</title>
    <style>
    .service-provider-profile {
        margin: auto;
    }
    </style>
</head>

<body>
    <div class="navbar">
        <nav>
            <input type="checkbox" name="check" id="check" onchange="docheck()">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>
            <img src="<?php echo URLROOT . '/public/img/image 1.png';?>" alt="">
            <ul>
                <li><a href="<?php echo URLROOT .'/service_providers/index'?>" class="nav_tags">Home</a></li>
                <li><a href="#" class="nav_tags">Shop</a></li>
                <li><a href="<?php echo URLROOT.'/users/sound_engineers'; ?>" class="nav_tags">Sound Engineers</a></li>


                <li><a href="#" class="nav_tags">Events</a></li>
                <?php if(isset($_SESSION['user_id'])){
                echo '<div class="dropdown">';
                    echo '<button onclick="myFunction()" class="dropbtn">Hi '.$_SESSION['user_name']. ' &nbsp<i class="fa-solid fa-caret-down"></i></button>';
                    echo '<div id="myDropdown" class="dropdown-content">';
                        echo '<a href="'.URLROOT . '/service_providers/profile" class="nav_tags">Profile</a>';
                        echo '<a href="'.URLROOT . '/users/logout" class="nav_tags">Logout</a>';
                    echo '</div>';
                echo '</div> ';
            }
            else{
                echo '<li><a href="'.URLROOT . '/users/login" class="nav_tags">Login</a></li>';
                echo '<li><a href="'.URLROOT.'/users/register" class="nav_tags">Signup</a></li>';
            }
             ?>
            </ul>
        </nav>
    </div>

    <div class="service-provider-profile">
        <div class="white-box">
            <div class="profile-title">
                <div class="profile-pic"> <?php if($data['details']->profile_image): ?>
                    <img src="<?php echo URLROOT . '/public/uploads/Profile/' . $data['details']->profile_image; ?>"
                        id="profile-img">
                    <?php else: ?>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <?php endif; ?></i>
                </div>
                <div class="name-rating">
                    <div class="name">
                        <p id="Name"><?php echo $data['details']->first_name . ' ' . $data['details']->second_name ?>
                        </p>
                        <p id="profession"><?php echo $data['details']->profession?></p>
                    </div>
                    <div class="rating"><span class="rate"><?php echo $data['details']->Rating;?></span>

                        <?php for($i=0; $i<floor($data['details']->Rating); $i++): ?>
                        <i class="fa fa-star"></i>
                        <?php endfor; ?>

                        <?php if(strpos((string)$data['details']->Rating, '.')): ?>
                        <i class="fa fa-star-half-o"></i>
                        <?php endif; ?>
               

                    </div>

                    <div class="add_watch_list">
                        <form id="add_watch_list_service_provider" method="POST" data-op = "add" data-watchLoad ="<?php echo $data['watched'] ; ?>"  >
                            <!-- if user is logged in then he have a _SESSION, if not user id value will be 0  -->
                            <input type="text" name="user_type" value="buyer" hidden>
                            <input type="text" name ="user_id" value= " <?php echo (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0) ; ?>" hidden>
                            <!-- buyer_id -->
                            <input type="text" name="service_provider_id" value="<?php echo $data['details']->user_id ; ?>" hidden >
                            <!-- service_provider_id -->
                            
                            <?php
                            // if not log in then show the button to every one
                            if( !isLoggedIn() ){?>
                                <div class="button-container">
                                    <input type="submit" value="Add To Watchlist" class="watch" id="add-service-provider-to-watchlist" " >
                                </div>
            
                            <?php } else if($_SESSION['user_type'] != 'seller' && $_SESSION['user_type'] != 'service_provider' ){ ?>
                                <!-- if log in then show the button only to buyers -->
                                <div class="button-container">
                                    <input type="submit" value="Add To Watchlist" class="watch" id="add-service-provider-to-watchlist">
                                </div>
                            <?php }?>
                        </form>
                    </div>

                    <?php if(isLoggedIn()){
                    if($_SESSION['user_email']!=$data['user']->email){?>
                    <!-- if user is logged in check user is not equal to seller -->
                        <div class="message_review service_provider">
                            <a  class="message btn" href="<?php echo URLROOT . '/users/chat/'.$data['user']->user_id;?>" class="btn btn-primary">Message</a>
                            <a href="" class="review btn" onclick="openModal(); return false;">Write Review</a>
                        </div>
                    <?php }}else{ ?>
                        <!-- user is not logged in -->
                        <div class="message_review service_provider">
                            <a  class="message btn" href="<?php echo URLROOT . '/users/chat/'.$data['user']->user_id;?>" class="btn btn-primary">Message</a>
                            <a href="" class="review btn" onclick="openModal(); return false;">Write Review</a>
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
            <!-- <a href="<?php echo URLROOT .'/service_providers/settings'?>" class="btn"> Add to WatchList</a> -->
            <div class="profile-info">
                <div class="description">
                    <h1>About me</h1>
                    <p> <?php if($data['details']->description == ''){
                    echo '<span class="red-alert">please complete your profile in the profile settings section</span>';
                }
                else{
                    echo $data['details']->description;
                } ?>

                    </p>
                </div>
                <div class="info-blocks">
                    <div class="info-titles">
                        <span>First Name : </span>
                        <span>Last Name : </span>
                        <!-- <span>Email : </span> -->
                        <span>Address Line 1 : </span>
                        <span>Address Line 2 : </span>
                        <span>Mobile : </span>
                        <span>Profession : </span>
                        <span>Qualifications : </span>
                        <span>Achivements : </span>
                    </div>
                    <div class="info-items">
                        <span><?php echo $data['details']->first_name ?></span>
                        <span><?php echo $data['details']->second_name ?></span>
                        <!-- <span><?php echo $data['details']->email ?></span> -->
                        <span><?php echo $data['details']->address_line_one ?></span>
                        <span><?php echo $data['details']->address_line_two ?></span>
                        <span><?php echo $data['details']->mobile ?></span>
                        <span><?php echo $data['details']->profession ?></span>
                        <span><?php echo $data['details']->qualifications ?></span>
                        <span><?php echo $data['details']->achievements?></span>
                    </div>
                </div>
                

            </div>
            <h2>Events</h2>
            <div class="events">
                <div class=event>
            </div>
            <div class=event>
            </div>
            <div class=event>
            </div>
            <div class=event>
            </div>

            </div>

            <h2>Recent Feed Posts</h2>
            <div class="events">
            <div class=event>
            </div>
            <div class=event>
            </div>
            <div class=event>
            </div>
            <div class=event>
            </div>
            </div>
        </div>



    </div>
    <script>
    /* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }

    //keeping the sidebar button clicked at the page

    // link = document.querySelector('#profile-settings');
    // link.style.background = "#E5E9F7";
    // link.style.color = "red";

    // error = document.querySelector('.red-alert');
    // error.style.color = "#FF0000"

    // editButton = document.querySelector('.btn');

    // if (error) {
    //     editButton.style.animation = "alert 2s ease 0s infinite normal forwards"
    //     editButton.style.color = "#FF0000"
    //     editButton.style.background = "#E5E9F7"
    // }



    // these codes for wtite reviwe form and model

    // get user email(email rater)  using sessions and check user is logged or not
    const emai_rater = <?php
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

        if(emai_rater != "0"){
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
                console.log(feedback);
                console.log(value);

                const url1 = '<?php echo URLROOT?>/users/rateSeller/';
                fetch(url1, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ rating: value,
                                           review:feedback,
                                           emai_rater:emai_rater,
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
    <script src="<?php echo URLROOT . '/public/js/service-provider-watchlist.js';?>"></script>

</body>

</html>