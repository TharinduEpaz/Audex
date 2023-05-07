<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/login.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/service_provider.css?id=0ff9u';?>">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title><?php echo SITENAME; ?></title>
</head>

<style>
    input {
    line-height: 2em;
    margin-left: 40px;
    border-radius: 3px;
    border: 1px solid #999;
    padding: 5px 10px;
  }
  


  .item-group {
    display: flex;
    flex-direction: row;
    align-items: flex-end;
    margin: 10px 10px 30px 10px;
  }
  
  .item-group::after {
    content: attr(data-name);
    position: relative;
    position: relative;
    top: 20px;
    display: block;
    margin-left: -50%;
  }
  
  #collection {
    display: flex;
    flex-direction: row;
    align-items: flex-end;
    flex-wrap: wrap;
  }
  
  #filter-bar {
    position: fixed;
    background:fixed;
    margin-top: 10vh;
    
  
   
    display: flex;
    align-items: baseline;
    background-color: #E5E9F7;
    padding-top: 10px;
    padding-bottom: 10px;
    
  }
  
  #filter li {
    list-style: none;
    display: inline-block;
    cursor: default;
    padding: 5px 10px;
  }
  .sound-eng-profiles{
    padding-top: 5vh;
  }
  #search{
    width:30vw;
    border-radius: 10px;
  }
  #filter{
    
    border-radius: 10px;
    

  }

  #filter li{
    margin-left: 20px;
    background-color: #fff;
    border-radius: 10px;
    padding: 10px;
  }
  .wrapper-filter{
    display: flex;
    justify-content: center;
  }
  #search-btn{
    display: inline;
    margin-left: 20px;
    background-color: #fff;
    border-radius: 10px;
    padding: 10px;
  }
  
  
</style>

<body>
    <?php require_once APPROOT . '/views/users/navbar.php';?>

    <div class="wrapper-filter">
      <div id="filter-bar">
      
        <div class="ad-search-shop">
          <!-- this div contains search form in shop page -->
          <form method="post" class="shop-search-form" id="shop-search-form">
              <div class="search-component">
                  <input type="text" name="search" id="search" placeholder="Search">
                  <button type="submit" id="search-btn"> SEARCH </button>
                  <!-- <button  id="advance-search" > Filter </button> -->
              </div>
          </form>
        </div>

        <!-- <input type="text" name="search" value="" id="search" placeholder="Search"> -->
        
        <ul id="filter" class="filter-all">
          <li id="Sound Engineers">Sound Engineers</li>
          <li id="DJ Artists">DJ Artists</li>
          <li id="Technicians">Technicians</li>
          <li id="Other">Other</li>
        </ul>
      </div>
    </div>

    <!-- create 4 divs and display 4 profile pics in each div -->
    <div class="sound-eng">
        <?php  foreach ($data as $object): ?>
        <div class="sound-eng-profiles" >
            <div class="profile-image">
                <?php $id = $object->user_id; ?>
                <a href="<?php echo URLROOT .'/users/serviceProviderPublic/' . "?id=$id" ?>">
                <img src="<?php echo URLROOT .'/public/uploads/Profile/' . $object->profile_image ?>" alt="">
        </a>
            </div>

            <div class="profile-data">
                <?php echo "$object->first_name \n"; ?>
                <?php echo "$object->second_name <br>\n"; ?>
                <p id="profession"><?php echo "$object->profession <br>\n"; ?> </p>
            </div>            
                <div class="rating-stars">
                <span class="rate"><?php echo "$object->Rating";?></span> 

                <?php for($i=0; $i<floor($object->Rating); $i++): ?>
                <i class="fa fa-star"></i>
                <?php endfor; ?>

                <?php if(strpos((string)$object->Rating, '.')): ?>
                <i class="fa fa-star-half-o"></i>
                <?php endif; ?>   
                </div>                
        </div>
        <?php endforeach;?>
    </div>
</body>
<script>

   
  

</script>

</html>