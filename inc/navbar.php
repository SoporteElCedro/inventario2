<nav class="navbar" role="navigation" aria-label="main navigation">

    <div class="navbar-brand">
        <a class="navbar-item" href="index.php?vista=home">
        <img src="./img/TLC-BLANCO.png" width="70" height="30">
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">

            <?php if($_SESSION['permiso']==1){
                echo '<div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">Usuarios</a>

                        <div class="navbar-dropdown">
                            <a href="index.php?vista=user_new" class="navbar-item">Nuevo</a>
                            <a href="index.php?vista=user_list" class="navbar-item">Lista</a>
                            <a href="index.php?vista=user_search" class="navbar-item">Buscar</a>
                        </div>
                    </div> ';
            } ?>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Categorías</a>

                <div class="navbar-dropdown">
                    <a href="index.php?vista=category_new" class="navbar-item">Nueva</a>
                    <a href="index.php?vista=category_list" class="navbar-item">Lista</a>
                    <a href="index.php?vista=category_search" class="navbar-item">Buscar</a>
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Productos</a>

                <div class="navbar-dropdown">
                    <a href="index.php?vista=product_new" class="navbar-item">Nuevo</a>
                    <a href="index.php?vista=product_list" class="navbar-item">Lista</a>
                    <a href="index.php?vista=product_category" class="navbar-item">Por categoría</a>
                    <a href="index.php?vista=product_search" class="navbar-item">Buscar</a>
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Salidas</a>

                <div class="navbar-dropdown">
                    <a href="index.php?vista=product_out" class="navbar-item">Nuevo</a>
                    
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Personal</a>

                <div class="navbar-dropdown">
                    <a href="index.php?vista=person_new" class="navbar-item">Nuevo</a>
                    <a href="index.php?vista=person_list" class="navbar-item">Lista</a>
                    <a href="index.php?vista=person_search" class="navbar-item">Buscar</a>
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Unidades</a>

                <div class="navbar-dropdown">
                    <!-- <a href="index.php?vista=unit_new" class="navbar-item">Nuevo</a> -->
                    <a href="index.php?vista=unit_list" class="navbar-item">Lista</a>
                    <!-- <a href="index.php?vista=unit_search" class="navbar-item">Buscar</a> -->
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Provedores</a>

                <div class="navbar-dropdown">
                    <a href="index.php?vista=supplier_new" class="navbar-item">Nuevo</a>
                    <a href="index.php?vista=supplier_list" class="navbar-item">Lista</a>
                    <a href="index.php?vista=supplier_search" class="navbar-item">Buscar</a>
                </div>
            </div>

        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a href="index.php?vista=user_update&user_id_up=<?php echo $_SESSION['id']; ?>" class="button is-primary is-rounded">
                        Mi cuenta
                    </a>

                    <a href="index.php?vista=logout" class="button is-link is-rounded">
                        Salir
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>