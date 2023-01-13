<?php
    class User{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        //Register User
        public function register($data){
            $this->db->query('INSERT INTO user (first_name, second_name, email, phone_number, user_type,registered_date,password,email_active) VALUES(:first_name, :second_name, :email, :phone,:user_type,NOW(), :password, 1)');
            //Bind values
            $this->db->bind(':first_name', $data['first_name']);
            $this->db->bind(':second_name', $data['second_name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':phone', $data['phone']);
            $this->db->bind(':user_type', $data['user_type']);
            $this->db->bind(':password', $data['password']);

            //Execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        //Send Email
        public function sendEmail($email,$otp,$fname){
            $to=$email;
            $sender='audexlk@gmail.com';
            $mail_subject='Verify Email Address';
            $email_body='<p>Dear '.$fname.',<br>Thank you for signing up to Audexlk. In order to'; 
            $email_body.=' validate your account you need enter the given OTP in the verification page.<br>';
            $email_body.='<h3>The OTP</h3><br><h1>'.$otp.'</h1><br>';
            $email_body.='Thank you,<br>Audexlk</p>';
            $header="From:{$sender}\r\nContent-Type:text/html;";
            $send_mail_result=mail($to,$mail_subject,$email_body,$header);
            if($send_mail_result){
                return true;
            }
            else{
                return false;
            }
        }

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

        public function logintime($email){
            $this->db->query('UPDATE user set last_login=NOW() WHERE email = :email');
            $this->db->bind(':email', $email);
            $row = $this->db->execute(); //single row

        }

        //Login user
        public function login($email, $password){
            $this->db->query('SELECT * FROM user WHERE email = :email && email_active=1');
            $this->db->bind(':email', $email);

            $row = $this->db->single(); //single row

            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)){
                $this->logintime($email);
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
            $this->db->query('SELECT user_id FROM user WHERE email = :email');
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
            $this->db->query('SELECT * FROM product WHERE is_deleted=0');
            $results = $this->db->resultSet();
            return $results;

        }
        public function getAdvertiesmentById($id){
            $this->db->query('SELECT * FROM product WHERE product_id = :id');
            $this->db->bind(':id' , $id);

            $row = $this->db->single();
            return $row;
        }
        public function getAuctionById($id){
            $this->db->query('SELECT * FROM auction WHERE product_id = :id');
            $this->db->bind(':id' , $id);

            $row = $this->db->single();
            if($row){
                return $row;
            }else{
                return "Error";
            }
        }

        public function getAuctionDetails($id){
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

        public function add_bid($price,$auction_id){

            $this->db->query('INSERT INTO bid (auction_id, email_buyer, name, price, date_time) VALUES (:auction_id, :email_buyer, :name, :price, NOW())');
            $this->db->bind(':auction_id', $auction_id);
            if($_SESSION['user_type'] == "buyer"){
                $this->db->bind(':email_buyer', $_SESSION['user_email']);
            }else if($_SESSION['user_type'] == "service_provider"){
                $this->db->bind(':email_service_provider', $_SESSION['user_email']);
            }
            $this->db->bind(':name', $_SESSION['user_name']);
            $this->db->bind(':price', $price);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
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
        


    }
?>