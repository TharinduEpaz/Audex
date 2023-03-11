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
                <div class="messages" id="msg">
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
                    <div class="current_messages" id="current-messages">
                        <?php if(!empty($data['current_chat'])){?>
                        <?php foreach($data['current_chat'] as $chat): ?>
                            <div class="typed" id="typed">
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
                    <div class="current_messages" id="current-messages">
                            <div class="typed">
                                    
                            </div>
                    <?php }?>
                    </div>
                    <div class="enter_message">
                        <form action="" id = "chat-form">
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

    // get user email(email sender)  using sessions and check user is logged or not
    const sender_email = <?php
                if (isLoggedIn()) {
                    echo "'".$_SESSION['user_email']."'";
                }
                else{
                    echo "0";
                }
            ?>;
    // get rate receiver's email form profile
    const receiver_email = <?php echo "'".$data['receiver_details']->email."'"; ?>;

    

    //keeping the sidebar button clicked at the page
    link = document.querySelector('#messages');
    link.style.background = "#E5E9F7";
    link.style.color = "red";
    link.style.fontWeight = "800";

    
    currentChat = document.getElementById("current-messages");
    typed = document.getElementById("typed");
    messages = document.getElementById("msg");


    const chatForm = document.getElementById('chat-form');
    // console.log(chatForm);

    chatForm.addEventListener('submit', (e)=>{
        e.preventDefault();

        const formData = new FormData(chatForm);
        formData.append("add",1);

        //get the form data/sumitted data
        const message = document.getElementById('message').value;
        console.log(message);

        // for (const pair of formData.entries()) {
        //     console.log(`${pair[0]}, ${pair[1]}`);
        // }

        const url1 = '<?php echo URLROOT?>/users/chat/<?php echo $data['receiver_details']->user_id;?>';
        fetch(url1, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ message: message,
                                    sender_email:sender_email,
                                    receiver_email:receiver_email,
                                }),
        })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
            if(data.message == 'Message Sent'){
                document.getElementById('message').value = '';
                // window.location.href = '<?php echo URLROOT?>/chat/'+receiver_email;
            }
            
        })
        .catch(error => {
            console.error(error);
        });
        
    });
    
    
    
    
    function reloadPage() {
        urlNew = '<?php echo URLROOT?>/users/chatMessages/<?php echo $data['receiver_details']->user_id;?>';
        fetch(urlNew,{
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({  sender_email:sender_email,
                                    receiver_email:receiver_email,
                                }),
        })
        .then(response => response.json())
        .then(data => {
            var html = "";
            var html1="";
            // document.documentElement.innerHTML = html;
            // console.log(<?php echo $data['receiver_details']->user_id;?>);
            // console.log(data.message);
            for(var i=0;i< data.message['email_receivers'].length;i++){
                var result = data.message['email_receivers'][i];
                // console.log(result);
                html1+="<div class='message'><a href='<?php echo URLROOT.'/users/chat/';?>"+result.user_id+"'><div class='image' style='background-image: url(<?php echo URLROOT.'/uploads/'?>"+result.profile_pic+");'></div><h5>"+result.first_name+' '+result.second_name+"</h5></a></div>"

            }
            for (var i = 0; i < data.message['current_chat'].length; i++) {
                var result = data.message['current_chat'][i];
                console.log(result);
                if(result.sender_email == sender_email){
                    html+= "<div class ='typed'> <div class= 'type right blue'> <div class='msg'> "+ result.message + "<br> <p style='float: right;color:black;font-weight:600;font-size:8pt;' >"+ result.date+"</p> </div> </div> </div>"
                }
                else{
                    html+= "<div class ='typed'> <div class= 'type left white'> <div class='msg'> "+ result.message + "<br> <p style='float: right;color:black;font-weight:600;font-size:8pt;' >"+ result.date+"</p> </div> </div> </div>"
                    
                }
                
                // console.log(html);
                // console.log('sender: '+result.sender_email ,"\nReceiver: "+result.receiver_email, "\nMessage: "+result.message, "\nDate: "+result.date);
                
            }
            // data.forEach(function(result){
                //     console.log(result.product_title,result.price,result.product_category);
                // })
                // console.log(currentChat);
               console.log(html1);
                messages.innerHTML = html1;
                currentChat.innerHTML = html;
        });

    }
    setInterval(reloadPage, 500);
    
</script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
<script src="<?php echo URLROOT . '/public/js/product-watch-list.js';?>"></script>
</html>