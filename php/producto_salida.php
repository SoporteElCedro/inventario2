<?php
	$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";

	$campos="producto.producto_id,producto.producto_codigo,producto.producto_nombre,producto.producto_precio,producto.producto_stock,producto.producto_foto,producto.categoria_id,producto.usuario_id,categoria.categoria_id,categoria.categoria_nombre,usuario.usuario_id,usuario.usuario_nombre,usuario.usuario_apellido";

	if(isset($busqueda) && $busqueda!=""){

		$consulta_datos="SELECT $campos FROM producto INNER JOIN categoria ON producto.categoria_id=categoria.categoria_id INNER JOIN usuario ON producto.usuario_id=usuario.usuario_id WHERE producto.producto_codigo LIKE '%$busqueda%' OR producto.producto_nombre LIKE '%$busqueda%' ORDER BY producto.producto_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(producto_id) FROM producto WHERE producto_codigo LIKE '%$busqueda%' OR producto_nombre LIKE '%$busqueda%'";

	}elseif($categoria_id>0){

		$consulta_datos="SELECT $campos FROM producto INNER JOIN categoria ON producto.categoria_id=categoria.categoria_id INNER JOIN usuario ON producto.usuario_id=usuario.usuario_id WHERE producto.categoria_id='$categoria_id' ORDER BY producto.producto_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(producto_id) FROM producto WHERE categoria_id='$categoria_id'";

	}else{

		$consulta_datos="SELECT $campos FROM producto INNER JOIN categoria ON producto.categoria_id=categoria.categoria_id INNER JOIN usuario ON producto.usuario_id=usuario.usuario_id ORDER BY producto.producto_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(producto_id) FROM producto";

	}

	$conexion=conexion();

	$datos = $conexion->query($consulta_datos);
	$datos = $datos->fetchAll();

	$total = $conexion->query($consulta_total);
	$total = (int) $total->fetchColumn();

	$Npaginas =ceil($total/$registros);

	if($total>=1 && $pagina<=$Npaginas){
		$contador=$inicio+1;
		$pag_inicio=$inicio+1;
		foreach($datos as $rows){
			
			$tabla.='
				<article class="media">
			        <figure class="media-left">
			            <p class="image is-64x64">';
			            if(is_file("./img/producto/".$rows['producto_foto'])){
			            	$tabla.='<img src="./img/producto/'.$rows['producto_foto'].'">';
			            }else{
			            	$tabla.='<img src="./img/producto.png">';
			            }
			   $tabla.='</p>
			        </figure>
			        <div class="media-content">
			            <div class="content">
			              <p>
			                <strong>'.$contador.' - '.$rows['producto_nombre'].'</strong><br>
			                <strong>CODIGO:</strong> '.$rows['producto_codigo'].', <strong>STOCK:</strong> '.$rows['producto_stock'].', <strong>CATEGORIA:</strong> '.$rows['categoria_nombre'].' 
			              </p>
			            </div>
			            <div class="has-text-right">
							<form method="POST" action="index.php?vista=product_out">
								<input type="hidden" name="prod-id" value="'.$rows['producto_id'].'"/>
								<input name="stock" type="number" class="txtnum" value="'.$rows['producto_stock'].'"/>
								<label class="txt">piezas salientes</label>
								<input class="button is-link is-rounded is-small" type="submit" value="Agregar Producto"/> 
							</form>
			            </div>
			        </div>
			    </article>

			    <hr>

            ';
            $contador++;
		}
		$pag_final=$contador-1;
	}else{
		if($total>=1){
			$tabla.='
				<p class="has-text-centered" >
					<a href="'.$url.'1" class="button is-link is-rounded is-small mt-4 mb-4">
						Haga clic acá para recargar el listado
					</a>
				</p>
			';
		}else{
			$tabla.='
				<p class="has-text-centered" >No hay registros en el sistema</p>
			';
		}
	}

	if($total>0 && $pagina<=$Npaginas){
		$tabla.='<p class="has-text-right">Mostrando productos <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
	}
	
	
		// <form action="index.php?vista=" method="POST">
		// <div class="has-text-right">
		// 	<button class="button is-link is-success is-rounded">Guardar Salida</button>
		// 	<a href="index.php?vista=home" class="button is-link is-danger is-rounded">Cancelar</a>
		echo'<input type="hidden" name="idprod" value="<?php $valor ?>">';
		// </div><br>
		echo '<div>
				<label for="">Personal</label>
				<select name="lista-personal" id="">
					<option value="-1" >Seleccione Personal</option>';
				$personal=conexion();
				$personal=$conexion->query("SELECT personal_id, personal_nombre, personal_apaterno FROM personal");
					while($row=$personal->fetch(PDO::FETCH_ASSOC)){
						echo '<option value="'.$row['personal_id'].'">'.$row['personal_nombre'].' '.$row['personal_apaterno'].'</option>';
					}
				echo '
				</select>
				<label for="">Unidades</label>
				<select name="lista-unidades" id="">
					<option value="-1" >Seleccione Personal</option>';
				$unidades=conexion();
                $unidades=$unidades->query("SELECT unidad_id, unidad_eco FROM unidades");
                    while($row1=$unidades->fetch(PDO::FETCH_ASSOC)){
                        echo '<option value='.$row1["unidad_id"].'>'.$row1["unidad_eco"].'</option>';
                    }
				echo'</select>
			</div>
			<div>
                <label></label>
                <textarea name="obs" cols="45" rows="5" placeholder="Observaciones"></textarea>
            </div>
		';
	$conexion=null;
	echo $tabla;

	if($total>=1 && $pagina<=$Npaginas){
		echo paginador_tablas($pagina,$Npaginas,$url,7);
	}