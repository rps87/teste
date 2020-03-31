<?php
    class HomeController extends MainController
    {
        public function index() {
            $this->title = 'Home';
            $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
            require ABSPATH . '/views/home/home-view.php';
        }
    }