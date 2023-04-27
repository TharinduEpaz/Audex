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
            $this->db->query('SELECT * FROM product WHERE is_deleted=0');
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
            $this->db->query('SELECT * FROM user WHERE user_id = :id');
            $this->db->bind(':id' , $id);

            $row = $this->db->single();
            return $row;
        }

        public function getBDetails($id){
            $this->db->query('SELECT * FROM buyer WHERE user_id = :id');
            $this->db->bind(':id' , $id);

            $row = $this->db->single();
            return $row;
        }

        public function updateProfile($data){
            $this->db->query('UPDATE user SET first_name = :first_name,second_name = :second_name, address1 = :address1, address2 = :address2 WHERE user_id = :id ');
            
            $this->db->bind(':first_name' , $data['first_name']);
            $this->db->bind(':second_name' , $data['second_name']);
            $this->db->bind(':address1' , $data['address1']);
            $this->db->bind(':address2' , $data['address2']);
            $this->db->bind(':id' , $data['id']);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // public function getBuyerWatchProducts($email){
        //     $this->db->query('SELECT product_id FROM view_item WHERE email_buyer = :email');
          //     $this->db->bind(':email' , $email);
      //     $results = $this->db->resultSet();

        //     // foreach($results as $result):
        //     //     echo gettype($result) . "</br>";
        //     //     echo $result->product_id . "</br>";
        //     //     echo gettype($result->product_id) . "</br>";
        //     // endforeach;

        //     $items = [];
        //     foreach($results as $result):
        //         $id = $result->product_id;
        //         settype($id,"integer");
        //         $this->db->query('SELECT product_id,email,product_title,product_condition,image1,price FROM product WHERE product_id = :id');
        //         $this->db->bind(':id' , $id);
        //         $item = $this->db->single();
        //         array_push($items,$item);
        //     endforeach;
        //     return $items;
            
        // }

        public function deleteUserProfile($id){
            $this->db->query('SELECT email FROM user WHERE user_id = :id');
            $this->db->bind(':id' , $id);

            $row = $this->db->single();

            $this->db->query('DELETE FROM buyer WHERE email = :email');
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


        public function findUserDetailsByEmail($email){
            $this->db->query('SELECT * FROM user WHERE email = :email');
            //Bind value
            $this->db->bind(':email', $email);
            $row = $this->db->single();
            //Check row
            echo $row->user_id .'</br>' ;
            echo $row->is_deleted.'</br>' ;
            return $row;
        }

        // public function addItemToWatchList($p_id,$user_id){

        //     $this->db->query('SELECT email FROM user WHERE user_id = :id');
        //     $this->db->bind(':id' , $user_id);

        //     $row = $this->db->single();

        //     $this->db->query('INSERT INTO view_item (email_buyer,product_id) VALUES(:email,:p_id)');
        //     //Bind value
        //     $this->db->bind(':email', $row->email);
        //     $this->db->bind(':p_id', $p_id);

        //     if($this->db->execute()){
        //         return true;
        //     }else{
        //         return false;
        //     }
        // }

        // public function removeItemFromWatchList($p_id,$user_id){

        //     $this->db->query('SELECT email FROM user WHERE user_id = :id');
        //     $this->db->bind(':id' , $user_id);

        //     $row = $this->db->single();

        //     $this->db->query('DELETE FROM view_item WHERE view_item.product_id = :p_id AND view_item.email_buyer = :email;
        //     ');
        //     //Bind value
        //     $this->db->bind(':email', $row->email);
        //     $this->db->bind(':p_id', $p_id);

        //     if($this->db->execute()){
        //         return true;
        //     }else{
        //         return false;
        //     }
        // }

        // public function removeOneItemFromWatchList($p_id,$user_id){

        //     $this->db->query('SELECT email FROM user WHERE user_id = :id');
        //     $this->db->bind(':id' , $user_id);

        //     $row = $this->db->single();

        //     $this->db->query('DELETE FROM view_item WHERE view_item.product_id = :p_id AND view_item.email_buyer = :email');
        //     //Bind value
        //     $this->db->bind(':email', $row->email);
        //     $this->db->bind(':p_id', $p_id);

        //     if($this->db->execute()){
        //         return true;
        //     }else{
        //         return false;
        //     }
        // }

        // public function checkAddedLike($p_id,$user_id){
        //     $this->db->query('SELECT email FROM user WHERE user_id = :id');
        //     $this->db->bind(':id' , $user_id);

        //     $row = $this->db->single();

        //     $this->db->query('SELECT * FROM reaction WHERE email_buyer = :email AND product_id = :p_id');
        //     //Bind value
        //     $this->db->bind(':email', $row->email);
        //     $this->db->bind(':p_id', $p_id);

        //     $result =  $this->db->single();

        //     return $result;
        // }

        // public function addLikeToProduct($p_id,$user_id){

        //     $this->db->query('SELECT email FROM user WHERE user_id = :id');
        //     $this->db->bind(':id' , $user_id);

        //     $row = $this->db->single();

        //     $this->db->query('INSERT INTO reaction (email_buyer,product_id,liked,disliked) VALUES (:email,:p_id,1,0)');
        //     //Bind value
        //     $this->db->bind(':email', $row->email);
        //     $this->db->bind(':p_id', $p_id);

        //     if($this->db->execute()){
        //         return true;
        //     }else{
        //         return false;
        //     }
        // }

        // public function removeLikeFromProduct($p_id,$user_id){

        //     $this->db->query('SELECT email FROM user WHERE user_id = :id');
        //     $this->db->bind(':id' , $user_id);

        //     $row = $this->db->single();

        //     $this->db->query('DELETE FROM reaction WHERE reaction.product_id = :p_id AND reaction.email_buyer = :email');
        //     //Bind value
        //     $this->db->bind(':email', $row->email);
        //     $this->db->bind(':p_id', $p_id);

        //     if($this->db->execute()){
        //         return true;
        //     }else{
        //         return false;
        //     }
        // }

        
        // public function searchItems($searchedTerm){
        //     $this->db->query('SELECT * FROM product WHERE product_title LIKE :searchedTerm');
        //     $this->db->bind(':searchedTerm', '%'.$searchedTerm.'%');

        //     $results = $this->db->resultSet();
        //     return $results;

        // }


        public function getBuyerLikedProducts($email){
            $this->db->query('SELECT product_id FROM reaction WHERE email_buyer = :email AND liked= 1 ');
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
                $this->db->query('SELECT * FROM product WHERE product_id = :id');
                $this->db->bind(':id' , $id);
                $item = $this->db->single();
                array_push($items,$item);
            endforeach;
            return $items;
            
        }
        public function getBuyerDislikedProducts($email){
            $this->db->query('SELECT product_id FROM reaction WHERE email_buyer = :email AND disliked= 1 ');
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
                $this->db->query('SELECT * FROM product WHERE product_id = :id');
                $this->db->bind(':id' , $id);
                $item = $this->db->single();
                array_push($items,$item);
            endforeach;
            return $items;
            
        }

    }

?>