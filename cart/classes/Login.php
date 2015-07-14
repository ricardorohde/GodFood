<?php

class Login
{

    private $conexao = null;

    public function __construct()
    {
         if(!isset($_SESSION))
         {
             session_start();
         }

        if (isset($_GET["logout"])) {
            $this->logout();
        }

        elseif (isset($_POST["login"]) && isset($_POST['senha'])) {
            $this->login($_POST['login'],$_POST['senha']);
        }
    }

private function conexao()
{
        if ($this->conexao != null) {
            return true;
        } else {
            try {
                $dsn = 'mysql:host=localhost;dbname=u288492055_food;charset=utf8';
                $usuario = 'root';
                $pass = '';
                $this->conexao = new PDO($dsn, $usuario, $pass);
                return true;
            } catch (PDOException $e) {
                $_SESSION['erros'] = 'Erro ao Conectar-se ao Banco de Dados' . $e->getMessage();
            }
    }
    return false;
}


private function login($login,$senha)
{
        $login = $_POST['login'];
        $senha = sha1($_POST['senha']);
        $senha_hash = hash('sha512',$senha);

        if($this->conexao()){

        $sql = "SELECT id_usuario, login, senha, nome, usr_ativo, id_nivel FROM usuarios WHERE login = :login AND senha = :senha";

        $cmd = $this->conexao->prepare($sql);
        $cmd->bindParam('login',$login);
        $cmd->bindParam('senha',$senha_hash);
        $cmd->execute();

        $result = $cmd->fetch();
    }

        if($cmd->rowCount() == 1){
                $_SESSION['id_usuario'] = $result['id_usuario'];
        	    $_SESSION['login'] = $result['login'];
                $_SESSION['nome'] = $result['nome'];
                $_SESSION['login_status'] = 1;
                $_SESSION['id_nivel'] = $result['id_nivel'];
                $_SESSION['usr_ativo'] = $result['usr_ativo'];
        } else {
        	$_SESSION['erros'] = " Login e/ou senha invalidos";
            unset($_SESSION['login_status']);
        }
}

public function logout()
{
        unset($_SESSION['logado'],$_SESSION['login_status'],$_SESSION['id_usuario'],
            $_SESSION['login'],$_SESSION['email'],$_SESSION['usr_ativo']);
}

public function usuarioLogado()
{
        if (isset($_SESSION['login_status']) AND $_SESSION['login_status'] == 1
            && isset($_SESSION['usr_ativo']) AND $_SESSION['usr_ativo'] == 1
            && isset($_SESSION['id_nivel']) AND $_SESSION['id_nivel'] == 5) {
            return true;
            $_SESSION['msg_sucesso'] = "Logado com Sucesso.";
        } else if (isset($_SESSION['id_nivel']) AND $_SESSION['id_nivel'] < 5) {
            $_SESSION['mensagem'] = " Você não tem permissão para acessar esta pagina.";
        } else {
            return false;
        }
    }
}
