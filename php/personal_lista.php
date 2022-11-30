<?php
	$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";

	$campos="personal.personal_id,personal.personal_nombre,personal.personal_apaterno,personal.personal_amaterno,personal.personal_puesto";

	if(isset($busqueda) && $busqueda!=""){

		$consulta_datos="SELECT $campos FROM personal WHERE personal.personal_nombre LIKE '%$busqueda%' OR personal.personal_apaterno LIKE '%$busqueda%' ORDER BY personal.personal_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(personal_id) FROM personal WHERE personal_apaterno LIKE '%$busqueda%' OR personal_nombre LIKE '%$busqueda%'";

	}else{

		$consulta_datos="SELECT $campos FROM personal ORDER BY personal.personal_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(personal_id) FROM personal";

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
			        <div class="media-content">
			            <div class="content">
						<p>
						<strong>'.$contador.' - '.$rows['personal_nombre'].' '.$rows['personal_apaterno'].' '.$rows['personal_amaterno'].'</strong><br>
						<strong>PUESTO:</strong> '.$rows['personal_puesto'].'
					  </p>
			            </div>
			            <div class="has-text-right">
			                <a href="index.php?vista=person_update&person_id_up='.$rows['personal_id'].'" class="button is-success is-rounded is-small">Actualizar</a>
			                <a href="'.$url.$pagina.'&person_id_del='.$rows['personal_id'].'" class="button is-danger is-rounded is-small">Eliminar</a>
			            </div>
			        </div>
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

	$conexion=null;
	echo $tabla;

	if($total>=1 && $pagina<=$Npaginas){
		echo paginador_tablas($pagina,$Npaginas,$url,7);
	}