<?php
session_start();

//El control de acceso
if(isset($_SESSION['rol'])  && $_SESSION ['rol'] !== 'admin'){
    header("Location: ../index.php");
    exit();
}


include "../templates/header.php";
?>
<h1 class="mt-5">Interfaz del administrador</h1>
<h3 class="mb-5">Bienvenido al sistema, <strong><?php echo $_SESSION['nombre'] ?></strong>.</h3>
<?php
include "../templates/footer.php";
?>
