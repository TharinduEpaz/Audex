<?php

    
    class Service_providers extends Controller{

        private $service_provider_model;
        public function __construct(){
            if(!isLoggedIn()){
                redirect('users/login');
            }

            $this->service_provider_model=$this->model('Service_provider');
        }

        public function index(){

            $this->view('service_providers/index');
        }

        public function profile(){


            $user_data=$this->service_provider_model->getDetails($_SESSION['user_email']);
    
            $this->view('service_providers/profile',$user_data);
        }
        public function settings(){
            $this->view('service_providers/settings');
        }


        
    }



?>