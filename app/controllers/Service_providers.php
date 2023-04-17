<?php

class Service_providers extends Controller
{

    private $service_model;

    public function __construct()
    {
        if(isset($_SESSION['attempt'])){
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

        $data = [
            'details' => $details,
            'events' => $events
        ];

        $this->view('service_providers/profile', $data);

    }
    public function settings()
    {
        $details = $this->service_model->getDetails($_SESSION['user_id']);

        $data = [
            'details' => $details
        ];
        $this->view('service_providers/settings', $data);
    }

    public function setDetails()
    {

        $details = $this->service_model->getDetails($_SESSION['user_id']);
        $data = [
            'details' => $details
        ];


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['profession']) && $_POST['profession'] != '') {

                $profession = $_POST['profession'];

            } else {
                $profession = $data['details']->profession;
            }

            if (isset($_POST['qualifications']) && $_POST['qualifications'] != '') {

                $qualifications = $_POST['qualifications'];

            } else {
                $qualifications = $data['details']->qualifications;
            }
            if (isset($_POST['achievements']) && $_POST['achievements'] != '') {

                $achievements = $_POST['achievements'];

            } else {
                $achievements = $data['details']->achievements;
            }
            if (isset($_POST['description']) && $_POST['description'] != '') {

                $description = $_POST['description'];

            } else {
                $description = $data['details']->description;
            }
            if (isset($_POST['first_name']) && $_POST['first_name'] != '') {

                $first_name = $_POST['first_name'];

            } else {
                $first_name = $data['details']->first_name;
            }
            if (isset($_POST['second_name']) && $_POST['second_name'] != '') {

                $second_name = $_POST['second_name'];

            } else {
                $second_name = $data['details']->second_name;
            }
            if (isset($_POST['address1']) && $_POST['address1'] != '') {

                $address1 = $_POST['address1'];

            } else {
                $address1 = $data['details']->address_line_one;
            }
            if (isset($_POST['address2']) && $_POST['address2'] != '') {

                $address2 = $_POST['address2'];

            } else {
                $address2 = $data['details']->address_line_two;
            }
        }

        $details = array($profession, $qualifications, $achievements, $description, $first_name, $second_name, $address1, $address2);

        $this->service_model->setDetails($details, $_SESSION['user_id']);

        redirect('service_providers/profile/');
    }

    public function setImage(){
        
        // File Properties
        
        $temp_name = $_FILES['profile']['tmp_name'];
        $file_name = $_FILES['profile']['name'];
        $file_size = $_FILES['profile']['size'];
        $file_error = $_FILES['profile']['error'];


        // Work out the file extension
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));


        $allowed = array('jpg', 'jpeg', 'png', 'gif');

        // check for errors
        if ($file_error === 0) {
            if (in_array($file_ext, $allowed)) {
                if ($file_size <= 2097152) {
                    
                    // $file_name_new = $_SESSION['user_id']. 'profile' . '.'  . $file_ext;

                    $file_destination = dirname(APPROOT).'/public/uploads/profile/'.$file_name;
                    echo $temp_name . '<br>';
                    echo $file_destination . '<br>';
                    
                    // move_uploaded_file() is the built-in function in PHP that is used to move an uploaded file from its temporary location to a new location on the server
                    
                    if (move_uploaded_file($temp_name, $file_destination)) {

                        $this->service_model->setImage($file_name, $_SESSION['user_id']);

                    }
                    else{
                        echo 'error in  uploading';
                    }
                }
                else{
                    echo 'error large size';
                }
            }
            else{
                echo 'error not allowed this type';
            }
        }
        redirect('service_providers/profile/');
    }

    public function feed()
    {

        $this->view('service_providers/feed');

    }

    public function addEvent()
    {
        $errors = [];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate form data
            $name = $_POST['eventname'];

            //getting the date for the event
            
            // $day = $_GET['date'];
            // $year = $_GET['year'];
            // $date_str = $day . ' ' . $year;
            $date_str = $_GET['date'];
            $date = date("Y-m-d", strtotime($date_str));
            
            
            $location = $_POST['location'];
            $link = $_POST['ticket-link'];
            $description = $_POST['description'];
            $public = 1;
        
            if (empty($name)) {
                $errors[] = 'Name is required';
            } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $errors[] = 'Only letters and white space allowed in name field';
            }

            $event_details = array($name, $date, $public, $location, $link, $description);

            try {
                $this->service_model->setEvent($event_details, $_SESSION['user_id']);
               
            } catch(PDOException $e) {
                echo "ERROR : " . $e->getMessage();
            }
            
    }
}


   


        ////////////////////////////////////////////////////

        // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //     if (isset($_POST['name']) && $_POST['name'] != '') {
        //         $name = $_POST['name'];
        //     }

        //     if (isset($_POST['date']) && $_POST['date'] != '') {
        //         $date = $_POST['date'];
        //     }
        //     if (isset($_POST['public']) && $_POST['public'] != '') {
        //         $public_event = $_POST['public_event'];
        //     }

        //     if (isset($_POST['location']) && $_POST['location'] != '') {
        //         $location = $_POST['location'];
        //     }

        //     if (isset($_POST['link']) && $_POST['link'] != '') {
        //         $link = $_POST['link'];
        //     }

        //     if (isset($_POST['description']) && $_POST['description'] != '') {
        //         $description = $_POST['description'];
        //     }

        //     $event_details = array($name, $date, $public_event, $location, $link, $description);


        //     $this->service_model->setEvent($event_details, $_SESSION['user_id']);

        // }

    

    public function dashboard()
    {
        $this->view('service_providers/dashboard');
    }

    public function eventCalander(){

        $month = $_GET['month'];

        if ($month == 'current') {
            $_SESSION['current'] = date('m');
            $_SESSION['current_y'] = date('y');
        }
        else if ($month == 'next' && $_SESSION['current'] < 12 ) {
            $_SESSION['current'] = $_SESSION['current'] + 1;
           
        }

        else if($month == 'next' && $_SESSION['current'] >= 12){
            $_SESSION['current_y'] = $_SESSION['current_y'] + 1;
            $_SESSION['current'] = 01;
        }

        else if ($month == 'previous' && $_SESSION['current'] > 1) {
            $_SESSION['current'] = $_SESSION['current'] - 1;
        }
    
        else if ($month == 'previous' && $_SESSION['current'] <= 1){
                $_SESSION['current_y'] = $_SESSION['current_y'] - 1;
                $_SESSION['current'] = 12;
            }
        
        
        // Update the displayed month name based on the new value of $current
        $year = $_SESSION['current_y'];
        $monthName = date('F', mktime(0, 0, 0, $_SESSION['current'], 1));
        
        $events = $this->service_model->getEventsByMonth($_SESSION['user_id'],$_SESSION['current']);
        
        $data = [
            'events' => $events,
            'month' => $monthName,
            'year' => $year,
            'no' => $_SESSION['current']
        ];
    
        $this->view('service_providers/eventCalander',$data);
    }

    public function messages(){
        $this->view('service_providers/chat');
    }

    public function getEvent(){
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

 

}


?>