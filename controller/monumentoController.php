<?php
include_once '../dao/conn.php'; 
include_once '../model/monumento.php';
include_once '../dao/monumentoDAO.php'; 
include_once '../registrarImagens.php';

$controller = new monumentoController;
if (!empty($_POST)) {
$metodo = $_POST['metodo'];
if($metodo == "inserir"){
    $controller->inserir();
}
if($metodo == "update"){
    $controller->updateMonumento();
}
if($metodo == "pesquisar"){
    $parametro = $_POT['parametro'];
    $valorDoParametro = $_POST['valorDoParametro'];
    $controller->pesquisarMonumentos($parametro,$valorDoParametro);
}

}


if (!empty($_GET)&!empty($_GET['subjeto'])) {
    $subjeto = $_GET['subjeto'];
    if($subjeto == "pesquisar"){
        $parametro = $_GET['parametro'];
        $valorDoParametro = $_GET['valorDoParametro'];
        $controller->pesquisarMonumentos($parametro,$valorDoParametro);
    }
    if($subjeto == "cidade"){
        $id = $_GET['id'];
        $controller->getCidade($id);
    }
    if($subjeto == "listarMonumento"){
        $id = $_GET['id'];
        $controller->carregarMonumento($id);
    }
    if($subjeto == "estados"){
        $controller->listarEstados();
    }
    if($subjeto == "estadosPorMonumento"){
        $controller->listarEstadosPorMonumento();
    }
    if($subjeto == "monumentoPorCidade"){
        $id = $_GET['id'];
        $controller->listarMonumentosPorCidade($id);
    }
    if($subjeto == "cidadePorMonumento"){
        $id = $_GET['id'];
        $controller->listarCidadesPorMonumento($id);
    }
    if($subjeto == "listarDiretorio"){
        $idEstado = $_GET['idEstado'];
        $idCidade = $_GET['idCidade'];
        $nome = $_GET['nome'];
        $controller->listarDiretorio($idEstado,$idCidade,$nome);
    }
    if($subjeto == "monumentoUnico"){
        $id = $_GET['id'];
        $controller->listarMonumentoPorId($id);
    }
    if($subjeto == "invalidar"){
        $id = $_GET['id'];
        $controller->invalidar($id);
    }
}


class monumentoController{

public function postInfo(){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $descricao = $_POST['descricao'];
    $idCidade = $_POST['cidade'];
    $modo = $_POST['modo'];
    $monumento = new Monumento;
    $monumento ->setId($id);
    $monumento ->setNome($nome);
    $monumento ->setRua($rua);
    $monumento ->setNumero($numero);
    $monumento ->setDescricao($descricao);
    $monumento ->setId_cidade($idCidade);
    $monumento ->setModo($modo);
    return $monumento;
}


public function inserir(){
$idEstado = $_POST['estado'];
$monumento = $this->postInfo();
$arquivos = $_FILES['arquivos'];
$monumentoDAO = new monumentoDAO;
$imagem = new registrarImagens;

    $imagem->registra($arquivos,$monumento,$idEstado);
    $monumentoDAO->inserirDAO($monumento);
    echo "Monumento cadastrado com sucesso!";
    echo "<a href='../view/cadastrar.php'>Clique aqui para realizar um novo cadastro</a><br>";

}//fim do metodo inserir

public function getCidade($id){
    $monumentoDAO = new monumentoDAO;
    $result = $monumentoDAO->retornaCidades($id);
    echo json_encode($result);

}//fim do metodo getCidade


public function updateMonumento(){
    $monumentoDAO = new monumentoDAO;
    $monumento = $this->postInfo();
    $monumentoDAO->updateMonumento($monumento);
    echo "Monumento editado com sucesso!";
    echo "<a href='../view/home.php'>Clique aqui para voltar</a><br>";

}// fim do update monumento

public function carregarMonumento($id){
    $monumentoDAO = new monumentoDAO;
    $return = $monumentoDAO->listarMonumento($id);
    return $return;
}//fim do carregarMonumento

public function listarEstados(){
    $monumentoDAO = new monumentoDAO;
    $result = $monumentoDAO->listarEstados();
    echo json_encode($result);
}//fim do listarEstados()

public function pesquisarMonumentos($parametro,$valorDoParametro){
    $monumentoDAO = new monumentoDAO;
    $result = $monumentoDAO->pesquisarMonumentos($parametro,$valorDoParametro);
    
        echo"<table border=1>";
            echo"<tr>";
            echo"<th>Nome do Monumento</th>";
            echo"<th>Cidade do Monumento</th>";
            echo"<th>Editar Monumento</th>";
            echo"<th>Invalidar Monumento</th>";
            echo"</tr>";
    foreach ($result as $item) {
            echo"<tr>";
            echo"<td>".$item->nome."</td>";
            echo"<td>".$item->nome."</td>";
            echo"<td>Nada</td>";
            echo"<td>Nada</td>";
            echo"</tr>";
        }
        echo"</table>";
        
        
}
public function invalidar($id){
    $monumentoDAO = new monumentoDAO;
    $monumentoDAO->invalidar($id);
    echo"<h3>Monumento Invalidado</h3>";
    header('location:../../view/home.php');
    

}


//---------------------------- MÉTODOS MOBILE ----------------------

public function listarMonumentosPorCidade($id){
    $monumentoDAO = new monumentoDAO;
    $result = $monumentoDAO->listarMonumentosPorCidade($id);
    echo json_encode($result);
}

public function listarEstadosPorMonumento(){
    $monumentoDAO = new monumentoDAO;
    $result = $monumentoDAO->listarEstadosPorMonumento();
    echo json_encode($result);
    
}

public function listarCidadesPorMonumento($id){
    $monumentoDAO = new monumentoDAO;
    $result = $monumentoDAO->listarCidadePorMonumento($id);
    echo json_encode($result);
}

public function listarDiretorio($idEstado,$idCidade,$nome){
    $diretorio = "https://monumentoqr.herokuapp.com/arquivos/$idEstado/$idCidade/$nome/*.*";
    $glob = glob($diretorio);
    $quantidade = count($glob);
    echo json_encode($quantidade);
}

public function listarMonumentoPorId($id){
    $monumentoDAO = new monumentoDAO;
    $result = $monumentoDAO->listarMonumento($id);
    echo json_encode($result);
}

}//fim da classe

?>