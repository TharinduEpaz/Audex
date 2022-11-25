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
    


  }  

?>