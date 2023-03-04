<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/advertise.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/advertiesmentDetails.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Advertisement</title>
</head>
<body>
<?php require_once APPROOT . '/views/users/navbar.php';?>

    <div class="container" style="background: none;">
    
    <!-- <?php echo '<pre>'; print_r($data); echo '</pre>';?>
    <?php echo $data['auction']->end_date;?> -->
    <?php echo flash('email_err');?>
        <div class="content">
        <div class="image" style="width: 40%;">
                    <div class="grid">
                        <div id="img1" class="img1" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['advertisement']->image1;?>)">
                        </div>
                        <div class="img2" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['advertisement']->image1;?>)">    
                            <a style="width: 100%;height:100%; " onclick="change_img1(); return false;" ></a>
                        </div>
                        <div class="img3" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['advertisement']->image2;?>)"> 
                            <?php if($data['advertisement']->image2!=null){?>  
                                <a style="width: 100%;height:100%; " onclick="change_img2(); return false;"></a> 
                            <?php }?>
                        </div>
                        <div class="img4" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['advertisement']->image3;?>)">   
                            <?php if($data['advertisement']->image3!=null){?>  
                                <a style="width: 100%;height:100%; " onclick="change_img3(); return false;"></a>
                            <?php }?>
                        </div>
                    </div>
            </div>
            <div class="details">
                <h2><?php echo $data['advertisement']->product_title?></h2>
                <table>
                    <tr>
                        <td class="name">Category</td>
                        <td class="value">: <?php echo $data['advertisement']->product_category?></td>
                    </tr>
                    <tr>
                        <td class="name">Model Number</td>
                        <td class="value">: <?php echo $data['advertisement']->model_no?></td>
                    </tr>
                    <tr>
                        <td class="name">Brand name</td>
                        <td class="value">: <?php echo $data['advertisement']->brand?></td>
                    </tr>
                    <tr>
                        <td class="name">Condition</td>
                        <td class="value">: <?php echo $data['advertisement']->product_condition?></td>
                    </tr>
                </table>
                <div class="price">
                    <h4>Rs. <?php echo $data['advertisement']->price?></h4>
                </div>
                <div class="buttons">
                    <?php if($data['advertisement']->product_type=='auction'){?>
                    <button type="button" class="accept_bid" onclick="location.href='<?php echo URLROOT;?>/users/accept_bid/<?php echo $data['advertisement']->email.'/'.$data['advertisement']->product_id.'/'.$data['bid']->bid_id.'/'.$data['bid']->price?>'">Accept Offer</button>
                    <?php }?>
                    <button type="button" class="reject_bid" onclick="location.href='<?php echo URLROOT;?>/users/reject_bid/<?php echo $data['advertisement']->email.'/'.$data['advertisement']->product_id.'/'.$data['bid']->bid_id.'/'.$data['bid']->price;?>'"> Reject Offer</button>    
                    

                </div>
            </div>
            <div class="seller-detais">
                    <h2 style="text-align: center;width:115%"><?php 
                                if( empty($data['seller']->shop_name )){
                                    echo 'Seller';
                                }
                                else{
                                    echo 'Shop';
                                }
                            ?> Details</h2>
                            
    
                                    
    
                    <a href="<?php echo URLROOT . '/users/getProfile/'.$data['SellerMoreDetails']->user_id;?>">
    
                                
                    <div class="top_details">
                            <div class="profile_img">
                                <img src="<?php echo URLROOT . '/public/uploads/'.$data['SellerMoreDetails']->profile_pic;?>" alt="Profile Picture">
                            </div>
                            <div class="other_details_profile">
                                <p class="full_name"><?php echo $data['SellerMoreDetails']->first_name.' '.$data['SellerMoreDetails']->second_name; ?></p>
                                <div class="stars_date">
                                    <div class="stars">
                                        <!-- <img src="<?php echo URLROOT . '/public/img/stars.png';;?>" alt="Profile Picture"> -->
                                        <div class="current-rate">
                                        <!-- <label for="current-rate" style="display:none">Rate:</label> -->
                                        <!-- <input type="text" name="current-rate" value="<?php echo $data['seller']->rate ?>" id="current-seller-rate"> -->
                                        <div class="rating-stars">
                                            <!-- <span class="rate"><?php echo $data['seller']->rate;?></span>  -->
    
                                            <?php $i=0;
                                            for($i; $i<floor($data['seller']->rate); $i++): ?>
                                            <i class="fa fa-star"></i>
                                            <?php endfor; ?>
                                            
                                            <?php if(strpos((string)$data['seller']->rate, '.')){?>
                                            <i class="fa fa-star-half-o"></i>
                                            
                                            <?php $i++;} 
                                            while($i<5){ ?>
                                            <i class="fa fa-star-o"></i>
                                            <?php $i++; } ?>
                                        </div>                
                                    </div>
                                    </div>
                                    
                                    <div class="date">
                                        <p>Joined : <?php echo date('Y-m-d',strtotime($data['SellerMoreDetails']->registered_date));; ?></p>
                                    </div>
                                </div>
                                <div class="likes_dislikes">
                                    <div class="flags">
                                    <i class="fa-sharp fa-solid fa-flag"> : 0 </i>
                                
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    <div class="review-seller">
                    <!-- add to watch button is not visible if user is a seller or service provider -->
                    <!-- watch list button should visible if user is not logged in -->
                        <?php if(!isLoggedIn()){?>
                            <div class="write-review">
                                <input type="submit" value="Write Review" id="review-seller-btn">
                            </div>
                        <?php } else if($_SESSION['user_type'] != 'seller' && $_SESSION['user_type'] != 'service_provider' ){ ?>
                                <div class="write-review">
                                    <input type="submit" value="Write Review" id="review-seller-btn">
                                </div>
                        <?php } ?>
    
                        <div class="review-form">
                            <div class="review-area-select-star">
                                <label for="select">Select:</label>
                                <div class="star-rating">
                                    <i class="fa fa-star star" data-value="1"></i>
                                    <i class="fa fa-star star" data-value="2"></i>
                                    <i class="fa fa-star star" data-value="3"></i>
                                    <i class="fa fa-star star" data-value="4"></i>
                                    <i class="fa fa-star star" data-value="5"></i>
                                </div>
                            </div>
                            <div class="selected-rate">
                                        <label for="given-rate">Rate:</label>
                                        <input type="text" value="<?php echo $data['loadRate'] ?>" id="buyer-selected-rate">
                                    </div>
                            <div class="feedback-area">
                                <form action="" method="post" id="review-write-form">
    
    
                                    <label for="feedback">Feedback:</label>
                                    <textarea  name="review" rows="4" id="submitted-feedback"  ><?php echo $data['loadFeedback'] ?></textarea>
                                    <!-- <?php flash('rating_message');?> -->
                                    <input type="submit" value="Submit" id="submit-review-btn">
    
                                </form>
                            </div>
    
                        </div>
                    </div>
                </div>
        </div>
        <div class="description">
            <h3>Description</h3>
            <p><?php echo $data['advertisement']->p_description?></p>
        </div>
    </div>
</body>

<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>
<!-- Closing the connection