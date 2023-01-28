<?php
    date_default_timezone_set("Asia/Kolkata");
    //DB params
    define('DB_HOST', 'audex1.cqiwgljqq7rv.ap-northeast-1.rds.amazonaws.com');
    //root.cqiwgljqq7rv.ap-northeast-1.rds.amazonaws.com
    //audex.cqiwgljqq7rv.ap-northeast-1.rds.amazonaws.com
    define('DB_USER','root');
    define('DB_PASS','Audex123');
    define('DB_NAME','userdb');

    //App Root
    define('APPROOT', dirname(dirname(__FILE__)));
    //URL Root
    define('URLROOT', 'http://35.77.143.216');
    //Site Name
    define('SITENAME', 'Audex');