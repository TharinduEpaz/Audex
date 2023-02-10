

<div class="service-provider-profile">
<h2 style="margin-top:70px"> Your January Events will appear here </h2>
  
        <div class="button-section">
            
    
        <div class="white-box">
        <button>Next Month</button>
        

        <div class="feed_items_container">
            <div class="feed-item item1"></div>
            <div class="feed-item item2"></div>
            <div class="feed-item item3"></div>
            <div class="feed-item item3"></div>
            <div class="feed-item item1"></div>
            <div class="feed-item item2"></div>
            <div class="feed-item item3"></div>
            <div class="feed-item item3"></div>
           
            

        </div>
 
        </div>

        

    </div>

    <script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>

    <script>

        //keeping the sidebar button clicked at the page

        link = document.querySelector('#calender');
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