<?php
    class Sellers extends Controller{

        public function __construct(){
            // echo "pages loaded";
        }

        public function advertisements(){
            // echo 'hi';

            $data = [
                'title' => 'Welcome!!!!!'
              ];
             
              $this->view('sellers/advertisements', $data);
        }
        
    }