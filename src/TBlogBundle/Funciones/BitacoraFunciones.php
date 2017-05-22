<?php

namespace TBlogBundle\Funciones;

use TBlogBundle\Model\Model;

class BitacoraFunciones{

    public function InsertaBitacora($Usuarios_id, $accion, $detalle){
        $conn = new Model();
        $sql = "insert into sis_bitacora (numco, Bitacora_fchcrea, bitacora_accion, bitacora_detalle) values ($Usuarios_id, now(), '$accion', '$detalle');";
        $result = $conn->consulta($sql);
        $conn->close();
        return $result;
    }

    public function GetBitacoraxnombre($nombre){
        $conn = new Model();
        $sql  = "select * from sis_bitacora A inner join usuario B on (A.numco = B.numco) where B.nomusr like '%$nombre%';";
        $result = $conn->consulta($sql);
        $bitacora = array();
        while($row = $conn->fetch_assoc($result)){
            $bitacora[] = $row;
        }
        //print_r($clasificaciones);
        $conn->close();
        return $bitacora;
    }

    public function GetBitacora(){
        $conn = new Model();
        $sql  = "select * from sis_bitacora A inner join usuario B on (A.numco = B.numco);";
        $result = $conn->consulta($sql);
        $bitacora = array();
        while($row = $conn->fetch_assoc($result)){
            $bitacora[] = $row;
        }
        //print_r($clasificaciones);
        $conn->close();
        return $bitacora;
    }

}