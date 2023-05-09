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
    /* margin-left: 40px; */
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
    flex-direction: column;
    
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
   
    background-color: #fff;
    border-radius: 10px;
    padding: 10px;
  }
  .wrapper-filter{
    display: flex;
    justify-content: center;
  }
  #search-service-provider{
    width: 50vw;
    border-radius: 10px;
  }
  #search-btn{
    display: inline;
    margin-left: 20px;
    background-color: #fff;
    border-radius: 10px;
    padding: 10px;


  font-weight: 400;
  font-size: 1rem;
  align-items: center;
  appearance: none;
  background-color: #776cea;
 
  background-size: calc(100% + 20px) calc(100% + 20px);
  border-radius: 20px;
  border-width: 0;
  box-shadow: none;
  box-sizing: border-box;
  color: #FFFFFF;
  cursor: pointer;
  display: inline-flex;
  

  height: auto;
  justify-content: center;
  line-height: 1.5;
  padding: 6px 40px;

  text-align: center;
  text-decoration: none;
  transition: background-color .2s,background-position .2s;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: top;
  white-space: nowrap;
  }

  /* search result table */
  #sound-engineer-search-results{
    display: block;
    margin-top: -25px;
    margin-left: 2.5%;
  }
  #sound-engineer-search-results .table{
    /* padding: 12px 15px; */
    border: 1px solid rgb(169 165 165);
    background: #ffffff;
    display: -webkit-box;
    text-align: left;
    font-size: 16px;
    width: 100%;
    border-collapse: collapse;
    margin-left: 13%;
    margin-top: 8%;
  }
  .search-result-row-content{
    background-color: white;
    display: flex;
    flex-direction: row;
    align-items: center;
    border: 1px solid rgb(169 165 165);
  }  

  .search-result-row-content img{
    width: 60px;
    height: 60px;
    margin: 5px;
  }


  
</style>

<body>
    <?php require_once APPROOT . '/views/users/navbar.php';?>

    <div class="wrapper-filter">
      <div id="filter-bar">
      
        <div class="search-sound-engineers">
          <!-- this div contains search form in shop page -->
          <form method="post" class="sound-engineers-search-form" id="sound-engineers-search-form">
              <div class="search-component">
                  <input type="text" name="search-term" id="search-service-provider" placeholder="Search">
                  <button type="submit" id="search-btn"> SEARCH </button>
                  <!-- <button  id="advance-search" > Filter </button> -->
              </div>
          </form>
        </div>

        <div id="sound-engineer-search-results">
          <!-- this div shows search results for keyup events live -->
        </div>

        <!-- <input type="text" name="search" value="" id="search" placeholder="Search"> -->
        
        <!-- <ul id="filter" class="filter-all">
          <li id="Sound Engineers">Sound Engineers</li>
          <li id="DJ Artists">DJ Artists</li>
          <li id="Technicians">Technicians</li>
          <li id="Other">Other</li>
        </ul> -->
      </div>
    </div>

    <div id="sound-engineers-page-search-result-area">
      <!-- this div shows search results by searching in sound engineers page -->
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

<script src="<?php echo URLROOT . '/public/js/serviceProviderSearch.js';?>"></script>

</html>