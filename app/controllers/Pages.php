<?php
    class Pages extends Controller{

        public function __construct(){
            // echo "pages loaded";
            $this->postModel = $this->model('Post');
        }

        public function index(){
            // $this->view('hello');

            $posts=$this->postModel->getPosts();
            $data = [
                'title' => 'Welcome!!!!!',
                'posts' => $posts
              ];
             
              $this->view('index', $data);
        }

        public function hello(){
        }
        
    }