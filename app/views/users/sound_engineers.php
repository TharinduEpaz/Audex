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

<body>
    <?php require_once APPROOT . '/views/users/navbar.php';?>

    <!-- create 4 divs and display 4 profile pics in each div -->
    <div class="sound-eng">
        <?php  foreach ($data as $object): ?>
        <div class="sound-eng-profiles">
            <div class="profile-image">
                <img src="<?php echo URLROOT .'/public/uploads/Profile/' . $object->profile_image ?>" alt="">
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

                <i class="fa fa-star-half-o"></i>
                
           
                    
                   
                </div>
                
                

        </div>
        <?php endforeach;?>
    </div>
</body>
<script>
    //read the star rating from the database and make the stars
    //lidocught up according to the rating
    
    
    // document.addEventListener('DOMContentLoaded', function() {
    //     let stars = document.getElementsByClassName('fas fa-star');
    //     let rating = document.getElementsByClassName('rate');
    //     console.log(rating);
    //     for (let i = 0; i < rating.length; i++) {
    //         let rate = rating[i].innerHTML;
    //         console.log(rate);
    //         for (let j = 0; j < rate; j++) {
    //             stars[j].style.color = 'yellow';
    //         }
    //     }
    // });

   
  var spans = document.querySelectorAll(".rate");
 
  for (var i = 0; i < spans.length; i++) {

 
  }

    // console.log(rating);
    // let stars = document.getElementsByClassName('fas fa-star');
    // console.log(stars);
    // for (let i = 0; i < rating; i++) {
    //     stars[i].style.color = 'yellow';
    // }

</script>

</html>