<?php
class Monumento{
    private $id;
    private $nome;
    private $rua;
    private $numero;
    private $descricao;
    private $id_cidade;
    private $modo;
    
    function setId($id) { $this->id = $id; }
    function getId() { return $this->id; }
    function setNome($nome) { $this->nome = $nome; }
    function getNome() { return $this->nome; }
    function setRua($rua) { $this->rua = $rua; }
    function getRua() { return $this->rua; }
    function setNumero($numero) { $this->numero = $numero; }
    function getNumero() { return $this->numero; }
    function setDescricao($descricao) { $this->descricao = $descricao; }
    function getDescricao() { return $this->descricao; }
    function setId_cidade($id_cidade) { $this->id_cidade = $id_cidade; }
    function getId_cidade() { return $this->id_cidade; }
    function setModo($modo) { $this->modo = $modo; }
    function getModo() { return $this->modo; }
    
}

?>