<?php

    class Admins extends Controller{
n
        public function __construct(){
            if(!isLoggedIn()){
                redirect('users/login');
            }

            $this->adminModel=$this->model('Admin');
        }

        public function index(){

            $this->view('admins/index');
        }


        
    }



?>