<?php
require_once 'usuario.php';
$usuario = new Usuario();
$usuario->conectar("cadastrousuarioturma33", "localhost", "root", "");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_usuario'])) {
    $id_usuario = (int)$_POST['id_usuario'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $confSenha = $_POST['confSenha'];

    if (!empty($nome) && !empty($email) && !empty($telefone) && !empty($senha) && !empty($confSenha)) {
        if ($senha === $confSenha) {
            if ($usuario->atualizar($id_usuario, $nome, $telefone, $email, $senha)) {
                echo "<p>Dados atualizados com sucesso.</p>";
            } else {
                echo "<p>Erro: Email já cadastrado para outro usuário.</p>";
            }
        } else {
            echo "<p>Erro: Senha e confSenha não batem.</p>";
        }
    } else {
        echo "<p>Preencha todos os campos!</p>";
    }
} else {
    echo "<p>Erro: ID do usuário não especificado.</p>";
}
?>
