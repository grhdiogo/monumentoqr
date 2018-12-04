<?php
class Imagem{
    private $id;
    private $nome;
    private $tipo;
    private $tamanho;
    private $imagem;
    private $id_monumento;

    function setId($id) { $this->id = $id; }
    function getId() { return $this->id; } 
    function setNome($nome) { $this->nome = $nome; }
    function getNome() { return $this->nome; }  
    function setTipo($tipo) { $this->tipo = $tipo; }
    function getTipo() { return $this->tipo; }
    function setTamanho($tamanho) { $this->tamanho = $tamanho; }
    function getTamanho() { return $this->v; } 
    function setImagem($imagem) { $this->imagem = $imagem; }
    function getImagem() { return $this->imagem; } 
    function setId_Monumento($id_monumento) { $this->id_monumento = $id_monumento; }
    function getId_Monumento() { return $this->id_monumento; }   
}
?>