<?php
    /*
        *App core Class
        *Creates URL & loads core controller
        *URL FORMAT - /controller/method/params
    */

    class Core{
        protected $currentController='users';
        protected $currentMethod='index';
        protected $params=[];//[] represents an array

        public function __construct(){
            $url=$this->getURL();
            if(isset($url[0])){
                // print_r( ucwords($url[0])); 
                //Look in controllers for first value
                if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
                    //if exists, set as controller
                    $this->currentController=ucwords($url[0]);
                    //Unset 0 Index
                    unset($url[0]);
                }

            }
            

            //Require the controller
            require_once '../app/controllers/'.$this->currentController.'.php';

            //Instantiate controller class
            $this->currentController=new $this->currentController;

            //Check for second part of url
            if(isset($url[1])){
                //Check to see if method/function exists in controller
                if(method_exists($this->currentController,$url[1])){
                    $this->currentMethod=$url[1];
                    //Unset 1 index
                    unset($url[1]);
                }
            }
            //Get params
            $this->params=$url ? array_values($url) : [];//if(url)->array_values($url) else empty array []

            //Call a callback with array of params
            call_user_func_array([$this->currentController,$this->currentMethod],$this->params);
            
        }
        public function getURL(){           
            if(isset($_GET['url'])){
                $url=rtrim($_GET['url'],'/');
                $url=filter_var($url,FILTER_SANITIZE_URL);
                $url=explode('/',$url);
                return $url;
            }
        }
    }
?>