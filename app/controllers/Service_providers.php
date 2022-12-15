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


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['profession'])) {

                $profession = $_POST['profession'];

            }
            if (isset($_POST['qualifications'])) {

                $qualifications = $_POST['qualifications'];

            }
            if (isset($_POST['achievements'])) {

                $achievements = $_POST['achievements'];

            }
            if (isset($_POST['description'])) {

                $description = $_POST['description'];

            }
        }

        $details = array($profession, $qualifications, $achievements, $description);

        $this->service_model->setDetails($details,$_SESSION['user_id']);



        // redirect('service_providers/profile/');
    }



}



?>