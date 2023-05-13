<?php
date_default_timezone_set("Asia/Kolkata");

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

        public function getUserDetailsByEmail($email){
            $this->db->query('SELECT * FROM user WHERE email = :email');
            $this->db->bind(':email' , $email);
            
            $row = $this->db->single();
            return $row;
        }

        public function findUserDetailsByEmail($email){
            $this->db->query('SELECT * FROM user WHERE email = :email');
            //Bind value
            $this->db->bind(':email', $email);
            $row = $this->db->single();
            //Check row
            if($this->db->rowCount() > 0){
                return $row;
            }else{
                return false;
            }
        }

        //Get user id
        public function getUserId($email){
            $this->db->query('SELECT * FROM user WHERE email = :email');
            //Bind value
            $this->db->bind(':email', $email);
            $row = $this->db->single();
            //Check row
            if($this->db->rowCount() > 0){
                return $row;
            }else{
                return false;
            }
        }

        public function getSellerDetails($id){
            $this->db->query('SELECT * FROM seller WHERE user_id = :id');
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

        public function advertise($data,$dat,$id=NULL){
            $this->db->query('INSERT INTO product (email,product_title,product_condition,product_category,district,product_type,model_no,brand,image1,image2,image3,image4,image5,image6,address,latitude,longitude,price,p_description,date_added,date_expires,repost_prev_id) VALUES(:user_email,:title,:condition,:category,:district,:type,:model,:brand,:image1,:image2,:image3,:image4,:image5,:image6,:address,:latitude,:longitude,:price,:description,:date_added,:date_expires,:id)');
            //Bind values
            $this->db->bind(':user_email', $data['user_email']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':condition', $data['condition']);
            $this->db->bind(':category', $data['category']);
            $this->db->bind(':district', $data['district']);
            $this->db->bind(':type', $data['type']);
            $this->db->bind(':model', $data['model']);
            $this->db->bind(':brand', $data['brand']);
            $this->db->bind(':image1', $data['image1']);
            $this->db->bind(':image2', $data['image2']);
            $this->db->bind(':image3', $data['image3']);
            $this->db->bind(':image4', $data['image4']);
            $this->db->bind(':image5', $data['image5']);
            $this->db->bind(':image6', $data['image6']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':latitude', $data['latitude']);
            $this->db->bind(':longitude', $data['longitude']);
            $this->db->bind(':price', $data['price']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':date_added', $data['date_added']);
            $this->db->bind(':date_expires', $data['date_expire']);
            $this->db->bind(':id', $id);

            //Execute
            if($this->db->execute()){
                $this->db->query('INSERT INTO seller_add_product (product_id,user_id,email,posted_time) VALUES(:product_id,:user_id,:user_email,:t)');
                //Bind values
                $product_id=$this->db->lastInsertId();
                $this->db->bind(':product_id', $product_id);
                $this->db->bind(':user_id', $data['user_id']);
                $this->db->bind(':user_email', $data['user_email']);
                $this->db->bind(':t', $dat);
                if($this->db->execute()){
                    if($data['type']=="auction"){
                        $this->db->query('INSERT INTO auction (product_id,email,start_date,end_date,start_price,is_active,is_finished) VALUES(:product_id,:email,:t,:end_date,:start_price,1,0)');
                        //Bind values
                        $this->db->bind(':product_id', $product_id);
                        $this->db->bind(':email', $data['user_email']);
                        $this->db->bind(':start_price', $data['price']);
                        $this->db->bind(':end_date', $data['end_date']);
                        $this->db->bind(':t', $dat);
                        if($this->db->execute()){
                            return $product_id;
                        }else{
                            return false;
                        }
                    }else{
                        return $product_id;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
        public function delete_prev_ad($id){
            $this->db->query('UPDATE product SET is_deleted=1 WHERE product_id = :id');
            //Bind values
            $this->db->bind(':id', $id);
            //Execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        
        public function edit_ispaid($id){
            $this->db->query('UPDATE product SET is_paid=1 WHERE product_id=:id');
            //Bind values
            $this->db->bind(':id', $id);
            //Execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function getRepostById($id){
            $this->db->query('SELECT * FROM product WHERE repost_prev_id = :id');
            $this->db->bind(':id', $id);
            $row = $this->db->execute();
            //Check row
            if($this->db->rowCount() > 0){//If there's a row, that means this product is reposted
                return 1;
            }else{
                return 0;
            }
        }


        //edit advertisement
        public function edit_advertisement($data){
            $this->db->query('UPDATE product SET product_title=:title,product_condition=:condition,product_category=:category,district=:district,model_no=:model,brand=:brand,image1=:image1,image2=:image2,image3=:image3,image4=:image4,image5=:image5,image6=:image6,price=:price,p_description=:description WHERE product_id=:id');
            //Bind values
            $this->db->bind(':id', $data['id']);
            // $this->db->bind(':user_email', $data['user_email']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':condition', $data['condition']);
            $this->db->bind(':category', $data['category']);
            $this->db->bind(':district', $data['district']);
            // $this->db->bind(':type', $data['type']);
            $this->db->bind(':model', $data['model']);
            $this->db->bind(':brand', $data['brand']);
            $this->db->bind(':image1', $data['image1']);
            $this->db->bind(':image2', $data['image2']);
            $this->db->bind(':image3', $data['image3']);
            $this->db->bind(':image4', $data['image4']);
            $this->db->bind(':image5', $data['image5']);
            $this->db->bind(':image6', $data['image6']);
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

        public function approve_bid($bid_id,$email,$price,$date){
            // $time=CONVERT_TZ(NOW(),'SYSTEM','Asia/Calcutta');
            $this->db->query('INSERT INTO bid_list (bid_id,time,price,email_buyer,is_accepted,is_rejected) VALUES(:bid_id,:t,:price,:email,0,0)');
            //Bind values
            $this->db->bind(':bid_id', $bid_id);
            $this->db->bind(':email', $email);
            $this->db->bind(':price', $price);
            $this->db->bind(':t', $date);

            //Execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }
        public function sellerDetailsWithLikeDislikeCount($email){
            $this->db->query('SELECT product_id, SUM(liked) as likes,SUM(disliked) as dislikes FROM reaction GROUP BY product_id');
            $likes_dislikes_count=$this->db->resultSet();
            $data['likes_dislikes_count']=$likes_dislikes_count;
            $data['likes']=0;
            $data['dislikes']=0;
            if(!empty($likes_dislikes_count)){
                foreach($likes_dislikes_count as $products){
                    $this->db->query('SELECT * FROM product WHERE product_id=:id AND is_deleted=0');
                    $this->db->bind(':id', $products->product_id);
                    $product=$this->db->single();
                    if(!empty($product)){
                        if($product->email==$email){
                            $data['likes']+=$products->likes;
                            $data['dislikes']+=$products->dislikes;
                        }
                    }
                }
            }else{
                $data['likes']=0;
                $data['dislikes']=0;
            }
            return $data;
        } 
        public function sellerDetailsWithLikeCountDates($email){
            $this->db->query('SELECT DATE(reaction.date_time) as date, count(reaction.product_id) as count FROM reaction INNER JOIN product ON reaction.product_id=product.product_id WHERE product.email=:email AND reaction.liked=1 AND product.is_deleted=0 GROUP BY DATE(reaction.date_time)');
            $this->db->bind(':email', $email);
            $likes=$this->db->resultSet();
            if($this->db->rowCount()>0){
                return $likes;
            }else{
                return false;
            }

        }
        public function sellerDetailsWithDislikeCountDates($email){
            $this->db->query('SELECT DATE(reaction.date_time) as date, count(reaction.product_id) as count FROM reaction INNER JOIN product ON reaction.product_id=product.product_id WHERE product.email=:email AND reaction.disliked=1 AND product.is_deleted=0 GROUP BY DATE(reaction.date_time)');
            $this->db->bind(':email', $email);
            $likes=$this->db->resultSet();
            if($this->db->rowCount()>0){
                return $likes;
            }else{
                return false;
            }

        }
        public function getFeedbacksRate($email){
            $rate[]='';
            for($i=0;$i<5;$i++){
                $this->db->query('SELECT count(email_rate_receiver) as count FROM rate WHERE email_rate_receiver=:email AND rate=:i GROUP BY rate');
                $this->db->bind(':email', $email);
                $this->db->bind(':i', $i);
                $rat=$this->db->resultSet();
                if($rat!=null){
                    $rate[$i]=$rat[0]->count;
                }else{
                    $rate[$i]=0;
                }
            }
            return $rate;
            
        }
        public function getProductsCount($email){
            $this->db->query('SELECT count(product_id) as count FROM product WHERE email=:email AND date_added=2023 GROUP BY MONTH(date_added)');
            $month[]='';
            for($i=0;$i<12;$i++){
                $this->db->query('SELECT count(product_id) as count FROM product WHERE email=:email AND YEAR(date_added)=2023 AND MONTH(date_added)=:i GROUP BY MONTH(date_added)');
                $this->db->bind(':email', $email);
                $this->db->bind(':i', $i+1);
                $mont=$this->db->resultSet();
                if($mont!=null){
                    $month[$i]=$mont[0]->count;
                }else{
                    $month[$i]=0;
                }
            }
            return $month;
        }


        

        public function sellerNoAuctions($email){
            $this->db->query('SELECT count(product_id) as count FROM auction WHERE email=:email AND is_active=1');
            $this->db->bind(':email', $email);
            $products=$this->db->single();
            return $products;

        }
        public function sellerNoFixedAds($email){
            $this->db->query('SELECT count(product_id) as count FROM product WHERE email=:email AND product_type="fixed_price" AND is_deleted=0');
            $this->db->bind(':email', $email);
            $products=$this->db->single();
            return $products;

        }
        
        public function getViewsCount($email){
            $this->db->query('SELECT DATE(view_item.date) AS date ,count(view_item.product_id) AS count FROM view_item INNER JOIN product ON view_item.product_id=product.product_id WHERE product.email=:email AND product.is_deleted=0 GROUP BY  DATE(view_item.date)');
            $this->db->bind(':email', $email);
            $products=$this->db->resultset();
            if($this->db->rowCount()>0){
                return $products;
            }else{
                return false;
            }

        }
        public function sellerNoViews($email){
            $this->db->query('SELECT SUM(view_count) as count FROM product WHERE email=:email AND is_deleted=0');
            $this->db->bind(':email', $email);
            $products=$this->db->single();
            return $products;

        }

        public function getAdvertiesmentById($id){
            $this->db->query('SELECT * FROM product WHERE product_id = :id');
            $this->db->bind(':id' , $id);

            $row = $this->db->single();
            return $row;
        }

        public function getAuctionById_withfinished($id){
            $this->db->query('SELECT * FROM auction WHERE product_id = :id ');
            $this->db->bind(':id' , $id);

            $row = $this->db->single();
            if($row){
                return $row;
            }else{
                return "Error";
            }
        }
        
        public function getAuctionDetails($id){
            $this->db->query('SELECT * FROM auction WHERE product_id = :id');
            $this->db->bind(':id' , $id);

            $row = $this->db->single();

            // SELECT email_buyer, MAX(price) FROM bid WHERE auction_id = 9 GROUP BY email_buyer ORDER BY(MAX(price)) DESC;
            $this->db->query('SELECT *,MAX(bid.price) as max_price,MAX(bid.bid_id) as max_bid_id FROM bid INNER JOIN auction ON auction.auction_id = bid.auction_id WHERE auction.auction_id = :id GROUP BY bid.email_buyer ORDER BY MAX(bid.price) DESC');
            $this->db->bind(':id' , $row->auction_id);
            $results = $this->db->resultSet();
            if($results){
                return $results;
            }else{
                return NULL;
            }
        }

        public function getAuctionDetailsNoRows($id){
            $this->db->query('SELECT * FROM auction WHERE product_id = :id');
            $this->db->bind(':id' , $id);

            $row = $this->db->single();

            $this->db->query('SELECT *,MAX(bid.price) as max_price,MAX(bid.bid_id) as max_bid_id FROM bid INNER JOIN auction ON auction.auction_id = bid.auction_id WHERE auction.auction_id = :id GROUP BY bid.email_buyer ORDER BY MAX(bid.price) DESC');
            $this->db->bind(':id' , $row->auction_id);
            $results = $this->db->resultSet();
            if($results){
                $rowCount=$this->db->rowCount();
                return $rowCount;
            }else{
                return NULL;
            }
        }

        public function getFeedbacks($email){
            $this->db->query('SELECT * FROM rate WHERE email_rate_receiver = :email');
            $this->db->bind(':email' , $email);

            $row = $this->db->resultSet();
            return $row;
        }

        public function getFeedbacksCount($email){
            $this->db->query('SELECT * FROM rate WHERE email_rate_receiver = :email');
            $this->db->bind(':email' , $email);
            $row = $this->db->resultSet();
            if($row){
                $rowCount = $this->db->rowCount();
                return $rowCount;
            }else{
                return 0;
            }
            
        }

        public function getBidList($bid_id){
            $this->db->query('SELECT * FROM bid_list WHERE bid_id = :id ');
            $this->db->bind(':id' , $bid_id);

            $row = $this->db->single();
            if($row){
                return $row;
            }else{
                return NULL;
            }
        }

        public function updateBidStatus($bid_id){
            $this->db->query('UPDATE bid_list SET is_rejected=1 WHERE bid_id = :id ');
            $this->db->bind(':id' , $bid_id);

            $row = $this->db->execute(); //single row
            if($row){
                return true;
            }else{
                return false;
            }
        }

        
        
        

    }