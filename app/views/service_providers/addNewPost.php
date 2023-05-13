<div class="service-provider-profile">
    <div class="white-box">

        <?php if ($data['posts'] != 0) : ?>


            <div class="feed-post-edit-container">
                <form action="<?php echo URLROOT . '/service_providers/insertPost'; ?>" method="POST" enctype="multipart/form-data">
                    <label for="post-title">Add Post Title : </label>
                    <input type="text" name="title" id="" required>
                    <label for="add-post" style="margin-top:40px">Create Your Post (you can resize editor by dragging right bottom corner)</label>
                    <textarea name="add-post" id="add-post-text" cols="30" rows="10"></textarea>
                    <br>
                    <span id="select-photos">Select photos for your post (at least 1 photo is required/max size 5MB)</span>
                    <div class="post-pics">
                        <input type="file" id="file" name="post-photo-1" accept="image/*" required maxlength="5242880" required>
                        <input type="file" name="post-photo-2" maxlength="2097152">
                        <input type="file" name="post-photo-3" maxlength="2097152">
                    </div>
                    <div class="button-section">
                        <button type="submit" id="create-feed-post" name='submit'>POST</button>
                        <button type="reset" onclick="exit()">Cancel</button>
                    </div>
                </form>
            </div>

        <?php else : ?>

            <span>Please pay before adding any post</span>

            <button class="add-event-btn" id="edit-event-btn" onclick="">Make Payment</button>


        <?php endif; ?>

    </div>
</div>

<script src="<?php echo URLROOT . '/public/js/form.js'; ?>"></script>

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
    var uploadField = document.getElementById("file");
    console.log(uploadField);

    uploadField.onchange = function() {
        if (this.files[0].size > 5242880) {
            alert("File is too big!");
            this.value = "";
        };
    };

    function exit() {
        confirm("Are you sure you want to exit?")
        if (confirm) {
            window.location.href = "<?php echo URLROOT . '/service_providers/feed' ?>"
        }

    }
</script>

</body>

</html>