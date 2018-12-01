<?php
include_once 'conn.php'; 
include_once '../model/login.php';

class loginDao{

   public function efetuarLogin(Login $login){
        $usuario = $login->getUsuario();
        $senha = $login->getSenha();
        $sql = "SELECT * FROM sessao 
        WHERE usuario = '$usuario' AND senha = '$senha'";
        $stmt=Database::getConnection()->prepare($sql);
        $stmt->execute();
        for ($i=0; $x =  $stmt->fetch(PDO::FETCH_OBJ) ; $i++) { 
            $result[$i]=$x;
        }
        return $result;

            
    }//fim do efetuarLogin
}
?>