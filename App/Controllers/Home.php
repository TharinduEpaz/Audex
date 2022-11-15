<?php 

namespace App\Controllers;

class Home extends \Core\Controller {

    public function index(){
        echo "I am the index function at the Home Controller";
    }
    protected function before()
    {
        echo "before";
    }
    protected function after()
    {
        echo "after";
    }
}







?>