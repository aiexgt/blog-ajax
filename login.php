<?php

session_start();
session_destroy();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | KMS Operaciones</title>
    <?php include('./components/header/default.php') ?>
    <link rel="stylesheet" href="./assets/custom/login-style.css">
</head>

<body class="bg-body-secondary">
    <div class="row bg-bac p-1 ps-4 pe-4 text-white">
        <div class="offset-10 col-2 text-end">
            <button class="btn btn-sm btn-outline-light" id="btn_operaciones">Operaciones</button>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card px-5 py-5" id="form1">
                    <div class="form-data">
                        <img src="./assets/img/logo_bac.png" style="width:70%;margin-left:15%;" class="mt-4 mb-4">
                        <div class="forms-inputs mb-4"> <span>Usuario</span>
                            <input autocomplete="off" type="text" id="input_user">
                        </div>
                        <div class="forms-inputs mb-4"> <span>Contraseña</span>
                            <input autocomplete="off" type="password" id="input_pass">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-login btn-danger bg-bac w-100" id="btn_login">Iniciar Sesión</buttonclass=>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('./components/footer/default.php') ?>
    <script src="./assets/js/login-script.js"></script>
</body>

</html>