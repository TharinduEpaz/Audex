<?php
    class Service_provider{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getDetails($id){
        
        $this->db->query('SELECT * FROM user LEFT JOIN service_provider ON user.user_id = service_provider.user_id WHERE service_provider.user_id = :id UNION SELECT * FROM user RIGHT JOIN service_provider ON user.user_id = service_provider.user_id WHERE service_provider.user_id = :id;');

        
        $this->db->bind(':id',$id);
        $row = $this->db->single();

        return $row;
        
        }

        public function setDetails($arr){

        }
    }



?>