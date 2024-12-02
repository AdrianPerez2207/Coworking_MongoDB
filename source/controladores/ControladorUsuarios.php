<?php

    namespace Coworking\controladores;

    use Coworking\modelos\ModeloUsuarios;
    use Coworking\vistas\VistaLogin;
    use Coworking\vistas\VistaRegistro;


    class ControladorUsuarios{

        public static function registro($nombre, $apellidos, $email, $password, $telefono){
            //Verificamos que el email ya exista
            $usuario = ModeloUsuarios::getEmail($email);
            if($usuario != null){
                //Si el email ya existe, muestra un mensaje de error
                header("Location: index.php?accion=mostrarRegistro&error=El email ya existe");
            } else{
                //Si el email no existe, registramos el usuario y lo metemos en la sesión
                $id = ModeloUsuarios::registrar($nombre, $apellidos, $email, $password, $telefono);
                $_SESSION["usuario"] = ["email"=>$email,"id"=> $id];
                //Y redireccionamos al usuario
                header("Location: index.php?accion=mostrarSalas");
            }
        }
        public static function mostrarRegistro($error){
            VistaRegistro::render($error);
        }

        public static function login($email, $password){
            $usuario = ModeloUsuarios::getEmail($email);
            //Verificamos la contraseña
            if(password_verify($password, $usuario->getPassword())){
                //Si la contraseña es correcta, metemos al usuario en la sesión
                $_SESSION["usuario"] = ["email"=>$usuario->getEmail(),"id"=> $usuario->getId()];
                //Y redireccionamos al usuario
                header("Location: index.php?accion=mostrarSalas");
            } else{
                //Si la contraseña es incorrecta, muestra un mensaje de error
                self::mostrarLogin("Error Login");
            }
        }

        public static function mostrarLogin($error){
            VistaLogin::render($error);
        }
    }