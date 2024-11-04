<?php
    require_once 'usuario.php';
    $usuario = new Usuario();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Cadastro</title>
</head>
<body>
    <h2>Cadastro de Usuario</h2><br>
    <form action="" method="post">
        <label>Nome:</label>
        <input type="text" name="nome" id=""placeholder="Nome Completo"><br>
        <label>Email:</label>
        <input type="email" name="email" id=""placeholder="Digite o email"><br>
        <label>Telefone:</label>
        <input type="tel" name="telefone" id=""placeholder="Telefone Completo"><br>
        <label>Senha:</label>
        <input type="password" name="senha" id=""placeholder="Digite sua Senha"><br>
        <label>Confirmar Senha:</label>
        <input type="password" name="confSenha" id=""placeholder="Confirme sua Senha"><br>
        
        <input type="submit" value="CADASTRAR">
    </form>


<?php

    if(isset($_POST['nome']))
    {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $senha = $_POST['senha'];
        $confSenha = addslashes($_POST['confSenha']);

        if(!empty($nome) && !empty($email) && !empty($telefone) && !empty($senha) && !empty($confSenha))
        {
            $usuario->conectar("cadastrousuarioturma33","localhost","root","");

            if($usuario->msgErro == "")
            {
                if($senha == $confSenha)
                {
                    if($usuario->cadastrar($nome, $telefone, $email, $senha))
                    {
                        ?>
                            <!-- bloco de HTML -->
                            <div class="msg-sucesso">
                                <p>Cadastrado com Sucesso</p>
                                <p>Clique <a href="login.php">aqui</a> para Logar</p>
                            </div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <div class="msg-erro">
                            <p>Email já Cadastrado!</p>
                        </div>
                    <?php
                    }
                }
                else
                {
                    ?>
                        <div class="msg-erro">
                            <p>Senha e Confirmar Senha não conferem.</p>
                        </div>
                    <?php
                }
            }
            else
            {
                ?>
                    <div class="msg-erro">
                        <?php echo "Erro: ".$usuario->msgErro;?>
                    </div>
                <?php
            }
        }
        else
        {
            ?>
                <div class="msg-erro">
                    <p>Preencha todos os campos!</p>
                </div>

            <?php
        }
    }
?>
</body>
</html>