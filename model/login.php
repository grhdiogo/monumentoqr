<?php
class Login{
    private $id;
    private $usuario;
    private $senha;
    
    function setId($id) { $this->id = $id; }
    function getId() { return $this->id; }
    function setUsuario($usuario) { $this->usuario = $usuario; }
    function getUsuario() { return $this->usuario; }
    function setSenha($senha) { $this->senha = $senha; }
    function getSenha() { return $this->senha; }
   
    
}

?>