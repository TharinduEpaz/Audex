<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Playfair+Display&display=swap');

    body {
        padding-left: 15vw;
        padding-right: 10vw;
        background-color: #E5E9F7;
        font-family: 'Open Sans';
    }

    .container {
        display: grid;
        grid-template-columns: 1.2fr 1.3fr;
        grid-template-rows: 1.6fr 0.3fr 1.1fr;
        gap: 0px 0px;
        grid-auto-flow: row;
        grid-template-areas:
            "image product-details"
            "buttons about-the-seller"
            "description seler-details";


        padding-top: 15vh;
        gap: 20px;
        flex-wrap: wrap;
    }

  

    .product-details {
        background-color: #fff;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;
        border-radius: 10px;
        padding: 20px;
        padding-left: 40px;
        width:30vw;

        grid-area: product-details;

        gap: 20px;
    }
    #product-title span{
        font-weight:800;
        font-size:2rem;
    } 

    #product-price span{
        font-size: 2rem;
        font-weight: 300;
    }

    #product-category, #product-brand, #product-model, #product-condition{
        font-weight:200;
    }


    .product-details .p-buttons {
        display: inline block;
        margin-top: 20px;
        font-weight: 600;

        
    }
    .p-buttons #bid-now{

        font-weight: 600;
  font-size: 1rem;
  align-items: center;
  appearance: none;
  background-color: #776cea;
 
  background-size: calc(100% + 20px) calc(100% + 20px);
  border-radius: 20px;
  border-width: 0;
  box-shadow: none;
  box-sizing: border-box;
  color: #FFFFFF;
  cursor: pointer;
  display: inline-flex;
  

  height: auto;
  justify-content: center;
  line-height: 1.5;
  padding: 6px 20px;

  text-align: center;
  text-decoration: none;
  transition: background-color .2s,background-position .2s;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: top;
  white-space: nowrap;
  margin-right: 20px;

    }
    #bid-now i{
        margin-right:10px;
    }

    .p-buttons #message{
        font-weight: 600;
  font-size: 1rem;
  align-items: center;
  appearance: none;
  background-color: #000;
 
  background-size: calc(100% + 20px) calc(100% + 20px);
  border-radius: 20px;
  border-width: 0;
  box-shadow: none;
  box-sizing: border-box;
  color: #FFFFFF;
  cursor: pointer;
  display: inline-flex;
  

  height: auto;
  justify-content: center;
  line-height: 1.5;
  padding: 6px 20px;

  text-align: center;
  text-decoration: none;
  transition: background-color .2s,background-position .2s;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: top;
  white-space: nowrap;

    }
    #message i{
        margin-right:10px;
    }


    .buttons {
        grid-area: buttons;
        display: flex;
        justify-content: space-between;
    }

    .buttons button {
        width: 40px;
        height: 40px;
        border: none;
        background-color: #fff;
        text-align: center;
        border-radius: 100%;
    }

    .buttons #like {
        color: #5C4FEF;
    }


    .about-the-seller {
        grid-area: about-the-seller;
        display: flex;
        justify-content: start;
        align-items: end;
        padding-left: 40px;

    }

    .description {
        grid-area: description;
    }
    .description p{
        font-weight: 200;
    }
    .description span{
        font-weight: 600;
    }

    .seler-details {
        display: flex;
        flex-direction: row;
        grid-area: seler-details;
        overflow: hidden;
        gap: 20px;
        padding-left: 40px;

    }
    .seller-data #name{
        font-weight: 600;
        font-size: 1.5rem;
    }
    .seller-data #profession{
        font-weight: 200;
    }
    .seller-data button{
        font-weight: 400;
  font-size: 1rem;
  align-items: center;
  appearance: none;
  background-color: #000;
 
  background-size: calc(100% + 20px) calc(100% + 20px);
  border-radius: 20px;
  border-width: 0;
  box-shadow: none;
  box-sizing: border-box;
  color: #FFFFFF;
  cursor: pointer;
  display: inline-flex;
  

  height: auto;
  justify-content: center;
  line-height: 1.5;
  padding: 6px 20px;

  text-align: center;
  text-decoration: none;
  transition: background-color .2s,background-position .2s;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: top;
  white-space: nowrap;
    }
    
    .seller-data button i{
        margin-right:10px;
    }


    .seller-image img {

        width: 100%;
        height: 100%;
        border-radius: 100%;
        object-fit: cover;
        filter: drop-shadow(-4px 4px 2px #B7B7B7);
    }

    .seller-image {
        width: 100px;
        height: 100px;

    }

    .seller-data {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }


    /* CSS FOR THE IMAGE SLIDER */

    * {
        box-sizing: border-box;
    }

    /* Position the image container (needed to position the left and right arrows) */
    .image {
        position: relative;
    }

    /* Hide the images by default */
    .mySlides {
        display: none;
    }

    /* Add a pointer when hovering over the thumbnail images */
    .cursor {
        cursor: pointer;
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 40%;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        font-weight: bold;
        font-size: 20px;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    /* Container for image text */
    .caption-container {
        text-align: center;
        background-color: #222;
        padding: 2px 16px;
        color: white;
    }

    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* Six columns side by side */
    .column {
        float: left;
        width: 16.66%;
    }

    /* Add a transparency effect for thumnbail images */
    .demo {
        opacity: 0.6;
    }

    .active,
    .demo:hover {
        opacity: 1;
    }
</style>

<body>
<?php require_once APPROOT . '/views/users/navbar.php';?>

    <div class="search-bar"></div>


    <div class="container">
        <div class="image">
            <!-- <div class="image-box">
                <img src="https://images.unsplash.com/photo-1485579149621-3123dd979885?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1331&q=80"
                    alt="">

            </div>
            <div class="image-sliders">
            <div class="image-1"></div>
            <div class="image-2"></div>
            <div class="image-3"></div> -->

            <!-- Full-width images with number text -->
            <div class="mySlides">
                <div class="numbertext">1 / 3</div>
                <img src="<?php echo URLROOT.'/public/uploads/'.$data['ad']->image1;?>" style="width:100%">
            </div>

            <div class="mySlides">
                <div class="numbertext">2 / 3</div>
                <img src="<?php echo URLROOT.'/public/uploads/'.$data['ad']->image2;?>" style="width:100%">
            </div>

            <div class="mySlides">
                <div class="numbertext">3 / 3</div>
                <img src="<?php echo URLROOT.'/public/uploads/'.$data['ad']->image3;?>" style="width:100%">
            </div>

            <!-- <div class="mySlides">
                <div class="numbertext">4 / 6</div>
                <img src="img_lights_wide.jpg" style="width:100%">
            </div>

            <div class="mySlides">
                <div class="numbertext">5 / 6</div>
                <img src="img_nature_wide.jpg" style="width:100%">
            </div>

            <div class="mySlides">
                <div class="numbertext">6 / 6</div>
                <img src="img_snow_wide.jpg" style="width:100%">
            </div> -->

            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

          
            <!-- Thumbnail images -->
            <div class="row">
                <div class="column">
                    <img class="demo cursor" src="<?php echo URLROOT.'/public/uploads/'.$data['ad']->image1;?>" style="width:100%" onclick="currentSlide(1)"
                        alt="The Woods">
                </div>
                <div class="column">
                    <img class="demo cursor" src="<?php echo URLROOT.'/public/uploads/'.$data['ad']->image2;?>" style="width:100%" onclick="currentSlide(2)"
                        alt="Cinque Terre">
                </div>
                <div class="column">
                    <img class="demo cursor" src="<?php echo URLROOT.'/public/uploads/'.$data['ad']->image3;?>" style="width:100%" onclick="currentSlide(3)"
                        alt="Mountains and fjords">
                        </div>
                <!-- </div>
                <div class="column">
                    <img class="demo cursor" src="img_lights.jpg" style="width:100%" onclick="currentSlide(4)"
                        alt="Northern Lights">
                </div>
                <div class="column">
                    <img class="demo cursor" src="img_nature.jpg" style="width:100%" onclick="currentSlide(5)"
                        alt="Nature and sunrise">
                </div>
                <div class="column">
                    <img class="demo cursor" src="img_snow.jpg" style="width:100%" onclick="currentSlide(6)"
                        alt="Snowy Mountains">
                </div> -->
            </div>
        </div>

    


    <div class="product-details">
        <div id="product-title">
            <span><?php echo $data['ad']->product_title?></span>
        </div>
        <div id="product-price">
            <span id="product-price">LKR&nbsp;<?php echo $data['ad']->price?></span>

        </div>
        <div id="product-model">
            <span>Model :  </span><span id="product-model"><?php echo ucwords($data['ad']->model_no)?></span>

        </div>
        <div id="product-category">
            <span>Category :  </span><span id="product-category"><?php echo ucwords($data['ad']->product_category)?></span>

        </div>
        <div id="product-brand">
            <span>Brand Name :  </span> <span id="product-brand"><?php echo ucwords($data['ad']->brand)?></span>

        </div>
        <div id="product-condition">
            <span>Condition :  </span><span id="product-condition"><?php echo $data['ad']->product_condition?></span>

        </div>



        <div class="p-buttons">
            <?php 
                if(isLoggedIn()){
                    if($_SESSION['user_email']!=$data['ad']->email && $_SESSION['user_type']!='seller'){
                        if($data['ad']->product_type=='auction'){?>
                            <button onclick="window.location.href='<?php echo URLROOT.'/users/bid/'.$data['ad']->product_id?>'" id="bid-now"><i class="fa-solid fa-gavel"></i>BID NOW</button>
                            <?php } 
                        else{ ?>
                            <button onclick="window.location.href='<?php echo URLROOT.'/users/chat/'.$data['SellerMoreDetails']->user_id?>'" id="message"><i class="fa-solid fa-message"></i>MESSAGE</button>
                    <?php 
                        }    
                    }
                }
            ?>
        </div>
        

    </div>
    <div class="buttons">

        <div class="like-dislike">
            <button id="like"> <i class="fa-regular fa-thumbs-up"></i></button>
            <button id="dislike"> <i class="fa-regular fa-thumbs-down"></i></button>


        </div>
        <div class="watlist-location">
            <button id="watchlist"><i class="fa-solid fa-heart"></i></button>
            <button id="location"><i class="fa-sharp fa-solid fa-location-dot"></i></button>
        </div>


    </div>
    <div class="about-the-seller">
        <span>About the seller</span>

    </div>
    <div class="description">
        <span>Product Description</span>
        <p><?php echo $data['ad']->p_description?>
        </p>
    </div>
    <div class="seler-details">
        <div class="seller-image">
            <img src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
                alt="">
        </div>
        <div class="seller-data">
            <span id="name"><?php echo $data['SellerMoreDetails']->first_name.' '.$data['SellerMoreDetails']->second_name; ?></span>
            <span id="profession">Professional Sound Engineer</span>
            <!-- Stars -->
            <button><i class="fa-solid fa-phone"></i>View mobile number</button>
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
            let dots = document.getElementsByClassName("demo");
            let captionText = document.getElementById("caption");
            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            captionText.innerHTML = dots[slideIndex - 1].alt;
        }

    </script>

</body>

</html>