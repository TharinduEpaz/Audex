<?php
    class Pages extends Controller{

        public function __construct(){
            // echo "pages loaded";
        }

        public function index(){
            // echo 'hi';

            $data = [
                'title' => 'Welcome!!!!!'
              ];
             
              $this->view('pages/index', $data);
        }
        
    }