<?php

    class Admins extends Controller{

        public function __construct(){
            if(!isLoggedIn()){
                redirect('users/login');
            }

            $this->adminModel=$this->model('Admin');
        }

        public function index(){

            $this->view('admins/index');
        }

        public function profile(){

                $details = $this->adminModel->getDetails($_SESSION['user_id']);
        
                $data = [
                    'details' => $details
                ];
                
              
                $this->view('admins/profile',$data);
        


        }

        public function manageuser(){


            $this->view('admins/manageuser');
        }
        


        public function addadmin(){

            $this->view('admins/addadmin');
        }



        
    }



?>