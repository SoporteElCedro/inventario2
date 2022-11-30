<?php
	require_once "main.php";

	/*== Almacenando id ==*/
    $id=limpiar_cadena($_POST['personal_id']);


    /*== Verificando producto ==*/
	$check_personal=conexion();
	$check_personal=$check_personal->query("SELECT * FROM personal WHERE personal_id='$id'");

    if($check_personal->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El personal no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_personal->fetch();
    }
    $check_personal=null;


    /*== Almacenando datos ==*/
    $paterno=limpiar_cadena($_POST['personal_paterno']);
	$nombre=limpiar_cadena($_POST['personal_nombre']);

	$materno=limpiar_cadena($_POST['personal_materno']);
	$puesto=limpiar_cadena($_POST['personal_puesto']);
	//$categoria=limpiar_cadena($_POST['producto_categoria']);


	/*== Verificando campos obligatorios ==*/
    if($paterno=="" || $nombre=="" || $materno=="" || $puesto==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}",$paterno)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El Apellido Paterno no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}",$puesto)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El Puesto no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}",$materno)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El Apellido Materno no coincide con el formato solicitado
            </div>
        ';
        exit();
    }


    // /*== Verificando codigo ==*/
    // if($codigo!=$datos['producto_codigo']){
	//     $check_codigo=conexion();
	//     $check_codigo=$check_codigo->query("SELECT producto_codigo FROM producto WHERE producto_codigo='$codigo'");
	//     if($check_codigo->rowCount()>0){
	//         echo '
	//             <div class="notification is-danger is-light">
	//                 <strong>¡Ocurrio un error inesperado!</strong><br>
	//                 El CODIGO de BARRAS ingresado ya se encuentra registrado, por favor elija otro
	//             </div>
	//         ';
	//         exit();
	//     }
	//     $check_codigo=null;
    // }


    // /*== Verificando nombre ==*/
    // if($nombre!=$datos['producto_nombre']){
	//     $check_nombre=conexion();
	//     $check_nombre=$check_nombre->query("SELECT producto_nombre FROM producto WHERE producto_nombre='$nombre'");
	//     if($check_nombre->rowCount()>0){
	//         echo '
	//             <div class="notification is-danger is-light">
	//                 <strong>¡Ocurrio un error inesperado!</strong><br>
	//                 El NOMBRE ingresado ya se encuentra registrado, por favor elija otro
	//             </div>
	//         ';
	//         exit();
	//     }
	//     $check_nombre=null;
    // }


    // /*== Verificando categoria ==*/
    // if($categoria!=$datos['categoria_id']){
	//     $check_categoria=conexion();
	//     $check_categoria=$check_categoria->query("SELECT categoria_id FROM categoria WHERE categoria_id='$categoria'");
	//     if($check_categoria->rowCount()<=0){
	//         echo '
	//             <div class="notification is-danger is-light">
	//                 <strong>¡Ocurrio un error inesperado!</strong><br>
	//                 La categoría seleccionada no existe
	//             </div>
	//         ';
	//         exit();
	//     }
	//     $check_categoria=null;
    // }


    /*== Actualizando datos ==*/
    $actualizar_personal=conexion();
    $actualizar_personal=$actualizar_personal->prepare("UPDATE personal SET personal_nombre=:nombre,personal_apaterno=:apaterno,personal_amaterno=:amaterno,personal_puesto=:puesto WHERE personal_id=:id");

    $marcadores=[
        ":nombre"=>$nombre,
        ":apaterno"=>$paterno,
        ":amaterno"=>$materno,
        ":puesto"=>$puesto,
        ":id"=>$id
    ];


    if($actualizar_personal->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡PERSONAL ACTUALIZADO!</strong><br>
                El personal se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el personal, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_personal=null;