<?php
require_once('../models/model.playlist.php');

if (isset($_POST['playlistName']) && !empty($_POST['playlistName']) && isset($_POST['id_usuario']) && !empty($_POST['id_usuario'])) {

    $id_usuario = $_POST['id_usuario'];
    $nome_playlist = $_POST['playlistName'];
    $model = new playlist();
    $result = $model->criar_playlist($nome_playlist, $id_usuario);

    switch ($result) {

        case 1:
            header('location:../views/criar_playlist.php?true');
            exit();
            break;
        case 2:
            header('location:../views/criar_playlist.php?false');
            exit();
            break;
        case 3:
            header('location:../views/criar_playlist.php?ja_existe');
            exit();
            break;
    }
} else if (isset($_POST['playlist']) && !empty($_POST['playlist']) && isset($_POST['id_usuario']) && !empty($_POST['id_usuario'])) {

    $nome_playlist = $_POST['playlist'];
    $id_usuario = $_POST['id_usuario'];

    $playlist = new playlist();
    $result = $playlist->delete_playlist($nome_playlist, $id_usuario);

    switch ($result) {

        case 1:
            header('location:../views/deletar_playlist.php?true');
            exit();
            break;
        case 2:
            header('location:../views/deletar_playlist.php?false');
            exit();
            break;
    }
} else if (isset($_POST['add_musica']) && !empty($_POST['add_musica']) && isset($_POST['id_usuario']) && !empty($_POST['id_usuario']) && isset($_POST['nome_playlist']) && !empty($_POST['nome_playlist'])) {

    $new_musicas = $_POST['add_musica'];
    $id_usuario = $_POST['id_usuario'];
    $nome_playlist = $_POST['nome_playlist'];

    $playlist = new playlist();
    echo $result = $playlist->add_musica($id_usuario, $nome_playlist, $new_musicas);

    switch ($result) {

        case 1:
            header('location:../views/playlist.php?nome_playlist=' . $nome_playlist . '&erro');
            exit();
            break;
        case 2:
            header('location:../views/playlist.php?nome_playlist=' . $nome_playlist);
            exit();
            break;
    }
} else {
    header('location:../index.php');
    exit();
}
