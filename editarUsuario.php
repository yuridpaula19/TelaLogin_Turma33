<?php
    require_once 'usuario.php';
    $usuario = new Usuario();
    $usuario->conectar("cadastrousuarioturma33", "localhost", "root", "");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualzizar Dados</title>
</head>
<body>
    <h2>Atualizar Dados do Usuario</h2><br>
    <form action="" method="post">
        <label>Nome:</label>
        <input type="text" name="nome" id="" placeholder="Nome Completo"><br>
        <label>Email:</label>
        <input type="email" name="email" id=""placeholder="Digite o email"><br>
        <label>Telefone:</label>
        <input type="tel" name="telefone" id=""placeholder="Telefone Completo"><br>
        <label>Senha:</label>
        <input type="password" name="senha" id=""placeholder="Digite sua Senha"><br>
        <label>Confirmar Senha:</label>
        <input type="password" name="confSenha" id=""placeholder="Confirme sua Senha"><br>
        
        <input type="submit" value="ATUALIZAR">
    </form>
    <?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_usuario'])) {
    $id_usuario = (int)$_POST['id_usuario'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $confSenha = $_POST['confSenha'];

    if (!empty($nome) && !empty($email) && !empty($telefone) && !empty($senha) && !empty($confSenha)) {
        if ($usuario->msgErro == "") {
            if ($senha === $confSenha) {
                if ($usuario->atualizar($id_usuario, $nome, $telefone, $email, $senha)) {
                    ?>
                    <div class="msg-sucesso">
                        <p>Dados Atualizados com Sucesso</p>
                        <p>Clique <a href="login.php">aqui</a> para Logar</p>
                    </div>
                    <?php
                } else {
                    echo "<p>Erro ao atualizar dados.</p>";
                }
            } else {
                ?>
                <div class="msg-erro">
                    <p>Senha e Confirmar Senha não conferem.</p>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="msg-erro">
                <?php echo "Erro: " . $usuario->msgErro; ?>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="msg-erro">
            <p>Preencha todos os campos!</p>
        </div>
        <?php
    }
} else {
    echo "<p>Erro: ID do usuário não especificado.</p>";
    var_dump($_POST);
}
?>
