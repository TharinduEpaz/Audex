<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/seller_advertisement.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/watchlist.css';?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>

    <style>
        .topicHeader h1{
            margin: 25px 0px 15px 20px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            color: darkgrey;
            font-size: 2em;
            font-weight: 500;
        }
        .switchDivs{
            text-decoration: none;
            font-weight: bolder;
            font-size: 12pt;
            background: #002EF9;
            color: white;
            text-align: center;
            padding: 1vh 1%;
            height: 5vh;
            width: 22%;
            border-radius: 7px;
            border: 1px solid #002EF9;
            margin: 15px 0px 0px 20px;
        }
        /* box = container-data, box-containt = container-ad */
        .box {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            /*align-items: center; */
            margin: 10px;

            /* display: grid;
            grid-template-columns: repeat(5,1fr);
            grid-auto-rows: 300px;
            grid-gap: 0.3rem; */
        }

        @media (max-width: 768px) {
            .box {
                flex-direction: column;
                align-items: stretch;
            }
        }

        .box-content {
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0,0,0,0.2);
            margin: 20px;
            width: 230px;
            height: 310px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-radius: 1rem;
            border: 1px solid ghostwhite;
            /* 4:5 */
        }

        @media (max-width: 768px) {
            .box-content {
                margin: 10px 0;
            }
        }

        .box-content-img {
            height: 200px;
            overflow: hidden;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 1rem 1rem 0 0;
        }

        .box-content-img img {
            /* width: 100%;
            height: 100%;
            object-fit:cover - 
            The image will be clipped to fit given dimension*/
            object-fit: cover;  
            max-width: -webkit-fill-available;
            height: inherit;
            max-height: -webkit-fill-available;
            aspect-ratio: auto;
            width: auto;

        }

        .box-content .title {
            height: 60px;
            padding: 10px;
            overflow: hidden;
            background-color: #E5E9F7;
            border-radius: 0 0 0 0;
            font-size: 14px;
            text-align: left;
            font-weight: 500;
            line-height: 1.5;
            color: rgb(56, 68, 36);
            width: 100%;

        }
        .box-content .title a {
            text-decoration: none;
            color: black;
        }
        
        .box-content .title h3 {
            margin: 0;
            font-size: 16px;
            overflow: hidden;
        }
        
        .box-content .price {
            height: 50px;
            padding: 5px 10px;
            overflow: hidden;
            background-color: #E5E9F7;
            text-align: end;
        }

        .box-content .price h6 {
            margin: 0;
            font-size: 16px;
            overflow: hidden;
        }

        .box-content .price button[type="submit"] {
            padding: 4px 10px;
            border: none;
            border-radius: 8px;
            background-color: #3423c8;
            color: #fff;
            cursor: pointer;
            font-size: 10px;
        }

        .box-content .price button[type="submit"]:hover {
            background-color: #666;
        }

        .box-content .price label{
            padding: 5px 10px;
            border: none;                               
            border-radius: 3px;
            background-color: white;
            color: indianred;
            /* cursor: pointer; */
            margin-right: 0%;
            font-size: 10px;
            font-weight: 600;
        }
        .box-content .price form input[type="submit"]{
            display: block;
            padding: 4px 10px;
            border: none;
            border-radius: 8px;
            background-color: red;
            color: #fff;
            cursor: pointer;
            font-size: 10px;
        }


    </style>

    <title>Profile</title>
