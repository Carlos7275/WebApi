<?php
require_once "Connection.php";
require_once "./libraries/src/JWT.php";

use Firebase\JWT\JWT; //Usa el Namespace del Archivo JWT
class AlumnosModel{
    //Muestra todos los Registros de dicha tabla
    static public function index($tabla){
        $stmt=Connection::connect()->prepare("SELECT * FROM $tabla");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
        $stmt->close();
        $stmt=null;
    }   

    //Muestra a los Usuarios Registrados de Acuerdo a su Estatus y Rol
    static  public function MostrarUsuariosRegistrados($estatus="",$Rol=""){
        $stmt=Connection::connect()->prepare("SELECT usuarios.NumCuenta,Nombres,ApellidoPaterno,ApellidoMaterno,Correo,Telefono,Domicilio,CodigoPostal,AfiliacionImss,Discapacidad,ID_ROL,Estatus FROM usuarios inner join Datos_usuario on usuarios.NumCuenta=Datos_usuario.NumCuenta  and id_rol=$Rol");


        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
        $stmt->close();
        $stmt=null;

    }
//Mostrar Usuario Especifico
    static  public function MostrarUsuarioEspecifico($id){
        $stmt=Connection::connect()->prepare("SELECT usuarios.NumCuenta,Nombres,ApellidoPaterno,ApellidoMaterno,Correo,Telefono,Domicilio,CodigoPostal,AfiliacionImss,Discapacidad,ID_ROL,Estatus FROM usuarios inner join Datos_usuario on usuarios.NumCuenta=Datos_usuario.NumCuenta  where  usuarios.NumCuenta=$id");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->close();
        $stmt=null;

    }

    //Funcion para RegistrarUsuario

    static public function RegistrarUsuario($data){
        
        try{
       
            $stmt=Connection::connect()->prepare("insert into usuarios values (:numCuenta,:Pass,:IdRol,'ACTIVO')");
            $pass=hash("sha512",$data["Password"]);
            $stmt->bindParam(":numCuenta",$data["NumeroCuenta"]);
          
            $stmt->bindParam(":Pass",$pass);
            $stmt->bindParam(":IdRol",$data["Id_Rol"]);

            $stmt->execute();
            $stmt=null;


            $stmt=Connection::connect()->prepare("insert into datos_usuario values (:numCuenta,:Nombres,:ApellidoPat,:ApellidoMat,:Domicilio,:Correo,:Telefono,:CodigoPostal,:Curp,:Discapacidad,:AfiliacionImss)");
            $stmt->bindParam(":numCuenta",$data["NumeroCuenta"]);
            $stmt->bindParam(":Nombres",$data["Nombres"]);
            $stmt->bindParam(":ApellidoPat",$data["ApellidoPaterno"]);
            $stmt->bindParam(":ApellidoMat",$data["ApellidoMaterno"]);
            $stmt->bindParam(":Correo",$data["Correo"]);
            $stmt->bindParam(":Domicilio",$data["Domicilio"]);
            $stmt->bindParam(":Telefono",$data["Telefono"]);
            $stmt->bindParam(":CodigoPostal",$data["CodigoPostal"]);
            $stmt->bindParam(":Curp",$data["Curp"]);
            $stmt->bindParam(":Discapacidad",$data["Discapacidad"]);
            $stmt->bindParam(":AfiliacionImss",$data["Afiliacion_IMSS"]);

            $stmt->execute();
       
            return "Se registro correctamente el Usuario!";
        }
        catch(Exception $e1){
            return "Error:".$e1->getMessage();

        }
      

    }

