<?php
    class Seller{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getadvertisements(){
            $this->db->query('SELECT * FROM product ');
            $results = $this->db->resultSet();
            return $results;
        }
    }