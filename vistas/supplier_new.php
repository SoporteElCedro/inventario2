<div class="container is-fluid mb-6">
	<h1 class="title">Personal</h1>
	<h2 class="subtitle">Nuevo personal</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		require_once "./php/main.php";
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/provedor_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data" >
		<div class="columns">
		  	<div class="column">
				
		    	<div class="control">
					<label>*Nombre del Proveedor</label>
				  	<input class="input" type="text" name="provedor_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="70" required >
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
	*Campos Obligatorios <br>
	<!-- Observacion: Debe de existir antes una categoria -->
</div>