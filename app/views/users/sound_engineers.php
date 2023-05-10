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

  /* styles for sidebar */
  /* Style the sidebar */
  .side-bar {
    /* background-color: #eee;
    padding: 10px;
    flex: 0 0 200px; */
    
    width: 240px;
    min-height: 90vh;
    max-height: auto;
    background: #E5E9F7;
    padding-top: 6vh;
    display: block;
    position: fixed;
    margin-top: 10vh;

    left: 0;
    top: 0;
  }
  .side-bar form {
      display: flex;
      flex-direction: column;
  }

  .radio, .form-group{
    margin-left: 20px;
  }
  .form-group .form-control{
    border-radius: 5px;
    padding: 5px;
    border: none;
    width: 150px;
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

  .checked {
    color: orange;
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
    color: black;
    padding: 10px;
  }
  
  .side-bar label {
    color: black;
  }

  @media (max-width: 860px){
    .side-bar {
      height: auto;
      width: 70px;
      left: 0;
      margin: 10vh 0;
    }
  }
  select{
    width: 70%;
    height: 40px;
    padding: 10px;
    font-size: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background: url(http://localhost/Audex/public/img/arrow-down.png) no-repeat right #fff;
    background-size: 30px;
    margin: 2%;
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

      <!-- filtering side-bar -->
      <div class="side-bar" style="width:240px">
        <h3>Filter Service Providers</h3>
        <form id="service-provider-filter-form" method="post">

          <h4>Profession</h4>
            <div class="radio">
              <input type="radio" id="all-type" name="profession" value="" <?php echo ($data['profession'] == "1") ? 'checked' : ''; ?> >
              <label for="all-type">All</label>
            </div>
            <div class="radio">
              <input type="radio" id="Sound engineer" name="profession" value="Sound engineer" <?php echo ($data['profession'] == "Sound engineer") ? 'checked' : ''; ?>>
              <label for="fixed-price">Sound Engineer</label>
            </div>
            <div class="radio">
              <input type="radio" id="DJ Artist" name="profession" value="DJ Artist" <?php echo ($data['profession'] == "DJ Artist") ? 'checked' : ''; ?> >
              <label for="auction">DJ Artist</label>
            </div>
          
            <h4>Rate</h4>
              <div class="radio">
                <input type="radio" id="any-star" name="rate" value="" <?php echo ($data['rate'] == "") ? 'checked' : ''; ?>>
                <label for="all-type">Any</label>
              </div>
              <div class="radio">
                <input type="radio" id="one-star" name="rate" value="1" <?php echo ($data['rate'] == "1") ? 'checked' : ''; ?>>
                <label for="all-type"><i class="fa-sharp fa-solid fa-star checked"></i><i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i></label>
              </div>
              <div class="radio">
                <input type="radio" id="two-star" name="rate" value="2" <?php echo ($data['rate'] == "2") ? 'checked' : ''; ?>>
                <label for="all-type"><i class="fa-sharp fa-solid fa-star checked"></i><i class="fa-sharp fa-solid fa-star checked"></i><i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i></label>
              </div>
              <div class="radio">
                <input type="radio" id="three-star" name="rate" value="3" <?php echo ($data['rate'] == "3") ? 'checked' : ''; ?>>
                <label for="all-type"><i class="fa-sharp fa-solid fa-star checked"></i><i class="fa-sharp fa-solid fa-star checked"></i><i class="fa-sharp fa-solid fa-star checked"></i><i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i></label>
              </div>
              <div class="radio">
                <input type="radio" id="four-star" name="rate" value="4" <?php echo ($data['rate'] == "4") ? 'checked' : ''; ?>>
                <label for="all-type"><i class="fa-sharp fa-solid fa-star checked"></i><i class="fa-sharp fa-solid fa-star checked"></i><i class="fa-sharp fa-solid fa-star checked"></i><i class="fa-sharp fa-solid fa-star checked"></i><i class="fa-sharp fa-solid fa-star"></i></label>
              </div>
              <div class="radio">
                <input type="radio" id="five-star" name="rate" value="5" <?php echo ($data['rate'] == "5") ? 'checked' : ''; ?>>
                <label for="all-type"><i class="fa-sharp fa-solid fa-star checked"></i><i class="fa-sharp fa-solid fa-star checked"></i><i class="fa-sharp fa-solid fa-star checked"></i><i class="fa-sharp fa-solid fa-star checked"></i><i class="fa-sharp fa-solid fa-star checked"></i></label>
              </div>

            <h4>District</h4>
            <div class="radio">
                <select name="district" id="district">
                  <option value="">Select District</option>
                  <option value="Ampara">Ampara</option>
                  <option value="Anuradhapura">Anuradhapura</option>
                  <option value="Badulla">Badulla</option>
                  <option value="Batticaloa">Batticaloa</option>
                  <option value="Colombo">Colombo</option>
                  <option value="Galle">Galle</option>
                  <option value="Gampaha">Gampaha</option>
                  <option value="Hambantota">Hambantota</option>
                  <option value="Jaffna">Jaffna</option>
                  <option value="Kalutara">Kalutara</option>
                  <option value="Kandy">Kandy</option>
                  <option value="Kegalle">Kegalle</option>
                  <option value="Kilinochchi">Kilinochchi</option>
                  <option value="Kurunegala">Kurunegala</option>
                  <option value="Mannar">Mannar</option>
                  <option value="Matale">Matale</option>
                  <option value="Matara">Matara</option>
                  <option value="Monaragala">Monaragala</option>
                  <option value="Mullaitivu">Mullaitivu</option>
                  <option value="Nuwara Eliya">Nuwara Eliya</option>
                  <option value="Polonnaruwa">Polonnaruwa</option>
                  <option value="Puttalam">Puttalam</option>
                  <option value="Ratnapura">Ratnapura</option>
                  <option value="Trincomalee">Trincomalee</option>
                  <option value="Vavuniya">Vavuniya</option>
                </select>
              <!-- <select id="cities" name="city">
                <option value="">Select City</option> -->
            </div>

        </form>
      </div>

      <?php  foreach ($data['details'] as $object): ?>
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
<script src="<?php echo URLROOT . '/public/js/serviceProviderFilter.js';?>"></script>
<!-- <script>
  // List of cities in Sri Lanka
  const cities = ["Ampara", "Anuradhapura","Badulla","Batticaloa","Colombo","Galle","Gampaha","Hambantota","Jaffna","Kalutara","Kandy","Kegalle","Kilinochchi","Kurunegala","Mannar",
      "Matale","Matara","Monaragala","Mullaitivu","Nuwara Eliya","Polonnaruwa","Puttalam","Ratnapura","Trincomalee","Vavuniya"

    ];

    // Get a reference to the dropdown element
    const dropdown = document.getElementById("cities");

    // Loop through the list of cities and create an option for each one
    for (let i = 0; i < cities.length; i++) {
      const city = cities[i];
      const option = document.createElement("option");
      option.text = city;
      option.value = city;
      dropdown.add(option);
    }
</script> -->

</html>