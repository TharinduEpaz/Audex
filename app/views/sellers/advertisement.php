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
<?php require_once APPROOT . '/views/sellers/navbar.php';?>

    <div class="container" style="background: none;">
    
        <div class="content">
            <div class="image">
                <img src="<?php echo URLROOT.'/public/uploads/'.$data['advertisement']->image1;?>" alt="">
                <!-- <a href="">next</a> -->
            </div>
            <form action="<?php echo URLROOT;?>/sellers/delete_advertisement/<?php echo $data['advertisement']->product_id;?>" method="POST">
                <input type="submit" value="Delete">
            </form>
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