<?php
date_default_timezone_set("Asia/Kolkata");
    class User{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        //Register User
        public function register($data,$dat){
            $this->db->query('INSERT INTO user (first_name, second_name, email, phone_number, user_type,registered_date,password,otp,email_active) VALUES(:first_name, :second_name, :email, :phone,:user_type,:t, :password,:otp, 0)');
            //Bind values
            $this->db->bind(':first_name', $data['first_name']);
            $this->db->bind(':second_name', $data['second_name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':phone', $data['phone']);
            $this->db->bind(':user_type', $data['user_type']);
            $this->db->bind(':t', $dat);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':otp', $data['otp']);

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
            $this->db->query('SELECT * FROM user WHERE email = :email && email_active=1');
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

        //Find user by email
        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM user WHERE email = :email && email_active=1');
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

        //Not activated
        public function notActivated($email){
            $this->db->query('SELECT * FROM user WHERE email = :email && email_active=0');
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

        public function getUserDetails($id){
            $this->db->query('SELECT * FROM user WHERE user_id = :id');
            $this->db->bind(':id' , $id);
            
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
        public function getAdvertiesmentById($id){
            $this->db->query('SELECT * FROM product WHERE product_id = :id');
            $this->db->bind(':id' , $id);

            $row = $this->db->single();
            return $row;
        }

        public function getSellerDetails($email){
            $this->db->query('SELECT * FROM seller WHERE email = :email');
            $this->db->bind(':email' , $email);

            $row = $this->db->single();
            return $row;
        }


        public function getSellerMoreDetails($email){
            $this->db->query('SELECT * FROM user WHERE email = :email');
            $this->db->bind(':email' , $email);

            $row = $this->db->single();
            return $row;
        }

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
        
        public function getBidList($bid_id,$price){
            $this->db->query('SELECT * FROM bid_list WHERE bid_id = :id && price=:price');
            $this->db->bind(':id' , $bid_id);
            $this->db->bind(':price' , $price);

            $row = $this->db->single();
            if($row){
                return $row;
            }else{
                return NULL;
            }
        }

        public function updateBidStatus($bid_id,$price){
            $this->db->query('UPDATE bid_list SET is_rejected=1 WHERE bid_id = :id && price=:price');
            $this->db->bind(':id' , $bid_id);
            $this->db->bind(':price' , $price);

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

            $this->db->query('INSERT INTO bid (auction_id, email_buyer, name, price, date_time) VALUES (:auction_id, :email_buyer, :name, :price, :t)');
            $this->db->bind(':auction_id', $auction_id);
            $this->db->bind(':email_buyer', $_SESSION['user_email']);
            $this->db->bind(':name', $_SESSION['user_name']);
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

            $this->db->query('SELECT view_id FROM view_item WHERE email_buyer = :email AND product_id = :p_id');
            //Bind value
            $this->db->bind(':email', $row->email);
            $this->db->bind(':p_id', $p_id);

            $result =  $this->db->single();

            return $result;

        }
        public function getBuyerWatchProducts($email){
            $this->db->query('SELECT product_id FROM view_item WHERE email_buyer = :email');
            $this->db->bind(':email' , $email);
            $results = $this->db->resultSet();

            // foreach($results as $result):
            //     echo gettype($result) . "</br>";
            //     echo $result->product_id . "</br>";
            //     echo gettype($result->product_id) . "</br>";
            // endforeach;

            $items = [];
            foreach($results as $result):
                $id = $result->product_id;
                settype($id,"integer");
                $this->db->query('SELECT product_id,email,product_title,product_condition,image1,price FROM product WHERE product_id = :id');
                $this->db->bind(':id' , $id);
                $item = $this->db->single();
                array_push($items,$item);
            endforeach;
            return $items;
            
        }

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

        public function addItemToWatchList($p_id,$user_id){

            $this->db->query('SELECT email FROM user WHERE user_id = :id');
            $this->db->bind(':id' , $user_id);

            $row = $this->db->single();

            $this->db->query('INSERT INTO view_item (email_buyer,product_id) VALUES(:email,:p_id)');
            //Bind value
            $this->db->bind(':email', $row->email);
            $this->db->bind(':p_id', $p_id);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function removeItemFromWatchList($p_id,$user_id){

            $this->db->query('SELECT email FROM user WHERE user_id = :id');
            $this->db->bind(':id' , $user_id);

            $row = $this->db->single();

            $this->db->query('DELETE FROM view_item WHERE view_item.product_id = :p_id AND view_item.email_buyer = :email;
            ');
            //Bind value
            $this->db->bind(':email', $row->email);
            $this->db->bind(':p_id', $p_id);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function removeOneItemFromWatchList($p_id,$user_id){

            $this->db->query('SELECT email FROM user WHERE user_id = :id');
            $this->db->bind(':id' , $user_id);

            $row = $this->db->single();

            $this->db->query('DELETE FROM view_item WHERE view_item.product_id = :p_id AND view_item.email_buyer = :email');
            //Bind value
            $this->db->bind(':email', $row->email);
            $this->db->bind(':p_id', $p_id);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
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
        public function searchAndFilterItems($searchedTerm,$category,$type,$priceMin,$priceMax){

            $sql = 'SELECT * FROM product';
            $where = array();

            if( isset($searchedTerm) ){
                $where[] = 'product_title LIKE '. '%'.$searchedTerm.'%' ;
                // $this->db->bind(':searchedTerm',$searchedTerm);
            }
            if( isset($category) ){
                $where[] = 'product_category =\''. $category.';';
                // $this->db->bind(':category',$category);
            }
            // if( isset($type) ){
            //     $where[] = 'product_type ='.':types';
            //     $this->db->bind(':types',$type);
            // }
            // if( isset($priceMin) ){
            //     $where[] = 'price <='.':priceMin';
            //     $this->db->bind(':price',$priceMin);
            // }
            // if( isset($priceMax) ){
            //     $where[] = 'price >='.':priceMax';
            //     $this->db->bind(':price',$priceMax);
            // }
                    
            if (count($where)) {
              $sql .= " WHERE ".implode(" AND ", $where);
            }
        // return $sql;
            $this->db->query($sql);
            $results = $this->db->resultSet();
            return $results;

            // $sql = "SELECT * FROM product ";
            // $where = array();
        
            // // if ($searchedTerm) {
            // //   $where[] = "product_title LIKE :searchedTerm";
            // //   $this->db->bind(':searchedTerm', '%'.$searchedTerm.'%');
            // // //   $this->db->bind(':searchedTerm', $searchedTerm);
              
            // // }
        
            // if ($category) {
            //   $where = "SELECT * FROM product where product_category = :$category";
            //   $this->db->bind(':category', $category);

            // }
            
            // // if ($type) {
            // //   $where[] = "product_type = '".$this->db->escape($type)."'";
            // // }
            
            // // if ($priceMin || $priceMax) {
            // //   $where[] = "price BETWEEN ".intval($priceMin)." AND ".intval($priceMax);
            // // }
        
        
            // // if (count($where)) {
            // //   $sql .= " WHERE ".implode(" AND ", $where);
            // // }
        
            // $this->db->query($where);

            // return $this->db->resultSet();
        }

        

        public function getServiceProvidersPublic($id){
            
            
            $this->db->query('SELECT * FROM service_provider_view Where user_id = :id');
            $this->db->bind(':id', $id);
            $result = $this->db->single();
            return $result;

        }

        public function checkAddedRate($buyer_id, $seller){
            $this->db->query('SELECT email FROM user WHERE user_id = :buyer_id');
            $this->db->bind(':buyer_id' , $buyer_id);
            $row = $this->db->single();

            $this->db->query('SELECT rate FROM seller_rate_buyer WHERE email_buyer = :buyer AND email_seller = :seller ');
            //Bind value
            $this->db->bind(':buyer', $row->email);
            $this->db->bind(':seller', $seller);

            $result =  $this->db->single();
            
            // if there no rate value it will be null
            return $result->rate?? NULL;
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
        public function rateSeller($rate,$buyer_id,$seller,$review){
            // get the email from buyer id
            $this->db->query('SELECT email FROM user WHERE user_id = :buyer_id');
            $this->db->bind(':buyer_id' , $buyer_id);
            $row = $this->db->single();
            

            $this->db->query('INSERT INTO seller_rate_buyer (email_seller,email_buyer,rate,review) VALUES (:seller,:buyer,:rate,:review)');
            $this->db->bind(':seller', $seller);
            $this->db->bind(':buyer', $row->email);
            $this->db->bind(':rate', $rate);
            $this->db->bind(':review', $review);

            if($this->db->execute()){
                // if rating sucessful then update the seller table
                $this->db->query('SELECT avg(rate) as rateNew FROM seller_rate_buyer WHERE email_seller = :seller ');
                //Bind value
                $this->db->bind(':seller', $seller);
                $result1 =  $this->db->single();
                // update main rate in seller table 
                $this->db->query('UPDATE seller SET rate = :newRate WHERE email = :seller ');
                $this->db->bind(':newRate', $result1->rateNew);
                $this->db->bind(':seller', $seller);

                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
            
        }
        
        public function updateSellerRate($rating, $buyer_id, $seller,$review){
            // get the email from buyer id
            $this->db->query('SELECT email FROM user WHERE user_id = :buyer_id');
            $this->db->bind(':buyer_id' , $buyer_id);
            $row = $this->db->single();
    
            // update seller's rate given by a particular buyer 
            $this->db->query('UPDATE seller_rate_buyer SET rate = :rate, review = :review WHERE email_buyer = :buyer AND email_seller = :seller ');
            //Bind value
            $this->db->bind(':buyer', $row->email);
            $this->db->bind(':seller', $seller);
            $this->db->bind(':rate', $rating);
            $this->db->bind(':review', $review);
    
            if($this->db->execute()){
                // if rating sucessful then update the seller table
                $this->db->query('SELECT avg(rate) as rate FROM seller_rate_buyer WHERE email_seller = :seller ');
                //Bind value
                $this->db->bind(':seller', $seller);
                $result1 =  $this->db->single();
                // update main rate in seller table 
                $this->db->query('UPDATE seller SET rate = :newRate WHERE email = :seller ');
                $this->db->bind(':newRate', $result1->rate);
                $this->db->bind(':seller', $seller);

                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function getSellerFinalRate($seller){
            $this->db->query('SELECT rate FROM seller WHERE email = :seller ');
            //Bind value
            $this->db->bind(':seller', $seller);
            $result1 = $this->db->single();

            return $result1->rate;

        }
    }
?>