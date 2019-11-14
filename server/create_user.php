<?php
  
  //include('lib.php'); 
  require('./lib.php'); 
 
  $data['nombres'] = "'".$_POST['nombres']."'";
  $data['apellidos'] = "'".$_POST['apellidos']."'";
  $data['correo'] = "'".$_POST['correo']."'";  

  //encriptamos la contraceña
   $data['password'] = "'". password_hash($_POST['password'], PASSWORD_DEFAULT)."'";

  $con = new ConectorBD('localhost', 'user_calendar', 'Adario');  
  $response['conexion'] = $con->initConexion('calendario');
   
   
  if ($response['conexion']=='OK') {
  	
    if($con->insertData('usuarios', $data)){
      $response['msg']="exito en la inserción";
    }else {
      $response['msg']= "Hubo un error y los datos no han sido cargados";
    } 
      
 
  }else {
    $response['msg']= "No se pudo conectar a la base de datos";
  }

  echo json_encode($response);


 ?>
