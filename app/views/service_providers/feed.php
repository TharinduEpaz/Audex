<div class="service-provider-profile">
    <div class="white-box">
        <div class="title-section">
            <span id="feed-title">Feed</span>
            <button onclick="window.location.href='<?php echo URLROOT . '/service_providers/addNewPost/' ?>'" id="create-feed-post">Create New</button>

        </div>

        <div class="post-section">

        <?php if($data['posts'] != 0): ?>

            <?php foreach ($data['posts'] as $post) : ?>
                <div class="feed-card" onclick="gotopost(<?php echo $post->post_id ?>)">
                    <img src="<?php echo URLROOT . '/public/uploads/feed/' . $post->image1; ?>" alt="post image" style="width:100%">
                    <div class="feed-post-container">
                        <h4><b><?php echo $post->title ?></b></h4>
                        <p><?php echo substr($post->content, 0, 20) . '....'; ?></p>
                    </div>
                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <span>Please pay before adding any post</span>
        
            <button class="add-event-btn" id="edit-event-btn" onclick="">Make Payment</button>
            

        <?php endif; ?>


        </div>
    </div>



</div>

<script src="<?php echo URLROOT . '/public/js/form.js'; ?>"></script>

<script>
    //keeping the sidebar button clicked at the page

    link = document.querySelector('#feed');
    link.style.background = "#E5E9F7";
    link.style.color = "red";



    editButton = document.querySelector('.btn');

    

    function gotopost(id) {
        window.location.href = "<?php echo URLROOT . '/service_providers/feedPost?id=' ?>" + id;
    }
</script>

</body>

</html>