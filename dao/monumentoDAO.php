<?php
include_once 'conn.php'; 
include_once '../model/monumento.php';

class monumentoDAO{
public function inserirDAO(Monumento $monumento){
 
    try{
    $sql = "INSERT INTO monumento (nome,rua,numero,descricao,id_cidade,modo) 
    VALUES(:nome,:rua,:numero,:descricao,:id_cidade,:modo)";

    $stmt=Database::getConnection()->prepare($sql);

    $stmt->bindValue(':nome', $monumento->getNome(), PDO::PARAM_STR);
    $stmt->bindValue(':rua', $monumento->getRua(), PDO::PARAM_STR);
    $stmt->bindValue(':numero', $monumento->getNumero(), PDO::PARAM_INT);
    $stmt->bindValue(':descricao', $monumento->getDescricao(), PDO::PARAM_STR);
    $stmt->bindValue(':id_cidade', $monumento->getId_cidade(), PDO::PARAM_INT);
    $stmt->bindValue(':modo', $monumento->getModo());

    $stmt->execute();
} catch (PDOException $erro) {
    echo "Erro: " . $erro->getMessage();
}
}//fim do inserir

public function listarEstados(){
    $sql = "SELECT * FROM tb_estados";
    $stmt=Database::getConnection()->prepare($sql);
    $stmt->execute();

    for ($i=0; $x =  $stmt->fetch(PDO::FETCH_OBJ) ; $i++) { 
     $result[$i]=$x;
    }
    return $result;
}//fim do listarEstados

public function retornaCidades($id){
    $sql = "SELECT * FROM tb_cidades WHERE estado = $id";
    $stmt=Database::getConnection()->prepare($sql);
    $stmt->execute();
    for ($i=0; $x =  $stmt->fetch(PDO::FETCH_OBJ) ; $i++) { 
        $result[$i]=$x;
    }
    return $result;

}//fim do retornaCidades

public function listarTodos(){
    $sql = "SELECT id,nome,nomeCidade FROM monumento MO 
    INNER JOIN tb_cidades CI ON MO.id_cidade=CI.idCidade
    WHERE modo = 'ativo' ORDER BY nome ASC ";
    $stmt=Database::getConnection()->prepare($sql);
    $stmt->execute();
    for ($i=0; $x =  $stmt->fetch(PDO::FETCH_OBJ) ; $i++) { 
        $result[$i]=$x;
    }
    return $result;
}//fim do listarTodos

public function updateMonumento(Monumento $monumento){
    try{
    $sql = "UPDATE monumento 
    SET nome=:nome,rua=:rua,numero=:numero,descricao=:descricao,id_cidade=:id_cidade,modo=:modo
    WHERE id = :id";
    $stmt=Database::getConnection()->prepare($sql);
    $stmt->bindValue(':nome', $monumento->getNome(), PDO::PARAM_STR);
    $stmt->bindValue(':rua', $monumento->getRua(), PDO::PARAM_STR);
    $stmt->bindValue(':numero', $monumento->getNumero(), PDO::PARAM_INT);
    $stmt->bindValue(':descricao', $monumento->getDescricao(), PDO::PARAM_STR);
    $stmt->bindValue(':id_cidade', $monumento->getId_cidade(), PDO::PARAM_INT);
    $stmt->bindValue(':modo', $monumento->getModo(), PDO::PARAM_STR);
    $stmt->bindValue(':id', $monumento->getId(), PDO::PARAM_INT);
    $stmt->execute();
} catch (PDOException $erro) {
    echo "Erro: " . $erro->getMessage();
}
}//fim do update monumento

public function listarMonumento($id){
    $sql = "SELECT id,nome,rua,numero,descricao,id_cidade,nomeCidade,nomeEstado,idCidade,idEstado FROM monumento MO
    INNER JOIN tb_cidades CI ON MO.id_cidade = CI.idCidade 
    INNER JOIN tb_estados ES ON CI.estado = ES.idEstado
    WHERE id = $id ";
    $stmt=Database::getConnection()->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_OBJ);
    
