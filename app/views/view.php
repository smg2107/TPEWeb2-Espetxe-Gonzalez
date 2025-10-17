<?php
require_once './app/helpers/auth.helper.php';

class View{
    
    protected $session; //boolean que define si está iniciada la session o no 

    public function __construct() {
        $this->session = AuthHelper::check();
    }
}