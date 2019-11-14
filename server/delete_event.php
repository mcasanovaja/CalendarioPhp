<?php

require('./lib.php');
  session_start();
  //si se logeo el usuario
  if(isset($_SESSION['user'])){      
          //nos conectamos a la base de datos
         $con = new ConectorBD('localhost', 'user_calendar', 'Adario');
      	 $response['conexion'] = $con->initConexion('calendario');
        
		 if($response['conexion'] == 'OK'){ 	      
                 //capturamos el id del evento para eliminar
		        $id = $_POST['id'];
		              
		            if($con->eliminarRegristro('evento', 'id ="' .$id.'"')){
		        	   //si se actualizo
		        	   $response['msg'] = 'OK';
		        	   //$response['respuesta'] = $respuesta;
		        	   //$response['cont'] = $data;

		              }else{
		              	$response['msg'] = 'Error al eliminar el evento';
		              }  
		               
		      }else{ 
                   $response['msg']= "No se pudo conectar a la base de datos";             
		        }    

   }else{
   	$response['msg'] = 'No esta autorizado inicie session';
   }

  echo json_encode($response);



 ?>
