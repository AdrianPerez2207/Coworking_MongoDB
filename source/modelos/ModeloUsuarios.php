<?php

    namespace Coworking\modelos;

    class ModeloUsuarios{

        public static function getEmail($email){
            //Obtenemos la conexion
            $conexion = new ConexionBD();
            //Consulta MongoDB
            $usuarioJson = $conexion->getConexion()->usuario->findOne(['email' => $email]);
            $usuario = new Usuario($usuarioJson->_id, $usuarioJson->nombre, $usuarioJson->apellidos, $usuarioJson->email,
            $usuarioJson->password, $usuarioJson->telefono, $usuarioJson->fecha_creacion);
            //Cerrar la conexion
            $conexion->cerrarSesion();
            return $usuario;
        }

        public static function registrar($nombre, $apellidos, $email, $password, $telefono){
            //Conexion
            $conexion = new ConexionBD();
            //Consulta MongoDB
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $usuario = $conexion->getConexion()->usuario->insertOne(['nombre' => $nombre, 'apellidos' => $apellidos,
            'email' => $email, 'password' => $passwordHash, 'telefono' => $telefono, 'fecha_creacion' => date("Y-m-d")]);
            //Obtenedmos la _id insertada
            $id = $usuario->getInsertedId();
            //Cerramos sesión
            $conexion->cerrarSesion();
            //Devolvemos el id
            return $id;
        }
    }