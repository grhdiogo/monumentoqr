<?php
include_once 'monumentoController.php'; 
include_once '../dao/conn.php'; 
include_once '../dao/monumentoDAO.php'; 
include_once '../model/imagem.php'; 

class registrarImagens{
    function registra($arquivos,$id){
    $imagemDao = new imagemDao;
    $imagem = new Imagem;
    
 
    // total de arquivos enviados
    $total = count($arquivos['name']);
    for ($i = 0; $i < $total; $i++){
        
        $imagem->setNome($arquivos['name'][$i]);
        $imagem->setImagem($arquivos['tmp_name'][$i]);
        $imagem->setTamanho($arquivos['size'][$i]);
        $imagem->setTipo($arquivos['type'][$i]);
        $imagem->setId_Monumento($id);
        // - $arquivos['error'][$i]
        $imagemDao->inserir($imagem);

    }//fim do for
    }
}
?>