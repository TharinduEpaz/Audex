<?php
    class Service_provider{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getDetails($email){
            
            $this->db->query('SELECT * FROM user WHERE email=:email && is_deleted=0');
            $this->db->bind(':email', $email);
            $results = $this->db->resultSet();
            return $results;
            
        }
    }



?>