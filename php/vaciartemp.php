<?php
    require_once "./php/main.php";

    $conexion=conexion();
    $conexion->query("TRUNCATE TABLE temp_producto");
?>