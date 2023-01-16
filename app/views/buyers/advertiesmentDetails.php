<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/login.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/shop.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/advertiesmentDetails.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/dialogBox.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title><?php echo SITENAME; ?></title>
</head>
<body>
    <style>
        body .container{
            background-image: none;
            background-color: rgb(214, 214, 239);
        }
    </style> 
    <nav>
        <input type="checkbox" name="check" id="check" onchange="docheck()">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <img src="<?php echo URLROOT . '/public/img/image 1.png';?>" alt="logo">
        <ul>
            <li><a href="<?php echo URLROOT;?>/buyers/index" class="nav_tags">Home</a></li>
            <li><a href="<?php echo URLROOT;?>/buyers/shop" class="nav_tags">Shop</a></li>
            <li><a href="#" class="nav_tags">Sound Engineers</a></li>
            <li><a href="#" class="nav_tags">Events</a></li>
            <?php if(isset($_SESSION['user_id'])){
                echo '<div class="dropdown">';
                    echo '<button onclick="myFunction()" class="dropbtn">Hi '.$_SESSION['user_name']. ' &nbsp<i class="fa-solid fa-caret-down"></i></button>';
                    echo '<div id="myDropdown" class="dropdown-content">';
                        echo '<a href="'.URLROOT .'/'.$_SESSION['user_type'].'s/getProfile/'.$_SESSION['user_id'].'" class="nav_tags">Profile</a>';
                        echo '<a href="'.URLROOT . '/'.$_SESSION['user_type'].'s/watchlist/'.$_SESSION['user_id'].'" class="nav_tags">Watchlist</a>';
                        echo '<a href="#" class="nav_tags">Feedback</a>';
                        echo '<a href="#" class="nav_tags">Reactions</a>';
                        echo '<a href="#" class="nav_tags">Messages</a>';
                        echo '<a href="'.URLROOT . '/users/logout" class="nav_tags">Logout</a>';
                    echo '</div>';
                echo '</div> ';
            }
            else{
                echo '<li><a href="'.URLROOT . '/users/login" class="nav_tags">Login</a></li>';
                echo '<li><a href="'.URLROOT.'/users/register" class="nav_tags">Signup</a></li>';
            }
    ?>

        </ul>
    </nav>

    <div class="container">
        <!-- <div class="ad-search" >
            <input type="search" name="search"> 
            <a href="#"><button type="submit" value="search" name="submit">Search</button></a>
        </div> -->
        <div class="container-main">
            <div class="container-product">
                <div class="container-product-img">
                    <img src="<?php echo URLROOT.'/public/uploads/'.$data['ad']->image1;?>" />
                    <div class="like-dislike-area">
                        <button type="submit" onload="likeBtnOnload()" id="product-like-btn" data-like = "addLike"><i class="fas fa-thumbs-up"></i></button>
                        <button type="submit" id="product-dislike-btn" data-dislike = "removeLike"><i class="fa-solid fa-thumbs-down"></i></button> 
                    </div>
                </div>
                <div class="container-product-attributes">
                    <div class="title">
                        <h3><?php echo $data['ad']->product_title ; ?></h3>
                    </div>
                    <div class="category">
                        <h4><?php echo $data['ad']->product_category ; ?></h4>
                    </div>
                    <div class="condition">
                        <h4><?php echo $data['ad']->product_condition ; ?></h4>
                    </div>
                    <div class="brand">
                        <h4><?php echo $data['ad']->brand ; ?></h4>
                    </div>            
                    <div class="price">
                        <button ><?php echo 'RS.'.$data['ad']->price ; ?></button>
                    </div>
                    <button type="submit" class="msg">Message</button>
                    <!-- <?php 
                        if(isset($_SESSION['user_type'])){
                            if($_SESSION['user_type'] == 'buyer' || $_SESSION['user_type'] == 'service_provider'){
                                echo '<button type="submit" class="msg">Message</button>';
                            }

                        }
                    ?> -->

                    <form id="add_watch_list_form" method="POST" data-op = "add" >
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
                                <i class="fa-sharp fa-solid fa-xmark"></i>
                            </div>  
                            <hr>
                            <div>
                                <button class="continue">OK </button>  
                                <button class="close">Close</button>
                            </div>
                        </dialog>
                        <!-- <?php 
                            if(isset($_SESSION['user_type'])){
                                if($_SESSION['user_type'] == 'buyer' || $_SESSION['user_type'] == 'service_provider'){
                                    echo '<input type="submit" value="Add To Watchlist" class="watch" id="add-to-watchlist">';
                                }
                            }
                        ?> -->
                    </form>
                </div>
            </div>
            <div class="container-description">
                    <h4>Product Description</h4>
                    <?php echo $data['ad']->p_description ; ?>
            </div>
        </div>
    </div>
</body>

<script>
    // like removeLike functions click event
    const likeBtn = document.getElementById("product-like-btn");
    const dislikeBtn = document.getElementById("product-dislike-btn");

    // get user id and product id using sessions
    const user_id = "<?php echo $_SESSION['user_id']; ?>";
    const product_id = "<?php echo $_SESSION['product_id']; ?>";

    // window.addEventListener("DOMContentLoaded",(e)=>{
    //     // e.preventDefault();
    //     console.log("loaded");
    //     likeBtn.style.background="green";
    // });

    // like btn onload event
    // function likeBtnOnload(){
    //     console.log("loaded");
    //     // window.addEventListener("DOMContentLoaded", (e)=>{
    //     //     // e.preventDefault();
    //     //     console.log("loaded");
    //     //     likeBtn.style.color="green";

    //     // } );
    // }                        

    likeBtn.addEventListener("click",async (e)=>{
        e.preventDefault();

        if(likeBtn.getAttribute("data-like") === "addLike"){
            const url = 'http://localhost/Audex/buyers/addLikeToProduct/' +product_id.trim()+'/'+ user_id.trim();
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
                likeBtn.setAttribute("data-like","removeLike");      
                likeBtn.style.background="Red";

            })
            .catch(error => {
                console.log("Error:", error);
            });

        }
        else if(likeBtn.getAttribute("data-like") === "removeLike"){
            const url = 'http://localhost/Audex/buyers/removeLikeFromProduct/' +product_id.trim()+'/'+ user_id.trim();
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
                likeBtn.setAttribute("data-like","addLike");      
                likeBtn.style.color="black";
            })
            .catch(error => {
                console.log("Error:", error);
            });

        }


    });


</script>

<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>

