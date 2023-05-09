<?php
date_default_timezone_set("Asia/Kolkata");
    class User{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        //Register User
        public function register($data,$dat){
            $this->db->query('INSERT INTO user (first_name, second_name, email,  user_type,registered_date,password,otp,email_active) VALUES(:first_name, :second_name, :email,:user_type,:t, :password,:otp, 0)');
            //Bind values
            $this->db->bind(':first_name', $data['first_name']);
            $this->db->bind(':second_name', $data['second_name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':user_type', $data['user_type']);
            $this->db->bind(':t', $dat);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':otp', $data['otp_hashed']);

            //Execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function updateUserActivated($email,$time){
            $this->db->query('UPDATE user  set email_active=1,registered_date=:t WHERE email=:email');
            //Bind values
            $this->db->bind(':email', $email);
            $this->db->bind(':t', $time);

            //Execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function updateUserPhone($email,$phone){
            $this->db->query('UPDATE user set phone_number=:phone WHERE email=:email');
            //Bind values
            $this->db->bind(':email', $email);
            $this->db->bind(':phone', $phone);

            //Execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        

        public function updateUserEmail($email, $id){
            $this->db->query('UPDATE user set email=:email WHERE user_id=:id');
            //Bind values
            $this->db->bind(':email', $email);  
            $this->db->bind(':id', $id);

            //Execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function updatePhoneOTP($otp,$id){
            $this->db->query('UPDATE user set phone_otp=:otp WHERE user_id=:id');
            //Bind values
            $this->db->bind(':otp', $otp);
            $this->db->bind(':id', $id);

            //Execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }

        public function updateEmailOTP($otp,$id){
            $this->db->query('UPDATE user set otp=:otp WHERE user_id=:id');
            //Bind values
            $this->db->bind(':otp', $otp);
            $this->db->bind(':id', $id);

            //Execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }

        //Send Email
        // public function sendEmail($email,$otp,$fname){
        //     $to=$email;
        //     $sender='audexlk@gmail.com';
        //     $mail_subject='Verify Email Address';
        //     $email_body='<p>Dear '.$fname.',<br>Thank you for signing up to Audexlk. In order to'; 
        //     $email_body.=' validate your account you need enter the given OTP in the verification page.<br>';
        //     $email_body.='<h3>The OTP</h3><br><h1>'.$otp.'</h1><br>';
        //     $email_body.='Thank you,<br>Audexlk</p>';
        //     $header="From:{$sender}\r\nContent-Type:text/html;";
        //     $send_mail_result=mail($to,$mail_subject,$email_body,$header);
        //     if($send_mail_result){
        //         return true;
        //     }
        //     else{
        //         return false;
        //     }
        // }

        //Add to seller
        public function addToSeller($data){
            $this->db->query('INSERT INTO seller (user_id,email) VALUES(:user_id,:email)');
            //Bind values
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':email', $data['email']);

            //Execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        //Add to buyer
        public function addToBuyer($data){
            $this->db->query('INSERT INTO buyer (user_id,email) VALUES(:user_id,:email)');
            //Bind values
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':email', $data['email']);

            //Execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        //Add to admin
        public function addToAdmin($data){
            $this->db->query('INSERT INTO admin (name,email,phone_number,password) VALUES(:first_name,:email,:phone,:password)');
            //Bind values
            $this->db->bind(':name', $data['first_name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':phone', $data['phone']);
            $this->db->bind(':password', $data['password']);

            //Execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        //Add to service provider
        public function addToServiceProvider($data){
            $this->db->query('INSERT INTO service_provider (user_id) VALUES(:user_id)');
            //Bind values
            $this->db->bind(':user_id', $data['user_id']);

            //Execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function logintime($email,$dat){
            $this->db->query('UPDATE user set last_login=:t WHERE email = :email');
            $this->db->bind(':email', $email);
            $this->db->bind(':t', $dat);
            $row = $this->db->execute(); //single row

        }

        //Login user
        public function login($email, $password,$dat){
            $this->db->query('SELECT * FROM user WHERE email = :email AND email_active=1');
            $this->db->bind(':email', $email);

            $row = $this->db->single(); //single row

            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)){
                $this->logintime($email,$dat);
                return $row;
            }else{
                return false;
            }
        }


        public function verifyotp($otp, $otp_hashed){
            if(password_verify($otp, $otp_hashed)){
                return true;
            }else{
                return false;
            }
        }
        

        public function updatePasswordAttempts($email){
            $this->db->query('UPDATE user set password_wrong_attempts=password_wrong_attempts+1 WHERE email = :email');
            $this->db->bind(':email', $email);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }

        public function updatePasswordAttemptsZero($email){
            $this->db->query('UPDATE user set password_wrong_attempts=0 WHERE email = :email');
            $this->db->bind(':email', $email);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }
        

        public function suspendAccount($email,$date){
            $this->db->query('UPDATE user set suspended=1,suspend_end_time=:date WHERE email = :email');
            $this->db->bind(':email', $email);
            $this->db->bind(':date', $date);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }

        //Find user by email
        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM user WHERE email = :email AND email_active=1');
            //Bind value
            $this->db->bind(':email', $email);
            $row = $this->db->single();
            //Check row
            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        //Find user by phone number
        public function findUserByPhone($phone){
            $this->db->query('SELECT * FROM user WHERE phone_number = :phone');
            //Bind value
            $this->db->bind(':phone', $phone);
            $row = $this->db->single();
            //Check row
            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        //Not activated
        public function notActivated($email){
            $this->db->query('SELECT * FROM user WHERE email = :email AND email_active=0');
            $this->db->bind(':email', $email);
            $row = $this->db->single();

            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function updateOtp($otp,$time,$email){
            $this->db->query('UPDATE user set otp=:otp,registered_date=:t WHERE email = :email');
            $this->db->bind(':email', $email);
            $this->db->bind(':otp', $otp);
            $this->db->bind(':t', $time);
            $row = $this->db->execute(); //single row
            if($row){
                return true;
            }else{
                return false;
            }

        }
        public function updatePassword($password,$id){
            $this->db->query('UPDATE user set password=:password WHERE user_id = :id');
            $this->db->bind(':id', $id);
            $this->db->bind(':password', $password);
            $row = $this->db->execute(); //single row
            if($row){
                return true;
            }else{
                return false;
            }

        }

        public function getUserDetails($id){
            $this->db->query('SELECT * FROM user WHERE user_id = :id');
            $this->db->bind(':id' , $id);
            
            $row = $this->db->single();
            return $row;
        }

        public function getUserDetailsByEmail($email){
            $this->db->query('SELECT * FROM user WHERE email = :email');
            $this->db->bind(':email' , $email);
            
            $row = $this->db->single();
            return $row;
        }

        public function updateProfilePicture($data){
            $this->db->query('UPDATE user SET profile_pic = :profile_picture WHERE user_id = :id ');
            
            $this->db->bind(':profile_picture' , $data['image1']);
            $this->db->bind(':id' , $data['id']);
            // $this->db->dbh->lastInsertId();

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }

        public function updateProfile($data){
            $this->db->query('UPDATE user SET first_name = :first_name,second_name = :second_name, address1 = :address1, address2 = :address2, phone_number = :phone_number WHERE user_id = :id ');
            
            $this->db->bind(':first_name' , $data['first_name']);
            $this->db->bind(':second_name' , $data['second_name']);
            $this->db->bind(':address1' , $data['address1']);
            $this->db->bind(':address2' , $data['address2']);
            $this->db->bind(':phone_number' , $data['phone_number']);
            $this->db->bind(':id' , $data['id']);
            // $this->db->dbh->lastInsertId();

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function deleteUserProfile($id){
            $this->db->query('SELECT email FROM user WHERE user_id = :id');
            $this->db->bind(':id' , $id);

            $row = $this->db->single();

            $this->db->query('DELETE FROM seller WHERE email = :email');
            $this->db->bind(':email' , $row->email);

            $result1 = $this->db->execute();

            $this->db->query('UPDATE user SET is_deleted = 1 WHERE email = :email ');    
            $this->db->bind(':email' , $row->email);

            // if($this->db->execute()){
            //     return true;
            // } else {
            //     return false;
            // }

            $result2 = $this->db->execute();

            if($result1 && $result2){
                return true;
            }
            else{
                return false;
            }
        }
        public function findUserDetailsByEmail($email){
            $this->db->query('SELECT * FROM user WHERE email = :email');
            //Bind value
            $this->db->bind(':email', $email);
            $row = $this->db->single();
            //Check row
            if($this->db->rowCount() > 0){
                return $row;
            }else{
                return false;
            }
        }
        

        //Get user id
        public function getUserId($email){
            $this->db->query('SELECT * FROM user WHERE email = :email');
            //Bind value
            $this->db->bind(':email', $email);
            $row = $this->db->single();
            //Check row
            if($this->db->rowCount() > 0){
                return $row;
            }else{
                return false;
            }
        }

        public function getAdvertiesment(){
            $this->db->query('SELECT * FROM product WHERE is_deleted=0 && is_paid=1');
            $results = $this->db->resultSet();
            return $results;

        }
        //this function calls from links in the index page 
        public function getAdvertiesmentByCategory($arg1){
            $this->db->query('SELECT * FROM product WHERE product_category = :category && is_deleted=0 && is_paid=1');
            $this->db->bind(':category', $arg1);
            $results = $this->db->resultSet();
            return $results;

        }
        public function getAdvertiesmentById($id){
            $this->db->query('SELECT * FROM product WHERE product_id = :id');
            $this->db->bind(':id' , $id);

            $row = $this->db->single();
            return $row;
        }

        public function getAdvertisementById($id){
            $this->db->query('SELECT * FROM product WHERE product_id = :id');
            $this->db->bind(':id', $id);
            $row = $this->db->single();
            return $row;
        }

        public function getSellerDetails($email){
            $this->db->query('SELECT * FROM seller WHERE email = :email');
            $this->db->bind(':email' , $email);

            $row = $this->db->single();
            return $row;
        }

        public function getBuyerDetails($email){
            $this->db->query('SELECT * FROM buyer WHERE email = :email');
            $this->db->bind(':email' , $email);

            $row = $this->db->single();
            return $row;
        }

        public function getService_ProviderDetails($id){
            $this->db->query('SELECT * FROM service_provider WHERE user_id = :id');
            $this->db->bind(':id' , $id);

            $row = $this->db->single();
            return $row;
        }

        public function getServiceProviderEvents($id){
            $this->db->query('SELECT * FROM events WHERE user_id = :id');
            $this->db->bind(':id' , $id);

            $row = $this->db->resultSet();
            return $row;
        }

        public function getEventDates($serviceProviderEmail, $eventName){
            $this->db->query('SELECT user_id FROM user WHERE email = :serviceProviderEmail');
            $this->db->bind(':serviceProviderEmail' , $serviceProviderEmail);
            $row1 = $this->db->single();   
            
            $this->db->query('SELECT date FROM events WHERE user_id = :id AND name = :eventName');
            $this->db->bind(':id' , $row1->user_id);
            $this->db->bind(':eventName' , $eventName);

            $row = $this->db->resultSet();
            return $row;
            
        }


        public function getSellerMoreDetails($email){
            $this->db->query('SELECT * FROM user WHERE email = :email');
            $this->db->bind(':email' , $email);

            $row = $this->db->single();
            return $row;
        }

        public function getFeedbacks($email){
            $this->db->query('SELECT * FROM rate WHERE email_rate_receiver = :email');
            $this->db->bind(':email' , $email);

            $row = $this->db->resultSet();
            return $row;
        }

        public function getFeedbacksCount($email){
            $this->db->query('SELECT COUNT(email_rate_receiver) AS count FROM rate WHERE email_rate_receiver = :email');
            $this->db->bind(':email' , $email);
            $row = $this->db->resultSet();
            if($row){
                return $row;
            }else{
                return NULL;
            }
            
        }

        // public function getFeedbacks($email){
        //     $this->db->query('SELECT * FROM rate WHERE email_rate_receiver = :email');
        //     $this->db->bind(':email' , $email);

        //     $row = $this->db->resultSet();
        //     return $row;
        // }

        public function getAuctionById($id){
            $this->db->query('SELECT * FROM auction WHERE product_id = :id && is_finished=0 && is_active=1');
            $this->db->bind(':id' , $id);

            $row = $this->db->single();
            if($row){
                return $row;
            }else{
                return "Error";
            }
        }

        public function update_view_count($id){
            $this->db->query('UPDATE product SET view_count = view_count + 1 WHERE product_id = :id');
            $this->db->bind(':id' , $id);

            $row = $this->db->execute(); //single row
            if($row){
                return true;
            }else{
                return false;
            }
        }

        public function checkViewCount($id,$email){
            $this->db->query('SELECT * FROM view_item WHERE product_id = :id AND email_viewer = :email');
            $this->db->bind(':id' , $id);
            $this->db->bind(':email' , $email);

            $row = $this->db->single();
            if($row){
                return true;
            }else{
                return false;
            }
        }
        public function addViewDetails($id,$email){
            $this->db->query('INSERT into view_item(product_id,email_viewer) VALUES(:id,:email)');
            $this->db->bind(':id' , $id);
            $this->db->bind(':email' , $email);

            $row = $this->db->single();
            if($row){
                return true;
            }else{
                return false;
            }
        }
        



        public function getAuctionById_withfinished($id){
            $this->db->query('SELECT * FROM auction WHERE product_id = :id ');
            $this->db->bind(':id' , $id);

            $row = $this->db->single();
            if($row){
                return $row;
            }else{
                return "Error";
            }
        }

        public function bidExpired($auction_id){
            $this->db->query('UPDATE auction SET is_finished=1, is_active=0 WHERE auction_id = :id');
            $this->db->bind(':id' , $auction_id);

            $row = $this->db->execute(); //single row
            if($row){
                return true;
            }else{
                return false;
            }
        }
        
        public function getBidList($bid_id){
            $this->db->query('SELECT * FROM bid_list WHERE bid_id = :id ');
            $this->db->bind(':id' , $bid_id);

            $row = $this->db->single();
            if($row){
                return $row;
            }else{
                return NULL;
            }
        }

        public function updateBidStatus($bid_id){
            $this->db->query('UPDATE bid_list SET is_rejected=1 WHERE bid_id = :id ');
            $this->db->bind(':id' , $bid_id);

            $row = $this->db->execute(); //single row
            if($row){
                return true;
            }else{
                return false;
            }
        }

        public function updateBidAcceptedStatus($bid_id,$price){
            $this->db->query('UPDATE bid_list SET is_accepted=1 WHERE bid_id = :id && price=:price');
            $this->db->bind(':id' , $bid_id);
            $this->db->bind(':price' , $price);

            $row = $this->db->execute(); //single row
            if($row){
                return true;
            }else{
                return false;
            }
        }

        public function getAuctionDetails($id){
            $this->db->query('SELECT * FROM auction WHERE product_id = :id');
            $this->db->bind(':id' , $id);

            $row = $this->db->single();

            // SELECT email_buyer, MAX(price) FROM bid WHERE auction_id = 9 GROUP BY email_buyer ORDER BY(MAX(price)) DESC;
            $this->db->query('SELECT *,MAX(bid.price) as max_price,MAX(bid.bid_id) as max_bid_id FROM bid INNER JOIN auction ON auction.auction_id = bid.auction_id WHERE auction.auction_id = :id GROUP BY bid.email_buyer ORDER BY MAX(bid.price) DESC');
            $this->db->bind(':id' , $row->auction_id);
            $results = $this->db->resultSet();
            if($results){
                return $results;
            }else{
                return NULL;
            }
        }
        public function getAuctionDetailsNoRows($id){
            $this->db->query('SELECT * FROM auction WHERE product_id = :id');
            $this->db->bind(':id' , $id);

            $row = $this->db->single();

            $this->db->query('SELECT *,MAX(bid.price) as max_price,MAX(bid.bid_id) as max_bid_id FROM bid INNER JOIN auction ON auction.auction_id = bid.auction_id WHERE auction.auction_id = :id GROUP BY bid.email_buyer ORDER BY MAX(bid.price) DESC');
            $this->db->bind(':id' , $row->auction_id);
            $results = $this->db->resultSet();
            if($results){
                $rowCount=$this->db->rowCount();
                return $rowCount;
            }else{
                return NULL;
            }
        }
        public function getAllAuctionDetails($id){
            $this->db->query('SELECT * FROM auction WHERE product_id = :id');
            $this->db->bind(':id' , $id);

            $row = $this->db->single();

            $this->db->query('SELECT * FROM bid INNER JOIN auction ON auction.auction_id = bid.auction_id WHERE auction.auction_id = :id ORDER BY bid.price DESC');
            $this->db->bind(':id' , $row->auction_id);
            $results = $this->db->resultSet();
            if($results){
                return $results;
            }else{
                return NULL;
            }
        }

        public function add_bid($price,$auction_id,$dat){

            $this->db->query('INSERT INTO bid (auction_id, email_buyer, price, date_time) VALUES (:auction_id, :email_buyer,:price, :t)');
            $this->db->bind(':auction_id', $auction_id);
            $this->db->bind(':email_buyer', $_SESSION['user_email']);
            $this->db->bind(':price', $price);
            $this->db->bind(':t', $dat);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function checkIsItemWatched($p_id,$user_id){
            $this->db->query('SELECT email FROM user WHERE user_id = :id');
            $this->db->bind(':id' , $user_id);

            $row = $this->db->single();

            $this->db->query('SELECT * FROM add_watch_list_product WHERE email_buyer = :email AND product_id = :p_id');
            //Bind value
            $this->db->bind(':email', $row->email);
            $this->db->bind(':p_id', $p_id);

            $result =  $this->db->single();

            return $result;

        }
        // public function getBuyerWatchProducts($email){
        //     $this->db->query('SELECT product_id FROM add_watch_list_product WHERE email_buyer = :email');
        //     $this->db->bind(':email' , $email);
        //     $results = $this->db->resultSet();

        //     // foreach($results as $result):
        //     //     echo gettype($result) . "</br>";
        //     //     echo $result->product_id . "</br>";
        //     //     echo gettype($result->product_id) . "</br>";
        //     // endforeach;

        //     $items = [];
        //     foreach($results as $result):
        //         $id = $result->product_id;
        //         settype($id,"integer");
        //         $this->db->query('SELECT * FROM product WHERE product_id = :id');
        //         $this->db->bind(':id' , $id);
        //         $item = $this->db->single();
        //         array_push($items,$item);
        //     endforeach;
        //     return $items;
            
        // }
        // public function getBuyerWatchServiceProviders($email){
        //     $this->db->query('SELECT email_service_provider FROM add_watch_list_service_provider WHERE email_buyer = :email');
        //     $this->db->bind(':email' , $email);
        //     $results = $this->db->resultSet();

        //     // foreach($results as $result):
        //     //     echo gettype($result) . "</br>";
        //     //     echo $result->product_id . "</br>";
        //     //     echo gettype($result->product_id) . "</br>";
        //     // endforeach;

        //     $serviceProviders = [];
        //     foreach($results as $result):
        //         $service_provider_email = $result->email_service_provider;
        //         settype($id,"integer");
        //         $this->db->query('SELECT * FROM user WHERE email = :service_provider_email');
        //         $this->db->bind(':service_provider_email' , $service_provider_email);
        //         $service_provider = $this->db->single();
        //         array_push($serviceProviders,$service_provider);
        //     endforeach;
        //     return $serviceProviders;
            
        // }

        public function update_price($price,$product_id){

            $this->db->query('UPDATE product SET price = :price WHERE product_id = :product_id');
            $this->db->bind(':product_id', $product_id);
            $this->db->bind(':price', $price);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        // public function addItemToWatchList($p_id,$user_id){

        //     $this->db->query('SELECT email FROM user WHERE user_id = :id');
        //     $this->db->bind(':id' , $user_id);

        //     $row = $this->db->single();

        //     $this->db->query('INSERT INTO add_watch_list_product (email_buyer,product_id) VALUES(:email,:p_id)');
        //     //Bind value
        //     $this->db->bind(':email', $row->email);
        //     $this->db->bind(':p_id', $p_id);

        //     if($this->db->execute()){
        //         return true;
        //     }else{
        //         return false;
        //     }
        // }

        // public function removeItemFromWatchList($p_id,$user_id){

        //     $this->db->query('SELECT email FROM user WHERE user_id = :id');
        //     $this->db->bind(':id' , $user_id);

        //     $row = $this->db->single();

        //     $this->db->query('DELETE FROM add_watch_list_product WHERE add_watch_list_product.product_id = :p_id AND add_watch_list_product.email_buyer = :email; ');
        //     //Bind value
        //     $this->db->bind(':email', $row->email);
        //     $this->db->bind(':p_id', $p_id);

        //     if($this->db->execute()){
        //         return true;
        //     }else{
        //         return false;
        //     }
        // }

        // public function removeOneItemFromWatchList($p_id,$user_id){

        //     $this->db->query('SELECT email FROM user WHERE user_id = :id');
        //     $this->db->bind(':id' , $user_id);

        //     $row = $this->db->single();

        //     $this->db->query('DELETE FROM add_watch_list_product WHERE add_watch_list_product.product_id = :p_id AND add_watch_list_product.email_buyer = :email');
        //     //Bind value
        //     $this->db->bind(':email', $row->email);
        //     $this->db->bind(':p_id', $p_id);

        //     if($this->db->execute()){
        //         return true;
        //     }else{
        //         return false;
        //     }
        // }
        // add service provider to watch list function
        // public function addServiceProviderToWatchList($buyerId,$serviceProviderId){

        //     $this->db->query('SELECT email FROM user WHERE user_id = :id');
        //     $this->db->bind(':id' , $buyerId);
        //     $buyer_email = $this->db->single();
            
        //     $this->db->query('SELECT email FROM user WHERE user_id = :id');
        //     $this->db->bind(':id' , $serviceProviderId);
        //     $service_provider_email = $this->db->single();
            

        //     $this->db->query('INSERT INTO add_watch_list_service_provider (email_buyer,email_service_provider) VALUES(:buyer_email,:service_provider_email)');
        //     //Bind value
        //     $this->db->bind(':buyer_email', $buyer_email->email);
        //     $this->db->bind(':service_provider_email', $service_provider_email->email);

        //     if($this->db->execute()){
        //         return true;
        //     }else{
        //         return false;
        //     }
        // }

        // public function removeServiceProviderFromWatchList($buyerId, $serviceProviderId){

        //     $this->db->query('SELECT email FROM user WHERE user_id = :id');
        //     $this->db->bind(':id' , $buyerId);
        //     $buyer_email = $this->db->single();

        //     $this->db->query('SELECT email FROM user WHERE user_id = :id');
        //     $this->db->bind(':id' , $serviceProviderId);
        //     $service_provider_email = $this->db->single();

        //     $this->db->query('DELETE FROM add_watch_list_service_provider WHERE add_watch_list_service_provider.email_buyer = :buyer_email AND add_watch_list_service_provider.email_service_provider = :service_provider_email ; ');
        //     //Bind value
        //     $this->db->bind(':buyer_email', $buyer_email->email);
        //     $this->db->bind(':service_provider_email', $service_provider_email->email);

        //     if($this->db->execute()){
        //         return true;
        //     }else{
        //         return false;
        //     }
        // }

        public function checkIsServiceProviderWatched($buyerId,$serviceProviderId){
            $this->db->query('SELECT email FROM user WHERE user_id = :id');
            $this->db->bind(':id' , $buyerId);
            $buyer_email = $this->db->single();
            
            $this->db->query('SELECT email FROM user WHERE user_id = :id');
            $this->db->bind(':id' , $serviceProviderId);
            $service_provider_email = $this->db->single();

            $this->db->query('SELECT * FROM add_watch_list_service_provider WHERE email_buyer = :buyer_email AND email_service_provider = :service_provider_email');
            //Bind value
            $this->db->bind(':buyer_email', $buyer_email->email);
            $this->db->bind(':service_provider_email', $service_provider_email->email);


            $result =  $this->db->single();

            return $result;

        }

        public function checkAddedLike($p_id,$user_id){
            $this->db->query('SELECT email FROM user WHERE user_id = :id');
            $this->db->bind(':id' , $user_id);

            $row = $this->db->single();

            $this->db->query('SELECT liked FROM reaction WHERE email_buyer = :email AND product_id = :p_id AND liked = 1');
            //Bind value
            $this->db->bind(':email', $row->email);
            $this->db->bind(':p_id', $p_id);

            $result =  $this->db->single();

            return $result;
        }
        public function checkAddedDislike($p_id,$user_id){
            $this->db->query('SELECT email FROM user WHERE user_id = :id');
            $this->db->bind(':id' , $user_id);

            $row = $this->db->single();

            $this->db->query('SELECT disliked FROM reaction WHERE email_buyer = :email AND product_id = :p_id AND disliked = 1');
            //Bind value
            $this->db->bind(':email', $row->email);
            $this->db->bind(':p_id', $p_id);

            $result =  $this->db->single();

            return $result;
        }

        // get the current like count
        public function checkLikeCount($p_id){
            $this->db->query('SELECT COUNT(liked) as likedCount FROM reaction WHERE  product_id = :p_id AND liked = 1');
            //Bind value
            $this->db->bind(':p_id', $p_id);

            $result =  $this->db->single();

            return $result->likedCount;
        }
        // get the current dislike count
        public function checkDislikeCount($p_id){
            $this->db->query('SELECT COUNT(disliked) as dislikedCount FROM reaction WHERE  product_id = :p_id AND disliked = 1');
            //Bind value
            $this->db->bind(':p_id', $p_id);

            $result =  $this->db->single();

            return $result->dislikedCount;
        }

        public function addLikeToProduct($p_id,$user_id){

            $this->db->query('SELECT email FROM user WHERE user_id = :id');
            $this->db->bind(':id' , $user_id);

            $row = $this->db->single();

            $this->db->query('INSERT INTO reaction (email_buyer,product_id,liked,disliked) VALUES (:email,:p_id,1,0)');
            //Bind value
            $this->db->bind(':email', $row->email);
            $this->db->bind(':p_id', $p_id);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        public function updateLikeToProduct($p_id,$user_id){

            $this->db->query('SELECT email FROM user WHERE user_id = :id');
            $this->db->bind(':id' , $user_id);

            $row = $this->db->single();

            $this->db->query('UPDATE reaction SET liked = 1, disliked = 0  WHERE email_buyer = :email AND product_id = :p_id ');
            //Bind value
            $this->db->bind(':email', $row->email);
            $this->db->bind(':p_id', $p_id);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function removeLikeFromProduct($p_id,$user_id){

            $this->db->query('SELECT email FROM user WHERE user_id = :id');
            $this->db->bind(':id' , $user_id);

            $row = $this->db->single();

            $this->db->query('DELETE FROM reaction WHERE reaction.product_id = :p_id AND reaction.email_buyer = :email AND liked = 1');
            //Bind value
            $this->db->bind(':email', $row->email);
            $this->db->bind(':p_id', $p_id);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }


        public function addDislikeToProduct($p_id,$user_id){

            $this->db->query('SELECT email FROM user WHERE user_id = :id');
            $this->db->bind(':id' , $user_id);

            $row = $this->db->single();

            $this->db->query('INSERT INTO reaction (email_buyer,product_id,liked,disliked) VALUES (:email,:p_id,0,1)');
            //Bind value
            $this->db->bind(':email', $row->email);
            $this->db->bind(':p_id', $p_id);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        public function updateDislikeToProduct($p_id,$user_id){

            $this->db->query('SELECT email FROM user WHERE user_id = :id');
            $this->db->bind(':id' , $user_id);

            $row = $this->db->single();

            $this->db->query('UPDATE reaction SET liked = 0, disliked = 1  WHERE email_buyer = :email AND product_id = :p_id ');
            //Bind value
            $this->db->bind(':email', $row->email);
            $this->db->bind(':p_id', $p_id);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        

        public function removeDislikeFromProduct($p_id,$user_id){

            $this->db->query('SELECT email FROM user WHERE user_id = :id');
            $this->db->bind(':id' , $user_id);

            $row = $this->db->single();

            $this->db->query('DELETE FROM reaction WHERE reaction.product_id = :p_id AND reaction.email_buyer = :email AND disliked = 1');
            //Bind value
            $this->db->bind(':email', $row->email);
            $this->db->bind(':p_id', $p_id);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        //Fee payment
        public function addPayment($amount,$product_id,$payment_intent,$payment_intent_client_secret,$redirect_status){
            $this->db->query('INSERT INTO payment (amount,payment_method,date,product_id,payment_intent,payment_intent_client_secret,redirect_status) VALUES (:amount,"stripe",NOW(),:product_id,:payment_intent,:payment_intent_client_secret,:redirect_status)');
            //Bind value
            $this->db->bind(':amount', $amount);
            $this->db->bind(':product_id', $product_id);
            $this->db->bind(':payment_intent', $payment_intent);
            $this->db->bind(':payment_intent_client_secret', $payment_intent_client_secret);
            $this->db->bind(':redirect_status', $redirect_status);

            if($this->db->execute()){
                $this->db->query('UPDATE product SET is_paid = 1 WHERE product_id = :product_id');
                $this->db->bind(':product_id', $product_id);

                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function getServiceProviders(){
            $this->db->query('SELECT user_id,first_name,second_name,profile_image,profession,Rating FROM service_provider_view');
            $result = $this->db->resultSet();
            return $result;
        }

        public function searchItems($searchedTerm){
            $this->db->query('SELECT * FROM product WHERE product_title LIKE :searchedTerm');
            $this->db->bind(':searchedTerm', '%'.$searchedTerm.'%');

            $results = $this->db->resultSet();
            return $results;

        }
        // this function works when filter applyies without a search  term
        public function searchAndFilterItems($filter,$categories){
            $sql='';
            $categorySql = '';
            

            if (!empty($categories)) {
                $categorySql = '(';

                // print_r($categories);
              
                foreach ($categories as $value) {
                    $categorySql.= 'product_category = :'.$value;

                    $categorySql.= ' OR ';
                //   $categoryConditions[] = "product_category = ':category'";
                }
                $categorySql=substr($categorySql,0,-3);
                $categorySql.= ')';
                // echo $categorySql;

                // $categorySql = "(" . implode(" OR ", $categoryConditions) . ")";
              }

            foreach($filter as $key=>$value){
                if($key==='min_price'){
                    $sql.='price >= :min_price';
                }
                else if($key=='max_price'){
                    $sql.='price <= :max_price';
                }
                else{
                    $sql.=$key." = :".$key."";
                }
                $sql.=' AND ';
            }
            if(empty($categories)){
                $sql=substr($sql,0,-4);
            }
            


            $this->db->query('SELECT * FROM product WHERE '.$sql .$categorySql);
            

            foreach($filter as $key=>$value){
                $this->db->bind(':'.$key, $value);
            }
            foreach($categories as $value){
                $this->db->bind(':'.$value, $value);
            }

            // echo 'SELECT * FROM product WHERE '.$sql .$categorySql;
            // exit();

            $results = $this->db->resultSet();
            return $results;
        }
        // this function calls when search term is set
        // public function searchAndFilterItemsWithSearchTerm($filter,$searchedTerm){
        //     $sql='';
        //     foreach($filter as $key=>$value){
        //         if($key==='min_price'){
        //             $sql.='product.price >= :min_price';
        //         }
        //         else if($key=='max_price'){
        //             $sql.='product.price <= :max_price';
        //         }
        //         else{
        //             $sql.="product".$key." = :".$key."";
        //         }
        //         $sql.=' AND ';
        //     }
        //     $sql=substr($sql,0,-4);

        //     // echo $sql;
            
        //     // $this->db->query('SELECT * FROM product WHERE product_title LIKE :searchedTerm AND '.$sql);
        //     $this->db->query('SELECT * FROM product LEFT JOIN auction ON product.product_id = auction.product_id WHERE '.$sql.' AND product.brand="ecwc" AND auction.is_active = 1 AND auction.is_finished = 0');
        //     $this->db->bind(':searchedTerm', '%'.$searchedTerm.'%');

        //     foreach($filter as $key=>$value){
        //         $this->db->bind(':'.$key, $value);
        //     } 
        //     // print_r($this->db);
        //     // exit;
        //     $results = $this->db->resultSet();
        //     return $results;
        // }

        public function searchAndFilterItemsWithSearchTerm($filter,$categories){

            if( empty($categories) ){
                $sql='';
                foreach($filter as $key=>$value){
                    if($key==='min_price'){
                        $sql.='product.price >= :min_price';
                    }
                    else if($key=='max_price'){
                        $sql.='product.price <= :max_price';
                    }
                    else{
                        $sql.="product".$key." = :".$key."";
                    }
                    $sql.=' AND ';
                }
                $sql=substr($sql,0,-4);
    
                // echo $sql;
                
                $this->db->query('SELECT * FROM product WHERE '.$sql);
    
    
                foreach($filter as $key=>$value){
                    $this->db->bind(':'.$key, $value);
                } 
                // print_r($this->db);
                // exit;
                $results = $this->db->resultSet();
                return $results;

            }
            else{
                // Create Query part product table conditions
                // product.price >= :min_price AND product.condition = :condition AND
                $sql='';
                foreach($filter as $key=>$value){
                    if($key==='min_price'){
                        $sql.='product.price >= :min_price';
                    }
                    else if($key=='max_price'){
                        $sql.='product.price <= :max_price';
                    }
                    else{
                        $sql.="product".$key." = :".$key."";
                    }
                    $sql.=' AND ';
                }
                // $sql=substr($sql,0,-4);
    

                
                $this->db->query('SELECT p.* FROM product p JOIN ProductCategory pc ON p.product_id = pc.product_id WHERE '.$sql);
    
    
                foreach($filter as $key=>$value){
                    $this->db->bind(':'.$key, $value);
                }
            }
        }

        public function searchServiceProviders($searchedTerm){
            // search in both tables user and service provider view
            $this->db->query('SELECT u.*,sv.* FROM user u JOIN service_provider_view sv ON u.user_id = sv.user_id WHERE (u.first_name LIKE :searchedTerm OR u.second_name LIKE :searchedTerm) AND u.user_type = "service_provider"');
            $this->db->bind(':searchedTerm', '%'.$searchedTerm.'%');

            $results = $this->db->resultSet();
            return $results;

        }

        
        public function getServiceProvidersPublic($id){
        
            $this->db->query('SELECT * from service_provider_view WHERE user_id = :id');
            $this->db->bind(':id', $id);
            $result = $this->db->single();
            return $result;

        }

        // public function getEvents($id){
        //     $this->db->query('SELECT * FROM event WHERE user_id = :id');
        //     $this->db->bind(':id', $id);
        //     $result = $this->db->resultSet();
        //     return $result;
        // }
        
        public function checkAddedRate($email_rater, $email_rate_receiver){


            $this->db->query('SELECT rate_id FROM `rate` WHERE email_rater = :email_rater AND email_rate_receiver = :email_rate_receiver ');
            //Bind value
            $this->db->bind(':email_rater', $email_rater);
            $this->db->bind(':email_rate_receiver', $email_rate_receiver);

            $result =  $this->db->single();
            
            // if there no rate value it will be null
            return $result->rate_id?? NULL;
        }
        public function checkAddedReview($buyer_id, $seller){
            $this->db->query('SELECT email FROM user WHERE user_id = :buyer_id');
            $this->db->bind(':buyer_id' , $buyer_id);
            $row = $this->db->single();

            $this->db->query('SELECT review FROM seller_rate_buyer WHERE email_buyer = :buyer AND email_seller = :seller ');
            //Bind value
            $this->db->bind(':buyer', $row->email);
            $this->db->bind(':seller', $seller);

            $result =  $this->db->single();
            
            // if there no rate value it will be null
            return $result->review?? NULL;
        }
        public function rateSeller($rating,$email_rater,$email_rate_receiver,$date,$review){
            // get the email from buyer id

            $this->db->query('INSERT INTO rate (email_rater,email_rate_receiver,rate,date,review) VALUES (:email_rater,:email_rate_receiver,:rate,:date,:review)');
            $this->db->bind(':email_rater', $email_rater);
            $this->db->bind(':email_rate_receiver', $email_rate_receiver);
            $this->db->bind(':rate', $rating);
            $this->db->bind(':date', $date);
            $this->db->bind(':review', $review);

            if($this->db->execute()){
                // if rating sucessful then update rate receivers rate
                $this->db->query('SELECT avg(rate) as rateNew FROM rate WHERE email_rate_receiver = :email_rate_receiver ');
                //Bind value
                $this->db->bind(':email_rate_receiver', $email_rate_receiver);
                $result1 =  $this->db->single();
                // update main rate in seller table 
                $this->db->query('UPDATE user SET rate = :newRate WHERE email = :email_rate_receiver');
                $this->db->bind(':newRate', $result1->rateNew);
                $this->db->bind(':email_rate_receiver', $email_rate_receiver);
                

                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
            
        }
        
        public function updateSellerRate($rating, $email_rater, $email_rate_receiver,$review,$date){
            // update seller's rate given by a particular buyer 
            $this->db->query('UPDATE rate SET rate.rate = :rate, rate.review = :review, rate.date =:date  WHERE rate.email_rater = :email_rater AND rate.email_rate_receiver = :email_rate_receiver ');
            //Bind value
            $this->db->bind(':email_rater', $email_rater);
            $this->db->bind(':email_rate_receiver', $email_rate_receiver);
            $this->db->bind(':rate', $rating);
            $this->db->bind(':review', $review);
            $this->db->bind(':date', $date);
    
            if($this->db->execute()){
                // if rating sucessful then update the user table's rate field
                $this->db->query('SELECT avg(rate) as rate FROM rate WHERE email_rate_receiver = :email_rate_receiver ');
                //Bind value
                $this->db->bind(':email_rate_receiver', $email_rate_receiver);
                $result1 =  $this->db->single();
                // update main rate in seller table 
                $this->db->query('UPDATE `user` SET rate = :newRate WHERE email = :email_rate_receiver ');
                $this->db->bind(':newRate', $result1->rate);
                $this->db->bind(':email_rate_receiver', $email_rate_receiver);

                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        // rate and review service provider will add new record to database
        public function rateServiceProvider($emailBuyer, $emailServiceProvider, $eventName, $eventDate, $rate, $review, $reviewedDay){
            // get the email from buyer id

            $this->db->query('INSERT INTO rate_service_provider (email_buyer,email_service_provider,event_name,event_date,rate,review,reviewed_day) VALUES (:emai_buyer,:email_service_provider,:event_name,:event_date,:rate,:review,:reviewed_day)');
            $this->db->bind(':emai_buyer', $emailBuyer);
            $this->db->bind(':email_service_provider', $emailServiceProvider);
            $this->db->bind(':event_name', $eventName);
            $this->db->bind(':event_date', $eventDate);
            $this->db->bind(':rate', $rate);
            $this->db->bind(':review', $review);
            $this->db->bind(':reviewed_day', $reviewedDay);

            if($this->db->execute()){
                // if rating sucessful then update rate receivers rate
                $this->db->query('SELECT avg(rate) as rateNew FROM rate_service_provider WHERE email_service_provider = :email_service_provider ');
                //Bind value
                $this->db->bind(':email_service_provider', $emailServiceProvider);
                $result1 =  $this->db->single();
                // update main rate in seller table 
                $this->db->query('UPDATE user SET rate = :newRate WHERE email = :email_service_provider');
                $this->db->bind(':newRate', $result1->rateNew);
                $this->db->bind(':email_service_provider', $emailServiceProvider);
                

                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
            
        }

        
        // check service providers previous rate if available
        public function checkAddedServiceProviderRate($emailBuyer, $emailServiceProvider, $eventName, $eventDate){


            $this->db->query('SELECT rate_service_provider.rate FROM rate_service_provider WHERE email_buyer = :email_buyer AND email_service_provider = :email_service_provider AND event_name =:event_name AND event_date= :event_date');
            //Bind value
            $this->db->bind(':email_buyer', $emailBuyer);
            $this->db->bind(':email_service_provider', $emailServiceProvider);
            $this->db->bind(':event_name', $eventName);
            $this->db->bind(':event_date', $eventDate);

            $result =  $this->db->single();
            
            // if there no rate value it will be null
            return $result->rate?? NULL;
        }

        // update service providers current rate if available
        public function updateServiceProviderRate($emailBuyer, $emailServiceProvider, $eventName, $eventDate, $rate, $review, $reviewedDay){
            // update seller's rate given by a particular buyer 
            $this->db->query('UPDATE rate_service_provider SET rate_service_provider.rate = :rate, rate_service_provider.review = :review, rate_service_provider.reviewed_day = :reviewed_day WHERE email_buyer = :email_buyer AND email_service_provider = :email_service_provider AND event_name =:event_name AND event_date= :event_date');
            //Bind value
            $this->db->bind(':email_buyer', $emailBuyer);
            $this->db->bind(':email_service_provider', $emailServiceProvider);
            $this->db->bind(':event_name', $eventName);
            $this->db->bind(':event_date', $eventDate);
            $this->db->bind(':rate', $rate);
            $this->db->bind(':review', $review);
            $this->db->bind(':reviewed_day', $reviewedDay);

    
            if($this->db->execute()){
                // if rating sucessful then update the user table's rate field
                $this->db->query('SELECT avg(rate) as rate FROM rate_service_provider WHERE email_service_provider = :email_service_provider');
                //Bind value
                $this->db->bind(':email_service_provider', $emailServiceProvider);
                $result1 =  $this->db->single();
                // update main rate in seller table 
                $this->db->query('UPDATE user SET rate = :newRate WHERE email = :email_service_provider');
                $this->db->bind(':newRate', $result1->rate);
                $this->db->bind(':email_service_provider', $emailServiceProvider);

                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
        


        public function getRateReceiversFinalRate($email_rate_receiver){
            $this->db->query('SELECT rate FROM user WHERE email = :email_rate_receiver ');
            //Bind value
            $this->db->bind(':email_rate_receiver', $email_rate_receiver);
            $result1 = $this->db->single();

            return $result1->rate;

        }

        public function getChats($data){
            $this->db->query('SELECT * FROM chat WHERE sender_email = :email OR receiver_email = :email ORDER BY chat_id DESC');
            //Bind value
            $this->db->bind(':email', $data['email_sender']);
            $result1 = $this->db->execute();

            if($result1){
                $result = $this->db->resultSet();
                return $result;
            }else{
                return false;
            }

        }
        public function getCurrentChat($email_sender,$receiver_email){
            $this->db->query('SELECT * FROM chat WHERE (sender_email = :email_sender AND receiver_email = :receiver_email) OR (sender_email = :receiver_email AND receiver_email = :email_sender)');
            //Bind value
            $this->db->bind(':email_sender', $email_sender);
            $this->db->bind(':receiver_email', $receiver_email);
            $result1 = $this->db->execute();

            if($result1){
                $result = $this->db->resultSet();
                return $result;
            }else{
                return false;
            }

        }

        public function AddNewMessage($sender_email,$receiver_email,$date,$message){
            $this->db->query('INSERT INTO chat (sender_email,receiver_email,date,message) VALUES (:sender_email,:receiver_email,:date,:message)');
            //Bind value
            $this->db->bind(':sender_email', $sender_email);
            $this->db->bind(':receiver_email', $receiver_email);
            $this->db->bind(':date', $date);
            $this->db->bind(':message', $message);
            $result1 = $this->db->execute();

            if($result1){
               return true;
            }else{
                return false;
            }
        }

        public function getAllMessages($emai_sender,$email_receiver){
            $this->db->query('SELECT * FROM chat WHERE (sender_email = :emai_sender AND receiver_email = :email_receiver) OR (receiver_email = :emai_sender AND sender_email = :email_receiver)');
            //Bind value
            $this->db->bind(':email_receiver', $email_receiver);
            $this->db->bind(':emai_sender', $emai_sender);
            $result1 = $this->db->execute();

            if($result1){
                $result = $this->db->resultSet();
                return $result;
            }else{
                return false;
            }
        }
        public function getHotestAuctions(){
            $this->db->query('SELECT * FROM product INNER JOIN auction WHERE product.product_id=auction.product_id AND is_active = 1 ORDER BY end_date ASC LIMIT 6');
            $result1 = $this->db->execute();
            if($result1){
                $result = $this->db->resultSet();
                return $result;
            }else{
                return false;
            }
        }
        public function getPopularEngineers(){
            $this->db->query('SELECT * FROM user INNER JOIN service_provider WHERE service_provider.user_id=user.user_id AND user.is_deleted=0 AND user.user_type = "service_provider" ORDER BY service_provider.rating DESC LIMIT 6;');
            $result1 = $this->db->execute();
            if($result1){
                $result = $this->db->resultSet();
                return $result;
            }else{
                return false;
            }
        }

        public function getPostsByUser($user_id){
            $this->db->query('SELECT * FROM feed_post WHERE user_id = :id');
            $this->db->bind(':id', $user_id);
            $posts = $this->db->resultSet();
            return $posts;
        }

        public function getEventsByUser($user_id,$month){

            $this -> db -> query('SELECT * FROM events WHERE user_id = :id AND MONTH(date) = :month');
            $this -> db -> bind(':id', $user_id);
            $this -> db -> bind(':month', $month);
            $events = $this -> db -> resultSet();       
            return $events;
        }

        public function getEventsByMonth($user_id,$month){

            $this -> db -> query('SELECT * FROM events WHERE user_id = :id AND MONTH(date) = :month');
            $this -> db -> bind(':id', $user_id);
            $this -> db -> bind(':month', $month);
            $events = $this -> db -> resultSet();       
            return $events;
        }
    
        public function getEventById($event_id){
    
            $this -> db -> query('SELECT * FROM events WHERE event_id = :id ');
            $this -> db -> bind(':id', $event_id);
            $event = $this -> db -> single();
            return $event;
    
        }    
        public function getEventOwner($id){

            $this->db->query('SELECT first_name, second_name FROM `user`,`events` WHERE user.user_id = events.user_id and events.event_id = :id;');
            $this -> db -> bind(':id', $id);
            $name = $this -> db -> single();
            return $name;
   
       } 
       
       public function getPostById($id){
            
            $this->db->query('SELECT * FROM `feed_post` WHERE post_id = :id;');
            $this -> db -> bind(':id', $id);
            $post = $this -> db -> single();
            return $post;
    
       }
    }
?>