    static public function ModificarUsuario($data){
        
        try{
       
            $stmt=Connection::connect()->prepare("update usuarios set Estatus=:Estatus where NumCuenta=:numCuenta");
            $stmt->bindParam(":numCuenta",$data["NumeroCuenta"]);
            $stmt->bindParam(":Estatus",$data["Estatus"]);
            $stmt->execute();
            $stmt=null;


            $stmt=Connection::connect()->prepare("update  datos_usuario set Nombres=:Nombres,ApellidoPaterno=:ApellidoPat,ApellidoMaterno=:ApellidoMat,Domicilio=:Domicilio,Correo=:Correo,Telefono=:Telefono,CodigoPostal=:CodigoPostal,Curp=:Curp,Discapacidad=:Discapacidad,AfiliacionIMSS=:AfiliacionImss where NumCuenta=:numCuenta");
            $stmt->bindParam(":numCuenta",$data["NumeroCuenta"]);
            $stmt->bindParam(":Nombres",$data["Nombres"]);
            $stmt->bindParam(":ApellidoPat",$data["ApellidoPaterno"]);
            $stmt->bindParam(":ApellidoMat",$data["ApellidoMaterno"]);
            $stmt->bindParam(":Correo",$data["Correo"]);
            $stmt->bindParam(":Domicilio",$data["Domicilio"]);
            $stmt->bindParam(":Telefono",$data["Telefono"]);
            $stmt->bindParam(":CodigoPostal",$data["CodigoPostal"]);
            $stmt->bindParam(":Curp",$data["Curp"]);
            $stmt->bindParam(":Discapacidad",$data["Discapacidad"]);
            $stmt->bindParam(":AfiliacionImss",$data["Afiliacion_IMSS"]);

            $stmt->execute();
       
            return "Se Modifico correctamente el Usuario!";
        }
        catch(Exception $e1){
            return "Error:".$e1->getMessage();

        }
      

    }
//  
    static public function Login($datos){
        //Comprobar si existe el Numero de Cuenta y Password
        try{
            if(isset($datos["NumCuenta"]) && isset($datos["Password"])){
                $pass=hash("sha512",$datos["Password"]);
                $stmt=Connection::connect()->prepare("select * from usuarios where NumCuenta=:numCuenta and Password=:Password");
                $stmt->bindParam(":numCuenta",$datos["NumCuenta"]);
                $stmt->bindParam(":Password",$pass);
                $stmt->execute();
                

                if($stmt->rowCount()>0){
                    
                    if(!AlumnosModel::ExisteToken($datos["NumCuenta"])){
                      
                        $datos=AlumnosModel::MostrarUsuarioEspecifico($datos["NumCuenta"]);
                        $json=array("message"=>"¡Operacion Exitosa!","status"=>200,"data"=> AlumnosModel::InsertarToken($datos));
                        echo json_encode($json);
                    }
                    else{
                    
                        $datos=AlumnosModel::MostrarUsuarioEspecifico($datos["NumCuenta"]);
                        $json=array("message"=>"¡Operacion Exitosa!","status"=>200,"data"=> AlumnosModel::ActualizarToken($datos));
                        echo json_encode($json);
                    }

                   
               
                
                }   
                else{
                    header("HTTP/1.0 401 Not Authorized ");
                    echo "El Numero de Cuenta o la Contraseña no Coinciden!";
                }
            }
            else{
                header("HTTP/1.0 401 Not Authorized ");
                echo "No deje los Campos Vacios!";
            }
    
        }catch(Exception $e1){
            return "Error".$e1->getMessage();
        }
        

    }

    static public function ExisteToken($datos){
        try{

            $stmt=Connection::connect()->prepare("select Token from usuarios_token where NumCuenta=:NumCuenta and Estatus='ACTIVO'");
            $stmt->bindParam(":NumCuenta",$datos);
            $stmt->execute();
            
            if($stmt->rowCount()>0){
 
           return true;

            }
            else{
                return false;
            }
        }catch(Exception $e1){
            return "Error".$e1->getMessage();
        }

    }

    static public function IsValidToken($datos){
        try{

            $stmt=Connection::connect()->prepare("select * from usuarios_token where Token=:Token and Estatus='ACTIVO'");
            $stmt->bindParam(":Token",$datos);
            $stmt->execute();
            
            if($stmt->rowCount()>0){
              
            
                return true;

            }
            else{
   
                return false;
            }
        }catch(Exception $e1){
            return "Error".$e1->getMessage();
        }

    }
    static public function ActualizarToken($datos){
        try{
            
            $time=time();
            $token=array("message"=>"¡Operacion con Exito!","status"=>200,"data"=>
            $datos);
            $jwt=JWT::encode($token,'68V0zWFrS72GbpPreidkQFLfj4v9m3Ti+DXc8OB0gcM=',"HS256");
    
            
            $stmt=Connection::connect()->prepare("update usuarios_token set NumCuenta=:numCuenta,Token=:token,Estatus='ACTIVO' where NumCuenta=:numCuenta");
            $stmt->bindParam(":numCuenta",$datos["NumCuenta"]);
            $stmt->bindParam(":token",$jwt);
            $stmt->execute();
            return $jwt;
        }
        catch(Exception $e1){
            return "Error:".$e1->getMessage();
        }
    }

        static public function InsertarToken($datos){
            try{
                
                $time=time();
                $token=array("message"=>"¡Operacion con Exito!","status"=>200,"data"=>
                $datos);
                $jwt=JWT::encode($token,'68V0zWFrS72GbpPreidkQFLfj4v9m3Ti+DXc8OB0gcM=',"HS256");
        
    
                $stmt=Connection::connect()->prepare("insert into  usuarios_token values(:numCuenta,:token,'ACTIVO',default)");
                $stmt->bindParam(":numCuenta",$datos["NumCuenta"]);
                $stmt->bindParam(":token",$jwt);
                $stmt->execute();
                return $jwt;
            }
            catch(Exception $e1){
                return "Error:".$e1->getMessage();
            }
    

    }
    //Da de Baja a un Estudiante de Acuerdo a su Numero de Cuenta
    static public function DardeBajaEstudiante($id){
        
        try{
            $stmt=Connection::connect()->prepare("update usuarios set Estatus='BAJA' where NumCuenta=:numCuenta");
            $stmt->bindParam(":numCuenta",$id["NumeroCuenta"]);
  
             $stmt->execute();

         return "Se dio de baja al Usuario:".$id["NumeroCuenta"];
        }catch(Exception $e1){
            return "Error:".$e1->getMessage();
        }


    
        
    }
   
    
}


?>