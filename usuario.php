<?php
    Class Usuario
    {
        private $pdo;

        public $msgErro = "";

        public function conectar($nome, $host, $usuario, $senha)
        {
            global $pdo;
            try
            {
                $pdo = new PDO("mysql:dbname=".$nome, $usuario, $senha);
            }
            catch(PDOException $erro)
            {
                $msgErro = $erro -> getMessage();
            }
        }

        public function cadastrar($nome, $telefone, $email, $senha)
        {
            global $pdo;

            $sql = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :m");

            $sql->bindValue(":m",$email);
            $sql->execute();

            if($sql->rowCount() > 0)
            {
                return false;
            }
            else
            {
                $sql = $pdo->prepare("INSERT INTO usuario (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
                $sql->bindValue(":n",$nome);
                $sql->bindValue(":t",$telefone);
                $sql->bindValue(":e",$email);
                $sql->bindValue(":s",md5($senha));
                $sql->execute();
                return true;
            }
        }
        public function logar($email, $senha)
        {
            global $pdo;

            $verificarEmail = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :e AND senha = :s");
            $verificarEmail->bindValue(":e",$email);
            $verificarEmail->bindValue(":s",md5($senha));
            $verificarEmail->execute();

            if($verificarEmail->rowCount()>0)
            {
                $dados = $verificarEmail->fetch();
                session_start();
                $_SESSION['id_usuario'] = $dados['id_usuario'];
                return true;
            }
            else
            {
                return false;
            }
        }
        public function listarUsuarios()
        {
            global $pdo;
            
            $sqlListar = $pdo->prepare("SELECT * FROM usuario");
            $sqlListar->execute();
            if($sqlListar->rowCount()>0)
            {
                $dados = $sqlListar->fetchAll(PDO::FETCH_ASSOC);
                return $dados;
            }
            else
            {
                return false;
            }
        }

        public function deletar(int $id)
        {
            global $pdo;

            $sql = $pdo->prepare("DELETE FROM usuario WHERE id_usuario = :i");
            $sql->bindValue(":i",$id);
            $sql->execute();
        }

        public function atualizar($id_usuario, $nome, $telefone, $email, $senha)
        {
            global $pdo;

            $sql = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :e AND id_usuario != :id");
            $sql->bindValue(":e", $email);
            $sql->bindValue(":id", $id_usuario);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                return false;
            } else {
                $sql = $pdo->prepare("UPDATE usuario SET nome = :n, telefone = :t, email = :e, senha = :s WHERE id_usuario = :id");
                $sql->bindValue(":id", $id_usuario);
                $sql->bindValue(":n", $nome);
                $sql->bindValue(":t", $telefone);
                $sql->bindValue(":e", $email);
                $sql->bindValue(":s", md5($senha));
                $sql->execute();
                return true;
            }
        }
    }
?>