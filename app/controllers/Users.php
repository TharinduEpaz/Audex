<?php
        use \PHPMailer\PHPMailer\PHPMailer;
        use \PHPMailer\PHPMailer\Exception;

        require dirname(APPROOT).'/app/phpmailer/src/Exception.php';
        require dirname(APPROOT).'/app/phpmailer/src/PHPMailer.php';
        require dirname(APPROOT).'/app/phpmailer/src/SMTP.php';

        require_once dirname(APPROOT).'/app/stripe/init.php';
    class Users extends Controller{
        private $userModel;
        private $buyerModel;
        private $sellerModel;


        public function __construct(){
            
            $this->userModel = $this->model('User');
            $this->buyerModel = $this->model('Buyer');
            $this->sellerModel = $this->model('Seller');

        }

        public function index(){

            $data = [
                'title' => 'Welcome!!!!!'
              ];
             
              $this->view('users/index', $data);
        }

        //register
        public function register(){
            if(isset($_SESSION['otp'])){
                unset($_SESSION['otp']);
                unset($_SESSION['email']);
                unset($_SESSION['password']);
                unset($_SESSION['first_name']);
                unset($_SESSION['second_name']);
                unset($_SESSION['phone']);
                unset($_SESSION['user_type']);
                unset($_SESSION['attempt']);
                session_destroy();
                // redirect('users/login');
            }
            //CHECK FOR POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form
                //Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                //Init data
                $data = [
                    'first_name' => trim($_POST['fname']),
                    'second_name' =>trim($_POST['lname']),
                    'email' => trim($_POST['email']),
                    'phone' => trim($_POST['phone']),
                    'user_type' => trim($_POST['type']),
                    'password' => trim($_POST['password']),
                    'user_id' => '',          
                    'otp'=>rand(111111,999999),
                    'first_name_err' => '',
                    'second_name_err' => '',
                    'email_err' => '',
                    'phone_err' => '',
                    'password_err' => ''
                ];
                
                //Validate email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                }else{
                    //Check email
                    if($this->userModel->findUserByEmail($data['email'])){
                        $data['email_err'] = 'Email is already taken';
                    }
                    else if($this->userModel->notActivated($data['email'])){
                        $data['email_err'] = 'Email is not activated,register again';
                    }
                }
                //Validate first name
                if(empty($data['first_name'])){
                    $data['first_name_err'] = 'Please enter first name';
                }
                //Validate second name
                if(empty($data['second_name'])){
                    $data['second_name_err'] = 'Please enter second name';
                }
                //Validate phone
                if(empty($data['phone'])){
                    $data['phone_err'] = 'Please enter phone';
                }
                //Validate password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter password';
                }elseif(strlen($data['password']) < 6){
                    $data['password_err'] = 'Password must be at least 6 characters';
                }


                //Make sure errors are empty
                if(empty($data['email_err']) && empty($data['first_name_err']) && empty($data['second_name_err']) && empty($data['phone_err']) && empty($data['password_err'])){
                    //Validated

                    //Hash password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    $_SESSION['email'] = $data['email'];
                    $_SESSION['password'] = $data['password'];
                    $_SESSION['first_name'] = $data['first_name'];
                    $_SESSION['second_name'] = $data['second_name'];
                    $_SESSION['phone'] = $data['phone'];
                    $_SESSION['user_type'] = $data['user_type'];
                    $_SESSION['otp'] = $data['otp'];
                    $_SESSION['attempt']=1;

                    //Send email
                    $to=$data['email'];
                    $sender='audexlk@gmail.com';
                    $mail_subject='Verify Email Address';
                    $email_body='<p>Dear '.$data['first_name'].',<br>Thank you for signing up to Audexlk. In order to'; 
                    $email_body.=' validate your account you need enter the given OTP in the verification page.<br>';
                    $email_body.='<h3>The OTP</h3><br><h1>'.$data['otp'].'</h1><br>';
                    $email_body.='Thank you,<br>Audexlk</p>';
                    // $header="From:{$sender}\r\nContent-Type:text/html;";

                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = $sender;
                    $mail->Password = 'bcoxsurnseqiajuf';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->setFrom($sender);
                    $mail->addAddress($to);
                    $mail->isHTML(true);
                    $mail->Subject = $mail_subject;
                    $mail->Body = $email_body;
                    if($mail->send()){
                        //Otp send by email
                        redirect('users/verifyotp');
                    }
                    else{
                        $data['email_err'] = 'Email not sent';
                        $this->view('users/register', $data);
                    }

                    // }
                    // if($this->userModel->sendEmail($data['email'],$data['otp'],$data['first_name'])){
                    //     //Otp send by email
                    //     redirect('users/verifyotp');
                    // }
                    // else{
                    //     $data['email_err'] = 'Email not sent';
                    //     $this->view('users/register', $data);

                    // }

                    //Register user
                    // if($this->userModel->register($data)){
                    //     $row=$this->userModel->getUserId($data['email']);
                    //     $data['user_id']=$row->user_id;
                    //     if($data['user_type']=='seller'){
                    //         if($this->userModel->addToSeller($data)){
                    //             flash('register_success', 'You are registered and can log in');
                    //             redirect('users/login');
                    //         }else{
                    //             die('Something went wrong');
                    //         }
                        
                    //     }
                    //     else if($data['user_type']=='user'){
                    //         if($this->userModel->addToBuyer($data)){
                    //             flash('register_success', 'You are registered and can log in');
                    //             redirect('users/login');
                    //         }else{
                    //             die('Something went wrong');
                    //         }
                    //     }
                    //     else if($data['user_type']=='admin'){
                    //         if($this->userModel->addToAdmin($data)){
                    //             flash('register_success', 'You are registered and can log in');
                    //             redirect('users/login');
                    //         }else{
                    //             die('Something went wrong');
                    //         }
                    //     }
                    //     else{
                    //         if($this->userModel->addTosServiceProvider($data)){
                    //             flash('register_success', 'You are registered and can log in');
                    //             redirect('users/login');
                    //         }else{
                    //             die('Something went wrong');
                    //         }
                    //     }
                    // }
                }else{
                    //Load view with errors
                    $this->view('users/register', $data);
                }
            }
            else{
                //Init data
                $data = [
                    'dir'=>APPROOT,
                    'first_name' => '',
                    'second_name' => '',
                    'email' => '',
                    'phone' => '',
                    'user_type' => '',
                    'password' => '',
                    'otp'=>'',
                    'first_name_err' => '',
                    'second_name_err' => '',
                    'email_err' => '',
                    'phone_err' => '',
                    'password_err' => ''
                ];

                //Load view
                $this->view('users/register', $data);
            }
        }

        //verifyotp
        public function verifyotp(){
            //not filled registration form
            if(!isset($_SESSION['otp'])){
                redirect('users/register');
            }
            
            if($_SESSION['attempt']<=3){
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $_SESSION['attempt']++;
                    // Process form
                    //Sanitize POST data
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    //init data
                    $data = [
                        'first_name' => $_SESSION['first_name'],
                        'second_name' => $_SESSION['second_name'],
                        'email' => $_SESSION['email'],
                        'phone' => $_SESSION['phone'],
                        'user_type' => $_SESSION['user_type'],
                        'password' => $_SESSION['password'],
                        'otp_sent'=>$_SESSION['otp'],
                        'otp_entered'=>trim($_POST['otp']),
                        'otp_err' => '',
                        'first_name_err' => '',
                        'second_name_err' => '',
                        'email_err' => '',
                        'phone_err' => '',
                        'password_err' => ''
                    ];

                    if(empty($data['otp_entered'])){
                        $data['otp_err'] = 'Please enter otp';
                    }elseif(strlen($data['otp_entered']) !=6){
                        $data['otp_err'] = 'Otp must be 6 characters';
                    }
                    if(empty($data['otp_err'])){
                        //no errors
                        if($data['otp_entered']==$data['otp_sent']){
                            //otp matched
                            $dat=date('Y-m-d H:i:s');

                            //Register user
                            if($this->userModel->register($data,$dat)){
                                $row=$this->userModel->getUserId($data['email']);
                                $data['user_id']=$row->user_id;
                                unset($_SESSION['otp']);
                                unset($_SESSION['email']);
                                unset($_SESSION['password']);
                                unset($_SESSION['first_name']);
                                unset($_SESSION['second_name']);
                                unset($_SESSION['phone']);
                                unset($_SESSION['user_type']);
                                session_destroy();


                                if($data['user_type']=='seller'){
                                    if($this->userModel->addToSeller($data)){
                                        flash('register_success', 'You are registered and can log in');
                                        redirect('users/login');
                                    }else{
                                        die('Something went wrong');
                                    }
                                
                                }
                                else if($data['user_type']=='user'){
                                    if($this->userModel->addToBuyer($data)){
                                        flash('register_success', 'You are registered and can log in');
                                        redirect('users/login');
                                    }else{
                                        die('Something went wrong');
                                    }
                                }
                                else if($data['user_type']=='admin'){
                                    if($this->userModel->addToAdmin($data)){
                                        flash('register_success', 'You are registered and can log in');
                                        redirect('users/login');
                                    }else{
                                        die('Something went wrong');
                                    }
                                }
                                else if($data['user_type']=='service_provider'){
                                    if($this->userModel->addToServiceProvider($data)){
                                        flash('register_success', 'You are registered and can log in');
                                        redirect('users/login');
                                    }else{
                                        die('Something went wrong');
                                    }
                                }
                                else if($data['user_type']=='buyer'){
                                    if($this->userModel->addToBuyer($data)){
                                        flash('register_success', 'You are registered and can log in');
                                        redirect('users/login');
                                    }else{
                                        die('Something went wrong');
                                    }
                                }
                            }
                        }
                        else{
                            $data['otp_err'] = 'Otp not matched ';
                            $this->view('users/verifyotp', $data);
                        }
                    }
                    else{
                        $this->view('users/verifyotp', $data);
                    }

                }
                else{
                    //Init data
                    $data = [
                        'first_name' => '',
                        'second_name' => '',
                        'email' => '',
                        'phone' => '',
                        'user_type' => '',
                        'password' => '',
                        'otp_sent'=>'',
                        'otp_entered'=>'',
                        'otp_err' => '',
                        'first_name_err' => '',
                        'second_name_err' => '',
                        'email_err' => '',
                        'phone_err' => '',
                        'password_err' => ''
                    ];
    
                    //Load view
                    $this->view('users/verifyotp', $data);
                }
            }
            else{
                unset($_SESSION['otp']);
                unset($_SESSION['email']);
                unset($_SESSION['password']);
                unset($_SESSION['first_name']);
                unset($_SESSION['second_name']);
                unset($_SESSION['phone']);
                unset($_SESSION['user_type']);
                unset($_SESSION['attempt']);
                session_destroy();
                flash('register_fail', 'You have exceeded the maximum number of attempts');
                redirect('users/register');
            }

        }

        //login
        public function login(){
            if(isset($_SESSION['otp'])){
                unset($_SESSION['otp']);
                // unset($_SESSION['email']);
                // unset($_SESSION['password']);
                // unset($_SESSION['first_name']);
                // unset($_SESSION['second_name']);
                // unset($_SESSION['phone']);
                // unset($_SESSION['user_type']);
                // unset($_SESSION['attempt']);
                // session_destroy();
                // redirect('users/login');
            }
            //CHECK FOR POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form
                //Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                //Init data
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_err' => '',
                    'password_err' => ''
                ];
                
                //Validate email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                }
                //Validate password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter password';
                }elseif(strlen($data['password']) < 6){
                    $data['password_err'] = 'Password must be at least 6 characters';
                }
                
                //Check for user/email
                if($this->userModel->findUserByEmail($data['email'])){
                }
                else if($this->userModel->notActivated($data['email'])){
                    $data['email_err'] = 'Email is not activated,register again';
                }
                else{
                    //User not found
                    $data['email_err'] = 'No user found';
                }

                $userData = $this->userModel->findUserDetailsByEmail($data['email']);
                if($userData->is_deleted == '1'){
                    $data = [
                        'email' => '',
                        'password' => '',
                        'email_err' => '',
                        'password_err' => ''
                    ];
                    redirect('users/register');
                    //$this->view('users/register', $data);
                }
                else{
                    //not a deleted account
                    //Make sure errors are empty
                    if(empty($data['email_err'])  && empty($data['password_err'])){
                        //Validated
                        //Check and set logged in user
                        $dat=date('Y-m-d H:i:s');

                        $loggedInUser = $this->userModel->login($data['email'], $data['password'],$dat);
                        if($loggedInUser){
                            //Create session
                            $this->createUserSession($loggedInUser);
                        }
                        else{
                            $data['password_err'] = 'Password incorrect';

                            $this->view('users/login', $data);
                        }
                    }
                    else{
                        //Load view with errors
                        $this->view('users/login', $data);
                    }
                }          
            }
            else{
                //Init data
                $data = [
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => ''
                ];

                //Load view
                $this->view('users/login', $data);
            }
        }

        public function createUserSession($user){
            //User loged in correctly
            $_SESSION['user_id'] = $user->user_id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->first_name;
            $_SESSION['user_type'] = $user->user_type;
            redirect('users/index');
            
        }

        //Logout
        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_type']);
            session_destroy();
            redirect('users/login');
        }
        //Shop
        public function shop(){
            if(isset($_SESSION['otp'])){
                unset($_SESSION['otp']);
                unset($_SESSION['email']);
                unset($_SESSION['password']);
                unset($_SESSION['first_name']);
                unset($_SESSION['second_name']);
                unset($_SESSION['phone']);
                unset($_SESSION['user_type']);
                unset($_SESSION['attempt']);
                session_destroy();
                // redirect('users/login');
            }
            $ads  = $this->userModel->getAdvertiesment();   
            // get the serchResults session value
            $results = $_SESSION['searchResults'];

            // check serch results are empty(1) or not empty(0)
            $empty = empty($results);


            $data = [
                'ads' => $ads,
                'searchResults' => $results,
                'isEmpty' => $empty
            ];

            unset($_SESSION['searchResults']);
            $i=0;
            foreach($ads as $ad):

                if($ad->product_type=='auction'){
                    $auction = $this->userModel->getAuctionById($ad->product_id);
                    if($auction!='Error'){
                        $data['auction'][$i] = $auction;
                        if($auction->end_date < date("Y-m-d H:i:s") ){
                            redirect('users/bid_expired/'.$ad->product_id.'/'.$auction->auction_id);
                        }
                    }else{
                        unset($data['ads'][$i]);
                    }
                }
                $i++;
            endforeach;
            $this->view('users/shop',$data);
        }


        


        public function advertiesmentDetails($id)
        {

            $_SESSION['product_id'] = $id;

            $ad = $this->userModel->getAdvertiesmentById($id);
            $likeCount = $this->userModel->checkLikeCount($id);
            $dislikeCount = $this->userModel->checkDislikeCount($id);

            //CHeck if loggedIn
            if(isLoggedIn()){
                // check alredy liked or not
                $liked = $this->userModel->checkAddedLike($id,$_SESSION['user_id']);
                $disliked = $this->userModel->checkAddedDislike($id,$_SESSION['user_id']);
                if(empty($liked) && empty($disliked)){
                    // not liked and not disliked
                    $data = [
                        'ad' => $ad,
                        'liked' => 'notliked',
                        'disliked' => 'notdisliked',
                        'likedCount' => $likeCount,
                        'dislikedCount' => $dislikeCount
                    ];
                } 
                else if(!empty($liked) ){
                    $data = [
                        'ad' => $ad,
                        'liked' => 'liked',
                        'disliked' => 'notdisliked',
                        'likedCount' => $likeCount,
                        'dislikedCount' => $dislikeCount
                    ];
                }
                else if(!empty($disliked) ){
                    $data = [
                        'ad' => $ad,
                        'liked' => 'notliked',
                        'disliked' => 'disliked',
                        'likedCount' => $likeCount,
                        'dislikedCount' => $dislikeCount
                    ];
                }
            }
            else{
                // not loggedin
                $data = [
                    'ad' => $ad,
                    'liked' => 'notliked',
                    'disliked' => 'notdisliked',
                    'likedCount' => $likeCount,
                    'dislikedCount' => $dislikeCount
                ];
            }

              $this->view('users/advertiesmentDetails',$data);
          
        }
        public function auction($id)
        {
          $ad = $this->userModel->getAdvertiesmentById($id);
          $data = [
            'ad' => $ad
          ];
          $auction = $this->userModel->getAuctionById($id);
          $data['auction'] = $auction;

          $this->view('users/auction',$data);

        }




        public function bid($id){
          $ad = $this->userModel->getAdvertiesmentById($id);
          $data['ad'] = $ad;

          $auction = $this->userModel->getAuctionById($id);
          $data['auction'] = $auction;
          
          $auction_details = $this -> userModel->getAuctionDetails($id);
          if($auction_details){
            $data['auctions'] =$auction_details;
          }else{
            $data['auctions'] = null;
          }
          $data['auction_expired']=$data['auction']->is_finished;
        //   $this->view('users/bid',$data);

        
        //CHECK FOR POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //CHeck if loggedIn
            if(!isLoggedIn()){
                redirect('pages/index');
            }

            // Process form
            //Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            //Init data
            $data['price'] =trim($_POST['price']);
            
            //Validate price
            if(empty($data['price'])){
                $data['price_err1'] = 'Please enter price';
            }
            //Valid price
            if($data['price']<0){
                $data['price_err2'] = 'Please enter valid price';
            }
            switch($ad->price){
                case $ad->price <1000:
                    $price=$ad->price+10 .'.00';
                break;

                case $ad->price >=1000 && $ad->price < 10000:
                    $price=$ad->price+100 .'.00';
                break;

                case $ad->price >= 10000 && $ad->price < 100000:
                    $price=$ad->price+1000 .'.00';
                break;

                case $ad->price >= 100000 && $ad->price < 1000000:
                    $price=$ad->price+(float)10000 .'.00';
                break;

                case $ad->price >= 1000000 && $ad->price < 10000000:
                    $price=$ad->price+100000 .'.00';
                break;

                case $ad->price >= 10000000 && $ad->price < 100000000:
                    $price=$ad->price+1000000 .'.00';
                break;

                case $ad->price >= 100000000 && $ad->price < 1000000000:
                    $price=$ad->price+10000000 .'.00';
                break;

            }
            //Check for less than current price
            
            
            if($price>$data['price']){
                $data['price_err5'] = 'Please enter a more price than or equal to RS.'.$price ;
            }
            
            if(empty($data['price_err1']) && empty($data['price_err2']) && empty($data['price_err3']) && empty($data['price_err4']) && empty($data['price_err5'])){
                //Validated
            $dat=date('Y-m-d H:i:s');

                $added_bid = $this->userModel->add_bid($data['price'], $auction->auction_id,$dat);
                if($added_bid){
                    $update_price = $this->userModel->update_price($data['price'], $id);
                    if($update_price){
                        redirect('users/bid/'.$id);
                    }else{
                        die('Something went wrong');
                    }
                }
                else{
                    die('Something went wrong');
                }
            }
            else{
                //Load view with errors
                $this->view('users/bid', $data);

            }          
        }
        else{
            //Load view
            $this->view('users/bid', $data);
        }

        }


        public function bid_expired($product_id,$auction_id){
            $row=$this->userModel->bidExpired($auction_id);
            if($row){
                redirect('users/shop');

            }else{
                die('Something went wrong');
            }
        }

        // public function add_bid($product_id,$auction_id,$current_price,$starting_price){
        //     //CHeck if loggedIn
        //     if(!isLoggedIn()){
        //         redirect('pages/index');
        //     }
        //     //CHECK FOR POST
        //     if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //         // Process form
        //         //Sanitize POST data
        //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
        //         //Init data
        //         $data = [
        //             'price' => trim($_POST['price']),
        //             'price_err' => ''
        //         ];
                
        //         //Validate price
        //         if(empty($data['price'])){
        //             $data['price_err'] = 'Please enter price';
        //         }
        //         //Valid price
        //         if($data['price']<0){
        //             $data['price_err'] = 'Please enter valid price';
        //         }
        //         //Check for less than current price
        //         if($data['price']<=$current_price || $data['price']<=$starting_price){
        //             if($current_price == 0){
        //                 $current_price = $starting_price;
        //             }
        //             $data['price_err'] = 'Please enter a more price than RS.'.$current_price;
        //         }

        //         if(empty($data['price_err']) ){
        //             //Validated
        //             $added_bid = $this->userModel->add_bid($data['price'], $auction_id);
        //             if($added_bid){
        //                 redirect('users/bid/'.$product_id);
        //             }
        //             else{
        //                 die('Something went wrong');
        //             }
        //         }
        //         else{
        //             //Load view with errors
        //             redirect('users/bid/'.$product_id);
        //         }          
        //     }
        //     else{
        //         //Init data
        //         $data = [
        //             'price' => '',
        //             'price_err' => ''
        //         ];

        //         //Load view
        //         $this->view('users/bid', $data);
        //     }
        // }


        public function watchlist(){
            if(!isLoggedIn()){
              $_SESSION['url']=URL();
              redirect('users/login');
            }

            $products = $this->userModel->getBuyerWatchProducts($_SESSION['user_email']);
            $data =[
              'products' => $products,
            ];
            $this->view('users/watchlist',$data);
      
          }
      
      
          public function addToWatchList($p_id,$u_id){
            if(!isLoggedIn()){
              $_SESSION['url']=URL();

              redirect('users/login');
            }
            echo $_POST['user_id'];
            if($_POST['user_id'] == 0){
              redirect('users/login');
            }
            else{
              if (isset($_POST['add'])){
                $result = $this-> userModel->addItemToWatchList($p_id, $u_id);
                if($result){
                  echo flash('register_success', 'You are registered and can log in');
                }
                else{
                  die('Something went wrong');
                }
        
              }
            }
          }
          
          public function removeItemFromWatchList($p_id,$u_id){
            if(!isLoggedIn()){
              $_SESSION['url']=URL();

              redirect('users/login');
            }
            echo $_POST['user_id'];
            if($_POST['user_id'] == 0){
              redirect('users/login');
            }
            else{
              if (isset($_POST['remove'])){
              echo "This Works";
                $result = $this-> userModel->removeItemFromWatchList($p_id, $u_id);
                if($result){
                  echo flash('register_success', 'You are registered and can log in');
                }
                else{
                  die('Something went wrong');
                }
        
              }
            }
          }
      
          
          public function removeOneItemFromWatchList($p_id,$u_id){
            if(!isLoggedIn()){
              $_SESSION['url']=URL();

              redirect('users/login');
            }
            echo $_POST['user_id'];
            if($_POST['user_id'] == 0){
                
              redirect('users/login');
            }
            else{
              if (isset($_POST['remove'])){
              echo "This Works";
                $result = $this-> userModel->removeOneItemFromWatchList($p_id, $u_id);
                if($result){
                  echo flash('register_success', 'You are registered and can log in');
                }
                else{
                  die('Something went wrong');
                }
        
              }
            }
          }
      
        public function addLikeToProduct($p_id, $u_id)
        {
          if (!isLoggedIn()) {
            $_SESSION['url']=URL();

            redirect('users/login');
          }
          // $result = $this-> userModel->addLikeToProduct($p_id, $u_id);
      
          $json = file_get_contents('php://input');
          $dat = json_decode($json, true);
      
          echo $dat['addLike'];
          echo $dat['user_id'];
          echo $dat['product_id'];
      
      
          if (isset($dat['addLike'])) {
            // check previous likes dislikes added by this user
            $result1=$this->userModel->checkAddedLike($dat['product_id'], $dat['user_id']);
            $result2=$this->userModel->checkAddedDislike($dat['product_id'], $dat['user_id']);

            if (empty($result1) AND empty($result2)) {
              $resultAdd = $this->userModel->addLikeToProduct($dat['product_id'], $dat['user_id']);
              if ($resultAdd) {
                echo flash('register_success', 'You are registered and can log in');
              } else {
                die();
              }
      
            }
            else{
                $resultUpdate = $this->userModel->updateLikeToProduct($dat['product_id'], $dat['user_id']);
            }
          }
        }
      
      
        public function removeLikeFromProduct($p_id,$u_id)
        {
            if(!isLoggedIn()){
              $_SESSION['url']=URL();

              redirect('users/login');
            }
            // $result = $this-> userModel->addLikeToProduct($p_id, $u_id);
      
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
      
            echo $data['removeLike'];
            echo $data['user_id'];
            echo $data['product_id'];
            //  print_r($dat);
      
            // print_r($_POST);
            // echo $_POST['user_id'];
      
            if (isset($data['removeLike'])){
              $result = $this-> userModel->removeLikeFromProduct($data['product_id'], $data['user_id']);
              if($result){
                echo flash('register_success', 'You are registered and can log in');
              }
              else{
                die('Something went wrong');
              }
      
            }
        }


        public function addDislikeToProduct($p_id, $u_id)
        {
          if (!isLoggedIn()) {
            $_SESSION['url']=URL();

            redirect('users/login');
          }
          // $result = $this-> userModel->addLikeToProduct($p_id, $u_id);
      
          $json = file_get_contents('php://input');
          $dat = json_decode($json, true);
      
          echo $dat['addDislike'];
          echo $dat['user_id'];
          echo $dat['product_id'];
      
      
          if (isset($dat['addDislike'])) {

            // check previous likes dislikes added by this user
            $result1=$this->userModel->checkAddedLike($dat['product_id'], $dat['user_id']);
            $result2=$this->userModel->checkAddedDislike($dat['product_id'], $dat['user_id']);

            if (empty($result1) AND empty($result2)) {
                $resultAdd = $this->userModel->addDislikeToProduct($dat['product_id'], $dat['user_id']);
              if ($resultAdd) {
                echo flash('register_success', 'You are registered and can log in');
              } else {
                die();
              }
      
            }
            else{
                $resultUpdate = $this->userModel->updateDislikeToProduct($dat['product_id'], $dat['user_id']);
            }
          }  
        }

        public function removeDislikeFromProduct($p_id,$u_id)
        {
            if(!isLoggedIn()){
              $_SESSION['url']=URL();

              redirect('users/login');
            }
            // $result = $this-> userModel->addLikeToProduct($p_id, $u_id);
      
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
      
            echo $data['removeDislike'];
            echo $data['user_id'];
            echo $data['product_id'];
            //  print_r($dat);
      
            // print_r($_POST);
            // echo $_POST['user_id'];
      
            if (isset($data['removeDislike'])){
              $result = $this-> userModel->removeDislikeFromProduct($data['product_id'], $data['user_id']);
              if($result){
                echo flash('register_success', 'You are registered and can log in');
              }
              else{
                die('Something went wrong');
              }
      
            }
        }
        public function sound_engineers(){
        $data = $this->userModel->getServiceProviders();
            
        $this->view('users/sound_engineers', $data);
    }

        public function checkout($product_id,$data1){
            // $json = file_get_contents($data1);
            $data = json_decode($data1, true);
            $data['product_id']=$product_id;
            $this->view('users/checkout',$data);

        }

        public function payment(){

            \Stripe\Stripe::setApiKey(STRIPE_API_KEY);
            
            header('Content-Type: application/json');
            
            try {
                // retrieve JSON from POST body
                $jsonStr = file_get_contents('php://input');
                $jsonObj = json_decode($jsonStr);
            
                // Create a PaymentIntent with amount and currency
                $paymentIntent = \Stripe\PaymentIntent::create([
                    'amount' => 300*100,
                    'currency' => 'lkr',
                    'automatic_payment_methods' => [
                        'enabled' => true,
                    ],
                ]);
            
                $output = [
                    'clientSecret' => $paymentIntent->client_secret,
                ];
            
                echo json_encode($output);
            } catch (Error $e) {
                http_response_code(500);
                echo json_encode(['error' => $e->getMessage()]);
            }


        }
        public function paid($product_id){
            $data=[
                'product_id'=>$product_id,
                'payment_intent' => $_GET['payment_intent'],
                'payment_intent_client_secret' => $_GET['payment_intent_client_secret'],
                'redirect_status' => $_GET['redirect_status']
            ];
            $payment_intent = $_GET['payment_intent'];
            $payment_intent_client_secret = $_GET['payment_intent_client_secret'];
            $redirect_status = $_GET['redirect_status'];
            $amount = 300.00;
            if($redirect_status=='succeeded'){
                $result = $this->userModel->addPayment($amount,$product_id,$payment_intent,$payment_intent_client_secret,$redirect_status);
                if($result){
                    redirect('users/success');
                }
                else{
                    die('Something went wrong');
                }
            }
            $this->view('users/success',$data);
        
        
        }


        public function success(){
            $data=[
                'title'=>'Success'
            ];
            $this->view('users/success',$data);
        }
        
        
        public function approve_reject_bid($product_id,$bid_id,$price,$time){
            if(time() < $time){
                $advertisement=$this->sellerModel->getAdvertisementById($product_id);
                if($advertisement){
                    $data['advertisement'] = $advertisement;
                }
                else{
                    die('Something went wrong');
                }
                $data=[
                    'advertisement'=>$advertisement
                ];
                $auction = $this->userModel->getAuctionById_withfinished($product_id);
                if($auction){
                    $data['auction'] = $auction;
                }
                else{
                    die('Something went wrong');
                }
                $bid = $this->userModel->getBidList($bid_id,$price);
                if($bid){
                    $data['bid'] = $bid;
                }
                else{
                    die('Something went wrong');
                }
                
                if(isLoggedIn()){
                    if($bid->email_buyer!=$_SESSION['user_email']){
                        $_SESSION['url']=URL();
                        redirect('users/login');
                    }
                    else{
                        if($bid->is_accepted==0 && $bid->is_rejected==0){

                            $this->view('users/aprove_reject_bid',$data);
                        }else{
                            redirect('pages/index');
                        }
                    }

                }else{
                    $_SESSION['url']=URL();
                    redirect('users/login');
                }

            }else{
                $this->userModel->updateBidStatus($bid_id,$price);
                redirect('pages/index');
            }
        } 
        
        public function accept_bid($bid_id,$price){
            $result = $this->userModel->updateBidAcceptedStatus($bid_id,$price);
            if($result){
                flash('auction_message', 'Offer Accepted');
                redirect('pages/index');
            }
            else{
                die('Something went wrong');
            }
        }

        public function reject_bid($bid_id,$price){
            $result = $this->userModel->updateBidStatus($bid_id,$price);
            if($result){
                redirect('pages/index');
            }
            else{
                die('Something went wrong');
            }
        }
        
        

        public function searchItems(){

            $searchedTerm = $_POST['search-item'];
            
            if( !isset($_POST['submit']) ){
              // this is for keyup event
              if( strlen($searchedTerm) <3 ){
                echo json_encode([]);
              }else{
                $results = $this-> userModel->searchItems($searchedTerm);
                echo json_encode($results);
              }
            }
            else{
              // user has pressed enter
              if( strlen($searchedTerm) <1 ){
                echo json_encode([]);
              }else{
                $results = $this-> userModel->searchItems($searchedTerm);
                $_SESSION['searchResults'] = $results;
                echo json_encode($results);
              }
      
            }
      
        }

    public function serviceProviderPublic()
    {
       
        $id = $_GET['id'];

        $d = $this->userModel->getServiceProvidersPublic($id);
        $data = [
            'details' => $d
        ];
        $this->view('users/service_provider_public', $data);
    }    
    }