<?php

    class clientes
    {

        public $cpf;
        public $nome;
        public $email;
        public $telefone;
        public $dataNascimento;
        public $profissao;

    }

    function getClientes($conn)
    {
        $arrayClientes = [];

        $SQL = "
            SELECT *
            FROM Cliente
            ORDER BY nome ASC;
        ";

        $result = $conn->query($SQL);
        if (! $result)
            throw new Exception('Ocorreu uma falha ao gerar o relatorio de testes: ' . $conn->error);

        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                $clientes = new Clientes();

                $clientes->cpf = $row["cpf"];
                $clientes->nome = $row["nome"];
                $clientes->email = $row["email"];
                $clientes->telefone = $row["telefone"];
                $clientes->dataNascimento = $row["dataNascimento"];
                $clientes->profissao = $row["profissao"];

                $arrayClientes[] = $clientes;
            }
        }

        return $arrayClientes;

    }

?>