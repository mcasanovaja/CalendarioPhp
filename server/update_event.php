<?php
 
require('./lib.php');
  session_start();
  //si se logeo el usuario
  if(isset($_SESSION['user'])){      
          //nos conectamos a la base de datos
         $con = new ConectorBD('localhost', 'user_calendar', 'Adario');
      	 $response['conexion'] = $con->initConexion('calendario');
        
		 if($response['conexion'] == 'OK'){ 	      
                 //capturamos el id del evento y toda la data
		        $id = $_POST['id']; 	        
           
		        $data['fechaIni'] = "'".$_POST['start_date']."'";
		        $data['fechaFin'] = "'".$_POST['end_date']."'";
		        $data['horaIni'] = "'".$_POST['start_hour']."'";
		        $data['horaFin'] = "'".$_POST['end_hour']."'";		            
		              
		            if($con->actualizarRegistro('evento', $data, 'id ="' .$id.'"')){
		        	   //si se actualizo
		        	   $response['msg'] = 'OK';
		        	   //$response['respuesta'] = $respuesta;
		        	   //$response['cont'] = $data;

		              }else{
		              	$response['msg'] = 'Error al actualizar el evento';
		              }  
		               
		      }else{ 
                   $response['msg']= "No se pudo conectar a la base de datos";             
		        }    

   }else{
   	$response['msg'] = 'No esta autorizado inicie session';
   }

  echo json_encode($response);


 ?>
