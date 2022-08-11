<?php
$arrayRutas = explode("/",$_SERVER["REQUEST_URI"]); //Separa la ruta actual y lo guarda en un array


if(count(array_filter($arrayRutas))==1){ //Caso que no exista una ruta
    echo "Ruta no Encontrada";
     return;

}
else{
 //Sin Parametros
    if(count(array_filter($arrayRutas))==2)
    {
     
        if(array_filter($arrayRutas)[2]=="?u=ObtenerAlumnos"){
            //Post en Alumnos
            if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"]=="POST"){
                 $objAlumnos= new AlumnosController();
                 $objAlumnos->index();   
            }
          
            
              
    }
    else if(array_filter($arrayRutas)[2]=="?u=RegistrarAlumno"){
                
        if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"]=="POST"){
         
            $json = file_get_contents('php://input');

          
            $datosArray = json_decode($json,true);
            $objAlumnos= new AlumnosController();
            $objAlumnos->create($datosArray);   
       }

    }
    else if(array_filter($arrayRutas)[2]=="?u=ModificarAlumnoEspecifico"){
          if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"]=="PUT"){
            $objAlumnos= new AlumnosController();
            $json = file_get_contents('php://input');
            $datosArray = json_decode($json,true);
            $objAlumnos->update($datosArray);
      
      }

    }
    else if(array_filter($arrayRutas)[2]=="?u=ObtenerAlumnoEspecifico"){
        if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"]=="POST"){
            $json = file_get_contents('php://input');
            $datosArray = json_decode($json,true);
            $objAlumnos= new AlumnosController();
            $objAlumnos->show($datosArray);
    
    }
    }
    else if(array_filter($arrayRutas)[2]=="?u=EliminarAlumnoEspecifico"){
    if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"]=="DELETE"){
        $json = file_get_contents('php://input');        
        $datosArray = json_decode($json,true);
        $objAlumnos= new AlumnosController();
        $objAlumnos->delete($datosArray);
    
    }
}

    else if(array_filter($arrayRutas)[2]=="?u=IniciarSesion"){
        if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"]=="POST"){
            $json = file_get_contents('php://input');        
            $datosArray = json_decode($json,true);
            $objAlumnos= new AlumnosController();
            $objAlumnos->login($datosArray);
        
        }
}
  else{
    echo "No existe la ruta especifica!";
  }
        }

    }

    




?>