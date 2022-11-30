<?php
	require_once "main.php";

	/*== Almacenando id ==*/
    $id=limpiar_cadena($_POST['provedor_id']);


    /*== Verificando producto ==*/
	$check_provedor=conexion();
	$check_provedor=$check_provedor->query("SELECT * FROM provedores WHERE provedor_id='$id'");

    if($check_provedor->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El personal no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_provedor->fetch();
    }
    $check_provedor=null;


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


    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}",$provedor)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El Nombre de Provedor no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    /*== Actualizando datos ==*/
    $actualizar_provedor=conexion();
    $actualizar_provedor=$actualizar_provedor->prepare("UPDATE provedores SET provedor_nombre=:nombre WHERE provedor_id=:id");

    $marcadores=[
        ":nombre"=>$provedor,
        ":id"=>$id
    ];


    if($actualizar_provedor->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡PROVEDOR ACTUALIZADO!</strong><br>
                El provedor se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el provedor, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_provedor=null;