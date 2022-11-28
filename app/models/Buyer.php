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
        public function getAdvertiesmentById($id)
        {
            $this->db->query('SELECT * FROM product WHERE product_id = :id');
            $this->db->bind(':id' , $id);

            $row = $this->db->single();
            return $row;
        }
        public function getBuyerDetails($id){
            $this->db->query('SELECT * FROM user WHERE _id = :id');
            $this->db->bind(':id' , $id);

            $row = $this->db->single();
            return $row;
        }

        public function getBuyerWatchProducts($email){
            $this->db->query('SELECT product_id FROM watch_list WHERE email = :email');
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
                $this->db->query('SELECT product_id,email,product_title,product_condition,img FROM product WHERE product_id = :id');
                $this->db->bind(':id' , $id);
                $item = $this->db->single();
                array_push($items,$item);
            endforeach;
            return $items;
            
        }

    }


?>