</head>
<body>
<?php require_once APPROOT . '/views/users/navbar.php';?>


    <div class="container">
        <div class="sidebar">
            <!-- <a href="<?php echo URLROOT . '/buyers/getProfile/'.$_SESSION['user_id'];?>"><i class="fas fa-address-card"></i> <span>My Profile</span></a>
            <a href="#" class="current"> <i class="far fa-calendar-check" aria-hidden="true"></i><span>Watch List</span></a>
            <a href="#"> <i class="fa fa-comments-o" aria-hidden="true"></i><span>Feedback</span></a>
            <a href="<?php echo URLROOT . '/buyers/reactions/'.$_SESSION['user_id'];?>"> <i class="fa fa-thumbs-up" aria-hidden="true"></i><span>Reactions</span></a>
            <a id="messages" href="<?php echo URLROOT;?>/users/chat"> <i class="fa fa-comments"></i><span>Messages</span></a> -->
            
            <a id="profile" href="<?php echo URLROOT . '/buyers/getProfile/'.$_SESSION['user_id'];?>" ><i class="fas fa-address-card"></i> <span>My Profile</span></a>
            <a id="watch_list" href="<?php echo URLROOT . '/buyers/watchlist';?>"> <i class="far fa-calendar-check" aria-hidden="true"></i><span>Watch List</span></a>
            <a id="feedback" href="#"> <i class="fa fa-comments-o" aria-hidden="true"></i><span>Feedback</span></a>
            <a id="reactions" href="<?php echo URLROOT . '/buyers/reactions';?>"> <i class="fa fa-thumbs-up" aria-hidden="true"></i><span>Reactions</span></a>
            <a id="messages" href="<?php echo URLROOT . '/users/chat';?>"> <i class="fa fa-comments"></i><span>Messages</span></a>  

        </div>

        <div class="poster_advertisements">
            <!-- create link to go between two headers -->
            <button class="switchDivs" onclick="location.href='#partOneProducts'">Watch Products</button>
            <button class="switchDivs" onclick="location.href='#partTwoServiceProvidrs'">Service providers</button>
            <?php if( sizeof($data['products']) > 0 ) 
                    echo "<div class = 'topicHeader'> 
                        <h1>Watch Products</h1> 
                    </div>";
                else{
                    echo "<div class = 'topicHeader'> 
                        <h1>Your Watchlist Don Not Have Any Watch Products.</h1> 
                    </div>";
                }
            ?>
            <div class="box" id="partOneProducts">
            <?php $i=0;
                foreach($data['products'] as $ads) : ?>
                    <div class="box-content">
                        <div class="box-content-img">
                            <img src="<?php echo URLROOT.'/public/uploads/'.$ads->image1;?>" /> 
                        </div>
                        <div class="title">
                            <h3><a href="<?php if($ads->product_type == 'auction'){
                                        echo URLROOT . '/users/auction/'.$ads->product_id;
                                    }else{
                                        echo URLROOT . '/users/advertiesmentDetails/'.$ads->product_id;
                                    }
                                ?>">
                                <?php echo $ads->product_title ; ?></a> </h3>
                            <h6><?php echo $ads->p_description ; ?></h6>
                        </div>
                        <div class="price">
                            <?php 
                                if($ads->product_type == 'auction' ){
                                    echo '<label>Auction</label>';?>
                                    
                                    <?php } $i++;?>
                                    
                            <label for="price"><?php echo 'LKR:'.$ads->price ; ?></label>
                            <a href="<?php if($ads->product_type == 'auction'){
                                    echo URLROOT . '/users/auction/'.$ads->product_id;
                                }else{
                                    echo URLROOT . '/users/advertiesmentDetails/'.$ads->product_id;
                                }
                                    ?>">
                                    <button type="submit">View</button>
                            </a>
                                
                            <form class="remove_item" method="post">
                                <!-- if user is logged in then he have a _SESSION, if not user id value will be 0  -->
                                <input type="text" name="user_type" value="buyer" hidden>
                                <input type="text" name ="user_id" value= " <?php echo (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0) ; ?>" hidden>
                                <input type="text" name="product_id" value="<?php echo $ads->product_id ; ?>" hidden >
                                <input type="submit" value="Remove" name="submit_btn">
                            </form>
                        </div>

                    </div> 
                <?php endforeach; ?>
            </div>

            <?php if( sizeof($data['serviceProviders']) > 0 ) 
                    echo "<div class = 'topicHeader'> 
                        <h1>Service Providers</h1> 
                    </div>";
                else{
                    echo "<div class = 'topicHeader'> 
                        <h1>Your Watchlist Don Not Have Any Service Providers.</h1> 
                    </div>";
                }
            ?>
            <div class="box" id="partTwoServiceProvidrs">
            <?php $i=0;
                foreach($data['serviceProviders'] as $people) : ?>
                    <div class="box-content">
                        <div class="box-content-img">
                            <!-- <img src="<?php echo URLROOT.'/public/uploads/Profile/'.$people->profile_image;?>" />  -->
                            <?php $id = $people->user_id; ?>
                            <a href="<?php echo URLROOT .'/users/serviceProviderPublic/' . "?id=$id" ?>">
                                <img src="<?php echo URLROOT .'/public/uploads/' . $people->profile_pic ?>" alt="">
                            </a>
                        </div>
                        <div class="title">
                            <h3><?php $id = $people->user_id; ?>
                                <a href="<?php echo URLROOT .'/users/serviceProviderPublic/' . "?id=$id" ?>">
                                <?php echo $people->first_name." ".$people->second_name ; ?></a> 
                            </h3>
                            <form class="remove_watch_service_provider" method="post">
                                <!-- remove single service provider js will call -->
                                <!-- if user is logged in then he have a _SESSION, if not user id value will be 0  -->
                                <input type="text" name="user_type" value="buyer" hidden>
                                <input type="text" name ="user_id" value= " <?php echo (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0) ; ?>" hidden>
                                <input type="text" name ="buyer_email" value= " <?php echo (isset($_SESSION['user_email']) ? $_SESSION['user_email'] : null) ; ?>" hidden>
                                <input type="text" name="service_provider_email" value="<?php echo $people->email ; ?>" hidden >
                                <input type="text" name="service_provider_id" value="<?php echo $people->user_id ; ?>" hidden >
                                <input type="submit" value="Remove" name="submit_btn">
                            </form>
                        </div>
                    </div> 
                <?php endforeach; ?>
            </div>
        </div>  
    </div>
</body>
<script>
jQuery(document).ready(function(){
    $.getScript('<?php echo URLROOT . '/public/js/form.js';?>');
    $.getScript('<?php echo URLROOT . '/public/js/removeSingleWatchListItem.js';?>');
    $.getScript('<?php echo URLROOT . '/public/js/removeSingleServiceProvider.js';?>');
});
</script>
</html>
