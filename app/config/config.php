<?php
    date_default_timezone_set("Asia/Kolkata");
    //DB params
    define('DB_HOST', 'audex1.cqiwgljqq7rv.ap-northeast-1.rds.amazonaws.com');
    define('DB_USER','root');
    define('DB_PASS','Audex123');
    define('DB_NAME','userdb');

    // define('DB_HOST', 'localhost');
    // define('DB_USER','root');
    // define('DB_PASS','');
    // define('DB_NAME','userdb');



    //App Root
    define('APPROOT', dirname(dirname(__FILE__)));
    //URL Root
    define('URLROOT', 'http://localhost/Audex');
    //Site Name
    define('SITENAME', 'Audex');

    /*
     * Stripe API configuration
    */ 
    define('STRIPE_API_KEY','sk_test_51MU2C4GlTSbBWjmimgrPHcMYPk02bQCrTJf9dSqMQG3nmcnGu4ylcNsUcIOR2vMOd4pDLPCKrO6oNQMN4cpz9ef700arP2rYRf');
    define('STRIPE_PUBLISHABLE_KEY','pk_test_51MU2C4GlTSbBWjmij5ZWbU3wOBLFWZUeBS4AcCwc0FIZQAc9ifJmoZyyK33TYAqWB80sqMouMEWn2UNwyJUbawqU00UMTnoldI');
    define('STRIPE_SUCCESS_URL',URLROOT);
    define('STRIPE_CANCEL_URL',URLROOT);