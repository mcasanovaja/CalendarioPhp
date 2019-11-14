<?php 

class ConectorBD{
  private $host;
  private $user;
  private $password;
  private $conexion;

  function __construct($host, $user, $password){
      $this->host = $host;
      $this->user = $user;
      $this->password = $password;
    }

    function initConexion($nombre_db){
    $this->conexion = new mysqli($this->host, $this->user, $this->password, $nombre_db);
    if($this->conexion->connect_error){
      return "Error:" . $this->conexion->connect_error;
    }else{
      return "OK";
    } 
  } 

  function ejecutarQuery($query){
    return $this->conexion->query($query);
  }

  function cerrarConexion(){
    $this->conexion->close();
  }   

  function consultarQuery($tablas, $campos, $condicion){
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

      //echo  $sql;
      return $this->ejecutarQuery($sql);

    }

    function insertData($tabla, $data){
      $sql = 'INSERT INTO '.$tabla.' (';
      $i = 1;
      foreach ($data as $key => $value) {
        $sql .= $key;
        if ($i<count($data)) {
          $sql .= ', ';
        }else $sql .= ')';
        $i++;
      }
      $sql .= ' VALUES (';
      $i = 1;
      foreach ($data as $key => $value) {
        $sql .= $value;
        if ($i<count($data)) {
          $sql .= ', ';
        }else $sql .= ');';
        $i++;
      }
      return $this->ejecutarQuery($sql);

    }

    function actualizarRegistro($tabla, $data, $condicion){
    $sql = 'UPDATE '.$tabla.' SET ';
    $i = 1;
    foreach ($data as $key => $value) {
      $sql .= $key.'='.$value;
      if($i<sizeof($data)){
        $sql .= ', ';         
      }else $sql .= ' WHERE '.$condicion.';';
      $i++;
    }     
    return $this->ejecutarQuery($sql);
    //return $sql;
  }

  function eliminarRegristro($tabla, $condicion){
    $sql = 'DELETE FROM '.$tabla.' WHERE '.$condicion.';';
    //echo "Se eliminara ". $sql;
    return $this->ejecutarQuery($sql);
  }

  
  }
?>