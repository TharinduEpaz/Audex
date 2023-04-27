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
            height: 290px;
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
            height: 30px;
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
    <?php require_once APPROOT . '/views/buyers/sidebar.php';?>   
        <div class="poster_advertisements">
        
            <!-- create link to go between two headers -->
            <button class="switchDivs" onclick="location.href='#partOneLikedProducts'">Liked Products</button>
            <button class="switchDivs" onclick="location.href='#partTwoDisikedProducts'">Disliked Products</button>

            <?php if( sizeof($data['likedProducts']) > 0 ) 
                    echo "<div class = 'topicHeader'> 
                        <h1>Liked Products</h1> 
                    </div>";
                else{
                    echo "<div class = 'topicHeader'> 
                        <h1>Your Watchlist Don Not Have Any Liked Products.</h1> 
                    </div>";
                }
            ?>
            <div class="box" id="partOneLikedProducts">
                <?php $i=0;
                foreach($data['likedProducts'] as $ads) : ?>
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
                        </div>

                    </div> 
                <?php endforeach; ?>
            </div>
            <?php if( sizeof($data['dislikedProducts']) > 0 ) 
                    echo "<div class = 'topicHeader'> 
                        <h1>Disliked Products</h1> 
                    </div>";
                else{
                    echo "<div class = 'topicHeader'> 
                        <h1>Your Watchlist Don Not Have Any Disliked Products.</h1> 
                    </div>";
                }
            ?>
            <div class="box" id="partTwoDisikedProducts">
                <?php $i=0;
                foreach($data['dislikedProducts'] as $ads) : ?>
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
                        </div>

                    </div> 
                <?php endforeach; ?>
            </div>
            <!-- bellow this -->
            

        </div>
    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
<script src="<?php echo URLROOT . '/public/js/removeWatchListItem.js';?>"></script>
</html>
