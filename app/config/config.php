<?php
    date_default_timezone_set("Asia/Kolkata");
    //DB params
    define('DB_HOST', 'localhost');
    //root.cqiwgljqq7rv.ap-northeast-1.rds.amazonaws.com
    define('DB_USER','root');
    define('DB_PASS','');
    define('DB_NAME','userdb');

    //App Root
    define('APPROOT', dirname(dirname(__FILE__)));
    //URL Root
    define('URLROOT', 'http://localhost/Audex');
    //Site Name
    define('SITENAME', 'Audex');