

<div class="service-provider-profile">
        <div class="white-box">
            <div class="feed-post-edit-container">
                <form action="<?php echo URLROOT . '/service_providers/insertPost';?>" method="POST" enctype="multipart/form-data"> 
                    <label for="post-title">Add Post Title : </label>
                    <input type="text" name="title" id="" required>
                    <label for="add-post" style="margin-top:40px">Create Your Post (you can resize editor by dragging right bottom corner)</label>
                    <textarea name="add-post" id="add-post-text" cols="30" rows="10" required></textarea>
                    <br>
                    <span id="select-photos" >Select photos for your post (at least 1 photo is required)</span>
                    <div class="post-pics">
                    <input type="file" name="post-photo-1" required>
                    <input type="file" name="post-photo-2">
                    <input type="file" name="post-photo-3">
                    </div>
                    <div class="button-section">
                <button type="submit" id="create-feed-post">POST</button>
                <button type="reset">Cancel</button>
                </div>
                </form>
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