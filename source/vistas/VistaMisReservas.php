<?php

namespace Coworking\vistas;

class VistaMisReservas  {

    public static function render($misReservas) {

        include("cabecera.php");
?>
        <main  class="p-3">
            <section class="p-3">
                <h1 class="h3 mb-5 fw-normal text-center">Mis Reservas</h1>
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th scope="col">Sala</th>
                        <th scope="col">Fecha de reserva</th>
                        <th scope="col">Hora de inicio</th>
                        <th scope="col">Hora de fin</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Cancelar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($misReservas as $reserva){
                            if ($reserva->getEstado() == "confirmada"){
                    ?>
                                <tr>
                                    <td><?=$reserva->getNombreSala(); ?></td>
                                    <td><?=$reserva->getFechaReserva(); ?></td>
                                    <td><?=$reserva->getHoraInicio(); ?></td>
                                    <td><?=$reserva->getHoraFin(); ?></td>
                                    <td><?=$reserva->getEstado(); ?></td>
                                    <td><a href="index.php?accion=cancelarReserva&id=<?=$reserva->getId(); ?>">
                                            <i class="fa-solid fa-ban fs-5 text-danger"></i></a>
                                    </td>
                                </tr>
                        <?php
                            } else{
                        ?>
                                <tr>
                                    <td><?=$reserva->getNombreSala(); ?></td>
                                    <td><?=$reserva->getFechaReserva(); ?></td>
                                    <td><?=$reserva->getHoraInicio(); ?></td>
                                    <td><?=$reserva->getHoraFin(); ?></td>
                                    <td><?=$reserva->getEstado(); ?></td>
                                    <td></td>
                                </tr>
                        <?php
                                }
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
