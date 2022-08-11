<?php
class AlumnosController{


    public function Error($e){
        header("HTTP/1.0 500");
        $json=array("message" => "¡Hubo un Error!","status"=>500,"data" => $e->getMessage());
        echo json_encode($json);
        return ;
    }

    public function index(){
        try{
            $alumnos=AlumnosModel::MostrarUsuariosRegistrados("ACTIVO",2);

            $json=array("message"=>"¡Operacion Exitosa!","status"=>200,"data"=> $alumnos);
            echo json_encode($json);
            return ;
        }
        catch(Exception $e){
          AlumnosController::Error($e);
        }
    
    }

    public function create($datos){

        try{
            //Verifica que el Usuario Se halla autenticado por el token 
            if(AlumnosModel::IsValidToken(Authorization::getAuthorization())){
                $alumnos=AlumnosModel::RegistrarUsuario($datos);
           
                if($alumnos[0]!="E"){
                    $json=array("message"=>"¡Operacion Exitosa!","status"=>200,"data"=> $alumnos);
                    echo json_encode($json);
                    return ;
                }
              else{
                header("HTTP/1.0 500 ");
                $json=array("message"=>"¡Hubo un Error!","status"=>500,"data"=> $alumnos);
                echo json_encode($json);
                return ;
              }
            }else{
                header("HTTP/1.0 401 Not Authorized ");
                echo "No tienes derecho ha acceder aqui";
            }
            
          
           
        }
        catch(Exception $e){
            AlumnosController::Error($e);
        }
        
       
    }

    public function show($id){

        try{
            if(AlumnosModel::IsValidToken(Authorization::getAuthorization())){
            $datos=AlumnosModel::MostrarUsuarioEspecifico($id["NumCuenta"]);
            
            $json=array("message"=>"¡Operacion Exitosa!","status"=>200,"data"=> $datos);
            echo json_encode($json);
            return ;
            }
            else{
                header("HTTP/1.0 401 Not Authorized ");
                echo "No tienes derecho ha acceder aqui";
            }

        }catch(Exception $e1){
            AlumnosController::Error($e1);
        }
       
    }
    public function login($datos){
        
        
        $datos=AlumnosModel::Login($datos);
            

    }
    public function update($id){

        try{
            if(AlumnosModel::IsValidToken(Authorization::getAuthorization())){
            $datos=AlumnosModel::ModificarUsuario($id);
            if($datos[0]!="E"){
            $json=array("message"=>"¡Operacion Exitosa!","status"=>200,"data"=> $datos);
            echo json_encode($json);
            return ;   
            }
            else{
                header("HTTP/1.0 500 ");
                $json=array("message"=>"¡Hubo un Error!","status"=>500,"data"=> $datos);
                echo json_encode($json);
                return ;
            }
        }else{
            header("HTTP/1.0 401 Not Authorized ");
            echo "No tienes derecho ha acceder aqui";
        }
        }

        catch(Exception $e1){
            AlumnosController::Error($e1);
        }
      
    }

    public function delete($id){

        try{
            if(AlumnosModel::IsValidToken(Authorization::getAuthorization())){
            $datos=AlumnosModel::DardeBajaEstudiante($id);
            if($datos[0]!="E"){
            $json=array("message"=>"¡Operacion Exitosa!","status"=>200,"data"=> $datos);
            echo json_encode($json);
            return ;
            }
            else{
                header("HTTP/1.0 500 ");
                $json=array("message"=>"¡Hubo un Error!","status"=>500,"data"=> $datos);
                echo json_encode($json);
                return ;
            }
        }
        else{
            header("HTTP/1.0 401 Not Authorized ");
            echo "No tienes derecho ha acceder aqui";
        }
    }

        catch(Exception $e1){

            AlumnosController::Error($e);
        }
     
    }

}
?>