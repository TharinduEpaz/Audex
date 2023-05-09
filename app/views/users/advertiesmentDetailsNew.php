<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Advertisement</title>

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

    .buttons #product-like-btn {
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
            <span id="product-price">RS <?php echo $data['ad']->price?></span>

        </div>
        <div id="product-model">
            <span>Model :  </span><span id="product-model"><?php echo $data['ad']->model_no?></span>

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
            <!-- <button id="bid-now"><i class="fa-solid fa-gavel"></i>BID NOW</button> -->

            <?php 
                if(isLoggedIn()){
                    if($_SESSION['user_email']!=$data['ad']->email){
                        echo '<a href="'.URLROOT.'/users/chat/'.$data['SellerMoreDetails']->user_id.'"><button id="message"><i class="fa-solid fa-message"></i>MESSAGE</button></a>';
                    }
                }
            ?>
        </div>

    </div>
    <div class="buttons">

        <div class="like-dislike">
            <!-- used two custom attributes one for click event and other one to store liked value when load -->
            <button type="submit" id="product-like-btn" onload="likeBtnOnload()" data-like = "addLike" data-likeLoad ="<?php echo $data['liked'] ; ?>" > <i class="fa-regular fa-thumbs-up"></i></button>
            <div id="like-count">
                <?php echo $data['likedCount'] ?>
            </div>
            <button type="submit" id="product-dislike-btn" data-dislike = "addDislike" data-dislikeLoad = "<?php echo $data['disliked'] ; ?>"  > <i class="fa-regular fa-thumbs-down"></i></button>
            <div id="dislike-count">
                <?php echo $data['dislikedCount'] ?>
            </div>

        </div>
        <div class="watlist-location">
            <!-- <button id="watchlist"><i class="fa-solid fa-heart"></i></button> -->

            <div class="add_watch_list">
                <form id="add_watch_list_form" method="POST" data-op = "add" data-watchLoad ="<?php echo $data['watched'] ; ?>" >
                    <!-- if user is logged in then he have a _SESSION, if not user id value will be 0  -->
                    <input type="text" name="user_type" value="buyer" hidden>
                    <input type="text" name ="user_id" value= " <?php echo (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0) ; ?>" hidden>
                    <input type="text" name="product_id" value="<?php echo $data['ad']->product_id ; ?>" hidden >
                    
                    <div class="button-container">
                        <!-- <input type="submit" value="Add To Watchlist" class="watch" id="add-to-watchlist"> -->

                    <?php
                        if( !isLoggedIn() ){?>    
                            <button type="submit" class="heart" id="heart">
                                    <i class="fa-solid fa-heart"></i>
                            </button>
                    <?php }
                        else if($_SESSION['user_type'] != 'seller' && $_SESSION['user_type'] != 'service_provider' ){ ?>
                            <button type="submit" class="heart" id="heart">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                    <?php }?>
                    </div>
                    <dialog id="dia">
                        <div class="top-part" style="margin-bottom: 1vh;">
                            <button class="btn_close">X</button>
                            <!-- <i class="fa-sharp fa-solid fa-xmark"></i> -->
                        </div>  
                        <hr>
                        <div class="bottom-part" style="margin-top: 1vh;">
                            <h4>Do You Want To Continue?</h4>
                            <button class="close">Close</button>
                            <button class="continue">OK </button>  
                        </div>
                    </dialog>
    
                </form>
            </div>


            <?php if($data['ad']->longitude!='NULL' && $data['ad']->latitude!='NULL'){?>
                <div class="location">
                    <div class="input">
                        <a href="" class="post" onclick="openModal(); return false;"><button id="location"><i class="fa-sharp fa-solid fa-location-dot"></i></button></a>
                    </div>
                    <div id="myModal" class="modal">
                        <div class="modal-content">
                            <div id="floating-panel">
                                <!-- <h3 for="longitude">Longitude: <?php echo $data['ad']->longitude; ?></h3>
                                <h3 for="latiitude">Latiitude: <?php echo $data['ad']->latitude; ?></h3>
                                <h3 for="address">Address: <?php echo $data['ad']->address; ?></h3> -->
                                <a style="color: black;" href="https://www.google.com/maps/search/?api=1&query=<?php echo $data['ad']->latitude; ?>,<?php echo $data['ad']->longitude; ?>" target="_blank">Open in google</a>

                            </div>
                            <span class="close" onclick="closeModal()">&times;</span>
                            <div id="map" style="width: 100%; height: 90%;">
                                <script>
                                    var geocoder;
                                    var map;
                                    var longitude;
                                    var latitude;
                                    var position;
                                    function initMap() {
                                        var position = {lat: <?php echo $data['ad']->latitude?>, lng: <?php echo $data['ad']->longitude?>};
                                            var map = new google.maps.Map(document.getElementById('map'), {
                                                zoom: 12,
                                                center: position
                                        
                                            });
                                            const marker = new google.maps.Marker({
                                                position: position,
                                                map: map,
                                                draggable: false
                                            });

                                            
                                    }
                                    </script>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <!-- <button id="location"><i class="fa-sharp fa-solid fa-location-dot"></i></button> -->
        </div>


    </div>
    <div class="about-the-seller">
        <span>About the seller</span>

    </div>
    <div class="description">
        <span>Product Description</span>
        <p><?php echo $data['ad']->p_description?> </p>
    </div>
    <div class="seler-details">
        <div class="seller-image">
            <img src="<?php echo URLROOT . '/public/uploads/'.$data['SellerMoreDetails']->profile_pic;?>"
                alt="seller/shop image">
        </div>
        <div class="seller-data">
            <span id="name"><?php echo $data['SellerMoreDetails']->first_name.' '.$data['SellerMoreDetails']->second_name; ?></span>
            <span id="profession">Professional Sound Engineer</span>
            <!-- Stars -->

            <div class="stars_date">
                <div class="stars">
                    <!-- <img src="<?php echo URLROOT . '/public/img/stars.png';;?>" alt="Profile Picture"> -->
                    <div class="current-rate">
                        <!-- <label for="current-rate" style="display:none">Rate:</label> -->
                        <!-- <input type="text" name="current-rate" value="<?php echo $data['SellerMoreDetails']->rate ?>" id="current-seller-rate"> -->
                        <div class="rating-stars">
                            <!-- <span class="rate"><?php echo $data['seller']->rate;?></span>  -->

                            <?php $i=$data['SellerMoreDetails']->rate;
                            $j=0;
                            for($i; $i>=1; $i--){?>
                            <i class="fa fa-star"></i>
                            <?php  $j++;} ?>
                            
                            <?php if($i>0){ ?>
                            <i class="fa fa-star-half-o"></i>
                            
                            <?php $i--;$j++;} 
                            while($j<5){ ?>
                            <i class="fa fa-star-o"></i>
                            <?php $j++; } ?>
                        </div>                
                    </div>
                </div>
                
                <div class="date">
                    <p>Joined : <?php echo date('Y-m-d',strtotime($data['SellerMoreDetails']->registered_date));; ?></p>
                </div>
            </div>
            <div class="likes_dislikes">
                <div class="flags">
                    <i class="fa-sharp fa-solid fa-flag"> : 0 </i>
                </div>
            </div>

            <!-- <button><i class="fa-solid fa-phone"></i>View mobile number</button> -->
        </div>
    </div>
    </div>

</body>






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


    function openModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
        initMap();
           
    }

    function closeModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
	}
    // When the user clicks anywhere outside of the modal, close it
	var modal = document.getElementById("myModal");

    window.addEventListener("click", function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    });

    function change_img1(){
        document.getElementById('img1').style.backgroundImage = "url('<?php echo URLROOT.'/public/uploads/'.$data['ad']->image1;?>')";
    }
    function change_img2(){
        document.getElementById('img1').style.backgroundImage = "url('<?php echo URLROOT.'/public/uploads/'.$data['ad']->image2;?>')";
    }
    function change_img3(){
        document.getElementById('img1').style.backgroundImage = "url('<?php echo URLROOT.'/public/uploads/'.$data['ad']->image3;?>')";
    }

    // like removeLike functions click event
    const likeBtn = document.getElementById("product-like-btn");
    const dislikeBtn = document.getElementById("product-dislike-btn");
    const likedCount = document.getElementById("like-count");
    const dislikedCount = document.getElementById("dislike-count");

    // console.log(likedCount.innerText );

    window.addEventListener("DOMContentLoaded",(e)=>{
        // add even listner to check status of like when load liked or not liked
        if(likeBtn.getAttribute("data-likeLoad") === "liked"){
            likeBtn.style.color="Red";
            likeBtn.setAttribute("data-like","removeLike"); 
        }
        else if(dislikeBtn.getAttribute("data-dislikeLoad") === "disliked"){
            dislikeBtn.style.color="Red";
            dislikeBtn.setAttribute("data-dislike","removeDislike"); 
        }
    });

    // get user id and product id using sessions and check user is logged or not
    const user_id = <?php
                        if (isLoggedIn()) {
                            echo $_SESSION['user_id'];
                        }
                        else{
                            echo "0";
                        }
                    ?>;

    const product_id = "<?php echo $_SESSION['product_id']; ?>";


    likeBtn.addEventListener("click",async (e)=>{
        e.preventDefault();

        if(user_id != "0"){
            if(likeBtn.getAttribute("data-like") === "addLike"){
                const url = '<?php echo URLROOT?>/users/addLikeToProduct/' +product_id.trim()+'/'+ user_id;
                console.log(url);

                const d = {
                        'addLike':1,
                        'user_id' : user_id,
                        'product_id': product_id,
                    }
                

                const data  = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(d)
                })
                .then(response => response.json())
                .then(data =>{
                    console.log(data); 
                    if(likeBtn.getAttribute("data-like") === "addLike"){
                        likedCount.innerHTML = ++likedCount.innerText;
                        likeBtn.setAttribute("data-like","removeLike");      
                        likeBtn.style.color="Red";
                    }

                    // check is there any dislike and if it is reduce the dislike count
                    if( dislikeBtn.getAttribute("data-dislike") === "removeDislike" ){
                        dislikedCount.innerHTML = --dislikedCount.innerText;    
                        dislikeBtn.style.color="black";
                        dislikeBtn.setAttribute("data-dislike","addDislike");                      

                    }

                })
                .catch(error => {
                    console.log("Error:", error);
                });
            }
            else if(likeBtn.getAttribute("data-like") === "removeLike"){
                const url = '<?php echo URLROOT?>/users/removeLikeFromProduct/' +product_id.trim()+'/'+ user_id;
                console.log(url);

                const d = {
                        'removeLike':1,
                        'user_id' : user_id,
                        'product_id': product_id,
                    }
                const data  = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(d)
                })
                .then(response => response.json())
                .then(data =>{
                    console.log(data); 
                    if(likeBtn.getAttribute("data-like") === "removeLike"){
                        likedCount.innerHTML = --likedCount.innerText;
                        likeBtn.setAttribute("data-like","addLike");      
                        likeBtn.style.color="black";
    
                        dislikeBtn.setAttribute("data-dislike","addDislike");      
                        dislikeBtn.style.color="black";
                    }
                })
                .catch(error => {
                    console.log("Error:", error);
                });
            }
        }
        else{
            //user is not logged in 
            window.location.href = '<?php echo URLROOT?>/users/login/';
        }
    });


    dislikeBtn.addEventListener("click",async (e)=>{
        e.preventDefault();

        if(user_id != "0"){
            if( dislikeBtn.getAttribute("data-dislike") === "addDislike" ){
                const url = '<?php echo URLROOT?>/users/addDislikeToProduct/' +product_id.trim()+'/'+ user_id;
                console.log(url);

                const d = {
                        'addDislike':1,
                        'user_id' : user_id,
                        'product_id': product_id,
                    }
                

                const data  = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(d)
                })
                .then(response => response.json())
                .then(data =>{
                    console.log(data); 
                    if( dislikeBtn.getAttribute("data-dislike") === "addDislike" ){
                        dislikedCount.innerHTML = ++dislikedCount.innerText;
                    }

                    // Check is there any like and reduce the like count
                    // check is there any like and if it is reduce the like count
                    if( likeBtn.getAttribute("data-like") === "removeLike" ){
                        likedCount.innerHTML = --likedCount.innerText;    
                        likeBtn.style.color="black";
                        likeBtn.setAttribute("data-like","addLike");  
                    }

                    dislikeBtn.setAttribute("data-dislike","removeDislike");      
                    dislikeBtn.style.color="Red";


                })
                .catch(error => {
                    console.log("Error:", error);
                });
            }
            else if( dislikeBtn.getAttribute("data-dislike") === "removeDislike" ){
                const url = '<?php echo URLROOT?>/users/removeDislikeFromProduct/' +product_id.trim()+'/'+ user_id;
                console.log(url);

                const d = {
                        'removeDislike':1,
                        'user_id' : user_id,
                        'product_id': product_id,
                    }
                const data  = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(d)
                })
                .then(response => response.json())
                .then(data =>{
                    console.log(data); 
                    if( dislikeBtn.getAttribute("data-dislike") === "removeDislike" ){
                        dislikedCount.innerHTML = --dislikedCount.innerText;
                        dislikeBtn.setAttribute("data-dislike","addDislike");      
                        dislikeBtn.style.color="black"; 
    
                        likeBtn.style.color="black"; 
                        likeBtn.setAttribute("data-like","addLike");
                    }

                })
                .catch(error => {
                    console.log("Error:", error);
                });
            }
        }
        else{
            //user is not logged in 
            window.location.href = '<?php echo URLROOT?>/users/login/';
        }
    });


</script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
<script src="<?php echo URLROOT . '/public/js/product-watch-list.js';?>"></script>



</html>