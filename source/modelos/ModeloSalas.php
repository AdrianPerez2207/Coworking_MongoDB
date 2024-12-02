<?php

    namespace Coworking\modelos;
    use MongoDB\BSON\Regex;

    class ModeloSalas{

        public static function mostrarSalas(){
            $conexion = new ConexionBD();
            //ConsultaMongoDB
            $consulta = $conexion->getConexion()->sala->find();
            //Cerramos sesión
            $conexion->cerrarSesion();
            //Generamos un array
            $array = $consulta->toArray();
            //Creamos un array de objetos vacío
            $salas = array();
            //Creamos objetos sala y los añadimos a nuestro array vacío
            foreach ($array as $objeto){
                $sala = new Sala($objeto->_id, $objeto->nombre, $objeto->capacidad, $objeto->ubicacion);
                $salas[] = $sala;
            }
            return $salas;
        }

        public static function detallesSala($nombre){
            $conexion = new ConexionBD();
            // Paso 1: Obtener el _id de la sala
            $sala = $conexion->getConexion()->sala->findOne(['nombre' => $nombre], ['projection' => ['_id' => 1]]);
            $id_sala = $sala->_id;

            // Paso 2: Buscar solo las reservas confirmadas para esa sala
            $reservas = $conexion->getConexion()->reserva->find([
                'id_sala' => $id_sala,
                'estado' => 'confirmada'
            ],
                //Ordenar los resultados por fecha_reserva (ascendente)
                [
                    "sort" => [
                        "fecha_reserva" => 1
                    ]
                ]);

            // Paso 3: Añadir a cada reserva información del usuario
            $resultado = [];
            foreach ($reservas as $reserva) {
                $usuario = $conexion->getConexion()->usuario->findOne(
                    ['_id' => $reserva['id_usuario']],
                    ['projection' => ['nombre' => 1]]
                );

                $resultado[] = new Reserva($reserva['_id'], $usuario->nombre, $nombre, $reserva['fecha_reserva'], $reserva['hora_inicio'], $reserva['hora_fin']);
            }
            return $resultado;
        }

        public static function buscarSala($NombreSala){
            $conexion = new ConexionBD();
            // Crear patrón de búsqueda con regex para "contiene"
            $regex = new Regex($NombreSala, 'i'); // 'i' para ignorar mayúsculas/minúsculas

            // Realizar la consulta
            $salas = $conexion->getConexion()->sala->find(['nombre' => $regex]);

            // Convertir resultados en objetos Sala
            $resultado = [];
            foreach ($salas as $sala) {
                $resultado[] = new Sala(
                    $sala['_id'], // Asumiendo que Sala tiene un constructor que acepta los campos
                    $sala['nombre'],
                    $sala['capacidad'],
                    $sala['ubicacion']
                );
            }

            return $resultado;
        }
    }
