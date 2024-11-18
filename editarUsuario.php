<?php
require_once 'usuario.php';
require_once 'cabecalho.php';
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Atualizar Dados do Usuário</title>
</head>
<body>
    <h1 class="text-center mb-4">Atualizar Dados do Usuário</h1><br>
    <form action="atualizarUsuario.php" method="post" class="bg-light p-5 rounded shadow">
        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
        
        <label class="form-label">Nome:</label>
        <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>" placeholder="Nome Completo"><br>
        
        <label>Email:</label>
        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Digite o email"><br>
        
        <label class="form-label">Telefone:</label>
        <input type="tel" name="telefone" class="form-control" value="<?php echo $telefone; ?>" placeholder="Telefone Completo"><br>
        
        <label class="form-label">Senha:</label>
        <input type="password" name="senha" class="form-control" placeholder="Digite sua Senha"><br>
        
        <label class="form-label">Confirmar Senha:</label>
        <input type="password" name="confSenha" class="form-control" placeholder="Confirme sua Senha"><br>
        
        <input type="submit" value="ATUALIZAR" class="btn btn-primary w-100">
    </form>
</body>
</html>
