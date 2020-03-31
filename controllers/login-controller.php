<?php
    class LoginController extends MainController
    {
        public function index() {
            $this->title = 'Login';
            $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
            require ABSPATH . '/views/login/login-view.php';
        }
    }