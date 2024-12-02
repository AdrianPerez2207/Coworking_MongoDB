<?php

    namespace Coworking\modelos;

    use PDO;

    class ModeloReservas{
        /**
         * Muestra todas las reservas que tiene el usuario
         * Al hacer el SELECT, se le pone al nombre de la sala el mismo nombre que tiene en la tabla de la BD
         * @param $id
         * @return array|false
         */
        public static function mostrarMisReservas($id){
            $conexion = new ConexionBD();
            //Consulta a la BD
            $stmt = $conexion->getConexion()->prepare("SELECT r.id, s.nombre as nombre_sala, r.fecha_reserva, r.hora_inicio, r.hora_fin, r.estado
                                                        FROM reservas r JOIN salas s ON s.id = r.id_sala
                                                        WHERE r.id_usuario = :id ORDER BY r.estado");
            $stmt->bindValue(1, $id);
            //Cambiamos el modo en que nos devuelve el Fetch
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Coworking\modelos\Reserva');
            //Ejecutamos la consulta
            $stmt->execute();
            //Obtenemos el resultado
            $misReservas = $stmt->fetchAll();
            //Cerrar la conexion
            $conexion->cerrarSesion();
            return $misReservas;
        }

        public static function cancelarReserva($idUsuario, $idReserva){
            $conexion = new ConexionBD();
            //Consulta a la BD
            $stmt = $conexion->getConexion()->prepare("UPDATE reservas SET estado = 'cancelada' WHERE id = :idReserva
                                                    AND id_usuario = :idUsuario");
            $stmt->bindValue(1, $idReserva);
            $stmt->bindValue(2, $idUsuario);
            //Ejecutamos la consulta
            $stmt->execute();
            //Cerrar la conexion
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
