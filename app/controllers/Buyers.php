<?php
  class Buyers extends Controller{
    private $buyerModel;
    private $userModel;
    public function __construct()
    {
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
    //   if($_SESSION['user_type'] != 'buyer'){
    //     redirect($_SESSION['user_type'].'s/index');
    // }
      $this->buyerModel = $this->model('Buyer');
      $this->userModel = $this->model('User');
    }
    public function index(){

      $this->view('buyers/index');
  }

    public function shop(){
        $ads  = $this->buyerModel->getAdvertiesment();
        // get the serchResults session value
        $results = $_SESSION['searchResults'];

        // check serch results are empty(1) or not empty(0)
        $empty = empty($results);


        $data = [
          'ads' => $ads,
          'searchResults' => $results,
          'isEmpty' => $empty
        ];

        unset($_SESSION['searchResults']);

        $this->view('buyers/shop',$data);
    }

    

   public function advertiesmentDetails($id)
    {
      // set product id to session to use for js
      $_SESSION['product_id'] = $id;

      $ad = $this->buyerModel->getAdvertiesmentById($id);
      $liked = $this->buyerModel->checkAddedLike($id,$_SESSION['user_id']);

      if(empty($liked)){
        $data = [
          'ad' => $ad,
          'liked' => 'notliked'
        ];
      }else{
        $data = [
          'ad' => $ad,
          'liked' => 'liked'
        ];

      }
      


      // $data = [
      //   'ad' => $ad
      // ];
      $this->view('buyers/advertiesmentDetails',$data);
    }
    public function getProfile($id)
    { 
      if(!isLoggedIn()){
        redirect('users/login');
      }
      $details = $this->buyerModel->getBuyerDetails($id);
      $buyerDetails = $this->buyerModel->getBDetails($id);
      if ($details->user_id != $_SESSION['user_id']) {
        redirect('users/index');
      }

      $feedbacks=$this->userModel->getFeedbacks($details->email);
      $feedbackcount=$this->userModel->getFeedbacksCount($details->email);

      $data =[
        'id' => $id,
        'user' => $details,
        'buyer' => $buyerDetails,
        'feedbacks' => $feedbacks,
        'feedbackcount' => $feedbackcount
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
          if($this->buyerModel->updateProfile($data)){
            $_SESSION['user_name'] = $data['first_name'];
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

        $this->view('buyers/editProfile',$data);
      }
    }

//     public function watchlist(){
//       if(!isLoggedIn()){
//         redirect('users/login');
//       }
// //this should change after orginal db
//       $products = $this->buyerModel->getBuyerWatchProducts($_SESSION['user_email']);
//       $data =[
//         'products' => $products,
//       ];
//       $this->view('buyers/watchlist',$data);

//     }

    public function deleteProfile($id){
      if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
        $user = $this->buyerModel->getBuyerDetails($id);

        //check for owner
        if( $user->_id != $_SESSION['user_id'] ){
          redirect('users/login');
        }

        if($this->buyerModel->deleteUserProfile($id)){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_type']);
            session_destroy();
            flash('user_deleted','User deleted successfully');
          redirect('users/index');
        }
        else{
          die('Something went wrong');
        }
      }
      else{
        redirect('users/index');
      }


    }

    // public function addToWatchList($p_id,$u_id){
    //   if(!isLoggedIn()){
    //     redirect('users/login');
    //   }
    //   echo $_POST['user_id'];
    //   if($_POST['user_id'] == 0){
    //     redirect('users/login');
    //   }
    //   else{
    //     if (isset($_POST['add'])){
    //       $result = $this-> buyerModel->addItemToWatchList($p_id, $u_id);
    //       if($result){
    //         echo flash('register_success', 'You are registered and can log in');
    //       }
    //       else{
    //         die('Something went wrong');
    //       }
  
    //     }
    //   }
    // }
    
    // public function removeItemFromWatchList($p_id,$u_id){
    //   if(!isLoggedIn()){
    //     redirect('users/login');
    //   }
    //   echo $_POST['user_id'];
    //   if($_POST['user_id'] == 0){
    //     redirect('users/login');
    //   }
    //   else{
    //     if (isset($_POST['remove'])){
    //     echo "This Works";
    //       $result = $this-> buyerModel->removeItemFromWatchList($p_id, $u_id);
    //       if($result){
    //         echo flash('register_success', 'You are registered and can log in');
    //       }
    //       else{
    //         die('Something went wrong');
    //       }
  
    //     }
    //   }
    // }

    
    // public function removeOneItemFromWatchList($p_id,$u_id){
    //   if(!isLoggedIn()){
    //     redirect('users/login');
    //   }
    //   echo $_POST['user_id'];
    //   if($_POST['user_id'] == 0){
    //     redirect('users/login');
    //   }
    //   else{
    //     if (isset($_POST['remove'])){
    //     echo "This Works";
    //       $result = $this-> buyerModel->removeOneItemFromWatchList($p_id, $u_id);
    //       if($result){
    //         echo flash('register_success', 'You are registered and can log in');
    //       }
    //       else{
    //         die('Something went wrong');
    //       }
  
    //     }
    //   }
    // }

  // public function addLikeToProduct($p_id, $u_id)
  // {
  //   if (!isLoggedIn()) {
  //     redirect('users/login');
  //   }
  //   // $result = $this-> buyerModel->addLikeToProduct($p_id, $u_id);

  //   $json = file_get_contents('php://input');
  //   $dat = json_decode($json, true);

  //   echo $dat['addLike'];
  //   echo $dat['user_id'];
  //   echo $dat['product_id'];


  //   if (isset($dat['addLike'])) {
  //     $result=$this->buyerModel->checkAddedLike($dat['product_id'], $dat['user_id']);
  //     if (empty($result)) {
  //       $result = $this->buyerModel->addLikeToProduct($dat['product_id'], $dat['user_id']);
  //       if ($result) {
  //         echo flash('register_success', 'You are registered and can log in');
  //       } else {
  //         die();
  //       }

  //     }
  //   }
  //   // if (isset($dat['addLike'])){
  //   //   $result = $this-> buyerModel->addLikeToProduct($dat['product_id'], $dat['user_id']);
  //   //   if($result){
  //   //     echo flash('register_success', 'You are registered and can log in');
  //   //   }
  //   //   else{
  //   //     die();
  //   //   }
  //   // }

  // }


    // public function removeLikeFromProduct($p_id,$u_id){
    //   if(!isLoggedIn()){
    //     redirect('users/login');
    //   }
    //   // $result = $this-> buyerModel->addLikeToProduct($p_id, $u_id);

    //   $json = file_get_contents('php://input');
    //   $data = json_decode($json, true);

    //   echo $data['removeLike'];
    //   echo $data['user_id'];
    //   echo $data['product_id'];
    //   //  print_r($dat);


    //   if (isset($data['removeLike'])){
    //     $result = $this-> buyerModel->removeLikeFromProduct($data['product_id'], $data['user_id']);
    //     if($result){
    //       echo flash('register_success', 'You are registered and can log in');
    //     }
    //     else{
    //       die('Something went wrong');
    //     }

    //   }
    // }

  //   public function searchItems(){

  //     $searchedTerm = $_POST['search-item'];
      
  //     if( !isset($_POST['submit']) ){
  //       // this is for keyup event
  //       if( strlen($searchedTerm) <3 ){
  //         echo json_encode([]);
  //       }else{
  //         $results = $this-> buyerModel->searchItems($searchedTerm);
  //         echo json_encode($results);
  //       }
  //     }
  //     else{
  //       // user has pressed enter
  //       if( strlen($searchedTerm) <1 ){
  //         echo json_encode([]);
  //       }else{
  //         $results = $this-> buyerModel->searchItems($searchedTerm);
  //         $_SESSION['searchResults'] = $results;
  //         echo json_encode($results);
  //       }

  //     }

  // }

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
    public function dashboard(){
      $this->view('service_providers/dashboard');
    }

    public function reactions(){
      if(!isLoggedIn()){
        $_SESSION['url']=URL();
        redirect('users/login');
      }

      $products = $this->buyerModel->getBuyerReactedProducts($_SESSION['user_email']);
      $data =[
        'products' => $products,
      ];

      $this->view('buyers/reactions',$data);
    }

  }  

?>