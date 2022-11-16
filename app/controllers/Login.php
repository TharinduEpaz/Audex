<?php
    class Login extends Controller{

        public function __construct(){
            // echo "pages loaded";
        }

        public function index(){
            // $this->view('hello');

            $data = [
                'title' => 'Welcome!!!!!'
              ];
             
              $this->view('login', $data);
        }

        
    }