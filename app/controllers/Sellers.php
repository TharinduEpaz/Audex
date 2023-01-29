<?php


    class Sellers extends Controller{
        private $sellerModel;
        private $userModel;


        public function __construct(){
            if(!isLoggedIn()){
                echo "not logged in seller";
                unset($_SESSION['otp']);
                unset($_SESSION['email']);
                unset($_SESSION['password']);
                unset($_SESSION['first_name']);
                unset($_SESSION['second_name']);
                unset($_SESSION['phone']);
                unset($_SESSION['user_type']);
                unset($_SESSION['attempt']);
                session_destroy();
                redirect('users/login');
            }
            else if($_SESSION['user_type'] != 'seller' && isLoggedIn()){
                redirect($_SESSION['user_type'].'s/index');
            }
            $this->sellerModel=$this->model('Seller');
            $this->userModel = $this->model('User');

        }

        public function index(){

            $this->view('sellers/index');
        }

    public function getProfile($id){ 
      if(!isLoggedIn()){
        redirect('users/login');
      }
      $details = $this->sellerModel->getUserDetails($id);

      if ($details->user_id != $_SESSION['user_id']) {
        redirect('users/login');
      }

      $data =[
        'id' => $id,
        'user' => $details
      ];
      $this->view('sellers/getProfile',$data);
    }

        public function editProfile($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
              $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      
              $data = [
                'id' => $id,
                'first_name' => trim($_POST['first_name']),
                'second_name' => trim($_POST['second_name']),
                'email' => $_SESSION['user_email'],
                'address1' => trim($_POST['address1']),
                'address2' => trim($_POST['address2']),
                'phone_number' => trim($_POST['phone_number']),
                'user_id' => $_SESSION['user_id'],
                'first_name_err' => '',
                'second_name_err' => '',
                'address1_err' => '',
                'address2_err' => '',
                'phone_number_err' => ''
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
              if(empty($data['phone_number'])){
                $data['phone_number_err'] = 'Please Enter Phone Number';
              }
      
      
              if( empty($data['first_name_err']) && empty($data['second_name_err']) && empty($data['address1_err']) && empty($data['address1_err'] && empty($data['phone_number_err'])) ){
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
                redirect('users/login');
              }
      
              if($this->sellerModel->deleteUserProfile($id)){
                redirect('users/login');
              }
              else{
                die('Something went wrong');
              }
            }
            else{
              redirect('seller/index');
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
            $auction = $this->userModel->getAuctionById($id);
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
                    'brand' => trim($_POST['brand']),
                    'model' => trim($_POST['model']),
                    'type'=> 'fixed_price',
                    'end_date'=>'',
                    'category' =>trim($_POST['category']),
                    'title_err' => '',
                    'description_err' => '',
                    'price_err' => '',
                    'condition_err' => '',
                    'image1_err' => '',
                    'image2_err' => '',
                    'image3_err' => '',
                    'brand_err' => '',
                    'model_err' => '',
                    'category_err' => '',
                    'date_err'=>''
                ];
                if(isset($_POST['check_au'])){
                    $data['type']='auction';
                    $num_of_dates=trim($_POST['date']);
                    $data['end_date']=strtotime("+".$num_of_dates." Days");
                    $data['end_date']=date('Y-m-d  h:i:sa',$data['end_date']);
                }

                $user_id=$this->userModel->getUserId($data['user_email']);
                $data['user_id']=$user_id->user_id;

                //Validate data
                if(empty($data['title'])){
                    $data['title_err'] = 'Please enter title';
                }
                if(empty($data['description'])){
                    $data['description_err'] = 'Please enter description';
                }
                if(empty($data['price'])){
                    $data['price_err'] = 'Please enter price';
                }
                if($data['price']<=0){
                    $data['price_err'] = 'Please enter valid price';
                }
                if(empty($data['category'])){
                    $data['category_err'] = 'Please enter category';
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

                                // //Insert into database
                                // if($this->sellerModel->addAdvertisement($data)){
                                //     flash('post_message', 'Advertisement Added');
                                //     redirect('sellers/advertisements');
                                // }
                                // else{
                                //     die('Something went wrong');
                                // }
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

                                // //Insert into database
                                // if($this->sellerModel->addAdvertisement($data)){
                                //     flash('post_message', 'Advertisement Added');
                                //     redirect('sellers/advertisements');
                                // }
                                // else{
                                //     die('Something went wrong');
                                // }
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
                // else{
                //     $data['image2_err'] = 'Please second first image';
                // }


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

                                // //Insert into database
                                // if($this->sellerModel->addAdvertisement($data)){
                                //     flash('post_message', 'Advertisement Added');
                                //     redirect('sellers/advertisements');
                                // }
                                // else{
                                //     die('Something went wrong');
                                // }
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
                // else{
                //     $data['image3_err'] = 'Please upload third image';
                // }
                //Make sure no errors
                if(empty($data['title_err']) && empty($data['description_err']) && empty($data['price_err'])  && empty($data['condition_err']) && empty($data['image1_err']) && empty($data['image2_err']) && empty($data['image3_err']) && empty($data['brand_err']) && empty($data['model_err'])){
                    //Validated
                    
                    // if(!empty($_FILES['image3']['name'])){
                    //     //Get file info
                    //     $image3_filename=basename($_FILES['image3']['name']);
                    //     $image3_filetype=pathinfo($image3_filename,PATHINFO_EXTENSION);

                    //     if(in_array($image3_filetype,$allowedTypes)){
                    //         $image3=$_FILES['image3']['tmp_name'];
                    //         $image3_content=addslashes(file_get_contents($image3));
                    //         $data['image3']=$image3_content;
                    //     }
                    //     else{
                    //         $data['image3_err']="Sorry, only JPG, JPEG, PNG, & GIF files are allowed.";
                    //     }
                    // }
                    if($this->sellerModel->advertise($data)){
                        flash('product_message', 'Product Added');
                        redirect('sellers/advertisements');
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
                    'brand' => trim($_POST['brand']),
                    'model' => trim($_POST['model']),
                    'category' =>trim($_POST['category']),
                    'title_err' => '',
                    'description_err' => '',
                    'price_err' => '',
                    'condition_err' => '',
                    'image1_err' => '',
                    'image2_err' => '',
                    'image3_err' => '',
                    'brand_err' => '',
                    'model_err' => '',
                    'category_err' => ''
                ];

                //Validate data
                if(empty($data['title'])){
                    $data['title_err'] = 'Please enter title';
                }
                if(empty($data['description'])){
                    $data['description_err'] = 'Please enter description';
                }
                if(empty($data['price'])){
                    $data['price_err'] = 'Please enter price';
                }
                if(empty($data['category'])){
                    $data['category_err'] = 'Please enter category';
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
                // if(isset($_FILES['image1'])){
                //     $img_name = $_FILES['image1']['name'];
                //     $img_size = $_FILES['image1']['size'];
                //     $tmp_name = $_FILES['image1']['tmp_name'];
                //     $error = $_FILES['image1']['error'];

                //     if($error === 0){
                //         if($img_size > 12500000){
                //             $data['image1_err'] = "Sorry, your file is too large.";
                //         }
                //         else{
                //             $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); //Extension type of image(jpg,png)
                //             $img_ex_lc = strtolower($img_ex);

                //             $allowed_exs = array("jpg", "jpeg", "png"); 

                //             if(in_array($img_ex_lc, $allowed_exs)){
                //                 $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                //                 $img_upload_path = dirname(APPROOT).'/public/uploads/'.$new_img_name;
                //                 move_uploaded_file($tmp_name, $img_upload_path);
                //                 $data['image1'] = $new_img_name;

                //                 // //Insert into database
                //                 // if($this->sellerModel->addAdvertisement($data)){
                //                 //     flash('post_message', 'Advertisement Added');
                //                 //     redirect('sellers/advertisements');
                //                 // }
                //                 // else{
                //                 //     die('Something went wrong');
                //                 // }
                //             }
                //             else{
                //                 $data['image1_err'] = "You can't upload files of this type";
                //             }
                //         }
                //     }
                //     else{
                //         $data['image1_err'] = "Unknown error occurred!";
                //     }
                // }else{
                //     $data['image1_err'] = 'Please upload atleast one image';
                // }


                //Make sure no errors
                if(empty($data['title_err']) && empty($data['description_err']) && empty($data['price_err'])  && empty($data['condition_err']) && empty($data['image1_err']) && empty($data['image2_err']) && empty($data['image3_err']) && empty($data['brand_err']) && empty($data['model_err'])){
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
                    'brand' => $advertisement->brand,
                    'model' => $advertisement->model_no,
                    'category' =>$advertisement->product_category,
                    'product_type'=>$advertisement->product_type,
                    'title_err' => '',
                    'description_err' => '',
                    'price_err' => '',
                    'condition_err' => '',
                    'image1_err' => '',
                    'image2_err' => '',
                    'image3_err' => '',
                    'brand_err' => '',
                    'model_err' => '',
                    'category_err' => ''
                ];
                

                $this->view('sellers/edit_advertisement', $data);
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
            $ad = $this->userModel->getAdvertiesmentById($id);
            $data['ad'] = $ad;
  
            $auction = $this->userModel->getAuctionById($id);
            $data['auction'] = $auction;
            
            $auction_details = $this -> userModel->getAuctionDetails($id);
            if($auction_details){
              $data['auctions'] =$auction_details;
            }else{
              $data['auctions'] = null;
            }
            $data['auction_expired']=$data['auction']->is_finished;
          //   $this->view('users/bid',$data);
  
              //Load view
              $this->view('sellers/bid_list', $data);
  
          }
        
    }