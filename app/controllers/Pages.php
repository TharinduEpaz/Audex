<?php
    class Pages extends Controller{

        public function __construct(){
            // echo "pages loaded";
                if(!isLoggedIn()){
                    unset($_SESSION['otp']);
                    unset($_SESSION['email']);
                    unset($_SESSION['password']);
                    unset($_SESSION['first_name']);
                    unset($_SESSION['second_name']);
                    unset($_SESSION['phone']);
                    unset($_SESSION['user_type']);
                    unset($_SESSION['attempt']);
                    session_destroy();
                }
        }

        public function index(){
            // echo 'hi';

            $data = [
                'title' => 'Welcome!!!!!'
              ];
             
              $this->view('pages/index', $data);
        }
        
    }