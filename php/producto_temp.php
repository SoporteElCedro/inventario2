<?php
    $inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";

    $consulta_datos="SELECT * FROM temp_producto";

    $conexion=conexion();

    $datos=$conexion->query($consulta_datos);
    $datos=$datos->fetchAll();

    $total=$conexion->query($consulta_datos);
    $total=(int) $total->fetchColumn();

    $Npaginas=ceil($total/$registros);

    if($total>=1 && $pagina<=$Npaginas){
        $contador=$inicio+1;
        $pag_inicio=$inicio+1;
        foreach($datos as $rows){
            $idp=$rows['temp_idprod'];
            $cant=$rows['temp_cantidad'];

            $conid="SELECT producto_nombre, producto_stock FROM producto WHERE producto_id='".$idp."'";
            $dat=$conexion->query($conid);
            $dat=$dat->fetchAll();
            foreach($dat as $rowss){ 
            $tabla.='
            <div class="media-content">
              <div class="content">
                <p>
                  <strong>'.$contador.' - '.$rowss['producto_nombre'].'</strong><br>
                  Cantidad a retirar: '.$cant.'
                </p>
              </div>
              <div class="has-text-right">
                <a href="'.$url.$pagina.'&prodid_del='.$idp.'" class="button is-danger is-rounded is-small">Quitar</a>
			        </div>
            </div>
            ';
            $contador++;
        }}
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
				<p class="has-text-centered" >No hay productos agregados</p>
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

?>