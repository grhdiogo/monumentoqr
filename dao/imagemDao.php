<?php
include_once 'conn.php';
include_once '../model/imagem.php'; 


class imagemDao{

public function inserir(Imagem $imagem){
    try{
        $sql = "INSERT INTO imagens (nome_imagem,tamanho_imagem,tipo_imagem,imagem,id_monumento) 
        VALUES(:nome,:tamanho,:tipo,:imagem,:id_monumento)";
    
        $stmt=Database::getConnection()->prepare($sql);
    
        $stmt->bindValue(':nome', $imagem->getNome(), PDO::PARAM_STR);
        $stmt->bindValue(':tamanho', $imagem->getTamanho(), PDO::PARAM_STR);
        $stmt->bindValue(':tipo', $imagem->getTipo(), PDO::PARAM_STR);
        $stmt->bindValue(':imagem', $imagem->getImagem(), PDO::PARAM_STR);
        $stmt->bindValue(':id_monumento', $imagem->getId_Monumento(), PDO::PARAM_INT);
    
        $stmt->execute();
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }//fim do try


    }//fim do inserir

}//fim da classe
?>