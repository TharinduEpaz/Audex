<div class="service-provider-profile">
    <div class="white-box">
        <h1>Edit Profile</h1>
        <div class="info-settings">

            <div class="info-titles">
                <span>First Name : </span>
                <span>Last Name : </span>
                <span>Address Line 1 : </span>
                <span>Address Line 2 : </span>
                <span>Mobile : </span>
                <span>Profession : </span>
                <span>Qualifications : </span>
                <span>Achivements : </span>
                <span>Edit Description : </span>

            </div>
            <div class="info-items">
                <form action="<?php echo URLROOT . '/service_providers/setDetails/' ?>" method="post">
                    <input type="text" name="first_name" placeholder="<?php echo $data['details']->first_name ?>">
                    <input type="text" name="second_name" placeholder="<?php echo $data['details']->second_name ?>">
                    <input type="text" name="address1" placeholder="<?php echo $data['details']->address_line_one ?>">
                    <input type="text" name="address2" placeholder="<?php echo $data['details']->address_line_two ?>">
                    <input type="number" name="mobile" placeholder="<?php echo $data['details']->mobile ?>" disabled>
                    <input type="text" name="profession" placeholder="<?php echo $data['details']->profession ?>">
                    <input type="text" name="qualifications"
                        placeholder="<?php echo $data['details']->qualifications ?>">
                    <input type="text" name="achievements" placeholder="<?php echo $data['details']->achievements ?>">
                    <textarea name="description" cols="30" rows="10"
                        placeholder="<?php echo $data['details']->description ?>"></textarea>
                        
                    
                    <!-- Buttons to submit or cancel the form -->
                    
                    <section class="buttons">
                        <button id="save" type="submit">Save</button>
                        <button id="cancel" type="reset" onclick="exit()">Cancel</button>
                    </section>
                </form>
            </div>
        </div>
        <div class="profile-pic-settings">
                    
        
                    <?php if($data['details']->profile_image): ?>
                            <img src="<?php echo URLROOT . '/public/uploads/Profile/' . $data['details']->profile_image; ?>" >
                    <?php else: ?>
                            <i class="fa fa-user" aria-hidden="true"></i>
                    <?php endif; ?>

                    <p>Edit Profile Image</p>
                   
                   <form action="<?php echo URLROOT . '/service_providers/setImage/' ?>" method="post" enctype="multipart/form-data">
                    <input type="file" name="profile" id="profile">
                    <button id="save" type="submit">Upload</button>
                 
                    </form>
                </div>
    </div>
</div>

<script src="<?php echo URLROOT . '/public/js/form.js'; ?>"></script>

<script>
    //keeping the sidebar button clicked at the page

    link = document.querySelector('#profile-settings');
    link.style.background = "#E5E9F7";
    link.style.color = "red";

    function exit() {
        window.location.replace("http://localhost/audex/service_providers/profile");
    }
    

</script>

</body>

</html>