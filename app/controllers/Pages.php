<?php
    class Pages{

        public function __construct(){
            echo "pages loaded";
        }

        public function index(){
            echo 'Hi123';
        }

        public function hello($id){
            echo 'Hi .'.$id;
        }
        
    }