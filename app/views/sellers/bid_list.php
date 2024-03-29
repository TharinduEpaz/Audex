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

    <!-- rate and review Modal is for specific styles for rata and review styles for modal -->
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/rateAndReviewModal.css';?>">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    
    <script type="text/javascript" src="<?php echo URLROOT . '/public/js/moment.min.js';?>"></script>
    <script type="text/javascript" src="<?php echo URLROOT . '/public/js/moment-timezone-with-data.js';?>"></script>
    <title>Advertisement</title>

    <style>
/* styles for modal */
    .modal-content {
        background-color: #fefefe;
        padding: 20px;
        border: 1px solid #888;
        width: 25%

    }

    .review-area-select-star {
        display: flex;
        flex-direction: row;
        height: 6vh;
    }

    .review-form form {
        display: flex;
        flex-direction: column;
    }
    .close {
        /* color: #aaa; */
        /* float: right; */
        font-size: 28px;
        font-weight: bold;
        background: gray;
        color: white;
        text-align: center;
        height: 30px;
        border-radius:0 ;
    }

    .review-form label, .review-area-select-star label {
        /* margin: 2%; */
        font-size: 15px;
        font-weight: 500;
    }
    .star-rating {
        display: inline-block;
        /* height: 3vh; */
        margin: 2%;
        padding: 1%;
    }
    .feedback-area form textarea {
        margin: 2%;
        border: 1px solid;
        overflow: hidden;
        overflow-y: auto;
        border-radius: 0.25rem;
        padding: 3%;
        resize: none;
    }
    #submit-review-btn {
        text-align: center;
        /* padding: auto; */
        /* border-radius: 10px; */
        /* border: 1px solid #002EF9; */
        font-weight: 600;
        /* margin-top: 3vh; */
        float: right;
        width: 100%;
        height: 5vh;
        /* font-size: 16px; */
        /* padding: 1% 2% 1% 2%; */
        /* border-radius: 10px; */
        /* border: 1px solid #002EF9; */
        margin: 10px 0% 0% 0%;
    }
    .feedback-area form label {
        width: 30%;

    }
    #submitted-feedback{
        margin: 2%;
        border: 1px solid;
        overflow: hidden;
        overflow-y: auto;
        border-radius: 0.25rem;
        padding: 3%;
        resize: none;
    }


    </style>

