<?php
 use \PHPMailer\PHPMailer\PHPMailer;
 use \PHPMailer\PHPMailer\Exception;

 require dirname(APPROOT).'/app/phpmailer/src/Exception.php';
 require dirname(APPROOT).'/app/phpmailer/src/PHPMailer.php';
 require dirname(APPROOT).'/app/phpmailer/src/SMTP.php';

    class Admins extends Controller{
        private $adminModel;

        public function __construct(){
          if(isset($_SESSION['attempt'])){
            unset($_SESSION['otp_email']);
            unset($_SESSION['phone']);
            unset($_SESSION['attempt']);
            unset($_SESSION['time']);
        }
            if(!isLoggedIn()){
                session_destroy();
                redirect('users/login');
            }
            if($_SESSION['user_type'] != 'admin'){
                redirect($_SESSION['user_type'].'s/index');
            }

            //Session timeout
            if(isset($_SESSION['session_time'])){
                if(time() - $_SESSION['session_time'] > 60*30){
                    // flash('session_expired', 'Your session has expired', 'alert alert-danger');
                    redirect('users/logout');
                }else{
                    $_SESSION['session_time'] = time();
                }
            }

            $this->adminModel=$this->model('Admin');
        }

        public function index(){

            $this->view('admins/index');
        }

        public function spprofile(){
          $id = $_GET['id'];
          
          $details= $this->adminModel->getspprofile($id);
          $data =[
            'details'=> $details
          ];
           //print_r($data);
           //exit();
          //$this->view('admins/approval',$data);
          $this->view('admins/spprofile',$data);
      }

        public function approval(){

          $details= $this->adminModel->getserviceproviderdetails();
          $data =[
            'details'=> $details
          ];
          // print_r($data);
          // exit();
          $this->view('admins/approval',$data);

      }

      
        public function profiletest(){

                $details = $this->adminModel->getadminDetails($_SESSION['user_id']);
        
                $data = [
                    'details' => $details
                ];
                
              
                $this->view('admins/profiletest',$data);
        


        }



        public function editProfile($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
              $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      
              $data = [
                'id' => $id,
                'first_name' => trim($_POST['first_name']),
                'second_name' => trim($_POST['second_name']),
                'email' => $_SESSION['user_email'],
                'address1' => trim($_POST['address1']),
                'address2' => trim($_POST['address2']),
                'user_id' => $_SESSION['user_id'],
                'first_name_err' => '',
                'second_name_err' => '',
                'address1_err' => '',
                'address2_err' => '',
              ];
      
              //validate data
              if(empty($data['first_name'])){
                $data['first_name_err'] = 'Please Enter First Name';
              }
              if(empty($data['second_name'])){
                $data['second_name_err'] = 'Please Enter Second Name';
              }
              if(empty($data['address1'])){
                $data['address1_err'] = 'Please Enter Address Line 1';
              }
              if(empty($data['address2'])){
                $data['address2_err'] = 'Please Enter Address Line 2';
              }
      
      
              if( empty($data['first_name_err']) && empty($data['second_name_err']) && empty($data['address1_err']) && empty($data['address1_err'] ) ){
                //validated
                if($this->adminModel->updateProfile($data)){
                  $_SESSION['user_name'] = $data['first_name'];
                  redirect('admins/profiletest');
                }
                else{
                  die('Something went wrong');
                }
      
              }
              else{
                //Load with errors
                $this->view('admins/editProfile',$data);
              }
            }
            else{
              $details = $this->adminModel->getadminDetails($id);
      
              if($details->user_id != $_SESSION['user_id']){
                redirect('users/login');
              }
      
              $data = [
                'id' => $id,
                'first_name' => $details->first_name,
                'second_name' => $details->second_name,
                'address1' => $details->address1,
                'email' => $details->email,
                'address2' => $details->address2,
                'phone_number' => $details->phone_number
              ];
      
              $this->view('admins/editProfile',$data);
            }
          }


        


        public function addadmin(){

            $this->view('admins/addadmin');
        }


        public function getProfile($id)
    { 
      if(!isLoggedIn()){
        redirect('users/login');
      }
      $details = $this->adminModel->getadminDetails($id);

      if ($details->user_id != $_SESSION['user_id']) {
        redirect('users/login');
      }

      $data =[
        'id' => $id,
        'user' => $details
      ];
      $this->view('admins/profiletest',$data);
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
        $this->adminModel->setDetails($details);


        redirect('admins/profiletest/');
        
    }



        
    }

    public function ignoresp(){
      $id = $_GET['id'];

      if ($_SERVER['REQUEST_METHOD']=='POST'){

          if(isset($_POST['ignore-reason'])&& $_POST['ignore-reason'] !=''){
            $ignore_reason= $_POST['ignore-reason'];
          }

          

        
        $this->adminModel->ignoresp($id,$ignore_reason);

        redirect('admins/approval/');

      }
      
  }


    public function approvesp(){

        $id = $_GET['id'];
        // $admin_ignored =$_GET['admin_ignored'];

        if ($_SERVER['REQUEST_METHOD']=='POST'){

            
                $this->adminModel->approvesp2($id);
            
          redirect('admins/approval/');
        }


    }

    public function admindashboard(){

        $details=$this->adminModel->getcounts();
        $toprated=$this->adminModel->gettopratedsellers();
        $producttype=$this->adminModel->producttypecount();
        $viewcount=$this->adminModel->getviewcount();
        
        $data=[
          'details'=>$details,
          'toprated'=>$toprated,
          'producttype'=>$producttype,
          'viewcount'=>$viewcount
        ];
        $this->view('admins/admindashboard',$data);


      }


      public function adminviewreport(){

        $details= $this->adminModel->getreportdetails();
        $total=$this->adminModel->gettotalpayment();
        $data =[
          'details'=> $details, 
          'total'=>$total->total
        ];
        // print_r($data);
        // exit();
        $this->view('admins/adminviewreport',$data);

      }

      public function reports(){
          $this->view('admins/reports');
  
      }

      public function approvedservice_providers(){
        $serviceProvider=$this->adminModel->getserviceProviderReport();
        $data =[
          'service_provider_report' => $serviceProvider
        ];
        $this->view('admins/service_providers_approved',$data);
      }
      public function lowratings(){
        $lowServiceProviders = $this->adminModel->getLowServiceProviders();
        $data =[
          'low_service_providers' => $lowServiceProviders
        ];
        $this->view('admins/serviceproviderslowratings',$data);
      }
      public function highratings(){
        $topRated = $this->adminModel->getTopServiceProviders();
        $data =[
          'top_rated' => $topRated
        ];
        $this->view('admins/serviceprovidershighratings',$data);
      }
      public function seller_highratings(){
        $topRated = $this->adminModel->getTopSeller();
        $data =[
          'top_rated' => $topRated
        ];
        $this->view('admins/sellerhighratings',$data);
      }
      public function seller_lowratings(){
        $topRated = $this->adminModel->getlowSeller();
        $data =[
          'top_rated' => $topRated
        ];
        $this->view('admins/sellerlowratings',$data);
      }
      public function seller_product_count(){
        $topRated = $this->adminModel->seller_product_count();
        $sum=0;
        foreach($topRated as $value){
          $sum=$sum+$value->count;
        }
        $data =[
          'top_rated' => $topRated,
          'sum' => $sum
        ];
        $this->view('admins/seller_product_count',$data);
      }
      public function trending_products(){
        $topRated = $this->adminModel->trending_products();
        $data =[
          'top_rated' => $topRated
        ];
        $this->view('admins/trending_products',$data);
      }
      
      



      public function manageuser(){

        $admins=$this->adminModel->getadmins();
        $users=$this->adminModel->get_users();
        $data=[
          'admins'=>$admins,
          'users'=>$users
        ];

        $this->view('admins/manageuser',$data);
      }

      public function suspend($id){
        $user=$this->adminModel->getadminDetails($id);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'reason' => trim($_POST['reason'])
                  ];
          $this->adminModel->user_suspend($id,$data['reason']);
          //Send email
          $mail = new PHPMailer(true);
          try {
              $to=$user->email;
              $sender='audexlk@gmail.com';
              $mail_subject='Suspend Account';
              $email_body='<p>Dear '.$user->first_name.',<br>Your account has been suspended for following reason. <br><hr>'; 
              $email_body.='<b>Reason: '.$data['reason'].'</b><br><br>';
              $email_body.='Thank you,<br>Audexlk</p>';
              // $header="From:{$sender}\r\nContent-Type:text/html;";
              
              $mail->isSMTP();
              $mail->Host = 'smtp.gmail.com';
              $mail->SMTPAuth = true;
              $mail->Username = $sender;
              $mail->Password = EMAIL_PASS;
              $mail->SMTPSecure = 'ssl';
              $mail->Port = 465;
              $mail->setFrom($sender);
              $mail->addAddress($to);
              $mail->isHTML(true);
              $mail->Subject = $mail_subject;
              $mail->Body = $email_body;
              // if($mail->send()){
                  $mail->send();
                  //Otp send by email
                  redirect('/admins/manageuser');
              // }
              // else{
                  // }
              } catch (Exception $e) {
                  flash('email_err','Mail could not be sent. Error: '. $e->getMessage(),'alert alert-danger');
                  redirect('/admins/manageuser');
              // echo 'Message could not be sent. Error: ', $e->getMessage();
              }
          redirect('admins/manageuser');
        }
        $this->adminModel->user_suspend($id);
        redirect('admins/manageuser');
      }
      public function unsuspend($id){
        $user=$this->adminModel->getadminDetails($id);
        $this->adminModel->user_unsuspend($id);
        //Send email
        $mail = new PHPMailer(true);
        try {
            $to=$user->email;
            $sender='audexlk@gmail.com';
            $mail_subject='Unuspend Account';
            $email_body='<p>Dear '.$user->first_name.',<br>Your account has been unsuspended. <br>'; 
            $email_body.='Thank you,<br>Audexlk</p>';
            // $header="From:{$sender}\r\nContent-Type:text/html;";
            
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $sender;
            $mail->Password = EMAIL_PASS;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom($sender);
            $mail->addAddress($to);
            $mail->isHTML(true);
            $mail->Subject = $mail_subject;
            $mail->Body = $email_body;
            // if($mail->send()){
                $mail->send();
                //Otp send by email
                redirect('admins/manageuser');
            // }
            // else{
                // }
            } catch (Exception $e) {
                flash('email_err','Mail could not be sent. Error: '. $e->getMessage(),'alert alert-danger');
                redirect('/admins/manageuser');
            // echo 'Message could not be sent. Error: ', $e->getMessage();
            }
        redirect('admins/manageuser');
      }


  }






  
  
?>