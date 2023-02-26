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
            width: 730px;
            height: 100%;
            padding: 10px;
            border-radius: 0px 15px 15px 0px;
            overflow: hidden;
            
        }
        .result-container .result-title .top-part{
            height: 160px;
            margin-bottom: 10px;
            overflow: hidden;
        }
        
        .result-container .result-title .bottom-part{
            height: 80px;
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
        }
        .result-title label{
            border: none;
            border-radius: 3px;
            color: black;
            margin-right: 0%;
            background: #c85555;
            padding: 4px;
            margin: 1px 20px 1px -4px;
        }
        

        /* styles for live search results */


        #shop-search-results{
            display: block;
            margin-top: -48px;
        }
        #shop-search-results .table {
            width: 692px;
            border-collapse: collapse;
            margin-left: 3%;
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
            /* max-width: 1200px; */
            margin: 0 auto;
            display: flex;
            flex-direction: row;
            background-image: none;
            background-color: #E5E9F7;
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
            padding-top: 6vh;
            display: block;
            position: fixed;
            margin-top: 10vh;

        }
        .side-bar h2 {
            margin: 0px 0px 5px 15px;
            color: red;
          }
        .side-bar h3 {
            margin-top: 0;
            color: white;
            padding: 10px;
          }
          
          .side-bar ul {
            list-style: none;
            margin:0px 0px 0px 25px;
            padding: 0;
          }
          
          .side-bar ul li a {
            display: block;
            padding: 5px 10px;
            color: white;
            text-decoration: none;
          }
          
          .side-bar ul li a:hover {
            background-color: #ddd;
          }
          
        .side-bar a.current{
            background-color: white;
            color: red;
            font-weight: 800;
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
            margin-left: 240px;
            margin-top: 6%;
        }

        .ad-search-shop {
            /* background-color: #fff; */
            padding: 5px;
            text-align: center;
            display: flex;
            flex-direction: column;
            margin: 0% 3% 2% 3%;
        }

        .ad-search-shop img {
            max-width: 100%;
        }

        .ad-search-shop form {
            display: flex;
            flex-direction: column;
            margin-top: 10px;
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
            margin: 0 0 1% -23%;
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
            font-weight: 700;
            cursor: pointer;
            height: 6vh;
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
            justify-content: space-between;
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
        }

        .container-img img {
            /* width: 100%;
            height: 100%;
            object-fit:cover - 
            The image will be clipped to fit given dimension*/
            object-fit: cover;  
            max-width: -webkit-fill-available;
            height: inherit;
        }

        .container-ad .title {
            height: 60px;
            padding: 10px;
            overflow: hidden;
            background-color: #E5E9F7;
            border-radius: 0 0 0 0;
            /* text-align: center; */
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
            background-color: white;
            color: indianred;
            /* cursor: pointer; */
            margin-right: 0%;
            font-size: 10px;
            font-weight: 600;
        }

        </style> 
</head>
<body>
    <?php require_once APPROOT . '/views/users/navbar.php';?>

    <div class="shop-container" >

        <div class="side-bar">

            <h2>SORT BY</h2>
            <h3>Categories</h3>
                <ul>
                <li><a href="#" class="current">All</a></li>
                <li><a href="#">Microphones</a></li>
                <li><a href="#">Speakers</a></li>
                <li><a href="#">Mixers</a></li>
                <li><a href="#">Amplifiers</a></li>
                </ul>
        
            <h3>Price</h3>
                <ul>
                <li><a href="#">Min Price</a></li>
                <li><a href="#">Max Price</a></li>
                </ul>
        
            <h3>Type</h3>
                <ul>
                <li><a href="#">Fixed Price</a></li>
                <li><a href="#">Auction</a></li>
                </ul>
        </div>

        <div class="shop-container-details">


            <div class="ad-search-shop">
                <!-- this div contains search form in shop page -->
                <form method="post" class="shop-search-form" id="shop-search-form">
                    <div class="search-component">
                        <input type="text" name="search-item" id="shop-search-item-term" placeholder="Microphone" value="<?php echo ($data['isEmptySearchTerm'] == '0') ? $data['searchTerm'] : '';  ?>" >
                        <button type="submit" > SEARCH </button>
                        <button  id="advance-search" > Filter </button>
                    </div>
                    <div class="filter-component" id="filter-content" >
                        <label for="category">Category:</label>
                        <select name="category" id="category" class="select-category">
                            <option value="">All</option>
                            <option value="microphone">Microphone</option>
                            <option value="amplifier">Amplifier</option>
                            <option value="speaker">Speaker</option>
                            <option value="mixer">Mixer</option>
                        </select>

                        <label for="price">Price Min:</label>
                        <input type="text" id="price" name="price-min" placeholder="Price Min" >

                        <label for="price">Price Max:</label>
                        <input type="text" id="price" name="price-max" placeholder="Price Max" >

                        <label for="Product_type">Type:</label>
                        <select name="type" id="type" class="select-type">
                            <option value="">All</option>
                            <option value="fixed_price">Fixed Price</option>
                            <option value="auction">Auction</option>
                        </select>
                    </div>
                </form>
            </div>
            
            <div id="shop-search-results">
                <!-- this div shows search results for keyup events live -->
                <table class="table" id="search-results-table">
                </table>
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
                                <?php echo '<h3>'.$result->product_title.'</h3' ; ?>
                                <?php echo '<h4>'.$result->product_condition.'</h4' ; ?>
                                <?php echo '<h5>'.$result->p_description.'</h5' ; ?>
                                <?php echo '<label><h6>LKR:'. $result->price .'</h6></label> <button type = "submit">View Product</button>' ?>
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
    
            <div class="container-data">
                <?php $i=0;
                foreach($data['ads'] as $ads) :?>
    
                    <div class="container-ad">
                        <div class="container-img">
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
const advanceSearchBtn = document.getElementById('advance-search');
const content = document.getElementById('filter-content');

advanceSearchBtn.addEventListener('click', () => {
  if (content.style.display === 'none') {
    content.style.display = 'block';
  } else {
    content.style.display = 'none';
  }
});


jQuery(document).ready(function(){
    $.getScript('<?php echo URLROOT . '/public/js/form.js';?>');
    // $.getScript('<?php echo URLROOT . '/public/js/search.js';?>');
    // $.getScript('<?php echo URLROOT . '/public/js/shop-search.js';?>">');
});
</script>


<script src="<?php echo URLROOT . '/public/js/shop-search.js';?>"></script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>