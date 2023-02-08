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
                <?php $id = $object->user_id; ?>
                <a href="<?php echo URLROOT .'/users/serviceProviderPublic/' .  urlencode($id) ?>">
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
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>

</html>