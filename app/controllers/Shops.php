<?php 
  class Shops extends Controller{

    public function index(){
        $data = [];

        $this->view('buyers/index',$data);

    }

  }
?>