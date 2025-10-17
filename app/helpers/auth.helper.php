<?php

class AuthHelper {

    public static function init() {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function login($user) {       //inicia la session con el usuario enviado por parámetro
        AuthHelper::init();
        $_SESSION['USER_ID'] = $user->id_user;
        $_SESSION['USER_NAME'] = $user->username; 
    }

    public static function logout() {           //destruye la session iniciada
        AuthHelper::init();
        session_destroy();
    }

    public static function verify() {           //verifica que este logeado el usuario (controller)
        AuthHelper::init();
        if (!isset($_SESSION['USER_ID'])) {
            header('Location: ' . BASE_URL . 'login');
            die();
        }
    }

    public static function check() {            //chequea si se encuentra o no iniciada una session (views)
        AuthHelper::init();
        return isset($_SESSION['USER_ID']);
    }
}