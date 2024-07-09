<?php

if($_SERVER["REQUEST_METHOD"] === "POST")
{

    $ruta = $_POST['ruta'];
    $ruta_completa = '../'.$ruta;

    $filename = $ruta_completa;

    if (file_exists($filename)) {
        $success = unlink($filename);
        $respuesta = array(
            'respuesta' => 'exito',
          );
        
        if (!$success) {
            $respuesta = array(
                'respuesta' => 'error'
              );
        }
    }

    die(json_encode($respuesta));


}
?>