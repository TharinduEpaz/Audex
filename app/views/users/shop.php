<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/login.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/shop.css?id=123';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/advertiesmentDetails.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>

    <title><?php echo SITENAME; ?></title>
    
    <style>
        /* styles for search results submits */
        .result-container{
            display: flex;
            flex-direction: row;
            height: 240px;
            width: 90%;
            margin: 3%;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0 5px rgb(0 0 0 / 20%);
            overflow: hidden;

        }

        @media (max-width: 768px) {
            .result-container {
                max-width: 100%;
                padding: 0 10px;
                flex-direction: column;
            }
        }

        .result-container-img{
            width: 250px;
            height: 100%;
            border-radius: 15px 0px 0px 15px;
        }

        .result-container-img img{
            width: 100%;
            height: 100%;
            object-fit: fill;
            border-radius: 15px 0px 0px 15px;
        }

        .result-container .result-title{
            display: flex;
            flex-direction: column;
            font-weight: 800;
            width: 90%;
            height: 100%;
            padding: 10px;
            border-radius: 0px 15px 15px 0px;
            overflow: hidden;
            
        }
        .result-container .result-title .top-part{
            height: 133px;
            margin-bottom: 10px;
            overflow: hidden;
        }
        
        .result-container .result-title .bottom-part{
            height: 107px;
            display: flex;
            flex-direction: column;
        }

        .result-title h3{
            padding: 5px;
            font-weight: 600;
            overflow: hidden;
        }
        .result-title h4{
            padding: 5px;
            font-weight: 600;
            overflow: hidden;
        }
        .result-title h5{
            padding: 5px;
            font-weight: 600;
            overflow: hidden;
        }

        .result-title h6{
            padding: 5px;
            font-weight: 600;
            overflow: hidden;
            margin: 5px 0px;
            display: contents;
        }
        .result-title a{
            text-decoration: none;
            color: #000;
        }
        .result-title button{
            padding: 4px 10px;
            border: none;
            border-radius: 8px;
            background-color: #3423c8;
            color: #fff;
            cursor: pointer;
            margin: 1px 20px 1px 0px;
            align-self: end;
        }
        .result-title label{
            border: none;
            border-radius: 3px;
            color: black;
            margin-right: 0%;
            /* background: #c85555; */
            padding: 4px;
            margin: 1px 20px 1px -4px;
        }
        

        /* styles for live search results */


        #shop-search-results{
            display: block;
            margin-top: -25px;
            margin-left: 2.5%;
        }
        #shop-search-results .table {
            width: 53%;
            border-collapse: collapse;
            /* margin-left: 3%; */
        } 
        #shop-search-results .table td {
            padding: 12px 15px;
            border: 1px solid rgb(169 165 165);
            background: #ffffff;
            display: -webkit-box;
            text-align: left;
            font-size: 16px;
        }


        .shop-container {
            margin: 0 auto;
            position: absolute;
            display: flex;
            flex-direction: row;
            background-image: none;
            background-color: #E5E9F7;
            /* margin-left: 240px; */
            /* margin-top: 10vh; */
            /* min-width: 100vw; */
            top: 10vh;
            left: 240px;
            width: calc(100vw - 240px);
        }
        .btn-primary{
            height: 5vh;
            margin-top: 3vh;
            font-size: 15pt;
            font-weight: 800;
        }

        .btn-primary:hover{
            background-color: #3423c8;
            color: #fff;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .shop-container {
                max-width: 100%;
                padding: 0 10px;
                flex-direction: column;
            }
        }

        /* Style the sidebar */
        .side-bar {
            /* background-color: #eee;
            padding: 10px;
            flex: 0 0 200px; */
            
            width: 240px;
            min-height: 90vh;
            max-height: auto;
            background: #1e1e1e;
            /* padding-top: 6vh; */
            display: block;
            position: fixed;
            margin-top: 10vh;

        }
        .side-bar form {
            display: flex;
            flex-direction: column;
            /* height: 400px;
            overflow-y: scroll; */
        }

        .radio, .form-group{
            margin-left: 20px;
        }
        .form-group .form-control{
            border-radius: 5px;
            padding: 5px;
            /* border: none; */
            width: 150px;
        }
        .input-error {
            border: 2px solid red;
        }

        input[type="radio"],
        input[type="text"] {
            margin: 5px 0 5px 20px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="radio"]:checked {
            background-color: #333;
            color: #fff;
        }

        input[type="text"]:focus {
            outline: none;
            border: 2px solid #333;
        }

        body > div > div.side-bar > form > button {
            margin: 15px 35px 0 35px;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            background-color: white;
            color: black;
            font-weight: 700;
            cursor: pointer;
            height: 5vh;
        }

        body > div > div.side-bar > form > button:hover {
            background-color: red;
        }

        .side-bar h3 {
            margin-top: 0;
            color: red;
            padding: 10px;
          }
        .side-bar h4 {
            margin-top: 0;
            color: white;
            padding: 10px;
        }
        
        .side-bar label {
            color: white;
        }

        @media (max-width: 860px){
            .side-bar {
                height: auto;
                width: 70px;
                left: 0;
                margin: 10vh 0;
            }
        } 

        /* Style the details container */
        .shop-container-details {
            display: flex;
            flex-direction: column;
            flex: 1;
            margin-left: 40px;
            /* margin-top: 6%; */
        }

        .ad-search-shop {
            /* background-color: #fff; */
            padding: 5px;
            text-align: center;
            display: flex;
            flex-direction: column;
            margin: 1% 3% 0% 3%;
            width: 80%;
        }

        .ad-search-shop img {
            max-width: 100%;
        }

        .ad-search-shop form {
            display: flex;
            flex-direction: column;
            /* margin-top: 10px; */
        }
        .search-component{
            margin: 0 1% 1% 0%;
            align-self: flex-start;
            width: 100%;
        }

        .filter-component{
            margin: 0 1% 1% -6%;
            align-self: flex-start;
            width: 90%;
            display: none;
        }

        .ad-search-shop input[type="text"] {
            padding: 5px;
            margin: 0 0 1% -28%;
            border: none;
            border-radius: 3px;
            width: 65%;
            height: 6vh;
            font-size: 3vh;
        }
        #price{
            margin: 0 0 5px -5px;
            width: 12%;
            height: 5vh;
        }

        .ad-search-shop button[type="submit"] {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            background-color: white;
            color: black;
            font-weight: 500;
            cursor: pointer;
            height: 6vh;
            font-size: 3vh;
        }

        .ad-search-shop button {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            background-color: white;
            color: black;
            font-weight: 700;
            cursor: pointer;
            height: 6vh;
        }

        .ad-search-shop button[type="submit"]:hover {
            background-color: blue;
        }

        .select-category, .select-type {
            width: 13%;
            height: 5vh;
            border: 1px solid #999;
            font-size: 18px;
            color: #000;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 2px 2px #ccc;
            margin: 0% 0% 0% 0%;
            cursor: pointer;
        }

        .ad-search-shop label{
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            background-color: white;
            color: black;
            height: 5vh;
            margin-right: 0%;
        }

        .container-data {
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
            .container-data {
                flex-direction: column;
                align-items: stretch;
            }
        }

        .container-ad {
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
            .container-ad {
                margin: 10px 0;
            }
        }

        .container-img {
            height: 200px;
            overflow: hidden;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 1rem 1rem 0 0;
        }

        .container-img a{
            width: 100%;
            height: 100%;
            display: contents;
        }

        .container-img img {
            /* width: 100%;
            height: 100%;
            object-fit:cover - 
            The image will be clipped to fit given dimension*/
            object-fit: contain;  
            max-width: -webkit-fill-available;
            height: inherit;
            max-height: -webkit-fill-available;

        }

        .container-ad .title {
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
        .container-ad .title a {
            text-decoration: none;
            color: black;
        }
        
        .container-ad .title h3 {
            margin: 0;
            font-size: 16px;
            overflow: hidden;
        }
        
        .container-ad .price {
            height: 30px;
            padding: 5px 10px;
            overflow: hidden;
            background-color: #E5E9F7;
            text-align: end;
        }

        .container-ad .price h6 {
            margin: 0;
            font-size: 16px;
            overflow: hidden;
        }

        .container-ad .price button[type="submit"] {
            padding: 4px 10px;
            border: none;
            border-radius: 8px;
            background-color: #3423c8;
            color: #fff;
            cursor: pointer;
            font-size: 10px;
        }

        .container-ad .price button[type="submit"]:hover {
            background-color: #666;
        }

        .container-ad .price label{
            padding: 5px 10px;
            border: none;                               
            border-radius: 3px;
            /* background-color: white; */
            color: black;
            /* cursor: pointer; */
            margin-right: 0%;
            font-size: 10px;
            font-weight: 600;
        }

    </style> 
</head>
<body>
    <?php require_once APPROOT . '/views/users/navbar.php';?>
    <!-- filtering side-bar -->
    <div class="side-bar" style="width:240px">
        <h3>Filter Products</h3>
        <form id="shop-filter-form" method="post">
            <h4>Category</h4>
            <div class="radio">
                <input type="checkbox" name="category[]" id="microphone" value="microphone" <?php echo ($data['category'] == "microphone") ? 'checked' : '' ?> >
                <label for="microphone">Microphone</label>
            </div>
            <div class="radio">
                <input type="checkbox" name="category[]" id="speakers" value="speaker" <?php echo ($data['category'] == "speaker") ? 'checked' : '' ?> >
                <label for="speakers">Speaker</label>
            </div>
            <div class="radio">
                <input type="checkbox" name="category[]" id="amplifiers" value="amplifier" <?php echo ($data['category'] == "amplifier") ? 'checked' : '' ?>  >
                <label for="amplifiers">Amplifier</label>
            </div>
            <div class="radio">
                <input type="checkbox" name="category[]" id="dj" value="mixer" <?php echo ($data['category'] == "mixer") ? 'checked' : '' ?> >
                <label for="mixer">Mixer</label>
            </div>
            <div class="radio">
                <input type="checkbox" name="category[]" id="guitar" value="guitar" <?php echo ($data['category'] == "guitar") ? 'checked' : '' ?> >
                <label for="guitar">Guitar</label>
            </div>
            <div class="radio">
                <input type="checkbox" name="category[]" id="keyboard" value="keyboard" <?php echo ($data['category'] == "keyboard") ? 'checked' : '' ?> >
                <label for="keyboard">Keyboard</label>
            </div>
            <div class="radio">
                <input type="checkbox" name="category[]" id="percussion/drums" value="percussion/drums" <?php echo ($data['category'] == "percussion/drums") ? 'checked' : '' ?> >
                <label for="percussion/drums">Percussion/Drums</label>
            </div>

            <h4>Price</h4>
            <div class="form-group">
                <label for="min-price">Min Price</label>
                <input type="number" class="form-control" id="min-price" name="price-min" min="0" placeholder="Enter min price" value = "<?php echo ($data['price-min']) ?>" >
            </div>
            <div class="form-group">
                <label for="max-price">Max Price</label>
                <input type="number" class="form-control" id="max-price" name="price-max" min="0" placeholder="Enter max price" value = "<?php echo ($data['price-max']) ?>">
            </div>

            <h4>Type</h4>
            <div class="radio">
                <input type="radio" id="all-type" name="type" value="" <?php echo ($data['type'] == "1") ? 'checked' : ''; ?> >
                <label for="all-type">All</label>
            </div>
            <div class="radio">
                <input type="radio" id="fixed-price" name="type" value="fixed_price" <?php echo ($data['type'] == "fixed_price") ? 'checked' : ''; ?>>
                <label for="fixed-price">Fixed Price</label>
            </div>
            <div class="radio">
                <input type="radio" id="auction" name="type" value="auction" <?php echo ($data['type'] == "auction") ? 'checked' : ''; ?>>
                <label for="auction">Auction</label>
            </div>

            <h4>Condition</h4>
            <div class="radio">
                <input type="radio" id="all-condition" name="condition" value="" <?php echo ($data['condition'] == "1") ? 'checked' : ''; ?> >
                <label for="all-type">All</label>
            </div>
            <div class="radio">
                <input type="radio" id="used" name="condition" value="Used" <?php echo ($data['condition'] == "Used") ? 'checked' : ''; ?>>
                <label for="used">Used</label>
            </div>
            <div class="radio">
                <input type="radio" id="new" name="condition" value="New" <?php echo ($data['condition'] == "New") ? 'checked' : ''; ?>>
                <label for="new">New</label>
            </div>

            <!-- <button type="submit" class="btn-primary">Filter</button> -->
        </form>
    </div>
    <div class="shop-container" >


        <div class="shop-container-details">


            <div class="ad-search-shop">
                <!-- this div contains search form in shop page -->
                <form method="post" class="shop-search-form" id="shop-search-form">
                    <div class="search-component">
                        <input type="text" name="search-item" id="shop-search-item-term" placeholder="Microphone" value="<?php echo ($data['isEmptySearchTerm'] == '0') ? $data['searchTerm'] : '';  ?>" >
                        <button type="submit" > SEARCH </button>
                        <!-- <button  id="advance-search" > Filter </button> -->
                    </div>
                </form>
            </div>
            
            <div id="shop-search-results">
                <!-- this div shows search results for keyup events live -->

            </div>

            <?php echo flash('auction_error');?>

            <div id="search-result-area">
                <!-- this div showa search results comes from index page -->
                <?php if( $data['isEmptySearchResults'] == '0' ){ ?>
                    <div class="header">
                        <h1>Search Results</h1>
    
                    </div>
                    <?php foreach($data['searchResults'] as $result) : ?>
                        <div class="result-container">
                            <div class="result-container-img">
                                <img src="<?php echo URLROOT.'/public/uploads/'.$result->image1;?>" /> 
                            </div>
                            <div class="result-title">
                                <a href="<?php if($result->product_type == 'auction'){
                                        echo URLROOT . '/users/auction/'.$result->product_id;
                                    }else{
                                        echo URLROOT . '/users/advertiesmentDetails/'.$result->product_id;
                                    }
                                ?>">
                                <div class="top-part">
                                    <?php echo '<h3>'.$result->product_title.'</h3>' ; ?>
                                    <?php echo '<h4>'.$result->product_condition.'</h4>' ; ?>
                                    <?php echo '<h5>'.$result->p_description.'</h5>' ; ?>
                                </div>
                                <div class="bottom-part">
                                    <?php echo '<h6><label>LKR:'. $result->price .'</label></h6> ' ;?>

                                    <?php if($result->product_type == 'auction'){
                                            echo '<h6><label> Auction </label></h6>';
                                        }
                                    ?>    
                                    <?php echo '<button type = "submit">View Product</button>' ;?>
                                </div>
                            </a>        
                            </div>
                        </div>
                    <?php endforeach; ?>
    
                <?php }; ?>
            </div>

            <div id="shop-page-search-result-area">
                <!-- this div shows search results by searching in shop page -->
            </div>

            <!-- <?php echo '<pre>'; print_r($data); echo '</pre>';?> -->
    
            <div class="container-data" id="shop-container-data">
                <!-- <?php echo $data['type']?>;
                <?php echo $data['category']?>; -->
                <?php $i=0;
                foreach($data['ads'] as $ads) :?>
    
                    <div class="container-ad">

                        <div class="container-img">
                            <a href="<?php  if($ads->product_type == 'auction'){
                                                echo URLROOT . '/users/auction/'.$ads->product_id;
                                            }else{
                                                echo URLROOT . '/users/advertiesmentDetails/'.$ads->product_id;
                                            }
                                     ?>">
                                        <img src="<?php echo URLROOT.'/public/uploads/'.$ads->image1;?>" /> 
                            </a>
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
                                    <button type="submit">View </button>
                            </a>  
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>


        </div>

    </div>
</body>
<script>
// const advanceSearchBtn = document.getElementById('advance-search');
// const content = document.getElementById('filter-content');

// advanceSearchBtn.addEventListener('click', () => {
//   if (content.style.display === 'none') {
//     content.style.display = 'block';
//   } else {
//     content.style.display = 'none';
//   }
// });


jQuery(document).ready(function(){
    $.getScript('<?php echo URLROOT . '/public/js/form.js';?>');
    // $.getScript('<?php echo URLROOT . '/public/js/search.js';?>');
    // $.getScript('<?php echo URLROOT . '/public/js/shop-search.js';?>">');
});
</script>


<script src="<?php echo URLROOT . '/public/js/shop-search.js';?>"></script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
<script src="<?php echo URLROOT . '/public/js/shopFilter.js';?>"></script>
</html>