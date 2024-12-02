<?php

namespace Coworking\vistas;

class VistaDetalles  {

    public static function render($detalles) {

        include("cabecera.php");
?>
        <main  class="p-3">
            <section class="p-3">
                <h1 class="h3 mb-5 fw-normal text-center">Detalles de la sala <?=$_GET['nombre']; ?></h1>
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th scope="col">Usuario</th>
                        <th scope="col">Fecha de reserva</th>
                        <th scope="col">Hora de inicio</th>
                        <th scope="col">Hora de fin</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($detalles as $detalle){

                            ?>
                            <tr>
                                <td><?=$detalle->getNombreUsuario(); ?></td>
                                <td><?=$detalle->getFechaReserva(); ?></td>
                                <td><?=$detalle->getHoraInicio(); ?></td>
                                <td><?=$detalle->getHoraFin(); ?></td>
                            </tr>
                            <?php
                        }
                    ?>
                    </tbody>
                </table>
            </section>
        </main>
<?php
        include('pie.php');
        }
    }
?>
