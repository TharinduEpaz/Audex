
    <div class="service-provider-profile">
        <div class="white-box">
        <div class="profile-title">
            <div class="profile-pic"> <?php if($data['details']->profile_image): ?>
                            <img src="<?php echo URLROOT . '/public/uploads/Profile/' . $data['details']->profile_image; ?>" id="profile-img" >
                    <?php else: ?>
                            <i class="fa fa-user" aria-hidden="true"></i>
                    <?php endif; ?></i></div>
            <div class="name-rating">
                <div class="name"><p id="Name"><?php echo $data['details']->first_name . ' ' . $data['details']->second_name ?></p><p id="profession"><?php echo $data['details']->profession?></p></div>
                <div class="rating"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></div>
            </div>
        </div>
        <div class="profile-info">
            <div class="description"><h1>About me</h1>
                <p> <?php if($data['details']->description == ''){
                    echo '<span class="red-alert">please complete your profile in the profile settings section</span>';
                }
                else{
                    echo $data['details']->description;
                } ?>
                    
</p></div>
            <div class="info-blocks">
                <div class="info-titles">
                    <span>First Name : </span>
                    <span>Last Name : </span>
                    <span>Email : </span>
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
                    <span><?php echo $data['details']->email ?></span>
                    <span><?php echo $data['details']->address_line_one ?></span>
                    <span><?php echo $data['details']->address_line_two ?></span>
                    <span><?php echo $data['details']->mobile ?></span>
                    <span><?php echo $data['details']->profession ?></span>
                    <span><?php echo $data['details']->qualifications ?></span>
                    <span><?php echo $data['details']->achievements?></span>
                </div>
            </div>
            
        </div>
         <a href="<?php echo URLROOT .'/service_providers/settings'?>" class="btn"> Edit Settings</a></button>
        <h2>Events</h2>
        <a href="<?php echo URLROOT .'/service_providers/addEvent'?>" style="margin-left:10px;">Add Event</a>
        <div class="events">
            
            
            <?php foreach ($data['events'] as $event):
                echo '<div class="event">';
                echo '<h1>' . $event->name . '</h1>';
                echo '<p>' . $event->date . '</p>';
                echo '</div>';

            endforeach;

                ?>
       
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


        


    </script>

</body>
</html>