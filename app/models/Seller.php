<?php
    class Seller{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getadvertisements($email){
            $this->db->query('SELECT * FROM product WHERE email=:email');
            $this->db->bind(':email', $email);
            $results = $this->db->resultSet();
            return $results;
        }

        public function getAdvertisementById($id){
            $this->db->query('SELECT * FROM product WHERE product_id = :id');
            $this->db->bind(':id', $id);
            $row = $this->db->single();
            return $row;
        }

        public function advertise($data){
            $this->db->query('INSERT INTO product (email,product_title,product_condition,product_category,product_type,model_no,brand,price,p_description) VALUES(:user_email,:title,:condition,:category,:type,:model,:brand,:price,:description)');
            //Bind values
            $this->db->bind(':user_email', $data['user_email']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':condition', $data['condition']);
            $this->db->bind(':category', $data['category']);
            $this->db->bind(':type', $data['type']);
            $this->db->bind(':model', $data['model']);
            $this->db->bind(':brand', $data['brand']);
            $this->db->bind(':price', $data['price']);
            $this->db->bind(':description', $data['description']);

            //Execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        //edit advertisement
        public function edit_advertisement($data){
            $this->db->query('UPDATE product SET product_title=:title,product_condition=:condition,product_category=:category,model_no=:model,brand=:brand,price=:price,p_description=:description WHERE product_id=:id');
            //Bind values
            $this->db->bind(':id', $data['id']);
            // $this->db->bind(':user_email', $data['user_email']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':condition', $data['condition']);
            $this->db->bind(':category', $data['category']);
            // $this->db->bind(':type', $data['type']);
            $this->db->bind(':model', $data['model']);
            $this->db->bind(':brand', $data['brand']);
            $this->db->bind(':price', $data['price']);
            $this->db->bind(':description', $data['description']);

            //Execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

    }