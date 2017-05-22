<?php

namespace TBlogBundle\Model;

class Model {
    private $conexion;
    private $host;
    private $usuario;
    private $password;
    private $db;
    private $logs;
    private $sqlError;

    public function __construct(){
        $this->host = 'localhost';
        $this->usuario = 'root';
        $this->password = 'hola';
        $this->db = 'revista';
        if(!isset($this->conexion)){
            $this->conexion = (mysqli_connect($this->host, $this->usuario, $this->password, $this->db)) or die (mysqli_connect_error());
        }
    }

	function getConexion(){
		return $this->conexion;
	}

    public function consulta($consulta){
        $resultado = mysqli_query($this->conexion, $consulta) or die($this->setError( mysqli_errno( $this->conexion ), mysqli_error( $this->conexion ), $consulta));
        return $resultado;
    }

    public function fetch_array($consulta){
        if( !$consulta ){
            return 0;
        }
        return mysqli_fetch_array($consulta);
    }

    public function fetch_assoc($consulta){
        if( !$consulta ){
            return 0;
        }
        return mysqli_fetch_assoc($consulta);
    }

    public function num_rows($consulta){
        if( !$consulta ){
            return 0;
        }
        return mysqli_num_rows($consulta);
    }

    public function affected_rows(){
        return mysqli_affected_rows($this->conexion);
    }

    public function close(){
        mysqli_close($this->conexion);
    }

    public function insert_id(){
        return mysqli_insert_id($this->conexion);
    }

    public function setError($no_err,$err,$sq){
        $this->sqlError = " Error SQL: ".$no_err." -- ".$err.". En la sentencia: ".$sq;
        return $this->sqlError;
    }

    /*public function errores(){
        return $this->sqlError;
    }*/
}