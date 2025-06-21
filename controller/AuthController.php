<?php

class Auth extends Controller
{

    function loginForm()
    {
        $this->loadView('loginform.php');
    }

    function registerForm()
    {
        $this->loadView('registerform.php');
    }

    function login()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $model = $this->loadModel('AuthModel');
        $data = $model->login($username);
        if ($data) {
            if (password_verify($password, $data['password_hash'])) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user_id'] = $data['id'];
                header("Location: index.php?c=Category&m=index");
                exit;
            } else {
                $this->loadView('loginform.php', ['error' => 'Invalid password']);
            }
        } else {
            $this->loadView('loginform.php', ['error' => 'Invalid username']);
        }
    }

    function register()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $model = $this->loadModel('AuthModel');
        $result = $model->register($username, $password);
        if ($result) {
            header("Location: index.php?c=Auth&m=login");
            exit;
        } else {
            $this->loadView('registerform.php', ['error' => 'Registration failed']);
        }
    }

    function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['user_id']);
        session_destroy();
        header("Location: index.php?c=Auth&m=login");
        exit;
    }
}
