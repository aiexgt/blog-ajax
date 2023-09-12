<?php

session_start();
$user_id = $_SESSION['user_id'];

require_once("../config/database.php");
require_once("../helpers/response.php");

if (!isset($_POST['fnc']) ||  $_POST['fnc'] == '') {
    echo generarRespuesta('error', 'Ha ocurrido un error');
    die();
}

switch ($_POST['fnc']) {

    case "mostrar_usuarios":

        $query = "SELECT *
        FROM usuario u
        WHERE u.active = 1";

        if (isset($_POST['terminos']) && $_POST['terminos'] != '') {

            $terminos = $_POST['terminos'];
            $query .= " AND (u.nombre LIKE '%$terminos%' OR u.apellidos LIKE '%$terminos%')";
        }

        $query .= ' ORDER BY u.id ASC';

        $result = dbQuery($query);

        if (mysqli_num_rows($result) > 0) {

            $response = array();

            while ($row = mysqli_fetch_assoc($result)) {
                array_push($response, $row);
            }

            echo generarRespuesta('success', $response);
            die();
        } else {

            echo generarRespuesta('notfound', 'No se ha encontrado usuarios');
            die();
        }

        break;

    case "eliminar_usuario":

        if (isset($_POST['id']) && $_POST['id'] > 0) {

            $id = $_POST['id'];

            $query = "DELETE FROM usuario
            WHERE id = $id";

            $result = dbQuery($query);

            if ($result == 1) {

                echo generarRespuesta('success', "Operacion exitosa");
                die();
            } else {

                echo generarRespuesta('error', "Ha ocurrido un error");
                die();
            }
        } else {
            echo generarRespuesta('error', "No se ha encontrado el ID");
            die();
        }

        break;

    case "agregar_usuario":

        if (isset($_POST['nombre']) && isset($_POST['usuario']) && isset($_POST['password'])) {


            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $email = $_POST['email'];
            $usuario = $_POST['usuario'];
            $password = $_POST['password'];

            $query = "INSERT INTO usuario(nombre, apellidos, email, usuario, password, active)
            VALUES('$nombre', '$apellidos', '$email', '$usuario','$password', 1)";

            $result = dbQuery($query);

            if ($result == '1') {

                echo generarRespuesta('success', "Operacion Exitosa");
                die();
            } else {

                echo generarRespuesta('error', "Ha ocurrido un error");
                die();
            }
        } else {

            echo generarRespuesta('error', "Nombre, usuario y contraseña son obligatorios");
        }

        break;
}
