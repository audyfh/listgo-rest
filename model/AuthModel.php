<?php

class AuthModel extends Model{

    function login($username){
        $username = $this->db->real_escape_string($username);
    
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->db->query($query);
        
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
    }

    function register($username, $password){
        $username = $this->db->real_escape_string($username);
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        
        $query = "INSERT INTO users (username, password_hash) VALUES ('$username', '$passwordHash')";
        return $this->db->query($query);
    }
}