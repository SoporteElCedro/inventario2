<?php
	/*== Almacenando datos ==*/
    $person_id_del=limpiar_cadena($_GET['person_id_del']);
	$usuario=$_SESSION['permiso'];

    /*== Vereficar Privilegios ==*/
	if($usuario==1){
		/*== Verificando producto ==*/
		$check_personal=conexion();
		$check_personal=$check_personal->query("SELECT * FROM personal WHERE personal_id='$person_id_del'");
	
		if($check_personal->rowCount()==1){
	
			$datos=$check_personal->fetch();
	
			$eliminar_personal=conexion();
			$eliminar_personal=$eliminar_personal->prepare("DELETE FROM personal WHERE personal_id=:id");
	
			$eliminar_personal->execute([":id"=>$person_id_del]);
	
			if($eliminar_personal->rowCount()==1){
	
				// if(is_file("./img/producto/".$datos['producto_foto'])){
				// 	chmod("./img/producto/".$datos['producto_foto'], 0777);
				// 	unlink("./img/producto/".$datos['producto_foto']);
				// }
	
				echo '
					<div class="notification is-info is-light">
						<strong>¡PERSONAL ELIMINADO!</strong><br>
						Los datos del personal se eliminaron con exito
					</div>
				';
			}else{
				echo '
					<div class="notification is-danger is-light">
						<strong>¡Ocurrio un error inesperado!</strong><br>
						No se pudo eliminar el personal, por favor intente nuevamente
					</div>
				';
			}
			$eliminar_personal=null;
		}else{
			echo '
				<div class="notification is-danger is-light">
					<strong>¡Ocurrio un error inesperado!</strong><br>
					El PERSONAL que intenta eliminar no existe
				</div>
			';
		}
		$check_personal=null;

	}else{
		echo '
				<div class="notification is-danger is-light">
					<strong>¡Ocurrio un error inesperado!</strong><br>
					El USUARIO no tiene permiso para eliminar al personal
				</div>
			';
	}
	
	