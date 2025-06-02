<?php

class Model
{
    protected $db;

    public function __construct()
    {
        $hostname = 'localhost:3306';
        $username = 'root';
        $password = ''; 
        $dbname   = 'listngo';

        $this->db = new mysqli(
            $hostname,
            $username,
            $password,
            $dbname
        );

        if (!$this->db) die('Database error!');
    }
}
