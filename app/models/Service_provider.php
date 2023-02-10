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

        $this->db->query('SELECT * FROM user LEFT JOIN service_provider ON user.user_id = service_provider.user_id WHERE service_provider.user_id = :id UNION SELECT * FROM user RIGHT JOIN service_provider ON user.user_id = service_provider.user_id WHERE service_provider.user_id = :id ');


        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;

    }

    public function setDetails($arr, $id)
    {

        $this->db->query('UPDATE service_provider,user SET user.first_name = :first_name, user.second_name = :second_name, service_provider.address_line_one = :address1,service_provider.address_line_two = :address2,service_provider.profession = :profession, service_provider.qualifications = :qualifications, service_provider.achievements = :achievements, service_provider.description = :description  WHERE service_provider.user_id = :id AND user.user_id = :id');

        $this->db->bind(':id', $id);
        $this->db->bind(':profession', $arr[0]);
        $this->db->bind(':qualifications', $arr[1]);
        $this->db->bind(':achievements', $arr[2]);
        $this->db->bind(':description', $arr[3]);
        $this->db->bind(':first_name', $arr[4]);
        $this->db->bind(':second_name', $arr[5]);
        $this->db->bind(':address1', $arr[6]);
        $this->db->bind(':address2', $arr[7]);

        $this->db->execute();

        
    }

    public function getEvents($user_id){

        $this->db->query('SELECT * FROM events WHERE user_id = :id');
        $this->db->bind(':id', $user_id);
        $events = $this->db->resultSet();

        return $events;
    }

    public function setEvent($data,$user_id){

        // $this->db->query('INSERT INTO events (name, description, date, user_id, location, ticket_link) VALUES (:name, :description, :date, :user_id, :location, :ticketLink)');


        $this->db->query('INSERT INTO `events` (`event_id`, `name`, `description`, `date`, `user_id`, `public_event`, `location`, `ticket_link`, `time`) VALUES (NULL, :name, :description, :date, :user_id, NULL, :location, :ticketLink , 12);');

        // $event_details = array($name, $date, $public_event, $location, $link, $description); 

        $this->db->bind(':name', $data[0]);
        $this->db->bind(':date', $data[1]);
        // $this->db->bind(':public', $data[2]);
        $this->db->bind(':location', $data[3]);
        $this->db->bind(':ticketLink', $data[4]);
        $this->db->bind(':description', $data[5]);
        $this->db->bind(':user_id', $user_id);

        $this->db->execute();

        redirect('service_providers/profile/');

    
    }

    public function setImage($file_name, $user_id){

        $this->db->query('UPDATE service_provider SET profile_image = :image WHERE user_id = :id');

        $this->db->bind(':image', $file_name);
        $this->db->bind(':id', $user_id);

        $this->db->execute();

    }
  
               
}




?>