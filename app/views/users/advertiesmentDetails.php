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
    <title>Advertisement</title>
</head>
<body>
<?php require_once APPROOT . '/views/users/navbar.php';?>

    <div class="container" style="background: none;">
    
        <div class="content">
            <div class="image">
                <img src="<?php echo URLROOT.'/public/uploads/'.$data['ad']->image1;?>" alt="">
                <div class="like-dislike-area">
                        <!-- used two custom attributes one for click event and other one to store liked value when load -->
                        <button type="submit" onload="likeBtnOnload()" id="product-like-btn" data-like = "addLike" data-likeLoad ="<?php echo $data['liked'] ; ?>"><i class="fas fa-thumbs-up"></i></button>
                        <button type="submit" id="product-dislike-btn" data-dislike = "removeLike"><i class="fa-solid fa-thumbs-down"></i></button> 
                    </div>
                <!-- <a href="">next</a> -->
            </div>
            <div class="details">
                <h2><?php echo $data['ad']->product_title?></h2>
                <table>
                    <tr>
                        <td class="name">Category</td>
                        <td class="value">: <?php echo $data['ad']->product_category?></td>
                    </tr>
                    <tr>
                        <td class="name">Model Number</td>
                        <td class="value">: <?php echo $data['ad']->model_no?></td>
                    </tr>
                    <tr>
                        <td class="name">Brand name</td>
                        <td class="value">: <?php echo $data['ad']->brand?></td>
                    </tr>
                    <tr>
                        <td class="name">Condition</td>
                        <td class="value">: <?php echo $data['ad']->product_condition?></td>
                    </tr>
                </table>
                <div class="price">
                    <h4>Rs. <?php echo $data['ad']->price?></h4>
                </div>
                <div class="message_bid">
                <?php 
                    if(isLoggedIn()){
                        if($_SESSION['user_email']!=$data['ad']->email){
                            if($data['ad']->product_type=='auction'){

                                echo '<div class="bid_now">';
                                echo '<a href="'.URLROOT.'/users/bid/'.$data['ad']->product_id.'">Bid Now</a>';
                                echo '</div>';
                            }
                            echo '<div class="message_seller">';
                            echo '<a href="'.URLROOT.'/users/bid/'.$data['ad']->product_id.'">Message Seller</a>';
                            echo '</div>';
                        }
                    }
                ?>
                </div>
                <div class="add_watch_list">
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
        </div>
        <div class="description">
            <h3>Description</h3>
            <p><?php echo $data['ad']->p_description?></p>
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

    // add even listner to check status of like when load liked or not liked
    window.addEventListener("DOMContentLoaded",(e)=>{
        if(likeBtn.getAttribute("data-likeLoad") === "liked"){
            likeBtn.style.color="Red";
            likeBtn.setAttribute("data-like","removeLike"); 
        }
    });

                     

    likeBtn.addEventListener("click",async (e)=>{
        e.preventDefault();

        if(likeBtn.getAttribute("data-like") === "addLike"){
            const url = 'http://localhost/Audex/users/addLikeToProduct/' +product_id.trim()+'/'+ user_id.trim();
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
                likeBtn.style.color="Red";

            })
            .catch(error => {
                console.log("Error:", error);
            });

        }
        else if(likeBtn.getAttribute("data-like") === "removeLike"){
            const url = 'http://localhost/Audex/users/removeLikeFromProduct/' +product_id.trim()+'/'+ user_id.trim();
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
<!-- Closing the connection-->