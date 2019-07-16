<?php
    class Dados
    {
        public $nome;
        public $cpf;
        public $email;
        public $telefone;
        public $profissao;
        public $senha;
        public $dataNascimento;
    }

    class EnderecoResidencial{
        public $logradouro;
        public $bairro;
        public $cep;
        public $numero;
        public $cidade;
        public $estado;
    }

    class EnderecoDeEntrega{
        public $logradouro;
        public $bairro;
        public $cep;
        public $numero;
        public $cidade;
        public $estado;
    }

    function getDados($conn, $cpf)
    {
        $dados = new Dados();

        $SQL = "
            SELECT nome, email, senha, telefone, profissao, cpf, dataNascimento
            FROM Cliente WHERE cpf = '$cpf'
        ";

        $result = $conn->query($SQL);

        if (! $result)
            throw new Exception('Ocorreu uma falha: ' . $conn->error);

        if ($result->num_rows > 0)
        {
                $row = $result->fetch_assoc();
                $dados->nome            = $row["nome"];
                $dados->email         = $row["email"];
                $dados->telefone   = $row["telefone"];
                $dados->profissao = $row["profissao"];
                $dados->senha = $row["senha"];
                $dados->cpf = $row["cpf"];
                $dados->dataNascimento = $row["dataNascimento"];

        }

        return $dados;

    }

    function getEnderecoResidencial($conn, $cpf)
    {
        $endereco = new EnderecoResidencial();

        $SQL = "
            SELECT logradouro, bairro, numero, cep, cidade, estado 
            FROM EnderecoResidencial WHERE cpfCliente = '$cpf'
        ";

        $result = $conn->query($SQL);

        if (! $result)
            throw new Exception('Ocorreu uma falha: ' . $conn->error);

        if ($result->num_rows > 0)
        {
                $row = $result->fetch_assoc();
                $endereco->logradouro            = $row["logradouro"];
                $endereco->bairro         = $row["bairro"];
                $endereco->numero   = $row["numero"];
                $endereco->cidade = $row["cidade"];
                $endereco->estado = $row["estado"];
                $endereco->cep = $row["cep"];
        }

        return $endereco;

    }

    function getEnderecoDeEntrega($conn, $cpf)
    {
        $endereco = new EnderecoDeEntrega();

        $SQL = "
            SELECT logradouro, bairro, numero, cep, cidade, estado 
            FROM EnderecoEntrega WHERE cpfCliente = '$cpf'
        ";

        $result = $conn->query($SQL);

        if (! $result)
            throw new Exception('Ocorreu uma falha: ' . $conn->error);

        if ($result->num_rows > 0)
        {
                $row = $result->fetch_assoc();
                $endereco->logradouro            = $row["logradouro"];
                $endereco->bairro         = $row["bairro"];
                $endereco->numero   = $row["numero"];
                $endereco->cidade = $row["cidade"];
                $endereco->estado = $row["estado"];
                $endereco->cep = $row["cep"];

        }

        return $endereco;

    }
?>