<?php

use function PHPSTORM_META\type;

    class Sellers extends Controller{

        public function __construct(){
            if(!isLoggedIn()){
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

            $this->sellerModel=$this->model('Seller');
        }

        public function index(){

            $this->view('sellers/index');
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
                if(empty($data['brand'])){
                    $data['brand_err'] = 'Please enter brand';
                }
                if(empty($data['model'])){
                    $data['model_err'] = 'Please enter model';
                }


                //Make sure no errors
                if(empty($data['title_err']) && empty($data['description_err']) && empty($data['price_err'])  && empty($data['condition_err']) && empty($data['image1_err']) && empty($data['brand_err']) && empty($data['model_err'])){
                    //Validated
                    //Allowed file types
                    $allowedTypes=array('jpg','png','jpeg','gif');
                    if(!empty($_FILES['image1']['name'])){
                        //Get file info
                        $image1_filename=basename($_FILES['image1']['name']);
                        $image1_filetype=pathinfo($image1_filename,PATHINFO_EXTENSION);

                        if(in_array($image1_filetype,$allowedTypes)){
                            $image1=$_FILES['image1']['tmp_name'];
                            $image1_content=addslashes(file_get_contents($image1));
                            $data['image1']=$image1_content;
                        }
                        else{
                            $data['image1_err']="Sorry, only JPG, JPEG, PNG, & GIF files are allowed.";
                        }
                    }
                    else{
                        $data['image1_err'] = 'Please upload atleast one image';

                    }
                    if(!empty($_FILES['image2']['name'])){
                        //Get file info
                        $image2_filename=basename($_FILES['image2']['name']);
                        $image2_filetype=pathinfo($image2_filename,PATHINFO_EXTENSION);

                        if(in_array($image2_filetype,$allowedTypes)){
                            $image2=$_FILES['image2']['tmp_name'];
                            $image2_content=addslashes(file_get_contents($image2));
                            $data['image2']=$image2_content;
                        }
                        else{
                            $data['image2_err']="Sorry, only JPG, JPEG, PNG, & GIF files are allowed.";
                        }
                    }
                    if(!empty($_FILES['image3']['name'])){
                        //Get file info
                        $image3_filename=basename($_FILES['image3']['name']);
                        $image3_filetype=pathinfo($image3_filename,PATHINFO_EXTENSION);

                        if(in_array($image3_filetype,$allowedTypes)){
                            $image3=$_FILES['image3']['tmp_name'];
                            $image3_content=addslashes(file_get_contents($image3));
                            $data['image3']=$image3_content;
                        }
                        else{
                            $data['image3_err']="Sorry, only JPG, JPEG, PNG, & GIF files are allowed.";
                        }
                    }
                   
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
                    'user_email' => '',
                    'title' => '',
                    'description' => '',
                    'price' => '',
                    'condition' => '',
                    'image1' => '',
                    'image2' => '',
                    'image3' => '',
                    'brand' => '',
                    'model' => '',
                    'category' =>'',
                    'type'=>'',
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
                    // 'image1' => trim($_POST['image1']),
                    // 'image2' => trim($_POST['image2']),
                    // 'image3' => trim($_POST['image3']),
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
                    // 'image1' => $advertisement->image1,
                    // 'image2' => $advertisement->image2,
                    // 'image3' => $advertisement->image3,
                    'brand' => $advertisement->brand,
                    'model' => $advertisement->model_no,
                    'category' =>$advertisement->product_category,
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
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
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
            } else {
                redirect('sellers/advertisements');
            }
        }
        
    }