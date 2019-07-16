<?php

    require_once "login.php";
    require "conexaoMySql.php";

    session_start();
    $mysqli = conectaAoMySQL();
    checkUsuarioLogadoOrDie($mysqli);

?>
