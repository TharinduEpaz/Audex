<?php
  class Buyers extends Controller{
    private $buyerModel;
    public function __construct()
    {
      $this->buyerModel = $this->model('Buyer');
    }

    public function index(){
        $ads  = $this->buyerModel->getAdvertiesment();   
        $data = [
          'ads' => $ads
        ];
        $this->view('buyers/index',$data);
    }
   public function advertiesmentDetails($id)
    {
      $ad = $this->buyerModel->getAdvertiesmentById($id);
      $data = [
        'ad' => $ad
      ];
      $this->view('buyers/advertiesmentDetails',$data);
    }
    public function getProfile($id)
    { 
      if(!isLoggedIn()){
        redirect('users/login');
      }
      $details = $this->buyerModel->getBuyerDetails($id);

      if ($details->_id != $_SESSION['user_id']) {
        redirect('users/login');
      }

      $data =[
        'id' => $id,
        'user' => $details
      ];
      $this->view('buyers/getProfile',$data);
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
          'phone_number' => trim($_POST['phone_number']),
          'user_id' => $_SESSION['user_id'],
          'first_name_err' => '',
          'second_name_err' => '',
          'address1_err' => '',
          'address2_err' => '',
          'phone_number_err' => ''
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
        if(empty($data['phone_number'])){
          $data['phone_number_err'] = 'Please Enter Phone Number';
        }


        if( empty($data['first_name_err']) && empty($data['second_name_err']) && empty($data['address1_err']) && empty($data['address1_err'] && empty($data['phone_number_err'])) ){
          //validated
          if($this->buyerModel->updateProfile($data)){
            redirect('buyers/getProfile/'.$_SESSION['user_id']);
          }
          else{
            die('Something went wrong');
          }

        }
        else{
          //Load with errors
          $this->view('buyers/editProfile',$data);
        }
      }
      else{
        $details = $this->buyerModel->getBuyerDetails($id);

        if($details->_id != $_SESSION['user_id']){
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

        $this->view('buyers/editProfile',$data);
      }
    }

    public function watchlist(){
      if(!isLoggedIn()){
        redirect('users/login');
      }
//this should change after orginal db
      $products = $this->buyerModel->getBuyerWatchProducts($_SESSION['user_email']);
      $data =[
        'products' => $products,
      ];
      $this->view('buyers/watchlist',$data);

    }

    public function deleteProfile($id){
      if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
        $user = $this->buyerModel->getBuyerDetails($id);

        //check for owner
        if( $user->_id != $_SESSION['user_id'] ){
          redirect('users/login');
        }

        if($this->buyerModel->deleteUserProfile($id)){
          redirect('users/login');
        }
        else{
          die('Something went wrong');
        }
      }
      else{
        redirect('buyer/index');
      }


    }

    public function addToWatchList($p_id,$u_id){
      if(!isLoggedIn()){
        redirect('users/login');
      }
      echo $_POST['user_id'];
      if($_POST['user_id'] == 0){
        redirect('users/login');
      }
      else{
        if (isset($_POST['add'])){
          $result = $this-> buyerModel->addItemToWatchList($p_id, $u_id);
          if($result){
            echo flash('register_success', 'You are registered and can log in');
          }
          else{
            die('Something went wrong');
          }
  
        }
      }
      

    }
    
    public function test(){
      $email = 'dineshwickramasinghe2000@gmail.com';
      $userDetails = $this->buyerModel->findUserDetailsByEmail($email);
      echo gettype($userDetails->is_deleted);
      $data =[
        'user' => $userDetails->email,
        'user1' =>$userDetails->first_name
      ];
      echo $data['user'];
      $this->view('buyers/test',$data);

    }
    


  }  

?>