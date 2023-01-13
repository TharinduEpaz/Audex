<?php
    class Seller{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getUserDetails($id){
            $this->db->query('SELECT * FROM user WHERE user_id = :id');
            $this->db->bind(':id' , $id);

            $row = $this->db->single();
            return $row;
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

        public function getadvertisements($email){
            $this->db->query('SELECT * FROM product WHERE email=:email && is_deleted=0');
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
            $this->db->query('INSERT INTO product (email,product_title,product_condition,product_category,product_type,model_no,brand,image1,image2,image3,price,p_description) VALUES(:user_email,:title,:condition,:category,:type,:model,:brand,:image1,:image2,:image3,:price,:description)');
            //Bind values
            $this->db->bind(':user_email', $data['user_email']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':condition', $data['condition']);
            $this->db->bind(':category', $data['category']);
            $this->db->bind(':type', $data['type']);
            $this->db->bind(':model', $data['model']);
            $this->db->bind(':brand', $data['brand']);
            $this->db->bind(':image1', $data['image1']);
            $this->db->bind(':image2', $data['image2']);
            $this->db->bind(':image3', $data['image3']);
            $this->db->bind(':price', $data['price']);
            $this->db->bind(':description', $data['description']);

            //Execute
            if($this->db->execute()){
                $this->db->query('INSERT INTO seller_add_product (product_id,user_id,email,posted_time) VALUES(:product_id,:user_id,:user_email,NOW())');
                //Bind values
                $this->db->bind(':product_id', $this->db->lastInsertId());
                $this->db->bind(':user_id', $data['user_id']);
                $this->db->bind(':user_email', $data['user_email']);
                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
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
            // $this->db->bind(':image1', $data['image1']);
            // $this->db->bind(':image2', $data['image2']);
            // $this->db->bind(':image3', $data['image3']);
            $this->db->bind(':price', $data['price']);
            $this->db->bind(':description', $data['description']);

            //Execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function delete_advertisement($id){
            $this->db->query('UPDATE product SET is_deleted=1 WHERE product_id=:id');
            //Bind values
            $this->db->bind(':id', $id);

            //Execute
            if($this->db->execute()){
                $this->db->query('UPDATE seller_add_product SET is_deleted=1 WHERE product_id=:id');
                $this->db->bind(':id', $id);
                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }    
            }else{
                return false;
            }
        }

    }