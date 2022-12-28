

    <div class="service-provider-profile">
        <div class="white-box">
            <h1>Add New Event</h1>
            <div class="info-settings">

                <div class="info-titles">
                    <span>Name : </span>
                    <span>Date : </span>
                    <span>Public Event : </span>
                    <span>Location : </span>
                    <span>Ticket Link : </span>
                    <span>Description : </span>
                
                </div>
                <div class="info-items">
                    <form action= "<?php echo URLROOT . '/service_providers/addNewEvent/' ?>" method="post">
                         <input type="text" name="name" required>
                        <input type="text" name="date" required> <br>
                        <input type="checkbox" name="public">
                       <input type="text" name="location" required>
                        <input type="text" name="link" required>
                        <textarea name="description" cols="30" rows="10" required></textarea>


                        <section class="buttons" style="margin-top:50px;">
          
                        <button id="save" type="submit">Save</button>
                        <button id="cancel" type="reset" onclick="exit()">Cancel</button>
                    </section>
                    </form>
          </div>
                   
                </div>
                <!-- <div class="profile-pic-settings">
                    <img src="profile.jpg" alt="">
                    <p>Edit Profile Image</p>
                    <input type="file" name="Edit" id="" placeholder="Edit Image">
                </div> -->
            </div>

         
    

    </div>

    <script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>

    <script>
        //keeping the sidebar button clicked at the page

        link = document.querySelector('#profile-settings');
        link.style.background = "#E5E9F7";
        link.style.color = "red";

        function exit(){
            window.location.replace("http://localhost/audex/service_providers/profile");
        }

    </script>

</body>

</html>