<?php
    class Users extends Controller{
        private $userModel;
        private $buyerModel;

        public function __construct(){
            $this->userModel = $this->model('User');
            $this->buyerModel = $this->model('Buyer');

        }
        //register
        public function register(){
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
                    if($this->userModel->sendEmail($data['email'],$data['otp'],$data['first_name'])){
                        //Otp send by email
                        redirect('users/verifyotp');
                    }
                    else{
                        $data['email_err'] = 'Email not sent';
                        $this->view('users/register', $data);

                    }

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
                    //     else if($data['user_type']=='buyer'){
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
            if(!isset($_SESSION['email'])){
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

                            //Register user
                            if($this->userModel->register($data)){
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
                                else if($data['user_type']=='buyer'){
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
                                else{
                                    if($this->userModel->addToServiceProvider($data)){
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
                        $loggedInUser = $this->userModel->login($data['email'], $data['password']);
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
            switch($_SESSION['user_type']){
                case 'buyer':
                    redirect('buyers/index');
                    break;
                case 'seller':
                    redirect('sellers/index');
                    break;
                case 'admin':
                    redirect('admins/index');
                    break;
                case 'service_provider':
                    redirect('service_providers/index');
                    break;
                default:
                    redirect('users/index');
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

        
        
    }