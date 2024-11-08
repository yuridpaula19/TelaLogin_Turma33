<?php
require_once 'usuario.php';
$usuario = new Usuario();
$usuario->conectar("cadastrousuarioturma33", "localhost", "root", "");

if (isset($_POST['id_usuario'])) {
    $id_usuario = (int) $_POST['id_usuario'];
    $usuario->deletar($id_usuario);
    header("Location: areaRestrita.php");
    exit;
} else {
    echo "Erro: ID do usuário não especificado.";
}
?>