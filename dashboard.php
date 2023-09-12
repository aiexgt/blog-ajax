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

    <div class="modal fade" id="modal_agregar_articulo" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar artículos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="input_titulo" class="form-label">Título</label>
                                <input type="text" class="form-control" id="input_titulo" maxlength="300">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="input_descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="input_descripcion" rows="3"></textarea>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Imagen</label>
                                <input class="form-control" type="file" id="input_imagen" accept="image/png, image/gif, image/jpeg">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Archivo PDF</label>
                                <input class="form-control" type="file" id="input_pdf" accept="application/pdf">
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
        <div class="col-2">
            <small>Bienvenido, <?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellidos']?></small>
        </div>
        <div class="offset-6 col-4 text-end">
            <button class="btn btn-sm btn-outline-light" id="btn_blog">Ver Contenido</button>
            <button class="btn btn-sm btn-outline-light" id="btn_login">Cerrar Sesión</button>
        </div>
    </div>

    <div class="container mt-4 mb-4 p-4 rounded shadow bg-white">
        <div class="row mt-3 mb-3">
            <div class="offset-1 col-4">
                <div class="input-group">
                    <input type="text" class="form-control" id="input_termino" placeholder="Buscar algún artículo">
                    <button class="btn btn-danger bg-bac" type="button" id="btn_buscar">Buscar</button>
                </div>
            </div>
            <div class="col-3">
                <button class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#modal_agregar_articulo">Agregar Artículo</button>
            </div>
            <div class="col-3">
                <button class="btn btn-secondary w-100" id="btn_user">Administrar Usuarios</button>
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
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Archivo</th>
                            <th>Imagen</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="content_blog"></tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include('./components/footer/default.php') ?>
    <script src="./assets/js/dashboard-script.js"></script>
</body>

</html>