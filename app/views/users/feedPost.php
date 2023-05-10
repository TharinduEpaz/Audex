<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css?id=1425'; ?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/service_provider.css?id=25'; ?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/style.css?id=1445'; ?>">



    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Audex</title>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


    <!-- JQUERY LIBRARY -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .service-provider-profile {
            margin: auto;
            padding-left: 10vw;
            padding-right: 10vw;
        }

        .white-box {
            margin: 0;

        }
    </style>
</head>
<?php require_once APPROOT . '/views/users/navbar.php'; ?>
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