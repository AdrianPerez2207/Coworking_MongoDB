<?php

    namespace Coworking\vistas;
    class VistaSalas  {

    public static function render($salas):void {

            include("cabecera.php");
?>
    <main class="p-3">
        <h1 class="h3 mb-5 fw-normal text-center">Salas Disponibles</h1>
        <section class="p-3">
            <table class="table text-center">
                <thead>
                <tr>
                    <th scope="col">Salas</th>
                    <th scope="col">Capacidad</th>
                    <th scope="col">Ubicación</th>
                    <th scope="col">Reservar</th>
                    <th scope="col">Detalles</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($salas as $sala){

                ?>
                        <tr>
                            <td><?=$sala->getNombre(); ?></td>
                            <td><?=$sala->getCapacidad(); ?></td>
                            <td><?=$sala->getUbicacion(); ?></td>
                            <td><a href="index.php?accion=reservar&nombre=<?=$sala->getNombre(); ?>&id_sala=<?=$sala->getId(); ?>">
                                    <i class="fa-solid fa-registered fs-4"></i></a>
                            <td><a href="index.php?accion=detalles&nombre=<?=$sala->getNombre(); ?>">
                                    <i class="fa-solid fa-eye fs-4"></i></i></a>
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
