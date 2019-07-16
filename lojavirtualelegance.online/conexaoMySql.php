<?php

    define("HOST", "fdb20.awardspace.net");
    define("USER", "3063994_elegance");
    define("PASSWORD", "pielegance2019");
    define("DATABASE", "3063994_elegance");

    function conectaAoMySQL()
    {
        $conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
        if ($conn->connect_error)
        throw new Exception('Falha na conexão com o MySQL: ' . $conn->connect_error);

        return $conn;
    }

?>