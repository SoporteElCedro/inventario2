<?php
	require_once "../inc/session_start.php";

	require_once "main.php";

	/*== Almacenando datos ==*/
	$provedor=limpiar_cadena($_POST['provedor_nombre']);

	/*== Verificando campos obligatorios ==*/
    if($provedor==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}",$provedor)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El PROVEEDOR no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    /* Capturando Fecha */
    date_default_timezone_set('America/Mexico_City');
    $fecha=date('y/m/d h:i:s');

	/*== Guardando datos ==*/
    $guardar_provedor=conexion();
    $guardar_provedor=$guardar_provedor->prepare("INSERT INTO provedores(provedor_nombre,provedor_fechar,usuario_id) VALUES(:nombre,:fechar,:usuario)");

    $marcadores=[
        ":nombre"=>$provedor,
        ":fechar"=>$fecha,
        ":usuario"=>$_SESSION['id']
    ];

    $guardar_provedor->execute($marcadores);

    if($guardar_provedor->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡PERSONAL REGISTRADO!</strong><br>
                El personal se registro con exito
            </div>
        ';
    }else{

        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo registrar el personal, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_provedor=null;