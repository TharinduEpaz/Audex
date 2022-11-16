<?php
    class Pages extends Controller{

        public function __construct(){
            // echo "pages loaded";
            $this->postModel = $this->model('Post');
        }

        public function index(){
            // $this->view('hello');
            $data = [
                'title' => 'Welcome!!!!!'
              ];
             
              $this->view('index', $data);
        }

        public function hello(){
        }
        
    }