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

            public function getserviceproviderdetails(){
                // $this->db->query('SELECT * FROM user LEFT JOIN service_provider ON user.user_id = service_provider.user_id  UNION SELECT * FROM user RIGHT JOIN service_provider ON user.user_id = service_provider.user_id ');
                //$this->db->query('SELECT * FROM user INNER JOIN service_provider ON user.user_id = service_provider.user_id ');
                $this->db->query('SELECT * FROM user INNER JOIN service_provider ON user.user_id = service_provider.user_id WHERE service_provider.admin_approved = 0;');
                $serviceprovider= $this->db->resultSet();
                return $serviceprovider;
            }

            public function getspprofile($id){

                $this->db->query('SELECT * FROM user INNER JOIN service_provider ON user.user_id = service_provider.user_id WHERE user.user_id = :id');
                $this->db->bind(':id',$id);
                $serviceprovider= $this->db->resultSet();
                return $serviceprovider;
            }

            public function ignoresp($id,$ignore_reason){

                $this->db->query('UPDATE service_provider SET admin_ignored = 1, ignore_reason = :ignore_reason WHERE user_id = :id;');
                $this->db->bind(':ignore_reason',$ignore_reason);
                $this->db->bind(':id', $id);

                 if($this->db->execute()){
                    return true;
                } else {
                    return false;
                }

            }


            public function approvesp1($id){

                $this->db->query('UPDATE service_provider SET admin_ignored = 0, admin_approved = 1 WHERE user_id = :id;');
                $this->db->bind(':id', $id);

                 if($this->db->execute()){
                    return true;
                } else {
                    return false;
                }

            }


            public function approvesp2($id){

                $this->db->query('UPDATE service_provider SET admin_approved = 1 WHERE user_id = :id;');
                $this->db->bind(':id', $id);
                $this->db->execute();

                $this->db->query('UPDATE service_provider SET admin_ignored = 0 WHERE user_id = :id;');
                $this->db->bind(':id', $id);
                $this->db->execute();
                

            }




            public function getreportdetails(){

                $this->db->query('SELECT * FROM payment');
                $reportdetails= $this->db->resultSet();
                return $reportdetails;
            }



            public function gettotalpayment(){

                $this->db->query('SELECT SUM(amount) AS total FROM payment');
                $reportdetails= $this->db->single();
                return $reportdetails;
            }

            
            public function getcounts(){

                $this->db->query('SELECT
                (SELECT COUNT(*) FROM `user` WHERE `user_type` !=\'admin\') AS num_users,
                (SELECT COUNT(*) FROM `user` WHERE `user_type` = \'service_provider\') AS num_service_providers,
                (SELECT COUNT(*) FROM `user` WHERE `user_type` = \'seller\') AS num_sellers,
                (SELECT COUNT(*) FROM `product`) AS num_products');
                $getcounts= $this->db->resultSet();
                return $getcounts;
            }

            
            public function gettopratedsellers(){

                $this->db->query('SELECT * FROM user WHERE user_type = \'seller\' AND rate >= 4.0 AND rate <= 5.0 ORDER BY rate DESC LIMIT 5');
                $gettopratedsellers= $this->db->resultSet();
                return $gettopratedsellers;
            }

            public function producttypecount(){

                $this->db->query('SELECT COUNT(*) AS count, product_type
                FROM product
                GROUP BY product_type;
                ');
                $producttypecount= $this->db->resultSet();
                return $producttypecount;
            }
            public function getviewcount(){
                $month[]='';
                for($i=0;$i<12;$i++){
                    $this->db->query('SELECT COUNT(view_id) AS view_count FROM view_item WHERE MONTH(date)=:i GROUP BY MONTH(date)');
                    
                    $this->db->bind(':i', $i+1);
                    $mont=$this->db->resultSet();
                    if($mont!=null){
                        $month[$i]=$mont[0]->view_count;
                    }else{
                        $month[$i]=0;
                    }
                }
                return $month;
            }



    }



?>