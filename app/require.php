<?php
date_default_timezone_set("Asia/Kolkata");


    //App Root
    require_once 'config/config.php';

    //Load helpers
    require_once 'helpers/url_helper.php';
    require_once 'helpers/session_helper.php';
    
    //Require libraries
    // require_once 'libraries/controller.php';
    // require_once 'libraries/core.php';
    // require_once 'libraries/database.php';

    //Auto load core libraries
    spl_autoload_register(function($className){
        require_once 'libraries/'.$className.'.php';
    });

