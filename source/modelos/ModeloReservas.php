<?php

    namespace Coworking\modelos;

    use MongoDB\BSON\ObjectId;

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
            $conexion->getConexion()->reserva->updateOne(['_id' => new ObjectId($idReserva), 'id_usuario' => $idUsuario],
                ['$set' => ['estado' => 'cancelada']]);
            //Cerramos sesión
            $conexion->cerrarSesion();
        }

        /**
         * @param $id_usuario
         * @param $id_sala
         * @param $fecha_reserva
         * @param $hora_inicio
         * @param $hora_fin
         * @return bool
         */
        public static function crearReserva($id_usuario, $id_sala, $fecha_reserva, $hora_inicio, $hora_fin)
        {
            $conexion = new ConexionBD();
            //Comprobamos que no exista una reserva con la misma fecha y hora
            if (!self::consultarReservas($id_sala, $fecha_reserva, $hora_inicio, $hora_fin)) {
                return false;
            } else {
                //Consulta a MongoDB
                $conexion->getConexion()->reserva->insertOne([
                    'id_usuario' => $id_usuario,
                    //Pasamos el id de la sala como un ObjectId (Estaba pasándolo cómo String)
                    'id_sala' => new ObjectId($id_sala),
                    'fecha_reserva' => $fecha_reserva,
                    'hora_inicio' => $hora_inicio,
                    'hora_fin' => $hora_fin,
                    'estado' => 'confirmada'
                ]);
                //Cerramos sesión
                $conexion->cerrarSesion();
                return true;
            }
        }

        /**
         * Consulta a la BD para ver si hay reservas en la misma hora que la solicitada
         * @param $id_sala
         * @param $fecha_reserva
         * @param $hora_inicio
         * @param $hora_fin
         * @return bool
         */
        public
        static function consultarReservas($id_sala, $fecha_reserva, $hora_inicio, $hora_fin)
        {
            $conexion = new ConexionBD();
            //Consulta MongoDB
            $stmt = $conexion->getConexion()->reserva->find([
                'id_sala' => $id_sala,
                'fecha_reserva' => $fecha_reserva,
                'estado' => 'confirmada',
                //Buscamos horas que coincida entre la hora de inicio y la hora de fin.
                '$or' => [
                    ['hora_inicio' => ['$gte' => $hora_inicio, '$lte' => $hora_fin]],
                    ['hora_fin' => ['$gte' => $hora_inicio, '$lte' => $hora_fin]],
                    ['hora_inicio' => ['$gte' => $hora_inicio, '$lte' => $hora_fin]],
                    ['hora_fin' => ['$gte' => $hora_inicio, '$lte' => $hora_fin]]
                ]
            ]);
            //Cerrar la conexion
            $conexion->cerrarSesion();
            //Devolvemos false si la consulta devuelve resultados, true en caso contrario
            //Con el count() se obtiene el numero de resultados
            if (count($stmt->toArray()) > 0) {
                return false;
            } else {
                return true;
            }
        }
    }
