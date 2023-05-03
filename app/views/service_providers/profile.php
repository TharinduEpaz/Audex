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
                    <p id="Name"><?php echo $data['details']->first_name . ' ' . $data['details']->second_name ?></p>
                    <i class="fa fa-map-marker" aria-hidden="true"></i><span id="profession"><?php echo $data['details']->address_line_two ?></span>
                </div>
                <div class="rating">
                <?php for($i=0; $i<floor($data['details']->Rating); $i++): ?>
                <i class="fa fa-star"></i>
                <?php endfor; ?>
                </div>
              
        </div>
          
        <button id="edit-details" class="btn" onclick="gotoSettings()">Edit Details</button>
       
        <!-- <a href="<?php echo URLROOT .'/service_providers/settings'?>" class="btn" id="edit-settings"> Edit Settings</a></button>
        <h2>Events</h2>
        <a href="<?php echo URLROOT .'/service_providers/addEvent'?>" style="margin-left:10px;" id="add-event">Add Event</a>
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
        <p id="upcoming" >Upcoming Events</p>
        <button class="add-event-btn" onclick="addMoreEvents()">Add More Events</button>
        <div class="lower-section profile-title">
            <div class="profile-events">
                
                <?php foreach ($data['events'] as $event ): ?>
                    <div class="event-display">
                        
                        <img src="<?php echo URLROOT . '/public/uploads/events/' . $event->image;?>" alt="">
                        <div class="overlay">
                            <div class="text"><?php echo $event->name;?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                   
                
            </div>

        </div>

     

                
    </div>
    </div>



</div>

<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>

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

link = document.querySelector('#profile-settings');
link.style.background = "#E5E9F7";
link.style.color = "red";

error = document.querySelector('.red-alert');
error.style.color = "#FF0000"

editButton = document.querySelector('.btn');

if (error) {
    editButton.style.animation = "alert 2s ease 0s infinite normal forwards"
    editButton.style.color = "#FF0000"
    editButton.style.background = "#E5E9F7"
}


//Edit settings button
// const editSettingBtn = document.querySelector(".edit-details")
// console.log(editSettingBtn);
// editSettingBtn.addEventListener('click',function(){
//     console.log('working');
//     window.open('http://localhost/Audex/service_providers/settings', '_self');
// });

function gotoSettings(){
    window.open('http://localhost/Audex/service_providers/settings', '_self');
    
}
function addMoreEvents(){
    window.open('http://localhost/Audex/service_providers/eventCalander?month=current', '_self')
}
</script>

</body>

</html>