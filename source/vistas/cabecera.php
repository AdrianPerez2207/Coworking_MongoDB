<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservas coworking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/8b30965d9a.js" crossorigin="anonymous"></script>
    <style>
        ul{
            list-style-type: none;
        }
    </style>
</head>
<body class="min-vh-100">
<header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between ">

            <h1>Coworking</h1>
            <?php
                    if (isset($_SESSION['usuario'])) {
                        echo ("<form class='col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 d-flex gap-2' role='search' action='index.php' method='post'>
                                    <input type='search' class='form-control' placeholder='Buscar sala...' aria-label='Search' name='buscarSalaNombre'>
                                    <button class='btn btn-primary' type='submit' name='buscarSala'>Buscar</button>
                                </form>");
                    } else{
                        echo ("<form class='col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 d-flex gap-2' role='search'>
                                    <input type='search' class='form-control' placeholder='Buscar sala...' aria-label='Search' disabled>
                                    <button class='btn btn-primary' type='submit' disabled>Buscar</button>
                                </form>");
                    }
            ?>

            <div class="dropdown text-end">
                <?php
                    if (isset($_SESSION['usuario'])) {
                        $email = $_SESSION['usuario']['email'];
                        echo("
                            <a href='#' class='d-block link-body-emphasis text-decoration-none dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                                <i class='fa-solid fa-user fs-4'></i><span class='ms-2 d-none d-lg-inline-block'>{$email}</span>
                            </a>
                            <ul class='dropdown-menu text-small'>
                                <li><a class='dropdown-item' href='index.php?accion=mostrarSalas'>Salas disponibles</a></li>
                                <li><a class='dropdown-item' href='index.php?accion=misReservas'>Mis reservas</a></li>
                                <li><hr class='dropdown-divider'></li>
                                <li><a class='dropdown-item' href='index.php?accion=cerrarSesion'>Cerrar sesión</a></li>
                            </ul>");
                    } else{
                        echo("
                            <a href='#' class='d-block link-body-emphasis text-decoration-none dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                                <i class='fa-solid fa-user fs-4'></i>
                            </a>
                            <ul class='dropdown-menu text-small'>
                                <li><a class='dropdown-item' href='index.php?accion=registro'>Regístrate</a></li>
                                <li><hr class='dropdown-divider'></li>
                                <li><a class='dropdown-item' href='index.php?accion=login'>Iniciar sesión</a></li>
                            </ul>");
                    }
                ?>
            </div>
        </div>
    </div>
</header>


