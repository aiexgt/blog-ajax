<?php

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

        if (
            isset($_POST['fecha_inicio']) && $_POST['fecha_inicio'] != ''
            && isset($_POST['fecha_fin']) && $_POST['fecha_fin'] != ''
        ) {

            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_fin = $_POST['fecha_fin'];
        } else {

            $fecha_inicio = date('Y-m-d', strtotime(date('Y-m-d') . "- 1 month"));
            $fecha_fin = date('Y-m-d');
        }

        $query .= " AND DATE(a.fecha_creacion) BETWEEN '$fecha_inicio' AND '$fecha_fin' 
         ORDER BY a.fecha_creacion DESC";
    
        $result = dbQuery($query);

        if(mysqli_num_rows($result) > 0){

            $response = array();

            while($row = mysqli_fetch_assoc($result)){
                array_push($response, $row);
            }

            echo generarRespuesta('success', $response);
            die();

        }else{

            echo generarRespuesta('notfound', 'No se ha encontrado artículos');
            die();
        }

        break;
}
