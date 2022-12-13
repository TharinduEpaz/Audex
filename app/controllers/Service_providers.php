<?php

    class Service_providers extends Controller{

   

        public function __construct(){
            if(!isLoggedIn()){
                redirect('users/login');
            }

            $this->service_model=$this->model('Service_provider');
        }

        public function index(){

            $this->view('service_providers/index');
        }

        public function profile(){

        $details = $this->service_model->getDetails($_SESSION['user_id']);

        $data = [
            'details' => $details
        ];
        
      
        $this->view('service_providers/profile',$data);

        }
        public function settings(){
            $details = $this->service_model->getDetails($_SESSION['user_id']);

            $data = [
                'details' => $details
            ];
            $this->view('service_providers/settings',$data);
        }


        
    }



?>