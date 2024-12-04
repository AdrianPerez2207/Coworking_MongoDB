<?php

    namespace Coworking\modelos;

    class ModeloReservas{

        /**
         * Muestra todas las reservas que tiene el usuario.
         * Primero sacamos las reservas con el id del usuario, al tener que crear objetos reserva, tenemos que sacar el nombre del usuario,
         * y nombres de las salas asociadas a ese usuario.
         * @param $idUsuario
         * @return array
         */
        public static function mostrarMisReservas($idUsuario){
            $conexion = new ConexionBD();
            //Consulta MongoDB
            $stmt = $conexion->getConexion()->reserva->find(['id_usuario' => $idUsuario]);
            $nombreUsuario = $conexion->getConexion()->usuario->findOne(['_id' => $idUsuario], ['projection' => ['nombre' => 1]]);
            //Pasamos el resultado a objeto
            foreach ($stmt as $reserva){
                //Obtenemos el nombre de cada sala que tiene asociada la reserva.
                $nombreSalas = $conexion->getConexion()->sala->findOne(["_id" => $reserva["id_sala"]]);
                $reservaObjeto = new Reserva($reserva->_id, $nombreUsuario->nombre, $nombreSalas->nombre, $reserva->fecha_reserva, $reserva->hora_inicio, $reserva->hora_fin);
                $reservaObjeto->setEstado($reserva->estado);
                $reservaArray[] = $reservaObjeto;
            }
            //Cerramos sesión
            $conexion->cerrarSesion();
            return $reservaArray;
        }

        public static function cancelarReserva($idReserva, $idUsuario){
            $conexion = new ConexionBD();
            //Consulta a MongoDB
            var_dump($idReserva);
            var_dump($idUsuario);
            $conexion->getConexion()->reserva->updateOne(['_id' => $idReserva, 'id_usuario' => $idUsuario],
                ['$set' => ['estado' => 'cancelada']]);
            //Cerramos sesión
            $conexion->cerrarSesion();
        }

        /**
         * Para crear una reserva, primero se comprueba que no exista una reserva con la misma fecha y hora
         * Si no existe, se crea la reserva y se actualiza la tabla de reservas
         * Si ya existe, nos devolvería true
         * @param $id_sala
         * @param $id_usuario
         * @param $fecha_reserva
         * @param $hora_inicio
         * @param $hora_fin
         * @return bool
         */
        public static function crearReserva($id_usuario, $id_sala, $fecha_reserva, $hora_inicio, $hora_fin){
            $conexion = new ConexionBD();
            //Comprobamos que no exista una reserva con la misma fecha y hora
            if (!self::consultarReservas($id_sala, $fecha_reserva, $hora_inicio, $hora_fin)){
                return false;
            }else{
                //Consulta a la BD. Al insertar los datos, el estado de la reserva es confirmada por defecto.
                $stmt = $conexion->getConexion()->prepare("INSERT INTO reservas (id_usuario, id_sala, fecha_reserva, hora_inicio, hora_fin, estado) 
                                                        VALUES (:id_usuario, :id_sala, :fecha_reserva, :hora_inicio, :hora_fin, 'confirmada')");
                $stmt->bindValue(1, intval($id_usuario));
                $stmt->bindValue(2, intval($id_sala));
                $stmt->bindValue(3, $fecha_reserva);
                $stmt->bindValue(4, $hora_inicio);
                $stmt->bindValue(5, $hora_fin);
                //Ejecutamos la consulta
                $stmt->execute();
                //Cerrar la conexion
                $conexion->cerrarSesion();
                return true;
            }
        }

        /**
         * Consultamos que las horas de inicio y fin sean correctas y no hagan conflicto con otras insertadas
         * @param $id_sala
         * @param $fecha_reserva
         * @param $hora_inicio
         * @param $hora_fin
         * @return bool
         */
        public static function consultarReservas($id_sala, $fecha_reserva, $hora_inicio, $hora_fin){
            $conexion = new ConexionBD();
            //Consulta a la BD
            $stmt = $conexion->getConexion()->prepare("SELECT * FROM reservas WHERE id_sala = :id_sala AND 
                             fecha_reserva = :fecha_reserva AND estado = 'confirmada' AND (
                                 (:hora_inicio1 BETWEEN hora_inicio AND hora_fin) 
                                 OR (:hora_fin1 BETWEEN hora_inicio AND hora_fin)
                                 OR (hora_inicio BETWEEN :hora_inicio2 AND :hora_fin2)
                                 OR (hora_fin BETWEEN :hora_inicio3 AND :hora_fin3)
                             )");
            $stmt->bindValue(1, $id_sala);
            $stmt->bindValue(2, $fecha_reserva);
            $stmt->bindValue(3, $hora_inicio);//:hora_inicio1
            $stmt->bindValue(4, $hora_fin);//:hora_fin1
            $stmt->bindValue(5, $hora_inicio);//:hora_inicio2
            $stmt->bindValue(6, $hora_fin);//:hora_fin2
            $stmt->bindValue(7, $hora_inicio);//:hora_inicio3
            $stmt->bindValue(8, $hora_fin);//:hora_fin3
            //Ejecutamos la consulta
            $stmt->execute();
            //Cerramos sesión
            $conexion->cerrarSesion();
            //Devolvemos false si la consulta devuelve resultados, true en caso contrario
            if ($stmt->rowCount() > 0){
                return false;
            } else{
                return true;
            }
        }
    }