</head>
<body>
<?php require_once APPROOT . '/views/sellers/navbar.php';?>

    <div class="container" style="background: none;">
    <?php echo flash('email_err');?>
    <?php echo flash('bid_have');?>
    
        <div class="content">
            <div class="image_likes">
            <!-- Image section -->
            <div class="image">
                    <div class="grid">
                    <div id="img1" class="img1" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['ad']->image1;?>)">
                            <div>
                                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                            </div>
                            <div>
                                <a class="next" onclick="plusSlides(1)">&#10095;</a>
                            </div>

                        </div>
                        <div class="img2" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['ad']->image1;?>)">    
                            <a style="width: 100%;height:100%; " onclick="change_img(1); return false;" ></a>
                        </div>
                        <div class="img3" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['ad']->image2;?>)"> 
                            <?php if($data['ad']->image2!=null){?>  
                                <a style="width: 100%;height:100%; " onclick="change_img(2); return false;"></a> 
                            <?php }?>
                        </div>
                        <div class="img4" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['ad']->image3;?>)">   
                            <?php if($data['ad']->image3!=null){?>  
                                <a style="width: 100%;height:100%; " onclick="change_img(3); return false;"></a>
                            <?php }?>
                        </div>
                        <div class="img5" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['ad']->image4;?>)">   
                            <?php if($data['ad']->image4!=null){?>  
                                <a style="width: 100%;height:100%; " onclick="change_img(4); return false;"></a>
                            <?php }?>
                        </div>
                        <div class="img6" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['ad']->image5;?>)">   
                            <?php if($data['ad']->image5!=null){?>  
                                <a style="width: 100%;height:100%; " onclick="change_img(5); return false;"></a>
                            <?php }?>
                        </div>
                        <div class="img7" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['ad']->image6;?>)">   
                            <?php if($data['ad']->image6!=null){?>  
                                <a style="width: 100%;height:100%; " onclick="change_img(6); return false;"></a>
                            <?php }?>
                        </div>
                    </div>
                </div>
        </div>
        <!-- Auction details section -->
            <div class="auction_details">
                <h2><?php echo $data['ad']->product_title?></h2>
                <!-- Remaining time showing section -->
                <div class="time">
                    <p>Time Left:&nbsp;</p>
                    <p id='remaining_time'></p>
                </div>

                <!-- <?php echo '<pre>'; print_r($data); echo '</pre>';?> -->
                <table>
                    <tr>
                        <th>Place</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Buyer Profile</th>
                    </tr>
                    <?php 
                        if(!empty($data['auctions'])){
                            $i=0;
                            $j=0;
                            foreach($data['auctions'] as $auction): // $data['auctions'] contain all the max bids placed by the users grouped by email and auction details
                                $i++;
                        
                                echo '<tr>';
                                echo '<td>'.$i.'</td>';
                                echo '<td>'.$data['user'][$i-1]->first_name[0].$data['user'][$i-1]->first_name[1].'****</td>';//$data['user'] contains the user details of the user who placed the bid
                                echo '<td>LKR '.$auction->max_price.'</td>'; //Max price placed by the bidder(grouped by email)
                                // Profile link
                                echo '<td class=\'profile_link\'><a  href=\'' .URLROOT.'/users/getProfile/'.$data['user'][$i-1]->user_id.'\'>Profile</a></td>';

                                // Approve bid section
                                if($auction->is_active==0){// If auction is expired
                                    // If number of bid rows is greater than 3, then only show the approve button for the first 3 bids
                                    if(($i<4 && $data['auctions_no_rows']>3) || 
                                        // If number of bid rows is 3, then only show the approve button for the first 2 bids
                                        ($i<3 && $data['auctions_no_rows']==3) || 
                                        // If number of bid rows is less than 3, then only show the approve button for the first 1 bids                               
                                        ($i<2 && $data['auctions_no_rows']<=2)){
                                        if($data['bid_list'][$i-1]!=NULL){ //This means the bid is accepted or rejected or email sent
                                            if($data['bid_list'][$i-1]->is_accepted==0 && $data['bid_list'][$i-1]->is_rejected==0){ //Email sent
                                                echo '<td id=\'approve_link\' class=\'aprove\'><a style=\'pointer-events: none\' href=\'' .URLROOT.'/sellers/aprove_bid/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Email Sent</a></td>';
                                            }else if($data['bid_list'][$i-1]->is_accepted==1){ //Bid accepted
                                                echo '<td id=\'approve_link\' class=\'aprove\'><a style=\'pointer-events: none ; color:green\' href=\'' .URLROOT.'/sellers/aprove_bid/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Approved</a></td>';
                                                if($data['bid_list'][$i-1]->feedback_given==0){ //Feedback not given
                                                    echo '<td id=\'feedback\' class=\'feedback\'><a href="#" onclick="openModal(\''.$data['bid_list'][$i-1]->email_buyer.'\');" >Feedback</a></td> '?>

                                                    <div id="myModal" class="modal">
                                                        <div class="modal-content">
                                                            <span class="close" onclick="closeModal()" style="float: right; z-index: 1; position: inherit; visibility: visible; opacity:100%;">&times;</span>
                                                            
                                                            <div class="review-seller">
                                                                <!-- start of review form -->
                                                                <div class="review-form">
                                                                    <div class="review-area-select-star">
                                                                        <label for="select">Rate:</label>
                                                                        <div class="star-rating">
                                                                            <i class="fa fa-star star" data-value="1"></i>
                                                                            <i class="fa fa-star star" data-value="2"></i>
                                                                            <i class="fa fa-star star" data-value="3"></i>
                                                                            <i class="fa fa-star star" data-value="4"></i>
                                                                            <i class="fa fa-star star" data-value="5"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="feedback-area">
                                                                        <form action="" method="post" id="review-write-form">
    
    
                                                                            <label for="review">Review:</label>
                                                                            <textarea  name="review" rows="4" id="submitted-feedback"  ></textarea>
                                                                            <?php echo flash('rating_message');?>
                                                                            <input type="submit" value="Submit" id="submit-review-btn">
    
                                                                        </form>
                                                                    </div>
    
                                                                </div>
                                                                <!-- end of review form -->
                                                            </div>
                                                        </div>
                                                    </div> 
                                                <?php } 

                                            }else if($data['bid_list'][$i-1]->is_rejected==1){ //Bid rejected
                                                echo '<td id=\'approve_link\' class=\'aprove\'><a style=\'pointer-events: none; color:red\' href=\'' .URLROOT.'/sellers/aprove_bid/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Rejected</a></td>';
                                                $j++;
                                                if($data['bid_list'][$i-1]->feedback_given==0){ //Feedback not given
                                                    echo '<td id=\'feedback\' class=\'feedback\'><a href="#" onclick="openModal(\''.$data['bid_list'][$i-1]->email_buyer.'\');" >Feedback</a></td>'
                                                    ?>
                                                    <div id="myModal" class="modal">
                                                        <div class="modal-content">
                                                            <span class="close" onclick="closeModal()" style="float: right; z-index: 1; position: inherit; visibility: visible; opacity:100%;">&times;</span>
                                                            
                                                            <div class="review-seller">
                                                                <!-- start of review form -->
                                                                <div class="review-form">
                                                                    <div class="review-area-select-star">
                                                                        <label for="select">Rate:</label>
                                                                        <div class="star-rating">
                                                                            <i class="fa fa-star star" data-value="1"></i>
                                                                            <i class="fa fa-star star" data-value="2"></i>
                                                                            <i class="fa fa-star star" data-value="3"></i>
                                                                            <i class="fa fa-star star" data-value="4"></i>
                                                                            <i class="fa fa-star star" data-value="5"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="feedback-area">
                                                                        <form action="" method="post" id="review-write-form">
                                
                                
                                                                            <label for="review">Review:</label>
                                                                            <textarea  name="review" rows="4" id="submitted-feedback"  ></textarea>
                                                                            <?php echo flash('rating_message');?>
                                                                            <input type="submit" value="Submit" id="submit-review-btn">
                                
                                                                        </form>
                                                                    </div>
                                
                                                                </div>
                                                                <!-- end of review form -->
                                                            </div>
                                                        </div>
                                                    </div>
                                               <?php }
                                            }

                                        }else if($data['check']==0){ //$data['check']=0 means, there's no any sent email or an accepted bid. There can be rejected bids
                                            //This is the only link that can be clicked(Approve link)
                                            echo '<td id=\'approve_link\' class=\'aprove\'><a href=\'' .URLROOT.'/sellers/aprove_bid/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$auction->max_price.'/'.$data['user'][$i-1]->first_name.'\'>Approve</a></td>';

                                        }else{
                                            //This is Approve link, but there are accepted or email sent bid
                                            echo '<td id=\'approve_link\' class=\'aprove\'><a style=\'pointer-events: none\' href=\'' .URLROOT.'/sellers/aprove_bid/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Approve</a></td>';
                                        }

                                    }
                                    
                                }
                                echo '</tr>';
                            endforeach;
                        }
                    ?>


                    

                </table>
            </div>
            <?php if($data['auction']->is_active==0 && $data['reposted']!=1 ){
                    if(($data['auctions_no_rows']=='') || ($j==3 && $data['auctions_no_rows']>3) || 
                    // If number of bid rows is 3, then only show the approve button for the first 2 bids
                    ($j==2 && $data['auctions_no_rows']==3) || 
                    // If number of bid rows is less than 3, then only show the approve button for the first 1 bids                               
                    ($j==1 && $data['auctions_no_rows']<=2)){?>
                        <div style="left:55%;top:15vh;position:absolute;" class="message_seller">
                            <a href="<?php echo URLROOT.'/sellers/repost/'.$data['ad']->product_id; ?>">REPOST</a>
                        </div>
            <?php   }
                 }?>
        </div>
        <div class="description" style="margin-top: -2vh;">
            <h3>Description</h3>
            <p><?php echo $data['ad']->p_description?></p>
        </div>
    </div>
