<?php
	/*== Almacenando datos ==*/
    $product_id_del=limpiar_cadena($_GET['prodid_del']);

	/*== Verificando producto ==*/
	$check_producto=conexion();
	$check_producto=$check_producto->query("SELECT * FROM temp_producto WHERE temp_idprod='$product_id_del'");
	
	if($check_producto->rowCount()==1){
	
		$datos=$check_producto->fetch();
	
		$eliminar_producto=conexion();
		$eliminar_producto=$eliminar_producto->prepare("DELETE FROM temp_producto WHERE temp_idprod=:id");
	
		$eliminar_producto->execute([":id"=>$product_id_del]);
	
		if($eliminar_producto->rowCount()==1){
	
		}else{
			echo '
				<div class="notification is-danger is-light">
					<strong>¡Ocurrio un error inesperado!</strong><br>
					No se pudo eliminar el producto, por favor intente nuevamente
				</div>
			';
		}
		$eliminar_producto=null;
	}else{
		echo '
			<div class="notification is-danger is-light">
				<strong>¡Ocurrio un error inesperado!</strong><br>
				El PRODUCTO que intenta eliminar no existe
			</div>
		';
	}
	$check_producto=null;		