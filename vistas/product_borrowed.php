<?php

date_default_timezone_set('America/Mexico_City');
$fecha=date('y/m/d h:i:s');

require_once "./php/main.php";

    echo $cantidad=$_POST['stock']."<br>";
    echo $fecha."<br>";
    echo $idusu=$_SESSION['id']."<br>";
    echo $prodid=$_POST['idprod']."<br>";
    echo $personal=$_POST['lista-personal']."<br>";
    echo $eco=$_POST['lista-unidad']."<br>";
    echo $obse=$_POST['obs']."<br>";
    $tipo="herramienta";

    for($i=0;$i<count($cantidad);$i++){
        echo "<br>".$i."; ".$cantidad[$i];
    }

    
    $conexion=conexion();
    $array_temp=$conexion->query("SELECT temp_idprod FROM temp_producto");
    $array_temp=$array_temp->fetchAll();
    for($j=0;$j<count($array_temp);$j++){
        echo "prueba<br>".$j."; ".$array_temp[$j];
    }
    // foreach($array_temp as $datos){
    //     $dato = $datos['temp_idprod'].",";
    //     echo $dato;
    // }

    $insertar_s=conexion();
    $insertar_s=$insertar_s->prepare("INSERT INTO salida_producto(salida_cantidad,salida_fecha,salida_usuid,salida_prodid,salida_personalid,salida_unidadid,salida_observaciones,salida_tipo) VALUES (:cantidad,:fecha,:usuario,:temp,:personal,:eco,:observaciones,:tipo)");

    $marcadores=[
        ":cantidad"=>$cantidad,
        ":fecha"=>$fecha,
        ":usuario"=>$idusu,
        ":temp"=>$dato,
        ":personal"=>$personal,
        ":eco"=>$eco,
        ":observaciones"=>$obse,
        ":tipo"=>$tipo
    ];

    $insertar_s->execute($marcadores);

    if($insertar_s->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡PRODUCTO REGISTRADO!</strong><br>
                El producto se registro con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo registrar el producto, por favor intente nuevamente
            </div>
        ';
    }



?>