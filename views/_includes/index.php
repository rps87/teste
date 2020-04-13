<?php
    include_once 'topo.php';
    if(isset($_SESSION['usuario'])){
        
        include_once 'fundo.php';
        include_once 'rodape.php';
    }else{
        header("Location: login.php");
    }
?>