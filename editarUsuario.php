<?php
require_once 'usuario.php';
$usuario = new Usuario();
$usuario->conectar("cadastrousuarioturma33", "localhost", "root", "");

if (isset($_POST['id_usuario']) && !empty($_POST['id_usuario'])) {
    $id_usuario = $_POST['id_usuario'];

    $dadosUsuario = $usuario->listarUsuarios();

    foreach ($dadosUsuario as $pessoa) {
        if ($pessoa['id_usuario'] == $id_usuario) {
            $nome = $pessoa['nome'];
            $email = $pessoa['email'];
            $telefone = $pessoa['telefone'];
        }
    }
} else {
    echo "Erro: ID do usuário não encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Dados do Usuário</title>
</head>
<body>
    <h2>Atualizar Dados do Usuário</h2><br>
    <form action="atualizarUsuario.php" method="post">
        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
        
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo $nome; ?>" placeholder="Nome Completo"><br>
        
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Digite o email"><br>
        
        <label>Telefone:</label>
        <input type="tel" name="telefone" value="<?php echo $telefone; ?>" placeholder="Telefone Completo"><br>
        
        <label>Senha:</label>
        <input type="password" name="senha" placeholder="Digite sua Senha"><br>
        
        <label>Confirmar Senha:</label>
        <input type="password" name="confSenha" placeholder="Confirme sua Senha"><br>
        
        <input type="submit" value="ATUALIZAR">
    </form>
</body>
</html>
