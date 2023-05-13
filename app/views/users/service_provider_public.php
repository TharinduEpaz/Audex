<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css?id=1425'; ?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/service_provider.css?id=325'; ?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/style.css?id=1445'; ?>">

    <!-- this is for model -->
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/seller_advertisement.css'; ?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/rateAndReviewModal.css'; ?>">


    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Audex</title>
    <style>
        .service-provider-profile {
            margin: auto;
            padding-left: 10vw;
            padding-right: 10vw;
        }

        .white-box {
            margin: 0;

        }
    </style>
</head>

<body>
    <?php require_once APPROOT . '/views/users/navbar.php'; ?>

    <!-- <div class="navbar">
        <nav>
            <input type="checkbox" name="check" id="check" onchange="docheck()">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>
            <img src="<?php echo URLROOT . '/public/img/image 1.png'; ?>" alt="">
            <ul>
            <li><a href="<?php echo URLROOT; ?>/users/index" class="nav_tags">Home</a></li>
            <li><a href="<?php echo URLROOT . '/users/shop'; ?>" class="nav_tags">Shop</a></li>
            <li><a href="<?php echo URLROOT . '/users/sound_engineers'; ?>" class="nav_tags">Sound Engineers</a></li>
            <li><a href="#" class="nav_tags">Events</a></li>
            <li><a href="<?php echo URLROOT . '/users/sound_engineers'; ?>" class="nav_tags">Event Calendar</a></li>


                <li><a href="#" class="nav_tags">Events</a></li>
                <?php if (isset($_SESSION['user_id'])) {
                    echo '<div class="dropdown">';
                    echo '<button onclick="myFunction()" class="dropbtn">Hi ' . $_SESSION['user_name'] . ' &nbsp<i class="fa-solid fa-caret-down"></i></button>';
                    echo '<div id="myDropdown" class="dropdown-content">';
                    echo '<a href="' . URLROOT . '/service_providers/profile" class="nav_tags">Profile</a>';
                    echo '<a href="' . URLROOT . '/users/logout" class="nav_tags">Logout</a>';
                    echo '</div>';
                    echo '</div> ';
                } else {
                    echo '<li><a href="' . URLROOT . '/users/login" class="nav_tags">Login</a></li>';
                    echo '<li><a href="' . URLROOT . '/users/register" class="nav_tags">Signup</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div> -->

    <div class="service-provider-profile">
        <div class="white-box">

            <div class="profile-title">
                <div class="profile-pic"> <?php if ($data['details']->profile_image) : ?>
                        <img src="<?php echo URLROOT . '/public/uploads/Profile/' . $data['details']->profile_image; ?>" id="profile-img">
                    <?php else : ?>
                        <i class="fa fa-user" aria-hidden="true"></i>
                    <?php endif; ?></i>
                </div>

                <div class="name-rating">
                    <div class="name">
                        <p id="Name"><?php echo $data['details']->first_name . ' ' . $data['details']->second_name ?>
                        </p>
                        <i class="fa fa-map-marker" aria-hidden="true"></i><span id="profession"><?php echo $data['details']->address_line_two ?></span>
                    </div>
                    <div class="rating">

                    <?php for ($i = 0; $i < floor($data['details']->Rating); $i++) : ?>
                        <i class="fa fa-star"></i>
                    
                    <?php endfor; ?>
                    <?php if (strpos((string)$data['details']->Rating, '.')) : ?>
                        <i class="fa fa-star-half-o"></i>
                    <?php endif; ?>
                    <?php for ($i = 0; $i < 5 - ceil($data['details']->Rating); $i++) : ?>
                        <i class="fa fa-star-o"></i>
                    
                    <?php endfor; ?>

                    </div>
                    <?php if($data['approval']->admin_approved == 1): ?>
            <button id="approved" class="btn" onclick="gotoSettings()"><i class="fa fa-check-circle" style="margin-right:10px" aria-hidden="true" disabled></i>APPROVED BY AUDEX</button>
            <?php elseif($data['approval']->admin_ignored == 1): ?>
            <button id="ignored" class="btn" onclick="gotoSettings()"><i class="fa fa-times-circle" style="margin-right:10px" aria-hidden="true"></i>APPROVAL ERROR</button>
            
            <?php elseif($data['approval']->approve_document != ''): ?>
                <button id="ignored" class="btn" onclick="gotoSettings()"><i class="fa fa-times-circle" style="margin-right:10px" aria-hidden="true"></i>APPROVAL PENDING</button>


            <?php else: ?>
            <button id="not-approved" class="btn" onclick="gotoSettings()"><i class="fa fa-times-circle" style="margin-right:10px" aria-hidden="true"></i>NOT APPROVED BY AUDEX</button>
            <?php endif; ?>


                    <!-- <?php echo $data['watched']; ?> -->


                    <!-- ADD TO WATCH LIST  -->
                    <div class="dinesh-wrapper">
                        <div class="add_watch_list">
                            <form id="add_watch_list_service_provider" method="POST" data-op="add" data-watchLoad=" ">
                                <!-- if user is logged in then he have a _SESSION, if not user id value will be 0  -->
                                <input type="text" name="user_type" value="buyer" hidden>
                                <input type="text" name="user_id" value=" <?php echo (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0); ?>" hidden>
                                <!-- buyer_id -->
                                <input type="text" name="service_provider_id" value="<?php echo $data['details']->user_id; ?>" hidden>
                                <!-- service_provider_id -->
                                
                                <?php
                                // if not log in then show the button to every one
                                if (!isLoggedIn()) { ?>
                                    
                                    <input type="submit" value="Add To Watchlist" class="watch" id="add-service-provider-to-watchlist" >
                                    
                                    
                                    <?php } else if ($_SESSION['user_type'] != 'seller' && $_SESSION['user_type'] != 'service_provider') { ?>
                                        <!-- if log in then show the button only to buyers -->
                                        
                                        <input type="submit" value="Add To Watchlist" class="watch" id="add-service-provider-to-watchlist">
                                        <?php } ?>
                                    </form>
                                    <button class='message btn'  onclick="getCalander(<?php echo $data['details']->user_id?>)">Get calander</button>
                        </div>

                        <?php if (isLoggedIn()) {
                            if ($_SESSION['user_email'] != $data['user']->email) { ?>
                                <!-- if user is logged in check user is not equal to seller -->
                                <div class="message_review service_provider">
                                    
                                    <a class="message btn" href="<?php echo URLROOT . '/users/chat/' . $data['user']->user_id; ?>" class="btn btn-primary">Message</a>

                                    <!-- hide this button if there is no events -->
                                    <?php if( sizeof($data['events']) ){?>
                                        <a href="" class="review btn" onclick="openModal(); return false;">Write Review</a>
                                    <?php } ?>
                                </div>
                            <?php }
                        } else { ?>
                            <!-- user is not logged in -->
                            
                                <a class="message btn" href="<?php echo URLROOT . '/users/chat/' . $data['user']->user_id; ?>" class="btn btn-primary">Message</a>
                                
                                <a href="" class="review btn" onclick="openModal(); return false;">Write Review</a>
                           
                        <?php } ?>

                    </div>




                    <!-- REVIEW MODEL IS HERE -->

                    <div id="myModal" class="modal">
                        <div class="modal-content serviceProvider">
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
                                    <div class="event-date-select">
                                        <!-- show the event dates according to event name -->
                                        <label for="event-date">Event Date:</label>
                                        <select id="event-date" name="event-date">
                                            <!-- load only first date according to first event of array -->
                                            <?php foreach ($data['events'] as $event) { ?>
                                                <option value="<?php echo $event->date ?>"><?php echo $event->date ?></option>
                                            <?php } ?>
                                        </select>
                                        <!-- <input type="date" id="event-date" name="event-date" value="2018-07-22" min="2018-01-01" max="2018-12-31" required /> -->
                                    </div>
                                    <div class="event-select">
                                        <!-- show the events -->
                                        <label for="event-name">Event Name:</label>
                                        <select name="event-name" id="event-name">
                                            <?php $event = $data['events'][0] ?>
                                                <option value="<?php echo $event->name ?>"><?php echo $event->name ?></option>
                                            <?php  ?>
                                        </select>
                                    </div>
                                    <div class="feedback-area">
                                        <form action="" method="post" id="review-write-form">
                                            <label for="review">Review:</label>
                                            <textarea name="review" rows="4" id="submitted-feedback"></textarea>
                                            <!-- <?php echo $data['loadFeedback'] ?> -->
                                            <!-- <?php flash('rating_message'); ?> -->
                                            <input type="submit" value="Submit" id="submit-review-btn">

                                        </form>
                                    </div>

                                </div>
                                <!-- end of review form -->
                            </div>
                        </div>
                    </div>






                </div>


                <!-- NEWLY ADDED BY EPA -->
                <div class="mid-section profile-title">
                    <div class="other-details">
                        <span>Qualifications</span>
                        <p><?php echo $data['details']->qualifications; ?></p>
                        <span>Achievements</span>
                        <p><?php echo $data['details']->achievements; ?></p>
                    </div>
                    <div class="profile-description name-rating">
                        <p id="profession">
                            <?php echo $data['details']->profession; ?>
                        </p>
                        <?php echo $data['details']->description; ?>
                    </div>
                </div>
                <p id="upcoming">Upcoming Events</p>

                <div class="lower-section profile-title">
                    <div class="profile-events">
                        <?php foreach ($data['events'] as $event) : ?>
                            <div class="event-display">
                                <img src="<?php echo URLROOT . '/public/uploads/events/' . $event->image; ?>" alt="">
                                <div class="overlay" data-event-target="#event" class="text" onclick="loadevent(<?php echo $event->event_id ?>)">
                                    <div data-event-target="#event" class="text" onclick="loadevent(<?php echo $event->event_id ?>)"><?php echo $event->name ?></div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <p id="upcoming">Recent Feed Posts</p>
        
            <div class="lower-section profile-title">
                <div class="profile-events">
                    <?php foreach ($data['posts'] as $post) : ?>
                        <div class="event-display">
                           
                            <img src="<?php echo URLROOT . '/public/uploads/' . $post->image1; ?>" alt="">
                            <div class="overlay" class="text" onclick="openPost(<?php echo $post->post_id?>)">
                                <div  class="text" style="font-size=6px;"><?php echo $post->title ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
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

       


        // these codes for wtite reviwe form and model

        // get user email(email rater)  using sessions and check user is logged or not
        const emai_rater = <?php
                            if (isLoggedIn()) {
                                echo "'" . $_SESSION['user_email'] . "'";
                            } else {
                                echo "0";
                            }
                            ?>;
        // get rate receiver's email form profile
        const email_rate_receiver = <?php echo "'" . $data['user']->email . "'"; ?>;

        // // set current date to value of input field and max date to current date
        // var today = new Date().toISOString().substr(0, 10);
        // document.querySelector("#event-date").value = today;
        // document.querySelector("#event-date").max = today;


        // set event names according to event date
        const eventDateDropdown = document.getElementById("event-date");
        console.log(document.getElementById("event-date").value)
        // add an event listener to the event date dropdown to retrieve
        // the corresponding events when the user selects a date
        eventDateDropdown.addEventListener("change", autoSetEventName);
        eventDateDropdown.addEventListener("DOMContentLoaded", autoSetEventName);


        function autoSetEventName() {
            const selectedEventDate = document.getElementById("event-date").value;
            console.log("this one", selectedEventDate);

            // send a fetch request to a PHP file to retrieve the Event names for the selected date
            const urlEvent = '<?php echo URLROOT ?>/users/getEventNames/';
            fetch(urlEvent, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        serviceProviderEmail: email_rate_receiver,
                        eventDate: selectedEventDate,
                    })

                })
                .then(response => response.json())
                .then(data => {
                    // clear the event name dropdown
                    var nameDropdown = document.getElementById("event-name");
                    nameDropdown.innerHTML = "";

                    // populate the date dropdown with the results
                    data.names.forEach(names => {
                        var option = document.createElement("option");
                        option.value = names.name;
                        option.text = names.name;
                        nameDropdown.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }



        // to open the model when button clicked
        function openModal() {
            reviewWriteForm = document.getElementById("review-write-form");
            const stars = document.querySelectorAll('.star-rating .star');
            var value = '';

            var modal = document.getElementById("myModal");
            modal.style.display = "block";

            // rate functionality======================================================================================================================

            if (emai_rater != "0" ) {
                // user is logged in

                for (const star of stars) {
                    star.addEventListener('click', function() {
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
                reviewWriteForm.addEventListener("submit", (e) => {
                    // e.preventDefault();
                    //get the form data/sumitted data
                    const feedback = document.getElementById('submitted-feedback').value;
                    console.log(feedback);
                    console.log(value);

                    const selectedEvent = document.getElementById("event-name").value;
                    let eventDate = document.getElementById("event-date").value;

                    const url1 = '<?php echo URLROOT ?>/users/rateServiceProvider/';
                    fetch(url1, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                rating: value,
                                review: feedback,
                                emai_rater: emai_rater,
                                email_rate_receiver: email_rate_receiver,
                                event: selectedEvent,
                                day: eventDate,
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

            } else {
                //user is not logged in 
                window.location.href = '<?php echo URLROOT ?>/users/login/';
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


        //getcalander
        function getCalander(id){
            window.location.href = '<?php echo URLROOT ?>/users/calanderPublic?id='+id + '&month=current';
        }
        function openPost(id){
            window.location.href = '<?php echo URLROOT ?>/users/feedPost?id='+id;
        }
    </script>
        

    <script src="<?php echo URLROOT . '/public/js/form.js'; ?>"></script>
    <script src="<?php echo URLROOT . '/public/js/service-provider-watchlist.js'; ?>"></script>

</body>

</html>