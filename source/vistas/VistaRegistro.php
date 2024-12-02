<?php

    namespace Coworking\vistas;

    class VistaRegistro  {

        public static function render($error) {

            include("cabecera.php");
?>
            <main class="p-3">
                <?php
                //Si algo falla, muestra un mensaje de error
                if (strlen($error) > 0) {
                    echo "<p class='text-danger'>{$error}</p>";
                }
                ?>
                <form class="w-25 p-5 mb-5 bg-light rounded-3 m-auto d-grid gap-3" action="index.php" method="post">
                    <h1 class="h3 mb-3 fw-normal">Regístrate</h1>
                    <div class="form-floating">
                        <input name="nombre" type="text" class="form-control" id="floatingInput" placeholder="Adrián">
                        <label for="floatingInput">Nombre</label>
                    </div>
                    <div class="form-floating">
                        <input name="apellidos" type="text" class="form-control" id="floatingInput" placeholder="Pérez Sánchez">
                        <label for="floatingInput">Apellidos</label>
                    </div>
                    <div class="form-floating">
                        <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email</label>
                    </div>
                    <div class="form-floating">
                        <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Contraseña</label>
                    </div>
                    <div class="form-floating">
                        <input name="telefono" type="tel" class="form-control" id="floatingInput" placeholder="XXXXXXXXX">
                        <label for="floatingInput">Teléfono</label>
                    </div>

                    <div class="form-check text-start my-3">
                        <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Recordarme
                        </label>
                    </div>
                    <button class="btn btn-primary w-100 py-2" type="submit" name="registro">Regístrate</button>
                    <p class="mt-5 mb-3 text-body-secondary">© 2024</p>
                </form>
            </main>

<?php
            include('pie.php');
        }
    }
?>
