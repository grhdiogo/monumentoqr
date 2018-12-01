<?php
include_once '../controller/loginController.php';

$loginController = new loginController();
$loginController->verificarSessao();
?>
<!DOCTYPE html>
<html>
    <head><meta charset="utf-8"> 
        <title></title>
    </head>
    <body>
        <div>
            <form action="../controller/monumentoController.php" method="post">
                <input type="hidden" name="metodo" value="pesquisar">
                <h1>Pesquisar Monumento</h1>
                <label>Pesquisar por: </label><select name="parametro" required>
                    <option value="" disabled selected>-- Escolha uma Opção --</option>
                    <option value="id" >Id</option>
                    <option value="nome" >Nome</option>
                    <option value="nomeCidade" >Cidade</option>
                    <option value="nomeEstado" >Estado</option>
                </select>
                <input type="text" name="valorDoParametro" required/>
                <input type="submit" id="btEnviar"/>
            </form>
        </div>
        <div id="corpo">
                
        </div>
        <a href="home.php">Voltar a Página Inicial</a>
     
        
    </body>
    
</html>