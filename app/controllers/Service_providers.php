<?php

require_once dirname(APPROOT) . '/app/vendor/samayo/bulletproof/src/bulletproof.php'; //bulletproof library for file upload


class Service_providers extends Controller
{

    private $service_model;

    public function __construct()
    {
        if (isset($_SESSION['attempt'])) {
            unset($_SESSION['otp_email']);
            unset($_SESSION['phone']);
            unset($_SESSION['attempt']);
            unset($_SESSION['time']);
        }
        if (!isLoggedIn()) {
            session_destroy();
            redirect('users/login');
        }
        if ($_SESSION['user_type'] != 'service_provider') {
            redirect($_SESSION['user_type'] . 's/index');
        }


        //Session timeout
        if (isset($_SESSION['session_time'])) {
            if (time() - $_SESSION['session_time'] > 60 * 30) {
                // flash('session_expired', 'Your session has expired', 'alert alert-danger');
                redirect('users/logout');
            } else {
                $_SESSION['session_time'] = time();
            }
        }

        $this->service_model = $this->model('Service_provider');
    }

    public function index()
    {

        $this->view('service_providers/index');
    }

    public function profile()
    {

        $details = $this->service_model->getDetails($_SESSION['user_id']);
        $events = $this->service_model->getEvents($_SESSION['user_id']);
        $posts = $this->service_model->getPostsByUser($_SESSION['user_id']);
        

        $data = [
            'details' => $details,
            'events' => $events,
            'posts' => $posts,
            
        ];

        $this->view('service_providers/profile', $data);
    }
    public function setImage($temp_name, $file_name, $file_size, $file_error)
    {


        // Work out the file extension
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));


        $allowed = array('jpg', 'jpeg', 'png', 'gif');

        // check for errors
        if ($file_error === 0) {
            if (in_array($file_ext, $allowed)) {
                if ($file_size <= 2097152) {

                    // $file_name_new = $_SESSION['user_id']. 'profile' . '.'  . $file_ext;

                    $file_destination = dirname(APPROOT) . '/public/uploads/profile/' . $file_name;

                    // move_uploaded_file() is the built-in function in PHP that is used to move an uploaded file from its temporary location to a new location on the server

                    if (move_uploaded_file($temp_name, $file_destination)) {

                        $this->service_model->setImage($file_name, $_SESSION['user_id']);
                        return;
                    } else {
                        echo 'error in  uploading';
                    }
                } else {

                    echo 'error large size';
                }
            } else {
                echo 'error not allowed this type';
            }
        }
    }
    public function settings($errors = [])
    {
        $details = $this->service_model->getDetails($_SESSION['user_id']);

        $data = [
            'details' => $details,
            'errors' => $errors
        ];
        $data1 = [
            'title' => $details->first_name . ' ' . $details->second_name 
        ];
        $this->view('service_providers/settings', $data,$data1);
    }

    public function setDetails()
    {

        $details = $this->service_model->getDetails($_SESSION['user_id']);
        $data = [
            'details' => $details
        ];
        $flag = 0;


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['profession']) && $_POST['profession'] != '') {
                $flag = 1;
                $profession = $_POST['profession'];
            } else {
                $profession = $data['details']->profession;
            }

            if (isset($_POST['qualifications']) && $_POST['qualifications'] != '') {
                $flag = 1;
                $qualifications = $_POST['qualifications'];
            } else {
                $qualifications = $data['details']->qualifications;
            }
            if (isset($_POST['achievements']) && $_POST['achievements'] != '') {
                $flag = 1;
                $achievements = $_POST['achievements'];
            } else {
                $achievements = $data['details']->achievements;
            }
            if (isset($_POST['description']) && $_POST['description'] != '') {
                $flag = 1;
                $description = $_POST['description'];
            } else {
                $description = $data['details']->description;
            }
            if (isset($_POST['first_name']) && $_POST['first_name'] != '') {
                $flag = 1;
                $first_name = $_POST['first_name'];
            } else {
                $first_name = $data['details']->first_name;
            }
            if (isset($_POST['second_name']) && $_POST['second_name'] != '') {
                $flag = 1;
                $second_name = $_POST['second_name'];
            } else {
                $second_name = $data['details']->second_name;
            }
            if (isset($_POST['address1']) && $_POST['address1'] != '') {
                $flag = 1;
                $address1 = $_POST['address1'];
            } else {
                $address1 = $data['details']->address_line_one;
            }
            if (isset($_POST['address2']) && $_POST['address2'] != '') {
                $flag = 1;
                $address2 = $_POST['address2'];
            } else {
                $address2 = $data['details']->address_line_two;
            }
           

            if (!empty($_FILES['profile']['name'])) {

                $flag = 1;
                $temp_name = $_FILES['profile']['tmp_name'];
                $file_name = $_FILES['profile']['name'];
                $file_size = $_FILES['profile']['size'];
                $file_error = $_FILES['profile']['error'];

                
            }
        }

        // $details = array($profession, $qualifications, $achievements, $description, $first_name, $second_name, $address1, $address2);

        $details = [
            'profession' => $profession,
            'qualifications' => $qualifications,
            'achievements' => $achievements,
            'description' => $description,
            'first_name' => $first_name,
            'second_name' => $second_name,
            'address1' => $address1,
            'address2' => $address2,
            
        ];

        if (empty($this->validateProfileDetails($details,$flag))) {
            $this->setImage($temp_name, $file_name, $file_size, $file_error);
            $this->service_model->setDetails($details, $_SESSION['user_id']);

        } else {
            $errors = $this->validateProfileDetails($details,$flag);
            $this->settings($errors);
        }

        redirect('service_providers/profile/');
    }

    public function validateProfileDetails($details,$flag)
    {
        
        $errors = array();
       

       
        if(!$flag){
        array_push($errors, 'fill at least one field before submitting the form');
        }


        $details = array_map('trim', $details);
        $details = array_map('stripslashes', $details);
        $details = array_map('htmlspecialchars', $details);

        if (!preg_match("/^[a-zA-Z-' ]*$/", $details['first_name'])) {
            $nameErr = " First Name : Only letters and white space allowed";
            array_push($errors, $nameErr);
        }

        if (!preg_match("/^[a-zA-Z-' ]*$/", $details['second_name'])) {
            $nameErr = "Second Name : Only letters and white space allowed";
            array_push($errors, $nameErr);
        }

        // if(isset($FILES['profile']['name'])){
        $file_size = $_FILES['profile']['size'];
            if ($file_size > 2097152) {
                $sizeERR = 'File size must not be larger than 2 MB';
                array_push($errors, $sizeERR);
            }

        // }


        return $errors;
    }

    public function addEvent()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Validate form data
            
            $date_str = $_GET['date'];

            $details = [
            'name' => $_POST['eventname'],
            'date_str' => $_GET['date'],
            'date' => date("Y-m-d", strtotime($date_str)),
            'location' => $_POST['location'],
            'link' => $_POST['ticket-link'],
            'description' => $_POST['description'],
            'public' => $_POST['event-type'],
            'time' => $_POST['time']
            ];

            $details = array_map('trim', $details);
            $details = array_map('stripslashes', $details);
            $details = array_map('htmlspecialchars', $details);
    
            //uploading the image

            $image = new Bulletproof\Image($_FILES);
            $image->setSize(10, 10485760);
            $image->setDimension(10000, 10000);

            if($image["event-img"]){
                $image->setName(substr(base64_encode(random_bytes(12)), 0, 20)); //length 20 random name);
              $upload = $image->upload(); 
            
              if($upload){
                $img = $image->getName() . '.' . $image->getMime();
              }else{
                echo $image->getError(); 
              }
            }

            $event_details = array(
                $details['name'],
                $details['date'],
                $details['public'],
                $details['location'],
                $details['link'],
                $details['description'],
                $img,
                $details['time']
            );

    
            // SEND THE DATA INTO THE DATABASE USING THE MODEL

            // $event_details = array($name, $date, $public, $location, $link, $description, $img, $time);

            try {
                $this->service_model->setEvent($event_details, $_SESSION['user_id']);
            } catch (PDOException $e) {
                echo "ERROR : " . $e->getMessage();
            }
        }
    }


    public function validateEvent(){
        
    }

    public function dashboard()
    {   
        $details = $this->service_model->getDetails($_SESSION['user_id']);
        $post_count = $this->service_model->getPostCount($_SESSION['user_id']);
        $event_count = $this->service_model->getEventCountforCurrentMonth($_SESSION['user_id']);
        $likes = $this->service_model->getTotalEventLikes($_SESSION['user_id']);

        $profile_completion = 0;

        if(!$details->profile_image == ''){
            $profile_completion = $profile_completion + 20;
        }
        if(!$details->profession == ''){
            $profile_completion = $profile_completion + 10;
        }
        if(!$details->qualifications == ''){
            $profile_completion = $profile_completion + 10;
        }
        if(!$details->achievements == ''){
            $profile_completion = $profile_completion + 10;
        }
        if(!$details->description == ''){
            $profile_completion = $profile_completion + 10;
        }
        if($details->is_paid == 1){
            $profile_completion = $profile_completion + 20;
        }
        if($details->admin_approved == 1){
            $profile_completion = $profile_completion + 20;
        }

        $data = [
            'post_count' => $post_count,
            'event_count' => $event_count,
            'profile_completion' => $profile_completion,
            'likes' => $likes
        ];
        

        
        $this->view('service_providers/dashboard', $data);
    }

    public function eventCalander()
    {
        if (isset($_GET['month'])) {
            $month = $_GET['month'];
        } else {
            $month = 'current';
        }


        if ($month == 'current') {
            $_SESSION['current'] = date('m');
            $_SESSION['current_y'] = date('y');
        } else if ($month == 'next' && $_SESSION['current'] < 12) {
            $_SESSION['current'] = $_SESSION['current'] + 1;
        } else if ($month == 'next' && $_SESSION['current'] >= 12) {
            $_SESSION['current_y'] = $_SESSION['current_y'] + 1;
            $_SESSION['current'] = 01;
        } else if ($month == 'previous' && $_SESSION['current'] > 1) {
            $_SESSION['current'] = $_SESSION['current'] - 1;
        } else if ($month == 'previous' && $_SESSION['current'] <= 1) {
            $_SESSION['current_y'] = $_SESSION['current_y'] - 1;
            $_SESSION['current'] = 12;
        }

        // Update the displayed month name based on the new value of $current
        $year = $_SESSION['current_y'];
        $monthName = date('F', mktime(0, 0, 0, $_SESSION['current'], 1));

        $events = $this->service_model->getEventsByMonth($_SESSION['user_id'], $_SESSION['current']);
        $is_paid = $this->service_model->is_paid($_SESSION['user_id']);

        $data = [
            'events' => $events,
            'month' => $monthName,
            'year' => $year,
            'month_no' => $_SESSION['current'],
            'year_no' => $_SESSION['current_y'],
            'is_paid' => $is_paid
        ];

        $this->view('service_providers/eventCalander', $data);
    }

    public function messages()
    {
        $this->view('service_providers/chat');
    }

    public function getEvent()
    {
        $id = $_GET['id'];
        $event = $this->service_model->getEventById($id);
        $name = $this->service_model->getEventOwner($id);
        $data = [
            'event' => $event,
            'name' => $name
        ];
        echo json_encode($data);
        return json_encode($data);
    }

    public function editEvent()
    {
        $id = $_GET['id'];
        $event = $this->service_model->getEventById($id);
        $data = [
            'event' => $event,
            'id' => $id

        ];
   
        $this->view('service_providers/editEvent', $data);
    }

    public function editEventDetails()
    {

        $id = $_GET['id'];
        $event_name = isset($_POST['eventname']) ? $_POST['eventname'] : '';
        $location = isset($_POST['location']) ? $_POST['location'] : '';
        $time = isset($_POST['time']) ? $_POST['time'] : '';
        $link = isset($_POST['ticket-link']) ? $_POST['ticket-link'] : '';
        $event_type = $_POST['event-type'];
        $description = isset($_POST['description']) ? $_POST['description'] : '';

        //image
        if (isset($_FILES['event-img'])) {
            $temp_name = $_FILES['event-img']['tmp_name'];
            $file_name = $_FILES['event-img']['name'];
            $file_size = $_FILES['event-img']['size'];
            $file_error = $_FILES['event-img']['error'];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            $allowed = array('jpg', 'jpeg', 'png', 'gif');
            $img = '';

            // check for errors
            if ($file_error === 0) {
                if (in_array($file_ext, $allowed)) {
                    if ($file_size <= 2097152) {

                        // $file_name_new = $_SESSION['user_id']. 'profile' . '.'  . $file_ext;

                        $file_destination = dirname(APPROOT) . '/public/uploads/events/' . $file_name;

                        // move_uploaded_file() is the built-in function in PHP that is used to move an uploaded file from its temporary location to a new location on the server

                        if (move_uploaded_file($temp_name, $file_destination)) {
                            $img = $file_name;
                        } else {

                            echo 'error in  uploading';
                        }
                    } else {
                        echo 'error large size';
                    }
                } else {
                    echo 'error not allowed this type';
                }
            }
        } else {
            $file_name = '';
        }
        // Work out the file extension


        $this->service_model->updateEvent($id, $event_name, $location, $time, $link, $event_type, $description, $img);
        redirect('service_providers/profile');
    }


    public function deleteEvent(){
        $id = $_GET['id'];
        $this->service_model->deleteEvent($id);

        redirect('service_providers/profile');
    }

    public function likeDislike()
    {
        $id = $_GET['id'];
        $type = $_GET['type'];
        $this->service_model->likeDislike($id, $type);
        $reactions = $this->service_model->getReactions($id);
        $data = [
            'reactions' => $reactions,
        ];
        echo json_encode($data);
        return json_encode($data);
    }


    public function feed()
    {
        $posts = $this->service_model->getPostsByUser($_SESSION['user_id']);
        $is_paid = $this->service_model->is_paid($_SESSION['user_id']);

        if (!$is_paid->is_paid) {
            $data = [
                'posts' => 0
            ];
        } else {
            $data = [
                'posts' => $posts
            ];
        }

        $this->view('service_providers/feed', $data);
    }

    public function feedPost()
    {
        $id = $_GET['id'];
        $post = $this->service_model->getPostById($id);
        $data = [
            'post' => $post,


        ];
        $this->view('service_providers/post', $data);
    }

    public function addNewPost($errors = [])
    {
      
        $is_paid = $this->service_model->is_paid($_SESSION['user_id']);

        if (!$is_paid->is_paid) {
            $data = [
                'posts' => 0
            ];
        } else {
            $data = [
                'posts' => 1
            ];
        }
        $this->view('service_providers/addNewPost', $data);
    }

    public function insertPost()
    {
        $user_id = $_SESSION['user_id'];
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $content = isset($_POST['add-post']) ? $_POST['add-post'] : '';

        $image1 = '';
        $image2 = '';
        $image3 = '';

        $title = htmlspecialchars($title);
        $content = htmlspecialchars($content);
        

        $errors = array();
            
        

       

        if (isset($_POST['submit'])) {

            $temp_name = $_FILES['post-photo-1']['tmp_name'];
            $file_name = $_FILES['post-photo-1']['name'];
            $file_size = $_FILES['post-photo-1']['size'];
            $file_error = $_FILES['post-photo-1']['error'];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));


            $allowed = array('jpg', 'jpeg', 'png', 'gif');

            // check for errors
            if ($file_error === 0) {
                if (in_array($file_ext, $allowed)) {
                    if ($file_size <= 2097152) {

                        // $file_name_new = $_SESSION['user_id']. 'profile' . '.'  . $file_ext;

                        $file_destination = dirname(APPROOT) . '/public/uploads/feed/' . basename($_FILES['post-photo-1']['name']);

                        // move_uploaded_file() is the built-in function in PHP that is used to move an uploaded file from its temporary location to a new location on the server

                        if (move_uploaded_file($temp_name, $file_destination)) {
                            $image1 = basename($_FILES['post-photo-1']['name']);
                            
                        } else {
                            
                                
                            array_push($errors, "error in  uploading");
                        }
                    } else {


                        array_push($errors, "error large size");
                    }
                } else {

                    array_push($errors, "error not allowed this type");
                }

            }
            array_push($errors, "unknown error occured please try later");

        }

        if (isset($_POST['submit'])) {

            $temp_name = $_FILES['post-photo-2']['tmp_name'];
            $file_name = $_FILES['post-photo-2']['name'];
            $file_size = $_FILES['post-photo-2']['size'];
            $file_error = $_FILES['post-photo-2']['error'];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));


            $allowed = array('jpg', 'jpeg', 'png', 'gif');

            // check for errors
            if ($file_error === 0) {
                if (in_array($file_ext, $allowed)) {
                    if ($file_size <= 5242880) {

                        // $file_name_new = $_SESSION['user_id']. 'profile' . '.'  . $file_ext;

                        $file_destination = dirname(APPROOT) . '/public/uploads/feed/' . basename($_FILES['post-photo-2']['name']);

                        // move_uploaded_file() is the built-in function in PHP that is used to move an uploaded file from its temporary location to a new location on the server

                        if (move_uploaded_file($temp_name, $file_destination)) {
                            $image2 = basename($_FILES['post-photo-2']['name']);
                            
                        } else {
                                
                                    
                            array_push($errors, "error in  uploading");

                        }
                    } else {


                        array_push($errors, "error large size");
                    }
                } else {

                    array_push($errors, "error not allowed this type");
                }

            }
            array_push($errors, "unknown error occured please try later");

        }

        if (isset($_POST['submit'])) {

            $temp_name = $_FILES['post-photo-3']['tmp_name'];
            $file_name = $_FILES['post-photo-3']['name'];
            $file_size = $_FILES['post-photo-3']['size'];
            $file_error = $_FILES['post-photo-3']['error'];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));


            $allowed = array('jpg', 'jpeg', 'png', 'gif');

            // check for errors
            if ($file_error === 0) {
                if (in_array($file_ext, $allowed)) {
                    if ($file_size <= 5242880) {

                        // $file_name_new = $_SESSION['user_id']. 'profile' . '.'  . $file_ext;
                        //create a unique name for the image before saving it to the database

                        $file_destination = dirname(APPROOT) . '/public/uploads/feed/' . basename($_FILES['post-photo-3']['name']);

                        // move_uploaded_file() is the built-in function in PHP that is used to move an uploaded file from its temporary location to a new location on the server

                        if (move_uploaded_file($temp_name, $file_destination)) {
                            $image3 = basename($_FILES['post-photo-3']['name']);
                            
                        } else {
                                    
                                        
                                array_push($errors, "error in  uploading");

                        }
                    } else {


                        array_push($errors, "error large size");
                    }
                } else {

                    array_push($errors, "error not allowed this type");
                }

            }
            array_push($errors, "unknown error occured please try later");
        }

        $this->service_model->insertPost($user_id, $title, $content, $image1, $image2, $image3);


        redirect('service_providers/feed');

    }

    public function uploadImage($image)
    {
        $text = $image;
        $image = new Bulletproof\Image($_FILES);
        $image->setSize(10, 10485760);
        $image->setDimension(10000, 10000);

        if ($image["$text"]) {

            $image->setName(substr(base64_encode(random_bytes(12)), 0, 20)); //length 20 random name);

            $upload = $image->upload();
            $image->setMime(array('pdf'));

            if ($upload) {
                return $image->getName() . '.' . $image->getMime();;
            } else {

                echo $image->getError();
                return;
            }
        }
    }

    public function deletePost()
    {
        $id = $_GET['id'];
        $this->service_model->deletePost($id);
        redirect('service_providers/feed');
    }
    public function adminApprove()
    {
        $id = $_SESSION['user_id'];

        // $approval = $this->service_model->getApprovalDetails($_SESSION['user_id']);
        // if (!empty($approval)) {
        //     $data = [
        //         'approval' => $approval
        //     ];
        // } else {
        //     $data = 0;
        // }



        if (isset($_POST['submit'])) {

            $temp_name = $_FILES['approve']['tmp_name'];
            $file_name = $_FILES['approve']['name'];
            $file_size = $_FILES['approve']['size'];
            $file_error = $_FILES['approve']['error'];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));


            $allowed = array('pdf');

            // check for errors
            if ($file_error === 0) {
                if (in_array($file_ext, $allowed)) {
                    if ($file_size <= 5242880) {

                        // $file_name_new = $_SESSION['user_id']. 'profile' . '.'  . $file_ext;

                        $file_destination = dirname(APPROOT) . '/public/uploads/approve/' . basename($_FILES['approve']['name']);

                        // move_uploaded_file() is the built-in function in PHP that is used to move an uploaded file from its temporary location to a new location on the server

                        if (move_uploaded_file($temp_name, $file_destination)) {
                            $this->service_model->adminApprove($_SESSION['user_id'],$file_name);
                            
                        } else {
                            echo 'error in  uploading';

                        }
                    } else {


                        echo 'error large size';
                    }
                } else {

                    echo 'error not allowed this type';
                }

            }
        }
        $this->profile();
    }

    



}
