<?php

    class PrincipalMVC
    {

        private $controlador;
        private $acao;
        private $parametros;
        private $not_found = '/includes/404.php';

        public function __construct () {
            $this->get_url_data();
            if ( ! $this->controlador ) {
                require_once ABSPATH . '/controllers/home-controller.php';
                $this->controlador = new HomeController();
                $this->controlador->index();
                return;		
            }
            if ( ! file_exists( ABSPATH . '/controllers/' . $this->controlador . '.php' ) ) {
                require_once ABSPATH . $this->not_found;
                return;
            }
            require_once ABSPATH . '/controllers/' . $this->controlador . '.php';
            $this->controlador = preg_replace( '/[^a-zA-Z]/i', '', $this->controlador );
            if ( ! class_exists( $this->controlador ) ) {
                require_once ABSPATH . $this->not_found;
                return;
            }
            $this->controlador = new $this->controlador( $this->parametros );
            $this->acao = preg_replace( '/[^a-zA-Z]/i', '', $this->acao );
            if ( method_exists( $this->controlador, $this->acao ) ) {
                $this->controlador->{$this->acao}( $this->parametros );
                return;
            }
            if ( ! $this->acao && method_exists( $this->controlador, 'index' ) ) {
                $this->controlador->index( $this->parametros );		
                return;
            }
            require_once ABSPATH . $this->not_found;
            return;
        }

        public function get_url_data () {
            //$url = str_replace("/teste/", "", $_SERVER["REQUEST_URI"]);
            //if ( ! $url === "" ) {
            if ( isset( $_GET['caminho'] ) ) {
                $caminho = $_GET['caminho'];
                $caminho = rtrim($caminho, '/');
                $caminho = filter_var($caminho, FILTER_SANITIZE_URL);
                $caminho = explode('/', $caminho);
                //$path = $url;
                $this->controlador  = chk_array( $caminho, 0 );
                $this->controlador .= '-controller';
                $this->acao         = chk_array( $caminho, 1 );
                if ( chk_array( $caminho, 2 ) ) {
                    unset( $caminho[0] );
                    unset( $caminho[1] );
                    $this->parametros = array_values( $caminho );
                }
                // DEBUG
                //
                // echo $this->controlador . '<br>';
                // echo $this->acao        . '<br>';
                // echo '<pre>';
                // print_r( $this->parametros );
                // echo '</pre>';
            }
        }	
    }