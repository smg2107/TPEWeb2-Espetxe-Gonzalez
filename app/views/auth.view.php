<?php
require_once './app/views/view.php';

class AuthView extends View{
    public function showLogin($error = null) {
        require './templates/users/formLogin.phtml';
    }
}