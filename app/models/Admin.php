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
        
                $this->db->query('INSERT INTO `user` (`user_id`, `email`, `first_name`, `address1`, `address2`, `phone_number`,) VALUES (NULL, 'lahiru', 'lahiru123@gmail.com', '0774809951', 'kirikiththa', '123456');');
        
                $this->db->bind(':id', $id);
                $this->db->bind(':profession', $arr[0]);
                $this->db->bind(':qualifications', $arr[1]);
                $this->db->bind(':achievements', $arr[2]);
                $this->db->bind(':description', $arr[3]);
                $this->db->bind(':first_name', $arr[4]);
                $this->db->bind(':second_name', $arr[5]);
                $this->db->bind(':address1', $arr[6]);
                $this->db->bind(':address2', $arr[7]);
        
                $this->db->execute();
        
                redirect('service_providers/profile');
            }



    }



?>