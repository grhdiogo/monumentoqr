<?php
include_once '../controller/loginController.php';

$loginController = new loginController();
$loginController->verificarSessao();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Página Inicial</title>
    </head>
    <body>
        <h1>Bem Vindo</h1><br>
        <a href="cadastrar.php">Cadastrar Monumento</a> <br>
        <a href="listarMonumentos.php">Listar Monumentos Ativos</a><br>
        <a href="pesquisarMonumento.php">Pesquisar Monumento</a><br>
        <form method="post" action="../controller/loginController.php">
        <input type="hidden" name="metodo" value="deslogar" />
        <input type="submit" value="Deslogar">
        </form>
    </body>
</html>