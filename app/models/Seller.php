<?php
    class Seller{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getadvertisements(){
            $this->db->query('SELECT * FROM product ');
            $results = $this->db->resultSet();
            return $results;
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
    }