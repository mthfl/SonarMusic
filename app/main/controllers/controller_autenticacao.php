<?php

require_once('../models/model.php');

if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['confirmar_senha']) && !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['senha']) && !empty($_POST['confirmar_senha'])) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    if ($senha !== $confirmar_senha) {
        header('location:../views/entrar_cadastrar.php?false');
        exit();
    }

    $cadastro = new model();
    $result = $cadastro->cadastrar($nome, $email, $senha);

    switch ($result) {

        case 1:
            header('location:../views/entrar_cadastrar.php?ja_existe');
            exit();
            break;
        case 2:
            header('location:../views/entrar_cadastrar.php?cadastrado');
            exit();
            break;
        case 3:
            header('location:../views/entrar_cadastrar.php?fatal');
            exit();
            break;
    }
} else if (isset($_POST['email']) && isset($_POST['senha']) && !empty($_POST['email']) && !empty($_POST['senha'])) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $logar = new model();
    $result = $logar->logar($email, $senha);

    switch ($result) {

        case 1:
            header('location:../views/home_page.php');
            exit();
            break;

        case 2:
            header('location:../views/entrar_cadastrar.php?erro');
            exit();
            break;
    }
} else {
    header('location:../index.php');
    exit();
}
