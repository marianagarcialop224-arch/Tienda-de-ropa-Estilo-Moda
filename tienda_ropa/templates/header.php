<!doctype html>
<html lang="en" data-bs-theme="light">

    <head>
        <title>Estilo & Moda</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS v5.3.8 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"/>
         
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.3.8/datatables.min.css" rel="stylesheet" integrity="sha384-nD9P196GmYuiIASpxI7+7/0LqD6BBA74CfgIOSQUo7brmKKeph8lSEMm2sGgSAvK" crossorigin="anonymous">
 
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.3.8/datatables.min.js" integrity="sha384-pszF7QvU8ChuuhQBJGIvzVEcojfpYqQOVG2PaXES4M4Mcn+1CqfQ4r1b/mpdtn/6" crossorigin="anonymous"></script>



        </head>

    <body>
        <header>
            <!-- place navbar here -->
             <nav class="navbar navbar-expand navbar-light bg-light">
                <ul class="nav navbar-nav">
                    
                    
                    <?php
                    if($_SESSION['rol'] === 'admin'):
                    ?> 
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/productos.php">Gestionar inventario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/usuarios.php">Gestionar Usuarios</a>
                    </li>
                    <?php
                    endif;
                    ?>
                  

                  <?php
                    if($_SESSION['rol'] === 'empleado'):
                    ?> 
                    <li class="nav-item">
                        <a class="nav-link" href="../vendedor/index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../vendedor/catalogo.php">Ver catàlogo</a>
                    </li>
                    
                    <?php
                    endif;
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Cerrar sesiòn</a>
                    </li>


                </ul>
             </nav>
             
        </header>
        <main class="container ">

            



        
