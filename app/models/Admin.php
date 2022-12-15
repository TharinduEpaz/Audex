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