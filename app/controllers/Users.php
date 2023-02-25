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
        private $calendar;



        public function __construct(){
            
            $this->userModel = $this->model('User');
            $this->buyerModel = $this->model('Buyer');
            $this->sellerModel = $this->model('Seller');

        }

        public function index(){
            if(isset($_SESSION['attempt'])){
                unset($_SESSION['otp_email']);
                unset($_SESSION['phone']);
                unset($_SESSION['attempt']);
                unset($_SESSION['time']);
            }
            $data = [
                'title' => 'Welcome!!!!!'
              ];
             
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
                if(empty($data['email_err']) && empty($data['first_name_err']) && empty($data['second_name_err'])  && empty($data['password_err1']) && empty($data['password_err2']) && empty($data['password_err3']) && empty($data['password_err4']) && empty($data['password_err5']) && empty($data['password_err6'])){
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
                            $_SESSION['otp_email']=$data['email'];
                            //Otp send by email
                            redirect('users/verifyotp');
                        }
                        else{
                            flash('email_err','Email not sent');
                            $this->view('users/register', $data);
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
            $data['email']=$email;
            $data['otp']=rand(111111,999999);
            $data['otp_hashed'] = password_hash($data['otp'], PASSWORD_DEFAULT);
            $dat=date('Y-m-d H:i:s');
            if($this->userModel->updateOtp($data['otp'],$dat,$data['email'])){
                //Send email
                $to=$data['email'];
                $sender='audexlk@gmail.com';
                $mail_subject='Verify Email Address';
                $email_body='<p>Dear '.$data['user']->first_name.',<br>Thank you for signing up to Audexlk. In order to'; 
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
                    $_SESSION['otp_email']=$data['email'];
                    redirect('users/verifyotp');
                }
                else{
                    $data['email_err'] = 'Email not sent';
                    $this->view('users/register', $data);
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
                    if(empty($data['email_err'])  && empty($data['password_err']) && empty($data['email_not_activated_err'])){
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
                if(!isLoggedIn()){
                  $_SESSION['url']=URL();
          
                  redirect('users/login');
                }
                $details = $this->userModel->getUserDetails($id);
          
                // if ($details->user_id != $_SESSION['user_id']) {
                //   $_SESSION['url']=URL();
          
                //   redirect('users/login');
                // }
          
                $data =[
                  'id' => $id,
                  'user' => $details
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
                if(!isLoggedIn()){
                    redirect('users/login');
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
                if(!isLoggedIn()){
                    redirect('users/login');
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
            

          public function edit_profile_picture($id){
            if(isset($_SESSION['attempt'])){
                unset($_SESSION['otp_email']);
                unset($_SESSION['phone']);
                unset($_SESSION['attempt']);
                unset($_SESSION['time']);
            }
            if(!isLoggedIn()){
              $_SESSION['url']=URL();
      
              redirect('users/login');
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
            session_destroy();
            redirect('users/login');
        }
        //Shop
        public function shop(){
            if(isset($_SESSION['attempt'])){
                unset($_SESSION['otp_email']);
                unset($_SESSION['phone']);
                unset($_SESSION['attempt']);
                unset($_SESSION['time']);
            }
            $ads  = $this->userModel->getAdvertiesment();   
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

            ];

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
            
            unset($_SESSION['searchResults']);
            unset($_SESSION['searchTerm']);
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

          $this->view('users/auction',$data);

        }



        public function bid($id){
          $ad = $this->userModel->getAdvertiesmentById($id);
          $data['ad'] = $ad;

          $auction = $this->userModel->getAuctionById($id);
          if($auction=='Error'){
            flash('auction_error','Auction is not available','alert alert-danger');
            redirect('users/shop');
          }
          $data['auction'] = $auction;
          
          $auction_details = $this -> userModel->getAllAuctionDetails($id);
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
          public function addServiceProviderToWatchList(){
            if(!isLoggedIn()){
              $_SESSION['url']=URL();

              redirect('users/login');
            }
            // echo $_POST['user_id'];

            if($_POST['user_id'] == 0){
              redirect('users/login');
            }
            else{
                $buyerId = $_POST['user_id'];
                $serviceProviderId = $_POST['service_provider_id'];

                // echo $buyerId;
                // echo $serviceProviderId;

                if (isset($_POST['add'])){
                    // check weather service provider is alredy in watch list or not
                    $result1 = $this->userModel->checkIsServiceProviderWatched($buyerId,$serviceProviderId);

                    if (empty($result1)) {
                        $addToList = $this->userModel->addServiceProviderToWatchList($buyerId,$serviceProviderId);
                        if ($addToList) {
                            echo json_encode(['message' => 'Added to the list']);
                        } else {
                            echo json_encode(['message' => 'Some thing went wrong']);
                        }
                    }
                    else
                    {
                        // if service provider is alredy in list then nothig to do
                        echo json_encode(['message' => 'Alredy in the list']);
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
                $_SESSION['searchTerm'] = $searchedTerm;
                $_SESSION['searchResults'] = $results;
                // echo $_SESSION['searchResults'];
                echo json_encode($results);
              }
      
            }
      
        }
        public function shopSearchItems(){
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
                
                $productCategory = $_POST['category'];
                $productPriceMin = $_POST['price-min'];
                $productPriceMax = $_POST['price-max'];
                $productType = $_POST['type'];

                $Filter=[];

                if( empty(trim($searchedTerm)) and empty(trim($productCategory)) and empty(trim($productPriceMin)) and empty(trim($productPriceMax)) and empty(trim($productType))) 
                {
                    // if all filters are empty
                    echo json_encode([]);
                }
                else if( empty(trim($searchedTerm)) )
                {
                    if(!empty(trim($productCategory))){
                        $Filter['product_category']=$productCategory;
                    }
                    if(!empty(trim($productPriceMin))){
                        $Filter['min_price']=(int) $productPriceMin;
                    }
                    if(!empty(trim($productPriceMax))){
                        $Filter['max_price']=(int) $productPriceMax;
                    }
                    if(!empty(trim($productType))){
                        $Filter['product_type']= $productType;
                    }
                    $results = $this-> userModel->searchAndFilterItems($Filter);

                    $_SESSION['searchTerm'] = $searchedTerm;
                    // $_SESSION['searchResults'] = $results;
                    // echo $_SESSION['searchResults'];
    
                    echo json_encode($results);
                }
                else if( !empty(trim($searchedTerm)) )
                {
                    // search term has set
                    if( !empty(trim($searchedTerm)) and empty(trim($productCategory)) and empty(trim($productPriceMin)) and empty(trim($productPriceMax)) and empty(trim($productType))) 
                    {
                        // if all filters are empty except search term
                        $results = $this-> userModel->searchItems($searchedTerm);
                        echo json_encode($results);
                    }
                    else{
                        if(!empty(trim($productCategory))){
                            $Filter['product_category']=$productCategory;
                        }
                        if(!empty(trim($productPriceMin))){
                            $Filter['min_price']=(int) $productPriceMin;
                        }
                        if(!empty(trim($productPriceMax))){
                            $Filter['max_price']=(int) $productPriceMax;
                        }
                        if(!empty(trim($productType))){
                            $Filter['product_type']= $productType;
                        }
                        $results = $this-> userModel->searchAndFilterItemsWithSearchTerm($Filter,$searchedTerm);
                        $_SESSION['searchTerm'] = $searchedTerm;
                        // $_SESSION['searchResults'] = $results;
                        // echo $_SESSION['searchResults'];
        
                        echo json_encode($results);
                    }


                }

                // echo $searchedTerm;
                // echo $productCategory;
                // echo $productType;
                // echo $productPriceMax;
                // echo $productPriceMin;
      
            }
      
        }
        public function serviceProviderPublic()
        {
            $id = $_GET['id'];
            $d = $this->userModel->getServiceProvidersPublic($id);


            $data = [
                'details' => $d
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
            // print_r($ServiceProviderWatched);
            // exit();

            $this->view('users/service_provider_public', $data);

        }

        public function rateSeller(){

            $data = json_decode(file_get_contents('php://input'), true);

            $rating = $data['rating'] ?? 0;
            $buyer_id = $data['buyer'];
            $seller = $data['seller'];
            $review = $data['review'];

            $results2 = '';
            $results3 = '';
            // echo $rating;
            // echo $buyer_id;
            // echo $seller;
            $results1 = $this->userModel->checkAddedRate($buyer_id, $seller);

            if( empty($results1) ){
                $results2 = $this-> userModel->rateSeller($rating,$buyer_id,$seller,$review);
            }
            else{
                $results3 = $this->userModel->updateSellerRate($rating, $buyer_id, $seller,$review);
            }
            $results4 = $this->userModel->getSellerFinalRate($seller);
            flash('rating_message', 'Rating added successfully');
            // ,'result1'=>$results1,'result2'=>$results2,'result3'=>$results3
            echo json_encode(['message' => 'Rating saved','results4'=>$results4,'result1'=>$results1,'result2'=>$results2,'result3'=>$results3]);


        }
        
        //Event calendar
        public function eventCalendar(){
            $this->calendar = new Calendar;
            $this->calendar->add_event('Birthday', '2023-02-23', 1, 'green');
            $this->calendar->add_event('blue', '2023-02-03', 1, 'blue');
            $this->calendar->add_event('burly', '2023-02-13', 1, 'burlywood');
            $this->calendar->add_event('blue', '2023-02-13', 1, 'blue');
            $this->calendar->add_event('red', '2023-02-13', 1, 'red');
            $this->calendar->add_event('aqua', '2023-02-13', 1, 'aquamarine');
            $this->calendar->add_event('bisq', '2023-02-13', 1, 'bisque');
            $this->calendar->add_event('green', '2023-03-13', 1, 'green');
            $data= $this->calendar;
            $this->view('users/calendar',$data);
                
        }
            
        public function map_view(){
            $this->view('users/map_view');
        }
        
    }