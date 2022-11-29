<?php
    class User{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        //Register User
        public function register($data){
            $this->db->query('INSERT INTO user (first_name, second_name, email, phone_number, user_type,registered_date,password) VALUES(:first_name, :second_name, :email, :phone,:user_type,NOW(), :password)');
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

        public function logintime($email){
            $this->db->query('UPDATE user set last_login=NOW() WHERE email = :email');
            $this->db->bind(':email', $email);
            $row = $this->db->single(); //single row

        }

        //Login user
        public function login($email, $password){
            $this->db->query('SELECT * FROM user WHERE email = :email');
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
    }
?>