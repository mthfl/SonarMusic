<?php
require_once('../models/sessions.php');
require_once('../models/model.php');

if (isset($_POST['new_email']) && !empty($_POST['new_email']) && isset($_POST['nome']) && !empty($_POST['nome'])) {

    $email = $_POST['new_email'];
    $nome = $_POST['nome'];

    $model = new model();
    $result = $model->mudar_email($email, $nome);

    switch ($result) {

        case 1:
            header('location:../views/perfil.php?email_true');
            exit();
            break;
        case 2:
            header('location:../views/perfil.php?email_erro');
            exit();
            break;
    }
} else if (isset($_POST['current_password']) && !empty($_POST['current_password']) && isset($_POST['new_password']) && !empty($_POST['new_password']) && isset($_POST['confirm_password']) && !empty($_POST['confirm_password']) && isset($_POST['email']) && !empty($_POST['email'])) {

    $senha_atual = $_POST['current_password'];
    $senha_nova = $_POST['new_password'];
    $confirmar_senha = $_POST['confirm_password'];
    $email = $_POST['email'];

    if ($_SESSION['senha'] !== $senha_atual) {
        header('location:../views/perfil.php?senha_atual_erro');
        exit();
    }
    if ($senha_nova !== $confirmar_senha) {
        header('location:../views/perfil.php?senha_nova_erro');
        exit();
    }
    $model = new model();
    $result = $model->mudar_senha($senha_nova, $email);

    switch ($result) {

        case 1:
            header('location:../views/perfil.php?senha_true');
            break;

        case 2:
            header('location:../views/perfil.php?senha_erro');
    }
} else {
    header('location:../index.php');
    exit();
}
