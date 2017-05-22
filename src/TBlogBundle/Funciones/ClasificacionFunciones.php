<?php

namespace TBlogBundle\Funciones;

use TBlogBundle\Model\Model;

class ClasificacionFunciones{

    public function AgregaClasificacion($nombreclasificacion, $Usuarios_id){
        $conn = new Model();
        $sql = "Insert into clasificacion (nomcla, usr, fecha, activo) values ('$nombreclasificacion', $Usuarios_id, now(), 1);";
        $result = $conn->consulta($sql);
        $conn->close();
        return $result;
    }

    public function ModificarClasificacion($nombreclasificacion, $idclasificacion){
        $conn = new Model();
        $sql = "Update clasificacion set nomcla = '$nombreclasificacion' where idcla = $idclasificacion;";
        $result = $conn->consulta($sql);
        $conn->close();
        return $result;
    }

    public function GetClasificaciones(){
        $conn = new Model();
        $sql  = "Select * from clasificacion ORDER BY nomcla;";
        $result = $conn->consulta($sql);
        $clasificaciones = array();
        while($row = $conn->fetch_assoc($result)){
            $clasificaciones[] = $row;
        }
        //print_r($clasificaciones);
        $conn->close();
        return $clasificaciones;
    }

    public function GetClasificacionesactivas(){
        $conn = new Model();
        $sql  = "Select * from clasificacion where activo = 1 ORDER BY nomcla;";
        $result = $conn->consulta($sql);
        $clasificaciones = array();
        while($row = $conn->fetch_assoc($result)){
            $clasificaciones[] = $row;
        }
        //print_r($clasificaciones);
        $conn->close();
        return $clasificaciones;
    }

    public function ActDesClasificacion($idcategoria, $activo){
        $conn = new Model();
        $sql = "Update clasificacion set activo = $activo where idcla = $idcategoria;";
        $result = $conn->consulta($sql);
        $conn->close();
        return $result;
    }

}