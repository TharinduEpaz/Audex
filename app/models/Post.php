<?php
    class Post{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        public function getPosts(){
            $this->db->query("SELECT * FROM user");
            return $this->db->resultSet();
        }
    }
?>
<!-- <h1>Welcome</h1> -->