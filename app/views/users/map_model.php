public function register($data,$x){
        $this->db->query('INSERT INTO beneficiary_details (B_Name,B_Email,B_Tpno,B_Address,B_Password,otp,User_Id,latitude,longitude) VALUES(:name, :email,:telephone_number,:address, :password,:otp,:User_Id,:latitude,:longitude)');
        //bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telephone_number', $data['telephone_number']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':otp', $data['otp']);
        $this->db->bind(':User_Id', $x);
        $this->db->bind(':latitude', $data['latitude']);
        $this->db->bind(':longitude', $data['longitude']);





        //execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }