<?php
    class MainController
    {
        public $title;
        public $parametros = array();
        public function __construct ( $parametros = array() ) {
            $this->parametros = $parametros;	
        }
    }