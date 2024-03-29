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

      //Session timeout
      if(isset($_SESSION['session_time'])){
        if(time() - $_SESSION['session_time'] > 60*30){
            // flash('session_expired', 'Your session has expired', 'alert alert-danger');
            redirect('users/logout');
        }else{
            $_SESSION['session_time'] = time();
        }
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
      $feedbacks_normal=$this->buyerModel->getFeedbacks($details->email);
      $feedbacks_seller_rated=$this->buyerModel->getFeedbacks_seller_rated($details->email);
      $feedbacks = array_merge($feedbacks_normal, $feedbacks_seller_rated);
      
      $feedbackcount_normal=$this->buyerModel->getFeedbacksCount($details->email);
      $feedbackcount_seller_rated=$this->buyerModel->getFeedbacksCount_seller_rated($details->email);
      $feedbackcount = $feedbackcount_normal + $feedbackcount_seller_rated;
                
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
    // this is buyers watchlist
    // this will call views/buyers/watchlist.js file 
    public function watchlist(){
      if(!isLoggedIn()){
        $_SESSION['url']=URL();
        redirect('users/login');
      }

      $products = $this->buyerModel->getBuyerWatchProducts($_SESSION['user_email']);
      $serviceProviders = $this->buyerModel->getBuyerWatchServiceProviders($_SESSION['user_email']);
      $data =[
        'products' => $products,
        'serviceProviders' => $serviceProviders,
      ];
      $this->view('buyers/watchlist',$data);

    }

    public function addToWatchList($p_id,$u_id){
      if(!isLoggedIn()){
        $_SESSION['url']=URL();

        redirect('users/login');
      }
      echo $_POST['user_id'];
      if($_POST['user_id'] == 0){
        redirect('users/login');
      }
      else{
        if (isset($_POST['add'])){
          $result = $this->buyerModel->addItemToWatchList($p_id, $u_id);
          if($result){
            echo flash('register_success', 'You are registered and can log in');
          }
          else{
            die('Something went wrong');
          }

        }
      }
    }


    public function addServiceProviderToWatchList(){
      if(!isLoggedIn()){
        $_SESSION['url']=URL();

        redirect('users/login');
      }
      // echo $_POST['user_id'];

      if($_POST['user_id'] == 0){
        redirect('users/login');
      }
      else{
          $buyerId = $_POST['user_id'];
          $serviceProviderId = $_POST['service_provider_id'];

          // echo $buyerId;
          // echo $serviceProviderId;

          if (isset($_POST['add'])){
              // check weather service provider is alredy in watch list or not
              $result1 = $this->buyerModel->checkIsServiceProviderWatched($buyerId,$serviceProviderId);

              if (empty($result1)) {
                  $addToList = $this->buyerModel->addServiceProviderToWatchList($buyerId,$serviceProviderId);
                  if ($addToList) {
                      echo json_encode(['message' => 'Added to the list']);
                  } else {
                      echo json_encode(['message' => 'Some thing went wrong']);
                  }
              }
              else
              {
                  // if service provider is alredy in list then nothig to do
                  echo json_encode(['message' => 'Alredy in the list']);
              }
          }
      }
    }

    //   this function calls from asvertiesment details page
    public function removeItemFromWatchList($p_id,$u_id){
      if(!isLoggedIn()){
        $_SESSION['url']=URL();

        redirect('users/login');
      }
      echo $_POST['user_id'];
      if($_POST['user_id'] == 0){
        redirect('users/login');
      }
      else{
        if (isset($_POST['remove'])){
        
          $result = $this->buyerModel->removeItemFromWatchList($p_id, $u_id);
          if($result){
            echo flash('register_success', 'You are registered and can log in');
          }
          else{
            die('Something went wrong');
          }
  
        }
      }
    }

    //this function calls from watch list page in buyer profile which is linked to removeSingleServiceProvider.js
    //also this function will call from service provider profile page(serviceProviderPublic) which is linked to service-provider-watchlist.js
    public function removeServiceProviderFromWatchList(){
      if(!isLoggedIn()){
        $_SESSION['url']=URL();

        redirect('users/login');
      }
      
      if($_POST['user_id'] == 0){
        redirect('users/login');
      }
      else{
          $buyerId = $_POST['user_id'];
          $serviceProviderId = $_POST['service_provider_id'];

          if (isset($_POST['remove'])){

              $result = $this->buyerModel->removeServiceProviderFromWatchList($buyerId, $serviceProviderId);
              
              if($result){
                  if ($result) {
                      echo json_encode(['message' => 'Removed from list']);
                  } 
                  // else {
                  //     echo json_encode(['message' => 'Some thing went wrong']);
                  // }
              }
              else{
                  echo json_encode(['message' => 'Something went wrong']);
                  die('Something went wrong');
          }
  
        }
      }
    }

    //   this function calls from watch list page in buyer profile
    public function removeOneItemFromWatchList($p_id,$u_id){
      if(!isLoggedIn()){
        $_SESSION['url']=URL();

        redirect('users/login');
      }
      echo $_POST['user_id'];
      if($_POST['user_id'] == 0){
          
        redirect('users/login');
      }
      else{
        if (isset($_POST['remove'])){
        echo "This Works";
          $result = $this->buyerModel->removeOneItemFromWatchList($p_id, $u_id);
          if($result){
            echo flash('register_success', 'You are registered and can log in');
          }
          else{
            die('Something went wrong');
          }
  
        }
      }
    }



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

    // this is for buyer feedback
    // this will call views/buyers/feedback.js file 
    public function feedback(){
      if(!isLoggedIn()){
        $_SESSION['url']=URL();
        redirect('users/login');
      }

      $sellers = $this->buyerModel->getBuyerReviewedSellers($_SESSION['user_email']);
      $serviceProviders = $this->buyerModel->getBuyerReviewedServiceProviders($_SESSION['user_email']);
      $data =[
        'sellers' => $sellers,
        'serviceProviders' => $serviceProviders,
      ];
      // print_r($data);
      // exit();
      $this->view('buyers/feedback',$data);

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
    public function dashboard(){
      $this->view('service_providers/dashboard');
    }

    public function reactions(){
      if(!isLoggedIn()){
        $_SESSION['url']=URL();
        redirect('users/login');
      }

      $likedProducts = $this->buyerModel->getBuyerLikedProducts($_SESSION['user_email']);
      $dislikedProducts = $this->buyerModel->getBuyerDislikedProducts($_SESSION['user_email']);


      $data =[
        'likedProducts' => $likedProducts,
        'dislikedProducts' => $dislikedProducts
      ];

      $this->view('buyers/reactions',$data);
    }

  }  

?>