<?php

class Service_providers extends Controller
{



    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
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

        $data = [
            'details' => $details
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
        }

        $details = array($profession, $qualifications, $achievements, $description);

        $this->service_model->setDetails($details,$_SESSION['user_id']);



        // redirect('service_providers/profile/');
    }



}



?>