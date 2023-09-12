<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home | KMS Operaciones</title>
    <?php include('./components/header/default.php') ?>
</head>

<body class="bg-body-secondary">

    <div class="row bg-bac p-1 ps-4 pe-4 text-white">
        <div class="offset-10 col-2 text-end">
            <button class="btn btn-sm btn-outline-light" id="btn_login">Iniciar Sesión</button>
        </div>
    </div>

    <div class="container mt-4 mb-4 p-4 rounded shadow bg-white">
        <div class="row mt-3">
            <div class="offset-1 col-4">
                <input type="text" class="form-control" id="input_termino" placeholder="Buscar algún artículo">
            </div>
            <div class="col-5">
                <div class="input-group mb-3">
                    <input type="date" class="form-control" id="input_fecha_inicio" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d') . "- 1 month")); ?>">
                    <span class="input-group-text">-</span>
                    <input type="date" class="form-control" id="input_fecha_fin" value="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>
            <div class="col-1">
                <button class="btn btn-danger bg-bac" id="btn_buscar">Buscar</button>
            </div>
        </div>
    </div>

    <div id="content_blog"></div>

    <?php include('./components/footer/default.php') ?>
    <script src="./assets/js/index-script.js"></script>
</body>

</html>