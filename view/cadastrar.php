<?php
include_once '../dao/conn.php'; 
include_once '../dao/monumentoDAO.php'; 
include_once '../controller/loginController.php';

$loginController = new loginController();
$loginController->verificarSessao();
$monumentoDAO = new monumentoDAO;
$lista = $monumentoDAO->listarEstados();
?>
<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
        <title>Cadastrar Monumento</title>
        <style type="text/css">
			.carregando{
				color:#666;
				display:none;
			}
		</style>
    </head>
    <body>
        <h1>Cadastrar Novo Monumento</h1>
        <form action="../controller/monumentoController.php" method="post" enctype="multipart/form-data" id="formCadastro">
        <input type="hidden" name="metodo" value="inserir">
        <input type="hidden" name="modo" value="ativo">
        <input type="hidden" name="id" value="0">
        <label>Nome do Monumento: </label><input type="text" name="nome" required maxlength="30"/><br>
        <label>Estado: </label>
                        <select name="estado" id="estado" required>
                        <option value="" disabled selected>-- Escolha um Estado --</option>
                        <?php foreach ($lista as $estado) { ?>
                        <option value=<?= $estado->idEstado ?>><?= $estado->nomeEstado ?></option>
                        <?php } ?>
                        </select><br>
        
        <label>Cidade: </label>
        <span class="carregando">Aguarde, carregando...</span>
        <select id="cidade" name="cidade" >
        <option value="" disabled selected>-- Escolha uma Cidade --</option>
        </select><br>
        <label>Rua: </label><input type="text" name="rua" required maxlength="50"/><br>
        <label>Número: </label><input type="number" name="numero" maxlength="6" value="0"/><br>
		<label>Descrição: </label><input type="text" name="descricao" required maxlength="1000"/><br>
        <label>Fotos do Local: </label><input type="file" id="imagem" name="arquivos[]" multiple required accept="image/png, image/jpeg">
            <br>
            <button id="btEnviar">Enviar</button>
        </form>
        <a href="home.php">Voltar a Página Inicial</a>
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
        $("#btEnviar").click(function(){
         if($("#imagem")[0].files.length != 5) {
                   alert("You can select only 2 images");
         } else {
               $("formCadastro").submit();
         }
    });
        </script>
    </body>
</html>