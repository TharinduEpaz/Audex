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



        public function setDetails()
    {

        


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           
            if (isset($_POST['first_name'])&& $_POST['first_name'] != '') {

                $first_name = $_POST['first_name'];
            }

           if(isset($_POST['second_name'])&& $_POST['second_name'] != '') {

                $second_name = $_POST['second_name'];
            }

            if(isset($_POST['email'])&& $_POST['email'] != '') {

                $email = $_POST['email'];
            }

            if(isset($_POST['address1'])&& $_POST['address1'] != '') {

                $address1 = $_POST['address1'];
            }

            if(isset($_POST['address2'])&& $_POST['address2'] != '') {

                $address2 = $_POST['address2'];
            }

            if(isset($_POST['mobile'])&& $_POST['mobile'] != '') {

                $mobile = $_POST['mobile'];
            }

            if(isset($_POST['password'])&& $_POST['password'] != '') {

                
                $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
            }
           
        

        $details = array($first_name, $second_name, $email, $address1,$address2,$mobile,$password,);

        /*$this->adminmodel->setDetails($details,$_SESSION['user_id']); */
        $this->adminmodel->setDetails($details);


        redirect('admins/profile/');
    }



        
    }



?>