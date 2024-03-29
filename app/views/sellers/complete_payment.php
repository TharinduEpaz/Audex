<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sELL_ITEM.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Edit Advertisement</title>
</head>
<body>
<?php require_once APPROOT . '/views/sellers/navbar.php';?>

    <div class="container_add">
        <div class="sidebar">
                <a href="#"><i class="fas fa-qrcode"></i> <span>Dashboard</span></a>
                <a href="#"> <i class="fa fa-cog" aria-hidden="true"></i><span>Profile Settings</span></a>
                <a href="<?php echo URLROOT;?>/sellers/advertisements"> <i class="fa fa-ad" aria-hidden="true"></i><span>Advertisements</span></a>
                <a class="current" href="<?php echo URLROOT;?>/sellers/advertise"><i class="fa-solid fa-dollar-sign" aria-hidden="true"></i><span>Edit Item</span></a>
                <a href="#"> <i class="fa fa-comments"></i><span>Messages</span></a>       
        </div>
        <div class="container">
        <div class="advertisement">
            <div class="add">
                <div id="forms" class="form_seller">
                <?php
                if(!empty($data['title_err']) || !empty($data['description_err']) || !empty($data['price_err'])  || !empty($data['condition_err']) || !empty($data['image1_err']) || !empty($data['image2_err']) || !empty($data['image3_err']) || !empty($data['brand_err']) || !empty($data['model_err']) ){
                    echo '<div class="error">';
                        if(!empty($data['title_err'])){
                            echo '*'.$data['title_err'].'<br>';
                        }
                        if(!empty($data['description_err'])){
                            echo '*'.$data['description_err'].'<br>';
                        }
                        if(!empty($data['price_err'])){
                            echo '*'.$data['price_err'].'<br>';
                        }
                        if(!empty($data['condition_err'])){
                            echo '*'.$data['condition_err'].'<br>';
                        }
                        if(!empty($data['image1_err'])){
                            echo '*'.$data['image1_err'].'<br>';
                        }
                        if(!empty($data['image2_err'])){
                            echo '*'.$data['image2_err'].'<br>';
                        }
                        if(!empty($data['image3_err'])){
                            echo '*'.$data['image3_err'].'<br>';
                        }
                        if(!empty($data['brand_err'])){
                            echo '*'.$data['brand_err'].'<br>';
                        }
                        if(!empty($data['model_err'])){
                            echo '*'.$data['model_err'].'<br>';
                        }

                    echo '</div>';
                }

            ?>
                    <form action="<?php echo URLROOT . '/sellers/complete_payment/'.$data['id'];?>" method="post" enctype="multipart/form-data">
                        <div class="input">
                            <label for="">Title&nbsp</label>
                            <input class="title" type="text" name="title"  value="<?php echo $data['title']?>" >
                        </div>
                        <?php if($data['product_type']!='auction'){?>
                        <div class="input">
                            <label for="">Price</label>
                            <input class="price" type="text" name="price"  value="<?php echo $data['price']?>"  >
                        </div>
                        <?php }?>
                        <div class="input">
                            <label class="condition" for="">Condition</label>
                            <input class="condition" type="text" name="condition"   value="<?php echo $data['condition']?>" >
                        </div>
                        <div class="input">
                            <label class="category" for="category">Category&nbsp</label>
                            <select name="category" id="category">
                              <option value="microphone">Microphone</option>
                              <option value="dj">DJ</option>
                              <option value="mixer">Mixer</option>
                              <option value="amplifier">Amplifier</option>                         
                            </select>
                        </div>
                        <div class="input">
                            <label class="model" for="">Model No.</label>
                            <input class="model" type="text" name="model"   value="<?php echo $data['model']?>" >
                        </div>
                        <div class="input">
                            <label class="brand" for="">Brand Name</label>
                            <input class="brand" type="text" name="brand"   value="<?php echo $data['brand']?>" >
                        </div>
                        <div class="input">
                            <label class="descriptionl" for="">Description</label>
                            <textarea name="description" id="description" class="description" cols="30" rows="15"  value="" ><?php echo $data['description']?></textarea>
                            
                        </div>
                        <div class="submit">
                            <input type="submit" name="submit" value="Edit(Checkout)" class="post">
                            <a class="cancel" href="<?php echo URLROOT;?>/sellers/advertisements">Cancel</a>

                        </div>
                    </form>
                </div>
            </div>
        </div>

            
        </div>
    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>

