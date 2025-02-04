<?php

require_once('../config/connect.php');

class model extends connect
{

    private $tabela_usuarios;
    private $tabela_playlist;
    private $tabela_musicas;

    function __construct()
    {
        parent::__construct();
        $this->tabela_playlist = 'playlist';
        $this->tabela_musicas = 'musicas';
        $this->tabela_usuarios = 'usuarios';
    }
    function cadastrar($nome, $email, $senha)
    {

        $sql_check = $this->connect->prepare("SELECT * FROM $this->tabela_usuarios WHERE nome_usuario = :nome OR email = :email");
        $sql_check->bindParam(':nome', $nome);
        $sql_check->bindParam(':email', $email);
        $sql_check->execute();

        if ($sql_check->rowCount() == 1) {

            return 1;
        } else {

            $sql_cadastro = $this->connect->prepare("INSERT INTO $this->tabela_usuarios VALUES (DEFAULT, :nome, :email, MD5(:senha), NULL)");
            $sql_cadastro->bindParam(':nome', $nome);
            $sql_cadastro->bindParam(':email', $email);
            $sql_cadastro->bindParam(':senha', $senha);
            $sql_cadastro->execute();

            if ($sql_cadastro) {

                return 2;
            } else {

                return 3;
            }
        }
    }
    function logar($email, $senha)
    {

        session_start();
        $sql_logar = $this->connect->prepare("SELECT * FROM $this->tabela_usuarios WHERE email = :email AND senha = MD5(:senha)");
        $sql_logar->bindParam(':email', $email);
        $sql_logar->bindParam(':senha', $senha);
        $sql_logar->execute();

        if ($sql_logar->rowCount() > 0) {

            $nome_usuario = $this->connect->prepare("SELECT * FROM $this->tabela_usuarios WHERE email = :email");
            $nome_usuario->bindParam(':email', $email);
            $nome_usuario->execute();

            $bd = $nome_usuario->fetchAll(PDO::FETCH_ASSOC);
            foreach ($bd as $value) {
                $nome = $value['nome_usuario'];
                $id = $value['id'];
            }
            $_SESSION['id'] = $id;
            $_SESSION['nome'] = $nome;
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            return 1;
        } else {

            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            return 2;
        }
    }
    function mudar_email($email, $nome)
    {
        $sql_email = $this->connect->prepare("UPDATE $this->tabela_usuarios SET email = :email WHERE nome_usuario = :nome");
        $sql_email->bindParam(':email', $email);
        $sql_email->bindParam(':nome', $nome);
        $sql_email->execute();

        if ($sql_email) {

            $_SESSION['email'] = $email;
            return 1;
        } else {
            return 2;
        }
    }
    function mudar_senha($nova_senha, $email)
    {
        $sql_senha = $this->connect->prepare("UPDATE $this->tabela_usuarios SET senha = MD5(:senha) WHERE email = :email");
        $sql_senha->bindParam(':senha', $nova_senha);
        $sql_senha->bindParam(':email', $email);
        $sql_senha->execute();

        if ($sql_senha) {

            $_SESSION['senha'] = $nova_senha;
            return 1;
        } else {
            return 2;
        }
    }
    function data_senha($email)
    {
        $sql_data = $this->connect->query("SELECT * FROM $this->tabela_usuarios WHERE email = '$email'");
        $data = $sql_data->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as $value) {
            return $value['ultima_alteracao'];
        }
    }
    function lista_musicas(){

        $sql_musica = $this->connect->query("SELECT * FROM $this->tabela_musicas");
        $result = $sql_musica->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
