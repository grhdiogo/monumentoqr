<?php
include_once 'controller/monumentoController.php'; 

class registrarImagens{
    function registra($arquivos,Monumento $monumento,$estado){
        $cidade = $monumento->getId_cidade();
        $nomeDoMonumento = $monumento->getNome();

       
        $diretorio = "https://monumentoqr.herokuapp.com/arquivos/";
        $diretorio .= "$estado";
        if (!file_exists($diretorio)) {
            mkdir("$diretorio" , 0777,true) or die("erro ao criar diretório1");
        }


        $diretorio = "https://monumentoqr.herokuapp.com/arquivos/";
        $diretorio .= "$estado/$cidade";
        if (!file_exists($diretorio)) {
            mkdir("$diretorio" , 0777) or die("erro ao criar diretório2");
        }

        $diretorio = "https://monumentoqr.herokuapp.com/arquivos/";
        $diretorio .= "$estado/$cidade/$nomeDoMonumento";
        if (!file_exists($diretorio)) {
            mkdir("$diretorio" , 0777) or die("erro ao criar diretório3");
        }else{
            die("<a href='../view/cadastrar.php'>Monumento já existente, tente de novo</a><br>");
        }

        $diretorio="https://monumentoqr.herokuapp.com/arquivos/";
// diretório de destino do arquivo
define('DEST_DIR', __DIR__ ."/". $diretorio);
 
     
    // cria uma variável para facilitar
    //
 
    // total de arquivos enviados
    $total = count($arquivos['name']);
 

    for ($i = 0; $i < $total; $i++)
    {
        // podemos acessar os dados de cada arquivo desta forma:
        // - $arquivos['name'][$i]
        // - $arquivos['tmp_name'][$i]
        // - $arquivos['size'][$i]
        // - $arquivos['error'][$i]
        // - $arquivos['type'][$i]
         
        if (!move_uploaded_file($arquivos['tmp_name'][$i], DEST_DIR . '/' . $i . '.jpg'))
        {
            die("Falha ao enviar a imagem");
        }
    }
    }
}
?>