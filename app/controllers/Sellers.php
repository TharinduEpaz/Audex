<?php
    class Sellers extends Controller{

        public function __construct(){
            if(!isLoggedIn()){
                redirect('users/login');
            }

            $this->sellerModel=$this->model('Seller');
        }

        public function advertisements(){
            //Get advertisements
            $advertisements=$this->sellerModel->getadvertisements();



            $data = [
                'advertisements' => $advertisements
              ];
             
              $this->view('sellers/advertisements', $data);
        }

        //Add product
        public function advertise(){
            // echo 'hi';

            $data = [
                'title' => '',
                'body'=>''
              ];
             
              $this->view('sellers/advertise', $data);
        }
        
    }