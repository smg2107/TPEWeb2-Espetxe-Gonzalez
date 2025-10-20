<?php

require_once './app/models/user.model.php';
require_once './app/views/auth.view.php';
require_once './app/helpers/auth.helper.php';

class AuthController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->view = new AuthView();
        $this->model = new UserModel();
    }

    public function login()
    {
        $this->view->showLogin();
    }

    public function auth()
    {
        $username = $_POST['username'];          //se reciben user y pass enviados por POST del form
        $password = $_POST['password'];
        //$hash = password_hash($password, PASSWORD_DEFAULT);
        

        if (empty($username) || empty($password)) {
            $this->view->showLogin('Faltan completar datos');
            return;
        }

        $user = $this->model->getByUser($username);

        if (!$user) {
            $this->view->showLogin('Usuario no encontrado');
            return; // Early return if user is not found
        }

        if ($user && password_verify($password, $user->password)) { //checkeamos que el user este en la db
            AuthHelper::login($user);
            header('Location: ' . BASE_URL . ' ');
        } else {
            $this->view->showLogin('Usuario y/o contraseña inválidos');
            

        }
    }

    public function logout()
    {
        AuthHelper::logout();
        header('Location: ' . BASE_URL . ' ');
    }
}