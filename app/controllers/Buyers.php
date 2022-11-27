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
    public function getProfile()
    { 
      if(!isLoggedIn()){
        redirect('users/login');
      }
      $details = $this->buyerModel->getBuyerDetails($_SESSION['user_id']);
      $data =[
        'user' => $details
      ];
      $this->view('buyers/getProfile',$data);
    }

    public function watchlist(){
      if(!isLoggedIn()){
        redirect('users/login');
      }
      $products = $this->buyerModel->getBuyerWatchProducts($_SESSION['user_id']);
      $data =[
        'products' => $products,
      ];
      $this->view('buyers/watchlist',$data);

    }
    


  }  

?>