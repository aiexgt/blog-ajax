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

    case "mostrar_articulos":

        $query = "SELECT a.*, u.nombre, u.apellidos 
        FROM articulo a 
        INNER JOIN usuario u ON u.id = a.usuario_id 
        WHERE a.active = 1";

        if (isset($_POST['terminos']) && $_POST['terminos'] != '') {

            $terminos = $_POST['terminos'];
            $query .= " AND (a.titulo LIKE '%$terminos%' OR a.descripcion LIKE '%$terminos%')";
        }

        $query .= ' ORDER BY a.fecha_creacion DESC';

        $result = dbQuery($query);

        if (mysqli_num_rows($result) > 0) {

            $response = array();

            while ($row = mysqli_fetch_assoc($result)) {
                array_push($response, $row);
            }

            echo generarRespuesta('success', $response);
            die();
        } else {

            echo generarRespuesta('notfound', 'No se ha encontrado artículos');
            die();
        }

        break;

    case "eliminar_articulo":

        if (isset($_POST['id']) && $_POST['id'] > 0) {

            $id = $_POST['id'];

            $query = "DELETE FROM articulo
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

    case "agregar_articulo":

        if (isset($_POST['titulo']) && isset($_FILES['pdf'])) {

            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $nuevo_nombre = date("Y-m-d_H-i-s");

            $nombre_pdf = $_FILES['pdf']['name'];
            $tipo_pdf = $_FILES['pdf']['type'];

            if ($tipo_pdf == "application/pdf") {

                if (move_uploaded_file($_FILES['pdf']['tmp_name'],  '../uploads/' . $nuevo_nombre . '.pdf')) {

                    $archivo = $nuevo_nombre . '.pdf';
                } else {

                    echo generarRespuesta('error', 'No se logro subir el archivo');
                    die();
                }
            } else {
                echo generarRespuesta('error', 'El tipo de archivo no es válido (Solo PDF)');
                die();
            }

            if (isset($_FILES['imagen'])) {
                $nombre_imagen = $_FILES['imagen']['name'];
                $tipo_imagen = $_FILES['imagen']['type'];

                if($tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen == "image/png"){

                    if (move_uploaded_file($_FILES['imagen']['tmp_name'],  '../uploads/' . $nuevo_nombre . '.jpg')) {

                        $imagen = $nuevo_nombre . '.jpg';
                    } else {
    
                        echo generarRespuesta('error', 'No se logro subir la imagen');
                        die();
                    }

                }else{
                    echo generarRespuesta('error', 'El tipo de archivo no es válido (Solo PNG, JPG, JPEG)');
                    die();
                }
            }else{
                $imagen = '';
            }

            $query = "INSERT INTO articulo(titulo, descripcion, imagen, archivo, fecha_creacion, usuario_id, active)
            VALUES('$titulo', '$descripcion', '$imagen', '$archivo', NOW(), '$user_id', 1)";

            $result = dbQuery($query);

            if($result == '1'){

                echo generarRespuesta('success', "Operacion Exitosa");
                die();

            }else{

                echo generarRespuesta('error', "Ha ocurrido un error");
                die();

            }
        } else {

            echo generarRespuesta('error', "Título y archivo PDF son obligatorios");
        }

        break;
}
