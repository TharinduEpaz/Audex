<?php
    date_default_timezone_set("Asia/Kolkata");
    //DB params
    // define('DB_HOST', 'audex.ci55pw7kjzp5.ap-northeast-1.rds.amazonaws.com');
    // define('DB_USER','root');
    // define('DB_PASS','Audex123');
    // define('DB_NAME','userdb');

    define('DB_HOST', 'localhost');
    define('DB_USER','root');
    define('DB_PASS','');
    define('DB_NAME','test');



    //App Root
    define('APPROOT', dirname(dirname(__FILE__)));
    //URL Root
    define('URLROOT', 'http://localhost/Audex');
    //Site Name
    define('SITENAME', 'Audex');

    
    //Email password
    define('EMAIL_PASS', 'bcoxsurnseqiajuf');


    define('MAPS_API','AIzaSyC5ZntESaneCqqHfq1ngZ1PaHvYbGbsvNA');
    define('GEOCODE','https://maps.googleapis.com/maps/api/geocode/json?key='.MAPS_API);

    /*
     * Stripe API configuration
    */ 
    define('STRIPE_API_KEY','sk_test_51MVhcLDfLLASKhc4CUas6dl7QjlDwEjBDOEqu3WDZrmvz31v1ooDPUZ15STWkhEcizyTe0TIbR7Z8REJ5ujvmM4h00FnTCBGGm');
    define('STRIPE_PUBLISHABLE_KEY','pk_test_51MVhcLDfLLASKhc4Fslrqmsvk33Mc5ZWjpaoiu9PCXHDGstChyOj0mUARDt4uLCgfrl94Koo3AuExPSJw18m76o300w9p2INH8');
    define('STRIPE_SUCCESS_URL',URLROOT);
    define('STRIPE_CANCEL_URL',URLROOT);

?>
  