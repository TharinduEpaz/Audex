<?php
    class Admin{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getadminDetails($id){
        
            $this->db->query('SELECT * FROM user WHERE user_id = :id;');
    
            
            $this->db->bind(':id',$id);
            $row = $this->db->single();
    
            return $row;
            
            }

         public function updateProfile($data){
                $this->db->query('UPDATE user SET first_name = :first_name,second_name = :second_name, address1 = :address1, address2 = :address2  WHERE user_id = :id ');
                
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


            public function setDetails($arr)
            {
        
                $this->db->query('INSERT INTO user (email, first_name, second_name, address1, address2, phone_number, user_type, registered_date, admin_id, password, email_active) VALUES (:email, :first_name, :second_name, :address1, :address2, :mobile,\'admin\', NOW(), 1, :password, 1);');
        
                $this->db->bind(':first_name', $arr[0]);
                $this->db->bind(':second_name', $arr[1]);
                $this->db->bind(':email', $arr[2]);
                $this->db->bind(':address1', $arr[3]);
                $this->db->bind(':address2', $arr[4]);
                $this->db->bind(':mobile', $arr[5]);
                $this->db->bind(':password', $arr[6]);
                
        
                $this->db->execute();
        
                redirect('admins/profile');
            }



    }



?>