<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/advertise.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/advertiesmentDetails.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo MAPS_API;?>&callback=initMap&libraries=placesMap&v=weekly"></script>
    <title>Advertisement</title>
</head>
<body>
<?php require_once APPROOT . '/views/users/navbar.php';?>

    <div class="container" style="background: none;">
    
        <div class="content">
            <div class="image_likes">
            <div class="image">
                    <div class="grid">
                        <div id="img1" class="img1" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['ad']->image1;?>)">
                        </div>
                        <div class="img2" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['ad']->image1;?>)">    
                            <a style="width: 100%;height:100%; " onclick="change_img1(); return false;" ></a>
                        </div>
                        <div class="img3" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['ad']->image2;?>)"> 
                            <?php if($data['ad']->image2!=null){?>  
                                <a style="width: 100%;height:100%; " onclick="change_img2(); return false;"></a> 
                            <?php }?>
                        </div>
                        <div class="img4" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['ad']->image3;?>)">   
                            <?php if($data['ad']->image3!=null){?>  
                                <a style="width: 100%;height:100%; " onclick="change_img3(); return false;"></a>
                            <?php }?>
                        </div>
                    </div>
            </div>
                <div class="like-dislike-area">
                        <!-- used two custom attributes one for click event and other one to store liked value when load -->
                        <div id="like-count">
                            <?php echo $data['likedCount'] ?>
                        </div>
                        <button type="submit" onload="likeBtnOnload()" id="product-like-btn" data-like = "addLike" data-likeLoad ="<?php echo $data['liked'] ; ?>" ><i class="fas fa-thumbs-up"></i></button>
                        <div id="dislike-count">
                            <?php echo $data['dislikedCount'] ?>
                        </div>
                        <button type="submit" id="product-dislike-btn" data-dislike = "addDislike" data-dislikeLoad = "<?php echo $data['disliked'] ; ?>" ><i class="fa-solid fa-thumbs-down"></i></button> 
                    </div>

            </div>
            <div class="details">
                <h2><?php echo $data['ad']->product_title?></h2>
                <table>
                    <tr>
                        <td class="name">Category</td>
                        <td class="value">: <?php echo ucwords($data['ad']->product_category)?></td>
                    </tr>
                    <tr>
                        <td class="name">Model Number</td>
                        <td class="value">: <?php echo $data['ad']->model_no?></td>
                    </tr>
                    <tr>
                        <td class="name">Brand name</td>
                        <td class="value">: <?php echo ucwords($data['ad']->brand)?></td>
                    </tr>
                    <tr>
                        <td class="name">Condition</td>
                        <td class="value">: <?php echo $data['ad']->product_condition?></td>
                    </tr>
                </table>
                <div class="price">
                    <h4>LKR&nbsp;<?php echo $data['ad']->price?></h4>
                </div>
                <div class="message_bid">
                <?php 
                    if(isLoggedIn()){
                        if($_SESSION['user_email']!=$data['ad']->email){
                            echo '<div class="message_seller">';
                            echo '<a href="'.URLROOT.'/users/bid/'.$data['ad']->product_id.'">Message Seller</a>';
                            echo '</div>';
                        }
                    }
                ?>
                <!-- add to watch button is not visible if user is a seller or service provider -->
                <!-- watch list button should visible if user is not logged in -->
                <?php
                    if( !isLoggedIn() ){?>
                            <div class="add_watch_list">
                                <form id="add_watch_list_form" method="POST" data-op = "add" data-watchLoad ="<?php echo $data['watched'] ; ?>" >
                                    <!-- if user is logged in then he have a _SESSION, if not user id value will be 0  -->
                                    <input type="text" name="user_type" value="buyer" hidden>
                                    <input type="text" name ="user_id" value= " <?php echo (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0) ; ?>" hidden>
                                    <input type="text" name="product_id" value="<?php echo $data['ad']->product_id ; ?>" hidden >
                                    
                                    <div class="button-container">
                                        <input type="submit" value="Add To Watchlist" class="watch" id="add-to-watchlist">
                                    </div>
                                    <dialog id="dia">
                                        <div class="top-part">
                                            <button class="btn_close">X</button>
                                            <!-- <i class="fa-sharp fa-solid fa-xmark"></i> -->
                                        </div>  
                                        <hr>
                                        <div>
                                            <button class="continue">OK </button>  
                                            <button class="close">Close</button>
                                        </div>
                                    </dialog>
                    
                                </form>
                            </div>
                            <?php } else if($_SESSION['user_type'] != 'seller' && $_SESSION['user_type'] != 'service_provider' ){ ?>
                                <div class="add_watch_list">
                                    <form id="add_watch_list_form" method="POST" data-op = "add" data-watchLoad ="<?php echo $data['watched'] ; ?>" >
                                        <!-- if user is logged in then he have a _SESSION, if not user id value will be 0  -->
                                        <input type="text" name="user_type" value="buyer" hidden>
                                        <input type="text" name ="user_id" value= " <?php echo (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0) ; ?>" hidden>
                                        <input type="text" name="product_id" value="<?php echo $data['ad']->product_id ; ?>" hidden >
                                        
                                        <div class="button-container">
                                            <input style="margin-top:2vh" type="submit" value="Add To Watchlist" class="watch" id="add-to-watchlist">
                                        </div>
                                        <dialog id="dia">
                                            <div class="top-part">
                                                <button class="btn_close">X</button>
                                                <!-- <i class="fa-sharp fa-solid fa-xmark"></i> -->
                                            </div>  
                                            <hr>
                                            <div>
                                                <button class="continue">OK </button>  
                                                <button class="close">Close</button>
                                            </div>
                                        </dialog>
                        
                                    </form>
                                </div>

                <?php }?>
                </div>


                <!-- <?php echo 'Hello'.$data['ad']->longitude;?> -->
                <?php if($data['ad']->longitude!='NULL' && $data['ad']->latitude!='NULL'){?>
                    <div class="location">
                        <div class="input">
                            <a href="" class="post" onclick="openModal(); return false;">Check on map</a>
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
            </div>
            <div class="seller-detais">
                <h2 style="text-align: center;width:115%"><?php 
                            if( empty($data['seller']->shop_name )){
                                echo 'Seller';
                            }
                            else{
                                echo 'Shop';
                            }
                        ?> Details</h2>
                        

                                

                <a href="<?php echo URLROOT . '/users/getProfile/'.$data['SellerMoreDetails']->user_id;?>">

                            
                <div class="top_details">
                        <div class="profile_img">
                            <img src="<?php echo URLROOT . '/public/uploads/'.$data['SellerMoreDetails']->profile_pic;?>" alt="Profile Picture">
                        </div>
                        <div class="other_details_profile">
                            <p class="full_name"><?php echo $data['SellerMoreDetails']->first_name.' '.$data['SellerMoreDetails']->second_name; ?></p>
                            <div class="stars_date">
                                <div class="stars">
                                    <!-- <img src="<?php echo URLROOT . '/public/img/stars.png';;?>" alt="Profile Picture"> -->
                                    <div class="current-rate">
                                    <!-- <label for="current-rate" style="display:none">Rate:</label> -->
                                    <!-- <input type="text" name="current-rate" value="<?php echo $data['SellerMoreDetails']->rate ?>" id="current-seller-rate"> -->
                                    <div class="rating-stars">
                                        <!-- <span class="rate"><?php echo $data['seller']->rate;?></span>  -->

                                        <?php $i=0;
                                        for($i; $i<=floor($data['SellerMoreDetails']->rate); $i++): ?>
                                        <i class="fa fa-star"></i>
                                        <?php endfor; ?>
                                        
                                        <?php if(strpos((string)$data['SellerMoreDetails']->rate, '.')){?>
                                        <!-- <i class="fa fa-star-half-o"></i> -->
                                        
                                        <?php $i++;} 
                                        while($i<5){ ?>
                                        <i class="fa fa-star-o"></i>
                                        <?php $i++; } ?>
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
                        </div>
                    </div>
                    </a>
                <!-- <div class="review-seller"> -->
                <!-- add to watch button is not visible if user is a seller or service provider -->
                <!-- watch list button should visible if user is not logged in -->
                    <!-- <?php if(!isLoggedIn()){?>
                        <div class="write-review">
                            <input type="submit" value="Write Review" id="review-seller-btn">
                        </div>
                    <?php } else if($_SESSION['user_type'] != 'seller' && $_SESSION['user_type'] != 'service_provider' ){ ?>
                            <div class="write-review">
                                <input type="submit" value="Write Review" id="review-seller-btn">
                            </div>
                    <?php } ?> -->

                    <!-- <div class="review-form">
                        <div class="review-area-select-star">
                            <label for="select">Select:</label>
                            <div class="star-rating">
                                <i class="fa fa-star star" data-value="1"></i>
                                <i class="fa fa-star star" data-value="2"></i>
                                <i class="fa fa-star star" data-value="3"></i>
                                <i class="fa fa-star star" data-value="4"></i>
                                <i class="fa fa-star star" data-value="5"></i>
                            </div>
                        </div> -->
                        <!-- <div class="selected-rate">
                            <label for="given-rate">Rate:</label>
                            <input type="text" value="<?php echo $data['loadRate'] ?>" id="buyer-selected-rate">
                        </div> -->
                        <!-- <div class="feedback-area">
                            <form action="" method="post" id="review-write-form">
                                <label for="feedback">Feedback:</label>
                                <textarea  name="review" rows="4" id="submitted-feedback"  ><?php echo $data['loadFeedback'] ?></textarea>
                                <input type="submit" value="Submit" id="submit-review-btn">

                            </form>
                        </div> -->
                    <!-- </div> -->
                </div>
            </div>
        </div>
        <div class="description">
            <h3>Description</h3>
            <p><?php echo $data['ad']->p_description?></p>
        </div>
    </div>
</body>
<script>
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

// rate functionality======================================================================================================================

    writeReviewBtn = document.getElementById("review-seller-btn");
    reviewWriteForm = document.getElementById("review-write-form");
    const stars = document.querySelectorAll('.star-rating .star');
    const sellerEmail = '<?php echo $data['SellerMoreDetails']->email ?>';
    var value = '';

    writeReviewBtn.addEventListener("click",(e)=>{
        if(user_id != "0"){
            // user is logged in
       
            document.querySelector(".review-form").style.visibility = "visible";
            for (const star of stars) {
                star.addEventListener('click', function () {
                    value = parseFloat(this.getAttribute('data-value'));

                        for (const star of stars) {
                            star.classList.remove('selected');
                        }
                
                        for (let i = 0; i < value; i++) {
                            stars[i].classList.add('selected');
                        }
                        document.getElementById('buyer-selected-rate').value = value;
                        // document.getElementById('current-seller-rate').value = data.results4;
                    
                });
            }
            reviewWriteForm.addEventListener("submit",(e)=>{
                e.preventDefault();
                //get the form data/sumitted data
                const feedback = document.getElementById('submitted-feedback').value;
                console.log(feedback);
                console.log(value);

                const url1 = '<?php echo URLROOT?>/users/rateSeller/';

                fetch(url1, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ rating: value,
                                           review:feedback,
                                           buyer:user_id,
                                           seller:sellerEmail
                                        }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data.message);
            
                    for (const star of stars) {
                     star.classList.remove('selected');
                    }
            
                    for (let i = 0; i < value; i++) {
                     stars[i].classList.add('selected');
                    }
                    document.getElementById('buyer-selected-rate').value = value;
                    document.getElementById('current-seller-rate').value = data.results4;
                })
                .catch(error => {
                    console.error(error);
                });
            });

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
<!-- Closing the connection-->