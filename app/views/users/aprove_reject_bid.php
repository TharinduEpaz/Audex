<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/advertise.css';?>">
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
        <div class="content">
            <div class="image">
                <img src="<?php echo URLROOT.'/public/uploads/'.$data['advertisement']->image1;?>" alt="">
                <!-- <a href="">next</a> -->
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