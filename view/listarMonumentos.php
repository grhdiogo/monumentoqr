<?php
include_once '../dao/conn.php'; 
include_once '../dao/monumentoDAO.php'; 
include_once '../controller/monumentoController.php';
include_once '../controller/loginController.php';

$loginController = new loginController();
$loginController->verificarSessao(); 
$monumentoDAO = new monumentoDAO;
$lista = $monumentoDAO->listarTodos();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Lista de Monumentos</title>
    </head>
    <body>
        <table border=1>
            <tr>   
                <th>Nome do Monumento</th>
                <th>Cidade do Monumento</th>
                <th>Editar Monumento</th>
                <th>Invalidar Monumento</th>
            </tr>
            <?php foreach ($lista as $item) { ?>
            <tr>
                <td> <?= $item->nome ?> </td>
                <td><?= $item->nomeCidade ?></td>
                <td><a href="pagEditar.php/?subjeto=editar&id=<?= $item->id ?>">Click </a></td>
                <td><a href="../controller/monumentoController.php/?subjeto=invalidar&id=<?= $item->id ?>">Click</a></td>
            </tr>
            <?php } ?>
        </table>
        <a href="home.php">Voltar a Página Inicial</a>
    </body>
</html>