</body>
<!-- Display the countdown timer in an element -->


<script>
   
//Image change
var img=1;
    var image1 = <?php echo json_encode($data['ad']->image1); ?>;
    var image2 = <?php echo json_encode($data['ad']->image2); ?>;
    var image3 = <?php echo json_encode($data['ad']->image3); ?>;
    var image4 = <?php echo json_encode($data['ad']->image4); ?>;
    var image5 = <?php echo json_encode($data['ad']->image5); ?>;
    var image6 = <?php echo json_encode($data['ad']->image6); ?>;

    //To check how many images are there
    var no_images=0;
    for(var cnt=1;cnt<=6;cnt++){
        if(window["image"+cnt]!=""){
            no_images++;
        }
    }
    function change_img(n){
        var image1
        var link= <?php echo json_encode(URLROOT.'/public/uploads/');?>+window['image'+n];
        document.getElementById("img1").style.backgroundImage = "url('"+link+"')";
        img=n;
    }
    function plusSlides(n){
        img=(img+n)%no_images;
        if(img<=0){
            img=no_images;
        }
            change_img(img);   
    }
                    
    // Update the count down every 1 second
    var x = setInterval(function() {
    
         // Get today's date and time
      var now = moment().tz("Asia/Colombo");
      var milliseconds = now.format('x');

      var end_date=  <?php echo strtotime($data['auction']->end_date);?>
      // Find the distance between now and the count down date
      var distance = end_date*1000 - milliseconds;
    
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
      // Display the result in the element with id="demo"
      document.getElementById("remaining_time").innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";
    
      // If the count down is finished, write some text
      if (distance < 0) {
          clearInterval(x);
          document.getElementById("remaining_time").innerHTML = "EXPIRED";
          if(<?php echo $data['auction']->is_finished;?>==0){
              window.location.href = "<?php echo URLROOT.'/users/bid_expired/'.$data['ad']->product_id.'/'.$data['auction']->auction_id?>";

         }
      }
    }, 1000);


    // rate functionality======================================================================================================================
    function openModal(email) {
        reviewWriteForm = document.getElementById("review-write-form");
        const stars = document.querySelectorAll('.star-rating .star');
        
        const email_seller = <?php echo json_encode($_SESSION['user_email']); ?>;
        const email_buyer=email;
        const product_id = <?php echo $data['ad']->product_id  ?>;
        var value = '';

        console.log(email_seller, email_buyer);
        
		var modal = document.getElementById("myModal");
		modal.style.display = "block";
            

        if(email_seller != ""){
            // user is logged in
       
            for (const star of stars) {
                star.addEventListener('click', function () {
                    value = parseFloat(this.getAttribute('data-value'));

                        for (const star of stars) {
                            star.classList.remove('selected');
                        }
                
                        for (let i = 0; i < value; i++) {
                            stars[i].classList.add('selected');
                        }
                        // document.getElementById('buyer-selected-rate').value = value;
                        // document.getElementById('current-seller-rate').value = data.results4;
                    
                });
            }
            reviewWriteForm.addEventListener("submit",(e)=>{
                // e.preventDefault();
                // const email_buyer = document.getAttribute('date-email').value;


                // e.preventDefault();
                //get the form data/sumitted data
                const feedback = document.getElementById('submitted-feedback').value;
                // console.log(feedback);
                // console.log(value);

                const url1 = '<?php echo URLROOT?>/sellers/rateBuyer/';

                // console.log(url1);

                fetch(url1, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ rating: value,
                                           review:feedback,
                                           email_seller:email_seller,
                                           email_buyer:email_buyer,
                                           product_id:product_id,
                                        }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data.message);
            
                    for (const star of stars) {
                     star.classList.remove('selected');
                    }
            
                    for (let i = 0; i < value; i++) {
                     stars[i].classList.add('selected');
                    }
                    // document.getElementById('buyer-selected-rate').value = value;
                    // document.getElementById('current-seller-rate').value = data.results4;
                })
                .catch(error => {
                    console.error(error);
                });
            });

        }
        else{
            //user is not logged in 
            <?php $_SESSION['url']=URL();?>
            window.location.href = '<?php echo URLROOT?>/users/login/';
        }

           
    }


    function closeModal() {
		var modal = document.getElementById("myModal");
		modal.style.display = "none";
	}
    // When the user clicks anywhere outside of the modal, close it
	var modal = document.getElementById("myModal");

    window.addEventListener("click", function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });
</script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>
<!-- Closing the connection