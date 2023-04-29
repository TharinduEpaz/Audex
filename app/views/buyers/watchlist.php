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
        .poster_advertisements {
            padding: 0% 0% 1% 0%;
        }
        .topicHeader h1{
            margin: 25px 0px 15px 20px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            color: darkgrey;
            font-size: 2em;
            font-weight: 500;
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
        .box-content .price form button[type="submit"]{
            display: block;
            padding: 4px 10px;
            border: none;
            border-radius: 8px;
            background-color: red;
            color: #fff;
            cursor: pointer;
            font-size: 10px;
        }
        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons that are used to open the tab content */
        .tab button {
            background-color: #c4cce2;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 1rem;
            font-weight: 500;
            color: white;
            width: 50%;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #97A3F1;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #97A3F1;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
        .tabcontent {
            animation: fadeEffect 1s; /* Fading effect takes 1 second */
        }

        /* Go from zero to full opacity */
        @keyframes fadeEffect {
            from {opacity: 0;}
            to {opacity: 1;}
        }



    </style>

    <title>Profile</title>
</head>
<body>
<?php require_once APPROOT . '/views/buyers/navbar.php';?>


    <div class="container">
        <?php require_once APPROOT . '/views/buyers/sidebar.php';?>

        <div class="poster_advertisements">
            <!-- create link to go between two headers -->
            <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'partOneProducts')" id="defaultOpen">Products</button>
                <button class="tablinks" onclick="openTab(event, 'partTwoServiceProvidrs')">Service Providers</button>
            </div>

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
                                <!-- <input type="submit" value="Remove" name="submit_btn"> -->
                                <button type="submit" class="remove-btn" name="submit_btn"><i class="fa-solid fa-trash"></i></i></button>
                            </form>
                        </div>

                    </div> 
                <?php endforeach; ?>
            </div>


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
                                <!-- <input type="submit" value="Remove" name="submit_btn"> -->
                                <button type="submit" class="remove-btn" name="submit_btn"><i class="fa-solid fa-trash"></i></i></button>
                            </form>
                        </div>
                    </div> 
                <?php endforeach; ?>
            </div>
        </div>  
    </div>
</body>
<script>
    //keeping the sidebar button clicked at the page
    link = document.querySelector('#watch_list');
    link.style.background = "#E5E9F7";
    link.style.color = "red";
    link.style.fontWeight = "800";

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();

    function openTab(evt, tabId) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="box" and hide them
        tabcontent = document.getElementsByClassName("box");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(tabId).style.display = "flex";
        evt.currentTarget.className += " active";
    }


</script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
<script src="<?php echo URLROOT . '/public/js/removeSingleWatchListItem.js';?>"></script>
<script src="<?php echo URLROOT . '/public/js/removeSingleServiceProvider.js';?>"></script>
</html>
