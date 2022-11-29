<?php
    class Users extends Controller{

        public function __construct(){
            $this->userModel = $this->model('User');
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

                    //Register user
                    if($this->userModel->register($data)){
                        $row=$this->userModel->getUserId($data['email']);
                        $data['user_id']=$row->user_id;
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
                            if($this->userModel->addTosServiceProvider($data)){
                                flash('register_success', 'You are registered and can log in');
                                redirect('users/login');
                            }else{
                                die('Something went wrong');
                            }
                        }
                    }
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
            redirect('pages/index');
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