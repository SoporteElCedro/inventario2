<div class="container pb-6 pt-6">
    <?php
        require_once "./php/main.php";
    ?>
    <div class="columns">
        <div class="column is-one-third">
            <h2 class="title has-text-centered">PRESTAMO / SALIDAS</h2>
            <form action="" method="POST" class="FormularioAjax" autocomplete="off">
                <div>
                        <?php
                            $personal=conexion();
                            $personal=$personal->query("SELECT peronal_id, personal_nombre, personal_apaterno FROM personal");
                            
                            if($personal->rowCount()>0){
                                $personal=$personal->fetchAll();
                                foreach($personal as $row){
                                    echo '<label for="">Personal</label>
                                          <select name="lista-personal" id="">
                                            <option value="-1" >Seleccione Personal</option>';
                                    echo '  <option value='.$row["peronal_id"].' >'.$row["personal_nombre"].' '.$row["personal_apaterno"].'</option>
                                          </select>';
                                }
                            }else{
                                echo '<p class="has-text-centered" >No hay personal registrado</p>';
                            }
                            $personal=null;
                        ?>
                </div>
                
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
                $url="index.php?vista=product_list&page="; /* <== */
                $registros=15;
                $busqueda="";

                $categoria_id = (isset($_GET['category_id'])) ? $_GET['category_id'] : 0;

                # Paginador producto #
                require_once "./php/producto_salida.php";

            ?>
        </div>
    </div>
</div>