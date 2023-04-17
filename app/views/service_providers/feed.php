

    <div class="service-provider-profile">
        <div class="white-box">
            <span id="feed-title">
            Welcome to your feed Mevan<br>
            </span>
            <span id="feed-discription">
            Your feed includes highlights from your events, achievements and the special posts you need to give into your audience. 
            </span>

        <div class="feed_items_container">
            <div class="card">
                <div class="imgBx">
                    <img src="https://www.careersinmusic.com/wp-content/uploads/2019/07/audio-engineering.jpg" alt="">
                </div>
                
                <div class="content">
                <h2>Post Title</h2>
                    
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi, cum fugit! Repellat unde consequatur placeat nobis, quae non! Asperiores impedit molestiae perspiciatis repellendus neque, blanditiis reprehenderit facilis repellat. Quod, temporibus?</p>
                </div>
            </div>
            
            
        </div>
        <div class="button-section">
            <button onclick="window.location.href='<?php echo URLROOT . '/service_providers/addNewPost/' ?>'" id="create-feed-post">Create New</button>

        </div>
        
        </div>

        

    </div>

    <script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>

    <script>

        //keeping the sidebar button clicked at the page

        link = document.querySelector('#feed');
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