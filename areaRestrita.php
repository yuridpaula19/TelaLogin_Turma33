<?php
require_once 'usuario.php';
require_once 'cabecalho.php';
$usuario = new Usuario();
$usuario->conectar("cadastrousuarioturma33", "localhost", "root", "");
$dados = $usuario->listarUsuarios();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Listar Dados</title>
</head>

<body>
    <h1>Listar Usuarios</h1>
    <table border="1" class="table tabela-alunos mt-3">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="aluno-list">
            <?php
            if (!empty($dados)) {
                foreach ($dados as $pessoa):
                    ?>
                    <tr>
                        <td><?php echo $pessoa['nome']; ?></td>
                        <td><?php echo $pessoa['email']; ?></td>
                        <td><?php echo $pessoa['telefone']; ?></td>
                        <td style="display:flex; flex-direction:row; gap:3px;">
                            <form action="excluirUsuario.php" method="post">
                                <input type="hidden" name="id_usuario" value="<?php echo $pessoa['id_usuario']; ?>">
                                <input type="submit" class='btn btn-danger btn-sm' value="Excluir">
                            </form>
                            <form action="editarUsuario.php" method="post">
                                <input type="hidden" name="id_usuario" value="<?php echo $pessoa['id_usuario'];?>">
                                <input type="submit" class='btn btn-warning btn-sm' value="Editar">
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