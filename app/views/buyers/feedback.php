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
            flex-direction: column;
            flex-wrap: wrap;
            justify-content: flex-start;
            align-items: center;
            margin: 10px;
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
            width: 90%;
            height: 150px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-radius: 1rem;
            border: 1px solid ghostwhite;
            padding: 10px;
            /* 4:5 */
        }

        @media (max-width: 768px) {
            .box-content {
                margin: 10px 0;
            }
        }

        .box-content a{
            width: 100%;
            height: 100%;
            display: contents;
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



        .box-content label{
            padding: 5px 10px;
            border: none;                               
            border-radius: 3px;
            /* background-color: white; */
            color: black;
            /* cursor: pointer; */
            margin-right: 0%;
            font-size: 14px;
            font-weight: 700;
        }
        .seller-review{
            display: contents;
        }
        .rate-review{
            margin: 0 0 0 3%;
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
                <button class="tablinks" onclick="openTab(event, 'partOneSellers')" id="defaultOpen">Given To Sellers</button>
                <button class="tablinks" onclick="openTab(event, 'partTwoServiceProvidrs')">Given Service Providers</button>
            </div>

            <div class="box" id="partOneSellers">
            <?php $i=0;
                foreach($data['sellers'] as $sellers) : ?>
                    <div class="box-content">  
                        <div class="seller-mail">
                            <label for="mail">Seller Email:</label>
                            <span><?php echo $sellers->email_rate_receiver; ?></span>
                        </div>
                        <div class="seller-rate">
                            <label for="rate">Given Rate:</label>
                                <?php 
                                    $i=$sellers->rate;
                                    $j=0;

                                    for($i; $i>=1; $i--){?>
                                        <i class="fa fa-star"></i>
                                    <?php  
                                        $j++;} 
                                    ?>
                                    
                                    <?php 
                                        if($i>0){ ?>
                                            <i class="fa fa-star-half-o"></i>
                                    
                                            <?php $i--;$j++;} 
                                    while($j<5){ ?>
                                        <i class="fa fa-star-o"></i>
                                    <?php $j++; } ?>


                        </div>
                        <div class="seller-review">
                            <label for="rate">Given Rate:</label>
                            <span class="rate-review"><?php echo $sellers->review; ?></span>

                        </div>

                    </div> 
                <?php endforeach; ?>
            </div>


            <div class="box" id="partTwoServiceProvidrs">
            <?php $i=0;
                foreach($data['serviceProviders'] as $serviceProviders) : ?>
                    <div class="box-content">
                        <div class="seller-mail">
                            <label for="mail">Seller Email:</label>
                            <span><?php echo $serviceProviders->email_service_provider; ?></span>
                        </div>
                        <div class="seller-rate">
                            <label for="rate">Given Rate:</label>
                                <?php 
                                    $i=$serviceProviders->rate;
                                    $j=0;

                                    for($i; $i>=1; $i--){?>
                                        <i class="fa fa-star"></i>
                                    <?php  
                                        $j++;} 
                                    ?>
                                    
                                    <?php 
                                        if($i>0){ ?>
                                            <i class="fa fa-star-half-o"></i>
                                    
                                            <?php $i--;$j++;} 
                                    while($j<5){ ?>
                                        <i class="fa fa-star-o"></i>
                                    <?php $j++; } ?>


                        </div>
                        <div class="seller-review">
                            <label for="rate">Given Rate:</label>
                            <span class="rate-review"><?php echo $serviceProviders->review; ?></span>

                        </div>
                    </div> 
                <?php endforeach; ?>
            </div>
        </div>  
    </div>
</body>
<script>
    //keeping the sidebar button clicked at the page
    link = document.querySelector('#feedback');
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
