<?php
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;

require dirname(APPROOT).'/app/phpmailer/src/Exception.php';
require dirname(APPROOT).'/app/phpmailer/src/PHPMailer.php';
require dirname(APPROOT).'/app/phpmailer/src/SMTP.php';

    class Sellers extends Controller{
        private $sellerModel;
        // private $userModel;


        public function __construct(){
            if(isset($_SESSION['attempt'])){
                unset($_SESSION['otp_email']);
                unset($_SESSION['phone']);
                unset($_SESSION['attempt']);
                unset($_SESSION['time']);
            }
            if(!isLoggedIn()){
                
                $_SESSION['url']=URL();

                redirect('users/login');
            }
            else if($_SESSION['user_type'] != 'seller' && isLoggedIn()){
                redirect('users/index');
            }

            //Session timeout
            if(isset($_SESSION['session_time'])){
                if(time() - $_SESSION['session_time'] > 60*30){
                    // flash('session_expired', 'Your session has expired', 'alert alert-danger');
                    redirect('users/logout');
                }else{
                    $_SESSION['session_time'] = time();
                }
            }


            $this->sellerModel=$this->model('Seller');
            // $this->userModel = $this->model('User');

        }

        public function index(){

            $this->view('sellers/index');
        }

    public function getProfile($id){ 
        
        if(isset($_SESSION['phone'])){
            unset($_SESSION['phone']);
            unset($_SESSION['attempt']);
        }
      if(!isLoggedIn()){
        $_SESSION['url']=URL();

        redirect('users/login');
      }
      $details = $this->sellerModel->getUserDetails($id);
      $feedbackcount=$this->sellerModel->getFeedbacksCount($details->email);


      if ($details->user_id != $_SESSION['user_id']) {
        redirect('users/index');
      }
      $feedbacks=$this->sellerModel->getFeedbacks($details->email);

      $data =[
        'id' => $id,
        'user' => $details,
        'feedbacks' => $feedbacks,
        'feedbackcount' => $feedbackcount
      ];
      $this->view('sellers/getProfile',$data);
    }

        public function editProfile($id){
            if( $id != $_SESSION['user_id'] ){
              $_SESSION['url']=URL();

                redirect('users/login');
              }
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
              $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      
              $data = [
                'id' => $id,
                'first_name' => trim($_POST['first_name']),
                'second_name' => trim($_POST['second_name']),
                'email' => $_SESSION['user_email'],
                'address1' => trim($_POST['address1']),
                'address2' => trim($_POST['address2']),
                'user_id' => $_SESSION['user_id'],
                'first_name_err' => '',
                'second_name_err' => '',
                'address1_err' => '',
                'address2_err' => '',
              ];
      
              //validate data
              if(empty($data['first_name'])){
                $data['first_name_err'] = 'Please Enter First Name';
              }
              if(empty($data['second_name'])){
                $data['second_name_err'] = 'Please Enter Second Name';
              }
              if(empty($data['address1'])){
                $data['address1_err'] = 'Please Enter Address Line 1';
              }
              if(empty($data['address2'])){
                $data['address2_err'] = 'Please Enter Address Line 2';
              }
      
      
              if( empty($data['first_name_err']) && empty($data['second_name_err']) && empty($data['address1_err']) && empty($data['address1_err'] ) ){
                //validated
                if($this->sellerModel->updateProfile($data)){
                  $_SESSION['user_name'] = $data['first_name'];
                  redirect('sellers/getProfile/'.$_SESSION['user_id']);
                }
                else{
                  die('Something went wrong');
                }
      
              }
              else{
                //Load with errors
                $this->view('sellers/editProfile',$data);
              }
            }
            else{
              $details = $this->sellerModel->getUserDetails($id);
      
              if($details->user_id != $_SESSION['user_id']){
              $_SESSION['url']=URL();

                redirect('users/login');
              }
      
              $data = [
                'id' => $id,
                'first_name' => $details->first_name,
                'second_name' => $details->second_name,
                'address1' => $details->address1,
                'email' => $details->email,
                'address2' => $details->address2,
                'phone_number' => $details->phone_number
              ];
      
              $this->view('sellers/editProfile',$data);
            }
          }

          public function deleteProfile($id){
            if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
              $user = $this->sellerModel->getUserDetails($id);
      
              //check for owner
              if( $user->_id != $_SESSION['user_id'] ){
                $_SESSION['url']=URL();

                redirect('users/login');
              }
      
              if($this->sellerModel->deleteUserProfile($id)){
                unset($_SESSION['user_id']);
                unset($_SESSION['user_email']);
                unset($_SESSION['user_name']);
                unset($_SESSION['user_type']);
                session_destroy();
                flash('user_deleted','User deleted successfully');
                redirect('users/index');
              }
              else{
                die('Something went wrong');
              }
            }
            else{
              redirect('users/index');
            }
      
      
          }

        public function advertisements(){
            //Get advertisements
            $advertisements=$this->sellerModel->getadvertisements($_SESSION['user_email']);



            $data = [
                'advertisements' => $advertisements
              ];
             
              $this->view('sellers/advertisements', $data);
        }

        public function advertisement($id){
            $advertisement=$this->sellerModel->getAdvertisementById($id);
            $data=[
                'advertisement'=>$advertisement
            ];
            $auction = $this->sellerModel->getAuctionById_withfinished($id);
            $data['auction'] = $auction;
            if($data['advertisement']->email!=$_SESSION['user_email']){
                redirect('sellers/advertisements');
            }
            else{
                $this->view('sellers/advertisement',$data);
            }
        }

        //Add product
        public function advertise(){
            $sellerDetails = $this->sellerModel->getUserDetailsByEmail($_SESSION['user_email']);//Gets seller details
            if(!isLoggedIn()){
                $_SESSION['URL'] =URL();
                redirect('users/login');
                //If the seller didn't add his phone number
            }else if($sellerDetails->phone_number==NULL || $sellerDetails->phone_number=='' || $sellerDetails->phone_number==0 || empty($sellerDetails->phone_number) || $sellerDetails->phone_number==null){
                flash('phone_number_error','Please add your phone number before advertise.<a href="'.URLROOT.'/users/change_phone/'.$sellerDetails->user_id.'">Click Here</a>','alert alert-danger');
                $data['phone_err']='Please add your phone number before advertise.';
                redirect('sellers/getProfile/'.$sellerDetails->user_id);
            }

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Sanitize POST array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'user_email' => $_SESSION['user_email'],
                    'user_id'=>'',
                    'title' => trim($_POST['title']),
                    'description' => trim($_POST['description']),
                    'price' => trim($_POST['price']),
                    'condition' => trim($_POST['condition']),
                    'image1' => '',
                    'image2' => '',
                    'image3' => '',
                    'image4' => '',
                    'image5' => '',
                    'image6' => '',
                    'address'=>'',
                    'longitude' => '',
                    'latitude' => '',
                    'brand' => trim($_POST['brand']),
                    'model' => trim($_POST['model']),
                    'type'=> 'fixed_price',
                    'end_date'=>'',
                    'category' =>'',
                    'district' =>ucwords(trim($_POST['district'])),
                    'title_err' => '',
                    'description_err' => '',
                    'price_err' => '',
                    'condition_err' => '',
                    'image1_err' => '',
                    'image2_err' => '',
                    'image3_err' => '',
                    'image4_err' => '',
                    'image5_err' => '',
                    'image6_err' => '',
                    'error_geocode' => trim($_POST['error_geocode']),
                    'brand_err' => '',
                    'model_err' => '',
                    'category_err' => '',
                    'date_err'=>''
                ];
                if(isset($_POST['category'])){
                    $data['category']=$_POST['category'];
                }
                if(isset($_POST['check_au'])){
                    $data['type']='auction';
                    $num_of_dates=trim($_POST['date']);
                    // $data['end_date']=strtotime("+".$num_of_dates." Days");
                    $data['end_date']=date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). ' + '.$num_of_dates.' days'));
                    // $data['end_date']=date('Y-m-d  H:i:s',$data['end_date']);
                }
                if(isset($_POST['show_map'])){
                    $data['longitude']=trim($_POST['longitude']);
                    $data['latitude']=trim($_POST['latitude']);
                    $data['address']=trim($_POST['address']);
                    
                }else{
                    $data['longitude']='';
                    $data['latitude']='';
                    $data['address']='';
                }
                $user_id=$this->sellerModel->getUserId($data['user_email']);
                $data['user_id']=$user_id->user_id;

                //Validate data
                if(empty($data['title'])){
                    $data['title_err'] = 'Please enter title';
                }
                //Title doesn't contain any special characters
                else if(!preg_match("/^[a-zA-Z0-9 ]*$/",$data['title'])){
                    $data['title_err'] = 'Title cannot contain special characters';
                }
                if(empty($data['description'])){
                    $data['description_err'] = 'Please enter description';
                }
                if(empty($data['price'])){
                    $data['price_err'] = 'Please enter price';
                }else{
                    if(!is_numeric($data['price'])) {
                        $data['price_err'] = 'Please enter valid price';
                    }
                }
                if($data['price']<=0){
                    $data['price_err'] = 'Please enter valid price';
                }
                if(empty($data['category'])){
                    $data['category_err'] = 'Please check atleast one category';
                }else{
                    $data['category']=implode(',',$data['category']);//The implode function is used to concatenate all the values of the 'category' array into a single string separated by commas.
                }
                if(empty($data['condition'])){
                    $data['condition_err'] = 'Please enter condition';
                }
                if(empty($data['brand'])){
                    $data['brand_err'] = 'Please enter brand';
                }
                if(empty($data['model'])){
                    $data['model_err'] = 'Please enter model';
                }

                //Image 1
                if(!empty($_FILES['image1']['name'])){
                    $img_name = $_FILES['image1']['name'];
                    $img_size = $_FILES['image1']['size'];
                    $tmp_name = $_FILES['image1']['tmp_name'];
                    $error = $_FILES['image1']['error'];

                    if($error === 0){
                        if($img_size > 12500000){
                            $data['image1_err'] = "Sorry, your first image is too large.";
                        }
                        else{
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); //Extension type of image(jpg,png)
                            $img_ex_lc = strtolower($img_ex);

                            $allowed_exs = array("jpg", "jpeg", "png"); 

                            if(in_array($img_ex_lc, $allowed_exs)){
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = dirname(APPROOT).'/public/uploads/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                                $data['image1'] = $new_img_name;
                            }
                            else{
                                $data['image1_err'] = "You can't upload files of this type";
                            }
                        }
                    }
                    else{
                        $data['image1_err'] = "Unknown error occurred!";
                    }
                }else{
                    $data['image1_err'] = 'Please upload atleast one image';
                }

                //Image 2
                if(!empty($_FILES['image2']['name'])){
                    $img_name = $_FILES['image2']['name'];
                    $img_size = $_FILES['image2']['size'];
                    $tmp_name = $_FILES['image2']['tmp_name'];
                    $error = $_FILES['image2']['error'];

                    if($error === 0){
                        if($img_size > 12500000){
                            $data['image2_err'] = "Sorry, your second image is too large.";
                        }
                        else{
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); //Extension type of image(jpg,png)
                            $img_ex_lc = strtolower($img_ex);

                            $allowed_exs = array("jpg", "jpeg", "png"); 

                            if(in_array($img_ex_lc, $allowed_exs)){
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = dirname(APPROOT).'/public/uploads/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                                $data['image2'] = $new_img_name;
                            }
                            else{
                                $data['image2_err'] = "You can't upload files of this type";
                            }
                        }
                    }
                    else{
                        $data['image2_err'] = "Unknown error occurred!";
                    }
                 }


                //Image 3
                if(!empty($_FILES['image3']['name'])){
                    $img_name = $_FILES['image3']['name'];
                    $img_size = $_FILES['image3']['size'];
                    $tmp_name = $_FILES['image3']['tmp_name'];
                    $error = $_FILES['image3']['error'];

                    if($error === 0){
                        if($img_size > 12500000){
                            $data['image3_err'] = "Sorry, your third image is too large.";
                        }
                        else{
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); //Extension type of image(jpg,png)
                            $img_ex_lc = strtolower($img_ex);

                            $allowed_exs = array("jpg", "jpeg", "png"); 

                            if(in_array($img_ex_lc, $allowed_exs)){
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = dirname(APPROOT).'/public/uploads/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                                $data['image3'] = $new_img_name;
                            }
                            else{
                                $data['image3_err'] = "You can't upload files of this type";
                            }
                        }
                    }
                    else{
                        $data['image3_err'] = "Unknown error occurred!";
                    }
                }

                //Image 4
                if(!empty($_FILES['image4']['name'])){
                    $img_name = $_FILES['image4']['name'];
                    $img_size = $_FILES['image4']['size'];
                    $tmp_name = $_FILES['image4']['tmp_name'];
                    $error = $_FILES['image4']['error'];

                    if($error === 0){
                        if($img_size > 12500000){
                            $data['image4_err'] = "Sorry, your third image is too large.";
                        }
                        else{
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); //Extension type of image(jpg,png)
                            $img_ex_lc = strtolower($img_ex);

                            $allowed_exs = array("jpg", "jpeg", "png"); 

                            if(in_array($img_ex_lc, $allowed_exs)){
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = dirname(APPROOT).'/public/uploads/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                                $data['image4'] = $new_img_name;
                            }
                            else{
                                $data['image4_err'] = "You can't upload files of this type";
                            }
                        }
                    }
                    else{
                        $data['image4_err'] = "Unknown error occurred!";
                    }
                }

                //Image 5
                if(!empty($_FILES['image5']['name'])){
                    $img_name = $_FILES['image5']['name'];
                    $img_size = $_FILES['image5']['size'];
                    $tmp_name = $_FILES['image5']['tmp_name'];
                    $error = $_FILES['image5']['error'];

                    if($error === 0){
                        if($img_size > 12500000){
                            $data['image5_err'] = "Sorry, your third image is too large.";
                        }
                        else{
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); //Extension type of image(jpg,png)
                            $img_ex_lc = strtolower($img_ex);

                            $allowed_exs = array("jpg", "jpeg", "png"); 

                            if(in_array($img_ex_lc, $allowed_exs)){
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = dirname(APPROOT).'/public/uploads/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                                $data['image5'] = $new_img_name;
                            }
                            else{
                                $data['image5_err'] = "You can't upload files of this type";
                            }
                        }
                    }
                    else{
                        $data['image5_err'] = "Unknown error occurred!";
                    }
                }

                //Image 6
                if(!empty($_FILES['image6']['name'])){
                    $img_name = $_FILES['image6']['name'];
                    $img_size = $_FILES['image6']['size'];
                    $tmp_name = $_FILES['image6']['tmp_name'];
                    $error = $_FILES['image6']['error'];

                    if($error === 0){
                        if($img_size > 12500000){
                            $data['image6_err'] = "Sorry, your third image is too large.";
                        }
                        else{
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); //Extension type of image(jpg,png)
                            $img_ex_lc = strtolower($img_ex);

                            $allowed_exs = array("jpg", "jpeg", "png"); 

                            if(in_array($img_ex_lc, $allowed_exs)){
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = dirname(APPROOT).'/public/uploads/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                                $data['image3'] = $new_img_name;
                            }
                            else{
                                $data['image6_err'] = "You can't upload files of this type";
                            }
                        }
                    }
                    else{
                        $data['image6_err'] = "Unknown error occurred!";
                    }
                }
                //Make sure no errors
                if(empty($data['title_err']) && empty($data['description_err']) && empty($data['price_err'])  && empty($data['condition_err']) && empty($data['image1_err']) && empty($data['image2_err']) && empty($data['image3_err']) && empty($data['image4_err']) && empty($data['image5_err']) && empty($data['image6_err']) && empty($data['error_geocode']) && empty($data['brand_err']) && empty($data['model_err'])){
                    //Validated
                    
                    $dat=date('Y-m-d H:i:s');
                    $data['date_added']=$dat;
                    $data['date_expire']=date('Y-m-d H:i:s', strtotime($dat. ' + 90 days'));
                    if($data['longitude']=='' && $data['latitude']==''){
                        $data['longitude']='NULL';
                        $data['latitude']='NULL';
                        $data['address']='NULL';
                    }
                    
                    $product_id=$this->sellerModel->advertise($data,$dat);
                    if($product_id!=false){
                        $data1=[
                            'title' => $data['title'],
                        ];
                        flash('product_message', 'Product Added');
                        // redirect('users/checkout/'.urlencode(base64_encode("$data1")));
                        // urlencode(base64_encode("user-data"))
                        redirect('users/checkout/'.$product_id.'/'.urlencode(json_encode($data1)));
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    //Load view with errors
                    $this->view('sellers/advertise', $data);
                }

            } else {
                $data = [
                    'user_email' => $_SESSION['user_email'],
                    'title' => '',
                    'description' => '',
                    'user_id' => '',
                    'price' => '',
                    'condition' => '',
                    'image1' => '',
                    'image2' => '',
                    'image3' => '',
                    'image4' => '',
                    'image5' => '',
                    'image6' => '',
                    'address' => '',
                    'longitude' => '',
                    'latitude' => '',
                    'brand' => '',
                    'model' => '',
                    'category' =>'',
                    'type'=>'',
                    'end_date' => '',
                    'title_err' => '',
                    'description_err' => '',
                    'price_err' => '',
                    'condition_err' => '',
                    'image1_err' => '',
                    'image2_err' => '',
                    'image3_err' => '',
                    'image4_err' => '',
                    'image5_err' => '',
                    'image6_err' => '',
                    'error_geocode' => '',
                    'brand_err' => '',
                    'model_err' => '',
                    'category_err' => ''
                ];
                $this->view('sellers/advertise', $data);
            }

            
        }

        //Edit add
        public function edit_advertisement($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $advertisement=$this->sellerModel->getAdvertisementById($id);
                //Sanitize POST array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'id' => $id,
                    'user_email' => $_SESSION['user_email'],
                    'title' => trim($_POST['title']),
                    'description' => trim($_POST['description']),
                    'price' => trim($_POST['price']),
                    'condition' => trim($_POST['condition']),
                    'image1' => '',
                    'image2' => '',
                    'image3' => '',
                    'image4' => '',
                    'image5' => '',
                    'image6' => '',
                    'brand' => trim($_POST['brand']),
                    'model' => trim($_POST['model']),
                    'category' =>'',
                    'district' => trim($_POST['district']),
                    'product_type'=>$advertisement->product_type,
                    'title_err' => '',
                    'description_err' => '',
                    'price_err' => '',
                    'condition_err' => '',
                    'image1_err' => '',
                    'image2_err' => '',
                    'image3_err' => '',
                    'image4_err' => '',
                    'image5_err' => '',
                    'image6_err' => '',
                    'brand_err' => '',
                    'model_err' => '',
                    'category_err' => ''
                ];
                if(isset($_POST['category'])){
                    $data['category']=$_POST['category'];
                }
                //Validate data
                if(empty($data['title'])){
                    $data['title_err'] = 'Please enter title';
                }
                if(empty($data['description'])){
                    $data['description_err'] = 'Please enter description';
                }
                if($advertisement->product_type=='auction'){
                    $data['price']=$advertisement->price;
                }else{
                    $data['price']=trim($_POST['price']);
                    if(empty($data['price'])){
                        $data['price_err'] = 'Please enter price';
                    }else{
                        if(!is_numeric($data['price'])) {
                            $data['price_err'] = 'Please enter valid price';
                        }
                    }
                    if($data['price']<=0){
                        $data['price_err'] = 'Please enter valid price';
                    }
                }
                if(empty($data['category'])){
                    $data['category_err'] = 'Please check atleast one category';
                }else{
                    $data['category']=implode(',',$data['category']);//The implode function is used to concatenate all the values of the 'category' array into a single string separated by commas.
                }
                if(empty($data['condition'])){
                    $data['condition_err'] = 'Please enter condition';
                }
                // if(empty($data['image1'])){
                //     $data['image1_err'] = 'Please enter image1';
                // }
                // if(empty($data['image2'])){
                //     $data['image2_err'] = 'Please enter image2';
                // }
                // if(empty($data['image3'])){
                //     $data['image3_err'] = 'Please enter image3';
                // }
                if(empty($data['brand'])){
                    $data['brand_err'] = 'Please enter brand';
                }
                if(empty($data['model'])){
                    $data['model_err'] = 'Please enter model';
                }
                if($data['price']<=0){
                    $data['price_err'] = 'Please enter valid price';
                }
                //Image 1
                if(!empty($_FILES['image1']['name'])){
                    $img_name = $_FILES['image1']['name'];
                    $img_size = $_FILES['image1']['size'];
                    $tmp_name = $_FILES['image1']['tmp_name'];
                    $error = $_FILES['image1']['error'];

                    if($error === 0){
                        if($img_size > 12500000){
                            $data['image1_err'] = "Sorry, your first image is too large.";
                        }
                        else{
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); //Extension type of image(jpg,png)
                            $img_ex_lc = strtolower($img_ex);

                            $allowed_exs = array("jpg", "jpeg", "png"); 

                            if(in_array($img_ex_lc, $allowed_exs)){
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = dirname(APPROOT).'/public/uploads/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                                $data['image1'] = $new_img_name;
                            }
                            else{
                                $data['image1_err'] = "You can't upload files of this type";
                            }
                        }
                    }else{
                        $data['image1'] = $advertisement->image1;
                    }
                }else{
                    $data['image1'] = $advertisement->image1;
                }

                //Image 2
                if(!empty($_FILES['image2']['name'])){
                    $img_name = $_FILES['image2']['name'];
                    $img_size = $_FILES['image2']['size'];
                    $tmp_name = $_FILES['image2']['tmp_name'];
                    $error = $_FILES['image2']['error'];

                    if($error === 0){
                        if($img_size > 12500000){
                            $data['image2_err'] = "Sorry, your second image is too large.";
                        }
                        else{
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); //Extension type of image(jpg,png)
                            $img_ex_lc = strtolower($img_ex);

                            $allowed_exs = array("jpg", "jpeg", "png"); 

                            if(in_array($img_ex_lc, $allowed_exs)){
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = dirname(APPROOT).'/public/uploads/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                                $data['image2'] = $new_img_name;
                            }
                            else{
                                $data['image2_err'] = "You can't upload files of this type";
                            }
                        }
                    }
                    else{
                        $data['image2'] = $advertisement->image2;

                    }
                 }else{
                    $data['image2'] = $advertisement->image2;

                }


                //Image 3
                if(!empty($_FILES['image3']['name'])){
                    $img_name = $_FILES['image3']['name'];
                    $img_size = $_FILES['image3']['size'];
                    $tmp_name = $_FILES['image3']['tmp_name'];
                    $error = $_FILES['image3']['error'];

                    if($error === 0){
                        if($img_size > 12500000){
                            $data['image3_err'] = "Sorry, your third image is too large.";
                        }
                        else{
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); //Extension type of image(jpg,png)
                            $img_ex_lc = strtolower($img_ex);

                            $allowed_exs = array("jpg", "jpeg", "png"); 

                            if(in_array($img_ex_lc, $allowed_exs)){
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = dirname(APPROOT).'/public/uploads/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                                $data['image3'] = $new_img_name;
                            }
                            else{
                                $data['image3_err'] = "You can't upload files of this type";
                            }
                        }
                    }
                    else{
                        $data['image3'] = $advertisement->image3;

                    }
                }else{
                    $data['image3'] = $advertisement->image3;

                }  
                
                //Image 4
                if(!empty($_FILES['image4']['name'])){
                    $img_name = $_FILES['image4']['name'];
                    $img_size = $_FILES['image4']['size'];
                    $tmp_name = $_FILES['image4']['tmp_name'];
                    $error = $_FILES['image4']['error'];

                    if($error === 0){
                        if($img_size > 12500000){
                            $data['image4_err'] = "Sorry, your third image is too large.";
                        }
                        else{
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); //Extension type of image(jpg,png)
                            $img_ex_lc = strtolower($img_ex);

                            $allowed_exs = array("jpg", "jpeg", "png"); 

                            if(in_array($img_ex_lc, $allowed_exs)){
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = dirname(APPROOT).'/public/uploads/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                                $data['image4'] = $new_img_name;
                            }
                            else{
                                $data['image4_err'] = "You can't upload files of this type";
                            }
                        }
                    }
                    else{
                        $data['image4'] = $advertisement->image4;

                    }
                }else{
                    $data['image4'] = $advertisement->image4;

                }

                //Image 5
                if(!empty($_FILES['image5']['name'])){
                    $img_name = $_FILES['image5']['name'];
                    $img_size = $_FILES['image5']['size'];
                    $tmp_name = $_FILES['image5']['tmp_name'];
                    $error = $_FILES['image5']['error'];

                    if($error === 0){
                        if($img_size > 12500000){
                            $data['image5_err'] = "Sorry, your third image is too large.";
                        }
                        else{
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); //Extension type of image(jpg,png)
                            $img_ex_lc = strtolower($img_ex);

                            $allowed_exs = array("jpg", "jpeg", "png"); 

                            if(in_array($img_ex_lc, $allowed_exs)){
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = dirname(APPROOT).'/public/uploads/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                                $data['image5'] = $new_img_name;
                            }
                            else{
                                $data['image5_err'] = "You can't upload files of this type";
                            }
                        }
                    }
                    else{
                        $data['image5'] = $advertisement->image5;

                    }
                }else{
                    $data['image5'] = $advertisement->image5;

                }

                //Image 6
                if(!empty($_FILES['image6']['name'])){
                    $img_name = $_FILES['image6']['name'];
                    $img_size = $_FILES['image6']['size'];
                    $tmp_name = $_FILES['image6']['tmp_name'];
                    $error = $_FILES['image6']['error'];

                    if($error === 0){
                        if($img_size > 12500000){
                            $data['image6_err'] = "Sorry, your third image is too large.";
                        }
                        else{
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); //Extension type of image(jpg,png)
                            $img_ex_lc = strtolower($img_ex);

                            $allowed_exs = array("jpg", "jpeg", "png"); 

                            if(in_array($img_ex_lc, $allowed_exs)){
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = dirname(APPROOT).'/public/uploads/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                                $data['image6'] = $new_img_name;
                            }
                            else{
                                $data['image6_err'] = "You can't upload files of this type";
                            }
                        }
                    }
                    else{
                        $data['image6'] = $advertisement->image6;

                    }
                }else{
                    $data['image6'] = $advertisement->image6;

                }


                //Make sure no errors
                if(empty($data['title_err']) && empty($data['category_err']) && empty($data['description_err']) && empty($data['price_err'])  && empty($data['condition_err']) && empty($data['image1_err']) && empty($data['image2_err']) && empty($data['image3_err']) && empty($data['image4_err']) && empty($data['image5_err']) && empty($data['image6_err']) && empty($data['brand_err']) && empty($data['model_err'])){
                    //Validated
                    if($this->sellerModel->edit_advertisement($data)){
                        flash('product_message', 'Product Edited');
                        redirect('sellers/advertisements');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    //Load view with errors
                    $this->view('sellers/edit_advertisement', $data);
                }

            } else {
                //Get existing post from model
                $advertisement=$this->sellerModel->getAdvertisementById($id);
                //Check for owner
                if($advertisement->email != $_SESSION['user_email']){
                    redirect('sellers/advertisements');
                }
                $data = [
                    'id' => $id,
                    'user_email' => $advertisement->email,
                    'title' => $advertisement->product_title,
                    'description' => $advertisement->p_description,
                    'price' => $advertisement->price,
                    'condition' => $advertisement->product_condition,
                    'image1' => $advertisement->image1,
                    'image2' => $advertisement->image2,
                    'image3' => $advertisement->image3,
                    'image4' => $advertisement->image4,
                    'image5' => $advertisement->image5,
                    'image6' => $advertisement->image6,
                    'brand' => $advertisement->brand,
                    'model' => $advertisement->model_no,
                    'category' =>$advertisement->product_category,
                    'district' => $advertisement->district,
                    'product_type'=>$advertisement->product_type,
                    'title_err' => '',
                    'description_err' => '',
                    'price_err' => '',
                    'condition_err' => '',
                    'image1_err' => '',
                    'image2_err' => '',
                    'image3_err' => '',
                    'image4_err' => '',
                    'image5_err' => '',
                    'image6_err' => '',
                    'brand_err' => '',
                    'model_err' => '',
                    'category_err' => ''
                ];
                

                $this->view('sellers/edit_advertisement', $data);
            }

            
        }

        //Reposting an expired auction with no bids/accepted bids
        public function repost($id){
            $reposted=$this->sellerModel->getRepostById($id);
            if($reposted==1){
                redirect('sellers/advertisements');
            }
            $data['reposted']=$reposted;
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $advertisement=$this->sellerModel->getAdvertisementById($id);
                //Check for owner
                if($advertisement->email != $_SESSION['user_email']){
                    redirect('sellers/advertisements');
                }
                if($advertisement->product_type!="auction"){
                    redirect('sellers/advertisements');
                }
                //Sanitize POST array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'id' => $id,
                    'user_email' => $_SESSION['user_email'],
                    'title' => trim($_POST['title']),
                    'description' => trim($_POST['description']),
                    'price' => trim($_POST['price']),
                    'condition' => trim($_POST['condition']),
                    'image1' => '',
                    'image2' => '',
                    'image3' => '',
                    'image4' => '',
                    'image5' => '',
                    'image6' => '',
                    'address'=>'',
                    'longitude' => '',
                    'latitude' => '',
                    'brand' => trim($_POST['brand']),
                    'model' => trim($_POST['model']),
                    'category' =>'',
                    'type' =>'auction',
                    'district' => trim($_POST['district']),
                    'product_type'=>$advertisement->product_type,
                    'title_err' => '',
                    'description_err' => '',
                    'price_err' => '',
                    'condition_err' => '',
                    'image1_err' => '',
                    'image2_err' => '',
                    'image3_err' => '',
                    'image4_err' => '',
                    'image5_err' => '',
                    'image6_err' => '',
                    // 'error_geocode' => trim($_POST['error_geocode']),
                    'brand_err' => '',
                    'model_err' => '',
                    'category_err' => ''
                ];

                $user_id=$this->sellerModel->getUserId($data['user_email']);
                $data['user_id']=$user_id->user_id;
                //Calculating end date
                $num_of_dates=trim($_POST['date']);
                $data['end_date']=date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). ' + '.$num_of_dates.' days'));

                if(isset($_POST['category'])){
                    $data['category']=$_POST['category'];
                }

                if(isset($_POST['show_map'])){
                    $data['longitude']=trim($_POST['longitude']);
                    $data['latitude']=trim($_POST['latitude']);
                    $data['address']=trim($_POST['address']);
                    
                }else{
                    $data['longitude']='';
                    $data['latitude']='';
                    $data['address']='';
                }

                //Validate data
                if(empty($data['title'])){
                    $data['title_err'] = 'Please enter title';
                }
                if(empty($data['description'])){
                    $data['description_err'] = 'Please enter description';
                }
                if(empty($data['price'])){
                    $data['price_err'] = 'Please enter price';
                }else{
                    if(!is_numeric($data['price'])) {
                        $data['price_err'] = 'Please enter valid price';
                    }
                }
                if($data['price']<=0){
                    $data['price_err'] = 'Please enter valid price';
                }
                if(empty($data['category'])){
                    $data['category_err'] = 'Please check atleast one category';
                }else{
                    $data['category']=implode(',',$data['category']);//The implode function is used to concatenate all the values of the 'category' array into a single string separated by commas.
                }
                if(empty($data['condition'])){
                    $data['condition_err'] = 'Please enter condition';
                }
                if(empty($data['brand'])){
                    $data['brand_err'] = 'Please enter brand';
                }
                if(empty($data['model'])){
                    $data['model_err'] = 'Please enter model';
                }
                if($data['price']<=0){
                    $data['price_err'] = 'Please enter valid price';
                }
                //Image 1
                if(!empty($_FILES['image1']['name'])){
                    $img_name = $_FILES['image1']['name'];
                    $img_size = $_FILES['image1']['size'];
                    $tmp_name = $_FILES['image1']['tmp_name'];
                    $error = $_FILES['image1']['error'];

                    if($error === 0){
                        if($img_size > 12500000){
                            $data['image1_err'] = "Sorry, your first image is too large.";
                        }
                        else{
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); //Extension type of image(jpg,png)
                            $img_ex_lc = strtolower($img_ex);

                            $allowed_exs = array("jpg", "jpeg", "png"); 

                            if(in_array($img_ex_lc, $allowed_exs)){
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = dirname(APPROOT).'/public/uploads/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                                $data['image1'] = $new_img_name;
                            }
                            else{
                                $data['image1_err'] = "You can't upload files of this type";
                            }
                        }
                    }else{
                        $data['image1'] = $advertisement->image1;
                    }
                }else{
                    $data['image1'] = $advertisement->image1;
                }

                //Image 2
                if(!empty($_FILES['image2']['name'])){
                    $img_name = $_FILES['image2']['name'];
                    $img_size = $_FILES['image2']['size'];
                    $tmp_name = $_FILES['image2']['tmp_name'];
                    $error = $_FILES['image2']['error'];

                    if($error === 0){
                        if($img_size > 12500000){
                            $data['image2_err'] = "Sorry, your second image is too large.";
                        }
                        else{
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); //Extension type of image(jpg,png)
                            $img_ex_lc = strtolower($img_ex);

                            $allowed_exs = array("jpg", "jpeg", "png"); 

                            if(in_array($img_ex_lc, $allowed_exs)){
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = dirname(APPROOT).'/public/uploads/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                                $data['image2'] = $new_img_name;
                            }
                            else{
                                $data['image2_err'] = "You can't upload files of this type";
                            }
                        }
                    }
                    else{
                        $data['image2'] = $advertisement->image2;

                    }
                 }else{
                    $data['image2'] = $advertisement->image2;

                }


                //Image 3
                if(!empty($_FILES['image3']['name'])){
                    $img_name = $_FILES['image3']['name'];
                    $img_size = $_FILES['image3']['size'];
                    $tmp_name = $_FILES['image3']['tmp_name'];
                    $error = $_FILES['image3']['error'];

                    if($error === 0){
                        if($img_size > 12500000){
                            $data['image3_err'] = "Sorry, your third image is too large.";
                        }
                        else{
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); //Extension type of image(jpg,png)
                            $img_ex_lc = strtolower($img_ex);

                            $allowed_exs = array("jpg", "jpeg", "png"); 

                            if(in_array($img_ex_lc, $allowed_exs)){
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = dirname(APPROOT).'/public/uploads/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                                $data['image3'] = $new_img_name;
                            }
                            else{
                                $data['image3_err'] = "You can't upload files of this type";
                            }
                        }
                    }
                    else{
                        $data['image3'] = $advertisement->image3;

                    }
                }else{
                    $data['image3'] = $advertisement->image3;

                }  
                
                //Image 4
                if(!empty($_FILES['image4']['name'])){
                    $img_name = $_FILES['image4']['name'];
                    $img_size = $_FILES['image4']['size'];
                    $tmp_name = $_FILES['image4']['tmp_name'];
                    $error = $_FILES['image4']['error'];

                    if($error === 0){
                        if($img_size > 12500000){
                            $data['image4_err'] = "Sorry, your third image is too large.";
                        }
                        else{
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); //Extension type of image(jpg,png)
                            $img_ex_lc = strtolower($img_ex);

                            $allowed_exs = array("jpg", "jpeg", "png"); 

                            if(in_array($img_ex_lc, $allowed_exs)){
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = dirname(APPROOT).'/public/uploads/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                                $data['image4'] = $new_img_name;
                            }
                            else{
                                $data['image4_err'] = "You can't upload files of this type";
                            }
                        }
                    }
                    else{
                        $data['image4'] = $advertisement->image4;

                    }
                }else{
                    $data['image4'] = $advertisement->image4;

                }

                //Image 5
                if(!empty($_FILES['image5']['name'])){
                    $img_name = $_FILES['image5']['name'];
                    $img_size = $_FILES['image5']['size'];
                    $tmp_name = $_FILES['image5']['tmp_name'];
                    $error = $_FILES['image5']['error'];

                    if($error === 0){
                        if($img_size > 12500000){
                            $data['image5_err'] = "Sorry, your third image is too large.";
                        }
                        else{
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); //Extension type of image(jpg,png)
                            $img_ex_lc = strtolower($img_ex);

                            $allowed_exs = array("jpg", "jpeg", "png"); 

                            if(in_array($img_ex_lc, $allowed_exs)){
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = dirname(APPROOT).'/public/uploads/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                                $data['image5'] = $new_img_name;
                            }
                            else{
                                $data['image5_err'] = "You can't upload files of this type";
                            }
                        }
                    }
                    else{
                        $data['image5'] = $advertisement->image5;

                    }
                }else{
                    $data['image5'] = $advertisement->image5;

                }

                //Image 6
                if(!empty($_FILES['image6']['name'])){
                    $img_name = $_FILES['image6']['name'];
                    $img_size = $_FILES['image6']['size'];
                    $tmp_name = $_FILES['image6']['tmp_name'];
                    $error = $_FILES['image6']['error'];

                    if($error === 0){
                        if($img_size > 12500000){
                            $data['image6_err'] = "Sorry, your third image is too large.";
                        }
                        else{
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); //Extension type of image(jpg,png)
                            $img_ex_lc = strtolower($img_ex);

                            $allowed_exs = array("jpg", "jpeg", "png"); 

                            if(in_array($img_ex_lc, $allowed_exs)){
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = dirname(APPROOT).'/public/uploads/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                                $data['image6'] = $new_img_name;
                            }
                            else{
                                $data['image6_err'] = "You can't upload files of this type";
                            }
                        }
                    }
                    else{
                        $data['image6'] = $advertisement->image6;

                    }
                }else{
                    $data['image6'] = $advertisement->image6;

                }


                //Make sure no errors
                if(empty($data['title_err']) && empty($data['description_err']) && empty($data['price_err'])  && empty($data['category_err']) && empty($data['condition_err']) && empty($data['image1_err']) && empty($data['image2_err']) && empty($data['image3_err']) && empty($data['image4_err']) && empty($data['image5_err']) && empty($data['image6_err']) && empty($data['brand_err']) && empty($data['model_err'])){
                    //Validated

                    $dat=date('Y-m-d H:i:s');
                    $data['date_added']=$dat;
                    $data['date_expire']=date('Y-m-d H:i:s', strtotime($dat. ' + 90 days'));
                    if($data['longitude']=='' && $data['latitude']==''){
                        $data['longitude']='NULL';
                        $data['latitude']='NULL';
                        $data['address']='NULL';
                    }
                    $product_id=$this->sellerModel->advertise($data,$dat,$data['id']);
                    if($product_id){
                        //Change is_deleted to 1 in previous ad
                        if($this->sellerModel->delete_prev_ad($data['id'])){
                            //As this is a repost, no need to pay again. So updating is_paid in product to 1
                            if($this->sellerModel->edit_ispaid($product_id)){
                                flash('product_message', 'Product Reposted');
                                redirect('sellers/advertisements');
                            }
                        }
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    //Load view with errors
                    $this->view('sellers/repost', $data);
                }

            } else {
                //Get existing post from model
                $advertisement=$this->sellerModel->getAdvertisementById($id);
                //Check for owner
                if($advertisement->email != $_SESSION['user_email']){
                    redirect('sellers/advertisements');
                }
                if($advertisement->product_type!="auction"){
                    redirect('sellers/advertisements');
                }
                $data = [
                    'id' => $id,
                    'user_email' => $advertisement->email,
                    'title' => $advertisement->product_title,
                    'description' => $advertisement->p_description,
                    'price' => $advertisement->price,
                    'condition' => $advertisement->product_condition,
                    'image1' => $advertisement->image1,
                    'image2' => $advertisement->image2,
                    'image3' => $advertisement->image3,
                    'image4' => $advertisement->image4,
                    'image5' => $advertisement->image5,
                    'image6' => $advertisement->image6,
                    'brand' => $advertisement->brand,
                    'model' => $advertisement->model_no,
                    'category' =>$advertisement->product_category,
                    'district' => $advertisement->district,
                    'product_type'=>$advertisement->product_type,
                    'title_err' => '',
                    'longitude' => $advertisement->longitude,
                    'latitude' => $advertisement->latitude,
                    'address' => $advertisement->address,
                    'description_err' => '',
                    'price_err' => '',
                    'condition_err' => '',
                    'image1_err' => '',
                    'image2_err' => '',
                    'image3_err' => '',
                    'image4_err' => '',
                    'image5_err' => '',
                    'image6_err' => '',
                    'brand_err' => '',
                    'model_err' => '',
                    'category_err' => ''
                ];
                $user_id=$this->sellerModel->getUserId($data['user_email']);
                $data['user_id']=$user_id->user_id;

                $this->view('sellers/repost', $data);
            }

            
        }


        public function delete_advertisement($id){
            // if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Get existing post from model
                $advertisement=$this->sellerModel->getAdvertisementById($id);
                //Check for owner
                if($advertisement->email != $_SESSION['user_email']){
                    redirect('sellers/advertisements');
                }
                if($this->sellerModel->delete_advertisement($id)){
                    flash('product_message', 'Product Removed');
                    redirect('sellers/advertisements');
                } else {
                    die('Something went wrong');
                }
            // } else {
            //     redirect('sellers/advertisements');
            // }
        }

        public function bid_list($id){
            //Gets advertisement details
            $ad = $this->sellerModel->getAdvertiesmentById($id);//Advertiesement details
            $reposted=$this->sellerModel->getRepostById($id); //If reposted=1, that means this product is reposted
            $data['reposted']=$reposted;
            if(isLoggedIn()){
                if($ad->email != $_SESSION['user_email']){//If not the owner of the posted advertisement
                        $_SESSION['url'] = URL();
                        redirect('users/login');
                    }
            }else{
                $_SESSION['url']=URL();
                redirect('users/login');
            }

            $data['ad'] = $ad;
            $auction = $this->sellerModel->getAuctionById_withfinished($id); //Gets the auction details of the product(Not need to check whether the auction is finished or not)
            $data['auction'] = $auction;
            
            $auction_details = $this -> sellerModel->getAuctionDetails($id); //Gets all the current placed bids 
            $auctions_details_no_rows= $this -> sellerModel->getAuctionDetailsNoRows($id);

           

            $data['check']=0;
            $data['auctions_no_rows'] ='';
            if($auction_details){
              $data['auctions'] =$auction_details;
              $data['auctions_no_rows'] =$auctions_details_no_rows;
            //   $data['user']=$this->userModel->findUserDetailsByEmail($auction_details->email_buyer);

              for($i=0;$i<$auctions_details_no_rows;$i++){
                 $bid_list = $this->sellerModel->getBidList($data['auctions'][$i]->max_bid_id,$data['auctions'][$i]->max_price);
                 $data['user'][$i]=$this->sellerModel->findUserDetailsByEmail($data['auctions'][$i]->email_buyer);
                 if($bid_list!=NULL){
                    if(date('Y-m-d H:i:s', strtotime($bid_list->time. ' + 5 days'))<date('Y-m-d H:i:s') && $bid_list->is_accepted==0 && $bid_list->is_rejected==0){
                        $this->sellerModel->updateBidStatus($bid_list->bid_id,$data['auctions'][$i]->max_price);
                         $bid_list1 = $this->sellerModel->getBidList($data['auctions'][$i]->max_bid_id,$data['auctions'][$i]->max_price);
                         $data['bid_list'][$i]=$bid_list1;

                    }else{
                        $data['bid_list'][$i]=$bid_list;
                    }
                    if($data['bid_list'][$i]->is_accepted==0 && $data['bid_list'][$i]->is_rejected==0){
                        $data['check']++;
                    }else if($data['bid_list'][$i]->is_accepted==1){
                        $data['check']++;

                    }else if($data['bid_list'][$i]->is_rejected==1){

                    }
                }else{
                    $data['bid_list'][$i]=NULL;
                }
                
              }
            }else{
              $data['auctions'] = null;
            }
            $data['auction_expired']=$data['auction']->is_finished;
          //   $this->view('users/bid',$data);
  
              //Load view
            //   print_r($data);
            //   exit();

              $this->view('sellers/bid_list', $data);
  
        }

        public function aprove_bid($product_id,$bid_id,$email,$price,$name){
            $dat=date('Y-m-d H:i:s');
                //Send email
                $mail = new PHPMailer(true);
                try{
                    $to=$email;
                    $sender='audexlk@gmail.com';
                    $mail_subject='Approve/Reject a auction offer - Audexlk';
                    
                    // $header="From:{$sender}\r\nContent-Type:text/html;";

                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = $sender;
                    $mail->Password = 'bcoxsurnseqiajuf';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->setFrom($sender);
                    $mail->addAddress($to);
                    $mail->isHTML(true);
                    $expiring_timestamp = time() + (24*60*60*5); // Expires in 24*5 hours
                    $activation_link = URLROOT.'/users/approve_reject_bid/'.$product_id.'/'.$bid_id.'/' . $expiring_timestamp;
                    $email_body='<p>Dear '.$name.',<br>Thank you for bidding on Audexlk. Seller has been selected you as the winner of his auction.'; 
                    $email_body.=' You can <b>accept or reject</b> his offer by clicking the fllowing link.<b>Link will be expires in 5 days. After that you cannot approve or reject.</b><br><br>';
                    $email_body.='<b><a href="'.URLROOT.'/users/approve_reject_bid/'.$product_id.'/'.$bid_id.'/' . $expiring_timestamp.'">Click here</a></b><br><br>';
                    $email_body.='Thank you,<br>Audexlk</p>';
                    $mail->Subject = $mail_subject;
                    $mail->Body = $email_body;
                    // if($mail->send()){
                    // $time=CONVERT_TZ(NOW(),'SYSTEM','Asia/Calcutta');

                        // Mail sent 
                        $mail->send();
                        if($this->sellerModel->approve_bid($bid_id,$email,$price,$dat)){
                            flash('email_err','Mail sent successfully');
                            redirect('sellers/bid_list/'.$product_id.'/'.$bid_id);
                        }else {
                            flash('email_err','Something went wrong,retry','alert alert-danger');
                            redirect('sellers/bid_list/'.$product_id.'/'.$bid_id);
                        }
                    
                } catch (Exception $e) {
                    flash('email_err','Mail could not be sent. Error: '. $e->getMessage(),'alert alert-danger');
                    redirect('sellers/bid_list/'.$product_id.'/'.$bid_id);
                }
            
        }
        public function dashboard(){
            // $data['likes_dislikes']=$this->sellerModel->sellerDetailsWithLikeDislikeCount($_SESSION['user_email']);
            $data['no_auctions']=$this->sellerModel->sellerNoAuctions($_SESSION['user_email']);
            $data['no_fixed_ads']=$this->sellerModel->sellerNoFixedAds($_SESSION['user_email']);
            $data['no_views']=$this->sellerModel->sellerNoViews($_SESSION['user_email']);
            $data['feedbackcount']=$this->sellerModel->getFeedbacksCount($_SESSION['user_email']);
            //View count with dates
            $data['view_count']=$this->sellerModel->getViewsCount($_SESSION['user_email']);
            if($data['view_count']==false){
                $data['view_count']=0;
                $data['empty_view_count']=1;

            }else{
                $data['empty_view_count']=0;
            }
            //Likes count with dates
            $data['likes_dates']=$this->sellerModel->sellerDetailsWithLikeCountDates($_SESSION['user_email']);
            if(!$data['likes_dates']){
                $data['likes_dates']=0;
                $data['empty_likes_dates']=1;
                $data['likes_date'] = [];
                $data['likes_counts'] = [];
                $data['startDate']= new DateTime(date('Y-m-d H:i:s'));
                $data['endDate']= clone $data['startDate'];
            }else{
                $data['startDate'] = new DateTime(date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). ' - 1 months')));
                $data['endDate'] = clone $data['startDate'];
                $data['endDate']->modify('+1 months');
                $data['likes_date'] = [];
                $data['empty_likes_dates']=0;
                $data['likes_counts'] = [];
                foreach ($data['likes_dates'] as $item) {
                    $data['likes_date'][] = $item->date;
                    $data['likes_counts'][] = $item->count;
                }
            }
            //Dislikes count with dates
            $data['dislikes_dates']=$this->sellerModel->sellerDetailsWithDislikeCountDates($_SESSION['user_email']);
            if(!$data['dislikes_dates']){
                $data['dislikes_dates']=0;
                $data['empty_dislikes_dates']=1;
                $data['dislikes_date'] = [];
                $data['dislikes_counts'] = [];
                $data['startDate_dislikes']= new DateTime(date('Y-m-d H:i:s'));
                $data['endDate_dislikes']= clone $data['startDate_dislikes'];
            }else{
                $data['startDate_dislikes'] = new DateTime(date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). ' - 1 months')));
                $data['endDate_dislikes'] = clone $data['startDate_dislikes'];
                $data['endDate_dislikes']->modify('+1 months');
                $data['dislikes_date'] = [];
                $data['empty_dislikes_dates']=0;
                $data['dislikes_counts'] = [];
                foreach ($data['dislikes_dates'] as $item) {
                    $data['dislikes_date'][] = $item->date;
                    $data['dislikes_counts'][] = $item->count;
                }
            }

            //Feedbacks count with related to rate
            $data['feedbacks_rate']=$this->sellerModel->getFeedbacksRate($_SESSION['user_email']);
            //Products count
            $data['products_count']=$this->sellerModel->getProductsCount($_SESSION['user_email']);


            $this->view('sellers/dashboard',$data);
        }

        public function rateBuyer(){

            $data = json_decode(file_get_contents('php://input'), true);

            $email_seller = $data['email_seller'];
            $email_buyer = $data['email_buyer'];
            $product_id = $data['product_id'];
            $rating = $data['rating'] ?? 0;
            $review = $data['review'];

            $results2 = '';
            $results3 = '';
            // echo $rating;
            // echo $buyer_id;
            // echo $seller;
            $results1 = $this->sellerModel->checkAddedRate($email_seller, $email_buyer,$product_id);



            $date=date('Y-m-d H:i:s');
            if( empty($results1) ){
                $results2 = $this-> sellerModel->rateBuyer($email_seller, $email_buyer,$product_id, $rating, $review, $date);
            }
            else{
                $results3 = $this->sellerModel->updateBuyerRate($email_seller, $email_buyer,$product_id, $rating, $review, $date);
            }
            $results4 = $this->sellerModel->getRateReceiversFinalRate($email_buyer);
            flash('rating_message', 'Rating added successfully');
            // ,'result1'=>$results1,'result2'=>$results2,'result3'=>$results3
           
            // print_r(['message' => 'Rating saved','results4'=>$results4,'result1'=>$results1,'result2'=>$results2,'result3'=>$results3]);
            // exit();
            echo json_encode(['message' => 'Rating saved','results4'=>$results4,'result1'=>$results1,'result2'=>$results2,'result3'=>$results3]);
            // echo json_encode(['message' => 'Rating saved','result1'=>$results1,'result2'=>$results2,'result3'=>$results3]);


        }




        
        
    }