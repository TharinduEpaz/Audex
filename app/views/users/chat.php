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
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/chat.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo MAPS_API;?>&callback=initMap&libraries=placesMap&v=weekly"></script>
    <title>Advertisement</title>
</head>
<body>
<?php require_once APPROOT . '/views/'.$_SESSION['user_type'].'s/navbar.php';?>
<div class="container">
    
    <?php require_once APPROOT . '/views/'.$_SESSION['user_type'].'s/sidebar.php';?>
    <div class="message_container">
        <!-- <?php echo '<pre>'; print_r($data); echo '</pre>';?> -->
        <div class="chat">
            <div class="chats">
                <div class="messages">
                    <?php foreach($data['email_receivers'] as $receiver): ?>
                    <div class="message">
                        <a href="<?php echo URLROOT.'/users/chat/'.$receiver->user_id ?>">
                            <div class="image" style="background-image: url(<?php echo URLROOT.'/uploads/'.$receiver->profile_pic;?>);">
                            </div>
                            <h5><?php echo $receiver->first_name." ".$receiver->second_name;?></h5>

                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="current_chat">
                    <?php if($data['receiver']!=null){ ?>
                    <div class="message" style="margin-top: 0%;border-radius:0px;background-color:rgba(0, 19, 101, 0.11);height:10%;">
                            <div class="image" style="background-image: url(<?php echo URLROOT.'/uploads/'.$data['receiver_details']->profile_pic;?>);background-color:rgba(0, 19, 101, -0.89);">
                            </div>
                            <h5 style="font-size: 16pt;"><?php echo $data['receiver_details']->first_name." ".$data['receiver_details']->second_name;?></h5>
                    </div>
                    <div class="current_messages">
                        <?php if(!empty($data['current_chat'])){?>
                        <?php foreach($data['current_chat'] as $chat): ?>
                            <div class="typed">
                            <?php if($chat->sender_email==$_SESSION['user_email'] ){?>
                                    <div class="type right blue">
                                <?php }else{?>
                                    <div class="type left white">
                                <?php }?>
                                    <div class="msg">
                                        <?php echo $chat->message;?>
                                        <br><p style="float: right;color:black;font-weight:600;font-size:8pt;"><?php echo date('H:i', strtotime($chat->date));?></p>
                                    </div>
                                </div>
                            </div>
                    <?php endforeach; ?>
                    <?php }?>
                    <?php }else{?>
                        <div class="message" style="margin-top: 0%;border-radius:0px;background-color:rgba(0, 19, 101, 0.11);height:10%;">
                            <div class="image" style="background-image: url(<?php echo URLROOT.'/img/profile.png';?>);background-color:rgba(0, 19, 101, -0.89);">
                            </div>
                            <h5 style="font-size: 16pt;"></h5>
                    </div>
                    <div class="current_messages">
                            <div class="typed">
                                    
                            </div>
                    <?php }?>
                    </div>
                    <div class="enter_message">
                        <form action="">
                            <input type="text" name="message" id="message" placeholder="Enter your message">
                            <button type="submit" id="send_message"><i class="fas fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
<script>
    //keeping the sidebar button clicked at the page
    link = document.querySelector('#messages');
    link.style.background = "#E5E9F7";
    link.style.color = "red";
    link.style.fontWeight = "800";

    
</script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
<script src="<?php echo URLROOT . '/public/js/product-watch-list.js';?>"></script>
</html>