<?php 
    class Buyer{
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }
        public function register($data){
            $this->db->query('INSERT INTO buyer (email) VALUES(:email)');
                //Bind values
                $this->db->bind(':email', $data['email']);
            
                //Execute
                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
        }

        public function getAdvertiesment(){
            $this->db->query('SELECT * FROM product');
            $results = $this->db->resultSet();
            return $results;

        }


    }


?>