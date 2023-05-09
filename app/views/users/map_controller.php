public function signup_ben(){
        // Check for POST
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form

            //sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $otp_code = rand(100000,999999);

            $role = 1;

            
         
            // Init data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),  
                'telephone_number' => trim($_POST['telephone_number']),
                'address' => trim($_POST['address']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'user_role'=>$role,
                'status' => false,
                'status_2' => '',
                'otp'=>$otp_code,
                'latitude' => trim($_POST['latitude']),
                'longitude' => trim($_POST['longitude']),
                'name_err' => '',
                'email_err' => '',
                'telephone_number_err' => '',
                'address_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            //Validate Email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';
            }
            //Validate Name
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter name';
            }
            //Validate Telephone Number
            if(empty($data['telephone_number'])){
                $data['telephone_number_err'] = 'Please enter telephone number';
            }
            //Validate Address
            if(empty($data['address'])){
                $data['address_err'] = 'Please enter address';
            }
            //Validate Password
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            } elseif(strlen($data['password']) < 6){
                $data['password_err'] = 'Password must be at least 6 characters';
            }
            //Validate Confirm Password
            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if($data['password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }
            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['name_err']) && empty($data['telephone number_err']) && empty($data['address_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
                // Validated
                //Hash
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                //Register User
                

                if($this->userModel->regcom($data) ){

                    flash('register_success', 'You are registered and can log in');
                    $x=$this->userModel->getBenUserId($data['email']);
                    $this->userModel->register($data,$x);
                    $email = new Email($data['email']);
                    $email->sendVerificationEmail($data['email'], $otp_code);
                    

                    redirect('Users/verify');
                } else {
                    die('Something went wrong');
                }

                
            } else {
                // Load view with errors
                $this->view('users/signup_ben', $data);
            }
            

            // Load view
            $this->view('users/signup_ben', $data);
        }
        else{
            // Init data
            $data = [
                'name' => '',
                'email' => '',  
                'telephone_number' => '',
                'address' => '',
                'password' => '',
                'status' => '',
                'otp'=>'',
                'status_2' => '',
                'role'=>'',
                'latitude' => '',
                'longitude' => '',

                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'telephone_number_err' => '',
                'address_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            // Load view
            $this->view('users/signup_ben', $data);
        }
    }