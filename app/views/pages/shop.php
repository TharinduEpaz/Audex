
    <div class="service-provider-profile">
        <div class="white-box">
        <div class="profile-title">
            <div class="profile-pic"><i class="far fa-user fa-7x"></i></div>
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

   
</body>
</html>