    return $result;
}//fim do listar monumento;

public function pesquisarMonumentos($parametro,$valorDoParametro){
    $sql = "SELECT id,nome,rua,numero,descricao,id_cidade,nomeCidade,nomeEstado,idCidade,idEstado FROM monumento MO
    INNER JOIN tb_cidades CI ON MO.id_cidade = CI.idCidade 
    INNER JOIN tb_estados ES ON CI.estado = ES.idEstado
    WHERE $parametro = '$valorDoParametro' ";
    $stmt=Database::getConnection()->prepare($sql);
    $stmt->execute();

    for ($i=0; $x =  $stmt->fetch(PDO::FETCH_OBJ) ; $i++) { 
        $result[$i]=$x;
    }
    
    return $result;
}

public function invalidar($id){
    $sql = "UPDATE monumento SET modo='invalido' where id = $id";
    $stmt=Database::getConnection()->prepare($sql);
    $stmt->execute();
}





//---------------------------- MÉTODOS MOBILE ----------------------




public function listarMonumentosPorCidade($id){
    $sql = "SELECT * FROM monumento MO
    INNER JOIN tb_cidades CI ON MO.id_cidade = CI.idCidade
    INNER JOIN tb_estados ES ON CI.estado = ES.idEstado
    WHERE id_cidade = $id AND modo = 'ativo'";
    $stmt=Database::getConnection()->prepare($sql);
    $stmt->execute();

    for ($i=0; $x =  $stmt->fetch(PDO::FETCH_OBJ) ; $i++) { 
        $result[$i]=$x;
    }
    
    return $result;
}//fim do listarMonumentoPorCidade

public function listarEstadosPorMonumento(){
    $sql = "SELECT DISTINCT nomeEstado,idEstado FROM tb_estados ES
        INNER JOIN tb_cidades CI ON CI.estado = ES.idEstado
        INNER JOIN  monumento MO ON MO.id_cidade = CI.idCidade";
    $stmt=Database::getConnection()->prepare($sql);
    $stmt->execute();

    for ($i=0; $x =  $stmt->fetch(PDO::FETCH_OBJ) ; $i++) { 
     $result[$i]=$x;
    }
    return $result;
}


public function listarCidadePorMonumento($id){
    $sql = "SELECT DISTINCT nomeCidade,idCidade FROM tb_cidades CI
        INNER JOIN tb_estados ES ON CI.estado = ES.idEstado
        INNER JOIN  monumento MO ON MO.id_cidade = CI.idCidade WHERE estado=$id";
    $stmt=Database::getConnection()->prepare($sql);
    $stmt->execute();

    for ($i=0; $x =  $stmt->fetch(PDO::FETCH_OBJ) ; $i++) { 
     $result[$i]=$x;
    }
    return $result;
}
public function verificarExistencia($id){
    $sql = "SELECT id FROM monumento WHERE id = $id ";
    $stmt=Database::getConnection()->prepare($sql);
    $stmt->execute();

    $result =   $stmt->fetch(PDO::FETCH_OBJ); 
    return $result;
}

public function pegarUltimoId(){
    $sql = "SELECT id FROM monumento order by id DESC limit 1";
    $stmt=Database::getConnection()->prepare($sql);
    $stmt->execute();

    for ($i=0; $x =  $stmt->fetch(PDO::FETCH_OBJ) ; $i++) { 
     $result[$i]=$x->id;
    }
    return $result[0];
}
public function recuperarImagem($id){
    $sql = "SELECT * FROM imagens WHERE id_monumento =$id";
    $stmt=Database::getConnection()->prepare($sql);
    $stmt->execute();

    
    for ($i=0; $x =  $stmt->fetch(PDO::FETCH_OBJ) ; $i++) { 
    $result[$i]=$x;
    $result[$i]->imagem = base64_encode($x->imagem);
    //echo '<img src="data:'.$x->tipo_imagem.';base64,'.base64_encode($x->imagem).'" height="100" width="100"/>';
    }
    
     
    return $result;
}



}//fim da classe
?>