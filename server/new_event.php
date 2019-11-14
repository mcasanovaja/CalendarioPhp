<?php

  require('./lib.php'); 

  session_start();
  if(isset($_SESSION['user'])){

       //capturamos la data 
       $data['titulo'] = "'".$_POST['titulo']."'";
       $data['fechaIni'] = "'".$_POST['start_date']."'";
       $data['fechaFin'] = "'".$_POST['end_date']."'";
       $data['horaIni'] = "'".$_POST['start_hour']."'";
       $data['horaFin'] = "'".$_POST['end_hour']."'";
       $data['todoDia'] = "'".$_POST['allDay']."'";
       //$data['idUsuario'] = "'".$_POST['idCorreo']."'";
       $data['idUsuario'] = "'".$_SESSION['user']."'";
     //aqui me quede
     
     $con = new ConectorBD('localhost', 'user_calendar', 'Adario');
        $response['conexion'] = $con->initConexion('calendario');
        if($response['conexion'] == 'OK'){            

            if($con->insertData('evento', $data)){
                //$response['msg']="exito en la inserción";
                $response['msg']="OK";
            }else {
                $response['msg']= "Hubo un error y los datos no han sido cargados";
            }              
           
        }else {
           $response['msg']= "No se pudo conectar a la base de datos";
        }
        

  }else{
   	$response['msg'] = 'No esta autorizado inicie session';
   }

  echo json_encode($response);


 ?>
