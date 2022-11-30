<div class="container is-fluid mb-6">
	<h1 class="title">Proveedores</h1>
	<h2 class="subtitle">Actualizar proveedor</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		include "./inc/btn_back.php";

		require_once "./php/main.php";

		$id = (isset($_GET['supplier_id_up'])) ? $_GET['supplier_id_up'] : 0;
		$id=limpiar_cadena($id);

		/*== Verificando producto ==*/
    	$check_provedor=conexion();
    	$check_provedor=$check_provedor->query("SELECT * FROM provedores WHERE provedor_id='$id'");

        if($check_provedor->rowCount()>0){
        	$datos=$check_provedor->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/provedor_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data" >
    <input type="hidden" name="provedor_id" value="<?php echo $datos['provedor_id']; ?>" required >
		<div class="columns">
		  	<div class="column">
				
		    	<div class="control">
					<label>*Nombre del Proveedor</label>
				  	<input class="input" type="text" name="provedor_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="70" required value="<?php echo $datos['provedor_nombre']; ?>">
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
    <?php 
		}else{
			include "./inc/error_alert.php";
		}
		$check_personal=null;
	?>
	*Campos Obligatorios <br>
	<!-- Observacion: Debe de existir antes una categoria -->
</div>