<?php

function generarRespuesta($status, $message)
{
    return json_encode(array("status" => $status, "message" => $message));
}
