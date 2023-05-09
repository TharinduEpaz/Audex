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

    public function setDetails($data, $id)
    {
        // $details = [
        //     'profession' => $profession,
        //     'qualifications' => $qualifications,
        //     'achievements' => $achievements,
        //     'description' => $description,
        //     'first_name' => $first_name,
        //     'second_name' => $second_name,
        //     'address1' => $address1,
        //     'address2' => $address2,
        // ];

        $this->db->query('UPDATE service_provider,user SET user.first_name = :first_name, user.second_name = :second_name, user.phone_number = :phone, service_provider.address_line_one = :address1,service_provider.address_line_two = :address2,service_provider.profession = :profession, service_provider.qualifications = :qualifications, service_provider.achievements = :achievements, service_provider.description = :description  WHERE service_provider.user_id = :id AND user.user_id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':profession', $data['profession']);
        $this->db->bind(':qualifications', $data['qualifications']);
        $this->db->bind(':achievements', $data['achievements']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':second_name', $data['second_name']);
        $this->db->bind(':address1', $data['address1']);
        $this->db->bind(':address2', $data['address2']);
        $this->db->bind(':phone', $data['phone']);
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

        $this->db->query('INSERT INTO `events` (`name`, `description`, `date`, `user_id`, `event_type`, `location`, `ticket_link`, `time`,`image`) VALUES ( :name, :description, :date, :user_id, :public, :location, :ticketLink , :time,:img);');

        // $event_details = array($name, $date, $public_event, $location, $link, $description); 

        $this->db->bind(':name', $data[0]);
        $this->db->bind(':date', $data[1]);
        $this->db->bind(':public', $data[2]);
        $this->db->bind(':location', $data[3]);
        $this->db->bind(':ticketLink', $data[4]);
        $this->db->bind(':description', $data[5]);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':img', $data[6]);
        $this->db->bind(':time',$data[7]);

        $this->db->execute();

        // redirect('service_providers/profile/'); 
    }

    public function setImage($file_name, $user_id){

        $this->db->query('UPDATE service_provider SET profile_image = :image WHERE user_id = :id');
        $this->db->bind(':image', $file_name);
        $this->db->bind(':id', $user_id);
        $this->db->execute();

    }

    public function getEventsByMonth($user_id,$month){

        $this -> db -> query('SELECT * FROM events WHERE user_id = :id AND MONTH(date) = :month');
        $this -> db -> bind(':id', $user_id);
        $this -> db -> bind(':month', $month);
        $events = $this -> db -> resultSet();       
        return $events;
    }

    public function getEventById($event_id){

        $this -> db -> query('SELECT * FROM events WHERE event_id = :id ');
        $this -> db -> bind(':id', $event_id);
        $event = $this -> db -> single();
        return $event;

    }

    public function getEventOwner($id){

         $this->db->query('SELECT first_name, second_name FROM `user`,`events` WHERE user.user_id = events.user_id and events.event_id = :id;');
         $this -> db -> bind(':id', $id);
         $name = $this -> db -> single();
         return $name;

    }
    public function updateEvent($id, $event_name, $location, $time, $link, $event_type, $description, $file_name){

        if($event_name != ''){
            $this->db->query('UPDATE events SET name = :name WHERE event_id = :id');
            $this->db->bind(':name', $event_name);
            $this->db->bind(':id', $id);
            $this->db->execute();
        }
        //location
        if($location != ''){
            $this->db->query('UPDATE events SET location = :location WHERE event_id = :id');
            $this->db->bind(':location', $location);
            $this->db->bind(':id', $id);
            $this->db->execute();
        }
        //time
        if($time != ''){
            $this->db->query('UPDATE events SET time = :time WHERE event_id = :id');
            $this->db->bind(':time', $time);
            $this->db->bind(':id', $id);
            $this->db->execute();
        }
        //link
        if($link != ''){
            $this->db->query('UPDATE events SET ticket_link = :link WHERE event_id = :id');
            $this->db->bind(':link', $link);
            $this->db->bind(':id', $id);
            $this->db->execute();
        }
        //event type
        if($event_type != ''){
            $this->db->query('UPDATE events SET event_type = :event_type WHERE event_id = :id');
            $this->db->bind(':event_type', $event_type);
            $this->db->bind(':id', $id);
            $this->db->execute();
        }
        //description
        if($description != ''){
            $this->db->query('UPDATE events SET description = :description WHERE event_id = :id');
            $this->db->bind(':description', $description);
            $this->db->bind(':id', $id);
            $this->db->execute();
        }
        //image
        if($file_name != ''){
            $this->db->query('UPDATE events SET image = :image WHERE event_id = :id');
            $this->db->bind(':image', $file_name);
            $this->db->bind(':id', $id);
            $this->db->execute();
        }

    }
    public function likeDislike($event_id,$type){
        switch ($type) {
            case 'like':
                $this->db->query('UPDATE events SET likes = likes + 1 WHERE event_id = :id');
                break;
            case 'dislike':
                $this->db->query('UPDATE events SET dislikes = dislikes + 1 WHERE event_id = :id');
                break;
            
            default:
                break;
        }
        $this->db->bind(':id', $event_id);
        $this->db->execute();

        return $this->getReactions($event_id);
    }


    public function getReactions($id){
        $this->db->query('SELECT likes,dislikes FROM events WHERE event_id = :id');
        $this->db->bind(':id', $id);
        $reactions = $this->db->single();
        return $reactions;
    }
    
    public function getPostsByUser($user_id){
        $this->db->query('SELECT * FROM feed_post WHERE user_id = :id');
        $this->db->bind(':id', $user_id);
        $posts = $this->db->resultSet();
        return $posts;
    }

    public function getPostById($id){
        $this->db->query('SELECT * FROM feed_post WHERE post_id = :id');
        $this->db->bind(':id', $id);
        $post = $this->db->single();
        return $post;
    }
    public function insertPost($user_id, $title, $content, $image1, $image2, $image3){
        $this->db->query('INSERT INTO feed_post (user_id, title, content, image1, image2, image3) VALUES (:user_id, :title, :content, :image1, :image2, :image3)');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':title', $title);
        $this->db->bind(':content', $content);
        $this->db->bind(':image1', $image1);
        $this->db->bind(':image2', $image2);
        $this->db->bind(':image3', $image3);
        $this->db->execute();

    }

    public function deletePost($id){
        $this->db->query('DELETE FROM feed_post WHERE post_id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
    }
     
}




?>