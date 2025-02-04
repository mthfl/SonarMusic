<?php
require('../config/connect.php');

class playlist extends connect
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

    function criar_playlist($nome_playlist, $id_usuario)
    {

        $sql_check = $this->connect->prepare("SELECT * FROM $this->tabela_playlist WHERE nome_playlist = :nome_playlist AND id_usuario = :id_usuario");
        $sql_check->bindParam('nome_playlist', $nome_playlist);
        $sql_check->bindParam('id_usuario', $id_usuario);
        $sql_check->execute();

        if ($sql_check->rowCount() == 0) {
            $sql_playlist = $this->connect->prepare("INSERT INTO $this->tabela_playlist VALUES (DEFAULT, :nome_playlist, null, :id_usuario)");
            $sql_playlist->bindParam(':nome_playlist', $nome_playlist);
            $sql_playlist->bindParam(':id_usuario', $id_usuario);
            $sql_playlist->execute();

            if ($sql_playlist) {
                return 1;
            } else {
                return 2;
            }
        } else {
            return 3;
        }
    }
    function view_playlist($id_usuario)
    {
        $sql_view = $this->connect->query("SELECT nome_playlist, id_usuario 
        FROM $this->tabela_playlist 
        WHERE id_usuario = '$id_usuario'
        GROUP BY nome_playlist, id_usuario ");
        return $playlist = $sql_view->fetchAll(PDO::FETCH_ASSOC);
    }
    function views_total_musica($nome_playlist, $id_usuario)
    {
        $sql_count = $this->connect->query("SELECT count(id_musica) AS linhas FROM $this->tabela_playlist WHERE nome_playlist = '$nome_playlist' AND id_usuario = '$id_usuario'");

        $result = $sql_count->fetch(PDO::FETCH_ASSOC);

        return $result['linhas'];
    }
    function delete_playlist($nome_playlist, $id_usuario)
    {
        $sql_delete_playlist = $this->connect->query("DELETE FROM $this->tabela_playlist WHERE nome_playlist = '$nome_playlist' AND id_usuario = '$id_usuario'");

        if ($sql_delete_playlist) {
            return 1;
        } else {
            return 2;
        }
    }
    function view_musica($id_usuario, $nome_playlist)
    {
        $sql_conta_musica = $this->connect->query("SELECT nome_musica, album, tempo, cantor from $this->tabela_musicas INNER JOIN $this->tabela_playlist INNER JOIN $this->tabela_usuarios on musicas.id = playlist.id_musica AND usuarios.id = playlist.id_usuario AND playlist.id_usuario = '$id_usuario' and playlist.nome_playlist = '$nome_playlist'");

        return $result = $sql_conta_musica->fetchAll(PDO::FETCH_ASSOC);
    }
    function total_muinutos($id_usuario, $nome_playlist)
    {
        $sql_conta_musica = $this->connect->query("SELECT tempo from $this->tabela_musicas INNER JOIN $this->tabela_playlist INNER JOIN $this->tabela_usuarios on musicas.id = playlist.id_musica AND usuarios.id = playlist.id_usuario AND playlist.id_usuario = '$id_usuario' and playlist.nome_playlist = '$nome_playlist'");

        $result = $sql_conta_musica->fetchAll(PDO::FETCH_ASSOC);

        $soma = 0;
        foreach ($result as $tempo) {

            $soma += $tempo['tempo'];
        }

        if (empty($result)) {
            return "";
        } else if (count($result) == 1) {
            return $tempo['tempo'];
        } else {

            list($h, $m) = explode(".", $soma);
            $h += intdiv($m, 60);
            $m = $m % 60;

            return sprintf("%02d:%02d", $h, $m);
        }
    }
    function add_musica($id_usuario, $nome_playlist, $new_musicas = array())
    {
        foreach ($new_musicas as $musica) {
            $sql_delete = $this->connect->query("DELETE FROM $this->tabela_playlist WHERE id_musica = NULL");

            $sql_idMusica = $this->connect->query("SELECT id FROM $this->tabela_musicas WHERE nome_musica = '$musica'");
            $result = $sql_idMusica->fetch(PDO::FETCH_ASSOC);

            $id = $result['id'];
            $sql_check = $this->connect->query("SELECT id_musica FROM $this->tabela_playlist WHERE id_musica = '$id'");

            if ($sql_check->rowCount() == 0) {

                $sql_add_musica = $this->connect->query("INSERT INTO $this->tabela_playlist VALUES(DEFAULT, '$nome_playlist', '$id', '$id_usuario')");
            } else {

                return 1;
            }
        }
        return 2;
    }
}
