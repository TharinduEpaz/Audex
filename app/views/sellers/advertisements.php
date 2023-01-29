<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/seller_advertisement.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Advertisements</title>
</head>
<body>
<?php require_once APPROOT . '/views/sellers/navbar.php';?>

    <div class="container">
    <div class="sidebar">
                <a href="#"><i class="fas fa-qrcode"></i> <span>Dashboard</span></a>
                <a href="<?php echo URLROOT.'/sellers/getProfile/'.$_SESSION['user_id']?>"> <i class="fa fa-cog" aria-hidden="true"></i><span>Profile Settings</span></a>
                <a class="current" href="<?php echo URLROOT;?>/sellers/advertisements"> <i class="fa fa-ad" aria-hidden="true"></i><span>Advertisements</span></a>
                <a href="<?php echo URLROOT;?>/sellers/advertise"><i class="fa-solid fa-dollar-sign" aria-hidden="true"></i><span>Advertise</span></a>
                <a href="#"> <i class="fa fa-comments"></i><span>Messages</span></a>       
        </div>
        <div class="poster_advertisements">
            <h1>Posted Advertisements</h1>
            <div class="header">
                <div class="image">
                    <img  class="two" src="" alt="photo">
                </div>
                <p class="one">Title</p>
                <p class="two">Format</p>
                <p class="three">Fee Paid</p>
                <p class="four">Price</p>
                <p class="five">Edit</p>
                <p class="six">Priview</p>

            </div>
            <?php foreach($data['advertisements'] as $advertisement): ?>
            <div class="advertisements">
                <div class="image">
                    <img src="<?php echo URLROOT.'/public/uploads/'.$advertisement->image1;?>" alt="photo">
                </div>
                <p class="one"><?php echo $advertisement->product_title;?></p>
                <p class="two"><?php echo $advertisement->product_type;?></p>
                <p class="three">
                    <?php if($advertisement->is_paid == 1): ?>
                        <a style="text-decoration:none;color:green;font-weight: 700;pointer-events: none" >Completed</a>
                    <?php else: ?>
                        <a style="text-decoration:none;color:red;font-weight: 700" href="<?php echo URLROOT;?>/sellers/complete_payment/<?php echo $advertisement->product_id;?>" >Incompleted</a>
                    <?php endif; ?>
                </p>
                <p class="four">Rs.<?php echo $advertisement->price;?></p>
                <?php if($advertisement->is_paid == 1){ ?>
                <a class="five" href="<?php echo URLROOT;?>/sellers/edit_advertisement/<?php echo $advertisement->product_id;?>">Edit</a>
                <?php }else{ ?>
                <a class="five" style="pointer-events: none" href="<?php echo URLROOT;?>/sellers/edit_advertisement/<?php echo $advertisement->product_id;?>">Edit</a>
                <?php } ?>   
                <a class="six" href="<?php echo URLROOT;?>/sellers/advertisement/<?php echo $advertisement->product_id;?>">Preview</a>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>