<?php
    class Admin{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getDetails($id){
        
            $this->db->query('SELECT * FROM user WHERE user_id = :id;');
    
            
            $this->db->bind(':id',$id);
            $row = $this->db->single();
    
            return $row;
            
            }



    }



?>