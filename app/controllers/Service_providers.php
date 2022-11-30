<?php

    class Service_providers extends Controller{

        public function __construct(){
            if(!isLoggedIn()){
                redirect('users/login');
            }

            $this->service_providerModel=$this->model('Service_provider');
        }

        public function index(){

            $this->view('service_providers/index');
        }

        public function profile(){
            $this->view('service_providers/profile');
        }


        
    }



?>