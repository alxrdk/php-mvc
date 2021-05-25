<?php

namespace App\Controllers\Admin;

use \App\Config;

class Login extends \App\Controller
{
    use \App\Traits\Auth;

    protected function validateLogin()
    {
        $errors = [];
        if (empty($_POST['username'])) {
            $errors[] = 'Empty username';
        }

        if (empty($_POST['password'])) {
            $errors[] = 'Empty password';
        }

        return $errors;
    }

    public function login()
    {

        if ($this->isAuthorized()) {
            header('Location: /');
            return;
        }

        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        $error = null;

        $errors = [];
        if ($_POST) {
            $errors = $this->validateLogin();
            if (sizeof($errors) == 0) {

                if (strtolower($username) == Config::ADMIN_USER && $password == Config::ADMIN_PASSWORD) {

                    $_SESSION['authorized'] = true;
                    header('Location: /');
                    return;
                } else {
                    $errors[] = 'Wrong username or password!';
                }

            }
        }

        $this->view('Admin\Login', ['username' => $username, 'password' => $password, 'errors' => $errors]);
    }

    public function logout()
    {
        unset($_SESSION['authorized']);
        header('Location: /');
    }

}