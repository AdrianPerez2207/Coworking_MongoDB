<?php

namespace Coworking\controladores;

use Coworking\modelos\ModeloReservas;
use Coworking\vistas\VistaReservas;
use Coworking\vistas\VistaMisReservas;

class ControladorReservas{

    public static function mostrarReservas($error){
        VistaReservas::render($error);
    }

    public static function mostrarMisReservas($id){
        VistaMisReservas::render(ModeloReservas::mostrarMisReservas($id));
    }

    public static function cancelarReserva($idReserva, $idUsuario){
        ModeloReservas::cancelarReserva($idUsuario, $idReserva);
        header("Location: index.php?accion=misReservas");
    }

    public static function crearReserva($id_usuario, $id_sala, $fecha_reserva, $hora_inicio, $hora_fin){
        if (ModeloReservas::crearReserva($id_usuario, $id_sala, $fecha_reserva, $hora_inicio, $hora_fin)){
            header("Location: index.php?accion=misReservas");
        }else{
            VistaReservas::render("Error al crear la reserva");
        }
    }

}