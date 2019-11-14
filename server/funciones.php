<?php 

class codigoDb{

	function __construct($host, $user, $password){
      $this->host = $host;
      $this->user = $user;
      $this->password = $password;
    }//fin de __construct

    function initConexion($nombre_db){
 		$this->conexion = new mysqli($this->host, $this->user, $this->password, $nombre_db);
 		if($this->conexion->connect_error){
 			return "Error:" . $this->conexion->connect_error;
 		}else{
 			return "OK";
 		} 
 	}//fin de initConexion 

 	function cerrarConexion(){
 		$this->conexion->close();
 	}//fin de cerrarConexion 
  
  function consultarQ($tablas, $campos, $condicion){
      $sql = "SELECT ";
      
      //agregamos todos los campos a nuestro sql
      $length_array = count($campos);
      $i = 1;
      foreach ($campos as $key => $value) {
        $sql .= $value;
        if ($i!= $length_array) {
          $sql .= ', ';
        }else {
          $sql .= ' FROM ';
        }
        $i++;
      }

      //agregamos todas las tablas a nuestro sql
      $length_array = count($tablas);
      $i = 1;
      foreach ($tablas as $key => $value) {
        $sql .= $value;
        if ($i!= $length_array) {
          $sql .= ', ';
        }else {
          $sql .= ' ';
        }
        $i++;
      }

      //agregamos la condicion en nuestro sql
      if($condicion == ""){
        $sql .= ';';
      }else{
        $sql .= $condicion.';';
      }

      return  $sql;
      //return $this->ejecutarQuery($sql);
  }//fin de consultarQ
}//fin de class codigoDb
?>