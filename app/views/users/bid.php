<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/advertise.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/bid.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Advertisement</title>
</head>
<body>
<?php require_once APPROOT . '/views/users/navbar.php';?>

    <div class="container" style="background: none;">
    
        <div class="content">
            <div class="image">
                <img src="<?php echo URLROOT.'/public/uploads/'.$data['ad']->image1;?>" alt="">
                <!-- <a href="">next</a> -->
            </div>
            <div class="auction_details">
                <h2><?php echo $data['ad']->product_title?></h2>
                <!-- <h1><?php echo '*'.$data[0].'<br>*'.$data[1].'<br>';?></h1> -->

                <!-- <?php echo '<pre>'; print_r($data); echo '</pre>';?> -->
                <!-- <?php echo '<pre>'; print_r($data['auctions']); echo '</pre>';?> -->
                <!-- <?php echo $data['auctions'][0]->price;?> -->
                <table>
                    <tr>
                        <th>Place</th>
                        <th>Name</th>
                        <th>Amount</th>
                    </tr>
                    <?php 
                        if(!empty($data['auctions'])){
                            $i=0;
                            foreach($data['auctions'] as $auction):
                            $i++;
                        
                        echo '<tr>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$auction->name.'</td>';
                            echo '<td>Rs..'.$auction->price.'</td>';
                        echo '</tr>';
                        endforeach;
                        }
                    ?>
                </table>
                <div class="add_bid" >
                    <?php
                        if(!empty($data['price_err1']) || !empty($data['price_err2']) || !empty($data['price_err3']) || !empty($data['price_err4'])  ){
                            echo '<div class="error">';
                                if(!empty($data['price_err'])){
                                    echo '*'.$data['price_err'].'<br>';
                                }if(!empty($data['price_err1'])){
                                    echo '*'.$data['price_err1'].'<br>';
                                }if(!empty($data['price_err2'])){
                                    echo '*'.$data['price_err2'].'<br>';
                                }if(!empty($data['price_err3'])){
                                    echo '*'.$data['price_err3'].'<br>';
                                }if(!empty($data['price_err4'])){
                                    echo '*'.$data['price_err4'].'<br>';
                                }

                            echo '</div>';
                        }

                    ?>
                                    
                    <!-- <h1><?php echo $data['ad']->product_id.'/'.$auction->auction_id.'/'.$data['auctions'][0]->price.'/'.$data['ad']->price;?></h1> -->
                    
                    <form action="<?php echo URLROOT.'/users/bid/'.$data['ad']->product_id?>" class="bid" method="post">
                        
                    <!-- <label for="price">Price</label> -->
                    <input class="price" type="text" name="price"  placeholder="xxxx.xx"   >
                    <input type="submit" name="submit" value="Bid" class="bid_button">
                            
                    </form>
                        
                </div>
                <?php 
                    if(isLoggedIn()){
                        if($_SESSION['user_email']!=$data['ad']->email){
                            echo '<div class="message_bid">';
                                echo '<div class="message_seller">';
                                echo '<a href="'.URLROOT.'/users/message" class="btn">Message Seller</a>';
                                echo '</div>';
                            echo '</div>';
                        }
                    }
                ?>
            </div>
        </div>
        <div class="description">
            <h3>Description</h3>
            <p><?php echo $data['ad']->p_description?></p>
        </div>
    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>
<!-- Closing the connection