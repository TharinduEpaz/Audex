<?php
class Service_provider
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getDetails($id)
    {

        $this->db->query('SELECT * FROM user LEFT JOIN service_provider ON user.user_id = service_provider.user_id WHERE service_provider.user_id = :id UNION SELECT * FROM user RIGHT JOIN service_provider ON user.user_id = service_provider.user_id WHERE service_provider.user_id = :id');


        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;

    }

    public function setDetails($arr, $id)
    {

        $this->db->query('UPDATE service_provider SET profession = :profession, qualifications = :qualifications, achievements
            = :achievements, description = :description WHERE service_provider.user_id = :id');

        $this->db->bind(':id', $id);
        $this->db->bind(':profession', $arr[0]);
        $this->db->bind(':qualifications', $arr[1]);
        $this->db->bind(':achievements', $arr[2]);
        $this->db->bind(':description', $arr[3]);

        $this->db->execute();

        redirect('service_providers/profile');
    }
}



?>