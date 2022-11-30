<div class="container pb-6 pt-6">
    <?php
        require_once "./php/main.php";

        
        if(isset($_POST['prod-id'])){
            $valor=$_POST['prod-id'];
            $can=$_POST['stock'];
            
            $checkid=conexion();
            $checkid=$checkid->query("SELECT * FROM temp_producto WHERE temp_idprod='$valor'");
            
            if($checkid->rowCount()==1){
	
                $datos=$checkid->fetch();
                echo '
				<div class="notification is-danger is-light">
					<strong>¡Producto en lista!</strong><br>
					El producto ya esta en lista
				</div>
			';

            }else{
                $guardar_id=conexion();
                $guardar_id=$guardar_id->prepare("INSERT INTO temp_producto(temp_idprod, temp_cantidad) VALUES(:id,:cantidad)");
    
                $marcadores=[
                    ":id"=>$valor,
                    ":cantidad"=>$can
                ];
                $guardar_id->execute($marcadores);
            }
            $guardar_id=null;
        } else{
    
        }
        $checkid=null;

        if(isset($_GET['prodid_del'])){
            // echo $idd=$_GET['prodid_del'];
            require_once "./php/producto_eliminar2.php";
        }
        	
    ?>
    <div class="columns">
        <div class="column is-one-third">
            <h2 class="title has-text-centered">PRESTAMO / SALIDAS</h2>
            <form action="./php/product_borrowed.php" method="POST">
            <div class="has-text-right">
                <button class="button is-link is-success is-rounded">Guardar Salida</button>
                <a href="index.php?vista=home" class="button is-link is-danger is-rounded">Cancelar</a>
                <input type="hidden" name="idprod" value="<?php $valor ?>">
            </div><br>
                <div>
                    <label for="">Personal</label>
                    <select name="lista-personal" id="">
                    <option value="-1" >Seleccione Personal</option>
                    <?php
                        $personal=conexion();
                        $personal=$personal->query("SELECT personal_id, personal_nombre, personal_apaterno FROM personal");

                        if($personal->rowCount()>0){
                            while($row=$personal->fetch(PDO::FETCH_ASSOC)){
                                echo '<option value='.$row["personal_id"].'>'.$row["personal_nombre"].' '.$row["personal_apaterno"].'</option>';
                            }
                        }else{
                            echo '<p class="has-text-centered" >No hay personal registrado</p>';
                        }
                        $personal=null;
                    ?>
                    </select>
                </div>
                <div>
                    <label for="">Unidades</label>
                    <select name="lista-unidad" id="">
                    <option value="0" >Seleccione unidad</option>
                    <?php
                        $unidades=conexion();
                        $unidades=$unidades->query("SELECT unidad_id, unidad_eco FROM unidades");
                        if($unidades->rowCount()>0){
                            while($row1=$unidades->fetch(PDO::FETCH_ASSOC)){
                                echo '<option value='.$row1["unidad_id"].'>'.$row1["unidad_eco"].'</option>';
                            }
                        }else{
                            echo '<p class="has-text-centered" >No hay unidades registradas</p>';
                        }
                        $unidades=null;
                    ?>
                    </select>
                </div>
                <div>
                    <label></label>
                    <textarea name="obs" cols="45" rows="5" placeholder="Observaciones"></textarea>
                </div>

                <?php
                
                if(!isset($_GET['page'])){
                    $pagina=1;
                }else{
                    $pagina=(int) $_GET['page'];
                    if($pagina<=1){
                        $pagina=1;
                    }
                }
                $pagina=limpiar_cadena($pagina);
                $url="index.php?vista=product_out&page="; /* <== */
                $registros=15;
                // $busqueda="";
                require_once "./php/producto_temp.php";
                ?>
            </form>
        </div>
        <div class="column">
        <h2 class="has-text-centered title" >Agrege herramientas o refaciones</h2>
            <?php
                if(!isset($_GET['page'])){
                    $pagina=1;
                }else{
                    $pagina=(int) $_GET['page'];
                    if($pagina<=1){
                        $pagina=1;
                    }
                }

                $pagina=limpiar_cadena($pagina);
                $url="index.php?vista=product_out&page="; /* <== */
                $registros=15;
                $busqueda="";

                $categoria_id = (isset($_GET['category_id'])) ? $_GET['category_id'] : 0;

                # Paginador producto #
                require_once "./php/producto_salida.php";

            ?>
        </div>
    </div>
</div>