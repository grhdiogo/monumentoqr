<?php 
include_once '../dao/conn.php'; 
include_once '../model/login.php';
include_once '../dao/loginDao.php'; 

$controller = new loginController;
if (!empty($_POST)) {
    $metodo = $_POST['metodo'];
    if($metodo == "logar"){
        $controller->logar();
    }
    if($metodo == "deslogar"){
        $controller->deslogar();
    }
}


class loginController{
    public function logar(){
    $loginDAO = new loginDAO;
    $login = new Login;
    session_start();

    $usuario = $_POST['login'];
$senha = $_POST['senha'];

$login->setUsuario($usuario);
$login->setSenha($senha);

$result = $loginDAO->efetuarLogin($login);

if($result == true ) {
    $_SESSION['usuario'] = $usuario;
    $_SESSION['senha'] = $senha;
    header('location:../view/home.php');
}else{
    unset ($_SESSION['usuario']);
    unset ($_SESSION['senha']);
    header('location:../index.html');
    echo"<p>Login ou Senha Invalidos</p>";
} 
}//fim do logar

    public function verificarSessao(){
        session_start();
        if((!isset ($_SESSION['usuario']) == true) and (!isset ($_SESSION['senha']) == true)){
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        header('location:../index.html');
        }
    }//fim do verificarSessao();


    public function deslogar(){
            session_start();
            session_destroy();
            header('location:../index.html');
    }//fim do deslogar
}


?>