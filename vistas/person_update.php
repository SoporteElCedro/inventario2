<div class="container is-fluid mb-6">
	<h1 class="title">Personal</h1>
	<h2 class="subtitle">Actualizar personal</h2>
</div>

<div class="container pb-6 pt-6">
<?php
		include "./inc/btn_back.php";

		require_once "./php/main.php";

		$id = (isset($_GET['person_id_up'])) ? $_GET['person_id_up'] : 0;
		$id=limpiar_cadena($id);

		/*== Verificando producto ==*/
    	$check_personal=conexion();
    	$check_personal=$check_personal->query("SELECT * FROM personal WHERE personal_id='$id'");

        if($check_personal->rowCount()>0){
        	$datos=$check_personal->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/personal_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data" >
    <input type="hidden" name="personal_id" value="<?php echo $datos['personal_id']; ?>" required >
		<div class="columns">
		  	<div class="column">
				
		    	<div class="control">
					<label>*Nombre</label>
				  	<input class="input" type="text" name="personal_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="30" required value="<?php echo $datos['personal_nombre']; ?>">
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>*Apellido Paterno</label>
				  	<input class="input" type="text" name="personal_paterno" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="30" required value="<?php echo $datos['personal_apaterno']; ?>">
				</div>
		  	</div>
			  <div class="column">
		    	<div class="control">
					<label>*Apellido Materno</label>
				  	<input class="input" type="text" name="personal_materno" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="30" required value="<?php echo $datos['personal_amaterno']; ?>">
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>*Puesto</label>
				  	<input class="input" style="width: 200px;" type="text" name="personal_puesto" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="50" required value="<?php echo $datos['personal_puesto']; ?>">
				</div>
		  	</div>
		  	<!-- <div class="column">
		    	<div class="control">
					<label>*Stock</label>
				  	<input class="input" type="text" name="producto_stock" pattern="[0-9]{1,25}" maxlength="25" required >
				</div>
		  	</div>
		  	<div class="column">
				<label>*Categoría</label><br>
		    	<div class="select is-rounded">
				  	<select name="producto_categoria" >
				    	<option value="" selected="" >Seleccione una opción</option>
				    	<?php
    						// $categorias=conexion();
    						// $categorias=$categorias->query("SELECT * FROM categoria");
    						// if($categorias->rowCount()>0){
    						// 	$categorias=$categorias->fetchAll();
    						// 	foreach($categorias as $row){
    						// 		echo '<option value="'.$row['categoria_id'].'" >'.$row['categoria_nombre'].'</option>';
				    		// 	}
				   			// }
				   			// $categorias=null;
				    	?>
				  	</select>
				</div>
		  	</div>
		</div>
		<div class="columns">
			<div class="column">
				<label>Foto o imagen del producto</label><br>
				<div class="file is-small has-name">
				  	<label class="file-label">
				    	<input class="file-input" type="file" name="producto_foto" accept=".jpg, .png, .jpeg" >
				    	<span class="file-cta">
				      		<span class="file-label">Imagen</span>
				    	</span>
				    	<span class="file-name">JPG, JPEG, PNG. (MAX 3MB)</span>
				  	</label>
				</div>
			</div>-->
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