<?php

require('./lib.php');
  session_start();
  //si se logeo el usuario
  if(isset($_SESSION['user'])){      
          //nos conectamos a la base de datos
         $con = new ConectorBD('localhost', 'user_calendar', 'Adario');
      	 $response['conexion'] = $con->initConexion('calendario');
        
		 if($response['conexion'] == 'OK'){ 	      
                    //recuperamos el correo
		            $correo = $_SESSION['user'];              
		            //$correo = 'mcasanovaja@gmail.com';              
		              
		              $resultado = $con->consultarQuery(['evento'], ['id', 'titulo', 'fechaIni', 'fechaFin', 'horaIni', 'horaFin', 'todoDia', 'idUsuario'], 'WHERE idUsuario="' .$correo.'"');		              
		             
		             if($resultado->num_rows > 0){		               
		                 
		                  while ($fila = $resultado->fetch_assoc()) {
							        //aqui capturamos los datos
				                      $data[] = array(
				                           'id'  => $fila["id"],                           
				                           'title'  => $fila["titulo"],
				                           'start' => (bool)$fila["todoDia"]===false ? $fila["fechaIni"]. ' '. $fila["horaIni"] : $fila["fechaIni"],
				                           'end' => (bool)$fila["todoDia"]===false ? $fila["fechaFin"]. ' '. $fila["horaFin"] : $fila["fechaFin"],
				                           'allDay' => (bool)$fila["todoDia"]
				                        );
							    }		                      

		                             $response['msg'] = 'OK';
		                             $response['eventos'] = $data;
		                             $response['respuesta'] = '';
		                        
		                            
		                        $resultado->free();

		             }else{
		              $response['msg'] = 'OK';
		              $response['respuesta'] = 'Aun no se agrega ningun evento';
		             }
                    
		               
		      }else{ 
                   $response['msg']= "No se pudo conectar a la base de datos";             
		        } 
    

   }else{
   	$response['msg'] = 'No esta autorizado inicie session';
   }

  echo json_encode($response);

 ?>
