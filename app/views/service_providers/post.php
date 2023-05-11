<div class="service-provider-profile">
    <div class="white-box">
<div class="feed">
    
     <div class="title-section">
            <span id="post-title"><?php echo $data['post']->title ?></span>
            <!-- <button onclick="window.location.href='<?php echo URLROOT . '/service_providers/addNewPost/' ?>'" id="create-feed-post">Create New</button> -->

        </div>


        <div class="image-gallery">

            <!-- Slideshow container -->
            <div class="slideshow-container">

                <!-- Full-width images with number and caption text -->
                <div class="mySlides fade">
                    <div class="numbertext">1 / 3</div>
                    <img src="<?php echo URLROOT . '/public/uploads/' . $data['post']->image1; ?>" style="width:100%">
                    <!-- <div class="text">Caption Text</div> -->
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">2 / 3</div>
                    <img src="<?php echo URLROOT . '/public/uploads/' . $data['post']->image2; ?>" style="width:100%">
                    <!-- <div class="text">Caption Two</div> -->
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">3 / 3</div>
                    <img src="<?php echo URLROOT . '/public/uploads/' . $data['post']->image3; ?>" style="width:100%">
                    <!-- <div class="text">Caption Three</div> -->
                </div>

                <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            <br>

            <!-- The dots/circles -->
            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>

        </div>

        <div class="post-content">
            <?php echo $data['post']->content ?>
        </div>

        <button class="cancel" id="edit-event-btn" type="reset"  onclick="deletePost(<?php echo $data['post']->post_id ?>)">Delete Post</button>
        


        </div>
    </div>
    

</div>



</div>

<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }

    setInterval(function() {
        plusSlides(1);
    }, 5000);

    function deletePost(id) {
        if (confirm("Are you sure you want to delete this post?")) {
            window.location.href = "<?php echo URLROOT . '/service_providers/deletePost?id=' ?>" + id;
        }
    }
</script>