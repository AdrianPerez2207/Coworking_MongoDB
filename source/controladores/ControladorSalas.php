<?php

    namespace Coworking\controladores;

    use Coworking\modelos\ModeloSalas;
    use Coworking\vistas\VistaSalas;
    use Coworking\vistas\VistaDetalles;

    class ControladorSalas{

        public static function mostrarSalas()
        {
            //Llamar al modelo para pedir las salas
            $salas = ModeloSalas::mostrarSalas();

            //Llamar al vista para mostrar las salas
            VistaSalas::render($salas);

        }

        public static function detallesSala($nombre){

            //Llamar al modelo para pedir los detalles de la sala
            $detalles = ModeloSalas::detallesSala($nombre);

            //Llamar al vista para mostrar los detalles de la sala
            VistaDetalles::render($detalles);
        }

        public static function buscarSala($NombreSala){
            //Llamar al modelo para buscar la sala
            $sala = ModeloSalas::buscarSala($NombreSala);

            //Si la sala existe, mostrar los detalles
            VistaSalas::render($sala);
        }
    }
