<?php
include_once '../dao/conn.php'; 
include_once '../dao/monumentoDAO.php'; 
include_once '../controller/monumentoController.php';
include_once '../controller/loginController.php';

$loginController = new loginController();
$loginController->verificarSessao(); 
$id = $_GET['id'];
$controller = new monumentoController;
$monumentoDAO = new monumentoDAO;
$lista = $monumentoDAO->listarEstados();
$monumento = $controller->carregarMonumento($id);
?>
<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
        <title>Editar Monumento</title>
    </head>
    <body>
        <h1>Editar Monumento</h1>
        <form action="../../controller/monumentoController.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="metodo" value="update">
        <input type="hidden" name="modo" value="ativo">
        <input type="hidden" name="id" value=<?=$monumento->id ?>>
        <label>Nome do Monumento: </label><input type="text" name="nome" required maxlength="30" value="<?=$monumento->nome ?>"/><br>
        <label>Estado:</label>
                        <select name="estado" id="estado">
                        <option value="" ><?= $monumento->nomeEstado ?></option> 
                        <?php foreach ($lista as $estado) { ?>
                        <option value=<?= $estado->idEstado ?>><?= $estado->nomeEstado ?></option>
                        <?php } ?>
                        </select><br>
        
        <label>Cidade: </label>
        <select id="cidade" name="cidade" >
        <option value="<?= $monumento->id_cidade?>"><?= $monumento->nomeCidade ?></option>
        </select><br>
        <label>Rua: </label><input type="text" name="rua" required maxlength="50" value="<?=$monumento->rua ?>" /><br>
        <label>Número: </label><input type="number" name="numero" maxlength="6" value="<?=$monumento->numero ?>"/><br>
		<label>Descrição: </label><input type="text" name="descricao" required maxlength="1000" value="<?=$monumento->descricao ?>"/><br>
        <label>Fotos do Local: </label><input type="file" name="arquivos[]" multiple required accept="image/png, image/jpeg">
            <br>
            <input type="submit" value="Enviar">
        </form>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">
           $(function(){
			$('#estado').change(function(){
				if( $(this).val() ) {
                    $('#cidade').hide();
                    $('.carregando').show();
					$.getJSON('../controller/monumentoController.php/?subjeto=cidade',{id: $(this).val(), ajax: 'true'}, function(j){
						var options ;	
						for (var i = 0; i < j.length; i++) {
                            options += '<option value="' + j[i].idCidade + '">' + j[i].nomeCidade + '</option>';
                        }
                        $('#cidade').html(options).show();
                        $('.carregando').hide();
					});
				} else {
					$('#cidade').html('<option value="">– Escolha um estado –</option>');
				}
			});
		});
        </script>
        <a href="../home.php">Voltar a Página Inicial</a>
    </body>
</html>