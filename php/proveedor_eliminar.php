<?php
	/*== Almacenando datos ==*/
    $provedor_id_del=limpiar_cadena($_GET['supplier_id_del']);
	$usuario=$_SESSION['permiso'];

    /*== Vereficar Privilegios ==*/
	if($usuario==1){
		/*== Verificando producto ==*/
		$check_provedor=conexion();
		$check_provedor=$check_provedor->query("SELECT * FROM provedores WHERE provedor_id='$provedor_id_del'");
	
		if($check_provedor->rowCount()==1){
	
			$datos=$check_provedor->fetch();
	
			$eliminar_provedor=conexion();
			$eliminar_provedor=$eliminar_provedor->prepare("DELETE FROM provedores WHERE provedor_id=:id");
	
			$eliminar_provedor->execute([":id"=>$provedor_id_del]);
	
			if($eliminar_provedor->rowCount()==1){
		
				echo '
					<div class="notification is-info is-light">
						<strong>¡PROVEEDOR ELIMINADO!</strong><br>
						Los datos del proveedor se eliminaron con exito
					</div>
				';
			}else{
				echo '
					<div class="notification is-danger is-light">
						<strong>¡Ocurrio un error inesperado!</strong><br>
						No se pudo eliminar el proveedor, por favor intente nuevamente
					</div>
				';
			}
			$eliminar_provedor=null;
		}else{
			echo '
				<div class="notification is-danger is-light">
					<strong>¡Ocurrio un error inesperado!</strong><br>
					El PROVEEDOR que intenta eliminar no existe
				</div>
			';
		}
		$check_provedor=null;

	}else{
		echo '
				<div class="notification is-danger is-light">
					<strong>¡Ocurrio un error inesperado!</strong><br>
					El USUARIO no tiene permiso para eliminar al personal
				</div>
			';
	}
	
	?>