<?php
require_once("./components/session/component.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard | KMS Operaciones</title>
    <?php include('./components/header/default.php') ?>
</head>

<body class="bg-body-secondary">

    <div class="modal fade" id="modal_agregar_usuario" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="input_nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="input_nombre" maxlength="100">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="input_apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="input_apellido" maxlength="100">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="input_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="input_email" maxlength="100">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="input_usuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="input_usuario" maxlength="10">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="input_password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="input_password" maxlength="20">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn_cerrar">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn_guardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row bg-bac p-1 ps-4 pe-4 text-white">
        <div class="offset-8 col-4 text-end">
            <button class="btn btn-sm btn-outline-light" id="btn_blog">Ver Contenido</button>
            <button class="btn btn-sm btn-outline-light" id="btn_login">Cerrar Sesión</button>
        </div>
    </div>

    <div class="container mt-4 mb-4 p-4 rounded shadow bg-white">
        <div class="row mt-3 mb-3">
            <div class="offset-1 col-4">
                <div class="input-group">
                    <input type="text" class="form-control" id="input_termino" placeholder="Buscar algún usuario">
                    <button class="btn btn-danger bg-bac" type="button" id="btn_buscar">Buscar</button>
                </div>
            </div>
            <div class="col-3">
                <button class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#modal_agregar_usuario">Agregar Usuario</button>
            </div>
            <div class="col-3">
                <button class="btn btn-secondary w-100" id="btn_articulos">Administrar Artículos</button>
            </div>
        </div>
    </div>

    <div class="container mt-4 mb-4 p-4 rounded shadow bg-white">
        <div class="row mt-3 mb-3">
            <div class="col">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Usuario</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="content_user"></tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include('./components/footer/default.php') ?>
    <script src="./assets/js/user-script.js"></script>
</body>

</html>