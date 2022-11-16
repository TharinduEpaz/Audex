<?php
    class Pages extends Controller{

        public function __construct(){
            // echo "pages loaded";
        }

        public function index(){
            $this->view('hello');
        }

        public function hello(){
        }
        
    }