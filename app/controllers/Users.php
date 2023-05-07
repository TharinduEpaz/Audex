<?php
        use \PHPMailer\PHPMailer\PHPMailer;
        use \PHPMailer\PHPMailer\Exception;

        require dirname(APPROOT).'/app/phpmailer/src/Exception.php';
        require dirname(APPROOT).'/app/phpmailer/src/PHPMailer.php';
        require dirname(APPROOT).'/app/phpmailer/src/SMTP.php';

        require_once dirname(APPROOT).'/app/stripe/init.php';
    class Users extends Controller{
        private $userModel;
        // private $buyerModel;
        // private $sellerModel;
        private $calendar;



        public function __construct(){
            
            $this->userModel = $this->model('User');
            // $this->buyerModel = $this->model('Buyer');
            // $this->sellerModel = $this->model('Seller');

            //Session timeout
            if(isset($_SESSION['time'])){
                if(time() - $_SESSION['time'] > 60*30){
                    // flash('session_expired', 'Your session has expired', 'alert alert-danger');
                    $this->logout();
                }else{
                    $_SESSION['time'] = time();
                }
            }

        }

        public function index(){
            if(isset($_SESSION['attempt'])){
                unset($_SESSION['otp_email']);
                unset($_SESSION['phone']);
                unset($_SESSION['attempt']);
                unset($_SESSION['time']);
            }
            //Get hotest auctions
            $auctions = $this->userModel->getHotestAuctions();
            //Get popular sound engineers
            $engineers = $this->userModel->getPopularEngineers();
            if($auctions!=false){
                $data['auctions'] = $auctions;
            }else{
                $data['auctions'] = [];
            }
            if($engineers!=false){
                $data['engineers'] = $engineers;
            }else{
                $data['engineers'] = [];
            }

             
              $this->view('users/index', $data);
        }

        //register
        public function register(){
            if(isset($_SESSION['attempt'])){
                unset($_SESSION['otp_email']);
                unset($_SESSION['phone']);
                unset($_SESSION['attempt']);
                unset($_SESSION['time']);
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
                    'user_type' => trim($_POST['type']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'user_id' => '',          
                    'otp'=>rand(111111,999999),
                    'first_name_err' => '',
                    'second_name_err' => '',
                    'email_err' => '',
                    'password_err1' => '',
                    'password_err2' => '',
                    'password_err3' => '',
                    'password_err4'=>'',
                    'password_err5' => '',
                    'password_err6' => '',
                    'confirm_password_err' => '',
                    'email_not_activated_err' => ''
                ];
                $data['passwd']=$data['password'];
                $data['confirm_passwd']=$data['confirm_password'];
                
                //Validate email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                }else{
                    //Check email
                    if($this->userModel->findUserByEmail($data['email'])){
                        $data['email_err'] = 'Email is already taken';
                    }
                }
                if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                } else {
                    $data['email_err'] = "Invalid email";
                }
                //Validate first name
                if(empty($data['first_name'])){
                    $data['first_name_err'] = 'Please enter first name';
                }else{
                    //Check first name has numbers/special characters
                    if(preg_match('/^[a-zA-Z]+$/', $data['first_name'])) {

                    } else {
                        $data['first_name_err'] = 'Use only letters';
                    }
                }
                //Validate second name
                if(empty($data['second_name'])){
                    $data['second_name_err'] = 'Please enter second name';
                }else{
                    //Check first name has numbers/special characters
                    if(preg_match('/^[a-zA-Z]+$/', $data['second_name'])) {

                    } else {
                        $data['second_name_err'] = 'Use only letters';
                    }
                }
                //Validate password
                if(empty($data['passwd'])){
                    $data['password_err1'] = 'Please enter a password';
                }if(strlen($data['password']) < 6){
                    $data['password_err2'] = 'Password must be at least 6 characters';
                }
                // if(!preg_match("#[0-9]+#",$data['password'])) {
                //     $data['password_err3'] = 'Password must contain at least 1 number!';
                // }if(!preg_match("#[A-Z]+#",$data['password'])) {
                //     $data['password_err4'] = 'Password must contain at least 1 capital letter!';
                // }if(!preg_match("#[a-z]+#",$data['password'])) {
                //     $data['password_err5'] = 'Password must contain at least 1 lowercase letter!';
                /* }if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=!_+¬-]/', $data['password'])) {*/
                //     $data['password_err6'] = 'Password must contain at least 1 special character!';
                // }

                if(empty($data['confirm_passwd'])){
                    $data['confirm_password_err'] = 'Please confirm the password';
                }else if($data['passwd'] != $data['confirm_passwd']){
                    $data['confirm_password_err'] = 'Passwords do not match';
                }

                //Make sure errors are empty
                if(empty($data['email_err']) && empty($data['first_name_err']) && empty($data['second_name_err'])  && empty($data['password_err1']) && empty($data['password_err2']) && empty($data['password_err3']) && empty($data['password_err4']) && empty($data['password_err5']) && empty($data['confirm_password_err']) && empty($data['password_err6'])){
                    //Validated
                    //Hash password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                    $data['otp_hashed'] = password_hash($data['otp'], PASSWORD_DEFAULT);
                    $dat=date('Y-m-d H:i:s');
                    //Already registered with email active
                    if($this->userModel->findUserByEmail($data['email'])){
                        redirect('users/login');
                    }else if($this->userModel->notActivated($data['email'])){ //Already registered, email not activated
                         $data['email_not_activated_err']='Email is not activated, <a href=\''.URLROOT.'/users/activate_email/'.$data['email'].'\'>click to activate again</a>';
                        
                    }
                    if($data['email_not_activated_err']!=''){

                        $this->view('users/register', $data);

                    }else if($this->userModel->register($data,$dat)){
                        $_SESSION['otp_email']=$data['email'];
                        $_SESSION['attempt']=0;
                        $_SESSION['time'] = date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime(date('Y-m-d H:i:s'))));
                        //Send email
                        $mail = new PHPMailer(true);
                        try {
                            $to=$data['email'];
                            $sender='audexlk@gmail.com';
                            $mail_subject='Verify Email Address';
                            $email_body='<p>Dear '.$data['first_name'].',<br>Thank you for signing up to Audexlk. In order to'; 
                            $email_body.=' validate your account you need enter the given OTP in the verification page.<br>';
                            $email_body.='<h3>The OTP</h3><br><h1>'.$data['otp'].'</h1><br>';
                            $email_body.='Thank you,<br>Audexlk</p>';
                            // $header="From:{$sender}\r\nContent-Type:text/html;";
                            
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = $sender;
                            $mail->Password = EMAIL_PASS;
                            $mail->SMTPSecure = 'ssl';
                            $mail->Port = 465;
                            $mail->setFrom($sender);
                            $mail->addAddress($to);
                            $mail->isHTML(true);
                            $mail->Subject = $mail_subject;
                            $mail->Body = $email_body;
                            // if($mail->send()){
                                $mail->send();
                                $_SESSION['otp_email']=$data['email'];
                                //Otp send by email
                                redirect('users/verifyotp');
                            // }
                            // else{
                                // }
                            } catch (Exception $e) {
                                flash('email_err','Mail could not be sent. Error: '. $e->getMessage(),'alert alert-danger');
                                unset($_SESSION['otp_email']);
                                unset($_SESSION['attempt']);
                                unset($_SESSION['time']);
                                $this->view('users/register', $data);
                            // echo 'Message could not be sent. Error: ', $e->getMessage();
                            }
                    
                    }else{
                        die('Something went wrong');
                    }

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
                    'user_type' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'passwd' => '',
                    'confirm_passwd' => '',
                    'otp'=>'',
                    'first_name_err' => '',
                    'second_name_err' => '',
                    'email_err' => '',
                    'confirm_password_err' => '',
                    'password_err' => ''
                ];

                //Load view
                $this->view('users/register', $data);
            }
        }

        //Registered not email activated
        public function activate_email($email){
            $data['user']=$this->userModel->findUserDetailsByEmail($email);
            $_SESSION['attempt']=0;
            $_SESSION['time'] = date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime(date('Y-m-d H:i:s'))));
            $data['email']=$email;
            $data['otp']=rand(111111,999999);
            $data['otp_hashed'] = password_hash($data['otp'], PASSWORD_DEFAULT);
            $dat=date('Y-m-d H:i:s');
            if($this->userModel->updateOtp($data['otp'],$dat,$data['email'])){
                //Send email
                $mail = new PHPMailer(true);
                try{
                $to=$data['email'];
                $sender='audexlk@gmail.com';
                $mail_subject='Verify Email Address';
                $email_body='<p>Dear '.$data['user']->first_name.',<br>Thank you for signing up to Audexlk. In order to'; 
                $email_body.=' validate your account you need enter the given OTP in the verification page.<br>';
                $email_body.='<h3>The OTP</h3><br><h1>'.$data['otp'].'</h1><br>';
                $email_body.='Thank you,<br>Audexlk</p>';
                // $header="From:{$sender}\r\nContent-Type:text/html;";
                
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
                // if($mail->send()){
                    //Otp send by email
                    $mail->send();
                    $_SESSION['otp_email']=$data['email'];
                    redirect('users/verifyotp');
                // }
                // else{
                //     $data['email_err'] = 'Email not sent';
                //     $this->view('users/register', $data);
                // }
                } catch (Exception $e) {
                    flash('email_err','Mail could not be sent. Error: '. $e->getMessage(),'alert alert-danger');
                    unset($_SESSION['otp_email']);
                    unset($_SESSION['attempt']);
                    unset($_SESSION['time']);
                    redirect('users/register');
                // echo 'Message could not be sent. Error: ', $e->getMessage();
                }
            }
        }


        //verifyotp
        public function verifyotp(){
            //not filled registration form
            if(!isset($_SESSION['otp_email'])){
                redirect('users/register');
            }
            if(!isset($_SESSION['attempt'])){
                redirect('users/register');
            }
            $email=$_SESSION['otp_email'];
            if(isLoggedIn()){
                redirect('users/index');
            }
            
            if($_SESSION['attempt']<=3){
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $_SESSION['attempt']++;
                    // Process form
                    //Sanitize POST data
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    //init data
                    $data = [
                        'otp_entered'=>trim($_POST['otp']),
                        'otp_err' => ''
                    ];

                    if(empty($data['otp_entered'])){
                        $data['otp_err'] = 'Please enter otp';
                    }elseif(strlen($data['otp_entered']) !=6){
                        $data['otp_err'] = 'Otp must be 6 characters';
                    }
                    if(!isset($_POST['acceptT'])){
                        $data['accept_err'] = 'Please accept terms and conditions';
                    }
                    if(empty($data['otp_err']) && empty($data['accept_err'])){
                        //no errors
                        if($email!=NULL){
                            $user_details=$this->userModel->findUserDetailsByEmail($email);
                            $data['user']=$user_details;
                            if($user_details){
                                if($data['otp_entered'] == $user_details->otp){
                                    //otp matched
                                    $dat=date('Y-m-d H:i:s');
        
                                    //Update user
                                    if($this->userModel->updateUserActivated($user_details->email,$dat)){
                                        $row=$this->userModel->getUserId($user_details->email);
                                        $data['user_id']=$row->user_id;
                                        $data['email']=$row->email;
                                        $data['user_type']=$row->user_type;
                                        unset($_SESSION['otp_email']);
                                        
                                        if($data['user_type']=='seller'){
                                            if($this->userModel->addToSeller($data)){
                                                flash('register_success', 'You are registered and can log in');
                                                unset($_SESSION['otp_email']);
                                                unset($_SESSION['attempt']);
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
                                    }else{
                                        die('Something went wrong');}
                                }
                                else{
                                    $data['otp_err'] = 'Otp not matched ';
                                    $this->view('users/verifyotp', $data);
                                }
                            }
                        }else{
                            unset($_SESSION['otp_email']);
                            unset($_SESSION['attempt']);
                            redirect('users/register');
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
                unset($_SESSION['attempt']);
                unset($_SESSION['otp_email']);
                session_destroy();
                flash('register_fail', 'You have exceeded the maximum number of attempts');
                redirect('users/register');
            }

        }

        //login
        public function login(){
            if(isset($_SESSION['attempt'])){
                unset($_SESSION['otp_email']);
                unset($_SESSION['attempt']);
                unset($_SESSION['time']);
            }
            if(isLoggedIn()){
                redirect('users/index');
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
                if(!empty($this->userModel->findUserByEmail($data['email']))){
                }
                else if($this->userModel->notActivated($data['email'])){
                }
                else{
                    //User not found
                    $data['email_err'] = 'No user found';
                }

                $userData = $this->userModel->findUserDetailsByEmail($data['email']);
                if(!empty($userData) && $userData->is_deleted == 1){
                    $data = [
                        'email' => '',
                        'password' => '',
                        'email_err' => '',
                        'password_err' => ''
                    ];
                    flash('Account_deleted','Account is deleted, register with a new email');
                    redirect('users/register');
                    //$this->view('users/register', $data);
                }else if(!empty($userData) && $userData->email_active==0){
                    $data['email_not_activated_err']='Email is not activated, <a href=\''.URLROOT.'/users/activate_email/'.$data['email'].'\'> click to activate again</a>';
                }
                    //not a deleted account
                    //Make sure errors are empty
                    if($userData->password_wrong_attempts<=3){
                        if(empty($data['email_err'])  && empty($data['password_err']) && empty($data['email_not_activated_err'])){
                            //Validated
                            //Check and set logged in user
                            $dat=date('Y-m-d H:i:s');
    
                            $loggedInUser = $this->userModel->login($data['email'], $data['password'],$dat);
                            if($loggedInUser ){
                                if($loggedInUser->suspended == 0){
                                    //Create session
                                    $this->userModel->updatePasswordAttemptsZero($data['email']);
                                    $this->createUserSession($loggedInUser);
                                }else{
                                    flash('login_fail', 'Account suspended for 1 hour', 'alert alert-danger');
                                    $this->view('users/login', $data);

                                }
                            }
                            else{
                                $data['password_err'] = 'Password incorrect';
                                $this->userModel->updatePasswordAttempts($data['email']);
    
                                $this->view('users/login', $data);
                            }
                        }
                        else{
                            //Load view with errors
                            $this->view('users/login', $data);
                        }

                    }else{
                        $dat=date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). ' +1  hour'));
                        if($this->userModel->suspendAccount($data['email'],$dat)){
                            flash('login_fail', 'Account suspended for 1 hour', 'alert alert-danger');
                            $this->view('users/login', $data);
                        }else{
                            flash('login_fail', 'Something went wrong', 'alert alert-danger');
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
            $_SESSION['prev_user_type'] ='';
            $_SESSION['time']=time();
            if(isset($_SESSION['url'])){
                $url=$_SESSION['url']; // holds url for last page visited.
                unset($_SESSION['url']);
                redirect($url);
            }
            else{
                redirect('users/index');
            }
            
        }

            public function getProfile($id){ 
                if(isset($_SESSION['attempt'])){
                    unset($_SESSION['otp_email']);
                    unset($_SESSION['phone']);
                    unset($_SESSION['attempt']);
                    unset($_SESSION['time']);
                }
                // get user data from user table
                $user=$this->userModel->getUserDetails($id);
                if(empty($user)){
                    redirect('users/index');
                }
                // if(!isLoggedIn()){
                //     $_SESSION['url'] = URL();
                //     redirect('users/login');
                // }else if($_SESSION['user_email'] != $user->email){
                //     redirect($_SESSION['user_type'].'s/getProfile/'.$id);
                // }

                if($user->user_type=='buyer'){
                    // get data from buyer table
                    $userDetails = $this->userModel->getBuyerDetails($user->email);
                }else if($user->user_type=='seller'){
                    // get data from seller table
                    $userDetails = $this->userModel->getSellerDetails($user->email);
                }else if($user->user_type=='service_provider'){
                    $userDetails = $this->userModel->getService_ProviderDetails($user->user_id);
                }
                // if ($details->user_id != $_SESSION['user_id']) {
                //   $_SESSION['url']=URL();
          
                //   redirect('users/login');
                // }
                
                //get all feedback this user has 
                $feedbacks=$this->userModel->getFeedbacks($user->email);

                $feedbackcount=$this->userModel->getFeedbacksCount($user->email);
                
                $data =[
                  'id' => $id,
                  'user' => $user,
                  'userDetails' => $userDetails,
                  'feedbacks' => $feedbacks,
                  'feedbackcount' => $feedbackcount
                ];
                $this->view('users/getProfile',$data);
              }

            public function change_phone($id){
                if(isset($_SESSION['attempt'])){
                    unset($_SESSION['otp_email']);
                    unset($_SESSION['phone']);
                    unset($_SESSION['attempt']);
                    unset($_SESSION['time']);
                }
                $user=$this->userModel->getUserDetails($id);
                if(empty($user)){
                    redirect('users/index');
                }
                if(!isLoggedIn()){
                    $_SESSION['url'] = URL();
                    redirect('users/login');
                }else if($_SESSION['user_email'] != $user->email){
                    redirect($_SESSION['user_type'].'s/getProfile/'.$id);
                }
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    // Process form
                    //Sanitize POST data
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    //init data
                    $data = [
                        'id' => $id,
                        'phone'=>trim($_POST['phone']),
                        'phone_err' => ''
                    ];
                    //Validate phone
                    if(empty($data['phone'])){
                        $data['phone_err'] = 'Please enter a phone number';
                    }else if(!preg_match('/^[0-9]{10}$/', $data['phone'])){
                        $data['phone_err'] = 'Enter a valid Phone number';
                    }else if($this->userModel->findUserByPhone($data['phone'])){
                        $data['phone_err'] = 'Phone number is already added, use another one';
                    }
                    //Make sure errors are empty
                    if(empty($data['phone_err'])){
                        //Validated

                        // Create a new cURL resource
                        // $curl = curl_init();

                        // Set the cURL options
                        // curl_setopt($curl, CURLOPT_URL, URLROOT.'/users/otp_phone');
                        // curl_setopt($curl, CURLOPT_POST, 1);
                        // curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
                        //     'id' => $data['id'],
                        //     'phone' => $data['phone'],
                        // )));

                        // // Execute the cURL request
                        // $response = curl_exec($curl);

                        // // Close the cURL resource
                        // curl_close($curl);
                        $_SESSION['phone'] = $data['phone'];
                        $_SESSION['attempt'] = 0;
                        $_SESSION['time'] = date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime(date('Y-m-d H:i:s'))));
                        $otp=rand(111111,999999);
                        if($this->userModel->updatePhoneOTP($otp,$id)){
                            $user = "94722699883";
                            $password = "7884";
                            $text = urlencode("Dear valued customer, your OTP is $otp. Please enter this OTP to verify your phone number in AudexLK. This expires in 10minutes from now. Thank you . From AUDEXLK");
                            $to = $data['phone'];

                            $baseurl ="http://www.textit.biz/sendmsg";
                            $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";
                            $ret = file($url);

                            $res= explode(":",$ret[0]);

                            if (trim($res[0])=="OK"){
                                echo "Message Sent - ID : ".$res[1];
                                redirect('users/otp_phone/'.$data['id']);
                            }
                            else{
                                echo "Sent Failed - Error : ".$res[1];
                                flash('phone_message', 'OTP didn\'t send, try again');
                                redirect($_SESSION['user_type'].'s/getProfile/'.$id);
                            }
                        }
                        else{
                            die('Something went wrong');
                        }
                        
                    }else{
                        //Load view with errors
                        $this->view('users/change_phone', $data);
                    }
                }else{
                    $data = [
                        'id' => $id,
                        'phone'=> '',
                        'phone_err' => ''
                    ];
                    $this->view('users/change_phone',$data);
                }
            }

            public function otp_phone($id){
                if(!isset($_SESSION['attempt']) || $id==null){
                    unset($_SESSION['otp_email']);
                    unset($_SESSION['attempt']);
                    redirect('users/index');
                }
                $user=$this->userModel->getUserDetails($id);
                if(empty($user)){
                    redirect('users/index');
                }
                if(!isLoggedIn()){
                    $_SESSION['url'] = URL();
                    redirect('users/login');
                }else if($_SESSION['user_email'] != $user->email){
                    redirect($_SESSION['user_type'].'s/getProfile/'.$id);

                }
                if($_SESSION['attempt']<=3){

                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $_SESSION['attempt']++;
                        // Process form
                        //Sanitize POST data
                        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                        //init data
                        $data = [
                            'id' => $id,
                            'phone' => $_SESSION['phone'],
                            'otp_entered'=>trim($_POST['otp']),
                            'otp_err' => ''
                        ];

                        if(empty($data['otp_entered'])){
                            $data['otp_err'] = 'Please enter otp';
                        }else if(strlen($data['otp_entered']) !=6){
                            $data['otp_err'] = 'Otp must be 6 characters';
                        }else if(!preg_match('/^[0-9]{6}$/', $data['otp_entered'])){
                            $data['otp_err'] = 'Otp must be numeric';
                        }
                        if(empty($data['otp_err'])){
                            //no errors
                            if($id!=NULL){
                                $user_details=$this->userModel->getUserDetails($id);
                                $data['user']=$user_details;
                                if($user_details){
                                    if($data['otp_entered'] == $user_details->phone_otp){
                                        //otp matched
                                    
                                        //Update user
                                        if($this->userModel->updateUserPhone($user_details->email, $data['phone'])){
                                            unset($_SESSION['phone']);
                                            unset($_SESSION['attempt']);
                                            unset($_SESSION['time']);
                                            flash('phone_message', 'Phone number updated successfully');
                                            redirect($_SESSION['user_type'].'s/getProfile/'.$id);

                                        }else{
                                            die('Something went wrong');}
                                    }
                                    else{
                                        $data['otp_err'] = 'Otp not matched ';
                                        $this->view('users/otp_phone', $data);
                                    }
                                }
                            }else{
                                unset($_SESSION['phone']);
                                unset($_SESSION['attempt']);
                                unset($_SESSION['time']);
                                redirect('users/index');
                            }
                        }
                        else{
                            $this->view('users/otp_phone', $data);
                        }

                    }
                
                    else{
                        $data = [
                            'id' => $id,
                            'phone' => $_SESSION['phone'],
                            'otp_entered' => '',
                            'otp_err' => '',
                        ];
                        $this->view('users/otp_phone',$data);
                    }
                }else{
                    unset($_SESSION['phone']);
                    unset($_SESSION['attempt']);
                    unset($_SESSION['time']);
                    flash('phone_message', 'Eccessed maximum attempts', 'alert alert-danger');
                    redirect($_SESSION['user_type'].'s/getProfile/'.$id);
                }
            }

            public function change_email($id){
                if(isset($_SESSION['attempt'])){
                    unset($_SESSION['otp_email']);
                    unset($_SESSION['phone']);
                    unset($_SESSION['attempt']);
                    unset($_SESSION['time']);
                }
                $user=$this->userModel->getUserDetails($id);
                if(empty($user)){
                    redirect('users/index');
                }
                if(!isLoggedIn()){
                    $_SESSION['url'] = URL();
                    redirect('users/login');
                }else if($_SESSION['user_email'] != $user->email){
                    redirect($_SESSION['user_type'].'s/getProfile/'.$id);
                }
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    // Process form
                    //Sanitize POST data
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    //init data
                    $data = [
                        'id' => $id,
                        'email'=>trim($_POST['email']),
                        'email_err' => '',
                        'user' => $this->userModel->getUserDetails($id)
                    ];
                    //Validate phone
                    if(empty($data['email'])){
                        $data['email_err'] = 'Please enter a email';
                    }
                    if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                        $data['email_err'] = 'Enter a valid Email';
                    }
                    if(!empty($this->userModel->getUserDetailsByEmail($data['email']))){
                        $data['email_err'] = 'Email is already added, use another one';
                    }
                    //Make sure errors are empty
                    if(empty($data['email_err'])){
                        //Validated
                        $_SESSION['attempt'] = 0;
                        $_SESSION['time'] = date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime(date('Y-m-d H:i:s'))));
                        $otp=rand(111111,999999);
                        if($this->userModel->updateEmailOTP($otp,$id)){
                            //Send email
                            $mail = new PHPMailer(true);
                            try{
                                $to=$data['email'];
                                $sender='audexlk@gmail.com';
                                $mail_subject='Verify Email Address';
                                $email_body='<p>Dear '.$data['user']->first_name.',<br>In order to change your email address you need to validate your account.'; 
                                $email_body.=' To validate your account you need enter the given OTP in the verification page.<br>';
                                $email_body.='<h3>The OTP</h3><br><h1>'.$otp.'</h1><br>';
                                $email_body.='Thank you,<br>Audexlk</p>';
                                // $header="From:{$sender}\r\nContent-Type:text/html;";
                                
                                $mail->isSMTP();
                                $mail->Host = 'smtp.gmail.com';
                                $mail->SMTPAuth = true;
                                $mail->Username = $sender;
                                $mail->Password = EMAIL_PASS;
                                $mail->SMTPSecure = 'ssl';
                                $mail->Port = 465;
                                $mail->setFrom($sender);
                                $mail->addAddress($to);
                                $mail->isHTML(true);
                                $mail->Subject = $mail_subject;
                                $mail->Body = $email_body;
                                // if($mail->send()){
                                    $mail->send();
                                    $_SESSION['otp_email']=$data['email'];
                                    //Otp send by email
                                    redirect('users/otp_email/'.$id);
                                // }
                                // else{
                                    // flash('email_err','Email not sent','alert alert-danger');
                                    // $this->view('users/change_email', $data);
                                // }
                            } catch (Exception $e) {
                                flash('email_err','Mail could not be sent. Error: '. $e->getMessage(),'alert alert-danger');
                                unset($_SESSION['otp_email']);
                                unset($_SESSION['attempt']);
                                unset($_SESSION['time']);
                                $this->view('users/change_email', $data);
                            // echo 'Message could not be sent. Error: ', $e->getMessage();
                            }
                        }
                        else{
                            die('Something went wrong');
                        }
                        
                    }else{
                        //Load view with errors
                        $this->view('users/change_email', $data);
                    }
                }else{
                    $data = [
                        'id' => $id,
                        'email'=>'',
                        'email_err' => '',
                        'user' => $this->userModel->getUserDetails($id)
                    ];
                    $this->view('users/change_email',$data);
                }
            }

            public function otp_email($id){

                if(!isset($_SESSION['attempt']) || $id==null){
                    unset($_SESSION['otp_email']);
                    unset($_SESSION['time']);
                    unset($_SESSION['attempt']);
                    redirect('users/index');
                }
                $user=$this->userModel->getUserDetails($id);
                if(empty($user)){
                    redirect('users/index');
                }
                if(!isLoggedIn()){
                    $_SESSION['url'] = URL();
                    redirect('users/login');
                }else if($_SESSION['user_email'] != $user->email){
                    redirect($_SESSION['user_type'].'s/getProfile/'.$id);

                }
                if($_SESSION['attempt']<=3){

                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $_SESSION['attempt']++;
                        // Process form
                        //Sanitize POST data
                        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                        //init data
                        $data = [
                            'id' => $id,
                            'email' => $_SESSION['otp_email'],
                            'otp_entered'=>trim($_POST['otp']),
                            'otp_err' => ''
                        ];

                        if(empty($data['otp_entered'])){
                            $data['otp_err'] = 'Please enter otp';
                        }else if(strlen($data['otp_entered']) !=6){
                            $data['otp_err'] = 'Otp must be 6 characters';
                        }else if(!preg_match('/^[0-9]{6}$/', $data['otp_entered'])){
                            $data['otp_err'] = 'Otp must be numeric';
                        }
                        if(empty($data['otp_err'])){
                            //no errors
                            if($id!=NULL){
                                $user_details=$this->userModel->getUserDetails($id);
                                $data['user']=$user_details;
                                if($user_details){
                                    if($data['otp_entered'] == $user_details->otp){
                                        //otp matched
                                    
                                        //Update user
                                        if($this->userModel->updateUserEmail($data['email'], $id)){
                                            unset($_SESSION['otp_email']);
                                            unset($_SESSION['attempt']);
                                            unset($_SESSION['time']);
                                            $_SESSION['user_email']=$data['email'];
                                            flash('phone_message', 'Email updated successfully');
                                            redirect($_SESSION['user_type'].'s/getProfile/'.$id);

                                        }else{
                                            die('Something went wrong');}
                                    }
                                    else{
                                        $data['otp_err'] = 'Otp not matched ';
                                        $this->view('users/otp_email', $data);
                                    }
                                }
                            }else{
                                unset($_SESSION['otp_email']);
                                unset($_SESSION['attempt']);
                                unset($_SESSION['time']);
                                redirect('users/index');
                            }
                        }
                        else{
                            $this->view('users/otp_email', $data);
                        }

                    }
                
                    else{
                        $data = [
                            'id' => $id,
                            'email' => $_SESSION['otp_email'],
                            'otp_entered' => '',
                            'otp_err' => '',
                        ];
                        $this->view('users/otp_email',$data);
                    }
                }else{
                    unset($_SESSION['otp_email']);
                    unset($_SESSION['attempt']);
                    unset($_SESSION['time']);
                    flash('phone_message', 'Eccessed maximum attempts', 'alert alert-danger');
                    redirect($_SESSION['user_type'].'s/getProfile/'.$id);
                }
            }

            public function enterEmail(){
                if(isset($_SESSION['attempt'])){
                    unset($_SESSION['otp_email']);
                    unset($_SESSION['phone']);
                    unset($_SESSION['attempt']);
                    unset($_SESSION['time']);
                }
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    // Process form
                    //Sanitize POST data
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    //init data
                    $data = [
                        'email'=>trim($_POST['email']),
                        'email_err' => ''
                    ];
                    //Validate phone
                    if(empty($data['email'])){
                        flash('email_err','Please enter a email in forgot password section','alert alert-danger');
                        $data['email_err'] = 'Please enter a email';
                    }else if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                        flash('email_err','Please enter a valid email in forgot password section','alert alert-danger');
                        $data['email_err'] = 'Enter a valid Email';
                    }else if(empty($this->userModel->getUserDetailsByEmail($data['email']))){
                        flash('email_err','No user found to change the password','alert alert-danger');
                        $data['email_err'] = 'No user found';
                    }
                    $user=$this->userModel->getUserDetailsByEmail($data['email']);
                    //Make sure errors are empty
                    if(empty($data['email_err'])){
                        //Validated
                        $date = date('U', strtotime('+10 minutes', strtotime(date('Y-m-d H:i:s')))); //10 minutes from now{date('U') gives the time stamp}
                            //Send email
                            $mail = new PHPMailer(true);
                            try{
                                $to=$data['email'];
                                $sender='audexlk@gmail.com';
                                $mail_subject='Verify Email Address to change password';
                                $mail->isSMTP();
                                $mail->Host = 'smtp.gmail.com';
                                $mail->SMTPAuth = true;
                                $mail->Username = $sender;
                                $mail->Password = EMAIL_PASS;
                                $mail->SMTPSecure = 'ssl';
                                $mail->Port = 465;
                                $mail->setFrom($sender);
                                $mail->addAddress($to);
                                $mail->isHTML(true);
                                $email_body='<p>Dear '.$user->first_name.',<br>In order to change your password, you need to validate your account.'; 
                                $email_body.=' To validate your account <b><a href="'.URLROOT.'/users/forgot_password/'.$user->user_id.'/' . $date.'/'.$user->password.'">Click here</a>.<br>';
                                $email_body.='Thank you,<br>Audexlk</p>';
                                // $header="From:{$sender}\r\nContent-Type:text/html;";
                                
                                $mail->Subject = $mail_subject;
                                $mail->Body = $email_body;
                                // if($mail->send()){
                                    $mail->send();
                                    flash('email_message','Email sent to change password');
                                    //Otp send by email
                                    redirect('users/login');
                                // }
                                // else{
                                //     flash('email_message','Email not sent','alert alert-danger');
                                //     $this->view('users/login');
                                // }
                            } catch (Exception $e) {
                                flash('email_err','Mail could not be sent. Error: '. $e->getMessage(),'alert alert-danger');
                                $this->view('users/login');

                            // echo 'Message could not be sent. Error: ', $e->getMessage();
                            }
                        
                    }else{
                        //Load view with errors
                        redirect('users/login');
                    }
                }
            }

            public function forgot_password($id,$time,$password){
                if($time<date('U')){
                    flash('email_message','Link expired','alert alert-danger');
                    redirect('users/login');
                }
                $user=$this->userModel->getUserDetails($id);
                if(empty($user->email)){
                    flash('email_message','No user found','alert alert-danger');
                    redirect('users/login');
                }
                if($user->password!=$password){
                    flash('email_message','Wrong user','alert alert-danger');
                    redirect('users/login');
                }
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    // Process form
                    //Sanitize POST data
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    //init data
                    $data = [
                        'id' => $id,
                        'time' => $time,
                        'password' => $password,
                        'new_password' => trim($_POST['new_password']),
                        'confirm_passwd' => trim($_POST['newc_password']),
                        'password_err' => '',
                        'new_password_err' => '',
                        'confirm_password_err' => ''
                    ];
                    $data['new_hashed_password'] = password_hash($data['new_password'], PASSWORD_DEFAULT);
                    
                    //Validate new password
                    if(empty($data['new_password'])){
                        $data['new_password_err'] = 'Please enter new password';
                    }else if(strlen($data['new_password']) < 6){
                        $data['new_password_err'] = 'Password must be at least 6 characters';
                    }else if(password_verify($data['new_password'], $user->password)){
                        $data['new_password_err'] = 'New password must be different from current password';
                    }
                    // if(!preg_match("#[0-9]+#",$data['new_password'])) {
                    //     $data['password_err3'] = 'Password must contain at least 1 number!';
                    // }if(!preg_match("#[A-Z]+#",$data['new_password'])) {
                    //     $data['password_err4'] = 'Password must contain at least 1 capital letter!';
                    // }if(!preg_match("#[a-z]+#",$data['new_password'])) {
                    //     $data['password_err5'] = 'Password must contain at least 1 lowercase letter!';
                    /* }if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=!_+¬-]/', $data['new_password'])) {*/
                    //     $data['password_err6'] = 'Password must contain at least 1 special character!';
                    // }

                    if(empty($data['confirm_passwd'])){
                        $data['confirm_password_err'] = 'Please confirm the password';
                    }else if($data['new_password'] != $data['confirm_passwd']){
                        $data['confirm_password_err'] = 'Passwords do not match';
                    }
                    //Make sure errors are empty
                    if(empty($data['confirm_password_err']) && empty($data['new_password_err']) && empty($data['password_err3']) && empty($data['password_err4']) && empty($data['password_err5']) && empty($data['password_err6'])){
                        //Validated
                        if($this->userModel->updatePassword($data['new_hashed_password'],$id)){
                            flash('password_message', 'Password updated successfully');
                            redirect('users/login');
                        }
                        else{
                            flash('password_message', 'Password change unsuccessful', 'alert alert-danger');
                            redirect('users/login');
                        }
                        
                    }else{
                        //Load view with errors
                        $this->view('users/forgot_password',$data);
                    }
                }else{
                    $data = [
                        'id' => $id,
                        'time' => $time,
                        'password' => $password,
                        'new_password' => '',
                        'confirm_passwd' => '',
                        'new_password_err' => '',
                        'confirm_password_err' => '',
                        'user' => $user
                    ];
                    $this->view('users/forgot_password',$data);
                    
                }

            }
            

            public function change_password($id){
                if(isset($_SESSION['attempt'])){
                    unset($_SESSION['otp_email']);
                    unset($_SESSION['phone']);
                    unset($_SESSION['attempt']);
                    unset($_SESSION['time']);
                }
                $user=$this->userModel->getUserDetails($id);
                if(empty($user->email)){
                    redirect('users/index');
                }
                if(!isLoggedIn()){
                    $_SESSION['url'] = URL();
                    redirect('users/login');
                }else 
                if($_SESSION['user_email'] != $user->email){
                    redirect($_SESSION['user_type'].'s/getProfile/'.$id);
                }
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    // Process form
                    //Sanitize POST data
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    //init data
                    $data = [
                        'id' => $id,
                        'password' => trim($_POST['password']),
                        'new_password' => trim($_POST['new_password']),
                        'confirm_passwd' => trim($_POST['newc_password']),
                        'password_err' => '',
                        'new_password_err' => '',
                        'confirm_password_err' => ''
                    ];
                    $data['hashed_password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                    $data['new_hashed_password'] = password_hash($data['new_password'], PASSWORD_DEFAULT);
                    //Validate password
                    if(empty($data['password'])){
                        $data['password_err'] = 'Please enter current password';
                    }else if(!password_verify($data['password'], $user->password)  ){
                        $data['password_err'] = 'Incorrect current password';
                    }
                    //Validate new password
                    if(empty($data['new_password'])){
                        $data['new_password_err'] = 'Please enter new password';
                    }else if(strlen($data['new_password']) < 6){
                        $data['new_password_err'] = 'Password must be at least 6 characters';
                    }else if(password_verify($data['new_password'], $user->password)){
                        $data['new_password_err'] = 'New password must be different from current password';
                    }
                    // if(!preg_match("#[0-9]+#",$data['new_password'])) {
                    //     $data['password_err3'] = 'Password must contain at least 1 number!';
                    // }if(!preg_match("#[A-Z]+#",$data['new_password'])) {
                    //     $data['password_err4'] = 'Password must contain at least 1 capital letter!';
                    // }if(!preg_match("#[a-z]+#",$data['new_password'])) {
                    //     $data['password_err5'] = 'Password must contain at least 1 lowercase letter!';
                    /* }if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=!_+¬-]/', $data['new_password'])) {*/
                    //     $data['password_err6'] = 'Password must contain at least 1 special character!';
                    // }

                    if(empty($data['confirm_passwd'])){
                        $data['confirm_password_err'] = 'Please confirm the password';
                    }else if($data['new_password'] != $data['confirm_passwd']){
                        $data['confirm_password_err'] = 'Passwords do not match';
                    }
                    //Make sure errors are empty
                    if(empty($data['confirm_password_err']) && empty($data['new_password_err']) && empty($data['password_err']) && empty($data['password_err3']) && empty($data['password_err4']) && empty($data['password_err5']) && empty($data['password_err6'])){
                        //Validated
                        if($this->userModel->updatePassword($data['new_hashed_password'],$id)){
                            flash('password_message', 'Password updated successfully');
                            redirect($_SESSION['user_type'].'s/getProfile/'.$id);
                        }
                        else{
                            flash('password_message', 'Password change unsuccessful', 'alert alert-danger');
                            redirect($_SESSION['user_type'].'s/getProfile/'.$id);
                        }
                        
                    }else{
                        //Load view with errors
                        $this->view('users/change_password',$data);
                    }
                }else{
                    $data = [
                        'id' => $id,
                        'password' => '',
                        'new_password' => '',
                        'confirm_passwd' => '',
                        'password_err' => '',
                        'new_password_err' => '',
                        'confirm_password_err' => '',
                        'user' => $user
                    ];
                    $this->view('users/change_password',$data);
                    
                }
            }

          public function edit_profile_picture($id){
            if(isset($_SESSION['attempt'])){
                unset($_SESSION['otp_email']);
                unset($_SESSION['phone']);
                unset($_SESSION['attempt']);
                unset($_SESSION['time']);
            }
            $user=$this->userModel->getUserDetails($id);
            if(!isLoggedIn()){
                $_SESSION['url'] = URL();
                redirect('users/login');
            }else if($_SESSION['user_email'] != $user->email){
                redirect('users/index');
            }
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data =[
                    'id' => $id,
                    'image1' => '',
                    'image1_err' => ''
                ];

                //Image 1
                if(!empty($_FILES['image1']['name'])){
                    $img_name = $_FILES['image1']['name'];
                    $img_size = $_FILES['image1']['size'];
                    $tmp_name = $_FILES['image1']['tmp_name'];
                    $error = $_FILES['image1']['error'];

                    if($error === 0){
                        if($img_size > 12500000){
                            $data['image1_err'] = "Sorry, your image is too large.";
                        }
                        else{
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); //Extension type of image(jpg,png)
                            $img_ex_lc = strtolower($img_ex);

                            $allowed_exs = array("jpg", "jpeg", "png"); 

                            if(in_array($img_ex_lc, $allowed_exs)){
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = dirname(APPROOT).'/public/uploads/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                                $data['image1'] = $new_img_name;

                                // //Insert into database
                                // if($this->sellerModel->addAdvertisement($data)){
                                //     flash('post_message', 'Advertisement Added');
                                //     redirect('sellers/advertisements');
                                // }
                                // else{
                                //     die('Something went wrong');
                                // }
                            }
                            else{
                                $data['image1_err'] = "You can't upload files of this type";
                            }
                        }
                    }
                    else{
                        $data['image1_err'] = "Unknown error occurred!";
                    }
                }else{
                    $data['image1_err'] = 'Please upload an image';
                }
                if(empty($data['image1_err'])){
                    if($this->userModel->updateProfilePicture($data)){
                        flash('post_message', 'Profile Picture Updated');
                        // redirect($_SESSION['user_type'].'s/getProfile/'.$data['id']);
                        echo json_encode(['success' => 'Profile Picture Updated']);
                    }
                    else{
                        die('Something went wrong');
                    }
                }
                else{
                    flash('photo_message', $data['image1_err'],'alert alert-danger');
                    echo json_encode(['unsuccess' => 'Profile Picture not Updated']);
                    // redirect($_SESSION['user_type'].'s/getProfile/'.$data['id']);
                }   
          }
        //Logout
        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_type']);
            unset($_SESSION['time']);
            session_destroy();
            redirect('users/login');
        }
        //Shop
        public function shop($arg1=NULL){
            if(isset($_SESSION['attempt'])){
                unset($_SESSION['otp_email']);
                unset($_SESSION['phone']);
                unset($_SESSION['attempt']);
                unset($_SESSION['time']);
            }
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // this is come from filter form

                $data = [
                    'category' => '1',
                    'price-min' => '',
                    'price-max' => '',
                    'type' => '1',
                    'searchResults' => '',
                    'searchTerm' => '',
                    'isEmptySearchResults' => 1,
                    'isEmptySearchTerm' => 1,
    
                ];

                $productCategory = $_POST['category'];
                $productPriceMin = $_POST['price-min'];
                $productPriceMax = $_POST['price-max'];
                $productType = $_POST['type'];

                // echo $productCategory;
                // echo $productPriceMax;
                // echo $productPriceMin;
                // echo $productType;

                // exit();

                $Filter=[];

                if( empty(trim($productCategory)) and empty(trim($productPriceMin)) and empty(trim($productPriceMax)) and empty(trim($productType))) 
                {
                    // if all filters are empty, then redirect to shop page
                    // redirect('users/shop');
                    echo json_encode($data = []);
                }
                // all filters cant be empty
                if(!empty(trim($productCategory))){
                    $Filter['product_category']=$productCategory;
                    $data['category'] = $productCategory;
                }
                if(!empty(trim($productPriceMin))){
                    $Filter['min_price']=(int) $productPriceMin;
                    $data['price-min'] = $productPriceMin;
                }
                if(!empty(trim($productPriceMax))){
                    $Filter['max_price']=(int) $productPriceMax;
                    $data['price-max'] = $productPriceMax;
                }
                if(!empty(trim($productType))){
                    $Filter['product_type']= $productType;
                    $data['type'] = $productType;
                }
                $results = $this-> userModel->searchAndFilterItems($Filter);

                $data['ads'] = $results;
                // print_r($data['ads']);
                // exit;

                $i=0;
                foreach($results as $ad):
                    
                    if($ad->product_type=='auction'){
                        $auction = $this->userModel->getAuctionById($ad->product_id);
                        if($auction!='Error'){
                            $data['auction'][$i] = $auction;
                            if($auction->end_date < date("Y-m-d H:i:s") ){
                                $abc=$this->bid_expired($ad->product_id,$auction->auction_id);
                                // redirect('users/bid_expired/'.$ad->product_id.'/'.$auction->auction_id);
                            }
                        }else{
                            unset($data['ads'][$i]);
                        }
                    }
                    $i++;
                endforeach;

                echo json_encode($data);

                // $this->view('users/shop',$data);
            }
            else{

                // one argument have provide
                // this is called by links in the index page
                if(isset($arg1)){
                    $ads  = $this->userModel->getAdvertiesmentByCategory($arg1);   
                }
                else{
                    $ads  = $this->userModel->getAdvertiesment();   
                }

                // get the serchResults session value
                // print_r($_SESSION);
                // exit();
                $searchResults = '';
                $searchTerm = '';
    
                if(isset($_SESSION['searchResults'])):
                    $searchResults = $_SESSION['searchResults'];
                endif;
                if(isset($_SESSION['searchTerm'])):
                    $searchTerm = $_SESSION['searchTerm'];
                endif;
                
    
                // check serch results are empty(1) or not empty(0)\
                if( empty($searchResults) ){
                    $emptySearchResults = '1';
                }
                else{
                    $emptySearchResults = '0';
                }
                // check serch term is empty(1) or not empty(0)\
                if( empty($searchTerm) ){
                    $emptySearchTerm = '1';
                }
                else{
                    $emptySearchTerm = '0';
                }
    
    
                $data = [
                    'ads' => $ads,
                    'searchResults' => $searchResults,
                    'searchTerm' => $searchTerm,
                    'isEmptySearchResults' => $emptySearchResults,
                    'isEmptySearchTerm' => $emptySearchTerm,
                    'category' => '1',
                    'price-min' => '',
                    'price-max' => '',
                    'type' => '1',
    
                ];
                // if $arg1 is set then change the product category to $arg1
                if(isset($arg1)){
                    $data['category'] = $arg1;
                }

                // print_r($data);
                // exit;
    
                $i=0;
                foreach($ads as $ad):
                    
                    if($ad->product_type=='auction'){
                        $auction = $this->userModel->getAuctionById($ad->product_id);
                        if($auction!='Error'){
                            $data['auction'][$i] = $auction;
                            if($auction->end_date < date("Y-m-d H:i:s") ){
                                $abc=$this->bid_expired($ad->product_id,$auction->auction_id);
                                // redirect('users/bid_expired/'.$ad->product_id.'/'.$auction->auction_id);
                            }
                        }else{
                            unset($data['ads'][$i]);
                        }
                    }
                    $i++;
                endforeach;
                $this->view('users/shop',$data);
                
                unset($_SESSION['searchResults']);
                unset($_SESSION['searchTerm']);
            }



        }

        public function advertiesmentDetails($id)
        {

            $_SESSION['product_id'] = $id;

            $ad = $this->userModel->getAdvertiesmentById($id);
            $likeCount = $this->userModel->checkLikeCount($id);
            $dislikeCount = $this->userModel->checkDislikeCount($id);




            // seller details
            $sellerDetails = $this->userModel->getSellerDetails($ad->email);
            $SellerMoreDetails = $this->userModel->getSellerMoreDetails($ad->email);
            $sellerRegDate = $SellerMoreDetails->registered_date;
            settype($sellerRegDate, 'string');
            $sellerRegDate = substr($sellerRegDate,0,10);

            $data = [
                'ad' => $ad,
                'likedCount' => $likeCount,
                'dislikedCount' => $dislikeCount,
                'seller' => $sellerDetails,
                'SellerMoreDetails' => $SellerMoreDetails,
                'sellerRegDate' => $sellerRegDate,
                'liked' => '',
                'disliked' => '',
                'watched' => '',
                'loadFeedback' =>'',
                'loadRate' =>'',
            ];

            
            //CHeck if loggedIn
            if(isLoggedIn()){
                // check alredy liked or not
                $liked = $this->userModel->checkAddedLike($id,$_SESSION['user_id']);
                $disliked = $this->userModel->checkAddedDislike($id,$_SESSION['user_id']);

                $loadRate = $this->userModel->checkAddedRate($_SESSION['user_id'],$ad->email);
                
                $loadFeedback = $this->userModel->checkAddedReview($_SESSION['user_id'],$ad->email);
                $data['loadFeedback'] = $loadFeedback;
                $data['loadRate'] = $loadRate;

                $itemWatched = $this->userModel->checkIsItemWatched($id,$_SESSION['user_id']);
                if( empty($itemWatched) ){
                    // Item is not in watch list
                    $data['watched'] = 'notwatched';
                }
                else{
                    $data['watched'] = 'watched';
                }
            // echo $data['watched'];

                if(empty($liked) && empty($disliked)){
                    // not liked and not disliked
                    $data['liked'] = 'notliked';
                    $data['disliked'] = 'notdisliked';
                } 
                else if(!empty($liked) ){
                    $data['liked'] = 'liked';
                    $data['disliked'] = 'notdisliked';
                }
                else if(!empty($disliked) ){
                    $data['liked'] = 'notliked';
                    $data['disliked'] = 'disliked';
                }
            }
            else{
                // not loggedin
                $data['liked'] = 'notliked';
                $data['disliked'] = 'notdisliked';
            }   
            if(isLoggedIn()){
                if($SellerMoreDetails->email!=$_SESSION['user_email']){
                    if($this->userModel->checkViewCount($id,$_SESSION['user_email'])==false){
                        if($this->userModel->update_view_count($id)){
                            $this->userModel->addViewDetails($id,$_SESSION['user_email']);
                        }else{
                            die('Error');
                        }

                    }
                }

            }

            $this->view('users/advertiesmentDetails',$data);
          
        }
        public function auction($id)
        {
            $_SESSION['product_id'] = $id;
            $likeCount = $this->userModel->checkLikeCount($id);
            $dislikeCount = $this->userModel->checkDislikeCount($id);


            $ad = $this->userModel->getAdvertiesmentById($id);


            // seller details
            $sellerDetails = $this->userModel->getSellerDetails($ad->email);
            $SellerMoreDetails = $this->userModel->getSellerMoreDetails($ad->email);
            $sellerRegDate = $SellerMoreDetails->registered_date;
            settype($sellerRegDate, 'string');
            $sellerRegDate = substr($sellerRegDate,0,10);

            $data = [
                'ad' => $ad,
                'likedCount' => $likeCount,
                'dislikedCount' => $dislikeCount,
                'seller' => $sellerDetails,
                'SellerMoreDetails' => $SellerMoreDetails,
                'sellerRegDate' => $sellerRegDate,
                'liked' => '',
                'disliked' => '',
                'watched' => '',
                'loadFeedback' =>'',
                'loadRate' =>'',
            ];

            
            //CHeck if loggedIn
            if(isLoggedIn()){
                // check alredy liked or not
                $liked = $this->userModel->checkAddedLike($id,$_SESSION['user_id']);
                $disliked = $this->userModel->checkAddedDislike($id,$_SESSION['user_id']);

                $loadRate = $this->userModel->checkAddedRate($_SESSION['user_id'],$ad->email);
                $loadFeedback = $this->userModel->checkAddedReview($_SESSION['user_id'],$ad->email);
                $data['loadFeedback'] = $loadFeedback;
                $data['loadRate'] = $loadRate;

                $itemWatched = $this->userModel->checkIsItemWatched($id,$_SESSION['user_id']);
                if( empty($itemWatched) ){
                    // Item is not in watch list
                    $data['watched'] = 'notwatched';
                }
                else{
                    $data['watched'] = 'watched';
                }
            // echo $data['watched'];

                if(empty($liked) && empty($disliked)){
                    // not liked and not disliked
                    $data['liked'] = 'notliked';
                    $data['disliked'] = 'notdisliked';
                } 
                else if(!empty($liked) ){
                    $data['liked'] = 'liked';
                    $data['disliked'] = 'notdisliked';
                }
                else if(!empty($disliked) ){
                    $data['liked'] = 'notliked';
                    $data['disliked'] = 'disliked';
                }
            }
            else{
                // not loggedin
                $data['liked'] = 'notliked';
                $data['disliked'] = 'notdisliked';
            }
          
          $auction = $this->userModel->getAuctionById($id);
          $data['auction'] = $auction;

          if(isLoggedIn()){
              if($SellerMoreDetails->email!=$_SESSION['user_email']){
                if($this->userModel->update_view_count($id)){
    
                }else{
                    die('Error');
                }
    
              }

          }
          $this->view('users/auction',$data);

        }



        public function bid($id){
          $buyerDetails = $this->userModel->getUserDetailsByEmail($_SESSION['user_email']);
          $ad = $this->userModel->getAdvertiesmentById($id);
          $data['ad'] = $ad;
          $SellerMoreDetails = $this->userModel->getSellerMoreDetails($ad->email);
          $data['SellerMoreDetails'] = $SellerMoreDetails;

          $i=0;

          $auction = $this->userModel->getAuctionById($id);
          if($auction=='Error'){
            flash('auction_error','Auction is not available','alert alert-danger');
            redirect('users/shop');
          }
          $data['auction'] = $auction;
          
          $auction_details = $this -> userModel->getAllAuctionDetails($id);
          if($auction_details){
            $data['auctions'] =$auction_details;
            foreach($data['auctions'] as $auction){
                $data['user'][$i] = $this->userModel->findUserDetailsByEmail($auction->email_buyer);
                $i++;
            }
            // endforeach;
          }else{
            $data['auctions'] = null;
          }
          $data['auction_expired']=$data['auction']->is_finished;
        //   $this->view('users/bid',$data);

        
        //CHECK FOR POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //CHeck if loggedIn
            if(!isLoggedIn()){
                $_SESSION['URL'] =URL();
                redirect('users/login');
            }else if($buyerDetails->phone_number==NULL || $buyerDetails->phone_number=='' || $buyerDetails->phone_number==0 || empty($buyerDetails->phone_number) || $buyerDetails->phone_number==null){
                flash('phone_number_error','Please add your phone number before bid.<a href="'.URLROOT.'/users/change_phone/'.$buyerDetails->user_id.'">Click Here</a>','alert alert-danger');
                $data['phone_err']='Please add your phone number before bid.';
                // redirect('users/bid/'.$id);
            }

            // Process form
            //Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            //Init data
            $data['price'] =trim($_POST['price']);
            
            //Validate price
            if(empty($data['price'])){
                $data['price_err1'] = 'Please enter price';
            }else if(!is_numeric($data['price'])) {
                $data['price_err'] = 'Please enter valid price';
            }else if($data['price']<0){
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
            
            if(empty($data['price_err1']) && empty($data['price_err2']) && empty($data['price_err3']) && empty($data['price_err4']) && empty($data['price_err5']) && empty($data['phone_err'])){
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
                return true;
                // redirect('users/shop');

            }else{
                return false;
                // die('Something went wrong');
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


        // public function watchlist(){
        //     if(!isLoggedIn()){
        //       $_SESSION['url']=URL();
        //       redirect('users/login');
        //     }

        //     $products = $this->userModel->getBuyerWatchProducts($_SESSION['user_email']);
        //     $serviceProviders = $this->userModel->getBuyerWatchServiceProviders($_SESSION['user_email']);
        //     $data =[
        //       'products' => $products,
        //       'serviceProviders' => $serviceProviders,
        //     ];
        //     $this->view('users/watchlist',$data);
      
        // }
      
      
        //   public function addToWatchList($p_id,$u_id){
        //     if(!isLoggedIn()){
        //       $_SESSION['url']=URL();

        //       redirect('users/login');
        //     }
        //     echo $_POST['user_id'];
        //     if($_POST['user_id'] == 0){
        //       redirect('users/login');
        //     }
        //     else{
        //       if (isset($_POST['add'])){
        //         $result = $this-> userModel->addItemToWatchList($p_id, $u_id);
        //         if($result){
        //           echo flash('register_success', 'You are registered and can log in');
        //         }
        //         else{
        //           die('Something went wrong');
        //         }
        
        //       }
        //     }
        //   }
        //   public function addServiceProviderToWatchList(){
        //     if(!isLoggedIn()){
        //       $_SESSION['url']=URL();

        //       redirect('users/login');
        //     }
        //     // echo $_POST['user_id'];

        //     if($_POST['user_id'] == 0){
        //       redirect('users/login');
        //     }
        //     else{
        //         $buyerId = $_POST['user_id'];
        //         $serviceProviderId = $_POST['service_provider_id'];

        //         // echo $buyerId;
        //         // echo $serviceProviderId;

        //         if (isset($_POST['add'])){
        //             // check weather service provider is alredy in watch list or not
        //             $result1 = $this->userModel->checkIsServiceProviderWatched($buyerId,$serviceProviderId);

        //             if (empty($result1)) {
        //                 $addToList = $this->userModel->addServiceProviderToWatchList($buyerId,$serviceProviderId);
        //                 if ($addToList) {
        //                     echo json_encode(['message' => 'Added to the list']);
        //                 } else {
        //                     echo json_encode(['message' => 'Some thing went wrong']);
        //                 }
        //             }
        //             else
        //             {
        //                 // if service provider is alredy in list then nothig to do
        //                 echo json_encode(['message' => 'Alredy in the list']);
        //             }
        //         }
        //     }
        //   }

        // //   this function calls from asvertiesment details page
        //   public function removeItemFromWatchList($p_id,$u_id){
        //     if(!isLoggedIn()){
        //       $_SESSION['url']=URL();

        //       redirect('users/login');
        //     }
        //     echo $_POST['user_id'];
        //     if($_POST['user_id'] == 0){
        //       redirect('users/login');
        //     }
        //     else{
        //       if (isset($_POST['remove'])){
              
        //         $result = $this-> userModel->removeItemFromWatchList($p_id, $u_id);
        //         if($result){
        //           echo flash('register_success', 'You are registered and can log in');
        //         }
        //         else{
        //           die('Something went wrong');
        //         }
        
        //       }
        //     }
        //   }
        
        //     //this function calls from watch list page in buyer profile which is linked to removeSingleServiceProvider.js
        //     //also this function will call from service provider profile page(serviceProviderPublic) which is linked to service-provider-watchlist.js
        //   public function removeServiceProviderFromWatchList(){
        //     if(!isLoggedIn()){
        //       $_SESSION['url']=URL();

        //       redirect('users/login');
        //     }
            
        //     if($_POST['user_id'] == 0){
        //       redirect('users/login');
        //     }
        //     else{
        //         $buyerId = $_POST['user_id'];
        //         $serviceProviderId = $_POST['service_provider_id'];

        //         if (isset($_POST['remove'])){

        //             $result = $this-> userModel->removeServiceProviderFromWatchList($buyerId, $serviceProviderId);
                    
        //             if($result){
        //                 if ($result) {
        //                     echo json_encode(['message' => 'Removed from list']);
        //                 } 
        //                 // else {
        //                 //     echo json_encode(['message' => 'Some thing went wrong']);
        //                 // }
        //             }
        //             else{
        //                 echo json_encode(['message' => 'Something went wrong']);
        //                 die('Something went wrong');
        //         }
        
        //       }
        //     }
        //   }
      
        // //   this function calls from watch list page in buyer profile
        //   public function removeOneItemFromWatchList($p_id,$u_id){
        //     if(!isLoggedIn()){
        //       $_SESSION['url']=URL();

        //       redirect('users/login');
        //     }
        //     echo $_POST['user_id'];
        //     if($_POST['user_id'] == 0){
                
        //       redirect('users/login');
        //     }
        //     else{
        //       if (isset($_POST['remove'])){
        //       echo "This Works";
        //         $result = $this-> userModel->removeOneItemFromWatchList($p_id, $u_id);
        //         if($result){
        //           echo flash('register_success', 'You are registered and can log in');
        //         }
        //         else{
        //           die('Something went wrong');
        //         }
        
        //       }
        //     }
        //   }
      
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
            if(isset($_SESSION['attempt'])){
                unset($_SESSION['otp_email']);
                unset($_SESSION['attempt']);
                unset($_SESSION['time']);
            }
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
        
        
        public function approve_reject_bid($product_id,$bid_id,$time){
            if(time() < $time){
                $advertisement=$this->userModel->getAdvertisementById($product_id);
                $sellerDetails = $this->userModel->getSellerDetails($advertisement->email);
                $SellerMoreDetails = $this->userModel->getSellerMoreDetails($advertisement->email);
                $sellerRegDate = $SellerMoreDetails->registered_date;
                settype($sellerRegDate, 'string');
                $sellerRegDate = substr($sellerRegDate,0,10);
    
                if($advertisement){
                    $data['advertisement'] = $advertisement;
                }
                else{
                    die('Something went wrong');
                }
                $data = [
                    'advertisement' => $advertisement,
                    'seller' => $sellerDetails,
                    'SellerMoreDetails' => $SellerMoreDetails,
                    'sellerRegDate' => $sellerRegDate,
                    'liked' => '',
                    'disliked' => '',
                    'watched' => '',
                    'loadFeedback' =>'',
                    'loadRate' =>'',
                ];
                $auction = $this->userModel->getAuctionById_withfinished($product_id);
                if($auction){
                    $data['auction'] = $auction;
                }
                else{
                    die('Something went wrong');
                }
                $bid = $this->userModel->getBidList($bid_id);
                if($bid){
                    $data['bid'] = $bid;
                }
                else{
                    die('Something went wrong');
                }
                
                if(isLoggedIn()){
                    if($bid->email_buyer!=$_SESSION['user_email']){
                        unset($_SESSION['user_id']);
                        unset($_SESSION['user_email']);
                        unset($_SESSION['user_name']);
                        unset($_SESSION['user_type']);
                        // session_destroy();
                        $_SESSION['url']=URL();
                        redirect('users/login');
                    }
                    else{
                        if($bid->is_accepted==0 && $bid->is_rejected==0){

                            $this->view('users/aprove_reject_bid',$data);
                        }else{
                            redirect('users/index');
                        }
                    }

                }else{
                    $_SESSION['url']=URL();
                    redirect('users/login');
                }

            }else{
                $this->userModel->updateBidStatus($bid_id);
                redirect('pages/index');
            }
        } 
        
        public function accept_bid($email,$product_id,$bid_id,$price){
                $data=[
                    'email'=>$email,
                    'product_id'=>$product_id,
                    'bid_id'=>$bid_id,
                    'price'=>$price
                ];
                $user=$this->userModel->getUserDetailsByEmail($email);
                if($user){
                    $data['user'] = $user;
                    //Send email
                    $mail = new PHPMailer(true);
                    try{
                        $to=$data['email'];
                        $sender='audexlk@gmail.com';
                        $mail_subject='Your offer for bid has been accepted';
                        $email_body='<p>Dear '.$data['user']->first_name.',<br><br>';
                        $email_body.='Your request send to accept the bid has been accepted for the product you have published.To visit the product click <a href="'.URLROOT.'/sellers/bid_list/'.$data['product_id'].'">here</a><br><br>';
                        $email_body.='Thank you,<br>Audexlk</p>';
                        // $header="From:{$sender}\r\nContent-Type:text/html;";
                        
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
                        // if($mail->send()){
                            $mail->send();
                            $result = $this->userModel->updateBidAcceptedStatus($bid_id,$price);
                            if($result){
                                flash('auction_message', 'Offer Accepted');
                                redirect('users/index');
                            }
                            else{
                                flash('auction_message', 'Something went wrong,try again later','alert alert-danger');
                            }
                        // }
                        // else{
                        //     flash('email_err','Email not sent');
                        //     $this->view('users/index');
                        // }
                    } catch (Exception $e) {
                        flash('email_err','Mail could not be sent. Error: '. $e->getMessage(),'alert alert-danger');
                        $this->view('users/index');


                    // echo 'Message could not be sent. Error: ', $e->getMessage();
                    }
                }
                else{
                    die('Something went wrong');
                }
            
        }

        public function reject_bid($email,$product_id,$bid_id,$price){
                $data=[
                    'email'=>$email,
                    'product_id'=>$product_id,
                    'bid_id'=>$bid_id,
                    'price'=>$price
                ];
                $user=$this->userModel->getUserDetailsByEmail($email);
                if($user){
                    $data['user'] = $user;
                    //Send email
                    $mail = new PHPMailer(true);
                    try{
                        $to=$data['email'];
                        $sender='audexlk@gmail.com';
                        $mail_subject='Your offer for bid has been rejected';
                        $email_body='<p>Dear '.$data['user']->first_name.',<br><br>';
                        $email_body.='Your request send to accept the bid has been rejected for the product you have published.To visit the product click <a href="'.URLROOT.'/sellers/bid_list/'.$data['product_id'].'">here</a><br><br>';
                        $email_body.='Thank you,<br>Audexlk</p>';
                        // $header="From:{$sender}\r\nContent-Type:text/html;";
                        
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
                        // if($mail->send()){
                            $mail->send();
                            $result = $this->userModel->updateBidStatus($bid_id,$price);
                            if($result){
                                flash('auction_message', 'Offer Rejected');
                                redirect('users/index');
                            }
                            else{
                                flash('auction_message', 'Something went wrong,try again','alert alert-danger');
                            }
                        // }
                        // else{
                        //     flash('email_err','Email not sent');
                        //     $this->view('users/index');
                        // }
                    } catch (Exception $e) {
                        flash('email_err','Mail could not be sent. Error: '. $e->getMessage(),'alert alert-danger');
                        redirect('users/index');

                    // echo 'Message could not be sent. Error: ', $e->getMessage();
                    }
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
                $_SESSION['searchTerm'] = $searchedTerm;
                $_SESSION['searchResults'] = $results;
                // echo $_SESSION['searchResults'];
                echo json_encode($results);
              }
      
            }
      
        }
        public function shopFilter(){
            // $productCategory = $_POST['category'];
            $categories = isset($_POST['category']) ? $_POST['category'] : [];

            $productPriceMin = $_POST['price-min'];
            $productPriceMax = $_POST['price-max'];
            $productType = $_POST['type'];

            // echo $productCategory;
            // echo $categories;
            // echo $productPriceMax;
            // echo $productPriceMin;
            // echo $productType;

            // exit();

            $Filter=[];
            $results = [];

            if( empty($categories) and empty(trim($productPriceMin)) and empty(trim($productPriceMax)) and empty(trim($productType))) 
            {
                // if all filters are empty
                // redirect('users/shop');
                $results = [];
                echo json_encode(['message' => 'No filters','results'=>$results]);
            }
            else{
                // if(!empty(trim($categories))){
                //     $Filter['product_category']=$categories;
                // }
                if(!empty(trim($productPriceMin))){
                    $Filter['min_price']=(int) $productPriceMin;
                }
                if(!empty(trim($productPriceMax))){
                    $Filter['max_price']=(int) $productPriceMax;
                }
                if(!empty(trim($productType))){
                   $Filter['product_type']= $productType;
                }
                $results = $this-> userModel->searchAndFilterItems($Filter,$categories);            
                echo json_encode(['message' => 'filters','results'=>$results]);
            }

        }

        // public function shopSearchItems(){
        //     $searchedTerm = $_POST['search-item'];

            
        //     if( !isset($_POST['submit']) ){
        //       // this is for keyup event
        //       if( strlen($searchedTerm) <3 ){
        //         echo json_encode([]);
        //       }else{
        //         $results = $this-> userModel->searchItems($searchedTerm);
        //         echo json_encode($results);
        //       }
        //     }
        //     else{
        //         // user has pressed enter
                
        //         $productCategory = $_POST['category'];
        //         $productPriceMin = $_POST['price-min'];
        //         $productPriceMax = $_POST['price-max'];
        //         $productType = $_POST['type'];

        //         $Filter=[];

        //         if( empty(trim($searchedTerm)) and empty(trim($productCategory)) and empty(trim($productPriceMin)) and empty(trim($productPriceMax)) and empty(trim($productType))) 
        //         {
        //             // if all filters are empty
        //             echo json_encode($results = []);
        //         }
        //         else if( empty(trim($searchedTerm)) )
        //         {
        //             // search term is empty and check if others are empty (all other filters cant be empty)
        //             if(!empty(trim($productCategory))){
        //                 $Filter['product_category']=$productCategory;
        //             }
        //             if(!empty(trim($productPriceMin))){
        //                 $Filter['min_price']=(int) $productPriceMin;
        //             }
        //             if(!empty(trim($productPriceMax))){
        //                 $Filter['max_price']=(int) $productPriceMax;
        //             }
        //             if(!empty(trim($productType))){
        //                 $Filter['product_type']= $productType;
        //             }
        //             $results = $this-> userModel->searchAndFilterItems($Filter);

        //             $_SESSION['searchTerm'] = $searchedTerm;
        //             // $_SESSION['searchResults'] = $results;
        //             // echo $_SESSION['searchResults'];
    
        //             echo json_encode($results);
        //         }
        //         else if( !empty(trim($searchedTerm)) )
        //         {
        //             // search term has set
        //             if( !empty(trim($searchedTerm)) and empty(trim($productCategory)) and empty(trim($productPriceMin)) and empty(trim($productPriceMax)) and empty(trim($productType))) 
        //             {
        //                 // if all filters are empty except search term
        //                 $results = $this-> userModel->searchItems($searchedTerm);
        //                 echo json_encode($results);
        //             }
        //             else{
        //                 // search term is not empty and some other fiters are set
        //                 if(!empty(trim($productCategory))){
        //                     $Filter['product_category']=$productCategory;
        //                 }
        //                 if(!empty(trim($productPriceMin))){
        //                     $Filter['min_price']=(int) $productPriceMin;
        //                 }
        //                 if(!empty(trim($productPriceMax))){
        //                     $Filter['max_price']=(int) $productPriceMax;
        //                 }
        //                 if(!empty(trim($productType))){
        //                     $Filter['product_type']= $productType;
        //                 }
        //                 $results = $this-> userModel->searchAndFilterItemsWithSearchTerm($Filter,$searchedTerm);
        //                 $_SESSION['searchTerm'] = $searchedTerm;
        //                 // $_SESSION['searchResults'] = $results;
        //                 // echo $_SESSION['searchResults'];
        
        //                 echo json_encode($results);
        //             }


        //         }

        //         // echo $searchedTerm;
        //         // echo $productCategory;
        //         // echo $productType;
        //         // echo $productPriceMax;
        //         // echo $productPriceMin;
      
        //     }
      
        // }
        public function serviceProviderPublic()
        {
            $id = $_GET['id'];

            // get user data from user table
            $user=$this->userModel->getUserDetails($id);

            // get data from service_provider_view table
            $d = $this->userModel->getServiceProvidersPublic($id);

            // get this service provider's events
            $events = $this->userModel->getServiceProviderEvents($id); 


            $data = [
                'details' => $d,
                'user' => $user,
                'events' => $events 
            ];

            if(isLoggedIn()){
                $ServiceProviderWatched = $this->userModel->checkIsServiceProviderWatched($_SESSION['user_id'],$id);
                if( empty($ServiceProviderWatched->email_buyer) ){
                    // Item is not in watch list
                    $data['watched'] = 'notwatched';
                }
                else{
                    $data['watched'] = 'watched';
                }
            }
            // print_r($data);
            // print_r($ServiceProviderWatched);
            // exit();

            $this->view('users/service_provider_public', $data);

        }
        // get the event dates according to selected event name
        // this is calling from fetch api in the service providers page 
        public function getEventDates(){

            $values = json_decode(file_get_contents('php://input'), true);

            $serviceProviderEmail = $values['serviceProviderEmail'];
            $eventName = $values['eventName'];

            // echo $serviceProviderEmail;
            // echo $eventName;

            $dates = $this->userModel->getEventDates($serviceProviderEmail, $eventName);

            $data = [
                'dates' => $dates
            ];
            // print_r($data);
            // print_r($ServiceProviderWatched);
            // exit();
            echo json_encode($data);
        }

        public function rateSeller(){

            $data = json_decode(file_get_contents('php://input'), true);

            $rating = $data['rating'] ?? 0;
            $email_rater = $data['email_rater'];
            $email_rate_receiver = $data['email_rate_receiver'];
            $review = $data['review'];

            $results2 = '';
            $results3 = '';
            // echo $rating;
            // echo $buyer_id;
            // echo $seller;
            $results1 = $this->userModel->checkAddedRate($email_rater, $email_rate_receiver);



            $date=date('Y-m-d H:i:s');
            if( empty($results1) ){
                $results2 = $this-> userModel->rateSeller($rating,$email_rater,$email_rate_receiver,$date,$review);
            }
            else{
                $results3 = $this->userModel->updateSellerRate($rating, $email_rater, $email_rate_receiver,$review,$date);
            }
            $results4 = $this->userModel->getRateReceiversFinalRate($email_rate_receiver);
            flash('rating_message', 'Rating added successfully');
            // ,'result1'=>$results1,'result2'=>$results2,'result3'=>$results3
           
            // print_r(['message' => 'Rating saved','results4'=>$results4,'result1'=>$results1,'result2'=>$results2,'result3'=>$results3]);
            // exit();
            echo json_encode(['message' => 'Rating saved','results4'=>$results4,'result1'=>$results1,'result2'=>$results2,'result3'=>$results3]);
            // echo json_encode(['message' => 'Rating saved','result1'=>$results1,'result2'=>$results2,'result3'=>$results3]);


        }

        public function rateServiceProvider(){

            $data = json_decode(file_get_contents('php://input'), true);

            $emailBuyer = $data['emai_rater'];
            $emailServiceProvider = $data['email_rate_receiver'];
            $eventName = $data['event'];
            $eventDate = $data['day'];
            $rate = $data['rating'] ?? 0;
            $review = $data['review'];

            $results2 = '';
            $results3 = '';
            // echo $rating;
            // echo $buyer_id;
            // echo $seller;
            $results1 = $this->userModel->checkAddedServiceProviderRate($emailBuyer, $emailServiceProvider, $eventName, $eventDate);

            $reviewedDay =date('Y-m-d H:i:s');

            if( empty($results1) ){
                $results2 = $this-> userModel->rateServiceProvider($emailBuyer, $emailServiceProvider, $eventName, $eventDate, $rate, $review, $reviewedDay);
            }
            else{
                $results3 = $this->userModel->updateServiceProviderRate($emailBuyer, $emailServiceProvider, $eventName, $eventDate, $rate, $review, $reviewedDay);
            }
            $results4 = $this->userModel->getRateReceiversFinalRate($emailServiceProvider);
            flash('rating_message', 'Rating added successfully');
            // ,'result1'=>$results1,'result2'=>$results2,'result3'=>$results3

            echo json_encode(['message' => 'Rating saved','results4'=>$results4,'result1'=>$results1,'result2'=>$results2,'result3'=>$results3]);
            // echo json_encode(['message' => 'Rating saved','result1'=>$results1,'result2'=>$results2,'result3'=>$results3]);


        }
        
        
            
        public function map_view(){
            $this->view('users/map_view');
        }

        public function chat($id=null){
            if(!isLoggedIn()){
                $_SESSION['url'] = URL();
                redirect('users/login');
            }

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // this is come from post method (fetch) form
                
                $data = json_decode(file_get_contents('php://input'), true);

                $message = $data['message'] ?? 0;
                $emai_sender = $data['sender_email'];
                $email_receiver = $data['receiver_email'];
               

                // $results2 = '';
                // $results3 = '';
                // echo $message;
                // echo $emai_sender;
                // echo $email_receiver;
                $date=date('Y-m-d H:i:s');

                $newMessage = $this->userModel->AddNewMessage($emai_sender,$email_receiver,$date,$message);

                if($newMessage){
                    echo json_encode(['message' => 'Message Sent']);
                }
                else{
                    echo json_encode(['message' => 'Message Not Sent']);
                    
                }



            }
            else{
                $i=0;
                $data=[
                    'email_sender'=>$_SESSION['user_email'],
                ];
                $chats=$this->userModel->getChats($data);
                if($chats!=false){
                        foreach($chats as $chat){
                            if($chat->sender_email==$_SESSION['user_email']){
                                $data['email_receiver'][$i]=$chat->receiver_email;
                                $i++;
                            }
                            else{
                                $data['email_receiver'][$i]=$chat->sender_email;
                                $i++;
                            }
                        }
                        $i=0;
                        $data['email_receivers']=array_unique($data['email_receiver']);
                        $data['email_receivers']=array_values($data['email_receivers']);
                        foreach($data['email_receivers'] as $email_receiver){
                            $receiver=$this->userModel->getUserDetailsByEmail($email_receiver);
                            if(!empty($receiver)){
                                $data['email_receivers'][$i]=$receiver;
                                $i++;
                            }
                        }
                        // $data['chats']=$chats;
                    }
                    if($id!=null){
                        $data['receiver']=$id;
                        $receiver=$this->userModel->getUserDetails($data['receiver']);
                        if(!empty($receiver)){
                            $data['receiver_details']=$receiver;
                        }
                        $current_chat=$this->userModel->getCurrentChat($data['email_sender'],$data['receiver_details']->email);
                        if(!empty($current_chat)){
                            $data['current_chat']=$current_chat;
                        }
                    }else{
                        $data['receiver']=null;
                    }
                    $this->view('users/chat',$data);
            }

        }
        
    
        public function chatMessages($id=null){
            $data = json_decode(file_get_contents('php://input'), true);

            $emai_sender = $data['sender_email'];
            $email_receiver = $data['receiver_email'];

            // $oldChat = $this->userModel->getAllMessages($emai_sender,$email_receiver);
            $i=0;
            $data=[
                'email_sender'=>$_SESSION['user_email'],
            ];
            $chats=$this->userModel->getChats($data);
            if($chats!=false){
                    foreach($chats as $chat){
                        if($chat->sender_email==$_SESSION['user_email']){
                            $data['email_receiver'][$i]=$chat->receiver_email;
                            $i++;
                        }
                        else{
                            $data['email_receiver'][$i]=$chat->sender_email;
                            $i++;
                        }
                    }
                    $i=0;
                    $data['email_receivers']=array_unique($data['email_receiver']);
                    $data['email_receivers']=array_values($data['email_receivers']);
                    foreach($data['email_receivers'] as $email_receiver){
                        $receiver=$this->userModel->getUserDetailsByEmail($email_receiver);
                        if(!empty($receiver)){
                            $data['email_receivers'][$i]=$receiver;
                            $i++;
                        }
                    }
                    // $data['chats']=$chats;
                }
                if($id!=null){
                    $data['receiver']=$id;
                    $receiver=$this->userModel->getUserDetails($data['receiver']);
                    if(!empty($receiver)){
                        $data['receiver_details']=$receiver;
                    }
                    $current_chat=$this->userModel->getCurrentChat($data['email_sender'],$data['receiver_details']->email);
                    if(!empty($current_chat)){
                        $data['current_chat']=$current_chat;
                    }
                }else{
                    $data['receiver']=null;
                }
            // if(empty($oldChat)){
            //     echo json_encode(['message' => 'No Previous Chat']);
            // }
            // else{
                echo json_encode(['message' => $data]);
                
            // }
        }

        public function switch_user(){
            if(!isLoggedIn()){
                $_SESSION['url'] = URL();
                redirect('users/login');
            }
            if($_SESSION['user_type']!='seller'){
                $_SESSION['prev_user_type']=$_SESSION['user_type'];
                $_SESSION['user_type']='seller';
                flash('user_type_message', 'You are now a Seller');
                redirect('users/index');

            }
            else if($_SESSION['prev_user_type']!='seller'){
                $_SESSION['user_type']=$_SESSION['prev_user_type'];
                flash('user_type_message', 'You are now a '.ucwords($_SESSION['prev_user_type']));
                redirect('users/index');
            }

        }
        
    }