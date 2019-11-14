<?php
  
  require('./lib.php');  

  $correo = $_POST['correo'];
  $password = $_POST['password'];

      $con = new ConectorBD('localhost', 'user_calendar', 'Adario');
        $response['conexion'] = $con->initConexion('calendario');

        if($response['conexion'] == 'OK'){ 

           $resultado = $con->consultarQuery(['usuarios'], ['nombres', 'apellidos', 'correo', 'password'], 'WHERE correo="' .$correo.'"');

            if($resultado->num_rows > 0){
              //aqui verificamos que el passwor sea correcto
              $fila = $resultado->fetch_assoc();
              if (password_verify($password, $fila['password'])) {
                         $response['msg'] = 'OK';
                         $response['data'] = $fila['password'];
                         //se inicia la session
                         session_start();
                         $_SESSION['user'] = $correo;
                    }else {
                        $response['msg'] = 'La contraseña no es válida.';
                    } 

                    $resultado->free();
                
             }else{

              $response['msg'] = 'El correo no existe';
             }


        }else {
           $response['msg']= "No se pudo conectar a la base de datos";
        }

         echo json_encode($response); 

 ?>
