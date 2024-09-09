<?php
  error_reporting(E_ERROR | E_PARSE | E_NOTICE);

  //Configuración de conexión a la Base de datos.

  $bd_client = 'DATABASE_NAME';
  $conn = new mysqli('DATABASE_URL', 'DATABASE_USER_NAME', 'DATABASE_USER_PASS', $bd_client);
  if ($conn->connect_error) {
    echo $error->$conn->connect_error;
  }
  
?>
