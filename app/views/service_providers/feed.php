

    <div class="service-provider-profile">
        <div class="white-box">

        <div class="feed_items_container">
            <div class="feed-item item1"></div>
            <div class="feed-item item2"></div>
            <div class="feed-item item3"></div>
            <div class="feed-item item4"></div>
            <div class="feed-item item5"></div>
            <div class="feed-item item6"></div>
            

        </div>
        <div class="button-section">
            <button>Create New</button>

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