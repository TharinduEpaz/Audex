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
                    <p id="Name"><?php echo $data['details']->first_name . ' ' . $data['details']->second_name ?></p>
                    <i class="fa fa-map-marker" aria-hidden="true"></i><span id="profession"><?php echo $data['details']->address_line_two ?></span>
                </div>
                <div class="rating">
                    <?php for ($i = 0; $i < floor($data['details']->Rating); $i++) : ?>
                        <i class="fa fa-star"></i>
                    <?php endfor; ?>

                    <?php if (strpos((string)$data['details']->Rating, '.')) : ?>
                        <i class="fa fa-star-half-o"></i>
                    <?php endif; ?>

                    <!-- <span style="color:white"><?php echo $data['details']->Rating ?></span> -->

                </div>
                <?php if($data['details']->admin_approved == 1): ?>
            <button id="approved" class="btn" onclick="gotoSettings()"><i class="fa fa-check-circle" style="margin-right:10px" aria-hidden="true" disabled></i>APPROVED BY AUDEX</button>
            <?php elseif($data['details']->admin_ignored == 1): ?>
            <button id="ignored" class="btn" onclick="gotoSettings()"><i class="fa fa-times-circle" style="margin-right:10px" aria-hidden="true"></i>APPROVAL ERROR</button>
            
            <?php else: ?>
            <button id="not-approved" class="btn" onclick="gotoSettings()"><i class="fa fa-times-circle" style="margin-right:10px" aria-hidden="true"></i>NOT APPROVED BY AUDEX</button>
            <?php endif; ?>
            </div>
            <button id="edit-details" class="btn" onclick="gotoSettings()">Edit Details</button>

            <!-- <a href="<?php echo URLROOT . '/service_providers/settings' ?>" class="btn" id="edit-settings"> Edit Settings</a></button>
        <h2>Events</h2>
        <a href="<?php echo URLROOT . '/service_providers/addEvent' ?>" style="margin-left:10px;" id="add-event">Add Event</a>
        <div class="events"> -->

            <div class="mid-section profile-title">
                <div class="other-details">
                    <span>Email</span>
                    <p><?php echo $data['details']->email; ?></p>
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
            <button class="add-event-btn" onclick="addMoreEvents()">Add More Events</button>
            <div class="lower-section profile-title">
                <div class="profile-events">
                    <?php foreach ($data['events'] as $event) : ?>
                        <div class="event-display">

                            <img src="<?php echo URLROOT . '/public/uploads/' . $event->image; ?>" alt="">
                            <div class="overlay" data-event-target="#event" class="text" onclick="loadevent(<?php echo $event->event_id ?>)">
                                <div data-event-target="#event" class="text"><?php echo $event->name ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <p id="upcoming">Recent Feed Posts</p>
            <button class="add-event-btn" onclick="addMorePosts()">Add New Post</button>
            <div class="lower-section profile-title">
                <div class="profile-events">
                    <?php foreach ($data['posts'] as $post) : ?>
                        <div class="event-display">

                            <img src="<?php echo URLROOT . '/public/uploads/feed/' . $post->image1; ?>" alt="">
                            <div class="overlay" class="text" onclick="openPost(<?php echo $post->post_id ?>)">
                                <div class="text" style="font-size=6px;"><?php echo $post->title ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="event" id="event">
    <div class="event-left">
        <div class="event-header">
            <div class="title"></div>
            <div class="event-date"></div>
            <div class="event-time"></div>

            <button data-close-button class="close-button">&times;</button>

        </div>
        <div class="wrapper-for-event">
            <div class="event-publisher">
                <div class="event-owenr-image">
                    <img src="" alt="">
                </div>
                <span class="owner-name">John Doe</span>
            </div>
            <div class="event-buttons">
                <button class="like-button" data-id="<?php ?>"><i class="fas fa-thumbs-up"></i>&nbsp&nbsp<span id="likes"></span></button>
                <button class="dislike-button"><i class="fas fa-thumbs-down"></i>&nbsp&nbsp<span id="dislikes"></span></button>
            </div>

        </div>
        <div class="event-body">
        </div>

        <button class="add-event-btn" id="edit-delete-event" onclick="">Edit / Delete Event</button>

    </div>


    <div class="event-right">
        <img src="" alt="" id="event-img">
    </div>

</div>


<div id="overlay"></div>

<script src="<?php echo URLROOT . '/public/js/form.js'; ?>"></script>
<script src="<?php echo URLROOT . '/public/js/sp_profile.js'; ?>"></script>

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

    function editDeleteEvent(id){
        window.location.href = "<?php echo URLROOT . '/service_providers/editEvent?id=' ?>" + id;
    }

    
</script>

</body>

</html>