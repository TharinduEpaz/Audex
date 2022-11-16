<?php
    //App Root
    require_once 'config/config.php';


    //Require libraries
    // require_once 'libraries/controller.php';
    // require_once 'libraries/core.php';
    // require_once 'libraries/database.php';

    //Auto load core libraries
    spl_autoload_register(function($className){
        require_once 'libraries/'.$className.'.php';
    });

