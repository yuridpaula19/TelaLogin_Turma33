<?php
    require_once 'usuario.php';
    $usuario = new Usuario();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tela Login</title>
</head>
<body>
    <h1 class="text-center mb-4">Tela Login</h1><br><br>
    <form method="post" class="bg-light p-5 rounded shadow">
        <label class="form-label">Usuario:</label>
        <input type="email" name="email" class="form-control" id=""placeholder="Digite seu e-mail."><br><br>
        <label class="form-label">Senha:</label>
        <input type="password" name="senha" class="form-control" id=""placeholder="Digite sua senha"><br><br>

        <input type="submit" value="LOGAR" class="btn btn-primary w-100"><br><br>
        <a href="cadastro.php" class="btn btn-primary w-100" style="background-color: green; border:none;">INSCREVA-SE</a>
    </form>

    <?php
        if(isset($_POST['email']))
        {
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);

            if(!empty($email) && !empty($senha))
            {
                $usuario->conectar("cadastrousuarioturma33","localhost","root","");
                if($usuario->msgErro == "")
                {
                    if($usuario->logar($email,$senha))
                    {
                        header("location: areaRestrita.php");
                    }
                    else
                    {
                        ?>
                            <div class="msg-erro">
                                <p>Email e/ou Senha Incorretos.</p>
                            </div>
                        <?php
                    }
                }
                else
                {
                    ?>
                        <div class="msg-erro">
                            <?php echo "Erro" . $usuario->msgErro;?>
                        </div>

                    <?php
                }
            }
            else
            {
                ?>
                    <div class="msg-erro">
                        <p>Preencha Todos os Campos</p>
                    </div>
                <?php
            }
        }
    ?>

</body>
</html>