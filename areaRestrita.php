<?php
require_once 'usuario.php';
$usuario = new Usuario();
$usuario->conectar("cadastrousuarioturma33", "localhost", "root", "");
$dados = $usuario->listarUsuarios();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Dados</title>
</head>

<body>
    <h1>Listar Usuarios</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($dados)) {
                foreach ($dados as $pessoa):
                    ?>
                    <tr>
                        <td><?php echo $pessoa['nome']; ?></td>
                        <td><?php echo $pessoa['email']; ?></td>
                        <td><?php echo $pessoa['telefone']; ?></td>
                        <td>
                            <form action="excluirUsuario.php" method="post">
                                <input type="hidden" name="id_usuario" value="<?php echo $pessoa['id_usuario']; ?>">
                                <input type="submit" class="botao-excluir" value="Excluir">
                            </form>
                        </td>
                        <td>
                            <form action="editarUsuario.php" method="post">
                                <input type="hidden" name="id_usuario" value="<?php echo $pessoa['id_usuario'];?>">
                                <input type="submit" class="botao-editar" value="Editar">
                            </form>
                        </td>
                    </tr>
                    <?php
                endforeach;
            } else {
                echo "Nenhum Usuario Cadastrado";
            }
            ?>
        </tbody>
    </table>
</body>

</html>