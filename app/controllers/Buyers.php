<?php
  class Buyers extends Controller{

    public function index(){
        $data = [];
        $this->view('buyers/index',$data);
    }


  }  

?>