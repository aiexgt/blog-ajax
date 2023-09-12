<?php

require_once("../config/database.php");
require_once("../helpers/response.php");

if (!isset($_POST['fnc']) ||  $_POST['fnc'] == '') {
    echo generarRespuesta('error', 'Ha ocurrido un error');
    die();
}

switch ($_POST['fnc']) {

    case "iniciar_sesion":

        if (
            isset($_POST['user']) && $_POST['user'] != ''
            && isset($_POST['pass']) && $_POST['pass'] != ''
        ) {

            $user = $_POST['user'];
            $pass = $_POST['pass'];

            $query = "SELECT * FROM usuario
            WHERE usuario = '$user' AND password = '$pass' AND active = 1
            LIMIT 1";

            $result = dbQuery($query);

            if(mysqli_num_rows($result) > 0){
                
                $row = mysqli_fetch_assoc($result);
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['usuario'] = $row['usuario'];
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['apellidos'] = $row['apellidos'];

                echo generarRespuesta('success', 'Inicio de sesión exitoso');
                die();

            }else{

                echo generarRespuesta('error','Credenciales incorrectas');
                die();
            }

        }

        break;
}
