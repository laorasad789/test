<?php

namespace  TBlogBundle\Funciones;

use TBlogBundle\Model\Model;

class DefaultFunciones {
    
    public function validausr($numcon, $pass){
        $conn = new Model();
        $sql = "select * from usuario where numco = $numcon and pwd = '$pass' and activo = 1; ";
     
        //compara que los datos enviados se encuentren en la bd
        $result = $conn->consulta($sql);
        $row = $conn->fetch_assoc($result);
        $conn->close();
        return $row;
    }
     //Los parametros que son enviados 
    public function Registrarusuario($numcon , $email, $usuario, $pass){
        $conn = new Model();
        $sql = "insert into usuario (numco, usr, nomusr, pwd, tipousr, activo) values ('$numcon', '$email', '$usuario','$pass','u', 1);";

        $result = $conn->consulta($sql);
        $conn->close();
        return $result;
    }

    public function LlenarArticulos(){
        $conn = new Model();
        $sql = "select * from articulo";
        $result = $conn->consulta($sql);
        $articulo = array();
        while($row = $conn->fetch_assoc($result)){
            $articulo[] = $row;
        }

       
        $conn->close();
        return $articulo;
    }
}