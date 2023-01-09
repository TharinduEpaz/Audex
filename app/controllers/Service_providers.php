<?php

class Service_providers extends Controller
{



    public function __construct()
    {
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
        if($_SESSION['user_type'] != 'service_provider'){
            redirect($_SESSION['user_type'].'s/index');
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

            }
            else{
                $profession = $data['details']->profession;
            }

            if (isset($_POST['qualifications'])&& $_POST['qualifications'] != '') {

                $qualifications = $_POST['qualifications'];

            }else{
                $qualifications= $data['details']->qualifications;
            }
            if (isset($_POST['achievements'])&& $_POST['achievements'] != '') {

                $achievements = $_POST['achievements'];

            }else{
                $achievements = $data['details']->achievements;
            }
            if (isset($_POST['description'])&& $_POST['description'] != '') {

                $description = $_POST['description'];

            }else{
                $description = $data['details']->description;
            }
            if (isset($_POST['first_name'])&& $_POST['first_name'] != '') {

                $first_name = $_POST['first_name'];

            }else{
                $first_name = $data['details']->first_name;
            }
            if (isset($_POST['second_name'])&& $_POST['second_name'] != '') {

                $second_name = $_POST['second_name'];

            }else{
                $second_name = $data['details']->second_name;
            }
            if (isset($_POST['address1'])&& $_POST['address1'] != '') {

                $address1 = $_POST['address1'];

            }else{
                $address1 = $data['details']->address_line_one;
            }
            if (isset($_POST['address2'])&& $_POST['address2'] != '') {

                $address2 = $_POST['address2'];

            }else{
                $address2 = $data['details']->address_line_two;
            }
        }

        $details = array($profession, $qualifications, $achievements, $description,$first_name,$second_name,$address1,$address2);

        $this->service_model->setDetails($details,$_SESSION['user_id']);

        redirect('service_providers/profile/');
    }

    public function feed(){

        $this->view('service_providers/feed');
        
    }

    public function addEvent(){ 

        $this->view('service_providers/addEvent');
        
    }

    public function addNewEvent(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['name']) && $_POST['name'] != '') {
                $name = $_POST['name'];
            }

        if (isset($_POST['date'])&& $_POST['date'] != '') {
                $date = $_POST['date'];
        }
        if (isset($_POST['public'])&& $_POST['public'] != '') {
            $public_event = $_POST['public_event']; }

        if (isset($_POST['location'])&& $_POST['location'] != '') {
                $location = $_POST['location'];}
        
        if (isset($_POST['link'])&& $_POST['link'] != '') {
                $link = $_POST['link'];}

        if (isset($_POST['description'])&& $_POST['description'] != '') {
                $description = $_POST['description'];}

        $event_details = array($name, $date, $public_event, $location, $link, $description);
    

        $this->service_model->setEvent($event_details,$_SESSION['user_id']);

        

    }
}




}



?>